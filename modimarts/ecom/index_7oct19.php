<?php 
session_start();
include("config.php");


include("getlocationforsearch.php");
$stsss=0;//used in menu.php 0 means indexpage
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
        <link href="http://sarmicrosystems.in/oc1/" rel="canonical" />
        <link href="loginPopCss.css" rel="stylesheet" />
        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="requiredfunctions.js"></script>
    	<link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
        <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
        <link href="catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
        <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
        <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
        <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
        <!-- <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />-->
      
        <link href="catalog/view/theme/pav_bigstore/stylesheet/homebuilder.css" rel="stylesheet" />
        <link href="catalog/view/theme/pav_bigstore/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
        <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
        
        <link href="css/custom.css" rel="stylesheet" />
        
        <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
       
        <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
      
        <script type="text/javascript" src="catalog/view/javascript/layerslider/jquery.themepunch.plugins.min.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/layerslider/jquery.themepunch.revolution.min.js"></script>
<style>
 p.b {
    white-space: nowrap; 
    width: 179px; 
    overflow: hidden;
    text-overflow: ellipsis; 
    text-align:center;
   /* border: 1px solid #000000;*/
}
p.c {
    white-space: nowrap; 
    width: 129px; 
    overflow: hidden;
    text-overflow: ellipsis; 
    text-align:left;
   /* border: 1px solid #000000;*/
}

#overlay {
    width: 100%;
/* background: url('path/to/opaque/img.png') repeat;*/
    position: relative;
}

#overlay img.loading_circle {
    position: absolute;
    top: 50%;  // edit these values to give you
    left: 50%; // the positioning you're looking for.
}

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
<script>
var slider2shown=0;
var slider8shown=0;
var slider2shown=0;
$(document).ready(function(){
    $('#vid').on('ended',function(){
        updtadsplayed();
      rtymvid();
    });
  });
var dtss=[];
var incr=0;
function updtadsplayed()
{
//try
//{
    if(dtss["adid"]!="")
{
var adid=document.getElementById('adplid').value;
         $.ajax(
				{
					type:'POST',    
				//	url:'updtadsplayeddetailsfreegeoip.net.php',
					url:'updtadsplayeddetails.php',
					data:'adid='+adid,
					success: function(msg)
					{
                         //  alert(msg);
					    
					}
				});
}

/*}catch(ex)
{
    alert(ex);
}*/

}



function rtymvid()
{

var myVid = document.getElementById('vid');
myVid.control = false;
$.ajax(
				{
					type:'POST',    
					url:'gettime_new2.php',
					data:'stats=1',
					success: function(msg)
					{
					 //  alert(msg);
                                  dtss=JSON.parse(msg);


if(dtss["adid"]!="")
{
    
myVid.src = 'samplevideo.php?sid='+dtss["adid"];
myVid.currentTime = dtss["startfromtym"];
myVid.play();
}
else
{
myVid.src = '';
myVid.play();
}
}
});
}


var adsid=[];
function rtymvidold()
{
try
{
var myVid = document.getElementById('vid');
//alert("error");
$.ajax({
					type:'POST',    
					url:'gettime_new.php',
					datatype:'json',
					data:'stats=1',
					success: function(msg)
					{
                               // alert(msg);
adsid=JSON.parse(msg);
//alert(adsid);
//alert(jsr[0]);
myVid.src = 'samplevideo.php?sid='+adsid;
myVid.currentTime =arr[0];
myVid.play();   
/*alert(incr);
if(incr>=adsid.length)
    {
        incr=0;
    }*/
//playvidfunc();

                               }
					
				});
}catch(exc)
{
    alert(exc);
}

}

$( document ).ready(function(){
$(window).scroll(function(){
// This is then function used to detect if the element is scrolled into view

function elementScrolled(elem)
{//return true;
  try
{
var docViewTop = $(window).scrollTop();
var docViewBottom = docViewTop + $(window).height();
var elemTop = $("#"+elem).offset().top;
return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
}catch(ex)
{
    alert(elem);
}
}

if(elementScrolled("onsalesliderdivs")) {
//alert("ok");

if(slider2shown==0)
{
   showtoprigthslider();
   showslider2();
	        	showslider6()
	   			showslider3();
	   				
	   	     	showslider4();
	   	     
	   	     
	   	     showslider10();
             showslider11();
             showslider12();
             showslider13();
slider2shown=1;
}   


if(elementScrolled("dealssliderdivs")) {

if(slider8shown==0)
{

showslider7();

slider8shown=1;
}   
}

    
}



});
});

function playvidfunc()
{
    try
    {
  var myVid = document.getElementById('vid');
  
    if(incr<adsid.length)
    {
        alert(adsid[incr]);
myVid.src = 'samplevideo.php?sid='+adsid[incr]+'&stats=movie1';
document.getElementById('adplid').value=adsid[incr];
//myVid.currentTime =arr[0];
myVid.play(); 
  incr++;   
        
    }else
    {
      incr=0;  
      
      myVid.src = 'samplevideo.php?sid='+adsid[incr]+'&stats=movie1';
document.getElementById('adplid').value=adsid[incr];
myVid.play(); 
incr++;

    }
    }catch(exc)
{
    alert(exc);
}
    
}

function showloader(divid)
{
    $('#'+divid).html('<div id="overlay"><img src="image/magic-dots.gif" style="height:200px;width:200px;align:center" class="loading_circle" alt="loading" /></div>');   
}


function showtoprigthslider()
{
try
{
showloader("toprightsliderdiv");
   var latitude= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;
  

//$('#onsalesliderdivs').load('onsale.php');
	 

$.ajax(
    {
		type:'POST',    
		url:'toprightsliderhomepage.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success: function(msg)
		{
		    //alert(msg)
			document.getElementById("toprightsliderdiv").innerHTML=msg;	
		//	fnuncloadfn();
		//	showslider2();

				}
				});
				
}catch(ex)
{
    alert(ex);
}
}

function showslider2()
{
try
{

   var latitude= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;
  

//$('#onsalesliderdivs').load('onsale.php');
	 
	 
showloader("onsalesliderdivs");
$.ajax(
    {
		type:'POST',    
		url:'onsale.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success: function(msg)
		{
			document.getElementById("onsalesliderdivs").innerHTML=msg;	
				
		    
		}
				});
				
}catch(ex)
{
    alert(ex);
}
}



function showslider3()
{
try
{

showloader("productsliderdivs");
   var latitude= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;
 

//$('#onsalesliderdivs').load('onsale.php');
	 
$.ajax(
    {
		type:'POST',    
		url:'product_sidebar.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success: function(msg)
		{//alert(msg);
			document.getElementById("productsliderdivs").innerHTML=msg;	
				
	   
	   showslider4();
				
		}
				});
				
}catch(ex)
{
    alert(ex);
}
}


function showslider4()
{
try
{

   var latitude= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;
  

showloader("bestsellerdivs");
//$('#onsalesliderdivs').load('onsale.php');
	 
$.ajax(
    {
		type:'POST',    
		url:'bestseller.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success: function(msg)
		{
			document.getElementById("bestsellerdivs").innerHTML=msg;	
	//fnuncloadfn();
	
			showslider5();
	   	     
	   			
		}
				});
				
}catch(ex)
{
    alert(ex);
}
}


function showslider5()
{
try
{


showloader("latestsliderdiv");
   var latitude= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;
  

//$('#onsalesliderdivs').load('onsale.php');
	 
$.ajax(
    {
		type:'POST',    
		url:'Latest.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success: function(msg)
		{
		
			document.getElementById("latestsliderdiv").innerHTML=msg;	
	     fnuncloadfn();
				
		}
				});
				
}catch(ex)
{
    alert(ex);
}
}


function showslider6()
{
try
{

   var latitude= document.getElementById("latitude").value;
   var longitude= document.getElementById("longitude").value;
  
  
showloader("dealssliderdivs");
    $.ajax(
    {
		type:'POST',    
		url:'bottomslider.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success: function(msg)
		{
	//	document.getElementById("dealssliderdivs").innerHTML="";
		document.getElementById("dealssliderdivs").innerHTML=msg;	
	   		//	showslider7()
	   		//	showslider3();
	   		//	showslider4();
	   			 
		}
	});
				
    }catch(ex)
    {
        alert(ex);
    }
}


function showslider7()
{
try
{
    
showloader("topratingsliderdivs");
   var latitude= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;

//$('#onsalesliderdivs').load('onsale.php');
	 
$.ajax(
    {
		type:'POST',    
		url:'top_rating.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success: function(msg)
		{
		
		document.getElementById("topratingsliderdivs").innerHTML=msg;	
				
         fnuncloadfn(); 
				
		}
				});
				
}catch(ex)
{
    alert(ex);
}
}

//=================================test for slider (start) ====================
function showslider10()
{
try
{
    
showloader("topratingsliderdivs2");

   var latitude= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;
  

//$('#onsalesliderdivs').load('onsale.php');
	 
$.ajax(
    {
		type:'POST',    
		url:'top_rating2.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success: function(msg)
		{
		    //alert(msg)
		
		document.getElementById("topratingsliderdivs2").innerHTML=msg;	
				
       //  fnuncloadfn(); 
				
		}
				});
				
}catch(ex)
{
    alert(ex);
}
}
//=================================test for slider (End) ====================


//=================================test for slider (Minimum 70% Off) (start) ====================
function showslider11()
{
try
{
    
showloader("topratingsliderdivs3");

   var latitude= document.getElementById("latitude").value;
  var longitude= document.getElementById("longitude").value;
  

//$('#onsalesliderdivs').load('onsale.php');
	 
$.ajax(
    {
		type:'POST',    
		url:'top_rating3.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success: function(msg)
		{//alert(msg)
		
		document.getElementById("topratingsliderdivs3").innerHTML=msg;	
				
       //  fnuncloadfn(); 
				
		}
				});
				
}catch(ex)
{
    alert(ex);
}
}
//=================================test for slider (End) ====================

//=================================Ruchi : test for slider (Minimum 70% Off) (start) ====================
function showslider12()
{
    try
    {
       showloader("topratingsliderdivs4");
       var latitude= document.getElementById("latitude").value;
       var longitude= document.getElementById("longitude").value;
        //$('#onsalesliderdivs').load('onsale.php');
        $.ajax(
        {
    		type:'POST',    
    		url:'top_rating4.php',
    		data:'latitude='+latitude+'&longitude='+longitude,
    		success: function(msg)
    		{
    		    //alert(msg)
    		    document.getElementById("topratingsliderdivs4").innerHTML=msg;
                //  fnuncloadfn();
    		}
		});
    }catch(ex)
    {
        alert(ex);
    }
}
//=================================test for slider (End) ====================
//=================================Ruchi : test for slider (Minimum 70% Off) (start) ====================
function showslider13()
{
    try
    {
       showloader("topratingsliderdivs5");
       var latitude= document.getElementById("latitude").value;
       var longitude= document.getElementById("longitude").value;
        //$('#onsalesliderdivs').load('onsale.php');
        $.ajax(
        {
    		type:'POST',    
    		url:'top_rating5.php',
    		data:'latitude='+latitude+'&longitude='+longitude,
    		success: function(msg)
    		{
    		    //alert(msg)
    		    document.getElementById("topratingsliderdivs5").innerHTML=msg;
                //  fnuncloadfn();
    		}
		});
    }catch(ex)
    {
        alert(ex);
    }
}
//=================================test for slider (End) ====================
function fnuncloadfn()
{
    try
    {
	$('<link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />').appendTo("head");
	var s = document.createElement("script");
    s.type = "text/javascript";
    s.src = "catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js";
    // Use any selector
    $("head").append(s);
	var s2 = document.createElement("script");
    s2.type = "text/javascript";
    s2.src = "catalog/view/javascript/common.js";
    // Use any selector
    $("head").append(s2);
	var s3 = document.createElement("script");
    s3.type = "text/javascript";
    s3.src = "catalog/view/theme/pav_bigstore/javascript/common.js";
    // Use any selector
    $("head").append(s3);
	$('#product_tabs126552099 a:first').tab('show');	
    }catch(ex)
    {
        alert(ex);
    }
}
</script>
      </head>
  <body id="bd" class="common-home page-common-home layout-fullwidth" onload="rtymvid();showtoprigthslider();">
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
                                <div class="layerslider-wrapper" >
                                   <div style="margin-top:-px; margin-bottom:-px;background-color:black ">
                                      <!--<video width="850" height="650" id="vid"  loop autoplay muted onclick="flsc();">
                                          <source src="../../../../../../../../videoplaybackTP.mp4" type="video/mp4">
                                          <source src="" type="video/mp4">Your browser does not support the video tag.
                                          </video>-->
<video class="videoad" id="vid"  src="" type="video/mp4"  onclick="flsc()" style="height:460px;padding-top:7px" muted></video>  
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
}
var myVid1 = document.getElementById('vid');
myVid1.addEventListener("mozfullscreenchange",function(){
    console.log(document.mozFullScreen);
    var st=document.webkitIsFullScreen;
    console.log(st);
   if(st==true)
   {
       $("#vid").prop('muted', false);    
       
       $("#vid").css("pointer-events","");
       
   }else
   {
     $("#vid").prop('muted', true);  
      $("#vid").css("pointer-events","none");
      
    
   }
    
}, false);

myVid1.addEventListener("webkitfullscreenchange",function(){
    console.log(document.webkitIsFullScreen);
   // alert("ok");
   var st=document.webkitIsFullScreen;
    console.log(st);
   if(st==true)
   {
       $("#vid").prop('muted', false);    
       
   }else
   {
     $("#vid").prop('muted', true);  
   }
}, false);

</script>
    </div>
		<?php // include('slider.php');?>
    </div>
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
					                   								                						                							                     		
<div class="widget-products product-tabs panel   space-30" style="top: 8px;">
	<div class="widget-content">
	    <div id="latestsliderdiv">
  	<?php include('Latest.php')	?>
  	</div>
	</div>
	</div>
</div>

<script>
</script>				                   								                						                							                     		
<div class="productdeals panel panel-default nopadding ">
	<div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title"></h4></div>
	<div class="widget-inner panel-body">
		<div class="box-products  owl-carousel-play border" id="pavdealswddeals-6" data-ride="owlcarousel">
			<div class="owl-carousel" data-show="1" data-pagination="false" data-navigation="true">	</div> 
		</div>
	</div>
</div>
<?php 
   //include('bottomslider.php')
?>                					
<div id="dealssliderdivs"></div>
<div style=""></div>
<div class="widget panel ">
	<div class="clearfix"></div>
	<div class="box-products  owl-carousel-play border"></div>
</div>
	<?php //include('top_rating.php') ?>
	<div id="topratingsliderdivs"> </div>	
  <!--===============   test for slider (TRENDING OFFERS) (start) =====================-->
	<div class="widget panel ">
    	<div class="clearfix"></div>
    	<div class="box-products  owl-carousel-play border"></div>
    </div>
	<?php //include('top_rating.php')
	?>
	<div id="topratingsliderdivs2"></div>
	
	
<!--===============   test for slider (End) =====================-->
					       
<!--===============   test for slider (Minimum 70% Off) (start) =====================-->
 <div class="widget panel ">
	<div class="clearfix"></div>
	<div class="box-products  owl-carousel-play border"></div>
</div>
	<?php //include('top_rating.php')
	?>
	<div id="topratingsliderdivs3"></div>	
<!--===============   test for slider (End) =====================-->

<!--===============  Ruchi :  test for slider (TRENDING OFFERS2) (start) =====================-->
	<div class="widget panel ">
    	<div class="clearfix"></div>
    	<div class="box-products  owl-carousel-play border"></div>
    </div>
	<?php //include('top_rating.php')
	?>
	<div id="topratingsliderdivs4"></div>	
<!--===============   test for slider (End) =====================-->
<!--===============  Ruchi :  test for slider (TRENDING OFFERS2) (start) =====================-->
	<div class="widget panel ">
    	<div class="clearfix"></div>
    	<div class="box-products  owl-carousel-play border"></div>
    </div>
	<?php //include('top_rating.php')
	?>
	<div id="topratingsliderdivs5"></div>	
<!--===============   test for slider (End) =====================-->
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
<div class="col-inner sidebar hightlight space-30 hidden-sm" >
<div class="widget panel panel-default" style="margin-top:-1%;">
<div class="widget-heading panel-heading block-borderbox" style="margin-top: 0px;padding-top: 0px;"><h4 class="panel-title">Fast Selling Product &nbsp; &nbsp;</h4></div>
<div id="toprightsliderdiv"></div>
<?php
	//include('toprightsliderhomepage.php');
?>
</div>
<div class="clearfix"></div>
<div class="widget panel " style="margin-top:-30px;">
    <div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">On sale</h4></div>
	<?php //include('onsale.php'); ?>
	<div id="onsalesliderdivs"></div>
	<div class="clearfix"></div>
</div>				                   								                						                							                     		<div class="widget panel ">
<div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">Product</h4></div>
<?php
    //include('product_sidebar.php');
?>
	<div id="productsliderdivs"></div>
	<div class="clearfix"></div>
</div>
<div class="widget panel ">
    <div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">Bestseller</h4></div>
    	<?php //include('bestseller.php');	?>
			<div id="bestsellerdivs">
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
				    	<div class="row-inner clearfix"></div>
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
 
 
 
 
 
<!--==============================for image Slider  (Start) ===================-->
 <!--
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
                                <div class="layerslider-wrapper" >
	<?php // include('slider.php');?>
</div>
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
</div></div></div></div></div></div></div></div></div></div></div>-->

<!--==============================for image Slider  (End) ===================-->
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
</body>
</html>