<?php 
include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$userid = $_REQUEST['userid'];

$order_sql = mysqli_query($con1,"select od.* from Orders o join order_details od on o.id=od.oid where o.user_id = '".$userid."' ");

while($sql_result = mysqli_fetch_assoc($order_sql)) {
    
    
    $name = $sql_result['product_name'];
    $image = $sql_result['image'];
    $product_id = $sql_result['item_id'];
    $quantity = $sql_result['qty'];
    $single_price = $sql_result['rate'];
    $total_ind_price = $sql_result['total_amt'];
    $date = $sql_result['date'];
    $status = $sql_result['status'];
    if($status ==1){
        $msg = 'successfull';
    }else{
        $msg = 'pending';
    }

    $product[] = ['product_name'=>$name,'image'=>$image,'quantity'=>$quantity,'single_price'=>$single_price,'total_ind_price'=>$total_ind_price,'date'=>$date,'status'=>$status,'msg'=>$msg];
    
}

$data = ['product'=>$product];

//  print_r($product);

echo json_encode($product);
?>