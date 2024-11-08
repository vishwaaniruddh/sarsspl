<?php 
include("config.php");
$dt1=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt1'])));
$dt2=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt2'])));


function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

$exs=0;

$qr=mysqli_query($con1,"select * from ad_booking_details where frmdt>=now() and todt>=now()");
while($rws=mysqli_fetch_array($qr))
{
    
if(check_in_range($rws[2], $rws[3],$dt1))
{
$exs=1;
}


if(check_in_range($rws[2], $rws[3],$dt2))
{

$exs=1;  
}

    
}

echo $exs;
?>