<?php
 $alert=$_POST['alert'];
$eng_id=$_POST['eng_id'];
$feed=$_POST['feed'];
if(isset($_POST['stand']))
$stand=$_POST['stand'];
else
$stand='';
$st='';
if (preg_match('/[\'^�$%&*()}{@#~?><>,|=_+�-]/', $feed))
{
   $st=str_replace("'","\'",$feed);
}
else
$st=$feed;

include('config.php');
$sql=mysqli_query($con,"Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`standby`) Values('".$eng_id."','".$alert."','".$st."','".$stand."')");
if(isset($_POST['callclose'])){
$tab1=mysqli_query($con,"update alert set status='3', standby='".$stand."' where alert_id='".$alert."'");
if(!$tab1)
echo "failed".mysqli_error();}
if($sql)
{
	header('Location:eng_alert.php');
}
else
echo "Error Updating Alert";
?>