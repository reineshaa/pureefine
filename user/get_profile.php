<?php
include '../config/config.php';

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([
        "status" => "error", 
        "message" => "User ID tidak ditemukan"
    ]);
    exit();
}

$query = "SELECT full_name, email, username, role, profile_image FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    
    $user['profile_image_url'] = "http://192.168.1.xx/pureefine_api/images/profiles/" . $user['profile_image'];

    echo json_encode([
        "status" => "success",
        "data" => $user
    ]);
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "User tidak ditemukan"
    ]);
}

mysqli_close($conn);
?>