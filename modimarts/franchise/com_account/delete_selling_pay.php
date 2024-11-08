<? include('../config.php');
include('../../config.php');

$delete_id = $_POST['delete_id'];

if($delete_id){
    $sql = "delete from manage_sales_com where id='".$delete_id."'";
    
    if(mysqli_query($con3,$sql)){
        echo 1;
    }
    else{
        echo 0;
    }
    
}
else{
    echo 0;
}

?>