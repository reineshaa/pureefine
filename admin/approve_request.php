<?php
include '../config/config.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['id'];

    $getUser = mysqli_query($conn, "SELECT user_id FROM product_requests WHERE id = '$request_id'");
    $userData = mysqli_fetch_assoc($getUser);

    if ($userData) {
        $user_id = $userData['user_id'];
        
        $sql_update = "UPDATE product_requests SET status = 'approved' WHERE id = '$request_id'";
        
        if (mysqli_query($conn, $sql_update)) {
            $title = "Request Approved!";
            $message = "Your requested product is available now. Check it out!";
            $status = "approved";

            $sql_notif = "INSERT INTO notifications (user_id, title, message, status) 
                          VALUES ('$user_id', '$title', '$message', '$status')";
            
            mysqli_query($conn, $sql_notif);

            $response['status'] = "success";
            $response['message'] = "Request approved and notification sent.";
        } else {
            $response['status'] = "error";
            $response['message'] = "Failed to approve request.";
        }
    } else {
        $response['status'] = "error";
        $response['message'] = "Request ID not found.";
    }
} else {
    $response['status'] = "error";
    $response['message'] = "Invalid Request Method.";
}

echo json_encode($response);
?>