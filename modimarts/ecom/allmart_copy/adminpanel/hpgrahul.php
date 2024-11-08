<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
?>
<?php  include('header.php');
include('config.php');
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
        <link rel="stylesheet" href="">
       
                <meta name="description" content="My Store" />

<script type="text/javascript" src="../catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../requiredfunctions.js"></script>
    	     <link href="../catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/homebuilder.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                <script type="text/javascript" src="../catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="../catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
              
            <script type="text/javascript" src="../catalog/view/javascript/layerslider/jquery.themepunch.plugins.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/layerslider/jquery.themepunch.revolution.min.js"></script>
    <!-- FONT -->

        <!-- FONT -->

<style>

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
<script>
/*function latestprods()
{

try
{
 
    $.ajax({
   type: 'POST',    
url:'Latest.php',
dataType: 'html',
success: function(data){
    alert(data);
//document.getElementById('latestslider').html(html);//=msg;
$("#latestslider").load("Latest.php");
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
*/


/*function funonsale()
{
    alert("chjeck");
   $.ajax({
   type: 'POST',    
url:'onsale.php',
data :'',
success: function(data){
    alert(data);
document.getElementById('showsale').innerHTML=data;

         },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
     });  
}*/





function validateQty(event) {
    var key = window.event ? event.keyCode : event.which;

if (event.keyCode == 8 || event.keyCode == 46
 || event.keyCode == 37 || event.keyCode == 39) {
    return true;
}
else if ( key < 48 || key > 57 ) {
    return false;
}
else return true;
};

function updtfn(id,str,typ,num)
{

try
{
    alert(id);
    var elid=str+num;
    var newid=document.getElementById(elid).value;
 //alert(newid);
 $.ajax({
   type: 'POST',    
url:'processupdatehomepagedetails.php',
data:'updid='+id+'&newid='+newid+'&str='+str+'&typ='+typ,
success: function(msg){
   // alert(msg);

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

function delfun(id,typ)
{

try
{
   
   var confirmr=confirm("Are you sure you want to delete");
   
   if(confirmr)
   {
 $.ajax({
   type: 'POST',    
url:'processupdeletehomepagedetails.php',
data:'updid='+id+'&typ='+typ,
success: function(msg){
  //  alert(msg);

         },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
     });
   }
}catch(exc)
{
    alert(exc);
}
    
}



function getdealsofday()
{

try
{
   
  
 $.ajax({
   type: 'POST',    
url:'bottomslider.php',
data:'',
success: function(msg){
   alert(msg);
document.getElementById('dealsofday').innerHTML=msg;
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
<script>
function funonsale()
{

try
{
   
//  alert("testing");
 $.ajax({
   type: 'POST',    
url:'onsale.php',
data:'',
success: function(msg){
   // alert(msg);
document.getElementById('showsale').innerHTML=msg;

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
      </head>
  <body class="common-home page-common-home layout-fullwidth" onload="getdealsofday();">
 
 
 
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->





  <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification">
                
             
                
                
            </div>
          </div>
        </div>
        <!-- /sys-notification -->
                         
 



<div class="main-columns container-full">
  	<div class="row">
			   	<div id="sidebar-main" class="col-sm-12 col-xs-12">
			<div id="content">
	
<div id="pav-homebuilder1554270593" class="homebuilder clearfix ">

	 		   
		<div class="pav-container  " >
			<div class="pav-inner container">
		 
				    <div class="row row-level-1 ">
				    	<div class="row-inner clearfix" >
					        					            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
					            	<div class="col-inner space-30" >

					            		 						                							                     		


<div class="layerslider-wrapper" style="max-width:900px;">
<div STYLE="margin-top:-85px; margin-bottom:-px;">
    <video width="850" height="650" id="vid"  loop autoplay muted onclick="flsc();">
  <!--<source src="../../../../../../../../videoplaybackTP.mp4" type="video/mp4">-->
  <source src="../../../../../../../../videoplayback.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
<script>

function flsc()
{
    
    var elem = document.getElementById("vid");
if (elem.requestFullscreen) {
  elem.requestFullscreen();
} else if (elem.msRequestFullscreen) {
  elem.msRequestFullscreen();
} else if (elem.mozRequestFullScreen) {
  elem.mozRequestFullScreen();
} else if (elem.webkitRequestFullscreen) {
  elem.webkitRequestFullscreen();
}

if( $("#vid").prop('muted') )
    {
        $("#vid").prop('muted', false);
    }else
    {
       $("#vid").prop('muted', true); 
    }

}

document.addEventListener("keydown", function(e) {
    if (e.keyCode ==27) {
      $("#vid").prop('muted', true);
    }
  }, false);

</script>
    </div>


			<?php include('slider.php');?>
 

			<!--
			##############################
			 - ACTIVATE THE BANNER HERE -
			##############################
			-->
			
			
			
			<script type="text/javascript">

				var tpj=jQuery;
				 

			

				if (tpj.fn.cssOriginal!=undefined)
					tpj.fn.css = tpj.fn.cssOriginal;

					tpj('#sliderlayer1360699920').revolution(
						{
							delay:9000,
							startheight:645,
							startwidth:1170,


							hideThumbs:50,

							thumbWidth:100,						
							thumbHeight:50,
							thumbAmount:5,

							navigationType:"bullet",				
							navigationArrows:"verticalcentered",				
														navigationStyle:"round",			 
							 					
							navOffsetHorizontal:0,
							navOffsetVertical:20, 	

							touchenabled:"on",			
							onHoverStop:"on",						
							shuffle:"off",	
							stopAtSlide:-1,						
							stopAfterLoops:-1,						

							hideCaptionAtLimit:0,				
							hideAllCaptionAtLilmit:0,				
							hideSliderAtLimit:0,			
							fullWidth:"off",
							shadow:0	 
							 				 


						});

			</script>
					                   								                						                							                     		
<div class="widget-products product-tabs panel   space-30">
	
	<div class="widget-content" id="latestslider">
  	<?php include('Latest.php');?>
	</div>
	</div>
</div>

				                   								                						                							                     		

<div class="productdeals panel panel-default nopadding ">
		<div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title"></h4></div>
	
	<div class="widget-inner panel-body">
				<div class="box-products  owl-carousel-play border" id="pavdealswddeals-6" data-ride="owlcarousel">
						<div class="owl-carousel" data-show="1" data-pagination="false" data-navigation="true">	
			 
			 
			</div> 
		</div>



	</div>
</div>
					   <?php //include('bottomslider.php');
					   ?>                		
					   <div class="widget panel" id="dealsofday">
		<div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">Deals Of The Day</h4></div>
			<div class="list box-products owl-carousel-play panel-body block-content bg-white" id="product_list1011535050"  data-ride="owlcarousel">
						<div class="carousel-controls">
				<a class="carousel-control left center" href="#product_list1011535050"   data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control right center" href="#product_list1011535050"  data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
						<div class="owl-carousel product-grid"  data-show="1" data-pagination="false" data-navigation="true" >
											



			  			</div>
	</div>
	<div class="clearfix"></div>
</div>
					   
					   
					   <div class="widget panel ">
		
	<div class="clearfix"></div>
</div>
	<?php include('top_rating.php')?>
	
					            	</div>
					        	</div>
					        		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
					            	<div class="col-inner sidebar hightlight space-30 hidden-sm" >

					            		 						                							                     		<div class="widget panel panel-default">
		<div class="productajax box-products bg-white clearfix" id="product_list1281361960">
					<div class="col-xs-12 product-col border">
				<div class="product-block">
				    				      <div class="image">
				        <div class="product-img img">
				          <a class="img" title="Deepak" href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=50">
				            <img class="img-responsive" src="http://sarmicrosystems.in/oc1/image/cache/catalog/index-120x120.jpg" title="Deepak" alt="Deepak" />
				          </a>
				        </div>
				      </div>
				    				  	<div class="product-meta">
				        <h6><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=50">Deepak</a></h6>
				        <p><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=50">shop now<i class="fa fa-angle-right"></i></a></p> 
				  	</div>
				</div>
			</div>
					<div class="col-xs-12 product-col border">
				<div class="product-block">
				    				      <div class="image">
				        <div class="product-img img">
				          <a class="img" title="Canon EOS 5D" href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=30">
				            <img class="img-responsive" src="http://sarmicrosystems.in/oc1/image/cache/catalog/demo/canon_eos_5d_1-120x120.jpg" title="Canon EOS 5D" alt="Canon EOS 5D" />
				          </a>
				        </div>
				      </div>
				    				  	<div class="product-meta">
				        <h6><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=30">Canon EOS 5D</a></h6>
				        <p><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=30">shop now<i class="fa fa-angle-right"></i></a></p> 
				  	</div>
				</div>
			</div>
					<div class="col-xs-12 product-col border">
				<div class="product-block">
				    				      <div class="image">
				        <div class="product-img img">
				          <a class="img" title="HTC Touch HD" href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=28">
				            <img class="img-responsive" src="http://sarmicrosystems.in/oc1/image/cache/catalog/demo/htc_touch_hd_1-120x120.jpg" title="HTC Touch HD" alt="HTC Touch HD" />
				          </a>
				        </div>
				      </div>
				    				  	<div class="product-meta">
				        <h6><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=28">HTC Touch HD</a></h6>
				        <p><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=28">shop now<i class="fa fa-angle-right"></i></a></p> 
				  	</div>
				</div>
			</div>
					<div class="col-xs-12 product-col border">
				<div class="product-block">
				    				      <div class="image">
				        <div class="product-img img">
				          <a class="img" title="iPod Shuffle" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=34">
				            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/demo/ipod_shuffle_1-120x120.jpg" title="iPod Shuffle" alt="iPod Shuffle" />
				          </a>
				        </div>
				      </div>
				    				  	<div class="product-meta">
				        <h6><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=34">iPod Shuffle</a></h6>
				        <p><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=34">shop now<i class="fa fa-angle-right"></i></a></p> 
				  	</div>
				</div>
			</div>
					<div class="col-xs-12 product-col border">
				<div class="product-block">
				    				      <div class="image">
				        <div class="product-img img">
				          <a class="img" title="MacBook Pro" href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=45">
				            <img class="img-responsive" src="http://sarmicrosystems.in/oc1/image/cache/catalog/demo/macbook_pro_1-120x120.jpg" title="MacBook Pro" alt="MacBook Pro" />
				          </a>
				        </div>
				      </div>
				    				  	<div class="product-meta">
				        <h6><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=45">MacBook Pro</a></h6>
				        <p><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=45">shop now<i class="fa fa-angle-right"></i></a></p> 
				  	</div>
				</div>
			</div>
			</div>
</div>
<div class="clearfix"></div>					                   								                						                							                     		<div class="widget panel ">
		<div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">On sale</h4></div>
			<div class="list box-products owl-carousel-play panel-body block-content bg-white" id="product_list896145338"  data-ride="owlcarousel">
						<div class="carousel-controls">
				<a class="carousel-control left center" href="#product_list896145338"   data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control right center" href="#product_list896145338"  data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
						<div class="owl-carousel product-grid"  data-show="1" data-pagination="false" data-navigation="true">
<div class="item active products-block">
<div class="row products-row " id="showsale">
   
<!--<div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="TShirt1" href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=57">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc1/image/cache/catalog/tshirt1-94x94.jpg" title="TShirt1" alt="TShirt1" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('57');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc1/index.php?route=themecontrol/product&amp;product_id=57"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('57');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc1/image/catalog/tshirt1.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="TShirt1"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc1/index.php?route=product/product&amp;product_id=57">TShirt1</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$1,200.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('57');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
<div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="new pant" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=56">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/new%20pant-94x94.jpg" title="new pant" alt="new pant" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('56');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=56"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('56');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/new%20pant.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="new pant"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=56">new pant</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$12,333.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('56');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
<div class="col-lg-3 col-xs-12 col-sm-3 product-col">

<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="jeans" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=55">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/jeans5-94x94.jpg" title="jeans" alt="jeans" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('55');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=55"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('55');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/jeans5.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="jeans"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=55">jeans</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$12.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('55');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
<div class="col-lg-3 col-xs-12 col-sm-3 product-col">

<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="jeans" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=55">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/jeans5-94x94.jpg" title="jeans" alt="jeans" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('55');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=55"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('55');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/jeans5.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="jeans"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=55">jeans</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$12.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('55');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>-->
</div>																											
<!--<div class="row products-row ">																						    
<div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="T-Shirt" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=54">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/tshirt-94x94.jpg" title="T-Shirt" alt="T-Shirt" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('54');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=54"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('54');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/tshirt.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="T-Shirt"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=54">T-Shirt</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$12,333.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('54');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
														</div>-->																		</div>
<div class="item  products-block">
																				<div class="row products-row ">																						    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="pant" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=53">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/pant-94x94.jpg" title="pant" alt="pant" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('53');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=53"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('53');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/pant.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="pant"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=53">pant</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$1,400.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('53');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="Shirt1" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=52">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/fd7d69c38c079674c2a1a84845df7237-94x94.jpg" title="Shirt1" alt="Shirt1" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('52');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=52"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('52');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/fd7d69c38c079674c2a1a84845df7237.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="Shirt1"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=52">Shirt1</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$0.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('52');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="KUmar" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=51">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/index2-94x94.jpg" title="KUmar" alt="KUmar" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('51');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=51"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('51');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/index2.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="KUmar"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=51">KUmar</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$190,000.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('51');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="Deepak" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=50">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/index-94x94.jpg" title="Deepak" alt="Deepak" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('50');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=50"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('50');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/index.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="Deepak"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=50">Deepak</a></h6>
         
        <p class="description">The is best product.....</p>
        
                <div class="price">
                      <span class="price-new">$120.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('50');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
														</div>																											<div class="row products-row ">																						    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="Samsung Galaxy Tab 10.1" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=49">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/demo/samsung_tab_1-94x94.jpg" title="Samsung Galaxy Tab 10.1" alt="Samsung Galaxy Tab 10.1" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('49');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=49"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('49');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/demo/samsung_tab_1.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="Samsung Galaxy Tab 10.1"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=49">Samsung Galaxy Tab 10.1</a></h6>
         
        <p class="description">
	Samsung Galaxy Tab 10.1, is the world&rsquo;s thinnest tablet, measuring 8.6 mm thickness, runnin.....</p>
        
                <div class="price">
                      <span class="price-new">$199.99</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('49');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
														</div>																		</div>
			  			</div>
	</div>
	<div class="clearfix"></div>
</div>
					                   								                						                							                     		<div class="widget panel ">
		<div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">Product</h4></div>
			<div class="list box-products owl-carousel-play panel-body block-content bg-white" id="product_list500423425"  data-ride="owlcarousel">
						<div class="carousel-controls">
				<a class="carousel-control left center" href="#product_list500423425"   data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control right center" href="#product_list500423425"  data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
						<div class="owl-carousel product-grid"  data-show="1" data-pagination="false" data-navigation="true">
														<div class="item active products-block">
																				<div class="row products-row ">																						    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="Tshirt2" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=58">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/tshirt3-94x94.jpg" title="Tshirt2" alt="Tshirt2" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('58');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=58"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('58');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/tshirt3.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="Tshirt2"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=58">Tshirt2</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$500.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('58');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="TShirt1" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=57">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/tshirt1-94x94.jpg" title="TShirt1" alt="TShirt1" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('57');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=57"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('57');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/tshirt1.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="TShirt1"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=57">TShirt1</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$1,200.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('57');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="new pant" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=56">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/new%20pant-94x94.jpg" title="new pant" alt="new pant" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('56');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=56"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('56');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/new%20pant.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="new pant"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=56">new pant</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$12,333.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('56');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="jeans" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=55">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/jeans5-94x94.jpg" title="jeans" alt="jeans" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('55');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=55"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('55');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/jeans5.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="jeans"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=55">jeans</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$12.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('55');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
														</div>																											<div class="row products-row ">																						    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="T-Shirt" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=54">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/tshirt-94x94.jpg" title="T-Shirt" alt="T-Shirt" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('54');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=54"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('54');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/tshirt.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="T-Shirt"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=54">T-Shirt</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$12,333.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('54');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
														</div>																		</div>
			  					<div class="item  products-block">
																				<div class="row products-row ">																						    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="pant" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=53">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/pant-94x94.jpg" title="pant" alt="pant" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('53');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=53"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('53');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/pant.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="pant"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=53">pant</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$1,400.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('53');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="Shirt1" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=52">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/fd7d69c38c079674c2a1a84845df7237-94x94.jpg" title="Shirt1" alt="Shirt1" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('52');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=52"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('52');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/fd7d69c38c079674c2a1a84845df7237.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="Shirt1"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=52">Shirt1</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$0.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('52');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="KUmar" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=51">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/index2-94x94.jpg" title="KUmar" alt="KUmar" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('51');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=51"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('51');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/index2.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="KUmar"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=51">KUmar</a></h6>
         
        <p class="description">.....</p>
        
                <div class="price">
                      <span class="price-new">$190,000.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('51');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="Deepak" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=50">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/index-94x94.jpg" title="Deepak" alt="Deepak" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('50');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=50"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('50');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/index.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="Deepak"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=50">Deepak</a></h6>
         
        <p class="description">The is best product.....</p>
        
                <div class="price">
                      <span class="price-new">$120.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('50');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
														</div>																											<div class="row products-row ">																						    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="Samsung Galaxy Tab 10.1" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=49">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/demo/samsung_tab_1-94x94.jpg" title="Samsung Galaxy Tab 10.1" alt="Samsung Galaxy Tab 10.1" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('49');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=49"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('49');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/demo/samsung_tab_1.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="Samsung Galaxy Tab 10.1"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=49">Samsung Galaxy Tab 10.1</a></h6>
         
        <p class="description">
	Samsung Galaxy Tab 10.1, is the world&rsquo;s thinnest tablet, measuring 8.6 mm thickness, runnin.....</p>
        
                <div class="price">
                      <span class="price-new">$199.99</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('49');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
														</div>																		</div>
			  			</div>
	</div>
	<div class="clearfix"></div>
</div>
					                   								                						                							                     		<div class="widget panel ">
		<div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">Bestseller</h4></div>
			<div class="list box-products owl-carousel-play panel-body block-content bg-white" id="product_list834605992"  data-ride="owlcarousel">
						<div class="owl-carousel product-grid"  data-show="1" data-pagination="false" data-navigation="true">
														<div class="item active products-block">
																				<div class="row products-row ">																						    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
                  <span class="product-label sale-exist"><span class="product-label-special">Sale</span></span>
        
        <div class="product-img img">
          <a class="img" title="Apple Cinema 30&quot;" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=42">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/demo/apple_cinema_30-94x94.jpg" title="Apple Cinema 30&quot;" alt="Apple Cinema 30&quot;" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=42"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/demo/apple_cinema_30.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="Apple Cinema 30&quot;"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=42">Apple Cinema 30&quot;</a></h6>
         
        <p class="description">
	The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel resolution. Designed sp.....</p>
        
                <div class="price">
                      <span class="price-new">$90.00</span>
            <span class="price-old">$100.00</span> 
             
            
                  </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('42');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
																																			    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
							     
<div class="product-block">

          
      <div class="image">
                  <span class="product-label sale-exist"><span class="product-label-special">Sale</span></span>
        
        <div class="product-img img">
          <a class="img" title="Canon EOS 5D" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=30">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/demo/canon_eos_5d_1-94x94.jpg" title="Canon EOS 5D" alt="Canon EOS 5D" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('30');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=30"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('30');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/demo/canon_eos_5d_1.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="Canon EOS 5D"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=30">Canon EOS 5D</a></h6>
         
        <p class="description">
	Canon's press material for the EOS 5D states that it 'defines (a) new D-SLR category', while we'r.....</p>
        
                <div class="price">
                      <span class="price-new">$80.00</span>
            <span class="price-old">$100.00</span> 
             
            
                  </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('30');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





							    </div>
														</div>																		</div>
			  			</div>
	</div>
	<div class="clearfix"></div>
</div>
					                   								                						               
						                					               
					            	</div>
					        	</div>
					        			    	</div>
				</div>
		 
		    </div>
		</div>
			   
		<div class="pav-container  " >
			<div class="pav-inner container">
		 
				    <div class="row row-level-1 ">
				    	<div class="row-inner clearfix" >
					        			    	</div>
				</div>
		 
		    </div>
		</div>
			

</div>

</div>
	   	</div>
			</div>
</div>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->



<footer id="footer" class="nostylingboxs">
 
  

  <?php include("footer.php")?>

</footer>
 
 
<div id="powered">
  <?php include('footerbottom.php')?>

</div>

  
<script type="text/javascript">
$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );

</script>





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
    //$("#offcanvasmenu").html($("#bs-megamenu").html());
    
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>

<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<!--<div id="footer">
	<!--  start footer-left 
	<div id="footer-left">
	Admin Skin &copy; Copyright 1Click Guide. <a href="1clickguide.org">www.1clickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
<!--	<div class="clear">&nbsp;</div>
</div>-->
<!-- end footer -->
 
</body>
</html>