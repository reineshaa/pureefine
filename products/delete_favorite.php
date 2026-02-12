<?php
include '../config/config.php';

$userId = $_POST['user_id'];
$productId = $_POST['product_id'];

$query = "DELETE FROM favorites WHERE user_id = '$userId' AND product_id = '$productId'";

if(mysqli_query($conn, $query)){
    echo json_encode(["status" => "success", "message" => "Berhasil dihapus"]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>