<?php 
session_start();
include("config.php");
//echo $_SESSION['gid'];
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
        <title>Wish List</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
               	    	<link href="http://sarmicrosystems.in/oc1/image/catalog/cart.png" rel="icon" />
               	    	<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="requiredfunctions.js"></script>
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
                        
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
        
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

      </head>
      
      
    

<script type="text/javascript">
function srchfunc() {

//alert("testt");
   //document.getElementById("abc").submit();
   $('#searchform').attr('action','searchresult.php');
$('#searchform').submit();
//alert("testt1");
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
        <div class="">
            <div class="row">
            <?php include('menucopy.php')?>
            </div>
        </div>
    </div>
    <div id="header-bot" class="hidden-xs hidden-sm">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div id="pav-mainnav" class="hidden-xs hidden-sm">
                            
                                            
                                              <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
            <div class="container">
                <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
            </div>
        </div>
                                                </div>
                    </div>
                            <div class="col-lg-3 col-sm-3 col-md-3 hidden-xs hidden-sm">
                                 <?php 
                              //   include("mancategories.php");
                                 ?>                        
                            </div>
                        </div>
            </div>
        </div>
    </div>
</header>

        <!-- /header -->
      
        <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification"></div>
          </div>
        </div>
        <!-- /sys-notification -->
                        <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="myacc.php">Account</a></li>
        <li><a href="">My Wish List</a></li>
      </ul>
    <div class="row" style="height:350px">                <div id="content" class="col-sm-12" >      <h2>My Wish List</h2>
            <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead >
            <tr style="background-color: #11416b;color: white;">
              <td class="text-center">Image</td>
              <td class="text-left">Product Name</td>
              <td class="text-left">Model</td>
              <td class="text-right">Stock</td>
              <td class="text-right">Unit Price</td>
              <td class="text-center">Action</td>
            </tr>
          </thead>
          <tbody>
              <?php 
              
              $slctwish=mysqli_query($con1,"SELECT `wishlist_id`, `user_id`, `product_id`,`datetime`,categories_id FROM `wishlist` where user_id='".$_SESSION['gid']."'");
              //echo "SELECT `wishlist_id`, `user_id`, `product_id`, `datetime` FROM `wishlist` where user_id='".$_SESSION['gid']."'";
              while($slctwishftch=mysqli_fetch_array($slctwish)){
                  
                 // echo "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `audio`, `video`, `price`, `others`, `discount`, `discount_type`, `total_amt` FROM `products` WHERE code='".$slctwishftch['product_id']."' ";
             $getpro=mysqli_query($con1,"SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`,  `price`, `others`, `discount`, `discount_type`, `total_amt` FROM `Productviewtable` WHERE code='".$slctwishftch['product_id']."' and category='".$slctwishftch['categories_id']."' ");     
                  
                  
                  
                  $getprof=mysqli_fetch_array($getpro);
                  
                  
                  $proimg=mysqli_query($con1,"SELECT `img` FROM `Productviewimg` where product_id='".$slctwishftch['product_id']."' and category='".$slctwishftch['categories_id']."' ");
                  
                  //echo "SELECT `img` FROM `product_img` where product_id='".$slctwishftch['product_id']."'";
                  
                  $proimgs=mysqli_fetch_array($proimg);
              ?>
                        <tr style="background-color: white;">
              <td class="text-center" >               
              <a href=""><img src="<?php echo $proimgs['img'];?>" style="height:78px;wight:400px;"/></a>
                </td>
              <td class="text-left"><a href=""><?php echo $getprof['name'];?></a></td>
              <td class="text-left"><?php echo $getprof['code'];?></td>
              <td class="text-right">In Stock</td>
              <td class="text-right">                <div class="price">
                                    <?php echo $getprof['total_amt'];?>                                  </div>
                </td>
              <td class=""style="width: 155px;">
                  <!--<button type="button" onclick="addcart('<?php echo $slctwishftch['product_id']; ?>');" data-toggle="tooltip" title="Add to Cart" class="btn btn-primary"><i class="fa fa-shopping-cart"></i></button>
                <a href="javascript:void(0);" data-toggle="tooltip" title="Remove" class="btn btn-danger" onclick="removewishlist('<?php echo $slctwishftch['wishlist_id']; ?>');"><i class="fa fa-times"></i></a>
                -->
                	<img src="image/cartdemo2.gif" style="width: 47px;height: 39px;margin-top: 0px;" data-toggle="tooltip" title="Add to Cart" onclick="addcart('<?php echo $slctwishftch['product_id']; ?>');"/>
                                <div data-toggle="tooltip" title="Remove" class="btn btn-danger" onclick="removewishlist('<?php echo $slctwishftch['wishlist_id']; ?>');"  style="background-color: #ffffff;border-color: #ffffff;margin-left: 60px;padding-top: 3px;padding-bottom: 12px;" ><span class="glyphicon" style="top:3px;font-size: 12px;"> <div class="trash" title="Remove" style="right:-21px"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div></span> </a>
          	
          					
           
                
                
                </td>
           
           
           
           
           
            </tr>
            
            <?php } ?>
                  <!--      <tr>
              <td class="text-center">                <a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=56"><img src="" alt="new pant" title="new pant" /></a>
                </td>
              <td class="text-left"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=56">new pant</a></td>
              <td class="text-left">p123</td>
              <td class="text-right">In Stock</td>
              <td class="text-right">                <div class="price">
                                    £9,564.24                                  </div>
                </td>
              <td class="text-right"><button type="button" onclick="cart.add('56');" data-toggle="tooltip" title="Add to Cart" class="btn btn-primary"><i class="fa fa-shopping-cart"></i></button>
                <a href="http://sarmicrosystems.in/oc/index.php?route=account/wishlist&amp;remove=56" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
            </tr>-->
                      </tbody>
        </table>
      </div>
            <div class="buttons clearfix">
        <!--<div class="pull-right"><a href="http://sarmicrosystems.in/oc/index.php?route=account/account" class="btn btn-primary">Continue</a></div>-->
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
/*
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
 
*/
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