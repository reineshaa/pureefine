<?php
include '../config/config.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Kolom tidak boleh kosong"]);
    exit();
}

$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    
    if (password_verify($password, $user['password'])) {
        unset($user['password']);
        echo json_encode([
            "status" => "success",
            "message" => "Login Berhasil",
            "user" => $user
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Password salah"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Username tidak ditemukan"]);
}

mysqli_close($conn);
?>