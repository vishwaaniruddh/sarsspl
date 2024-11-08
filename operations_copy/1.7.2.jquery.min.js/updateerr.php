<?php

include("config.php");

$stat=$_GET['stat'];

$id=$_GET['id'];

if($stat=='1')

{

$atm=$_GET['atm'];

$cons=$_GET['cons'];

$fdt=$_GET['fdt'];

$tdt=$_GET['tdt'];

$bdt=$_GET['bdt'];

$ddt=mysqli_query($con,;

$pdt=$_GET['pdt'];

$operr=$_GET['openr'];

$closer=$_GET['closer'];

$unitmysqli_query($con,s'];

$pamt=$_GET['pamt'];

$xtra=$_GET['xtra'];

$tamt=$_GET['tamt'];





$cid=$_GET['cid'];

$qry=mysqli_query($con,"update uploadedebillerr set `atmid`='".$atm."', `consumerno`='".$cons."', `frmdt`=STR_TO_DATE('".$fdt."','%d/%m/%Y'), `todt`=STR_TO_DATE('".$tdt."','%d/%m/%Y'), `billdt`=STR_TO_DATE('".$bdt."','%d/%m/%Y'), `duedt`=STR_TO_DATE('".$ddt."','%d/%m/%Y'), `paiddt`=STR_TO_DATE('".$pdt."','%d/%m/%Y'), `openreading`='".$openr."', `closereading`='".$closer."', `units`='".$unit."', `paidamt`='".$pamt."', `extracharge`='".$xtra."', `totalamt`='".$tamt."', `cid`='".$cid."', `acmgrapp`=Now(), `status`='".$stat."' where id='".$id."'");

if($qry)

echo "1";

else

echo "0";

}

elseif($stat=='2')

{

$qry=mysqli_query($con,"update uploadedebillerr set `opmgrapp`=Now(), `status`='".$stat."' where id='".$id."'");

if($qry)

echo "1";

else

echo "0";

}

?>