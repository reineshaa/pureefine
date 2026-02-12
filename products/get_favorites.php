<?php
header('Content-Type: application/json');
include '../config/config.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

$query = "SELECT p.*, 1 as is_liked 
          FROM products p
          INNER JOIN favorites f ON p.id = f.product_id
          WHERE f.user_id = '$user_id'";

$result = mysqli_query($conn, $query);

if ($result) {
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {    
        $row['is_liked'] = (int)$row['is_liked'];
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal mengambil favorit"]);
}
?>