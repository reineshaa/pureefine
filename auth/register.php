<?php
include '../config/config.php';

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$checkUser = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $checkUser);

if (mysqli_num_rows($result) > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Username invalid, already taken!"
    ]);
} else {
    $query = "INSERT INTO users (full_name, username, email, password, role) 
              VALUES ('$name', '$username', '$email', '$password', 'user')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Account created"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Registration failed"]);
    }
}
?>