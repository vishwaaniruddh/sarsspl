<?php 
session_start();
include("config.php");
//$pid=300;
$pid=$_GET['prid'];
$cid=$_GET['catid'];

//================query for get category which under 0 =============
$qrya="select * from main_cat where id='".$cid."'";
 $resulta=mysql_query($qrya);
 $rowa = mysql_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysql_query($qrya1);
 $rowa1 = mysql_fetch_row($resulta1);
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
  <link rel="stylesheet" type="text/css" href="css/xzoom.css" media="all" /> 
  <!-- hammer plugin here -->
  <script type="text/javascript" src="hammer.js/1.0.5/jquery.hammer.min.js"></script> 
     <script src="js/setup.js"></script>
           
                  
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



<script type="text/javascript"> 
   $(function() {
       $('#attach_box').click(function() {
           $('#sec_box').show();
           return false;
       });        
   });
</script>



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



$('#image').attr("src",imgr);
//$('#xzoom-default').attr("src",imgr);

$('.imagezoom').remove();

$('#image').removeData('elevateZoom');
//$('#xzoom-default').removeData('elevateZoom');
var nm='<a href='+imgr+' title="" class="imagezoom" >';
nm=nm+'<img src='+imgr+' title="" alt="" id="image"  style="height:350px;width:75%;object-fit: contain" data-zoom-image='+imgr+' class="product-image-zoom img-responsive"/></a>';
                 
//document.getElementById("imgzm").innerHTML=nm;
  document.getElementById("a").innerHTML=nm;   
// $('.xzoom, .xzoom-gallery').xzoom({zoomWidth: 400, title: true, tint: '#333', Xoffset: 15});
       
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
    responsive: true,
    zoomWindowWidth:300,
    zoomWindowHeight:400,
    zoomWindowFadeIn: 500,
    zoomWindowFadeOut: 50,
    scrollZoom : true
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
  .custom-radios input[type="radio"]#color-1 + label span {
  background-color:#2ecc71;
}
.custom-radios input[type="radio"]#color-2 + label span {
  background-color: #3498db;
}
.custom-radios input[type="radio"]:checked + label span {
  opacity: 1;
  background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg) center center no-repeat;
  width: 40px;
  height: 40px;
  display: inline-block;

}
</style>
      </head>
  <body id="bd" class="common-home page-common-home layout-fullwidth" >
       <input type="hidden" name="adplid" id="adplid" readonly>
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
 
<header id="header-layout" class="header-v2">
     <div id="header-main">
        <div class="">
            <div class="row">
            <?php include('menucopy.php')?>
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
                         
 

<div class="breadcrumbs space-30">
    <div class="container"> 
	    <div class="container-inner">
	         <ul class="list-unstyled breadcrumb-links">
								<li><a href="index.php"><i class="fa fa-home"></i></a></li>
								<?php
							$sqlbrdcr = mysql_query("select * from main_cat where id ='".$latstprnrws['category']."'");
							
							
								$fbrws=mysql_fetch_array($sqlbrdcr);
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
								      
								       	$sqlbrdcr2 = mysql_query("select * from main_cat where id ='".$iddbr."'");
								       	
								     
								       	
							         	$fbrws2=mysql_fetch_array($sqlbrdcr2);
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
								    	$sqlbrdcr23 = mysql_query("select * from main_cat where id ='".$idbrdcrmbarr[$c]."'");
							         	$fbrws23=mysql_fetch_array($sqlbrdcr23);
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


<div class="main-columns container">
  <div class="row">
	  	<div id="sidebar-main" class="col-sm-12 col-xs-12">
		<div id="content">
			 
						
<div class="product-info">
    
    
    <div class="row">
    <?php
   
    if($Maincate==1){
     $sqlimg23mn=mysql_query("SELECT img,thumbs,midsize FROM `fashion_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    }
    else if($Maincate==190)
    {
         $sqlimg23mn=mysql_query("SELECT img,thumbs,midsize FROM `electronics_img` WHERE `product_id`='$pid' order by id asc  limit 0,1");
    }
    else if($Maincate==218)
    {
         $sqlimg23mn=mysql_query("SELECT img,thumbs,midsize FROM `grocery_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    }
    else 
    {
         $sqlimg23mn=mysql_query("SELECT img,thumbs,midsize FROM `product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    }






$frtu=mysql_fetch_array($sqlimg23mn);
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
                    
                    <?php include('sidebarimg.php') ?>
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
                   
   
   
                <div id="a" class="xzoom-default" style="border: 1px solid #f0f0f0;">
                    <center> <a href="<?php echo $prodimgpth.$frtu['img'];?>" title="<?php echo $latstprnrws['name'];?>" class="imagezoom" >
                    <img src="<?php echo $prodimgpth.$frtu['thumbs'];?>" title="<?php echo $latstprnrws['name'];?>" alt="<?php echo $latstprnrws['name'];?>" id="image"
                    style="height:350px;width:75%;object-fit:contain" data-zoom-image="<?php echo $prodimgpth.$frtu['img'];?>" class="product-image-zoom img-responsive"/>
                    </a> 
                    </center>
                </div>
   
   
   
   
             <div class="row " style="margin-top:20px;" >
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="cart pull-left" style="padding-left: 0px;">
                    
                    <?php if($latstprnrws['total_amt']>0){?>
                    <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" style="width: 192px;" onclick="addcart2('<?php echo $_GET['prid'];?>');">Add to Cart</button>
               <?php } ?>
                </div>
                </div>
                     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="cart pull-left">
                    <?php if($latstprnrws['total_amt']>0){?>
                 
                       <!-- <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" style="width: 192px;" onclick="buynow('<?php echo $_GET['prid'];?>');">
                        BUY NOW</button>-->
                         <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" style="width: 192px;"  onClick="Javascript:window.location.href = 'buynow.php?Pid=<?php echo $_GET['prid'];?>&cId=<?php echo $_GET['catid'];?>&qty='+ document.getElementById('input-quantity').value +'&clr='+ document.getElementById('colrcod').value +'&sz='+ document.getElementById('colrsize').value +'';">
                        BUY NOW</button>
                        
                       
                        
                        
               <?php } ?>
                </div></div>
            </div>
          
          
          
          
          
          
          

          
          
                 </div>
            
    		</div>
    </div>
 
 
 
 
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
  <div class="product-info-bg">
    <h1 class="title-product" style="font-size:23px"><?php echo $latstprnrws['name'];?></h1>

                    <div class="rating">
                        
<?php

for($i=5;$i>0;$i--)
{
    //echo "SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid." and rating_count='".$i."'";

$fstar5=mysql_query("SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid."' and rating_count='".$i."'"); 
						     $fstarftch5=mysql_fetch_array($fstar5);
						     
						     if($i==5){
						      $str5=$fstarftch5[0];
						     }
						     else if($i==4){
						      $str4=$fstarftch5[0];
						     }
						     else if($i==3){
						      $str3=$fstarftch5[0];
						     }
						     else if($i==2){
						      $str2=$fstarftch5[0];
						     }
						     else if($i==1){
						      $str1=$fstarftch5[0];
						     }
}					     
$avg=0;
 $ttl=0;                           $ttl=$ttl+($str5+$str4+$str3+$str2+$str1);
                                if($ttl>0){

						    $avg=$avg+((($str5*5)+($str4*4)+($str3*3)+($str2*2)+$str1)/$ttl); 
                                }else{
                                    
                                  $avg=0;  
                                }
                                //echo $avg;
                                $cn=0;
                                while($cn!=round($avg)){
                                
						    ?>
                                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                                                         
                                                                         <?php $cn++; }
                                                                         
                                                                         
                                                                         $cnt=5-round($avg); $cn1=0; while($cn1!=$cnt){?>
                                                                                         
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <?php $cn1++; } 
                                                                                                
     $fstar=mysql_query("SELECT count(product_id) FROM `product_review` where product_id='".$pid."'"); 
						     $fstarftch=mysql_fetch_array($fstar);

                                                                                                ?>
                                                                                                <!--
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>-->
                                                           <!--       <a href="#review-form" class="popup-with-form" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;" ><?php echo $fstarftch[0];?> reviews</a> /
                                                             <a href="#review-form"    class="popup-with-form" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;" >Write a review</a>-->
                                                       
                                                         <a target="_blank" class="popup-with-form"   href="review.php?pid=<?php echo $pid;?>&cid=<?php echo $cid;?>"> <?php echo $fstarftch[0];?>reviews</a> /

                                                             <button type="button" class="btn btn-link" style="color:blue;border:none;"   data-toggle="modal" data-target="#myModal">Write a review</button>




  <!--========================================pop up NEW Start1 ===========================-->

<div class="container">
  
 
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">WRITE A REVIEW</h4>
        </div>
        <div class="modal-body">
         <div id="review-form" class="panel review-form-width"><div class="panel-body">
                <form class="form-horizontal" id="form-review">
                 <input type="hidden" name="pro_id" value="<?php echo $latstprnrws['code'];?>">
                   <input type="hidden" name="cat_id" value="<?php echo $latstprnrws['category'];?>">
                    
                   <!-- <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label" for="input-name">Your Name</label>
                            <input type="text" name="name" value="" id="input-name" class="form-control" />
                        </div>
                    </div>-->
                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label" for="input-review">Your Review</label>
                            <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                            <!--<div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>-->
                        </div>
                    </div>
                    
<div class="rating-wrapper">
<div class="col-sm-12">
    
  <input type="radio" class="rating-input" id="rating-input-1-5" name="rating"  value="5"/>
  <label for="rating-input-1-5" class="rating-star" ></label>
  
  <input type="radio" class="rating-input" id="rating-input-1-4" name="rating" value="4"/>
 <label for="rating-input-1-4" class="rating-star"></label>
 
  <input type="radio" class="rating-input" id="rating-input-1-3" name="rating" value="3"/>
  <label for="rating-input-1-3" class="rating-star"></label>
  
  <input type="radio" class="rating-input" id="rating-input-1-2" name="rating" value="2" />
  <label for="rating-input-1-2" class="rating-star"></label>
  
  <input type="radio" class="rating-input" id="rating-input-1-1" name="rating"  value="1"/>
  <label for="rating-input-1-1" class="rating-star"></label>
</div>

</div>
                            
            
                                        <div class="buttons">
                        <div class="pull-right">
                            <button type="button" id="button-review" data-loading-text="Loading..." class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                </form></div></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>




<!--==========================================================================-->
                
              






 <div class="border-success space-30">
            <ul class="list-unstyled">
                <li><b>Product Code:</b> <?php echo $latstprnrws['code'];?></li>
            </ul>
        </div>
        
            </div>
        
                    <div class="price detail space-20">
                <ul class="list-unstyled">
                                            <li>
                             <span class="price-new"><i class="fa fa-inr "></i> <?php echo $latstprnrws['total_amt'];?></span>
            <?php if($latstprnrws['discount']>0){?>
            <span class="price-old">$<?php echo $latstprnrws['price'];?></span> 
             <?php } ?>
                        </li>
                                    </ul>
            </div>
        
       <!-- <ul class="list-unstyled">
                    <li>Ex Tax: $12,333.00</li>
        
                </ul>

                    <b>Availability:</b> In Stock <span class="check-box text-success"><i class="fa fa-check"></i></span>-->
                
       
        
        <div id="product">
            <div class="product-extra clearfix">
                <label class="control-label pull-left qty">Qty:</label>
                <div class="quantity-adder pull-left">
                    <span class="add-down add-action pull-left">
                        <i class="fa fa-minus"></i>
                    </span>
                    <div class="quantity-number pull-left">
                        <input type="text" name="quantity" value="1" size="1" id="input-quantity" class="form-control" onkeydown='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'/>
                    </div>                  
                    <span class="add-up add-action pull-left">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                
                <!--<div class="cart pull-left">
                   // <?php if($latstprnrws['total_amt']>0){?>
                    <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" onclick="addcart2('<?php echo $_GET['prid'];?>');">Add to Cart</button>
               ///<?php } ?>
                </div>-->
                
                
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
   
  <!-- <style>
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



 
    <?php 
    foreach ($c as $item) {
   
    
    $qurcolor=mysql_query("select id,color,color_code from fashioncolor where id='".$item."' ");
    $Rowcolor= mysql_fetch_array($qurcolor);
    
     ?>
    
   <!--
    <input type="button" class="button" id="<?php echo $Rowcolor['id']?>" value="" onclick="colrcod(this.id)" 
    style="width:30px;height:30px; border-radius: 50%;text-align:center;background-color:<?php echo $Rowcolor['color_code']?>" >-->
    
    
<?php }
    
    
    
    ?>
    
    <div class="container">
	<div class="row">
		
<div class="custom-radios">
  <div>
    <input type="radio" id="color-1" name="color" value="color-1">
    <label for="color-1">
      <span>
      </span>
    </label>
  </div>
  
   <div>
    <input type="radio" id="color-2" name="color" value="color-2">
    <label for="color-2">
      <span>
      </span>
    </label>
  </div>
  
  
    <!--<div class="container">
	<div class="row">
		
<div class="custom-radios">
  <div>
    <input type="radio" id="<?php echo $Rowcolor['id']?>" name="color" value="" onclick="colrcod(this.id)"style="width:30px;height:30px; border-radius: 50%;text-align:center;background-color:<?php echo $Rowcolor['color_code']?>">
    <label for="color-1">
      <span>
      </span>
    </label>
  </div>
-->
    
    
    
   

  
  
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
   
    <?php
    
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
    
    <input type="button"  value="<?php echo $i ?>" onclick="colrsize(this.value)" style="width:30px;height:30px;text-align:center; "  />
<?php }
    
    ?>
    
    
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
                     
                    $qry=mysql_query("SELECT product_specification,specificationname from fashionSpecification where product_id='".$pid."'");
                      }
                      else if($Maincate==190)
                      {
                          $qry=mysql_query("SELECT product_specification,specificationname from electronicsSpecification where product_id='".$pid."'");
                      }
                       else if($Maincate==218)
                      {
                          $qry=mysql_query("SELECT product_specification,specificationname from grocerySpecification where product_id='".$pid."'");
                      }
                       else
                      {
                          $qry=mysql_query("SELECT product_specification,specificationname from productspecification where product_id='".$pid."'");
                      }
                      
                      
                      
                      
                     
                     while($fetcspcf=mysql_fetch_array($qry)){
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
					</div>
					
					
					
					          
<div class="box-product-infomation tab-v2 tabs-left">
    
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
        <li><a href="#tab-review" data-toggle="tab">Reviews (<?php echo $fstarftch[0];?>)</a></li>
    </ul>
    
    <div class="tab-content text-left">
        <div class="tab-pane active" id="tab-description">
              <p class="intro">
  </div>

            <div class="tab-pane" id="tab-review">
              <div id="review" class="space-20">
                    <?php 
                    $S=1;
                    $R=4;
                    $getreview=mysql_query("SELECT `review_id`, `user_id`, `product_id`, `rating_count`, `description`, `date_time` FROM `product_review` where product_id='".$pid."' and category_id='".$cid."' order by review_id desc"); 
						     while($getreviewarr=mysql_fetch_array($getreview)){
						         
						       if($S<=$R) 
						         {
						             
//$getnam=mysql_query("SELECT Firstname FROM Registration where id='".$pid."'"); 
  $getnam=mysql_query("SELECT Firstname FROM Registration where id='".$getreviewarr[1]."'"); 
  
   $getnamarr=mysql_fetch_array($getnam);
                    ?>
<table class="table table-v2">
<thead> 
  <tr>
    <th style="width: 50%;"><strong><?php echo $getnamarr['Firstname'];?></strong></th>
    <th class="text-right"><?php echo date('d-m-Y',strtotime($getreviewarr['date_time']));?></th>
  </tr>  
</thead>
<tbody>
  <tr>
    <td colspan="2"><p><?php echo $getreviewarr['description'];?></p>
    <?php
                   $c1=0;
                                while($c1!=$getreviewarr['rating_count']){
                                
						    ?>
                                                                          <span class="fa fa-stack"><i style="color:red;" class="fa fa-star fa-stack-1x"></i></span>
                                                                       
                                                                         <?php $c1++; } $cnt2=5-$getreviewarr['rating_count']; $c3=0; while($c3!=$cnt2){?>
                                                                                         
                                                                                                <span class="fa fa-stack" style="color:red;" ><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <?php $c3++; } 
                                                                  

                                                                                                ?>
                                           
            </td>
  </tr>
</tbody> 
</table>
<?php } $S++ ;}?>
                </div>
                
                <button type="button" class="popup-with-form btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">Write a review</button>
                 <a target="_blank" class="popup-with-form btn btn-sm btn-primary" style="float: right;height:30px" href="review.php?pid=<?php echo $pid;?>&cid=<?php echo $cid;?>">More</a>

 
 
 </div>

               <!--============================================= old Pop up ==============-->
      <!--           <p> <a href="#review-form"  id="attach_box" class="popup-with-form btn btn-sm btn-primary" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;" >Write a review</a></p>
 


               <div  id="sec_box" style="display: none;"> <div id="review-form" class="panel review-form-width"><div class="panel-body">
                <form class="form-horizontal" id="form-review">
                 <input type="hidden" name="pro_id" value="<?php echo $latstprnrws['code'];?>">
                   <input type="hidden" name="cat_id" value="<?php echo $latstprnrws['category'];?>">
                    <h2>Write a review</h2>
                   <!-- <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label" for="input-name">Your Name</label>
                            <input type="text" name="name" value="" id="input-name" class="form-control" />
                        </div>
                    </div>-->
                <!--    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label" for="input-review">Your Review</label>
                            <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                            <!--<div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>-->
                    <!--    </div>
                    </div>
                    
<div class="rating-wrapper">
<div class="col-sm-12">
    
  <input type="radio" class="rating-input" id="rating-input-1-5" name="rating"  value="5"/>
  <label for="rating-input-1-5" class="rating-star" ></label>
  
  <input type="radio" class="rating-input" id="rating-input-1-4" name="rating" value="4"/>
 <label for="rating-input-1-4" class="rating-star"></label>
 
  <input type="radio" class="rating-input" id="rating-input-1-3" name="rating" value="3"/>
  <label for="rating-input-1-3" class="rating-star"></label>
  
  <input type="radio" class="rating-input" id="rating-input-1-2" name="rating" value="2" />
  <label for="rating-input-1-2" class="rating-star"></label>
  
  <input type="radio" class="rating-input" id="rating-input-1-1" name="rating"  value="1"/>
  <label for="rating-input-1-1" class="rating-star"></label>
</div>

</div>
                            
            
                                        <div class="buttons">
                        <div class="pull-right">
                            <button type="button" id="button-review" data-loading-text="Loading..." class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                </form></div></div>
                </div>-->
<!--=========================================== old pop up end ====================-->
            </div>
                
    </div>
</div>
          
	</div>
			</div>
</div>



<footer id="footer" class="nostylingboxs">
  <?php include("footer.php")?>
</footer>
 
 
<div id="powered">
  <?php include('footerbottom.php')?>
</div>

  
<script type="text/javascript">
$('#review').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

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
    responsive: true,
    zoomWindowWidth:300,
    zoomWindowHeight:400,
    zoomWindowFadeIn: 500,
    zoomWindowFadeOut: 50,
    scrollZoom : true
  });
</script>


<script type="text/javascript">
    //$("#offcanvasmenu").html($("#bs-megamenu").html());
    
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</body>
</html>