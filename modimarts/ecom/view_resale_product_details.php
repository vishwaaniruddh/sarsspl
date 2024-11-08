<?php
session_start();
if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){
    header("location:index.php");
}
include('config.php');
$pid=$_GET['prid'];
$cid=$_GET['catid'];
$regid= $_SESSION['gid'];
$loginstats=$_SESSION['loginstats'];

$qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,product_type FROM `Resale` WHERE code='".$pid."'";

$qrylatfrws=mysqli_query($con1,$qrylatf);   
$latstprnrws=mysqli_fetch_array($qrylatfrws);
?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
        <div class="row">
            <label>Sold</label>
            <span style='font-size:25px; margin-left: 79%;'>&#9989;</span>Sold
        </div>
    <div class="container">
        <div class="main-columns container" style="margin-left: 11px;">
  <div class="row">
	  <div id="sidebar-main" class="col-sm-12 col-xs-12">
		<div id="content">
            <div class="product-info"   style="padding-top:0px;"  >
                <div class="row">
                    <?php
                        $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `Resale_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
                        $frtu=mysqli_fetch_array($sqlimg23mn);
                        //echo $prodimgpth.$frtu['img'];
                    ?>
                    <?php
                    //echo $prodimgpth.$frtu['img'];
                    // echo $prodimgpth.$frtu['img'];
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 "   >
                       <style>
                        #sticky{
                        position: fixed;
                        height: 35px;
                        width: 45%;
                        color: white;   
                        background-color: #;
                        height:500px;
                        }
                        
                       #sticky::after{
                        position: fixed;
                        margin-top:-200px; 
                        background-color: #;
                        height:500px;
                        }
                        </style>
                        <div class="row" id="">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 " style="margin-top: -20px;">
                              <div class="thumbs-preview horizontal thumbnails">
                                
                                <?php include('resale_sidebarimg.php') ?>
                		       </div>
                		    </div>
                            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 ">
                                <!-- <div class="xzoom-container">
                                <!-- <img class="xzoom" id="xzoom-default" src="images/gallery/preview/01_b_car.jpg" xoriginal="images/gallery/original/01_b_car.jpg" />-->
                                <!-- <div id="aaa"> 
                                <img id="xzoom-default" src="<?php echo $prodimgpth.$frtu['midsize'];?>" xoriginal="<?php echo $prodimgpth.$frtu['img'];?>"  
                                class="xzoom"  style="width:450px; height:450px"/>
                                </div>
                                </div>    -->
                                <div id="a" class="" style="border: 1px solid #f0f0f0;">
                                    <center >
                                        <div id="b">
                                            <a href="<?php echo $prodimgpth.$frtu['img'];?>" title="<?php echo $latstprnrws['name'];?>" class="elevateZoom" target = '_blank'>
                                                <img src="<?php echo $prodimgpth.$frtu[2];?>" title="<?php echo $latstprnrws['name'];?>" alt="<?php echo $latstprnrws['name'];?>" id="image"
                                                style="height:350px;width:100%;object-fit:contain" data-zoom-image="<?php echo $prodimgpth.$frtu[3];?>" class="product-image-zoom img-responsive"/>
                                            </a> 
                                        </div>
                                    </center>
                                </div>
                                  <?php 
                                  $fstar=mysqli_query($con1,"SELECT count(product_id) FROM `product_review` where product_id='".$pid."' and category_id='".$cid."'"); 
                        	      $fstarftc=mysqli_fetch_array($fstar);
                                  ?>
                                <div class="box-product-infomation tab-v2 tabs-left" style="width:100%">
                                    <div class="">
                                        <!--<div class="tab-content text-left">-->
                                           <!-- <div class="tab-pane active" id="tab-description">
                                                  <p class="intro">
                                        </div>-->
                                        <div class="tab-pane active"  id="tab-review">
                                            <div id="review" class="space-20">
                                                <?php 
                                                $S=1;
                                                $R=4;
                                                $getreview=mysqli_query($con1,"SELECT `review_id`, `user_id`, `product_id`, `rating_count`, `description`, `date_time` FROM `product_review` where product_id='".$pid."' and category_id='".$cid."' order by review_id desc"); 
        					   
                    						    while($getreviewarr=mysqli_fetch_array($getreview)){
                    						       if($S<=$R) 
                    						         {
                                                        //$getnam=mysqli_query($con1,"SELECT Firstname FROM Registration where id='".$pid."'"); 
                                                        $getnam=mysqli_query($con1,"SELECT Firstname FROM Registration where id='".$getreviewarr[1]."'"); 
                                                        $getnamarr=mysqli_fetch_array($getnam);
                                                ?>
                                                <?php } $S++ ;}?>
                                            </div>
                                            <?php if($fstarftc[0]>4){?>
                                                <a target="_blank" class="popup-with-form btn btn-sm btn-primary" style="float: right;height:30px" href="review.php?pid=<?php echo $pid;?>&cid=<?php echo $cid;?>">More</a>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
            		    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                        <style>
                        * {
                            box-sizing: border-box;
                        }
                        
                        /* Create two equal columns that floats next to each other */
                        .column2 {
                            float: left;
                            width: 70%;
                            padding: 10px;
                            /* Should be removed. Only for demonstration */
                        }
                        .column1 {
                            float: left;
                            width: 30%;
                            padding: 10px;
                             /* Should be removed. Only for demonstration */
                        }
                        /* Clear floats after the columns */
                        .row:after {
                            content: "";
                            display: table;
                            clear: both;
                        }
                        </style>
                        <div class="row">
                            <div class="column2" >
                                <div class="product-info-bg">
                                   <h1 class="title-product" style="font-size:24px;margin-top: 0px;font-family:initial"><?php echo $latstprnrws['name'];?></h1>
                                </div>
                                <!-- style="border: 1px solid #f0f0f0;"-->
        <div class="row" >
            <div class="col-md-12" ><h2 style="font-size:13px;">Product Description</h2></div>
            <div class="col-md-12" >
                <p>
                    <?php  //echo $latstprnrws['Long_desc'];
                    $str = $latstprnrws['description'];
                    echo  $str;
                    /*   echo wordwrap($str,50,"<br>\n",TRUE);*/
                    ?>
                </p>
            </div>
        </div>
        <div class="row" style=" margin-top:0px;">
            <div class="col-md-12" style=" font-size:13px;"><h2 style="font-size:13px;font-family:initial">Specifications</h2></div>
            <div class="col-md-12" style="">
                <table>
                    <tr>
                        <?php 
                         $qry=mysqli_query($con1,"SELECT product_specification,specificationname from ResaleSpecification where product_id='".$pid."'");
                         while($fetcspcf=mysqli_fetch_array($qry)){
                         ?>
                        <div class="col-md-4"><p style="color:#0606068c"><?php echo $fetcspcf[0]; ?></p></div>
                        <div class="col-md-8"> <p> <?php echo $fetcspcf[1]; ?></p> </div> 
                        <?php } ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="column1" >
        <br /><br />
        <div class="border-success space-30">
            <ul class="list-unstyled">
                <li><b>Product Code:</b> <?php echo $latstprnrws['code'];?></li>
            </ul>
        </div>
        <div class="price detail space-20">
            <ul class="list-unstyled"  style="margin-top: 30px;">
                <li >            
                    <span class="price-new"><i class="fa fa-inr "></i> <?php echo $latstprnrws['price'];?></span>
                    <?php if($latstprnrws['discount']>0){?>
                        <span class="price-old"><!--$<?php //echo $latstprnrws['price'];?>--></span> 
                    <?php } ?>
                </li>
            </ul>
         </div>
    <div>
    </div>
        </div>
    </div><!-- End div bg -->
</div>
</div>
</div>
</div>
</div>
</div>

 
 
  
<script type="text/javascript">
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
</script> 

<script type="text/javascript" src=" catalog/view/javascript/jquery/elevatezoom/elevatezoom-min.js"></script>



<script type="text/javascript">
	/*	var zoomCollection = '#image';
		$( zoomCollection ).elevateZoom({
				lensShape : "basic",
		lensSize    : 100,
		easing:true,
		gallery:'image-additional-carousel',
		cursor: 'pointer',
		galleryActiveClass: "active"
	});*/
 
 
 $('#image').elevateZoom({
 /* responsive: true,
    zoomWindowWidth:300,
    zoomWindowHeight:400,
    zoomWindowFadeIn: 500,
    zoomWindowFadeOut: 50,
    scrollZoom : true*/
    
     zoomWindowFadeIn: 500,
			zoomWindowFadeOut: 500,
			lensFadeIn: 500,
			lensFadeOut: 500
			
		
  });
</script>


<script type="text/javascript">
    //$("#offcanvasmenu").html($("#bs-megamenu").html());
    
</script>
</div>
    </div>
</body>
</html>