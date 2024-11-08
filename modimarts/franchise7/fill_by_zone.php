<? include('config.php');

$zone = $_POST['zone'];

$zone_sql = mysqli_query($con,"select * from new_zone where zone= '".$zone."' and status=1");
$zone_sql_result = mysqli_fetch_assoc($zone_sql);

$zone = $zone_sql_result['id'];

$data = ['zone'=>$zone];

echo json_encode($data);
?>

