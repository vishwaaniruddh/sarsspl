<?php 
session_start();
include("config.php");
include("getlocationforsearch.php");
$stsss=0;//used in menu.php 0 means indexpage
//echo $_SESSION['gid'];


if($_GET["qty"]!="")
{
$nrwss11=$_GET["qty"];

}
else
{
 $cartdets1=mysqli_query($con1,"select sum(qty) from cart where user_id='".$_SESSION['gid']."' and status=0");
   $nrwss11=mysqli_fetch_array($cartdets1);   
}


   if($nrwss11[0]!=null & $nrwss11[0]>0 & $_SESSION['gid']!="")
   {

?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Merabazaar</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <link href="http://sarmicrosystems.in/oc1/image/catalog/cart.png" rel="icon" />
    	<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
    	       
    	    
                      <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
               	      <script type="text/javascript" src="requiredfunctions.js"></script>
            <!--    <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />-->
            <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
              
                <link href="catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
               
               
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/moment.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js"></script>
          <script src="js/vendor/jquery.js"></script>



        	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="zoomImage/Image-Hover-Zoom/assets/css/app.css">
		<link rel="stylesheet" href="zoomImage/Image-Hover-Zoom/wm-zoom/jquery.wm-zoom-1.0.min.css">

     








<style>

.fixed_div{
    
     margin-left: 45%;
}
/* Create two equal columns that floats next to each other */
.column5 {
    float: left;
    width: 100%;
    padding: 10px;
    /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
 
}

#sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 21%;
    width: 46%;
     
}
 
</style>

<script>
function remfromcart2(cartid)
{
  try
{
   //alert("this2");
$.ajax({
   type: 'POST',    
url:'remvcart.php',
data:'cartid='+cartid,

success: function(msg){
//alert(msg);
if(msg==2)
{
   // alert("sorry your session has been expired");
   toastfunc("sorry your session has been expired");
}
else if(msg==1)
{
 //toastfunc();
 toastfunc("Product removed from cart");
 showcartdetails();
}
else
{
toastfunc("Error removing from cart");
}
updatecart();
  //document.getElementById('show').innerHTML=msg;
         }
     });

}catch(exc)
{
alert(exc);
}  
    
}

var bl=true;
function qtfchk(qtyid)
{
    try
    {
        var chkqt=document.getElementById(qtyid).value;
        
        if(chkqt=="")
        {
            
           bl=false;
           toastfunc("Quantity must be greater than 0");
            
        }
       
    
    }catch(exc)
    {
       //alert(exc); 
    }
    return bl;
}



function process(v,row,cart,qt){
    
    
    var value = parseInt(document.getElementById('nwqty'+row).value);

    if (value > 0) {
           value+=v;
        } else{
            value=1;
        }
    if(value=='0') {
            value=1;
        }
    
    document.getElementById('nwqty'+row).value = value;
    updtfn(cart,qt)
}


function updtfn(cartid,qtyid)
{
  try
{
    if(qtfchk(qtyid))
    {
 //alert("this2");
   var qtyn=document.getElementById(qtyid).value;

   
$.ajax({
   type: 'POST',    
url:'updtcrtfromcart.php',
data:'cartid='+cartid+'&qtyn='+qtyn,

success: function(msg){
//alert(msg);
if(msg==2)
{
   // alert("sorry your session has been expired");
   toastfunc("sorry your session has been expired");
}
else if(msg==3)
{
    toastfunc("Product is out of stock");
}
else if(msg==1)
{
 //toastfunc();
 toastfunc("cart updated");
 showcartdetails();
}
else
{
toastfunc("Error updating cart");
}
updatecart();
  //document.getElementById('show').innerHTML=msg;
         }
     });
}
}catch(exc)
{
alert(exc);
}  
    
}





function showcartdetails()
{
try
{
// alert("ok");

 <?php if($_GET["Pid"]!=""){ ?> var pid=<?php echo $_GET["Pid"];?>;<?php } else { ?> var pid="";<?php }?>
          
       <?php if($_GET["cId"]!=""){ ?> var cid=<?php echo $_GET["cId"];?>;<?php } else { ?> var cid="";<?php }?>
          
       <?php if($_GET["qty"]!=""){ ?> var qty=<?php echo $_GET["qty"];?>;<?php } else { ?> var qty="";<?php }?>
          
         <?php if($_GET["clr"]!=""){ ?> var clr=<?php echo $_GET["clr"];?>;<?php } else { ?> var clr="";<?php }?>
         
         <?php $sss=$_GET["sz"];?>
            <?php if($sss!=""){ ?> var sz=<?php echo $sss;?>;<?php } else { ?> var sz="";<?php }?>
         



$.ajax({
   type: 'GET',    
url:'paymentProcess_cartpagesearch.php',
data:'Pid='+pid+'&cId='+cid+'&qty='+qty+'&clr='+clr+'&sz='+sz,

success: function(msg){
   // alert(msg);
    if(msg!="")
    {
         document.getElementById('cartdets').innerHTML=msg;
        document.getElementById('accordion').style.display='block';
        
         
    var div = $("#cartdets");
     var divtotal=div.height();
     var divheight=divtotal-56;
     $('#divheightcount').attr('style', 'margin-top :-'+ divheight+'px');

     // alert("height: " + div.height() );
     //alert(divheight)
     

        
    }else
    {
        document.getElementById('accordion').style.display='none'; 
        document.getElementById('cartdets').innerHTML="<center><b>Your Cart is empty<b></center>";
    }
   
    updatecart();
         }
     });

}catch(exc)
{
    alert(exc);
}
}


</script>

</head>
<body onload="showcartdetails();">
 
 
<!--=================== for menu ===============-->
<div style=" position: -webkit-sticky;position: sticky;top: 0px;z-index:1;">
<header id="header-layout" class="header-v2">
     <div id="header-main">
        <div  >
            <div class="row">
            <?php include('menucopy.php')?>
            </div>
        </div>
    </div>
    
</header></div>
<!--=============================================-->
 
 
 
 
 
<!--<div class="row" style="background-image: url(images/Steps.jpg);">-->
   <div class="row" style="background-color:#F5F5F5;">
    <div id="sticky"  >
      <div class="column"  >
       <!--  <img  src="images/logo.png" alt="Avatar">-->
         
        
         
         <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
            <div class="container">
                <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
            </div>
        </div>
        <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification"></div>
          </div>
        </div>
        <!-- /sys-notification -->
  <div class="container">
  <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
         <?php if($_GET['qty']>0){ ?>
       <li><a href="details.php?prid=<?php echo $_GET['Pid'];?>&catid=<?php echo $_GET['cId'];?>">BuyNow</a></li>
         <?php }else{ ?>
       <li><a href="cart.php">Shopping Cart</a></li>
         <?php } ?>
      </ul>
     </div>
     
        <div class="row"  >              
        <div id="content" class="col-sm-12" style="left: 21px;">     
       
      <form action="" method="post" enctype="multipart/form-data">
        <!--<div class="table-responsive" id="cartdets">-->
        <!-- <div  id="cartdets" style="height: 900px;">-->
     
      
        <div  id="cartdets" style="">
             
        </div>
        
       
      </form>
     
      </div>
    </div>
 
         
         
      </div>
    </div>
 
 

<div class="fixed_div" style="padding-left: 34px;padding-right: 0px;">
  <div class="container" style="margin-top:-135px;" >
 
   <!-- <div class="row" style="margin-top: inherit;"> -->
    <!-- <div class="row" style="margin-top: -67%;">  -->
    <div class="row" id="divheightcount" > 
    <div id="content" class="col-sm-8" style="margin-top: 36px;">  
   
      <div class="panel-group" id="accordion" style="margin-bottom: 5px;">
        <div class="panel panel-default">
          <div class="panel-heading" style="background-image:url(images/Steps.jpg);padding:4px">
              <div class="row">
                  
                  
                  <div class="col-md-6"><h4 style="margin-top: 2px;margin-bottom: 0px;" >STEP 1 :</h4></div>
                  <div class="col-md-6"><h4 class="panel-title" style="margin-left: -96px;color:white">login</h4></div>
              </div>
            <!--<h4 class="panel-title">Checkout Options</h4>-->
            
          </div>
          <div class="panel-collapse collapse" id="collapse-checkout-option" style="background-color:white">
            <div class="panel-body" style="padding-top: 3px;">
                
                
                
            </div>
          </div>
        </div>
                <div class="panel panel-default">
          <div class="panel-heading"  style="background-image:url(images/Steps.jpg);padding:4px">
            <div class="row">
                  
                  
                  <div class="col-md-6"><h4 style="margin-top: 2px;margin-bottom: 0px;" >STEP 2 :</h4></div>
                  <div class="col-md-6"> <h4 class="panel-title" style="color:white">Billing Details</h4></div>
              </div>
            
            
           
          </div>
          <div class="panel-collapse collapse" id="collapse-payment-address">
            <div class="panel-body" style="padding-top: 3px;margin-bottom: 0px;padding-bottom: 0px;"></div>
          </div>
        </div>
                       <!-- <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Step 3: Delivery Details</h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-shipping-address">
            <div class="panel-body"></div>
          </div>
        </div>-->
        <!--<div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Step 4: Delivery Method</h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-shipping-method">
            <div class="panel-body"></div>
          </div>
        </div>-->
                <div class="panel panel-default">
          <div class="panel-heading"  style="background-image:url(images/Steps.jpg);padding:4px">
            <div class="row">
                  
                  
                  <div class="col-md-6"><h4 style="margin-top: 2px;margin-bottom: 0px;" >STEP 3 :</h4></div>
                  <div class="col-md-6">  <h4 class="panel-title" style="color:white">Payment Method</h4></div>
              </div>
            
            
           
          </div>
          <div class="panel-collapse collapse" id="collapse-payment-method">
            <div class="panel-body" style="padding-top: 3px;background-color:white"></div>
          </div>
        </div>
        <div class="panel panel-default">
          <!--<div class="panel-heading"  style="background-image:linear-gradient(#0970bd, #b8e2ff)">-->
          <div class="panel-heading"  style="background-image:url(images/Steps.jpg);padding:4px">
            
        <div class="row">
                  
                  
                  <div class="col-md-6"><h4 style="margin-top: 2px;margin-bottom: 0px;" >STEP 4 :</h4></div>
                  <div class="col-md-6">  <h4 class="panel-title" style="color:white">Order Tracking</h4></div>
              </div>
        
        
          </div>
          <div class="panel-collapse collapse" id="collapse-checkout-confirm">
            <div class="panel-body" style="background-color:white"></div>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>




<script type="text/javascript">


$(document).on('change', 'input[name=\'account\']', function() {
	if ($('#collapse-payment-address').parent().find('.panel-heading .panel-title > *').is('a')) {
		if (this.value == 'register') {
			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Account &amp; Billing Details <i class="fa fa-caret-down"></i></a>');
		} else {
			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Billing Details <i class="fa fa-caret-down"></i></a>');
		}
	} else {
		if (this.value == 'register') {
			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('Step 2: Account &amp; Billing Details');
		} else {
			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('Step 2: Billing Details');
		}
	}
});




$(document).ready(function() {
   
    $.ajax({
        url: 'paymentProcess_paymentstep1.php',
         dataType: 'html',
        success: function(html) {

	<?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!="")
           
			{?>
		
		paydts1();
		
	//	paydts();
		 
		
			<?php }else
			{?>
           $('#collapse-checkout-option .panel-body').html(html);

			$('#collapse-checkout-option').parent().find('.panel-heading .panel-title').html('<a href="#collapse-checkout-option" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle" style="margin-left: -96px;color:white"> Login <i class="fa fa-caret-down"></i></a>');
//	$('#collapse-checkout-option').parent().find('.panel-heading .panel-title').html('<a href="#collapse-checkout-option" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle"></a>');

			$('a[href=\'#collapse-checkout-option\']').trigger('click');
			<?php } ?>
	
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});



function paydts()
{ 
    <?php if($_GET["qty"]==""){ ?>
    paydts1_checkout();
    <?php }else{ ?>
    paydts2_buynow();
    <?php }?>
    
   
}

//=============== by anand======================

function paydts1()
{ 
    <?php if($_GET["qty"]==""){ ?>
    
    paydts1_checkout_test();
    <?php }else{?>
    
    
    paydts2_buynow_test();
    <?php }?>
    
   
}

//=============================================



function paydts1_checkout_test(){
     
    var urll="";
  
  	<?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!="")
    {?>
  
  urll="paymentstep2forloginuser_test.php";
  
  <?php }else{ ?>
 
   
   if ($('input[name=\'account\']:checked').val() == 'register') {
 
        urll="paymentstep2reg.php";
     
   }else
   {
       urll="paymentstep2.php";
   }
   
   <?php } ?>
   
   
   
  
   //collapse-payment-address

     $.ajax({
        url: urll,
        dataType: 'html',
       success: function(html) {
            
	$('#collapse-payment-address .panel-body').html(html);

			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle" style="margin-left: -96px;color:white"> Billing Details <i class="fa fa-caret-down"></i></a>');

			$('a[href=\'#collapse-payment-address\']').trigger('click');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
		
}








function paydts1_checkout(){
     
    var urll="";
  
  	<?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!="")
    {?>
  
  urll="paymentstep2forloginuser.php";
  
  <?php }else{ ?>
 
   
   if ($('input[name=\'account\']:checked').val() == 'register') {
 
        urll="paymentstep2reg.php";
     
   }else
   {
       urll="paymentstep2.php";
   }
   
   <?php } ?>
   
   
   
  
   //collapse-payment-address

     $.ajax({
        url: urll,
        dataType: 'html',
       success: function(html) {
            
	$('#collapse-payment-address .panel-body').html(html);

			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Billing Details <i class="fa fa-caret-down"></i></a>');

			$('a[href=\'#collapse-payment-address\']').trigger('click');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
		
}




function paydts2_buynow_test(){
    var pid="";
    var cid="";
    var qty="";
    var clr="";
    var sz="";
    
    var urll="";
  
  	<?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!="")
    {?>
 
  urll="paymentstep2forloginuser_test.php";
  
  <?php }else{ ?>
 
   
   if ($('input[name=\'account\']:checked').val() == 'register') {
 
        urll="paymentstep2reg.php";
        
       
       
    <?php if($_GET["Pid"]!=""){ ?> var pid=<?php echo $_GET["Pid"];?>;<?php } else { ?> var pid="";<?php }?>
          
       <?php if($_GET["cId"]!=""){ ?> var cid=<?php echo $_GET["cId"];?>;<?php } else { ?> var cid="";<?php }?>
          
       <?php if($_GET["qty"]!=""){ ?> var qty=<?php echo $_GET["qty"];?>;<?php } else { ?> var qty="";<?php }?>
          
         <?php if($_GET["clr"]!=""){ ?> var clr=<?php echo $_GET["clr"];?>;<?php } else { ?> var clr="";<?php }?>
         
         <?php $sss=$_GET["sz"];?>
            <?php if($sss!=""){ ?> var sz=<?php echo $sss;?>;<?php } else { ?> var sz="";<?php }?>
         
       
   }else
   {
       urll="paymentstep2.php";
   }
   
   <?php } ?>
   
   
   
  
   //collapse-payment-address

     $.ajax({
        url: urll,
        dataType: 'html',
        data:'pid='+pid+'&cid='+cid+'&qty='+qty+'&clr='+clr+'&sz='+sz,
      
        success: function(html) {
            // alert(html);
            	
   
  	$('#collapse-payment-address .panel-body').html(html);

			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle" style="margin-left: -96px;">Billing Details <i class="fa fa-caret-down"></i></a>');

			$('a[href=\'#collapse-payment-address\']').trigger('click');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
		
}








function paydts2_buynow(){
    var pid="";
   var cid="";
  var  qty="";
   var clr="";
  var  sz="";
    
    var urll="";
  
  	<?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!="")
    {?>
 
  urll="paymentstep2forloginuser.php";
  
  <?php }else{ ?>
 
   
   if ($('input[name=\'account\']:checked').val() == 'register') {
 
        urll="paymentstep2reg.php";
        
       
       
         <?php if($_GET["Pid"]!=""){ ?> var pid=<?php echo $_GET["Pid"];?>;<?php } else { ?> var pid="";<?php }?>
          
       <?php if($_GET["cId"]!=""){ ?> var cid=<?php echo $_GET["cId"];?>;<?php } else { ?> var cid="";<?php }?>
          
       <?php if($_GET["qty"]!=""){ ?> var qty=<?php echo $_GET["qty"];?>;<?php } else { ?> var qty="";<?php }?>
          
         <?php if($_GET["clr"]!=""){ ?> var clr=<?php echo $_GET["clr"];?>;<?php } else { ?> var clr="";<?php }?>
         
         <?php $sss=$_GET["sz"];?>
            <?php if($sss!=""){ ?> var sz=<?php echo $sss;?>;<?php } else { ?> var sz="";<?php }?>
         
       
   }else
   {
       urll="paymentstep2.php";
   }
   
   <?php } ?>
   
   
   
  
   //collapse-payment-address

     $.ajax({
        url: urll,
        dataType: 'html',
        data:'pid='+pid+'&cid='+cid+'&qty='+qty+'&clr='+clr+'&sz='+sz,
      
        success: function(html) {
           //  alert(html);
            	
   
  	$('#collapse-payment-address .panel-body').html(html);

			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Billing Details <i class="fa fa-caret-down"></i></a>');

			$('a[href=\'#collapse-payment-address\']').trigger('click');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
		
}






/*$(document).ready(function() {
    $.ajax({
        url: 'index.php?route=checkout/payment_address',
        dataType: 'html',
        success: function(html) {
            $('#collapse-payment-address .panel-body').html("OK");

			$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Billing Details <i class="fa fa-caret-down"></i></a>');

			$('a[href=\'#collapse-payment-address\']').trigger('click');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});*/

// Checkout
$(document).delegate('#button-account', 'click', function() {
    
        /*    $('.alert, .text-danger').remove();

            $('#collapse-payment-address .panel-body').html(html);

			if ($('input[name=\'account\']:checked').val() == 'register') {
				$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Account &amp; Billing Details <i class="fa fa-caret-down"></i></a>');
			} else {
				$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Billing Details <i class="fa fa-caret-down"></i></a>');
			}
*/
		paydts();
     
});

//=========================comment by anand ============================
// Login
/*$(document).delegate('#button-login', 'click', function() {
    var ac=  $("input:radio[name=accounts]:checked").val();
    
    if(ac=="registered"){
    var eml=document.getElementById('input-email').value;
    var passw=document.getElementById('input-password').value;
   
    $.ajax({
        url: 'loginprocessnew.php',
        type: 'post',
        data:'email='+eml+'&password='+passw+'&ac='+ac,
        beforeSend: function() {
        	$('#button-login').button('loading');
		},
        complete: function() {
            $('#button-login').button('reset');
        },
        success: function(msg) {
            //alert(msg);
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');
           

            if (msg==1) {
              
                    location ="Checkout.php?Pid=<?php echo $_GET["Pid"];?>&cId=<?php echo $_GET["cId"];?>&qty=<?php echo $_GET["qty"];?>&clr=<?php echo $_GET["clr"];?>&sz='<?php echo $_GET["sz"];?>'";
            } else {
                $('#collapse-checkout-option .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Incorrect username and password'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('input[name=\'email\']').parent().addClass('has-error');
				$('input[name=\'password\']').parent().addClass('has-error');
		   }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    }
    else if(ac=="guest"){
         
  
         var Mobile=document.getElementById('Mobile').value;
    var Mail=document.getElementById('Mail').value;
   
    $.ajax({
        url: 'loginprocessnew.php',
        type: 'post',
        data:'Mobile='+Mobile+'&Mail='+Mail+'&ac='+ac,
        beforeSend: function() {
        	$('#button-login').button('loading');
		},
        complete: function() {
            $('#button-login').button('reset');
        },
        success: function(msg) {
            alert(msg);
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');
           

            if (msg==1) {
              
                    location ="paymentProcess.php?Pid=<?php echo $_GET["Pid"];?>&cId=<?php echo $_GET["cId"];?>&qty=<?php echo $_GET["qty"];?>&clr=<?php echo $_GET["clr"];?>&sz='<?php echo $_GET["sz"];?>'";
            } 
           else if (msg==2) {
              
                $('#collapse-checkout-option .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Email-ID Exist'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('input[name=\'email\']').parent().addClass('has-error');
				$('input[name=\'text\']').parent().addClass('has-error');
			} 
           else if (msg==3) {
              
                $('#collapse-checkout-option .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Mobile Number Exist'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('input[name=\'email\']').parent().addClass('has-error');
				$('input[name=\'password\']').parent().addClass('has-error');
			} 
            
            else {
                $('#collapse-checkout-option .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Incorrect username and password'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$('input[name=\'email\']').parent().addClass('has-error');
				$('input[name=\'password\']').parent().addClass('has-error');
		   }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
        
        
    }
    
    
    
    
});*/
//========================= comment by anand (end) ==============
// Register





$(document).delegate('#button-register', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/register/save',
        type: 'post',
        data: $('#collapse-payment-address input[type=\'text\'], #collapse-payment-address input[type=\'date\'], #collapse-payment-address input[type=\'datetime-local\'], #collapse-payment-address input[type=\'time\'], #collapse-payment-address input[type=\'password\'], #collapse-payment-address input[type=\'hidden\'], #collapse-payment-address input[type=\'checkbox\']:checked, #collapse-payment-address input[type=\'radio\']:checked, #collapse-payment-address textarea, #collapse-payment-address select'),
        dataType: 'json',
        beforeSend: function() {
			$('#button-register').button('loading');
		},
        success: function(json) {
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                $('#button-register').button('reset');

                if (json['error']['warning']) {
                    $('#collapse-payment-address .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

				for (i in json['error']) {
					var element = $('#input-payment-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
					} else {
						$(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
					}
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
            } else {
                                var shipping_address = $('#payment-address input[name=\'shipping_address\']:checked').prop('value');

                if (shipping_address) {
                    $.ajax({
                        url: 'index.php?route=checkout/shipping_method',
                        dataType: 'html',
                        success: function(html) {
							// Add the shipping address
                            $.ajax({
                                url: 'index.php?route=checkout/shipping_address',
                                dataType: 'html',
                                success: function(html) {
                                    $('#collapse-shipping-address .panel-body').html(html);

									$('#collapse-shipping-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 3: Delivery Details <i class="fa fa-caret-down"></i></a>');
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                }
                            });

							$('#collapse-shipping-method .panel-body').html(html);

							$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 4: Delivery Method <i class="fa fa-caret-down"></i></a>');

   							$('a[href=\'#collapse-shipping-method\']').trigger('click');

							$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('Step 4: Delivery Method');
							$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
							$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                } else {
                    $.ajax({
                        url: 'index.php?route=checkout/shipping_address',
                        dataType: 'html',
                        success: function(html) {
                            $('#collapse-shipping-address .panel-body').html(html);

							$('#collapse-shipping-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 3: Delivery Details <i class="fa fa-caret-down"></i></a>');

							$('a[href=\'#collapse-shipping-address\']').trigger('click');

							$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('Step 4: Delivery Method');
							$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
							$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                }
                
                $.ajax({
                    url: 'index.php?route=checkout/payment_address',
                    dataType: 'html',
                    complete: function() {
                        $('#button-register').button('reset');
                    },
                    success: function(html) {
                        $('#collapse-payment-address .panel-body').html(html);

						$('#collapse-payment-address').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-address" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Billing Details <i class="fa fa-caret-down"></i></a>');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Shipping Address
$(document).delegate('#button-shipping-address', 'click', function() {
    $.ajax({
        url: 'index.php?route=checkout/shipping_address/save',
        type: 'post',
        data: $('#collapse-shipping-address input[type=\'text\'], #collapse-shipping-address input[type=\'date\'], #collapse-shipping-address input[type=\'datetime-local\'], #collapse-shipping-address input[type=\'time\'], #collapse-shipping-address input[type=\'password\'], #collapse-shipping-address input[type=\'checkbox\']:checked, #collapse-shipping-address input[type=\'radio\']:checked, #collapse-shipping-address textarea, #collapse-shipping-address select'),
        dataType: 'json',
        beforeSend: function() {
			$('#button-shipping-address').button('loading');
	    },
        success: function(json) {
            $('.alert, .text-danger').remove();

            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                $('#button-shipping-address').button('reset');

                if (json['error']['warning']) {
                    $('#collapse-shipping-address .panel-body').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

				for (i in json['error']) {
					var element = $('#input-shipping-' + i.replace('_', '-'));

					if ($(element).parent().hasClass('input-group')) {
						$(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
					} else {
						$(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
					}
				}

				// Highlight any found errors
				$('.text-danger').parent().parent().addClass('has-error');
            } else {
                $.ajax({
                    url: 'index.php?route=checkout/shipping_method',
                    dataType: 'html',
                    complete: function() {
                        $('#button-shipping-address').button('reset');
                    },
                    success: function(html) {
                        $('#collapse-shipping-method .panel-body').html(html);

						$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 4: Delivery Method <i class="fa fa-caret-down"></i></a>');

						$('a[href=\'#collapse-shipping-method\']').trigger('click');

						$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('Step 5: Payment Method');
						$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 6: Confirm Order');

                        $.ajax({
                            url: 'index.php?route=checkout/shipping_address',
                            dataType: 'html',
                            success: function(html) {
                                $('#collapse-shipping-address .panel-body').html(html);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });

                $.ajax({
                    url: 'index.php?route=checkout/payment_address',
                    dataType: 'html',
                    success: function(html) {
                        $('#collapse-payment-address .panel-body').html(html);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});



// Guest
var bool=false;
function checkemail()
{
try{
//alert("hello");

var emailchk1=document.getElementById('emailchk').value;
 var email1=document.getElementById('input-payment-email').value;
if(emailchk1!=email1)
{

   document.getElementById('emailchk').value=email1;
   //alert(email1);
    $.ajax({
             type: "POST",
             url: "chkmail.php",
			
   data:'email2='+email1,
             success: function(msg){
                 //alert("check");
                 $('.text-danger').parent().addClass('form-group required');
                  $('.text-danger').parent().removeClass('has-error');
                 $('.alert, .text-danger').remove();
                
                 
                 
//alert(msg);
if(msg==1)
{
     bool=false;
var element = $('#input-payment-email');
$(element).after('<div class="text-danger">' +'Email Id is already registered' + '</div>');
$('.text-danger').parent().addClass('has-error');
element.focus();
}
else
{
 //bool=true;
 //$('.text-danger').parent().addClass('form-group required');
 
 checkcontact();
}

            }
         }); 
}else
{
 checkcontact();
}

}catch(ex){
    alert(ex);
    
}
         //alert(bool);
   return bool;
}

 
var bool2=false;
function checkcontact()
{
try{

var contchk1=document.getElementById('contchk').value;
    var cont=document.getElementById('input-payment-telephone').value;
  if(contchk1!=cont)
{
    document.getElementById('contchk').value=cont;
    $.ajax({
             type: "POST",
             url: "chkmail.php",
			
   data:'cont='+cont+'&stats=1',
             success: function(msg){
                 //alert("check");
                  $('.text-danger').parent().addClass('form-group required');
                  $('.text-danger').parent().removeClass('has-error');
                 $('.alert, .text-danger').remove();
                 
//alert(msg);
if(msg==1)
{
     bool2=false;
var element2 = $('#input-payment-telephone');
$(element2).after('<div class="text-danger">' +'Contact No is already registered' + '</div>');
$('.text-danger').parent().addClass('has-error');
element2.focus();
}
else
{
 //bool2=true;
 guestcheckoutfn();
}

            }
         }); 
}
else
{
 //bool2=true;
 guestcheckoutfn();
}
}catch(ex){
    alert(ex);
  
      
}
   return bool2;
}


var fbl=false;
function guestcheckoutfn()
{
     var data = new FormData( $( 'form#guestpaymentstep2form' )[ 0 ]);
   // alert("ok");
    $.ajax({
        url: 'guestdetailsupdatestep2.php',
        type: 'post',
        processData: false,
      contentType: false,
      data: data,
        beforeSend: function() {
       		$('#button-guest').button('loading');
	    },
        success: function(msg) {
            //alert(msg);
             $('#button-guest').button('reset');

if(msg==2)
{
    
     document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Sorry session expired'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
var scrollPos =  $("#notification1").offset().top;
 $(window).scrollTop(scrollPos);
window.open("index.php",'_self');    
}
else if(msg==1)
{
 paymethodop();
}
else
{
 document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Some error occured please try again'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';    
    var scrollPos =  $("#notification1").offset().top;
 $(window).scrollTop(scrollPos);
     //document.getElementById('sys-notification1').scrollIntoView();
}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    
return fbl;
}

function val()
{
    try{
        //alert(checkemail());
       // checkemail();
        //checkcontact();
        if(checkemail() & checkcontact())
        {
           //alert("okeml");
           return guestcheckoutfn();
           //finalbl=false; 
        }
        else
        {
            
           // alert("val error");
        }
      
        
        
        
    }catch(ex){
    alert(ex);
    
     
}
 return false;
}



function paymethodop_test()
{

$.ajax({
                    url: 'paymentmethodstep5_test.php',
                    dataType: 'html',
                    success: function(html) {
                       // alert(html)
                        $('#collapse-payment-method .panel-body').html(html);

// comment by ( anand )    	$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 3: Payment Method <i class="fa fa-caret-down"></i></a>');
                     	$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle" style="margin-left: -96px;color:white"> Payment Method <i class="fa fa-caret-down"></i></a>');


						$('a[href=\'#collapse-payment-method\']').trigger('click');

						$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('ORDER TRACKING');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });

}



function paymethodop()
{

$.ajax({
                    url: 'paymentmethodstep5.php',
                    dataType: 'html',
                    success: function(html) {
                        $('#collapse-payment-method .panel-body').html(html);

						$('#collapse-payment-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-payment-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 3: Payment Method <i class="fa fa-caret-down"></i></a>');

						$('a[href=\'#collapse-payment-method\']').trigger('click');

						$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('Step 4: ORDER TRACKING');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });

}


/*
function validation&Billdetails(){
    
   var fullname= $("#fullname").val(); 
    var plotNo= $("#plotNo").val(); 
    var wingNo= $("#wingNo").val(); 
    var buildingName= $("#buildingName").val(); 
    var roadNo= $("#roadNo").val(); 
    var landmark= $("#landmark").val(); 
    var locality= $("#locality").val(); 
   var zone= $("#input-payment-zone").val(); 
    var city= $("#city").val(); 
    var pincode= $("#pincode").val(); 
  
   
   if(fullname==""){
       swal("Please enter fullname");
  return false;
   }
   else if(plotNo){
       swal("Please enter plot No");
        return false;
   }
   else if(wingNo){
       swal("Please enter wing No");
        return false;
   }
   else if(buildingName){
       swal("Please enter building Name");
        return false;
   }
   else if(roadNo){
       swal("Please enter road No");
        return false;
   }
   else if(landmark){
       swal("Please enter landmark");
        return false;
   }
   else if(locality){
       swal("Please enter locality");
        return false;
   }
   else if(zone){
       swal("Please enter zone");
        return false;
   }
   else if(city){
       swal("Please enter city");
        return false;
   }
   else if(pincode){
       swal("Please enter pincode");
        return false;
   }
   else{
       
      return true; 
      loginuserbilldetailsfunc_test();
   }
   
   
   
}*/




function loginuserbilldetailsfunc_test()
{
    
    try
    {
       var data = new FormData( $( 'form#usenewaddr' )[ 0 ]);
    
    $.ajax({
        url: 'addnewaddressuser_test.php',
        type: 'post',
        processData: false,
      contentType: false,
      data: data,
        beforeSend: function() {
       		$('#button-payment-address').button('loading');
	    },
        success: function(msg) {
           // alert("ram"+ msg);
             $('#button-payment-address').button('reset');

if(msg==2)
{
    
     document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Sorry session expired'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
var scrollPos =  $("#notification1").offset().top;
 $(window).scrollTop(scrollPos);
window.open("index.php",'_self');    
}
else if(msg==1)
{
 paymethodop_test();
//window.location.reload();
}
else
{
 document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Some error occured please try again'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';    
    var scrollPos =  $("#notification1").offset().top;
 $(window).scrollTop(scrollPos);
     //document.getElementById('sys-notification1').scrollIntoView();
}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    
        
        
    
    }catch(ex)
    {
        alert(ex);
        
    }
    
 return false;   
}










function loginuserbilldetailsfunc()
{
    
    try
    {
    if(document.getElementById('payment_address').checked==true & document.getElementById('address_id').length>0)
    {
        
        paymethodop();
    }
    else if(document.getElementById('payment_address2').checked==true)
    {
        
        
        var data = new FormData( $( 'form#usenewaddr' )[ 0 ]);
   // alert("ok");
    $.ajax({
        url: 'addnewaddressuser.php',
        type: 'post',
        processData: false,
      contentType: false,
      data: data,
        beforeSend: function() {
       		$('#button-payment-address').button('loading');
	    },
        success: function(msg) {
            alert(msg);
             $('#button-payment-address').button('reset');

if(msg==2)
{
    
     document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Sorry session expired'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
var scrollPos =  $("#notification1").offset().top;
 $(window).scrollTop(scrollPos);
window.open("index.php",'_self');    
}
else if(msg==1)
{
 paymethodop();
//window.location.reload();
}
else
{
 document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Some error occured please try again'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';    
    var scrollPos =  $("#notification1").offset().top;
 $(window).scrollTop(scrollPos);
     //document.getElementById('sys-notification1').scrollIntoView();
}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    
        
        
    }
    }catch(ex)
    {
        alert(ex);
        
    }
    
 return false;   
}


$(document).delegate('#button-payment-method', 'click', function() {
    
    try
    {
    if(document.getElementById('chagree').checked==false)
    {
        $('.alert, .text-danger').remove();
var element2 = $('#button-payment-method');
$(element2).after('<div class="text-danger">' +'Please agree with terms and conditions ' + '</div>');
$('.text-danger').parent().addClass('has-error');
element2.focus(); 
    }else
    {
       $('.alert, .text-danger').remove(); 
   
      
       
        <?php if($_GET["Pid"]!=""){ ?> var pid=<?php echo $_GET["Pid"];?>;<?php } else { ?> var pid="";<?php }?>
          
       <?php if($_GET["cId"]!=""){ ?> var cid=<?php echo $_GET["cId"];?>;<?php } else { ?> var cid="";<?php }?>
          
       <?php if($_GET["qty"]!=""){ ?> var qty=<?php echo $_GET["qty"];?>;<?php } else { ?> var qty="";<?php }?>
          
         <?php if($_GET["clr"]!=""){ ?> var clr=<?php echo $_GET["clr"];?>;<?php } else { ?> var clr="";<?php }?>
         
         <?php $sss=$_GET["sz"];?>
       
      // alert(<?php //echo $sss; ?>);
            <?php if($sss!=""){ ?> var szz=<?php echo $sss;?>;<?php } else { ?> var szz="";<?php }?>
         
        
      
    // alert("hi"+szz)
      
       
        $.ajax({     
                    url: 'paymentstep6confirm.php',
                    data:'pid='+pid+'&cid='+cid+'&qty='+qty+'&clr='+clr+'&sz='+szz,
                    dataType: 'html',
                    complete: function() {
                        $('#button-payment-method').button('reset');
                    },
                    success: function(html) {
                       // alert(html)
                        
                        $('#collapse-checkout-confirm .panel-body').html(html);

						$('#collapse-checkout-confirm').parent().find('.panel-heading .panel-title').html('<a href="#collapse-checkout-confirm" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle" style="margin-left: -96px;"> Order Status<i class="fa fa-caret-down"></i></a>');

						$('a[href=\'#collapse-checkout-confirm\']').trigger('click');
				 $("#button-confirm").click(); 
			
					},
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
    }
    }catch(ex)
    {
        
        alert(ex);
    }
    
});



function confirmfunc()
{
    try
    {
        var addressid="";
        <?php 
        if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!="")
        {
        ?>
         
        addressid=document.getElementById("address_id").value;
        
        <?php } ?>
       
       
		var ctid=document.getElementById('cartids').value;
		var cCod=document.getElementById('cCod').value;
		var cSize=document.getElementById('cSize').value;
       // var qtty=document.getElementById('qtty').value;

        
		//var paymode=$('input[name=payment_method]:checked').val();
		var paymode1=$("input:radio[name='payment_method']:checked").val();
		//alert(paymode1);
		$.ajax({
		    type: 'post',
        url: 'paymentstep6confirmprocess.php',
        
        data:'ctid='+ctid+'&paymode='+paymode1+'&addressid='+addressid+'&cCod='+cCod+'&cSize='+cSize,
        beforeSend: function() {
        	$('#button-confirm').button('loading');
		},
        complete: function() {
           $('#button-confirm').button('reset');
        },
        success: function(msg) {
           //alert(msg);
           if(msg==2)
		    {
		        
		        
		        toastfunc("sorry your session has been expired");
		        window.open("index.php","_self");
		    }
		    else if(msg>0)
		    {
		          document.getElementById('orderno').value=msg;
		       document.getElementById('OrderNumber').innerHTML="Order Number :- "+msg;
		     

		         //document.getElementById('shwdata').innerHTML=" Your order has been successfully processed! <br />Thanks for shopping with us online! <br /> your Order id is "+msg;
		        
		  //       document.getElementById('confirmordpg').submit();
		  
		  popup('10','');
		  
		    }else{
		        
		        toastfunc("Some error occured please try again");
		        //window.open("index.php");
		    }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    }catch(exc)
    {
        alert(exc);
    }
		
}




function confirmfunc420()
{
    try
    {
        var addressid="";
        <?php 
        if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!="")
        {
        ?>
        addressid=document.getElementById("address_id").value;
        
        <?php } ?>
        
        var prdid=document.getElementById('prdid').value;
		var cate_id=document.getElementById('cate_id').value;
		var pric=document.getElementById('pric').value;
        
         
		var ctid=document.getElementById('cartids').value;
		var cCod=document.getElementById('cCod').value;
		var cSize=document.getElementById('cSize').value;

		//var paymode=$('input[name=payment_method]:checked').val();
		var paymode1=$("input:radio[name='payment_method']:checked").val();
		//alert(paymode1);
		$.ajax({
		    type: 'post',
        url: 'paymentstep6confirmprocess.php',
        
        data:'ctid='+ctid+'&paymode='+paymode1+'&addressid='+addressid+'&cCod='+cCod+'&cSize='+cSize+'&prdid='+prdid+'&cate_id='+cate_id+'&pric='+pric,
        beforeSend: function() {
        	$('#button-confirm').button('loading');
		},
        complete: function() {
           $('#button-confirm').button('reset');
        },
        success: function(msg) {
           // alert(msg);
           if(msg==2)
		    {
		        toastfunc("sorry your session has been expired");
		        window.open("index.php","_self");
		    }
		    else if(msg>0)
		    {
		        document.getElementById('orderno').value=msg;
		       //  document.getElementById('confirmordpg').submit();
		    }else{
		        
		        toastfunc("Some error occured please try again");
		        //window.open("index.php");
		    }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    }catch(exc)
    {
        alert(exc);
    }
		
}

</script>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->


</div></div>
 
<footer id="footer" class="nostylingboxs">
 
  

  <?php include("footer.php")?>

</footer>
 
 
<div id="powered">
  <?php include('footerbottom.php')?>

</div>

  
<script type="text/javascript">
/*$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );
*/
</script>


<script type="text/javascript">
$('#myTab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})
$('#myTab a:first').tab('show'); 
 

var $MAINCONTAINER = $("html");

/**
 * BACKGROUND-IMAGE SELECTION
 */
$(".background-images").each( function(){
	var $parent = this;
	var $input  = $(".input-setting", $parent ); 
	$(".bi-wrapper > div",this).click( function(){
		 $input.val( $(this).data('val') ); 
		 $('.bi-wrapper > div', $parent).removeClass('active');
		 $(this).addClass('active');

		 if( $input.data('selector') ){  
			$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'url('+ $(this).data('image') +')' );
		 }
	} );
} ); 

$(".clear-bg").click( function(){
	var $parent = $(this).parent();
	var $input  = $(".input-setting", $parent ); 
	if( $input.val('') ) {
		if( $parent.hasClass("background-images") ) {
			$('.bi-wrapper > div',$parent).removeClass('active');	
			$($input.data('selector'),$("#main-preview iframe").contents()).css( $input.data('attrs'),'none' );
		}else {
			$input.attr( 'style','' )	
		}
		$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'inherit' );

	}	
	$input.val('');

	return false;
} );



 $('.accordion-group input.input-setting').each( function(){
 	 var input = this;
 	 $(input).attr('readonly','readonly');
 	 $(input).ColorPicker({
 	 	onChange:function (hsb, hex, rgb) {
 	 		$(input).css('backgroundColor', '#' + hex);
 	 		$(input).val( hex );
 	 		if( $(input).data('selector') ){  
				$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'),"#"+$(input).val() )
			}
 	 	}
 	 });
	} );
 $('.accordion-group select.input-setting').change( function(){
	var input = this; 
		if( $(input).data('selector') ){  
		var ex = $(input).data('attrs')=='font-size'?'px':"";
		$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'), $(input).val() + ex);
	}
 } );
 

</script>
</div>
<div class="sidebar-offcanvas visible-xs visible-sm">
    <div class="offcanvas-inner panel-offcanvas">
        <div class="offcanvas-heading clearfix">
            <button data-toggle="offcanvas" class="btn btn-v2 pull-right" type="button"><span class="zmdi zmdi-close"></span></button>
        </div>
        <div class="offcanvas-body">
            <div id="offcanvasmenu"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#offcanvasmenu").html($("#bs-megamenu").html());
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</body></html>
<?php }else
{
?>
<script>
    
    window.open("cart.php","_self");
    
</script>
<?php } ?>




