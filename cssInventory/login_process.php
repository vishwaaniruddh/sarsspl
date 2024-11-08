<?php session_start();?>
<?php
include 'config.php';

$Email=$_POST['email'];
$pass=$_POST['password'];
//$sql="select * from login where email='".$Email."' and password='".$pass."'";
$sql="select * from login where email='".$Email."' and password='".$pass."'";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
$fetchresult=mysqli_fetch_array($result);

	if($Email==$fetchresult['email'] && $pass==$fetchresult['password'])
//	if($Email==$fetchresult['email'] && $pass==$fetchresult['password'])
	{

$_SESSION['login_user']= $fetchresult['email'];
$_SESSION['id']= $fetchresult['id'];
$_SESSION['designation'] = $fetchresult['designation'];
$_SESSION['permission'] = $fetchresult['permission'];

}
?>

<?php
if($num!=""){
    echo "1"; 
 
}
else{
    echo "0";
}
?>