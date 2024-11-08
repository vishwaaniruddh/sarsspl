<?php
session_start();
include('config.php');
include('adminaccess.php');
// var_dump($_POST);

$GST=$_POST['gst'];
$TDS=$_POST['tds'];
$TDS2=$_POST['tds2'];
$GST_Limit=$_POST['gst_limit'];
$TDS_Limit=$_POST['tds_limit'];

if($GST!='' && $TDS!='' && $GST_Limit!='' && $TDS_Limit!='' && $TDS2!='')
{
	$sql="UPDATE `CommissionDeduction` SET `gst`='".$GST."',`tds`='".$TDS."',`tds2`='".$TDS2."',`gst_limit`='".$GST_Limit."',`tds_limit`='".$TDS_Limit."' WHERE id='1'";
	$sqlquery=mysqli_query($con,$sql);
	if($sqlquery)
	{
		?>
         <script>
         window.location.href="<?=$baseurl?>adminpanel/CommissionSettings.php";
       </script>
		<?php
	}
	else
	{
		?>
        <script>
         window.location.href="<?=$baseurl?>adminpanel/CommissionSettings.php";
       </script>
		<?php

	}

}
 ?>
