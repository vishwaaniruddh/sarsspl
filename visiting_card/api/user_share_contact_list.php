<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'].'/visiting_card/config/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); 

$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');

$data = json_decode(file_get_contents("php://input"), true);

$response = array();

$visiting_card_id = $data['visiting_card_id'];
$user_id = $data['user_id'];
$mobile = $data['mobile_no'];

$contact_no_array = array_map('intval', $mobile); // Sanitize contact numbers
$contact_numbers = implode(',', $contact_no_array); // Convert to comma-separated string

if ($contact_numbers) {
    // Fetch available contacts
    $checkuser = mysqli_query($con, "SELECT mobile_no, id FROM users WHERE mobile_no IN ($contact_numbers)");
    
    $available_user_ids = [];
    $available_mobile_numbers = [];

    while ($checkuser_result = mysqli_fetch_assoc($checkuser)) {
        $available_user_ids[] = $checkuser_result['id'];
        $available_mobile_numbers[] = $checkuser_result['mobile_no'];
    }
    
    // Calculate unavailable contacts
    $unavailable_mobile_numbers = array_diff($contact_no_array, $available_mobile_numbers);

    if (!empty($available_user_ids)) {
        // Store available and unavailable contacts in response
        $response['available_user_ids'] = $available_user_ids;
        $response['unavailable_contact_numbers'] = array_values($unavailable_mobile_numbers);

        // Messages for available and unavailable contacts
        $response['success_msg'] = "Users found and processed successfully.";
        if (!empty($unavailable_mobile_numbers)) {
            $response['unavailable_msg'] = "Some contacts are unavailable. Please share manually.";
            $response['Code'] = 201; // Code 201 if only some contacts are available
        } else {
            $response['Code'] = 200; // Code 200 if all contacts are available
        }

        // Check if user data exists and update or insert
        $checkdataexist = mysqli_query($con, "SELECT share_contact_user_id FROM user_share_contact_list WHERE user_id = '$user_id'");
        
        if (mysqli_num_rows($checkdataexist) > 0) {
            // Update if data exists
            $existing_data = mysqli_fetch_assoc($checkdataexist);
            $existing_share_contact_ids = explode(',', $existing_data['share_contact_user_id']);
            $updated_share_user_ids = array_unique(array_merge($existing_share_contact_ids, $available_user_ids));
            $updated_share_user_ids_str = implode(',', $updated_share_user_ids);

            $update_sql = mysqli_query($con, "UPDATE user_share_contact_list 
                                              SET share_contact_user_id = '$updated_share_user_ids_str', updated_at = '$datetime' 
                                              WHERE user_id = '$user_id'");
            
            if ($update_sql) {
                $response['msg'] = "Data updated successfully";
            } else {
                $response['Code'] = 405;
                $response['msg'] = "Error: Unable to update the data.";
            }

        } else {
            // Insert if no data exists
            $available_user_ids_str = implode(',', $available_user_ids);
            
            $insertsql = mysqli_query($con, "INSERT INTO user_share_contact_list (user_id, share_contact_user_id, visiting_card_id, created_at) 
                                             VALUES ('$user_id', '$available_user_ids_str', '$visiting_card_id', '$datetime')");
            
            if ($insertsql) {
                $response['msg'] = "Data inserted successfully";
            } else {
                $response['Code'] = 405;
                $response['msg'] = "Error: Unable to insert the data.";
            }
        }
        
    } else {
        // Message if no contacts are available
        $response['Code'] = 502;
        $response['unavailable_msg'] = "No registered contacts found. Please share manually!";
        $response['unavailable_contact_numbers'] = array_values($unavailable_mobile_numbers);
    }

} else {
    $response['Code'] = 501;
    $response['msg'] = "No contact numbers received.";
}

echo json_encode($response);


?>
