<?php
session_start();
if(!$_SESSION['user'])
header('location:index.php');
include("config.php");

if(isset($_POST['Submit']))
{
	$tmt_id=$_POST['tmt_id'];
	$td_id=$_POST['td_id'];
	//$atmid=$_POST['atmid'];
	//$trackid=$_POST['trackid'];
	
	$sv=$_POST['sv'];
	$cust=$_POST['cust'];
	$amt=$_POST['amt'];
	$valid=$_POST['valid'];
	$totalamtgross=$_POST['totalamtgross'];
	$dt=date('Y-m-d H:i:s');
	$bill_date=date('Y-m-d');
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	mysqli_query($con,"BEGIN");
	$er_qry=mysqli_query($con,"SELECT * FROM `recharge_template` where tmt_id='".$tmt_id."'");
	$er=mysqli_fetch_array($er_qry);
	$error=0;
	for($i=0;$i<$_POST['counter'];$i++){
		if($valid[$i]=="yes"){
			$er_detail_qry=mysqli_query($con,"SELECT * FROM `recharge_template_details` where td_id='".$td_id[$i]."'");
			$er_detail=mysqli_fetch_array($er_detail_qry);
			//echo "INSERT INTO `ebillfundrequests` (`atmid`, `bill_date`, `amount`, `supervisor`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`print`, `pstat`, `type`,`priority`) VALUES ('".$er_detail['atm_id']."', '".$bill_date."', '".$amt[$i]."', '".$er['supervisor']."', '".$dt."', '".$er['cust_id']."', '".$srno[0]."','".$er_detail['tracker_id']."', '3', 'n','0', 'recharge','Normal')";
			$qry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`atmid`, `bill_date`, `amount`, `supervisor`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`print`, `pstat`, `type`,`priority`) VALUES ('".$er_detail['atm_id']."', '".$bill_date."', '".$amt[$i]."', '".$er['supervisor']."', '".$dt."', '".$er['cust_id']."', '".$srno[0]."','".$er_detail['tracker_id']."', '3', 'n','0', 'recharge','Normal')");
			if(!$qry)
				echo mysqli_error();
		}
	}
	if($error==0)
		mysqli_query($con,"COMMIT");
	else
		mysqli_query($con,"ROLLBACK");
	/*//echo "<br/><br/>INSERT INTO `erechargereq` ( `atmid`, `bill_date`,  `amount`, `supervisor`, `cust_id`, `reqby`, `reqstatus`,`entrydate`,  `print`, `pstat`, `type`) VALUES ('$tmt_id', '$bill_date',  '$totalamtgross', '$sv', '$cust', '$srno' , '1', '$dt',  'n','0', 'recharge')";
	$qry1=mysqli_query($con,"INSERT INTO `erechargereq` ( `atmid`, `bill_date`,  `amount`, `supervisor`, `cust_id`, `reqby`, `reqstatus`,`entrydate`,  `print`, `pstat`, `type`) VALUES ('$tmt_id', '$bill_date',  '$totalamtgross', '$sv', '$cust', '$srno[0]' , '1', '$dt',  'n','0', 'recharge')");
	$req_id=mysqli_insert_id();
	for($i=0;$i<$_POST['counter'];$i++){
		if($td_id[$i]!=""){
			if($qry1)
			{
				//echo "<br/>INSERT INTO `erequest_details` ( `req_no`, `td_id`, `amount`) VALUES ( '".$req_id."', '".$td_id[$i]."', '".$amt[$i]."')";
				$qry2=mysqli_query($con,"INSERT INTO `erequest_details` ( `req_no`, `td_id`, `amount`) VALUES ( '".$req_id."', '".$td_id[$i]."', '".$amt[$i]."')");
				if(!qry2)
					echo mysqli_error();
			}
			else
				echo mysqli_qrror();
		}
	}
	if($qry1 && $qry2)
		mysqli_query($con,"COMMIT");
	else
		mysqli_query($con,"ROLLBACK");
	header('location:view_er_template.php');*/
	header('location:view_er_template.php');
}
?>