<?php

include("access.php");

include("config.php");

if(isset($_POST['submit']))

{
mysqli_
$banmysqli_ST['bank'];

$amt=mysqli_['amount'];

$dept=$_POST['dept'];

$memo=str_replace("'","\'",$_POST['memo']);

$srno=mysql_query("select srno from login where username='".$_SESSION['user']."'");

$sr=mysql_fetch_row($srno);

//echo "INSERT INTO `fundrequest` (`reqid`, `claimedamt`, `approvedamt`, `memo`, `bank`, `dept`,`requestby`, `branchid`, `status`) VALUES (NULL, '".$amt."', '0', '".$memo."', '".$bank."','".$_POST['department']."', '".$_SESSION['user']."', '".$_SESSION['branch']."', '1')";

$qry=mysql_query("INSERT INTO `fundrequest` (`reqid`, `claimedamt`, `approvedamt`, `memo`, `bank`, `dept`,`requestby`, `branchid`, `status`) VALUES (NULL, '".$amt."', '0', '".$memo."', '".$bank."','".$_POST['department']."', '".$sr[0]."', '".$_SESSION['branch']."', '1')");

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