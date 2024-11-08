<?php
header('Content-Type: application/json');
include('../config.php');

$recordId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $con->prepare('SELECT * FROM engmaterialreceiveddetails WHERE engMaterialRecivedId = ?');
$stmt->bind_param('i', $recordId);
$stmt->execute();
$result = $stmt->get_result();
$details = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($details);
$stmt->close();
$con->close();
?>
