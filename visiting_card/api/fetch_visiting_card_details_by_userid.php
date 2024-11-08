<?php
include($_SERVER['DOCUMENT_ROOT'].'/visiting_card/config/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); // Set the response to JSON

// Initialize the response array
$response = array();

$data = $_POST;
$id = isset($data['user_id']) ? $data['user_id'] : '';

if ($id) {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($con, $id);

    $sql = "SELECT * FROM visiting_card_details WHERE user_id = '$id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // $result_data = mysqli_fetch_assoc($result);
        // $name = $result_data['first_name'].' '.$result_data['last_name'];
        $response['Code'] = 200;
        $response['msg'] = "Data fetched successfully";
        // $response['description'] = "Hey It's ".$name.". Check this Visiting Card App";
        $response['data'] = array(); 
        
        // Fetch data
        while($row = mysqli_fetch_assoc($result)) {
            $name = $row['first_name'].' '.$row['last_name'];
            $row['description'] = "Hey It's ".$name.". Check this Visiting Card";
            $response['data'][] = $row;
            
        }
    } else {
        $response['Code'] = 404;
        $response['msg'] = "No data found";
    }
} else {
    // Handle missing 'user_id'
    $response['Code'] = 400;
    $response['msg'] = "Missing user_id parameter";
}

// Close the database connection
mysqli_close($con);

// Return the response in JSON format
echo json_encode($response);

?>
