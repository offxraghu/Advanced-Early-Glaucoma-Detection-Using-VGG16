<?php
session_start();
require_once 'config/connection.php';

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['change_password'])) {
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $username = $_SESSION['username'];
    $password_pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/';

    if (!preg_match($password_pattern, $new_password)) {
        echo "<script>alert('New password must be at least 6 characters long, contain at least one letter, one number, and one special character.'); location.href = 'change-password.php';</script>";
        exit;
    }
    
    if ($new_password !== $confirm_password) {
        echo "<script>alert('New password and confirm password do not match.'); location.href = 'change_password.php';</script>";
        exit;
    }

    $query = "SELECT password FROM registration WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($current_password, $row['password'])) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE registration SET password = '$hashed_password' WHERE username = '$username'";

            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Password updated successfully.'); location.href = 'dashboard.php';</script>";
            } else {
                echo "<script>alert('Failed to update the password. Please try again.'); location.href = 'change_password.php';</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect.'); location.href = 'change-password.php';</script>";
        }
    } else {
        echo "<script>alert('User not found.'); location.href = 'index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .dashboard-header {
            text-align: center;
            margin: 2rem 0;
            color: var(--primary-color);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .form-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            margin-top: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }
    </style>
</head>
<body>
<?php include 'include/header.php'; ?>

<div class="container mt-4">
    <div class="dashboard-header">
        <h2>Change Your Password 🔒</h2>
        <p class="text-muted">Ensure your account security by updating your password regularly.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card form-card">
                
                <form method="POST" action="change-password.php">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password:</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password:</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password:</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
