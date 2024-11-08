<?php
session_start();
include 'config.php';
$stss=0;

if($_SESSION["id"]!="")
{
    
$dt=$_POST["dt"];

$mnth=$_POST["mnth"];
$yr=$_POST["yr"]; 
$dur=$_POST["dur"];
$selid=$_POST["selid"];
 
if($_POST["tymst"]!="")
{
$tymst=$_POST["tymst"];
}
else
{
    $tymst=date("Ymdhis");
}
$dtt=date("Y-m-d",strtotime($yr."-".$mnth."-".$dt));




if($selid=="0")//--means insert selected date
{

$availsecs=0;
$gts=mysqli_query($con3,"select  `total_duration`, `stats` from Date_duration where Date='".$dtt."'");
$gtsrws=mysqli_num_rows($gts);
if($gtsrws>0)
{
    
     $gettotdrws=mysqli_fetch_array($gts);
  
  if($gettotdrws["stats"]=="0")
  {
   
   $availsecstmp=0;
   $getfrtemp=mysql_query("select sum(duration) from ads_sec_booked where stats=0 and date='".$dtt."'");
   $frttemprs=mysql_fetch_array($getfrtemp);
   
   if($frttemprs[0]!=null)
   {
       
   $availsecstmp=$frttemprs[0];
       
   }
   
   
  
   $totbkd=$gettotdrws[0]+$availsecstmp;
   
   
   
    $availsecspen=$adstotaltym-$totbkd;
   
   
  
   if($availsecspen<=$dur)
   {
      
       $availsecs=0;
       
   }else
   {
       
       $availsecs=$availsecspen;
   }
   
      
      
      
  }else
  {
      
      $availsecs=0;
      
  }
 
    
}else
{
   
  $getfrtemp=mysql_query("select sum(duration) from ads_sec_booked where stats=0 and date='".$dtt."'");
   $frttemprs=mysql_fetch_array($getfrtemp);
   
   if($frttemprs[0]==null)
   {
       
   $availsecs=$adstotaltym;
       
   }else
   {
      
      
     $availsecs=$adstotaltym-$frttemprs[0];
   
 //  echo "ll".$availsecs;   
   }
   
  
}




if($availsecs>=$dur)
{


$getrt=mysql_query("SELECT * FROM `slot_details_ofdt` where date='".$dtt."' order by id desc");

$getrtrws=mysql_fetch_array($getrt);
$rate=$getrtrws["slot_rate"];




$qr=mysql_query("INSERT INTO `ads_sec_booked`(`user_id`, `date`, `duration`, `entrydt`,randomtymstmp,rowid,rate)values('".$_SESSION["id"]."','".$dtt."','".$dur."','".date("Y-m-d H:i:s")."','".$tymst."','".$_POST["rowid"]."','".$rate."')");

if($qr)
{
    $stss=1;
}else
{
    
    $stss=2;
}

}else
{
    
    $stss=20;//tym not available;
}

}else//--means delete selected date
{
    
    
     $qr=mysql_query("delete from ads_sec_booked where id='".$selid."' and randomtymstmp='".$tymst."' and user_id='".$_SESSION["id"]."'");
    if($qr)
    {
        
        
        $stss=1;
        
    }else
    {
        
        $stss=2;
    }
    
    
}


}else
{
    
    $stss=10;
}



$qrchjk=mysql_query("select date from  `ads_sec_booked` where user_id='".$_SESSION["id"]."'  and randomtymstmp='".$tymst."' and rowid='".$_POST["rowid"]."'");


$rwsr=mysql_num_rows($qrchjk);

$dtr[]=["sts"=>$stss,'tymst'=>$tymst,'rws'=>$rwsr];

echo json_encode($dtr);

?>