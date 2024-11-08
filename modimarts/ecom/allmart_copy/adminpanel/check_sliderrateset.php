<?php
session_start();
include('config.php');
//include('access.php');

$errors=0;
$sliderid=$_POST["sliderid"];

$begin = new DateTime($_POST["fromdt"]);
$interval=new DateInterval('P1D');
$end = new DateTime($_POST["todt"]);
$end ->add($interval);
$daterange = new DatePeriod($begin, $interval, $end);

$dtavail=array();
$dtsnotavail=array();
foreach($daterange as $date)
{
   $daterange=$date->format("Y-m-d");
   
  // echo $daterange."</br>";
   
   $dtavail[]=$date->format("d-m-Y");
 /*  

$gtbkid=mysql_query("select * from advertise_booking where dt='".$daterange."' and slot='".$sliderid."'");
if($nrtys=mysql_num_rows($gtbkid)==0)
{
    
    $dtavail[]=$date->format("d-m-Y");
}
else
{
    
    $dtsnotavail[]=$date->format("d-m-Y");
}

*/
}


$data = ['dtsv'=>join(",",$dtavail),'dtsnotavai'=>join(",",$dtsnotavail)];

echo json_encode($data);

?>