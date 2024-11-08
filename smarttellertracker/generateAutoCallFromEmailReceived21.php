<?php include('config.php');

$atmid = $_REQUEST['atmid'];
$siteAddress = $_REQUEST['siteAddress'];
$city = $_REQUEST['city'];
$circle = $_REQUEST['circle'];
$linkVendor = $_REQUEST['linkVendor'];
$atmIP = $_REQUEST['atmIP'];
$message = $_REQUEST['message'];

$message = quoted_printable_decode($message);
$message = str_replace('<br>', '', $message);

$logFile = './APILog.log';
$logData = [
    'atmid' => $atmid,
    'siteAddress' => $siteAddress,
    'city' => $city,
    'circle' => $circle,
    'linkVendor' => $linkVendor,
    'atmIP' => $atmIP,
    'message' => $message,
];

file_put_contents($logFile, "Request: " . json_encode($logData) . PHP_EOL, FILE_APPEND);

$response = [];

if ($atmid) {
    $sql = mysqli_query($con, "select * from sites where atmid='" . trim($atmid) . "'");
    if ($sql_result = mysqli_fetch_assoc($sql)) {
        // Your existing code for processing the data
        // ...

        // Simulate a response
        $response = [
            'status' => 'success',
            'message' => 'Processed successfully',
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'ATM ID not found',
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'No ATM ID provided',
    ];
}

file_put_contents($logFile, "Response: " . json_encode($response) . PHP_EOL, FILE_APPEND);
echo json_encode($response);
?>
