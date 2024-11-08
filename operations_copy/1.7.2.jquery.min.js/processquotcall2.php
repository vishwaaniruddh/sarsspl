<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, Your Session has Expired');window.location='index.php';</script>";
}
else{
include("config.php");
$cnt=$_POST['matcnt'];
$mat=array();
$rate=array();
$qty=array();
$remrk=array();
$docno=array();
$now=array();
$curdt=date('Y-m-d H:i:s');
$tot=0;
$stat=1;
$stat2=0;
echo strtotime(str_replace("/","-",$_POST['est']));
 //$_POST['time'] $_POST['meri']
 $tm=$_POST['time'].":00:00";
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']).":00:00";
 echo $tm;
 echo $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
/*$sup=$_POST['sup'];
 $quotid=$_POST['quot'];
$rem=str_replace("'","\'",$_POST['rem']);
$dt=date('Y-m-d H:i:s');
 $sup=$_POST['super'];
$log=mysqli_query($con,"Select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);
if($quotid==''){
$stat='1';
if(isset($_POST['updet']))
{
if($_POST['stype']=='sites')
{
$up=mysqli_query($con,"update ".$_POST['bank']."_sites set bank='".$_POST['bk']."',csslocalbranch='".$_POST['csslocalbr']."',state='".$_POST['state']."',city='".$_POST['city']."',atmsite_address='".str_replace("'","\'",$_POST['address'])."' where trackerid='".$_POST['trackid']."'");
}
else
{
}
}
$str= "INSERT INTO `quotation` (`status`,`quotid`, `quotby`, `cust_id`, `trackerid`,  `description`,`dept`,`sitetype`,`entrydt`,`supervisor`,`csslocalbranch`,`ccmail`,`atmid`) VALUES ('1',NULL, '".$logro[0]."', '".$_POST['bank']."', '".$_POST['trackid']."', '".$rem."','".$_POST['department']."','".$_POST['stype']."','".$curdt."','".$sup."','".$_POST['csslocalbr']."','".$_POST['ccmail']."','".$_POST['atmid']."')";
//echo $str;
$qry=mysqli_query($con,$str);
$qu=mysqli_query($con,"select max(quotid) from quotation");
$quro=mysqli_fetch_row($qu);
$quotid=$quro[0];
}
$stat=0;
$asst=array();
$mem2='';
$rem2=str_replace("'","\'",$_POST['rem']);
for($i=0;$i<$cnt;$i++)
{
if(isset($_POST['material'][$i]) && $_POST['material'][$i]!='-1')
{

 $mem2.="\n***###Component-".$asst[]=$_POST['asst'][$i];
 $mem2.="\nWork-".$mat[]=$_POST['material'][$i];
$now[]=$_POST['now'][$i];
$remrk[]=str_replace("'","\'",$_POST['memo'][$i]);
$docno[]=$_POST['docno'][$i];

 $tot=$tot+(($_POST['rate'][$i])*($_POST['qty'][$i]));

$stat=$stat+1;
}
}
$mem2.="\nTotal-".$tot;


if($stat>0)
{
//$quotid=$_POST['quot'];
$sub=str_replace("'","\'",$_POST['subject']);
$alertdt=date("Y-m-d");
for($i=0;$i<$stat;$i++)
{

$qry=mysqli_query($con,"INSERT INTO `quot_details` (`quotdetid`, `quotid`, `material`,`component`,`now`,`cldocno`,`memo`,`qty`) VALUES (NULL, '".$quotid."', '".$mat[$i]."','".$asst[$i]."','".$now[$i]."','".$docno[$i]."','".$remrk[$i]."','1')");
$qdtid=mysqli_query($con,"select max(quotdetid) from quot_details");
$qdtr=mysqli_fetch_row($qdtid);

}
 $tbl="<html>
<head>
<title>New Call Activation Request from CSS</title>
</head>
<body>
<p>Dear Concern,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;Your Call has been Logged. Please Find your Docket Number.</p><br><table border='1'><tr><th>Docket Number</th><th>ATM ID</th><th>BANK</th><th>LOCATION</th><th>CITY</th><th>ISSUE</th></tr>";
//echo "select alert_id,cust_id,atm_id,createdby,bank_name,address,city,mattype,alert_type from alert where alert_id='".$id."'";
		
		
$qdt=mysqli_query($con,"select distinct(component),now from quot_details where quotid='".$quotid."' and status=0");
while($qdtr=mysqli_fetch_array($qdt))
{
$prblm='';
$mprblm='';
$cldoc='';
$prblm.="<b>".$qdtr[0].": </b>\n";
if($qdtr[0]!="Other" && $qdtr[0]!="other" && $qdtr[0]!="Not Confirmed" && $qdtr[0]!="not confirmed" && $qdtr[0]!="not confirm"  && $qdtr[0]!="Not Confirm")
$mprblm.="<b>".$qdtr[0].": </b>\n";
//echo "select material,qty,unit,cldocno from quot_details where component='".$qdtr[0]."' and quotid='".$quotid."' and status=0<br>";
$qrdt=mysqli_query($con,"select material,qty,unit,cldocno from quot_details where component='".$qdtr[0]."' and now='".$qdtr[1]."' and quotid='".$quotid."' and status=0");
while($qrdtr=mysqli_fetch_array($qrdt))
{
$cldoc.=$qrdtr[3].",";
$prblm.=$qrdtr[0]."\n";
if($qrdtr[0]!="Other" && $qrdtr[0]!="other" && $qrdtr[0]!="Not Confirmed" && $qrdtr[0]!="not confirmed" && $qrdtr[0]!="not confirm"  && $qrdtr[0]!="Not Confirm")
$mprblm.="<b>".$qrdtr[0].": </b>\n";
}

$doct=mysqli_query($con,"select count(alert_id) from alert where alert_date='".$alertdt."'");
$doctro=mysqli_fetch_row($doct);
$docketno='';
if(mysqli_num_rows($doct)=='0')
$docketno=$logro[0]."_".date('dmY')."1";
else
$docketno=$logro[0]."_".date('dmY')."".($doctro[0]+1);

 $aaa="INSERT INTO `alert` (`alert_id`, `cust_id`, `atm_id`, `bank_name`,`area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `createdby`, `state1`,quotdetid,cldocno,mattype,callpriority) VALUES (NULL, '".$_POST['bank']."','".$_POST['trackid']."', '".$_POST['bk']."','".$_POST['csslocalbr']."', '".$_POST['address']."', '".$_POST['city']."', '".$_POST['csslocalbr']."', NULL, '".$prblm."', '".$curdt."', '".$alertdt."','".$_POST['authn']."', '".$_POST['connum']."', '".$_POST['email']."', '1', '1', '".$_POST['stype']."', '0000-00-00 00:00:00','".$docketno."','".$_POST['state']."','".$quotid."','".$cldoc."','".$qdtr[1]."_".$qdtr[0]."','".$_POST['prio']."')";
$alert=mysqli_query($con,$aaa);

if($_POST['stype']=='sites')
		$site="select atm_id1 from ".$alertro[1]."_sites where trackerid='".$alertro[2]."'";
		elseif($_POST['stype']=='rnmsites')
		$site="select atm_id1 from rnmsites where trackerid='".$alertro[2]."'";
		//echo $site;
		$st=mysqli_query($con,$site);
		$sitero=mysqli_fetch_row($st);
$tbl.="<tr><td>".$docketno."</td><td>".$_POST['atmid']."</td><td>".$_POST['bk']."</td><td>".$_POST['address']."</td><td>".$_POST['city']."</td><td>".$mprblm."</td></tr>";
}

$to = $_POST['email'];
		$cc=str_replace("\n",",",$_POST['ccmail']);
			
			$subject = $sub;
			
			$headers = "From: CSSINDIA\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "Cc: ".$cc. "\r\n";
			//echo $tbl;
			$message=$tbl;
		$message.="</table><br><p>&nbsp;&nbsp;&nbsp;Once Issue Resolved, we will notify you.<br><br><br><br>&nbsp;&nbsp;&nbsp;Regards<br>&nbsp;&nbsp;&nbsp;CSS TEAM</p><img src='http://cssmumbai.sarmicrosystems.com/operations/csslogo.jpg'></body></html>";	
	//echo $message;		
		mail($to, $subject, $message, $headers);
//echo "Update quotation set subject='".$sub."',type='".$_POST['type']."',status='0',totalcost='0',materialcnt='".$stat."',mailperson='".$_POST['authn']."' where quotid='".$quotid."'";
$ins=mysqli_query($con,"Update quotation set subject='".$sub."',type='".$_POST['type']."',status='1',totalcost='0',materialcnt='".$stat."',mailperson='".$_POST['authn']."',`reqamt`='0' where quotid='".$quotid."'");
if($ins)
$str="Data Entered Successfully";
}
else
$str="No Material was Entered";

echo "<script type='text/javascript'>alert('Call locked Successfully');window.location='servicecall.php'</script>";
//header('location:viewquot.php');
*/
}
?>