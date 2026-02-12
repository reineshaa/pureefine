<?php
header('Content-Type: application/json');
include '../config/config.php';

$query = "SELECT * FROM notifications WHERE user_id IN (SELECT id FROM users WHERE role = 'admin') ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

$notifications = array();
while($row = mysqli_fetch_assoc($result)) {
    $row['created_at'] = $row['created_at'] ?? "";
    $row['message'] = $row['message'] ?? "";
    $row['status'] = $row['status'] ?? "pending";
    $notifications[] = $row;
}

echo json_encode($notifications);
?>