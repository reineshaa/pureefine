<?php
include 'config.php';

$request_id = $_GET['request_id'] ?? '';

$query = "SELECT pr.*, u.full_name, u.username, u.profile_image 
          FROM product_requests pr 
          JOIN users u ON pr.user_id = u.id 
          WHERE pr.id = '$request_id'";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if ($data) {
    echo json_encode(["status" => "success", "data" => $data]);
} else {
    echo json_encode(["status" => "error", "message" => "Detail tidak ditemukan"]);
}

mysqli_close($conn);
?>