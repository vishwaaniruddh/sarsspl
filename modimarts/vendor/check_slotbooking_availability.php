<?php 
include("config.php");
$dt1=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt1'])));
$dt2=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt2'])));

$begin = new DateTime($dt1);
$interval=new DateInterval('P1D');
$end = new DateTime($dt2);
$end ->add($interval);
$daterange = new DatePeriod($begin, $interval, $end);

$dtsavail=array();    
$totamt=0;
foreach($daterange as $date)
{
   $daterange=$date->format("Y-m-d");

$qr=mysqli_query($con1,"select * from advertise_booking where dt='".$daterange."' and  slot='".$_POST['slotid']."' and slot_pos='".$_POST['slotpos']."' and dt='".$daterange."'");
$nmr=mysqli_num_rows($qr);

if($nmr==0)
{
    
    $gtr=mysqli_query($con1,"select * from slider_slot_rate where slider_id='".$_POST['slotid']."' and slot_pos='".$_POST['slotpos']."'");
    $ratesetrws=mysqli_num_rows($gtr);
    if($ratesetrws>0)
    {
        
        $gtrws=mysqli_fetch_array($gtr);
        
        $rt=$gtrws["rate"];
        $totamt=$totamt+$rt;
        
   $dtsavail[]=$date->format("d-m-Y");
    }
    
}


    
}
$data=['availabledts'=>$dtsavail];


echo json_encode($data);
?>