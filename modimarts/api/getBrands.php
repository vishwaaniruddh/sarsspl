<?php 
include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$getbrands=mysqli_query($con1,"SELECT *  FROM `brand` where status=1");
$nrws=mysqli_num_rows($getbrands);

$data=array();
while($rws1=mysqli_fetch_array($getbrands))
{
    $categoryId=$rws1['category_id'];
    $brandName=$rws1['brand'];
    $id = $rws1['id'];
    
    $nextPage="https://allmart.world/api/getProductByBrand.php?id=".$id;
    
    if($rws1[4]!='') {
        $brandImage="https://allmart.world/ecom/adminpanel/".$rws1[4];
    } else {
        $brandImage="https://allmart.world/ecom/adminpanel/images/noimg.png";
    }
    
    $data[]=['id'=>$id,'categoryId'=>$categoryId,'brand'=>$brandName,'brandImage'=>$brandImage,'nextPage'=>$nextPage];
}
// print_r($data);

echo json_encode($data);

?>
