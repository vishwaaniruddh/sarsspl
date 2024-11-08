<? include('config.php');

$id = $_REQUEST['id'];

$sql = mysqli_query($conn,"select * from model_no where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$data = [
    'material_id'=>$sql_result['material_id'],
    'modelno'=>$sql_result['modelno'],
    'entrydate'=>$sql_result['entrydate'],'pono'=>$sql_result['pono'], 'project'=>$sql_result['project']
    ];

echo json_encode($data);



?>