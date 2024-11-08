<?php  include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');


$pid=$_REQUEST['pid'];
$cid=$_REQUEST['cid'];
$usrid = $_REQUEST['userid'];

if($userid > 0){
    
    $delete_sql="delete from wishlist where pid='".$pid."' and cat_id = '".$cat_id."' and  user_id='".$userid."'";
    
        if(mysqli_query($con1,$delete_sql)){
            echo '1';
        }
        else{
            echo '0';
        }
    }
    
    else{
        echo 0;
    }
?>