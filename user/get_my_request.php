<?php
include '../config/config.php';

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([]);
    exit();
}

$query = "SELECT * FROM product_requests WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$requests = [];

while ($row = mysqli_fetch_assoc($result)) {
    $requests[] = $row;
}

echo json_encode($requests);
mysqli_close($conn);
?>