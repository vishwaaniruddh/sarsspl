<? session_start();
include($_SERVER['DOCUMENT_ROOT'].'/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/functions.php');


$sku=$_POST['sku'];
$userid = $_SESSION['gid'];
$new_qty=$_POST['new_qty'];
$product_id= $_POST['product_id'];
$product_id = trim($product_id,'"');




$get_sql = mysqli_query($con1,"select * from cart where user_id ='".$userid."' and pid='".$product_id."'");
$get_sql_result = mysqli_fetch_assoc($get_sql);
$price = $get_sql_result['p_price'];
$new_total_amount = $new_qty * $price ;   




$sql="update cart set qty='".$new_qty."' , total_amt = '".$new_total_amount."' where user_id=$userid and pid='".$product_id."'";

if(mysqli_query($con1,$sql)){
    echo 1;
}
else{
    echo 0;
}




?>