<?php 
session_start();
include("config.php");
//$pid=300;
$pid=$_GET['prid'];
$cid=$_GET['catid'];

//================query for get category which under 0 =============
$qrya="select * from main_cat where id='".$cid."'";
 $resulta=mysqli_query($con1,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
//==============================================================

if($Maincate==1)
{
    
$qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `fashion` WHERE code='".$pid."'";
}
else if($Maincate==190)
{
    
$qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `electronics` WHERE code='".$pid."'";
}
else if($Maincate==218)
{
    
$qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `grocery` WHERE code='".$pid."'";
}
else 
{
    
$qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `products` WHERE code='".$pid."'";
}



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
          <script src="js/vendor/jquery.js"></script>
  <!-- xzoom plugin here -->
  <script type="text/javascript" src="dist/xzoom.min.js"></script>
  <!--<link rel="stylesheet" type="text/css" href="css/xzoom.css" media="all" />--> 
  <!-- hammer plugin here -->
  <script type="text/javascript" src="hammer.js/1.0.5/jquery.hammer.min.js"></script> 
     <script src="js/setup.js"></script>
           <script src='jquery.elevatezoom.js'></script>
                  
    <!-- FONT -->

        <!-- FONT -->

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

}catch(exc)
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

var nm='<a href='+imgr+' title="" class="elevateZoom" >';
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

.fixed_div{
    
     margin-left: 50%;
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
    top: 25%;
    width: 30%;
     
}
 
</style>

      </head>
  <body id="bd" class="common-home page-common-home layout-fullwidth" >
       <input type="hidden" name="adplid" id="adplid" readonly>
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
 <div style="position: fixed; ">
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
 
        <!-- sys-notification -->
        
        <div id="sys-notification">
          <div class="container">
            <div id="notification">
                
            </div>
          </div>
        </div>
        
        <!-- /sys-notification -->
                         
 

<div class="breadcrumbs space-30" style="margin-top:8.5%">
    <div class="container"> 
	    <div class="container-inner">
	         <ul class="list-unstyled breadcrumb-links">
								<li><a href="index.php"><i class="fa fa-home"></i></a></li>
								<?php
							$sqlbrdcr = mysqli_query($con1,"select * from main_cat where id ='".$latstprnrws['category']."'");
							
							
								$fbrws=mysqli_fetch_array($sqlbrdcr);
								if($fbrws['under']=="0")
								{
								    //echo "ok";
								  ?>  
								  <li><a href="product.php?mdi=<?php echo $fbrws['id'];?>"><?php echo $fbrws['name'];?></a></li>  
								<?php
								    
								}else
								{
								   $exs=0;
								   $idbrdcrmbarr=array();
								   $iddbr=$fbrws['id'];
								  
								   while($exs==0)
								   {
								      
								       	$sqlbrdcr2 = mysqli_query($con1,"select * from main_cat where id ='".$iddbr."'");
								       	
								     
								       	
							         	$fbrws2=mysqli_fetch_array($sqlbrdcr2);
							         	//$idbrdcrmbarr[]=$iddbr;
							         	array_unshift($idbrdcrmbarr, $iddbr);
							         	if($fbrws2['under']=="0")
							         	{
							         	 $iddbr="0";
							         	    	$exs=1;
							         	    	break;
							         	}else
							         	{
							         	 $iddbr= $fbrws2['under'];  
							         	}
							         
								   }
								   
								    //print_r($idbrdcrmbarr);
								}
								
								
								for($c=0;$c<count($idbrdcrmbarr);$c++)
								{
								    	$sqlbrdcr23 = mysqli_query($con1,"select * from main_cat where id ='".$idbrdcrmbarr[$c]."'");
							         	$fbrws23=mysqli_fetch_array($sqlbrdcr23);
								?>
								<li><a href="product.php?mdi=<?php echo $fbrws23['id'];?>"><?php echo $fbrws23['name'];?></a></li>
								<?php
								    
								}
								in
								
								?>
								<li><a href="javascript:void(0);"><b><?php echo $latstprnrws['name'];?></b></a></li>
								<!--<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69">Mens</a></li>
								<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_67">T-Shirt</a></li>-->
								</ul>
		</div>
		
		
		
    </div>
</div>        



<!--///////////////////////////////////////////////////////////////////////-->


<div class="row" >
   
    <div id="sticky"  >
      <div class="column"  >
         
        <div class="main-columns container">
        <div class="row">
	  	<div id="sidebar-main" class="col-sm-12 col-xs-12">
		<div id="content">
		<div class="product-info" style="padding-top: 0px;">	 
						

    
         <div class="row" >
          <?php
   
    if($Maincate==1){
     $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `fashion_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    }
    else if($Maincate==190)
    {
         $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$pid' order by id asc  limit 0,1");
    }
    else if($Maincate==218)
    {
         $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `grocery_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    }
    else 
    {
         $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    }






$frtu=mysqli_fetch_array($sqlimg23mn);
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
                    
                    <?php include('sidebarimg.php') ?>
    		       </div>
    		    </div>
               
                
                 <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 ">
                   
                  
   
                <div id="a" class="" style="border: 1px solid #f0f0f0;">
                    <center ><div id="b"> <a href="<?php echo $prodimgpth.$frtu['img'];?>" title="<?php echo $latstprnrws['name'];?>" class="elevateZoom" >
                    <img src="<?php echo $prodimgpth.$frtu[2];?>" title="<?php echo $latstprnrws['name'];?>" alt="<?php echo $latstprnrws['name'];?>" id="image"
                    style="height:350px;width:100%;object-fit:contain" data-zoom-image="<?php echo $prodimgpth.$frtu[3];?>" class="product-image-zoom img-responsive"/>
                    </a> 
                   
                   </div> </center>
                </div>
   
   
   
   
             <div class="row " style="margin-top:20px;" >
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="cart pull-left" style="padding-left: 42px;">
                    
                    <?php if($latstprnrws['total_amt']>0){?>
                    <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" style="width: 192px;" onclick="addcart2('<?php echo $_GET['prid'];?>');">Add to Cart</button>
               <?php } ?>
                </div>
                </div>
                     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="cart pull-left">
                    <?php if($latstprnrws['total_amt']>0){?>
                 
                         <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" style="width: 192px;"  onClick="Javascript:window.location.href = 'buynow.php?Pid=<?php echo $_GET['prid'];?>&cId=<?php echo $_GET['catid'];?>&qty='+ document.getElementById('input-quantity').value +'&clr='+ document.getElementById('colrcod').value +'&sz='+document.getElementById('colrsize').value+'';">
                        BUY NOW</button>
                        
                       
                        
                        
               <?php } ?>
                </div></div>
            </div>
    </div>
    </div>
    </div>
    </div>     
      
    </div>
    </div>
    </div>
    </div>
    </div>
         
      </div>
    </div>

<!--/////////////////////////////////////////////////////////////////////-->




  
<div class="fixed_div">

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
  <div class="product-info-bg">
    <h1 class="title-product" style="font-size:23px"><?php echo $latstprnrws['name'];?></h1>

                    
 






 <div class="border-success space-30">
            <ul class="list-unstyled">
                <li><b>Product Code:</b> <?php echo $latstprnrws['code'];?></li>
          
            </ul>
            
        </div>
      
            </div>
       
       
       
                  <!--  <div class="price detail space-20">
                <ul class="list-unstyled"  style="margin-top: 55px;">
                    
                   
                    
                                            <li >
                             <span class="price-new"><i class="fa fa-inr "></i> <?php echo $latstprnrws['total_amt'];?></span>
            <?php if($latstprnrws['discount']>0){?>
            <span class="price-old">$<?php echo $latstprnrws['price'];?></span> 
             <?php } ?>
                        </li></ul>
                                  
            </div>-->
          
           <style>
* {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.columnn {
    float: left;
    width: 50%;
    padding: 10px;
    height: 100px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style> 
            
            <div class="row">
  <div class="columnn" >
   <div class="price detail space-20">
                <ul class="list-unstyled" style="margin-top: 30px;">
                   <li>
                             <span class="price-new"><i class="fa fa-inr "></i> <?php echo $latstprnrws['total_amt'];?></span>
            <?php if($latstprnrws['discount']>0){?>
            <span class="price-old">$<?php echo $latstprnrws['price'];?></span> 
             <?php } ?>
                        </li></ul>
                                  
            </div>
   
  </div>
  <div class="columnn" >
                <div class="product-extra clearfix" style="border-top-width: 0px;">
                <label class="control-label pull-left qty">Qty:</label>
                <div class="quantity-adder pull-left">
                    <span class="add-down add-action fa fa-minus pull-left"> </span>
                    <div class="quantity-number pull-left">
                        <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" onkeydown='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'/>
                    </div>                  
                    <span class="add-up add-action  fa fa-plus pull-left"></span>
                </div>
                </div>
    
  </div>
</div>
            
            
        
       <!-- <ul class="list-unstyled">
                    <li>Ex Tax: $12,333.00</li>
        
                </ul>

                    <b>Availability:</b> In Stock <span class="check-box text-success"><i class="fa fa-check"></i></span>-->
       
       
       
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

                
       
        
        <div id="product">
         <!--   <div class="product-extra clearfix">
                <label class="control-label pull-left qty">Qty:</label>
                <div class="quantity-adder pull-left">
                    <span class="add-down add-action fa fa-minus pull-left"> </span>
                       
                   
                    <div class="quantity-number pull-left">
                        <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" onkeydown='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'/>
                    </div>                  
                    <span class="add-up add-action  fa fa-plus pull-left"></span>
                        
                    
                </div>
                
                <!--<div class="cart pull-left">
                   // <?php if($latstprnrws['total_amt']>0){?>
                    <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" onclick="addcart2('<?php echo $_GET['prid'];?>');">Add to Cart</button>
               ///<?php } ?>
                </div>-->
                
                
              <!--  </div>-->
    

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
        
        
        
        <div class="row" style="   border: 1px solid #f0f0f0;">
                <!--<div class="col-md-12" style="   border: 1px solid #f0f0f0;"><h2>Long Description</h2></div>-->
                 <div class="col-md-12" style="   border: 1px solid #f0f0f0;">
                     <p>
                         <?php echo $latstprnrws['description'];
                         ?>
                         
                     </p>
                     </div>
                     </div>
        <br/>
        
        
        
        
        
        
        
<!--==============color And size ==================-->

<?php  $s=  $latstprnrws['color'];
    $c=explode(',',$s);
   
  

 //===========code for hide "size" box ======================
    if($s==""){
    ?>
        <style type="text/css">
        #hidcolr{
            display:none;
            }
            
        </style>
    <?php }
   ?>
   <!--===================================================-->
   
  <!--<style>
      .button{
  background-color:yellow;
width:30px;height:30px; border-radius: 50%;text-align:center; 
border: 0px solid black;
}

.button:hover{background-color:orange;}

.button:focus{background-color:red;}
  </style>-->

    <div class="border-success space-30" id="hidcolr">
    <label class="control-label pull-left qty">Color:</label>
   
   
 

<!--<div >
   
  <button class="button"></button>
  <button class="button"></button>
</div>-->



   <div class="custom-radios">
  <div></div>
      
    <?php 
    $contcolor=1;
    foreach ($c as $item) {
   
    
    $qurcolor=mysqli_query($con1,"select id,color,color_code from fashioncolor where id='".$item."' ");
    $Rowcolor= mysqli_fetch_array($qurcolor);
    
     ?>
     
     
     <style>
     .custom-radios input[type="radio"]#color-<?php echo $contcolor;?> + label span {
  background-color: <?php echo $Rowcolor['color_code']?>;
}
</style>
     
  <input type="radio" id="color-<?php echo $contcolor;?>" name="color" value="<?php echo $Rowcolor['id']?>" onclick="colrcod(this.value)"   >
    <label for="color-<?php echo $contcolor;?>">
      <span>
      </span>
    </label>
   
   <!-- <input type="button" class="button" id="<?php //echo $Rowcolor['id']?>" value="" onclick="colrcod(this.id)" 
    style="width:30px;height:30px; border-radius: 50%;text-align:center;background-color:<?php //echo $Rowcolor['color_code']?>" >-->
<?php $contcolor++;}
    
    ?>
    </div></div>
   
  <!--<div class="custom-radios">
  <div>
    <input type="radio" id="color-1" name="color" value="color-1" checked>
    <label for="color-1">
      <span>
      </span>
    </label>
  </div></div>-->
  
  
   </div>
    
    <script>
    function colrcod(id){
   
        document.getElementById('colrcod').value =id;
         }
     function colrsize(id){
       
        document.getElementById('colrsize').value =id;
       
    }
    </script>


     <input type="hidden" id="colrcod" name="colrcod" value=""/>
     <input type="hidden" id="colrsize" name="colrsize" value=""/>
     <input type="hidden" id="cid" value="<?php echo $cid?>"/>
     
      <?php  $s=  $latstprnrws['size'];
    $c=explode(',',$s);
   
   //===========code for hide "size" box ======================
    if($s==""){
    ?>
        <style type="text/css">
        #hid{
            display:none;
            }
        </style>
    <?php }
   ?>
   <!--===================================================-->
   
   
   
   
    <!--============== size =============-->
    <div id="hid" >
    <div class="border-success space-30" >
    <label class="control-label pull-left qty">Size:</label>
      <div class="radio-toolbar">
 
    <?php
    $countsize=1;
    foreach ($c as $item) {
    
    if($item=="Large")
    {
        $i='L';
    }else if($item=="Medium")
    {
        $i='M';
    }
    else if($item=="Small")
    {
        $i='S';
    }
     else if($item=="XL")
    {
        $i='XL';
    }
     else if($item=="XXL")
    {
        $i='XXL';
    }
    ?>
    
  <input type="radio" id="radio<?php echo $countsize;?>" name="radios" value="<?php echo $i; ?>" onclick="colrsize(this.value)" >
  <label for="radio<?php echo $countsize;?>"><?php echo $i ?></label>

 
    
    
    <!--<input type="button"  value="<?php echo $i; ?>" onclick="colrsize(this.value)" style="width:30px;height:30px;text-align:center; "  />-->
<?php $countsize++;}
    
    ?>
     </div>
    
    </div>
         </div>

   <!--====================================================================-->     
        
        
         
        <div class="clearfix"></div>
        
         

        <!-- AddThis Button BEGIN -->
        
        <div class="addthis_toolbox addthis_default_style space-40">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> 
            <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> 
            <a class="addthis_counter addthis_pill_style"></a>
        </div>
        
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script> 
        <!-- AddThis Button END --> 
        <div class="tags"></div>
       </div>
       
       
       
        <div class="row" style="   border: 1px solid #f0f0f0;">
                <!--<div class="col-md-12" style="   border: 1px solid #f0f0f0;"><h2>Long Description</h2></div>-->
                 <div class="col-md-12" style="   border: 1px solid #f0f0f0;">
                     <p>
                         <?php echo $latstprnrws['Long_desc'];
                         ?>
                         
                     </p>
                     </div>
                     </div>
       
       
       
       
        <div class="row" style="   border: 1px solid #f0f0f0;">
                <div class="col-md-12" style="   border: 1px solid #f0f0f0; "><h2 style="font-size:23px;">Product Description</h2></div>
                 <div class="col-md-12" style="border: 1px solid #f0f0f0;">
                     <p>
                         <?php echo $latstprnrws['others'];
                         ?>
                         
                     </p>
                     </div>
                     </div>
                     
                     
                     
                    
                     
                     
                     
                     
                     
       
        <div class="row" style="   border: 1px solid #f0f0f0; margin-top:10px;">
                <div class="col-md-12" style="   border: 1px solid #f0f0f0; font-size:23px;"><h2 style="font-size:23px;">Specifications</h2></div>
                 <div class="col-md-12" style="   border: 1px solid #f0f0f0;">
                     <table>
                         <tr>
                             
                     <?php 
                     
                      if($Maincate==1){
                     
                    $qry=mysqli_query($con1,"SELECT product_specification,specificationname from fashionSpecification where product_id='".$pid."'");
                      }
                      else if($Maincate==190)
                      {
                          $qry=mysqli_query($con1,"SELECT product_specification,specificationname from electronicsSpecification where product_id='".$pid."'");
                      }
                       else if($Maincate==218)
                      {
                          $qry=mysqli_query($con1,"SELECT product_specification,specificationname from grocerySpecification where product_id='".$pid."'");
                      }
                       else
                      {
                          $qry=mysqli_query($con1,"SELECT product_specification,specificationname from productspecification where product_id='".$pid."'");
                      }
                      
                      
                      
                      
                     
                     while($fetcspcf=mysqli_fetch_array($qry)){
                     ?>
                    
                   <div class="col-md-4"><p style="color:#212121"><?php echo $fetcspcf[0]; ?></p></div>
                   
                   
                     <div class="col-md-8"> <p> <?php echo $fetcspcf[1]; ?></p> </div> 
                      
                     
          
                </div>
                
                
               <?php } ?>
               </tr>
                         </table>
            </div>
       
        </div>
            
    </div><!-- End div bg -->
    
   
</div>





</div>
				

<!--/////////////////////////////////////////////////////////////////////-->




<div style="position: -webkit-sticky;position: sticky;">


<footer id="footer" class="nostylingboxs">
  <?php include("footer.php")?>
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