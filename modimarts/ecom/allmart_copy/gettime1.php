<?php
include("config.php");
date_default_timezone_set('Asia/Kolkata');
$stats=$_POST['stats'];
$dtn=date('Y-m-d');
$tym=date('H:i:s');

function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

$arr=array();
$qr34=mysqli_query($con1,"select * from ad_booking_details where frmdt>='".$dtn."' or todt>='".$dtn."' and stats=1 order by id ");
$nrws34r=mysqli_num_rows($qr34);
if($nrws34r>0)
{
while($nrws34=mysqli_fetch_array($qr34))
{
if(check_in_range($nrws34["frmdt"],$nrws34["todt"],$dtn))
{
    //echo $nrws34["id"]; 
$arr[]=$nrws34["id"];    
}


}
    
}

//print_r($arr);
echo json_encode($arr);
?>