<?php 
session_start();
include("config.php");

if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){
    
    header("location:index.php");
}else
{
?>
<!DOCTYPE html>

<html dir="ltr" class="ltr" lang="en">
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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  width: 25%;
  position: fixed;
  z-index: 0;
  /*top: 120px;*/
  top:19%;
  /*left: 49px;*/
  /*background: white;*/
  /*background: #235b86;*/
  background: #f3f4f5;
  overflow-x: hidden;
  padding: 8px 40px;
  height: -webkit-fill-available;
  box-shadow: 3px 6px #8888882e;
}

.sidenav a {
  padding: 1px 0px 0px 10px;
  text-decoration: none;
  font-size: 13px;
  /*color: #2196F3;*/
  /*color:#fff;*/
  color: black;
  display: block;
}

.sidenav a:hover {
  color: #666;
  background: white;
}

.main {
  margin-left: 19%; /* Same width as the sidebar + left position in px */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

</head>
<body style="background-color:white">
    <!-- header -->
 <div style="position: fixed;z-index:1 " >
<header id="header-layout" class="header-v2">
     <div id="header-main" >
        <div >
            <div class="row" >
            <?php include('menucopy.php')?>
            </div>
        </div>
     </div>
</header>
</div>
<!-- /header -->
<div class="sidenav">
 <h4 style="color: black;">My Account</h4>
      <ul class="list-unstyled" >
        <li><a href="#expe1" id="" style="font-size:14px" >Edit account</a></li>
        <li><a href="#expe2" style="font-size:14px">Change password</a></li>
       <!-- <li><a href="addressbookentries.php">Modify your address book entries</a></li>-->  <!------  comment by anand ------->
        <li><a href="#expe3" style="font-size:16px">wish list</a></li>
        <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?>
            <li ><a onclick="popup('9','')">Gift Certificates</a></li>
            <?php }else{ ?>
             <li ><a  onclick="popup('1','myaccount')">Gift Certificates</a></li>
             <?php } ?>
      </ul>
      <h4 style="color: black;">My Products</h4>
      <ul class="list-unstyled">
        <li><a href="#expe5" style="font-size:14px">Upload Resale Products</a></li>
        <li><a href="#expe6" style="font-size:14px">View My Uploaded Products</a></li>
      </ul>
      <h4 style="color: black;">My Reports</h4>
      <ul class="list-unstyled">
        <li><a href="#" style="font-size:14px">View Sold Products</a></li>
        <li><a href="#" style="font-size:14px">View My Transactions</a></li>
      </ul>
      <h4 style="color: black;">My Orders</h4>
      <ul class="list-unstyled">
        <li><a href="#expe4" style="font-size:14px">View order history</a></li>
        <li><a href="logout.php" style="font-size:14px">Logout</a></li>
      </ul>
    </div>
<div class="main" >
   <div class="resume" id="expe1" >
    <iframe  src="http://sarmicrosystems.in/oc1/RegisterWithoutHeaderORFooter.php" style="width:1077px;height:800px;margin-top:119px;margin-bottom: -9px;border: 0;"></iframe>
   </div>
   <div class="resume" id="expe2" >
    <iframe  src="http://sarmicrosystems.in/oc1/changepassWithoutHeader.php" style="width:1077px;height:800px;margin-top:119px;margin-bottom: -9px;border: 0;"></iframe>
   </div>
   <div class="resume" id="expe3" >
    <iframe  src="http://sarmicrosystems.in/oc1/WishListWithoutHeader.php" id="foo" style="width:1077px;height:800px;margin-top:119px;margin-bottom: -9px;border: 0;"></iframe>
   </div>
   <div class="resume" id="expe4" >
    <iframe  src="http://sarmicrosystems.in/oc1/OrderHistoryWithoutHeader.php"  style="width:1077px;height:800px;margin-top:119px;margin-bottom: -9px;border: 0;"></iframe>
   </div>
   <div class="resume" id="expe5" >
    <iframe  src="http://sarmicrosystems.in/oc1/resale_AddProduct.php" style="width:1077px;height:800px;margin-top:119px;margin-bottom: -9px;border: 0;"></iframe>
   </div>
   <div class="resume" id="expe6" >
    <iframe  src="http://sarmicrosystems.in/oc1/view_resale_products.php" style="width:1077px;height:800px;margin-top:119px;margin-bottom: -9px;border: 0;"></iframe>
   </div>
</div>
<footer id="footer" class="nostylingboxs">
  <?php include("footer.php")?>
</footer>
 
 
<div id="powered">
  <?php include('footerbottom.php')?>
</div>
</body>
</html> 

<style>
.resume{
  display: none;
}
/*.resume2{
  display: none;
}
.resume3{
  display: none;
}
.resume4{
  display: none;
}
*/

</style>

<script>

$('#expe1').show();

jQuery(document).ready(function($) {
$('a[href^="#"]').on('click', function(event) {

   //var target = $( $(this).attr('href') );
    //target.fadeToggle(100);
    
    
   $('a[href="#expe1"]').click(function(){
       $('#expe1').show();
        $('#expe2').hide();
         $('#expe3').hide();
           $('#expe4').hide();
           $('#expe5').hide();
           $('#expe6').hide();
   }); 
   
   $('a[href="#expe2"]').click(function(){
       $('#expe2').show();
        $('#expe1').hide();
         $('#expe3').hide();
           $('#expe4').hide();
           $('#expe5').hide();
           $('#expe6').hide();
   }); 
    
     $('a[href="#expe3"]').click(function(){
       $('#expe2').hide();
        $('#expe1').hide();
         $('#expe3').show();
           $('#expe4').hide();
           $('#expe5').hide();
           $('#expe6').hide();
   }); 
   
   $('a[href="#expe4"]').click(function(){
       $('#expe2').hide();
        $('#expe1').hide();
         $('#expe3').hide();
           $('#expe4').show();
           $('#expe5').hide();
           $('#expe6').hide();
   }); 
   $('a[href="#expe5"]').click(function(){
       $('#expe2').hide();
        $('#expe1').hide();
         $('#expe3').hide();
           $('#expe5').show();
           $('#expe4').hide();
           $('#expe6').hide();
   }); 
   $('a[href="#expe6"]').click(function(){
       $('#expe2').hide();
        $('#expe1').hide();
         $('#expe3').hide();
           $('#expe5').hide();
           $('#expe4').hide();
           $('#expe6').show();
   }); 
    
    
    /*if( target.length ) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 2000);
    }*/

});
});


    

$(window).scroll(function(){
   
    var scrolled = $(window).scrollTop();
    // alert(screen.height)
    if(scrolled > 440){
 //alert(scrolled)
        $(".sidenav").css({"position":"absolute"});
       
    } else{
        $(".sidenav").css({"position":"fixed"});
    }
});


</script>

<? } ?>