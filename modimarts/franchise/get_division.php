<? include('config.php');


$state = $_POST['state_id'];

$sql = mysqli_query($con,"select * from new_division  where state = '".$state."' and status=1 order by division ASC");

$option = "<option value=''>".'Select'."</option>";

while($sql_result = mysqli_fetch_assoc($sql)){
    
    
    $option=$option."<option value='".$sql_result['id']."'>".$sql_result['division']."</option>";

    
}

echo $option;
?>