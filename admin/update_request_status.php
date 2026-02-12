<?php
include '../config/config.php';

$id_request = $_POST['id_request'] ?? '';
$status = $_POST['status'] ?? '';

if ($id_request && $status) {
    $get_req = mysqli_query($conn, "SELECT * FROM requests WHERE id = '$id_request'");
    $req_data = mysqli_fetch_assoc($get_req);
    
    if ($req_data) {
        $user_id_pemilik_request = $req_data['user_id'];
        $product_name = $req_data['brand_name'];

        $update = mysqli_query($conn, "UPDATE requests SET status = '$status' WHERE id = '$id_request'");

        if ($update) {
            $clean_status = ($status == 'log_approved') ? "approved" : "declined";

            $msg_user = "Your request for $product_name has been $clean_status!";
            mysqli_query($conn, "INSERT INTO notifications (user_id, title, message, status, created_at) 
                                VALUES ('$user_id_pemilik_request', 'Request Update', '$msg_user', 'unread', NOW())");

            $admin_query = mysqli_query($conn, "SELECT id FROM users WHERE role = 'admin' LIMIT 1");
            $admin_data = mysqli_fetch_assoc($admin_query);
            $real_admin_id = $admin_data['id'];

            $title_admin = "Request " . ucfirst($clean_status);
            $msg_admin = "You have $clean_status request for $product_name"; 
            
            mysqli_query($conn, "INSERT INTO notifications (user_id, title, message, status, created_at) 
                                VALUES ('$real_admin_id', '$title_admin', '$msg_admin', 'read', NOW())"); 

            mysqli_query($conn, "DELETE FROM notifications WHERE message LIKE '%(ID $id_request)%' AND title = 'Requested product!'");

            echo json_encode(["status" => "success"]);
        }
    }
}
?>