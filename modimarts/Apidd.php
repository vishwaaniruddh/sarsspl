<?php
session_start();
include 'head.php';
include 'apidata.php';


?>
<?php


$product_id    = mysqli_real_escape_string($con1, $_GET['product_id']);
// var_dump($product_id);

?>
    <style>
      .product-single h4 {
    text-transform: capitalize;
}
    </style>
    <style>
    .star {display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:30px;}
    .starrate {display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:30px;}
    .highlight, .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>

 
<nav class="breadcrumb" aria-label="breadcrumbs">
        <div class="container-bg">
          <a href="index.php">Home</a>
         

        <style>
            /* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

</style>
 </div>
      </nav>

<?php

$res_responce=GetProductdata('getProductInfo',$product_id);
$Prodata=$res_responce->Records;
$Sku_id=$Prodata[0]->Sku_id;

$size_responce=getProductSizes('getProductSizes',$product_id,$Sku_id);
$col_responce=getProductColors('getProductColors',$product_id,$Sku_id);
$size_res=$size_responce->Records;
$color_res=$col_responce->Records;

$color=$color_res[0]->Color_id;
$size=$size_res[0]->Size_id;



for ($j=0; $j <count($Prodata) ; $j++) { 

    $pro_name=$Prodata[$j]->Title;
    $description=$Prodata[$j]->Description;
    $amount=$Prodata[$j]->Regular_price;
    $minqty=number_format($Prodata[$j]->Stock_qty);
    $maxqty=0;

    $Regular_price = $Prodata[$j]->Regular_price;
    $Product_id = $Prodata[$j]->Product_id;
    $Shipping_charges = $Prodata[$j]->Shipping_charges;
    $Sku_id = $Prodata[$j]->Sku_id;
    $Medium_file = $Prodata[$j]->Medium_file;
    $Regular_price = $Prodata[$j]->Regular_price;
        


$imgresponse=getImagesList('getImagesList', $product_id);
$proimgresponse=$imgresponse->Records;

for ($i=0; $i <count($proimgresponse) ; $i++) { 
   $collect[] = $proimgresponse[$i]->Img_file;
}



 ?>

   <main class="main-content">
        <div class="dt-sc-hr-invisible-small"></div>
        <?=include 'pro_data_sidebar_lable.php'?>




        <div class="wrapper">
          <div class="grid-uniform">
            <div class="grid__item">
              <div class="container-bg">
                <div class="grid__item">
                  <?php include 'prodata_sidebar.php';?>

                  <div class="second">
                    <div
                      id="shopify-section-product-template"
                      class="shopify-section"
                    >
                      <div
                        class="grid__item wide--four-fifths post-large--three-quarters"
                      >
                        <div itemscope itemtype="https://schema.org/Product">
                          <meta
                            itemprop="url"
                            content="#"
                          />
                          <meta itemprop="name" content="Black Tea" />
                          <meta itemprop="sku" content="" />
                          <meta itemprop="gtin14" content="" />
                          <meta itemprop="brand" content="Groca" />
                          <meta
                            itemprop="description"
                            content="#"
                          />
                          <meta
                            itemprop="image"
                            content="<? echo $pro_img; ?>"
                          />
                          <div
                            itemprop="offers"
                            itemscope=""
                            itemtype="https://schema.org/Offer"
                          >
                            <meta itemprop="priceCurrency" content="INR" />
                            <meta itemprop="price" content="200.00" />
                            <meta
                              itemprop="itemCondition"
                              itemtype="https://schema.org/OfferItemCondition"
                              content="https://schema.org/NewCondition"
                            />
                            <meta
                              itemprop="availability"
                              content="https://schema.org/InStock"
                            />

                             
                          </div>
                        </div>
                        <div class="single-product-layout-type-1">
                          <div class="product-single">
                            <div class="grid__item">
                               <div class="grid__item wide--one-half post-large--one-half large--one-half left-sidebar-sticky" data-more-view-product id="imgbox">
                                  <div class="product-img-box">
                                    <div style="position: relative;" class="wrapper-images" id='wrapper-images'>
                                      <div class="product-photo-container slider-for"  >


                                          <?php
if ($categogy != '761') {

        $mainpath = "https://thebrandtadka.com/images_inventory_products/multiple_images/";
        // while ($sltingim = mysqli_fetch_array($sqlimg23mn)) {
        //     $collect[] = $sltingim;
        // }

        foreach ($collect as $row1) {

            ?>
                                        <div class="thumb filter-chocolate-protein-powder">
                                          <a data-zoom class="fancybox" rel="gallery1" href="<?php echo $mainpath . $row1; ?>" data-fancybox="images">
                                            <img id="product-featured-image-15327177867454" src="<?php echo $mainpath . $row1; ?>" alt="<?=$pro_name?>" >
                                          </a>
                                        </div>
                                     <?php }?>
                                      </div>
                                    </div>

                                    <div class="slider-nav   more-view-wrapper  more-view-vertical"  data-rows="5"  data-vertical="true"  >

                                    <?php
foreach ($collect as $row) {
            ?>

                                      <div class="item filter-chocolate-protein-powder">
                                        <a href="javascript:void(0)" data-image="<?php echo $mainpath . $row; ?>" data-zoom-image="<?php echo $mainpath . $row; ?>">
                                          <img src="<?php echo $mainpath . $row; ?>" alt="<?=$pro_name?>">
                                        </a>
                                      </div>
                                      <?php
                                        }
                                            } else {
                                                ?>
                                          <div class="thumb filter-chocolate-protein-powder">
                                          <a data-zoom class="fancybox" rel="gallery1" href="<?php echo $pro_img; ?>" data-fancybox="images">
                                            <img id="product-featured-image-15327177867454" src="<?php echo $pro_img; ?>" alt="<?=$pro_name?>" >
                                          </a>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="slider-nav   more-view-wrapper  more-view-vertical"  data-rows="5"  data-vertical="true"  >

                                      <div class="item filter-chocolate-protein-powder">
                                        <a href="javascript:void(0)" data-image="<?php echo $pro_img; ?>" data-zoom-image="<?php echo $pro_img; ?>">
                                          <img src="<?php echo $pro_img; ?>" alt="<?=$pro_name?>">
                                        </a>
                                      </div>
                                    </div>

   
                                      <?php }?>
                                    </div>


                                  </div>


                           </div>

                              <div
                                class="product_single_detail_section grid__item wide--one-half post-large--one-half large--one-half"
                              >
                                <h2 class="product-single__title"><?php echo $pro_name; ?></h2>

                                <div class="reviews-sold-in-hours">
                                  <span
                                    class="shopify-product-reviews-badge"
                                    data-id="6151883718846"
                                  ><a href="#ratings" onclick="review()">
                                      <ul >
                                            <?php 

                                            $star=5;
                                            $hg=$average;
                                            $nhg=$star-$hg;
                                            for ($i=0; $i <$hg ; $i++) { ?>
                                          <li  title="<?=$i?> Star Out Of 5" class="starrate highlight" >★</li>
                                          <?php } ?>
                                          <?php 
                                            for ($j=0; $j <$nhg ; $j++) { ?>
                                          <li class="starrate" >★</li>
                                          <?php } ?>
                                        </ul></a>
                                  </span>



                                <div class="product-description rte"><?php echo $description; ?>
                                    
                                 </div>

                                <link href="https://schema.org/InStock" />

                                <div class="product_single_price" id="pricebox" style="display: block;">
                                  <label>Price :</label>

                                  <div class="product_price">
                                    <div
                                      class="grid-link__org_price"
                                      id="ProductPrice"
                                    >
                                    <span>Rs <?php echo $amount; ?></span>&nbsp;&nbsp;

                                    </div>
                                  </div> <?php if ($latstprnrws['total_amt'] < $latstprnrws['price']) {?>
                                    <span style="color:red"><del>₹<?php echo $latstprnrws['price']; ?></del> (<?php echo round((1 - ($latstprnrws['total_amt'] / $latstprnrws['price'])) * 100, 0); ?> % Off )</span>
                                  <?php }?>
                                  
                                  
                                  
                                </div>
                                
                               
                                
                                


                               




                                            </div>


                              

                                  <div class="product-single__quantity" style="display: block;">
                                    <div class="quantity-box-section">
                                      <label>Quantity :</label>

                                      <div class="quantity_width">
                                        <div class="dec button">-</div>

                                        <input
                                          type="number"
                                          id="quantity"
                                          name="quantity"
                                          value="<?=$minqty?>"
                                          min="<?=$minqty?>" 
                                          onkeyup="updatePricing()"                                        
                                        />
                                        <input type="hidden" value="<?=$minqty?>" id="minqty">

                                        <div class="inc button">+</div>

                                        <p
                                          class="min-qty-alert"
                                          style="display: none"
                                        >
                                          Minimum quantity should be <?=$minqty?>
                                        </p>
                                      </div>
                                    </div>

                                    <div class="total-price" style="display: block;">
                                      <label>Subtotal : </label
                                      ><span id="totalprice">Rs. <?php echo $amount*$minqty; ?></span>
                                    </div>
                                     <input type="hidden" id="prod_id" value="<? echo  $cust_pid;?>">
                                    <div class="shipping-charges" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;display: block;">
                                      <label>Shipping Charges : </label>
                                        <span style="font-size: 18px;color: #ff6c26;">
                                            <?php
                                             // if($prod_id==1427){
                                              ?>
                                                <!-- <b>FREE Delivery for quantity more than 5. Otherwise Shipping Charges Rs.50/- upto 5 quantity</b>-->
                                                    <!-- <b>Rs. 50</b> -->
                                            <?php 
                                          // }else {
                                                    if($shipping_charges==0){?>
                                                    <b>FREE Delivery in India</b>
                                                    <?php }else{ ?>
                                                  Rs. <?php echo $shipping_charges; ?>
                                                   <?php }
                                                   // } 
                                                   ?> 
                                        </span>
                                    </div>


                               
                                <!-- <div class="progress-bar">
                                  <span class="progress bg-success" data-size=""></span>
                                </div> -->
                                    <?php if($prod_id==1427){?>
                                    <div class="certificates" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;display: block;">
                                        
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#btnShow').click(function(){
                                                    $("#dialog").show();
                                                    $("#frame").attr("src", "https://allmart.world/ecom/userfiles/safetycard/Certificates-MySafetyCard.pdf");
                                                }); 
                                            });
                                        </script>
                                      <label>Certificates : </label>
                                      <span id="certificates" style="font-size: 18px;color: #ff6c26;">
                                          <a href="https://allmart.world/ecom/userfiles/safetycard/Certificates-MySafetyCard.pdf" target="_blank">Show Certificates</a>
                                      </span>
                                      <!--  <label>&nbsp;</label>
                                       <span  style="font-size: 12px;color: #ff6c26;">
                                          <a href="https://allmart.world/ecom/userfiles/safetycard/Certificates-MySafetyCard.pdf" target="_blank"><small style="font-size: 12px;">(Haffkine, Bombay Test House, Patent, Euro Cert - ISO, FDA, CE, GMP)</small>
                                          </a></span> -->
                                    </div>
                                    <style>
                                      #lebelspace
                                        {
                                          width: 30%;
                                        }
                                         #lbcontent
                                        {
                                          width: 70%
                                        }
                                      @media screen and (max-width: 1599px)
                                      {
                                        #lebelspace
                                        {
                                          width: 40%;
                                        }
                                        #lbcontent
                                        {
                                          width: 60%
                                        }
                                      }
                                      

                                    </style>
                                    <div style="width: 100%">
                                      <div id="lebelspace"></div>
                                      <div id="lbcontent"> <a href="https://allmart.world/ecom/userfiles/safetycard/Certificates-MySafetyCard.pdf" target="_blank"><small style="font-size: 12px;">(Haffkine, Bombay Test House, Patent, Euro Cert - ISO, FDA, CE, GMP)</small></a></div>
                                    </div>
                                    
                                    <div class="press" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;display: block;">
                                        
                                      <label>Press Releases : </label>
                                      <span id="certificates" style="font-size: 18px;color: #ff6c26;">
                                          <a href="#ppress" onclick="openPress()">View</a>
                                      </span>  
                                    </div>
                                    <div class="faq" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;display: block;">
                                        
                                      <label>FAQ : </label>
                                      <span id="certificates" style="font-size: 18px;color: #ff6c26;">
                                          <a href="https://allmart.world/ecom/userfiles/safetycard/FAQ-MySafetyCard.pdf" target="_blank">Show FAQ</a>
                                      </span>  
                                    </div>
                                    <?php } ?> 
                                     <?php if($prod_id==1427){?>
                                    <div class="faq" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;display: block;">
                                      <label>Note : </label><span style="color:red;margin:0;font-size: 15px;">This Product is Non Refundable </span>
                                    </div>
                                    <div class="faq" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;display: block;">
                                      <label>Recommended Order: </label><span style="color: #ff6c26;margin:0;font-size: 15px;">1 card per family member for 1 month </span>
                                    </div>
                                <!--  <p style="color:red;margin:0;">Expiry is 2 years from the Manufacturing Date </p>
                                  <p style="color:red;margin:0;">Remains Active for 30 days after Opening</p> -->
                                <?php }?>
                                    
                                    <?php 
                                       $video_qry = mysqli_query($con1, "SELECT videopath,filename FROM product_videos where productid = '" . $pid . "'");
                                       $video_data = mysqli_fetch_row($video_qry);
                                       
                                       if(!empty($video_data)){
                                           $videopath = $video_data[0];
                                           $_videopath="https://allmart.world/ecom/".$videopath;
                                           $oggfile = $video_data[1];
                                           
                                    ?>
                                    <style>
                                             #fade {
                                              display: none;
                                              position: fixed;
                                              top: 0%;
                                              left: 0%;
                                              width: 100%;
                                              height: 100%;
                                              background-color: black;
                                              z-index: 1001;
                                              -moz-opacity: 0.8;
                                              opacity: .80;
                                              filter: alpha(opacity=80);
                                            }
                                            
                                            #light {
                                              display: none;
                                              position: absolute;
                                              top: 10%; 
                                              left: 50%;
                                              max-width: 800px;
                                              max-height: 360px;
                                              margin-left: -300px;
                                              margin-top: -180px;
                                              border: 2px solid #FFF;
                                              background: #FFF;
                                              z-index: 1002;
                                              overflow: visible;
                                            }
                                            
                                            #boxclose {
                                              float: right;
                                              cursor: pointer;
                                              color: #fff;
                                              border: 1px solid #AEAEAE;
                                              border-radius: 3px;
                                              background: #222222;
                                              font-size: 31px;
                                              font-weight: bold;
                                              display: inline-block;
                                              line-height: 0px;
                                              padding: 11px 3px;
                                              position: absolute;
                                              right: 2px;
                                              top: 2px;
                                              z-index: 1002;
                                              opacity: 0.9;
                                            }
                                            
                                            .boxclose:before {
                                              content: "×";
                                            }
                                            
                                            #fade:hover ~ #boxclose {
                                              display:none;
                                            }
                                            
                                            .test:hover ~ .test2 {
                                              display: none;
                                            }
                                        </style>
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                          $('#exampleModal').modal({
                                              show: false
                                          }).on('hidden.bs.modal', function(){
                                              $(this).find('video')[0].pause();
                                          });
                                        });
                                        window.document.onkeydown = function(e) {
                                              if (!e) {
                                                e = event;
                                              }
                                              if (e.keyCode == 27) {
                                                lightbox_close();
                                              }
                                            }
                                            
                                            function lightbox_open() {
                                              var lightBoxVideo = document.getElementById("VisaChipCardVideo");
                                              window.scrollTo(0, 0);
                                              document.getElementById('light').style.display = 'block';
                                              document.getElementById('fade').style.display = 'block';
                                              lightBoxVideo.play();
                                            }
                                            
                                            function lightbox_close() {
                                              var lightBoxVideo = document.getElementById("VisaChipCardVideo");
                                              document.getElementById('light').style.display = 'none';
                                              document.getElementById('fade').style.display = 'none';
                                              lightBoxVideo.pause();
                                            }
                                    </script>
                                    <div id="light">
                                      <a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
                                      <video id="VisaChipCardVideo" width="600" controls>
                                          <source src="<?php echo $_videopath;?>" type="video/mp4">
                                          <!--Browser does not support <video> tag -->
                                        </video>
                                    </div>
                                    
                                    <div id="fade" onClick="lightbox_close();"></div>
                                    <div class="video_file" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;">
                                        <label>Video : </label>
                                        <span style="font-size: 18px;color: #ff6c26;">
                                              <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> 
                                                Product Video
                                              </button> -->
                                                <div>
                                                  <a href="#" onclick="lightbox_open();">Product Video</a>
                                                </div>
                                               <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                                  <div class="modal-dialog" role="document" >
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                                          <span aria-hidden="true">×</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <video id="" width="100%" controls poster="#">
                                                          <source src="<?php echo $_videopath;?>" type="video/mp4">
                                                          <source src="https://allmart.world/ecom/userfiles/570/video/2021/04/<?php echo $oggfile; ?>" type="video/ogg">
                                                          Your browser does not support the video tag.
                                                        </video>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>

                                        </span>
                                    </div>
                                    <?php }?>
                                    
                                  </div>

                                  <script>
                                    jQuery(".button").on("click", function () {
                                      var oldValue = jQuery("#quantity").val(),
                                        newVal = 1;

                                      if (jQuery(this).text() == "+") {
                                        var max = <?=$maxqty?>;
                                        if (oldValue<max ||max==0)
                                        {
                                        newVal = parseInt(oldValue) + 1;
                                       }
                                       else
                                       {
                                         newVal = oldValue;
                                       }
                                      } else if (oldValue > 1) {
                                        var min = <?=$minqty?>;
                                        if(oldValue>min)
                                        {
                                        newVal = parseInt(oldValue) - 1;
                                         }
                                         else
                                         {
                                          newVal = oldValue;
                                         }
                                      }

                                      jQuery(".product-single #quantity").val(
                                        newVal
                                      );

                                      updatePricing();
                                    });

                                    //update price when changing quantity
                                    function updatePricing() {
                                      //try pattern one before pattern 2
                                      var regex = /([0-9]+[.|,][0-9]+[.|,][0-9]+)/g;
                                      var unitPriceTextMatch = jQuery(
                                        ".product-single #ProductPrice"
                                      )
                                        .text()
                                        .match(regex);

                                      if (!unitPriceTextMatch) {
                                        regex = /([0-9]+[.|,][0-9]+)/g;
                                        unitPriceTextMatch = jQuery(
                                          ".product-single #ProductPrice"
                                        )
                                          .text()
                                          .match(regex);
                                      }

                                      if (unitPriceTextMatch) {
                                        var unitPriceText =
                                          unitPriceTextMatch[0];
                                        var unitPrice = unitPriceText.replace(
                                          /[.|,]/g,
                                          ""
                                        );
                                        var quantity = parseInt(
                                          jQuery(
                                            ".product-single  #quantity"
                                          ).val()
                                        );
                                        var totalPrice = unitPrice * quantity;

                                        var totalPriceText = Shopify.formatMoney(
                                          totalPrice,
                                          window.money_format
                                        );
                                        regex = /([0-9]+[.|,][0-9]+[.|,][0-9]+)/g;
                                        if (!totalPriceText.match(regex)) {
                                          regex = /([0-9]+[.|,][0-9]+)/g;
                                        }
                                        totalPriceText = totalPriceText.match(
                                          regex
                                        )[0];

                                        var regInput = new RegExp(
                                          unitPriceText,
                                          "g"
                                        );
                                        var totalPriceHtml = jQuery(
                                          ".product-single #ProductPrice"
                                        )
                                          .html()
                                          .replace(regInput, totalPriceText);

                                        jQuery(
                                          ".product-single .total-price span"
                                        ).html(totalPriceHtml);
                                        
                                        var prod_id = 
                                            jQuery(".product-single #prod_id").val()
                                            ;
                                        if(prod_id==711){
                                            if(quantity>5){
                                              var totalShippingPriceHtml = "FREE Delivery";    
                                               jQuery(
                                                  ".product-single .shipping-charges span"
                                                ).html(totalShippingPriceHtml); 
                                            }else{
                                                 var totalShippingPriceHtml = "FREE Delivery";    
                                               jQuery(
                                                  ".product-single .shipping-charges span"
                                                ).html(totalShippingPriceHtml);
                                            }
                                        }
                                         // alert(prod_id);
                                      }
                                    }

                                    jQuery(".product-single #quantity").on(
                                      "change",
                                      updatePricing
                                    );

                                    var t = false;

                                    jQuery("input").focus(function () {
                                      var $this = jQuery(this);

                                      t = setInterval(function () {
                                        if (
                                          $this.val() < 1 &&
                                          $this.val().length != 0
                                        ) {
                                          if ($this.val() < 1) {
                                            $this.val(1);
                                          }

                                          jQuery(".min-qty-alert").fadeIn(
                                            1000,
                                            function () {
                                              jQuery(this).fadeOut(500);
                                            }
                                          );
                                        }
                                      }, 50);
                                    });

                                    jQuery("input").blur(function () {
                                      if (t != false) {
                                        window.clearInterval(t);
                                        t = false;
                                      }
                                    });
                                  </script>

                                  <div class="grid__item notify-block"><input type="hidden" id="jwt_token" value="<?php echo $rowtoken[0]; ?>"></div>
                                  <div class="product_button_section"  >
                                   <div style="display: flex;">
                                    <div class="col-md-1" style="display: flex;width: 25%">
                                      <input type="number" name="Pincode" onkeypress="return isNumberKey(event)" placeholder="Enter Pincode" class="form-control" id="delivery_pincode">
                                    </div>
                                     <div class="col-md-1" style="display: flex;width: 25%">
                                      <input onclick="checkdelivery()" type="submit" value="Check" title="Check Delivery" class="btn btn-danger" style="margin: 10px;width:100%">
                                    </div>
                                    <div class="col-md-1" style="width: 49%;margin: auto;padding: 5px;">
                                       <span id="placedata"></span><br/>
                                       <span id="checkdeliveryresult"></span>
                                    </div>
                                    </div>
                                    
                                  </div>
                                 

                                   <div class="product_button_section">
                                    

                                    <button
                                      type="submit"
                                      name="buy"
                                      id="AddToCart"
                                      class="btn"
                                      <?php 
                                      if($status==1)
                                      { ?>
                                      onclick="buy_now('<? echo $categogy;?>','<? echo  $cust_pid;?>','<? echo $amount; ?>','<? echo $pro_img;?>','<? echo urlencode($pro_name);?>','<? echo  $prod_id;?>','<?php echo $shipping; ?>','<?php echo $shipping_charges; ?>',)"
                                      <?php 
                                      }
                                      else { ?>
                                        disabled
                                        style="background: #f7b1117d;"
                                      <?php } ?>
                                    >
                                      <i
                                        class="fas fa-cart-plus"
                                        aria-hidden="true"
                                      ></i
                                      ><span id="BuyNowText">Buy Now</span
                                      >
                                    </button>
                                     <?php if($prod_id==1427){?>
                                     
                                    <!-- <div class="add-to-wishlist">
                                      <div class="show">
                                        <div
                                          class="default-wishbutton-black-tea loading"
                                        >
                                          <a
                                            title="Buy 50 Qty @300/Card"
                                            class="btn"                                           
                                            class="btn"
                                      onclick="bulkbuy_now('<? echo $categogy;?>','<? echo  $cust_pid;?>','<? echo $amount; ?>','<? echo $pro_img;?>','<? echo $pro_name;?>','<? echo  $prod_id;?>','<?php echo $shipping; ?>','<?php echo $shipping_charges; ?>',)"
                                            ><i class="fas fa-payment" aria-hidden="true" ></i><span id="BuybulkNowText">Buy 50 Qty @300/Card</span></a
                                          >
                                        </div>
                                        
                                        
                                      </div>
                                    </div> -->
                                  <?php } ?>

                                  <div class="add-to-wishlist">
                                      <div class="show">
                                        <div
                                          class="default-wishbutton-black-tea loading"
                                        >
                                          <a
                                            title="Add to wishlist"
                                            class="add-in-wishlist-js btn"
                                            <?php 
                                      if($status==1)
                                      { ?>
                                      onclick="add_to_card('<? echo $categogy;?>','<? echo  $cust_pid;?>','<? echo $amount; ?>','<? echo $pro_img;?>','<? echo urlencode($pro_name);?>','<? echo  $prod_id;?>','<?php echo $shipping; ?>','<?php echo $shipping_charges; ?>',)"
                                      <?php 
                                      }
                                      else { ?>
                                        disabled
                                        style="background: #f26522a8;"
                                      <?php } ?>
                                           
                                            ><i class="fas fa-cart-plus"
                                        aria-hidden="true"
                                      ></i
                                      ><span id="AddToCartText">Add to Cart</span></a>
                                        </div>
                                        
                                        
                                      </div>
                                    </div>

                                  </div> 

                                  <div class="product_button_section">
                                    <!-- <button
                                      type="submit"
                                      name="add"
                                      id="AddToCart"
                                      class="btn"
                                      onclick="add_to_card('<? echo $categogy;?>','<? echo  $cust_pid;?>','<? echo $amount; ?>','<? echo $pro_img;?>','<? echo $pro_name;?>','<? echo  $prod_id;?>','<?php echo $shipping; ?>','<?php echo $shipping_charges; ?>',)"
                                    >
                                      <i
                                        class="fas fa-cart-plus"
                                        aria-hidden="true"
                                      ></i
                                      ><span id="AddToCartText"


                                        >Add to Cart</span
                                      >
                                    </button> -->

                                    <div class="add-to-wishlist">
                                      <div class="show">
                                        <div
                                          class="default-wishbutton-black-tea loading"
                                        >
                                          <a
                                            title="Add to wishlist"
                                            class="add-in-wishlist-js btn"
                                            onclick="addtowishlist('<? echo $categogy;?>','<?php echo $prod_id; ?>','<? echo $amount; ?>','<? echo $pro_img;?>','<? echo urlencode($pro_name);?>','<? echo  $cust_pid;?>')"
                                            ><i class="far fa-heart"></i
                                            ><span class="tooltip-label"

                                              >Add to wishlist</span
                                            ></a
                                          >
                                        </div>
                                        
                                        
                                      </div>
                                    </div>

                                    
                                  </div>

                                <!-- <div class="realTime">
                                  <div class="avatar"></div>
                                  <div
                                    class="counter_real_time"
                                    data-counter-max="100"
                                    data-interval-time="2000"
                                  >
                                    Real time
                                    <span id="number_counter"
                                      >+<span>41</span></span
                                    >
                                    visitor right now
                                  </div>
                                </div> -->

                                <style type="text/css">
                                  #number_counter {
                                    background: #e53939;
                                    color: #ffffff;
                                  }
                                </style>

                                 <div class="share_this_btn">
                                  <div
                                    class="social-sharing is-clean"
                                    data-permalink="#"
                                  >
                                    <label style="margin-top: 2%;">Share this on: </label>

                                    <a
                                      
                                      href="#"
                                      class="share-facebook m-2"
                                      style="margin:5px"
                                    onclick="socialsharelink('facebook','<?php echo urlencode($pro_name); ?>','')">
                                      <span class="fab fa-facebook fa-2x"></span>
                                    </a>

                                    <a
                                      
                                      href="#"
                                      class="share-twitter m-2"
                                      style="margin:5px"
                                      onclick="socialsharelink('twitter','<?php echo urlencode($pro_name); ?>','')">
                                    
                                      <span class="fab fa-twitter fa-2x"></span>
                                    </a>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-pinterest m-2"
                                      style="margin:5px"
                                    onclick="socialsharelink('pinterest','<?php echo urlencode($pro_name); ?>','<?php echo $pro_img; ?>')">
                                      <span class="fab fa-pinterest fa-2x"></span>
                                    </a>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-google "
                                      style="margin:5px"
                                    onclick="socialsharelink('google-plus','<?php echo urlencode($pro_name); ?>','')">
                                      <!-- Cannot get Google+ share count with JS yet -->
                                      <span class="fab fa-google fa-2x"></span>
                                    </a>
                                    
                                    <a
                                      
                                      href="#"
                                      class="share-whatsapp m-2"
                                      style="margin:5px"
                                      onclick="socialsharelink('whatsapp','<?php echo urlencode($pro_name); ?>','<?php echo $pro_img; ?>')">
                                    
                                      <span class="fab fa-whatsapp fa-2x"></span>
                                    </a>
                                    
                                    <a
                                      
                                      href="#"
                                      class="share-instagram m-2"
                                      style="margin:5px"
                                      onclick="socialsharelink('instagram','<?php echo urlencode($pro_name); ?>','')">
                                    
                                      <span class="fab fa-instagram fa-2x"></span>
                                    </a>
                                  </div>
                                </div>
                                 <?php if($prod_id==1427){?>
                                <div class="share_this_btn">
                                  <div
                                    class="social-sharing is-clean"
                                    data-permalink="#"
                                  >
                                    <label style="margin-top: 2%;">Watch Product Video: </label>
                                   <!-- https://youtu.be/XdQ_8_qixPY -->
                                    <a
                                      
                                      href="https://youtu.be/ec6xUI7VWRg"
                                      target="_blank"
                                      class="share-facebook m-2"
                                      style="margin:5px">
                                      <span class="fab fa-youtube fa-2x"></span>
                                    </a>

                                    
                                  </div>
                                </div>
                              <?php } ?>
                              </div>
                            </div>

                            <script>
                              function openPress()
                              {
                                $("#pdesc").removeClass('current');
                                $("#desc_pro").hide();
                                $("#ppress").addClass('current');
                                $("#press_data").show();
                                $("#review").hide();
                              }
                            </script>
                            <script>
                              function review()
                              {
                               
                                $("#review").show();
                              }
                            </script>
                            <script>
                              function description()
                              {
                               
                                $("#review").hide();
                              }
                            </script>



                            <div class="grid__item">
                              <div class="product_sidebar"></div>
                            </div>
                          </div>

                          <div class="dt-sc-hr-invisible-large"></div>

                          <div class="dt-sc-tabs-container">
  <ul class="dt-sc-tabs">
    <li><a class="current" id="pdesc" href="#" onclick="description()"> Product Description </a></li> 
    <?php if($prod_id==1427){?>
    <li><a class="" id="ppress" href="#"> Press Releases </a></li>      
    <?php } ?>
    <li><a class="" href="#" id="ratings" onclick="review()"> Reviews  </a></li>
  </ul>
  <div class="dt-sc-tabs-content rte" id="desc_pro" style="display: block;">
    <p><span
                                  >
                                <?php if ($long_desc != '') {?>
                                  <p class="vote"><?php echo $long_desc; ?></p>
                                <?php }?>

                                <?php if ($desc_others != '') {?>
                                  <p class="vote"><?php echo $desc_others; ?></p>
                                <?php }?></span
                                ></p>

  </div>
  
    <?php if($prod_id==1427){?>
  
  <div class="dt-sc-tabs-content" id="press_data" style="display: none;">
    <div class="commentlist">
      <div class="comment-text">
        <div class="rating-review">
          <div id="shopify-product-reviews" data-id="5969999724734">
            <div class="spr-container">
              <div class="spr-header">
                <div class="grid__item">
                        <ul>
                            <li>
                                <a target="_blank" href="https://thetimesnews.co.in/protection-against-corona-and-other-infections-using-my-safety-card/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>thetimesnews.co.in</small></p></a>
                                <a target="_blank" href="https://thetimesnews.co.in/protection-against-corona-and-other-infections-using-my-safety-card/"><h4>Protection against Corona and other infections using My Safety Card…</h4></a>
                                <a target="_blank" href="https://thetimesnews.co.in/protection-against-corona-and-other-infections-using-my-safety-card/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://www.mid-day.com/lifestyle/health-&-fitness/article/my-safety-card-assures-protection-against-all-bacteria-and-viruses-including-covid19-23170003"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>mid-day.com</small></p></a>
                                <a target="_blank" href="https://www.mid-day.com/lifestyle/health-&-fitness/article/my-safety-card-assures-protection-against-all-bacteria-and-viruses-including-covid19-23170003"><h4>My Safety Card assures protection against all bacteria and viruses including Covid19</h4></a>
                                <a target="_blank" href="https://www.mid-day.com/lifestyle/health-&-fitness/article/my-safety-card-assures-protection-against-all-bacteria-and-viruses-including-covid19-23170003"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://dainiktimes.co.in/%E0%A4%AE%E0%A4%BE%E0%A4%AF-%E0%A4%B8%E0%A5%87%E0%A4%AB%E0%A5%8D%E0%A4%9F%E0%A5%80-%E0%A4%95%E0%A4%BE%E0%A4%B0%E0%A5%8D%E0%A4%A1-%E0%A4%8F%E0%A4%95-%E0%A4%A8%E0%A4%AF%E0%A4%BE-%E0%A4%AD%E0%A4%BE/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>dainiktimes.co.in</small></p></a>
                                <a target="_blank" href="https://dainiktimes.co.in/%E0%A4%AE%E0%A4%BE%E0%A4%AF-%E0%A4%B8%E0%A5%87%E0%A4%AB%E0%A5%8D%E0%A4%9F%E0%A5%80-%E0%A4%95%E0%A4%BE%E0%A4%B0%E0%A5%8D%E0%A4%A1-%E0%A4%8F%E0%A4%95-%E0%A4%A8%E0%A4%AF%E0%A4%BE-%E0%A4%AD%E0%A4%BE/"><h4> माय सेफ्टी कार्ड जो कि आपको सभी वायरस और बैक्टीरिया से बचाता है</h4></a>
                                <a target="_blank" href="https://dainiktimes.co.in/%E0%A4%AE%E0%A4%BE%E0%A4%AF-%E0%A4%B8%E0%A5%87%E0%A4%AB%E0%A5%8D%E0%A4%9F%E0%A5%80-%E0%A4%95%E0%A4%BE%E0%A4%B0%E0%A5%8D%E0%A4%A1-%E0%A4%8F%E0%A4%95-%E0%A4%A8%E0%A4%AF%E0%A4%BE-%E0%A4%AD%E0%A4%BE/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://timesapplaud.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>timesapplaud.com</small></p></a>
                                <a target="_blank" href="https://timesapplaud.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card assures protection you against all bacteria and Viruses including Covid19</h4></a>
                                <a target="_blank" href="https://timesapplaud.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                                <li>
                                <a target="_blank" href="https://timesapplaud.medium.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19-690c14394b8f"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>medium.com</small></p></a>
                                <a target="_blank" href="https://timesapplaud.medium.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19-690c14394b8f"><h4>My Safety Card assures protection you against all bacteria and Viruses including Covid19</h4></a>
                                <a target="_blank" href="https://timesapplaud.medium.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19-690c14394b8f"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://indiamirror.co.in/2021/04/24/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>indiamirror.co.in</small></p></a>
                                <a target="_blank" href="https://indiamirror.co.in/2021/04/24/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://indiamirror.co.in/2021/04/24/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            <li>
                                <a target="_blank" href="http://dhunt.in/epa6m"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>dailyhunt.in</small></p></a>
                                <a target="_blank" href="http://dhunt.in/epa6m"><h4>Protection against Corona and other infections using My Safety Card is easy and effective</h4></a>
                                <a target="_blank" href="http://dhunt.in/epa6m"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                        
                            <li>
                                <a target="_blank" href="https://healthwellness.co.in/protection-against-corona-and-other-infections-using-my-safety-card-is-easy-and-effective/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>healthwellness.co.in</small></p></a>
                                <a target="_blank" href="https://healthwellness.co.in/protection-against-corona-and-other-infections-using-my-safety-card-is-easy-and-effective/"><h4>Protection against Corona and other infections using My Safety Card is easy and effective</h4></a>
                                <a target="_blank" href="https://healthwellness.co.in/protection-against-corona-and-other-infections-using-my-safety-card-is-easy-and-effective/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            <li>
                                <a target="_blank" href="https://mumbaimate.com/protection-against-corona-and-other-infections-using-my-safety-card/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>mumbaimate.com</small></p></a>
                                <a target="_blank" href="https://mumbaimate.com/protection-against-corona-and-other-infections-using-my-safety-card/"><h4>Protection Against Corona And Other Infections Using My Safety Card…</h4></a>
                                <a target="_blank" href="https://mumbaimate.com/protection-against-corona-and-other-infections-using-my-safety-card/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            <li>
                                <a target="_blank" href="https://diginews.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>diginews.co.in</small></p></a>
                                <a target="_blank" href="https://diginews.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4> Looking for protection against Corona and other viruses & bacteria for yourself and your family? My Safety Card is the solution for your worries.</h4></a>
                                <a target="_blank" href="https://diginews.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://newsbundle.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>newsbundle.co.in</small></p></a>
                                <a target="_blank" href="https://newsbundle.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses/"><h4>Unbelievable but true. My Safety Card is an effortless way of rendering protection against Coronavirus apart from other infections.  It’s a medically tested, ISO, GMP, FDA,  CE certified product. With a 99% sterilization rate, it</h4></a>
                                <a target="_blank" href="https://newsbundle.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://bollywoodtadka.co.in/%E0%A4%AE%E0%A4%BE%E0%A4%AF-%E0%A4%B8%E0%A5%87%E0%A4%AB%E0%A5%8D%E0%A4%9F%E0%A5%80-%E0%A4%95%E0%A4%BE%E0%A4%B0%E0%A5%8D%E0%A4%A1-%E0%A4%9C%E0%A5%8B-%E0%A4%95%E0%A4%BF-%E0%A4%86%E0%A4%AA%E0%A4%95/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>bollywoodtadka.co.in</small></p></a>
                                <a target="_blank" href="https://bollywoodtadka.co.in/%E0%A4%AE%E0%A4%BE%E0%A4%AF-%E0%A4%B8%E0%A5%87%E0%A4%AB%E0%A5%8D%E0%A4%9F%E0%A5%80-%E0%A4%95%E0%A4%BE%E0%A4%B0%E0%A5%8D%E0%A4%A1-%E0%A4%9C%E0%A5%8B-%E0%A4%95%E0%A4%BF-%E0%A4%86%E0%A4%AA%E0%A4%95/"><h4> माय सेफ्टी कार्ड जो कि आपको सभी वायरस और बैक्टीरिया से बचाता है</h4></a>
                                <a target="_blank" href="https://bollywoodtadka.co.in/%E0%A4%AE%E0%A4%BE%E0%A4%AF-%E0%A4%B8%E0%A5%87%E0%A4%AB%E0%A5%8D%E0%A4%9F%E0%A5%80-%E0%A4%95%E0%A4%BE%E0%A4%B0%E0%A5%8D%E0%A4%A1-%E0%A4%9C%E0%A5%8B-%E0%A4%95%E0%A4%BF-%E0%A4%86%E0%A4%AA%E0%A4%95/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://businessnation.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-04-23'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>businessnation.co.in</small></p></a>
                                <a target="_blank" href="https://businessnation.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://businessnation.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://pressnews.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-04-24'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>pressnews.co.in</small></p></a>
                                <a target="_blank" href="https://pressnews.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://pressnews.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://nationalnewsnetworks.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-04-24'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>nationalnewsnetworks.com</small></p></a>
                                <a target="_blank" href="https://nationalnewsnetworks.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://nationalnewsnetworks.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                             <li>
                                <a target="_blank" href="https://flip.it/iq_8hG/"><p><?=date('M d Y',strtotime('2021-04-24'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>flip.it</small></p></a>
                                <a target="_blank" href="https://flip.it/iq_8hG/"><h4> My Safety Card assures protection you against all bacteria and Viruses including Covid19</h4></a>
                                <a target="_blank" href="https://flip.it/iq_8hG"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://www.instapaper.com/read/1408461501"><p><?=date('M d Y',strtotime('2021-04-24'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>www.instapaper.com</small></p></a>
                                <a target="_blank" href="https://www.instapaper.com/read/1408461501"><h4>Looking for protection against Corona and other viruses & bacteria for yourself and your family? My Safety Card is the solution for your worries. </h4></a>
                                <a target="_blank" href="https://www.instapaper.com/read/1408461501"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>

                                <li>
                                <a target="_blank" href="http://blogs.rediff.com/timesapplaud/2021/05/05/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>blogs.rediff.com/timesapplaud</small></p></a>
                                <a target="_blank" href="http://blogs.rediff.com/timesapplaud/2021/05/05/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="http://blogs.rediff.com/timesapplaud/2021/05/05/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://helloentrepreneurs.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/2203/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>helloentrepreneurs.in</small></p></a>
                                <a target="_blank" href="https://helloentrepreneurs.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/2203/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://helloentrepreneurs.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/2203/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://www.scoop.it/topic/hello-entrepreneurs/p/4124617890/2021/05/05/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19-hello-entrepreneurs"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>www.scoop.it/hello</small></p></a>
                                <a target="_blank" href="https://www.scoop.it/topic/hello-entrepreneurs/p/4124617890/2021/05/05/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19-hello-entrepreneurs"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://www.scoop.it/topic/hello-entrepreneurs/p/4124617890/2021/05/05/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19-hello-entrepreneurs"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://helloentrepreneurs.tumblr.com/post/650326965358936064/my-safety-card-assures-protection-you-against-all"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>helloentrepremeurs.tumblr.com/post</small></p></a>
                                <a target="_blank" href="https://helloentrepreneurs.tumblr.com/post/650326965358936064/my-safety-card-assures-protection-you-against-all"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://helloentrepreneurs.tumblr.com/post/650326965358936064/my-safety-card-assures-protection-you-against-all"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://news.google.com/publications/CAAqBwgKMNnnpAswnPK8Aw?r=7&oc=1&hl=en-IN&gl=IN&ceid=IN:en"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>news.google.com/publications</small></p></a>
                                <a target="_blank" href="https://news.google.com/publications/CAAqBwgKMNnnpAswnPK8Aw?r=7&oc=1&hl=en-IN&gl=IN&ceid=IN:en"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://news.google.com/publications/CAAqBwgKMNnnpAswnPK8Aw?r=7&oc=1&hl=en-IN&gl=IN&ceid=IN:en"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://thenewsbharti.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>thenewsbharti.com</small></p></a>
                                <a target="_blank" href="https://thenewsbharti.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://thenewsbharti.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://thenationalage.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>thenationalage.com</small></p></a>
                                <a target="_blank" href="https://thenationalage.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://thenationalage.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://indianbusinessline.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>indianbusinessline.com</small></p></a>
                                <a target="_blank" href="https://indianbusinessline.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://indianbusinessline.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://theoneindia.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>theoneindia.in</small></p></a>
                                <a target="_blank" href="https://theoneindia.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://theoneindia.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://theprimeindia.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>theprimeindia.in</small></p></a>
                                <a target="_blank" href="https://theprimeindia.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://theprimeindia.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://truestoryindia.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>trueindiastory.com</small></p></a>
                                <a target="_blank" href="https://truestoryindia.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://truestoryindia.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://indiafirstnews.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>indiafirstnews.in</small></p></a>
                                <a target="_blank" href="https://indiafirstnews.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://indiafirstnews.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://theindianjournal.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>theindianjournal.in</small></p></a>
                                <a target="_blank" href="https://theindianjournal.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://theindianjournal.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://indiannewsmaker.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/3516/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>indiannewsmaker.com</small></p></a>
                                <a target="_blank" href="https://indiannewsmaker.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/3516/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://indiannewsmaker.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/3516/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://dailynewsindia.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1675/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>dailynewsindia.com</small></p></a>
                                <a target="_blank" href="https://dailynewsindia.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1675/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://dailynewsindia.co.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1675/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://gujpost.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1496/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>gujpost.in</small></p></a>
                                <a target="_blank" href="https://gujpost.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1496/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://gujpost.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1496/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://khabreindia.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/2430/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>khabreindia.com</small></p></a>
                                <a target="_blank" href="https://khabreindia.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/2430/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://khabreindia.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/2430/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://delhipost.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1498/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>delhipost.in</small></p></a>
                                <a target="_blank" href="https://delhipost.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1498/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://delhipost.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1498/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://dailyhindu.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/2857/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>dailyhindu.in</small></p></a>
                                <a target="_blank" href="https://dailyhindu.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/2857/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://dailyhindu.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/2857/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://mumbaipost.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1491/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>mumbaipost.in</small></p></a>
                                <a target="_blank" href="https://mumbaipost.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1491/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://mumbaipost.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1491/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://forexnewstimes.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>foxnewstimes.com</small></p></a>
                                <a target="_blank" href="https://forexnewstimes.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://forexnewstimes.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://starnewsline.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>starnewsline.com</small></p></a>
                                <a target="_blank" href="https://starnewsline.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://starnewsline.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://globalnewstonight.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>globalnewstonight.com</small></p></a>
                                <a target="_blank" href="https://globalnewstonight.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://globalnewstonight.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://newsecontent.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1498/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>newsecontent.com</small></p></a>
                                <a target="_blank" href="https://newsecontent.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1498/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://newsecontent.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/1498/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://financialnewsday.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>financialnewsday.com</small></p></a>
                                <a target="_blank" href="https://financialnewsday.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://financialnewsday.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://www.timesreporter.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>timesreporter.in</small></p></a>
                                <a target="_blank" href="https://www.timesreporter.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://www.timesreporter.in/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://biznewss.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>biznews.com</small></p></a>
                                <a target="_blank" href="https://biznewss.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://biznewss.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://inbusinesstimes.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>inbusinesstimes.com</small></p></a>
                                <a target="_blank" href="https://inbusinesstimes.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://inbusinesstimes.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://urbannewsonline.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>urbannewsonline.com</small></p></a>
                                <a target="_blank" href="https://urbannewsonline.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://urbannewsonline.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://worldnewsforall.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>worldnewsforall.com</small></p></a>
                                <a target="_blank" href="https://worldnewsforall.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://worldnewsforall.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://justnewsnow.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>justnewsnow.com</small></p></a>
                                <a target="_blank" href="https://justnewsnow.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://justnewsnow.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://newsradian.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>thenewsradian.com</small></p></a>
                                <a target="_blank" href="https://newsradian.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://newsradian.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://primenewstv.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>primenewstv.com</small></p></a>
                                <a target="_blank" href="https://primenewstv.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://primenewstv.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://latestgoldnews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>latestgoldnews.com</small></p></a>
                                <a target="_blank" href="https://latestgoldnews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://latestgoldnews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://newssupplydaily.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>newssupplydaily.com</small></p></a>
                                <a target="_blank" href="https://newssupplydaily.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://newssupplydaily.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://newstrenddaily.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>newstrenddaily.com</small></p></a>
                                <a target="_blank" href="https://newstrenddaily.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://newstrenddaily.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://rtnews24.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>rtnews24.com</small></p></a>
                                <a target="_blank" href="https://rtnews24.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://rtnews24.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://punemetronews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>punemetronews.com</small></p></a>
                                <a target="_blank" href="https://punemetronews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://punemetronews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://directdigitalnews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>directdigitalnews.com</small></p></a>
                                <a target="_blank" href="https://directdigitalnews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://directdigitalnews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://newsroombuzz.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>newsroombuzz.com</small></p></a>
                                <a target="_blank" href="https://newsroombuzz.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://newsroombuzz.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://bestnewsjournal.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>bestnewsjournal.com</small></p></a>
                                <a target="_blank" href="https://bestnewsjournal.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://bestnewsjournal.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            <li>
                                <a target="_blank" href="https://venturecompanynews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p><?=date('M d Y',strtotime('2021-05-5'))?>&nbsp;&nbsp;&nbsp; Press Releases &nbsp;&nbsp;&nbsp;<small>venturecompanynews.com</small></p></a>
                                <a target="_blank" href="https://venturecompanynews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><h4>My Safety Card Assures Protection You Against All Bacteria And Viruses Including Covid19</h4></a>
                                <a target="_blank" href="https://venturecompanynews.com/my-safety-card-assures-protection-you-against-all-bacteria-and-viruses-including-covid19/"><p style="color: blue;">read more..</p></a>
                                <hr/>
                            </li>
                            
                            
                            
                        </ul>

                    </div>
                </div>
              </div>

            </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  <div class="dt-sc-tabs-content" id="review" onclick="review()" style="display: none;">
    <div class="commentlist">
      <div class="comment-text">
        <div class="rating-review">
          <div id="shopify-product-reviews" data-id="5969999724734">
           

<div class="spr-container">
  <div class="spr-header">
    <h2 class="spr-header-title">Customer Reviews</h2><div class="spr-summary">
             <ul >
                <?php 

                $star=5;
                $hg=$average;
                $nhg=$star-$hg;
                for ($i=0; $i <$hg ; $i++) { ?>
              <li  title="<?=$i+1?> Star Out Of 5" class="starrate highlight" >★</li>
              <?php } ?>
              <?php 
                for ($j=0; $j <$nhg ; $j++) { ?>
              <li class="starrate" >★</li>
              <?php } ?>
            </ul>
        <span class="spr-summary-caption"><span class="spr-summary-actions-togglereviews">Based on <?=$countreview?> review</span>
        </span><span class="spr-summary-actions">
        <a class="spr-summary-actions-newreview" onclick="$('#reviewform').toggle()" style="cursor: pointer;">Write a review</a>
      </span>
    </div>
  </div>

  <div class="spr-content">
    <?php 
    if (isset($_SESSION['gid'])) {
        $user_id=$_SESSION['gid'];
       $gdata= mysqli_query($con1,"SELECT * FROM `Order_ent` WHERE user_id='".$user_id."'");
        if (mysqli_num_rows($gdata)) {
            $getdata=mysqli_fetch_assoc($gdata);
            $order_id=$getdata['id'];
            $item_id=$pid."/".$cid."/".$prod_id;
            $getitem=mysqli_query($con1,"SELECT * FROM `order_details` WHERE oid='".$order_id."' AND item_id='".$item_id."'");
            if (mysqli_num_rows($getitem)) {
               
            
        
     ?>
    <div class="spr-form" id="reviewform" style="display:none;">
        <form method="post" action="https://allmart.world/addreviewprocess.php" class="new-review-form" enctype= "multipart/form-data" >
        <input type="hidden" name="userid" value="<?=$_SESSION['gid']?>">            
        <input type="hidden" name="product_id" value="<?=$pid?>">            
        <input type="hidden" name="catid" value="<?=$cid?>">            
            <h3 class="spr-form-title">Write a review</h3>
            


    <fieldset class="spr-form-review">
     
      <div class="spr-form-review-rating">
        <label class="spr-form-label" for="review[rating]">Rating</label>
        <div class="spr-form-input spr-starrating ">
          <input type="hidden" name="rating" id="rating"  />
            <ul onMouseOut="resetRating();">
              <li onmouseover="highlightStar(this);" title="1 Star Out Of 5" class="star" onmouseout="removeHighlight();" onClick="addRating(this);">★</li>
              <li onmouseover="highlightStar(this);" title="2 Star Out Of 5"  class="star" onmouseout="removeHighlight();" onClick="addRating(this);">★</li>
              <li onmouseover="highlightStar(this);" title="3 Star Out Of 5"  class="star" onmouseout="removeHighlight();" onClick="addRating(this);">★</li>
              <li onmouseover="highlightStar(this);" title="4 Star Out Of 5"  class="star" onmouseout="removeHighlight();" onClick="addRating(this);">★</li>
              <li onmouseover="highlightStar(this);" title="5 Star Out Of 5"  class="star" onmouseout="removeHighlight();" onClick="addRating(this);">★</li>
            </ul>
        </div>
      </div>

      <div class="spr-form-review-body">
        <label class="spr-form-label" for="review_body_5969999724734">
          Body of Review          
        </label>
        <div class="spr-form-input">
          <textarea class="spr-form-input spr-form-input-textarea " id="review"  name="review" rows="10" placeholder="Write your comments here" required></textarea>
        </div>
      </div>
      <div class="spr-form-review-title">
        <label class="spr-form-label" for="review_title_5969999724734">Images</label>
        <input class="spr-form-input spr-form-input-text "  type="file" name="reviewimg[]"  placeholder="Give your review a images" multiple>
      </div>
    </fieldset>

    <fieldset class="spr-form-actions">
      <input type="submit" class="spr-button spr-button-primary button button-primary btn btn-primary" value="Submit Review">
    </fieldset></form></div>
<?php }}} ?>

<?php 

// $reviews=mysqli_fetch_assoc();
foreach ($getreview as $key => $review) {
    $star=5;
    $higlight=$review['rating_count'];
    $nothilight=$star-$higlight;

    $sql=mysqli_query($con1,"select * from Registration where id='".$review['user_id']."'");
    
    $sql_result=mysqli_fetch_assoc($sql);
    $username=$sql_result['Firstname']."-".$sql_result['Lastname'];
   ?>
    <div class="spr-reviews" id="reviews_5969999724734">

    <div class="spr-review" id="spr-review-105032506">
      <div class="spr-review-header">
        <div class="spr-form-input spr-starrating ">
            <ul >
                <?php 
                for ($i=0; $i <$higlight ; $i++) { ?>
              <li  title="<?=$i+1?> Star Out Of 5" class="starrate highlight" >★</li>
              <?php } ?>
              <?php 
                for ($j=0; $j <$nothilight ; $j++) { ?>
              <li  class="starrate " >★</li>
              <?php } ?>
            </ul>
        </div>
        <span class="spr-review-header-byline"><strong><?=$username?></strong> on <strong><?=date('M,d Y',strtotime($review['date_time']))?></strong></span>
      </div>

      <div class="spr-review-content">
        <p class="spr-review-content-body"><?=$review['description']?></p>
        <div class="row">
            <?php
            if($review['review_images']!=''){
            $images=explode(',', $review['review_images']);
             for ($i=0; $i <count($images) ; $i++){
      ?>
  <div class="column">  
    <img src="https://allmart.world/<?=trim($images[$i])?>" style="width:80px" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
  </div>
<?php }} ?>
  
</div>

<!-- <div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img src="img_nature_wide.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 4</div>
      <img src="img_snow_wide.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 4</div>
      <img src="img_mountains_wide.jpg" style="width:100%">
    </div>
    
    <div class="mySlides">
      <div class="numbertext">4 / 4</div>
      <img src="img_lights_wide.jpg" style="width:100%">
    </div>
    
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="column">
      <img class="demo cursor" src="img_nature_wide.jpg" style="width:100%" onclick="currentSlide(1)" alt="Nature and sunrise">
    </div>
    <div class="column">
      <img class="demo cursor" src="img_snow_wide.jpg" style="width:100%" onclick="currentSlide(2)" alt="Snow">
    </div>
    <div class="column">
      <img class="demo cursor" src="img_mountains_wide.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
    </div>
    <div class="column">
      <img class="demo cursor" src="img_lights_wide.jpg" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
    </div>
  </div>
</div> -->
      </div>
      
    </div>
  </div>

<?php } ?>

  </div>

</div>
<script>
    function highlightStar(obj) {
    removeHighlight();      
    $('.star').each(function(index) {
        $(this).addClass('highlight');
        if(index == $(".star").index(obj)) {
            return false;   
        }
    });
}

function removeHighlight() {
    $('.star').removeClass('selected');
    $('.star').removeClass('highlight');
}

function addRating(obj) {
    $('.star').each(function(index) {
        $(this).addClass('selected');
        $('#rating').val((index+1));
        if(index == $(".star").index(obj)) {
            return false;   
        }
    });
}

function resetRating() {
    if($("#rating").val()) {
        $('.star').each(function(index) {
            $(this).addClass('selected');
            if((index+1) == $("#rating").val()) {
                return false;   
            }
        });
    }
}
</script>
  

</div>
        </div>
      </div>
    </div>
  </div>

                        <!--  <div
                            class="theme-ask"
                            data-toggle="modal"
                            data-target="#ask_an_expert"
                          >
                            <button class="ask-an-expert-text btn">
                              <i class="fa fa-question-circle"></i>Have
                              Questions? Ask An Expert
                            </button>
                          </div>  -->



                              
                               <div id="shopify-section-1603253149d62f2c0d" class="shopify-section index-section home-product-grid">

                <div class="product-grid-block" style="

                          margin-top: 20px;

                          float: left;

                          width: 100%;

                          background-color: #ffffff;

                        ">

                  <div class="full">


                    <div class="product-block-inner">

                      <div class="section-header section-header--small full-position-full-left">

                        <div class="border-title">

                          <h2 class="section-header__title" style="color: #000000">

                           Related Products

                          </h2>

                        </div>

                      </div>



                      <div class="grid-uniform">
                                  <div class="grid__item product-grid-none default">
                                    <div class="product-block load-wrapper">
                                      <ul class="grid-uniform">
                                     <?php include 'pro_data_related_pro.php';?>
                                      </ul>
                                    </div>
                                  </div>

                               </div>

                    </div>

                  </div>

                </div>



              </div>

                              
                         

                          <script type="text/javascript">
                            $(document).ready(function () {
                              var related = $(".related-products");
                              related.owlCarousel({
                                loop: false,
                                nav: true,
                                navContainer: ".nav_featured",
                                navText: [
                                  '<a class="prev btn"><i class="fas fa-angle-left"></i></a>',
                                  '<a class="next btn"><i class="fas fa-angle-right"></i></a>',
                                ],
                                dots: false,
                                responsive: {
                                  0: {
                                    items: 2,
                                  },
                                  600: {
                                    items: 3,
                                  },
                                  1000: {
                                    items: 3,
                                  },
                                },
                              });
                            });
                          </script>
                      <link
                        href="https://allmart.world/assets/jquery.fancybox.min.css"
                        rel="stylesheet"
                        type="text/css"
                        media="all"
                      />
                      <script
                        src="https://allmart.world/assets/jquery.fancybox.min.js"
                        type="text/javascript"
                      ></script>
                      <script
                        src="https://allmart.world/assets/sticky-kit.min.js"
                        type="text/javascript"
                      ></script>
                      <link rel="stylesheet" href="https://allmart.world/assets/css/review.css">


                      <style>
                        .swatch .tooltip {
                          display: block;
                        }
                        .single-product-layout-type-1
                          .product-img-box.has-jcarousel
                          .product-photo-container {
                          width: 80%;
                        }
                        .media-popup iframe {
                          width: 560px;
                          height: 315px;
                          max-width: 100%;
                        }
                      </style>

                      <div
                        style="display: none"
                        id="animatedModal"
                        class="animated-modal"
                      ></div>

                      <style>
                        .product_single_detail_section #BuyNow {
                          width: 50%;
                          float: left;
                          background: #f7b111;
                          color: #000000;
                          margin-bottom: 10px;
                          margin-right: 10px;
                        }
                        .product_single_detail_section #BuyNow:hover {
                          background: #f26522;
                          color: #ffffff;
                          border-color: #f26522;
                        }
                        .product_single_detail_section #AddToCart {
                          width: 50%;
                          float: left;
                          background: #f7b111;
                          color: #000000;
                          margin-bottom: 10px;
                          margin-right: 10px;
                        }
                        .product_single_detail_section #AddToCart:hover {
                          background: #f26522;
                          color: #ffffff;
                          border-color: #f26522;
                        }
                        .product_single_detail_section .add-to-wishlist {
                          width: calc(50% - 10px);
                        }
                        .product_single_detail_section .add-to-wishlist .btn {
                        }

                        .more-view-vertical {
                          float: right;
                        }

                        .single-product-layout-type-1
                          .product-img-box
                          .wrapper-images {
                          margin-bottom: 10px;
                          float: left;
                          padding: 0;
                        }

                        @media (min-width: 767px) {
                          .product-img-box .wrapper-images {
                            float: left;
                            width: -moz-calc(100% - 90px);
                            width: -webkit-calc(100% - 90px);
                            width: -ms-calc(100% - 90px);
                            width: calc(100% - 90px);
                          }

                          .more-view-vertical {
                            width: 70px;
                            padding: 0;
                          }
                        }

                        @media (max-width: 767px) {
                          .product-img-box .wrapper-images {
                            width: 100%;
                          }
                        }

                        @media (max-width: 567px) {
                          .product_single_detail_section .add-to-wishlist {
                            width: 100%;
                          }
                          .product_single_detail_section #AddToCart {
                            width: 100%;
                          }
                        }

                        .product_single_detail_section .add-to-wishlist .btn {
                          width: 100%;
                        }

                        /*

  Styles for animated modal
  =========================

  */

                        /* Start state */
                        .animated-modal {
                          max-width: 550px;
                          border-radius: 4px;
                          overflow: hidden;

                          transform: translateY(-50px);
                          transition: all 0.7s;
                        }

                        .animated-modal h2,
                        .animated-modal p {
                          transform: translateY(-50px);
                          opacity: 0;

                          transition-property: transform, opacity;
                          transition-duration: 0.4s;
                        }

                        /* Final state */
                        .fancybox-slide--current .animated-modal,
                        .fancybox-slide--current .animated-modal h2,
                        .fancybox-slide--current .animated-modal p {
                          transform: translateY(0);
                          opacity: 1;
                        }

                        /* Reveal content with different delays */
                        .fancybox-slide--current .animated-modal h2 {
                          transition-delay: 0.1s;
                        }

                        .fancybox-slide--current .animated-modal p {
                          transition-delay: 0.3s;
                        }
                      </style>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="dt-sc-hr-invisible-large"></div>
      </main>
             

       

    
<?php } ?>
      <script src="assets/Apicall.js"></script>

      <script>
          function Spec(val)
          {

             var mrp=Math.round($("#"+val).data("mrp")).toFixed(2);
             var offprc= Math.round($("#"+val).data("offprice")).toFixed(2);
             var img= $("#"+val).data("img");
             var specifiid= $("#"+val).data("specifiid");
             var mainpath="https://allmart.world/ecom/";
            //  var discount= Math.round(1-offprc/mrp*100).toFixed(2);
            //  var discount = (offprc * 100) / mrp;
            var discount =  Math.round(((mrp - offprc) * 100) / offprc).toFixed(2);
            if(mrp!=''){

              var pricebox='<div class="product_single_price"><label>Price :</label><div class="product_price"><div class="grid-link__org_price" id="ProductPrice"><span>Rs '+offprc+'<span>&nbsp;&nbsp;</div></div> <span style="color:red"><del>₹ '+mrp+'</del> ('+discount+' % Off )</span></div>';

              var imgbox=' <div class="product-img-box"><div style="position: relative;" class="wrapper-images">   <div class="product-photo-container slider-for"  ><div class="thumb filter-chocolate-protein-powder"><a data-zoom class="fancybox" rel="gallery1" href="'+mainpath+img+'" data-fancybox="images"><img id="product-featured-image-15327177867454" src="'+mainpath+img+'" alt="<?=$pro_name?>" ></a></div></div></div><div class="slider-nav   more-view-wrapper  more-view-vertical"  data-rows="5"  data-vertical="true"  ><div class="item filter-chocolate-protein-powder"><a href="javascript:void(0)" data-image="'+mainpath+img+'" data-zoom-image="'+mainpath+img+'"><img src="'+mainpath+img+'" alt="<?=$pro_name?>"></a></div> </div></div></div></div>';

                $("#pricebox").html(pricebox);
                $("#imgbox").html(imgbox);
                $("#selectedid").val(val);
                var quntity = $("#quantity").val();
                var subtotal=Math.round(offprc*quntity).toFixed(2);
                var subtotalht='<span> Rs'+subtotal+'</span>';
                $("#totalprice").html(subtotalht);
                $("#specifiid").val(specifiid);
            }
          }
      </script>

      <script>
        var notyf = new Notyf();
    
        
        
        function buy_now(cid,prodid,price,image,pname,pid,shipping,shipping_charges)
        {
            try
            {
                var proid=$("#selectedid").val();
                 var specifiid= null;
                if(proid!=''){
                 var mrp=Math.round($("#"+proid).data("mrp")).toFixed(2);
                 var price= Math.round($("#"+proid).data("offprice")).toFixed(2);
                 var pname= $("#"+proid).data("specifiname");
                 var img= $("#"+proid).data("img");
                 var specifiid= $("#"+proid).data("specifiid");
                 var image= "https://allmart.world/ecom/"+img;
                }
    
            var quntity = $("#quantity").val();

          // if(quntity>=50)
          //   {
          //     if(prodid=='711'){
          //     price=price-50;
          //   }
          //   }
             console.log(prodid);
          console.log(price);

          var minqty = $("#minqty").val();

          if(quntity>=minqty){
            if(price!=''){
       
                $.ajax({
                    type: 'POST',
                    url:'https://allmart.world/addcart2.php',
                    data:'prodid='+prodid+'&cid='+cid+'&price='+price+'&image='+image+'&pname='+pname+'&pid='+pid+'&shipping='+shipping+'&shipping_charges='+shipping_charges+'&quantity='+quntity+'&specifiid='+specifiid,
                    success: function(msg){ debugger;
                    
                        if(msg==2)
                        {
                            notyf.error('sorry your session has been expired');
                        }
                        else if(msg==1)
                        {
                           window.location.href = "https://allmart.world/My_cart.php";
                        }
                        else
                        {
                            notyf.error('Error  Please  try again after some time');
                        }
                    }
                });
               // showcart()
             //    loadcart();
             //   showcartproduct()
            }
            else
            {
                 notyf.error('Error  Please  try again after some time');
            }
          }
          else
          {
             notyf.error('Minimum Order Is '+minqty);
          }

        }catch(exc)
        {
            alert(exc);
        }
        }
         
        
        function bulkbuy_now(cid,prodid,price,image,pname,pid,shipping,shipping_charges)
        {

            try
            {
                var proid=$("#selectedid").val();
                 var specifiid= null;
                if(proid!=''){
                 var mrp=Math.round($("#"+proid).data("mrp")).toFixed(2);
                 var price= Math.round($("#"+proid).data("offprice")).toFixed(2);
                 var pname= $("#"+proid).data("specifiname");
                 var img= $("#"+proid).data("img");
                 var specifiid= $("#"+proid).data("specifiid");
                 var image= "https://allmart.world/ecom/"+img;
                }

                var price=300;
                console.log(price);
    
            var quntity = 50;
            var shipping_charges=0;
            if(price!=''){
       
                $.ajax({
                    type: 'POST',
                    url:'https://allmart.world/addcart2.php',
                    data:'prodid='+prodid+'&cid='+cid+'&price='+price+'&image='+image+'&pname='+pname+'&pid='+pid+'&shipping='+shipping+'&shipping_charges='+shipping_charges+'&quantity='+quntity+'&specifiid='+specifiid,
                    success: function(msg){ debugger;
                    
                        if(msg==2)
                        {
                            notyf.error('sorry your session has been expired');
                        }
                        else if(msg==1)
                        {
                           window.location.href = "https://allmart.world/My_cart.php";
                        }
                        else
                        {
                            notyf.error('Error  Please  try again after some time');
                        }
                    }
                });
               // showcart()
             //    loadcart();
             //   showcartproduct()
            }
            else
            {
                 notyf.error('Error  Please  try again after some time');
            }

        }catch(exc)
        {
            alert(exc);
        }
        }
        
        
      </script>
      <script>
                function socialsharingbuttons(social, params){
                      var button= '';
                      switch (social) {
                       case 'facebook':
                        button='https://www.facebook.com/share.php?u='+params.url;
                        break;
                       case 'twitter':
                        button='https://twitter.com/share?url='+params.url+'&amp;text='+params.title+'&amp;hashtags='+params.tags;
                        break;
                       case 'google-plus':
                        button='https://plus.google.com/share?url='+params.url;
                        break;
                       case 'pinterest':
                        button='https://pinterest.com/pin/create/button/?url='+params.url+'&amp;media='+params.media;
                        break;
                        case 'instagram':
                        button='https://instagram.com/allmart.world?url='+params.url+'&amp;media='+params.media;
                        break;
                       case 'whatsapp':
                        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                         button='whatsapp://send?text='+encodeURI(params.url);
                        }else{
                         button='https://web.whatsapp.com/send?text='+params.url;
                        }
                        break;
                       case 'linkedin':
                        button='https://www.linkedin.com/shareArticle?mini=true&amp;url='+params.url;
                        break;
                       default:
                        break;
                      }
                      return button; 
                 }
                 
                 function socialsharelink(social_type,title,media){
                        var social=social_type;
                        var url_link = $("#urllink").val();
                        var params={'url':url_link, 'title':title, 'tags':'#Allmart_'+title, 'media':media};
                        
                        url = socialsharingbuttons(social, params);
                        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
                        return true;
                 }

                 function checkdelivery(){

                     var deliverypincode = $('#delivery_pincode').val();
                     var jwt_token = $("#jwt_token").val();
                     if (deliverypincode.length==6) {
                      getpindata(deliverypincode);
                     var settings = {
                                      "url": "https://apiv2.shiprocket.in/v1/external/courier/serviceability?pickup_postcode=400067&weight=10&cod=0&delivery_country=IN&delivery_postcode="+deliverypincode,
                                      "method": "GET",
                                      "timeout": 0,
                                      "headers": {
                                        "Content-Type": "application/json",
                                        "Authorization": "Bearer "+jwt_token
                                      },
                                    };
                                    
                                    $.ajax(settings).done(function (response) { debugger;
                                      console.log(response);
                                      var html = "";
                                      if(response.status==200){
                                          html = "<span style='color:green;margin-left:1%;'>Delivery Available</span>";
                                          
                                      }else{
                                          html = "<span style='color:red;margin-left:1%;'>Delivery Not Available!</span>";
                                      }
                                      $("#checkdeliveryresult").html(html);
                                    });
                                  }
                                  else
                                  {
                                    html = "<span style='color:red;margin-left:1%;'>Not a valid Pincode</span>";
                                     $("#checkdeliveryresult").html(html);

                                  }
                 }
                 
                 function shareproduct(catid,proid,proimg,pid,mid){
                          //  alert("hi:"+catid+"-"+proid+"-"+proimg+"-"+pid+"-"+mid);
                          var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                                          if (this.readyState == 4 && this.status == 200) {
                                                            //alert(this.responseText);
                                                          }
                                                        };
                            xhttp.open("POST", "https://avoservice.in/whatsapp_productshare.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send("catid="+catid+"&proid="+proid+"&proimg="+proimg+"&pid="+pid+"&mid="+mid);
                            alert("Shared Successfully");
                    
                    }
                 
      </script>

       <script>
        function getpindata(pincode)
        {
          var deliverypincode = $('#delivery_pincode').val();
          var jwt_token = $("#jwt_token").val();
          if(pincode!=''){
          var settings = {
          "url": "https://apiv2.shiprocket.in/v1/external/open/postcode/details?postcode="+pincode,
          "method": "GET",
          "timeout": 0,
          "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " +jwt_token
          },
        };
      }

        $.ajax(settings).done(function (response) {
          console.log(response);
           var status = response.success;
           if(status){
             var placedata=response.postcode_details;
             var state=placedata.state;
             var local=placedata.locality[0];


          var placedata = '<span style="color:green">'+local+' - '+state+'</span>';
           $("#placedata").html(placedata);
           }
           else
           {
             var placedata = '<span style="color:red">Not Found</span>';
           $("#placedata").html(placedata);
           }
         
        }).fail(function (response) {
          
             var placedata = '<span style="color:red">Not Found</span>';
           $("#placedata").html(placedata);
          
         
        });
        }
      </script> 


      <script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

      <!-- Facebook Pixel Code -->
          <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '953136425133953');
          fbq('track', 'PageView');
          </script>
          <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=953136425133953&ev=PageView&noscript=1"
          /></noscript>
          <!-- End Facebook Pixel Code -->

    
      <?php include 'footer.php';?>