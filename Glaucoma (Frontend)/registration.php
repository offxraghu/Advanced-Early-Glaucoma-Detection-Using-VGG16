<?php
require_once 'config/connection.php';

function validate_input($username, $password) {
    $username_pattern = '/^[a-zA-Z_]+$/';
    $password_pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/';

    if (!preg_match($username_pattern, $username)) {
        echo "<script>alert('Username should contain only letters and underscores.');</script>";
        return false;
    }

    if (!preg_match($password_pattern, $password)) {
        echo "<script>alert('Password should be at least 6 characters long and contain at least one special character, one number, and one letter with both upper and lower case.');</script>";
        return false;
    }

    return true;
}

if (isset($_POST['register'])) {
    $u_name = mysqli_real_escape_string($conn, $_POST['username']);
    $u_email = mysqli_real_escape_string($conn, $_POST['email']);
    $u_phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $u_password = $_POST['password'];

    if (validate_input($u_name, $u_password)) {
        $u_password_hashed = password_hash($u_password, PASSWORD_BCRYPT);

        $check_email = "SELECT * FROM registration WHERE email = '$u_email'";
        $email_result = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($email_result) > 0) {
            echo "<script>alert('Email already registered. Please use a different email.');</script>";
        } else {
            $sql = "INSERT INTO registration (username, email, phone, password, user_type, status, created_at) 
                    VALUES ('$u_name', '$u_email', '$u_phone', '$u_password_hashed', 'User', 'Active', NOW())";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>alert('You have registered successfully'); location.href='index.php';</script>";
            } else {
                echo "<script>alert('Unable to process your request');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glaucoma Detection - Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #4361ee;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            padding: 35px;
            text-align: center;
        }

        .register-header {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #bbb;
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s ease-in-out;
        }

        .form-group input:focus {
            border-color:rgb(15, 156, 78);
            outline: none;
            box-shadow: 0 0 8px rgba(51, 212, 124, 0.83);
        }

        .btn {
            width: 100%;
            padding: 14px;
            background:rgb(49, 202, 11);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #2e8b57;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .footer a {
            color: #3cb371;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">Glaucoma Detection</div>
        <p>Create an Account</p>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="register" class="btn">Register</button>
        </form>
        <div class="footer">
            <p>Already have an account? <a href="index.php">Login</a></p>
        </div>
    </div>
</body>
</html>
