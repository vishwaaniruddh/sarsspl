<?php 
include('../config.php');
// print_r($_POST);


$franchise_id = $_POST['mem_id'];
$mobile = $_POST['mobile'];
$name = $_POST['name'];
$preferred_courier_company = $_POST['courier_company'];
$pid = $_POST['pid'];
$qty = $_POST['qty'];
$rate = $_POST['rate'];
$courier_charge = $_POST['courier_charge'];
$total_price = '';
$pay_date = $_POST['date'];
$pay_time = $_POST['time'];
$bank_name = $_POST['bank'];
$upi = $_POST['upi'];
$gstin = $_POST['gst'];
if(isset($_POST['is_address_same'])){
    $is_franchise_address = 1;
} else {
    $is_franchise_address = 0;
}
if(isset($_POST['delivery_address'])){
$address = $_POST['delivery_address']; 
} else {
    $address = '';
}

$status = 1;

$insert_sql = "insert into offline_orders(franchise_id,name,mobile,preferred_courier_company,pid,qty,rate,courier_charge,total_price,pay_date,pay_time,bank_name,upi,gstin,is_franchise_address,status) value('$franchise_id','$name','$mobile','$preferred_courier_company','$pid','$qty','$rate','$courier_charge','$total_price','$pay_date','$pay_time','$bank_name','$upi','$gstin','$is_franchise_address','$status')";
$insert = mysqli_query($con,$insert_sql);
$lastId = mysqli_insert_id($con);
 //echo $insert_sql;
if($insert) {
    if($is_franchise_address==0) {
        //echo "insert into offline_delivery_address (franchise_id,postal_address) values($franchise_id,'$address')";
        $insert_address = mysqli_query($con,"insert into offline_delivery_address (franchise_id,postal_address,status,order_id) values($franchise_id,'$address','$status','$lastId')");
    }
    
    $url = "https://modimart.world/franchise3/admin/offline_order.php";
    echo '<script>alert("Order added!!")</script>';
    
    echo ("<script>location.href='$url'</script>");

} else {
    echo '<script>alert("Error!")</script>';
    // echo ("<script>location.href='$url'</script>");
    echo "<script>window.history.back()</script>";
}












?>