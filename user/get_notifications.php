<?php
include '../config/config.php';

$user_id = $_GET['user_id'] ?? ''; 

if (!empty($user_id)) {
    $sql = "SELECT * FROM notifications 
            WHERE user_id = '$user_id' 
            ORDER BY created_at DESC";
            
    $query = mysqli_query($conn, $sql);
    $result = array();
    
    while($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    echo json_encode($result);
} else {
    echo json_encode([]);
}
?>