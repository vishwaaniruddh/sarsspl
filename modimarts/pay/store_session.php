<? session_start();

$country = $_POST['country'];
$zone = $_POST['zone'];

$_SESSION['country']=$country;
$_SESSION['zone']=$zone;

?>