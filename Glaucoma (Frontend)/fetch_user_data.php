<?php
require_once 'config/connection.php';

// Query to get user registration counts for the last 6 months
$query = "SELECT DATE_FORMAT(created_at, '%b') AS month, COUNT(*) AS userCount 
          FROM registration 
          WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
          GROUP BY month 
          ORDER BY MIN(created_at) ASC";  // Ensures chronological order

$result = mysqli_query($conn, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Return JSON response
echo json_encode($data);
?>
