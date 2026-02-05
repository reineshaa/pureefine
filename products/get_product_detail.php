<?php
include '../config/config.php';

$product_id = $_GET['product_id'] ?? '';

if (empty($product_id)) {
    echo json_encode(["status" => "error", "message" => "Product ID tidak ada"]);
    exit();
}

$product_query = "SELECT * FROM products WHERE id = '$product_id'";
$product_res = mysqli_query($conn, $product_query);
$product = mysqli_fetch_assoc($product_res);

if ($product) {
    $review_query = "SELECT r.*, u.username FROM reviews r 
                     JOIN users u ON r.user_id = u.id 
                     WHERE r.product_id = '$product_id' 
                     ORDER BY r.created_at DESC";
    $review_res = mysqli_query($conn, $review_query);
    
    $reviews = [];
    while ($row = mysqli_fetch_assoc($review_res)) {
        $reviews[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "product" => $product,
        "reviews" => $reviews
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Produk tidak ditemukan"]);
}

mysqli_close($conn);
?>