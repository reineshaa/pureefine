<?php
include '../config/config.php';

$userId = $_POST['user_id'];
$productId = $_POST['product_id'];

$check = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id = '$userId' AND product_id = '$productId'");

if(mysqli_num_rows($check) == 0){
    $query = "INSERT INTO favorites (user_id, product_id) VALUES ('$userId', '$productId')";
    if(mysqli_query($conn, $query)){
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "already_exists"]);
}
?>