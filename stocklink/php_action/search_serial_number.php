<?php require_once 'core.php';

$searchValue = $_GET['value'];
$material = $_GET['material'];

$sql = "SELECT serialNumber FROM stocklink_inventory WHERE serialNumber LIKE '%$searchValue%' AND product_name like '%$material%' AND activityStatus = 'Active'";

$stmt = $con->prepare($sql);
$stmt->execute();

$stmt->bind_result($serialNumber);
$serialNumbers = array();

while ($stmt->fetch()) {
    $serialNumbers[] = $serialNumber;
}

$stmt->close();
$con->close();

header('Content-Type: application/json');
echo json_encode($serialNumbers);