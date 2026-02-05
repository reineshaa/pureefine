<?php
include '../config/config.php';

$query = "SELECT pr.*, u.username, u.profile_image 
          FROM product_requests pr 
          JOIN users u ON pr.user_id = u.id 
          WHERE pr.status = 'pending' 
          ORDER BY pr.created_at DESC";

$result = mysqli_query($conn, $query);
$requests = [];

while ($row = mysqli_fetch_assoc($result)) {
    $requests[] = $row;
}

echo json_encode($requests);
mysqli_close($conn);
?>