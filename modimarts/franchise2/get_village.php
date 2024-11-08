<? include('config.php');


$pincode = $_POST['pincode_id'];

$sql = mysqli_query($con,"select * from new_village where pincode = '".$pincode."' and status=1 order by village ASC");

$option = "<option value=''>".'Select'."</option>";

while($sql_result = mysqli_fetch_assoc($sql)){
    
    
    $option=$option."<option value='".$sql_result['id']."'>".$sql_result['village']."</option>";

    
}

echo $option;
?>