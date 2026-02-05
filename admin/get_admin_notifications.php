<?php
include '../config/config.php';

$query = "SELECT n.*, u.profile_image 
          FROM notifications n 
          JOIN users u ON n.sender_username = u.username 
          WHERE n.title LIKE '%Request%' 
          ORDER BY n.created_at DESC";

$result = mysqli_query($conn, $query);
$notifs = [];

while ($row = mysqli_fetch_assoc($result)) {
    $notifs[] = $row;
}

echo json_encode($notifs);
mysqli_close($conn);
?>