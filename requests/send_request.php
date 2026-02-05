<?php
include '../config/config.php';

$user_id = $_POST['user_id'] ?? '';
$brand = $_POST['brand_name'] ?? '';
$category = $_POST['category'] ?? '';
$detail = $_POST['detail_product'] ?? '';
$review = $_POST['honest_review'] ?? '';
$username_pengirim = $_POST['username'] ?? ''; 

if (empty($user_id) || empty($brand)) {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
    exit();
}

$query = "INSERT INTO product_requests (user_id, brand_name, category, detail_product, honest_review) 
          VALUES ('$user_id', '$brand', '$category', '$detail', '$review')";

if (mysqli_query($conn, $query)) {
    $query_admin = "SELECT id FROM users WHERE role = 'admin' LIMIT 1";
    $res_admin = mysqli_query($conn, $query_admin);
    $admin = mysqli_fetch_assoc($res_admin);
    
    if ($admin) {
        $admin_id = $admin['id'];
        $title = "Request Product";
        $msg = "New product request for $brand";
        
        $query_notif = "INSERT INTO notifications (user_id, sender_username, title, message) 
                        VALUES ('$admin_id', '$username_pengirim', '$title', '$msg')";
        mysqli_query($conn, $query_notif);
    }

    echo json_encode(["status" => "success", "message" => "Request berhasil dikirim"]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}

mysqli_close($conn);
?>