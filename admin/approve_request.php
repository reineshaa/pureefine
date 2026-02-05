<?php
include '../config/config.php';

$request_id = $_POST['request_id'] ?? '';

$req_query = "SELECT * FROM product_requests WHERE id = '$request_id'";
$req_res = mysqli_query($conn, $req_query);
$data = mysqli_fetch_assoc($req_res);

if ($data) {
    $brand = $data['brand_name'];
    $product = $data['detail_product'];
    $category = $data['category'];
    $user_id = $data['user_id'];

    $insert_prod = "INSERT INTO products (brand_name, product_name, category) 
                    VALUES ('$brand', '$product', '$category')";
    
    if (mysqli_query($conn, $insert_prod)) {
        mysqli_query($conn, "UPDATE product_requests SET status = 'approved' WHERE id = '$request_id'");

        $msg = "Your request for $brand - $product has been approved and added to catalog!";
        mysqli_query($conn, "INSERT INTO notifications (user_id, title, message) 
                            VALUES ('$user_id', 'Request Approved', '$msg')");

        echo json_encode(["status" => "success", "message" => "Request Approved!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Request tidak ditemukan"]);
}

mysqli_close($conn);
?>