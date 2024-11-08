<?php
include ('config.php');

$fdate = date('Y-m-01');
$toDate = date('Y-m-t');



$data = array();


$sql1 = "SELECT COUNT(Lead_id) as L,Creation FROM Leads_table where   date(Creation) between  '" . $fdate . "' and '" . $toDate . "' GROUP BY date(Creation)   ";
$result1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_array($result1)) {

    $ts = strtotime($row1[1]);
    $dt = date('d-m-Y', $ts);

    $data[] = ['date' => $dt, 'Count' => $row1[0]];

}



echo json_encode($data);
?>