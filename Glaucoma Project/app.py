from flask import Flask, request, render_template, session, send_file
import mysql.connector
import cv2
import io
import numpy as np
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
from email.mime.application import MIMEApplication
from tensorflow.keras.models import load_model
from PIL import Image
import os
from reportlab.lib import colors
from reportlab.lib.pagesizes import letter
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle, Image as RLImage
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib.units import inch
import datetime

# Initialize Flask app
app = Flask(__name__)
app.secret_key = 'your-secure-secret-key-change-this'  # Change this!

# Load trained model
model_path = "Model/vgg16_glaucoma_model.h5"
if not os.path.exists(model_path):
    raise FileNotFoundError(f"Model not found at {model_path}")
model = load_model(model_path)

# Class labels for prediction
CLASS_LABELS = {0: "No Glaucoma", 1: "Glaucoma Detected"}

# MySQL configuration
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'glaucoma_db'
}

# Email configuration
SMTP_SERVER = "smtp.gmail.com"
SMTP_PORT = 587
EMAIL_ADDRESS = "naikaishwarya44@gmail.com"
EMAIL_PASSWORD = "ipmw jjmf hneb cwrp"


def get_db_connection():
    return mysql.connector.connect(**db_config)


def generate_pdf_report(result, image_path=None):
    buffer = io.BytesIO()
    doc = SimpleDocTemplate(buffer, pagesize=letter)
    styles = getSampleStyleSheet()
    story = []

    # Custom styles
    title_style = ParagraphStyle(
        'CustomTitle',
        parent=styles['Heading1'],
        fontSize=24,
        spaceAfter=30,
        textColor=colors.HexColor('#2757a4')
    )
    heading_style = ParagraphStyle(
        'CustomHeading',
        parent=styles['Heading2'],
        fontSize=16,
        spaceAfter=12,
        textColor=colors.HexColor('#2757a4')
    )
    normal_style = styles['Normal']

    story.append(Paragraph("Your Topic Name - Glaucoma Detection Report", title_style))
    story.append(Spacer(1, 20))

    current_time = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    story.append(Paragraph(f"Report Generated: {current_time}", normal_style))
    story.append(Spacer(1, 20))

    # Patient Information
    story.append(Paragraph("Patient Information", heading_style))
    patient_data = [
        ["Name:", result['name']],
        ["Age:", str(result['age'])],
        ["Gender:", result['gender']],
        ["Medical History:", result['description'] or "No history provided"]
    ]
    patient_table = Table(patient_data, colWidths=[2 * inch, 4 * inch])
    patient_table.setStyle(TableStyle([
        ('GRID', (0, 0), (-1, -1), 1, colors.grey),
        ('BACKGROUND', (0, 0), (0, -1), colors.lightgrey),
        ('PADDING', (0, 0), (-1, -1), 6),
    ]))
    story.append(patient_table)
    story.append(Spacer(1, 20))

    # If image is provided, add it to the report
    if image_path:
        img = RLImage(image_path, width=4 * inch, height=3 * inch)
        story.append(Paragraph("Retinal Scan", heading_style))
        story.append(img)
        story.append(Spacer(1, 20))

    # Prediction Result
    story.append(Paragraph("Prediction Result", heading_style))
    result_color = colors.red if result['prediction'] == "Glaucoma Detected" else colors.green
    result_style = ParagraphStyle(
        'ResultStyle',
        parent=normal_style,
        textColor=result_color,
        fontSize=14,
        bold=True
    )
    story.append(Paragraph(result['prediction'], result_style))

    # Add confidence score
    confidence_style = ParagraphStyle(
        'ConfidenceStyle',
        parent=normal_style,
        fontSize=12
    )
    story.append(Spacer(1, 8))
    story.append(Paragraph(f"Confidence: {result['confidence']}%", confidence_style))

    story.append(Spacer(1, 20))

    # Recommendations
    story.append(Paragraph("Recommendations", heading_style))
    for recommendation in result['recommendation']:
        story.append(Paragraph(f"• {recommendation}", normal_style))
    story.append(Spacer(1, 20))

    # Diet Plan
    story.append(Paragraph("Recommended Diet Plan", heading_style))
    for diet_item in result['diet_plan']:
        story.append(Paragraph(f"• {diet_item}", normal_style))

    # Footer
    story.append(Spacer(1, 30))
    footer_style = ParagraphStyle(
        'Footer',
        parent=styles['Italic'],
        textColor=colors.grey,
        fontSize=8
    )
    story.append(Paragraph(
        "This is an AI-generated report for screening purposes only. Please consult with a healthcare professional for proper medical diagnosis.",
        footer_style
    ))

    doc.build(story)
    buffer.seek(0)
    return buffer


def send_email(name, recipient_email, age, gender, description, prediction, result):
    subject = "Your Topic Name - Glaucoma Detection Report"

    # Generate PDF report
    pdf_buffer = generate_pdf_report(result)

    # Create message
    msg = MIMEMultipart()
    msg['From'] = EMAIL_ADDRESS
    msg['To'] = recipient_email
    msg['Subject'] = subject

    # Email body
    body = f"""
    Dear {name},

    Thank you for using Your Topic Name Glaucoma Detection Service. Please find your detailed report attached to this email.

    Summary of Results:
    - Prediction: {prediction}
    - Confidence: {result['confidence']}%
    - Date: {datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")}

    Important Note:
    This is an AI-assisted screening result. Please consult with an eye care professional for proper medical diagnosis.

    Best regards,
    Your Topic Name Team
    """
    msg.attach(MIMEText(body, 'plain'))

    # Attach PDF report
    pdf_attachment = MIMEApplication(pdf_buffer.read(), _subtype='pdf')
    pdf_attachment.add_header('Content-Disposition', 'attachment', filename='glaucoma_report.pdf')
    msg.attach(pdf_attachment)

    try:
        server = smtplib.SMTP(SMTP_SERVER, SMTP_PORT)
        server.starttls()
        server.login(EMAIL_ADDRESS, EMAIL_PASSWORD)
        server.send_message(msg)
        server.quit()
        return True
    except Exception as email_error:
        print(f"Failed to send email: {email_error}")
        return False


def preprocess_image(image):
    """Preprocess the input image to match model input requirements."""
    image = np.array(image)
    image = cv2.resize(image, (224, 224), interpolation=cv2.INTER_AREA)
    image = image.astype(np.float32) / 255.0
    return np.expand_dims(image, axis=0)


def get_recommendations(predicted_class):
    if predicted_class == 0:
        return [
            "👁️ Maintain a healthy lifestyle",
            "🏥 Get regular eye check-ups",
            "🕶️ Protect your eyes from UV light",
            "💪 Exercise regularly",
            "😴 Get adequate sleep"
        ]
    else:
        return [
            "👨‍⚕️ Consult an ophthalmologist immediately",
            "💊 Follow prescribed medications",
            "⚠️ Avoid excessive eye strain",
            "📱 Limit screen time",
            "🌙 Take regular breaks"
        ]


def get_diet_plan(predicted_class):
    if predicted_class == 0:
        return [
            "🥬 Eat green leafy vegetables",
            "🐟 Include omega-3 fatty acids (fish, nuts)",
            "💧 Stay hydrated",
            "🥕 Consume vitamin A rich foods",
            "🫐 Include antioxidant-rich berries"
        ]
    else:
        return [
            "🥕 Increase vitamin A intake",
            "☕ Reduce caffeine and salt consumption",
            "🚫 Avoid processed foods",
            "🥗 Include more fresh vegetables",
            "🍊 Increase vitamin C intake"
        ]


@app.route("/")
def index():
    return render_template("index.html")


@app.route("/predict", methods=["POST"])
def predict():
    try:

        name = request.form.get('name', '').strip()
        email = request.form.get('email', '').strip()
        age = request.form.get('age', '').strip()
        gender = request.form.get('gender', '').strip()
        description = request.form.get('description', '').strip()
        description = description[:300]

        if not name or not email or not age or not gender:
            return render_template("index.html", error="All fields except description are required.")

        if 'image' not in request.files or request.files['image'].filename == '':
            return render_template("index.html", error="No file uploaded. Please upload an image.")

        file = request.files['image']

        image = Image.open(io.BytesIO(file.read())).convert("RGB")
        processed_image = preprocess_image(image)

        prediction = model.predict(processed_image)
        predicted_probability = float(prediction[0][0])
        predicted_class = int(np.round(predicted_probability))
        class_label = CLASS_LABELS.get(predicted_class, "Unknown")

        # Calculate confidence percentage
        if predicted_class == 1:  # Glaucoma detected
            confidence = round(predicted_probability * 100, 1)
        else:  # No glaucoma
            confidence = round((1 - predicted_probability) * 100, 1)

        db_connection = get_db_connection()
        cursor = db_connection.cursor()
        sql_query = """
        INSERT INTO user_details (name, email, age, gender, description, prediction, confidence)
        VALUES (%s, %s, %s, %s, %s, %s, %s)
        """
        cursor.execute(sql_query, (name, email, age, gender, description, class_label, confidence))
        db_connection.commit()
        cursor.close()
        db_connection.close()

        result = {
            'name': name,
            'email': email,
            'age': age,
            'gender': gender,
            'description': description,
            'prediction': class_label,
            'confidence': confidence,
            'recommendation': get_recommendations(predicted_class),
            'diet_plan': get_diet_plan(predicted_class)
        }

        session['last_result'] = result

        send_email(name, email, age, gender, description, class_label, result)

        return render_template("result.html", result=result)

    except Exception as e:
        return render_template("index.html", error=f"An error occurred: {str(e)}")


@app.route("/download_report")
def download_report():
    try:
        result = session.get('last_result')
        if not result:
            return "Report not found", 404

        pdf_buffer = generate_pdf_report(result)
        return send_file(
            pdf_buffer,
            download_name='glaucoma_report.pdf',
            mimetype='application/pdf'
        )
    except Exception as e:
        return str(e), 500


if __name__ == "__main__":
    app.run(debug=True, port=5001)