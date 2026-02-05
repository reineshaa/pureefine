<?php
include '../config/config.php';

$user_id   = $_POST['user_id'] ?? '';
$full_name = $_POST['full_name'] ?? '';
$username  = $_POST['username'] ?? '';
$email     = $_POST['email'] ?? '';
$image_raw = $_POST['image_base64'] ?? '';

if (empty($user_id)) {
    echo json_encode(["status" => "error", "message" => "User ID wajib diisi"]);
    exit();
}

if (!empty($image_raw)) {
    $file_name = "profile_" . $user_id . "_" . time() . ".jpg";
    $file_path = "../images/profiles/" . $file_name;
    
    file_put_contents($file_path, base64_decode($image_raw));
    
    $query = "UPDATE users SET 
                full_name = '$full_name', 
                username = '$username', 
                email = '$email', 
                profile_image = '$file_name' 
              WHERE id = '$user_id'";
} else {
    $query = "UPDATE users SET 
                full_name = '$full_name', 
                username = '$username', 
                email = '$email' 
              WHERE id = '$user_id'";
}

if (mysqli_query($conn, $query)) {
    echo json_encode([
        "status" => "success", 
        "message" => "Profile updated successfully!"
    ]);
} else {
    if (mysqli_errno($conn) == 1062) {
        echo json_encode([
            "status" => "error", 
            "message" => "Username atau Email sudah digunakan orang lain!"
        ]);
    } else {
        echo json_encode([
            "status" => "error", 
            "message" => "Database error: " . mysqli_error($conn)
        ]);
    }
}

mysqli_close($conn);
?>