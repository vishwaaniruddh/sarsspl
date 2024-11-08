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
        <p>Allmart operates the https://allmart.world websit , which provides the SERVICE.</p><br>
        <p>This page is used to inform website visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service, the Allmart website.</p><br>
        <p>If you choose to use our Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that we collect are used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</p><br>
        <h3>Information Collection and Use</h3>
        <p>For a better experience while using our Service, we may require you to provide us with certain personally identifiable information, including but not limited to your name, phone number, email address, postal address and bank/card/payment details. The information that we collect will be used to contact or identify you and communicate with you from time to time.</p><br>
        <h3>Log Data</h3>
        <p>We want to inform you that whenever you visit our Service, we collect information that your browser sends to us that is called Log Data. This Log Data may include information such as your computer’s Internet Protocol ("IP") address, browser version, pages of our Service that you visit, the time and date of your visit, the time spent on those pages, and other statistics.</p><br>
        <h3>Disclaimer for Using Data Across</h3>
        <p>I/We hereby agree and authorize Allmart and all of its divisions, affiliates, subsidiaries, related parties, trusts and anyone else they allow to access my/our basic data / contact details provided herewith, i.e. name, address, telephone number, mobile number,  e-mail address, birth date and / or anniversary date, my profile and other information. I/ We hereby consent to, agree and acknowledge that they may call/ email/ SMS me/us on any of the basic contact details shared by me/us, in order to keep me/us informed regarding product details, or send me/us any marketing and other product or service related communication and other offers/details/promotions. I/ We hereby consent to, agree and acknowledge that they may use my name, photo, audio, video related to me in any form including for marketing purposes and on social media. I/We provide the details herein at my/our sole discretion and confirm that Allmart shall not be held responsible or liable for any claim arising out of accessing or using my/our basic data / contact details shared by me/us. I/We consent to being assigned a unique identity within the Allmart, to be shared amongst all their trust/companies/firms they authorise and allow, for the purpose outlined in this paragraph. I/We also agree that if at any point of time, I/We wish to stop receiving such communications from them, I /We will call theirs designated call center number and register my/our preference.</p><br>
        <h3>Cookies</h3>
        <p>Cookies are files with small amount of data that is commonly used as an anonymous unique identifier. These are sent to your browser from the website that you visit and are stored on your computer’s hard drive.</p>
        <p>Our website uses these "cookies" to collect information and to improve our Service. You have the option to either accept or refuse these cookies, and know when a cookie is being sent to your computer. If you choose to refuse our cookies, you may not be able to use some portions of our Service.</p><br>
        <h3>Service Providers</h3>
        <p>We may employ third-party companies and individuals due to the following reasons:</p>
        <ul>
            <li>To facilitate our Service</li>
            <li>To provide the Service on our behalf</li>
            <li>To perform Service-related services or</li>
            <li>To assist us in analyzing how our Service is used</li>
            <li>For any other purpose</li>
        </ul>
        <p>We want to inform our Service users that these third parties have access to your Personal and Other Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</p><br>
        <h3>Security</h3>
        <p>We value your trust in providing us with your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the Internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p><br>
        <h3>Links to Other Sites</h3>
        <p>Our Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites. We have no control over, and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p><br>
        <h3>Children’s Privacy</h3>
        <p>Our Services do not address anyone under the age of 18. We do not knowingly collect personal identifiable information from children under 18 years. In the case we discover that a child under 18 years has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do the necessary actions.</p><br>
        <h3>Transfer of Personal Information Overseas</h3>
        <p>Please note also that, we may use overseas facilities to process or back up the information that we hold. As a result, we may transfer your personal and other information to our or our appointed overseas facilities for storage. However, we will only transfer information overseas as authorized by the applicable Privacy laws and in keeping with our other commitments to safeguard your privacy.</p><br>
        <h3>Changes to This Privacy Policy</h3>
        <p>We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately after they are posted on this page.</p><br>
        <h3>Contact Us</h3>
        <p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us from the contact section of this website.</p><br>
    </div>
</div>
            
        </div>
        <br>
        <br><br>
        <br>
        
        </body>


<? include('footer.php');?>
</html>