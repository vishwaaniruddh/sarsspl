<?php

include 'connect.php';

ini_set("display_errors", 1);
function get_electronics_image($id)
{

 global $con1;

 $sql = mysqli_query($con1, "select * from electronics_img where product_id ='" . $id . "'");

 $sql_result = mysqli_fetch_assoc($sql);

 return $sql_result['thumbs'];

}

$supported_image = array(

 'gif',

 'jpg',

 'jpeg',

 'png',

);

$search = "New";

if ($search) {

 $view = "(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join electronics as pd on pm.id=pd.name where pm.status=1  ORDER BY pd.code DESC LIMIT 2 ) as p group by p.product_model)
    UNION
    (select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join fashion as pd on pm.id=pd.name where pm.status=1  ORDER BY pd.code DESC LIMIT 2  ) as p group by p.product_model)
    UNION
    (select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join grocery as pd on pm.id=pd.name where  pm.status=1 ORDER BY pd.code DESC LIMIT 2 ) as p group by p.product_model)
    UNION
    (select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join services as pd on pm.id=pd.name where  pm.status=1  ORDER BY pd.code DESC LIMIT 2 ) as p group by p.product_model)
    UNION
    (select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join products as pd on pm.id=pd.name where pm.status=1  ORDER BY pd.code DESC LIMIT 2 ) as p group by p.product_model)";

 $view = mysqli_query($con1, $view);

// $jwel = mysqli_query($con1, "SELECT * FROM product ORDER BY id DESC LIMIT '".$limit."'");

// $garment =mysqli_query($con1,"select * from  `garment_product` and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) and status=1  order by id desc limit 10");

 if (mysqli_num_rows($view)) {

  while ($view_result = mysqli_fetch_assoc($view)) {

   $getipuaevts2 = mysqli_query($con1, "SELECT * FROM `fashion_img` WHERE product_id='" . $view_result['code'] . "'");

   $rws3 = mysqli_fetch_assoc($getipuaevts2);
   $cat = $view_result['category_id'];

   $productname = $view_result["product_model"];

   $imageViewproduct = "https://allmart.world/ecom/" . $rws3['img'];

   $productprice = $view_result["price"];

   $productid = $view_result["name"];

   $offer_price = $view_result["offer_price"];

   $finalPrice = $view_result["total_amt"];

   $allmart_commission = $view_result['allmart_commission'];

   if ($cat == '205') {

    $code = $view_result['code'];

    $image = get_electronics_image($code);
   } else {

    if (!file_exists($imageViewproduct)) {

     $image = $view_result['photo'];

    } else {

     $image = $rws3['img'];

    }

   }

   $name = $view_result['product_model'];
   $getimgdata = Getimg($view_result['code'], $view_result['category_id'], $view_result['name']);

   ?>
    <li class="products">

                          <div class="grid__item wide--one-third post-large--one-third large--one-third medium--one-third small--grid__item">

                            <div class="product-container" style="height: 12em;">

                              <a class="thumb grid__item" href="#">

                                <img alt="featured product" src="<?=$getimgdata?>" />

                              </a>

                            </div>

                          </div>



                          <div class="grid__item wide--two-thirds post-large--two-thirds large--two-thirds medium--two-thirds small--grid__item">

                            <div class="top-products-detail product-detail grid__item">

                            
                              <a class="grid-link__title" href="https://allmart.world/<?=strurl($productname)?>/P/<?=strcode($view_result['code'])?>/<?=strcode($view_result['category_id'])?>/<?=strcode($view_result['name'])?>">

                              <? echo substr($productname, 0,25) ; ?>

                              </a>



                              <span class="shopify-product-reviews-badge" data-id="5970000773310"></span>

                              <div class="top-product-prices grid-link__meta">

                                <div class="product_price">

                                  <div class="grid-link__org_price">

                                    Rs.<?php echo $finalPrice; ?>

                                  </div>

                                </div>

                              </div>

                            </div>

                          </div>

                        </li>

  <?php

  }

 }
}

function Getimg($pid, $cid, $prod_id)
{

 global $con1;

 $qrya = "SELECT * FROM `main_cat` WHERE `id`='$cid'";

 $resulta = mysqli_query($con1, $qrya);

 $rowa = mysqli_fetch_row($resulta);

 $aa = $rowa[2];

 if ($cid == 80) {

  $maincatid = 5;

  $sql = "select * from  `garment_product` where product_for='" . $maincatid . "' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";

 } else {

  if ($aa != 0) {

   $qrya1 = "select * from main_cat where id='" . $aa . "'";

   $resulta1 = mysqli_query($con1, $qrya1);

   $rowa1 = mysqli_fetch_row($resulta1);

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

   $sql = "SELECT * FROM `product` WHERE `categories_id` " . $maincatid . " and product_id=" . $_GET['gid'];

   $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `product_id`=" . $_GET['gid'];

  } else {

   $prcode = $data['gproduct_code'];

   $sql = "select * from  `garment_product` where product_for " . $maincatid . " and gproduct_id=" . $_GET['gid'];

   $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=" . $_GET['gid'];

  }

  // $sql="select * from  `garment_product` where product_for ".$maincatid." and gproduct_id=".$_GET['gid'];

  $result = mysqli_query($con1, $sql);

  $data = mysqli_fetch_array($result);

  //print_r($data);

  if ($jewellery) {

   $prcode = $data['product_code'];

  } else {

   $prcode = $data['gproduct_code'];

  }

  $rate_qry = mysqli_query($con1, "SELECT unit_price,cost_price,quantity FROM phppos_items where name like '" . $prcode . "'");

  $rate = mysqli_fetch_row($rate_qry);

  // $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=".$_GET['gid'];

  // echo $sqlimg;

  $qryimg = mysqli_query($con1, $sqlimg);

  $rowimg = mysqli_fetch_row($qryimg);

  $path = trim($pathmain . "uploads" . $rowimg[0]);

  $expl = explode('/', $path);

  $pth1 = trim($pathmain . "mid1/" . $expl[$cnt - 1]);

  $pro_img = "https://yosshitaneha.com/" . $path;

  return $pro_img;

 } else {

  $categogy = $cid;

  $prod_id = $prod_id;

  $cust_pid = $pid;

  if ($categogy == '761') {

   $pro_img = 'https://allmart.world/ecom/' . get_kit_info($cust_pid, 'photo');

  } else {

   $pro_img = 'https://allmart.world/ecom/' . $frtu[0];

  }

 }

 return $pro_img;

}

?>



