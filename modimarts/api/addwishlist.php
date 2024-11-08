<?php  include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');


$pid=$_REQUEST['pid'];
$cid=$_REQUEST['cid'];
$price = $_REQUEST['price'];
$image = $_REQUEST['image'];
$pname = $_REQUEST['pname'];

$usrid = $_REQUEST['userid'];
$qty = 1;
$dt = date("Y-m-d");

if($usrid){

$check_sql = mysqli_query($con1,"select * from wishlist where cat_id='".$cid."' and user_id='".$usrid."' and pid='".$pid."'");

if($check_sql_result = mysqli_fetch_assoc($check_sql)){
    
    $quantity = $check_sql_result['qty'];
    
    $new_quantity = $quantity + $qty;
    $total_amount  = $new_quantity * $price; 
    
    $update = "update wishlist set qty = '".$new_quantity."',p_price = '".$price."', total_amt = '".$total_amount."', final_amt = '".$total_amount."'  where user_id = '".$usrid."' and pid='".$pid."' and cat_id='".$cid."'";
    if(mysqli_query($con1,$update)){
        echo 1;
    }
    else{
        echo 0;
    }
    
}

else{
    $total_amount  = $qty * $price; 

    $insert = "INSERT INTO `wishlist`(`user_id`,guest_id ,`pid`, `qty`, `dt`,p_price,total_amt,final_amt,color,size,cat_id,status,product_name,image) VALUES ('".$usrid."','".$usrid."','".$pid."','".$qty."','".$dt."','".$price."','".$total_amount."','".$total_amount."','','','".$cid."','0','".$pname."','".$image."')";
    
    if(mysqli_query($con1,$insert)){
        echo 1;
    }    
    else{
        echo 0;
    }
}
}
else{
    echo 0;
}


?>