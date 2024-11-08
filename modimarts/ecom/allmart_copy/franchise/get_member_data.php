<? include('config.php');


$country = $_POST['country'];
$zone = $_POST['zone'];
$state = $_POST['state'];
$division = $_POST['division'];
$district = $_POST['district'];
$taluka = $_POST['taluka'];
$pincode = $_POST['pincode'];
$village = $_POST['village'];
        
        



if($zone == ''){
    $zone = 0;
} 

if($state == ''){
    $state = 0;
} 

if($division == ''){
    $division = 0;
} 

if($district == ''){
    $district = 0;
} 

if($taluka == ''){
    $taluka = 0;
} 

if($pincode == ''){
    $pincode = 0;
} 

if($village == ''){
    $village = 0;
}

$sql = mysqli_query($con,"select * from new_member where country='".$country."'and zone='".$zone."' and state='".$state."' and division='".$division."' and district='".$district."' and taluka='".$taluka."' and pincode='".$pincode."' and village='".$village."' and status='1'");

if($sql_result = mysqli_fetch_assoc($sql)){
$id = $sql_result['id'];
$position_name = $sql_result['position_name'];
$star = $sql_result['star'];
$name = $sql_result['name'];
$status = $sql_result['status'];
$mobile = $sql_result['mobile'];

$image_sql = mysqli_query($con,"select * from new_member_images where member_id='".$id."' and type='passport'");
$image_sql_result = mysqli_fetch_assoc($image_sql);

$image = $image_sql_result['image'];

$data = ['id'=>$id,'star'=>$star,'position_name'=>$position_name,'mobile'=>$mobile,'name'=>$name,'status'=>$status,'image'=>$image];

echo json_encode($data);    

}

else{
    echo 0;
}




?>