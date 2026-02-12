<?php
header('Content-Type: application/json');
include '../config/config.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

$query = "SELECT *, 
          (SELECT COUNT(*) FROM favorites WHERE favorites.product_id = products.id AND favorites.user_id = '$user_id') as is_liked 
          FROM products";

$result = mysqli_query($conn, $query);

if ($result) {
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $row['is_liked'] = (int)$row['is_liked'];
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal mengambil data produk"
    ]);
}
?>