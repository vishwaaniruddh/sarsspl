<?php session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

    include("config.php");
    include("getlocationforsearch.php");
    $stsss=0; //used in menu.php 0 means indexpage 
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
        <title>All Mart </title>
        <link rel="stylesheet" href="">
        <meta name="description" content="My Store" />
        <link href="https://allmart.world/ecommerce" rel="canonical" />
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

.open .dropdown-menu{
    position: fixed;
    z-index: 10000;
    top: 25% !important;
    left: 0% !important;
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
    if(dtss["adid"]!="")
    {
        var adid=document.getElementById('adplid').value;
        $.ajax(
		{
			type:'POST', 
		    url:'updtadsplayeddetailsfreegeoip.net.php',
			url:'updtadsplayeddetails.php',
			data:'adid='+adid,
			success: function(msg)
			{
                //alert(msg);
			}
		});
    }

}



function rtymvid()
{
    var myVid = document.getElementById('vid');
    myVid.control = false;
    $.ajax({
		type:'POST',    
		url:'gettime_new2.php',
		/*url:'gettime_new.php',*/
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

}
}
$( document ).ready(function(){
$(window).scroll(function(){
// This is then function used to detect if the element is scrolled into view

function elementScrolled(elem)
{
    //return true;
    try
    {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();
        var elemTop = $("#"+elem).offset().top;
        return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
    } catch(ex)
    {

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
            // alert(adsid[incr]);
            myVid.src = 'samplevideo.php?sid='+adsid[incr]+'&stats=movie1';
            document.getElementById('adplid').value=adsid[incr];
            //myVid.currentTime =arr[0];
            myVid.play(); 
            incr++;
        } else {
            incr=0;  
            myVid.src = 'samplevideo.php?sid='+adsid[incr]+'&stats=movie1';
            document.getElementById('adplid').value=adsid[incr];
            myVid.play(); 
            incr++;
        }
    }catch(exc) {

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
        $.ajax({
        		type:'POST',    
        		url:'toprightsliderhomepage.php',
        		data:'latitude='+latitude+'&longitude='+longitude,
        		success: function(msg)
        		{
        		    //alert(msg) 
        			document.getElementById("toprightsliderdiv").innerHTML=msg;	
        		    //fnuncloadfn();
        		    //showslider2();
        		}
        	});
    }catch(ex) {
        // alert(ex);
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
        $.ajax({
        		type:'POST',    
        		url:'onsale.php',
        		data:'latitude='+latitude+'&longitude='+longitude,
        		success: function(msg)
        		{
        			document.getElementById("onsalesliderdivs").innerHTML=msg;
        		}
        	});
    }catch(ex) {
        // alert(ex);
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
    // alert(ex);
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
        // alert(ex);
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
    	 
    $.ajax({
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
        // alert(ex);
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
        // alert(ex);
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
        // alert(ex);
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
    // alert(ex);
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
    // alert(ex);
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
        // alert(ex);
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
        // alert(ex);
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
        // alert(ex);
    }
}
/*Ruchi*/
/*function addcart(pid,cid)
{
    alert('added to cart successfully'+pid+cid);
    $.ajax({
		type:'POST',    
		url:'addcart.php',
		data:'pid='+pid+'&cid='+cid,
		success: function(msg)
		{
			alert('added to cart successfully');
		}
	});
}*/
</script>
    </head>
    <body id="bd" class="common-home page-common-home layout-fullwidth">
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
        </div>
        
        </div>
        
        <style>
            .doc_img img{
                width:300px;
                height:300px;
                display:block;
                margin:auto; 
            }
            .doc_img a p{
                text-align:center;
                    font-size: 20px;
    margin: 1% auto;
            }

        </style>
        
        <br>
        <br>
        <br>
        <br>
        
        <div class="container-fluid">
            
            <!--<div class="container">-->
    <div class="row">
        <!--<h3></h3>-->
        <div class="col-md-2"></div>
        <div class="col-md-8">
        
        <div class="single-bottom" style="display: block;">						
							<p>&nbsp;</p>

<p><strong><u><span ><span >RETURN AND CANCELLATION POLICY</span></span></u></strong></p>

<ol style="list-style-type:upper-alpha">
	<li><strong><u><span ><span >Renting</span></span></u></strong></li>
</ol>

<p>&nbsp;</p>

<ol>
	<li><span ><span >This policy governs the cancellation and return of any Order placed by the Website User (defined hereinafter) on www.allmart.world (defined hereinafter).</span></span></li>
</ol>

<p><span ><span >The domain name http://www.allmart.world.com (hereinafter referred to as the "website") is owned by All mart</span></span><span ><span > a proprietorship firm located </span></span><span >at </span><span >101, Maheshwar Milan, NP Thakkar<span > Road, Vile Parle (East), Mumbai 400057.</span></span></p>

<p><span ><span >2. For the purpose of this Return and Cancellation Policy, wherever the context so requires “Website&nbsp; Owner” and “Website” shall mean All mart and www.allmart.world, respectively. Also, wherever the context so requires, “Website&nbsp; User" or “User” or “he/ she” or “his/ her” shall mean any natural or legal person who is competent to enter into a legally binding Contract under the “Indian Contract Act, 1872” (hereinafter referred to as the “Contract Act”). Any person who is not competent under the Contract Act to enter into a legally binding Contract including minors, un-discharged insolvents, persons of unsound mind etc. are not eligible to use this&nbsp; Website. This&nbsp; Website is intended for individuals who are 18 years of age or above. By accessing or using this&nbsp; Website or the services rendered by this&nbsp; Website in any manner, the&nbsp; Website User warrants that he/ she is 18 years of age or above.<br>
<br>
3. By accessing, browsing, using and/or availing the services, products and tools provided by this&nbsp; Website, the&nbsp; Website User agrees to abide and be bound by the provisions of this “Return and Cancellation Policy” as applicable to this&nbsp; Website. The&nbsp; Website User’s access to and use of this Site and/or the Services is conditional upon the&nbsp; Website User’s acceptance and continuous compliance with the provisions of this “Return and Cancellation Policy” and the Terms of Use and other policies available on this Site at all times. The&nbsp; Website Owner reserves the right to refuse access to this&nbsp; Website and/or terminate account(s) and/or remove and/or edit content at any time without Notice to the&nbsp; Website User. It is the&nbsp; Website User’s responsibility to review this “Return and Cancellation Policy” periodically for updates/ changes. The&nbsp; Website User’s continued use of this&nbsp; Website following the posting of changes will mean that he/she accepts and agrees to the revisions. If the&nbsp; Website User does not agree to be bound by any of the provisions of this Return and Cancellation Policy then he/ she shall not use and/ or access this&nbsp; Website.<br>
<br>
4. The&nbsp; Website Owner owes no liability to the&nbsp; Website User for citing any reason for cancelling any Order made by the&nbsp; Website User. </span></span></p>

<p><span ><span >5. By mere use of this&nbsp; Website, the&nbsp; Website User expressly consents to the terms of this “Return and Cancellation Policy”. This “Return and Cancellation Policy” is incorporated into and subject to the Terms of Use of this&nbsp; Website. This “Return and Cancellation Policy” shall be read in accordance with and subject to the provisions of the Terms of Use of this &nbsp;Website.</span></span></p>

<p><span ><span >6.No </span></span><span >cancellation request will be allowed. However All mart reserves the right to final decision for the same.</span></p>

<p><span >7.The Website User shall return the </span><span >All mart</span><span > Zip Bag, Wooden Hanger, Jewellery Box (if any) along with any other merchandise which was delivered with the product<span >(s). Failing which, INR 250/- shall be deducted from the Security Deposit </span></span></p>

<p><span ><span >8.The Website Owner will inspect the product(s) returned by the Website User when it reaches its warehouse and check whether the product(s) is intact and is in the same condition as it was when it was delivered to him/ her. </span></span><span ><span >All mart</span></span><span ><span > reserves the right to take the final decision about the condition of the returned product(s).</span></span></p>

<ol>
	<li><span ><span >In case of any Major Damage (any kind of loss which diminishes the commercial value of the product, including but not limited to, theft, alteration, non-reversible treatment to the fabric, replacing original product with fake product, fabric burn, ripping off of the fabric) being caused to the product(s) while it is in the custody of the Website User, an additional charge of up to 100% of the Retail value of such product(s), as determined by the Website Owner, shall be payable by the Website User.</span></span></li>
	<li><span ><span >&nbsp;The Website User explicitly agrees to the levy of such additional charge on account of Major Loss (defined above) being caused to the product(s) while in the custody of the Website User, as determined by the Website Owner.</span></span></li>
	<li><span ><span >The Pick-up time shall be mutually decided between the Delivery Personnel and Website User over phone-call on the day of pick-up. The Delivery Personnel shall call the Website User for knowing the Pick-up time.</span></span></li>
	<li><span ><span >The Website User is advised to check the product(s) thoroughly at the time of delivery and in case of any problem, including but not limited to, size, colour, style and/ or damage, the Website User shall intimate the Delivery Personnel about the same and shall return the product(s) with the Delivery Personnel. Once, the Delivery Personnel leaves the premises of the Website User and till the product(s) reaches the warehouse of the Website Owner, any kind of damage found on the product(s) shall be the sole liability of the Website User.</span></span></li>
</ol>

<p>&nbsp;</p>

<p style="margin-left:.25in">&nbsp;</p>

<ol start="6">
	<li><span ><span >Purchases from the website.</span></span></li>
</ol>

<h3 ><span ><span ><span >RETURNS AND SUBSTITUTIONS</span></span></span></h3>

<h4 ><span ><span ><span >1. RETURNS and SUBSTITUTIONS</span></span></span></h4>

<p><span ><span >In the odd case that you do not love your All mart products, here is our policy on returns:</span></span></p>

<ol>
	<li><span ><span ><span >You need to return the product to us in an unused condition. </span></span></span><span ><span >Products that are eligible for return can be returned within 72 hours of receiving the merchandise. The All mart Care team must receive and approve your return request. Once your request is received and approved, you will have to self ship the products back to us. The courier slip with proper shipping date will have to be mailed to us. <span >We recommend using an insured delivery service since the liability for the purchase is not transferred to ourselves until the return is received by ourselves or our representatives.</span></span></span></li>
	<li><span ><span >&nbsp;Once your return has been authorized, we'd be happy to process your refund. You can choose to receive the refund in the form of store credit, which will reflect in your All mart account within 72 working hours from when the product has been received at our warehouse. However, if you'd like to receive the amount back to the same payment mode that you used to place this order, we will initiate the refund after we receive the item and it has gone through the necessary quality checks.<span > You should allow up to 14 days from receipt by us of your returned goods for your refund to be processed. Charges incurred by yourself for returning your purchase will not be refunded. This does not affect your statutory rights.</span></span></span></li>
	<li><span ><span ><span >These conditions do not apply to custom made / made to measure products that are made after an order is placed on our site and specifically for customers, hence returns are not possible. Additionally, if any product has been partly or completely changed for your order, including but not restricted to changing lengths or changing colours or changing the fit, then returns for the same are not possible.</span></span></span></li>
</ol>

<p>&nbsp;</p>

<h4 ><span ><span ><span >2. DAMAGED OR FAULTY GOODS</span></span></span></h4>

<ol>
	<li><span ><span ><span >We employ professional carriers for all our deliveries to customers. In the unlikely event that your merchandise arrives damaged, you should </span></span><a href="mailto:hello@jaypore.com"><span ><span >email us</span></span></a><span ><span > a photo of the damaged product with the Bar Code. You must </span></span><a href="mailto:hello@jaypore.com"><span ><span >email us</span></span></a><span ><span > about any damaged product with the Bar Code. If a product is damaged or faulty, please contact us at once and no later than 2 working days of receipt, or of the fault developing, and we will arrange a refund or replacement as you request. We will refund the full purchase price of an item which is delivered in a damaged or faulty condition, provided adequate proof of the same has been provided. Alternatively, at your option, we will replace the item with the same or a similar product (subject to stock availability). </span></span></span></li>
	<li><span ><span ><span >All our clothing is required to be dry cleaned only. Owing to the detailed hand printing, hand embroidery and beading on the garments, it is advised that you only dry clean them. Any damage to the garments due to any other cleaning technique will not be our responsibility or liability.</span></span></span></li>
	<li><span ><span ><span >Sometimes the product specifications may change because of availability of material, embroidery materials or embellishments. In case the changes are substantially different from the advertised products, you can request a replacement and we will do our best to offer you a substitute of the same or better quality at the same price. If you are not happy with the replacement, you can return it in accordance with our returns policy as outlined above under paragraph. Please allow up to 14 days from receipt by us of your item for your refund to be processed or replacement item despatched.</span></span></span></li>
	<li><span ><span ><span >We reserve the right to refuse to issue a refund/replacement item and to recover the cost of the returns delivery from you in the event that the item is found to have suffered damage after delivery or has been misused or used other than in accordance with the instructions or if the problem is due to normal wear and tear. This does not affect your statutory rights.</span></span></span></li>
	<li><span ><span ><span >We aim to process all returns within 14 days. If you have any questions about your return, feel free to reach out to the All mart Care team at </span></span><a href="mailto:returns@test.com"><span >returns@test.com</span></a></span></li>
	<li><span ><span ><span >All returns are subject to the discretion of All mart. But we're a friendly bunch :)</span></span></span></li>
	<li><span ><span ><span >For any other questions or clarifications, please reach out to the </span></span><span ><span >All mart Care team at enquiry@test.com</span></span></span></li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<!---->						     </div>
						     
    </div>
</div>
            
        </div>
        <br>
        <br><br>
        <br>
        
        </body>


<? include('footer.php');?>
</html>