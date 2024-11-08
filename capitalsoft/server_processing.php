<?php
include('config.php');

// Define initial SQL query
$sql = "SELECT serviceExecutive, id, engineer_user_id, activity, customer, bank, atmid, trackerno, address, city, state, zone, branch, bm_name, bm_number, status, pincode, live_date FROM mis_newsite WHERE 1";

// Check if form submitted
if(isset($_POST['submit'])) {
    // Additional filters based on status
    if($_POST['status'] == "1") {
        $sql .= " AND (engineer_user_id='' OR engineer_user_id IS NULL)";
    } elseif($_POST['status'] == "") {
        // Do nothing, select all records
    } else {
        $sql .= " AND engineer_user_id!=''";
    }

    // Additional filters based on atmid
    if(isset($_POST['atmid']) && $_POST['atmid'] != '') {
        $atmid = implode("','", $_POST['atmid']);
        $sql .= " AND atmid IN ('$atmid')";
    }

    // Additional filters based on other criteria like customer, zone, state, bm, engineer, site_status
    if(isset($_POST['cust']) && $_POST['cust'] != '') {
        $sql .= " AND customer = '".$_POST['cust']."'";
    }

    if(isset($_POST['zone']) && $_POST['zone'] != '') {
        $sql .= " AND zone = '".$_POST['zone']."'";
    }

    // Add other filters similarly...
}

// Perform SQL query with pagination
$result = $con->query($sql);
$totalData = $result->num_rows;

$sql .= " LIMIT " . $_REQUEST['start'] . ", " . $_REQUEST['length'];
$result = $con->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nestedData = array();
        $nestedData[] = $row["customer"];
        $nestedData[] = $row["bank"];
        $nestedData[] = $row["atmid"];
        // Add other columns similarly...
        $data[] = $nestedData;
    }
}

// JSON data output
$json_data = array(
    "draw" => intval($_REQUEST['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
);

echo json_encode($json_data);
?>
