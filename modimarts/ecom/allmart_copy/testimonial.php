<?php session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

    include("config.php");
    include("getlocationforsearch.php");
    $stsss=0; //used in menu.php 0 means indexpage 
    
    $directory = 'image/testimonial/'; 
    $opendir = opendir($directory);

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
            .doc_img a p {
                text-align:center;
                font-size: 20px;
                margin: 1% auto;
            }
        </style>
        <br> <br> <br> <br>
        <div class="container-fluid">
            <div class="row">
                <?php 
                $rowCount = 0;
                while($file = readdir($opendir)) { echo $file.'<br>';
                    if($file!='..' || $file!='.'){
                ?>
                    <div class="col-md-3">
                        <img src= "<?php echo $directory.$file;?>" alt="<?php echo $directory.$file;?>" width="400px">
                    </div>
                <?php
                    $rowCount++;
                    if($rowCount % 4 == 0) echo '</div><div class="row">';
                }}
                ?>
            </div>
        </div>
        <br><br><br><br>
    </body>
    <?php include('footer.php');?>
</html>