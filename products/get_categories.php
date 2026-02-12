<?php
ob_clean();
header('Content-Type: application/json');
include '../config/config.php';

$query = "SELECT DISTINCT category FROM products WHERE category IS NOT NULL";
$result = mysqli_query($conn, $query);

$categories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $name = strtolower(trim($row['category']));
    
    if ($name == "cleanser") {
        $icon = "cleanser.png";
    } else if ($name == "moisturizer") {
        $icon = "moisturizer.png"; 
    } else if ($name == "mask") {
        $icon = "mask.png"; 
    } else if ($name == "toner") {
        $icon = "toner.png"; 
    } else if ($name == "serum") {
        $icon = "serum.png";
    } else if ($name == "sunscreen") {
        $icon = "sunscreen.png"; 
    } else if ($name == "lippies") {
        $icon = "lippies.png"; 
    } else {
        $icon = "product1.png"; 
    }
    
    $categories[] = array(
        "id" => "0",
        "category_name" => ucfirst($name), 
        "image" => $icon
    );
}

echo json_encode($categories);
?>