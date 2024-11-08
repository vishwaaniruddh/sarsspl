<? include('config.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=utf-8');


// https://sarmicrosystems.in/cssInventory/API/post.php?name=Aniruddh&email=aniruddhvishwa@gmail.com&contact=7021889883

$Name = $_REQUEST['name'];
$Address = $_REQUEST['address'];
$contact = $_REQUEST['contact'];
$email = $_REQUEST['email'];
$date = $_REQUEST['date'];

if($Name && $contact && $email){
    $sql = "insert into vendor_dummy(Name,Address,contact,email,date) values('".$Name."','".$Address."','".$contact."','".$email."','".$date."')";
    if(mysqli_query($con,$sql)){
        echo json_encode(1) ; 
    }else{
        echo json_encode(0);
    }    
}else{
    echo json_encode(2) ;
}

?>