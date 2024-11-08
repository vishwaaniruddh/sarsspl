<?php 
session_start();
include("config.php");
//$pid=300;
$pid=$_GET['prid'];
$qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` FROM `products` WHERE code='".$pid."'";
//echo $qrylatf;

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
    	       
    	    <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
               	      <script type="text/javascript" src="requiredfunctions.js"></script>
              
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

function shfunc(imgr)
{

//alert(imgr);
$('#image').attr("src",imgr);

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
                                 include("mancategories.php");
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

<div class="breadcrumbs space-30">
    <div class="container"> 
	    <div class="container-inner">
	         <ul class="list-unstyled breadcrumb-links">
								<li><a href="index.php"><i class="fa fa-home"></i></a></li>
								<?php
							$sqlbrdcr = mysqli_query($con1,"select * from main_cat where id ='".$latstprnrws['category']."'");
								$fbrws=mysqli_fetch_array($sqlbrdcr);
								if($fbrws['under']=="0")
								{
								    //echo "ok";
								  ?>  
								  <li><a href="product.php?mdi=<?php echo $fbrws['id'];?>"><?php echo $fbrws['name'];?></a></li>  
								<?php
								    
								}else
								{
								   $exs=0;
								   $idbrdcrmbarr=array();
								   $iddbr=$fbrws['id'];
								   while($exs==0)
								   {
								      //echo "select * from main_cat where id ='".$iddbr."'";
								       	$sqlbrdcr2 = mysqli_query($con1,"select * from main_cat where id ='".$iddbr."'");
							         	$fbrws2=mysqli_fetch_array($sqlbrdcr2);
							         	//$idbrdcrmbarr[]=$iddbr;
							         	array_unshift($idbrdcrmbarr, $iddbr);
							         	if($fbrws2['under']=="0")
							         	{
							         	 $iddbr="0";
							         	    	$exs=1;
							         	    	break;
							         	}else
							         	{
							         	 $iddbr= $fbrws2['under'];  
							         	}
							         
								   }
								   
								    //print_r($idbrdcrmbarr);
								}
								
								
								for($c=0;$c<count($idbrdcrmbarr);$c++)
								{
								    	$sqlbrdcr23 = mysqli_query($con1,"select * from main_cat where id ='".$idbrdcrmbarr[$c]."'");
							         	$fbrws23=mysqli_fetch_array($sqlbrdcr23);
								?>
								<li><a href="product.php?mdi=<?php echo $fbrws23['id'];?>"><?php echo $fbrws23['name'];?></a></li>
								<?php
								    
								}
								in
								
								?>
								<li><a href="javascript:void(0);"><b><?php echo $latstprnrws['name'];?></b></a></li>
								<!--<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69">Mens</a></li>
								<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_67">T-Shirt</a></li>-->
								</ul>
		</div>
    </div>
</div>        


<div class="main-columns container">
  <div class="row">
	  	<div id="sidebar-main" class="col-sm-12 col-xs-12">
		<div id="content">
			 
						
<div class="product-info">
    <div class="row">
    <?php
    
    $sqlimg23mn=mysqli_query($con1,"SELECT img FROM `product_img` WHERE `product_id`='$pid' limit 0,1");

    $frtu=mysqli_fetch_array($sqlimg23mn);

    ?>
        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 image-container">
                    <div class="image thumbnails">
                                                <a href="<?php echo $prodimgpth.$frtu['img'];?>" title="<?php echo $latstprnrws['name'];?>" class="imagezoom">
                    <img src="<?php echo $prodimgpth.$frtu['img'];?>" title="<?php echo $latstprnrws['name'];?>" alt="<?php echo $latstprnrws['name'];?>" id="image" style="height:400px;width:100%;object-fit: contain" data-zoom-image="<?php echo $prodimgpth.$frtu['img'];?>" class="product-image-zoom img-responsive"/>
                </a>
               
            </div>
             
                <div class="thumbs-preview horizontal thumbnails">
                    <?php include('slidetop.php')?>
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

$fstar5=mysqli_query($con1,"SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid."' and rating_count='".$i."'"); 
						     $fstarftch5=mysqli_fetch_array($fstar5);
						     
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
                                                                                                
     $fstar=mysqli_query("SELECT count(product_id) FROM `product_review` where product_id='".$pid."'"); 
						     $fstarftch=mysqli_fetch_array($fstar);

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
                        <input type="text" name="quantity" value="1" size="1" id="input-quantity" class="form-control" onkeydown='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'/>
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
        
        <div class="addthis_toolbox addthis_default_style space-40">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> 
            <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> 
            <a class="addthis_counter addthis_pill_style"></a>
        </div>
        
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script> 
        <!-- AddThis Button END --> 
        <div class="tags"></div>
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
                    $getreview=mysqli_query($con1,"SELECT `review_id`, `user_id`, `product_id`, `rating_count`, `description`, `date_time` FROM `product_review` where product_id='".$pid."'"); 
						     while($getreviewarr=mysqli_fetch_array($getreview)){
$getnam=mysqli_query($con1,"SELECT Firstname FROM Registration where id='".$pid."'"); 
$getnamarr=mysqli_fetch_array($getnam);
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
    
    //alert("ok");
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

 	<!-- FlexSlider -->
						  
</div>

<div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</body></html>