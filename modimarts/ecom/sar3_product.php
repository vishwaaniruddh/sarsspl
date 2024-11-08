<?php 
session_start();
include("config.php");
include("getlocationforsearch.php");
$stsss=0;//used in menu.php 0 means indexpage
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
    
     margin-left: 40%;
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
    width: 30%;
     
}
 
</style>
</head>
<body>
 
 
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
 
 
 
 
 
<div class="row" >
   
    <div id="sticky"  >
      <div class="column"  >
       <!--  <img  src="images/logo.png" alt="Avatar">-->
         
         <div class="container">
        	<div class="row">
			  	<div class="col-sm-12" >
			  		<article class="body" style="height: 0px;padding-bottom: 0px;" >
			  			<div class="wm-zoom-container my-zoom-1">
			  				<div class="wm-zoom-box" >
								<img  src="zoomImage/Image-Hover-Zoom/assets/img/small-image.jpg"  style="position:absolute;background-color:red;z-index:auto;"  class="wm-zoom-default-img" alt="alternative text" data-hight-src="zoomImage/Image-Hover-Zoom/assets/img/big-image.jpg" data-loader-src="zoomImage/Image-Hover-Zoom/assets/img/loader.gif">
			  				</div>
			  			</div>

			  			<br>
		  		</article>
		  	</div>	
		</div>
		</div>
         
         
         
         
         
      </div>
    </div>
 
 

  
<div class="fixed_div">
<h2>Sticky Image: Scroll Down to See the Effect</h2>
<p>The image will "stick" to the screen when you reach its scroll position.</p>

<h2>Scroll Down</h2>
<p>Some example text..</p>
<p><b>Scroll back up again to "remove" the sticky position.</b></p>

<h2>Sticky Image: Scroll Down to See the Effect</h2>
<p>The image will "stick" to the screen when you reach its scroll position.</p>

<h2>Scroll Down</h2>
<p>Some example text..</p>
<p><b>Scroll back up again to "remove" the sticky position.</b></p>
<h2>Sticky Image: Scroll Down to See the Effect</h2>
<p>The image will "stick" to the screen when you reach its scroll position.</p>

<h2>Scroll Down</h2>
<p>Some example text..</p>
<p><b>Scroll back up again to "remove" the sticky position.</b></p>
<h2>Sticky Image: Scroll Down to See the Effect</h2>
<p>The image will "stick" to the screen when you reach its scroll position.</p>

<h2>Scroll Down</h2>
<p>Some example text..</p>
<p><b>Scroll back up again to "remove" the sticky position.</b></p>
<h2>Sticky Image: Scroll Down to See the Effect</h2>
<p>The image will "stick" to the screen when you reach its scroll position.</p>

<h2>Scroll Down</h2>
<p>Some example text..</p>
<p><b>Scroll back up again to "remove" the sticky position.</b></p>
</div>
   
 
</div>


        <script type="text/javascript" src="zoomImage/Image-Hover-Zoom/assets/js/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="zoomImage/Image-Hover-Zoom/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="zoomImage/Image-Hover-Zoom/wm-zoom/jquery.wm-zoom-1.0.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.my-zoom-1').WMZoom();
				$('.my-zoom-2').WMZoom({
					config : {
						inner : true
					}
				});
			});
		</script>

</body>
</html>
