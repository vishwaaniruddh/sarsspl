<?php 
include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');


$productSearchName=$_GET["searchText"];
//$productSearchName="electronics";

$getipuaevts1="SELECT p.*,c.name as category_name,pm.product_model,pm.description as descr,pm.offer_price,pm.allmart_commission FROM `product_model` pm join Productviewtable  p on pm.id=p.code join main_cat c on p.category = c.id WHERE p.status='1' " ;

if($productSearchName!="")
{

$getipuaevts1.= " and pm.product_model like'%".$productSearchName."%' or  pm.description like'%".$productSearchName."%' or p.product_type like'%".$productSearchName."%' or p.brand like'%".$productSearchName."%' or p.keyword1 like'%".$productSearchName."%' or c.name like'%".$productSearchName."%'";

}
// echo $getipuaevts1;exit;
$searchdata=mysqli_query($con1,$getipuaevts1);

$data=array();

//echo "SELECT * FROM `products` WHERE `category` = '".$rws1[0]."';
while($rws2=mysqli_fetch_array($searchdata))
{
    
    // var_dump($rws2);exit;
    
/*$productSearchName=$productSearchName;
$productname=$rws2["name"];
$productprice=$rws2["price"];
$appiancesProductId=$rws2["code"];
$discount=$rws2["discount"];
$finalPrice=$rws2["total_amt"];
$productCategory=$rws2["category"];

$offer_price=$rws2["offer_price"]; 

$allmart_commission = $rws2['allmart_commission'];*/

$categoryId=$rws2["category"];

$productImg="SELECT * FROM `Productviewimg` WHERE product_id='".$rws2['code']."' and category='".$categoryId."'";
$fetchimg=mysqli_query($con1,$productImg);
$rws3=mysqli_fetch_array($fetchimg);


    // $imageViewproduct="https://allmart.world/ecom/".$rws3["img"];

    $productname=$rws2["product_model"];
    $imageViewproduct="https://allmart.world/ecom/".$rws3["img"];
    $productprice=$rws2["price"];
    $productid=$rws2["name"];
    $offer_price=$rws2["offer_price"]; 
    $finalPrice=$rws2["total_amt"];
    $allmart_commission = $rws2['allmart_commission'];
    $nextPage="https://allmart.world/allmart/api/getProductDetails.php?pid=".$productid."&category=".$categoryId;
    
    $data[]=['categoryId'=>$categoryId,'ProductName'=>$productname,'ProductPrice'=>$productprice,'offer_price'=>$offer_price,'allmart_commission'=>$allmart_commission,'productImage'=>$imageViewproduct,'productId'=>$productid,'nextPage'=>$nextPage];


}

 //print_r($data);
echo json_encode($data);

?>
