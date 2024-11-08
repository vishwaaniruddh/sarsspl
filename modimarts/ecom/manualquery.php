<?php
session_start();
include('config.php');

for($a=0;$a<3;$a++)
{
    $gtqrs=mysqli_query($con1,"select * from ads_slot_booked_details limit 0,1");
    
    while($fr=mysqli_fetch_array($gtqrs))
    {
    
   // echo $a."</br>";
    $qr=mysqli_query($con1,"INSERT INTO `ads_slot_booked_details`(`video_id`, `slot_booked`, `date_duration_id`, `slot_rate`, `total_amt`)values('".$fr["video_id"]."','".$fr["slot_booked"]."','".$fr["date_duration_id"]."','".$fr["slot_rate"]."','".$fr["total_amt"]."')");
    if(!$qr)
    {
        
        echo mysqli_error();
    }
    }
    
}

?>