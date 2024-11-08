<?php
session_start();
include 'head.php';

$pid = $_GET['pid'];
$cid = $_GET['catid'];

$prod_id = $_GET['prod_id'];

function get_kit_info($id, $parameter) {

    global $con1;

    $sql        = mysqli_query($con1, "select $parameter from kits where code ='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result[$parameter];

}
/*  Token  */
$qrytoken = "select token from add_ship_rocket_token where id='1'";

$result_token = mysqli_query($con1, $qrytoken);
$rowtoken    = mysqli_fetch_row($result_token);



//=================================================== query for get category which under 0 =================================================

$qrya = "select * from main_cat where id='" . $cid . "'";

$resulta = mysqli_query($con1, $qrya);
$rowa    = mysqli_fetch_row($resulta);

$aa = $rowa[2];

if ($cid == 80) {
    $maincatid = 5;
    $sql       = "select * from  `garment_product` where product_for='" . $maincatid . "' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";

} else {
    if ($aa != 0) {
        $qrya1    = "select * from main_cat where id='" . $aa . "'";
        $resulta1 = mysqli_query($con1, $qrya1);
        $rowa1    = mysqli_fetch_row($resulta1);
        $Maincate = $rowa1[4];
    }

    //=================================================================================================

    if ($Maincate == 1) {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `fashion` WHERE code='" . $pid . "'";
    } else if ($Maincate == 190) {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `electronics` WHERE code='" . $pid . "'";
    } else if ($Maincate == 218) {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `grocery` WHERE code='" . $pid . "'";
    } else if ($Maincate == 760) {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `kits` WHERE code='" . $pid . "'";
    }
    /*else if($Maincate == 757){
    $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `services` WHERE code='".$pid."'";
    }*/
    else if ($Maincate == 767) {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `promotion_product` WHERE code='" . $pid . "'";
    } else {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `products` WHERE code='" . $pid . "'";
    }
}

/*Date:26/02/2021*/
/*$descriptionQry = mysqli_query($con1,"select description,others,Long_desc,shipping_in_area from product_model where id='".$prod_id."'");*/

$descriptionQry = mysqli_query($con1, "select description,others,Long_desc from product_model where id='" . $prod_id . "'");
$desc_data      = mysqli_fetch_assoc($descriptionQry);

$qrylatfrws = mysqli_query($con1, $qrylatf);

$latstprnrws = mysqli_fetch_array($qrylatfrws);

$_shipping_charges = $latstprnrws['shipping_in_area'];

$prod         = mysqli_query($con1, "SELECT product_model FROM product_model where id='" . $latstprnrws['name'] . "'");
$product_name = mysqli_fetch_assoc($prod);

if ($Maincate == 1) {
    $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `fashion_img` WHERE `product_id`='$pid'");
} else if ($Maincate == 190) {
    $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$pid' ");
    //  $imgrow=mysqli_fetch_row($sqlimg23mn);
    //  echo "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$prod_id' order by id asc  limit 0,1";
} else if ($Maincate == 218) {
    $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `grocery_img` WHERE `product_id`='$pid' ");
} else if ($Maincate == 760) {
    $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `kits_img` WHERE `product_id`='$pid' ");
} else if ($Maincate == 657) {
    $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `service_img` WHERE `product_id`='$pid' ");
} else if ($Maincate == 767) {
    $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `promotion_product_img` WHERE `product_id`='$pid'");
} else {
    $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='$pid'");
}
global $sqlimg23mn;

while ($sltingim = mysqli_fetch_array($sqlimg23mn)) {
    $collect[] = $sltingim;
}
mysqli_data_seek($sqlimg23mn, 0);
$frtu = mysqli_fetch_array($sqlimg23mn);

if ($Maincate == 1) {
    $qry = mysqli_query($con1, "SELECT product_specification,specificationname from fashionSpecification where product_id='" . $pid . "'");
} else if ($Maincate == 190) {
    $qry = mysqli_query($con1, "SELECT product_specification,specificationname from electronicsSpecification where product_id='" . $pid . "'");
} else if ($Maincate == 218) {
    $qry = mysqli_query($con1, "SELECT product_specification,specificationname from grocerySpecification where product_id='" . $pid . "'");
}

else if ($Maincate == 767) {
    $qry = mysqli_query($con1, "SELECT product_specification,specificationname from promotion_product_Specification where product_id='" . $pid . "'");
} else {
    $qry = mysqli_query($con1, "SELECT product_specification,specificationname from productspecification where product_id='" . $pid . "'");
}

?>

                          <?php


    $categogy = $_GET['catid'];
    $prod_id  = $_GET['prod_id'];
    $cust_pid = $_GET['pid'];
    if ($categogy == '761') {

        $amount   = get_kit_info($cust_pid, 'total_amt');
        $pro_name = get_kit_info($cust_pid, 'name');
        $pro_img  = '/ecom/' . get_kit_info($cust_pid, 'photo');

        $description = get_kit_info($cust_pid, 'description');
        $long_desc   = get_kit_info($cust_pid, 'Long_desc');
        $desc_others = get_kit_info($cust_pid, 'others');
    } else {
        $amount   = $latstprnrws['total_amt'];
        $pro_name = $product_name['product_model'];
        $pro_img  = '/ecom/' . $frtu[0];
         // echo '<pre>';var_dump($amount);echo '</pre>';die;
        $description = $desc_data['description'];
        if ($description=='') {
         $description = $latstprnrws['description'];
        }

        $long_desc   = $desc_data['Long_desc']; 
        if ($long_desc=='') {
         $long_desc   = $latstprnrws['Long_desc'];
        }  
        $desc_others = $desc_data['others'];
        if ($desc_others=='') {
          $desc_others = $latstprnrws['others'];
        }
        // var_dump($description);
    }

    $amount="350.00";

    //   shipping_in_area,shipping_out_state
    if ($latstprnrws['shipping_in_area']) {
        $shipping         = 'shipping_in_area';
        $shipping_charges = $latstprnrws['shipping_in_area'];
    } else if ($latstprnrws['shipping_out_state']) {
        $shipping         = 'shipping_out_state';
        $shipping_charges = $latstprnrws['shipping_out_state'];
    } else {
        $shipping         = '';
        $shipping_charges = 0;
    }

    // var_dump($frtu);

     $s_proname=$pro_name;
    $new = str_replace(' ', '-', $s_proname);
    $pro_descri=$description;
    // $prolink="/product_detail.php?pid=".$cust_pid."&catid=".$categogy."&prod_id=".$prod_id."&prodnm=".$new;
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "https://";
    $prolink =$protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // $msg= urlencode("Buy ".$s_proname)."%0D%0A".$prolink;
    // $msg= urlencode($prolink);
    $msg= $prolink;
    ?>

 
<nav class="breadcrumb" aria-label="breadcrumbs">
        <div class="container-bg">
          <a href="index.php">Home</a>
          <input type="hidden" id="urllink" value="<?=$msg?>">

      <?php
$sqlbrdcr = mysqli_query($con1, "select * from main_cat where id ='" . $_GET['catid'] . "'");

    $fbrws = mysqli_fetch_array($sqlbrdcr);
    if ($fbrws['under'] == "0") {
        ?> <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
                        <span><a href="/product/<?=strurl($fbrws['name'])?>/<?=strcode($fbrws['id'])?>"><?php echo $fbrws['name']; ?></a></span>
                        <?php
} else {
        $exs          = 0;
        $idbrdcrmbarr = array();
        $iddbr        = $fbrws['id'];
        while ($exs == 0) {
            $sqlbrdcr2 = mysqli_query($con1, "select * from main_cat where id ='" . $iddbr . "'");
            $fbrws2    = mysqli_fetch_array($sqlbrdcr2);

            array_unshift($idbrdcrmbarr, $iddbr);
            if ($fbrws2['under'] == "0") {
                $iddbr = "0";
                $exs   = 1;
                break;
            } else {
                $iddbr = $fbrws2['under'];
            }
        }
    }
    for ($c = 0; $c < count($idbrdcrmbarr); $c++) {
        $sqlbrdcr23 = mysqli_query($con1, "select * from main_cat where id ='" . $idbrdcrmbarr[$c] . "'");
        $fbrws23    = mysqli_fetch_array($sqlbrdcr23);
        if ($c == count($idbrdcrmbarr) - 2) {
            $pcatid = $fbrws23['id'];
        }
       
        ?>
                  <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
                      <span > <a href="/product/<?=strurl($fbrws23['name'])?>/<?=strcode($fbrws23['id'])?>"><?php echo $fbrws23['name']; ?></a></span>
                      <?php
}
    ?>
                  <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
                      <span ><a href="#"><?php echo $pro_name; ?></a></span>

        </div>
      </nav>

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

        $mainpath = "/ecom/";
        // while ($sltingim = mysqli_fetch_array($sqlimg23mn)) {
        //     $collect[] = $sltingim;
        // }

        foreach ($collect as $row1) {

            ?>
                                        <div class="thumb filter-chocolate-protein-powder">
                                          <a data-zoom class="fancybox" rel="gallery1" href="<?php echo $mainpath . $row1['img']; ?>" data-fancybox="images">
                                            <img id="product-featured-image-15327177867454" src="<?php echo $mainpath . $row1['img']; ?>" alt="<?=$pro_name?>" >
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
                                        <a href="javascript:void(0)" data-image="<?php echo $mainpath . $row['img']; ?>" data-zoom-image="<?php echo $mainpath . $row['img']; ?>">
                                          <img src="<?php echo $mainpath . $row['img']; ?>" alt="<?=$pro_name?>">
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
                                  ></span>



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
                                  </div>                                
                                  
                                  
                                </div>
                                
                               
                                
                                


                                  <input
                                    type="hidden"
                                    name="form_type"
                                    value="product"
                                  /><input
                                    type="hidden"
                                    name="utf8"
                                    value="✓"
                                  />
                                  <div class="selector-wrapper-secton">
                                            <style>
                                                #AddToCartForm .selector-wrapper {
                                                display: none;
                                                }
                                                #productSelect-option-0-0 {
                                                display: none;
                                                }
                                                #productSelect-option-0-0 + .custom-style-select-box {
                                                display: none !important;
                                                }
                                            </style>

                                         
                                         <input type="hidden" id="selectedid">
                                                <input type="hidden" id="specifiid"> 
                                            <style>
                                                #AddToCartForm .selector-wrapper {
                                                display: none;
                                                }
                                                #productSelect-option-0-1 {
                                                display: none;
                                                }
                                                #productSelect-option-0-1 + .custom-style-select-box {
                                                display: none !important;
                                                }
                                            </style>




                                            </div>


                                  <!-- <div class="product-infor">
                                    <p class="product-vendor">
                                      <label>Brand :</label>
                                      <span>Groca</span>
                                    </p>

                                    <p class="product-type">
                                      <label>Product Type : </label>
                                      <span>Tea</span>
                                    </p>

                                    <p
                                      class="product-inventory"
                                      id="product-inventory"
                                    >
                                      <label>Availability : </label>
                                      <span> 40 In Stock </span>
                                    </p>

                                    <p>
                                      <label class="sku_wrapper">SKU:</label>
                                      <span
                                        class="sku variant-sku"
                                        id="product-sku"
                                      ></span>
                                    </p>
                                  </div> -->

                                  <div class="product-single__quantity" style="display: block;">
                                    <div class="quantity-box-section">
                                      <label>Quantity :</label>

                                      <div class="quantity_width">
                                        <div class="dec button">-</div>

                                        <input
                                          type="number"
                                          id="quantity"
                                          name="quantity"
                                          value="1"
                                          min="1"
                                        />

                                        <div class="inc button">+</div>

                                        <p
                                          class="min-qty-alert"
                                          style="display: none"
                                        >
                                          Minimum quantity should be 1
                                        </p>
                                      </div>
                                    </div>

                                    <div class="total-price" style="display: block;">
                                      <label>Subtotal : </label
                                      ><span id="totalprice">Rs. <?php echo $amount; ?></span>
                                    </div>
                                     <input type="hidden" id="prod_id" value="<? echo  $_GET['pid'];?>">
                                    



                               
                                <!-- <div class="progress-bar">
                                  <span class="progress bg-success" data-size=""></span>
                                </div> -->
                                    <?php if($prod_id==1427){?>
                                    <div class="certificates" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;display: block;">
                                        
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#btnShow').click(function(){
                                                    $("#dialog").show();
                                                    $("#frame").attr("src", "/ecom/userfiles/safetycard/Certificates-MySafetyCard.pdf");
                                                }); 
                                            });
                                        </script>
                                      <label>Certificates : </label>
                                      <span id="certificates" style="font-size: 18px;color: #ff6c26;">
                                          <a href="/ecom/userfiles/safetycard/Certificates-MySafetyCard.pdf" target="_blank">Show Certificates</a>
                                       <!-- <a href="#" id="btnShow">Show Certificates</a>
                                        <div id="dialog" style="display: none;">
                                            <div>
                                                <iframe id="frame"></iframe>
                                            </div>
                                        </div>-->
                                      </span>  
                                    </div>
                                    
                                    <div class="faq" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;display: block;">
                                        
                                      <label>FAQ : </label>
                                      <span id="certificates" style="font-size: 18px;color: #ff6c26;">
                                          <a href="/ecom/userfiles/safetycard/FAQ-MySafetyCard.pdf" target="_blank">Show FAQ</a>
                                       <!-- <a href="#" id="btnShow">Show Certificates</a>
                                        <div id="dialog" style="display: none;">
                                            <div>
                                                <iframe id="frame"></iframe>
                                            </div>
                                        </div>-->
                                      </span>  
                                    </div>
                                    <?php } ?> 
                                     <?php if($prod_id==1427){?>
                                    <div class="faq" style="float: left;width: 100%;font-weight: bold;margin-top: 15px;display: block;">
                                      <label>Note : </label><span style="color:red;margin:0;font-size: 15px;">The Product is Non Refundable </span>
                                    </div>
                                <!--  <p style="color:red;margin:0;">Expiry is 2 years from the Manufacturing Date </p>
                                  <p style="color:red;margin:0;">Remains Active for 30 days after Opening</p> -->
                                <?php }?>
                                    
                                    <?php 
                                       $video_qry = mysqli_query($con1, "SELECT videopath,filename FROM product_videos where productid = '" . $pid . "'");
                                       $video_data = mysqli_fetch_row($video_qry);
                                       
                                       if(!empty($video_data)){
                                           $videopath = $video_data[0];
                                           $_videopath="/ecom/".$videopath;
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
                                                          <source src="/ecom/userfiles/570/video/2021/04/<?php echo $oggfile; ?>" type="video/ogg">
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
                                        newVal = parseInt(oldValue) + 1;
                                      } else if (oldValue > 1) {
                                        newVal = parseInt(oldValue) - 1;
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
                                    <div class="col-md-6" style="display: flex;width: 68%">
                                      <input type="number" name="Pincode" placeholder="Enter Delivery Pincode" class="form-control" id="delivery_pincode">
                                    </div>
                                    <div class="col-md-3" style="display: flex;width: 32%">
                                      <input onclick="checkdelivery()" type="submit" value="Check " title="Check Delivery" class="btn btn-danger" style="margin: 10px;width:100%">
                                    </div>
                                    </div>
                                     <span id="checkdeliveryresult">
                                    </span>
                                    
                                  </div>
                                 

                                   <div class="product_button_section">
                                    

                                    <button
                                      type="submit"
                                      name="buy"
                                      id="AddToCart"
                                      class="btn"
                                      onclick="buy_now('<? echo $categogy;?>','<? echo  $_GET['pid'];?>','<? echo $amount; ?>','<? echo $pro_img;?>','<? echo urlencode($pro_name);?>','<? echo  $prod_id;?>','<?php echo $shipping; ?>','<?php echo $shipping_charges; ?>',)"
                                    >
                                      <i
                                        class="fas fa-cart-plus"
                                        aria-hidden="true"
                                      ></i
                                      ><span id="BuyNowText">Buy Now</span
                                      >
                                    </button>
                                   

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
                                    onclick="socialsharelink('facebook','<?php echo $pro_name; ?>','')">
                                      <span class="fab fa-facebook fa-2x"></span>
                                    </a>

                                    <a
                                      
                                      href="#"
                                      class="share-twitter m-2"
                                      style="margin:5px"
                                      onclick="socialsharelink('twitter','<?php echo $pro_name; ?>','')">
                                    
                                      <span class="fab fa-twitter fa-2x"></span>
                                    </a>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-pinterest m-2"
                                      style="margin:5px"
                                    onclick="socialsharelink('pinterest','<?php echo $pro_name; ?>','<?php echo $pro_img; ?>')">
                                      <span class="fab fa-pinterest fa-2x"></span>
                                    </a>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-google "
                                      style="margin:5px"
                                    onclick="socialsharelink('google-plus','<?php echo $pro_name; ?>','')">
                                      <!-- Cannot get Google+ share count with JS yet -->
                                      <span class="fab fa-google fa-2x"></span>
                                    </a>
                                    
                                    <a
                                      
                                      href="#"
                                      class="share-whatsapp m-2"
                                      style="margin:5px"
                                      onclick="socialsharelink('whatsapp','<?php echo $pro_name; ?>','')">
                                    
                                      <span class="fab fa-whatsapp fa-2x"></span>
                                    </a>
                                    
                                    <a
                                      
                                      href="#"
                                      class="share-instagram m-2"
                                      style="margin:5px"
                                      onclick="socialsharelink('instagram','<?php echo $pro_name; ?>','')">
                                    
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

                                    <a
                                      
                                      href="https://youtu.be/XdQ_8_qixPY"
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

                            <div class="grid__item">
                              <div class="product_sidebar"></div>
                            </div>
                          </div>

                          <div class="dt-sc-hr-invisible-large"></div>

                          <div class="dt-sc-tabs-container">
                            <ul class="dt-sc-tabs">
                              <li>
                                <a class="" href="#" style="pointer-events:none;"> Product Description </a>
                              </li>


                            </ul>

                            <div class="dt-sc-tabs-content rte" id="desc_pro">
                              <p>
                                <span
                                  >
                                <?php if ($long_desc != '') {?>
                                  <p class="vote"><?php echo $long_desc; ?></p>
                                <?php }?>

                                <?php if ($desc_others != '') {?>
                                  <p class="vote"><?php echo $desc_others; ?></p>
                                <?php }?></span
                                >
                              </p>
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
                        href="/assets/jquery.fancybox.min.css"
                        rel="stylesheet"
                        type="text/css"
                        media="all"
                      />
                      <script
                        src="/assets/jquery.fancybox.min.js"
                        type="text/javascript"
                      ></script>
                      <script
                        src="/assets/sticky-kit.min.js"
                        type="text/javascript"
                      ></script>


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

      <script>
          function Spec(val)
          {

             var mrp=Math.round($("#"+val).data("mrp")).toFixed(2);
             var offprc= Math.round($("#"+val).data("offprice")).toFixed(2);
             var img= $("#"+val).data("img");
             var specifiid= $("#"+val).data("specifiid");
             var mainpath="/ecom/";
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
        function add_to_card(cid,prodid,price,image,pname,pid,shipping,shipping_charges)
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
             var image= "/ecom/"+img;
            }

        var quntity = $("#quantity").val();
       if(quntity>=50)
            {
              if(prodid=='711'){
              price=price-50;
            }
            }
          console.log(prodid);
          console.log(price);
        if(price!=''){
   // alert(quntity);

        $.ajax({
        type: 'POST',
        url:'/addcart2.php',
        data:'prodid='+prodid+'&cid='+cid+'&price='+price+'&image='+image+'&pname='+pname+'&pid='+pid+'&shipping='+shipping+'&shipping_charges='+shipping_charges+'&quantity='+quntity+'&specifiid='+specifiid,
        success: function(msg){
        console.log(msg);


        if(msg==2)
        {

            notyf.error('sorry your session has been expired');
        }
        else if(msg==1)
        {
            notyf.success('Product added to cart successfully !');


        }
        else
        {
            notyf.error('Error  Please  try again after some time');

        }


            }
        });
        showcart()
        loadcart();
        showcartproduct()
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
                 var image= "/ecom/"+img;
                }
    
            var quntity = $("#quantity").val();

          if(quntity>=50)
            {
              if(prodid=='711'){
              price=price-50;
            }
            }
             console.log(prodid);
          console.log(price);
            if(price!=''){
       
                $.ajax({
                    type: 'POST',
                    url:'/addcart2.php',
                    data:'prodid='+prodid+'&cid='+cid+'&price='+price+'&image='+image+'&pname='+pname+'&pid='+pid+'&shipping='+shipping+'&shipping_charges='+shipping_charges+'&quantity='+quntity+'&specifiid='+specifiid,
                    success: function(msg){ debugger;
                    
                        if(msg==2)
                        {
                            notyf.error('sorry your session has been expired');
                        }
                        else if(msg==1)
                        {
                           window.location.href = "/checkout";
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
                     var settings = {
                                      "url": "https://apiv2.shiprocket.in/v1/external/courier/serviceability?pickup_postcode=400067&weight=10&cod=1&delivery_country=IN&delivery_postcode="+deliverypincode,
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
                                          html = "<p style='color:green;margin-left:1%;'>Available</p>";
                                          
                                      }else{
                                          html = "<p style='color:red;margin-left:1%;'>Not Available</p>";
                                      }
                                      $("#checkdeliveryresult").html(html);
                                    });
                                  }
                                  else
                                  {
                                    html = "<p style='color:red;margin-left:1%;'>Not a valid Pincode</p>";
                                     $("#checkdeliveryresult").html(html);

                                  }
                 }
      </script>

    
      <?php include 'footer.php';?>