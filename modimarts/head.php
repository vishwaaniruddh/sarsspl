<?php
if (session_id() == '') {session_start();}?>
<?php include_once 'connect.php';?>
<?php include_once 'function.php';?>
<?php include_once 'apidata.php';


$refcode = $_GET['rf'];

if (isset($_GET['rf'])) {

    $_SESSION['refcode'] = $refcode;

}

if ($_SESSION['mem_id'] || $_SESSION['gid'] && $_SESSION['gid'] != $_SESSION['geust_id']) {

    if ($_SESSION['gid'] != '') {
        $userid = $_SESSION['gid'];
    }
    if ($_SESSION['mem_id'] != '') {
        $userid = $_SESSION['mem_id'];
    }

    $username = get_username($userid);
    // var_dump($username);

}

function getdiscamount($amount, $percent)
    {
        $gst_amount  =$amount- ($amount * $percent) / 100;
        return $gst_amount;
    }

function ProIMG($pid, $cid, $prod_id)
{
    global $con1;

    $qrya    = "SELECT * FROM `main_cat` WHERE `id`='$cid'";
    $resulta = mysqli_query($con1, $qrya);
    $rowa    = mysqli_fetch_row($resulta);
    $aa      = $rowa[2];

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

    }

    if ($Maincate == 1) {
        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `fashion_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    } else if ($Maincate == 190) {
        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$pid' order by id asc  limit 0,1");
        //  $imgrow=mysqli_fetch_row($sqlimg23mn);
        //  echo "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$prod_id' order by id asc  limit 0,1";

    } else if ($Maincate == 218) {
        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `grocery_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    } else if ($Maincate == 760) {
        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `kits_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    } else if ($Maincate == 657) {
        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `service_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    } else if ($Maincate == 767) {
        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `promotion_product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    } else {
        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
    }
    $frtu = mysqli_fetch_array($sqlimg23mn);

    if (isset($_GET['gid'])) {
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
            $sql    = "SELECT * FROM `product` WHERE `categories_id` " . $maincatid . " and product_id=" . $_GET['gid'];
            $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `product_id`=" . $_GET['gid'];
        } else {
            $prcode = $data['gproduct_code'];
            $sql    = "select * from  `garment_product` where product_for " . $maincatid . " and gproduct_id=" . $_GET['gid'];
            $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=" . $_GET['gid'];
        }
        // $sql="select * from  `garment_product` where product_for ".$maincatid." and gproduct_id=".$_GET['gid'];
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
        // $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=".$_GET['gid'];
        // echo $sqlimg;
        $qryimg = mysqli_query($con1, $sqlimg);
        $rowimg = mysqli_fetch_row($qryimg);
        $path   = trim($pathmain . "uploads" . $rowimg[0]);
        $expl   = explode('/', $path);
        $pth1   = trim($pathmain . "mid1/" . $expl[$cnt - 1]);

        $pro_img = "http://yosshitaneha.com/" . $path;

        return $pro_img;
    } else {
        $categogy = $cid;
        $prod_id  = $prod_id;
        $cust_pid = $pid;
        if ($categogy == '761') {
            $pro_img = '/ecom/' . get_kit_info($cust_pid, 'photo');
        } else {
            $pro_img = '/ecom/' . $frtu[0];
        }
    }
    return $pro_img;
}

function getproductdetails($pid, $cid, $prod_id)
{
     global $con1;
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
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` ,`franchise_price`, `color` ,`maxqty`,`minqty`,`size`,Long_desc,shipping_in_area,shipping_out_state,`maxqty`,`minqty` FROM `fashion` WHERE code='" . $pid . "'";
    } else if ($Maincate == 190) {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`,`franchise_price`, `color` ,`size`,`maxqty`,`minqty`,Long_desc,shipping_in_area,shipping_out_state FROM `electronics` WHERE code='" . $pid . "'";
    } else if ($Maincate == 218) {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,`maxqty`,`franchise_price`,`minqty`,Long_desc,shipping_in_area,shipping_out_state FROM `grocery` WHERE code='" . $pid . "'";
    } else if ($Maincate == 760) {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`maxqty`,`minqty`,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `kits` WHERE code='" . $pid . "'";
    }
    else if ($Maincate == 767) {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,`maxqty`,`minqty`,Long_desc,shipping_in_area,shipping_out_state FROM `promotion_product` WHERE code='" . $pid . "'";
    } else {
        $qrylatf = "SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,`maxqty`,`franchise_price`,`minqty`,Long_desc,shipping_in_area,shipping_out_state FROM `products` WHERE code='" . $pid . "'";
    }
  }

  $descriptionQry = mysqli_query($con1, "select description,others,Long_desc,weight,type from product_model where id='" . $prod_id . "'");
$desc_data      = mysqli_fetch_assoc($descriptionQry);

$qrylatfrws = mysqli_query($con1, $qrylatf);

$latstprnrws = mysqli_fetch_array($qrylatfrws);

$prod         = mysqli_query($con1, "SELECT product_model,status FROM product_model where id='" . $latstprnrws['name'] . "' ");
$product_name = mysqli_fetch_assoc($prod);

return $countryResult[] = ['product_model'=>$product_name['product_model'],'description'=>$desc_data['others']];
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

function getstatus($prod_id)
{
    global $con1;
    $prod         = mysqli_query($con1, "SELECT status FROM product_model where id='" . $prod_id . "' ");
    $product_name = mysqli_fetch_assoc($prod);
    return $product_name['status'];
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
    return $latstprnrws;
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
function ValueofferCount($cat_id)
{
     global $con1;
     $Query=mysqli_fetch_assoc(mysqli_query($con1,"SELECT count(id) as Total FROM `product_model` WHERE `category_id`='".$cat_id."' AND `status`='1'"));
     $Querycount=$Query['Total'];
     return $Querycount;


}

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

        $table = 'product_model';

    }

    $apparel_qry = mysqli_query($con1, "SELECT count(gproduct_id) as total FROM garment_product where product_for in ('22','27','28','8','10','5') AND status='1'");

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

    $sql = mysqli_query($con1, "select count(code) as total from $table where category_id = $cat and status=1");

    if ($sql) {

        $sql_result = mysqli_fetch_assoc($sql);

        //  var_dump($sql_result); die();

        if ($main == 1 && get_top_cat($cat) == 1) {

            return $sql_result['total'];
            // return  $sringar_grand_total;

        } else {

            return $sql_result['total'];
            // return  $sri_total;

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

                    <a   href="list/<?=strurl($row->name)?>/<?=strcode($idc)?>">

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

                <a  href="list/<?=strurl($row->name)?>/<?=strcode($idc)?>">



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
        <li><a href="product/<?=strurl($catnamee['name'])?>/<?=strcode($catid)?>" style="color:blue;">Show More</a></li>
        <?php }
    echo '</ul>
        </div>';

}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="assets/logo.png" type="image/png" />

    <!-- Title and description ================================================== -->

  <title>Modimart</title>
  <meta charset="UTF-8">
  <meta name="keywords" content="Ecommerce,Allmart,Allmart.world,Shopping,">
  <meta name="author" content="Allmart.world">
  <meta name="description" content="Allmart, your single destination for everything you need.">

    <!-- Helpers ================================================== -->

     <!--  Essential META Tags -->
     <?php 

     if(isset($_GET['pid']) && isset($_GET['catid']) && isset($_GET['prod_id'])){
       
       $pid     = mysqli_real_escape_string($con1, $_GET['pid']);
       $cid     = mysqli_real_escape_string($con1, $_GET['catid']);
       $prod_id = mysqli_real_escape_string($con1, $_GET['prod_id']);

        $pro_img = ProIMG($pid,$cid,$prod_id);
        $productdateils=getproductdetails($pid, $cid, $prod_id);
        // var_dump($productdateils);

        ?>
        <meta property="og:title" content="<?=$productdateils['product_model']?>">
       <meta property="og:description" content="Allmart, your single destination for everything you need.">
       <meta property="og:image" content="<?=$pro_img?>">
       <meta property="og:url" content="">
       <meta name="twitter:card" content="summary_large_image">
       <meta property="og:site_name" content="Allmart.World Ecommerce">
       <meta name="twitter:image:alt" content="allmart World">

        <?php
     }
     else if(isset($_GET['product_id']))
     {
        $product_id    = mysqli_real_escape_string($con1, $_GET['product_id']);

        $res_responce=GetProductdata('getProductInfo',$product_id);
       $Prodata=$res_responce->Records;
      

       $pro_name=$Prodata[0]->Title;
       $description=$Prodata[0]->Description;

       $imgresponse=getImagesList('getImagesList', $product_id);
       $proimgresponse=$imgresponse->Records;
       $pro_img=$proimgresponse[0]->Img_file;

       ?>
       <meta property="og:title" content="<?=$pro_name?>">
       <meta property="og:description" content="Allmart, your single destination for everything you need.">
       <meta property="og:image" content="https://thebrandtadka.com/images_inventory_products/multiple_images/<?=$pro_img?>">
       <meta property="og:url" content="">
       <meta name="twitter:card" content="summary_large_image">
       <meta property="og:site_name" content="Allmart.World Ecommerce">
       <meta name="twitter:image:alt" content="allmart World">

       <?php
     }
     else 
     {
      ?>

                              <meta property="og:title" content="Allmart.World Ecommerce">
                              <meta property="og:description" content="Allmart.world is a technologically driven Indian Ecommerce platform for buyers to browse and buy the best products at the best deal.  We have a wide range of products available like- FMCG, Electronics, Apparel, Accessories, Furniture, Appliances, Grocery, and more.">
                              <meta property="og:image" content="assets/logo.png">
                              <meta property="og:url" content="">
                              <meta name="twitter:card" content="summary_large_image">
                              <meta property="og:site_name" content="Allmart.World Ecommerce">
                              <meta name="twitter:image:alt" content="allmart World">
                          <?php } ?>

    <link rel="canonical" href="" />

    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <!-- <meta name="theme-color" content="#f26522" /> -->

    <!-- CSS ================================================== -->
    
    <!-- keep href="assets" in place of href="assets"  -->

    <link href="assets/web.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- <script src="assets/web.js"></script> -->

    <link href="assets/frame.scss.css" rel="stylesheet" type="text/css" media="all"/>

    <script src="assets/sweetalert.min.js"></script>


    <link href="assets/home-sections.scss.css" rel="stylesheet" type="text/css" media="all" />

    <link

      href="assets/style.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />
<!--
    <link

      href="assets/videopopup.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />-->

    <link

      href="assets/slick.scss"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="assets/prettyPhoto.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="assets/animate.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="assets/font-all.min.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />



    <link

      rel="stylesheet"

      type="text/css"

      href="assets/gfontcss.css"

    />







    <link

      rel="stylesheet"

      type="text/css"

      href="assets/gfont3css.css"

    />



    <link

      rel="stylesheet"

      type="text/css"

      href="assets/gfont2css.css"

    />


    <link rel="stylesheet" href="assets/notyf.min.css">
    <script src="assets/notyf.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>



    <script

      src="assets/header.js"

      type="text/javascript"

    ></script>











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

        <div class="header-type-9" style="margin-bottom: 12px;">

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

                                  <a href="" style="max-width: 100px">

                                    <img

                                      class="normal-logo"

                                      src="assets/logo.png"

                                      alt="Modimarts"

                                      itemprop="logo"
                                      style="background: white;"

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
                                    if ($_SESSION['gid'] == '') {if ($_SESSION['mem_id'] == '') {$userid = $_SESSION['geust_id'];} else { $userid = $_SESSION['mem_id'];}}
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

                                    href=""

                                    itemprop="url">

                                    <img

                                      class="normal-logo"

                                      src="assets/logo.png"

                                      alt="Modimart"
                                        style="background: white;"


                                    />

                                  </a>

                                </h1>
                                <li class="nav-search post-large--hide large--hide medium-down--hide">

                                  <div class="search-form search_type1" data-ajax-search >

                                    <div class="header-search">

                                      <div class="header-search__form">

                                        <form

                                          action="/search_result.php"

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
                                            value="<?php if (isset($_GET['search'])) {echo $_GET['search'];}?>"

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

                                   

                                        <?php if ($_SESSION['mem_id'] || $_SESSION['gid'] && $_SESSION['gid'] != $_SESSION['geust_id']) {
    ?>
                                               
                                                  
                                                  <!-- <li class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide" >
                                                  <a href="MyAccount/" title="My-Account"></a>
                                                </li> -->
                                                  <li class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide" >
                                                  <div class="baskettop">
                                                  <a href="MyAccount/" class="icon-cart-arrow cart-icon" title="My Profile" > <i class="far fa-user-circle"></i>
                                                      <p style="padding: 5px;margin-top: 45px;margin-bottom: 0;font-size: 10px;"><?=$username;?></p>
                                                    </a>
                                                  </div>
                                                </li>
                                                  <li class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide" >
                                                  <div class="baskettop">
                                                  <a href="logout.php" class="icon-cart-arrow cart-icon" title="Logout" > <i class="fa fa-sign-out-alt"></i>
                                                      <p style="padding: 5px;margin-top: 45px;margin-bottom: 0;font-size: 10px;">Log Out
                                          </p>
                                                    </a>
                                                  </div>
                                                </li>
                                                  <?php
}
?>

                                     

                                    <?php if ($_SESSION['mem_id'] || $_SESSION['gid'] && $_SESSION['gid'] != $_SESSION['geust_id']) {

                                    }
                                    else{ ?>


                                    <li class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide" >
                                      <div class="baskettop">
                                      <a href="login.php" class="icon-cart-arrow cart-icon" title="Login" > <i class="fa fa-sign-in-alt"></i>
                                          <p style="padding: 3px;margin-top: 45px;margin-bottom: 4px;font-size: 10px;padding-left: 12px;">Login</p>
                                        </a>

                                      </div>
                                    </li> 

                                    <li class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide" >
                                      <div class="baskettop">
                                      <!--<a href="login_form.php" class="icon-cart-arrow cart-icon" title="Franchise Login" > <i class="fa fa-users"></i>-->
                                      <!-- <a href="/franchise_index.php" class="icon-cart-arrow cart-icon" title="Franchise Structure" > <i class="fa fa-users"></i> -->
                                      <a href="franchise_index.php" class="icon-cart-arrow cart-icon" title="Franchise Structure" > <i class="fa fa-users"></i>
                                          <p style="padding: 5px;margin-top: 45px;margin-bottom: 0;font-size: 10px;">Franchise</p>
                                        </a>
                                      </div>
                                    </li> 

                                   
                                     <li class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide" >
                                      <div class="baskettop">
                                      <a href="register.php" class="icon-cart-arrow cart-icon" title="Register" > <i class="fa fa-user-plus"></i>
                                          <p style="padding: 5px;margin-top: 45px;margin-bottom: 0;font-size: 10px;">Register</p>
                                        </a>
                                      </div>
                                    </li >
                                <?php } ?>
                                    <li

                                      class="header-bar__module cart header_cart post-large--hide large--hide medium-down--hide" style="padding:0;" >

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

                                          action="/search_result.php"

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

                                    <ul class="site-nav checking" style="margin-left: 10px;">

                                     <li class="menu-lv-1 item">

                                        <a class="current" href=""> Home </a>

                                      </li>

                                     <li class="menu-lv-1 item dropdown mega-menu">
                                        <a class="menu-moblie" href="#">
                                          All Categories
                                          <span class="icon-dropdown" data-toggle-menu-mb="">
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
                                              <div class="" data-masonry="{ &quot;itemSelector&quot;: &quot;[data-gridItem]&quot;, &quot;columnWidth&quot;: &quot;.grid-sizer&quot; }" style="position: relative; height: 830px;">
                                                <div class="grid-sizer"></div>

                                                  <!-- Menu level 2 -->


                                                              <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 0px; top: 0px;">


                                                                    <a class="menu__moblie" href="catalog-product?category_id=5">

                                                                      Backpack &amp; Travel Bag                                                                      <span class="icon-dropdown" data-toggle-menu-mb="">
                                                                          <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                        </span>

                                                                    </a>


                                                                       <div class="sub-menu-mobile menu-mb-translate">
                                                                <div class="menu-mb-title">
                                                                        <span class="icon-dropdown">
                                                                          <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                                        </span>
                                                                        SubCategory
                                                                      </div>
                                                                <ul class="dropdown">
                                                                    <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=34">

                                                                            Backpack
                                                                            </a>
                                                                        </li> 
                                                                        <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=35">

                                                                            Travel Bags
                                                                            </a>


                                                                        </li> 
                                                                        <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=37">

                                                                            Trolley Bag
                                                                            </a>


                                                                        </li>

                                                                </ul>
                                                                </div>



                                                              </div>




                                                              <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 322.25px; top: 0px;">


                                                                    <a class="menu__moblie" href="catalog-product?category_id=55">

                                                                      Electronics &amp; Home                                                                      <span class="icon-dropdown" data-toggle-menu-mb="">
                                                                          <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                        </span>

                                                                    </a>


                                                                       <div class="sub-menu-mobile menu-mb-translate">
                                                                <div class="menu-mb-title">
                                                                        <span class="icon-dropdown">
                                                                          <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                                        </span>
                                                                        SubCategory
                                                                      </div>
                                                                <ul class="dropdown"> 
                                                                    <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=56">

                                                                            Home and Electronics
                                                                            </a>
                                                                        </li> 
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=57">

                                                                            IT and Mobile
                                                                            </a>
                                                                        </li>
                                                                </ul>
                                                                </div>
                                                              </div>
                                                              <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 644.5px; top: 0px;">
                                                                    <a class="menu__moblie" href="catalog-product?category_id=58">

                                                                      Health Care    <span class="icon-dropdown" data-toggle-menu-mb="">
                                                                          <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                        </span></a><div class="sub-menu-mobile menu-mb-translate">
                                                                <div class="menu-mb-title">
                                                                        <span class="icon-dropdown">
                                                                          <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                                        </span>
                                                                        SubCategory
                                                                      </div>
                                                                <ul class="dropdown"> 
                                                                 <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=48">

                                                                            Covid-19
                                                                            </a>
                                                                        </li> 
                                                                          <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=59">

                                                                            Health Care Products
                                                                            </a>
                                                                        </li>
                                                                </ul>
                                                                </div>
                                                              </div>
                                                              <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 966.75px; top: 0px;">
                                                                    <a class="menu__moblie" href="catalog-product?category_id=1">

                                                                      Kid's                                                                      <span class="icon-dropdown" data-toggle-menu-mb="">
                                                                          <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                        </span>

                                                                    </a>
                                                                       <div class="sub-menu-mobile menu-mb-translate">
                                                                <div class="menu-mb-title">
                                                                        <span class="icon-dropdown">
                                                                          <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                                        </span>
                                                                        SubCategory
                                                                      </div>
                                                                <ul class="dropdown">   <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=65">

                                                                            Dresses
                                                                            </a> </li>  
                                                                             <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=11">

                                                                            Jeans &amp; Trousers
                                                                            </a>
                                                                        </li>  <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=12">

                                                                            Shirts &amp; T-Shirts
                                                                            </a>
                                                                        </li>
                                                                        <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=9">

                                                                            Shoes
                                                                            </a>
                                                                        </li>
                                                                            <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=10">

                                                                            Slippers &amp; Flip Flops
                                                                            </a>
                                                                        </li>                                                 <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=64">

                                                                            Winter Wear
                                                                            </a>

                                                                        </li>

                                                                </ul>
                                                                </div>
                                                              </div>
                                                              <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 322.25px; top: 142px;">
                                                                    <a class="menu__moblie" href="catalog-product?category_id=2">

                                                                      Men                                                                      <span class="icon-dropdown" data-toggle-menu-mb="">
                                                                          <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                        </span>

                                                                    </a>


                                                                       <div class="sub-menu-mobile menu-mb-translate">
                                                                <div class="menu-mb-title">
                                                                        <span class="icon-dropdown">
                                                                          <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                                        </span>
                                                                        SubCategory
                                                                      </div>
                                                                <ul class="dropdown">
                                                                 <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=13">

                                                                            Accessories
                                                                            </a>
                                                                        </li>
                                                                          <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=47">

                                                                            Blazers
                                                                            </a>
                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=43">

                                                                            Eyeglasses
                                                                            </a>
                                                                        </li>
                                                                          <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=52">

                                                                            Innerwear
                                                                            </a>


                                                                        </li>
                                                                          <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=19">

                                                                            Jeans &amp; Trousers
                                                                            </a>


                                                                        </li>
                                                                          <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=18">

                                                                            Shirts &amp; T-Shirts
                                                                            </a>
                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=14">

                                                                            Shoes
                                                                            </a>
                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=20">

                                                                            Shorts &amp; Lower
                                                                            </a>
                                                                        </li>
                                                                        <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=15">

                                                                            Slippers &amp; Flip Flops
                                                                            </a>
                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=16">

                                                                            Sunglasses
                                                                            </a>
                                                                        </li>
                                                                        <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=17">

                                                                            Watches
                                                                            </a>
                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=21">

                                                                            Winter Wear
                                                                            </a>
                                                                        </li>
                                                                </ul>
                                                                </div>
                                                              </div>
                                                              <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 644.5px; top: 142px;">
                                                                    <a class="menu__moblie" href="catalog-product?category_id=6">                                                                     Sports Club                                                                      <span class="icon-dropdown" data-toggle-menu-mb="">
                                                                          <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                        </span>

                                                                    </a>


                                                                       <div class="sub-menu-mobile menu-mb-translate">
                                                                <div class="menu-mb-title">
                                                                        <span class="icon-dropdown">
                                                                          <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                                        </span>
                                                                        SubCategory
                                                                      </div>
                                                                <ul class="dropdown">
                                                                 <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=67">

                                                                            All Sports Products
                                                                            </a>
                                                                        </li>
                                                                </ul>
                                                                </div>
                                                              </div>
                                                              <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 0px; top: 181px;">  <a class="menu__moblie" href="catalog-product?category_id=3">   Women          <span class="icon-dropdown" data-toggle-menu-mb="">
                                                                          <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                        </span>

                                                                    </a>


                                                                       <div class="sub-menu-mobile menu-mb-translate">
                                                                <div class="menu-mb-title">
                                                                        <span class="icon-dropdown">
                                                                          <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                                        </span>
                                                                        SubCategory
                                                                      </div>
                                                                <ul class="dropdown"> <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=27">

                                                                            Accessories
                                                                            </a>


                                                                        </li> <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=61">

                                                                            Blazers
                                                                            </a>


                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=62">

                                                                            Dresses
                                                                            </a>


                                                                        </li>
                                                                        <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=44">

                                                                            Eyeglasses
                                                                            </a>
                                                                        </li>
                                                                        <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=24">

                                                                            Hand Bag
                                                                            </a>


                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=22">

                                                                            Inner Wear
                                                                            </a>


                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=30">

                                                                            Jeans &amp; Trousers
                                                                            </a>


                                                                        </li>
                                                                          <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=28">

                                                                            Kurtas &amp; Kurtis
                                                                            </a>


                                                                        </li> <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=29">

                                                                            Shirts &amp; T-Shirts
                                                                            </a>


                                                                        </li><li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=23">

                                                                            Shoes
                                                                            </a>


                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=31">

                                                                            Shorts &amp; Lower
                                                                            </a>


                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=25">

                                                                            Slippers &amp; Flip Flops
                                                                            </a>


                                                                        </li>
                                                                          <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=33">

                                                                            Sunglasses
                                                                            </a>


                                                                        </li>
                                                                          <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=26">

                                                                            Watches
                                                                            </a>


                                                                        </li>
                                                                         <li class="menu-lv-3 inner">
                                                                            <a href="catalog-product?category_id=32">

                                                                            Winter Wear
                                                                            </a>


                                                                        </li>


                                                                </ul>
                                                                </div>
                                                              </div>
                                                              <?php
                                                              
                                                               if(isset($_SESSION['mem_id'])){ 
                                                                 $memid=$_SESSION['mem_id'];
                                                                ?>
                                                               <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 644.5px; top: 245px;">


                                                                    <a class="menu__moblie" href="franchise/admin/ShowMember.php?id=<?=$memid?>">

                                                                      Pay Now Order Later
                                                                    </a>
                                                              </div>
                                                          <?php } ?>
                                                               <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 644.5px; top: 245px;">


                                                                    <a class="menu__moblie" href="list/value-offer/803">

                                                                      Value Offer
                                                                    </a>


                                                              </div>
                                                               <div data-griditem="" class="menu-lv-2 inner dropdown col-12 col-xl-3" style="position: absolute; left: 644.5px; top: 245px;">


                                                                    <a class="menu__moblie" href="list/Offers-Today/810">

                                                                      Offers Today
                                                                    </a>


                                                              </div>




                                                </div>
                                           </div>

                                              <!-- <div class="row">
                                                <div class="col-12 col-xl-6">
                                                  <div class="mega-banner">
                                                    <div class="mega-col">
                                                      <a
                                                        class="animate-scale"
                                                        href="#"
                                                        title=""
                                                      >
                                                        <img
                                                          src="assets/images/Boom_Mega_Menu_01_850x75b8.png"
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
                                                        href="#"
                                                        title=""
                                                      >
                                                        <img
                                                          src="assets/images/Boom_Mega_Menu_02_850x4dbc.png"
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
                                       <?php if ($_SESSION['mem_id'] || $_SESSION['gid'] && $_SESSION['gid'] != $_SESSION['geust_id']) {?>
                                      <li class="menu-lv-1 item">

                                        <a

                                          class=""

                                          href="MyAccount/MyOrder.php"

                                        >

                                          My Orders

                                        </a>

                                      </li>
                                  <?php }?>


                                     <li class="menu-lv-1 item dropdown no-mega-menu">
                                        <a class="menu-moblie menu-mb-translate" >
                                           Media
                                            <span class="icon-dropdown" data-toggle-menu-mb="">
                                                <i aria-hidden="true" class="fa fa-angle-right">
                                                </i>
                                            </span>
                                        </a>
                                        <div class="sub-menu-mobile menu-mb-translate">
                                            <div class="menu-mb-title">
                                                <span class="icon-dropdown">
                                                    <i aria-hidden="true" class="fa fa-angle-left">
                                                    </i>
                                                </span>
                                               Media
                                            </div>
                                            <ul class="site-nav-dropdown">
                                                <li class="menu-lv-2">
                                                    <a class=" " href="PressReleases.php">
                                                        Digital Media
                                                    </a>
                                                </li>
                                                <li class="menu-lv-2">
                                                    <a class=" " href="PressReleases.php">
                                                        Tv News
                                                    </a>
                                                </li>
                                                <li class="menu-lv-2">
                                                    <a class=" " href="printmedia.php">
                                                        Print Media
                                                    </a>
                                                </li>
                                                <li class="menu-lv-2">
                                                    <a class=" " href="photogallery.php">
                                                        Images
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php
                                     if(isset($_GET['range']))
                                {
                                 $data= explode(':', $_GET['range']);
                                 $newdata1=$data[0];
                                 $newdata=$data[1];

                                }
                                else
                                {
                                 $newdata1='100'; 
                                 $newdata='1000'; 
                                }
                                 ?>
                               

                                      <li class="menu-lv-1 item " style="width: 17%;">
                                         <input type="range" min="1" max="30000" value="<?=$newdata1?>" class="slider" id="RmyRange" style="padding: 0px 11px;">
                                        <p style="margin:0;padding: 0;"><span style="display: inline-block;margin-right: 5px;">Price From: </span><input type="number" id="range" onchange="SetOne(this.value)" style="padding: 0px 4px;width:42%;color: white;display: inline-block;"></p>
                                    </li>
                                     <li class="menu-lv-1 item " style="width: 17%;">
                                        <input type="range" min="1" max="30000" value="<?=$newdata?>" class="slider" id="RmyRange1" style="padding: 0px 11px;">
                                        <p style="margin:0;padding: 0;"><span style="display: inline-block;margin-right: 5px;">Price Upto: </span><input type="number" id="range1" onchange="SetTwo(this.value)" style="padding: 0px 4px;width:42%;color: white;display: inline-block;"></p>
                                              
                                        <script>
                                            function SetOne(val)
                                            {
                                                var RmyRange = document.getElementById("RmyRange");
                                                var RmyRange1 = document.getElementById("RmyRange1");
                                                var range = document.getElementById("range");
                                                var range1 = document.getElementById("range1");
                                                if(range.value<range1.value)
                                                {
                                                  RmyRange.value = range.value;
                                                }                                                
                                                    else
                                                {
                                                    range.value=RmyRange.value;
                                                }
                                            }

                                             function SetTwo(val)
                                            {
                                                var RmyRange1 = document.getElementById("RmyRange1");
                                                var slider = document.getElementById("RmyRange");
                                                var range1 = document.getElementById("range1");
                                                var range = document.getElementById("range");
                                                if(range.value<range1.value)
                                                {
                                                  RmyRange1.value = range1.value;
                                                }
                                                else
                                                {
                                                    range1.value=RmyRange1.value;
                                                }
                                            }

                                                var RmyRange = document.getElementById("RmyRange");
                                                var range = document.getElementById("range");
                                                range.value = RmyRange.value;

                                                RmyRange.oninput = function() {
                                                  range.value = this.value;
                                                }

                                                var RmyRange1 = document.getElementById("RmyRange1");
                                                var range1 = document.getElementById("range1");
                                                range1.value = RmyRange1.value;

                                                RmyRange1.oninput = function() {
                                                  range1.value = this.value;
                                                }
                                                </script>
                                           
                                            </li>
                                             <li class="menu-lv-1 item ">
                                         <button onclick="getproval()" class="btn">Search</button>
                                    </li>
                                

                                      <?php if ($_SESSION['mem_id'] || $_SESSION['gid'] && $_SESSION['gid'] != $_SESSION['geust_id']) {?>
                                      <li class="menu-lv-1 item"><a class="" href="MyAccount" >My Account</a></li>
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
                                         <script>
                                                       function getproval()
                                                       {
                                                        //   alert(val);
                                                        var demo=$("#range").val();
                                                        var demo1=$("#range1").val();
                                                        var newval= demo+":"+demo1;
                                                        if(newval!=0){
                                                             var formData = {'Range': newval };
                                                             $("#tablerange").fadeOut();
                                                       $.ajax({
                                                                    url: "/getapiprodata.php",
                                                                    type: "post",
                                                                    data: formData,
                                                                    success: function(d) {
                                                                        // alert(d);
                                                                        $("#tablerange").fadeIn();
                                                                        $("#tablerange").html(d);
                                                                    }
                                                                });
                                                        
                                                        }else
                                                        {
                                                         window.location = "?category_id="+currentLocation;
                                                         }
                                                    }
                                                   </script> 

                                  </nav>

                                </div>

                                <div class="right-header header-items"

                                  data-append-header-pc

                                >

                                  <div class="appentMb" data-append-header-mb>

                                    <ul class="menu_bar_right wide--hide">

                                      <li class="customer_account">

                                        <div class="header-account_links">

                                          <ul>

                                            <li>



                                                <?php if ($_SESSION['mem_id'] || $_SESSION['gid'] && $_SESSION['gid'] != $_SESSION['geust_id']) {
    ?>
                                                <a href="MyAccount/" title="My-Account">
                                                <?php

    echo $username;
    ?>
                                                  </a></br><a href="logout.php">Logout</a>
                                                  <?php
} else {
    ?>
                                                <a href="login.php" title="Login">Login/</a><a href="register.php" title="Register">Register</a><br/><a href="franchise_index.php">Franchise</a>
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

                                                +91(9892384666)</span

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
      <style>

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    /*border: none;*/
    border-collapse: collapse;
    height:75%;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border: 1px solid black;
    font-size: 12px;
}

.fl-table thead th {
    color: #ffffff;
    background:#68c0d9;
    border: 1px solid black;
}

.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background:#68c0d9;
    border: 1px solid black;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
    border: 1px solid black;
}

/* Responsive */

@media (max-width: 768px) {
    .fl-table {
        display: block;
        width: 100%;
        column-count:2;
    -moz-column-count:2;
    -webkit-column-count:2;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 10px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 15px .625em .625em .625em;
        height: 40px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
        
    }
    
   
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid black;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid black;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid black;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
    
}
</style>
<?php 
$ValueofferCount=ValueofferCount(803); ?>

<?php 
if(isset($_GET['range']))
{
    $range=$_GET['range'] ;
    ?>
    <div class="table-wrapper">
    <table class="fl-table" border="1" id="tablerange">
      <thead>
              <tr>
                   <th><a href="catalog-product">Total Product</a></th>
                         <th><a href="catalog-product?category_id=5&range=<?=$range?>"> Backpack &amp; Travel Bag</a></th>
                    <th><a href="catalog-product?category_id=55&range=<?=$range?>"> Electronics &amp; Home</a></th>
                    <th><a href="catalog-product?category_id=58&range=<?=$range?>"> Health Care</a></th>
                    <th><a href="catalog-product?category_id=1&range=<?=$range?>"> Kid's</a></th>
                    <th><a href="catalog-product?category_id=2&range=<?=$range?>"> Men</a></th>
                    <th><a href="catalog-product?category_id=6&range=<?=$range?>"> Sports Club</a></th>
                    <th><a href="catalog-product?category_id=3&range=<?=$range?>"> Women</a></th>
                               
      <th><a href="list/value-offer/803">Value Offer</a></th>
        </tr>
        </thead>
        <tbody>
            <?php

            $cat5=GetTotalRecordsByrange(5,$range);
            $cat55=GetTotalRecordsByrange(55,$range);
            $cat58=GetTotalRecordsByrange(58,$range);
            $cat1=GetTotalRecordsByrange(1,$range);
            $cat2=GetTotalRecordsByrange(2,$range);
            $cat6=GetTotalRecordsByrange(6,$range);
            $cat3=GetTotalRecordsByrange(3,$range);
            $totalpro=$cat5+$cat55+$cat58+$cat1+$cat2+$cat6+$cat3;
            
             ?>
         
        <tr>
            <td><a href="catalog-product?range=<?=$range?>"><?=$totalpro?></a></td>
            
          
          
          <td><a href="catalog-product?category_id=5&range=<?=$range?>"><?=$cat5?></a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=55&range=<?=$range?>"><?=$cat55?></a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=58&range=<?=$range?>"><?=$cat58?></a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=1&range=<?=$range?>"><?=$cat1?></a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=2&range=<?=$range?>"><?=$cat2?></a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=6&range=<?=$range?>"><?=$cat6?></a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=3&range=<?=$range?>"><?=$cat3?></a></td>
     
          <td><a href="list/value-offer/803">68</a></td> 
        </tr>
       
        <tbody>
    </table>
</div>
<?php
}
else{ ?>

<div class="table-wrapper" id="tablerange">
    <table class="fl-table" border="1">
      <thead>
              <tr>
                   <th><a href="catalog-product">Total Product</a></th>
                         <th><a href="catalog-product?category_id=5"> Backpack &amp; Travel Bag</a></th>
                    <th><a href="catalog-product?category_id=55"> Electronics &amp; Home</a></th>
                    <th><a href="catalog-product?category_id=58"> Health Care</a></th>
                    <th><a href="catalog-product?category_id=1"> Kid's</a></th>
                    <th><a href="catalog-product?category_id=2"> Men</a></th>
                    <th><a href="catalog-product?category_id=6"> Sports Club</a></th>
                    <th><a href="catalog-product?category_id=3"> Women</a></th>
                               
      <th><a href="list/value-offer/803">Value Offer</a></th>
        </tr>
        </thead>
        <tbody>
         
        <tr>
            <td><a href="catalog-product">17235</a></td>
            
          
          
          <td><a href="catalog-product?category_id=5">139</a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=55">240</a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=58">34</a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=1">1330</a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=2">7418</a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=6">69</a></td>
     
     
          
          
          <td><a href="catalog-product?category_id=3">7749</a></td>
     
          <td><a href="list/value-offer/803"><?=ValueofferCount(803)?></a></td> 
        </tr>
       
        <tbody>
    </table>
</div>
<?php } ?>

