<?php
include '../config/config.php';

$keyword = $_GET['keyword'] ?? '';

$query = "SELECT * FROM products 
          WHERE brand_name LIKE '%$keyword%' 
          OR product_name LIKE '%$keyword%' 
          ORDER BY brand_name ASC";

$result = mysqli_query($conn, $query);
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode($products);
mysqli_close($conn);
?>