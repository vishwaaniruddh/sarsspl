<? session_start(); 

include('config.php');

$password =  $_POST['value'];
$id = $_POST['member_id'];



$sql = mysqli_query($con,"select * from new_member where id='".$id."' and password='".$password."'");

if($sql_result = mysqli_fetch_assoc($sql)){
    
    echo '1';
    
   $_SESSION['id'] = $sql_result['id'] ; 
   $_SESSION['status'] = '1';
}
else{
    echo '2';
}

?>