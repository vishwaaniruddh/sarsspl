<?php
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve form data
$recordId = $_POST['recordId'];
$newDeliveryStatus = $_POST['newDeliveryStatus'];
$deliveryDate = $_POST['deliveryDate'];
$contactPerson = $_POST['contactperson'];
$deliveryRemarks = $_POST['deliveryRemarks'];

// Handling file upload
$uploadDir = '../uploads/';
$year = date('Y');
$month = date('m');
$uploadPath = $uploadDir . $year . '/' . $month . '/';

if (!is_dir($uploadPath)) {
    mkdir($uploadPath, 0777, true);
}

$deliveryChallanURL = '';
if (!empty($_FILES['proofOfDelivery']['tmp_name'])) {
    $tempFile = $_FILES['proofOfDelivery']['tmp_name'];
    $fileName = basename($_FILES['proofOfDelivery']['name']);
    $uploadFile = $uploadPath . $fileName;

    if (move_uploaded_file($tempFile, $uploadFile)) {
        $deliveryChallanURL = $uploadFile;
    }
}

// Store delivery info
$sql = "INSERT INTO delivery_updates (recordId, newDeliveryStatus, deliveryDate, contactPerson, deliveryRemarks, deliveryChallan) 
        VALUES ('$recordId', '$newDeliveryStatus', '$deliveryDate', '$contactPerson', '$deliveryRemarks', '$deliveryChallanURL')";
mysqli_query($con, $sql);

// Update engmaterialreceived
if ($newDeliveryStatus === 'Delivered') {
   echo  $sql = "UPDATE engmaterialreceived SET isDelivered = 'Delivered' WHERE id = $recordId";
    mysqli_query($con, $sql);

    // Update engmaterialreceiveddetails
    $sql = "UPDATE engmaterialreceiveddetails SET materialStatus = 'Delivered' WHERE engMaterialRecivedId = $recordId";
    mysqli_query($con, $sql);

    // Update material_send
    $sql = "UPDATE material_send SET isDelivered = 'Delivered' WHERE id = (SELECT materialSendId FROM engmaterialreceived WHERE id = $recordId)";
    mysqli_query($con, $sql);

    // Update material_send_details
    $sql = "UPDATE material_send_details SET materialStatus = 'Delivered' WHERE materialSendId = (SELECT materialSendId FROM engmaterialreceived WHERE id = $recordId)";
    mysqli_query($con, $sql);


    $statement = "SELECT * from  material_send WHERE id = (SELECT materialSendId FROM engmaterialreceived WHERE id = $recordId)";
    $sqlQuery = mysqli_query($con,$statement);
    $sqlQueryResult = mysqli_fetch_assoc($sqlQuery);

    $requestId = $sqlQueryResult['requestId'];


    $sql = "UPDATE generatefaultymaterialrequest SET materialStatus = 'Delivered' WHERE id ='".$requestId."'";
    mysqli_query($con, $sql);

    
    $sql = "UPDATE generatefaultymaterialrequestdetails SET materialStatus = 'Delivered' WHERE requestId ='".$requestId."'";
    mysqli_query($con, $sql);

    


}

mysqli_close($con);

echo json_encode(['success' => true]);
?>
