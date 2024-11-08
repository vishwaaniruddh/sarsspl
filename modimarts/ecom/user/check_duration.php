<?php
session_start();
include('config.php');
include('access.php');
$duration=$_POST["durarr"];
//echo $duration;
$fdt=$_POST["fdt"];
$tdt=$_POST["tdt"];

//echo "test demo".$tdt;
$ncnt= count($duration);

$begin = new DateTime($fdt);
$interval=new DateInterval('P1D');
$end = new DateTime($tdt);
$end ->add($interval);
$daterange = new DatePeriod($begin, $interval, $end);
//$i=0;
    
foreach($daterange as $date){
    
    $daterange=$date->format("Y-m-d");
    
    // echo $daterange."\n";
     
    for($i=0;$i<$ncnt;$i++)
   	{
        $sts=0;
        $sec=round($duration[$i]);
        //echo $sec;

        while($sts==0)
        {
            $v=$sec % 3;
            
            if($v==0)
            {
                $sts=1;
                
            }else
            {
              $sec=$sec+1; 
                
            }
            //echo $sec."\n";
        }


    
  
//echo "select * from Date_duration Date='".$daterange."'";

$check_duration=mysqli_query($con1,"select * from Date_duration where Date='".$daterange."'");
$check_durationf1=mysqli_num_rows($check_duration);

if($check_durationf1>0){
    
    $check_durationf=mysqli_fetch_row($check_duration);
   
   if($check_durationf[2]==3600){
       
       echo "$daterange - not available"."\n";
   }else{
       
       
       $checktime=$check_durationf[2]+$sec;
       
       if($checktime<=3600){
           
           echo "$daterange - available"."\n";
       }else{
           
         //  $rem=3600-$check_durationf[2];
           
          echo "$daterange - not available"."\n";
       }
   }
   
    
}else{
    
    echo "$daterange - available"."\n";
}
}

}


?>