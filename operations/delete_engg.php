<?php
$id=$_GET['id'];
include("config.php");
$qry=mysqli_query($con,"select loginid from area_engg where engg_id='".$id."'");
$row=mysqli_fetch_row($qry);
/*require_once('class_files/delete.php');
$del=new delete();
$del->delete_from('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','area_engg','engg_id',$id);

if($del)
{
	header('Location:view_areaeng.php');
}*/
$qry3=mysqli_query($con,"Update area_engg set status='0', deleted='1' where engg_id='".$id."'");
$qry2=mysqli_query($con,"Update login set status=2 where srno='".$row[0]."'");
if($qry3 && $qry3)
header("location:view_areaeng.php");
else
echo "Error Deleting Engineer";

?>