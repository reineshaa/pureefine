<?php
header('Content-Type: application/json'); 
include '../config/config.php';

$user = isset($_POST['username']) ? $_POST['username'] : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($user) || empty($pass)) {
    echo json_encode([
        "status" => "error",
        "message" => "Username dan Password harus diisi!"
    ]);
    exit;
}

$query = "SELECT * FROM users WHERE username = '$user'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    if ($pass == $row['password']) {
        echo json_encode([
            "status" => "success",
            "message" => "Login Berhasil",
            "user" => [
                "id" => (int)$row['id'],
                "full_name" => $row['full_name'],
                "username" => $row['username'],
                "role" => $row['role']
            ]
        ]);
    } else {
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