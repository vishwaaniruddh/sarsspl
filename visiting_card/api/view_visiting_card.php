<?php 
include($_SERVER['DOCUMENT_ROOT'].'/visiting_card/config/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); // Set the response to JSON

// Initialize the response array
$response = array();



// SQL query to fetch data from the database
$sql = "SELECT * FROM visiting_card_details";

// Execute the query
$result = mysqli_query($con, $sql);

// Check if there are rows returned
if (mysqli_num_rows($result) > 0) {
    $response['Code'] = 200;
    $response['msg'] = "Data fetched successfully";
    $response['data'] = array(); // Initialize the data array

    // Fetch the data and store it in the response array
    while($row = mysqli_fetch_assoc($result)) {
        $response['data'][] = $row;
    }
} else {
    // If no data is found
    $response['Code'] = 404;
    $response['msg'] = "No data found";
}

// Close the database connection
mysqli_close($con);

// Return the JSON-encoded response
echo json_encode($response);

?>
