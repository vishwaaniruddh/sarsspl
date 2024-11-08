<?php
include("config.php");
$err=0;

$fdt=$_POST["fromdt"];

$tdt=$_POST["todt"];

$begin = new DateTime($fdt);
$interval=new DateInterval('P1D');
$end = new DateTime($tdt);
$end ->add($interval);
$daterange = new DatePeriod($begin, $interval, $end);
//$i=0;
    
    $dtar=array();
foreach($daterange as $date){
   
    
  $daterange=$date->format("Y-m-d");
  
  //echo $daterange;
  
  $qrc=mysql_query("select * from Date_duration where Date='".$daterange."'");
  $nre=mysql_num_rows($qrc);
  
  if($nre>0)
  {
      
      
     $dtar[]=$date->format("d-m-Y");
  }

}

$st="1";
$dts="";
if(count($dtar)>0)
{
    
$st="0"; 
$dts=implode( ", ", $dtar );
}
else
{
  $st="1";
    $dts="";
    
}

 $data = ['sts' =>$st,'dts' => $dts];

echo json_encode($data);

?>