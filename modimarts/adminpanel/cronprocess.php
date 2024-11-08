<?php
include("config.php");
$errors=0;
$dtt=date("Y-m-d",strtotime($_POST["fromdt"]));
//$dtt=date("Y-m-d",strtotime("2018-01-15"));

mysql_query("BEGIN");
$totdurscheduled=0;
$stopsts=0;

$qrm=mysql_query("select * from Date_duration where date='".$dtt."'");
$nr=mysql_num_rows($qrm);
if($nr>0)
{
$fr=mysql_fetch_array($qrm);
$dateduration_id=$fr[0];


function fn($dateduration_id,$dtt)
{
   global $totdurscheduled;
   global $adstotaltym;
   global $stopsts;
  // echo "tot".$totdurscheduled."</br>";
   //echo $adstotaltym."</br>";
$qr=mysql_query("select * from ads_slot_booked_details where date_duration_id='".$dateduration_id."' and status=0");
while($qrft=mysql_fetch_array($qr))
{
    
$endrtym=date("Y-m-d H:i:s",strtotime($dtt."23:00:00"));
$addtotym=$dtt." 00:00:00";

$addtotymaftr1hr = date("Y-m-d H:i:s", strtotime($addtotym."+1 hours"));
   
$chksch=mysql_query("select * from schedule_details where date_duration_id='".$dateduration_id."' order by tym desc limit 0,1");
$schrws=mysql_num_rows($chksch);
if($schrws>0)
{
  $ftchsc=mysql_fetch_array($chksch);
  $addtotym=$dtt." ".$ftchsc["tym_end"]; 
    
}else
{
    
   $addtotym=$dtt." 00:00:00"; 
}
 $dur=$qrft["ad_duration"];
 
 //echo $totdurscheduled+$dur."</br>";
    if($totdurscheduled+$dur<=$adstotaltym)
    {
  
   $adsid=$qrft["video_id"];
    $vpltymstrt=$addtotym;
   $vpltymend=date("Y-m-d H:i:s",strtotime($vpltymstrt."+".$dur." seconds"));
   
     
 /* echo  "INSERT INTO `schedule_details`(`date_duration_id`, `ad_id`, `duration`, `date`, `tym`, `tym_end`) VALUES('".$dateduration_id."','".$adsid."','".$dur."','".$dtt."','".date("H:i:s",strtotime($vpltymstrt))."','".date("H:i:s",strtotime($vpltymend))."') "."</br>";*/
     $totdurscheduled=$totdurscheduled+$dur;
     
     //echo "tot".$totdurscheduled."</br>";
   $inssch1=mysql_query("INSERT INTO `schedule_details`(`date_duration_id`, `ad_id`, `duration`, `date`, `tym`, `tym_end`) VALUES('".$dateduration_id."','".$adsid."','".$dur."','".$dtt."','".date("H:i:s",strtotime($vpltymstrt))."','".date("H:i:s",strtotime($vpltymend))."') "); 
  
  
  if(!$inssch1)
{
    echo mysql_error();
    $errormsg=5;
      $errtxt.="5".mysql_error()."\n";
     $errors++;
}
    
    
    }else
    {
        $stopsts=1;
    }
}
}

while($totdurscheduled<=$adstotaltym)
{
 if($stopsts==0)
 {
    fn($dateduration_id,$dtt);
 }else
 {
     break;
 }
}



if($errors==0)
{
    
    mysql_query("COMMIT");
    echo 1;
    
}else
{
    
mysql_query("ROLLBACK");
    echo 0;
}



}else
{
    
    
    echo 2;
}
?>