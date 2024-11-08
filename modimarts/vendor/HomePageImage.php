<?php session_start(); 
include('config.php');

echo error_reporting(E_ALL);

if($_SESSION['adminuser']!=""){
	function getrt($slideridf) 
	{   
	    $rt="";
    	$getrt=mysqli_query($con1,"select * from slider_slot_rate where dt='".date("Y-m-d")."' and slider_id='".$slideridf."'  order by id desc ");
    	if($nty=mysqli_num_rows($getrt))
    	{      
    	 $frtfws=mysqli_fetch_array($getrt);   
    	 $rt=$frtfws["rate"];  //
    	}
    	return $rt;     
	}
 ?>
<!-- <!DOCTYPE html>-->
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
    <title>Merchant-HomePage</title>
    <link rel="stylesheet" href="">
    <meta name="description" content="My Store" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script type="text/javascript" src="../catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
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
    <link href="../datepc/dcalendar.picker.css" rel="stylesheet" type="text/css"> 
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
$(document).ready(function(){
    $('#vid').on('ended',function(){
      rtymvid();
    });
  });
function rtymvid()
{
    var myVid = document.getElementById('vid');
    $.ajax({
		type:'POST',    
		url:'../gettime.php',
		data:'stats=1',
		success: function(msg)
		{
          //alert(msg);
           	if(msg!=1)
            {	
                var arr=msg.split('#####');
                myVid.src = '../samplevideo.php?sid='+arr[1]+'&stats=movie1';
                /*
                 if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true ))
                {
                $('#myvideo').bind('canplay', function() {
                  this.currentTime = 5;
                });
                myVid.play();
                    } 
                else if(navigator.userAgent.indexOf("Safari") != -1)
                    {
                        $('#myvideo').bind('canplay', function() {
                  this.currentTime = 5;
                });
                myVid.play();
                    } 
                    else 
                    {
                alert("ok");
                   myVid.currentTime = 5;
                myVid.play();
                    }*/
                //alert(arr[0]);
                myVid.currentTime =arr[0];
                myVid.play();
            }else
            {
                myVid.src = '../samplevideo.php?sid=0&stats=';  
                myVid.play();    
            }
        }
    });
}
</script><script>
function validateQty(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
        return true;
    }
    else if ( key < 48 || key > 57 ) {
        return false;
    }
    else return true;
}
function updtfn(id,str,typ,num,bookingid)
{
    try
    {
        // alert(id);
        var elid=str+num;
        var newid=document.getElementById(elid).value;
        //alert(newid);
        $.ajax({
        type: 'POST',    
        url:'processupdatehomepagedetails.php',
        data:'updid='+id+'&newid='+newid+'&str='+str+'&typ='+typ+'&bookingid='+bookingid,
        success: function(msg){
        //alert(msg);
       if(msg==2)
       {
            alert("Error");
       } else if(msg==50)
       {
           alert("Your session has been expired");
           winddow.open("logout.php","_self");
       }
        window.location.reload();
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
} catch(exc)
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
}catch(exc)
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
    } catch(exc) {
        alert(exc);
    }
}
//============================================end product side slider edit delete function=================================================
function pay(tr_for,r,slider_d,slider_pos) {
    var t = tr_for;
    var rate = r;
    var sid = slider_d;
    var sp = slider_pos;
    var mid = document.getElementById('mid').value;
   window.location = 'http://sarmicrosystems.in/oc1/Merchant/payumoney/pay.php?t='+t+'&mid='+mid+'&rate='+rate+'&sid='+sid+'&spos='+sp;
}
function saleupdtfn(newpid,cat,pcode)
{
    // Ruchi : pay
    if(document.getElementById("ratesetslotidm").value!=""){
        var slotid=document.getElementById("ratesetslotidm").value;
    } else {
        var slotid=document.getElementById("slotid").value;
    }
        var slotpos=document.getElementById("slotpos").value;
        var rate = document.getElementById("slotrtn").value;
        var r = document.getElementById('finalaRate').value;
        //alert('rate : '+rate+' Total : '+r);
        pay('sl',r,slotid,slotpos);
    try
    {
        bkfuncmerchant1();
        var updid=document.getElementById("toupdtid").value;
        var str=document.getElementById("slidername").value;
        
        var bookingid=document.getElementById("bookingid").value;
        //var slotid=document.getElementById("ratesetslotidm").value;
        // var slotid=document.getElementById("slotid").value;
        //alert(bookingid);
        /* Ruchi 
        var slotpos=document.getElementById("slotpos").value;
        if(document.getElementById("ratesetslotidm").value!=""){
            var slotid=document.getElementById("ratesetslotidm").value;
        } else {
            var slotid=document.getElementById("slotid").value;
        }*/
    //alert("akki"+bookingid);
     $.ajax({
        type: 'POST',    
        url:'processupdatesaleslider.php',
        data:'updid='+updid+'&newpid='+newpid+'&str='+str+'&slotpos='+slotpos+'&slotid='+slotid+'&bookingid='+bookingid+'&cat='+cat+'&pcode='+pcode,
        success: function(msg){
            //alert(msg);
           if(msg==0)
           {
               alert("Error");
           } else
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
    } catch(exc) {
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
    } catch(exc) {
        alert(exc);  
    } 
}
//============================================end on sale slider edit delete function=================================================
</script>
</head>
<body class="common-home page-common-home layout-fullwidth" onload="rtymvid()">
    <?php include("getadvtbookingdetails.php");  ?>
    <!-- start content-outer -->
    <div id="content-outer">
    <!-- start content -->
    <!-- sys-notification -->
    <div id="sys-notification">
        <div class="container">
            <div id="notification"> </div>
        </div>
    </div>
    <!-- /sys-notification -->
    <div class="main-columns container-full">
  	    <div class="row">
		    <div id="sidebar-main" class="col-sm-12 col-xs-12">
			    <div id="content">
                    <div id="pav-homebuilder1554270593" class="homebuilder clearfix ">
		                <div class="pav-container" >
		                    <div class="pav-inner container">
				                <div class="row row-level-1 ">
				    	            <div class="row-inner clearfix" >
					        		    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 "><br>
					            	        <div class="col-inner space-30" >
					            	            <div class="tab-v5 ">
					            	                <div class="tab-heading"></div>
					            	            </div>
					            	            <div  style="max-width:900px;">
					            	                <div STYLE="margin-top:-85px; margin-bottom:-px;">
                                                        <video width="850" height="650" id="vid"  src="" type="video/mp4"  onclick="flsc()" muted></video>   
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
                                                                } else
                                                                {
                                                                 $("#vid").prop('muted', true);  
                                                                }
                                                            }, false);
                                                            myVid1.addEventListener("webkitfullscreenchange",function(){
                                                                console.log(document.webkitIsFullScreen);
                                                                // alert("ok");
                                                                var st=document.webkitIsFullScreen;
                                                                console.log(st);
                                                               if(st==true) {
                                                                   $("#vid").prop('muted', false);
                                                               } else {
                                                                 $("#vid").prop('muted', true);  
                                                               }
                                                            }, false);
                                                        </script>
                                                    </div>
                                                <!--<div align="center"><b>Want your ads to be shown here ?</b><a href="javascript:void(0);" onclick="window.opener.fn('');window.close();">Book Now</a></div>-->

			                                    <?php include('../slider.php');	?>
			                                    <!--##############################- ACTIVATE THE BANNER HERE -##############################-->
			                <script type="text/javascript">
        				        var tpj=jQuery;
        				        alert(tpj.fn.cssOriginal);
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
		                </div>
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
	                <!-- Ruchi : -->
        	        <div class="widget panel ">
        			    <div class="clearfix"></div>
                    </div>
	                <?php include('slider4.php')?>
        	        <div class="widget panel ">
        			    <div class="clearfix"></div>
                    </div>
	                <?php include('slider5.php')?>
        	        <div class="widget panel ">
        			    <div class="clearfix"></div>
                    </div>
        	        <?php include('slider6.php')?>
        	        <div class="widget panel ">
        			    <div class="clearfix"></div>
                    </div>
        	        <?php include('slider7.php')?>
        	        <!-- Ruchi -->
		        </div>
	        </div> 
	        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
	        <div class="col-inner sidebar hightlight space-30 hidden-sm" >
	            <a href="welcome.php"><button type="text" name="back" class="btn-info" style="margin: 16px 1px 2px 238px;">Back</button></a>
                <div class="widget panel panel-default">
        	        <div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title"> On sale &nbsp; &nbsp;</h4></div>
    	           <?php include('toprightsliderhomepage.php'); ?>
    	        </div>
                <div class="clearfix"></div>					                   								                						                							                     		<div class="widget panel ">
		        <div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">On sale</h4></div>
    	        <?php include('onsale.php'); ?> 
    	        <div class="clearfix"></div>
    	        <div class="widget panel ">
        		    <div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">Product</h4></div>
        		    <?php include('product_sidebar.php');?>
        	        <div class="clearfix"></div>
    	        </div>					                   								                						                							                     		<div class="widget panel ">
		        <div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">Bestseller</h4></div>
		        <?php include('bestseller.php');?>.
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
				    <div class="row-inner clearfix" > </div>
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
    });
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
.bookslotmod {
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
.modal-contentbk{
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
<!--------------------book slot  start------------------>
<div id="bookslotmod" class="bookslotmod">
  <!-- Modal content -->
  <div class="modal-contentbk" >
  <button type="button" id="clsbrt" class="close">X</button>
<div id="shdrt" align="center">
    From Date <input type="text" id="rdate"  name="rdate" >
    To Date <input type="text" id="tdate" name="tdate">
    <button type="text" id="sbtn" name="sbtn" onclick="bkfuncmerchantchk();">Check Availability</button></br>
    <script> 
       $('#slotrt').on('input', function () {
            this.value = this.value.match(/^\d+\.?\d{0,2}/);
        });
    </script>
    </br>
     <input type="hidden" id="ratesetslotidm" name="ratesetslotidm">
     <input type="hidden" id="slotpos" name="slotpos">
     <input type="hidden" id="slotrtn" name="slotrtn">
</div>
<div style="display:none" id="didpmdiv">
    <div id="rtsetmsg"> </div>
    <center>
        <button type="text" id="fsbtn" name="fsbtn" onclick="bkfuncmerchant();">Submit</button>
    </center>
</div>
</div>
</div>

<!--Ruchi-->

<div class="container">
<!-- Trigger the modal with a button -->
<!-- Modal -->
<div class="modal fade" id="is_slot_avail" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Slot Availibility</h4>
        </div>
        <div class="modal-body">
            <input type='hidden' name='bk_date' id='bk_date' value=''>
            <input type='hidden' name='bk_till_date' id='bk_till_date' value=''>
            <input type='hidden' name='sliderId' id='sliderId' value=''>
            <input type='hidden' name='slotPos' id='slotPos' value=''>
            <input type='hidden' name='srate' id='srate' value=''>
            
            <div id="slot_tilldate">
                
            </div>
            <div class="margin-prop">
                <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="slotbkfunc(document.getElementById('sliderId').value,document.getElementById('slotPos').value,document.getElementById('srate').value)">
                    <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Book In Advance</span>
                </button>
            </div>
            <div> 
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="
          btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
</div>
<script type="text/javascript">
function showModal(bk_date,till_date,sid,spos,srate){
    //alert('bk date : '+bk_date+' till Date :'+till_date+'sid:'+sid+'spos:'+spos+'rate:'+srate);
    var s ='';
    document.getElementById('bk_till_date').value=till_date;
    document.getElementById('bk_date').value=bk_date;
    document.getElementById('sliderId').value=sid;
    document.getElementById('slotPos').value=spos;
    document.getElementById('srate').value=srate;
    
    s ='<p>This slot is available after : <b>" '+ till_date+' "</p>';
    var div = document.getElementById('slot_tilldate');
    div.innerHTML = '';
    div.innerHTML += s;
    $('#is_slot_avail').modal('show');
}
/*$(document).ready(function() {
    $('#is_slot_avail').modal('show');
});*/
</script>

 <!-------------------- book slot end ------------------>
<script>
    var slotdtschkarr=[];
    function bkfuncmerchantchk()
    {
        try
        {
            var adv_bk_tdate = document.getElementById('bk_till_date').value;
            
            var fromdt=document.getElementById("rdate").value;
            var todt=document.getElementById("tdate").value;
            var sliderid=document.getElementById("ratesetslotidm").value;
            var slotpos=document.getElementById("slotpos").value;
            if(fromdt=="")
            {
                alert("From Date is mandatory");
                document.getElementById("rdate").focus();
            } /*else if(adv_bk_tdate!=''){
               if(adv_bk_tdate==fromdt) {
                   alert("From date is already booked ! choose after "+fromdt);
               }
            }*/
            else if(todt=="")
            {
                alert("To Date is mandatory");
                document.getElementById("tdate").focus();
            } else {
            $.ajax({
    				type:'POST',    
    				url:'check_sliderbooking.php',
    				data:'fromdt='+fromdt+'&todt='+todt+'&sliderid='+sliderid+'&slotpos='+slotpos,
    				success: function(msg)
        			{
                        //alert(msg);
            			 slotdtschkarr = JSON.parse(msg);
            		     var alldts=slotdtschkarr["alldts"].split(",");
            		     var avldts=slotdtschkarr["dtsv"].split(",");
            		     var notavail=slotdtschkarr["dtsnotavai"].split(",");
            		     var dtsrate=slotdtschkarr["dtsnrt"].split(",");
        		         var mf='<table border="1" align="center" width="40%">';
        		         mf=mf+"<tr>";
        		         mf=mf+"<th>Date</th>";   
        		         mf=mf+"<th>Rate</th>";
        		         mf=mf+"<th>Status</th>";
        		         mf=mf+"</tr>";
        		         var dtexs=0;
        		         for(var a=0;a<alldts.length;a++)
        		         {
            		         mf=mf+"</tr>";
            		         mf=mf+"<td align='center'>"+alldts[a]+"</td>";
            		         mf=mf+"<td align='right'>"+dtsrate[a]+"</td>";
            		         //alert(notavail.indexOf(alldts[a]));
            		         if(notavail.indexOf(alldts[a])!="-1")
            		         {
            		            mf=mf+"<td align='center'>Unavailable</td>";
            		         } else {
                	             dtexs=1;
                	             mf=mf+"<td align='center'>Available</td>";
            			     }
            			     mf=mf+"</tr>";
        			     }	
        				    mf=mf+"<tr>";
        			        mf=mf+"<tr>";
        			        mf=mf+"<td align='center'><b>Total</b></td>";
        			        mf=mf+"<td align='right'><b>"+slotdtschkarr["totmt"]+"</b></td>";
        			        mf=mf+"<td></td>";
        			        mf=mf+"</tr>";
        			        mf=mf+"</table>";
        			        /*Ruchi*/
        			        document.getElementById('finalaRate').value=slotdtschkarr["totmt"];
        			        /*Ruchi*/
        			        didpmdiv.style.display = "block";
        			        document.getElementById("rtsetmsg").innerHTML=mf
        			        document.getElementById("didpmdiv").style.display="block";
        			        if(dtexs==0)
        			        {
        			            document.getElementById("fsbtn").style.display="none";
        			        } else {
        			            document.getElementById("fsbtn").style.display="block";
        			        }
        				}
    				});
                }     
            } catch(ex) {
                alert(ex);
            }
        }
function bkfuncmerchant(){
    var fromdt=document.getElementById("rdate").value;
    var todt=document.getElementById("tdate").value;
    var sliderid=document.getElementById("ratesetslotidm").value;
    var slotpos=document.getElementById("slotpos").value;
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
    else
    {   
        bookslotmod.style.display = "none";
        uomfmod.style.display = "block";
      // window.location.assign("try_Popup.php") 
      // bkfuncmerchant1();
    }
}
 function bkfuncmerchant1()
 {
     try
     {
        var fromdt=document.getElementById("rdate").value;
        var todt=document.getElementById("tdate").value;
        var sliderid=document.getElementById("ratesetslotidm").value;
        var slotpos=document.getElementById("slotpos").value;
        /*
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
        else
        	
        {
        */		    
         var alldts=slotdtschkarr["alldts"].split(",");
	     var avldts=slotdtschkarr["dtsv"].split(",");
	     var notavail=slotdtschkarr["dtsnotavai"].split(",");
	     var dtsrate=slotdtschkarr["dtsnrt"].split(",");
	     
	     //alert(r);
	     /* pay('sl',r,sliderid,slotpos);*/
	    var dta={avldts:avldts,sliderid:sliderid,slotpos:slotpos,amt:slotdtschkarr["totmt"],rate:dtsrate,fromdt:fromdt,todt:todt};
	    var myJSON = JSON.stringify(dta); 
        $.ajax({
				type:'POST',    
				url:'slider_bookprocess.php',
				data:{myJSON:myJSON},
				success: function(msg)
					{
    			        //alert(msg);
    				    if(msg=="1")
					    {
					        alert("slot booked");
					        //   window.location.assign("try_Popup.php")
					 } else
					 {
					     alert("Error");
					 }
					 // window.location.reload(true);
					}
				});
    
            //}     
        }catch(ex)
        {
            alert(ex);
        }
    }
    var bookslotmod = document.getElementById("bookslotmod");
    var clsbrt = document.getElementById("clsbrt");
    clsbrt.onclick = function () {
      $('#rdate').val('');
      $('#tdate').val('');
     didpmdiv.style.display = "none";
     bookslotmod.style.display = "none";
}

 function slotbkfunc(slotidm,slotpos,rate)
 {
    //alert(slotidm+slotpos+rate);
    try{
     //============== condition check  product select or not ==================
       $.ajax({
		type:'POST',    
		url:'product_chk.php',
	//	data:'slotidm='+slotidm+'&slotpos='+slotpos+'&rate='+rate,
		success: function(msg)
		{
		    if(msg>0){
	        //======================================================================
            document.getElementById("ratesetslotidm").value=slotidm;
            document.getElementById("slotpos").value=slotpos;
            document.getElementById("slotrtn").value=rate;
            bookslotmod.style.display = "block";
		}else{
		    swal("Please add product");
		 }
	}
});
}catch(ex)
{
    alert(ex);
}
}
    var uomfmod = document.getElementById("myModal");
    var uomclosbtn = document.getElementById("clsb");
    uomclosbtn.onclick = function () {
    $('#rdate').val('');
    $('#tdate').val('');
    uomfmod.style.display = "none";
    didpmdiv.style.display = "none"
}
 function srchfsnchw(slotid,updtid,slidername,slotpos,bookingid)
 {
     document.getElementById("slotid").value=slotid;
     document.getElementById("slotpos").value=slotpos;
     document.getElementById("toupdtid").value=updtid;
     document.getElementById("txtvid").value=slidername+slotpos;
     document.getElementById("slidername").value=slidername;
     document.getElementById("bookingid").value=bookingid;
     shwsrch("1");
     uomfmod.style.display = "block";
 }
 function shwsrch(page)
{
    var formData=$("#frmsrch").serialize();
    document.getElementById("shd").innerHTML="Please Wait...";
    $.ajax({
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

</script>
<input type="hidden" name="slotid" id="slotid" >
<input type="hidden" name="slotpos" id="slotpos">
<input type="hidden" name="toupdtid" id="toupdtid">
<input type="hidden" name="txtvid"  id="txtvid">
<input type="hidden" name="slidername" id="slidername">
<input type="hidden" name="bookingid" id="bookingid">
<!--Ruchi-->
<input type="hidden" name=""finalaRate" id="finalaRate">
<input type="hidden" name=""mid" id="mid" value="<?php echo $_SESSION['id'] ; ?>">
<script src="datepc/dcalendar.picker.js"></script>
<script>
    $('#rdate').dcalendarpicker({format: 'dd-mm-yyyy'});
    $('#tdate').dcalendarpicker({format: 'dd-mm-yyyy'});
</script>
<!-- start footer -->         
<!--<div id="footer">
	<!--  start footer-left 
	<div id="footer-left">
	Admin Skin &copy; Copyright 1Click Guide. <a href="1clickguide.org">www.1clickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
<!--	<div class="clear">&nbsp;</div>
</div>-->
<?php //include('footer_new.php'); ?>
<!-- end footer -->
</body>
</html>
<?php }else{
		header("location: index.php");
}?>