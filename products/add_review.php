<?php
include '../config/config.php';

$user_id = $_POST['user_id'] ?? '';
$product_id = $_POST['product_id'] ?? '';
$rating = $_POST['rating'] ?? ''; 
$comment = $_POST['comment'] ?? '';

if (empty($user_id) || empty($product_id) || empty($rating)) {
    echo json_encode(["status" => "error", "message" => "Rating dan User ID wajib diisi"]);
    exit();
}

$query = "INSERT INTO reviews (user_id, product_id, rating, comment) 
          VALUES ('$user_id', '$product_id', '$rating', '$comment')";

if (mysqli_query($conn, $query)) {
    echo json_encode(["status" => "success", "message" => "Review berhasil ditambahkan!"]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}

mysqli_close($conn);
?>