<?php
session_start();
include "config.php"; 


 $id=$_POST['id'];
$chk=$_POST['chkid'];
$txt=$_POST['txt'];
$ab="";

echo "hjfkrfdsk".$chk;
if($chk=="true")
{
$ab="R";


$qryupdt=mysqli_query($con1,"update order_details set `rejected_qty`='".$txt."',`status`='".$ab."' WHERE id='".$id."'");

//echo "update order_details set `rejected_qty`='".$txt."',`status`='".$ab."' WHERE id='".$id."'";
}
else
{
$ab="C";
$qryupdt=mysqli_query($con1,"update order_details set `rejected_qty`='0',`status`='".$ab."' WHERE id='".$id."'");
}
//echo "update order_details set `rejected_qty`='".$txt."',`status`='".$ab."' WHERE id='".$id."'";


?>