<?php 
session_start();
include("config.php");
//$pid=300;
$pid=$_GET['prid'];
$cid=$_GET['catid'];
//Ruchi 
$prod_id=$_GET['prod_id'];  
//================query for get category which under 0 =================
$qrya="select * from main_cat where id='".$cid."'";
//echo $qrya;
$resulta=mysqli_query($con1,$qrya);
$rowa = mysqli_fetch_row($resulta); 
$aa=$rowa[2]; 
    // echo $aa;  
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
    //$qrygetallproduct = "select * from fashion where category ='".$cid."' and status=1 ";
}
else if($Maincate==190)
{   
    $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `electronics` WHERE code='".$pid."'";
    //$qrygetallproduct = "select * from electronics where category ='".$cid."' and status=1 ";
}
else if($Maincate==218)
{   
    $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `grocery` WHERE code='".$pid."'";
    //$qrygetallproduct = "select * from grocery where category ='".$cid."' and status=1 and ccode='".$cid."'";
}
else 
{
    $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `products` WHERE code='".$pid."'";
    //$qrygetallproduct = "select * from products where category ='".$cid."' and status=1 ";
}

$qrylatfrws=mysqli_query($con1,$qrylatf);   
$latstprnrws=mysqli_fetch_array($qrylatfrws);
//var_dump($latstprnrws['ccode']);
//ruchi Get product name by id
$prod = mysqli_query($con1,"SELECT product_model FROM product_model where id='".$latstprnrws['name']."'");
$product_name = mysqli_fetch_assoc($prod);
//var_dump($product_name['product_model']);

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
        <title>Allmart</title>
     	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    
        <link href="https://allmart.world/image/catalog/cart.png" rel="icon" />
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
        <!-- FONT -->    <!-- FONT -->
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
          width: 27px;
          height: 27px;
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
          padding: 3px 8px;
          font-family: Arial;
          font-size: 12px;
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
        }   else if(msg==4)
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
        
            var nm='<a href='+imgr+' title="" class="elevateZoom"  target = "_blank">';
            nm=nm+'<img src='+imgr+' title="" alt="" id="image" style="height:350px;width:100%;object-fit: contain"  data-zoom-image='+imgr2+' class="product-image-zoom img-responsive"/></a>';
                         
            //document.getElementById("imgzm").innerHTML=nm;
            document.getElementById("b").innerHTML=nm;   
            //$('.xzoom, .xzoom-gallery').xzoom({zoomWidth: 400, title: true, tint: '#333', Xoffset: 15});
               
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
        <!----------- for quentity and price-------------->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>
        /* Commented by ruchi
        function up(max) {
            var anand=document.getElementById("input-quantity").value;
           
            document.getElementById("input-quantity").value = parseInt(document.getElementById("input-quantity").value) + 1;
             alert(anand)
            if (document.getElementById("input-quantity").value >= parseInt(max)) {
                document.getElementById("input-quantity").value = max;
            }
        }*/
        /*function down(min) {
            document.getElementById("input-quantity").value = parseInt(document.getElementById("input-quantity").value) - 1;
            if (document.getElementById("input-quantity").value <= parseInt(min)) {
                document.getElementById("input-quantity").value = min;
            }
        }*/
        /* Ruchi */
        function up(max) {
            var c=document.getElementById("input-quantity").value;
            var v =0;
            if(c>=1){
                v =parseInt(document.getElementById("input-quantity").value) + 1;
            } else {
                v = 1;
            }
            document.getElementById("input-quantity").value = v;
        }
        function down(min){
           var c=document.getElementById("input-quantity").value;
            var v =0;
            if(c>=1){
                v =parseInt(document.getElementById("input-quantity").value) - 1;
            } else {
                v = 0;
            }
            document.getElementById("input-quantity").value = v; 
        }
        </script>
        <style>
        .ab {
            background-color: #54b6f9; /* Green */
            border: none;
            color: white;
           
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .ab1 {
            background-color: white; 
            color: black; 
            border: 2px solid #54b6f9;
        }
        .ab1:hover {
            background-color: #54b6f9;
            color: white;
        }
        </style><style>
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
    <!----------- for quentity and price------END-------->
    </head>
    <body id="bd" class="common-home page-common-home layout-fullwidth" >
        <input type="hidden" name="adplid" id="adplid" readonly>
        <div class="row-offcanvas row-offcanvas-left">
            <div id="page">
                <!-- header -->
                <div style="position: fixed;z-index:1 " >
                    <header id="header-layout" class="header-v2">
                        <div id="header-main" >
                            <div>
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
                <div class="breadcrumbs space-30" style="margin-top:9%;" id="fix">
                    <div class="container" style="position:fixed;" > 
	                    <div class="container-inner" >
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
            					<!--	<p style="white-space:nowrap;width: 200px; overflow: hidden;text-overflow: ellipsis; ">-->
            					<!--	<li><a href="javascript:void(0);"><b ><?php echo $latstprnrws['name'];?></b></a></li>-->
            					<!--<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69">Mens</a></li>
            					<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_67">T-Shirt</a></li>-->
			                </ul>
		                </div>
                    </div>
                </div>  
                <!--///////////////////////////////////////////////////////////////////////-->
                <div class="row"  >
                    <div id="sticky" >
                        <div class="column" >
                            <div class="main-columns container" >
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
                                                      //  $imgrow=mysqli_fetch_row($sqlimg23mn); 
                                                       //  echo "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$prod_id' order by id asc  limit 0,1"; 
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
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
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
                                                        <div class="row" id="" style="margin-left: 7px;">
                                                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 " style="margin-top: -20px;">
                                                              <div class="thumbs-preview horizontal thumbnails">
                                                                <?php include('sidebarimg.php') ?>
                                                		       </div>
                                                		    </div>
                                                            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 " >
                                                                <div id="a" class="" style="border: 1px solid #f0f0f0;">
                                                                    <center >
                                                                        <div id="b">
                                                                            <a href="<?php echo $frtu['img'];?>" title="<?php echo $product_name['product_model'];?>" class="elevateZoom" target = '_blank'>
                                                                                <img src="<?php echo $frtu[2];?>" title="<?php echo $product_name['product_model'];?>" alt="<?php echo $product_name['product_model'];?>" id="image" style="height:350px;width:100%;object-fit:contain" data-zoom-image="<?php echo $frtu[3];?>" class="product-image-zoom img-responsive"/>
                                                                            </a>
                                                                        </div>
                                                                    </center>
                                                                </div>
                                                                <div class="row " style="margin-top:20px;margin-bottom:20px;" >
                                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="cart pull-left" style="padding-left: 42px;">
                                                                    
                                                                            <?php if($latstprnrws['total_amt']>0){?>
                                                                                <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" style="width: 192px;" onclick="addcart2('<?php echo $_GET['prid'];?>');">Add to Cart</button>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="cart1 pull-left">
                                                                            <?php if($latstprnrws['total_amt']>0){?>
                                                                                <!-- <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" style="width: 192px;"  onClick="Javascript:window.location.href = 'buynow.php?Pid=<?php echo $_GET['prid'];?>&cId=<?php echo $_GET['catid'];?>&qty='+ document.getElementById('input-quantity').value +'&clr='+ document.getElementById('colrcod').value +'&sz='+document.getElementById('colrsize').value+'';">
                                                                                BUY NOW</button>-->
                                                                                <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" style="width: 192px;"  onClick="Javascript:window.location.href = 'paymentProcess.php?Pid=<?php echo $_GET['prid'];?>&cId=<?php echo $_GET['catid'];?>&qty='+ document.getElementById('input-quantity').value +'&clr='+ document.getElementById('colrcod').value +'&sz='+document.getElementById('colrsize').value+'';">BUY NOW</button>
                                                                            <?php } ?>
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
                        </div>
                    </div>
                    <!--/////////////////////////////////////////////////////////////////////-->
                    <div class="fixed_div" id="x" style="padding-left: 0px;padding-right: 0px;">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 " style="padding-left: 0px;padding-right: 0px;">
                            <div class="product-info-bg">
                                <h1 class="title-product" style="font-size:23px;margin-top:42px;width: 649px;">
                                    <?php echo $product_name['product_model'];?>
                                </h1>
                                <div class="row" style="width:650px;padding-left: 3px;" >
                                    <div class="columnn" style="height: 32px;padding-top: 0px;padding-bottom: 0px;" >
                                        <div class="rating" style="margin-top: 3px;">
                                            <?php
                                            for($i=5;$i>0;$i--)
                                            {
                                                //echo "SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid." and rating_count='".$i."'";
                                                $fstar5=mysqli_query($con1,"SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid."' and rating_count='".$i."'"); 
                                            	$fstarftch5=mysqli_fetch_array($fstar5);
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
                                            $ttl=0;
                                            $ttl=$ttl+($str5+$str4+$str3+$str2+$str1);
                                            if($ttl>0){
                                    	        $avg=$avg+((($str5*5)+($str4*4)+($str3*3)+($str2*2)+$str1)/$ttl); 
                                            }else{
                                                $avg=0;  
                                            }
                                            //echo $avg;
                                            $cn=0;
                                            $round= round($avg);
                                            while($cn!=round($avg)){
                    			            ?>
                    			            <? if($round==1){ ?>
                    			            <span class="fa fa-stack"><i style="color:red;" class="fa fa-star fa-stack-1x"></i></span>
                                            <? }else if($round==2){?>  <span class="fa fa-stack"><i style="color:yellow;" class="fa fa-star fa-stack-1x"></i></span>                              
                                            <? }else if($round==3){?>  <span class="fa fa-stack"><i style="color:green;" class="fa fa-star fa-stack-1x"></i></span>                          
                                            <? }else if($round==4){?>  <span class="fa fa-stack"><i style="color:#9400D3;" class="fa fa-star fa-stack-1x"></i></span>
                                            <? }else if($round==5){?>  <span class="fa fa-stack"><i style="color:#00008B	;" class="fa fa-star fa-stack-1x"></i></span>
                                            <? }else{ ?>
                                            <span class="fa fa-stack"><i style="" class="fa fa-star fa-stack-1x"></i></span>             
                                            <?php }?>   
                                            <!--  <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>-->
                                            <?php 
                                            $cn++; 
                                            }
                                            $cnt=5-round($avg); $cn1=0; while($cn1!=$cnt){?>
                                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <?php $cn1++; }
                                                $fstar=mysqli_query($con1,"SELECT count(product_id) FROM `product_review` where product_id='".$pid."' and category_id='".$cid."'"); 
                    						    $fstarftch=mysqli_fetch_array($fstar);
                    						?>
                    						<!--
                                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>-->
                                            <!--<a href="#review-form" class="popup-with-form" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;" ><?php echo $fstarftch[0];?> reviews</a> /
                                            <a href="#review-form" class="popup-with-form" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;" >Write a review</a>-->
                                                       
                                            <a target="_blank" class="popup-with-form"  href="review.php?pid=<?php echo $pid;?>&cid=<?php echo $cid;?>">
                                            <?php echo $fstarftch[0];?>&nbsp;reviews</a>&nbsp;&nbsp;&nbsp; /
                                            <button type="button" class="btn btn-link" style="color:#0f6cb2;border:none;" data-toggle="modal" data-target="#myModal">Write a review</button>
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
                                                                <div id="review-form" class="panel review-form-width">
                                                                    <div class="panel-body">
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
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--===================================================================-->
                                        </div>
                                    </div>    
                                    <div class="columnn" style="height: 44px;padding-bottom: 8px;">
                                        <div class="clearfix"></div>
                                        <!-- AddThis Button BEGIN -->
                                        <div class="addthis_toolbox addthis_default_style space-40" style="padding-left: 26px;">
                                            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> 
                                            <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> 
                                            <a class="addthis_counter addthis_pill_style"></a>
                                        </div>
                                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script> 
                                        <!-- AddThis Button END --> 
                                        <div class="tags"></div>
                                    </div>
                                </div>
                                <!--<div class="border-success space-30">
                                    <ul class="list-unstyled" style="width: 650px;">
                                        <li><b>Product Code:</b> <?php echo $latstprnrws['code'];?> <b style="padding-left: 300px;">Quantity:</b></li>
                                    </ul>
                                </div>-->
                            </div>
                            <!--  <div class="price detail space-20">
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
                            *{
                                box-sizing: border-box;
                            }
                            /* Create two equal columns that floats next to each other */
                            .columnn {
                                float: left;
                                width: 50%;
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
                            <div class="row" style="width: 750px;">
                                <div class="columnn" style="height: 66px;width:350px">
                                    <div class="price detail space-20">
                                        <ul class="list-unstyled" style="">
                                            <li style="width: 304px;padding-left: 4px;">
                                                <span class="price-new"><i class="fa fa-inr "></i> <?php echo $latstprnrws['total_amt'];?></span>
                                                <?php if($latstprnrws['discount']>0){?>
                                                <span class="price-old">$<?php echo $latstprnrws['price'];?></span> 
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="columnn" >
                                    <div class="product-extra clearfix" style="border-top-width: 0px;width:207px;padding-left: 25px;">
                                       <!-- <label class="control-label pull-left qty">Qty:</label>-->
                                       <!-- <div class="quantity-adder pull-left">
                                            <span class="add-down add-action fa fa-minus pull-left"> </span>
                                            <div class="quantity-number pull-left">
                                                <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" onkeydown='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'/>
                                            </div>                  
                                            <span class="add-up add-action  fa fa-plus pull-left"></span>
                                        </div>-->
                                        <button id="down" class="ab ab1" onclick="down('1')" style="border-radius: 17px;font-size:14px;width: 43px;"><i class="fa fa-minus" ></span></i></button>
                                                 
                                        <input type="text" id="input-quantity" name="quantity" class="input-number" value="1" onkeydown='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' style="text-align:center;border-radius: 6px;width: 58px;border-bottom-width: 4px;"/>
                                            
                                        <button id="up" class="ab ab1" onclick="up('1')" style="border-radius: 17px;font-size:14px;width: 43px;"><i class="fa fa-plus" ></span></i></button> 
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
                                                <a data-toggle="tooltip" style="cursor: pointer;" class="wishlist" title="Add to Wish List" onclick="wishlistfunc('<?php echo $pid;?>','<?php echo $cid;?>');"><i class="fa-fw fa fa-heart"></i>Add to Wish List</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                            <div class="pull-left">
                                                <a data-toggle="tooltip" style="cursor: pointer;" class="compare" title="Compare this Product" onclick="comparefunc('<?php echo $pid;?>','<?php echo $cid;?>');"><i class="fa-fw fa fa-refresh"></i>Compare this Product</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row" style="  ">
                                <!--<div class="col-md-12" style="   border: 1px solid #f0f0f0;"><h2>Long Description</h2></div>-->
                                    <div class="col-md-12" >
                                        <p>
                                            <?php echo $latstprnrws['description']; ?>
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
                                <?php } ?>
                                <!--===================================================-->
                                <!--<style>
                                  .button{
                                      background-color:yellow;
                                    width:30px;height:30px; border-radius: 50%;text-align:center; 
                                    border: 0px solid black;
                                    }
                                    .button:hover{background-color:orange;}
                                    .button:focus{background-color:red;
                                    }
                                </style>-->
                                <div class="row" style="width:750px;">
                                    <div class="columnn" >
                                        <div class="border-success space-30" id="hidcolr">
                                            <label class="control-label pull-left qty" style="margin-top: 9px;"><b>Color:</b></label>
                                            <!--  <label ><b style="margin-left:50px">Color:</b></label>-->
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
                                                    <input type="radio" id="color-<?php echo $contcolor;?>" name="color" value="<?php echo $Rowcolor['id']?>" onclick="colrcod(this.value,'colrcod')"   >
                                                    <label for="color-<?php echo $contcolor;?>">
                                                        <span>  </span>
                                                    </label>
                                                    <!-- <input type="button" class="button" id="<?php //echo $Rowcolor['id']?>" value="" onclick="colrcod(this.id)" 
                                                    style="width:30px;height:30px; border-radius: 50%;text-align:center;background-color:<?php //echo $Rowcolor['color_code']?>" >-->
                                                <?php $contcolor++;} ?>
                                            </div>
                                        </div>
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
                                        function colrcod(id,feild){
                                            //alert(id);
                                            document.getElementById(feild).value =id;
                                        }
                                        function colrsize(id,val=''){
                                            alert(id)
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
                                    <?php } ?>
                                    <!--===================================================-->
                                    <div class="columnn" >
                                        <!--============== size =============-->
                                        <div id="hid" >
                                            <div class="border-success space-30" >
                                                <label class="control-label pull-left qty" style="margin-top: 9px;"><b>Size:&nbsp; </b></label>
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
                                                    <?php $countsize++;
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====================================================================--> 
                            <!--  <div class="clearfix"></div>
                            <!-- AddThis Button BEGIN -->
                            <!-- <div class="addthis_toolbox addthis_default_style space-40">
                                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> 
                                <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> 
                                <a class="addthis_counter addthis_pill_style"></a>
                            </div>
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script> 
                            <!-- AddThis Button END --> 
                            <!--    <div class="tags"></div>-->
                        </div>
                        <div class="row" style=" ">
                            <!--<div class="col-md-12" style="   border: 1px solid #f0f0f0;"><h2>Long Description</h2></div>-->
                            <div class="col-md-12" style="color:black ">
                                <p>
                                    <?php echo $latstprnrws['Long_desc']; ?>
                                </p>
                            </div>
                        </div>
                        <!-- Ruchi : Display products merchantwise -->
                        <?php 
                            //Ruchi get all products of merchants
                            if($Maincate==1)
                            {
                                $qrygetallproduct = mysqli_query($con1,"select * from fashion where category ='".$cid."'and name= '".$prod_id."' and code!='".$pid."' and status=1 ");
                            }
                            else if($Maincate==190)
                            {
                                $qrygetallproduct = mysqli_query($con1,"select * from electronics where category ='".$cid."' and name= '".$prod_id."' and code!='".$pid."' and status=1 ");
                            }
                            else if($Maincate==218)
                            {   
                                $qrygetallproduct = mysqli_query($con1,"select * from grocery where category ='".$cid."' and name= '".$prod_id."' and code!='".$pid."' and status=1 ");
                            }
                            else 
                            {
                                $qrygetallproduct = mysqli_query($con1,"select * from products where category ='".$cid."' and name= '".$prod_id."' and code!='".$pid."' and status=1 ");
                            }
                            /*$getproducts=mysqli_query($con1,$qrygetallproduct);   
                            $result=mysqli_fetch_array($getproducts);
                            //var_dump($result['name']);
                            $r = 1;
                            foreach($getproducts as $r){
                                //var_dump($r['ccode']);
                            }*/
                            $result_count = mysqli_num_rows($qrygetallproduct);
                       ?>
                       <?php if($result_count>0) { ?>
                            <div class="row" style=" margin-top:10px;margin-bottom:29px;"> 
                                <div class="col-md-12" style="font-size:23px;">
                                    <h2 style="font-size:23px;">Product Sold by Other Merchants</h2>
                                </div>
                                <div class="col-md-12" style="  ">
                                    <table>
                                        <tr>
                                            <div class="col-md-3">
                                               <h5>Seller Name</h5> 
                                            </div>
                                            <div class="col-md-2">
                                                <h5>Price</h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>Colors</h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>Size</h5>
                                            </div>
                                            <div class="col-md-1">
                                                <h5>Action</h5>
                                            </div>
                                            <?php
                                            //echo $result_count;
                                            /*if($result_count>0) {*/
                                            while($fetcspcf=mysqli_fetch_assoc($qrygetallproduct)){
                                                //var_dump($fetcspcf);
                                                $qryuser=mysqli_query("select * from clients where code = '".$fetcspcf['ccode']."'");
                                                $getname=mysqli_fetch_assoc($qryuser)
                                                ?>
                                                <div class="col-md-3">
                                                    <a href="#">
                                                        <p style="color:#212121"><?php echo $getname['name']; ?></p>
                                                    </a>
                                                </div>
                                                <div class="col-md-2">
                                                    <p><?php echo $fetcspcf['price']; ?></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <?php  $s1=  $fetcspcf['color'];
                                                    $c1=explode(',',$s1);
                                                    //===========code for hide "size" box ======================
                                                    if($s1==""){
                                                    ?>
                                                        <style type="text/css">
                                                            #hidcolr1{
                                                                display:none;
                                                            }
                                                        </style>
                                                    <?php } ?>
                                                    <div class="row" style="width:750px;">
                                                      <div class="columnn" >
                                                        <div class="border-success space-30" id="hidcolr1">
                                                            <div class="custom-radios">
                                                            <div></div>
                                                            <?php 
                                                                $contcolor1=1;
                                                                foreach ($c1 as $item) {
                                                                    //var_dump($item);
                                                                    $qurcolor=mysqli_query("select id,color,color_code from fashioncolor where id='".$item."' ");
                                                                    $Rowcolor= mysqli_fetch_array($qurcolor);
                                                                    ?>
                                                                    <style>
                                                                         .custom-radios input[type="radio"]#colors-<?php echo $contcolor1;?> + label span {
                                                                          background-color: <?php echo $Rowcolor['color_code']?>;
                                                                        }
                                                                    </style>
                                                                    <input type="radio" id="colors-<?php echo $contcolor1;?>" name="colors" value="<?php echo $Rowcolor['id']?>" onclick="colrcod(this.value,'colrcod')"   >
                                                                    <label for="colors-<?php echo $contcolor1;?>">
                                                                        <span></span>
                                                                    </label>
                                                                    <?php $contcolor1++;
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <p> </p>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" id="button-cart1" data-loading-text="Loading..." class="btn btn-primary" onClick="Javascript:window.location.href = 'paymentProcess.php?Pid=<?php echo $_GET['prid'];?>&cId=<?php echo $_GET['catid'];?>&qty='+ document.getElementById('input-quantity').value +'&clr='+ document.getElementById('colrcod').value +'&sz='+document.getElementById('colrsize').value+'';">
                                                    BUY NOW</button>
                                                    <?php /*
                                                   <a href="details.php?prid=<?php echo $fetcspcf['code'];?>&catid=<?php echo $fetcspcf['category'];?>"><input type="submit" name="submit" value="Buy Now"></a>
                                                    */?>
                                                </div>
                                            <?php } ?>
                                            <!--</div>-->
                                        </tr>
                                    </table>
                                    <br/>
                                </div>
                            </div>
                        <?php } ?>
                        <!--Ruchi -->
         
<!--  border: 1px solid #f0f0f0;-->
       <?php if($latstprnrws['others']!=""){?>
        <div class="row" style=" ">
            <div class="col-md-12" style="  "><h2 style="font-size:23px;">Product Description</h2></div>
                <div class="col-md-12" style=" ">
                    <p>
                        <?php echo $latstprnrws['others']; ?>
                    </p>
                </div>
            </div>
        <? }?>
        <div class="row" style=" margin-top:10px;margin-bottom:29px;"> 
            <div class="col-md-12" style="font-size:23px;">
                <h2 style="font-size:23px;">Specifications</h2>
            </div>
            <div class="col-md-12" style="  ">
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
               <hr style="margin-top: 168px; margin-bottom: -2px;" />
               </tr>
            </table>
          <br/>
          <?php 
          /*
          $fstar=mysql_query("SELECT count(product_id) FROM `product_review` where product_id='".$pid."' and category_id='".$cid."'"); 
	      $fstarftc=mysql_fetch_array($fstar);
        ?>
    <div class="box-product-infomation tab-v2 tabs-left" style="width:96%;" >
        <div > 
            <!--<ul class="nav nav-tabs" role="tablist">-->
            <ul class="" role="tablist" >
              <!--  <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>-->
                <li ><a href="#tab-review" data-toggle="tab">Reviews (<?php echo $fstarftc[0];?>)</a> &nbsp;&nbsp; /<button type="button" class="btn btn-link" style="color:#265fb5;padding-bottom: 0px;padding-top: 0px;" data-toggle="modal" data-target="#myModal">Write a review</button></li>
            </ul>
        </div> 
        <div class="">
        <!--<div class="tab-content text-left">-->
           <!-- <div class="tab-pane active" id="tab-description">
            <p class="intro">
        </div>-->
        <div class="tab-pane active"  id="tab-review" >
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
                <!--<table class="table table-v2">-->
                <table>
                    <thead > 
                      <tr style="height:20%;">
                        <th style="padding-top: 0px;padding-bottom: 0px;"><strong><?php echo $getnamarr['Firstname'];?>Anand gupta</strong></th>
                      </tr>  
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" style="padding-bottom: 0px;padding-top: 0px;"> 
                                <?php
                                    $countt= $getreviewarr['rating_count'];
                                    $c1=0;
                                    while($c1!=$getreviewarr['rating_count']){
        						?>
        						<? if($countt==1){ ?>
        						    <span class="fa fa-stack"><i style="color:red;" class="fa fa-star fa-stack-1x"></i></span>
                                    <? }else if($countt==2){?>  <span class="fa fa-stack"><i style="color:yellow;" class="fa fa-star fa-stack-1x"></i></span>                              
                                    <? }else if($countt==3){?>  <span class="fa fa-stack"><i style="color:green;" class="fa fa-star fa-stack-1x"></i></span>                          
                                    <? }else if($countt==4){?>  <span class="fa fa-stack"><i style="color:#9400D3;" class="fa fa-star fa-stack-1x"></i></span>
                                    <? }else if($countt==5){?>  <span class="fa fa-stack"><i style="color:#00008B	;" class="fa fa-star fa-stack-1x"></i></span>
                                    <? }else{ ?>            <span class="fa fa-stack"><i style="" class="fa fa-star fa-stack-1x"></i></span>             
                                    <? }?>       
                                    <!--   <span class="fa fa-stack"><i style="color:blue;" class="fa fa-star fa-stack-1x"></i></span>-->
                                    <?php $c1++; } $cnt2=5-$getreviewarr['rating_count']; $c3=0; while($c3!=$cnt2){   ?>
                                    <span class="fa fa-stack" style="color:red;" ><i class="fa fa-star-o fa-stack-1x"></i></span>
                                <?php $c3++; } ?>
                                <?php echo date('d-m-Y',strtotime($getreviewarr['date_time']));?>
                                <p style="margin-bottom: 0px;"><?php echo $getreviewarr['description'];?></p>
                            </td>
                            <br />
                        </tr>
                    </tbody> 
                </table>
            <?php } $S++ ;} ?>
            </div>
            <?php if($fstarftc[0]>4){?>
                <a target="_blank" class="popup-with-form btn btn-sm btn-primary" style="float: right;height:30px" href="review.php?pid=<?php echo $pid;?>&cid=<?php echo $cid;?>">More</a>
            <?php }?>
            </div>
        </div>
    </div> */?>
    </div><!-- End div bg -->
</div>
</div>
<!--/////////////////////////////////////////////////////////////////////-->
<div style="position:-webkit-sticky;position: sticky;">
<footer id="footer" class="nostylingboxs" >
  <?php include("footer.php")?>
</footer>
<div id="powered" style="background-color:white">
  <?php include('footerbottom.php')?>
</div>
<script type="text/javascript">
  var windw = this;
$.fn.followTo = function ( pos ) {
    var $this = this,
        $window = $(windw);
       // alert($window.scrollTop())
        
   $window.scroll(function(e){
       var tot=$window.scrollTop()+160;
      // alert(tot);
        if (tot > pos) {
            $this.css({
                position: 'absolute',
                top:pos
            });
        } else {
            $this.css({
                position: 'fixed',
                top: 162
            });
        }
    });
};
var d=$('#x').outerHeight();
var f=d-270;
//alert(f)
//alert($('#x').outerHeight());
$('#sticky').followTo(f);
$('#button-review').on('click', function() {
    
    //alert("ok");
	$.ajax({
		url:  'rating_insert_process.php',
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
 $('#image').elevateZoom({
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