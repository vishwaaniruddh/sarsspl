

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
        <title>ORDER TRACKING</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        
                    	    	<link href="image/catalog/cart.png" rel="icon" />
    	                <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
        
    <!-- FONT -->

        <!-- FONT -->


      </head>
      
      
      <script>
function trackorderfunc()
{

var orderid=document.getElementById('inputOrderTrackingID').value;

//alert("test");
$.ajax({
   type: 'POST',    
url:'trackorder_view.php',
data:'orderid='+orderid,

success: function(msg){

  document.getElementById('show').innerHTML=msg;
//alert(msg);
         }
     });

}


</script>



<style>
.txtbx {
    width: 100%;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 10px;
    font-size: 16px;
    background-color: #fff;
    background-image: url('search-button-clipart-1.jpg');
    background-position: 10px 10px;
    background-repeat: no-repeat;
    padding: 6px 6px 6px 6px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}
.button {
    background-color: #FF3300; /* red*/
    border: none;
    color: white;
    padding: 8px 8px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;
}
</style>


<script type="text/javascript">
function srchfunc() {

alert("testt");
   //document.getElementById("abc").submit();
   $('#searchform').attr('action','searchresult.php');
$('#searchform').submit();
alert("testt1");
}
</script>

<body class="common-home page-common-home layout-fullwidth">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
        
<header id="header-layout" class="header-v2">
    <div id="topbar" class="topbar-v1">
  <div class="container">
  <?php include('topbar.php')?>
</div>
</div>    <div id="header-main">
        <div class="container">
            <div class="row">
            <?php include('toplogo.php')?>
            </div>
        </div>
    </div>
    <div id="header-bot" class="hidden-xs hidden-sm">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div id="pav-mainnav" class="hidden-xs hidden-sm">
                            
                                              <?php include('menu.php')?>
                                              
                                                </div>
                    </div>
                                            <div class="col-lg-3 col-sm-3 col-md-3 hidden-xs hidden-sm">
                            <?php include("mancategories.php")?>                        </div>
                                     </div>
            </div>
        </div>
    </div>
</header>

        <!-- /header -->
        <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
            <div class="container">
                <button data-toggle="offcanvas " class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
            </div>
        </div>
        <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification"></div>
          </div>
        </div>
        <!-- /sys-notification -->
                        <div class="container">
  <ul class="breadcrumb">
        <li><a href="http://sarmicrosystems.in/oc/index.php?route=common/home"><i class="fa fa-home"></i></a></li>
        <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/account">Account</a></li>
        <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/login">Login</a></li>
      </ul>
      <div class="row">                <div id="content" class="col-sm-12">      <div class="row">
       
        <div class="col-sm-12">
          <div class="well">
            <Center><h2>Order Tracking</h2></center>
           
            <form action="http://sarmicrosystems.in/oc/index.php?route=account/login" method="post" enctype="multipart/form-data">
               
              <div class="form-group">
                 <label for="inputOrderTrackingID" class="col-sm-2 control-label">Order id</label>
                <input type="text" name="email" id="inputOrderTrackingID" value=""placeholder="# put your order id here"  class="form-control" />
              </div>
             
              <input type="submit" value="Get Status" class="btn btn-primary" />
                          </form>
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


<script type="text/javascript">
$('#myTab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})
$('#myTab a:first').tab('show'); 
 

var $MAINCONTAINER = $("html");

/**
 * BACKGROUND-IMAGE SELECTION
 */
$(".background-images").each( function(){
	var $parent = this;
	var $input  = $(".input-setting", $parent ); 
	$(".bi-wrapper > div",this).click( function(){
		 $input.val( $(this).data('val') ); 
		 $('.bi-wrapper > div', $parent).removeClass('active');
		 $(this).addClass('active');

		 if( $input.data('selector') ){  
			$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'url('+ $(this).data('image') +')' );
		 }
	} );
} ); 

$(".clear-bg").click( function(){
	var $parent = $(this).parent();
	var $input  = $(".input-setting", $parent ); 
	if( $input.val('') ) {
		if( $parent.hasClass("background-images") ) {
			$('.bi-wrapper > div',$parent).removeClass('active');	
			$($input.data('selector'),$("#main-preview iframe").contents()).css( $input.data('attrs'),'none' );
		}else {
			$input.attr( 'style','' )	
		}
		$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'inherit' );

	}	
	$input.val('');

	return false;
} );



 $('.accordion-group input.input-setting').each( function(){
 	 var input = this;
 	 $(input).attr('readonly','readonly');
 	 $(input).ColorPicker({
 	 	onChange:function (hsb, hex, rgb) {
 	 		$(input).css('backgroundColor', '#' + hex);
 	 		$(input).val( hex );
 	 		if( $(input).data('selector') ){  
				$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'),"#"+$(input).val() )
			}
 	 	}
 	 });
	} );
 $('.accordion-group select.input-setting').change( function(){
	var input = this; 
		if( $(input).data('selector') ){  
		var ex = $(input).data('attrs')=='font-size'?'px':"";
		$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'), $(input).val() + ex);
	}
 } );
 

</script>
</div>
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
    $("#offcanvasmenu").html($("#bs-megamenu").html());
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</body></html>