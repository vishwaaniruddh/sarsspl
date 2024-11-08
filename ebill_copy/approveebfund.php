<?php
include('access.php');
if(!isset($_SESSION['user'])){
echo "0";
}else{
	include('config.php');
	$reqid=$_REQUEST['id'];
	$stat=$_REQUEST['stat'];
	$rem=addslashes($_REQUEST['rem']);
	$reasons=$_REQUEST['reasons'];
	//echo "Update ebillfundrequests set reqstatus='".$stat."' where reqid='".$reqid."'";
	$dt=date('Y-m-d H:i:s');
	
	$supr=$_REQUEST['sup'];
	
	if(isset($_GET['chk']))
	$qr=" ,chqno='".$_GET['chk']."'";
	else
	$qr='';
	
	
	$str;
	if($supr>=0 && $supr!="")
	{
	$str="Update ebillfundrequests set reqstatus='".$stat."',supervisor='".$supr."'";
	}
	else
	{
	$str="Update ebillfundrequests set reqstatus='".$stat."'";
	}
	
	
	
	
	
	if($_REQUEST['amount']>0)
		$str.=",approvedamt='".$_REQUEST['amount']."'".$qr;
	$str.=" where req_no='".$reqid."'";
	//echo $str;
	$qry=mysqli_query($con,$str);
	/*if(!$qry)
		echo mysqli_error();*/
	//echo "INSERT INTO `ebillfundapp` (`appid`, `reqid`, `appamt`, `appby`, `apptime`, `remarks`, `level`,`reasons`) VALUES (NULL, '".$reqid."', '".$_REQUEST['amount']."', '".$_SESSION['user']."', '".$dt."', '".$rem."', '".$stat."','".$reasons."')";
	$ins=mysqli_query($con,"INSERT INTO `ebillfundapp` (`appid`, `reqid`, `appamt`, `appby`, `apptime`, `remarks`, `level`,`reasons`) VALUES (NULL, '".$reqid."', '".$_REQUEST['amount']."', '".$_SESSION['user']."', '".$dt."', '".$rem."', '".$stat."','".$reasons."')");
	/*if(!$ins)
		echo mysqli_error();*/
	if($qry && $ins)
	{
		echo "1";
	}
	else
		echo "0";
}
?>