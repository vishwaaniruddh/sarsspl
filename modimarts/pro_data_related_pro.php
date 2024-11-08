<?php
include('connect.php');


$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 5;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;



$catid = $_GET['catid'];
$pid = $_GET['pid'];



  if($catid==1)
    {
         $qry21="select *  from fashion where code='$pid'  ";
    }
    else if($catid==190)
    {
         $qry21="select *  from electronics where code='$pid'  ";
    }
    else if($catid==218)
    {
         $qry21="select *  from grocery where code='$pid'  ";
    }else if($catid==482)
    {
         $qry21="select *  from Resale where code='$pid'  ";
    }
    else
    {
     $qry21="select *  from products where code='$pid'  ";
    }
    $res21=mysqli_query($con1,$qry21);
    $row21=mysqli_fetch_array($res21);
    //ruchi Get product name by id
    $prod1 = mysqli_query($con1,"SELECT product_model,related_grp_id FROM product_model where id='".$row21[1]."'");
    $relepro = mysqli_fetch_assoc($prod1);


if ($relepro['related_grp_id']==0)
 {
$filter = $_GET['filter'];
 if($filter == 1){
     $orderby = 'asc';
 } else if($filter == 2){
     $orderby = 'desc';
 } else {
     $orderby = 'asc';
 }

function get_all($cat){

    global $con1;

    $sql = mysqli_query($con1,"select id from main_cat where under = '".$cat."'");

    while($sql_result = mysqli_fetch_assoc($sql)){

        $id[] =     $sql_result['id'];
    }
    return $id;
}

$all_cat = get_all($catid);

foreach($all_cat as $key => $val){

    $all[] = get_all($val);
}

$id = array_merge($all_cat, $all);

$id=json_encode($id);
$id=str_replace( array('[',']','"') , ''  , $id);
$arr=explode(',',$id);
$id = "'" . implode ( "', '", $arr )."'";

$sql_category = mysqli_query($con1,"select * from main_cat where under ='".$catid."'");

// echo "select * from main_cat where under ='".$catid."'";
// Product
$categoryId=$_GET["catid"];

// $categoryId=205;
 $qrya="select * from main_cat where id='".$categoryId."'";
$resulta=mysqli_query($con1,$qrya);
$rowa = mysqli_fetch_row($resulta);

 $aa=$rowa[2];
//5:blouse  8:kurti  10:lehanga  22:evening gowns  27 : kalmakari  28 : indo western  29 : trail gowns
$jewellery = false;
$is_srishringar_product = false;
if($categoryId==80) {
    $srishringar = true;

    $maincatid = ' in(22,27,28,29)';

} else if($categoryId == 82) {
    $srishringar = true;

    $maincatid = ' in(8)';

} else if($categoryId == 84) {
    $srishringar = true;

    $maincatid = ' in(10)';

} else if($categoryId == 85) {
    $srishringar = true;

    $maincatid = ' in(5)';

} else if($categoryId == 117) {
    $srishringar = true;
    // jewellery
    $jewellery = true;
    $maincatid = ' in(19)';
}

if($aa!=0) {
     $qrya1="select * from main_cat where id='".$aa."'";
    $resulta1=mysqli_query($con1,$qrya1);
    $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
    // $Maincate = 190;
}

if($Maincate==1) {
    if($jewellery) {
         $sql="SELECT * FROM `product` WHERE `categories_id` ".$maincatid."LIMIT $limit OFFSET $offset";
    } else {
        $sql="select * from  `garment_product` where product_for ".$maincatid." and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) LIMIT $limit OFFSET $offset";
    }

    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join fashion as pd on pm.id=pd.name where pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price LIMIT $limit OFFSET $offset ) as p group by p.product_model order by p.offer_price $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);
}
else if($Maincate==190) {


    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join electronics as pd on pm.id=pd.name where pd.name!='$pid' AND pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price LIMIT $limit OFFSET $offset ) as p group by p.product_model order by p.offer_price $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);
}
else if($Maincate==218) {

    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join grocery as pd on pm.id=pd.name where pd.code!='$pid' AND pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price LIMIT $limit OFFSET $offset ) as p group by p.product_model order by p.offer_price $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);

}
/*else if($Maincate==757) {

    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name from product_model as pm join services as pd on pm.id=pd.name where pd.code!='$pid' pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price LIMIT $limit OFFSET $offset ) as p group by p.product_model order by p.offer_price $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);

}*/
else if($Maincate==767) {

    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join promotion_product as pd on pm.id=pd.name where pd.code!='$pid' AND pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price LIMIT $limit OFFSET $offset ) as p group by p.product_model order by p.offer_price $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);

}
else if($Maincate==760) {

    $View="select * from kits";
    $getipuaevts1 =mysqli_query($con1,$View);

}
else {

    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join products as pd on pm.id=pd.name where pd.code!='$pid' AND pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price LIMIT $limit OFFSET $offset ) as p group by p.product_model order by p.offer_price $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);
}

$totalnorecord = mysqli_num_rows($getipuaevts1);

while($rws2=mysqli_fetch_assoc($getipuaevts1))
{
        //  var_dump($rws2);
        if($Maincate==1) {
            $getipuaevts2=mysqli_query($con1,"SELECT * FROM `fashion_img` WHERE `category` in ($id,'".$catid."')  and product_id='".$rws2['code']."'");
        } else if($Maincate==190) {

            $getipuaevts2=mysqli_query($con1,"SELECT * FROM `electronics_img` WHERE `category` in ($id,'".$catid."') and product_id='".$rws2['code']."' ");
        }
        else if($Maincate==218) {
            $getipuaevts2=mysqli_query($con1,"SELECT * FROM `grocery_img` WHERE `category` in ($id,'".$catid."') and product_id='".$rws2['code']."' ");
        }
        /*else if($Maincate==757) {
            $getipuaevts2=mysqli_query($con1,"SELECT * FROM `service_img` WHERE `category` in ($id,'".$catid."') and product_id='".$rws2['code']."' ");
        }*/
        else if($Maincate==767) {
            $getipuaevts2=mysqli_query($con1,"SELECT * FROM `promotion_product_img` WHERE `category` in ($id,'".$catid."') and product_id='".$rws2['code']."' ");
        }
        else {
            $getipuaevts2=mysqli_query($con1,"SELECT * FROM `product_img` WHERE `category` in ($id,'".$catid."') and product_id='".$rws2['code']."' ");
        }


        $rws3=mysqli_fetch_assoc($getipuaevts2);
        //  var_dump($rws3['img']);
        if($Maincate==760) {

            $productname = $rws2['code'];
            $imageViewproduct="/ecom/".$rws2['photo'];
            $productprice=$rws2["price"];
            $productid=$rws2["name"];
            $offer_price=$rws2["offer_price"];
            $finalPrice=$rws2["total_amt"];
        } else {
            $productname=$rws2["product_model"];
            if($rws3['img']==""){
                $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='".$rws2['code']."' order by id asc limit 0,1");
                $frtu=mysqli_fetch_array($sqlimg23mn);
                $rws3['img'] = $frtu[0];
            }
            $imageViewproduct="/ecom/".$rws3['img'];
            $productprice=$rws2["price"];
            $productid=$rws2["name"];
            $offer_price=$rws2["offer_price"];
            $finalPrice=$rws2["total_amt"];
            $allmart_commission = $rws2['allmart_commission'];
        }

        // $categoryId=$categoryId;

         if ($rws2['shipping_in_area']) {
              $shipping         = 'shipping_in_area';
              $shipping_charges = $rws2['shipping_in_area'];
          } else if ($rws2['shipping_out_state']) {
              $shipping         = 'shipping_out_state';
              $shipping_charges = $rws2['shipping_out_state'];
          } else {
              $shipping         = '';
              $shipping_charges = 0;
          }

                $minqty=$rws2['minqty'];
                $catid=$rws2['category_id'];
                $pid=$rws2['code'];
                $prod_id=$rws2['name'];
                $status =getstatus($prod_id);
                $name= $productname;
                $price= $finalPrice;

                $pro_img= $imageViewproduct;
                if ($status) {
                 
               

            ?>
      <li class="grid__item item-row wide--one-fifth post-large--one-quarter large--one-third medium--one-half small--one-half on-sale" id="product-5969999724734" id="product-5969999724734">

<div class="products product-hover-11">

  <div class="product-container">

    <a href="/<?=strurl($name)?>/P/<?=strcode($pid)?>/<?=strcode($catid)?>/<?=strcode($prod_id)?>" class="grid-link">

      <div class="featured-tag">

        <span class="badge badge--sale">

          <span class="gift-tag badge__text">Sale</span>

        </span>

      </div>



      <div class="ImageOverlayCa"></div>
      <a href="/<?=strurl($name)?>/P/<?=strcode($pid)?>/<?=strcode($catid)?>/<?=strcode($prod_id)?>" class="grid-link">
        <img src="<?=$pro_img?>" title="<?=$name?>" class="featured-image" alt="<?=$name?>" style="width:213px;height: 200px;" />
      </a>
    </a>
    <div class="ImageWrapper">
      <div class="product-button">
        <div class="add-to-wishlist">
          <div class="show">
            <div class="default-wishbutton-egg loading">
              <a title="Add to wishlist" class="add-in-wishlist-js" href="#"><i class="far fa-heart"></i><span class="tooltip-label">Add to wishlist</span></a>
            </div>
            <div class="loading-wishbutton-egg loading" style="
                      display: none;
                      pointer-events: none;
                    ">
              <a class="add_to_wishlist" href="#"><i class="fas fa-spinner"></i></a>
            </div>
            <div class="added-wishbutton-egg loading" style="display: none">
              <a title="View Wishlist" class="added-wishlist add_to_wishlist" href="#"><i class="fas fa-heart"></i><span class="tooltip-label">View Wishlist</span></a>
            </div>
          </div>
        </div>
        <a href="javascript:void(0)" title="Quick View" id="egg" class="quickview-button quick-view-text product_link" data-view="egg"><i class="fa fa-search"></i></a>
      </div>
    </div>
  </div>



  <div class="product-detail" title="<?=$name?>">



    <a href="/<?=strurl($name)?>/P/<?=strcode($pid)?>/<?=strcode($catid)?>/<?=strcode($prod_id)?>" style="height: 3em;" title="<?=$name?>" class="grid-link__title"><?=substr($name, 0, 30)?></a>
    <div class="grid-link__meta">
      <div class="product_price">
        <div class="grid-link__org_price" id="ProductPrice">
          Rs. <?=$price?>
        </div>

      </div>
    </div>




      <a class="add-cart-btn btn"
            <?php
            if($status==1)
            { ?>
             onclick="addtocart('<?=$catid;?>','<?=$pid?>','<?=$price?>','<?=$pro_img?>','<?=$name;?>','<?=$prod_id;?>','<?=$shipping?>','<?=$shipping_charges?>',<?=$minqty?>)"
            <?php 
            }
            else { ?>
              disabled
              style="background: #f26522a8;"
            <?php } ?>
      title="Add to Cart">

        <i class="fas fa-cart-plus"></i>

        Add to Cart

      </a>

  </div>

</div>

</li>
<?php
}
            }
          }
            else
            {
  $releprod = mysqli_query($con1,"SELECT * FROM `related_group_products` WHERE product_status='1' AND group_id='".$relepro['related_grp_id']."' AND pro_id<>'$pid'");
    while($querycatf=mysqli_fetch_array($releprod))
      { 
                $catid=$querycatf['cat_id'];
                $pid=$querycatf['pro_id'];
                $prod_id=$querycatf['prod_id'];
                $name=$querycatf['product_name'];
                 $status =getstatus($prod_id);
                $prodata=getproductprice($catid,$pid);
                $price=$prodata['total_amt'];
                $minqty=$prodata['minqty'];

                if ($prodata['shipping_in_area']) {
                    $shipping         = 'shipping_in_area';
                    $shipping_charges = $prodata['shipping_in_area'];
                } else if ($prodata['shipping_out_state']) {
                    $shipping         = 'shipping_out_state';
                    $shipping_charges = $prodata['shipping_out_state'];
                } else {
                    $shipping         = '';
                    $shipping_charges = 0;
                }

                $pro_img=ProIMG($pid,$catid,$prod_id);;
                if ($status) {
                 

            ?>
<li class="grid__item item-row wide--one-fifth post-large--one-quarter large--one-third medium--one-half small--one-half on-sale" id="product-5969999724734" id="product-5969999724734">

<div class="products product-hover-11">

  <div class="product-container" style="max-height:213px;">

    <a href="/<?=strurl($name)?>/P/<?=strcode($pid)?>/<?=strcode($catid)?>/<?=strcode($prod_id)?>" class="grid-link">

      <div class="featured-tag">

        <span class="badge badge--sale">

          <span class="gift-tag badge__text">Sale</span>

        </span>

      </div>



      <div class="ImageOverlayCa"></div>
      <a href="/<?=strurl($name)?>/P/<?=strcode($pid)?>/<?=strcode($catid)?>/<?=strcode($prod_id)?>" class="grid-link">
        <img src="<?=$pro_img?>" title="<?=$name?>" class="featured-image" alt="<?=$name?>" style="width:213px;height: 200px;" />
      </a>
    </a>
    <div class="ImageWrapper">
      <div class="product-button">
        <div class="add-to-wishlist">
          <div class="show">
            <div class="default-wishbutton-egg loading">
              <a title="Add to wishlist" class="add-in-wishlist-js" href="#"><i class="far fa-heart"></i><span class="tooltip-label">Add to wishlist</span></a>
            </div>
            <div class="loading-wishbutton-egg loading" style="
                      display: none;
                      pointer-events: none;
                    ">
              <a class="add_to_wishlist" href="#"><i class="fas fa-spinner"></i></a>
            </div>
            <div class="added-wishbutton-egg loading" style="display: none">
              <a title="View Wishlist" class="added-wishlist add_to_wishlist" href="#"><i class="fas fa-heart"></i><span class="tooltip-label">View Wishlist</span></a>
            </div>
          </div>
        </div>
        <a href="javascript:void(0)" title="Quick View" id="egg" class="quickview-button quick-view-text product_link" data-view="egg"><i class="fa fa-search"></i></a>
      </div>
    </div>
  </div>



  <div class="product-detail" title="<?=$name?>">



    <a href="/<?=strurl($name)?>/P/<?=strcode($pid)?>/<?=strcode($catid)?>/<?=strcode($prod_id)?>" style="height: 3em;" title="<?=$name?>" class="grid-link__title"><?=substr($name, 0, 25)?></a>
    <div class="grid-link__meta">
      <div class="product_price">
        <div class="grid-link__org_price" id="ProductPrice">
          Rs. <?=$price?>
        </div>

      </div>
    </div>




      <a class="add-cart-btn btn"

       <?php 
            if($status==1)
            { ?>
             onclick="addtocart('<?=$catid;?>','<?=$pid?>','<?=$price?>','<?=$pro_img?>','<?=$name;?>','<?=$prod_id;?>','<?=$shipping?>','<?=$shipping_charges?>',<?=$minqty?>)"
            <?php 
            }
            else { ?>
              disabled
              style="background: #f26522a8;"
            <?php } ?>
      title="Add to Cart">

        <i class="fas fa-cart-plus"></i>

        Add to Cart

      </a>

  </div>

</div>

</li>
      <?php
    }
      }
 }
?>



