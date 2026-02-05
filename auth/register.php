<?php
include '../config/config.php';

$full_name = $_POST['full_name'] ?? '';
$email     = $_POST['email'] ?? '';
$username  = $_POST['username'] ?? '';
$password  = $_POST['password'] ?? '';

if (empty($full_name) || empty($email) || empty($username) || empty($password)) {
    echo json_encode([
        "status" => "error",
        "message" => "Semua kolom harus diisi!"
    ]);
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (full_name, email, username, password, role) 
          VALUES ('$full_name', '$email', '$username', '$hashed_password', 'user')";

if (mysqli_query($conn, $query)) {
    echo json_encode([
        "status" => "success",
        "message" => "Registrasi berhasil! Silakan login."
    ]);
} else {
    if (mysqli_errno($conn) == 1062) {
        echo json_encode([
            "status" => "error",
            "message" => "Username atau Email sudah terdaftar!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Terjadi kesalahan: " . mysqli_error($conn)
        ]);
    }
}

mysqli_close($conn);
?>