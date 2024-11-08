<?php
session_start();
if(!$_SESSION['user']){
header('location:index.php');
}
else{
include("config.php");
if(isset($_POST['cmdsub']))
{
$dt=date('Y-m-d H:i:s');
$memo=str_replace("'","\'",$_POST['memo']);
$srno=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$sr=mysqli_fetch_row($srno);
$qry=mysqli_query($con,"INSERT INTO `onacctransfer` (`reqid`, `aid`, `amount`, `reqstatus`, `reqby`,`memo`,`entrydt`) VALUES (NULL, '".$_POST['sv']."', '".$_POST['amt']."', '6', '".$sr[0]."','".$memo."','".$dt."')");
if(!$qry)
echo mysqli_error();
if($qry)
{
$message2="You have  New Requests";
$str2=array();
//echo "Select gcm_regid from notification_tble where logid='71'  AND status='0'";
$qrygcm=mysqli_query($con,"Select gcm_regid from notification_tble where logid='71'  AND status='0'");
if(mysqli_num_rows($qrygcm)>0)
{
//echo "hi";
	while($max1=mysqli_fetch_row($qrygcm))
	{ 
	$str2[]=$max1[0];
	
	}


//print_r($str2);
		include_once '../andi/db_functions.php';
		include_once '../andi/GCM.php';
		$db = new DB_Functions();
		 $gcm = new GCM();
		
			//$registatoin_ids = $str2;
			$message = array("alert" => $message2);
			//print_r($message);
			$result = $gcm->send_notification($str2, $message);


}

?>
<script type="text/javascript">
alert("Request Created Successfully");
window.location="onaccreq.php";
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert("Some Error Occurred");
window.location="onaccreq.php";
</script>
<?php
}
}
else
header('location:onaccreq.php');
}
?>