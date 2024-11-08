<?php session_start();


$total_amount = $_SESSION['total_amount'];

$total_amount = sprintf("%.2f", $total_amount);


include('../../config.php');


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
 
function getCallbackUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$link =  $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
    
    return str_replace("index.php","",$link);
    
}




?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Mart | Members</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!--<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    
    
    
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  
  <script>
    if (!!window.performance && window.performance.navigation.type === 2) {
            // value 2 means "The page was accessed by navigating into the history"
            // console.log('Reloading');
            window.location.reload(); // reload whole page

        }
</script>



    <style>
               section.content{
    margin: 13% 15px 0 15px;
        }
        
        td{
                white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
        }
        .navbar-nav {
     margin: 2% auto !important;
}
#member_pic img{
    height: 150px;
    /*width: 150px;*/
        border: 1px solid black;
}
.table tbody tr td{
    vertical-align: baseline;
    
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

@media (max-width: 991px){
.content {
 margin-top: 45% !important;
}    
}



    </style>
</head>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!-- this meta viewport is required for BOLT //-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
<!-- BOLT Sandbox/test //-->
<!--<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>-->
<!-- BOLT Production/Live //-->
 <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>

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



<body class="theme-red">
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
   
    <style>
        label span{
            color:red;
        }
    </style>
    
    
        <section class="content">
        <div class="container-fluid">

            <!-- Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
	<form action="#" id="payment_form">
	    
    <div class="card">
        <div class="body">
          
          
            
        
    
    <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
    
    <div class="dv">

    <span><input type="text" id="key" name="key" placeholder="Merchant Key" value="usA7CkHP" / hidden></span>
    </div>
    
    <div class="dv">
    <span><input type="text" id="salt" name="salt" placeholder="Merchant Salt" value="qjR3FURgMf" / hidden></span>
    </div>
    
    <div class="dv">
    <span><input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" / hidden></span>
    </div>
    
    <!--<div class="dv">-->
    <!--<span><input type="text" id="amount" name="amount" placeholder="Amount" value="1.00" / hidden></span>    -->
    <!--</div>-->
    
    <div class="dv">
    <span><input type="text" id="pinfo" name="pinfo" placeholder="Product Info" value="P01" / hidden></span>
    </div>
    
    
           <div class="row clearfix">
                <div class="col-md-6">
                    
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="fname" name="fname" value="<? echo $_SESSION['fname'].' '.$_SESSION['lname']  ?>" class="form-control" required placeholder="Full Name" readonly>
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
                      <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" id="mobile" value="<? echo $_SESSION['mobile'];?>" name="mobile" class="form-control" size="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" minlength="10" placeholder="Mobile" readonly>
                            </div>
                        </div>
                </div>
               
            </div>
            
            <div class="row clearfix">                
                                        <div class="col-sm-6">
                                            <!--<input class="form-control" name="amount" id="amount" value="1.00" readonly>-->
                                            <input class="form-control" name="amount" id="amount" value="<? echo $total_amount; ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="email" id="email" value="<? echo $_SESSION['email'];?>" readonly>
                                        </div>
        </div>
            
    
    
    
    
    <div class="dv">
    <span><input type="text" id="hash" name="hash" placeholder="Hash" value="" hidden/ ></span>
    </div>
    
    
    <div class="row clearfix" style="display:flex;justify-content:center;">
        <input type="submit" id="submit" value="Pay" onclick="launchBOLT(); return false;" class="btn btn-danger" /></div>
    
    </div>
    </div>
	</form>        
        
                    
                </div>
            </div>
        </div>
        </section>


<script type="text/javascript"><!--

$(document).ready(function() {
$("input[type=number]").on("focus", function() {
    $(this).on("keydown", function(event) {
        if (event.keyCode === 38 || event.keyCode === 40) {
            event.preventDefault();
        }
     });
   });
   

   
   
});
// $('#payment_form').bind('keyup blur onload', function(){
	$.ajax({
          url: 'index.php',
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
			udf5: $('#udf5').val(),
			lastname: $('#lastname').val()
          }),
		  contentType: "application/json",
          dataType: 'json',
          success: function(json) {
            if (json['error']) {
			 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
            }
			else if (json['success']) {	
				$('#hash').val(json['success']);
            }
          }
        }); 
// });
//-->
</script>
<script type="text/javascript"><!--
function launchBOLT()
{
    

    if($("#mobile").val().length ==10){
      
       if($('#fname').val() && $('#mobile').val()){
        

        
 
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
    lastname: $('#lastname').val(),
	surl : $('#surl').val(),
	furl: $('#surl').val(),
	mode: 'dropout'	
},
{ responseHandler: function(BOLT){
    
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
 		alert( BOLT.message );
	}
});

    } else{
        alert('Please Field Required Places');
    }
    
    }
    else{
        alert('Mobile Numbers Should be 10 Digit Only !');
    }
   

}
//--
</script>	


    <script src="../plugins/jquery/jquery.min.js"></script> 
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="../plugins/node-waves/waves.js"></script>
    <script src="../plugins/autosize/autosize.js"></script>
    <script src="../plugins/momentjs/moment.js"></script>
    <script src="../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/pages/forms/basic-form-elements.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/demo.js"></script>
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../js/pages/ui/dialogs.js"></script>
    
</body>
</html>
	
