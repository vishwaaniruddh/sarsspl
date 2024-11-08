<?php
include('access.php');
if(!isset($_SESSION['user'])){
$_SESSION['success']=0;
}else{
	include('config.php');
	$array=$_REQUEST['mastapp'];
	$stat=$_REQUEST['stat'];
	$rem=addslashes($_REQUEST['remarks']);
	//$reasons=$_REQUEST['reasons'];
	//echo "Update ebillfundrequests set reqstatus='".$stat."' where reqid='".$reqid."'";
	$dt=date('Y-m-d H:i:s');
	mysqli_query($con,"BEGIN");
	$errors=0;
	foreach ($array as $reqid) 
	{
		$str="Update ebillfundrequests_tis set reqstatus='".$stat."'";
		/*if($_REQUEST['amount']>0)
			$str.=",approvedamt='".$_REQUEST['amount']."'";*/
		$str.=" where req_no='".$reqid."'";
		//echo $str;
		$qry=mysqli_query($con,$str);
		/*if(!$qry)
			echo mysqli_error();*/
		//echo "INSERT INTO `ebillfundapp` (`appid`, `reqid`, `appamt`, `appby`, `apptime`, `remarks`, `level`,`reasons`) VALUES (NULL, '".$reqid."', '".$_REQUEST['amount']."', '".$_SESSION['user']."', '".$dt."', '".$rem."', '".$stat."','".$reasons."')";
		$ins=mysqli_query($con,"INSERT INTO `ebillfundapp_tis` (`appid`, `reqid`, `appamt`, `appby`, `apptime`, `remarks`, `level`,`reasons`) VALUES (NULL, '".$reqid."', '".$_REQUEST['amount']."', '".$_SESSION['user']."', '".$dt."', '".$rem."', '".$stat."','".$reasons."')");
		if(!$qry || !$ins)
		{
			$errors++;
		}
	}
	/*if(!$ins)
		echo mysqli_error();*/
	if($errors>0)
	{
		$_SESSION['success']=0;
		mysqli_query($con,"ROLLBACK");
	}
	else
	{
		$_SESSION['success']=1;
		mysqli_query($con,"COMMIT");
	}
}
header('location:ebillreqapprovals_tis.php');
?>