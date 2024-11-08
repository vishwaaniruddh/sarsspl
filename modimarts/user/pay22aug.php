<?php
include('../config.php');
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
   
	//Request hash
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';	
	if(strcasecmp($contentType, 'application/json') == 0){
		$data = json_decode(file_get_contents('php://input'));
		$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
		$json=array();
		$json['success'] = $hash;
    	echo json_encode($json);
	}
	exit(0);
}
//var_dump($_GET['month']);
/*function getCallbackUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
}*/

function getCallbackUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol . $_SERVER['HTTP_HOST']. '/oc1/user/payumoney/response.php';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Merabazar Payment</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- this meta viewport is required for BOLT //-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
<!-- BOLT Sandbox/test //-->
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<!-- BOLT Production/Live //-->
<!--// script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script //-->

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
	.hide{
	    display : none;
	}
</style>
<body>
<div class="main">
	<div>
    	<img src="../payumoney/images/payumoney.png" />
    </div>
    <div class="hide">
    	<h3>Merabazar Payment</h3>
    </div>
	<form action="#" id="payment_form">
	        <div class="row">
        <div class="col-xs-12">
            <div class="text-xs-center">
                <i class="fa fa-search-plus float-xs-left icon"></i>
                <h2>Invoice for purchase #33221</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-3 float-xs-left">
                    <div class="card  height">
                        <div class="card-header">Billing Details</div>
                        <div class="card-block">
                            <strong>David Peere:</strong><br>
                            1111 Army Navy Drive<br>
                            Arlington<br>
                            VA<br>
                            <strong>22 203</strong><br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="card  height">
                        <div class="card-header">Payment Information</div>
                        <div class="card-block">
                            <strong>Card Name:</strong> Visa<br>
                            <strong>Card Number:</strong> ***** 332<br>
                            <strong>Exp Date:</strong> 09/2020<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="card  height">
                        <div class="card-header">Order Preferences</div>
                        <div class="card-block">
                            <strong>Gift:</strong> No<br>
                            <strong>Express Delivery:</strong> Yes<br>
                            <strong>Insurance:</strong> No<br>
                            <strong>Coupon:</strong> No<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 float-xs-right">
                    <div class="card  height">
                        <div class="card-header">Shipping Address</div>
                        <div class="card-block">
                            <strong>David Peere:</strong><br>
                            1111 Army Navy Drive<br>
                            Arlington<br>
                            VA<br>
                            <strong>22 203</strong><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
    <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
    <div class="dv hide" >
    <span class="text"><label>Merchant Key:</label></span>
    <span><input type="text" id="key" name="key" placeholder="Merchant Key" value="BhA3IR5V" /></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Merchant Salt:</label></span>
    <span><input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="ViHyr9bb8t" /></span>
    </div>
    <div class="dv hide">
    <span class="text X"><label>Transaction/Order ID:</label></span>
    <span><input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" /></span>
    </div>
    <input type="hidden" id="mid" name="mid" value="<?php echo $_GET['mid']; ?>" /></span>
    <div class="dv">
    <span class="text"><label>Amount:</label></span>
    <span><input type="text" id="amount" name="amount" placeholder="Amount" value="<?php echo $_GET['price']; ?>" readonly /></span>    
    </div>
    <div class="dv hide">
    <span class="text"><label>Product Info:</label></span>
    <span><input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="P01,P02" /></span>
    </div>
    <div class="dv">
    <span class="text"><label>Name:</label></span>
    <span><input type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo $_GET['name'];?>" /></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Mid:</label></span>
    <span><input type="text" id="mid" name="mid" placeholder="ID" value="<?php if(isset($_GET['mid'])){echo $_GET['mid'];} ?>" /></span>
    </div>
    <div class="dv">
    <span class="text"><label>Subcription month</label></span>
    <span><input type="text" id="sub_month" name="sub_month" placeholder="Month" value="<?php if(isset($_GET['month'])){echo $_GET['month'];} ?>" /></span>
    </div>
    <div class="dv">
    <span class="text"><label>Email ID:</label></span>
    <span><input type="text" id="email" name="email" placeholder="Email ID" value="<?php echo $_GET['email'];?>" /></span>
    </div>
    <div class="dv">
    <span class="text"><label>Mobile/Cell Number:</label></span>
    <span><input type="text" class="form-controls" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="<?php if(isset($_GET['mobile'])){echo $_GET['mobile'];} ?>" /></span>
    </div>
    <div class="dv hide">
    <span class="text"><label>Hash:</label></span>
    <span><input class="form-controls" type="text" id="hash" name="hash" placeholder="Hash" value="" /></span>
    </div>
    <div><input type="submit" class="btn-success" style="border-radius: 6px;margin-left: 42%;" value="Pay" onclick="launchBOLT(); return false;" /></div>
	</form>
</div>
<script type="text/javascript"><!--
$('#payment_form').bind('keyup blur', function(){
	$.ajax({
          url: 'pay.php',
          type: 'post',
          data: JSON.stringify({ 
            key: $('#key').val(),
			salt: $('#salt').val(),
			txnid: $('#txnid').val(),
			amount: $('#amount').val(),
		    pinfo: $('#pinfo').val(),
            fname: $('#fname').val(),
			email: $('#email').val(),
			mobile: $('#mobile').val(),
			mid: $('#mid').val(),
			month: $('#mo').val(),
			udf5: $('#udf5').val()
          }),
		  contentType: "application/json",
          dataType: 'json',
          success: function(json) {
              //alert(json);
            if (json['error']) {
                //alert(json['success']);
			 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
            }
			else if (json['success']) {	
			    //alert(json['success']);
				$('#hash').val(json['success']);
            }
          }
        }); 
});
//-->
</script>
<script type="text/javascript"><!--
function launchBOLT()
{
	bolt.launch({
	key: $('#key').val(),
	txnid: $('#txnid').val(), 
	hash: $('#hash').val(),
	amount: $('#amount').val(),
	firstname: $('#fname').val(),
	email: $('#email').val(),
	phone: $('#mobile').val(),
	productinfo: $('#pinfo').val(),
	udf5: $('#udf5').val(),
	surl : $('#surl').val(),
	furl: $('#surl').val(),
	mode: 'dropout'	
},{ responseHandler: function(BOLT){
	console.log( BOLT.response.txnStatus );		
	if(BOLT.response.txnStatus != 'CANCEL')
	{
		//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
		var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
		'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
		'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
		'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
		'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
		'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
		'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
		'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
		'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
		'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
		'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
		'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
		'</form>';
		var form = jQuery(fr);
		jQuery('body').append(form);								
		form.submit();
	}
},
	catchException: function(BOLT){
	    //alert('yyy');
 		alert( 'ww'+BOLT.message );
	}
});
}
//--
</script>	
</body>
</html>
	
