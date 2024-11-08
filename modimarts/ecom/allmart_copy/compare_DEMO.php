<?php
session_start();
include('config.php');
?>
<!DOCTYPE html>
<html>
    <html dir="ltr" class="ltr" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Product Comparison</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
       <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="requiredfunctions.js"></script>

                    	    	<link href="http://sarmicrosystems.in/oc/image/catalog/cart.png" rel="icon" />
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

      
        
<style>
    * {
    margin: 0;
    padding: 0;
}
body {
    background-color: #F2EEE9;
   
    color: #333;
}
.wrapper {
    
}

.clear {
    clear: both;
}
.items {
    
}
.item {
   
}
.item img {
    display: block;
   
}


span {
    
}
.shopping-cart {
    display: inline-block;
    background: url('http://cdn1.iconfinder.com/data/icons/jigsoar-icons/24/_cart.png') no-repeat 0 0;
    width: 24px;
    height: 24px;
    inline-size: 215px;
}
</style>
        
    </head>
    <body class="product-compare page-product-compare layout-fullwidth">

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
            <div class="row" >
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
                               //  include("mancategories.php");
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

 

                 <div class="breadcrumbs space-30">
    <div class="container"> 
	    <div class="container-inner">
	        	        				 <ul class="list-unstyled breadcrumb-links">
								<li><a href="http://sarmicrosystems.in/oc1/index.php?route=common/home"><i class="fa fa-home"></i></a></li>
								<li><a href="http://sarmicrosystems.in/oc1/index.php?route=product/compare">Product Comparison</a></li>
								</ul>
					</div>
    </div>
</div><div class="main-columns container">
    
      <div class="row" >
				   <div id="sidebar-main" class="col-sm-12 col-xs-12"><div id="content">
    <div class="content-inner bg-white">
          <h1 class="page-title" style="margin-bottom: 0px;">Product Comparison</h1>
          <?php
          $detsarr=array();
          
          $qrylatf="select * from `compare_products` where user_id='".$_SESSION['gid']."'";
$qrylatfrws=mysqli_query($con1,$qrylatf);   
$latstprnrws=mysqli_num_rows($qrylatfrws);
while($lat1=mysqli_fetch_array($qrylatfrws))
    {
    //echo "select * from products where code='".$lat1['product_id']."'";
    $getprdets=mysqli_query($con1,"select * from Productviewtable where code='".$lat1['product_id']."' and category='".$lat1['category']."' ");

      $prdrws=mysqli_fetch_array($getprdets);
      
      $qryimg=mysql_query("SELECT `img` FROM `Productviewimg` where product_id='".$lat1['product_id']."' and category='".$lat1['category']."' ");
      $proimg=mysql_fetch_array($qryimg);
    
$detsarr[]=['compareid'=>$lat1['id'],'code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$proimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'brand'=>$prdrws['brand'],'Long_desc'=>$prdrws['Long_desc']];
    }
          
          ?>
            <div class="table-responsive space-30">
      <table class="table table-bordered">
        <thead>
          <tr>
            <td colspan="5" style="background-color: #1c4b6f;color: white;text-align: center;"><strong>Products</strong></td>
          </tr>
        </thead>
        <tbody>
        
          <tr>
              <td style="color: #1c4b6f;font-weight: bold;">Image</td>
                        <td class="text-center">              
                        <!--<img style="width:250px;height:250px;" src="<?php echo trim($prodimgpth.$detsarr[0]['photo'],$proimg['img']);?>" alt="" title="<?php echo $detsarr[0]['name']?>" class="img-thumbnail" />-->
                       
             
        <div class="item">
         <img style="width:250px;height:250px;" src="<?php echo trim($prodimgpth.$detsarr[0]['photo']);?>" alt="item" title="<?php echo $detsarr[0]['name']?>" class="img-thumbnail" />
        <br />
         
           <?php		    if($detsarr[1]['code']!="") {?>
                   <div class="trash" title="Remove" onclick="removecompare('<?php echo $detsarr[0]['compareid'];?>')"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
                   <div class="add-to-cart" title="add-to-cart" onclick="addcart('<?php echo $detsarr[0]['code'];?>','<?php echo $detsarr[0]['category'];?>');" > <span><i class="shopping-cart"></i></span><div>
                                    
                                  <?php } ?>
         
         
        </div>
             
             
             
             
             
              </td>
              <td class="text-center" >  
              <div class="item">
                        <img style="width:250px;height:250px;"  src="<?php echo trim($prodimgpth.$detsarr[1]['photo']);?>" alt="item" title="<?php echo $detsarr[1]['name']?>" class="img-thumbnail" />
             <br />
              <?php		    if($detsarr[1]['code']!="") {?>
                                     <div class="trash" title="Remove" onclick="removecompare('<?php echo $detsarr[1]['compareid'];?>')"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
                                     <div class="add-to-cart" title="add-to-cart" onclick="addcart('<?php echo $detsarr[1]['code'];?>','<?php echo $detsarr[1]['category'];?>');" > <span><i class="shopping-cart"></i></span><div>
                                     <!--  <input type="button" id="add-to-cart" style="text-transform:none;border-radius:18px;outline: none;margin-right: 64px;" value="Add to Cart" class="button btn btn-primary" onclick="addcart('<?php echo $detsarr[1]['code'];?>','<?php echo $detsarr[1]['category'];?>');"  />-->
          						    <?php } ?>
          						     </div>
             
              </td>
              <td class="text-center">   
              <div class="item">
                        <img style="width:250px;height:250px;"  src="<?php echo trim($prodimgpth.$detsarr[2]['photo']);?>" alt="item" title="<?php echo $detsarr[2]['name']?>" class="img-thumbnail" />
              <br />
              <?php if($detsarr[2]['code']!="")  {?>
                                        <div class="trash" title="Remove" onclick="removecompare('<?php echo $detsarr[2]['compareid'];?>')"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
                                	    <div class="add-to-cart" title="add-to-cart" onclick="addcart('<?php echo $detsarr[2]['code'];?>','<?php echo $detsarr[2]['category'];?>');" > <span><i class="shopping-cart"></i></span><div>
                   
                                	   <!-- <input type="button" id="add-to-cart" style="text-transform:none;border-radius:18px;outline: none;margin-right: 64px;" value="Add to Cart" class="button btn btn-primary" onclick="addcart('<?php echo $detsarr[2]['code'];?>','<?php echo $detsarr[2]['category'];?>');"  />-->
                      				<?php } ?>
              </div>
              
              </td>
              <td class="text-center">  
              <div class="item">
                        <img style="width:250px;height:250px;"  src="<?php echo trim($prodimgpth.$detsarr[3]['photo']);?>" alt="item" title="<?php echo $detsarr[3]['name']?>" class="img-thumbnail" />
             <br />
              <?php if($detsarr[3]['code']!="") {?>
                                      <div class="trash" title="Remove" onclick="removecompare('<?php echo $detsarr[3]['compareid'];?>')"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
             						  <div class="add-to-cart" title="add-to-cart" onclick="addcart('<?php echo $detsarr[3]['code'];?>','<?php echo $detsarr[3]['category'];?>');" > <span><i class="shopping-cart"></i></span><div>
                   
             					<!--	  <input type="button"  id="add-to-cart" style="text-transform:none;border-radius:18px;outline: none;margin-right: 64px;" value="Add to Cart" class="button btn btn-primary" onclick="addcart('<?php echo $detsarr[3]['code'];?>','<?php echo $detsarr[3]['category'];?>');"  />-->
          						    <?php } ?>
             </div>
             
              </td>
                      </tr>
                      
                    <tr>
                        <td style="color: #1c4b6f;font-weight: bold;">Product</td>
                        <td><a href="details.php?prid=<?php echo $detsarr[0]['code']?>"><strong><?php echo $detsarr[0]['name']?></strong></a></td>
                        <td><a href="details.php?prid=<?php echo $detsarr[1]['code']?>"><strong><?php echo $detsarr[1]['name']?></strong></a></td>
                        <td><a href="details.php?prid=<?php echo $detsarr[2]['code']?>"><strong><?php echo $detsarr[2]['name']?></strong></a></td>
                        <td><a href="details.php?prid=<?php echo $detsarr[3]['code']?>"><strong><?php echo $detsarr[3]['name']?></strong></a></td>
                    </tr>
                     
          <tr>
            <td style="color: #1c4b6f;font-weight: bold;">Brand</td>
                        <td><?php echo $detsarr[0]['brand']?></td>
                        <td><?php echo $detsarr[1]['brand']?></td>
                        <td><?php echo $detsarr[2]['brand']?></td>
                        <td><?php echo $detsarr[3]['brand']?></td>
                      </tr> 
          <tr>
            <td style="color: #1c4b6f;font-weight: bold;">Price</td>
                        <td><i class="fa fa-inr"></i> <?php echo $detsarr[0]['total_amt']?></td>
                        <td><i class="fa fa-inr"></i> <?php echo $detsarr[1]['total_amt']?></td>
                        <td><i class="fa fa-inr"></i> <?php echo $detsarr[2]['total_amt']?></td>
                        <td><i class="fa fa-inr"></i> <?php echo $detsarr[3]['total_amt']?></td>
                        
                      </tr>
      
        
                    <tr>
            <td style="color: #1c4b6f;font-weight: bold;">Rating</td>
            
                        <td class="rating">           
                        <?php 
                        
                        if($detsarr[0]['code']!="")
                        {
                        
                        for($i=5;$i>0;$i--)
{
    //echo "SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid." and rating_count='".$i."'";

$fstar5=mysql_query("SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$detsarr[0]['code']."' and rating_count='".$i."'"); 
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
                                                                         
                                                                         <?php $cn++; } $cnt=5-round($avg); $cn1=0; while($cn1!=$cnt){?>
                                                                                         
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <?php $cn1++; } 
                                                                                                
     $fstar=mysql_query("SELECT count(product_id) FROM `product_review` where product_id='".$detsarr[0]['code']."'"); 
						     $fstarftch=mysql_fetch_array($fstar);

                                                                                                ?>
                
                                          <br />
              Based on <?php echo $fstarftch[0];?> reviews.
              <?php } ?>
              </td>
              <td class="rating">           
                        <?php 
                        if($detsarr[1]['code']!="")
                        {
                        
                        for($i=5;$i>0;$i--)
{
    //echo "SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid." and rating_count='".$i."'";

$fstar5=mysql_query("SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$detsarr[1]['code']."' and rating_count='".$i."'"); 
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
                                                                         
                                                                         <?php $cn++; } $cnt=5-round($avg); $cn1=0; while($cn1!=$cnt){?>
                                                                                         
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <?php $cn1++; } 
                                                                                                
     $fstar=mysql_query("SELECT count(product_id) FROM `product_review` where product_id='".$detsarr[1]['code']."'"); 
						     $fstarftch=mysql_fetch_array($fstar);

                                                                                                ?>
                
                                          <br />
              Based on <?php echo $fstarftch[0];?> reviews.
              <?php } ?>
              </td>
              <td class="rating">           
                        <?php 
                        if($detsarr[2]['code']!="")
                        {
                        
                        for($i=5;$i>0;$i--)
{
    //echo "SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid." and rating_count='".$i."'";

$fstar5=mysql_query("SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$detsarr[2]['code']."' and rating_count='".$i."'"); 
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
                                                                         
                                                                         <?php $cn++; } $cnt=5-round($avg); $cn1=0; while($cn1!=$cnt){?>
                                                                                         
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <?php $cn1++; } 
                                                                                                
     $fstar=mysql_query("SELECT count(product_id) FROM `product_review` where product_id='".$detsarr[2]['code']."'"); 
						     $fstarftch=mysql_fetch_array($fstar);

                                                                                                ?>
                
                                          <br />
              Based on <?php echo $fstarftch[0];?> reviews.
              <?php } ?>
              </td>
              <td class="rating">           
                        <?php 
                        if($detsarr[3]['code']!="")
                        {
                        
                        for($i=5;$i>0;$i--)
{
    //echo "SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$pid." and rating_count='".$i."'";

$fstar5=mysql_query("SELECT count(review_id),count(product_id) FROM `product_review` where product_id='".$detsarr[3]['code']."' and rating_count='".$i."'"); 
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
                                                                         
                                                                         <?php $cn++; } $cnt=5-round($avg); $cn1=0; while($cn1!=$cnt){?>
                                                                                         
                                                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                                                                <?php $cn1++; } 
                                                                                                
     $fstar=mysql_query("SELECT count(product_id) FROM `product_review` where product_id='".$detsarr[3]['code']."'"); 
						     $fstarftch=mysql_fetch_array($fstar);

                                                                                                ?>
                
                                          <br />
              Based on <?php echo $fstarftch[0];?> reviews.
              <?php } ?></td>
                      </tr>
                    <tr>
            <td style="color: #1c4b6f;font-weight: bold;">Summary</td>
                        <td class="description" style="width:250px;"><?php echo $detsarr[0]['description'];?></td>
                        <td class="description" style="width:250px;"><?php echo $detsarr[1]['description'];?></td>
                        <td class="description" style="width:250px;"><?php echo $detsarr[2]['description'];?></td>
                        <td class="description" style="width:250px;"><?php echo $detsarr[3]['description'];?></td>
                      </tr>
          <tr>
            <td style="color: #1c4b6f;font-weight: bold;">Description</td>
                        <td><?php echo $detsarr[0]['Long_desc'];?></td>
                        <td><?php echo $detsarr[1]['Long_desc'];?></td>
                        <td><?php echo $detsarr[2]['Long_desc'];?></td>
                        <td><?php echo $detsarr[3]['Long_desc'];?></td>
                      </tr>
      
        </tbody>
           <!--     <tr>
          <td style="color: #1c4b6f;font-weight: bold;"></td>
          						<td class="text-center">
          				<?php		    if($detsarr[0]['code']!="")
                        {?>
                        
                      
                 
                              
                   <div class="trash" title="Remove" onclick="removecompare('<?php echo $detsarr[0]['compareid'];?>')"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
                  <input type="button" style="text-transform:none;border-radius:18px;outline: none;" value="Add to Cart" class="button btn btn-primary" onclick="addcart('<?php echo $detsarr[0]['code'];?>','<?php echo $detsarr[0]['category'];?>');"  />
          		 <?php } ?>
          						    </td>
          						    
          						    
          						    
          						<td class="text-center">
          						    <?php		    if($detsarr[1]['code']!="") {?>
                                     <div class="trash" title="Remove" onclick="removecompare('<?php echo $detsarr[1]['compareid'];?>')"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
                                     
                                     <input type="button" style="text-transform:none;border-radius:18px;outline: none;" value="Add to Cart" class="button btn btn-primary" onclick="addcart('<?php echo $detsarr[1]['code'];?>','<?php echo $detsarr[1]['category'];?>');"  />
          						    <?php } ?>
          						</td>
          						    
          						    
          						<td class="text-center">
          						    <?php if($detsarr[2]['code']!="")  {?>
                                        <div class="trash" title="Remove" onclick="removecompare('<?php echo $detsarr[2]['compareid'];?>')"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
                                	    <input type="button" style="text-transform:none;border-radius:18px;outline: none;" value="Add to Cart" class="button btn btn-primary" onclick="addcart('<?php echo $detsarr[2]['code'];?>','<?php echo $detsarr[2]['category'];?>');"  />
                      				<?php } ?>
          						</td>
          						<td class="text-center">
          						    <?php if($detsarr[3]['code']!="") {?>
                                      <div class="trash" title="Remove" onclick="removecompare('<?php echo $detsarr[3]['compareid'];?>')"><span class="lid" style="width:26px"></span><span class="can" style="width:26px"></span></div>
             						  <input type="button" style="text-transform:none;border-radius:18px;outline: none;" value="Add to Cart" class="button btn btn-primary" onclick="addcart('<?php echo $detsarr[3]['code'];?>','<?php echo $detsarr[3]['category'];?>');"  />
          						    <?php } ?>
          					    </td>
							</tr>-->
<!--					<tr>
						<td style="color: #1c4b6f;font-weight: bold;"></td>
												<td class="remove text-center">
												     <?php if($detsarr[0]['code']!="") {?>
                        
                        <a href="javascript:void(0);" style="text-transform:none;border-radius:18px;outline: none;" onclick="removecompare('<?php echo $detsarr[0]['compareid'];?>')" class="button btn btn-primary">Remove</a>
                        
                        
                        <?php } ?></td>
												<td class="remove text-center">
												     <?php if($detsarr[1]['code']!=""){?>
												     
                        <a href="javascript:void(0);" style="text-transform:none;border-radius:18px;outline: none;" onclick="removecompare('<?php echo $detsarr[1]['compareid'];?>')" class="button btn btn-primary">Remove</a>
                        <?php } ?></td>
											
												<td class="remove text-center">
												     <?php		    if($detsarr[2]['code']!="")
                        {?><a href="javascript:void(0);" style="text-transform:none;border-radius:18px;outline: none;" onclick="removecompare('<?php echo $detsarr[2]['compareid'];?>')" class="button btn btn-primary">Remove</a><?php } ?></td>
											
												<td class="remove text-center">
												     <?php		    if($detsarr[3]['code']!="")
                        {?><a href="javascript:void(0);" style="text-transform:none;border-radius:18px;outline: none;" onclick="removecompare('<?php echo $detsarr[3]['compareid'];?>')" class="button btn btn-primary">Remove</a><?php } ?></td>
						
						
						<td><button type="button" onclick="parent.addcart('<?php echo $slctwishftch['product_id']; ?>','<?php echo $slctwishftch['categories_id']; ?>');" data-toggle="tooltip" title="Add to Cart" class="btn btn-primary"><i class="fa fa-shopping-cart"></i></button>
                <a href="javascript:void(0);" data-toggle="tooltip" title="Remove" class="btn btn-danger" onclick="removewishlist('<?php echo $slctwishftch['wishlist_id']; ?>');"><span class="glyphicon" style="top:3px;font-size: 12px;">&#xe020;</span> </a></td>
												
                  </tr>-->
      </table>
      </div>
            </div>
   </div></div> 
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
    $("#offcanvasmenu").html($("#bs-megamenu").html());
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</body></html>

<!--/ wrapper -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  
<script>
    
   

$('.add-to-cart').on('click', function () {
        var cart = $('.icon-cart');
      
        var imgtodrag = $(this).parent('.item').find("img").eq(0);
      
        if (imgtodrag) { 
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
         
            }) 
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo');
            
            setTimeout(function () {
                cart.effect("shake", {
                    times: 1
                }, 300);
            }, 1500);

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        }
    });
    
    
</script>









