<? include('config.php');


$zone = $_POST['zone_id'];

$sql = mysqli_query($con,"select * from new_state  where zone = '".$zone."' and status=1 order by state ASC");

$option = "<option value=''>".'Select'."</option>";

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];
    $state = $sql_result['state'];
    
    
    $option=$option."<option value='".$sql_result['id']."'>".$sql_result['state']."</option>";

    
}

echo $option;
?>