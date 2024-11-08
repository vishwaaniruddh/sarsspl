<?php
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
{
	header("location: access-denied.php"); 
	exit();
}   
?>
<?php
include('config.php'); 
include('header.php');    
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
    <title>Merabazaar </title>
    <link rel="stylesheet" href="">
    <meta name="description" content="My Store" />

    <script type="text/javascript" src="../catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../requiredfunctions.js"></script>
	<link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/stylesheet.css" rel="stylesheet" />
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
#notification.showalrt {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
</style>
<script>
function validateQty(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
        return true;
    } 
    else if (key < 48 || key > 57 ) {
        return false;
    }
    else return true;
}
function updtfn(newpid)
{
    try
    {
     $.ajax({
       type: 'POST',    
        url:'processupdatehomepagedetails.php',
        data:'updid='+id+'&newpid='+newpid+'&str='+str+'&typ='+typ,
        success: function(msg){
        //alert(msg);
        if(msg==2)
        {
           alert("Error");
        }
        window.location.reload();
    },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
    });
    } catch(exc)
    {
        alert(exc);
    }
}
function delfun(id,typ,str)
{
try
{
   var confirmr=confirm("Are you sure you want to delete");
   if(confirmr)
   {
    $.ajax({
    type: 'POST',    
    url:'processupdeletehomepagedetails.php',
    data:'updid='+id+'&typ='+typ+'&str='+str,
    success: function(msg){
    //  alert(msg);
    if(msg==2)
       {
           alert("Error");
       }
    window.location.reload();
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
//============================================product side slider edit delete function=================================================
function productupdtfn(id,str,num)
{
    try
    {
        // alert(id);
        var elid=str+num;
        var newid=document.getElementById(elid).value;
        //alert(newid);
        $.ajax({
        type: 'POST',    
        url:'processupdateproducthp.php',
        data:'updid='+id+'&newid='+newid+'&str='+str,
        success: function(msg){
        //alert(msg);
           if(msg==2)
           {
               alert("Error");
           }
            window.location.reload();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
         });
    } catch(exc)
    {
        alert(exc);
    }
}

function productdelfun(id,str)
{
    try
    {
       var confirmr=confirm("Are you sure you want to delete");
       if(confirmr)
       {
        $.ajax({
        type: 'POST',    
        url:'processupdeleteproducthp.php',
        data:'updid='+id+'&str='+str,
        success: function(msg) {
            //alert(msg);
            if(msg==2)
            {
               alert("Error");
            }
            window.location.reload();
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
//============================================end product side slider edit delete function=================================================

//============================================on sale slider edit delete function=================================================
function saleupdtfn(newpid,cat)
{
try
{
 var updid=document.getElementById("toupdtid").value;
 var str=document.getElementById("slidername").value;
 var slotid=document.getElementById("slotid").value;
 var slotpos=document.getElementById("slotpos").value;
 $.ajax({
    type: 'POST',    
    url:'processupdatesaleslider.php',
    data:'updid='+updid+'&newpid='+newpid+'&str='+str+'&slotpos='+slotpos+'&slotid='+slotid+'&cat='+cat,
        success: function(msg){
        // alert(msg);
        if(msg==0)
        {
           alert("Error");
        }else
        {
            document.getElementById("toupdtid").value="";
            document.getElementById("slidername").value="";
            document.getElementById("slotid").value="";
            document.getElementById("slotpos").value="";
        }
        window.location.reload(true);
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
function saledelfun(id,str)
{
try
{
   var confirmr=confirm("Are you sure you want to delete");
   if(confirmr)
   {
    $.ajax({
        type: 'POST',    
        url:'processdelete_saleslider.php',
        data:'updid='+id+'&str='+str,
        success: function(msg){
          //  alert(msg);
        if(msg==2)
        {
           alert("Error");
        }
        window.location.reload();
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
//============================================end on sale slider edit delete function=================================================
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
<body class="common-home page-common-home layout-fullwidth" >
    <div class="clear">&nbsp;</div>
    <!--  start nav-outer-repeat START -->
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
                                    <video width="850" height="650" id="vid"  src="" type="video/mp4"  ></video>   
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
                			    <div>
                			        <div id="lat" >[<a href="javascript:void(0);" onclick="setrtfunc(5);">SET RATE</a>]
                			            <?php echo"Todays slider Rate: ".getrt("5"); ?>
                                    </div>
                                <div id="feat" style="display:none">[<a href="javascript:void(0);" onclick="setrtfunc(6);">SET RATE</a>]
                                    <?php echo"Todays slider Rate: ".getrt("6"); ?>
                                </div>
                                <div id="spec" style="display:none">[<a href="javascript:void(0);" onclick="setrtfunc(7);">SET RATE</a>]
                                    <?php echo"Todays slider Rate: ".getrt("7"); ?>
                                </div>
                            </div></br></br>					                						                							        
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
                        			<div class="owl-carousel" data-show="1" data-pagination="false" data-navigation="true">	</div> 
                        		</div>
                        	</div>
                        </div>
                        <?php include('bottomslider.php')?>              								              
                        <div class="widget panel ">
                        	<div class="clearfix"></div>
                        </div>
                    	<?php include('top_rating.php')?>
                    	<?php include('Trending_Offers.php')?>
                    	<?php include('Minimum_Off.php')?>
                    	<?php include('Max_Off.php')?>
                    	<?php include('slider7.php')?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                    <div class="col-inner sidebar hightlight space-30 hidden-sm" >
                        <div class="widget panel panel-default">  
    	                    <?php 
    	                    function getrt($slideridf)
                        	{
                        	    $rt=0;
                            	$getrt=mysql_query("select * from slider_slot_rate where dt='".date("Y-m-d")."' and slider_id='".$slideridf."'  order by id desc ");
                            	if($nty=mysql_num_rows($getrt))
                            	{
                            	 $frtfws=mysql_fetch_array($getrt); 
                            	 $rt=$frtfws["rate"];
                            	}
                        	    return $rt;
                        	}
    	                    ?>
                            <div class="widget-heading panel-heading block-borderbox">
                                <h4 class="panel-title">  &nbsp; &nbsp;</h4>
                                On sale &nbsp;&nbsp;[<a href="javascript:void(0);" onclick="setrtfunc(1);">SET RATE111111111</a>]</br></br>
    	                        <?php echo"Todays slider Rate: ".getrt("1"); ?>
                            </div>
	                        <?php include('toprightsliderhomepage.php'); ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="widget panel ">
                            <div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">  &nbsp; &nbsp;</h4>On sale &nbsp;&nbsp;[<a href="javascript:void(0);" onclick="setrtfunc(2);">SET RATE</a>]</br></br>

    	                    <?php echo"Todays slider Rate: ".getrt("2"); ?>
                        </div>
	                    <?php include('onsale.php');?>
	                    <div class="clearfix"></div>
	                    <div class="widget panel ">
	                        <div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">  &nbsp; &nbsp;</h4>Products &nbsp;&nbsp;[<a href="javascript:void(0);" onclick="setrtfunc(3);">SET RATE</a>]</br></br>
    	                        <?php echo"Todays slider Rate: ".getrt("3"); ?>
                            </div>	
		                    <?php include('product_sidebar.php');?>
	                        <div class="clearfix"></div>
	                   </div>
	                   <div class="widget panel ">
    		                <div class="widget-heading panel-heading block-borderbox">
    		                    <h4 class="panel-title">  &nbsp; &nbsp;</h4>Bestseller &nbsp;&nbsp;[<a href="javascript:void(0);" onclick="setrtfunc(4);">SET RATE</a>]</br></br>
    	                        <?php echo"Todays slider Rate: ".getrt("4"); ?>
    	                   </div>
		                    <?php include('bestseller.php');?>
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
	    	<div class="row-inner clearfix" ></div>
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
<footer id="footer" class="nostylingboxs"></footer>
<div id="powered"></div>
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
</script>
<div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
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
<!--<div class="clear">&nbsp;</div>
</div>-->
<!-- end footer -->
<style>
.uommod {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* Modal Content */
.modal-contentuom{
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 90%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
.setratemodal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9999; /* Sit on top */
    padding-top: 200px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-contentsetrate{
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 60%;
}
</style>
<!--------------------search page modal div------------------>
<div id="myModal" class="uommod">
  <!-- Modal content -->
  <div class="modal-contentuom" >
  <button type="button" id="clsb" class="close">X</button>
<div id="shd">
<?php include "product_seach_view.php"; ?>  
</div>
</div>
</div>
    
<!--------------------search page modal div end------------------>


    <!--------------------set rate for slots------------------>


<div id="setratemodal" class="setratemodal">
  <!-- Modal content -->
  <div class="modal-contentsetrate" >
  <button type="button" id="clsbrt" class="close">X</button>
<div id="shdrt">
    
    From Date <input type="text" id="rdate" name="rdate">
    To Date <input type="text" id="tdate" name="tdate">
   
    Rate <input type="text" id="slotrt" name="slotrt">
   </br>
   <script> 
   $('#slotrt').on('input', function () {
        this.value = this.value.match(/^\d+\.?\d{0,2}/);
    });

    
    </script>
    </br>
    <center>
 <button type="text" id="sbtn" name="sbtn" onclick="setratefuncschk();">Submit</button>
    </center>
    
     <input type="hidden" id="ratesetslotid" name="ratesetslotid">
 

 
</div>
<div id="rtsetmsg">
    </div>

 </div>
    </div>

 <!--------------------set rate for slots end------------------>

 <script>
var setratemodal = document.getElementById("setratemodal");

var clsbrt = document.getElementById("clsbrt");

clsbrt.onclick = function () {
    setratemodal.style.display = "none";
}


var uomfmod = document.getElementById("myModal");

var uomclosbtn = document.getElementById("clsb");

uomclosbtn.onclick = function () {
    uomfmod.style.display = "none";
}

 function setrtfunc(slotid)
 {
    setratemodal.style.display = "block";
    document.getElementById("ratesetslotid").value=slotid;
 }

 
 function srchfsnchw(slotid,updtid,slidername,slotpos)
 {
     
     document.getElementById("slotid").value=slotid;
     document.getElementById("slotpos").value=slotpos;
     document.getElementById("toupdtid").value=updtid;
     document.getElementById("txtvid").value=slidername+slotpos;
      document.getElementById("slidername").value=slidername;
     
     
     shwsrch("1");
uomfmod.style.display = "block";
     
 }
 
 
 function shwsrch(page)
{

    var formData=$("#frmsrch").serialize();
    document.getElementById("shd").innerHTML="Please Wait...";
    
    $.ajax(
    {
    	type:'POST',    
    	url:'product_seach_view.php',
    	data:formData+'&page='+page,
    	success: function(msg)
    	{
    	    // alert(msg);
    	    document.getElementById("shd").style.display="none";
            document.getElementById("shd").innerHTML=msg;
            document.getElementById("shd").style.display="block";
    	    //alert(msg);
    	}
    });
}
 
function setratefuncschk()
{
    try
    {
        
        var fromdt=document.getElementById("rdate").value;
        
        var todt=document.getElementById("tdate").value;
        var sliderid=document.getElementById("ratesetslotid").value;
        var rate=document.getElementById("slotrt").value;
        //alert("an"+rate);
        
        if(fromdt=="")
        {
            alert("From Date is mandatory");
            document.getElementById("rdate").focus();
        }
        else if(todt=="")
        {
            alert("To  Date is mandatory");
            document.getElementById("tdate").focus();
        }
        else if(rate=="")
        {
            alert("Rate is mandatory");
            document.getElementById("rate").focus();
        } else {
            $.ajax({
    			type:'POST',    
    			url:'check_sliderrateset.php',
    			data:'fromdt='+fromdt+'&todt='+todt+'&sliderid='+sliderid,
    			success: function(msg)
    			{
    			    // alert(msg);
    			 
    			    var drr = JSON.parse(msg);
    			    // alert(drr["dtsv"]);
    		        /*	 if(drr["dtsnotavai"]!="")
    			    {
    			        var spl=drr["dtsnotavai"].split(",");
    			 
            			 if(dtsnotavai.length>0)
            			 {
            			     
            			 }
    			    } else {
        			    setratefunc(drr["dtsv"]);
        			} */
    			 setratefunc(drr["dtsv"]);
    			}
			});
        }     
    }catch(ex)
    {
         alert(ex);
    }
 }
 
 function setratefunc(dtsv)
 {
     try
     {
         
        
var fromdt=document.getElementById("rdate").value;

var todt=document.getElementById("tdate").value;
var sliderid=document.getElementById("ratesetslotid").value;
var rate=document.getElementById("slotrt").value;

var dtsavil=dtsv;

$.ajax(
				{
					type:'POST',    
					url:'sliderrateset.php',
					data:'rate='+rate+'&sliderid='+sliderid+'&dtsavil='+dtsavil,
					success: function(msg)
					{
					// alert(msg);
				if(msg==1)
				{
				 alert("Successfull");   
				 
				 window.location.reload(true);
				}else
				{
				    
				    alert("Error");
				}
					 
					}
					
				});
         
     }catch(ex)
     {
         alert(ex);
     }
 }
 
 </script>
 <input type="hidden" name="slotid" id="slotid">
 
 <input type="hidden"name="slotpos" id="slotpos">
 
 <input type="hidden"name="toupdtid" id="toupdtid">
 
 <input type="hidden"name="txtvid" id="txtvid">
 
 <input type="hidden"name="slidername" id="slidername">
 
<script src="datepc/dcalendar.picker.js"></script>
<script>
$('#rdate').dcalendarpicker({format: 'dd-mm-yyyy'});
$('#tdate').dcalendarpicker({format: 'dd-mm-yyyy'});


function shdv(sl)
{
   // alert(sl);
    document.getElementById("lat").style.display="none";
    document.getElementById("feat").style.display="none";

    document.getElementById("spec").style.display="none";
    document.getElementById(sl).style.display="block";
    
}

</script>

</body>
</html>