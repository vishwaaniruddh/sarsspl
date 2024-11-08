<?php
session_start();
include 'config.php';
$stss=0;

if($_SESSION["id"]!="")
{
    
    
    $getfrtempselct=mysqli_query($con1,"select id from ads_sec_booked where stats=0 and  randomtymstmp='".$_POST["tymstmp"]."' and rowid='".$_POST["rowid"]."'  and user_id='".$_SESSION["id"]."'");
if($nr=mysqli_num_rows($getfrtempselct)>0)
{
    
    $qr=mysqli_query($con1,"delete from ads_sec_booked where rowid='".$_POST["rowid"]."' and randomtymstmp='".$_POST["tymstmp"]."' and user_id='".$_SESSION["id"]."'");
    if(!$qr) 
    {
        
        
        echo 2;
        
    }else
    {
        
        echo 1;
    }
}else
{
    echo 1;
}
    
}else
{
    
    
    echo 10;
}