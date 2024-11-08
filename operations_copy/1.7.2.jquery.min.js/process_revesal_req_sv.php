<?php
	session_start();
	include("config.php");
	
	$accmgr=0;
	if($_SESSION['designation']==8 && $_SESSION['dept']==4 && $_SESSION['serviceauth']==2)
		$accmgr=1;
	$branchmgr=0;
	if($_SESSION['designation']==9 && $_SESSION['branch']!="all" && $_SESSION['branch']!="")
		$branchmgr=1;

	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	
	
	
	
	if($accmgr || $branchmgr)
	{
		$qry=mysqli_query($con,"select supervisor from ebillfundrequests where req_no='".$_REQUEST['reqid']."'");
		$row=mysqli_fetch_array($qry);
		$fundacc_qry=mysqli_query($con,"select * from fundaccounts where hname like '$row[0]'");
		$fundacc=mysqli_fetch_array($fundacc_qry);
	}
	else
	{
		$fundacc_qry=mysqli_query($con,"SELECT * FROM `fundaccounts` WHERE `srno` = '".$srno[0]."'");
		$fundacc=mysqli_fetch_array($fundacc_qry);
	}
	$ins=mysqli_query($con,"INSERT INTO `reversal`(`reqid`, `accid`,`dbtacc`, `payment_type`, `pdate`,`pamount`, `chqname`, `chqno`, `remark`, `entrydate`, `reqby`) VALUES ('".$_REQUEST['reqid']."','".$fundacc['aid']."','".$_REQUEST['dbtacc']."','".$_REQUEST['paytype']."','".date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['pdate'])))."','".$_REQUEST['pamount']."','".$_REQUEST['bank']."','".$_REQUEST['chqno']."','".$_REQUEST['remark']."','".date('Y-m-d H:m:s')."','".$srno[0]."')");
	if($ins)
	{
		$_SESSION['success']=1;
	}
	else
	{
		$_SESSION['success']=0;
		echo mysqli_error();
	}
	header('location:view_ebfundtrans_sv.php');
	
?>