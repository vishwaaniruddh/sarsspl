<?php
include ("access.php");
include ("config.php");

//echo "hello";
$qid = $_POST['qid'];
$upreqamt = $_POST['upreqamt'];
$uprem = $_POST['uprem'];
$sup = $_POST['sup'];


$errors = "0";

$dt = date('Y-m-d H:i:s');


$srqry = mysqli_query($con, "select srno from login where username='" . $_SESSION['user'] . "'");
$srno = mysqli_fetch_array($srqry);


mysqli_autocommit($con, FALSE);

$inqry = mysqli_query($con, "Insert into `quotation1_req`(`qid`, `req_amt`, `remark`, `reqby`, `entrydt`)values('" . $qid . "','" . $upreqamt . "','" . $uprem . "','" . $srno[0] . "','" . $dt . "')");




if (!$inqry) {
	echo mysqli_error();
	$errors++;
}


$upqr = mysqli_query($con, "update quotation1 set p_stat='1',supervisor='" . $sup . "' where id='" . $qid . "'");
if (!$upqr) {
	echo mysqli_error();
	$errors++;
}



if ($errors == 0) {
	mysqli_query($con, "COMMIT");
	echo "Approved";

} else {
	mysqli_query($con, "ROLLBACK");
	echo mysqli_error();
	echo "Error";

}









?>