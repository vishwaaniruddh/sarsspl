<?php
session_start();
include "config.php"; 

$sname=$_POST['sname'];
$contact=$_POST['contact'];
$cname=$_POST['cname'];
$dcn=$_POST['dcn'];
$rd=$_POST['rd'];
$oid=$_POST['oid'];
$loc=$_POST['loc'];
$prid=$_POST['prid'];
$ctid=$_POST['ctid'];
$date = date('Y-m-d H:i:s');


$qryinsert=mysqli_query($con1,"INSERT INTO `order_shipping`(`oid`, `pmode`, `person_name`, `P_contact`, `docate no`, `courier name`, `current_Location`, `dt`,Pid,Cid) VALUES ('".$oid."','".$rd."','".$sname."','".$contact."','".$dcn."','".$cname."','".$loc."','".$date."','".$prid."','".$ctid."')");

//echo "INSERT INTO `order_shipping`(`oid`, `pmode`, `person_name`, `P_contact`, `docate no`, `courier name`, `current_Location`, `dt`) VALUES ('".$oid."','".$rd."','".$sname."','".$contact."','".$dcn."','".$cname."','','".$date."')";
if($qryinsert)
{
    echo 1;
}
else
{
    echo 0;
}

?>