<? include('config.php');

$state = $_POST['state'];

$sql = mysqli_query($con,"select * from new_state where state like '".$state."'");
$sql_result = mysqli_fetch_assoc($sql);

echo $sql_result['id'];
?>