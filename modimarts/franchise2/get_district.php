<? include('config.php');


$division = $_POST['division_id'];

$sql = mysqli_query($con,"select * from new_district  where division = '".$division."' and status=1 order by district ASC");

$option = "<option value=''>".'Select'."</option>";

while($sql_result = mysqli_fetch_assoc($sql)){
    
    
    $option=$option."<option value='".$sql_result['id']."'>".$sql_result['district']."</option>";

    
}

echo $option;
?>