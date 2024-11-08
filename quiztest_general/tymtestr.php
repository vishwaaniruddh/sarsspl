<?php
include("config.php");


$sumTime="";

$qr=mysqli_query($con,"select tym_taken from  quiztest_qids_details where test_id='40'");
while($fr=mysqli_fetch_array($qr))
{
 
    $sumTime = $sumTime+$fr[0];
}

echo "tot".$sumTime;
    $hours = $sumTime / 3600;
    $minutes = ($sumTime % 3600) / 60;

    echo $hours.$minutes; // Outputs: 23:45
    
    
 $date = '2007-05-14';
 $datetime = strtotime("$date 00:00:00");
 
//    These are examples; you'll probably want to pull your numbers from the DB.
 $times = array(
    '01:15:45',
    '03:11:02',
    '10:15:45'
);
 
 $sum = 0;
foreach($times as $time) {
    $sum += strtotime("$date $time") - $datetime;
}
 
//    $sum holds the total number of seconds of all three times.
print($sum);
    
    ?>
