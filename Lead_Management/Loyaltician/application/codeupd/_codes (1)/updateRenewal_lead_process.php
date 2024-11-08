<?php
include 'config.php';

$leadid = $_POST['leadid'];
$Comments = $_POST['Comments'];
$status = $_POST['status'];
//$dt1=$_POST['dt1'];
$ClosedReason = $_POST['ClosedReason'];

date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');

$dt1 = str_replace("/", "-", $_POST['dt1']);
$startdt = date('Y-m-d', strtotime($dt1));


if ($ClosedReason != "") {
    $C_Date = $dates;
} else {
    $C_Date = "";
}

$sql = "insert into RenewalLeadUpdates(LeadId,Comments,UpdateTime,NextUpdate,closeReason,CloseDate) values('" . $leadid . "','" . $Comments . "','" . $dates . "','" . $startdt . "','" . $ClosedReason . "','" . $C_Date . "')";
$runsql = mysqli_query($conn, $sql);

$sql3 = "update Leads_table set renewalStatus='" . $status . "' where Lead_id='" . $leadid . "'";
$runsql3 = mysqli_query($conn, $sql3);



if ($runsql) {
    echo '1';

} else {
    echo '0';
}
//echo $sql;
//echo $sql2;
//echo $sql3;
?>