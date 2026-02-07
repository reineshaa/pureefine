<?php
header('Content-Type: application/json'); 
include '../config/config.php'; 

if(isset($_POST['username'])) {
    $email = $_POST['email'];
    $name  = $_POST['full_name'];
    $user  = $_POST['username'];
    $pass  = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$user'");
    
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(["status" => "error", "message" => "Username sudah terdaftar!"]);
    } else {
        $query = "INSERT INTO users (email, full_name, username, password, role) 
                  VALUES ('$email', '$name', '$user', '$pass', 'user')";
        
        if (mysqli_query($conn, $query)) {
            echo json_encode(["status" => "success", "message" => "Akun berhasil dibuat"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal simpan: " . mysqli_error($conn)]);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak diterima server"]);
}
?>