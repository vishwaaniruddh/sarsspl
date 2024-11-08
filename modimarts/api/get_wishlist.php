<?php include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');


$userid = $_REQUEST['userid'];
if($userid > 0){
$sql = mysqli_query($con1,"select * from wishlist where user_id = '".$userid."' and status=0");

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $name = $sql_result['product_name'];
    $image = $sql_result['image'];
    $prodid = $sql_result['prodid'];
    $pid = $sql_result['pid'];
    $catid = $sql_result['cat_id'];
    $single_price = $sql_result['p_price'];


$product[] = ['ProductName'=>$name,'ProductImage'=>$image,'ProductPrice'=>$single_price,'prodid'=>$prodid,'pid'=>$pid,'catid'=>$catid];
    
}




echo json_encode($product);    
}
else{
    echo 0;
}


?>