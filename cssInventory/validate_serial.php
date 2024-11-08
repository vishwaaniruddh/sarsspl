<? include('config.php');

$serial_number = $_REQUEST['serial_number'];

if($serial_number){
 
    $sql = mysqli_query($conn,"select * from enventory_Stock where srno like '".$serial_number."' and Status='Active'");
        if($sql_result = mysqli_fetch_assoc($sql)){
            echo 1 ;
        }else{
            echo 0;
        }
   
}else{
    echo '2';
}


?>