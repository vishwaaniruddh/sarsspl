<?php 
include($_SERVER['DOCUMENT_ROOT'].'/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$categoryId=$_GET["id"];
//$categoryId=83; 

$catid = $_GET['id'];
$sql_category = mysqli_query($con1,"select * from main_cat where under ='".$categoryId."'");

// $categoryId=205;
 $qrya="select * from main_cat where id='".$categoryId."'"; 
$resulta=mysqli_query($con1,$qrya);
$rowa = mysqli_fetch_row($resulta);

 $aa=$rowa[2]; 
//5:blouse  8:kurti  10:lehanga  22:evening gowns  27 : kalmakari  28 : indo western  29 : trail gowns
$jewellery = false;
if($categoryId==80) {
    
    $maincatid = ' in(22,27,28,29)';
    
    
} else if($categoryId == 82) {
    
    $maincatid = ' in(8)';
    
} else if($categoryId == 84) {
    
    $maincatid = ' in(10)';
    
} else if($categoryId == 85) {
    
    $maincatid = ' in(5)';
    
} else if($categoryId == 117) {
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
        $sql="SELECT * FROM `product` WHERE `categories_id` ".$maincatid;
    } else {
        $sql="select * from  `garment_product` where product_for ".$maincatid." and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
    }
    
    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name from product_model as pm join fashion as pd on pm.id=pd.name where pm.category_id ='".$categoryId."' and pm.status=1  order by pd.price ) as p group by p.product_model";
    $getipuaevts1 =mysqli_query($con1,$View);
}
else if($Maincate==190) {
    // $getipuaevts1=mysqli_query($con1,"SELECT * FROM `electronics` WHERE `category` = '$categoryId' AND `status` = '1'");
    
    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name from product_model as pm join electronics as pd on pm.id=pd.name where pm.category_id ='".$categoryId."' and pm.status=1  order by pd.price ) as p group by p.product_model";
    $getipuaevts1 =mysqli_query($con1,$View);
}
else if($Maincate==218) {
    
    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name from product_model as pm join grocery as pd on pm.id=pd.name where pm.category_id ='".$categoryId."' and pm.status=1  order by pd.price ) as p group by p.product_model";
    $getipuaevts1 =mysqli_query($con1,$View);

}
else if($Maincate==760) {
    
    $View="select * from kits";
    $getipuaevts1 =mysqli_query($con1,$View);
}
else {
    
    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name from product_model as pm join products as pd on pm.id=pd.name where pm.category_id ='".$categoryId."' and pm.status=1  order by pd.price ) as p group by p.product_model";
    $getipuaevts1 =mysqli_query($con1,$View);
}

// echo $sql;

//Ruchi get all products of merchants 
if($Maincate==1)
{
    if($jewellery) {
        $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='".$row[0]."'";
    } else {
        $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='".$row[0]."'";
    }
    
    $qrygetallproduct = mysqli_query($con1,"select * from fashion where category ='".$cid."'and name= '".$prod_id."' and code!='".$pid."' and status=1 ");
}
else if($Maincate==190)
{
    $qrygetallproduct = mysqli_query($con1,"select * from electronics where category ='".$cid."' and name= '".$prod_id."' and code!='".$pid."' and status=1 ");
}
else if($Maincate==218)
{   
    $qrygetallproduct = mysqli_query($con1,"select * from grocery where category ='".$cid."' and name= '".$prod_id."' and code!='".$pid."' and status=1 ");
}
else if($Maincate==760)
{
    $qrygetallproduct = mysqli_query($con1,"select * from kits where category ='".$cid."' and name= '".$prod_id."' and code!='".$pid."' and status=1 ");
}

else 
{
    $qrygetallproduct = mysqli_query($con1,"select * from products where category ='".$cid."' and name= '".$prod_id."' and code!='".$pid."' and status=1 ");
}

$result_count = mysqli_num_rows($qrygetallproduct);


while($rws2=mysqli_fetch_assoc($getipuaevts1))
{
    
    if($Maincate==1) {
        $getipuaevts2=mysqli_query($con1,"SELECT * FROM `fashion_img` WHERE `category` = '$categoryId'  and product_id='".$rws2['code']."'");
    } else if($Maincate==190) {
        $getipuaevts2=mysqli_query($con1,"SELECT * FROM `electronics_img` WHERE `category` = '$categoryId' and product_id='".$rws2['code']."' ");
    }
    else if($Maincate==218) {
        $getipuaevts2=mysqli_query($con1,"SELECT * FROM `grocery_img` WHERE `category` = '$categoryId'and product_id='".$rws2['code']."' ");
    } else {
        $getipuaevts2=mysqli_query($con1,"SELECT * FROM `product_img` WHERE `category` = '$categoryId' and product_id='".$rws2['code']."' ");
    }
    
    $rws3=mysqli_fetch_assoc($getipuaevts2);
    
    if($Maincate==760) {
        
        $productname = $rws2['code'];
        $productcode = $rws2['code'];
        $imageViewproduct="https://allmart.world/ecom/".$rws2['photo'];
        $productprice=$rws2["price"];
        $productid=$rws2["name"];
        $offer_price=$rws2["offer_price"]; 
        $finalPrice=$rws2["total_amt"];
        $allmart_commission = $rws2['allmart_commission'];  
        $nextPage="https://allmart.world/allmart/api/getProductDetails.php?pid=".$productid."&category=".$categoryId."&prod_id=".$productid;
    } else {
        $productcode = $rws2['code'];
        $productname=$rws2["product_model"];
        $imageViewproduct="https://allmart.world/ecom/".$rws3['img'];
        $productprice=$rws2["price"];
        $productid=$rws2["name"];
        $offer_price=$rws2["offer_price"]; 
        $finalPrice=$rws2["total_amt"];
        $allmart_commission = $rws2['allmart_commission'];                                    
    }
				 
    $nextPage="https://allmart.world/api/getProductDetails.php?pid=".$productcode."&category=".$categoryId."&prod_id=".$productid;
    $data[]=['categoryId'=>$categoryId,'ProductName'=>$productname,'ProductPrice'=>$productprice,'offer_price'=>$offer_price,'allmart_commission'=>$allmart_commission,'productImage'=>$imageViewproduct,'productId'=>$productid,'nextPage'=>$nextPage];
			
}


$apparels = mysqli_query($con1,$sql);
$counter = 1;
while($data1=mysqli_fetch_assoc($apparels))
{
    if($jewellery) {
        $productname=$data1["product_name"];
        $prcode = $data1['product_code']; 
        $prodid = $data1['product_id'];
        $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`='".$data1['product_id']."'";
    } else {
        $productname=$data1["gproduct_name"];
        $prcode = $data1['gproduct_code'];
        $prodid = $data1['gproduct_id'];
        $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='".$data1['gproduct_id']."'";
    }
    
    $qryimg=mysqli_query($con1,$sqlimg);
    $rowimg=mysqli_fetch_row($qryimg);
    
    $path=trim($pathmain."uploads".$rowimg[0]);
    
    $expl=explode('/',$path);
    
    $pth1=trim($pathmain."mid1/".$expl[$cnt-1]);
    
    $rate_qry = mysqli_query($con1,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
    $rate=mysqli_fetch_row($rate_qry);
    
    $imageViewproduct="http://yosshitaneha.com/".$path;
    $productprice=$rate[0]; 
    $productid=$prodid;
    $offer_price=$rate[0];
    $finalPrice=$rate[0];
    $allmart_commission = '';
    $nextPage="https://allmart.world/api/getProductDetails.php?pid=".$prodid."&category=".$categoryId."&gid=".$prodid;
    $data2[]=['categoryId'=>$categoryId,'ProductName'=>$productname,'ProductPrice'=>$productprice,'offer_price'=>$offer_price,'allmart_commission'=>$allmart_commission,'productImage'=>$imageViewproduct,'productId'=>$productid,'nextPage'=>$nextPage];

    $counter++;
}
if($data2){
    $result = array_merge($data,$data2);
} else {
    $result = $data;
}
//$result = array_merge($data,$data2);

//print_r($result);
echo json_encode($result);

?>
