<? include('config.php');


$district = $_POST['district_id'];

$sql = mysqli_query($con,"select * from new_taluka  where district = '".$district."' and status=1 order by taluka ASC");
$option = "<option value=''>".'Select'."</option>";

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $option=$option."<option value='".$sql_result['id']."'>".$sql_result['taluka']."</option>";

    
}

echo $option;
?>