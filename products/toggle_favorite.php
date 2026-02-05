<?php
include '../config/config.php';

$user_id = $_POST['user_id'] ?? '';
$product_id = $_POST['product_id'] ?? '';

$check = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id = '$user_id' AND product_id = '$product_id'");

if (mysqli_num_rows($check) > 0) {

    mysqli_query($conn, "DELETE FROM favorites WHERE user_id = '$user_id' AND product_id = '$product_id'");
    echo json_encode(["status" => "unfavorited"]);
} else {
    
    mysqli_query($conn, "INSERT INTO favorites (user_id, product_id) VALUES ('$user_id', '$product_id')");
    echo json_encode(["status" => "favorited"]);
}

mysqli_close($conn);
?>