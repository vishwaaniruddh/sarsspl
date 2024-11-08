<?php
session_start();
include('config.php');
$id=$_POST['j'];

$qry=mysql_query("select slot_pos from advertise_booking where slot='".$id."'  ");
 $data = array();
while($fetch=mysql_fetch_array($qry))
{
     $data[]=$fetch[0];
    //echo $fetch[0];
}
echo $cat= implode(",",$data);

?>