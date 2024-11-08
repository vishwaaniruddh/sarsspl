<?php
session_start();
include "../getlocationforsearch.php";
include('config.php');

$errors=0;
$sliderid=$_POST["sliderid"];

$begin = new DateTime($_POST["fromdt"]);
$interval=new DateInterval('P1D');
$end = new DateTime($_POST["todt"]);
$end ->add($interval);
$slotpos=$_POST["slotpos"];
$daterange = new DatePeriod($begin, $interval, $end);

$dtavail=array();
$alldts=array();
$dtsnotavail=array();
$dtsnrt=array();
$totmt=0;




$qrgetds=mysqli_query($con1,"SELECT * FROM `clients` where code='".$_SESSION['id']."'");
$frds=mysqli_fetch_array($qrgetds);

$lat1=floatval($frds["Latitude"]);
$long1=floatval($frds["Longitude"]);



foreach($daterange as $date)
{
      $alldts[]=$date->format("d-m-Y");
 
    $ckrtset=mysqli_query($con1,"select * from  `slider_slot_rate` where dt='".$date->format("Y-m-d")."'  and slider_id='".$sliderid."' order by id desc limit 0,1");
    $rtds=mysqli_num_rows($ckrtset);
    
    if($rtds)
    {
    
 
$daterange=$date->format("Y-m-d");
$gtbkid=mysqli_query($con1,"select * from advertise_booking where dt='".$daterange."' and slot='".$sliderid."' and slot_pos='".$slotpos."'");
if($nrtys=mysqli_num_rows($gtbkid)==0)
{
    
    $gtrtrws=mysqli_fetch_array($ckrtset);
    
    
    $dtavail[]=$date->format("d-m-Y");
    $dtsnrt[]=$gtrtrws["rate"];
    $totmt=$totmt+$gtrtrws["rate"];
}
else
{
    while($gtrtrws=mysqli_fetch_array($ckrtset))
    {
        
        
        $qrgetds=mysqli_query($con1,"SELECT * FROM `clients` where code='".$gtrtrws['merchant_id']."'");
        $frds=mysqli_fetch_array($qrgetds);

        $lat2=floatval($frds["Latitude"]);
        $long2=floatval($frds["Longitude"]);
        
        
        $dist=distance($lat1, $long1, $lat2, $long2, "K");
        
        
        if(floatval($dist)>5)
        {
            
            $dtavail[]=$date->format("d-m-Y");
            $dtsnrt[]=$gtrtrws["rate"];
            $totmt=$totmt+$gtrtrws["rate"];
        
            
        }else
        {
            
            $dtsnotavail[]=$date->format("d-m-Y");
            $dtsnrt[]="0";
        
            
        }
        

    }
    
    
    
    
}
}
else //-------------------------rate is not set----------------------------------------//
{
    
     $dtsnotavail[]=$date->format("d-m-Y");
     $dtsnrt[]="0";
}

}


$data = ['dtsv'=>join(",",$dtavail),'dtsnotavai'=>join(",",$dtsnotavail),'alldts'=>join(",",$alldts),'dtsnrt'=>join(",",$dtsnrt),'totmt'=>$totmt];
echo json_encode($data);
?>