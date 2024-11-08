<?php 
include($_SERVER['DOCUMENT_ROOT'].'/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$productmainCat = $_GET["id"];
//$productmainCat = 190;

// echo "SELECT *  FROM `main_cat` WHERE `base_cat` = '$productmainCat'";
$query=mysqli_query($con1,"SELECT *  FROM `main_cat` WHERE status=1 and `under` = '$productmainCat'");
$count=mysqli_num_rows($query);

$data=array();
while($fetchdata=mysqli_fetch_array($query))
{
    $categoryId=$fetchdata[0];
    $Pcat=$fetchdata[1];
    if($fetchdata[3]!='') {
        $Pimg="https://allmart.world/ecom/adminpanel/".$fetchdata[3];
    } else {
        $Pimg="https://allmart.world/ecom/adminpanel/images/noimg.png";
    }
    
    $query_subcategory=mysqli_query($con1,"SELECT *  FROM `main_cat` WHERE  `under` = '$categoryId' and status=1");
    $count_subcategory=mysqli_num_rows($query_subcategory);
    
    if($count_subcategory>0) {
        $nextPage="https://allmart.world/api/getSubcategory.php?id=".$categoryId;
    } else {
        $nextPage="https://allmart.world/api/getProducts.php?id=".$categoryId;
    }

    $data[]=['categoryId'=>$categoryId,'categoryName'=>$Pcat,'categoryImage'=>$Pimg,'nextPage'=>$nextPage];

}
//  print_r($data);
echo json_encode($data);

?>
