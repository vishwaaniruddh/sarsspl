<?php 
include('config.php');

// INSERT INTO `order_shipping`(`id`, `oid`, `channel_id`, `shipment_id`, `order_ids`, `awb_code`, `sendOrderShipRocket`, `sendOrderToShipRocket`, `generate_awb`, `generate_pickup`, `generateManifest`, `printManifest`, `generateLabel`, `printInvoice`, `gettrackdetails`)




     // sendOrderToShipRocket

if (isset($_POST['sendOrderToShipRocket'])) {

	$item_id = $_REQUEST['item_id'];
	$oid = $_REQUEST['oid'];
	$channel_id = $_REQUEST['channel_id'];
	$shipment_id = $_REQUEST['shipment_id'];
	$order_ids = $_REQUEST['order_ids'];

	$responce1 = $_REQUEST['responce1'];
	$responce2 = $_REQUEST['responce2'];

	$query= mysqli_query($con1,"INSERT INTO `order_shipping`(`oid`, `item_id`, `channel_id`, `shipment_id`, `order_ids`, `sendOrderShipRocket`, `sendOrderToShipRocket`) VALUES ('".$oid."','".$item_id."','".$channel_id."','".$shipment_id."','".$order_ids."','".$responce1."','".$responce2."')");

	if($query)
	{
		 $show_email_sql = mysqli_query($con1,"UPDATE order_details SET `track_Status`='1',track_id='".$order_ids."'   where id='".$item_id."' ");

	 echo "1";
	 	}
	else
	{echo "0";  }

	}



     // generate_awb

if (isset($_POST['generate_awb'])) {

	$item_id = $_REQUEST['item_id'];
	$shipment_id = $_REQUEST['shipment_id'];
	$responce2 = $_REQUEST['responce2'];
	$awb_code = $_REQUEST['awb_code'];



	$query= mysqli_query($con1,"UPDATE `order_shipping` SET `awb_code`='".$awb_code."',`generate_awb`='".$responce2."' WHERE item_id='".$item_id."' AND shipment_id='".$shipment_id."'");

	if($query)
	{ echo "1";	}
	else
	{echo "0";  }

	}



     // generate_pickup

if (isset($_POST['generate_pickup'])) {

	$item_id = $_REQUEST['item_id'];
	$shipment_id = $_REQUEST['shipment_id'];
	$responce2 = $_REQUEST['responce2'];



	$query= mysqli_query($con1,"UPDATE `order_shipping` SET `generate_pickup`='".$responce2."' WHERE item_id='".$item_id."' AND shipment_id='".$shipment_id."'");

	if($query)
	{ echo "1";	}
	else
	{echo "0";  }

	}



     // generateManifest

if (isset($_POST['generateManifest'])) {

	$item_id = $_REQUEST['item_id'];
	$shipment_id = $_REQUEST['shipment_id'];
	$responce2 = $_REQUEST['responce2'];



	$query= mysqli_query($con1,"UPDATE `order_shipping` SET `generateManifest`='".$responce2."' WHERE item_id='".$item_id."' AND shipment_id='".$shipment_id."'");

	if($query)
	{
		$getdata=mysqli_query($con1,"SELECT order_ids FROM order_shipping WHERE item_id='".$item_id."' AND shipment_id='".$shipment_id."' ");
		$_getdata=mysqli_fetch_assoc($getdata);
		$return = array(
			'status' => 1,
			'order_ids' => $_getdata['order_ids'],
		 );

	 echo json_encode($return);
	 	}
	else
	{
		$return = array(
			'status' => 0,
			'order_ids' => null,
		 );

	 echo json_encode($return);  }

	}



     // printManifest

if (isset($_POST['printManifest'])) {

	$order_ids = $_REQUEST['order_ids'];
	$responce2 = $_REQUEST['responce2'];



	$query= mysqli_query($con1,"UPDATE `order_shipping` SET `printManifest`='".$responce2."' WHERE order_ids='".$order_ids."'");

	if($query)
	{
		$getdata=mysqli_query($con1,"SELECT item_id, shipment_id FROM order_shipping WHERE order_ids='".$order_ids."'");
		$_getdata=mysqli_fetch_assoc($getdata);
		$return = array(
			'status' => 1,
			'item_id' => $_getdata['item_id'],
			'shipment_id' => $_getdata['shipment_id'],
		 );

	 echo json_encode($return);

	 	}
	else
	{
		$return = array(
			'status' => 0,
			'order_ids' => null,
		 );

	 echo json_encode($return); }

	}



     // generateLabel


if (isset($_POST['generateLabel'])) {
	$item_id = $_REQUEST['item_id'];
	$shipment_id = $_REQUEST['shipment_id'];
	$responce2 = $_REQUEST['responce2'];



	$query= mysqli_query($con1,"UPDATE `order_shipping` SET `generateLabel`='".$responce2."' WHERE item_id='".$item_id."' AND shipment_id='".$shipment_id."'");

	if($query)
	{
		$getdata=mysqli_query($con1,"SELECT order_ids FROM order_shipping WHERE item_id='".$item_id."' AND shipment_id='".$shipment_id."' ");
		$_getdata=mysqli_fetch_assoc($getdata);
		$return = array(
			'status' => 1,
			'order_ids' => $_getdata['order_ids'],
		 );

	 echo json_encode($return);

	 	}
	else
	{
	$return = array(
			'status' => 0,
			'order_ids' => null,
		 );

	 echo json_encode($return);  }

	}



     // printInvoice

if (isset($_POST['printInvoice'])) {

	$order_ids = $_REQUEST['order_ids'];
	$responce2 = $_REQUEST['responce2'];



	$query= mysqli_query($con1,"UPDATE `order_shipping` SET `printInvoice`='".$responce2."' WHERE order_ids='".$order_ids."'");

	if($query)
	{ echo "1";	}
	else
	{echo "0";  }

	}



     // gettrackdetails

if (isset($_POST['gettrackdetails'])) {

	
	$awb_code = $_REQUEST['awb_code'];
	$responce2 = $_REQUEST['responce2'];

             $query= mysqli_query($con1,"UPDATE `order_shipping` SET `gettrackdetails`='".$responce2."' WHERE awb_code='".$awb_code."'");
	if($query)
	{ echo "1";	}
	else
	{echo "0";  }

	}

if (isset($_POST['CheckCourier'])) {

	
	$item_id = $_REQUEST['item_id'];
	$responce2 = $_REQUEST['responce2'];

             $query= mysqli_query($con1,"UPDATE `order_shipping` SET `courier_list`='".$responce2."' WHERE item_id='".$item_id."'");
	if($query)
	{ echo "1";	}
	else
	{echo "0";  }

	}	

	
if (isset($_POST['CancelOrder'])) {

	
	$order_ids = $_REQUEST['order_ids'];
	$responce2 = $_REQUEST['responce2'];

             $query= mysqli_query($con1,"UPDATE `order_shipping` SET `CancelOrder`='".$responce2."' WHERE order_ids='".$order_ids."'");
	if($query)
	{ echo "1";	}
	else
	{echo "0";  }

	}


	









 ?>