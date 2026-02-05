<?php
include '../config/config.php';

$user_id = $_GET['user_id'] ?? '';
$product_id = $_GET['product_id'] ?? '';

$query = "SELECT * FROM favorites WHERE user_id = '$user_id' AND product_id = '$product_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(["is_favorite" => true]);
} else {
    echo json_encode(["is_favorite" => false]);
}

mysqli_close($conn);
?>