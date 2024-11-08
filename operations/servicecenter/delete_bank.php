<?php
$id=$_GET['id'];
require_once('class_files/delete.php');
$del=new delete();
$del->delete_from('localhost','site','site','atm_site','bank','bank_id',$id);

if($del)
{
	header('Location:view_bank.php');
}
else
echo "Error Deleting Bank";

?>