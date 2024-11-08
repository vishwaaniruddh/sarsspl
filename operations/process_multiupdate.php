<?php
session_start();
if(!isset($_SESSION['designation']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired. Please login again');window.location='index.php';</script>";
}
else
{
if(isset($_POST['cmdsub']))
{
include("config.php");
$qid=array();
function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}
$alertid=$_POST['alertid'];
$alert=implode(",",$alertid);
$sttt='';

if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['up']))
{
   $sttt=str_replace("'","\'",$_POST['up']);
}
else
 $sttt=$_POST['up'];
//echo "select distinct(quotdetid) from alert where alert_id in ($alert)<br>";
$quot=mysqli_query($con,"select distinct(quotdetid) from alert where alert_id in ($alert)");
while($qt=mysqli_fetch_array($quot))
{
 $qid[]=$qt[0];
}  
$cdate=date('Y-m-d H:i:s');
// if call is closed
if(isset($_POST['tou']) && $_POST['tou']=="Close")
{
$close=mysqli_query($con,"update alert set call_status='3',close_date='".$cdate."' where alert_id in ($alert)");
}

// if call is not closed and wnt to set remainder
if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!='' && $_POST['tou']!="Close"){
		$tm=$_POST['time'].":00:00";
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']).":00:00";
 //echo $tm;
 $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
 
 $estm=mysqli_query($con,"Update alert set eta='".$etdt."' where alert_id in ('".$alert."')");
 }
 
 
 
for($i=0;$i<count($qid);$i++)
{
$mailto='';
//echo "select alert_id,cust_id,atm_id,createdby,bank_name,address,city,mattype,alert_type,caller_email from alert where alert_id in($alert) and quotdetid='".$qid[$i]."'<br>";

$tbl="<html>
<head>
<title>Update From CSSINDIA</title>
</head>
<body>
<p>Update for your Request</p><table border='1'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>LOCATION</th><th>CITY</th><th>ISSUE</th><th>STATUS</th></tr>";
$qry=mysqli_query($con,"select alert_id,cust_id,atm_id,createdby,bank_name,address,city,mattype,alert_type,caller_email from alert where alert_id in($alert) and quotdetid='".$qid[$i]."'");
while($alertro=mysqli_fetch_array($qry))
{


 $tab=mysqli_query($con,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`,`upby`) Values('".$id."','".$sttt."','".$cdate."','".$br3."','".$_SESSION['user']."')");

$site="";
//echo $alertro[8];
		if($alertro[8]=='sites')
		$site="select atm_id1 from ".$alertro[1]."_sites where trackerid='".$alertro[2]."'";
		elseif($alertro[8]=='rnmsites')
		$site="select atm_id1 from rnmsites where id='".$alertro[2]."'";
		//echo $site;
		$ste=mysqli_query($con,$site);
		$sitero=mysqli_fetch_row($ste);
 $mailto=$alertro[9];
$tbl.="<tr><td>".$alertro[3]."</td><td>".$sitero[0]."</td><td>".$alertro[4]."</td><td>".$alertro[5]."</td><td>".$alertro[6]."</td><td>".$alertro[7]."</td><td>".$sttt."</td></tr>";
}
$ccm=mysqli_query($con,"select ccmail,subject from quotation where quotid='".$qid[$i]."'");
$ccmr=mysqli_fetch_row($ccm);

$cc=implode(",",extract_email_address($ccmr[0]));
//print_r($cc);
$subject=$ccmr[1];
//echo "<br>";
$tbl.="</table><br><img src='http://cssmumbai.sarmicrosystems.com/operations/csslogo.jpg'></body></html>";
//echo $tbl."<br>";
//echo $mailto." ".$cc;
$headers = "From: CSSINDIA\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "Cc: ".$cc. "\r\n";
			//echo $tbl;
			$message=$tbl;
			if(isset($_POST['mail']))
			{
			mail($mailto, $subject, $message, $headers);
			}
}

echo "<script type='text/javascript'>window.location='view_alert.php';</script>";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
}
else
{
echo "<script type='text/javascript'>window.location='view_alert.php';</script>";
}
}
?>