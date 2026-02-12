<?php
header('Content-Type: application/json');
include '../config/config.php';

$user_id  = $_POST['user_id'] ?? null;
$username = $_POST['username'] ?? null;
$brand    = $_POST['brand_name'] ?? null;
$category = $_POST['category'] ?? null;
$detail   = $_POST['detail_product'] ?? null;

if ($user_id && $username && $brand && $category && $detail) {
    
    $queryRequest = "INSERT INTO requests (user_id, brand_name, category, detail_product, status) 
                     VALUES ('$user_id', '$brand', '$category', '$detail', 'pending')";
    
    if (mysqli_query($conn, $queryRequest)) {
        $requestId = mysqli_insert_id($conn);
        
        $title = "Requested product!";
        $message = "From @$username (ID $requestId)";
        mysqli_query($conn, "INSERT INTO notifications (user_id, title, message, status) 
                             VALUES (1, '$title', '$message', 'pending')");

        echo json_encode(["status" => "success", "message" => "Request sent successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
}
?>