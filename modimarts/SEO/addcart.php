<?php
 session_start();

include('connect.php');

$prodid=$_POST['prodid'];
$pid = $_POST['pid'];
$cid=$_POST['cid'];
$price = $_POST['price'];
$image = $_POST['image'];
$pname = $_POST['pname'];
if(isset($_POST['specifiid'])){ $specifiid = $_POST['specifiid'];} else {
$specifiid =0;
}

if($_SESSION['gid']=='')
{

    if($_SESSION['geust_id']==''){
    $qryid=mysqli_query($con1,"INSERT INTO `Registration`(`id`) values ('')");
        if($qryid=="")
        {
        $errs++;
        }
    $usrid=mysqli_insert_id($con1);
    $_SESSION['geust_id']=$usrid;
    }
    else
    {
        $usrid=$_SESSION['geust_id'];
    }

}
else
{

    $geust_id = $_SESSION['geust_id'];
    $usrid = $_SESSION['gid'];

    $updateid = "update cart set user_id = '".$usrid."' WHERE user_id ='".$geust_id."'";
    $cmpquery=mysqli_query($con1,$updateid);

}





$shipping = $_POST['shipping'];
$shipping_charges = $_POST['shipping_charges'];

if($shipping == 'shipping_in_area'){
    $shipping_in_area = $shipping_charges;
    $shipping_out_state = 0;
} else if($shipping == 'shipping_out_state'){
    $shipping_in_area = 0;
    $shipping_out_state = $shipping_charges;
}


$qty = 1;
$dt = date("Y-m-d");

if($usrid){
    
$check_sql = mysqli_query($con1,"select * from cart where cat_id='".$cid."' and user_id='".$usrid."' and pid='".$prodid."' and variant_id='".$specifiid."'");

if($check_sql_result = mysqli_fetch_assoc($check_sql)){
    
    $quantity = $check_sql_result['qty'];
    
    $new_quantity = $quantity + $qty;
    $total_amount  = $new_quantity * $price; 
    
    $update = "update cart set qty = '".$new_quantity."',p_price = '".$price."', total_amt = '".$total_amount."', final_amt = '".$total_amount."'  where user_id = '".$usrid."' and pid='".$prodid."' and cat_id='".$cid."' AND variant_id='".$specifiid."'";
    if(mysqli_query($con1,$update)){
        echo 1;
    }
    else{
        echo 0;
    }
    
}

else{
    $total_amount  = $qty * $price; 

      $insert = "INSERT INTO `cart`(`user_id`,guest_id ,`pid`, `qty`, `dt`,p_price,total_amt,final_amt,color,size,cat_id,status,product_name,image,prodid,shipping_in_area,shipping_out_state,variant_id) VALUES ('".$usrid."','".$usrid."','".$prodid."','".$qty."','".$dt."','".$price."','".$total_amount."','".$total_amount."','','','".$cid."','0','".$pname."','".$image."','".$pid."','".$shipping_in_area."','".$shipping_out_state."','".$specifiid."')";
    
    //echo $insert;
    if(mysqli_query($con1,$insert)){
        echo 1;
    }    
    else{
        echo 0;
    }
}
}
else{
    echo 2;
}


?>