<?php
include ("config.php");

/*
$moviepath=$_POST["movpath"];
$mdt=$_POST["mdt"];
$mtym=$_POST["mtym"];
$dur=$_POST["ndur"];




//print_r($mdt);
*/


$friendsJsonString = $_POST['dat'];


$array = json_decode($friendsJsonString, true);



$errs=0;
for($i=0;$i<count($array['mpath']);$i++)
{

$pdt=date("Y-m-d",strtotime($array['mdt'][$i]));
//echo $pdt;
$qr=mysqli_query($con3,"INSERT INTO `scheduled_ads`(`entrydt`, `time`, `duration`,`movie_path`,ad_id) values('".$pdt."','".$array['mtym'][$i]."','".$array['ndur'][$i]."','".$array['mpath'][$i]."','".$array['adidarr'][$i]."')");

if($qr=="")
{

$errs++;
//echo mysqli_error($con);
}

}

if($errs==0)
{
echo "Ads Scheduled";
}
else
{

echo "Error";
}



?>