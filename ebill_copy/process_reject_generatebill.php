<?php
session_start();
if(!$_SESSION['user']){
echo "0";
}else{
	include("config.php");
	$dt=date('Y-m-d H:i:s');
	$reqid=$_GET['reqid'];
	$email=$_GET['rejemail'];
	$to=$email;
	$cc=str_replace("\n",",",$_GET['rejccemail']);
	//$cc=$_GET['rejccemail'];
	$reason1=$_GET['reason'];
	$reason="";
	for($i=0;$i<count($reason1);$i++)
	{
		if($i==0)
			$reason.=$reason1[$i];
		else
			$reason.=",".$reason1[$i];
	}
	$remarks=$_GET['reason1'];
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	//echo "INSERT INTO `rejected_generate_ebill` (`req_no`, `email`, `ccemail`, `reason`, `remarks`,`entrydate`) VALUES ('$reqid', '$email', '$cc', '$reason', '$remarks','$dt')";
	$qry1=mysqli_query($con,"INSERT INTO `rejected_generate_ebill` (`req_no`, `email`, `ccemail`, `reason`, `remarks`,`entrydate`,`rejectedby`) VALUES ('$reqid', '$email', '$cc', '$reason', '$remarks','$dt',$srno[0])");
	
	$qry2=mysqli_query($con,"update ebillfundrequests set pstat='2' where req_no='".$reqid."'");
	if(!$qry1 || !$qry2)
	 echo "<br/>".mysqli_error();
	if($qry1 && $qry2)
	{
	
	$qry=mysqli_query($con,"select atmid,reqby, entrydate,bill_date,unit, amount,start_date, end_date, due_date,opening_reading, closing_reading, req_no, print, cust_id, status, memo, trackerid from ebillfundrequests where req_no='$reqid'");
	$row = mysqli_fetch_array($qry);
	//echo "select bank,csslocalbranch,zone,state,city,location,atmsite_address,takeover_date from ".$row[13]."_sites where trackerid='".$row[16]."'";
	$sitestr= mysqli_query($con,"select bank,csslocalbranch,zone,state,city,location,atmsite_address,takeover_date from ".$row[13]."_sites where trackerid='".$row[16]."'");
	$site = mysqli_fetch_array($sitestr);
	$str="<html><body>";
	$str.="<table border=\"1\" align=\"center\" style=\"width:auto; table-layout:auto; border-collapse:collapse; empty-cells:hide;\">
	  <tr style=\"background-color:#8FB26B;color:#fff;\">
		<th>Atm ID</th>
		<th>Docket NO</th>
		<th width=\"10%\">Entry Date</th>
		<th>Bank</th>
		<th>State</th>
		<th>City</th>
		<th >Address</th>
		<th width=\"10%\">Bill Date</th>
		<th>Unit </th>
		<th>Amount</th>
		<th width=\"10%\">Start date</th>
		<th width=\"10%\">End date</th>
		<th width=\"10%\">Due Date</th>
		<th>Opening Reading</th>
		<th>Closing reading</th>
	  </tr>
	  <tr style=\"background-color:#B8E68A;color:#000;font-size:12px;\">
		<th>".$row['atmid']."</th>
		<th>".$row['req_no']."</th>
		<th>".date('d-m-Y',strtotime($row['entrydate']))."</th>
		<th>".$site['bank']."</th>
		<th>".$site['state']."</th>
		<th>".$site['city']."</th>
		<th style=\"font-size: '10px' \">".$site['atmsite_address']."</th>
		<th>".date('d-m-Y',strtotime($row['bill_date']))."</th>
		<th>".$row['unit']."</th>
		<th>".$row['amount']."</th>
		<th>".date('d-m-Y',strtotime($row['start_date']))."</th>
		<th>".date('d-m-Y',strtotime($row['end_date']))."</th>
		<th>".date('d-m-Y',strtotime($row['due_date']))."</th>
		<th>".$row['opening_reading']."</th>
		<th>".$row['closing_reading']."</th>
	  </tr>
	  </table>
	  ";
	$str.="Your reqid : <b>".$reqid."</b><br/> Reasons : <br/>";
	for($i=0;$i<count($reason1);$i++)
	{
		$qry3=mysqli_query($con,"select reason from rejection_generateebill where id=".$reason1[$i]);
		$row=mysqli_fetch_array($qry3);
		$str.=($i+1)." : <b>".$row['reason']."</b><br/>";
	}
	$str.="<br/> Remarks : <b>".$remarks."</b></body></html>";
	//echo $str;
	$subject = "Subject";
				
				$headers = "From: CSSINDIA\r\n";
				//$headers .= "Reply-To: ".dfdf . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$headers .= "Cc: ".$cc. "\r\n";
				//echo $tbl;
				$message=$str;
			//$message.="</table><br><p>&nbsp;&nbsp;&nbsp;Once Issue Resolved, we will notify you.<br><br><br><br>&nbsp;&nbsp;&nbsp;Regards<br>&nbsp;&nbsp;&nbsp;CSS TEAM</p><img src='http://cssmumbai.sarmicrosystems.com/operations/csslogo.jpg'></body></html>";	
		//echo $message;		
			mail($to, $subject, $message, $headers);
	}

}
?>
<script>
alert("Your rejection reasons is sent through mail. ");
window.close();
</script>