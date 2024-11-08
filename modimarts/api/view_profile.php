<? include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$userid=$_REQUEST['userid'];

if($userid > 0){
    $sql=mysqli_query($con1,"select * from Registration where id='".$userid."'");
    $sql_result=mysqli_fetch_assoc($sql); 
    $name = $sql_result['Firstname'].' '.$sql_result['Lastname'];
    $mobile = $sql_result['Mobile'];
    $email = $sql_result['email'];
    
    
    if($_GET['id']){
    $address_sql = mysqli_query($con1,"select * from address where id = '".$_GET['id']."'");
    $address_sql_result = mysqli_fetch_assoc($address_sql);
    $address = $address_sql_result['address'];
    $pincode = $address_sql_result['pincode'];
    $landmark = $address_sql_result['landmark'];
    $state = $address_sql_result['state'];
    $city = $address_sql_result['city'];
    $is_primary = $address_sql_result['is_primary'];
    }
    else{
    $address_sql = mysqli_query($con1,"select * from address where userid='".$userid."' and is_primary=1");
    $address_sql_result = mysqli_fetch_assoc($address_sql);
    $address = $address_sql_result['address'];
    $pincode = $address_sql_result['pincode'];
    $landmark = $address_sql_result['landmark'];
    $state = $address_sql_result['state'];
    $city = $address_sql_result['city'];
    $is_primary = $address_sql_result['is_primary'];
        
    }
    
    $data[]=['id'=>$userid,'name'=>$name,'email'=>$email,'mobile'=>$mobile,'address'=>$address,'pincode'=>$pincode,'landmark'=>$landmark,'state'=>$state,'city'=>$city,'is_primary'=>$is_primary];
    // print_r($data);
    echo json_encode($data);
    
}
else{
    echo 0;
}
?>