<?php
session_start();
if(!$_SESSION['user'])
header('location:index.php');
include("config.php");

if(isset($_POST['Submit']))
{
	$atmid=$_POST['atmid'];
	$trackid=$_POST['trackid'];
	$amt=$_POST['amt'];
	$dt=date('Y-m-d H:i:s');
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	//echo "INSERT INTO `recharge_template` (`supervisor`, `cust_id`, `createdby`, `createdon`) VALUES ('".$_POST['sv']."', '".$_POST['cust']."', '".$srno[0]."', '".$dt."')";
	$qry=mysqli_query($con,"INSERT INTO `recharge_template` (`supervisor`, `cust_id`, `createdby`, `createdon`) VALUES ('".$_POST['sv']."', '".$_POST['cust']."', '".$srno[0]."', '".$dt."');");
	$qid=mysqli_insert_id();
	//echo "<br/>".$_POST['counter'];
	if($qry)
	{
		for($i=0;$i<$_POST['counter'];$i++)
		{
			if($atmid[$i]!=""){
					//echo "<br/>INSERT INTO `recharge_template_details` ( `tmt_id`, `atm_id`, `tracker_id`, `amount`, `createdon`, `createdby`) VALUES ('".$qid."', '".$atmid[$i]."', '".$trackid[$i]."', '".$amt[$i]."', '".$dt."', '".$srno[0]."')";
					$insert_qry_temp_detalil=mysqli_query($con,"INSERT INTO `recharge_template_details` ( `tmt_id`, `atm_id`, `tracker_id`, `amount`, `createdon`, `createdby`) VALUES ('".$qid."', '".$atmid[$i]."', '".$trackid[$i]."', '".$amt[$i]."', '".$dt."', '".$srno[0]."');");
					if(!$insert_qry_temp_detalil)
						echo mysqli_error();
			}
		}
	}
	else
		echo mysqli_error()." ertty";
	header('location:view_er_template.php');
}
?>