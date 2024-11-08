<?php 
session_start();
include("config.php");
//$pid=300;
$pid=$_GET['pid'];
$cid=$_GET['cid'];

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
          <script src="js/vendor/jquery.js"></script>
  <!-- xzoom plugin here -->
  <script type="text/javascript" src="dist/xzoom.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/xzoom.css" media="all" /> 
  <!-- hammer plugin here -->
  <script type="text/javascript" src="hammer.js/1.0.5/jquery.hammer.min.js"></script> 
     <script src="js/setup.js"></script>
           
                  
    <!-- FONT -->

        <!-- FONT -->





<style>
    
.rating-wrapper {
  overflow: hidden;
  display: inline-block;
}

.rating-input {
  position: absolute;
  left: 0;
  top: -50px;
   display: none;
}

.rating-star:hover,
.rating-star:hover ~ .rating-star {
  background-position: 0 0;
}

.rating-wrapper:hover .rating-star:hover,
.rating-wrapper:hover .rating-star:hover ~ .rating-star,
.rating-input:checked ~ .rating-star {
  background-position: 0 0;
}

.rating-star,
.rating-wrapper:hover .rating-star {
  float: right;
  display: block;
  width: 18px;
  height: 18px;
  padding:5px;
  background: url('http://css-stars.com/wp-content/uploads/2013/12/stars.png') 0 -16px;
}





</style>


      </head>
  <body id="bd" class="common-home page-common-home layout-fullwidth" >
       
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




        <!-- /header -->
 
      <h1 align="center"> Review <h1>
 		
           
                    <?php 
                    
                   
                    $getreview=mysqli_query($con1,"SELECT `review_id`, `user_id`, `product_id`, `rating_count`, `description`, `date_time` FROM `product_review` where product_id='".$pid."' and category_id='".$cid."'  order by review_id desc "); 
						     while($getreviewarr=mysqli_fetch_array($getreview)){
						         
						       
						             
//$getnam=mysqli_query($con1,"SELECT Firstname FROM Registration where id='".$pid."'"); 
  $getnam=mysqli_query($con1,"SELECT Firstname FROM Registration where id='".$getreviewarr[1]."'"); 
  
   $getnamarr=mysqli_fetch_array($getnam);
                    ?>
<table class="table table-v2"  style="width:50%;" align="center">
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
                  $countt= $getreviewarr['rating_count'];
                                while($c1!=$getreviewarr['rating_count']){
                                
						    ?>
						    
						    
						                                     <? if($countt==1){ ?>      <span class="fa fa-stack"><i style="color:red;" class="fa fa-star fa-stack-1x"></i></span>
                                                             <? }else if($countt==2){?>  <span class="fa fa-stack"><i style="color:yellow;" class="fa fa-star fa-stack-1x"></i></span>                              
                                                             <? }else if($countt==3){?>  <span class="fa fa-stack"><i style="color:green;" class="fa fa-star fa-stack-1x"></i></span>                          
                                                             <? }else if($countt==4){?>  <span class="fa fa-stack"><i style="color:#9400D3;" class="fa fa-star fa-stack-1x"></i></span>
                                                             <? }else if($countt==5){?>  <span class="fa fa-stack"><i style="color:#00008B	;" class="fa fa-star fa-stack-1x"></i></span>
                                                             <? }else{ ?>            <span class="fa fa-stack"><i style="" class="fa fa-star fa-stack-1x"></i></span>             
                                                              <? }?>
                                                                        <!--  <span class="fa fa-stack"><i style="color:red;" class="fa fa-star fa-stack-1x"></i></span>-->
                                                                       
                                                                         <?php $c1++; } $cnt2=5-$getreviewarr['rating_count']; $c3=0; while($c3!=$cnt2){?>
                                                                                         
                                                                                                <span class="fa fa-stack" style="color:red;" ><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <?php $c3++; } 
                                                                  

                                                                                                ?>
                                           
            </td>
  </tr>
</tbody> 
</table>
<?php  }?>
               
                
             
</body>
</html>