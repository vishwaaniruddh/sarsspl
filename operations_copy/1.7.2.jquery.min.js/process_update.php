<?php
session_start();
if(!isset($_SESSION['user']))
echo "<script type='text/javascript'>alert('Sorry You need to login again'); window.location='index.php';</script>";
else
{
include("config.php");
$id=$_POST['id'];
function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}
$alert=mysqli_query($con,"select alert_id,cust_id,atm_id,createdby,bank_name,address,city,mattype,alert_type from alert where alert_id='".$id."'");
		$alertro=mysqli_fetch_row($alert);
		//echo "hi";
		if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!=''){
		$tm=$_POST['time'].":00:00";
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']).":00:00";
 //echo $tm;
 $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
 
 $estm=mysqli_query($con,"Update alert set eta='".$etdt."' where alert_id='".$id."'");
 }
$site="";
//echo $alertro[8];
		if($alertro[8]=='sites')
		$site="select atm_id1 from ".$alertro[1]."_sites where trackerid='".$alertro[2]."'";
		elseif($alertro[8]=='rnmsites')
		$site="select atm_id1 from rnmsites where id='".$alertro[2]."'";
		//echo $site;
		$st=mysqli_query($con,$site);
		$sitero=mysqli_fetch_row($st);
$br2=array();
$br=$_POST['br'];
$up=$_POST['up'];
$cdate = date('Y-m-d H:i:s');
$br1=explode(',',$br);
for($i=0;$i<count($br1);$i++)
{
$br2[]=$br1[$i];
}
//print_r($br2);
$st='';
$br3=implode(',',$br2);
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $up))
{
   $st=str_replace("'","\'",$up);
}
else
 $st=$up;
//echo "Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`) Values('".$id."','".$up."','".$cdate."','".$br3."')";
 $tab=mysqli_query($con,"Insert into alert_updates(`alert_id`,`up`,`update_time`,`branch`,`upby`) Values('".$id."','".$st."','".$cdate."','".$br3."','".$_SESSION['user']."')");
//require_once('class_files/insert.php');
//$in_obj=new insert();
//$tab=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert_updates',array("alert_id","up","update_time","branch"),array($id,$up,$cdate,$br3));
if(!$tab)
echo "failed".mysqli_error();
if($tab)
{
include("config.php");
	if($_POST['email']!="")
	{
	$sub=mysqli_query($con,"select subject,ccmail from quotation where quotid in (select quotdetid from alert where alert_id='".$id."')");
	$subro=mysqli_fetch_row($sub);	
	$tbl="<html>
<head>
<title>Update From CSSINDIA</title>
</head>
<body>
<p>Update for your Request</p><table border='1'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>LOCATION</th><th>CITY</th><th>ISSUE</th><th>STATUS</th></tr>";
//echo "select alert_id,cust_id,atm_id,createdby,bank_name,address,city,mattype,alert_type from alert where alert_id='".$id."'";
		
		$tbl.="<tr><td>".$alertro[3]."</td><td>".$sitero[0]."</td><td>".$alertro[4]."</td><td>".$alertro[5]."</td><td>".$alertro[6]."</td><td>".$alertro[7]."</td><td>".$up."</td></tr>";
		
		$tbl.="</table><br><img src='http://cssmumbai.sarmicrosystems.com/operations/csslogo.jpg'></body></html>";
		$to = $_POST['email'];
			$ccm=implode(",",extract_email_address($subro[1]));
			$subject = $subro[0];
			
			$headers = "From: CSSINDIA\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "Cc: ".$ccm. "\r\n";
			//echo $tbl;
			$message=$tbl;
			
			
		mail($to, $subject, $message, $headers);
	}
	if($_POST['rtime']!='')
	{
	$qrr=mysqli_query($con,"select responsetime from alert where alert_id='".$id."'");
	$rr=mysqli_fetch_row($qrr);
	if($rr[0]=='0000-00-00 00:00:00')
	{
	//echo "Update alert set responsetime='".$_POST['rtime']."' where alert_id='".$id."'";
	$qry=mysqli_query($con,"Update alert set responsetime='".$_POST['rtime']."' where alert_id='".$id."'");
	if($qry)
			{
			header('Location:view_alert.php?atmid='.$sitero[0]);
			
			 }
			 else
			 echo "Failed to set Response Time".mysqli_error();
	}
	else
	header('Location:view_alert.php?atmid='.$sitero[0]);
	
			
	}
	
	
	header('Location:view_alert.php?atmid='.$sitero[0]);


}
}
?>