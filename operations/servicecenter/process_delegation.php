<?php
include_once('class_files/insert.php');

$req=$_GET['req'];
$eng=$_GET['eng'];
$atm=$_GET['atm'];

$ins=new insert();
$tab=$ins->insert_into('localhost','site','site','atm_site','alert_delegation',array("engineer","atm","alert_id"),array($eng,$atm,$req));

/*include('config.php');
$sql=mysql_query("update alert set status='Delegated' where alert_id='$req'");*/

include_once('class_files/update.php');
$up=new update();
$tab1=$up->update_table('localhost','site','site','atm_site','alert',array("status"),array("Delegated"),"alert_id",$req);

if($tab && $tab1)
{
	header('Location:view_alert.php');
}
else
echo "Error Creating Delegation";

?>