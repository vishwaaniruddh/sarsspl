<? include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$query = "select * from new_member where id =58";
$sql = mysqli_query($con,$query);

if($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];
    $position_name = $sql_result['position_name'];
    $star = $sql_result['star'];
    $name = $sql_result['name'];
    $status = $sql_result['status'];
    $mobile = $sql_result['mobile'];
    
    $from_date =  $sql_result['created_at'];
    $date = date('Y-m-d');
    
    $turn_sql = "select *,datediff( $date,  $from_date) as days from new_member where id = '".$id."'";

echo $turn_sql;
    
}
?>