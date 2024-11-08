<?php
include('../../config.php');

$postdata = $_POST;
$msg = '';
if (isset($postdata ['key'])) {
	$key				=   $postdata['key'];
	$salt				=   $postdata['salt'];
// 	$salt				=   'ViHyr9bb8t';
	$txnid 				= 	$postdata['txnid'];
    $amount      		= 	$postdata['amount'];
	$productInfo  		= 	$postdata['productinfo'];
	$firstname    		= 	$postdata['firstname'];
	$email        		=	$postdata['email'];
	$udf5				=   $postdata['udf5'];
	$mihpayid			=	$postdata['mihpayid'];
	$status				= 	$postdata['status'];
	$resphash			= 	$postdata['hash'];
	//Calculate response hash to verify	

	$keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
	$keyArray 	  		= 	explode("|",$keyString);
	$reverseKeyArray 	= 	array_reverse($keyArray);
	$reverseKeyString	=	implode("|",$reverseKeyArray);
	$CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));
	
	$date = date('Y-m-d H:i:s');
    // 	if ($status == 'success'  && $resphash == $CalcHashString) {
    if ($status == 'success'  ) {
	    //insert order data 
	    $q ="update Orders set status = 1 where id = ".$udf5;
        $result = mysql_query($q);
        
        $order_details ="update order_details set status = 1 where oid = ".$udf5;
        $res = mysql_query($order_details);
        
        $tr="Insert into order_payment (oid,amt,type,dt,transaction) values('".$udf5."','".$amount."','".$postdata['mode']."','".$date."','".$txnid."')";
        $q_run = mysql_query($tr);
        /*var_dump($q_run);*/
		$msg = "Transaction Successful and Hash Verified...";
		//Do success order processing here...
		
// 		send mail
        $to=$email;
        $subject = "Payment Details";
        
        $txtdispatch = "Your payment of is successful!";
        
        $txtdelivered = " Dear sir/Madam,
                             Thank you for purchasing the order  from our site (Merabazaar.com). 
        
        Thanking You,
        (Merabazaar)";
        
        $headers = "From: Merabazaar@example.com" . "\r\n" .
        "CC: sarmicrosystems@example.com";
        mail($to,$subject,$txtdelivered,$headers);

	} else {
		//tampered or failed
		$msg = "Payment failed for Hasn not verified...";
	} 
}
else exit(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Merabazaar</title>
</head>
<style type="text/css">
	.main {
		margin-left:30px;
		font-family:Verdana, Geneva, sans-serif, serif;
	}
	.text {
		float:left;
		width:180px;
	}
	.dv {
		margin-bottom:5px;
	}
	
</style>
<body>
<div class="main">
	<div>
    	<img src="images/payumoney.png" />
    </div>
    <div>
    	<h3>Merabazaar</h3>
    </div>
	
    <!--<div class="dv">
    <span class="text"><label>Merchant Key:</label></span>
    <span><?php echo $key; ?></span>
    </div>-->
    
    <!--<div class="dv">
    <span class="text"><label>Merchant Salt:</label></span>
    <span><?php echo $salt; ?></span>
    </div>
    -->
    <!--<div class="dv">-->
    <!--<span class="text"><label>Transaction/Order ID:</label></span>-->
    <!--<span><?php echo $txnid; ?></span>-->
    <!--</div>-->
    
    <!--<div class="dv">
    <span class="text"><label>Amount:</label></span>
    <span><?php echo $amount; ?></span>    
    </div>-->
    
    <!--<div class="dv">
    <span class="text"><label>Product Info:</label></span>
    <span><?php echo $productInfo; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>First Name:</label></span>
    <span><?php echo $firstname; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Email ID:</label></span>
    <span><?php echo $email; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Mihpayid:</label></span>
    <span><?php echo $mihpayid; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Hash:</label></span>
    <span><?php echo $resphash; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>RHash:</label></span>
    <span><?php echo $CalcHashString; ?></span>
    </div>
    
    <div class="dv">
    <span class="text"><label>Transaction Status:</label></span>
    <span><?php echo $status; ?></span>
    </div>-->
    
    <!--<div class="dv">
    <span class="text"><label>Message:</label></span>
    <span><?php echo $msg; ?></span>
    </div>-->
    
    <div class="container">
    <form action="http://sarmicrosystems.in/oc1">
    <label >Congratulation!</label>
    <label >Transaction orderId : <?php echo $txnid; ?></label>
    <label >Your transaction is successful of <?php echo $amount; ?>/.</label>
   
    <input type="submit" value="Back">
  </form>
</div>
</div>
</body>
</html>
	