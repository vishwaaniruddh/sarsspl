<?php

include("config.php");

$id=$_GET['id'];

$servmysqli_query($con,ervice'];

$dt=$_GET['dt'];
mysqli_query($con,
//echo $id;

$qry=mysqli_query($con,"select * from tempsites where id='".$id."'");
mysqli_query($con,
$rowmysqli_query($con,_row($qry);

$atmid=explode("_",$row[3]);

$qry2=mysqli_query($con,"INSERT INTO `satyavan_accounts`.`Amc` (`amcid`, `cid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `Ref_id`,`servicetype`) VALUES (NULL, '".$row[1]."', '".$row[2]."', '".$atmid[1]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."', '".$row[9]."', '".$row[10]."','".$service."')");

$id2=mysqli_insert_id();

$dt=str_replace("/","-",$dt);

	$start=date('Y-m-d', strtotime($dt));

	 $qry3=mysqli_query($con,"INSERT INTO `satyavan_accounts`.`amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$row[1]."', '".$row[2]."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id2."')");

$up=mysqli_query($con,"update tempsites set status='1' where id='".$id."'");

if($up)

echo "1";

else

echo "0";

?>