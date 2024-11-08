<?php include_once 'connect.php';?>
<?php include_once 'function.php';?>
<?php
session_start();
// var_dump($_SESSION);
if ($_SESSION['gid']) {
    $userid   = $_SESSION['gid'];
    $username = get_username($userid);
    if ($username=='') {
        $username="Geust"; 
    }
}

 function strurl($string)  
 {  
      $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($string)));  
      return $slug;  
 } 

 function strcode($code)
 {
    return $code;
 }

function getproductprice($cid, $pid)
{
    global $con1;

    $qrya = "select * from main_cat where id='" . $cid . "'";

    $resulta = mysqli_query($con1, $qrya);
    $rowa    = mysqli_fetch_row($resulta);

    $aa = $rowa[2];

    if ($cid == 80) {
        $maincatid = 5;

    } else {
        if ($aa != 0) {
            $qrya1    = "select * from main_cat where id='" . $aa . "'";
            $resulta1 = mysqli_query($con1, $qrya1);
            $rowa1    = mysqli_fetch_row($resulta1);
            $Maincate = $rowa1[4];
        }
        if ($Maincate == 1) {
            $qrylatf = "SELECT * FROM `fashion` WHERE code='" . $pid . "'";
        } else if ($Maincate == 190) {
            $qrylatf = "SELECT * FROM `electronics` WHERE code='" . $pid . "'";
        } else if ($Maincate == 218) {
            $qrylatf = "SELECT * FROM `grocery` WHERE code='" . $pid . "'";
        } else if ($Maincate == 760) {
            $qrylatf = "SELECT * FROM `kits` WHERE code='" . $pid . "'";
        } else if ($Maincate == 767) {
            $qrylatf = "SELECT  * FROM `promotion_product` WHERE code='" . $pid . "'";
        } else {
            $qrylatf = "SELECT  * FROM `products` WHERE code='" . $pid . "'";
        }
    }
    $qrylatfrws = mysqli_query($con1, $qrylatf);

    $latstprnrws = mysqli_fetch_array($qrylatfrws);
    return $latstprnrws['total_amt'];
}

function get_all_cat($cat)
{
    global $con1;
    $sql = "select * from main_cat where under ='" . $cat . "' and status=1";
    if (mysqli_query($con1, $sql)) {
        $sql = mysqli_query($con1, $sql);
        $ids = [];
        while ($sql_result = mysqli_fetch_assoc($sql)) {
            $ids[] = $sql_result['id'];
        }
        foreach ($ids as $key => $val) {
            if ($val > 0 && $val != null) {
                $ids[] = get_all_cat($val);
            }
        }
        return $ids;
    } else {

        $category[] = $cat;

        return $category;

    }

}

function filter_cat($result)
{

    $all_cat = [];

    foreach ($result as $key => $val) {

        if (!is_array($val)) {

            $all_cat[] = $val;

        } else {

            foreach ($val as $k => $v) {

                if (!is_array($v)) {

                    $all_cat[] = $v;

                } else {

                    foreach ($v as $ke => $va) {

                        $all_cat[] = $va;

                    }

                }

            }

        }

    }

    $filter = array_filter($all_cat);

    return $filter;

}

function if_top($cat)
{

    global $con1;

    $sql = mysqli_query($con1, "select * from main_cat where id='" . $cat . "' and status=1");

    $sql_result = mysqli_fetch_assoc($sql);

    $id = $sql_result['id'];

    $under = $sql_result['under'];

    if ($under == 0) {

        return $cat;

    } else {

        return 0;

    }

}

function get_top_cat($cat)
{

    global $con1;

    $sql = mysqli_query($con1, "select * from main_cat where id='" . $cat . "' and status=1");

    $sql_result = mysqli_fetch_assoc($sql);

    $under = $sql_result['under'];

    if (if_top($cat) == 0) {

        return get_top_cat($under);

    } else {

        return $cat;

    }

}

?>



<?php

function get_count($cat, $main = 0)
{

    global $con1;

    $sri = false;

    $jwel = false;

    $sringar = false;

    $sri_main = false;

    $sringar_grand_total = 0;

    $result = get_all_cat($cat);

    $sri_total = 0;

    $filter = filter_cat($result);

    $id = "'" . implode("', '", $filter) . "'";

    if (get_top_cat($cat) == 1/*|| $cat == '133' || $cat == '765'*/) {

        $table = 'fashion';

        $sri_total = 0;

        $sringar = true;

        if ($cat == 80) {

            $sri = true;

            $sringar = true;

            $sri_id = "'22','27','28','8','10','5'";

        } else if ($cat == 82) {

            $sri = true;

            $sri_id = "'8'";

            $sringar = true;

        } else if ($cat == 83) {

            $sri = true;

            $sri_id = "'27','22','28'";

            $sringar = true;

        } else if ($cat == 84) {

            $sri = true;

            $sri_id = "'10'";

            $sringar = true;

        } else if ($cat == 85) {

            $sri = true;

            $sri_id = "'5'";

            $sringar = true;

        } else if ($cat == 117) {

            $jwel = true;

            $sri_id = "1,11,12,14,15,17,18,19,20,21,22,23,24,25,26,27";

            $sringar = true;

        } else if ($cat == 79) {

            $sri_main = true;

            // $sri_id = "'22','27','28','8','10','5'";

        }

    } else if (get_top_cat($cat) == 190) {

        $table = 'electronics';

    } else if (get_top_cat($cat) == 218) {

        $table = 'grocery';

    } else if (get_top_cat($cat) == 767) {

        $table = 'promotion_product';

    } else if (get_top_cat($cat) == 799) {

        $table = 'product_model';

    }

    /*else if(get_top_cat($cat) == 757 ) {

    $table = 'services';

    }*/

    else {

        $table = 'products';

    }

    $apparel_qry = mysqli_query($con1, "SELECT count(gproduct_id) as total FROM garment_product where product_for in ('22','27','28','8','10','5') ");

    $garment_result = mysqli_fetch_assoc($apparel_qry);

    $garment_total = $garment_result['total'];

    $jewellery_qry = mysqli_query($con1, "SELECT count(product_id) as total FROM product where categories_id in (1,11,12,14,15,17,18,19,20,21,22,23,24,25,26,27) ");

    $jewellery_result = mysqli_fetch_assoc($jewellery_qry);

    $jewellery_total = $jewellery_result['total'];

    $sringar_grand_total = $garment_total + $jewellery_total;

    if ($jwel) {

        $sringar_table = 'product';

        $sringar_qry = mysqli_query($con1, "SELECT count(product_id) as total FROM product WHERE categories_id in ($sri_id)");

        $sql_result_sri = mysqli_fetch_assoc($sringar_qry);

        $sri_total = $sql_result_sri['total'];

    } else if ($sri) {

        $sringar_table = 'garment_product';

        $sringar_qry = mysqli_query($con1, "SELECT count(gproduct_id) as total FROM $sringar_table WHERE product_for in ($sri_id)");

        $sql_result_sri = mysqli_fetch_assoc($sringar_qry);

        $sri_total = $sql_result_sri['total'];

    } else if ($sri_main) {

        $sri_total = $sringar_grand_total;

    }

    $sql = mysqli_query($con1, "select count(code) as total from $table where category in ('" . $cat . "',$id) and status=1");

    if ($sql) {

        $sql_result = mysqli_fetch_assoc($sql);

        //  var_dump($sql_result); die();

        if ($main == 1 && get_top_cat($cat) == 1) {

            return $sql_result['total'] + $sringar_grand_total;

        } else {

            return $sql_result['total'] + $sri_total;

        }

    } else {

        if ($main == 1 && get_top_cat($cat) == 1) {

            return $sringar_grand_total;

        } else {

            return $sri_total;

        }

    }

}

?>





<?php

// echo get_count(198);

// return;

function categories($catid, $sub_menu)
{

    global $con1;

    $sql2     = "select * from main_cat where under ='" . $catid . "' and status=1 order by name asc LIMIT 0,3";
    $catnamee = mysqli_fetch_assoc(mysqli_query($con1, "select name from main_cat where id = '$catid' and status=1"));

    $result = mysqli_query($con1, $sql2);

    if ($result) {

        if ($sub_menu == 0) {

            echo '<div class="sub-menu-mobile menu-mb-translate">
        <div class="menu-mb-title">
                <span class="icon-dropdown">
                  <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
                SubCategory
              </div>
        <ul class="dropdown"> ';

        } else {

            echo '

        <div class="sub-menu-mobile menu-mb-translate">
              <div class="menu-mb-title">
                <span class="icon-dropdown">
                  <i class="fa fa-angle-left" aria-hidden="true"></i>
                </span>
                SubCategory
              </div>
              <ul class="dropdown">';

        }

        while ($row = mysqli_fetch_object($result)) {

            $idc = $row->id;

            $chku = mysqli_query($con1, "select * from main_cat where id ='" . $idc . "' and status=1 order by name asc ");

            $chkufr = mysqli_fetch_array($chku);

            $aa = $chkufr[2];

            if ($aa != 0) {

                $qrya1 = "select * from main_cat where id='" . $aa . "' and status=1";

                $resulta1 = mysqli_query($con1, $qrya1);

                $rowa1 = mysqli_fetch_row($resulta1);

                $Maincate = $rowa1[4];

            }

            if ($Maincate == 1) {

                $chkqrnrprodcts = mysqli_query($con1, "select * from fashion where category ='" . $idc . "' and status=1 code LIMIT 0,3");

            } else if ($Maincate == 190) {

                $chkqrnrprodcts = mysqli_query($con1, "select * from electronics where category ='" . $idc . "' and status=1 code LIMIT 0,3");

            } else if ($Maincate == 218) {

                $chkqrnrprodcts = mysqli_query($con1, "select * from grocery where category ='" . $idc . "' and status=1 code LIMIT 0,3");

            } else {

                $chkqrnrprodcts = mysqli_query($con1, "select * from products where category ='" . $idc . "' and status=1 code LIMIT 0,3");

            }
            if (!empty($chkqrnrprodcts)) {
                $cprodexs = mysqli_num_rows($chkqrnrprodcts);
            }

            $chkundrexs = mysqli_query($con1, "select * from main_cat where under ='" . $idc . "' and status=1 order by name asc");

            $chkundrexsrws = mysqli_num_rows($chkundrexs);

            $chkqrnr = mysqli_query($con1, "select * from main_cat where id ='" . $chkufr[2] . "' and status=1");

            $chkissubcat = mysqli_fetch_array($chkqrnr);

            if ($chkissubcat[2] == 0 or $chkundrexsrws > 0) {
                ?>

        <li class="menu-lv-3 inner">

                    <a   href="https://allmart.world/list/<?=strurl($row->name)?>/<?=strcode($idc)?>">

                    <?php echo $row->name; ?>
                     
                    </a>

                    <?php

                // $sub_menu = 1;

                // if(categories($row->id,$sub_menu) > 0 ){

                // categories($row->id,$sub_menu);

                // }

                ?>

                </li>

            <?php

            } else {
                ?>

            <li> 

                <a  href="https://allmart.world/list/<?=strurl($row->name)?>/<?=strcode($idc)?>">



                    <?php if (strlen($row->name) > 20) {?>

                         <span href="#" data-toggle="tooltip" title="<?php echo $row->name; ?>">

                         <?php echo $row->name . '(' . get_count($idc) . ')'; ?>

                         </span>

                    <?php } else {

                    echo $row->name . ' (' . get_count($idc) . ')';

                }

                ?>



                </a>

            </li>

        <?php }

        }
        ?>
        <li><a href="https://allmart.world/product/<?=strurl($catnamee['name'])?>/<?=strcode($catid)?>" style="color:blue;">Show More</a></li>
        <?php }
    echo '</ul>
        </div>';

}

?>
<!DOCTYPE html>

<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <link

      rel="shortcut icon"

      href="https://allmart.world/assets/logo-original.png"

      type="image/png"

    />



    <!-- Title and description ================================================== -->

  <title>Allmart</title>
  <meta charset="UTF-8">
  <meta name="description" content="Allmart.world is a technologically driven Indian e-commerce platform for buyers to browse and buy the best products at the best deal as well as for sellers to list their products and make it available. We have a wide range of products available like- FMCG, Electronics, Apparel, Accessories, Furniture, Appliances, Grocery, and more. Further, we welcome Manufacturers, Importers, Distributors, Wholesalers, Retailers, Resellers, and even NGOs from different product categories. We have a vendor friendly panel to upload products and make it available for sale on the same day itself">
  <meta name="keywords" content="Ecommerce,Allmart,Allmart.world,Shopping,">
  <meta name="author" content="Allmart.world">

    <!-- Social meta ================================================== -->

    <meta property="og:type" content="website" />
    <meta property="og:title" content="Allmart.World Ecommerce" />
    <meta property="og:url" content="https://allmart.world/" />
    <meta property="og:image" content="https://allmart.world/assets/logo.png" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:secure_url" content="https://allmart.world/assets/logo.png" />
    <meta property="og:site_name" content="Allmart.World Ecommarce" />
    <meta name="twitter:card" content="summary" />

    <!-- Helpers ================================================== -->

    <link rel="canonical" href="#" />

    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <meta name="theme-color" content="#f26522" />

    <!-- CSS ================================================== -->

    <link

      href="https://allmart.world/assets/frame.scss.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <script src="https://allmart.world/assets/sweetalert.min.js"></script>


    <link

      href="https://allmart.world/assets/home-sections.scss.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="https://allmart.world/assets/style.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />
<!--
    <link

      href="https://allmart.world/assets/videopopup.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />-->

    <link

      href="https://allmart.world/assets/slick.scss"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="https://allmart.world/assets/prettyPhoto.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="https://allmart.world/assets/animate.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="https://allmart.world/assets/font-all.min.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />



    <link

      rel="stylesheet"

      type="text/css"

      href="https://allmart.world/assets/gfontcss.css"

    />







    <link

      rel="stylesheet"

      type="text/css"

      href="https://allmart.world/assets/gfont3css.css"

    />



    <link

      rel="stylesheet"

      type="text/css"

      href="https://allmart.world/assets/gfont2css.css"

    />

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script> -->

    <link rel="stylesheet" href="https://allmart.world/assets/notyf.min.css">
    <script src="https://allmart.world/assets/notyf.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

    <style type="text/css">

        .imgBox{width: 300px;height: 300px;border: 1px solid #222;}
    </style>

    <script

      src="https://allmart.world/assets/header.js?v=10373096426439681222"

      type="text/javascript"

    ></script>

    <style type="text/css">



      .announcement-bar {

        background: #ffffff;

        float: left;

        clear: both;

        width: 100%;

      }

      .announcement-bar:empty {

        display: none;

      }

      .announcement-bar p {

        margin-bottom: 0;

        padding: 5px 0;

      }

      .announcement-bar p,

      .announcement-bar p a {

        color: #313131;

        font-size: 14px;

        font-weight: 500;

      }

      .announcement-bar p a:hover {

        color: #f7b111;

      }



      .announcement-bar {

        position: relative;

      }

      .announcement-bar .close {

        font-size: 20px;

        position: absolute;

        transform: translateY(-50%);

        top: 50%;

        right: 15px;

        width: 20px;

        height: 20px;

        line-height: 20px;

        text-align: center;

        font-weight: 100;

        color: #313131;

      }

    </style>

    <style>

      @media only screen and (min-width: 1200px) {

        /* Top block */



        .header-type-9 .top_bar {

          background: ;

        }

        .header-type-9 .top_bar li {

          color: #242424;

        }

        .header-type-9 .top_bar a {

          color: #242424;

        }

        .header-type-9 .top_bar a:hover,

        .header-type-9 .top_bar a:hover span {

          color: #ff594d;

        }



        /* .header-type-9 .top_bar li a,.header-type-9 .top_bar li span,.top-bar-type-5.top_bar .tbl-list>li.currency>.dropdown-toggle { border-right:1px solid ; }*/

        .header-type-9 .top_bar ul li:last-child,

        .header-type-9 .top_bar li:last-child span {

          border-right: none;

        }



        /* Logo block */

        .header-type-9 .site-header__menubar {

          /*background: #5f9f0d;*/
          background: #ffffff;

        }

        .header-type-9 .site-header__logo a,

        .header-type-9 .header-mobile #showLeftPush {

          color: #242424;

        }

        .header-type-9 .site-header__logo a:hover,

        .header-type-9 .header-mobile #showLeftPush:hover {

          color: #ff594d;

        }



        /* Menu  block */



        .header-type-9 .top_bar_left li i {

          color: #f7b111;

        }



        .header-type-9 .desktop-megamenu,

        .mobile-nav-section {

         /* background: #5f9f0d; */
         background: #313131;

        }

        .header-type-9 .desktop-megamenu ul > li {

          color: #ffffff;

        }

        .header-type-9 .desktop-megamenu ul > li > a,

        .mobile-nav-section .mobile-nav-trigger,

        .header-type-9 .is-sticky .header-bar__module a,

        .header-type-9 .desktop-megamenu .header-5-icon {

          color: #ffffff;

        }

        .header-type-9 .desktop-megamenu ul > li:hover > a,

        .header-type-9 .menu-tool .site-nav > li:hover > a.current {

         /* color: #f7b111; */
            color: red;

        }

        .header-type-9 .desktop-megamenu .site-nav > li > a.current {

         /* color: #f7b111; */
            color: red;
        }

        .header-type-9 .site-nav-dropdown,

        #MobileNav,

        .mobile-nav__sublist {

          background: #ffffff;

        }

        .header-type-9 .site-nav-dropdown .inner > a,

        .header-type-9 .site-nav .mega-banner .title,

        .header-type-9 .site-nav .mega-banner .regular-product {

          color: #242424;

        }

        .header-type-9 .desktop-megamenu .site-nav-dropdown .inner > a:hover,

        .header-type-9 .site-nav .mega-menu .product-item .product-title:hover {

          color: #ff594d;

        }

        .header-type-9 .desktop-megamenu .site-nav-dropdown li > a,

        .header-type-9 .menu-tool .site-nav .site-nav-dropdown li a,

        .header-type-9 .site-nav .mega-menu .product-item .product-title,

        .header-type-9 .site-nav .widget-featured-product .widget-title h3,

        #MobileNav a,

        .mobile-nav__sublist a,

        .site-nav .widget-featured-nav .owl-prev a,

        .site-nav .widget-featured-nav .owl-next a {

          color: #242424;

        }

        .header-type-9 .desktop-megamenu .site-nav-dropdown li > a.current,

        .header-type-9 .desktop-megamenu .site-nav-dropdown li:hover > a,

        .header-type-9 .menu-tool .site-nav .site-nav-dropdown li a:hover,

        .header-type-9 .site-nav-dropdown .inner .dropdown a.current,

        .header-type-9 .menu-tool .site-nav .site-nav-dropdown li a.current,

        .header-type-9 .site-nav .mega-menu .product-item .product-title:hover,

        #MobileNav a.current,

        .mobile-nav__sublist a.current,

        .site-nav .widget-featured-nav .owl-prev a:hover,

        .site-nav .widget-featured-nav .owl-next a:hover {

          color: #ff594d;

        }



        /* Dropdown block */

        .header-type-9 #Togglemodal i {

          color: #ffffff;

        }

        .header-type-9 #Togglemodal i:hover {

          color: #ff594d;

        }

        .header-type-9 #slidedown-modal {

          background: #ffffff;

        }

        .header-type-9 #slidedown-modal ul li a {

          color: #ffffff;

        }

        .header-type-9 #slidedown-modal ul li a:hover {

          color: #ff594d;

        }



        /* Search block */

        .header-type-9 .search-bar input[type="search"] {

          /*color: #858585;*/
          color: #ffffff;

        }

        .header-type-9 .header-search span {

          color: #f28c8c;

        }

        .header-type-9 .header-search span:hover {

          color: #a7b3ab;

        }



        .header-type-9 .header-search svg {

          fill: #f28c8c;

        }

        .header-type-9 .header-search svg:hover {

          fill: #a7b3ab;

        }



        .header-type-9 .search-bar__form,

        .header-type-9 #SearchDrawer,

        .header-type-9 .search-bar {

         /* background: #ffffff; */
            background: #313131;
        }



        .header-type-9

          .search-bar

          input[type="search"]::-webkit-input-placeholder {

          /* Chrome/Opera/Safari */

          color: #858585;

        }

        .header-type-9 .search-bar input[type="search"]::-moz-placeholder {

          /* Firefox 19+ */

          color: #858585;

        }

        .header-type-9 .search-bar input[type="search"]:-ms-input-placeholder {

          /* IE 10+ */

          color: #858585;

        }

        .header-type-9 .search-bar input[type="search"]:-moz-placeholder {

          /* Firefox 18- */

          color: #858585;

        }



        /* Cart Summary block */

        .header-type-9 a.icon-cart-arrow,

        .header-type-9 a.icon-cart-arrow i,

        .header-type-9 #minicart_total span {

          color: #ffffff;

        }



        .header-type-9 .header-bar__module a .detail::before {

          background: #e4e4e4;

        }



        .header-type-9 a.icon-cart-arrow:hover,

        .header-type-9 a.icon-cart-arrow:hover #minicart_total span,

        .header-type-9 a.icon-cart-arrow:hover i {

          color: #ffffff;

        }

        .header-type-9 .header_cart .baskettop a.icon-cart-arrow #cartCount {

          background: ;

          color: ;

        }



        .header-type-9 .nav-search .search-bar {

          border: none;

        }

        .header-type-9 .nav-search .search-bar input {

          border-right: none;

        }



        /* Currency block */



        .header-type-9 .lang-currency-groups .dropdown-label,

        .header-type-9 .lang-currency-groups .dropdown-toggle:after {

          color: #242424;

        }

        .header-type-9 .lang-currency-groups .dropdown-label:hover,

        .header-type-9 .lang-currency-groups .dropdown-toggle:hover::after {

          color: #ff594d;

        }

        .header-type-9 .header_currency ul li.currency:hover:after {

          border-top-color: #ff594d;

        }

        .header-type-9 .header_currency ul li.currency:after {

          border-top-color: #242424;

        }



        /* Header borders */



        .header-type-9 .menu_bar_right .customer_account li a {

          /*color: #ffffff;*/
          color: #313131;

        }



        .header-type-9 .menu_bar_right .customer_account li a:hover {

          /*color: #ffffff;*/
          /*color: #313131;*/
          color: red;

        }



        .header-type-9 .header-bar__module.cart .baskettop a.icon-cart-arrow i {

        /*  background: #70a926;
          */
          background: red;
          color: #ffffff;

        }



        .header-type-9

          .header-bar__module.cart

          .baskettop

          a.icon-cart-arrow:hover

          i {

          /*background: #f26522;*/
          background: #ffffff;
          /*color: #ffffff;*/
          color: red;
        }



        .header-type-9 .header-bar__module.cart .baskettop a.icon-cart-arrow,

        .header-type-9 .menu_bar_right a {

         /* color: #ffffff; */
            color: #313131;

        }

        .header-type-9

          .header-bar__module.cart

          .baskettop

          a.icon-cart-arrow:hover,

        .header-type-9 .menu_bar_right a:hover {

          /* color: #ffffff; */
            color: #313131;

        }



        /* General styles for all menus */



        .header-type-9 .top_bar {

          background: ;

        }

        .header-type-9 .menu_icon li {

          color: #242424;

        }



        .header-type-9 .menu_icon .right a,

        .header-type-9 .menu_icon .right button,

        .header-type-9 .menu_icon li i {

          background: #70a926;

          color: #ffffff;

        }

        .header-type-9 .menu_icon a:hover i,

        .header-type-9 button:hover,

        .header-type-9 li.init.dt-sc-toggle:hover {

          background: #f26522;

          color: #ffffff;

        }

      }

    </style>

    <style type="text/css">

      .dropdown {

        position: relative;

        display: inline-block;

      }



      .dropdown-content {

        display: none;

        position: absolute;



        min-width: 265px;

        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);

        padding: 12px 16px;

        z-index: 1;

        list-style: none;

        left: 0;

      }



      .dropdown:hover .dropdown-content {

        display: block;

      }



      @media screen and (min-width: 768px) and (max-width: 967px) {

        .dropdown-content {

          min-width: 172px;

        }

      }

      @media screen and (min-width: 968px) and (max-width: 1199px) {

        .dropdown-content {

          min-width: 213px;

        }

      }

      @media screen and (min-width: 1200px) and (max-width: 1399px) {

        .dropdown-content {

          min-width: 265px;

        }

      }



      /* Search block */



      .header-type-9 .header-all--collections ul li:not(.init) {

        background: ;

        border-color: ;

      }

      .header-type-9 .header-all--collections ul.inline-list,

      .header-type-9 .header-search input#search {

        border-color: ;

      }

      .header-type-9 .header-all--collections ul.inline-list:before {

        background: ;

      }

      .header-type-9 .header-search input#search,

      .header-type-9 .results-box {

        color: ;

        background: ;

      }

      .header-type-9 .header-search span,

      .header-type-9 .header-search .res_btn,

      .header-mobile #showLeftPush {

        color: ;

        background: none;

      }

      .header-type-9 .header-search span:hover,

      .header-type-9 .header-search .res_btn:hover,

      .header-mobile #showLeftPush:hover {

        color: ;

        background: none;

      }

      .header-type-9 .header-search button,

      .vetical-nav-with-search .dropdown {

       color: #000000;

       background: #f7b111;


      }

      .header-type-9 .header-search button:hover,

      .vetical-nav-with-search .dropdown:hover {

        color: #ffffff;

        background: #f26522;

      }

      .header-type-9 .header-all--collections {

        background: #f7b111;

        color: #000000;

      }

      */ .header-type-9 .header-all--collections ul li a {

        color: #000000;

      }

      .header-type-9 .header-search input#search::-webkit-input-placeholder {

        /* Chrome/Opera/Safari */

        color: ;

      }

      .header-type-9 .header-search input#search::-moz-placeholder {

        /* Firefox 19+ */

        color: ;

      }

      .header-type-9 .header-search input#search:-ms-input-placeholder {

        /* IE 10+ */

        color: ;

      }

      .header-type-9 .header-search input#search:-moz-placeholder {

        /* Firefox 18- */

        color: ;

      }

      /* Header borders */



      .header-type-9 .top_bar ul li:last-child,

      .header-type-11 .top_bar li:last-child span,

      .header-type-11 .top_bar li:last-child a {

        border-right: none;

      }



      .header-all--collections ul {

        height: 30px;

        width: 100%;

        float: left;

      }



      .header-all--collections ul li {

        padding: 5px 10px;

        z-index: 2;

      }



      .header-all--collections li.init {

        cursor: pointer;

      }

    </style>

    <style>

      .nav-vertical .header-logo img {

        max-height: ;

      }



      @media (min-width: 1200px) {

        .wrapper-navigation .main-menu {

          text-align: left;

        }



        .navigation-vertical-menu .mb-area .nav-bar {

          max-height: -moz-calc(100vh - 78px - 115px - 77px - 77px - 100px);

          max-height: -webkit-calc(100vh - 78px - 115px - 77px - 77px - 100px);

          max-height: -ms-calc(100vh - 78px - 115px - 77px - 77px - 100px);

          max-height: calc(100vh - 78px - 115px - 77px - 77px - 100px);

          max-height: calc(100vh - 45px - - 115px - 77px - 77px - 100px);

        }



        .site-nav .icon_sale:before {

          border-top-color: #eb440f;

        }



        .site-nav .icon_new:before {

          border-top-color: #532798;

        }



        .site-nav .icon_hot:before {

          border-top-color: #ffbb49;

        }



        .site-nav .menu-lv-1 > a,

        .site-nav .menu-mb-title {

          font-size: 16px;

        }



        .site-nav .menu-lv-2 > a,

        .site-nav .mega-menu .mega-banner .title,

        .site-nav .mega-menu .product-item .btn {

          font-size: 15px;

        }



        .site-nav .menu-lv-3 > a {

          font-size: 14px;

        }

      }



      .site-nav .icon_sale {

        background-color: #eb440f;

        color: #ffffff;

      }



      .site-nav .icon_new {

        background-color: #532798;

        color: #ffffff;

      }



      .site-nav .icon_hot {

        background-color: #ffbb49;

        color: #ffffff;

      }



      @media (max-width: 1199px) {

        .site-nav .icon_sale:before {

          border-right-color: #eb440f;

        }



        .site-nav .icon_new:before {

          border-right-color: #532798;

        }



        .site-nav .icon_hot:before {

          border-right-color: #ffbb49;

        }

      }

    </style>



    <style>

      @media (min-width: 1200px) {

        .header-lang-style2 .is-sticky .main-menu,

        .wrapper_header_default .is-sticky .main-menu {

          width: -moz-calc(100% - 112px);

          width: -webkit-calc(100% - 112px);

          width: -ms-calc(100% - 112px);

          width: calc(100% - 112px);

          margin-left: 112px;

        }

      }

    </style>

    <style>

      .lof-clock-timer-detail ul li,

      .lof-clock-timer-detail ul li span {

        color: #000000;

      }

      .banner-content .lof-clock-timer-detail li:after {

        background: #000000;

      }

      .banner-content .deal-btn .btn:hover {

        background: #f7b111 !important;

        color: #ffffff !important;

      }

    </style>

    <style>

      .home-blog-type .style2 .article-content h4 a {

        color: #000000;

        text-transform: inherit;

        font-weight: 500;

      }

      .home-blog-type .style2 .article-item:hover .article-content h4 a {

        color: #f7b111;

      }



      .home-blog-type .style2 .article-item .article-content h4:after {

        background: #f7b111;

      }

      .home-blog-type .style2 .article-content .comments-count {

        color: #000000;

      }

      .home-blog-type .style2 .comments-count:before {

        background: #000000;

      }

      .home-blog-type .style2 .article i {

        color: #000000;

      }

      .home-blog-type .style2 .blog-tag .blog-tags {

        background: #000000;

        color: #000000;

      }



      .home-blog-type .style2 .link_text {

        color: #ffffff;

      }

      .home-blog-type .style2 .link_text:hover {

        color: #ffffff;

      }



      .home-blog-type .style2 .btn {

        background: #f26522;

        color: #ffffff;

      }

      .home-blog-type .style2 .btn:hover {

        background: #5f9f0d;

        color: #ffffff;

      }

    </style>



    <style>

      .home-newsletter-block form input[type="email"] {

        color: #989898;

        border: 1px solid #e2e2e2;

      }

      .home-newsletter-block form input[type="email"]:focus {

        background-color: rgba(255, 255, 255, 0.5);

        border: 1px solid rgba(226, 226, 226, 0.5);

      }

      .home-newsletter-block

        form

        input[type="email"]::-webkit-input-placeholder {

        color: #989898;

      }

      .home-newsletter-block form input[type="email"]::-moz-placeholder {

        color: #989898;

      }

      .home-newsletter-block form input[type="email"]:-ms-input-placeholder {

        color: #989898;

      }

      .home-newsletter-block form input[type="email"]:-moz-placeholder {

        color: #989898;

      }



      /*  */

      .home-newsletter-block form .btn {

        color: #000000;

        background: #f7b111;

      }

      .home-newsletter-block form .btn:hover {

        color: #ffffff;

        background: #f26522;

      }



      .home-newsletter-block .inline-list li a {

        border: 1px solid #000000;

      }

      .home-newsletter-block .inline-list li a:hover {

        border: 1px solid #000000;

        background: #000000;

        color: #ffffff;

      }

    </style>



    <style data-shopify>

      @media only screen and (min-width: 968px) {

        .footer__item--footer-0 {

          width: 25%;

        }

      }

    </style>



    <style data-shopify>

      .footer__logo a {

        height: 53px;

      }

    </style>



    <style data-shopify>

      @media only screen and (min-width: 968px) {

        .footer__item--footer-1 {

          width: 17%;

        }

      }

    </style>



    <style data-shopify>

      @media only screen and (min-width: 968px) {

        .footer__item--1603353091214 {

          width: 17%;

        }

      }

    </style>



    <style data-shopify>

      @media only screen and (min-width: 968px) {

        .footer__item--1603353109370 {

          width: 17%;

        }

      }

    </style>



    <style data-shopify>

      @media only screen and (min-width: 968px) {

        .footer__item--675340cb-1af9-417c-9f2f-ac3d5a5f75f1 {

          width: 24%;

        }

      }

    </style>



    <style>

      .footer-default .footer__newsletter .btn {

        background: #f26522;

        color: #ffffff;

      }

      .footer-default .footer__newsletter .btn:hover {

        background: #5f9f0d;

        color: #ffffff;

      }

      .footer-default h4 {

        color: #313131;

      }

      .footer-default,

      .footer-default p {

        color: #626262;

        font-weight: 500;

      }

      .footer-default li a {

        color: #626262;

      }

      .footer-default li a:hover {

        color: #5f9f0d;

      }

      .footer-default span,

      .footer-default .address-block h3 {

        color: #89c74a;

      }

      footer.footer-default .contact-info h4 {

        color: #626262;

      }

    </style>



    <style>

      .product-notification {

        left: 0;

      }



      .product-notification.active {

        left: 15px;

      }

    </style>

  </head>



  <body id="Allmart" class="template-index others">

    <div

      id="shopify-section-top-countdown-bar"

      class="shopify-section index-section"

    >

      <div

        data-section-id="top-countdown-bar"

        data-section-type="top-countdown-bar"

        class="top-countdown-bar"

      ></div>

    </div>

    <!-- <div

      id="shopify-section-announcement-bar"

      class="shopify-section announcement-bar"

    >

      <p class="text-center">

        <a href="javascript:void(0)" class="close"

          ><i class="fas fa-times-circle"></i></a

        >Free worldwide shipping on order over $50

      </p>



      <script type="text/javascript">

        if (jQuery.cookie("announcementCookie") == "closed") {

          jQuery(".announcement-bar").hide();

        }

        jQuery(".announcement-bar a.close").bind("click", function () {

          console.log("activated");

          jQuery(".announcement-bar").fadeOut();

          jQuery.cookie("announcementCookie", "closed", {

            expires: 1,

            path: "/",

          });

        });

      </script>

    </div> -->



    <div class="shifter-page is-moved-by-drawer" id="PageContainer">

      <div class="quick-view"></div>



      <div class="wrapper-header wrapper-container">

        <div class="header-type-9">

          <header class="site-header header-default">

            <div class="header-sticky">

              <div id="header-landing" class="sticky-animate">

                <div

                  id="shopify-section-header-model-9"

                  class="shopify-section"

                >

                  <div class="grid--full site-header__menubar">

                    <div class="container-bg">

                      <a

                        href="#"

                        class="icon-nav close-menu-mb"

                        title="Menu Mobile Icon"

                        data-menu-mb-toogle

                      >

                        <span class="icon-line"></span>

                      </a>



                      <div

                        class="grid__item menubar_inner header-bottom"

                        data-sticky-mb

                      >

                        <div class="wrapper-header-bt">

                          <div class="header-mb">

                            <div class="header-mb-left header-mb-items">

                              <div class="hamburger-icon svg-mb">

                                <a

                                  href="#"

                                  class="icon-nav"

                                  title="Menu Mobile Icon"

                                  data-menu-mb-toogle

                                >

                                  <span class="icon-line"></span>

                                </a>

                              </div>

                            </div>



                            <div class="header-mb-middle header-mb-items">

                              <div class="header-logo">

                                <h1

                                  class="site-header__logo"



                                >

                                  <a href="https://allmart.world/" style="max-width: 100px">

                                    <img

                                      class="normal-logo"

                                      src="https://allmart.world/assets/logo.png"

                                      alt="Allmart"

                                      itemprop="logo"
                                      style="background: white;border-radius: 50%;"

                                    />

                                  </a>

                                </h1>

                              </div>

                            </div>



                            <div class="header-mb-right header-mb-items">

                              <div class="cart-icon svg-mb">

                                <a href="#" title="Cart Icon" data-cart-toggle>

                                  <svg

                                    version="1.1"

                                    id="Capa_1"

                                    xmlns="https://www.w3.org/2000/svg"

                                    xmlns:xlink="https://www.w3.org/1999/xlink"

                                    x="0px"

                                    y="0px"

                                    viewBox="0 0 489 489"

                                    style="enable-background: new 0 0 489 489"

                                    xml:space="preserve"

                                  >

                                    <g>

                                      <path

                                        d="M440.1,422.7l-28-315.3c-0.6-7-6.5-12.3-13.4-12.3h-57.6C340.3,42.5,297.3,0,244.5,0s-95.8,42.5-96.6,95.1H90.3

                    c-7,0-12.8,5.3-13.4,12.3l-28,315.3c0,0.4-0.1,0.8-0.1,1.2c0,35.9,32.9,65.1,73.4,65.1h244.6c40.5,0,73.4-29.2,73.4-65.1

                    C440.2,423.5,440.2,423.1,440.1,422.7z M244.5,27c37.9,0,68.8,30.4,69.6,68.1H174.9C175.7,57.4,206.6,27,244.5,27z M366.8,462

                    H122.2c-25.4,0-46-16.8-46.4-37.5l26.8-302.3h45.2v41c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h139.3v41

                    c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h45.2l26.9,302.3C412.8,445.2,392.1,462,366.8,462z"

                                      ></path>

                                    </g>

                                  </svg>


                                  <?php
$userid = $_SESSION['gid'];
if ($_SESSION['gid'] == '') {$userid = $_SESSION['geust_id'];}
$qryc      = mysqli_query($con1, "select* from cart where user_id='" . $userid . "' and status=0");
$countcart = mysqli_num_rows($qryc);
?>
                                  <span class="cartCount" id="cartCount">
                                  <?=$countcart?>
                                  </span>

                                </a>

                              </div>

                            </div>

                          </div>

                          <div class="header-pc">

                            <div class="header-panel-top">

                              <div class="menu_icon_section">

                                <h1

                                  class="site-header__logo order-header post-large--hide large--hide medium-down--hide"

                                >

                                  <a

                                    href="https://allmart.world/"

                                    itemprop="url"



                                  >

                                    <img

                                      class="normal-logo"

                                      src="https://allmart.world/assets/logo.png"

                                      alt="Allmart"
                                        style="background: white;border-radius: 50%;"


                                    />

                                  </a>

                                </h1>

                                <li

                                  class="nav-search post-large--hide large--hide medium-down--hide"

                                >

                                  <div

                                    class="search-form search_type1"

                                    data-ajax-search

                                  >

                                    <div class="header-search">

                                      <div class="header-search__form">

                                        <form

                                          action="search_result.php"

                                          method="get"

                                          class="search-bar"

                                          role="search"

                                        >




                                          <input

                                            type="search"

                                            name="search"

                                            placeholder="Search here..."

                                            class="input-group-field header-search__input"

                                            aria-label="Search Site"

                                            autocomplete="off"

                                          />



                                          <button

                                            type="submit"

                                            class="btn icon-search"

                                            value="Search"

                                          >

                                            Search

                                          </button>

                                        </form>

                                      </div>



                                    </div>

                                  </div>

                                </li>



                                <div class="menu_icon_container">

                                  <ul

                                    class="menu_icon grid__item wide--one-sixth post-large--one-sixth large--one-sixth"

                                  >

                                    <li

                                       class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide"

                                    >
                                     <div class="baskettop" style="font-size: 76%;">

                                      <?
if ($_SESSION['gid']) {
    ?>
                                                <a href="https://allmart.world/MyAccount/" title="My-Account">
                                                <?php

    echo $username;
    ?>
                                                  </a></br><a href="https://allmart.world/logout.php">Logout</a>
                                                  <?php
} else {
    ?>
                                                <a href="https://allmart.world/login.php" title="Login">Login / Register</a>
                                                <?php
}
?>
                                              </p><a href="https://allmart.world/franchise/home.php">Franchise</a></p>

                                      </div>
<!--
                                      <ul class="menu_bar_right">

                                        <li class="customer_account">

                                          <div class="header-account_links">

                                            <ul>

                                              <li style="font-size: 76%;">



                                                  <?
if ($_SESSION['gid']) {
    ?>
                                                <a href="#" title="My-Account">
                                                <?php

    echo $username;
    ?>
                                                  </a></br><a href="logout.php">Logout</a>
                                                  <?php
} else {
    ?>
                                                <a href="login.php" title="Login">Login / Register</a>
                                                <?php
}
?>



                                                  </p><a href="https://allmart.world/franchise/home.php">Franchise</a></p>

                                              </li>

                                            </ul>

                                          </div>

                                        </li>

                                      </ul> -->

                                    </li>


                                    <li

                                      class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide"

                                    >

                                      <!-- Mini Cart Start -->

                                      <div class="baskettop">

                                      <a href="wishlist.php" class="icon-cart-arrow cart-icon" title="Wishlist" > <i class="fas fa-heart"></i>

                                          <p>

                                          </p>




                                        </a>

                                      </div>

                                    </li>
                                    <li

                                      class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide"

                                    >

                                      <!-- Mini Cart Start -->

                                      <div class="baskettop">

                                        <a

                                          href="#"

                                          class="icon-cart-arrow cart-icon"

                                          data-cart-toggle
                                          title="My Cart"

                                        >

                                          <i class="fas fa-shopping-bag"></i>

                                          <p>

                                            My Cart<br />

                                            <span

                                              id="cartCount1"
                                              class="cartCount"

                                              data-cart-count
                                              style="width:45%"

                                            >

                                                <?=$countcart?>


                                            </span><span class="cartCountspan" style="width:50%;"

                                              >Item</span

                                            >

                                          </p>


                                        </a>

                                      </div>

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

                <div class="desktop-megamenu">

                  <div class="container-bg">

                  <div id="shopify-section-vmenu" class="shopify-section vetical-nav-with-search"><div class="grid-uniform">



<div class="grid__item">






<!--
     <div class="dropdown">

    <span id="dropbtn" class="dropdown"><i class="fa fa-bars"></i>Main Categories </span>

    <ul class="parent dropdown-content" id="dropdown-content" style="overflow: hidden; display: none;">

                            <?php

// $sql23 = mysqli_query($con1,"select * from main_cat where under ='0' and name!='Resale' and status=1 order by name");

//    $grand_total = 0;

//    while($result23 =mysqli_fetch_array($sql23))

//      {

?>

                                <li class="cat-item cat-item-39 cat-parent dropdown-menu">

                                    <?php //if($result23[0]==803){?>

                                <a class="nav-link" href="new_product.php?catid=<?php // echo $result23[0];?>" >

                                  <?php // echo $result23['name'];?>

                            </a>

                                    <?php

//   }else{

?>

                                <a class="nav-link" href="#<?php // echo $result23[0];?>" >

                                  <?php

// echo $result23['name'];

?>

                            </a>

                               

                                <?php // }?>

                                </li>



                                <?php // } ?>



  </div>  -->





</div>



</div>

<style type="text/css">



.dropdown {

position: relative;

display: inline-block;

}



.dropdown-content {

display: none;

position: absolute;



min-width: 265px;

box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

padding: 12px 16px;

z-index: 1;

list-style:none;

left:0;

}



.dropdown:hover .dropdown-content {

display: block;

}



@media screen and (min-width: 768px) and (max-width: 967px){ .dropdown-content{min-width: 172px; } }

@media screen and (min-width: 968px) and (max-width: 1199px){ .dropdown-content{min-width: 213px; } }

@media screen and (min-width: 1200px) and (max-width: 1399px){ .dropdown-content{min-width: 265px; } }



/* Search block */



.header-type-9 .header-all--collections ul li:not(.init){ background:; border-color:}

.header-type-9 .header-all--collections ul.inline-list,.header-type-9 .header-search input#search{ border-color:}

.header-type-9 .header-all--collections ul.inline-list:before{ background:}

.header-type-9 .header-search input#search,.header-type-9 .results-box {color:;background:;}

  .header-type-9 .header-search span, .header-type-9 .header-search .res_btn,.header-mobile #showLeftPush  {color:;background:none;}

  .header-type-9 .header-search span:hover, .header-type-9 .header-search .res_btn:hover,.header-mobile #showLeftPush:hover {color:;background:none;}

  .header-type-9 .header-search button,.vetical-nav-with-search .dropdown { /*color:#000000;background:#f7b111; */color:#ffffff;background:red;}

  .header-type-9 .header-search button:hover,.vetical-nav-with-search .dropdown:hover { color:#ffffff;background:#f26522;}

 .header-type-9 .header-all--collections { background:#f7b111;color:#000000;}*/

  .header-type-9 .header-all--collections ul li a { color:#000000; }

  .header-type-9 .header-search input#search::-webkit-input-placeholder  { /* Chrome/Opera/Safari */

    color:;

  }

  .header-type-9 .header-search input#search::-moz-placeholder { /* Firefox 19+ */

    color:;

  }

  .header-type-9 .header-search input#search:-ms-input-placeholder { /* IE 10+ */

    color:;

  }

  .header-type-9 .header-search input#search:-moz-placeholder { /* Firefox 18- */

    color:;

  }

 /* Header borders */



  .header-type-9 .top_bar ul li:last-child,.header-type-11 .top_bar li:last-child span,.header-type-11 .top_bar li:last-child a { border-right:none; }



  .header-all--collections ul {

    height: 30px;

    width: 100%;float:left;



  }



  .header-all--collections ul li { padding: 5px 10px; z-index: 2; }



  .header-all--collections li.init { cursor: pointer; }





</style>



<script type="text/javascript">

$( "#dropbtn" ).click(function() {

$(this).toggleClass('open');

$( "#dropdown-content" ).slideToggle( "slow", function() {

  // Animation complete.

});

});

</script>



</div>

                    <div

                      id="shopify-section-navigation-etc"

                      class="shopify-section"

                    >

                      <div class="wrapper-navigation" data-sticky-pc>

                        <div class="main-menu jas-mb-style">

                          <div class="row">

                            <div class="col-12">

                              <div class="mb-area">

                                <div class="nav-search wide--hide">

                                  <div

                                    class="search-form search_type1"

                                    data-ajax-search

                                  >

                                    <div class="header-search">

                                      <div class="header-search__form">

                                        <form

                                          action="search_result.php"

                                          method="get"

                                          class="search-bar"

                                          role="search"

                                        >




                                          <input

                                            type="search"

                                            name="search"

                                            placeholder="Search here..."

                                            class="input-group-field header-search__input"

                                            aria-label="Search Site"

                                            autocomplete="off"

                                          />



                                          <button

                                            type="submit"

                                            class="btn icon-search"

                                            value="Search"

                                          >

                                            Search

                                          </button>

                                        </form>

                                      </div>



                                    </div>

                                  </div>

                                </div>

                                <div class="left">

                                  <nav class="nav-bar" role="navigation">

                                    <ul class="site-nav checking">

                                    <!--  <li class="menu-lv-1 item">

                                        <a class="current" href="index.php"> Home </a>

                                      </li> -->

                                      <li class="menu-lv-1 item dropdown mega-menu">
                                        <a class="menu__moblie" href="#">
                                          All Categories
                                          <span class="icon-dropdown" data-toggle-menu-mb>
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                          </span>
                                        </a>
                                        <div class="sub-menu-mobile menu-mb-translate">
                                          <div class="menu-mb-title">
                                            <span class="icon-dropdown">
                                              <i class="fa fa-angle-left" aria-hidden="true"></i>
                                            </span>
                                            All Categories
                                          </div>
                                          <div class="site-nav-dropdown style_5">
                                            <div class="container">
                                              <div class=""   data-masonry='{ "itemSelector": "[data-gridItem]", "columnWidth": ".grid-sizer" }'
                                              >
                                                <div class="grid-sizer"></div>

                                                  <!-- Menu level 2 -->

                                                  <?php

                                                    $sql23 = mysqli_query($con1, "select * from main_cat where under ='0' and name!='Resale' and status=1 order by name limit 0,8");

                                                    $grand_total = 0;

                                                    while ($result23 = mysqli_fetch_array($sql23)) {
                                                        ?>

                                                              <div data-gridItem class="menu-lv-2 inner dropdown col-12 col-xl-3">

                                                                  <?php if ($result23[0] == 803) {
                                                                        ?>

                                                                    <a class="menu__moblie"  class="current" href="https://allmart.world/list/<?=strurl($result23['name'])?>/<?=strcode($result23[0])?>">

                                                                      <?php echo $result23['name']; ?>

                                                                    </a>

                                                                  <?php

    } else {

        ?>

                                                                    <a class="menu__moblie"  class="current" href="https://allmart.world/list/<?=strurl($result23['name'])?>/<?=strcode($result23[0])?>">

                                                                      <?php

                                                                        echo $result23['name'];

                                                                        ?><span class="icon-dropdown" data-toggle-menu-mb>
                                                                          <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                        </span>

                                                                    </a>
                                                                    <?php categories($result23[0], 0);?>

                                                                  <?php }?>

                                                              </div>



                                                              <?php }?>




                                                </div>
                                           </div>

                                              <!-- <div class="row">
                                                <div class="col-12 col-xl-6">
                                                  <div class="mega-banner">
                                                    <div class="mega-col">
                                                      <a
                                                        class="animate-scale"
                                                        href="products/copy-of-product-30.html"
                                                        title=""
                                                      >
                                                        <img
                                                          src="/assets/images/Boom_Mega_Menu_01_850x75b8.png?v=1602916469"
                                                          alt=""
                                                        />
                                                      </a>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="col-12 col-xl-6">
                                                  <div class="mega-banner">
                                                    <div class="mega-col">
                                                      <a
                                                        class="animate-scale"
                                                        href="products/zen-backpacks-a1.html"
                                                        title=""
                                                      >
                                                        <img
                                                          src="/assets/images/Boom_Mega_Menu_02_850x4dbc.png?v=1602916478"
                                                          alt=""
                                                        />
                                                      </a>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div> -->
                                            </div>
                                          </div>
                                      </li>

                                      <li class="menu-lv-1 item">

                                        <a

                                          class=""

                                          href="https://allmart.world/my_orders.php"

                                        >

                                          My Orders

                                        </a>

                                      </li>


                                      <li class="menu-lv-1 item">

                                        <a

                                          class=""

                                          href="https://allmart.world/wishlist.php"

                                        >

                                          Wishlist

                                        </a>

                                      </li>
                                      <?php if ($_SESSION['gid']) {?>
                                      <li class="menu-lv-1 item"><a class="" href="https://allmart.world/MyAccount" >My Account</a></li>
                                    <?php }?>

                                      <!-- <li class="menu-lv-1 item">

                                        <a

                                          class=""

                                          href="#"

                                        >

                                          Offers

                                        </a>

                                      </li> -->

                                    </ul>

                                  </nav>

                                </div>

                                <div

                                  class="right-header header-items"

                                  data-append-header-pc

                                >

                                  <div class="appentMb" data-append-header-mb>

                                    <ul class="menu_bar_right wide--hide">

                                      <!-- <li class="wishlist">

                                        <a

                                          href="wishlist.php"

                                          title="Wishlist"

                                          >Wishlist<i

                                            class="fas fa-heart post-large--hide large--hide medium-down--hide"

                                          ></i

                                        ></a>

                                      </li> -->



                                      <li class="customer_account">

                                        <div class="header-account_links">

                                          <ul>

                                            <li>

                                              <!-- <a

                                                href="login.php"

                                                title="Log in"

                                                data-value="value 1"

                                                ><i

                                                  class="fa fa-user post-large--hide large--hide medium-down--hide"

                                                ></i

                                                ><span class="wide--hide"

                                                  >Log in</span

                                                ></a

                                              > -->

                                               <?
if ($_SESSION['gid']) {
    ?>
                                                <a href="https://allmart.world/MyAccount/" title="My-Account">
                                                <?php

    echo $username;
    ?>
                                                  </a></br><a href="https://allmart.world/logout.php">Logout</a>
                                                  <?php
} else {
    ?>
                                                <a href="https://allmart.world/login.php" title="Login">Login</a>
                                                <?php
}
?>

                                            </li>

                                          </ul>

                                        </div>

                                      </li>

                                    </ul>

                                    <div class="right">

                                      <ul class="header-5-icon gg">

                                        <li>

                                          <div class="right">

                                            <p>

                                              <i

                                                class="fas fa-phone post-large--hide large--hide medium-down--hide"

                                              ></i

                                              >Call Us Now :<span>

                                                +91(7710835444)</span

                                              >

                                            </p>

                                          </div>

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

                  </div>

                </div>

              </div>

            </div>

          </header>

        </div>

      </div>

