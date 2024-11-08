<? include('config.php');


$sql = mysqli_query($con,"select * from new_member order by id asc");

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $part = $sql_result['taluka'];
    
    $query = mysqli_query($con,"select * from new_taluka where taluka='".$part."'");
    $query_result = mysqli_fetch_assoc($query);
    $part_id = $query_result['id'];
    
    
    // echo $part.' '.$part_id;

$update = "update new_member set taluka ='".$part_id."' where taluka='".$part."'";    
echo $update;
echo '<br>';
mysqli_query($con,$update);


}

?>

