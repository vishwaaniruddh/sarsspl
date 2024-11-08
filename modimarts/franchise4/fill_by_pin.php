<? include('config.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$pin = $_POST['pincode'];

// $pin = '400050';

$sql = mysqli_query($con,"select * from new_pincode where pincode ='".$pin."' and status=1");
$sql_result = mysqli_fetch_assoc($sql);
$taluka = $sql_result['taluka'];
$pin_id = $sql_result['id'];

$talula_sql = mysqli_query($con,"select * from new_taluka where id= '".$taluka."' and status=1");
$talula_sql_result = mysqli_fetch_assoc($talula_sql);

$district = $talula_sql_result['district'];

$district_sql = mysqli_query($con,"select * from new_district where id= '".$district."' and status=1");
$district_sql_result = mysqli_fetch_assoc($district_sql);

$division = $district_sql_result['division'];


$division_sql = mysqli_query($con,"select * from new_division where id= '".$division."' and status=1");
$division_sql_result = mysqli_fetch_assoc($division_sql);

$state = $division_sql_result['state'];


$state_sql = mysqli_query($con,"select * from new_state where id= '".$state."' and status=1");
$state_sql_result = mysqli_fetch_assoc($state_sql);

$zone = $state_sql_result['zone'];

$data = ['zone'=>$zone,'state'=>$state,'division'=>$division,'district'=>$district,'taluka'=>$taluka,'pincode_id'=>$pin_id];

echo json_encode($data);
?>

