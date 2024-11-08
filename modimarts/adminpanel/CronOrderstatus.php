<?php 
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

            $qrytoken = "select token from add_ship_rocket_token where id='1'";
            $result_token = mysqli_query($con1, $qrytoken);
            $rowtoken    = mysqli_fetch_row($result_token);
            $jwttoken=$rowtoken[0];

$getorders=mysqli_query($con1,"SELECT * FROM `order_shipping` WHERE Order_status<>'Delivered' AND Order_status<>'Canceled' AND generate_awb<>''");
while ($data=mysqli_fetch_assoc($getorders)) {
    $awb_code= $data['awb_code'];
	// echo "<br/>";
	// echo $data['Order_status'];
	// echo "<br/>";

	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/track/awb/'.$awb_code,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json',
	    'Authorization: Bearer '.$jwttoken
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$getresponce=json_decode($response);
	// var_dump($getresponce);
	// echo "<br/>";
	$updated_at=date('Y-m-d H:i:s');
	
	$Status=$getresponce->tracking_data->track_status;
if($Status){
	
  $currentstatus=$getresponce->tracking_data->shipment_track[0]->current_status;
    
	
	$query= mysqli_query($con1,"UPDATE `order_shipping` SET `gettrackdetails`='".$response."', Order_status='".$currentstatus."',updated_at='".$updated_at."' WHERE awb_code='".$awb_code."'");
}
else
{
	echo "Elase";
	$query= mysqli_query($con1,"UPDATE `order_shipping` SET `gettrackdetails`='".$response."',updated_at='".$updated_at."' WHERE awb_code='".$awb_code."'");
}
}
 ?>