<?php

include("access.php");

inclumysqli_query($con,hp");

//echo "INSERT INTO `satyavan_accounts`.`tempsites` (`id`, `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`) VALUES (NULL, '".$_POST['cust']."', '".$_POST['po']."', '".$_POST['atmid']."', '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['pincode']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['address']."', '".$_POST['atmid']."')<br>";

$qry=mysqli_query($con,"INSERT INTO `satyavan_accounts`.`tempsites` (`id`, `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`) VALUES (NULL, '".$_POST['cust']."', '".$_POST['po']."', 'temp_".$_POST['atmid']."', '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['pincode']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['address']."', '".$_POST['atmid']."')");
mysqli_query($con,
$tempimysqli_query($con,rt_id();

if(!$mysqli_query($con,

echo "failed".mysqli_error();

//echo "update tempsites set trackerid='temp_".$tempid."' where id='".$tempid."'<br>";

$qryup=mysqli_query($con,"update tempsites set trackerid='temp_".$tempid."' where id='".$tempid."'");

$qry2=mmysqli_query($con,select srno from login where username='".$_SESSION['user']."'");

$qry2ro=mysqli_fetch_row($qry2);

$qrr=mysqli_query($con,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
mysqli_query($con,
	$num=mysqli_num_rows($qrr);

	$num2=$num+1;

	if($num2>0 && $num2<=9)

	$num3="0".$num2;

	else

	$num3=$num2;

//echo "Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`) Values('".$_POST['cust']."','".$_POST['atmid']."','".$_POST['bank']."','".$_POST['area']."','".$_POST['address']."','".$_POST['city']."','".$_POST['state']."','".$_POST['pincode']."','".$_POST['prob']."','".$_POST['cname']."','".$_POST['cphone']."','".$_POST['cemail']."',STR_TO_DATE('".$_POST['adate']."','%d/%m/%Y'),'Pending','new','".$_POST['cdate']."','".$_POST['po']."')<br>";

$alert=mysqli_query($con,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`,`state1`,`createdby`,`serviceid`) Values('".$_POST['cust']."','temp_".$_POST['atmid']."','".$_POST['bank']."','".$_POST['area']."','".$_POST['address']."','".$_POST['city']."','".$_POST['state']."','".$_POST['pincode']."','".$_POST['prob']."','".$_POST['cname']."','".$_POST['cphone']."','".$_POST['cemail']."',STR_TO_DATE('".$_POST['adate']."','%d/%m/%Y'),'Pending','new temp','".date('Y-m-d H:i:s')."','".$_POST['po']."','".$_POST['state']."','".$qry2ro[0]."_".date("Ymd").$num3."','".$_POST['servicetp']."')");

$id=mysqli_insert_id();





//echo "<br>Update alert set `createdby`='".$qry2ro[0]."_".date("Ymd").$tempid."' where alert_id='".$tempid."'";

//$up=mysqli_query($con,"Update alert set `createdby`='".$qry2ro[0]."_".date("Ymd").$num3."' where alert_id='".$id."'");

?>

<script type="text/javascript">

alert("Alert created successfully. Complain ID is : <?php echo $qry2ro[0]."_".date("Ymd").$num3; ?> ");

window.location='newtempsite.php';

</script>