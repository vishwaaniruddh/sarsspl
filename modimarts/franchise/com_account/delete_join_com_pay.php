<? include('../config.php');
include('../../config.php');

$delete_id = $_POST['delete_id'];

if($delete_id){
    
     $sql = "update commission set status=0 where `txn_id` = '".$delete_id."'";
    
    if(mysqli_query($con3,$sql)){
        echo 1; 
        mysqli_query($con3,"update commission_details set status=0 where `txn_id` ='".$delete_id."'");
    }
    else{
        echo 0;
    }
    
}
else{
    echo 0;
}

?>