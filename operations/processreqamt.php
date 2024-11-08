<?php
include("access.php");
include("config.php");
if(isset($_POST['submit']))
{
$bank=$_POST['bank'];
$amt=$_POST['amount'];
//$dept=$_POST['dept'];
$memo=str_replace("'","\'",$_POST['memo']);
$srno=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$sr=mysqli_fetch_row($srno);
//echo "INSERT INTO `fundrequest` (`reqid`, `claimedamt`, `approvedamt`, `memo`, `bank`, `dept`,`requestby`, `branchid`, `status`) VALUES (NULL, '".$amt."', '0', '".$memo."', '".$bank."','".$_POST['department']."', '".$_SESSION['user']."', '".$_SESSION['branch']."', '1')";
$qry=mysqli_query($con,"INSERT INTO `fundrequest` (`reqid`, `claimedamt`, `approvedamt`, `memo`, `bank`, `dept`,`requestby`, `branchid`, `status`,`entrydt`) VALUES (NULL, '".$amt."', '0', '".$memo."', '".$bank."','".$_POST['department']."', '".$sr[0]."', '".$_SESSION['branch']."', '3',Now())");
if($qry)
{
$_SESSION['success']="ok";
header('location:requestamt.php');
}
else
{
$_SESSION['error']="notok";
header('location:requestamt.php');
}
}
?>