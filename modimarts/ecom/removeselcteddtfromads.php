<?php
session_start();
include 'config.php';
$stss=0;

if($_SESSION["id"]!="")
{
    
    
 
    
    $qr=mysqli_query($con1,"delete from ads_sec_booked where id='".$_POST["selid"]."' and randomtymstmp='".$_POST["tymstmp"]."' and user_id='".$_SESSION["id"]."'");
    if(!$qr)
    {
        
        
        echo 2;
        
    }else
    {
        
        echo 1;
    }

}else
{
    
    
    echo 10;
}