<?php
include ("config.php");
include ("access.php");



$qid = $_POST['qid'];
$reqamt = $_POST['tramt'];
$vcno = $_POST['vcno'];
$sup = $_POST['sup'];

//echo "hello";
$error = 0;

$tid = "";
$qry1 = mysqli_query($con, "select max(tid) from quotation1ftransfers");
$qrrow = mysqli_fetch_row($qry1);
if ($qrrow != null) {
     $tid = $qrrow[0] + 1; //echo $tid;
} else {
     $tid = 1;
}

//echo $tid;

mysqli_autocommit($con, FALSE);

$dt = date('Y-m-d H:i:s');
$qry = mysqli_query($con, "insert into quotation1ftransfers(`tid`, `qid`, `accid`,  `dbtaccno`, `tamount`, `entrydt`, `status`, `email_body`, `mail_by`, `voucher_no`) values('" . $tid . "','" . $qid . "','" . $sup . "','','" . $reqamt . "','" . $dt . "','1','','','" . $vcno . "')");
if (!$qry) {
     $error++;
}
$sql3 = mysqli_query($con, "update quotation1 set p_stat='2',local_status='2' where id='" . $qid . "'");
if (!$sql3) {
     $error++;
}

if ($error == 0) {
     mysqli_query($con, "COMMIT");
     echo "Transferred";
} else {
     mysqli_query($con, "ROLLBACK");
     echo "insert into quotation1ftransfers(`tid`, `qid`, `accid`,  `dbtaccno`, `tamount`, `entrydt`, `status`, `email_body`, `mail_by`, `voucher_no`) values('" . $tid . "','" . $qid . "','','','" . $reqamt . "','" . $dt . "','1','','','" . $vcno . "')" . "<br>";

     echo "update quotation1 set p_stat='2',local_status='2' where id='" . $qid . "'";


}



?>