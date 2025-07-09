<?php
session_start();
require_once 'config/connection.php';
$username = $_SESSION['username']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glaucoma Detection</title>
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

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 1.5rem;
        }

        .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        .chart-container {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1rem;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-card {
            background: white;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
        }

        .action-card i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        /* New styles for aligning cards and chart in the same row */
        .row-custom {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-custom {
            flex: 0 0 48%;
            margin-bottom: 1rem;
        }

        /* Glaucoma Content Styling */
        .glaucoma-section {
            background-color: white;
            padding: 2rem;
            margin-top: 2rem;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
        }

        .glaucoma-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .glaucoma-text {
            font-size: 1.1rem;
            color: #555;
        }

        .glaucoma-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
<?php include 'include/header.php'; ?>
    
    <div class="container mt-4">
        <div class="dashboard-header">
            <h2>Welcome back, <?php echo $username; ?>! 👋</h2>
            <p class="text-muted">Here's what's happening with your platform today.</p>
        </div>
        
        <!-- Custom Row for Total Users and Graph -->
        <div class="row-custom">
            <div class="col-custom">
                <div class="card stats-card">
                <?php
                    // Assuming you have a database connection $conn
                    $query = "SELECT COUNT(*) AS userCount FROM registration"; // Modify the table name if necessary
                    $result = mysqli_query($conn, $query);

                    // Fetch the count from the result
                    $row = mysqli_fetch_assoc($result);
                    $userCount = $row['userCount'];
                ?>
                    <!-- HTML code for displaying the user count -->
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-subtitle mb-2">Total Users</h6>
                            <p class="stats-number"><?php echo $userCount; ?></p>
                            <?php
                                // Assuming you have a database connection $conn
                                $queryGrowth = "SELECT (COUNT(*) - (SELECT COUNT(*) FROM registration WHERE created_at < DATE_SUB(NOW(), INTERVAL 1 MONTH))) / (SELECT COUNT(*) FROM registration WHERE created_at < DATE_SUB(NOW(), INTERVAL 1 MONTH)) * 100 AS growthRate FROM registration WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                                $resultGrowth = mysqli_query($conn, $queryGrowth);

                                // Fetch the growth rate from the result
                                $rowGrowth = mysqli_fetch_assoc($resultGrowth);
                                $growthRate = round($rowGrowth['growthRate'], 2);
                            ?>
                            <p class="mb-0"><i class="fas fa-arrow-up me-2"></i><?php echo $growthRate; ?>% increase</p>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="card chart-container">
                    <h5 class="card-title mb-4">User Growth Analytics</h5>
                    <canvas id="userChart" height="100"></canvas>
                </div>
                </div>
            </div>

            <div class="col-custom">
            <img src="img/3d.gif" alt="Glaucoma Information" style="max-width: 100%; border-radius: 15px;">
            
            </div>
        </div>

        <!-- Glaucoma Information Section -->
        <div class="glaucoma-section">
            <div class="glaucoma-text">
                <p>Glaucoma is a group of eye conditions that damage the optic nerve, which is essential for vision. It is often caused by abnormally high pressure in the eye, and can lead to blindness if not treated. It is a leading cause of irreversible blindness worldwide.</p>
                <p><strong>Symptoms:</strong> Glaucoma may have no symptoms at first, but can lead to peripheral vision loss and eventually total blindness. Early detection is key.</p>
                <p><strong>Treatment:</strong> While glaucoma cannot be cured, it can be managed through medication, laser treatments, or surgery to lower intraocular pressure and prevent further vision loss.</p>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <div class="glaucoma-icon">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
        </div>

    </div>

    <script>
        var ctx = document.getElementById('userChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'User Growth',
                    data: [],
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderColor: 'rgba(67, 97, 238, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgba(67, 97, 238, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        function fetchUserData() {
            fetch('fetch_user_data.php')
                .then(response => response.json())
                .then(data => {
                    let labels = data.map(item => item.month); // Extracting month names
                    let userCounts = data.map(item => item.userCount); // Extracting user count

                    // Update Chart Data
                    userChart.data.labels = labels;
                    userChart.data.datasets[0].data = userCounts;
                    userChart.update();
                })
                .catch(error => console.error('Error fetching user data:', error));
        }

        // Auto-refresh data every 5 seconds
        setInterval(fetchUserData, 5000);

        // Fetch initial data
        fetchUserData();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
