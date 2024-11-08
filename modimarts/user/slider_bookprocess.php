<?php
session_start();
include('config.php');

$errors=0;

$obj2 = json_decode($_POST["myJSON"], true );

//var_dump($obj2);

$availabledates=$obj2["avldts"];

$sliderid=$obj2["sliderid"];
$slotpos=$obj2["slotpos"];
$amt=$obj2["amt"];
$rate=$obj2["rate"];

$frmd=date("Y-m-d",strtotime($obj2["fromdt"]));
$tod=date("Y-m-d",strtotime($obj2["todt"]));

mysqli_begin_transaction($con1);

/* Ruchi 
$ins=mysqli_query($con1,"INSERT INTO `advertise_booking_dets`(`merchant_id`, `fromdt`, `todt`, `entrydt`)values('".$_SESSION['id']."','".$frmd."','".$frmd."','".date("Y-m-d H:i:s")."')");*/
$ins=mysqli_query($con1,"INSERT INTO `advertise_booking_dets`(`merchant_id`, `fromdt`, `todt`, `entrydt`)values('".$_SESSION['id']."','".$frmd."','".$tod."','".date("Y-m-d H:i:s")."')");

if(!$ins)
{
 $errors++;   
}
$insid=mysqli_insert_id($con1);
for($a=0;$a<count($availabledates);$a++)
{
    $dtt=date("Y-m-d",strtotime($availabledates[$a]));
   
    $ins=mysqli_query($con1,"INSERT INTO `advertise_booking`( `merchant_id`, `dt`, `slot`, `slot_pos`, `rate`,booking_id) values('".$_SESSION['id']."','".$dtt."','".$sliderid."','".$slotpos."','".$rate[$a]."','".$insid."')");
   
    if(!$ins)
    {
       $errors++; 
    }
}

if($errors==0)
{
    
    mysqli_commit($con1);
    echo 1;
    
}else
{
    
    mysqli_rollback($con1);
    echo 2;
    
}
?>