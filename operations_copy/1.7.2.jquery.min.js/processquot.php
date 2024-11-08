<?php
session_start();
if(!$_SESSION['user'])
{
header('location:index.php');
}
else{
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
include("config.php");
$memo=str_replace("'","\'",$_POST['memo']);
$dt=date('Y-m-d H:i:s');
 $sup=$_POST['super'];
$log=mysqli_query($con,"Select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);
$stat=0;
if($_SESSION['designation']=='11' && $_SESSION['dept']=='4')
$stat='1';
elseif($_SESSION['designation']=='8' && $_SESSION['dept']=='4')
$stat='2';
$str= "INSERT INTO `quotation` (`status`, `quotid`, `quotby`, `cust_id`, `trackerid`,  `description`,`dept`,`sitetype`,`entrydt`,`supervisor`) VALUES ('".$stat."', NULL, '".$logro[0]."', '".$_POST['cust']."', '".$_POST['trackid']."', '".$memo."','".$_POST['department']."','".$_POST['stype']."','".$dt."','".$sup."')";
//echo $str;
$qry=mysqli_query($con,$str);
$stat='';
if($qry)
{
$stat=="Quotation Created Successfully";;
//$_SESSION['success']
//header('location:requestquot.php');
//header('location:viewquot.php');
}
else
{
$stat="Failed to create Quotation".mysqli_error();

//header('location:requestquot.php');
}
echo "<script type='text/javascript'>alert('".$stat."');window.location='requestquot.php'</script>";
 //header('location:requestquot.php');
}
?>