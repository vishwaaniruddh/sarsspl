<?php 
include 'config.php';
$id=$_POST['ids'];
date_default_timezone_set('Asia/Kolkata');
$time=date("h:i:s");
$from=$_POST['fdate'];
$sdate=str_replace("/","-",$from);
if($from!="")
            {
            //$newDate = date_format($date,"y/m/d H:i:s");
            $fromdt = date('Y-m-d', strtotime($sdate));
            
           
            }
            
    $sql="update surveilance_sites set handover='".$fromdt.' '.$time."',live='N' where SN='$id'";
    $runsql=mysqli_query($con,$sql);
    
    if($runsql){
        echo '1';
    }
            ?>