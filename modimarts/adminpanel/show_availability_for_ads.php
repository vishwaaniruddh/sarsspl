<?php
session_start();

//$tyms and total seconds of a slot is set in config.php

include('config.php');
//include('access.php');

$id=$_POST['id'];
$errors=0;
//print_r($_POST["durationv"]);
$durationn=$_POST["durationv"];

$duration=array_sum($durationn);

$name=$_POST["namearr"];
$desc=$_POST["descarr"];
$fdt=$_POST["rdate"];
$tdt=$_POST["tdate"];
$begin = new DateTime($fdt);
$interval=new DateInterval('P1D');
$end = new DateTime($tdt);
$end ->add($interval);
$daterange = new DatePeriod($begin, $interval, $end);

$dtsavail=array();

$dtsavailreqcnt=array();
$alldts=array();
$dtsnotavail=array();
$dtsavailtym=array();
$ratearr=array();
$dureacharr=array();
$finalamta=0;
//echo "test";
foreach($daterange as $date)
{
   $daterange=$date->format("Y-m-d");


$alldts[]=$date->format("d-m-Y");
$qr=mysql_query("select * from Date_duration where date='".$daterange."' and stats=0");
$nr=mysql_num_rows($qr);
if($nr>0)
{
  
$fr=mysql_fetch_array($qr);

$remainigtym=$adstotaltym-$fr["total_duration"];
$reqdur=$tyms*$duration;
//echo $remainigtym."---".$reqdur;
if($duration<=$remainigtym)
{
    
     $gettotalslots=mysql_query("select * from slot_details_ofdt where date='".$daterange."' order by id desc");
     $chkislot=mysql_num_rows($gettotalslots);//---------check if rate is set for the date---//
    
     $frss=mysql_fetch_array($gettotalslots);

        $ratepersec=$frss["slot_rate"];//----rate per second--------//
        $dtsavail[]=$date->format("d-m-Y");
        $cnc=$ratepersec*$reqdur;
        $totmtarr[]=$cnc;
        $ratearr[]=$ratepersec;
        $finalamta=$finalamta+$cnc;
        $dtsavailtym[]=$remainigtym;
        $dureacharr[]=$reqdur;
    
}else
{
    
    $dtsnotavail[]=$date->format("d-m-Y");  
}






}else
{
    
    $gettotalslots=mysql_query("select * from slot_details_ofdt where date='".$daterange."' order by id desc");
$chkislot=mysql_num_rows($gettotalslots);//---------check if rate is set for the date---//
    if($chkislot>0)
   {
       $reqdur=$tyms*$duration;

     $frss=mysql_fetch_array($gettotalslots);

        $ratepersec=$frss["slot_rate"];//----rate per second--------//
        $dtsavail[]=$date->format("d-m-Y");
        $cnc=$ratepersec*$reqdur;
        $totmtarr[]=$cnc;
        $ratearr[]=$ratepersec;
        $finalamta=$finalamta+$cnc;
       $dtsavailtym[]=$adstotaltym;
       $dureacharr[]=$reqdur;
    }
    else
    {
      $dtsnotavail[]=$date->format("d-m-Y");  
        
    }
    
}
}
//if()

$data = ['dtsavail' =>$dtsavail,'dtsavailtym' => $dtsavailtym,'dtsnotavail'=>$dtsnotavail,'alldts'=>$alldts,'dtsavailreqcnt'=>$dtsavailreqcnt,'rated'=>$ratearr,'totarr'=>$totmtarr,'totamt'=>$finalamta,'dureacharr'=>$dureacharr,duration=>$duration,tyms=>$tyms];

echo json_encode($data);

//print_r($dtsavaicount);

?>