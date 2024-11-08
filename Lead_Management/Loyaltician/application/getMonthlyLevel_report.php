<?php
include ('config.php');

$fdate = $_POST['fdate'];
$toDate = $_POST['toDate'];

$fdate1 = date('Y-m', strtotime($fdate));
$todate1 = date('Y-m', strtotime($toDate));

$fdate2 = date('m', strtotime($fdate));
$todate2 = date('m', strtotime($toDate));

$fdate3 = date('Y', strtotime($fdate));
$todate3 = date('Y', strtotime($toDate));

$data = array();


$from_padded = sprintf("%02d", $fdate2);
$to_padded = sprintf("%02d", $todate2);


$fdate4 = $fdate3 . "-" . $from_padded;
$todate4 = $todate3 . "-" . $to_padded;

$sql1 = "select count(MembershipDetails_Level) from Members where MembershipDetails_Level='1' and canceledMember='0' and date_format( entryDate, '%Y-%m' ) between  '" . $fdate4 . "' and '" . $todate4 . "'  ";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);

$sql2 = "select count(MembershipDetails_Level) from Members where MembershipDetails_Level='2' and canceledMember='0' and date_format( entryDate, '%Y-%m' ) between  '" . $fdate4 . "' and '" . $todate4 . "'  ";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);

$sql3 = "select count(MembershipDetails_Level) from Members where MembershipDetails_Level='3' and canceledMember='0' and date_format( entryDate, '%Y-%m' ) between  '" . $fdate4 . "' and '" . $todate4 . "'  ";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($result3);

$data[] = ['First' => $row1[0], 'gold' => $row2[0], 'Patinum' => $row3[0]];






echo json_encode($data);
?>