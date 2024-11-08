<?php 
include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$userid = $_REQUEST['userid'];

$total_sql = mysqli_query($con1,"select * from cart where user_id = '".$userid."' and status=0");
    
    $total_amount = 0;
    
    while($total_sql_result = mysqli_fetch_assoc($total_sql)){
    
        $total_ind_price = $total_sql_result['total_amt'];
        $total_amount = $total_amount + $total_ind_price;
    } 
        
$sql = mysqli_query($con1,"select * from cart where user_id = '".$userid."' and status=0");

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $name = $sql_result['product_name'];
    $image = $sql_result['image'];
    $product_id = $sql_result['pid'];
    $catid = $sql_result['cat_id'];
    $quantity = $sql_result['qty'];
    $single_price = $sql_result['p_price'];
    $total_ind_price = $sql_result['total_amt'];

$product[] = ['product_name'=>$name,'product_id'=>$product_id,'cat_id'=>$catid,'image'=>$image,'quantity'=>$quantity,'single_price'=>$single_price,'total_ind_price'=>$total_ind_price];
    
}

$data = ['product'=>$product,'total'=>$total_amount];

echo json_encode($data);
?>