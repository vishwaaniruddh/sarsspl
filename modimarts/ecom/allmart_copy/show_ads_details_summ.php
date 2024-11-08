<?php
session_start();
include 'config.php';

//print_r($_POST);
$tymstmp=$_POST["tymst"];
$namearr=$_POST["adsnmarr"];
$namearrindex=$_POST["adsnmarrindx"];

$cnts=$_POST["cnts"];

$qrr=mysqli_query($con1,"select * from ads_sec_booked where randomtymstmp='".$tymstmp."' and user_id='".$_SESSION["id"]."' and stats='0' order by date asc");

$data=array();
$totrsf=0;
$srn=0;
while($frt=mysqli_fetch_array($qrr))
{
    $dtt=date("d-m-Y",strtotime($frt["date"]));
    
    $rate=$frt["rate"];
    $adsduration=$frt["duration"];
    $totaldur=$tyms*$adsduration;
    $totlrt=$totaldur*$rate;
    $totrs=$totlrt/100;
    $totrsf=$totrsf+$totrs;
    
    $key = array_search($frt["rowid"], $namearrindex);
    $adname=$namearr[$key];
    
    //$adname=;
 
    $data[] = ['date' =>$dtt,'rate' => $rate,'adname'=>$adname,'adduration'=>$adsduration,'tottymstoplay'=>$tyms,'totaldur'=>$totaldur,'totlrt'=>$totlrt,'totrs'=>$totrs];   

    $srn++;
}
echo json_encode($data);
?>