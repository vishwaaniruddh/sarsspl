<?php
session_start();
include("config.php");
$hk=strtoupper($_POST['hk']);
$ct=strtoupper($_POST['ct']);
$mt=strtoupper($_POST['mt']);
$eb=strtoupper($_POST['eb']);
$query=mysqli_query($con,"INSERT INTO `newtempsites` (`id`, `cust_id`, `cust_name`,`housekeeping`, `caretaker`, `maintenance`, `ebill`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `city`, `location`, `atmsite_address`, `site_type`, `city_category`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `cust_remarks`, `active`, `project`,`upby`,`linktrackid`) VALUES (NULL, '".$_POST['cid']."', '".$_POST['cname']."', '".$hk."', '".$ct."','".$mt."', '".$eb."', '".$_POST['bank']."','".$_POST['local']."', '".$_POST['zone']."', '".$_POST['state']."', '".$_POST['reg']."', '".$_POST['site']."','".$_POST['atm']."','".$_POST['city']."', '".$_POST['loc']."','".$_POST['add']."','".$_POST['sitetp']."',NULL,STR_TO_DATE('".$_POST['tkdt']."','%d/%m/%Y'), '0000-00-00', '".$_POST['supname']."', '".$_POST['supno']."','".$_POST['rem']."', '0', '".$_POST['project']."','".$_SESSION['user']."','".$_POST['track']."')");
	if($query)
	echo "1";
	else
	echo "failed to insert Data. ".mysqli_error();
?>