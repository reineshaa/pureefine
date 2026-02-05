<?php
include '../config/config.php';

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode(["status" => "error", "message" => "User ID kosong"]);
    exit();
}

$query = "SELECT p.* FROM products p 
          JOIN favorites f ON p.id = f.product_id 
          WHERE f.user_id = '$user_id' 
          ORDER BY f.id DESC";

$result = mysqli_query($conn, $query);
$list = [];

while ($row = mysqli_fetch_assoc($result)) {
    $list[] = $row;
}

echo json_encode($list);
mysqli_close($conn);
?>