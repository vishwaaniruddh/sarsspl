<?php


$catid = "810";

$filter = $_GET['filter'];

 if($filter == 1){
     $filtype='offer_price';
     $orderby = 'desc';
 } else if($filter == 2){
     $filtype='offer_price';
     $orderby = 'acs';
 } else if($filter==3) {
     $filtype='discount';
     $orderby = 'desc';
 } else if($filter==4) {
     $filtype='discount';
     $orderby = 'acs';
 }
 else
 {
   $filtype='offer_price';
   $orderby = 'asc';
 }

function get_all($cat){

    global $con1;

    $sql = mysqli_query($con1,"select id from main_cat where under = '".$cat."'");

    $id = array();
    while($sql_result = mysqli_fetch_assoc($sql)){
        array_push($id,$sql_result['id']);
        //$id[] =     $sql_result['id'];
    }
    return $id;
}

$all_cat = array();
$all_cat = get_all($catid);
$all = [];
if(isset($all_cat)){
    foreach($all_cat as $key => $val){
       $all[] = get_all($val);
    }
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
         $sql="SELECT * FROM `product` WHERE `categories_id` ".$maincatid."'";
    } else {
        $sql="select * from  `garment_product` where product_for ".$maincatid." and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) ";
    }

    $View="select p.* from (select pm.product_model,pm.offer_price,pm.discount,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join fashion as pd on pm.id=pd.name where pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price ) as p group by p.product_model order by p.$filtype $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);
}
else if($Maincate==190) {


    $View="select p.* from (select pm.product_model,pm.offer_price,pm.discount,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join electronics as pd on pm.id=pd.name where pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price  ) as p group by p.product_model order by p.$filtype $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);
}
else if($Maincate==218) {

    $View="select p.* from (select pm.product_model,pm.offer_price,pm.discount,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join grocery as pd on pm.id=pd.name where pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price  ) as p group by p.product_model order by p.$filtype $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);

}
else if($Maincate==767) {

    $View="select p.* from (select pm.product_model,pm.offer_price,pm.discount,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join promotion_product as pd on pm.id=pd.name where pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price  ) as p group by p.product_model order by p.$filtype $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);

}
else if($Maincate==760) {

    $View="select * from kits";
    $getipuaevts1 =mysqli_query($con1,$View);

}
else {

    $View="select p.* from (select pm.product_model,pm.offer_price,pm.discount,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.shipping_in_area,pd.shipping_out_state,pd.minqty,pd.maxqty from product_model as pm join products as pd on pm.id=pd.name where pm.category_id in ($id,'".$catid."') and pm.status=1  order by pd.price ) as p group by p.product_model order by p.$filtype $orderby";
    $getipuaevts1 =mysqli_query($con1,$View);
}


// echo $View;
// echo $sql;

//Ruchi get all products of merchants
if($Maincate==1)
{
    if($jewellery) {
        $sqlcountQry="SELECT * FROM `product` WHERE `categories_id` ".$maincatid;
    } else {
        $sqlcountQry="select * from  `garment_product` where product_for ".$maincatid." and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) ";
    }

    $sqlcount = mysqli_query($con1,$sqlcountQry);
    $count = mysqli_num_rows($sqlcount);

    $qrygetallproduct = mysqli_query($con1,"select * from fashion where category ='".$catid."' and status=1 ");
}
else if($Maincate==190)
{

    $qrygetallproduct = mysqli_query($con1,"select * from electronics where category ='".$catid."' and status=1 ");
}
else if($Maincate==218)
{
    $qrygetallproduct = mysqli_query($con1,"select * from grocery where category ='".$catid."' and status=1 ");
}
else if($Maincate==767)
{
    $qrygetallproduct = mysqli_query($con1,"select * from promotion_product where category ='".$catid."' and status=1 ");
}
else if($Maincate==760)
{
    $qrygetallproduct = mysqli_query($con1,"select * from kits where category ='".$catid."' and status=1 ");
}

else
{
    $qrygetallproduct = mysqli_query($con1,"select * from products where category ='".$catid."' and status=1 ");
}

//$count = 0;

$result_count=0;

$result_count = mysqli_num_rows($getipuaevts1);
$count = $_GET['total_record'];
/*while($data = mysqli_fetch_assoc($sql)){
    echo "<h4>". $data['product_name']."</h4>";
}*/
$totalnorecord = mysqli_num_rows($qrygetallproduct);

?>

<?php
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
            $discount=$rws2["discount"];
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
            $discount=$rws2["discount"];
            $finalPrice=$rws2["total_amt"];
            $allmart_commission = $rws2['allmart_commission'];
        }

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

        // $categoryId=$categoryId;
        if ($Maincate == 760) { $productname = $productid;}
        $prodata=getprice($rws2['category_id'],$rws2['code']);

         if($_SESSION['mem_id']!=''){$finalPrice=$prodata['franchise_price'];}

    ?>


    <div class="category-item">

                                <a href="/<?=strurl($productname)?>/P/<?=strcode($rws2['code'])?>/<?=strcode('761')?>/<?=strcode($rws2['name'])?>">

                                  <img loading="lazy" src="<?php echo $imageViewproduct;?>" alt="" style="width:123px;height:123px;" />

                                  <h5><span></span></h5>

                                  <p><?=ucwords(substr($productname,0,30))?></p>

                                </a>

                              </div>

<?php } ?>
