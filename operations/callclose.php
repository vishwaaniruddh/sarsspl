<?php
include("config.php");
$id=$_GET['req'];
$qry=mysqli_query($con,"select caller_email,createdby,call_status from alert where alert_id='$id'");
$row=mysqli_fetch_row($qry);
if($row[2]<'3'){
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
<p>Update for your Request</p><table border='1'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>LOCATION</th><th>CITY</th><th>ISSUE</th><th>Resolving Date/Time</th><th>STATUS</th></tr>";
//echo "select alert_id,cust_id,atm_id,createdby,bank_name,address,city,mattype,alert_type from alert where alert_id='".$id."'";
		
		$tbl.="<tr><td>".$alertro[3]."</td><td>".$sitero[0]."</td><td>".$alertro[4]."</td><td>".$alertro[5]."</td><td>".$alertro[6]."</td><td>".$alertro[7]."</td><td>".date("d/m/Y H:i:s")."</td><td>Resolved</td></tr>";
		
		$tbl.="</table><br><img src='http://cssmumbai.sarmicrosystems.com/operations/csslogo.jpg'></body></html>";
			$ccm=str_replace("\n",",",$subro[1]);	
			$subject = $subro[0];
			$headers .= "Cc: ".$ccm. "\r\n";
			$headers .= "From: CSSINDIA\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			//$message="Update Time : ".date("Y-m-d H:i:s")."<br><br>Update : Your Complain number ".$row[1]." has been successfully resolved.";
			$message.=$tbl;
		mail($to, $subject, $message, $headers);
$qry=mysqli_query($con,"Update alert set call_status='3',close_date='".date("Y-m-d H:i:s")."' where alert_id='".$id."'");
if($qry)
echo "<script type='text/javascript'>alert('Call closed successfully'); window.close();</script>";
else
echo "some error Occurred";
}
else
echo "<script type='text/javascript'>alert('This call is already closed'); window.close();</script>";
?>