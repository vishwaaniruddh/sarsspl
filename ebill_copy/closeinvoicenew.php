<?php 
include("config.php");
include("access.php");



$sndid=$_POST['sendid'];
$yr=$_POST['yr'];

//echo $sndid;
$updqry=mysqli_query($con,"update send_bill set open='1',date='".date('Y-m-d')."',entrydt='".date('Y-m-d H:i:s')."' where send_id='".$sndid."' and fiscalyr='".$yr."'");
//echo "update send_bill set open='1' where send_id='".$sndid."' and fiscalyr='".$yr."'";
if($updqry)
{
echo "Updated";
}
else
{

echo "Error";
}
//echo "ok";
?>