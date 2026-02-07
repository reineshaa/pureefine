<?php

header('Content-Type: application/json'); // Wajib ada agar Retrofit tidak bingung
include '../config/config.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$query = "SELECT * FROM users WHERE username = '$user'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Sesuaikan: apakah password kamu di DB di-hash atau teks biasa?
    if ($pass == $row['password']) {
        echo json_encode([
            "status" => "success",
            "message" => "Login Berhasil"
        ]);
    } else {
        // HTTP 200 tapi status JSON-nya error
        echo json_encode([
            "status" => "error",
            "message" => "Password Salah!" 
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Username Tidak Ditemukan!"
    ]);
}
?>