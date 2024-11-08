<?php

require_once 'core.php';

$sql = "SELECT a.id, a.mis_id, a.atmid, a.engineer, a.ticketId, a.created_at, a.status, 
GROUP_CONCAT(
        CONCAT(
            UPPER(SUBSTRING(b.MaterialName, 1, 1)), 
            LCASE(SUBSTRING(b.MaterialName, 2))
        ) 
        ORDER BY b.MaterialName 
        SEPARATOR ', '
    ) AS MaterialNames,
    u.name,
    md.ticket_id,
    a.materialStatus
FROM generatefaultymaterialrequest a 
INNER JOIN generatefaultymaterialrequestdetails b ON a.id = b.requestId 
INNER JOIN mis_details md ON md.mis_id = a.mis_id 
INNER JOIN user u ON a.engineer = u.userid
WHERE a.status = 1 
GROUP BY a.id, a.mis_id, a.atmid, a.engineer, a.ticketId, a.created_at, a.status 
ORDER BY a.id DESC
" ;

$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    $serialNumber = 1; // Initialize serial number counter

    while ($row = $result->fetch_array()) {
        $id = $row['id'];
        $misid = $row['mis_id'];
        $atmid = $row['atmid'];
        $engineerId = $row['engineer'];
        $engineerName = $row['name'];
        $created_at = $row['created_at'];
        $MaterialNames = $row['MaterialNames'];
        $ticket_id = $row['ticket_id'];
        $materialStatus = $row['materialStatus'];

        // Define color labels based on materialStatus
        switch ($materialStatus) {
            case 'Pending':
                $statusLabel = "<label style='background-color: #f0ad4e; color: white; padding: 2px 5px; border-radius: 3px;'>Pending</label>";
                $button = '<a href="./processMaterialRequest.php?id='.$id.'&misId='.$misid.'" class="graybtn">Send Material</a>';
                break;
            case 'Dispatch':
                $statusLabel = "<label style='background-color: #5bc0de; color: white; padding: 2px 5px; border-radius: 3px;'>Dispatch</label>";
                $button = '<a href="./processMaterialRequest.php?id='.$id.'&misId='.$misid.'" class="graybtn">View</a>';
                break;
            case 'Delivered':
                $statusLabel = "<label style='background-color: #5cb85c; color: white; padding: 2px 5px; border-radius: 3px;'>Delivered</label>";
                $button = '<a href="./processMaterialRequest.php?id='.$id.'&misId='.$misid.'" class="graybtn">View</a>';
                break;
            case 'In-Transit':
                $statusLabel = "<label style='background-color: #0275d8; color: white; padding: 2px 5px; border-radius: 3px;'>In-Transit</label>";
                $button = '<a href="./processMaterialRequest.php?id='.$id.'&misId='.$misid.'" class="graybtn">View</a>';
                break;
            case 'Deleted':
                $statusLabel = "<label style='background-color: #d9534f; color: white; padding: 2px 5px; border-radius: 3px;'>Deleted</label>";
                $button = '<a href="./processMaterialRequest.php?id='.$id.'&misId='.$misid.'" class="graybtn">View</a>';
                break;
            default:
                $statusLabel = "<label style='background-color: #cccccc; color: black; padding: 2px 5px; border-radius: 3px;'>Unknown</label>";
                $button = '<a href="./processMaterialRequest.php?id='.$id.'&misId='.$misid.'" class="graybtn">View</a>';
                break;
        }


        $output['data'][] = array(
            $serialNumber, // Serial number in the first column
            $atmid,
            $MaterialNames,
            $engineerName,
            $created_at,
            $ticket_id,
            $statusLabel, // Material status as a colored label
            $button // Send Material button
        );

        $serialNumber++; // Increment serial number
    } // /while 
} // if num_rows

$connect->close();

echo json_encode($output);

?>
