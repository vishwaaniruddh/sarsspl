<?php
session_start();
include('config.php');
echo "delete from user_address where id='".$_POST['id']."'";
//$getdts=mysql_query("delete from user_address where id='".$_POST['id']."'");
if($getdts)
{

echo 1;

    
}else
{

echo 0;

}
?>