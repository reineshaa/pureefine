<?php
header('Content-Type: application/json');
include '../config/config.php';

$cat = $_GET['category']; 

$query = "SELECT * FROM products WHERE category = '$cat'";
$result = mysqli_query($conn, $query);
$products = array();

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode($products);