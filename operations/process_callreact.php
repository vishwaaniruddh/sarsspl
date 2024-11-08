<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('sorry your session has Expired'); window.location='index.php';</script>";
}
else
{
include("config.php");
$id=$_POST['alertid'];
$up=str_replace("'","','",$_POST['up']);
$qry=mysqli_query($con,"Insert into alert_reactive(`alert_id`,`entrydt`,`upby`,`remark`) Values('".$id."','".$_POST['dt']."','".$_SESSION['user']."','".$up."')");
if($qry)
{
$tab=mysqli_query($con,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`,`upby`) Values('".$id."','".$up."','".$_POST['dt']."','".$_SESSION['branch']."','".$_SESSION['user']."')");
$alrt=mysqli_query($con,"update alert set status='2',call_status=1,close_date='0000-00-00 00:00:00' where alert_id='".$id."'");
if($alrt)
{
if($_POST['email']!="")
	{
		
		$qry=mysqli_query($con,"select caller_email,createdby from alert where alert_id='$id'");
$row=mysqli_fetch_row($qry);
$to = $row[0];
$alert=mysqli_query($con,"select alert_id,cust_id,atm_id,createdby,bank_name,address,city,mattype,alert_type from alert where alert_id='".$id."'");
		$alertro=mysqli_fetch_row($alert);
		//echo "hi";
$site="";
//echo $alertro[8];
		if($alertro[8]=='sites')
		$site="select atm_id1 from ".$alertro[1]."_sites where trackerid='".$alertro[2]."'";
		elseif($alertro[8]=='rnmsites')
		$site="select atm_id1 from rnmsites where trackerid='".$alertro[2]."'";
		//echo $site;
		$st=mysqli_query($con,$site);
		$sitero=mysqli_fetch_row($st);	
		
		
		
		$sub=mysqli_query($con,"select subject,ccmail from quotation where quotid in (select quotdetid from alert where alert_id='".$id."')");
	$subro=mysqli_fetch_row($sub);	
	$tbl="<html>
<head>
<title>Update From CSSINDIA</title>
</head>
<body>
<p>Update for your Request</p><table border='1'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>LOCATION</th><th>CITY</th><th>ISSUE</th><th>Reactivation Date/Time</th><th>STATUS</th><th>REMARK</th></tr>";
//echo "select alert_id,cust_id,atm_id,createdby,bank_name,address,city,mattype,alert_type from alert where alert_id='".$id."'";
		
		$tbl.="<tr><td>".$alertro[3]."</td><td>".$sitero[0]."</td><td>".$alertro[4]."</td><td>".$alertro[5]."</td><td>".$alertro[6]."</td><td>".$alertro[7]."</td><td>".date('d/m/Y H:i:s')."</td><td>Reactivated</td><td>".$up."</td></tr>";
		
		$tbl.="</table><br><img src='http://cssmumbai.sarmicrosystems.com/operations/csslogo.jpg'></body></html>";
				
			$subject = $subro[0];
			$headers .= "Cc: ".$subro[1]. "\r\n";
			$headers .= "From: CSSINDIA@noreply.in\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			
			$message=$tbl;
			
		mail($to, $subject, $message, $headers);
	}
echo "<script type='text/javascript'>alert('Call Reactivated Successfully'); window.location='view_callalert.php';</script>";
}
else
{
$del=mysqli_query($con,"delete from alert_reactive where alert_id='".$id."' and status=0");
echo "<script type='text/javascript'>alert('Some Error Occurred'); window.location='view_callalert.php';</script>";
}
}
else
{
echo "<script type='text/javascript'>alert('Some Error Occurred'); window.location='view_callalert.php';</script>";
}
}

?>