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
                    <div><p><strong>Allmart Terms of Use</strong></p>
<p><strong>This document is an electronic record in terms of Information Technology Act, 2000 and rules there under as applicable and the amended provisions pertaining to electronic records in various statutes as amended by the Information Technology Act, 2000. This electronic record is generated by a computer system and does not require any physical or digital signatures.</strong></p>
<p><strong>This document is published in accordance with the provisions of Rule 3 (1) of the Information Technology (Intermediaries guidelines) Rules, 2011 that require publishing the rules and regulations, privacy policy and Terms of Use for access or usage of domain name </strong>[<strong>www.Allmart.world</strong>][www.Allmart.world] <strong>(“Website”), including the related mobile site and mobile application (hereinafter referred to as “Platform”) </strong></p>
<p>The Platform is owned by Allmart Internet Private Limited a company incorporated under the Companies Act, 1956 with its registered office at Buildings Alyssa, Begonia &amp; Clover, Embassy Tech Village, Outer Ring Road, Devarabeesanahalli Village, Bengaluru – 560103, Karnataka, India (hereinafter referred to as "Allmart").</p>
<p>Your use of the Platform and services and tools are governed by the following terms and conditions <strong>("Terms of Use")</strong> as applicable to the Platform including the applicable policies which are incorporated herein by way of reference. If You transact on the Platform, You shall be subject to the policies that are applicable to the Platform for such transaction. By mere use of the Platform, You shall be contracting with Allmart Internet Private Limited and these terms and conditions including the policies constitute Your binding obligations, with Allmart.</p>
<p>For the purpose of these Terms of Use, wherever the context so requires <strong>"You"</strong> or <strong>"User"</strong> shall mean any natural or legal person who has agreed to become a buyer on the Platform by providing Registration Data while registering on the Platform as Registered User using the computer systems. Allmart allows the User to surf the Platform or making purchases without registering on the Platform. The term <strong>"We", "Us", "Our"</strong> shall mean Allmart Internet Private Limited.</p>
<p>When You use any of the services provided by Us through the Platform, including but not limited to, (e.g. Product Reviews, Seller Reviews), You will be subject to the rules, guidelines, policies, terms, and conditions applicable to such service, and they shall be deemed to be incorporated into this Terms of Use and shall be considered as part and parcel of this Terms of Use. We reserve the right, at Our sole discretion, to change, modify, add or remove portions of these Terms of Use, at any time without any prior written notice to You. It is Your responsibility to review these Terms of Use periodically for updates / changes. Your continued use of the Platform following the posting of changes will mean that You accept and agree to the revisions. As long as You comply with these Terms of Use, We grant You a personal, non-exclusive, non-transferable, limited privilege to enter and use the Platform.</p>
<p><strong>ACCESSING, BROWSING OR OTHERWISE USING THE SITE INDICATES YOUR AGREEMENT TO ALL THE TERMS AND CONDITIONS UNDER THESE TERMS OF USE, SO PLEASE READ THE TERMS OF USE CAREFULLY BEFORE PROCEEDING</strong>. By impliedly or expressly accepting these Terms of Use, You also accept and agree to be bound by Allmart Policies ((including but not limited to Privacy Policy available at Privacy) as amended from time to time.</p>
<p><strong>Membership Eligibility</strong></p>
<p>Transaction on the Platform is available only to persons who can form legally binding contracts under Indian Contract Act, 1872. Persons who are "incompetent to contract" within the meaning of the Indian Contract Act, 1872 including un-discharged insolvents etc. are not eligible to use the Platform. If you are a minor i.e. under the age of 18 years, you may use the Platform or access content on the Platform only under the supervision and prior consent/ permission of a parent ormlegal guardian.</p>
<p>As a minor if you wish to transact on the Platform, such transaction on the Platform may be made by your legal guardian or parents. Allmart reserves the right to terminate your membership and / or refuse to provide you with access to the Platform if it is brought to Allmart's notice or if it is discovered that You are under the age of 18 years and transacting on the Platform.</p>
<p><strong>Your Account and Registration Obligations</strong></p>
<p>If You use the Platform, You shall be responsible for maintaining the confidentiality of your Display Name and Password and You shall be responsible for all activities that occur under your Display Name and Password. You agree that if You provide any information that is untrue, inaccurate, not current or incomplete or We have reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, or not in accordance with the this Terms of Use, We shall have the right to indefinitely suspend or terminate or block access of your membership on the Platform and refuse to provide You with access to the Platform.</p>
<p>Your mobile phone number and/or e-mail address is treated as Your primary identifier on the Platform. It is your responsibility to ensure that Your mobile phone number and your email address is up to date on the Platform at all times. You agree to notify Us promptly if your mobile phone number or e-mail address changes by updating the same on the Platform through a onetime password verification.</p>
<p>You agree that Allmart shall not be liable or responsible for the activities or consequences of use or misuse of any information that occurs under your Account in cases, including, where You have failed to update Your revised mobile phone number and/or e-mail address on the Website Platform.</p>
<p>If You share or allow others to have access to Your account on the Platform (“Account”), by creating separate profiles under Your Account, or otherwise, they will be able to view and access Your Account information. You shall be solely liable and responsible for all the activities undertaken under Your Account, and any consequences therefrom.</p>
<p><strong>Communications</strong></p>
<p>When You use the Platform or send emails or other data, information or communication to us, You agree and understand that You are communicating with Us through electronic records and You consent to receive communications via electronic records from Us periodically and as and when required. We may communicate with you by email or by such other mode of communication, electronic or otherwise.</p>
<p><strong>Platform for Transaction and Communication</strong></p>
<p>The Platform is a platform that Users utilize to meet and interact with one another for their transactions. Allmart is not and cannot be a party to or control in any manner any transaction between the Platform's Users.</p>
<p>Henceforward:</p>
<ol>
<li>All commercial/contractual terms are offered by and agreed to between Buyers and Sellers alone. The commercial/contractual terms include without limitation price, shipping costs, payment methods, payment terms, date, period and mode of delivery, warranties related to products and services and after sales services related to products and services. Allmart does not have any control or does not determine or advise or in any way involve itself in the offering or acceptance of such commercial/contractual terms between the Buyers and Sellers. All discounts, offers (including exchange offers) are by the Seller/Brand and not by Allmart.</li>
<li>Placement of order by a Buyer with Seller on the Platform is an offer to buy the product(s) in the order by the Buyer to the Seller and it shall not be construed as Seller's acceptance of Buyer's offer to buy the product(s) ordered. The Seller retains the right to cancel any such order placed by the Buyer, at its sole discretion and the Buyer shall be intimated of the same by way of an email/SMS. Any transaction price paid by Buyer in case of such cancellation by Seller, shall be refunded to the Buyer. Further, the Seller may cancel an order wherein the quantities exceed the typical individual consumption. This applies both to the number of products ordered within a single order and the placing of several orders for the same product where the individual orders comprise a quantity that exceeds the typical individual consumption. What comprises a typical individual's consumption quantity limit shall be based on various factors and at the sole discretion of the Seller and may vary from individual to individual.</li>
<li>Allmart does not make any representation or Warranty as to specifics (such as quality, value, salability, etc) of the products or services proposed to be sold or offered to be sold or purchased on the Platform. Allmart does not implicitly or explicitly support or endorse the sale or purchase of any products or services on the Platform. Allmart accepts no liability for any errors or omissions, whether on behalf of itself or third parties.</li>
<li>Allmart is not responsible for any non-performance or breach of any contract entered into between Buyers and Sellers. Allmart cannot and does not guarantee that the concerned Buyers and/or Sellers will perform any transaction concluded on the Platform. Allmart shall not and is not required to mediate or resolve any dispute or disagreement between Buyers and Sellers.</li>
<li>Allmart does not make any representation or warranty as to the item-specifics (such as legal title, creditworthiness, identity, etc) of any of its Users. You are advised to independently verify the bona fides of any particular User that You choose to deal with on the Platform and use Your best judgment in that behalf.</li>
<li>Allmart does not at any point of time during any transaction between Buyer and Seller on the Platform come into or take possession of any of the products or services offered by Seller nor does it at any point gain title to or have any rights or claims over the products or services offered by Seller to Buyer.</li>
<li>At no time shall Allmart hold any right, title or interest over the products nor shall Allmart have any obligations or liabilities in respect of such contract entered into between Buyers and Sellers. Allmart is not responsible for unsatisfactory or delayed performance of services or damages or delays as a result of products which are out of stock, unavailable or back ordered.</li>
<li>The Platform is only a platform that can be utilized by Users to reach a larger base to buy and sell products or services. Allmart is only providing a platform for communication and it is agreed that the contract for sale of any of the products or services shall be a strictly bipartite contract between the Seller and the Buyer.Allmart, currently, does not facilitate business to business transaction between Sellers and business customers. You are advised to refrain from transacting on the Platform if You intend to avail the benefits of input tax credit.</li>
</ol>
<p>At no time shall Allmart hold any right, title or interest over the products nor shall Allmart have any obligations or liabilities in respect of such contract.</p>
<p>Allmart is not responsible for unsatisfactory or delayed performance of services or damages or delays as a result of products which are out of stock, unavailable or back ordered.</p>
<ol>
<li>You shall independently agree upon the manner and terms and conditions of delivery, payment, insurance etc. with the seller(s) that You transact with.</li>
</ol>
<p>Disclaimer: Pricing on any product(s) as is reflected on the Platform may due to some technical issue, typographical error or product information published by seller may be incorrectly reflected and in such an event seller may cancel such your order(s).</p>
<ol>
<li>You release and indemnify Allmart and/or any of its officers and representatives from any cost, damage, liability or other consequence of any of the actions of the Users of the Platform and specifically waive any claims that you may have in this behalf under any applicable law. Notwithstanding its reasonable efforts in that behalf, Allmart cannot take responsibility or control the information provided by other Users which is made available on the Platform. You may find other User's information to be offensive, harmful, inconsistent, inaccurate, or deceptive. Please use caution and practice safe trading when using the Platform.</li>
</ol>
<p>Please note that there could be risks in dealing with underage persons or people acting under false pretence.</p>
<p><strong>Charges</strong></p>
<p>Membership on the Platform is free for buyers. Allmart does not charge any fee for browsing and buying on the Platform. Allmart reserves the right to change its Fee Policy from time to time. In particular, Allmart may at its sole discretion introduce new services and modify some or all of the existing services offered on the Platform. In such an event Allmart reserves the right to introduce fees for the new services offered or amend/introduce fees for existing services, as the case may be. Changes to the Fee Policy shall be posted on the Platform and such changes shall automatically become effective immediately after they are posted on the Platform. Unless otherwise stated, all fees shall be quoted in Indian Rupees. You shall be solely responsible for compliance of all applicable laws including those in India for making payments to Allmart Internet Private Limited.</p>
<p><strong>Use of the Platform</strong></p>
<p>You agree, undertake and confirm that Your use of Platform shall be strictly governed by the following binding principles:</p>
<ol>
<li>You shall not host, display, upload, modify, publish, transmit, update or share any information which:</li>
</ol>
<p>(a) belongs to another person and to which You does not have any right to;</p>
<p>(b) is grossly harmful, harassing, blasphemous, defamatory, obscene, pornographic, paedophilic, libellous, invasive of another's privacy, hateful, or racially, ethnically objectionable, disparaging, relating or encouraging money laundering or gambling, or otherwise unlawful in any manner whatever; or unlawfully threatening or unlawfully harassing including but not limited to "indecent representation of women" within the meaning of the Indecent Representation of Women (Prohibition) Act, 1986;</p>
<p>(c) is misleading in any way;</p>
<p>(d) is patently offensive to the online community, such as sexually explicit content, or content that promotes obscenity, paedophilia, racism, bigotry, hatred or physical harm of any kind against any group or individual;</p>
<p>(e) harasses or advocates harassment of another person;</p>
<p>(f) involves the transmission of "junk mail", "chain letters", or unsolicited mass mailing or "spamming";</p>
<p>(g) promotes illegal activities or conduct that is abusive, threatening, obscene, defamatory or libellous;</p>
<p>(h) infringes upon or violates any third party's rights [including, but not limited to, intellectual property rights, rights of privacy (including without limitation unauthorized disclosure of a person's name, email address, physical address or phone number) or rights of publicity];</p>
<p>(i) promotes an illegal or unauthorized copy of another person's copyrighted work (see "Copyright complaint" below for instructions on how to lodge a complaint about uploaded copyrighted material), such as providing pirated computer programs or links to them, providing information to circumvent manufacture-installed copy-protect devices, or providing pirated music or links to pirated music files;</p>
<p>(j) contains restricted or password-only access pages, or hidden pages or images (those not linked to or from another accessible page);</p>
<p>(k) provides material that exploits people in a sexual, violent or otherwise inappropriate manner or solicits personal information from anyone;</p>
<p>(l) provides instructional information about illegal activities such as making or buying illegal weapons, violating someone's privacy, or providing or creating computer viruses;</p>
<p>(m) contains video, photographs, or images of another person (with a minor or an adult).</p>
<p>(n) tries to gain unauthorized access or exceeds the scope of authorized access to the Platform or to profiles, blogs, communities, account information, bulletins, friend request, or other areas of the Platform or solicits passwords or personal identifying information for commercial or unlawful purposes from other users;</p>
<p>(o) engages in commercial activities and/or sales without Our prior written consent such as contests, sweepstakes, barter, advertising and pyramid schemes, or the buying or selling of "virtual" products related to the Platform. Throughout this Terms of Use, Allmart's prior written consent means a communication coming from Allmart's Legal Department, specifically in response to Your request, and specifically addressing the activity or conduct for which You seek authorization;</p>
<p>(p) solicits gambling or engages in any gambling activity which We, in Our sole discretion, believes is or could be construed as being illegal;</p>
<p>(q) interferes with another USER's use and enjoyment of the Platform or any other individual's User and enjoyment of similar services;</p>
<p>(r) refers to any Platform or URL that, in Our sole discretion, contains material that is inappropriate for the Platform or any other Platform, contains content that would be prohibited or violates the letter or spirit of these Terms of Use.</p>
<p>(s) harm minors in any way;</p>
<p>(t) infringes any patent, trademark, copyright or other proprietary rights or third party's trade secrets or rights of publicity or privacy or shall not be fraudulent or involve the sale of counterfeit or stolen products;</p>
<p>(u) violates any law for the time being in force;</p>
<p>(v) deceives or misleads the addressee/ users about the origin of such messages or communicates any information which is grossly offensive or menacing in nature;</p>
<p>(w) impersonate another person;</p>
<p>(x) contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer resource; or contains any trojan horses, worms, time bombs, cancelbots, easter eggs or other computer programming routines that may damage, detrimentally interfere with, diminish value of, surreptitiously intercept or expropriate any system, data or personal information;</p>
<p>(y) threatens the unity, integrity, defence, security or sovereignty of India, friendly relations with foreign states, or public order or causes incitement to the commission of any cognizable offence or prevents investigation of any offence or is insulting any other nation.</p>
<p>(z) shall not be false, inaccurate or misleading;</p>
<p>(aa) shall not, directly or indirectly, offer, attempt to offer, trade or attempt to trade in any item, the dealing of which is prohibited or restricted in any manner under the provisions of any applicable law, rule, regulation or guideline for the time being in force.</p>
<p>(ab) shall not create liability for Us or cause Us to lose (in whole or in part) the services of Our internet service provider ("ISPs") or other suppliers;</p>
<ol>
<li>You shall not use any "deep-link", "page-scrape", "robot", "spider" or other automatic device, program, algorithm or methodology, or any similar or equivalent manual process, to access, acquire, copy or monitor any portion of the Platform or any Content, or in any way reproduce or circumvent the navigational structure or presentation of the Platform or any Content, to obtain or attempt to obtain any materials, documents or information through any means not purposely made available through the Platform. We reserve Our right to bar any such activity.</li>
<li>You shall not attempt to gain unauthorized access to any portion or feature of the Platform, or any other systems or networks connected to the Platform or to any server, computer, network, or to any of the services offered on or through the Platform, by hacking, password "mining" or any other illegitimate means.</li>
<li>You shall not probe, scan or test the vulnerability of the Platform or any network connected to the Platform nor breach the security or authentication measures on the Platform or any network connected to the Platform. You may not reverse look-up, trace or seek to trace any information on any other User of or visitor to Platform, or any other customer, including any account on the Platform not owned by You, to its source, or exploit the Platform or any service or information made available or offered by or through the Platform, in any way where the purpose is to reveal any information, including but not limited to personal identification or information, other than Your own information, as provided for by the Platform.</li>
<li>You shall not make any negative, denigrating or defamatory statement(s) or comment(s) about Us or the brand name or domain name used by Us including the terms Allmart, Flyte, Digiflip, Flipcart, Allmart.world, or otherwise engage in any conduct or action that might tarnish the image or reputation, of Allmart or sellers on platform or otherwise tarnish or dilute any Allmart's trade or service marks, trade name and/or goodwill associated with such trade or service marks, trade name as may be owned or used by us. You agree that You will not take any action that imposes an unreasonable or disproportionately large load on the infrastructure of the Platform or Allmart's systems or networks, or any systems or networks connected to Allmart.</li>
<li>You agree not to use any device, software or routine to interfere or attempt to interfere with the proper working of the Platform or any transaction being conducted on the Platform, or with any other person's use of the Platform.</li>
<li>You may not forge headers or otherwise manipulate identifiers in order to disguise the origin of any message or transmittal You send to Us on or through the Platform or any service offered on or through the Platform. You may not pretend that You are, or that You represent, someone else, or impersonate any other individual or entity.</li>
<li>You may not use the Platform or any content for any purpose that is unlawful or prohibited by these Terms of Use, or to solicit the performance of any illegal activity or other activity which infringes the rights of Allmart and / or others.</li>
<li>You shall at all times ensure full compliance with the applicable provisions of the Information Technology Act, 2000 and rules thereunder as applicable and as amended from time to time and also all applicable Domestic laws, rules and regulations (including the provisions of any applicable Exchange Control Laws or Regulations in Force) and International Laws, Foreign Exchange Laws, Statutes, Ordinances and Regulations (including, but not limited to Sales Tax/VAT, Income Tax, Octroi, Service Tax, Central Excise, Custom Duty, Local Levies) regarding Your use of Our service and Your listing, purchase, solicitation of offers to purchase, and sale of products or services. You shall not engage in any transaction in an item or service, which is prohibited by the provisions of any applicable law including exchange control laws or regulations for the time being in force.</li>
<li>Solely to enable Us to use the information You supply Us with, so that we are not violating any rights You might have in Your Information, You agree to grant Us a non-exclusive, worldwide, perpetual, irrevocable, royalty-free, sub-licensable (through multiple tiers) right to exercise the copyright, publicity, database rights or any other rights You have in Your Information, in any media now known or not currently known, with respect to Your Information. We will only use Your information in accordance with the Terms of Use and Privacy Policy applicable to use of the Platform.</li>
<li>From time to time, You shall be responsible for providing information relating to the products or services proposed to be sold by You. In this connection, You undertake that all such information shall be accurate in all respects. You shall not exaggerate or over emphasize the attributes of such products or services so as to mislead other Users in any manner.</li>
<li>You shall not engage in advertising to, or solicitation of, other Users of the Platform to buy or sell any products or services, including, but not limited to, products or services related to that being displayed on the Platform or related to us. You may not transmit any chain letters or unsolicited commercial or junk email to other Users via the Platform. It shall be a violation of these Terms of Use to use any information obtained from the Platform in order to harass, abuse, or harm another person, or in order to contact, advertise to, solicit, or sell to another person other than Us without Our prior explicit consent. In order to protect Our Users from such advertising or solicitation, We reserve the right to restrict the number of messages or emails which a user may send to other Users in any 24-hour period which We deems appropriate in its sole discretion. You understand that We have the right at all times to disclose any information (including the identity of the persons providing information or materials on the Platform) as necessary to satisfy any law, regulation or valid governmental request. This may include, without limitation, disclosure of the information in connection with investigation of alleged illegal activity or solicitation of illegal activity or in response to a lawful court order or subpoena. In addition, We can (and You hereby expressly authorize Us to) disclose any information about You to law enforcement or other government officials, as we, in Our sole discretion, believe necessary or appropriate in connection with the investigation and/or resolution of possible crimes, especially those that may involve personal injury.</li>
</ol>
<p>We reserve the right, but has no obligation, to monitor the materials posted on the Platform. Allmart shall have the right to remove or edit any content that in its sole discretion violates, or is alleged to violate, any applicable law or either the spirit or letter of these Terms of Use. Notwithstanding this right, YOU REMAIN SOLELY RESPONSIBLE FOR THE CONTENT OF THE MATERIALS YOU POST ON THE PLATFORM AND IN YOUR PRIVATE MESSAGES. Please be advised that such Content posted does not necessarily reflect Allmart views. In no event shall Allmart assume or have any responsibility or liability for any Content posted or for any claims, damages or losses resulting from use of Content and/or appearance of Content on the Platform. You hereby represent and warrant that You have all necessary rights in and to all Content which You provide and all information it contains and that such Content shall not infringe any proprietary or other rights of third parties or contain any libellous, tortious, or otherwise unlawful information.</p>
<ol>
<li>Your correspondence or business dealings with, or participation in promotions of, advertisers found on or through the Platform, including payment and delivery of related products or services, and any other terms, conditions, warranties or representations associated with such dealings, are solely between You and such advertiser. We shall not be responsible or liable for any loss or damage of any sort incurred as the result of any such dealings or as the result of the presence of such advertisers on the Platform.</li>
<li>It is possible that other users (including unauthorized users or "hackers") may post or transmit offensive or obscene materials on the Platform and that You may be involuntarily exposed to such offensive and obscene materials. It also is possible for others to obtain personal information about You due to your use of the Platform, and that the recipient may use such information to harass or injure You. We does not approve of such unauthorized uses, but by using the Platform You acknowledge and agree that We are not responsible for the use of any personal information that You publicly disclose or share with others on the Platform. Please carefully select the type of information that You publicly disclose or share with others on the Platform.</li>
<li>Allmart shall have all the rights to take necessary action and claim damages that may occur due to your involvement/participation in any way on your own or through group/s of people, intentionally or unintentionally in DoS/DDoS (Distributed Denial of Services).</li>
<li><p>If you choose to browse or transact on the Platform using the voice command-based shopping<br>feature, you acknowledge that Allmart and/or its affiliates will collect, store and use your voice inputs on this feature to customize your experience and provide additional functionality as well as to improve Allmart’s and/or its affiliates’ products and services. Allmart’s and/or its affiliates’ use of your voice data will be in accordance with the Allmart Privacy Policy. You accept that your use of this feature is restricted to the territory of the Republic of India. This feature may not be accessible on certain devices and requires an internet connection. Allmart reserves the right to change, enhance, suspend, or discontinue this feature, or any part of it, at any time without notice to you. Your continued use of this feature constitutes your acceptance of the terms related to this feature.</p>
</li>
<li><p>You acknowledge and agree that the Hindi, Telegu, Tamil and Kannada translation features are made available on the Platform on a reasonable effort basis for convenience only, without any representation or warranties by Allmart, express or implied, including the translations being error free, their accuracy, completeness or reliability. Under the translation feature, You will have the option to adding delivery addresses in the language selected by You out of the featured languages. Such delivery addresses shall be transliterated in English language for processing, handling and fulfilling Your orders on the Platform. Allmart expressly disclaims any liability of any nature whatsoever arising from or related to the said translation/transliteration features on the Platform. Some features and sections on the Platform may not be translated in the language selected by You [Hindi, Telegu, Tamil or Kannada language, as applicable], and the English version of the same will be the definitive version. In the event of any conflict or inconsistency between the translated terms and the English version available on the Platform, the English version on the Platform shall prevail. This feature may not be accessible on certain devices. Allmart reserves the right to change, enhance, suspend, or discontinue this feature, or any part of it, at any time without notice to You.</p>
</li>
</ol>
<p><strong>Contents Posted on Platform</strong></p>
<p>All text, graphics, user interfaces, visual interfaces, photographs, trademarks, logos, sounds, music and artwork (collectively, "Content"), is a third party user generated content and Allmart has no control over such third party user generated content as Allmart is merely an intermediary for the purposes of this Terms of Use.</p>
<p>Except as expressly provided in these Terms of Use, no part of the Platform and no Content may be copied, reproduced, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted or distributed in any way (including "mirroring") to any other computer, server, Platform or other medium for publication or distribution or for any commercial enterprise, without Allmart's express prior written consent.</p>
<p>You may use information on the products and services purposely made available on the Platform for downloading, provided that You (1) do not remove any proprietary notice language in all copies of such documents, (2) use such information only for your personal, non-commercial informational purpose and do not copy or post such information on any networked computer or broadcast it in any media, (3) make no modifications to any such information, and (4) do not make any additional representations or warranties relating to such documents.</p>
<p>You shall be responsible for any notes, messages, emails, reviews, ratings, billboard postings, photos, drawings, profiles, opinions, ideas, images, videos, audio files or other materials or information posted or transmitted to the Platform (collectively, "Content"). Such Content will become Our property and You grant Us the worldwide, perpetual and transferable rights in such Content. We shall be entitled to, consistent with Our Privacy Policy as adopted in accordance with applicable law, use the Content or any of its elements for any type of use forever, including but not limited to promotional and advertising purposes and in any media whether now known or hereafter devised, including the creation of derivative works that may include the Content You provide. You agree that any Content You post may be used by us, consistent with Our Privacy Policy and Rules of Conduct on Site as mentioned herein, and You are not entitled to any payment or other compensation for such use. </p>
<p>SOME CONTENT OFFERED ON THE PLATFORM MAY NOT BE SUITABLE FOR SOME VIEWERS AND THEREFORE VIEWER DISCRETION IS ADVISED. ALSO, SOME CONTENT OFFERED ON THE PLATFORM MAY NOT BE APPROPRIATE FOR VIEWERSHIP BY CHILDREN. PARENTS AND/OR LEGAL GUARDIANS ARE ADVISED TO EXERCISE DISCRETION BEFORE ALLOWING THEIR CHILDREN AND/OR WARDS TO ACCESS CONTENT ON THE PLATFORM.</p>
<p><strong>Privacy</strong></p>
<p>We view protection of Your privacy as a very important principle. We understand clearly that You and Your Personal Information is one of Our most important assets. We store and process Your Information including any sensitive financial information collected (as defined under the Information Technology Act, 2000), if any, on computers that may be protected by physical as well as reasonable technological security measures and procedures in accordance with Information Technology Act 2000 and Rules there under.Our current Privacy Policy is available at Privacy. Our current Privacy Policy is available at Privacy. f You object to Your Information being transferred or used in this way please do not use Platform. If You object to Your Information being transferred or used in this way please do not use Platform.</p>
<p>We may share personal information with our other corporate entities and affiliates. These entities and affiliatesmay market to you as a result of such sharing unless you explicitly opt-out.</p>
<p>We may disclose personal information to third parties. This disclosure may be required for us to provide youaccess to our Services, to comply with our legal obligations, to enforce our User Agreement, to facilitate our marketing and advertising activities, or to prevent, detect, mitigate, and investigate fraudulent or illegal activities related to our Services. We do not disclose your personal information to third parties for their marketing and advertising purposes without your explicit consent.</p>
<p>We may disclose personal information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to respond to subpoenas, court orders, or other legal process. We may disclose personal information to law enforcement offices, third party rights owners, or others in the good faith belief that such disclosure is reasonably necessary to: enforce our Terms or Privacy Policy; respond to claims that an advertisement, posting or other content violates the rights of a third party; or protect the rights, property or personal safety of our users or the general public.</p>
<p>We and our affiliates will share / sell some or all of your personal information with another business entity should we (or our assets) plan to merge with, or be acquired by that business entity, or re-organization, amalgamation, restructuring of business. Should such a transaction occur that other business entity (or the new combined entity) will be required to follow this privacy policy with respect to your personal information.</p>
<p><strong>Disclaimer of Warranties and Liability</strong></p>
<p>This Platform, all the materials and products (including but not limited to software) and services, included on or otherwise made available to You through this site are provided on "as is" and "as available" basis without any representation or warranties, express or implied except otherwise specified in writing. Without prejudice to the forgoing paragraph, Allmart does not warrant that:</p>
<p>This Platform will be constantly available, or available at all; or</p>
<p>The information on this Platform is complete, true, accurate or non-misleading.</p>
<p>Allmart will not be liable to You in any way or in relation to the Contents of, or use of, or otherwise in connection with, the Platform. Allmart does not warrant that this site; information, Content, materials, product (including software) or services included on or otherwise made available to You through the Platform; their servers; or electronic communication sent from Us are free of viruses or other harmful components.</p>
<p>Nothing on Platform constitutes, or is meant to constitute, advice of any kind. All the Products sold on Platform are governed by different state laws and if Seller is unable to deliver such Products due to implications of different state laws, Seller will return or will give credit for the amount (if any) received in advance by Seller from the sale of such Product that could not be delivered to You.</p>
<p>You will be required to enter a valid phone number while placing an order on the Platform. By registering Your phone number with us, You consent to be contacted by Us via phone calls, SMS notifications, mobile applications and/or any other electronic mode of communication in case of any order or shipment or delivery related updates. We will not use your personal information to initiate any promotional phone calls or SMS.</p>
<p><strong>Selling</strong></p>
<p>As a registered seller, you are allowed to list item(s) for sale on the Platform in accordance with the Policies which are incorporated by way of reference in this Terms of Use. You must be legally able to sell the item(s) you list for sale on our Platform. You must ensure that the listed items do not infringe upon the intellectual property, trade secret or other proprietary rights or rights of publicity or privacy rights of third parties. Listings may only include text descriptions, graphics and pictures that describe your item for sale. All listed items must be listed in an appropriate category on the Platform. All listed items must be kept in stock for successful fulfilment of sales.</p>
<p>The listing description of the item must not be misleading and must describe actual condition of the product. If the item description does not match the actual condition of the item, you agree to refund any amounts that you may have received from the Buyer. You agree not to list a single product in multiple quantities across various categories on the Platform. Allmart reserves the right to delete such multiple listings of the same product listed by you in various categories.</p>
<p><strong>Services</strong></p>
<p>Payment</p>
<p>While availing any of the payment method/s available on the Platform, we will not be responsible or assume any liability, whatsoever in respect of any loss or damage arising directly or indirectly to You due to:</p>
<ol>
<li>Lack of authorization for any transaction/s, or</li>
<li>Exceeding the preset limit mutually agreed by You and between "Bank/s", or</li>
<li>Any payment issues arising out of the transaction, or</li>
<li>Decline of transaction for any other reason/s</li>
</ol>
<p>All payments made against the purchases/services on Platform by you shall be compulsorily in Indian Rupees acceptable in the Republic of India. Platform will not facilitate transaction with respect to any other form of currency with respect to the purchases made on Platform.</p>
<p>Before shipping / delivering your order to you, Seller may request you to provide supporting documents (including but not limited to Govt. issued ID and address proof) to establish the ownership of the payment instrument used by you for your purchase. This is done in the interest of providing a safe online shopping environment to Our Users.</p>
<p>Further:</p>
<ol>
<li>Transactions, Transaction Price and all commercial terms such as Delivery, Dispatch of products and/or services are as per principal to principal bipartite contractual obligations between Buyer and Seller and payment facility is merely used by the Buyer and Seller to facilitate the completion of the Transaction. Use of the payment facility shall not render Allmart liable or responsible for the non-delivery, non-receipt, non-payment, damage, breach of representations and warranties, non-provision of after sales or warranty services or fraud as regards the products and /or services listed on Allmart's Platform.</li>
<li>You have specifically authorized Allmart or its service providers to collect, process, facilitate and remit payments and / or the Transaction Price electronically or through Cash on Delivery to and from other Users in respect of transactions through Payment Facility. Your relationship with Allmart is on a principal to principal basis and by accepting these Terms of Use you agree that Allmart is an independent contractor for all purposes, and does not have control of or liability for the products or services that are listed on Allmart's Platform that are paid for by using the Payment Facility. Allmart does not guarantee the identity of any User nor does it ensure that a Buyer or a Seller will complete a transaction.</li>
<li>You understand, accept and agree that the payment facility provided by Allmart is neither a banking nor financial service but is merely a facilitator providing an electronic, automated online electronic payment, receiving payment through Cash On Delivery, collection and remittance facility for the Transactions on the Allmart Platform using the existing authorized banking infrastructure and Credit Card payment gateway networks. Further, by providing Payment Facility, Allmart is neither acting as trustees nor acting in a fiduciary capacity with respect to the Transaction or the Transaction Price.</li>
</ol>
<p>Payment Facility for Buyers:</p>
<ol>
<li>You, as a Buyer, understand that upon initiating a Transaction You are entering into a legally binding and enforceable contract with the Seller to purchase the products and /or services from the Seller using the Payment Facility, and You shall pay the Transaction Price through Your Issuing Bank to the Seller using Payment Facility.</li>
<li>You, as a Buyer, may agree with the Seller through electronic communication and electronic records and using the automated features as may be provided by Payment Facility on any extension / increase in the Dispatch and/or Delivery time and the Transaction shall stand amended to such extent. Any such extension / increase of Dispatch / Delivery time or subsequent novation / variation of the Transaction should be in compliance with Payment Facility Rules and Policies.</li>
<li>You, as a Buyer, shall electronically notify Payment Facility using the appropriate Allmart Platform features immediately upon Delivery or non Delivery within the time period as provided in Policies. Non notification by You of Delivery or non Delivery within the time period specified in the Policies shall be construed as a deemed Delivery in respect of that Transaction. In case of Cash On Delivery transactions, Buyer is not required to confirm the receipt of products or services.</li>
<li>You, as a Buyer, shall be entitled to claim a refund of the Transaction Price (as Your sole and exclusive remedy) in case You do not receive the Delivery within the time period agreed in the Transaction or within the time period as provided in the Policies, whichever is earlier. In case you do not raise a refund claim using Platform features within the stipulated time than this would make You ineligible for a refund.</li>
<li>You, as a Buyer, understand that the Payment Facility may not be available in full or in part for certain category of products and/or services and/or Transactions as mentioned in the Policies and hence You may not be entitled to a refund in respect of the Transactions for those products and /or services</li>
<li>Except for Cash On Delivery transaction, refund, if any, shall be made at the same Issuing Bank from where Transaction Price was received, or through any other method available on the Platform, as chosen by You.</li>
<li>For Cash On Delivery transactions, refunds, if any, will be made via electronic payment transfers.</li>
<li>Refund shall be made in Indian Rupees only and shall be equivalent to the Transaction Price received in Indian Rupees.</li>
<li>For electronics payments, refund shall be made through payment facility using NEFT / RTGS or any other online banking / electronic funds transfer system approved by Reserve Bank India (RBI).</li>
<li>Refunds may be supported for select banks. Where a bank is not supported for processing refunds, You will be required to share alternate bank account details with us for processing the refund.</li>
<li>Refund shall be conditional and shall be with recourse available to Allmart in case of any misuse by Buyer.</li>
<li>We may also request you for additional documents for verification.</li>
<li>Refund shall be subject to Buyer complying with Policies.</li>
<li>Allmart reserves the right to impose limits on the number of Transactions or Transaction Price which Allmart may receive from on an individual Valid Credit/Debit/ Cash Card / Valid Bank Account/ and such other infrastructure or any other financial instrument directly or indirectly through payment aggregator or through any such facility authorized by Reserve Bank of India to provide enabling support facility for collection and remittance of payment or by an individual Buyer during any time period, and reserves the right to refuse to process Transactions exceeding such limit.</li>
<li>Allmart reserves the right to refuse to process Transactions by Buyers with a prior history of questionable charges including without limitation breach of any agreements by Buyer with Allmart or breach/violation of any law or any charges imposed by Issuing Bank or breach of any policy.</li>
<li>Allmart may do such checks as it deems fit before approving the receipt of/Buyers commitment to pay (for Cash On Delivery transactions) Transaction Price from the Buyer for security or other reasons at the discretion of Allmart. As a result of such check if Allmart is not satisfied with the creditability of the Buyer or genuineness of the Transaction or other reasons at its sole discretion, Allmart shall have the right to reject the receipt of / Buyers commitment to pay Transaction Price. For avoidance of doubt, it is hereby clarified that the ‘Cash on Delivery’ feature for payment, may be disabled for certain account users, at the sole discretion of Allmart.</li>
<li>Allmart may delay notifying the payment confirmation i.e. informing Seller to Dispatch, if Allmart deems suspicious or for Buyers conducting high transaction volumes to ensure safety of the Transaction and Transaction Price. In addition, Allmart may hold Transaction Price and Allmart may not inform Seller to Dispatch or remit Transaction Price to law enforcement officials (instead of refunding the same to Buyer) at the request of law enforcement officials or in the event the Buyer is engaged in any form of illegal activity.</li>
<li>The Buyer and Seller acknowledge that Allmart will not be liable for any damages, interests or claims etc. resulting from not processing a Transaction/Transaction Price or any delay in processing a Transaction/Transaction Price which is beyond control of Allmart.</li>
</ol>
<p>Compliance with Laws:</p>
<ol>
<li>As required by applicable law, if the Customer makes a purchase of an amount equal to or above INR 2 00 000.00, the Customer will be required to upload a scanned copy of his/her PAN card on the Platform, within 4 days of making the purchase, failing which, the purchase made by the Customer will be cancelled. The requirement to submit the PAN card arises only once and if it has been submitted once by the Customer, it need not be submitted again. The order of the Customer shall stand cancelled if there is a discrepancy between the name of the Customer and the name on the PAN Card.</li>
<li>Buyer and Seller shall comply with all the applicable laws (including without limitation Foreign Exchange Management Act, 1999 and the rules made and notifications issued there under and the Exchange Control Manual as may be issued by Reserve Bank of India from time to time, Customs Act, Information and Technology Act, 2000 as amended by the Information Technology (Amendment) Act 2008, Prevention of Money Laundering Act, 2002 and the rules made there under, Foreign Contribution Regulation Act, 1976 and the rules made there under, Income Tax Act, 1961 and the rules made there under, Export Import Policy of government of India) applicable to them respectively for using Payment Facility and Allmart Platform.</li>
</ol>
<p>Buyer's arrangement with Issuing Bank:</p>
<ol>
<li>All Valid Credit / Debit/ Cash Card/ and other payment instruments are processed using a Credit Card payment gateway or appropriate payment system infrastructure and the same will also be governed by the terms and conditions agreed to between the Buyer and the respective Issuing Bank and payment instrument issuing company.</li>
<li>All Online Bank Transfers from Valid Bank Accounts are processed using the gateway provided by the respective Issuing Bank which support Payment Facility to provide these services to the Users. All such Online Bank Transfers on Payment Facility are also governed by the terms and conditions agreed to between Buyer and the respective Issuing Bank.</li>
</ol>
<p><strong>Allmart's Replacement Guarantee*</strong></p>
<p>Allmart's Replacement Guarantee seeks to assist Buyers who have been defrauded by qualified sellers on the Platform. The return policy period (Allmart's Replacement Guarantee) depends on the product category and the seller. Kindly click here to know the return policy period applicable for different categories. If at the time of delivery and/or within the applicable return policy period, if any defect is found, then the buyer of the product/s can ask for replacement of the product/s from the seller subject to the following terms and conditions</p>
<ol>
<li>Notify seller of any defects in the product/s at the time of delivery of the product/s and/or within the applicable return policy period and the same product/s will be replaced in return of the defective product/s.</li>
<li>Replacement can be for the entire product/s or part/s of the product subject to availability of the same with the seller.</li>
</ol>
<p>Following products shall not be eligible for return or replacement:</p>
<p>a. Damages due to misuse of product;</p>
<p>b. Incidental damage due to malfunctioning of product;</p>
<p>c. Any consumable item which has been used/installed;</p>
<p>d. Products with tampered or missing serial/UPC numbers;</p>
<p>e. Digital products/services (Flyte music downloads)</p>
<p>f. Any damage/defect which are not covered under the manufacturer's warranty</p>
<p>g. Any product that is returned without all original packaging and accessories, including the box, manufacturer's packaging if any, and all other items originally included with the product/s delivered;</p>
<p>h. Jewellery which is 'made to order' on customer's request</p>
<p>On Clothing and Footwear, qualified sellers accept 30 day exchange subject to the following conditions:</p>
<p>Clothes and footwear are not used (other than for trial), altered, washed, soiled or damaged in any way.</p>
<p>Original tags and packaging should be intact. For items that come in branded packaging, the box should be undamaged.</p>
<p>Returns are not applicable for 'Made to order' jewellery, Innerwear, lingerie, socks, clothing freebies, etc.</p>
<p>Damaged or defective or 'Not as described' products in Lifestyle category (includes clothing, footwear, etc.) are meanwhile covered by the 30 Day Replacement Guarantee. Kindly click here to know the return policy period (Replacement Guarantee) applicable for different categories.</p>
<p>If Allmart has any suspicion or knowledge that any of its buyers and sellers are involved in any activity that is intended to provide claims or information that is false or not genuine, Allmart may also, while reserving its rights to initiate civil and/or criminal proceedings against such member buyers and sellers, at its sole discretion, suspend, block, restrict, cancel the Display Name of such buyers and sellers and/or disqualify that user and any related users from availing protection through this program. Customers who have been blocked for any suspicious or fraudulent activity on Allmart will not be allowed to return their products.</p>
<p>Allmart reserves its right to initiate civil and/or criminal proceedings against a user who, files a invalid and/or false claims or provides false, incomplete, or misleading information. In addition to the legal proceedings as aforesaid, Allmart may at its sole discretion suspend, block, restrict, cancel the Display Name [and its related Display Names] of such user and/or disqualify that user and any related users from availing protection through this program. Any person who, knowingly and with intent to injure, defraud or deceive, files a Fraudulent Complaint containing false, incomplete, or misleading information may be guilty of a criminal offence and will be prosecuted to the fullest extent of the law.</p>
<p>Exchange Offers:</p>
<p>By participating in the exchange I confirm that I am the sole and absolute owner and/or user of the product mentioned above (device).</p>
<p>I confirm that device which I am exchanging under the buyback program is genuine and is not counterfeit, free from any and all encumbrances, liens, attachments, disputes, legal flaws, exchange or any Agreement of Sale etc. and I have got the clear ownership of the said device.</p>
<p>You agree to indemnity and keep indemnifying Allmart.world and any future buyer of the device against all or any third party claims, demand, cost, expenses including attorney fees which may be suffered, incurred, undergone and / or sustained by Allmart.world, its affiliates or any future buyer due to usage of the device by you till date and you undertake to make good the same.</p>
<p>I confirm that all the data in the said device will be erased before handing it over under buy back program. I also confirm that in spite of erasing the data manually/electronically, if any data still accessible due any technical reason, Allmart.world, Seller or the Manufacturer shall not be responsible for the same and I will not approach Allmart.world for any retrieval of the data.</p>
<p>I hereby give my consent that my personal information that I have provided in connection with this buyback program might be processed, transferred and retained by the retailer and other entities involved in managing the program for the purposes of validating the information that I provided herein and for the administration of the program.</p>
<p>I agree to indemnity and keep indemnifying the Allmart.world and any future buyer of the old device against all or any third party claims, demand, cost, expenses including attorney fees which may be suffered, incurred, undergone and / or sustained by Allmart.world, its affiliates or any future buyer due to usage of the device by me till date and I undertake to make good the same.</p>
<p>I understand once a device is sent by me to Allmart, in no scenario can this device be returned back to me.</p>
<p>I understand that the new device delivery and the old device pickup will happen simultaneously (hand in hand) and I shall keep the old device ready to be given for exchange.</p>
<p>Products distributed as gifts from state sponsored or NGO funded distribution programs are not accepted for exchange under exchange offers.</p>
<p><strong>Digital Content: Music</strong></p>
<p>Music (MP3 format): Only certain short listed Seller (at the sole discretion of Allmart) shall be entitled to sell Music (MP3 format) on the Platform. You may be able to purchase DRM-free digital music in MP3 file format on the Platform from the respective Sellers. Such MP3 music files shall be provided to You as per selection provided by Seller, subject to certain limitations as described by the Seller. You shall be granted specified download rights of DRM-free MP3 music files from the catalogue of MP3 music displayed on the Platform. The MP3 music may include full-length MP3 audio tracks at best available bit rate and certain other premium features, as may be provided on the Platform by respective Sellers from time to time.</p>
<p>Territory: Currently You can purchase downloadable digital MP3 music only through the Platform and Flyte Music Application as may be made available from time to time on the Platform, only within the territory of India.</p>
<p>Rights Granted: Music download right is a non-exclusive, non-transferable right to use for your personal, non-commercial, entertainment use, subject to and in accordance with the Terms of Use. You may copy, store, transfer and burn the MP3 music file only for your personal, non-commercial, entertainment use, subject to and in accordance with the Terms of Use. You represent, warrant and agree that You will use the MP3 music file only for your personal, non-commercial, entertainment use and not for any redistribution of the same or other use restricted in this Section. You agree not to infringe the rights of the copyright owners and to comply with all applicable laws in your use of the MP3 music file. You agree that You will not redistribute, transmit, assign, sell, broadcast, rent, share, lend, modify, adapt, edit, license or otherwise transfer or use MP3 music file. You are not granted any synchronization, public performance, promotional use, commercial sale, resale, reproduction or distribution rights for MP3 music file. You acknowledge that the MP3 music file embodies the intellectual property of a third party and is protected by law.</p>
<p>Explicit Consent: You agree that we shall have no liability to You for MP3 music file downloaded by You on the Platform if You find the same to be offensive, indecent or objectionable and expressions through the audio files are not subscribed by us.</p>
<p>Cash on Delivery as a mode of payment is not available for purchasing MP3 music on the Platform currently.</p>
<p>All Sales Final; Downloading and Risk of Loss; Availability of MP3 music files: All sales of MP3 music files are final. Returns of MP3 music files are not permissible on Platform. Once You have purchased MP3 music files, Allmart encourages You to download it promptly. If You are unable to complete a download, please contact customer service within 6 hours of the payment.</p>
<p>Further Allmart assumes no liability if your media player does not support the file format made available by the Seller on the Platform or your browser does not support the music download application / software available by the Seller on the Platform, by whatever name called.</p>
<p>You bear all risk of loss after purchase and for any loss of MP3 music files You have downloaded, including any loss due to a computer or hard drive crash.</p>
<p>Seller may, from time to time, at its sole discretion, remove MP3 music files from the Service without notice.</p>
<p>Intellectual Property Rights: It is hereby specifically recorded that the copyright and other Intellectual Property in the music available on the Platform is the sole and exclusive property of third parties. Seller represents and warrants that Sellers are authorized by such third parties to upload the music on the Platform for license of use to the end customers. Intellectual Property Rights for the purpose of this Terms of Use shall always mean and include copyrights whether registered or not, patents including rights of filing patents, trademarks, trade names, trade dresses, house marks, collective marks, associate marks and the right to register them, designs both industrial and layout, geographical indicators, moral rights, broadcasting rights, displaying rights, distribution rights, selling rights, abridged rights, translating rights, reproducing rights, performing rights, communicating rights, adapting rights, circulating rights, protected rights, joint rights, reciprocating rights, infringement rights. All those Intellectual Property rights arising as a result of domain names, internet or any other right available under applicable law shall vest in the domain of Allmart as the owner of such domain name. The Parties hereto agree and confirm that no part of any Intellectual Property rights mentioned hereinabove is transferred in the name of User and any intellectual property rights arising as a result of these presents shall also be in the absolute ownership, possession and Our control or control of its licensors, as the case may be.</p>
<p>Your request to download a MP3 music file is personal to You, and the track may not be used, sold, rented, transferred, licensed or otherwise provided to any other User. The license to downloaded tracks includes only those rights explicitly stated herein (typically, the right to play back for your own personal use from your personal computer, CD player, digital player, or other personal consumer electronic device), and, for the avoidance of doubt, does not include the right to create a derivative work, to make copies other than for your own personal use, or to use the track in any commercial manner. You shall promptly notify Us in writing upon your discovery of any unauthorized use or infringement.</p>
<p>Software: Seller may make available to You, from time to time, software for Your use in connection with the download of MP3 music files (any and all such software, individually and collectively, the "Software").</p>
<p>You may use the Software only in connection with the download of MP3 music files on the Platform. You may not separate any individual component of the Software for use other than in connection to the download, may not incorporate any portion of it into Your own programs or compile any portion of it in combination with your own programs, may not transfer it for use with another service, or use it, or any portion of it, over a network and may not sell, rent, lease, lend, loan, distribute or sub-license the Software or otherwise assign any rights to the Software in whole or in part. Seller may discontinue some or all of any Software Seller provide, and Seller may terminate your right to use any Software at any time and in such event may modify it to make it inoperable.</p>
<p>Without limiting the Disclaimer of Warranties and Limitation of Liability in this terms of use, (i) in no event shall Our or software licensors' total liability to You for all damages arising out of or related to your use or inability to use the Software and / or download manager or any other application exceed the amount of â‚¹20; and (ii) in no event shall Our or Our Digital Content providers' total liability to You for all damages arising from your use of the Service, the Digital Content, or information, materials or products included on or otherwise made available to You through the Service (excluding the Software), exceed the amount You paid to purchase, on the Service, the Digital Content related to Your claim for damages.</p>
<p><strong>Digital Content: eBooks</strong></p>
<p>ebook (ePub format): You will be able to purchase DRM-encrypted eBooks in ePub file format on the Allmart Platform and the Flyte eBooks application. Such ePub files shall be provided to you as per your selection, subject to certain limitations as described herein. You shall be granted specified download rights of DRM-encrypted ePub files from the catalog of eBooks displayed on the Platform.</p>
<p>Download rights: You will need to be registered with Allmart to make an ebook purchase. The eBooks which you purchase from the Allmart Platform or Flyte eBooks application shall be added in your Allmart eBooks library from where you can download the eBooks onto your device(/s). Each downloaded ebook is locked to the User account and the downloader device. These downloaded eBooks cannot be transferred onto other devices. Each device used by you will have to be synced with your online eBooks library. You can sync a maximum of six(6) devices against your user account. You can download the eBooks to your mobile or tablet devices for offline reading and can read the eBooks using the Flyte eBooks Application only.</p>
<p>Flyte eBooks application: Flyte eBooks application will enable you to read the digital books purchased from the Flyte eBooks store, on your mobile or tablet devices. The app also has an in-app Flyte eBooks store where the user can quickly purchase eBooks. The Flyte eBooks app will be available in the Android platform. The Android app will be compatible with both mobiles and tablet devices. You can download the Flyte eBooks android app for free from the Allmart Platform and also Google Play.</p>
<p>Territory: Currently you can purchase downloadable eBooks only through the Platform and Flyte eBooks Application as may be made available from time to time on the Platform, only within the territory of India. You have to be within the Indian Territory to even download the already purchased files from your Allmart eBooks library.</p>
<p>DRM Specifications: The DRM (Digital Rights Management) enables us to restrict certain permissions. The Flyte DRM specifications restrict the following permissions:</p>
<table>
 <thead>
  <tr>
   <th><p>Default Restrictions</p></th>
   <th><p>Allmart Settings</p></th>
  </tr>
 </thead>
 <tbody>
  <tr>
   <td><p>Printing</p></td>
   <td><p>Not Allowed</p></td>
  </tr>
  <tr>
   <td><p>Copying</p></td>
   <td><p>Not Allowed</p></td>
  </tr>
  <tr>
   <td><p>Side-Loading (from one device to other)</p></td>
   <td><p>Not Allowed</p></td>
  </tr>
  <tr>
   <td><p>e-mailing</p></td>
   <td><p>Not Allowed</p></td>
  </tr>
  <tr>
   <td><p>Saving Images</p></td>
   <td><p>Not Allowed</p></td>
  </tr>
  <tr>
   <td><p>Read out aloud</p></td>
   <td><p>Not Allowed</p></td>
  </tr>
  <tr>
   <td><p>Number of distinct devices for file downloading</p></td>
   <td><p>Allowed (Six)</p></td>
  </tr>
  <tr>
   <td><p>Social media sharing</p></td>
   <td><p>140 word</p></td>
  </tr>
 </tbody>
</table>

<p>Rights Granted: Upon your payment of our fees for ebook, we grant you a non-exclusive, non-transferable right to use the downloaded ebook for your personal, non-commercial, entertainment use, subject to and in accordance with the Terms of Use. You may store the ebook only for your personal, non-commercial, entertainment use, subject to and in accordance with the Terms of Use.</p>
<p>You represent, warrant and agree that you will use the ebook only for your personal, non-commercial, entertainment use and not for any redistribution of the same or other use restricted in this Section. You agree not to infringe the rights of the copyright owners and to comply with all applicable laws in your use of the ebook. You agree that you will not redistribute, transmit, assign, sell, broadcast, rent, share, lend, modify, adapt, edit, license or otherwise transfer or use ebook.</p>
<p>You are not granted any synchronization, public performance, promotional use, commercial sale, resale, reproduction or distribution rights for ebook. You acknowledge that the ebook embodies the intellectual property of a third party and is protected by law.</p>
<p>Explicit Consent: You agree that we shall have no liability to you for ebook downloaded by You on the Platform or Flyte Apps if you find the same to be offensive, indecent or objectionable.</p>
<p>Payment: The Price List for each downloadable ebook displayed on the Platform represents the full retail price (inclusive of all taxes unless specified otherwise) for said downloadable ebook. You shall pay for such downloadable ebook using one of the payment options available on the Platform.</p>
<p>The Price List mentions the prices of each downloadable ebook and the User shall pay in Indian Currency (i.e. Indian Rupee). We reserve our right to change the prices of the ebook and services and the availability of the same at our sole discretion.</p>
<p>Allmart will allow the user to buy ebook using the following forms of payments.</p>
<p>--&gt; Credit Cards</p>
<p>--&gt; Internet Banking</p>
<p>--&gt; Debit Cards</p>
<p>--&gt; Allmart Wallet</p>
<p>--&gt; any other mode of payment, as may be decided and made available on the Platform.</p>
<p>Please note that payment can be made only in India Rupees and all the above payment instruments must have been issued by entities operating in India and subject to Indian regulations.</p>
<p>Cash on Delivery as a mode of payment is not available for purchasing ebook on the Platform currently.</p>
<p>Payment made by credit card or any other mode as mentioned above should be received by us on time. If for any reason we do not receive payment from the credit card issuer or any agent involved in any of the above payment modes, You agree that you shall pay all amounts due upon demand by us.</p>
<p>All Sales Final; Downloading and Risk of Loss; Availability of eBooks. All sales of eBooks are final. We do not accept returns of eBooks. Once you have purchased eBooks, we encourage you to download it promptly. If you are unable to complete a download, please contact customer service within 30 days of the payment. The ebook will be removed from your library and the amount that was charged during the payment will be refunded in the form of store credit. The eBooks will also be replaced in cases of genuine technical errors as mentioned in the replacement policy.</p>
<p>You bear all risk of loss after purchase and for any loss of eBooks you have downloaded, including any loss due to a computer or hard drive crash. We may, from time to time, at our sole discretion remove eBooks from the Service without notice.</p>
<p>Intellectual Property Rights: It is hereby specifically recorded that the copyright and other Intellectual Property in the ebook available on the Platform is the sole and exclusive property of third parties. We are authorised by such third parties to upload the ebook on the Platform for license of use to the end customers. Intellectual Property Rights for the purpose of this Agreement shall always mean and include copyrights whether registered or not, patents including rights of filing patents, trademarks, trade names, trade dresses, house marks, collective marks, associate marks and the right to register them, designs both industrial and layout, geographical indicators, moral rights, broadcasting rights, displaying rights, distribution rights, selling rights, abridged rights, translating rights, reproducing rights, performing rights, communicating rights, adapting rights, circulating rights, protected rights, joint rights, reciprocating rights, infringement rights. All those Intellectual Property rights arising as a result of domain names, internet or any other right available under applicable law shall vest in the domain of Allmart Internet Private Limited as the owner of such domain name. The Parties hereto agree and confirm that no part of any Intellectual Property rights mentioned hereinabove is transferred in the name of User and any intellectual property rights arising as a result of these presents shall also be in the absolute ownership, possession and our control or control of its licensors, as the case may be.</p>
<p>Your request to download an ebook is personal to you, and the ebook may not be used, sold, rented, transferred, licensed or otherwise provided to any other user. The license to downloaded eBooks includes only those rights explicitly stated herein (typically, the right to read the ebook in Flyte eBooks Application), and, for the avoidance of doubt, does not include the right to create a derivative work, to make copies, or to use the ebook in any commercial manner. You shall promptly notify us in writing upon your discovery of any unauthorized use or infringement.</p>
<p>Software: We may make available to you, from time to time, software or updates for your use in connection with the download of eBooks (any and all such software, individually and collectively, the "Software").</p>
<p>You may use the Software only in connection with the download of eBooks on the Platform. You may not separate any individual component of the Software for use other than in connection to the download, may not incorporate any portion of it into Your own programs or compile any portion of it in combination with your own programs, may not transfer it for use with another service, or use it, or any portion of it, over a network and may not sell, rent, lease, lend, loan, distribute or sub-license the Software or otherwise assign any rights to the Software in whole or in part. We may discontinue some or all of any Software we provide, and we may terminate your right to use any Software at any time and in such event may modify it to make it inoperable.</p>
<p>Without limiting the Disclaimer of Warranties and Limitation of Liability in this terms of use, in no event shall our or our and/or our Digital Content providers' total liability to You for all damages arising from your use of the Service, the Digital Content, or information, materials or products included on or otherwise made available to You through the Service (excluding the Software), exceed the amount You paid to purchase, on the Service, the Digital Content related to Your claim for damages.</p>
<p><strong>Digital Content: Allmart Ideas</strong></p>
<ol>
<li>These Terms of Service (“Terms”) govern your access to and use of Allmart Ideas (hereinafter referred to as “Content”). By viewing the Contents you agree to be bound by these Terms. Content posted on the Platform is public and can be viewed by everyone who can see the Page.</li>
<li>Allmart is hosting the Content generated by third party users (“Content Owner”), within the FK Platform for convenience of Platform Users, and as such, Allmart has no ownership or control whatsoever in the Contents displayed. The Contents posted by the Content Owners are of personal views wherein Allmart plays no role in creating/developing the Content. You are responsible for your use of the Platform for viewing the Content.</li>
<li>By hosting the Content on the Platform, Allmart is neither guaranteeing nor giving any warranty nor making any representation with respect to the Contents. Allmart is neither endorsing the views, products or the Services, nor is it responsible for quality or features of the content displayed on the Platform. </li>
<li>Any information on the Platform, whether the content or any other information, have not been verified by Allmart, therefore, Allmart shall not be responsible for any such content or information. Allmart will not bear any obligation or liability if You rely on the Contents. </li>
<li>If You choose to view or rely, Allmart will neither be a party to nor in any manner concerned with the same nor be liable or responsible for any act or omission of the Content Owner. </li>
<li>You hereby acknowledge that the Contents are created and owned by Content Owners who own all the rights including the copyrights in the contents. The Contents are available on the Platform for personal use only and you shall not use it for any commercial, promotional, resale or further distribution purposes. </li>
<li>Any use or reliance on any Content or materials obtained by you through the Content is at your own risk. We do not endorse, support, represent or guarantee the completeness, truthfulness, accuracy, or reliability of any Content or communications posted on the Platform or endorse any opinions expressed via the contents. You understand that by using the Platform, you may be exposed to Content that might be offensive, harmful, inaccurate or otherwise inappropriate, or in some cases, postings that have been mislabeled or are otherwise deceptive. All Content is the sole responsibility of the person who originated such Content. Allmart may not monitor or control the Content posted on the Platform and, we do not take responsibility for such Content.</li>
<li>We reserve the right to remove Content that violates the Terms of Use, including for example, copyright or trademark violations, impersonation, unlawful conduct, or harassment. </li>
<li>If you see an offensive, abusive, or any unlawful content on the Platform, you can report it to <strong>ideas-support@Allmart.world</strong></li>
<li>You may find content that offends you or that you simply don’t like, but that doesn’t violate the content guidelines. If that happens, you can unfollow the user who posted it or hide the post</li>
<li>Your access to and use of the Services or any Content are at your own risk. You understand and agree that the Services are provided to you on an “AS IS” and “AS AVAILABLE” basis. Allmart makes no warranty or representation and disclaim all responsibility and liability for: (i) the completeness, accuracy, availability, timeliness, security or reliability of any Content; (ii) any harm to your computer system, loss of data, or other harm that results from your access to or use of any Content; (iii) the deletion of, or the failure to store or to transmit, any Content and other communications maintained by the Services; and (iv) whether the Services will meet your requirements or be available on an uninterrupted, secure, or error-free basis. No advice or information, whether oral or written, obtained through the Content, will create any warranty or representation not expressly made herein.</li>
<li>By using the Services you agree that Allmart, its parents, affiliates, related companies, officers, directors, employees, agents representatives, partners and licensors, liability is limited to the maximum extent permissible by Law.</li>
<li>We may revise these Terms from time to time.</li>
</ol>
<p><strong>Digital Content: Allmart Video</strong></p>
<ol>
<li><p>These Terms of Service ("Terms") govern your access to and use of Allmart Video which is an online over-the-top platform providing users with live and/or on-demand audio and video content of various genres which may be offered by either Allmart or by third party content providers (all such content, collectively, the "Content").</p>
</li>
<li><p>The Content is being hosted on Allmart mobile App only ("Platform"), that is owned and operated by Allmart Internet Private Limited ("Allmart", "We" or "Our").</p>
</li>
<li><p>This document sets out the terms and conditions in connection with your use of the Platform and, subsequently, your access to and/or consumption of the Content and/or other related services provided on the Platform (all such content and services, collectively, "Services" and such terms and conditions, the <strong>"Terms"</strong> ).</p>
</li>
<li><p>Use of Allmart Services is available only to persons who can form a legally binding contract under the Indian Contract Act, 1872.You must be 18 years of age, to avail the Services. Minors may only use the service under the supervision of an adult. Some content offered on the Platform may not be appropriate for viewership by minors. Accordingly, parents and/or the guardians of such children or minors are advised to exercise discretion before allowing their children or minors to access such content on the Platform.</p>
</li>
<li><p>All the Content being offered to the users on the Platform shall be, for the convenience of the users, free of cost, or at such other terms as may be offered by Allmart or the Content Providers with respect to any Content from time to time, and such other terms shall be communicated to the user at the time of viewing such Content and/or at the time of registering with the Platform. Subject to you accepting these Terms and any other terms as may be communicated to you from time to time, you are given a limited, non-exclusive, non-transferable, non-sub-licensable, revocable permission to view the Platform and avail the Services during the subsistence of your account with Allmart and no right, title or interest in any Content will be deemed transferred to you.</p>
</li>
<li><p>The Platform is an interactive online platform for the users to view the Content of various genres, which may either be offered by Allmart or third party content providers. As regards third party audio-video content generated by third parties (such content, the " <strong>Third Party Content</strong>" and such content providers, the " <strong>Content Owners</strong>"), the Platform offers you such Third Party Content by providing hosting services to Content Owners displaying their content and/or by allowing their content to be viewed by you on the Platform by integrating services and application of other audio-video hosting, caching and/or streaming service or infrastructure providers (" <strong>Platform Partners</strong>") who may have content procurement arrangements with the Content Owners The Platform may also provide content which is commissioned by Allmart and/or is procured by Allmart either under a license or copyright agreement (such content, " <strong>Allmart Originals</strong>").</p>
</li>
<li><p>Content will therefore consist of Allmart Originals or Third Party Content. Content Owners and/or Platform Partners will provide Third Party Content. Specifically, for more information in relation to Third Party Content (including the terms of use relating specifically to Third Partner Content), you may refer to their respective terms and conditions. As such, Allmart has no ownership or control whatsoever on Third Party Content, whether it is uploaded or streamed by Content Owners or by the Platform Partners. Allmart plays no role in creating/developing Third Party Content.</p>
</li>
<li><p>As regards all the news content which are also Third Party Content through the Platform Partners, Allmart's role is strictly limited to providing a uniform resource locator (URL) or a web-address to access and/or share such content on the Internet with the users and all news  content is provided, uploaded, streamed and/or hosted by Content Owners, the Platform Partners and/or their respective agents or service providers. For avoidance of doubt, it is clarified that Allmart will not be hosting, uploading or streaming any news content on its servers or IT systems. Allmart will not be exercising any control – physical, editorial or digital - over the news Content being viewed by or provided to the user on the Platform. Allmart will only be providing the user with an option and/or a medium to access news content through the Platform which, in turn, will provide the Content Providers and/or the Platform Partners an opportunity to disseminate their content on the Platform. The news Content on the Platform is directly uploaded or streamed onto the Platform by Platform Partners who avail of Allmart's communication platform, without any intervention from Allmart in the content procurement/uploading/streaming/transmission process. Allmart's role is that of an 'intermediary' as defined under the Information Technology Act, 2000 and the rules thereunder, with regard to the news  Content. Being an intermediary, Allmart has no responsibility and/or liability in respect of any news Content on the Platform, including for intellectual property rights infringement, defamation, obscenity or any other violation under applicable law.</p>
</li>
<li><p>Irrespective of whether the Content is a Third Party Content or a Allmart Original, you, at all times, are responsible for your use of the Platform and for viewing any Content and Allmart shall have no liability with respect to any loss or damage caused by viewing or relying on the Content. By hosting Allmart Originals on the Platform and by permitting the hosting, uploading or streaming of Third Party Content on the Platform, Allmart will neither guaranteeing nor giving any warranty nor making any representation with respect to the Contents. The Content provided on the Platform is for entertainment or information purposes only and Allmart will neither be endorsing the views, products or the services being depicted or offered as part of the Content, nor will Allmart be responsible for quality or features of the Content displayed on the Platform. Unless expressly stated otherwise, all characters, themes and events depicted in Allmart Originals are entirely fictitious and any similarity to actual events or persons, living or dead, is purely coincidental, unintentional or accidental.</p>
</li>
<li><p>Third Party Content will be made available to you through different modes, including via video-on-demand or on a live streaming basis, depending on the nature of the content and at the discretion of the Content Owners and/or Platform Partners. Allmart Originals will be provided to you through different modes as well as the discretion of Allmart. You may choose to view any Content at your discretion at a time chosen by you and by accepting these Terms and any other terms relating to such Content.</p>
</li>
<li><p>Please note that the availability of, and your ability to access, the Content or some part of the Services, (a) is subject to applicable law and the contractual arrangements between Allmart and the Content Owners and/or Platform Partners; and (b) may be dependent upon your geographical location, your Internet/data connectivity or your system capabilities or compatibility with the Platform. Not all Content or Services will be available to all users. On account of the nature of the Internet/data connectivity and system compatibility, the Platform and the Services may also be accessed in various geographical locations. You, therefore, hereby agree and acknowledge that you are accessing the Platform and availing of the Services, at your own risk, choice and initiative, and you agree and undertake to ensure that your use of the Platform and the Services complies with all applicable laws including the local laws in your jurisdiction. Further, you agree and acknowledge that the Services and Content may vary from place to place, time to time and device to device and the quality and the quantity of your access to the Content or the use of the Platform or availing of the Services would be subject to various parameters such as specifications, device, Internet availability and speed, bandwidth, etc.</p>
</li>
<li><p>Any information on the Platform, whether the Content or any other information (other than Allmart Original), have not been verified by Allmart, and therefore, Allmart shall not be responsible for any such Third Party Content or information. Allmart will not bear any obligation or liability if You rely on the Contents or information and any loss or liability has been incurred by you arising from such Third Party Content or information.</p>
</li>
<li><p>If you choose to view or rely on any Third Party Content or information on the Platform, you will be impliedly accepting the terms of viewing or relying on such Third Party Content or information, as offered by the Content Providers and/or the Platform Partners, and Allmart will neither be a party to such an arrangement nor will it in any manner be concerned with such an arrangement nor will Allmart be liable or responsible for any act or omission of the Content Owner and/or the Platform Partners.</p>
</li>
<li><p>You hereby acknowledge that the Third Party Content is created and owned by the Content Owners who own all the rights including the copyrights with respect to such content. The Content is available on the Platform for personal and non-commercial use only and you shall not use it for any commercial, promotional, resale, further distribution or any other unauthorized purposes. You agree not to use the service for public performances.</p>
</li>
<li><p>You further acknowledge that all the intellectual property rights contained in (a) the Allmart Originals are solely owned by Allmart and (b) in the Third Party Content are solely owned by the Content Owners or licensed to the Platform Partners. During the term of your Allmart membership we grant you a limited, non-exclusive, non-transferable, revocable right to access the Platform and view the Content. Except for the foregoing, no right, title or interest shall be transferred to you in any Content or the Platform.</p>
</li>
<li><p>We can terminate your account or place your account on hold in order to protect our or the interests of the Content Owners or of the Platform Partners, from an actual, probable or suspected theft, loss, damage or other fraudulent activity. Allmart reserves the right to immediately terminate, suspend, limit, or restrict your access or use of the Platform and/or the Services, at any time, without any notice or liability, if Allmart so determines, in its sole discretion, for any reason whatsoever, including that you have: (a) breached these Terms or the Privacy Policy; or (b) violated any applicable law, rule, or regulation; or (c) you have engaged in any inappropriate or unlawful conduct; or (d) provided any false or inaccurate information; or (e) for any other reason that Allmart deems fit in its sole discretion.</p>
</li>
<li><p>Any use or reliance on any Content or materials obtained by you through the Platform is at your own risk. We do not endorse, support, represent or guarantee the completeness, truthfulness, accuracy, or reliability of any Content or communications posted on the Platform or endorse any opinions expressed via the Contents. You understand that by using the Platform, you may be exposed to Content that might be offensive, harmful, inaccurate or otherwise inappropriate, or in some cases, postings that have been mislabeled or are otherwise deceptive. All Third Party Content is the sole responsibility of the Content Owners who originated such  content or it is the responsibility of the Platform Partners who host, upload and/or stream such Third Party Content. Allmart may not monitor or control the Content posted, uploaded and/or streamed on the Platform by the Content Owners, the Platform Partners and/or their respective agents or affiliates, and, we do not take responsibility or liability for any such content.</p>
</li>
<li><p>We reserve the right to remove any Content or the user data that violates these Terms or the applicable law, including for example, copyright or trademark violations, impersonation, unlawful conduct, or harassment. With respect to Third Party Content, Allmart's role is limited to providing a communication platform to Content Owners and/or Platform Partners, to enable the transmission of the Third Party Content directly from such third parties to you.</p>
</li>
<li><p>Personal Information; We may use information such as device ID, location or an account email address used with an existing Allmart account to determine eligibility and any offers therof. We may share personal information with our other corporate entities and Platform Partners only for the purposes of giving enhanced customer services.</p>
</li>
<li><p>Service Interruptions: You hereby consent to sharing your information with third parties unless you specifically opt out. In addition,  your access to the Services and the Platform may also be occasionally suspended or restricted to allow for repairs, maintenance, or the introduction of new facilities or services at any time without prior notice. We will attempt to limit the frequency and duration of any such suspension or restrictions.</p>
</li>
<li><p>If you see an offensive, abusive, or any unlawful content on the Platform, you can report it to customer care of Allmart.</p>
</li>
<li><p>Disclaimer of representations and warranties: Your access to and use of the Services or any Content are at your own risk. You understand and agree that the Services are provided to you on an "AS IS" or "AS AVAILABLE" basis. Allmart makes no warranty or representation and disclaim all responsibility and liability for: (i) the completeness, accuracy, availability, timeliness, security, security and non-compatibility or reliability of any Content; (ii) any harm to your computer system, loss of data, or other harm that results from your access to or use of any Content; (iii) the deletion of, or the failure to store or to transmit, any Content and other communications maintained by the Services; and (iv) whether the Services will meet your requirements or be available on an uninterrupted, secure, or error-free basis. No advice or information, whether oral or written, obtained through the Content, will create any warranty or representation not expressly made herein or therein.</p>
</li>
<li><p>Limitation of liability: By using the Services, you agree that the liability of Allmart, its parents, affiliates, related companies, officers, directors, employees, agents, representatives, partners and licensors, shall be limited to the maximum extent permissible by applicable law. In no case shall Allmart, its directors, officers, employees, affiliates, agents, contractors, principals, or licensors be liable for any direct, indirect, incidental, punitive, special, or consequential damages arising from your use of the Services or any Content or for any other claim related in any way to your access to the Platform and/or use of the Services, including, but not limited to, any errors or omissions in any Content or information on the Platform, or any loss or damage of any kind incurred as a result of the use of the Services and/or reliance on any Content or information on the Platform.</p>
</li>
<li><p>Indemnification: You shall defend, indemnify and hold harmless Allmart its owners, affiliates, subsidiaries, group companies, partners (as applicable), and their respective officers, directors, agents, and employees (" <strong>Indemnified Parties</strong>"), from and against any claim, demand, damages, obligations, penalty, losses or actions (including reasonable attorneys' fees) made by any third party against the Indemnified Parties or imposed against the Indemnified Parties, due to or arising out of your or your affiliate's or relative's: (a) breach of these Terms, the Privacy Policy and/or any other policies; or (b) violation of any applicable law, rules, regulations; or (c) violation of the rights (including infringement of intellectual property rights) of a third party or Allmart; or (d) unauthorized, improper, illegal or wrongful use of your Allmart account (including by you or by any person, including a third party, whether or not authorized or permitted by you). This indemnification obligation will survive the expiry or termination of these Terms and/or your use of the Service.</p>
</li>
<li><p>Force Majeure: You agree that Allmart shall be under no liability whatsoever to you in the event of non-availability of the Platform and/or any of the Services or any portion thereof, occasioned by an Act of God, war, disease, revolution, riot, civil commotion, strike, lockout, flood, fire, satellite failure, failure of any public utility, man-made disaster, satellite failure or any other cause whatsoever beyond the control of Allmart (including any event which is caused by the failure or non-performance on the part of the Content Owners or the Platform Partners).</p>
</li>
<li><p>Governing laws: These Terms shall be governed, interpreted, and construed in accordance with the laws of India, without regard to the conflict of law provisions and for resolution of any dispute arising out of your use of the Services or in relation to these Terms. Notwithstanding the foregoing, you agree that (i) Allmart has the right to bring any proceedings before any court/forum of competent jurisdiction and you irrevocably submit to the jurisdiction of such courts or forum; and (ii) any proceeding brought by you shall be exclusively before the courts in Bengaluru, India.</p>
</li>
<li><p>Severability: If any provision of these Terms is held invalid, void, or unenforceable, then that provision shall be considered severable from the remaining provisions, and the remaining provisions shall be given full force and effect.</p>
</li>
<li><p>Amendments: We may revise these Terms from time to time, without prior notice to you, to update, revise, supplement, and otherwise modify these Terms and to impose new or additional rules, policies, terms, or conditions on your use of the Service. Any updates, revisions, supplements, modifications, and additional rules, policies, terms, and conditions will be posted on the Platform and will be effective immediately after such posting and we recommend that you periodically check these Terms on the Platform for such revised terms. Your continued use of the Services and/or the Platform will be deemed to constitute your acceptance of any and all such revised terms.</p>
</li>
<li><p>Entire agreement: These Terms, the Privacy Policy and any other terms or policies as may be prescribed by Allmart from time to time, constitute the entire agreement between you and Allmart, which will govern your use of or access to the Services and/or the Platform, superseding any prior agreements between you and Allmart regarding such use or access.</p>
</li>
<li><p>Survival: You acknowledge that your representations, undertakings, and warranties and the clauses relating to indemnities, limitation of liability, grant of license, governing law shall survive the efflux of time and the termination of these Terms (including but not limited to Clauses 22 to 30 of these Terms).</p>
</li>
</ol>
<p><strong>Indemnity</strong></p>
<p>You shall indemnify and hold harmless Allmart, its owner, licensee, affiliates, subsidiaries, group companies (as applicable) and their respective officers, directors, agents, and employees, from any claim or demand, or actions including reasonable attorneys' fees, made by any third party or penalty imposed due to or arising out of Your breach of this Terms of Use, privacy Policy and other Policies, or Your violation of any law, rules or regulations or the rights (including infringement of intellectual property rights) of a third party.</p>
<p><strong>Applicable Law</strong></p>
<p>Terms of Use shall be governed by and interpreted and construed in accordance with the laws of India. The place of jurisdiction shall be exclusively in Bangalore.</p>
<p><strong>Jurisdictional Issues/Sale in India Only</strong></p>
<p>Unless otherwise specified, the material on the Platform is presented solely for the purpose of sale in India. Allmart make no representation that materials in the Platform are appropriate or available for use in other locations/Countries other than India. Those who choose to access this site from other locations/Countries other than India do so on their own initiative and Allmart is not responsible for supply of products/refund for the products ordered from other locations/Countries other than India, compliance with local laws, if and to the extent local laws are applicable.</p>
<p><strong>Trademark, Copyright and Restriction</strong></p>
<p>This site is controlled and operated by Allmart and products are sold by respective Sellers. All material on this site, including images, illustrations, audio clips, and video clips, are protected by copyrights, trademarks, and other intellectual property rights. Material on Platform is solely for Your personal, non-commercial use. You must not copy, reproduce, republish, upload, post, transmit or distribute such material in any way, including by email or other electronic means and whether directly or indirectly and You must not assist any other person to do so. Without the prior written consent of the owner, modification of the materials, use of the materials on any other Platform or networked computer environment or use of the materials for any purpose other than personal, non-commercial use is a violation of the copyrights, trademarks and other proprietary rights, and is prohibited. Any use for which You receive any remuneration, whether in money or otherwise, is a commercial use for the purposes of this clause.</p>
<p>Trademark complaint</p>
<p>Allmart respects the intellectual property of others. In case You feel that Your Trademark has been infringed, You can write to Allmart at info@Allmart.world or info@Allmart.world.</p>
<p><strong>Product Description</strong></p>
<p>Allmart we do not warrant that Product description or other content of this Platform is accurate, complete, reliable, current, or error-free and assumes no liability in this regard.</p>
<p><strong>Limitation of Liability</strong></p>
<p>IN NO EVENT SHALL Allmart BE LIABLE FOR ANY SPECIAL, INCIDENTAL, INDIRECT OR CONSEQUENTIAL DAMAGES OF ANY KIND IN CONNECTION WITH THESE TERMS OF USE, EVEN IF USER HAS BEEN INFORMED IN ADVANCE OF THE POSSIBILITY OF SUCH DAMAGES.</p>
<p><strong>POLICIES</strong></p>
<p><strong>Profanity Policy</strong></p>
<p>Allmart prohibits the use of language that is racist, hateful, sexual or obscene in nature in a public area.</p>
<p>This policy extends to text within listings, on Seller pages and all other areas of the site that another User may view. If the profane words are part of a title for the item being sold, we allow Sellers to 'blur' out the bulk of the offending word with asterisks (i.e., s*** or f***).</p>
<p>Please report any violations of this policy to the correct area for review:</p>
<ul>
<li>Report offensive Display Names</li>
<li>Report offensive language in a listing or otherwise</li>
</ul>
<p>If a feedback comment; or any communication made between Users on the Platform; or email communication between Users in relation to transactions conducted on Platform contain profanity, please review Our feedback removal policy and submit a request for action/removal.</p>
<p>Disciplinary action may result in the indefinite suspension of a User's account, temporary suspension, or a formal warning.</p>
<p>Allmart will consider the circumstances of an alleged policy violation and the user's trading records before taking action.</p>
<p>Violations of this policy may result in a range of actions, including:</p>
<ol>
<li>Limits placed on account privileges;</li>
<li>Loss of special status;</li>
<li>Account suspension.</li>
</ol>
<p>Allmart shall have the right to delete a product review posted by the customer at its sole discretion, if it is of the opinion that the review contains offensive language as stated above. Further, if Allmart is of the opinion that the review unfairly either: (i) causes disadvantage to a product; or (ii) increases the popularity of the product, Allmart shall have the right to delete the customer review. Allmart shall also, at its sole discretion have the right to blacklist the customer from posting any further customer reviews.</p>
<p>Replacement Guarantee*</p>
<p>The Replacement Guarantee seeks to assist Buyers who have been defrauded by qualified sellers on the Platform. If at the time of delivery and/or within specified days from the date of delivery of the product/s, if any defect is found, then the buyer of the product/s can ask for replacement of the product/s from the seller.</p>
<p>If Allmart has suspicion or knowledge, that any of its buyers and sellers are involved in any activity that is intended to provide claims or information that is false, misleading or not genuine, then Allmart may while reserving its rights to initiate civil and/or criminal proceedings against User may also at its sole discretion suspend, block, restrict, cancel the Display Name of such buyer and seller and /or disqualify that User and any related Users from availing protection through this program.</p>
<p>Allmart reserves its right to initiate civil and/or criminal proceedings against a User who, files a invalid and/or false claims or provides false, incomplete, or misleading information. In addition to the legal proceedings as aforesaid, Allmart may at its sole discretion suspend, block, restrict, cancel the Display Name [and its related Display Names] of such User and/or disqualify that User and any related Users from availing protection through this program. Any person who, knowingly and with intent to injure, defraud or deceive, files a Fraudulent Complaint containing false, incomplete, or misleading information may be guilty of a criminal offence and will be prosecuted to the fullest extent of the law.</p>
<p>For more details related to Replacement Policy, refer to s/help/cancellation-returns</p>
<p>Returns Policy</p>
<p>Definition: 'Return' is defined as the action of giving back the item purchased by the Buyer to the Seller on the Allmart Platform. Following situations may arise:</p>
<ol>
<li>Item was defective</li>
<li>Item was damaged during the Shipping</li>
<li>Products was / were missing</li>
<li>Wrong item was sent by the Seller.</li>
</ol>
<p>Return could also result in refund of money in most of the cases.</p>
<p>Points to be noted:</p>
<ol>
<li>Seller can always accept the return irrespective of the policy.</li>
<li>If Seller disagrees a return request, Buyer can file a dispute under the Buyer Protection Program*.</li>
</ol>
<p>We encourage the Buyer to review the listing before making the purchase decision. In case Buyer orders a wrong item, Buyer shall not be entitled to any return/refund.</p>
<p>Buyer needs to raise the return request within the return period applicable to the respective product.Once Buyer has raised a return request by contacting Us on Our Toll Free Number, Seller while closing the return ticket can select one of the following:</p>
<ol>
<li>Replace after shipment collection - Seller has agreed to wait for the logistics team to collect the shipment from the buyer before replacing it)</li>
<li>Refund after shipment collection - Seller has agreed to wait for the logistics team to collect the shipment from the buyer before refunding)</li>
<li>Refund without shipment collection - Seller has agreed to refund the buyer without expecting the original shipment back)</li>
<li>Replace without shipment collection - Seller has agreed to replace the order without expecting the original shipment back)</li>
<li>On certain select days as specified by Allmart (such as 'The Big Billion Day') separate policies may be applicable.</li>
</ol>
<p>In the event the Seller accepts the return request raised by the Buyer, Buyer will have to return the product and then the refund shall be credited to the Buyers account.</p>
<p>In case the Seller doesn't close the ticket in 3 days from the date of intimation to the Seller about the refund request, the refund request shall be settled in favor of the Buyer.</p>
<p>Further for returns being made by Buyer to the Seller of the product, the following parameters needs to be ensured by the Buyer:</p>
<table>
 <thead>
  <tr>
   <th><p>Category</p></th>
   <th><p>Condition</p></th>
  </tr>
 </thead>
 <tbody>
  <tr>
   <td><p>Electronics</p></td>
   <td><p>Should be included</p></td>
  </tr>
  <tr>
   <td><p>Clothing and Footwear</p></td>
   <td><p>Should be "New &amp; Unworn" (other than for trial)</p></td>
  </tr>
  <tr>
   <td><p>Beauty, Health &amp; Personal Care</p></td>
   <td><p>Should be "New &amp; Unopened"</p></td>
  </tr>
  <tr>
   <td><p>Sports &amp; Equipment</p></td>
   <td><p>Should be "New" and returned with original packaging</p></td>
  </tr>
  <tr>
   <td><p>Office Products</p></td>
   <td><p>Should be "New" and returned with original packaging</p></td>
  </tr>
  <tr>
   <td><p>Jewellery</p></td>
   <td><p>Should be "New" and returned with original packaging</p></td>
  </tr>
 </tbody>
</table>

<p>If the product being returned is not in accordance with the above parameters, then Buyer shall not be entitled to any refund of money from the Seller.</p>
<p>Shipping cost for returning the product shall be borne and incurred by the Seller.</p>
<p>Replacement</p>
<p>Definition: Replacement is the action or process of replacing something in place of another. A Buyer can request for replacement whenever he is not happy with the item, reason being Damaged in shipping, Defective item, Item(s) missing, wrong item shipped and the like.</p>
<p>Points to be noted:</p>
<ol>
<li>Seller can always accept the return irrespective of the policy.</li>
<li>If Seller disagrees for a return request, Buyer can file a dispute under Buyer Protection Program*.</li>
</ol>
<p>Buyer needs to raise the replacement request within the return period applicable to the respective product. Once Buyer has raised a replacement request by contacting Us on the Toll Free Number provided on the Platform. Once the replacement request has been raised, the following steps shall be followed:</p>
<ol>
<li>Buyer is asked for "Reason for Return". Among others, the following are the leading reasons:</li>
<li>Shipping was damaged</li>
<li>Item was defective</li>
<li>Item Dead on Arrival</li>
<li>Item(s) were missing</li>
<li>Wrong item sent</li>
<li>An intimation shall be provided to Seller seeking either "approval" or "rejection" of the replacement request.</li>
<li>In case the Seller accepts the replacement request, Buyer shall be required to return the product to the Seller and only after return of the product, Seller shall be obliged to provide the replacement product to the Buyer.</li>
<li>Incase Seller rejects the replacement request, Buyer can choose to raise a dispute by writing to resolution@Allmart.world.</li>
</ol>
<p>In case the Seller doesn't have the product at all, Seller can provide the refund to the Buyer and Buyer shall be obligated to accept the refund in lieu of replacement. All the product parameters shall be required to be complied with in cases of replacement.</p>
<p>If the Seller doesn't respond to the Buyer's replacement request, within three (3) days from the date of replacement request placed by the Buyer, refund shall be processed in favour of Buyer and Seller shall be liable to refund amount paid to the Seller.</p>
<p>All shipping and other replacement charges shall be borne and incurred by the Seller.</p>
<p>Disputes (Resolutions) Policy</p>
<p>Overview</p>
<p>Generally, transactions are conducted smoothly on Allmart. However there may be some cases where both the Buyers and Sellers may face issues. At Allmart, we have a Dispute Resolution process in order to resolve disputes between Buyers and Sellers.</p>
<p>What is a 'dispute'?</p>
<p>A 'Dispute' can be defined as a disagreement between a Buyer and a Seller in connection with a transaction on the Platform.</p>
<p>How does a 'dispute' occur in the Marketplace?</p>
<p>Disputes are filed as a result of a disagreement between the Buyer and the Seller. Disputes arise out of an issue that is raised by either party not being completely satisfied with the resolution of their complaint/issue.</p>
<p>It is important that before a Buyer/Seller raises a dispute, they should attempt to solve the issue. Please note that whenever a Buyer raises a dispute, the Seller's payment for that order is put on hold immediately until the issue is resolved.</p>
<p>How is a 'dispute' created?</p>
<p>Whenever there is a disagreement, the Buyer can write to info@Allmart.world, while the Seller can write to ss@Allmart.world, in order to raise a dispute. Disputes can be raised at a particular transaction level.</p>
<p>What are the various types of 'disputes'?</p>
<p>Following are the indicative examples of potential disputes:</p>
<ol>
<li>Wrong item received</li>
<li>Item Not as described</li>
<li>Damaged or Seal broken on Product</li>
<li>Part/Accessory missing</li>
<li>Item not Compatible</li>
<li>Seller Description/Specification Wrong</li>
<li>Defective (Functional issues)</li>
<li>Product not working and Manufacturer claims invalid Invoice</li>
</ol>
<p>In case the Seller rejects the return request of the Buyer, and Buyer raises a dispute, then Allmart will try to mediate and resolve the dispute between both the parties. If the dispute is resolved in favour of the Buyer, a refund is provided once the product is returned to the Seller. If the dispute is settled in favour of the Seller, Buyer is entitled to any refund.</p>
<p>Buyer Protection Program</p>
<p>In case of a dispute where the Seller is unable to provide a refund or a replacement, Allmart will actively work towards reaching a resolution.</p>
<p>The Buyer Protection Program covers Buyers who are unable to successfully resolve their dispute with the Seller or are not satisfied the resolution provided by the Seller.</p>
<p>The Buyer can write to resolution@Allmart.world if the issue with the Seller is not resolved. Allmart's Customer Support team will look into the case to check for possible fraud and if the Buyer has been blacklisted/blocked from making purchases on the Platform. Only after verifying these facts, a dispute can be registered.</p>
<p>In due course of resolution, Allmart's Customer Support Team will facilitate a conference call including the Seller and the Buyer.</p>
<p>When a dispute has been raised, Allmart may provide both the parties access to each others Display Names, contact details including email addresses and other details pertaining to the dispute. Buyers and Sellers are subject to final consent from Allmart for settling the dispute.</p>
<p>Buyer Eligibility and Restrictions</p>
<p>Only the Buyers who have purchased the product on Allmart are eligible for the Buyer Protection Program.</p>
<p>Buyers can file a dispute within 45 days from the date of delivery of the product</p>
<p>Any damage or loss to the product after delivery will not be covered under this program and will completely be the Buyer's responsibility. Buyers should refuse to accept delivery if the item is damaged.</p>
<p>To be able to take advantage of the Buyer Protection Program, Buyers should first contact the Seller and attempt to resolve the issue. If the Buyer doesn't hear from the Seller or is unable to resolve the issue with the Seller even after contact, a dispute can be raised with Allmart by writing an email to resolution@Allmart.world</p>
<p>Fraudulent charges and claims are not covered under Buyer Protection Program</p>
<p>If the Buyer has already initiated chargeback through the credit card issuing bank, it will not be covered under Buyer Protection Program, though in such cases a Seller can file a claim through the Seller Protection Program.</p>
<p>Blacklisted and Blocked Buyers are not covered by the Buyer Protection Program.</p>
<p>Buyers who have reached their maximum lifetime limit for claims are also not eligible. Buyers can make a maximum of 5 claims per year on Allmart. If the claim was withdrawn, it is not counted. The coverage amount will be limited to â‚¹50,000</p>
<p>Through the Buyer Protection program, Allmart does not provide any guarantee/warranty to Buyers for products sold on Allmart against technical/manufacturing defects.</p>
<p>Raising disputes against Sellers does not automatically entitle the Buyer to a refund or replacement for the product purchased. Allmart shall verify the disputes so raised and may process only such claims that are valid and genuine.</p>
<p>Allmart shall at no point be responsible for any direct or indirect losses, expenses, costs of any nature whatsoever that may be incurred by any Buyer/Seller.</p>
<p>Claims of the nature of 'Buyer remorse' (i.e. instances where products are bought by the Buyer by mistake or where the Buyer chooses to change his/her mind with regard to the product purchased by him) will not be entertained through this program.</p>
<p>Allmart reserves its right to initiate civil and/or criminal proceedings against a User who, files an invalid and/or false claims or provides false, incomplete, or misleading information. In addition to the legal proceedings as aforesaid, Allmart may at its sole discretion suspend, block, restrict, cancel the Display Name [and its related Display Names] of such User and/or disqualify that user and any related users from availing protection through this program.</p>
<p>Decisions made by Allmart under the Buyer Protection Program shall be final and binding on its Users.</p>
<p>Allmart reserves the right to modify / discontinue Buyer Protection Program without any prior notice period to its Users.</p>
<p>Through this program, Allmart shall not entertain claims of Buyers who have incurred loss due to delayed shipment or delivery of the item by the Seller.</p>
<p>Allmart Customer Support Team may seek additional information / clarification from Buyer to facilitate resolution of the dispute. In the event Buyer does not respond with information / clarification sought within 10 days of such request, the dispute shall be auto-closed in favour of the Seller.</p>
<p>Disputes via Chargeback</p>
<p>Whenever a chargeback (CB) comes from a payment gateway/bank, following situations may arise:</p>
<ol>
<li>Item not received CB - Buyer hasn't received the item. Refund will be created in accordance with the dispute policies</li>
<li>Unauthorized CB - Buyer hasn't made this particular transaction. Refund will be created in accordance with the dispute policies.</li>
</ol>
<p>Seller expressly agrees that issuing the correct and complete invoice is the sole and primary responsibility of the Seller. Furthermore, Seller shall ensure that invoices state "Powered by Allmart" and failing to do so Seller will be liable for chargebacks (as applicable).</p>
<ol>
<li>Item not as described - meaning item is not what Buyer expected. Dispute will be decided in accordance with the dispute policies.</li>
</ol>
<p>Email Abuse &amp; Threat Policy</p>
<p>Private communication, including email correspondence, is not regulated by Allmart. Allmart encourages its Users to be professional, courteous and respectful when communicating by email.</p>
<p>However, Allmart will investigate and can take action on certain types of unwanted emails that violate Allmart policies.</p>
<p>Such instances:</p>
<p>Threats of Bodily Harm - Allmart does not permit Users to send explicit threats of bodily harm.</p>
<p>Misuse of Allmart System - Allmart allows Users to facilitate transactions through the Allmart system, but will investigate any misuse of this service.</p>
<p>Spoof (Fake) email - Allmart will never ask you to provide sensitive information through email. In case you receive any spoof (fake) email, you are requested to report the same to Us through 'Contact Us' tab.</p>
<p>Spam (Unsolicited Commercial email) - Allmart's spam policy applies only to unsolicited commercial messages sent by Allmart Users. Allmart Users are not allowed to send spam messages to other Users.</p>
<p>Offers to Buy or Sell Outside of Allmart - Allmart prohibits email offers to buy or sell listed products outside of the Allmart Platform. Offers of this nature are a potential fraud risk for both Buyers and Sellers.</p>
<p>Allmart policy prohibits user-to-user threats of physical harm via any method including, phone, email and on Our public message boards.</p>
<p>Violations of this policy may result in a range of actions, including:</p>
<ul>
<li>Limits on account privileges</li>
<li>Account suspension</li>
<li>Cancellation of listings</li>
<li>Loss of special status</li>
</ul>
<p>Other Businesses</p>
<p>Allmart does not take responsibility or liability for the actions, products, content and services on the Platform, which are linked to Affiliates and / or third party Platforms using Platform's APIs or otherwise. In addition, the Platform may provide links to the third party Platforms of Our affiliated companies and certain other businesses for which, Allmart assumes no responsibility for examining or evaluating the products and services offered by them. Allmart do not warrant the offerings of, any of these businesses or individuals or the content of such third party Platform(s). Allmart does not endorse, in any way, any third party Platform(s) or content thereof.</p>
<p>Allmart Infringement Verification (FIV) - Reporting Listing Violations</p>
<p>Allmart has put in place Allmart Infringement Verification process so that intellectual property owners could easily report listings that infringe their rights. It is in Allmart's interest to ensure that infringing products are removed from the site, as they erode Buyer and good Seller trust.</p>
<ul>
<li>If you are a Verified Rights Owner and want to report a listing issue, see Allmart's FIV. Note: Only the intellectual property rights owner can report potentially infringing products or listings through FIV. If you are not the intellectual property rights owner, you can still help by getting in touch with the rights owner and encouraging them to [contact us][].</li>
<li>If your listing was removed through FIV, and you believe that your listing was removed in error, please [contact us][].</li>
</ul>
<p>Allmart does not and cannot verify that Sellers have the right or ability to sell or distribute their listed products. However, Allmart is committed to removing infringing or unlicensed products once an authorized representative of the rights owner properly reports them to Allmart.</p>
<p>FIV works to ensure that item listings do not infringe upon the copyright, trademark or other intellectual property rights of third parties. FIV participants have the ability to identify and request removal of allegedly infringing products and materials.</p>
<p>Any person or company who holds intellectual property rights (such as a copyright, trademark or patent) which may be infringed upon by products listed on Allmart is encouraged to become a FIV member.</p>
<p>Program membership entitles you (Verified Rights Owner) to the following benefits:</p>
<ul>
<li>Rapid response by Allmart in ending listings reported by you (as the Verified Rights Owner) as allegedly infringing</li>
<li>Dedicated priority email queues for reporting alleged infringements</li>
<li>The ability to obtain identifying information about Allmart's users'</li>
</ul>
<p>How to Become a FIV Member</p>
<p>To join the FIV, we require only that you fully complete and email Us a Notice of Infringement form specifying the allegedly infringing listings and the infringed work, complete with an original authorized signature. The information requested by the Notice of Infringement is designed to ensure that parties reporting products are authorized by the rights owners, and to enable Allmart to easily identify the material or listing to be ended.</p>
<p>In the interest of keeping the process easy and simple, after we receive your first Notice of Infringement in hard copy, future notices can be sent to Us by email at info@allmart.com.</p>
<p>Note: In your notice of infringement, you shall be required to identify the individual listing which is infringing your intellectual property. General notices shall not be accepted.</p>
<p>We are happy to receive such information, but must advise that we may be limited in Our ability to respond to your request absent formal notice from an authorized rights owner.</p>
<p>Notice of Infringement</p>
<p>Allmart Internet Private Limited</p>
<p>_______________________</p>
<p>_______________________</p>
<p>I, [name] ____________________________ of [address] _________________________ do solemnly and sincerely declare as follows:</p>
<ol>
<li>I am the owner of certain intellectual property rights, said owner being named __________________ ("IP Owner").</li>
<li>I have a good faith belief that the item listings or materials identified in the annexure attached hereto are not authorised by the above IP Owner, its agent, or the law and therefore infringe the IP Owner's rights. Please expeditiously remove or disable access to the material or products claimed to be infringing.</li>
<li>I may be contacted at:</li>
</ol>
<p>Name ___________________________________________________________</p>
<p>Title &amp; Company ________________________________________________________</p>
<p>Address _________________________________________________________</p>
<p>Email (correspondence) ___________________________________________________</p>
<p>Telephone/Fax _____________________________________________________________</p>
<p>Date _________________________________________________________________</p>
<p>and I make this declaration conscientiously believing it to be true and correct.</p>
<p>Declared by ______________________________</p>
<p>on [date] ___________________________________ in [place]________</p>
<p>Truthfully,</p>
<p>Signature</p>
<p>Addendum to Notice of Infringement:</p>
<p>List of Allegedly Infringing Listings, Products, or Materials</p>
<p>A Note on Reason Codes: When identifying item numbers please use the reasons below. When removing products from the site, Allmart will inform Sellers of the specific reason for the removal of their products.</p>
<p>Select the most appropriate reason. Please associate each item you report with only one reason code.</p>
<p>Trademark-infringement</p>
<ol>
<li>Trademark owner doesn't make this type of product or has discontinued the production of the product</li>
<li>Item(s) is an unlawful replica of a product made by the trademark owner or is counterfeit</li>
</ol>
<p>Trademark-listing description infringement</p>
<ol>
<li>Listing(s) has unlawful comparison to trademark owner's brand or product</li>
<li>Listing(s) contains unlawful use of trademark owner's logo</li>
</ol>
<p>Copyright-item infringement</p>
<ol>
<li>Software is being offered without any license or in violation of a license</li>
<li>Item(s) is a bootleg recording;</li>
<li>Item(s) is an unlawful copy (software, games, movies, etc.);</li>
<li>Item(s) is unlawful duplication of printed material</li>
<li>Item(s) is an unlawful copy of other copyrighted work (paintings, sculptures, etc.)</li>
</ol>
<p>Copyright-listing content infringement</p>
<ol>
<li>Listing(s) comprises unauthorized copy of copyrighted text</li>
<li>Listing(s) comprises unauthorized copy of copyrighted image</li>
<li>Listing(s) comprises unauthorized copy of copyrighted image and text</li>
</ol>
<p>Reason Code: _____________________________________________________________</p>
<p>Work(s)</p>
<p>infringed: _________________________________________________________</p>
<p>Item Number(s): ___________________________________________________________</p>
<p>Note:</p>
<ol>
<li>Please provide the ownership of Trademark (Trademark Registration Certificate should be in the name of applicant)</li>
<li>Please provide the evidence as to the ownership of copyright.</li>
</ol>
<p>All such Notices of Infringement shall be sent to info@allmart.com; or info@allmart.com.</p>
<p>Contacting the Seller</p>
<p>At Allmart we are committed towards ensuring that disputes between sellers and buyers are settled amicably by way of the above dispute resolution mechanisms and procedures. However, in the event that a buyer wishes to contact the seller, he/ she may proceed to do so by accessing the seller related information made available by the sellers on their product listing pages. Alternatively, the buyers may also reach out to customer support at 1800 208 9898 or access help center at [<a href="http://www.allmart.world/">http://www.allmart.world</a>].</p>
<p><strong>For Buyers from Maharashtra</strong></p>
<p><strong>Allmart Terms of Use</strong></p>

</div>
            </div>
        </div>
            
        </div>
        <br>
        <br><br>
        <br>
        
        </body>


<? include('footer.php');?>
</html>