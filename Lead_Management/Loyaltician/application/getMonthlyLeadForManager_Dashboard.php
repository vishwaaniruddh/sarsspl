<?php
include ('config.php');

$fdate = date('Y-m-01');
$toDate = date('Y-m-t');



$data1 = array();
$data2 = array();


$sql1 = "SELECT COUNT(Lead_id) as L,Creation FROM Leads_table where   date(Creation) between  '" . $fdate . "' and '" . $toDate . "' GROUP BY date(Creation)   ";
$result1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_array($result1)) {

    $ts = strtotime($row1[1]);
    $dt = date('d-m-Y', $ts);

    $data1[] = ['Leaddate' => $dt, 'LCount' => $row1[0]];

}

$sql2 = "SELECT COUNT(Lead_id) as L,Creation FROM Leads_table where Status='5' and  date(Creation) between  '" . $fdate . "' and '" . $toDate . "' GROUP BY date(Creation)   ";
$result2 = mysqli_query($conn, $sql2);
while ($row2 = mysqli_fetch_array($result2)) {

    $ts2 = strtotime($row2[1]);
    $dt2 = date('d-m-Y', $ts2);

    $data2[] = ['MemDate' => $dt2, 'MCount' => $row2[0]];

}

$data = array_merge($data1, $data2);


echo json_encode($data);
?>