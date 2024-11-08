<?php
include('access.php');
include('config.php');
$reqid=$_GET['id'];
//echo $stat=$_GET['stat'];
$rem=str_replace("'","\'",$_GET['rem']);
$str='';
if(isset($_GET['amt']))
$str=" , approvedamt='".$_GET['amt']."'";

if(isset($_GET['amt']))
$str.=" , chequeno='".$_GET['chk']."'";

$qry=mysqli_query($con,"Update fundrequest set status='".$stat."' ".$str." where reqid='".$reqid."'");
$ins=mysqli_query($con,"INSERT INTO `fundrequestapproval` (`appid`, `reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '".$reqid."', '".$_SESSION['user']."', Now(), '".$rem."', '".$stat."')");

if($stat=='6')
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
		include_once '../andi/GCM.php';
		 $gcm = new GCM();
		
			//$registatoin_ids = $str2;
			$message = array("alert" => $message2);
			//print_r($message);
			$result = $gcm->send_notification($str2, $message);
			
}

//$responsestr=1;
	//echo json_encode($responsestr);
}
else
{
	//$responsestr=-1;
	//echo json_encode($responsestr);
	//echo "Error Creating Delegation";
}

if(!$ins)
echo mysqli_error();
if($qry && $ins)
{

echo "1";
}
else
echo "0";
?>