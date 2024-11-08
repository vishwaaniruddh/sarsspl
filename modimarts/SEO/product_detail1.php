<?php
session_start();
// include('config.php');
include 'head.php';
// include('header2.php');
if (isset($_SESSION['mid'])) {
    $mid = $_SESSION['mid'];
} else {
    $mid = 0;
}

$pid = $_REQUEST['pid'];
$cid = $_REQUEST['catid'];

$prod_id = $_REQUEST['prod_id'];

function get_kit_info($id, $parameter) {

    global $con1;

    $sql        = mysqli_query($con1, "select $parameter from kits where code ='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result[$parameter];

}
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
/*else if($Maincate==757)
{
$qry=mysqli_query($con1,"SELECT product_specification,specificationname from services_Specification where product_id='".$pid."'");
}*/
else if ($Maincate == 767) {
    $qry = mysqli_query($con1, "SELECT product_specification,specificationname from promotion_product_Specification where product_id='" . $pid . "'");
} else {
    $qry = mysqli_query($con1, "SELECT product_specification,specificationname from productspecification where product_id='" . $pid . "'");
}

?>

	<!-- Start Blog Single -->
	<?php if (isset($_REQUEST['gid'])) {

    $jewellery = false;

    // $maincatid = ' in(5,10,22,27,28)';

    if ($cid == 80) {
        $maincatid = ' in(22,27,28,29)';
    } else if ($cid == 82) {
        $maincatid = ' in(8)';
    } else if ($cid == 84) {
        $maincatid = ' in(10)';
    } else if ($cid == 85) {
        $maincatid = ' in(5)';
    } else if ($cid == 117) {
        // jewellery
        $jewellery = true;
        $maincatid = ' in(19)';
    } else if ($cid == 117) {
        // jewellery
        $jewellery = true;
        $maincatid = ' in(19)';
    }

    if ($jewellery) {
        $prcode = $data['product_code'];
        $sql    = "SELECT * FROM `product` WHERE `categories_id` " . $maincatid . " and product_id=" . $_REQUEST['gid'];
        $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `product_id`=" . $_REQUEST['gid'];
    } else {
        $prcode = $data['gproduct_code'];
        $sql    = "select * from  `garment_product` where product_for " . $maincatid . " and gproduct_id=" . $_REQUEST['gid'];
        $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=" . $_REQUEST['gid'];
    }
    // $sql="select * from  `garment_product` where product_for ".$maincatid." and gproduct_id=".$_REQUEST['gid'];

    $result = mysqli_query($con1, $sql);
    $data   = mysqli_fetch_array($result);
    //print_r($data);

    if ($jewellery) {
        $prcode = $data['product_code'];

    } else {
        $prcode = $data['gproduct_code'];

    }
    $rate_qry = mysqli_query($con1, "SELECT unit_price,cost_price,quantity FROM phppos_items where name like '" . $prcode . "'");
    $rate     = mysqli_fetch_row($rate_qry);

    // $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=".$_REQUEST['gid'];
    // echo $sqlimg;
    $qryimg   = mysqli_query($con1, $sqlimg);
    $rowimg   = mysqli_fetch_row($qryimg);
    $path     = trim($pathmain . "uploads" . $rowimg[0]);
    $expl     = explode('/', $path);
    $pth1     = trim($pathmain . "mid1/" . $expl[$cnt - 1]);
    $categogy = $_REQUEST['catid'];
    $prod_id  = $_REQUEST['prod_id'];
    $amount   = $latstprnrws['total_amt'];
    $pro_img  = "http://yosshitaneha.com/" . $path;

    ?>

      <nav class="breadcrumb" aria-label="breadcrumbs">
        <div class="container-bg">
          <h1>Black Tea</h1>

          <a href="index.php">Home</a>
          <?php
$sqlbrdcr = mysqli_query($con1, "select * from main_cat where id ='" . $_REQUEST['catid'] . "'");

    $fbrws = mysqli_fetch_array($sqlbrdcr);
    if ($fbrws['under'] == "0") {
        ?>
                         <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
            						<span>
            						    <a href="product.php?catid=<?php echo $fbrws['id']; ?>&catname=<?=$fbrws['name']?>">
            						        <?php echo $fbrws['name']; ?>
            						    </a>
            						</span>
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
        							<span ><a href="product.php?catid=<?php echo $fbrws23['id']; ?>&catname=<?=$fbrws23['name']?>"><?php echo $fbrws23['name']; ?></a></span>
        							<?php
}
    ?>
                       <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
        							<span ><a href="#"><?php if ($data[3]) {echo $data[3];} else {echo $data[2];}?></a></span>

        </div>
      </nav>

      <main class="main-content">
        <div class="dt-sc-hr-invisible-small"></div>
        <?php
ob_start();
    include 'pro_data_sidebar_lable.php';
    ob_REQUEST_clean();
    ?>
        <div class="wrapper">
          <div class="grid-uniform">
            <div class="grid__item">
              <div class="container-bg">
                <div class="grid__item">
                <?php
include 'prodata_sidebar.php';
    ?>
                  <div class="second">
                    <div
                      id="shopify-section-product-template"
                      class="shopify-section"
                    >
                      <div
                        class="grid__item wide--four-fifths post-large--three-quarters"
                      >
                        <div itemscope itemtype="http://schema.org/Product">
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
                            content="#"
                          />
                          <div
                            itemprop="offers"
                            itemscope=""
                            itemtype="http://schema.org/Offer"
                          >
                            <meta itemprop="priceCurrency" content="INR" />
                            <meta itemprop="price" content="200.00" />
                            <meta
                              itemprop="itemCondition"
                              itemtype="http://schema.org/OfferItemCondition"
                              content="http://schema.org/NewCondition"
                            />
                            <meta
                              itemprop="availability"
                              content="http://schema.org/InStock"
                            />
                          </div>
                        </div>
                        <div class="single-product-layout-type-1">
                          <div class="product-single">
                            <div class="grid__item">
                              <div
                                class="grid__item wide--one-half post-large--one-half large--one-half left-sidebar-sticky"
                                data-more-view-product
                              >
                                <div class="product-img-box">
                                  <div
                                    style="position: relative"
                                    class="wrapper-images"
                                  >
                                    <div
                                      class="product-photo-container slider-for"
                                    >
                                      <div class="thumb filter-black-tea">
                                        <a
                                          data-zoom
                                          class="fancybox"
                                          rel="gallery1"
                                          href="<?=$pro_img;?>"
                                          data-fancybox="images"
                                        >
                                          <img
                                            id="product-featured-image-15326879219902"
                                            src="<?=$pro_img;?>"
                                            alt="<?=$data[3];?>"
                                          />
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div
                                class="product_single_detail_section grid__item wide--one-half post-large--one-half large--one-half"
                              >
                                <h2 class="product-single__title"><?php echo $data[3]; ?> </h2>

                                <div class="reviews-sold-in-hours">
                                  <span
                                    class="shopify-product-reviews-badge"
                                    data-id="6151883718846"
                                  ></span>

                                  <div
                                    data-soldOut-product
                                    class="sold_product"
                                    data-items="3,5,6,7,8,10,12,15"
                                    data-hours="10,15,16,17,18,20,25,35"
                                  >
                                    <svg
                                      aria-hidden="true"
                                      focusable="false"
                                      data-prefix="far"
                                      data-icon="fire"
                                      role="img"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 384 512"
                                      class="svg-inline--fa fa-fire fa-w-12 fa-2x"
                                    >
                                      <path
                                        fill="currentColor"
                                        d="M216 24.01c0-23.8-31.16-33.11-44.15-13.04C76.55 158.25 200 238.73 200 288c0 22.06-17.94 40-40 40s-40-17.94-40-40V182.13c0-19.39-21.86-30.76-37.73-19.68C30.75 198.38 0 257.28 0 320c0 105.87 86.13 192 192 192s192-86.13 192-192c0-170.29-168-192.85-168-295.99zM192 464c-79.4 0-144-64.6-144-144 0-28.66 8.56-64.71 24-88v56c0 48.52 39.48 88 88 88s88-39.48 88-88c0-64.27-88-120-64-208 40 88 152 121.77 152 240 0 79.4-64.6 144-144 144z"
                                        class=""
                                      ></path>
                                    </svg>
                                    <span class="items-count">2</span>
                                    sold in last
                                    <span class="hours-num">8</span>
                                    hours
                                  </div>
                                </div>

                                <div class="product-description rte"><?php echo $data['short_desc']; ?> </div>

                                <link href="http://schema.org/InStock" />

                                <div class="product_single_price">
                                  <label>Price :</label>

                                  <div class="product_price">
                                    <div
                                      class="grid-link__org_price"
                                      id="ProductPrice"
                                    >
                                    <span>Rs <?php echo $rate[0]; ?></span>&nbsp;&nbsp;
					    <?php if ($data['discount'] > 0) {?>
                            <span class="price-old"><del style="color:green;">Rs <?php echo $rate[0]; ?></del></span>
                        <?php }?>
                                    </div>
                                  </div>
                                </div>

                                <script>
                                  var inv_qty = {};

                                  inv_qty[37823643418814] = 40;
                                </script>

                                <p class="variant-inventory" data-size=""></p>
                                <div class="progress-bar">
                                  <span class="progress" data-size=""></span>
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
                                      #productSelect-option-0-0
                                        + .custom-style-select-box {
                                        display: none !important;
                                      }
                                    </style>

                                    <div class="swatch" data-option-index="0">
                                      <div class="header">
                                        Size
                                        <em>*</em>
                                      </div>

                                      <div class="variant-options">
                                        <div
                                          data-value="<?php echo $data[2]; ?>"
                                          class="swatch-element 3-kg available"
                                        >
                                          <input
                                            id="swatch-0-3-kg"
                                            type="radio"
                                            name="option-0"
                                            value="<?php echo $data[2]; ?>"
                                            checked
                                          />

                                          <label for="swatch-0-3-kg">
                                          <?php echo $data[2]; ?>
                                          </label>
                                        </div>

                                        <input
                                          class="text"
                                          data-value="swatch-0-<?php echo $data[2]; ?>"
                                          type="hidden"
                                          data-value-sticky="37823643418814"
                                        />
                                      </div>
                                    </div>

                                    <style>
                                      #AddToCartForm .selector-wrapper {
                                        display: none;
                                      }
                                      #productSelect-option-0-1 {
                                        display: none;
                                      }
                                      #productSelect-option-0-1
                                        + .custom-style-select-box {
                                        display: none !important;
                                      }
                                    </style>

                                    <!-- <div class="swatch" data-option-index="1">
                                      <div class="header">
                                        Flavour
                                        <em>*</em>
                                      </div>

                                      <div class="variant-options">
                                        <div
                                          data-value="Mint"
                                          class="swatch-element mint available"
                                        >
                                          <input
                                            id="swatch-1-mint"
                                            type="radio"
                                            name="option-1"
                                            value="Mint"
                                            checked
                                          />

                                          <label for="swatch-1-mint">
                                            Mint
                                          </label>
                                        </div>

                                        <input
                                          class="text"
                                          data-value="swatch-1-mint"
                                          type="hidden"
                                          data-value-sticky="37823643418814"
                                        />
                                      </div>
                                    </div> -->

                                    <!-- <select
                                      name="id"
                                      id="productSelect"
                                      class="product-single__variants"
                                    >
                                      <option
                                        selected="selected"
                                        value="37823643418814"
                                      >
                                        3 kg / Mint
                                      </option>
                                    </select> -->
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

                                  <div class="product-single__quantity">
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

                                    <div class="total-price">
                                      <label>Subtotal : </label
                                      ><span>Rs. <?php echo $rate[0]; ?></span>
                                    </div>
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

                                  <div class="grid__item notify-block"></div>

                                  <div class="product_button_section">
                                    <button
                                      type="submit"
                                      name="add"
                                      id="AddToCart"
                                      class="btn"
                                      onclick="add_to_card('<? echo $_REQUEST['catid'];?>','<?php echo $rws2['gid']; ?>','<? echo $rate[0]; ?>','<? echo $pro_img;?>','<? echo $data[3].' '.$data[2];?>','<? echo $_REQUEST['pid'];?>')"
                                    >
                                      <i
                                        class="fas fa-cart-plus"
                                        aria-hidden="true"
                                      ></i
                                      ><span id="AddToCartText"

                                        >Add to Cart</span
                                      >
                                    </button>

                                    <div class="add-to-wishlist">
                                      <div class="show">
                                        <div
                                          class="default-wishbutton-black-tea loading"
                                        >
                                          <a
                                            title="Add to wishlist"
                                            onclick="addtowishlist('<? echo $_REQUEST['catid'];?>','<?php echo $rws2['gid']; ?>','<? echo $rate[0]; ?>','<? echo $pro_img;?>','<? echo $data[3].' '.$data[2];?>','<? echo $_REQUEST['pid'];?>')"
                                            class="add-in-wishlist-js btn"
                                            href="black-tea"
                                            ><i class="far fa-heart"></i
                                            ><span class="tooltip-label"
                                              >Add to wishlist</span
                                            ></a
                                          >
                                        </div>
                                        <div
                                          class="loading-wishbutton-black-tea loading"
                                          style="
                                            display: none;
                                            text-align: center;
                                            pointer-events: none;
                                          "
                                        >
                                          <a
                                            class="add_to_wishlist btn"
                                            href="#"
                                            ><i class="fas fa-spinner"></i
                                          ></a>
                                        </div>
                                        <div
                                          class="added-wishbutton-black-tea loading"
                                          style="display: none"
                                        >
                                          <a
                                            title="View Wishlist"
                                            class="added-wishlist add_to_wishlist btn"
                                            href="#"
                                            ><i class="fas fa-heart"></i
                                            ><span class="tooltip-label"
                                              >View Wishlist</span
                                            ></a
                                          >
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      data-shopify="payment-button"
                                      class="shopify-payment-button"
                                    >
                                      <button
                                        class="shopify-payment-button__button shopify-payment-button__button--unbranded shopify-payment-button__button--hidden"
                                        disabled="disabled"
                                        aria-hidden="true"
                                      ></button
                                      ><button
                                        class="shopify-payment-button__more-options shopify-payment-button__button--hidden"
                                        disabled="disabled"
                                        aria-hidden="true"
                                      ></button>
                                    </div>
                                  </div>

                                <div class="realTime">
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
                                </div>

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
                                    <label>Share this on: </label>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-facebook m-2"
                                    >
                                      <span class="fab fa-facebook fa-2x"></span>
                                      <!--  <span class="share-title">Share</span>

        <span class="share-count">0</span>
      -->
                                    </a>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-twitter m-2"
                                    >
                                      <span class="fab fa-twitter fa-2x"></span>
                                      <!-- <span class="share-title">Tweet</span>

        <span class="share-count">0</span>
      -->
                                    </a>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-pinterest m-2"
                                    >
                                      <span class="fab fa-pinterest fa-2x"></span>
                                      <!-- <span class="share-title">Pin it</span>

          <span class="share-count">0</span>
        -->
                                    </a>

                                    <a
                                      target="_blank"
                                      href="$"
                                      class="share-google m-2"
                                    >
                                      <!-- Cannot get Google+ share count with JS yet -->
                                      <span class="fab fa-google fa-2x"></span>
                                      <!--
        <span class="share-count">+1</span>
      -->
                                    </a>
                                  </div>
                                </div>
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
                                <a class="" href="#"> Product Description </a>
                              </li>

                              <li><a class="" href="#"> Reviews </a></li>
                            </ul>

                            <div class="dt-sc-tabs-content rte" id="desc_pro">
                              <p>
                                <span
                                  >Lorem ipsum dolor sit amet, consectetur
                                  adipiscing elit, sed do eiusmod tempor
                                  incididunt ut labore et dolore magna aliqua.
                                  Ut enim ad minim veniam, quis nostrud
                                  exercitation ullamco laboris nisi ut aliquip
                                  ex ea commodo consequat. Duis aute irure dolor
                                  in reprehenderit in voluptate velit esse
                                  cillum dolore eu fugiat nulla pariatur.
                                  Excepteur sint occaecat cupidatat non
                                  proident, sunt in culpa qui officiore magna
                                  aliqua. Ut enim ad minim veniam, quis nostrud
                                  exercitation ullamco laboris nisi ut aliquip
                                  ex ea commodo consequat. Duis aute irure dolor
                                  in reprehenderit in voluptate velit esse
                                  cillumdo consequat. Duis aute irure dolor in
                                  reprehenderit in voluptate velit esse
                                  cillum.</span
                                >
                              </p>
                            </div>

                            <div class="dt-sc-tabs-content">
                              <div class="commentlist">
                                <div class="comment-text">
                                  <div class="rating-review">
                                    <div
                                      id="shopify-product-reviews"
                                      data-id="6151883718846"
                                    >
                                      <style scoped>
                                        .spr-container {
                                          padding: 24px;
                                          border-color: #ececec;
                                        }
                                        .spr-review,
                                        .spr-form {
                                          border-color: #ececec;
                                        }
                                      </style>

                                      <div class="spr-container">
                                        <div class="spr-header">
                                          <h2 class="spr-header-title">
                                            Customer Reviews
                                          </h2>
                                          <div class="spr-summary">
                                            <span
                                              class="spr-starrating spr-summary-starrating"
                                            >
                                              <i
                                                class="spr-icon spr-icon-star"
                                              ></i
                                              ><i
                                                class="spr-icon spr-icon-star"
                                              ></i
                                              ><i
                                                class="spr-icon spr-icon-star"
                                              ></i
                                              ><i
                                                class="spr-icon spr-icon-star"
                                              ></i
                                              ><i
                                                class="spr-icon spr-icon-star"
                                              ></i>
                                            </span>
                                            <span class="spr-summary-caption"
                                              ><span
                                                class="spr-summary-actions-togglereviews"
                                                >Based on 1 review</span
                                              > </span
                                            ><span class="spr-summary-actions">
                                              <a
                                                href="#"
                                                class="spr-summary-actions-newreview"
                                                onclick="SPR.toggleForm(6151883718846);return false"
                                                >Write a review</a
                                              >
                                            </span>
                                          </div>
                                        </div>

                                        <div class="spr-content">
                                          <div
                                            class="spr-form"
                                            id="form_6151883718846"
                                            style="display: none"
                                          ></div>
                                          <div
                                            class="spr-reviews"
                                            id="reviews_6151883718846"
                                          ></div>
                                        </div>
                                      </div>
                                      <script type="application/ld+json">
                                        {
                                          "@context": "http://schema.org/",
                                          "@type": "AggregateRating",
                                          "reviewCount": "1",
                                          "ratingValue": "5.0",
                                          "itemReviewed": {
                                            "@type": "Product",
                                            "name": "Black Tea",
                                            "offers": {
                                              "@type": "AggregateOffer",
                                              "lowPrice": "200.0",
                                              "highPrice": "200.0",
                                              "priceCurrency": "INR"
                                            }
                                          }
                                        }
                                      </script>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div
                            class="theme-ask"
                            data-toggle="modal"
                            data-target="#ask_an_expert"
                          >
                            <button class="ask-an-expert-text btn">
                              <i class="fa fa-question-circle"></i>Have
                              Questions? Ask An Expert
                            </button>
                          </div>

                          <?php
} else {

    $categogy = $_REQUEST['catid'];
    $prod_id  = $_REQUEST['prod_id'];
    $cust_pid = $_REQUEST['pid'];
    if ($categogy == '761') {

        $amount   = get_kit_info($cust_pid, 'total_amt');
        $pro_name = get_kit_info($cust_pid, 'name');
        $pro_img  = 'https://allmart.world/ecom/' . get_kit_info($cust_pid, 'photo');

        $description = get_kit_info($cust_pid, 'description');
        $long_desc   = get_kit_info($cust_pid, 'Long_desc');
        $desc_others = get_kit_info($cust_pid, 'others');
    } else {
        $amount   = $latstprnrws['total_amt'];
        $pro_name = $product_name['product_model'];
        $pro_img  = 'https://allmart.world/ecom/' . $frtu[0];
        //  echo '<pre>';var_dump($myimges);echo '</pre>';die;
        $description = $desc_data['description'];
        $long_desc   = $desc_data['Long_desc'];
        $desc_others = $desc_data['others'];
    }

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
    $new = str_replace(' ', '%20', $s_proname);
    $pro_descri=$description;
    $prolink="http://allmart.world/product_detail.php?pid=".$cust_pid."&catid=".$categogy."&prod_id=".$prod_id."&prodnm=".$new;
    $msg= urlencode($s_proname.$pro_descri)."%0D%0A".rawurlencode($prolink);
    ?>


<nav class="breadcrumb" aria-label="breadcrumbs">
        <div class="container-bg">
          <a href="index.php">Home</a>

		  <?php
$sqlbrdcr = mysqli_query($con1, "select * from main_cat where id ='" . $_REQUEST['catid'] . "'");

    $fbrws = mysqli_fetch_array($sqlbrdcr);
    if ($fbrws['under'] == "0") {
        ?> <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
            						<span><a href="product.php?catid=<?php echo $fbrws['id']; ?>"><?php echo $fbrws['name']; ?></a></span>
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
        /*if($c==count($idbrdcrmbarr)-1){ ?>
        <li ><a href="#"><?php echo $fbrws23['name'];?></a></li>
        <?php } else { ?>
        <li > <a href="product.php?catid=<?php echo $fbrws23['id'];?>"><?php echo $fbrws23['name'];?><i class="ti-arrow-right"></i></a></li>
        <?php }*/

        ?>
									<span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
        							<span > <a href="product.php?catid=<?php echo $fbrws23['id']; ?>"><?php echo $fbrws23['name']; ?></a></span>
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
                        <div itemscope itemtype="http://schema.org/Product">
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
                            itemtype="http://schema.org/Offer"
                          >
                            <meta itemprop="priceCurrency" content="INR" />
                            <meta itemprop="price" content="200.00" />
                            <meta
                              itemprop="itemCondition"
                              itemtype="http://schema.org/OfferItemCondition"
                              content="http://schema.org/NewCondition"
                            />
                            <meta
                              itemprop="availability"
                              content="http://schema.org/InStock"
                            />
                          </div>
                        </div>
                        <div class="single-product-layout-type-1">
                          <div class="product-single">
                            <div class="grid__item">

                              <div class="grid__item">
                               <div class="grid__item wide--one-half post-large--one-half large--one-half left-sidebar-sticky" data-more-view-product id="imgbox">
                                  <div class="product-img-box">
                                    <div style="position: relative;" class="wrapper-images">
                                      <div class="product-photo-container slider-for"  >


                                          <?php
if ($categogy != '761') {

        $mainpath = "https://allmart.world/ecom/";
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
                                     <?php } 
                                   }
                                     else
                                      {
                                        ?>
                                      <div class="thumb filter-chocolate-protein-powder">
                                          <a data-zoom class="fancybox" rel="gallery1" href="<?php echo $pro_img; ?>" data-fancybox="images">
                                            <img id="product-featured-image-15327177867454" src="<?php echo $pro_img; ?>" alt="<?=$pro_name?>" >
                                          </a>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                      </div>
                                    </div>

                                    <div class="slider-nav   more-view-wrapper  more-view-vertical"  data-rows="5"  data-vertical="true"  >

                                    <?php
                                    if($categogy != '761'){
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
                                          
                                     
                                      <div class="item filter-chocolate-protein-powder">
                                        <a href="javascript:void(0)" data-image="<?php echo $pro_img; ?>" data-zoom-image="<?php echo $pro_img; ?>">
                                          <img src="<?php echo $pro_img; ?>" alt="<?=$pro_name?>">
                                        </a>
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
                                    <?php if ($long_desc != '') {?>
                                  <p class="vote"><?php echo $long_desc; ?></p>
                                    <?php }?>

                                    <?php if ($desc_others != '') {?>
                                  <p class="vote"><?php echo $desc_others; ?></p>
                                    <?php }?>
                                    <p>
                                 </div>

                                <link href="http://schema.org/InStock" />

                                <div class="product_single_price" id="pricebox">
                                  <label>Price :</label>

                                  <div class="product_price">
                                    <div
                                      class="grid-link__org_price"
                                      id="ProductPrice"
                                    >
                                    <span>Rs <?php echo $latstprnrws['total_amt']; ?></span>&nbsp;&nbsp;

                                    </div>
                                  </div> <?php if ($latstprnrws['total_amt'] < $latstprnrws['price']) {?>
    			                         	<span style="color:red"><del>₹<?php echo $latstprnrws['price']; ?></del> (<?php echo round((1 - ($latstprnrws['total_amt'] / $latstprnrws['price'])) * 100, 0); ?> % Off )</span>
                                  <?php }?>
                                </div>

                                <script>
                                  var inv_qty = {};

                                  inv_qty[37823643418814] = 40;
                                </script>

                                <p class="variant-inventory" data-size=""></p>
                                <div class="progress-bar">
                                  <span class="progress" data-size=""></span>
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

                                            <div class="swatch" data-option-index="0">
                                                <div class="header">
                                                Variants
                                                <em>*</em>
                                                </div>
                                                 <div class="variant-options">
                                                 <?php
                                                   $qryspc=mysqli_query($con1,"SELECT * FROM `productspecification` where product_id='".$pid."'");


                                                while($prspcf=mysqli_fetch_array($qryspc))
                                                {
                                                  ?>
                                               
                                                <div data-value="<?=$prspcf['product_specification']?>" class="swatch-element 1-kg available">
                                                    <input
                                                    onclick="Spec('<?=$prspcf['product_id']?>-<?=$prspcf['id']?>-<?=$prspcf['product_specification']?>')"
                                                    id="<?=$prspcf['product_id']?>-<?=$prspcf['id']?>-<?=$prspcf['product_specification']?>"
                                                    type="radio"
                                                    data-img="<?=$prspcf['product_img']?>"
                                                    data-mrp="<?=$prspcf['product_mrp']?>"
                                                    data-offprice="<?=$prspcf['product_offerprice']?>"
                                                    data-specification="<?=$prspcf['product_specification']?>"
                                                    data-specifiname="<?=$prspcf['specificationname']?>"
                                                    data-specifiid="<?=$prspcf['id']?>"
                                                    name="option-1"
                                                    value="<?=$prspcf['product_specification']?>"
                                                    checked=""
                                                    class="variants"
                                                    />

                                                    <label for="<?=$prspcf['product_id']?>-<?=$prspcf['id']?>-<?=$prspcf['product_specification']?>"><?=$prspcf['product_specification']?> </label>
                                                </div>
                                                 
                                                <?php } ?>
                                               </div>
                                                <input type="hidden" id="selectedid">
                                                <input type="hidden" id="specifiid">
                                            </div>

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

                                  <div class="product-single__quantity">
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

                                    <div class="total-price">
                                      <label>Subtotal : </label
                                      ><span id="totalprice">Rs. <?php echo $latstprnrws['total_amt']; ?></span>
                                    </div>
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

                                  <div class="grid__item notify-block"></div>

                                  <div class="product_button_section">
                                    <button
                                      type="submit"
                                      name="add"
                                      id="AddToCart"
                                      class="btn"
                                      onclick="add_to_card('<? echo $categogy;?>','<? echo  $_REQUEST['pid'];?>','<? echo $amount; ?>','<? echo $pro_img;?>','<? echo $pro_name;?>','<? echo  $prod_id;?>','<?php echo $shipping; ?>','<?php echo $shipping_charges; ?>',)"
                                    >
                                      <i
                                        class="fas fa-cart-plus"
                                        aria-hidden="true"
                                      ></i
                                      ><span id="AddToCartText"


                                        >Add to Cart</span
                                      >
                                    </button>

                                    <div class="add-to-wishlist">
                                      <div class="show">
                                        <div
                                          class="default-wishbutton-black-tea loading"
                                        >
                                          <a
                                            title="Add to wishlist"
                                            class="add-in-wishlist-js btn"
                                            href="#"
                                            onclick="addtowishlist('<? echo $categogy;?>','<?php echo $prod_id; ?>','<? echo $amount; ?>','<? echo $pro_img;?>','<? echo $pro_name;?>','<? echo  $_REQUEST['pid'];?>')"
                                            ><i class="far fa-heart"></i
                                            ><span class="tooltip-label"

                                              >Add to wishlist</span
                                            ></a
                                          >
                                        </div>
                                        <div
                                          class="loading-wishbutton-black-tea loading"
                                          style="
                                            display: none;
                                            text-align: center;
                                            pointer-events: none;
                                          "
                                        >
                                          <a
                                            class="add_to_wishlist btn"
                                            href="#"
                                            ><i class="fas fa-spinner"></i
                                          ></a>
                                        </div>
                                        <div
                                          class="added-wishbutton-black-tea loading"
                                          style="display: none"
                                        >
                                          <a
                                            title="View Wishlist"
                                            class="added-wishlist add_to_wishlist btn"
                                            href="#"
                                            ><i class="fas fa-heart"></i
                                            ><span class="tooltip-label"
                                              >View Wishlist</span
                                            ></a
                                          >
                                        </div>
                                      </div>
                                    </div>

                                    <div
                                      data-shopify="payment-button"
                                      class="shopify-payment-button"
                                    >
                                      <button
                                        class="shopify-payment-button__button shopify-payment-button__button--unbranded shopify-payment-button__button--hidden"
                                        disabled="disabled"
                                        aria-hidden="true"
                                      ></button
                                      ><button
                                        class="shopify-payment-button__more-options shopify-payment-button__button--hidden"
                                        disabled="disabled"
                                        aria-hidden="true"
                                      ></button>
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
                                    <label>Share this on: </label>

                                    <a
                                      target="_blank"
                                      href="https://api.whatsapp.com/send?text=<?=$msg?>"
                                      class="share-facebook m-2"
                                      style="margin:5px"
                                    >
                                      <span class="fab fa-facebook fa-2x"></span>
                                      <!--  <span class="share-title">Share</span>

        <span class="share-count">0</span>
      -->
                                    </a>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-twitter m-2"
                                      style="margin:5px"
                                    >
                                      <span class="fab fa-twitter fa-2x"></span>
                                      <!-- <span class="share-title">Tweet</span>

        <span class="share-count">0</span>
      -->
                                    </a>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-pinterest m-2"
                                      style="margin:5px"
                                    >
                                      <span class="fab fa-pinterest fa-2x"></span>
                                      <!-- <span class="share-title">Pin it</span>

          <span class="share-count">0</span>
        -->
                                    </a>

                                    <a
                                      target="_blank"
                                      href="#"
                                      class="share-google "
                                      style="margin:5px"
                                    >
                                      <!-- Cannot get Google+ share count with JS yet -->
                                      <span class="fab fa-google fa-2x"></span>
                                      <!--
        <span class="share-count">+1</span>
      -->
                                    </a>
                                  </div>
                                </div>
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
                                <a class="" href="#"> Product Description </a>
                              </li>


                            </ul>

                            <div class="dt-sc-tabs-content rte" id="desc_pro">
                              <p>
                                <span
                                  ><?php echo $description; ?>
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

                          <div
                            class="theme-ask"
                            data-toggle="modal"
                            data-target="#ask_an_expert"
                          >
                            <button class="ask-an-expert-text btn">
                              <i class="fa fa-question-circle"></i>Have
                              Questions? Ask An Expert
                            </button>
                          </div>



                               <?php }?>
                               <div class="related-products-container">
                                <div class="dt-sc-hr-invisible-medium"></div>
                                <div class="section-header section-header--small">
                                  <div class="border-title">
                                    <h3 class="section-header__title">Related <span>Products</span></h3>
                                  </div>
                                  <div class="dt-sc-hr-invisible-very-small"></div>
                                </div>
                                <div class="related_products_container">
                                  <ul class="grid-uniform grid-link__container related-products owl-carousel owl-theme" >

                        <?php include 'pro_data_related_pro.php';?>
                               </ul>
                              <div class="nav_featured"></div>
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
                        href="assets/jquery.fancybox.min.css"
                        rel="stylesheet"
                        type="text/css"
                        media="all"
                      />
                      <script
                        src="assets/jquery.fancybox.min.js"
                        type="text/javascript"
                      ></script>
                      <script
                        src="assets/sticky-kit.min.js"
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
             var mainpath="https://allmart.world/ecom/";
            //  var discount= Math.round(1-offprc/mrp*100).toFixed(2);
            //  var discount = (offprc * 100) / mrp;
            var discount =  Math.round(((mrp - offprc) * 100) / offprc).toFixed(2);
            if(mrp!=''){

              var pricebox='<div class="product_single_price"><label>Price :</label><div class="product_price"><div class="grid-link__org_price" id="ProductPrice"><span>Rs '+offprc+'<span>&nbsp;&nbsp;</div></div> <span style="color:red"><del>₹ '+mrp+'</del> ('+discount+' % Off )</span></div>';


              var imgbox='<div class="StickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 156px;"><div class="product-img-box"><div class="wrapper-images" style="position: relative;"><div class="product-photo-container slider-for slick-initialized slick-slider"><div aria-live="polite" class="slick-list draggable"><div class="slick-track" role="listbox" style="opacity: 1; width: 482px;"><div aria-describedby="slick-slide00" aria-hidden="false" class="thumb filter-chocolate-protein-powder slick-slide slick-current slick-active" data-slick-index="0" role="option" style="width: 482px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;" tabindex="-1"><a class="fancybox" data-fancybox="images" data-zoom="" href="'+mainpath+img+'" rel="gallery1" tabindex="0"><img alt="<?=$pro_name?>" id="product-featured-image-15327177867454" src="'+mainpath+img+'"></a></div></div></div></div></div><div class="slider-nav more-view-wrapper more-view-vertical slick-initialized slick-slider" data-rows="5" data-vertical="true"><div aria-live="polite" class="slick-list draggable"><div class="slick-track" role="listbox" style="opacity: 1; width: 161px; transform: translate3d(0px, 0px, 0px);"><div aria-describedby="slick-slide10" aria-hidden="false" class="item filter-chocolate-protein-powder slick-slide slick-current slick-active" data-slick-index="0" role="option" style="width: 151px;" tabindex="-1"><a data-image="'+mainpath+img+'" data-zoom-image="'+mainpath+img+'" href="javascript:void(0)" tabindex="0"><img alt="<?=$pro_name?>" src="'+mainpath+img+'"></a></div></div>'


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
             var specifiid= "";
            if(proid!=''){
             var mrp=Math.round($("#"+proid).data("mrp")).toFixed(2);
             var price= Math.round($("#"+proid).data("offprice")).toFixed(2);
             var pname= $("#"+proid).data("specifiname");
             var img= $("#"+proid).data("img");
             var specifiid= $("#"+proid).data("specifiid");
             var image= "https://allmart.world/ecom/"+img;
            }

        var quntity = $("#quantity").val();
        if(price!=''){
   // alert(quntity);

        $.ajax({
        type: 'POST',
        url:'addcart2.php',
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
      </script>
      <script>

      </script>
      <?php include 'footer.php';?>