<?php
include ("access.php");
include ("config.php");

//echo "hello";
$qid = $_POST['qid'];
$upreqamt = $_POST['upreqamt'];
$uprem = $_POST['uprem'];


$errors = "0";

$dt = date('Y-m-d H:i:s');



$srqry = mysqli_query($con, "select srno from login where username='" . $_SESSION['user'] . "'");
$srno = mysqli_fetch_array($srqry);


mysqli_autocommit($con, FALSE);

$inqry = mysqli_query($con, "Insert into `quotation1_reject_tis`(`qid`,`remark`, `reqby`, `entrydt`)values('" . $qid . "','" . $uprem . "','" . $srno[0] . "','" . $dt . "')");




if (!$inqry) {

	$errors++;
}


$upqr = mysqli_query($con, "update quotation1_tis set p_stat='10' where id='" . $qid . "'");
if (!$upqr) {

	$errors++;
}


if ($errors == 0) {
	mysqli_query($con, "COMMIT");
	echo "Rejected";

} else {
	mysqli_query($con, "ROLLBACK");
	//echo mysqli_error();
	echo "Error";

}









?>