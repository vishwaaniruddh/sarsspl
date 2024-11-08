<?php
session_start();
include('config.php');
//include('access.php');

$id=$_POST['id'];
$errors=0;

$duration=$_POST["duration"];
$name=$_POST["namearr"];
$desc=$_POST["descarr"];
$fdt=$_POST["fromdt"];
$tdt=$_POST["todt"];

$begin = new DateTime($fdt);
$interval=new DateInterval('P1D');
$end = new DateTime($tdt);
$end ->add($interval);
$daterange = new DatePeriod($begin, $interval, $end);

$dtsavail=array();

$dtsavailreqcnt=array();
$alldts=array();
$dtsnotavail=array();
$dtsavaicount=array();
$ratearr=array();
$dureacharr=array();
$finalamta=0;
//echo "test";
foreach($daterange as $date)
{
   $daterange=$date->format("Y-m-d");


$alldts[]=$date->format("d-m-Y");
$qr=mysql_query("select id,Date from Date_duration where date='".$daterange."' and stats=0");
$nr=mysql_num_rows($qr);
if($nr>0)
{
  
$fr=mysql_fetch_array($qr);

//echo "select * from slot_details_ofdt where date='".$daterange."'";
$gettotalslots=mysql_query("select * from slot_details_ofdt where date='".$daterange."'");
$chkislot=mysql_num_rows($gettotalslots);//---------check is slot is set for the date
//echo mysql_error();
if($chkislot>0)
{
    //echo "ok";
$frss=mysql_fetch_array($gettotalslots);
//echo mysql_error();
$totalslots=$frss["slot_type"];//----total slots for that date--------//


//----get price of slot------//

 $calcmt=mysql_query("SELECT * FROM `ads_slot_amount` where slot_type='".$totalslots."' order by id desc");
    
    $frc=mysql_fetch_array($calcmt);
    
    $rate=$frc["amount"];
    

//----get price of end------//


$durationofeachslot=(3600/$frss["slot_type"]);//----duration of each slots for that date--------//
//echo "of each".$durationofeachslot;
$slotsreq=0;
$durtnn=$durationofeachslot;

//echo "post".$durtnn;
$brksts=0;
while($brksts==0)
    
{
    if(floatval($duration)<=floatval($durtnn))
    {
       $slotsreq++; 
       $brksts=1;
    }
   // echo "okt";
    else
    {
        
         $durtnn=$durtnn+$durationofeachslot;
   $slotsreq++;
    }
   
   //$slotsreq;
}

//echo   "slot req".$slotsreq;  

    $qr=mysql_query("select sum(slot_booked) from ads_slot_booked_details where date_duration_id='".$fr["id"]."'");
    
    $fr=mysql_fetch_array($qr);
    
    if($fr[0]<$totalslots)
    {
    
    $chkfs=$fr[0]+$slotsreq;
    
    
    if($chkfs<=$totalslots)
    {
        
        $dtsavail[]=$date->format("d-m-Y");
        $dtsavaicount[]=$totalslots-$fr[0];
        $dtsavailreqcnt[]=$slotsreq;
        $cnc=$frc["amount"]*$slotsreq;
         $totmtarr[]=$cnc;
        $ratearr[]=$frc["amount"];
        $finalamta=$finalamta+$cnc;
        $dureacharr[]=$durationofeachslot;
    }
    
        
    }else
    {
        
         $dtsnotavail[]=$date->format("d-m-Y");
    }

}//---------check is slot is set for the date end
else
{
    
  $dtsnotavail[]=$date->format("d-m-Y");  
}

}else
{
  $gettotalslots=mysql_query("select * from slot_details_ofdt where date='".$daterange."'");
$chkislot=mysql_num_rows($gettotalslots);//---------check is slot is set for the date
 if($chkislot>0)
{
$frss=mysql_fetch_array($gettotalslots);

$totalslots=$frss["slot_type"];//----total slots for that date--------//


//----get price of slot------//

 $calcmt=mysql_query("SELECT * FROM `ads_slot_amount` where slot_type='".$totalslots."' order by id desc");
    
    $frc=mysql_fetch_array($calcmt);
    
    $rate=$frc["amount"];
    

//----get price of end------//



$durationofeachslot=(3600/$frss["slot_type"]);//----duration of each slots for that date--------//
//echo "of each".$durationofeachslot;
$slotsreq=0;
$durtnn=$durationofeachslot;

//echo "post".$durtnn;
$brksts=0;
while($brksts==0)
    
{
    if(floatval($duration)<=floatval($durtnn))
    {
       $slotsreq++; 
       $brksts=1;
    }
   // echo "okt";
    else
    {
        
         $durtnn=$durtnn+$durationofeachslot;
   $slotsreq++;
    }
   
   //$slotsreq;
}
$dtsavail[]=$date->format("d-m-Y");
 $dtsavaicount[]=$totalslots;
 
 $dtsavailreqcnt[]=$slotsreq;
 $cnc=$frc["amount"]*$slotsreq;
  $totmtarr[]=$cnc;
        $ratearr[]=$frc["amount"];
        $finalamta=$finalamta+$cnc;
        $dureacharr[]=$durationofeachslot;
 
}else
{
    
    $dtsnotavail[]=$date->format("d-m-Y");
    
} 
    
}

}


//if()

$data = ['dtsavail' =>$dtsavail,'dtsavaicount' => $dtsavaicount,'dtsnotavail'=>$dtsnotavail,'alldts'=>$alldts,'dtsavailreqcnt'=>$dtsavailreqcnt,'rated'=>$ratearr,'totarr'=>$totmtarr,'totamt'=>$finalamta,'dureacharr'=>$dureacharr];

echo json_encode($data);

//print_r($dtsavaicount);

?>