<?php
	include("config.php");
	session_start();
	$app=$_POST['apps'];
	$max_qry=mysqli_query($con,"SELECT max(did) FROM `update_receipt`");
	$row1=mysqli_fetch_array($max_qry);
	if($row1[0]==0)
		$did=1;
	else
		$did=$row1[0]+1;
	mysqli_query($con,"BEGIN");
	$error=0;
	for($x=0;$x<count($app);$x++){
		$qry=mysqli_query($con,"update update_receipt set dstatus=1,did='$did',ddate='".date('Y-m-d')."' where id='$app[$x]'");
		if(!$qry)
			$error++;
	}
	if($error==0)
	{
		mysqli_query($con,"COMMIT");
		$_SESSION['success']=1;
		if($did<=9)
		$did ="000".$did ;
		if($did>9 && $did <=99)
		$did = "00".$did ;
		if($did>99 && $did <=999)
		$did = "0".$did ;
		$_SESSION['did']="CSS_".$_SESSION['user']."_".$did;
	}
	else
	{
		mysqli_query($con,"ROLLBACK");
		$_SESSION['success']=0;
	}
	header('location:view_dispatch_req.php');
?>