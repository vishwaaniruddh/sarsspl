<?php 
include($_SERVER['DOCUMENT_ROOT'].'/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$categoryId=$_GET["id"];
$brand_id = $_GET['brand_id'];

//$categoryId=205;

$qrya="select * from main_cat where id='".$categoryId."'";

$resulta=mysqli_query($con1,$qrya);

$rowa = mysqli_fetch_row($resulta);

$aa=$rowa[2];

if($aa!=0) {
    $qrya1="select * from main_cat where id='".$aa."'";
    $resulta1=mysqli_query($con1,$qrya1);
    $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4]; 
    // $Maincate = 190;
} 

if($Maincate==1) {
    
    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name from product_model as pm join fashion as pd on pm.id=pd.name where pm.brand_id ='".$brand_id."' and pm.status=1  order by pd.price ) as p group by p.product_model";
    $getipuaevts1 =mysqli_query($con1,$View);
}
else if($Maincate==190) {
    
    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name from product_model as pm join electronics as pd on pm.id=pd.name where pm.brand_id ='".$brand_id."' and pm.status=1  order by pd.price ) as p group by p.product_model";
    $getipuaevts1 =mysqli_query($con1,$View);
}
else if($Maincate==218) {
    
    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name from product_model as pm join grocery as pd on pm.id=pd.name where pm.brand_id ='".$brand_id."' and pm.status=1  order by pd.price ) as p group by p.product_model";
    $getipuaevts1 =mysqli_query($con1,$View);

} else {
    
    $View="select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name from product_model as pm join products as pd on pm.id=pd.name where pm.brand_id ='".$brand_id."' and pm.status=1  order by pd.price ) as p group by p.product_model";
    $getipuaevts1 =mysqli_query($con1,$View);
}

// echo $View;

while($rws2=mysqli_fetch_assoc($getipuaevts1))
{
    // var_dump($rws2);
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
    
    $productname=$rws2["product_model"];
    $imageViewproduct="https://allmart.world/ecom/".$rws3["img"];
    $productprice=$rws2["price"];
    $productid=$rws2["name"];
    $offer_price=$rws2["offer_price"]; 
    $finalPrice=$rws2["total_amt"];
    $allmart_commission = $rws2['allmart_commission'];
    $nextPage="https://allmart.world/api/getProductDetails.php?pid=".$productid."&category=".$categoryId;

    $data[]=['categoryId'=>$categoryId,'ProductName'=>$productname,'ProductPrice'=>$productprice,'offer_price'=>$offer_price,'allmart_commission'=>$allmart_commission,'productImage'=>$imageViewproduct,'productId'=>$productid,'nextPage'=>$nextPage];
}
/*if($data){
    $data['status'] = 1;
    
} else {
    $data['status'] = 0;
    
}*/
//print_r($data);
echo json_encode($data);

?>
