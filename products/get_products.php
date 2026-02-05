<?php
include '../config/config.php';

$category = $_GET['category'] ?? '';

if (!empty($category)) {
    $query = "SELECT * FROM products WHERE category = '$category' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM products ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode($products);
mysqli_close($conn);
?>