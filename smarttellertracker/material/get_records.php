<?php
header('Content-Type: application/json');

include('../config.php');


$result = $con->query('SELECT * FROM engmaterialreceived');
$records = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($records);
$con->close();
?>
