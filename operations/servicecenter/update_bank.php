<?php
$name=$_POST['name'];
$id=$_POST['id'];
require_once('class_files/update.php');
$update=new update();
$update->update_table('localhost','site','site','atm_site','bank','bank_name',$name,'bank_id',$id);

if($update)
{
	header('Location:view_bank.php');
}
else
echo "Error Creating Bank";
?>