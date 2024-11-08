<?php 
include("config.php");
$id=$_POST['id'];

$chage=$_POST['charges'];
$old_amt=$_POST['old_amt'];
$user=$_POST['user'];
$cur_date=date('Y-m-d H:i:sa');

$res=mysqli_query($con,"update `ebillcharges` set `Charges`='".$chage."' where `auto_id`='".$id."'");

if($res){
$res2=mysqli_query($con,"INSERT INTO `ebillcharges_updatedby`(`updated_by`, `up_date`, `old_amt`,`up_id`) VALUES ('".$user."','".$cur_date."','".$old_amt."','".$id."') ");
}

if($res2){

header("Location: http://cssmumbai.sarmicrosystems.com/ebill/edit_servicecharge.php");
}

?>