<? include('config.php');


$taluka = $_POST['taluka_id'];

$sql = mysqli_query($con,"select * from new_pincode where taluka = '".$taluka."' and status=1 order by pincode ASC");
$option = "<option value=''>".'Select'."</option>";
while($sql_result = mysqli_fetch_assoc($sql)){
    
    
    $option=$option."<option value='".$sql_result['id']."'>".$sql_result['pincode']."</option>";

    
}

echo $option;
?>