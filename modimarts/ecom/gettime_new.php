<?php
include("config.php");
date_default_timezone_set('Asia/Kolkata');
$stats=$_POST['stats'];
$dtn=date('Y-m-d');
$tym=date('H:i:s');
//echo $dtn;
//echo "select id,time from movies where entrydt='".$dtn."' and time<='".$tym."' order by time desc";

//echo "select id,time from scheduled_ads where entrydt='".$dtn."' and time<='".$tym."' order by time desc";

//echo "select id,duration from ads_upload where fromdt='".$dtn."'";

$qr=mysqli_query($con1,"select id,duration from ads_upload where fromdt='".$dtn."'");
$nrws=mysqli_fetch_array($qr);
//echo "select id,duration from ads_upload where fromdt='".$dtn."'";
$pldt=date('H:i:s');
$dt2=$dtn." ".$nrws[1];
//echo $dt2;
$entrydt1=date('H:i:s',strtotime($dt2));

//echo $entrydt1."<br>";
//echo $pldt."//".$entrydt1."<br>";

//echo strtotime($pldt)-strtotime($entrydt1);

echo $nrws[0];

?>