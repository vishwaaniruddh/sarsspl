<?php
session_start();
if(isset($_SESSION['id']) & $_SESSION['id']!="")
{
include('config.php');

$insqr=mysqli_query($con1,"insert into advertise_booking( `slot`, `merchant_id`, `fromdate`, `todate`)values('".$_POST['slotid']."','".$_SESSION['id']."','".date("Y-m-d",strtotime($_POST['dt1']))."','".date("Y-m-d",strtotime($_POST['dt2']))."')");
//echo "insert into advertise_booking( `slot`, `merchant_id`, `fromdate`, `todate`)values('".$_POST['slotid']."','".$_SESSION['id']."','".$_POST['dt1']."','".$_POST['dt2']."')";

    if($insqr)
    {
        echo 1;
    }else
    {
        echo 0;
    }
    
}
else
{
    
    echo 50;
}
?>