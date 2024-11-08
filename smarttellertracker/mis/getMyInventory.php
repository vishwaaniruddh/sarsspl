<?php
include('../config.php');

// Fetch data from the `engmaterialreceived` table
$sql = "SELECT * FROM engmaterialreceived";
$result = $con->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Fetch details for each record
        $detailsSql = "SELECT * FROM engmaterialreceiveddetails WHERE engMaterialRecivedId = " . $row['id'];
        $detailsResult = $con->query($detailsSql);

        if ($detailsResult->num_rows > 0) {
            while ($detail = $detailsResult->fetch_assoc()) {
                $data[] = array_merge($row, $detail); // Merge main record with details
            }
        } else {
            // Handle case where there are no details
            $data[] = $row;
        }
    }
}

header('Content-Type: application/json');
echo json_encode($data);

$con->close();
?>
