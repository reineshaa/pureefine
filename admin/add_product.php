<?php
header('Content-Type: application/json');
include '../config/config.php';

$brand_name = $_POST['brand_name'] ?? '';
$product_name = $_POST['product_name'] ?? '';
$category = $_POST['category'] ?? '';
$description = $_POST['description'] ?? '';

$target_dir = "../images/";
$file_name = time() . "_" . basename($_FILES["image"]["name"]);
$target_file = $target_dir . $file_name;

if (!empty($brand_name) && !empty($product_name) && isset($_FILES["image"])) {
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        
        $queryProduct = "INSERT INTO products (brand_name, product_name, category, description, image) 
                         VALUES ('$brand_name', '$product_name', '$category', '$description', '$file_name')";
        
        if (mysqli_query($conn, $queryProduct)) {
            
            $users = mysqli_query($conn, "SELECT id FROM users WHERE role = 'user'");
            
            $titleNotif = "New Product Available!";
            $messageNotif = "Check out our new product: $product_name from $brand_name. Explore now!";

            while ($user = mysqli_fetch_assoc($users)) {
                $userId = $user['id'];
                mysqli_query($conn, "INSERT INTO notifications (user_id, title, message, status) 
                                     VALUES ('$userId', '$titleNotif', '$messageNotif', 'unread')");
            }

            echo json_encode([
                "status" => "success", 
                "message" => "Product added and notifications sent to all users"
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to save product to database"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to upload image"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Incomplete data"]);
}
?>