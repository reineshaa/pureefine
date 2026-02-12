<?php
header('Content-Type: application/json');
include '../config/config.php';

$request_id = $_GET['request_id'] ?? '';

if (!empty($request_id)) {
    $sql = "SELECT r.*, u.full_name, u.username, u.email 
            FROM requests r 
            INNER JOIN users u ON r.user_id = u.id 
            WHERE r.id = '$request_id' 
            LIMIT 1";

    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode(["status" => "error", "message" => "Data request tidak ditemukan"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ID Request tidak dikirim"]);
}
?>