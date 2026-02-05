<?php
include '../config/config.php';

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([]);
    exit();
}

$query = "SELECT * FROM notifications WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$notifs = [];

while ($row = mysqli_fetch_assoc($result)) {
    $notifs[] = $row;
}

echo json_encode($notifs);
mysqli_close($conn);
?>