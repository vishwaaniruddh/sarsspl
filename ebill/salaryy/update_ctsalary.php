<?php
include("../config.php");
include("../access.php");
	
	$status=$_POST['status'];
	
	$handoverdt='0000-00-00';
	if($_POST['dt']!="")
	{
	$sdate=str_replace("/","-",$_POST['dt']);
        $handoverdt=date("Y-m-d",strtotime($sdate));
	}
	
	echo $handoverdt."-".$status;
	?>