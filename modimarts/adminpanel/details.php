<?php 
session_start();
include("config.php");
//$pid=300;
$pid=$_GET['prid'];
$qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `audio`, `video`, `price`, `others`, `discount`, `discount_type`, `total_amt` FROM `products` WHERE code='".$pid."'";


$qrylatfrws=mysqli_query($con1,$qrylatf);   
$latstprnrws=mysqli_fetch_array($qrylatfrws);


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
        <title>Details</title>
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
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                        
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/moment.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js"></script>
        
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
<script>
function addcart2(prodid)
{
try
{
    var qt=document.getElementById('input-quantity').value;
    
  // alert("this1");
$.ajax({
   type: 'POST',    
url:'addcart.php',
data:'pid='+prodid+'&qty='+qt,
success: function(msg){
//alert(msg);
updatecart();
 
//addincart();
//funcs('','');
if(msg==2)
{
     toastfunc("sorry your session has been expired");
    //alert("sorry your session has been expired");
}
else if(msg==1)
{
 toastfunc("Product added to cart successfully");
}
else
{
toastfunc("Error Please try again after some time");
}


  //document.getElementById('show').innerHTML=msg;
         }
     });

}catch(exc)
{
alert(exc);
}
    
}


</script>

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
                            <div class="top-verticalmenu hidden-xs hidden-sm">
	<div class="menu-heading d-heading">
	<h4>
	  <span class="fa fa-bars pull-left"></span>
	  categories              
	</h4>
	</div> 
	<div id="pav-verticalmenu"> 
	<div class="menu-content d-content">
	  	<div class="pav-verticalmenu fix-top">
		<div class="navbar navbar-verticalmenu">
			<div class="verticalmenu" role="navigation">
				<div class="navbar-header">
				<a href="javascript:;" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			    </a>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav verticalmenu"><li class="topdropdow parent dropdown " >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=24" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-mobile-phone"></i><span class="menu-title">Electronics</span><span class="menu-desc">Quisque ac neque et augue
bibendum</span><b class="caret"></b></a><div class="dropdown-menu"  style="width:300px" ><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-md-12 sidebar" > <div class="mega-col-inner"><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading">Products Latest</h4>
<div class="widget-content ">
	<div class="widget-inner list products-row">
				<div class="w-product product-col clearfix col-lg-4 col-md-4 col-sm-12 col-xs-12">
			
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="HP LP3065" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=47">
            <img class="img-responsive" src="" title="HP LP3065" alt="HP LP3065" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="comparefunc('<?php echo $pid;?>');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=47"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlistfunc('<?php echo $pid;?>');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/demo/hp_1.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="HP LP3065"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=47">HP LP3065</a></h6>
         
        <p class="description">
	Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel .....</p>
        
                <div class="price">
                      <span class="price-new">$100.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('47');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





   
		</div>
			</div>
</div>
</div></div></div></div></div></div></div></li><li class="bg1 parent dropdown " >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=46" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gift"></i><span class="menu-title">Accessories</span><span class="menu-desc">Quisque ac neque et augue
auctor aliquet</span><b class="caret"></b></a><div class="dropdown-menu"  style="width:500px" ><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-md-6 " > <div class="mega-col-inner"><div class="pavo-widget"></div><div class="pavo-widget"></div><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading title">Automative</h4>
<!--
<div class="">
	<ul class="content list-unstyled">
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_65">
                <span>Fashion</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_28">
                <span>Gym Wear</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_31">
                <span>Pant</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_29">
                <span>shirt</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_32">
                <span>Shoes</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_30">
                <span>Watch</span>
            </a>
        </li>
			</ul>
</div>--></div></div></div></div>				</div></div>
			</div>
		</div>
	</div>
	</div>
	</div>
</div>                        </div>
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
                        
<!--<div class="breadcrumbs space-30">
    <div class="container"> 
	    <div class="container-inner">
	        	        				 <ul class="list-unstyled breadcrumb-links">
								<li><a href="http://sarmicrosystems.in/oc/index.php?route=common/home"><i class="fa fa-home"></i></a></li>
								<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61">Fashion</a></li>
								<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69">Mens</a></li>
								<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_67">T-Shirt</a></li>
								<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;path=61_69_67&amp;product_id=54">T-Shirt</a></li>
								</ul>
					</div>
    </div>
</div>-->

<div class="main-columns container">
  <div class="row">
	  	<div id="sidebar-main" class="col-sm-12 col-xs-12">
		<div id="content">
			 
						
<div class="product-info">
    <div class="row">
    
        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 image-container">
                    <div class="image thumbnails">
                                                <a href="<?php echo $prodimgpth.$latstprnrws['photo'];?>" title="T-Shirt" class="imagezoom">
                    <img src="<?php echo $prodimgpth.$latstprnrws['photo'];?>" title="T-Shirt" alt="T-Shirt" id="image" style="height:400px;width:300px" data-zoom-image="<?php echo $prodimgpth.$latstprnrws['photo'];?>" class="product-image-zoom img-responsive"/>
                </a>
            </div>
                <div class="thumbs-preview horizontal thumbnails">
    		        </div>
    </div>
 
   
  <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
  <div class="product-info-bg">
    <h1 class="title-product"><?php echo $latstprnrws['name'];?></h1>

                    <div class="rating">
                        
<?php

for($i=5;$i>0;$i--)
{
    //echo "SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid." and rating_count='".$i."'";

$fstar5=mysql_query("SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid."' and rating_count='".$i."'"); 
						     $fstarftch5=mysql_fetch_array($fstar5);
						     
						     if($i==5){
						      $str5=$fstarftch5[0];
						     }
						     else if($i==4){
						      $str4=$fstarftch5[0];
						     }
						     else if($i==3){
						      $str3=$fstarftch5[0];
						     }
						     else if($i==2){
						      $str2=$fstarftch5[0];
						     }
						     else if($i==1){
						      $str1=$fstarftch5[0];
						     }
}					     
$avg=0;
 $ttl=0;                           $ttl=$ttl+($str5+$str4+$str3+$str2+$str1);
                                if($ttl>0){

						    $avg=$avg+((($str5*5)+($str4*4)+($str3*3)+($str2*2)+$str1)/$ttl); 
                                }else{
                                    
                                  $avg=0;  
                                }
                                //echo $avg;
                                $cn=0;
                                while($cn!=round($avg)){
                                
						    ?>
                                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                                                         
                                                                         <?php $cn++; }
                                                                         
                                                                         
                                                                         $cnt=5-round($avg); $cn1=0; while($cn1!=$cnt){?>
                                                                                         
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <?php $cn1++; } 
                                                                                                
     $fstar=mysql_query("SELECT count(product_id) FROM `product_review` where product_id='".$pid."'"); 
						     $fstarftch=mysql_fetch_array($fstar);

                                                                                                ?>
                                                                                                <!--
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>-->
                                                                <a href="#review-form" class="popup-with-form" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;" ><?php echo $fstarftch[0];?> reviews</a> / <a href="#review-form"  class="popup-with-form" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;" >Write a review</a>

            </div>
        
                    <div class="price detail space-20">
                <ul class="list-unstyled">
                                            <li>
                             <span class="price-new"><i class="fa fa-inr"></i> <?php echo $latstprnrws['total_amt'];?></span>
            <?php if($latstprnrws['discount']>0){?>
            <span class="price-old">$<?php echo $latstprnrws['price'];?></span> 
             <?php } ?>
                        </li>
                                    </ul>
            </div>
        
       <!-- <ul class="list-unstyled">
                    <li>Ex Tax: $12,333.00</li>
        
                </ul>

                    <b>Availability:</b> In Stock <span class="check-box text-success"><i class="fa fa-check"></i></span>-->
                
        <div class="border-success space-30">
            <ul class="list-unstyled">
                                <li><b>Product Code:</b> <?php echo $latstprnrws['code'];?></li>
                                            </ul>
        </div>

        
        
        <div id="product">
                        
            <div class="product-extra clearfix">
                <label class="control-label pull-left qty">Qty:</label>
                <div class="quantity-adder pull-left">
                    <span class="add-down add-action pull-left">
                        <i class="fa fa-minus"></i>
                    </span>
                    <div class="quantity-number pull-left">
                        <input type="text" name="quantity" value="1" size="1" id="input-quantity" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                    </div>                  
                    <span class="add-up add-action pull-left">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <div class="cart pull-left">
                    <?php if($latstprnrws['total_amt']>0){?>
                    <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary" onclick="addcart2('<?php echo $_GET['prid'];?>');">Add to Cart</button>
               <?php } ?>
                </div>
            </div>

            
 <?php if($latstprnrws['total_amt']>0){?>
            <div class="action pull-left">
                <div class="pull-left">
                     
                    <a data-toggle="tooltip" class="wishlist" title="Add to Wish List" onclick="wishlistfunc('<?php echo $pid;?>');"><i class="fa-fw fa fa-heart"></i>Add to Wish List</a>
                </div>
                <div class="pull-left">
                    <a data-toggle="tooltip" class="compare" title="Compare this Product" onclick="comparefunc('<?php echo $pid;?>');"><i class="fa-fw fa fa-refresh"></i>Compare this Product</a>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
        
         

        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style space-40"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script> 
        <!-- AddThis Button END --> 
        <div class="tags">
                    </div>
  </div>
    </div><!-- End div bg -->
</div>

<div class="box-product-infomation tab-v2 tabs-left">
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
                            <li><a href="#tab-review" data-toggle="tab">Reviews (<?php echo $fstarftch[0];?>)</a></li>
                    </ul>
    <div class="tab-content text-left">
        <div class="tab-pane active" id="tab-description">
              <p class="intro">
  <?php echo $latstprnrws['description']; ?></p></div>
            <div class="tab-pane" id="tab-review">

                <div id="review" class="space-20">
                    <?php 
                    $getreview=mysql_query("SELECT `review_id`, `user_id`, `product_id`, `rating_count`, `description`, `date_time` FROM `product_review` where product_id='".$pid."'"); 
						     while($getreviewarr=mysql_fetch_array($getreview)){
$getnam=mysql_query("SELECT Firstname FROM Registration where id='".$pid."'"); 
$getnamarr=mysql_fetch_array($getnam);
                    ?>
<table class="table table-v2">
<thead> 
  <tr>
    <th style="width: 50%;"><strong><?php echo $getnamarr['Firstname'];?></strong></th>
    <th class="text-right"><?php echo date('d-m-Y',strtotime($getreviewarr['date_time']));?></th>
  </tr>  
</thead>
<tbody>
  <tr>
    <td colspan="2"><p><?php echo $getreviewarr['description'];?></p>
    <?php
                   $c1=0;
                                while($c1!=$getreviewarr['rating_count']){
                                
						    ?>
                                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                                                         
                                                                         <?php $c1++; } $cnt2=5-$getreviewarr['rating_count']; $c3=0; while($c3!=$cnt2){?>
                                                                                         
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <?php $c3++; } 
                                                                  

                                                                                                ?>
                                           
            </td>
  </tr>
</tbody> 
</table>
<?php } ?>
                </div>
                <p> <a href="#review-form"  class="popup-with-form btn btn-sm btn-primary" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;" >Write a review</a></p>

               <div class="hide"> <div id="review-form" class="panel review-form-width"><div class="panel-body">
                <form class="form-horizontal" id="form-review">
                 <input type="hidden" name="pro_id" value="<?php echo $latstprnrws['code'];?>">
                    <h2>Write a review</h2>
                   <!-- <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label" for="input-name">Your Name</label>
                            <input type="text" name="name" value="" id="input-name" class="form-control" />
                        </div>
                    </div>-->
                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label" for="input-review">Your Review</label>
                            <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                            <!--<div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>-->
                        </div>
                    </div>
                    
                    <div class="form-group required">
                        <div class="col-sm-12">
                            <label class="control-label">Rating</label>
                            &nbsp;&nbsp;&nbsp; Bad&nbsp;
                            <input type="radio" name="rating" value="1" />
                            &nbsp;
                            <input type="radio" name="rating" value="2" />
                            &nbsp;
                            <input type="radio" name="rating" value="3" />
                            &nbsp;
                            <input type="radio" name="rating" value="4" />
                            &nbsp;
                            <input type="radio" name="rating" value="5" />
                            &nbsp;Good</div>
                    </div>
                                        <div class="buttons">
                        <div class="pull-right">
                            <button type="button" id="button-review" data-loading-text="Loading..." class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                </form></div></div>
                </div>

            </div>
                
    </div>
</div>
</div>
					</div>
	</div>
			</div>
</div>

<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#recurring-description').html('');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			if (json['success']) {
				$('#recurring-description').html(json['success']);
			}
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
/*$('#button-cart').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));
						
						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}
				
				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}
				
				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}
			
			if (json['success']) {
				$('#notification').html('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
		          
		
				$('#cart-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow');
				
				$('#cart > ul').load('index.php?route=common/cart/info ul li');
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});*/
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;
	
	$('#form-upload').remove();
	
	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');
	
	$('#form-upload input[name=\'file\']').trigger('click');
	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script> 
<script type="text/javascript"><!--
$('#review').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

//$('#review').load('index.php?route=product/product/review&product_id=54');

$('#button-review').on('click', function() {
    
    alert("ok");
	$.ajax({
		url: 'rating_insert_process.php',
		type: 'post',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			//$('#button-review').button('loading');
		},
		complete: function() {
		//	$('#button-review').button('reset');
		},
		success: function(msg) {
			//alert(msg);
			if(msg==1)
			{
			    window.open('details.php','_self');
			}
			else if(msg==3){
			
			    
			    alert("please login!!");
			}
			
		/*	$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review-form').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review-form').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);*/
			//}
		}
	});
});

$(document).ready(function() { 
	$('.product-info .image a').click(
		function(){  
			$.magnificPopup.open({
			  items: {
			    src:  $('img',this).attr('src')
			  },
			  type: 'image'
			});	
			return false;
		}
	);
});
//--></script> 
<script type="text/javascript" src=" catalog/view/javascript/jquery/elevatezoom/elevatezoom-min.js"></script>
<script type="text/javascript">
		var zoomCollection = '#image';
		$( zoomCollection ).elevateZoom({
				lensShape : "basic",
		lensSize    : 150,
		easing:true,
		gallery:'image-additional-carousel',
		cursor: 'pointer',
		galleryActiveClass: "active"
	});
 
</script>

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