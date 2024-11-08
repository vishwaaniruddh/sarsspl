<?php
	session_start();
	include("config.php");
	
	
	
	



	$qry=mysqli_query($con,"select aid from onacctransfer where reqid='".$_REQUEST['reqid']."'");

//echo "select reqid from onacctransfer where reqid='".$_REQUEST['reqid']."'";
		$row=mysqli_fetch_array($qry);
	
	$ins=mysqli_query($con,"INSERT INTO `onaccount_reversal`(`reqid`, `accid`,`dbtacc`, `payment_type`, `pdate`,`pamount`, `chqname`, `chqno`, `remark`, `entrydate`, `reqby`) VALUES ('".$_REQUEST['reqid']."','".$row['aid']."','".$_REQUEST['dbtacc']."','".$_REQUEST['paytype']."','".date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['pdate'])))."','".$_REQUEST['pamount']."','".$_REQUEST['bank']."','".$_REQUEST['chqno']."','".$_REQUEST['remark']."','".date('Y-m-d H:m:s')."','".$srno[0]."')");
	if($ins)
	{
		$_SESSION['success']=1;
	}
	else
	{
		$_SESSION['success']=0;
		echo mysqli_error();
	}
	header('location:view_onaccount_sv.php');
	
?>