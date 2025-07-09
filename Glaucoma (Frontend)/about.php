<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Glaucoma - Understanding Eye Health</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
         :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --background-color: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--background-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1rem 2rem;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* :root {
            --primary-color: #2C3E50;
            --secondary-color: #3498DB;
            --accent-color: #E74C3C;
            --text-color: #34495E;
        } */

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }

        .hero-section {
            background: linear-gradient(rgba(44, 62, 80, 0.9), rgba(44, 62, 80, 0.9)),
                        url('/api/placeholder/1200/400');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }

        .info-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .section-title {
            color: var(--primary-color);
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--secondary-color);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .highlight-box {
            background-color: #f8f9fa;
            border-left: 4px solid var(--accent-color);
            padding: 20px;
            margin: 20px 0;
        }

        .treatment-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid var(--secondary-color);
        }
    </style>
</head>
<body>
    <?php include 'include/header.php'; ?>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center">
            <h1>Understanding Glaucoma</h1>
            <p class="lead">Learn about the silent thief of sight and how to protect your vision</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- What is Glaucoma Section -->
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="section-title">What is Glaucoma?</h2>
                <p>Glaucoma is a group of eye conditions that damage the optic nerve, which is vital for good vision. This damage is often caused by abnormally high pressure in your eye. It's one of the leading causes of blindness for people over 60 years old.</p>
                <div class="highlight-box">
                    <h5>Key Facts:</h5>
                    <ul>
                        <li>Affects more than 3 million Americans</li>
                        <li>Often has no early warning signs</li>
                        <li>Can lead to permanent vision loss if untreated</li>
                        <li>Regular eye exams are crucial for early detection</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <img src="img/i1.jpg" alt="Eye diagram showing glaucoma" class="img-fluid rounded shadow">
            </div>
        </div>

        <!-- Types of Glaucoma -->
        <div class="row mb-5">
            <h2 class="section-title">Types of Glaucoma</h2>
            <div class="col-md-4">
                <div class="info-card p-4">
                    <i class="fas fa-eye info-icon"></i>
                    <h4>Open-angle Glaucoma</h4>
                    <p>The most common form, occurs when the drainage angle remains open but fluid doesn't drain properly.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card p-4">
                    <i class="fas fa-exclamation-triangle info-icon"></i>
                    <h4>Angle-closure Glaucoma</h4>
                    <p>Occurs when the iris blocks the drainage angle, requiring immediate medical attention.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card p-4">
                    <i class="fas fa-child info-icon"></i>
                    <h4>Normal-tension Glaucoma</h4>
                    <p>Optic nerve damage occurs despite normal eye pressure levels.</p>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="row mb-5 text-center">
            <h2 class="section-title text-center w-100">Glaucoma by the Numbers</h2>
            <div class="col-md-3">
                <div class="stat-number">3M+</div>
                <p>Americans affected</p>
            </div>
            <div class="col-md-3">
                <div class="stat-number">50%</div>
                <p>Cases undiagnosed</p>
            </div>
            <div class="col-md-3">
                <div class="stat-number">60+</div>
                <p>Age group most at risk</p>
            </div>
            <div class="col-md-3">
                <div class="stat-number">15%</div>
                <p>Family history risk</p>
            </div>
        </div>

        <!-- Treatment Options -->
        <div class="row mb-5">
            <h2 class="section-title">Treatment Options</h2>
            <div class="col-md-6">
                <div class="treatment-card">
                    <h4><i class="fas fa-pills me-2"></i>Medications</h4>
                    <p>Eye drops are often the first choice to lower eye pressure. These medications work by either reducing fluid production or improving drainage.</p>
                </div>
                <div class="treatment-card">
                    <h4><i class="fas fa-laser me-2"></i>Laser Treatment</h4>
                    <p>Laser trabeculoplasty opens clogged channels in the eye's drainage system, helping to reduce pressure.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="treatment-card">
                    <h4><i class="fas fa-hospital me-2"></i>Surgery</h4>
                    <p>Various surgical procedures can create new drainage channels or implant devices to help fluid drain properly.</p>
                </div>
                <div class="treatment-card">
                    <h4><i class="fas fa-heart me-2"></i>Lifestyle Changes</h4>
                    <p>Regular exercise, maintaining a healthy diet, and protecting eyes from injury can help manage glaucoma.</p>
                </div>
            </div>
        </div>

        <!-- Prevention Tips -->
        <div class="row mb-5">
            <div class="col-md-6">
                <img src="img/i2.jpg" alt="Regular eye examination" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Prevention & Early Detection</h2>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i>Regular eye examinations</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Know your family history</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Exercise regularly</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Wear eye protection</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Maintain a healthy diet</li>
                </ul>
                <div class="highlight-box mt-4">
                    <p class="mb-0"><strong>Remember:</strong> Early detection through regular eye exams is crucial for preventing vision loss from glaucoma.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>About This Resource</h5>
                    <p>This information is provided for educational purposes only. Always consult with an eye care professional for medical advice.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Emergency Contact</h5>
                    <p>If you experience sudden vision changes or eye pain, contact your eye doctor immediately.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>