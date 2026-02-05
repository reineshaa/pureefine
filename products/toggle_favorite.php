<?php
include '../config/config.php';

$user_id = $_POST['user_id'] ?? '';
$product_id = $_POST['product_id'] ?? '';

if (empty($user_id) || empty($product_id)) {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
    exit();
}

$check_query = "SELECT id FROM favorites WHERE user_id = '$user_id' AND product_id = '$product_id'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) > 0) {
    $delete_query = "DELETE FROM favorites WHERE user_id = '$user_id' AND product_id = '$product_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo json_encode([
            "status" => "success",
            "action" => "unliked",
            "message" => "Dihapus dari favorit"
        ]);
    }
} else {
    $insert_query = "INSERT INTO favorites (user_id, product_id) VALUES ('$user_id', '$product_id')";
    if (mysqli_query($conn, $insert_query)) {
        echo json_encode([
            "status" => "success",
            "action" => "liked",
            "message" => "Berhasil ditambah ke favorit"
        ]);
    }
}

mysqli_close($conn);
?>