<?php
include("config.php");
$id=$_GET['id'];
$stat=$_GET['stat'];
//echo "Update Handoverform set status='".$stat."' where id='".$id."'";
$qry=mysqli_query($con,"Update Handoverform set status='".$stat."' where id='".$id."'");
if($stat=='2')
{
//echo "select handover_date,trackerid,customer from Handoverform where id='".$id."'";
$qr=mysqli_query($con,"select handover_date,trackerid,customer from Handoverform where id='".$id."'");
$qrro=mysqli_fetch_row($qr);
//echo "Update ".$qrro[2]."_sites set active='N', handover_date='".$qrro[0]."' where trackerid='".$qrro[1]."'";
$up=mysqli_query($con,"Update ".$qrro[2]."_sites set active='N', handover_date='".$qrro[0]."' where trackerid='".$qrro[1]."'");
}
if($qry)
echo "1";
else
echo "0";
?>