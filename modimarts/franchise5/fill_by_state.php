<? include('config.php');

$state = $_POST['state'];

$state_sql = mysqli_query($con,"select * from new_state where state= '".$state."' and status=1");
$state_sql_result = mysqli_fetch_assoc($state_sql);

$state = $state_sql_result['id'];
$zone = $state_sql_result['zone'];


$data = ['zone'=>$zone,'state'=>$state];

echo json_encode($data);
?>

