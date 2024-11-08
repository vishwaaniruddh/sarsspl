<?php
include("config.php");
$id=$_GET['id'];
$stat=$_GET[stat];
$quotid=$_GET['quotid'];
//echo $id." ".$stat;
$rt=mysqli_query($con,"select qty,rate from quot_details where quotdetid='".$id."'");
$rtr=mysqli_fetch_row($rt);
$val=$rtr[0]*$rtr[1];
//echo "update quotation set totalcost=(totalcost-".$val."),materialcnt=(materialcnt-1) where quotid='".$quotid."'";
$up=mysqli_query($con,"update quotation set totalcost=(totalcost-".$val."),materialcnt=(materialcnt-1) where quotid='".$quotid."'");
if($up){
$qry=mysqli_query($con,"update quot_details set status='".$stat."' where quotdetid='".$id."'");
$up2=mysqli_query($con,"update alert set call_status=0 where quotdetid='".$id."'");
if($qry)
echo "1";
else
echo "0";
}
else
echo "0";
?>