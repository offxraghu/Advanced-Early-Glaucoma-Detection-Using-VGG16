<?php
session_start();
require_once 'config/connection.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM registration WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) { 
            $_SESSION['isLogin'] = true;
            $_SESSION['username'] = $row['username'];
            echo "<script>alert('Login successful!'); location.href = 'dashboard.php';</script>";
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with the provided username.'); location.href = 'index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glaucoma Detection - Login</title>
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

        .login-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            padding: 35px;
            text-align: center;
        }

        .login-header {
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
    <div class="login-container">
        <div class="login-header">Glaucoma Detection</div>
        <p>Login to your account</p>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <div class="footer">
            <p>Don't have an account? <a href="registration.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>
