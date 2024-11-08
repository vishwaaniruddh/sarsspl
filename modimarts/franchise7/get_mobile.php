<? include('config.php');

$id = $_POST['id'];

if($id){
    

$sql = mysqli_query($con, "select * from new_member where id='".$id."'");
 
 $sql_result = mysqli_fetch_assoc($sql);


echo $sql_result['mobile'];
}
else{
    echo 'No data';
}
?>