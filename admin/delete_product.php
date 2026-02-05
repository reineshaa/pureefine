<?php
include '../config/config.php';

$product_id = $_POST['product_id'] ?? '';

if (empty($product_id)) {
    echo json_encode(["status" => "error", "message" => "ID Produk tidak valid"]);
    exit();
}

$sql_get = "SELECT image FROM products WHERE id = '$product_id'";
$result = mysqli_query($conn, $sql_get);
$data = mysqli_fetch_assoc($result);

if ($data) {
    $nama_file = $data['image'];
    $path_file = "../images/products/" . $nama_file;

    $sql_delete = "DELETE FROM products WHERE id = '$product_id'";
    
    if (mysqli_query($conn, $sql_delete)) {
        if (file_exists($path_file) && $nama_file != "default.png") {
            unlink($path_file);
        }

        echo json_encode([
            "status" => "success",
            "message" => "Produk berhasil dihapus!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menghapus data: " . mysqli_error($conn)
        ]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Produk tidak ditemukan"]);
}

mysqli_close($conn);
?>