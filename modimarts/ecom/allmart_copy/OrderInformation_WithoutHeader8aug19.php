<?php
session_start();
include('config.php');
$oid1=$_GET['id'];
//echo "aknan".$oid1;
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
                                // include("mancategories.php");
                                 ?>                        
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
            <div id="notification"></div>
          </div>
        </div>
        <!-- /sys-notification -->
                        <div class="container">
  <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="myaccount.php">Account/</a></li>
        <li><a href="OrderHistoryWithoutHeader.php">Order History/</a></li>
        <li><a href="OrderInformation_WithoutHeader.php">Order Information/</a></li>
      </ul>
      <div class="row">                <div id="content" class="col-sm-9" style="left: -23px;width: 1018px;">      <h2>Order Information</h2>
      <table class="table table-bordered table-hover" style="background-color: white;">
        <?php
            $query = mysql_query("SELECT * FROM Orders WHERE user_id ='".$_SESSION['gid']."' ");
               //echo "SELECT * FROM Orders WHERE user_id ='".$_SESSION['gid']."' ";
                  $rows = mysql_fetch_array($query);
         $query1 = mysql_query("SELECT Firstname,Lastname,address FROM Registration WHERE id ='".$rows[1]."'  ");
      $rows1 = mysql_fetch_array($query1);
          $query2 = mysql_query("SELECT qty,item_id,oid FROM order_details WHERE oid ='".$oid1."'  ");
        //  echo "SELECT qty,item_id,oid FROM order_details WHERE oid ='".$oid1."'  ";
      $rows2 = mysql_fetch_array($query2);
            $query3 = mysql_query("SELECT address,state,city,pin FROM user_address WHERE user_id ='".$rows[1]."'  ");
      $rows3 = mysql_fetch_array($query3);
       $query4 = mysql_query("SELECT * FROM states WHERE state_code ='".$rows3[1]."'  ");
      $rows4 = mysql_fetch_array($query4);
      $query5 = mysql_query("SELECT * FROM cities WHERE code ='".$rows3[2]."'  ");
      $rows5 = mysql_fetch_array($query5);
     $dt=date('d-m-Y',strtotime($rows['date']));
    
            ?>
<?php 
if($rows['status']==0)
{
    $p="Pending";
}
else if($rows['status']==1)
{
    $p="Processing";
}
else if($rows['status']==2)
{
    $p="Dispatch";
}
else if($rows['status']==3)
{
    $p="compltete";
}
else if($rows['status']==4)
{
    $p="Reject";
}
else {
 
}
?>              
        <thead>
          <tr>
            <td class="text-left" colspan="2"><b style="color:#666666">Order Details</b></td>
          </tr>
        </thead>
        <tbody>
           
          <tr>
               
            <td class="text-left" style="width: 50%;">              <b>Order ID:</b> <?php echo $rows2[2];?><br />
              <b>Date Added:</b> <?php echo $dt;?></td>
            <td class="text-left" style="width: 50%;">              <b>Payment Method:</b> <?php echo $rows[7];?><br />
                                          <b>Shipping Method:</b>              </td>
          </tr>
        </tbody>
      </table>
      <table class="table table-bordered table-hover" style="background-color: white;">
        <thead>
          <tr>
            <td class="text-left" style="width: 50%; vertical-align: top;"><b style="color:#666666">Payment Address</b></td>
                        <td class="text-left" style="width: 50%; vertical-align: top;"><b style="color:#666666">Shipping Address</b></td>
                      </tr>
        </thead>
        <tbody>

          <tr>
            <td class="text-left"><?php echo $rows1[2];?><br /><?php echo $rows5[2];?><br /><?php echo $rows4[1];?><br /><?php echo $rows3[3];?></td>
                        <td class="text-left"><?php echo $rows1[0];?> <?php echo $rows1[1];?><br /><?php echo $rows3[0];?><br /><?php echo $rows5[2];?><br /><?php echo $rows4[1];?><br /><?php echo $rows3[3];?></td>
                      </tr>
        </tbody>
      </table>
      <div class="table-responsive">
        <table class="table table-bordered table-hover" style="background-color: white;">
          <thead>
            <tr>
              <td class="text-left"><b style="color:#666666">Product Name</b></td>
            <!--  <td class="text-left"><b style="color:#666666">Model</b></td>-->
              <td class="text-right"><b style="color:#666666">Quantity</b></td>
              <td class="text-right"><b style="color:#666666">Price</b></td>
              <td class="text-right"><b style="color:#666666">Total</b></td>
                           
                      </tr>
          </thead>
          <tbody> 
          <?php 
          
                   $query8 = mysql_query("SELECT qty,item_id,oid,rate,total_amt,cat_id FROM order_details WHERE oid ='".$oid1."'  ");
                 //echo "SELECT qty,item_id,oid FROM order_details WHERE oid ='".$oid1."'  ";
                   
          
                   while($rows6 = mysql_fetch_array($query8)){
                         
                   $query7 = mysql_query("SELECT * FROM Productviewtable WHERE code ='".$rows6[1]."' and category='".$rows6['cat_id']."' ");
                 //  echo "SELECT name FROM products WHERE code ='".$rows6[1]."' ";
                  $rows7=mysql_fetch_array($query7);
              
            ?>
                        <tr>
              <td class="text-left"><?php echo $rows7[1];?>               </td>
            <!--  <td class="text-left">p123</td>-->
              <td class="text-right"><?php echo $rows6[0];?></td>
              <td class="text-right"><?php echo $rows6[3];?></td>
              <td class="text-right"><?php echo $rows6[4];?></td>

            </tr>
                        
                           <?php }?>        </tbody>
          <tfoot>
                        <tr>
                            <?php
                            $query10=mysql_query("select sum(total_amt) as total ,round(sum(total_amt))  from order_details where oid='".$oid1 ."' ");
                        // echo "select sum(total_amt) as total ,round(sum(total_amt))  from order_details where oid='".$oid1 ."' ";
                          $rows10=mysql_fetch_array($query10);
                            ?>
              <td colspan="2"></td>
              <td class="text-right"><b>Sub-Total</b></td>
              <td class="text-right">Rs.<?php echo $rows10[0];?></td>
                            
                          </tr>
                      <!--  <tr>
              <td colspan="3"></td>
              <td class="text-right"><b>Flat Shipping Rate</b></td>
              <td class="text-right">00.00</td>
                            <td></td>
                          </tr>-->
                      
                        <tr>
                           
              <td colspan="2"></td>
              <td class="text-right"><b>Total</b></td>
              <td class="text-right">Rs.<?php echo $rows10[1]; ?></td>
                          
                         </tr>
                      </tfoot> 
        </table>
      </div>
                  <h3>Order History</h3>
      <table class="table table-bordered table-hover" style="background-color: white;">
        <thead>
          <tr>
            <td class="text-left">Date Added</td>
            <td class="text-left">Status</td>
            <td class="text-left">Comment</td>
          </tr>
        </thead>
        <tbody>
                              <tr>
            <td class="text-left"><?php echo $dt;?></td>
            <td class="text-left"><?php echo $p;?></td>
            <td class="text-left"></td>
          </tr>
                           </tbody>
      </table>
            <br />
      </div>
    <!--<div id="column-right" class="col-lg-3 col-md-3 col-sm-12 sidebar col-xs-12">
    <div class="list-group">
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/account" class="list-group-item">My Account</a>
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/edit" class="list-group-item">Edit Account</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/password" class="list-group-item">Password</a>
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/address" class="list-group-item">Address Book</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/wishlist" class="list-group-item">Wish List</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/order" class="list-group-item">Order History</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/download" class="list-group-item">Downloads</a>
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/recurring" class="list-group-item">Recurring payments</a>
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/reward" class="list-group-item">Reward Points</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/return" class="list-group-item">Returns</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/transaction" class="list-group-item">Transactions</a> 
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/newsletter" class="list-group-item">Newsletter</a>
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/logout" class="list-group-item">Logout</a>
  </div>
  </div>--->
</div>
</div>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->


<br />
 <br /><br />


  
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