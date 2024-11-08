<? include('config.php');

$division = $_POST['division'];

// $division = 'Dadra & Nagar Haveli Division 1';


$division_sql = mysqli_query($con,"select * from new_division where division= '%".$division."%' and status=1");
$division_sql_result = mysqli_fetch_assoc($division_sql);

// var_dump($division_sql_result);
$division_id = $division_sql_result['id'];
$state = $division_sql_result['state'];


$state_sql = mysqli_query($con,"select * from new_state where id= '".$state."' and status=1");
$state_sql_result = mysqli_fetch_assoc($state_sql);

$zone = $state_sql_result['zone'];

$data = ['zone'=>$zone,'state'=>$state,'division'=>$division,'division_id'=>$division_id];

echo json_encode($data);
?>

