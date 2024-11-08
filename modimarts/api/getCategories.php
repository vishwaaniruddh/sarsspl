
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$getipuaevts=mysqli_query($con1,"SELECT *  FROM `main_cat` where id!=482 and under = '0' and status= 1");
$nrws1=mysqli_num_rows($getipuaevts);

$data=array();
while($rws1=mysqli_fetch_array($getipuaevts))
{
    $categoryId=$rws1[0];
    $categoryName=$rws1[1];
    
    $nextPage="https://allmart.world/api/getSubcategory.php?id=".$categoryId;
    
    if($rws1[3]!='') {
        $productImage="https://allmart.world/ecom/adminpanel/".$rws1[3];
    } else {
        $productImage="https://allmart.world/ecom/adminpanel/images/noimg.png";
    }
    
    $data[]=['categoryId'=>$categoryId,'categoryName'=>$categoryName,'categoryImage'=>$productImage,'nextPage'=>$nextPage];
}
//print_r($data);

echo json_encode($data);

?>
