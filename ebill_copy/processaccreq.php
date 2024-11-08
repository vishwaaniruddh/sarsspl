<?php
session_start();
if(!$_SESSION['user']){
header('location:index.php');
}
else{
include("config.php");
if(isset($_POST['cmdsub']))
{
if($_POST['sv']=='-1')
echo "<script type='text/javascript'>alert('No Account Selected');window.location='onaccreq.php';</script>";
else
{




       $dt1=str_replace("/","-",$_POST['dt']);
	$start=date('Y-m-d', strtotime($dt1));
       $tym = date("H:i:s"); 
	$dt=date('Y-m-d H:i:s',strtotime($start.$tym));





$memo=str_replace("'","\'",$_POST['memo']);
$srno=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$sr=mysqli_fetch_row($srno);
$qry=mysqli_query($con,"INSERT INTO `onacctransfer` (`reqid`, `aid`, `amount`, `reqstatus`, `reqby`,`memo`,`entrydt`,approvedamt) VALUES (NULL, '".$_POST['sv']."', '".$_POST['amt']."', '7', '".$sr[0]."','".$memo."','".$dt."','".$_POST['amt']."')");
if(!$qry)
echo mysqli_error();
if($qry)
{
?>
<script type="text/javascript">
alert("Request Created Successfully");
window.location="onaccreq.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert("Some Error Occurred");
window.location="onaccreq.php";
</script>
<?php
}
}
}
else
header('location:onaccreq.php');
}
?>