<?php
include '../config/config.php';

$brand_name   = $_POST['brand_name'] ?? '';
$product_name = $_POST['product_name'] ?? '';
$category     = $_POST['category'] ?? '';
$description  = $_POST['description'] ?? '';
$image_raw    = $_POST['image_base64'] ?? '';

if (empty($brand_name) || empty($product_name) || empty($image_raw)) {
    echo json_encode(["status" => "error", "message" => "Semua data termasuk gambar wajib diisi!"]);
    exit();
}

$file_name = "prod_" . time() . ".jpg";
$file_path = "../images/products/" . $file_name;

if (file_put_contents($file_path, base64_decode($image_raw))) {
    
    $query = "INSERT INTO products (brand_name, product_name, category, description, image) 
              VALUES ('$brand_name', '$product_name', '$category', '$description', '$file_name')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Produk berhasil ditambahkan!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal simpan ke database: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Gagal upload gambar ke server"]);
}

mysqli_close($conn);
?>