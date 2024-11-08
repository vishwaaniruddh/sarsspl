<?php 
session_start();
include("config.php");
//$pid=300;
$pid=$_GET['prid'];
$cid=$_GET['catid'];
$regid= $_SESSION['gid'];
 $loginstats=$_SESSION['loginstats'];
//echo $regid;
//echo $loginstats;

$qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,product_type FROM `Resale` WHERE code='".$pid."'";

$qrylatfrws=mysqli_query($con1,$qrylatf);   
$latstprnrws=mysqli_fetch_array($qrylatfrws);

?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->

<html dir="ltr" class="ltr" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Merabazaar</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
     	<link href="http://sarmicrosystems.in/oc1/image/catalog/cart.png" rel="icon" />
    	<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
    	<script type="text/javascript" src="requiredfunctions.js"></script>
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
        <script src="js/vendor/jquery.js"></script>
        <!-- xzoom plugin here -->
        <script type="text/javascript" src="dist/xzoom.min.js"></script>
        <!--<link rel="stylesheet" type="text/css" href="css/xzoom.css" media="all" />--> 
        <!-- hammer plugin here -->
        <script type="text/javascript" src="hammer.js/1.0.5/jquery.hammer.min.js"></script> 
        <script src="js/setup.js"></script>
        <script src='jquery.elevatezoom.js'></script>
        <style>
            video::-webkit-media-controls {
              display: none;
            }
    /* Could Use thise as well for Individual Controls */
video::-webkit-media-controls-play-button {}

video::-webkit-media-controls-volume-slider {}

video::-webkit-media-controls-mute-button {}

video::-webkit-media-controls-timeline {}

video::-webkit-media-controls-current-time-display {}

#notification {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
}

#notification.showalrt{
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
</style>
<style>
.rating-wrapper {
  overflow: hidden;
  display: inline-block;
}

.rating-input {
  position: absolute;
  left: 0;
  top: -50px;
  display: none;
}

.rating-star:hover,
.rating-star:hover ~ .rating-star {
  background-position: 0 0;
}

.rating-wrapper:hover .rating-star:hover,
.rating-wrapper:hover .rating-star:hover ~ .rating-star,
.rating-input:checked ~ .rating-star {
  background-position: 0 0;
}

.rating-star,
.rating-wrapper:hover .rating-star {
  float: right;
  display: block;
  width: 18px;
  height: 18px;
  padding:5px;
  background: url('http://css-stars.com/wp-content/uploads/2013/12/stars.png') 0 -16px;
}
</style>
<!--=================Code For color checkbox tick End============================-->

<style>
html, body {
  height: 100%;
  width: 100%;
  margin: 0;
}

.custom-radios div {
  display: inline-block;
}
.custom-radios input[type="radio"] {
  display: none;
}
.custom-radios input[type="radio"] + label {
  color: #333;
  font-family: Arial, sans-serif;
  font-size: 14px;
}
.custom-radios input[type="radio"] + label span {
  display: inline-block;
  width: 40px;
  height: 40px;
  margin: -1px 4px 0 0;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 50%;
  border: 2px solid #FFFFFF;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
  background-repeat: no-repeat;
  background-position: center;
  text-align: center;
  line-height: 44px;
}
.custom-radios input[type="radio"] + label span img {
  opacity: 0;
  transition: all .3s ease;
}

.custom-radios input[type="radio"]:checked + label span {
  opacity: 1;
  background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg) center center no-repeat;
  width: 40px;
  height: 40px;
  display: inline-block;
}
</style>

<!--=================Code For color checkbox tick <End>============================-->

<!--==================Code For Size Seleted Color change <Start >======================-->
<style>
.radio-toolbar input[type="radio"] {
  display: none;
}

.radio-toolbar label {
  display: inline-block;
  background-color: #ddd;
  padding: 4px 11px;
  font-family: Arial;
  font-size: 16px;
  cursor: pointer;
}

.radio-toolbar input[type="radio"]:checked+label {
  background-color: #AED6F1;
}
</style>
<!--==================Code For Size Seleted Color change <END>======================-->
<style>
.button {
  padding: 6px 20px;
  font-size: 15px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: black;
  background-color: #6ebaf1;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #6ebaf1}

.button:active {
  background-color: #ffd400;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
<script>

function addcart2(prodid)
{
    try
    {
        var qt=document.getElementById('input-quantity').value;
        var colrcod=document.getElementById('colrcod').value;
        var colrsize=document.getElementById('colrsize').value;
        var cid=document.getElementById('cid').value;
        // alert("this1");
        $.ajax({
           type: 'POST',    
            url:'addcart.php',
            data:'pid='+prodid+'&qty='+qt+'&colrcod='+colrcod+'&colrsize='+colrsize+'&cid='+cid,
            success: function(msg){
                //alert(msg);
                updatecart();
             
                //addincart();
                //funcs('','');
                if(msg==2)
                {
                     toastfunc("sorry your session has been expired");
                    //alert("sorry your session has been expired");
                }
                else if(msg==1)
                {
                 toastfunc("Product added to cart successfully");
                }else if(msg==3)
                {
                    toastfunc("Product is out of stock");
                }else if(msg==4)
                {
                    toastfunc("Maximum product entered");
                }
                else
                {
                toastfunc("Error Please  try again after some time");
                }
                //document.getElementById('show').innerHTML=msg;
            }
        });
    } catch(exc)
    {
        alert(exc);
    }
}

function shfunc(imgr,imgr2)
{
    try
    {
    //alert(imgr);
    
    //$('#image').attr("src",imgr);
    //$('#xzoom-default').attr("src",imgr);
    //$('#xzoom-default').remove();
    //$('#image').removeData('elevateZoom');
    //alert(imgr);
    //$('#b').remove();
    $('.zoomContainer').remove();
    $('.zoomWindowContainer').remove();
    $('#image').attr("src",imgr);
    $('.imagezoom').remove();
    $('#image').remove();
    $('.elevateZoom').remove();
    $('#image').removeData('elevateZoom');
    
    var nm='<a href='+imgr+' title="" class="elevateZoom" target = "_blank">';
    nm=nm+'<img src='+imgr+' title="" alt="" id="image" style="height:350px;width:100%;object-fit: contain"  data-zoom-image='+imgr2+' class="product-image-zoom img-responsive"/></a>';
                     
    //document.getElementById("imgzm").innerHTML=nm;
    document.getElementById("b").innerHTML=nm;   
    $('.xzoom, .xzoom-gallery').xzoom({zoomWidth: 400, title: true, tint: '#333', Xoffset: 15});
    /*	var zoomCollection = '#image';
    		$( zoomCollection ).elevateZoom({
    				lensShape : "basic",
    		lensSize    : 150,
    		easing:true,
    		gallery:'image-additional-carousel',
    		cursor: 'pointer',
    		galleryActiveClass: "active"
    	});*/
     
    $('#image').elevateZoom({
       /*responsive: true,
        zoomWindowWidth:400,
        zoomWindowHeight:400,
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 50,
        scrollZoom : true*/
        zoomWindowFadeIn: 500,
		zoomWindowFadeOut: 500,
		lensFadeIn: 500,
		lensFadeOut: 500
      });
    }catch(ex)
    {
       alert(ex); 
    }
}
</script>
<style>
    .sliderct{
         border: 1px solid #f0f0f0;
    }
    .sliderct:hover{
        border: 1px solid #000;    
    }
</style>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
  
    border-radius:25px;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;
    margin-top:14px;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #a4d9ff;
    color: white;
    
    border-top-left-radius:25px;
     border-top-right-radius:25px;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}
</style>
<script>
 
 
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
  </script>
 

      </head>
  <body id="bd" class="common-home page-common-home layout-fullwidth" >
       <input type="hidden" name="adplid" id="adplid" readonly>
       <input type="hidden" name="ccode" id="ccode" value="<?php echo $latstprnrws['ccode']; ?>">
       <input type="hidden" name="pid" id="pid" value="<?php echo $_GET['prid']; ?>">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
 

<header id="header-layout" class="header-v2">
     <div id="header-main">
        <div class="">
            <div class="">
            <?php include('resale_menu.php')?>
            </div>
        </div>
    </div>
</header>
        <!-- /header -->
 
        <!-- sys-notification -->
        
        <div id="sys-notification">
          <div class="container">
            <div id="notification">
                
            </div>
          </div>
        </div>
        <!-- /sys-notification -->
 <div class="row">
    <div class="col-md-11">
        <div class="breadcrumbs space-30">
            <div class="container" >  
	            <div class="container-inner" style="height: 35px;width:1307px;padding-top: 5px;">
	                <ul class="list-unstyled breadcrumb-links">
						<li><a href="index.php"><i class="fa fa-home"></i></a></li>
						<li><a href="product.php?mdi=<?php echo $fbrws['id'];?>">Resale</a></li>
						<li><a ><?php echo $latstprnrws['product_type'];?></a></li>
						<li><a href="javascript:void(0);"><b><?php echo $latstprnrws['name'];?></b></a></li>
						<!--<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69">Mens</a></li>
						<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_67">T-Shirt</a></li>-->
					</ul>
				</div>
            </div>
        </div>        
    </div>
    <div class="col-md-1">
            <a href="resale_index.php"> <img src="image/back-button.png"  style="width: 80px;height: 33px;left: 1156px;top: 65px;"/></a>
         </div>
    </div>
<div class="main-columns container" style="margin-left: 11px;">
  <div class="row">
	  <div id="sidebar-main" class="col-sm-12 col-xs-12">
		<div id="content">
            <div class="product-info"   style="padding-top:0px;"  >
                <div class="row">
                    <?php
                        $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
                        $frtu=mysqli_fetch_array($sqlimg23mn);
                        //echo $prodimgpth.$frtu['img'];
                    ?>
                    <?php
                    //echo $prodimgpth.$frtu['img'];
                    // echo $prodimgpth.$frtu['img'];
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 "   >
                       <style>
                        #sticky{
                        position: fixed;
                        height: 35px;
                        width: 45%;
                        color: white;   
                        background-color: #;
                        height:500px;
                        }
                        
                       #sticky::after{
                        position: fixed;
                        margin-top:-200px; 
                        background-color: #;
                        height:500px;
                        }
                        </style>
                        <div class="row" id="">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 " style="margin-top: -20px;">
                              <div class="thumbs-preview horizontal thumbnails">
                                
                                <?php include('resale_sidebarimg.php') ?>
                		       </div>
                		    </div>
                            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 ">
                                <!-- <div class="xzoom-container">
                                <!-- <img class="xzoom" id="xzoom-default" src="images/gallery/preview/01_b_car.jpg" xoriginal="images/gallery/original/01_b_car.jpg" />-->
                                <!-- <div id="aaa"> 
                                <img id="xzoom-default" src="<?php echo $prodimgpth.$frtu['midsize'];?>" xoriginal="<?php echo $prodimgpth.$frtu['img'];?>"  
                                class="xzoom"  style="width:450px; height:450px"/>
                                </div>
                                </div>    -->
                                <div id="a" class="" style="border: 1px solid #f0f0f0;">
                                    <center >
                                        <div id="b">
                                            <a href="<?php echo $prodimgpth.$frtu['img'];?>" title="<?php echo $latstprnrws['name'];?>" class="elevateZoom" target = '_blank'>
                                                <img src="<?php echo $prodimgpth.$frtu[2];?>" title="<?php echo $latstprnrws['name'];?>" alt="<?php echo $latstprnrws['name'];?>" id="image"
                                                style="height:350px;width:100%;object-fit:contain" data-zoom-image="<?php echo $prodimgpth.$frtu[3];?>" class="product-image-zoom img-responsive"/>
                                            </a> 
                                        </div>
                                    </center>
                                </div>
                                  <?php 
                                  $fstar=mysqli_query($con1,"SELECT count(product_id) FROM `product_review` where product_id='".$pid."' and category_id='".$cid."'"); 
                        	      $fstarftc=mysqli_fetch_array($fstar);
                                  ?>
                                <div class="box-product-infomation tab-v2 tabs-left" style="width:100%">
                                    <div class="">
                                        <!--<div class="tab-content text-left">-->
                                           <!-- <div class="tab-pane active" id="tab-description">
                                                  <p class="intro">
                                        </div>-->
                                        <div class="tab-pane active"  id="tab-review">
                                            <div id="review" class="space-20">
                                                <?php 
                                                $S=1;
                                                $R=4;
                                                $getreview=mysqli_query($con1,"SELECT `review_id`, `user_id`, `product_id`, `rating_count`, `description`, `date_time` FROM `product_review` where product_id='".$pid."' and category_id='".$cid."' order by review_id desc"); 
        					   
                    						    while($getreviewarr=mysqli_fetch_array($getreview)){
                    						       if($S<=$R) 
                    						         {
                                                        //$getnam=mysqli_query($con1,"SELECT Firstname FROM Registration where id='".$pid."'"); 
                                                        $getnam=mysqli_query($con1,"SELECT Firstname FROM Registration where id='".$getreviewarr[1]."'"); 
                                                        $getnamarr=mysqli_fetch_array($getnam);
                                                ?>
                                                <?php } $S++ ;}?>
                                            </div>
                                            <?php if($fstarftc[0]>4){?>
                                                <a target="_blank" class="popup-with-form btn btn-sm btn-primary" style="float: right;height:30px" href="review.php?pid=<?php echo $pid;?>&cid=<?php echo $cid;?>">More</a>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
            		    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                        <!--  <div class="product-info-bg">
                            <h1 class="title-product" style="font-size:23px"><?php echo $latstprnrws['name'];?></h1>
                        </div>
                        <div class="border-success space-30">
                            <ul class="list-unstyled">
                                <li><b>Product Code:</b> <?php echo $latstprnrws['code'];?></li>
                            </ul>
                        </div>-->
                        <!--    <div class="price detail space-20">
                            <ul class="list-unstyled"  style="margin-top: 55px;">
                                <li >
                                    <span class="price-new"><i class="fa fa-inr "></i> <?php echo $latstprnrws['total_amt'];?></span>
                                    <?php if($latstprnrws['discount']>0){?>
                                        <span class="price-old">$<?php echo $latstprnrws['price'];?></span> 
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>-->
                        <style>
                        * {
                            box-sizing: border-box;
                        }
                        
                        /* Create two equal columns that floats next to each other */
                        .column2 {
                            float: left;
                            width: 70%;
                            padding: 10px;
                            /* Should be removed. Only for demonstration */
                        }
                        .column1 {
                            float: left;
                            width: 30%;
                            padding: 10px;
                             /* Should be removed. Only for demonstration */
                        }
                        /* Clear floats after the columns */
                        .row:after {
                            content: "";
                            display: table;
                            clear: both;
                        }
                        </style>
                        <div class="row">
                            <div class="column2" >
                                <div class="product-info-bg">
                                   <h1 class="title-product" style="font-size:24px;margin-top: 0px;font-family:initial"><?php echo $latstprnrws['name'];?></h1>
                                </div>
                                <!-- style="border: 1px solid #f0f0f0;"-->
        <div class="row" >
            <div class="col-md-12" ><h2 style="font-size:13px;">Product Description</h2></div>
            <div class="col-md-12" >
                <p>
                    <?php  //echo $latstprnrws['Long_desc'];
                    $str = $latstprnrws['description'];
                    echo  $str;
                    /*   echo wordwrap($str,50,"<br>\n",TRUE);*/
                    ?>
                </p>
            </div>
        </div>
        <div class="row" style=" margin-top:0px;">
            <div class="col-md-12" style=" font-size:13px;"><h2 style="font-size:13px;font-family:initial">Specifications</h2></div>
            <div class="col-md-12" style="">
                <table>
                    <tr>
                        <?php 
                         $qry=mysqli_query($con1,"SELECT product_specification,specificationname from ResaleSpecification where product_id='".$pid."'");
                         while($fetcspcf=mysqli_fetch_array($qry)){
                         ?>
                        <div class="col-md-4"><p style="color:#0606068c"><?php echo $fetcspcf[0]; ?></p></div>
                        <div class="col-md-8"> <p> <?php echo $fetcspcf[1]; ?></p> </div> 
                        <?php } ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="column1" >
        <br /><br />
        <div class="border-success space-30">
            <ul class="list-unstyled">
                <li><b>Product Code:</b> <?php echo $latstprnrws['code'];?></li>
            </ul>
        </div>
        <div class="price detail space-20">
            <ul class="list-unstyled"  style="margin-top: 30px;">
                <li >            
                    <span class="price-new"><i class="fa fa-inr "></i> <?php echo $latstprnrws['price'];?></span>
                    <?php if($latstprnrws['discount']>0){?>
                        <span class="price-old"><!--$<?php //echo $latstprnrws['price'];?>--></span> 
                    <?php } ?>
                </li>
            </ul>
         </div>
        <div class="cart pull-left" style="padding-left: 0px;width: 168px;">
            <button class="btn" id="myBtn" style="width:204px;padding-left:8px;padding-right:6px;" onclick="checkLogin()">Contact Seller</button>
            <div class="row " style="margin-top:20px;" >
                <!-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="cart pull-left" style="padding-left: 0px;">
                <button class="btn" id="myBtn">Contact Seller</button>
                </div>
                </div>-->
                <!-- Trigger/Open The Modal -->
                <!--<button id="myBtn">Open Modal</button>-->
                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content" style="height: 170px;width: 345px;border-radius: 23px;">
                        <div class="modal-header" style="padding-bottom: 0px;padding-top: 1px;">
                          <span class="close" style="margin-top:14px">&times;</span>
                          <h2 id="hdtext1" style="font-family:monospace;margin-top:11px;text-align:center">Enter Mobile Number</h2>
                           <h2 id="hdtext2" style="display:none;font-family:monospace;margin-top:11px;text-align:center">Enter OTP Number</h2>
                           <h2 id="hdtext3" style="display:none;font-family:monospace;margin-top:11px;text-align:center">Seller Details</h2>
                        </div>
                        <div class="modal-body" style="padding:7px">
                            <div id="hd3" style="display:none;margin-top: 17px;" class="container" >
                                <div class="row">
                                    <div class="col-sm-1" style="width:9.33333%;font-family:Comic Sans MS">Seller Name: </div>
                                    <div class="col-sm-1" >
                                        <input type="text" id="seller_name" value="Anand Gupta" style="border-color:lightgoldenrodyellow;padding-left:11px;width: 172px;font-family:Comic Sans MS" readonly>
                                    </div>
                                </div> <br />
                                 <div class="row">
                                    <div class="col-sm-1"  style="width:9.33333%;font-family:Comic Sans MS">
                                      Mobile No:
                                    </div>
                                    <div class="col-sm-1" >
                                     <input type="text" id="seller_mobile" value="9876055121" style="border-color:lightgoldenrodyellow;padding-left:11px;width: 172px;font-family:Comic Sans MS" readonly>
                                    </div>
                                </div>
                            </div> <br /> <br />  
                            <div id="hd1" style="font-family:Comic Sans MS;">
                              Mobile No: <input type="text" id="txt_mobile" name="txt_mobile" style="border-color:lightgoldenrodyellow;padding-left:11px;font-family:Comic Sans MS;width:166px"   maxlength="10" onkeypress="return isNumber(event)" />
                                <input type="button" value="Submit" class="button" onclick="validation1();" style="padding-top: 3px;padding-left: 6px;padding-right: 6px;width: 71px;"/>
                            </div>
                            <div id="hd2" style="display:none;font-family:Comic Sans MS;">
                             Enter OTP: <input type="text" id="txt_otp" name="txt_otp" style="border-color:lightgoldenrodyellow;padding-left:11px;font-family:Comic Sans MS;width:164px"/>
                                <input type="button" value="Submit" class="button" onclick="sendOTP()" style="padding-top: 3px;padding-left: 6px;padding-right: 6px;width: 71px;"/>
                            </div>
                        </div> <br /><br />
                        <!-- <div class="modal-footer">
                          <h3>Modal Footer</h3>
                        </div>-->
                    </div>
                </div>
            </div> 
            <script>
                $("#myBtn").click(function(){
                    var c="";
                    var a= <? echo $regid;?>;
                    var b= <? if($loginstats==""){echo "c";}else{echo $loginstats;} ?>;
                    if(a!="" && b!=""){
                        $("#hd1").hide();
                        $("#hdtext1").hide();
                       
                        $("#hd2").hide();
                        $("#hdtext2").hide();
                       
                        $("#hd3").show();
                        $("#hdtext3").show();
                        $("#hdtext3").focus();
                    }
                    else
                      {
                        $("#hd1").show();
                        $("#hdtext1").show();
                        $("#txt_mobile").focus();
                       
                        $("#hd2").hide();
                        $("#hdtext2").hide();
                       
                        $("#hd3").hide();
                        $("#hdtext3").hide();
                      }
                });
                function validation1(){
                    var mobile=document.getElementById('txt_mobile').value;
                    var pid=document.getElementById('pid').value;
                    var ccode=document.getElementById('ccode').value;
                    /*Ruchi */
                	$.ajax({
                		url: 'insert_data.php',
                		type: 'post',
                		data: 'mobile='+mobile+'&action=usercontact'+'&pid='+pid+'&ccode='+ccode,
                		success: function(msg) {
                		    var obj = JSON.parse(msg)
                			/*alert(obj[0].mobile);*/
                			$('#seller_name').val(obj[0].name);
                			$('#seller_mobile').val(obj[0].mobile);
                		}
	                });
                   
                    if(mobile!=""){
                        $("#hd1").hide();
                        $("#hdtext1").hide();
                        $("#hd3").hide();
                        $("#hdtext3").hide();
                   
                        $("#hd2").show();
                        $("#hdtext2").show();
                        $("#txt_otp").focus();
                    }
                }
                function sendOTP(){
                    var otp=document.getElementById('txt_otp').value;
                    if(otp!=""){
                        $("#hd1").hide();
                        $("#hdtext1").hide();
                       
                        $("#hd2").hide();
                        $("#hdtext2").hide();
                        
                        $("#hd3").show();
                        $("#hdtext3").show();
                    }
                }
            </script>
            <script>
            // Get the modal
            var modal = document.getElementById('myModal');
            
            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks the button, open the modal 
            btn.onclick = function() {
                modal.style.display = "block";
            }
            
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
            
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            </script>
        </div>
       <script>
        var qty = function(el) {
        return $(el).closest('div.quantity-adder').find('input[type=text][name=quantity]').eq(0);
        };
        var plus = function(e) {
            var q = qty(this);
            q.val(1 + (+q.val() || 0));
        };
        var minus = function(e) {
        var q = qty(this);
        var v = (+q.val() || 0) - 1;
        if (1 > v)
            v = 1;
            q.val(v);
        };
        $(function() {
          $('span.fa-plus').on('click', plus);
          $('span.fa-minus').on('click', minus);
        });
    </script>
    <div>
        <!--<div class="product-extra">-->
        <!-- 
        <div id="product">
            <div class="product-extra clearfix">
                <label class="control-label pull-left qty">Qty:</label>
                <div class="quantity-adder pull-left">
                    <span class="add-down add-action fa fa-minus pull-left"> </span>
                    <div class="quantity-number pull-left">
                        <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" onkeydown='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'/>
                    </div>                  
                    <span class="add-up add-action  fa fa-plus pull-left"></span>
                </div>
            </div>
            <?php if($latstprnrws['total_amt']>0){?>
            <div class="action pull-left">
                
                <div class="pull-left">
                    <a data-toggle="tooltip" class="wishlist" title="Add to Wish List" onclick="wishlistfunc('<?php echo $pid;?>');"><i class="fa-fw fa fa-heart"></i>Add to Wish List</a>
                </div>
                
                <div class="pull-left">
                    <a data-toggle="tooltip" class="compare" title="Compare this Product" onclick="comparefunc('<?php echo $pid;?>','<?php echo $cid;?>');"><i class="fa-fw fa fa-refresh"></i>Compare this Product</a>
                </div>
                
            </div>
            <?php } ?>
        </div>
        -->
    </div>
        <?php /*
        <div class="row" style="   border: 1px solid #f0f0f0;">
            <div class="col-md-12" style="   border: 1px solid #f0f0f0; "><h2 style="font-size:23px;">Product Description</h2></div>
            <div class="col-md-12" style="border: 1px solid #f0f0f0;">
                <p>
                    <?php echo $latstprnrws['others']; ?>
                </p>
            </div>
        </div>
        <div class="row" style="   border: 1px solid #f0f0f0; margin-top:10px;">
            <div class="col-md-12" style="   border: 1px solid #f0f0f0; font-size:23px;"><h2 style="font-size:23px;">Specifications</h2></div>
                <div class="col-md-12" style="   border: 1px solid #f0f0f0;">
                    <table>
                        <tr>
                            <?php 
                            $qry=mysqli_query($con1,"SELECT product_specification,specificationname from ResaleSpecification where product_id='".$pid."'");
                            while($fetcspcf=mysqli_fetch_array($qry)){
                            ?>
                                <div class="col-md-4"><p style="color:#212121"><?php echo $fetcspcf[0]; ?></p></div>
                                <div class="col-md-8"> <p> <?php echo $fetcspcf[1]; ?></p> </div> 
                            </div>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
           */?>
        </div>
    </div><!-- End div bg -->
</div>
</div>
</div>
</div>
</div>
</div>
<footer id="footer" class="nostylingboxs">
  <?php include("resale_footer.php")?>
</footer>
 
 
<div id="powered">
  <?php include('footerbottom.php')?>
</div>

  
<script type="text/javascript">



/*$('#review').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});*/

//$('#review').load('index.php?route=product/product/review&product_id=54');

$('#button-review').on('click', function() {
    
    //alert("ok");
	$.ajax({
		url: 'rating_insert_process.php',
		type: 'post',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			//$('#button-review').button('loading');
		},
		complete: function() {
		//	$('#button-review').button('reset');
		},
		success: function(msg) {
			//alert(msg);
			if(msg==1)
			{
			    window.location.reload();
			}
			else if(msg==3){
			    alert("please login!!");
			    window.location="login.php";
			}
			
		/*	$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review-form').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review-form').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);*/
			//}
		}
	});
});

$(document).ready(function() { 
	$('.product-info .image a').click(
		function(){  
			$.magnificPopup.open({
			  items: {
			    src:  $('img',this).attr('src')
			  },
			  type: 'image'
			});	
			return false;
		}
	);
});

 
</script> 

<script type="text/javascript" src=" catalog/view/javascript/jquery/elevatezoom/elevatezoom-min.js"></script>



<script type="text/javascript">
	/*	var zoomCollection = '#image';
		$( zoomCollection ).elevateZoom({
				lensShape : "basic",
		lensSize    : 100,
		easing:true,
		gallery:'image-additional-carousel',
		cursor: 'pointer',
		galleryActiveClass: "active"
	});*/
 
 
 $('#image').elevateZoom({
 /* responsive: true,
    zoomWindowWidth:300,
    zoomWindowHeight:400,
    zoomWindowFadeIn: 500,
    zoomWindowFadeOut: 50,
    scrollZoom : true*/
    
     zoomWindowFadeIn: 500,
			zoomWindowFadeOut: 500,
			lensFadeIn: 500,
			lensFadeOut: 500
			
		
  });
</script>


<script type="text/javascript">
    //$("#offcanvasmenu").html($("#bs-megamenu").html());
    
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</body>
</html>