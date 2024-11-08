<?php
include('../config.php');

// Fetch data from `engmaterialreceived`
$sql = "SELECT * FROM engmaterialreceived";
$result = $con->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Fetch details for each record
        $detailsSql = "SELECT * FROM engmaterialreceiveddetails WHERE engMaterialRecivedId = " . $row['id'];
        $detailsResult = $con->query($detailsSql);
        $details = [];

        if ($detailsResult->num_rows > 0) {
            while ($detail = $detailsResult->fetch_assoc()) {
                $details[] = $detail;
            }
        }

        $row['materials'] = $details; // Add details to the main record
        $data[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($data);

$con->close();
