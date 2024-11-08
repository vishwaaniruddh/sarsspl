<? include('../config.php');

$pid=$_POST['pid'];
$cat_id = $_POST['catid'];
$userid=$_POST['usrid'];



$delete_sql="delete from cart where pid='".$pid."' and cat_id = '".$cat_id."' and  user_id='".$userid."'";
    
    if(mysqli_query($con1,$delete_sql)){
        echo '1';
    }
    else{
        echo '0';
    }
    



?>