<? include('config.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$district = $_POST['district'];

// $district = 'Aligarh';

$district_sql = mysqli_query($con,"select * from new_district where district= '".$district."' and status=1");
$district_sql_result = mysqli_fetch_assoc($district_sql);
$district_id = $district_sql_result['id'];
$division = $district_sql_result['division'];


$division_sql = mysqli_query($con,"select * from new_division where id= '".$division."' and status=1");
$division_sql_result = mysqli_fetch_assoc($division_sql);

$state = $division_sql_result['state'];


$state_sql = mysqli_query($con,"select * from new_state where id= '".$state."' and status=1");
$state_sql_result = mysqli_fetch_assoc($state_sql);

$zone = $state_sql_result['zone'];

$data = ['zone'=>$zone,'state'=>$state,'division'=>$division,'district'=>$district,'district_id'=>$district_id];

echo json_encode($data);
?>

