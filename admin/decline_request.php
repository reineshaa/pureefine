<?php
include '../config/config.php';

$request_id = $_POST['request_id'] ?? '';
$reason = $_POST['reason'] ?? 'Produk tidak sesuai kriteria.';

if (empty($request_id)) {
    echo json_encode(["status" => "error", "message" => "ID Request tidak ada"]);
    exit();
}

$req_info = mysqli_query($conn, "SELECT user_id, brand_name FROM product_requests WHERE id = '$request_id'");
$data = mysqli_fetch_assoc($req_info);

if ($data) {
    $user_id = $data['user_id'];
    $brand = $data['brand_name'];

    mysqli_query($conn, "UPDATE product_requests SET status = 'declined' WHERE id = '$request_id'");

    $msg = "Sorry, your request for $brand was declined. Reason: $reason";
    mysqli_query($conn, "INSERT INTO notifications (user_id, title, message) 
                        VALUES ('$user_id', 'Request Declined', '$msg')");

    echo json_encode(["status" => "success", "message" => "Request declined."]);
}

mysqli_close($conn);
?>