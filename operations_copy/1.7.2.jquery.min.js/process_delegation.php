<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

if(isset($_POST['delegate']))
{

 $req=$_POST['req'];
 $eng=$_POST['eng'];
 $atm=$_POST['atm'];
 $br=$_POST['br'];
$dt=date("Y-m-d H:i:s");
if($eng=='0'){
echo "<script type='text/javascript'>alert('No Person was selected to delegate this call');window.location='view_alert.php';</script>>";
}
else{
include('config.php');
$tab=mysqli_query($con,"update alert set status='2' where alert_id='$req'");
$tab2=mysqli_query($con,"Insert into alert_delegation(engineer,atm,alert_id,entrydt) Values('".$eng."','".$atm."','".$req."','".$dt."')");
include_once('class_files/update.php');

if($tab && $tab2)
{
	header('Location:view_alert.php');
}
else
echo "Error Creating Delegation";
}
}
?>