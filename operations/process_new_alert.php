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
$sup=$_POST['super'];

$error=0;


if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!='')
{
 $tm=$_POST['time'].":00:00";
 if($_POST['meri']=='pm')

 $tm=(12+$_POST['time']).":00:00";
 //echo $tm;
 $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
 }

$trst=0;
if($_POST['super']=="")
{
$trst=1;

}

$etdt="0000-00-00 00:00:00";
if(isset($_POST['est']) && $_POST['est']!='' && isset($_POST['time']) && $_POST['time']!=''){
 $tm=$_POST['time'].":00:00";
 if($_POST['meri']=='pm')
 $tm=(12+$_POST['time']).":00:00";
 //echo $tm;
 $etdt=date("Y-m-d $tm",strtotime(str_replace("/","-",$_POST['est'])));
 }


$sdt1=str_replace("/","-",$_POST['aldt']);
$alertdt=date("Y-m-d",strtotime($sdt1));

$log=mysqli_query($con,"Select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);



$doct=mysqli_query($con,"select count(alertid) from alert_detail where alert_date='".$alertdt."'");
$doctro=mysqli_fetch_row($doct);
$docketno='';
if(mysqli_num_rows($doct)=='0')
$docketno=$logro[0]."_".date('dmY')."1";
else
$docketno=$logro[0]."_".date('dmY')."".($doctro[0]+1);





for($i=0;$i<$cnt;$i++)
{


$str= "INSERT INTO `alert_detail`(`cust_id`, `atmid`, `bank`, `css_area`, `csslocalbranch`, `state`, `address`, `city`, `contact_no`, `mailperson`, `email`, `ccmail`, `supervisor`, `subject`, `remark`, `type`, `materialcnt`, `delegate_status`, `transfer_to_status`, `entrydt`,priority,deadline,complaint_id,reqby,alert_date)values('".$_POST['bank']."','".$_POST['atmid']."','".$_POST['bk']."','".$_POST['cssarea1']."','".$_POST['csslocalbr']."','".$_POST['state']."','".$_POST['address']."','".$_POST['city']."','".$_POST['connum']."','".$_POST['authn']."','".$_POST['email']."','".$_POST['ccmail']."','".$_POST['super']."','".$_POST['subject']."','".$_POST['rem']."','".$_POST['type']."','".$cnt."','0','".$trst."','".$curdt."','".$_POST['prio']."','".$etdt."','".$docketno."','".$logro[0]."','".$alertdt."')";

mysqli_query($con,'BEGIN');
$insqry=mysqli_query($con,$str);
$alid=mysqli_insert_id();
if(!$insqry)
{

$error++;
}



if($_POST['asst'][$i]!="")
{
$str2="insert into quot_details( `alertid`, `material`, `status`, `component`, `now`, `remark`, `docno`)values('".$alid."','".$_POST['material'][$i]."',0,'".$_POST['asst'][$i]."','".$_POST['now'][$i]."','".$_POST['memo'][$i]."','".$_POST['docno'][$i]."')";
$insqry2=mysqli_query($con,$str2);

if(!$insqry2)
{

$error++;
}
}



}



if($error==0)
{

mysqli_query($con,'COMMIT');
/*
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
		mail($to, $subject, $message, $headers);*/







?>
<script>alert("Call Logged Successfully");</script>
<script>window.open('servicecall.php','_self');</script>

<?php
}

else
{
mysqli_query($con,'ROLLBACK');
?>
<script>alert("Error");</script>
<script>window.open('servicecall.php','_self');</script>

<?php
}

}

?>