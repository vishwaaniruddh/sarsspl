<?php
session_start();
include('config.php');
?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
 <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Merabazaar</title>
    <link rel="stylesheet" href="">
       
    <meta name="description" content="My Store" />
    <link href="http://sarmicrosystems.in/oc1/" rel="canonical" />
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
                <link href="catalog/view/theme/pav_bigstore/stylesheet/homebuilder.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
              
            <script type="text/javascript" src="catalog/view/javascript/layerslider/jquery.themepunch.plugins.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/layerslider/jquery.themepunch.revolution.min.js"></script>
    <!-- FONT -->

        <!-- FONT -->


      </head>
  <body class="common-home page-common-home layout-fullwidth">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
        
<header id="header-layout" class="header-v2">
    <div id="topbar" class="topbar-v1">
  <div class="container">
  <?php include('topbar.php')?>
</div>
</div>    

   <div id="header-bot" class="hidden-xs hidden-sm">
        <div class="container">
            <div class="container-inner">
                <div class="row" >
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
                        <?php // include("mancategories.php"); ?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </header>
        <!-- /header -->
         <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
            <div class="container">
                <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
            </div>
        </div>
        <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification">
            </div>
          </div>
        </div>
        <!-- /sys-notification -->
        <div class="container">
            <ul class="breadcrumb">
                <li><a href=""><i class="fa fa-home"></i></a></li>
                <li><a href="">Account</a></li>
                <li><a href="">Order History</a></li>
            </ul>
  <div class="row">           
  <div id="content" class="col-md-12" style="left: 5%;">  
  <h1>Order History</h1>
            <div class="table-responsive">
        <table class="table table-bordered table-hover" >
          <thead style="background-color: #15527f;color: white;">
            <tr>
              <td class="text-right">Order ID</td>
              <td class="text-left">Customer</td>
              <td class="text-right">No. of Products</td>
              <td class="text-left">Status</td>
              <td class="text-right">Total</td>
              <td class="text-left">Date Added</td>
              <td></td>
            </tr>
          </thead>
          <tbody style="background-color: white;"> 
         
<?php    
    $query = mysqli_query($con1,"SELECT * FROM Orders WHERE user_id ='".$_SESSION['gid']."' ");
    //echo "SELECT * FROM Orders WHERE user_id ='".$_SESSION['gid']."' ";
      while($rows = mysqli_fetch_array($query)){
      $query1 = mysqli_query($con1,"SELECT Firstname FROM Registration WHERE id ='".$rows[1]."'  ");
      $rows1 = mysqli_fetch_array($query1);
          $query2 = mysqli_query($con1,"SELECT qty FROM order_details WHERE oid ='".$rows[0]."'  ");
      $rows2 = mysqli_fetch_array($query2);
?>
                        <tr >
              <td class="text-center" ><?php echo $rows['id'];?></td>
              <td class="text-center" ><?php echo $rows1[0];?></td>
              <td class="text-center" ><?php echo $rows2[0];?></td>
              <td class="text-center" ><?php echo $rows['status'];?></td>
              <td class="text-center"><?php echo $rows['amount'];?></td>
              <td class="text-center"><?php echo $rows['date'];?></td>
            <!--  <td class="text-center"><a href="http://sarmicrosystems.in/oc1/index.php?route=account/order/info&amp;order_id=3" data-toggle="tooltip" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a></td>-->
            <td class="text-center"><a href="OrderInformation_WithoutHeader.php?id=<?php echo $rows[0];?>"><i class="fa fa-eye"></i></a></td>
           
            </tr><?php }?>
             
                      </tbody>
        </table>
        <div style="height:250px"></div>
      </div>
     
      </div>
   <!-- <div id="column-right" class="col-lg-3 col-md-3 col-sm-12 sidebar col-xs-12">
    <div class="list-group">
    <a href="http://sarmicrosystems.in/oc1/index.php?route=account/account" class="list-group-item">My Account</a>
    <a href="http://sarmicrosystems.in/oc1/index.php?route=account/edit" class="list-group-item">Edit Account</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/password" class="list-group-item">Password</a>
    <a href="http://sarmicrosystems.in/oc1/index.php?route=account/address" class="list-group-item">Address Book</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/wishlist" class="list-group-item">Wish List</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/order" class="list-group-item">Order History</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/download" class="list-group-item">Downloads</a><a href="http://sarmicrosystems.in/oc1/index.php?route=account/recurring" class="list-group-item">Recurring payments</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/reward" class="list-group-item">Reward Points</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/return" class="list-group-item">Returns</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/transaction" class="list-group-item">Transactions</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/newsletter" class="list-group-item">Newsletter</a>
    <a href="http://sarmicrosystems.in/oc1/index.php?route=account/logout" class="list-group-item">Logout</a>
  </div>
  </div>--->
</div>
</div>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->







  
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