<? include('config.php');
header('Content-Type: application/json; charset=utf-8');

$sql = mysqli_query($con ,"select * from vendor");
$sql_result = mysqli_fetch_assoc($sql);

$id = $sql_result['id'];
$Name = $sql_result['Name'];
$Address = $sql_result['Address'];
$contact = $sql_result['contact'];
$email = $sql_result['email'];
$date = $sql_result['date'];

$data[] = ['id'=>$id,'Name'=>$Name,	'Address'=>$Address,	'contact'=>$contact,	'email'=>$email,	'date'=>$date];

echo json_encode($data);
?>