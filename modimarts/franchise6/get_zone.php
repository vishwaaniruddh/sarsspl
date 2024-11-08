<? include('config.php');

$sql = mysqli_query($con,"select * from new_zone  where country = '1' order by id ASC");

$option = '<select class="form-control show-tick" name="state">';

$option = $option."<option value=''>".'Select'."</option>";

while($sql_result = mysqli_fetch_assoc($sql)){

    $option=$option."<option value='".$sql_result['id']."'>".$sql_result['zone']."</option>";

    
}
$option = $option.'</select>';

echo $option;
?>