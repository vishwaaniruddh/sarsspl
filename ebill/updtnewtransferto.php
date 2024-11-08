<?php
session_start();
include("config.php");
include("access.php");

if(isset($_SESSION['user']) & $_SESSION['user']!="")
{

$insqr=mysqli_query($con,"INSERT INTO `newtransferto_supv`(`req_no`, `old_supvid`, `new_supvid`, `updtby`, `updt_dt`) VALUES('".$_POST["reqno"]."','".$_POST["supvorg"]."','".$_POST["sv"]."','".$_SESSION['user']."','".date('Y-m-d H:i:s')."') ");

    if($insqr)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
}
else
{
    
    echo 2;
}
?>