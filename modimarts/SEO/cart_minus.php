<? include('connect.php');


$pid=$_POST['pid'];
$cat_id = $_POST['catid'];
$userid=$_POST['usrid'];

$sql = mysqli_query($con1,"select * from cart where user_id='".$userid."' and pid='".$pid."' and cat_id ='".$cat_id."'");

$sql_result=mysqli_fetch_assoc($sql);

$previous_quantity=$sql_result['qty'];

if($previous_quantity==1){

$sql_update="delete from cart where user_id='".$userid."' and pid='".$pid."' and cat_id ='".$cat_id."'";

    if(mysqli_query($con1,$sql_update)){
        
        echo '1';

    }
    else{
        echo -1;
    }
    
}
else{

$quantity=$sql_result['qty']-1;

$amount=$sql_result['p_price'];

$total_amt=$amount*$quantity;


$sql_update="update cart set qty='".$quantity."', total_amt='".$total_amt."' where user_id='".$userid."' and pid='".$pid."' and cat_id ='".$cat_id."'";

    if(mysqli_query($con1,$sql_update)){
         echo 1;
    }
    else{
        echo -1;
    }

}
?>