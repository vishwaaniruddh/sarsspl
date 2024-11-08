<?php
include 'config.php';

// Fetch DataTables request parameters
$draw = $_GET['draw'];
$start = $_GET['start'];
$length = $_GET['length'];
$searchValue = $_GET['search']['value'];

// Define query
$query = "SELECT d.id, d.indoor_reg_no, p.name, CONCAT(p.age, '/', p.sex) AS age_gender, p.mobile, p.city, p.address, d.dept1, d.payment,CONCAT(d.add_date, ' ', d.add_time) AS add_date_time, CONCAT(d.datedis, ' ', d.timedis) AS datedis_time, d.discharge_type FROM newdischarge_summary d JOIN patient p ON d.id = p.no WHERE 1=1;";

// Append search condition if any
if (!empty($searchValue)) {
    $query .= " AND (d.indoor_reg_no LIKE '%$searchValue%' OR p.name LIKE '%$searchValue%' OR p.mobile LIKE '%$searchValue%' OR p.city LIKE '%$searchValue%')";
}

// Get total records without any search
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM newdischarge_summary";
$totalRecordsResult = mysqli_query($con, $totalRecordsQuery);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Get total records with search
$totalRecordsWithSearchQuery = "SELECT COUNT(*) AS total FROM ($query) as temp";
$totalRecordsWithSearchResult = mysqli_query($con, $totalRecordsWithSearchQuery);
$totalRecordsWithSearch = mysqli_fetch_assoc($totalRecordsWithSearchResult)['total'];

// Add limit for pagination
// $query .= " LIMIT $start, $length";
$query .= " LIMIT 0,10";

// Echo the final query for debugging
echo $query;

// Execute query
$result = mysqli_query($con, $query);

// Prepare data for DataTables
$data = [];
// $i = $start + 1;
$i = 0 + 1;

// while ($row = mysqli_fetch_assoc($result)) {
//     $row['S.No.'] = $i++;
//     $row['action'] = '<a href="editdischargesummary.php?id=' . $row['id'] . '" target="_new"><input type="button" value="Edit" class="form-control formbutton"></a>
//                       <a href="newprint.php?id=' . $row['id'] . '" target="_new"><input type="submit" class="form-control formbutton_new" value="Print"></a>';
//     $data[] = $row;
// }

// Return response
// $response = [
//     "draw" => intval($draw),
//     "recordsTotal" => intval($totalRecords),
//     "recordsFiltered" => intval($totalRecordsWithSearch),
//     "data" => $data
// ];
$response = [
    "query" => $query,
];

echo json_encode($response);
?>
