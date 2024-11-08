<?php
session_start();
include("config.php");
$cnt=$_POST['matcnt'];
$mat=array();
$rate=array();
$qty=array();
$curdt=date('Y-m-d H:i:s');
$tot=0;
$stat=0;
$stat2=0;
$sup=$_POST['sup'];
 $quotid=$_POST['quot'];
$memo=str_replace("'","\'",$_POST['memo']);
$dt=date('Y-m-d H:i:s');
 $sup=$_POST['super'];
$log=mysqli_query($con,"Select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);
if($quotid==''){
if($_SESSION['designation']=='11' && $_SESSION['dept']=='4'){
$stat='1';

}
elseif($_SESSION['designation']=='8' && $_SESSION['dept']=='4')
$stat='2';
$str= "INSERT INTO `quotation` (`status`, `quotid`, `quotby`, `cust_id`, `trackerid`,  `description`,`dept`,`sitetype`,`entrydt`,`supervisor`) VALUES ('".$stat."', NULL, '".$logro[0]."', '".$_POST['bank']."', '".$_POST['trackid']."', '".$memo."','".$_POST['department']."','".$_POST['stype']."','".$curdt."','".$sup."')";
//echo $str;
$qry=mysqli_query($con,$str);
$qu=mysqli_query($con,"select max(quotid) from quotation");
$quro=mysqli_fetch_row($qu);
$quotid=$quro[0];
}
$stat=0;
$asst=array();
$mem2='';
$memo=str_replace("'","\'",$_POST['memo']);
for($i=0;$i<$cnt;$i++)
{
if(isset($_POST['material'][$i]) && $_POST['material'][$i]!='')
{

 $mem2.="\n***###Component-".$asst[]=$_POST['asst'][$i];
 $mem2.="\nWork-".$mat[]=$_POST['material'][$i];
$mem2.="\nRate-".$rate[]=$_POST['rate'][$i];
 $mem2.="\nQuantity-".$qty[]=$_POST['qty'][$i];
 $mem2.=" ".$unit[]=$_POST['unit'][$i];
 $tot=$tot+(($_POST['rate'][$i])*($_POST['qty'][$i]));
$stat=$stat+1;
}
}
$mem2.="\nTotal-".$tot;
if($_SESSION['designation']>'8')
$memo=$memo." ".$mem2;
//echo "<br>";
//echo $memo;
if($stat>0)
{
//$quotid=$_POST['quot'];
$sub=str_replace("'","\'",$_POST['subject']);

for($i=0;$i<$stat;$i++)
{
//echo "INSERT INTO `quot_details` (`quotdetid`, `quotid`, `material`, `qty`, `unit`, `rate`,`component`) VALUES (NULL, '".$quotid."', '".$mat[$i]."', '".$qty[$i]."', '".$unit[$i]."', '".$rate[$i]."','".$_POST['asst'][$i]."')";
$qry=mysqli_query($con,"INSERT INTO `quot_details` (`quotdetid`, `quotid`, `material`, `qty`, `unit`, `rate`,`component`) VALUES (NULL, '".$quotid."', '".$mat[$i]."', '".$qty[$i]."', '".$unit[$i]."', '".$rate[$i]."','".$asst[$i]."')");
}
 $rem= "INSERT INTO `quotapproval` (`appid`, `quotid`, `appby`, `apptime`, `remarks`, `level`, `status`) VALUES (NULL, '".$quotid."', '".$_SESSION['user']."', '".$curdt."', '".$memo."', '20', '0')";
$ins2=mysqli_query($con,$rem);

//echo "Update quotation set subject='".$sub."',type='".$_POST['type']."',status='20',totalcost='".$tot."',materialcnt='".$stat."',mailperson='".$_POST['authn']."' where quotid='".$quotid."'";
$ins=mysqli_query($con,"Update quotation set subject='".$sub."',type='".$_POST['type']."',status='20',totalcost='".$tot."',materialcnt='".$stat."',mailperson='".$_POST['authn']."',`reqamt`='".$tot."' where quotid='".$quotid."'");
if($ins)
$str="Data Entered Successfully";
}
else
$str="No Material was Entered";

echo "<script type='text/javascript'>alert('Quote created successfully');window.location='viewquot2.php'</script>";
//header('location:viewquot.php');

?>