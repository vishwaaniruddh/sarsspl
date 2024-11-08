<?php
session_start();
include("config.php");
$err=0;
$fdt=$_POST["fromdt"];
$tdt=$_POST["todt"];
$ratepersec=$_POST["ratepersec"];
$nouptdt=array();
$nouptdt=explode(",",$_POST["noupdt"]);
//print_r($nouptdt);
$begin = new DateTime($fdt);
$interval=new DateInterval('P1D');
$end = new DateTime($tdt);
$end ->add($interval);
$daterange = new DatePeriod($begin, $interval, $end);
//$i=0;
$dtar=array();
foreach($daterange as $date){
 $daterange=$date->format("Y-m-d");
 $dtt=$date->format("d-m-Y")."<\br>";
 $exs=0;
 $d=date("d-m-Y",strtotime($daterange));
 for($b=0;$b<count($nouptdt);$b++)
 {
    $dc=date("d-m-Y",strtotime($nouptdt[$b]));
    // echo $dc."-----".$d."<\n>";
    if($dc==$d)
    {
        $exs="1"; 
    }
 }
 //echo "updt"+$daterange+"</br>";
  if($exs=="0")
  {
    $gtqrschk=mysql_query("select * from slot_details_ofdt where date='".$daterange."'");
    $nrts=mysql_num_rows($gtqrschk);
    if($nrts>0)
    {
        $strq= "update slot_details_ofdt set slot_rate='".$ratepersec."' where date='".$daterange."'";
    }  else
    {
        $strq= "insert into  slot_details_ofdt(`slot_rate`, `date`)values('".$ratepersec."','".$daterange."')";
    }
    $qrc=mysql_query($strq);
 
    $cont=mysql_insert_id();
    if($nrts>0)
    {$line= $daterange;}
    else
    {$line=$cont;}
 
    $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','add ','Set Slot Rate Per Secont In Parameter','".$curr_dt."','".$_SESSION['lastSubID']."','".$line."','slot_details_ofdt') ");
 
  if(!$qrc)
  {
      
      $err++;
  }
  }
 
}




if($err==0)
{
    
$st="1"; 
}
else
{
$st="0"; 
}

 $data = ['sts' =>$st];

echo json_encode($data);
?>