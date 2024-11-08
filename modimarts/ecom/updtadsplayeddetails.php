<?php
    session_start();
    include('config.php');
    $updqr=mysqli_query($con1,"INSERT INTO `ads_playdetails`(`ad_id`, `user_id`, `play_dtym`) VALUES('".$_POST['adid']."','".$_SESSION['gid']."','".date("Y-m-d H:i:s")."')");
    if(!$updqr)
    {
        echo 0;
    }else
    {
        echo 1;
    }
?>