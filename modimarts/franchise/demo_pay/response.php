<?php

include('../config.php');

$postdata = $_POST;

$msg = '';
if (isset($postdata ['key'])) {
	$key				=   $postdata['key'];
	$salt				=   $postdata['salt'];
	$txnid 				= 	$postdata['txnid'];
    $amount      		= 	$postdata['amount'];
	$productInfo  		= 	$postdata['productinfo'];
	
	$mihpayid			=	$postdata['mihpayid'];
	$status				= 	$postdata['status'];
	$resphash			= 	$postdata['hash'];
    
    $firstname    		= 	$postdata['firstname'];
	$email        		=	$postdata['email'];
	$want_area				=   $postdata['udf5'];
    $intro_mobile= $postdata['udf3'];
    $intro_name = $postdata['udf4'];
    $state = $postdata['udf1'];
    $write_area= $postdata['udf2'];
	$phone = $postdata['phone'];
	  	$intro_id = $postdata['lastname']; 
	
	$date = date('Y-m-d');
	
	$insert = "insert into franchise_payment(name,mobile,want_area,write_area,state,email,intro_id,intro_name,intro_mobile,txn_id,txnStatus,amount,hash,created_at) values('".$firstname."','".$phone."','".$want_area."','".$write_area."','".$state."','".$email."','".$intro_id."','".$intro_name."','".$intro_mobile."','".$txnid."','".$status."','".$amount."','".$resphash."','".$date."')";
	
	

// mysqli_query($con,$insert);
	//Calculate response hash to verify	
	
// 	$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|'.$data->udf1.'|'.$data->udf2.'|'.$data->udf3.'|'.$data->udf4.'|'.$data->udf5.'||||||'.$data->salt);
			
	
	
	$keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|'.$udf1.'|'.$udf2.'|'.$udf3.'|'.$udf4.'|'.$udf5.'|||||';
	$keyArray 	  		= 	explode("|",$keyString);
	$reverseKeyArray 	= 	array_reverse($keyArray);
	$reverseKeyString	=	implode("|",$reverseKeyArray);
	
	
	
	
	
	$CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));
	
	
	if ($status == 'success'  && $resphash == $CalcHashString) {
		$msg = "Transaction Successful and Hash Verified...";
		//Do success order processing here...
	}
	else {
		//tampered or failed
// 		$msg = "Payment failed for Hasn not verified...";
	} 
}
else exit(0);
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
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!--<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    
    
    
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
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
    </style>
</head>

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
            <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header" style="min-width: 200px;">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
                <a class="navbar-brand" href="../index.php" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="../logo.jpg" style="width:100px;" >
                    <span style="margin: auto 5%;">AllMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    
                    <li>
                        <a href="http://www.allmart.world/franchise/get_members.php" class="">Member Filter</a>
                    </li>
                    
                    <li>
                        <a href="http://www.allmart.world/franchise/pay" class="">Franchise Payment</a>
                    </li>
                    
                    <? 
                    if(isset($_SESSION) && $_SESSION['rollid']==1){ ?>
                                        <li>
                        <a href="http://www.allmart.world/franchise/admin/members.php" class="">Member</a>
                    </li>
                    
                    
                    <li>
                        <a href="http://www.allmart.world/franchise/admin/pending_approve.php" class="">Pending Approve</a>
                    </li>
                        
                    <? } else{ ?>
                    <li>
                        <a href="http://www.allmart.world/franchise/admin/index.php" class="">Login</a>
                    </li>     
                    <? } ?>
                   
                   
                </ul>
            </div>
        </div>
    </nav>
    
    
    <style>
        label span{
            color:red;
        }
    </style>
    
    
        <section class="content">
        <div class="container-fluid">
            
            
            
            
<?


echo $insert;
echo '<br>';

echo 'Calculated : '.$CalcHashString;

echo '<br>';

echo 'Response : '.$resphash;

echo '<br>';
echo '<pre>';
print_r($_POST);
echo '<pre>';

?>
            
  <div class="card">
        <div class="body">
            
            <? if($status=='success'){ ?>
               <h2 style="text-align:center;">
                   Thanks for your payment ! Your Payment is succesfully done ! 
               </h2>
               
           <p style="text-align:center;">The Transaction id for your reference is <span style="color:red;"><? echo $txnid; ?></span>  
           </p>
               
               <div class="row clearfix" style="display: flex;
    justify-content: center;">
                   
                    <a href="http://www.allmart.world/franchise/pay/" class="btn btn-danger" style="margin: 1%;">Make Another Payment</a>
                    <a href="http://www.allmart.world/franchise/" class="btn btn-danger" style="margin: 1%;">Go to Homepage</a>
               </div>
                
            <? } else{ ?>
               
                              <h2>
                   Payment Error ! Your Payment is Unsuccesfull ! 
               </h2>
               

               <div class="row clearfix">
                   
                    <a href="http://www.allmart.world/franchise/pay/" class="btn btn-danger">Try Payment Again</a>
                    <a href="http://www.allmart.world/franchise/" class="btn btn-danger">Go to Homepage</a>
               </div>
               
                
            <? }
            ?>
            
            
        </div>
    </div>
        </div>
        </section>
        </body>
    </html>