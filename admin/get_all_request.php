<?php
include '../config/config.php';
header('Content-Type: application/json');

$query = mysqli_query($conn, "SELECT requests.*, users.full_name, users.email, users.username 
                              FROM requests 
                              JOIN users ON requests.user_id = users.id 
                              WHERE requests.status = 'pending' 
                              ORDER BY requests.id DESC");

$result = array();

if ($query) {
    while($row = mysqli_fetch_assoc($query)){
        $result[] = $row;
    }
    echo json_encode($result);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
?>