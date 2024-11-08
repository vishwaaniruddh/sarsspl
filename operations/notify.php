<?php

include('config.php');

$req=$_GET['req'];

//$city=$_GET['city'];

$br=$_GET['br'];

$cdate = date('Y-m-d H:i:s');

if(isset($_GET['type']))

$stamysqli_query($con,

else

$stat=mysqli_query($con,

/*inclmysqli_query($con,ass_files/update.php');

$up=new update();

$tab1=$up->update_table('localhost','site','site','atm_site','alert',array("call_status","close_date"),array("Done",'CURDATE()'),"alert_id",$req);

*/

$qr=mysqli_query($con,"select call_status,caller_email from alert where alert_id='".$req."'");

$qrro=mysqli_fetch_row($qr);

//echo $qrro[0];

if($qrro[0]=='2')

$tab1=mysqli_query($con,"update alert set call_status='$stat' where alert_id='".$req."'");

else

$tab1=mysqli_query($con,"update alert set call_status='$stat',close_date='".$cdate."' where alert_id='".$req."'");

if($tab1)

{

	header('Location:view_alert.php');

}

else

echo "Error in Notifying Callers";



?>