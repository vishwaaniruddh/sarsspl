<?php include('../config.php');


if(isset($_REQUEST['sub_menu'])){

$sub_menu = $_REQUEST['sub_menu']; 
$sub_menu_str  = implode(',',$sub_menu) ; 

}else{
    $sub_menu_str = '';
}





$id = $_POST['id'];
$name = $_POST['name'];
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$contact = $_POST['contact'];
$role = $_POST['role'];
$sql = "
UPDATE user set 
name='".$name."',
uname = '".$uname."',
pwd = '".$pwd."',
contact = '".$contact."',
permission = '".$sub_menu_str."',
level='".$role."'

where userid='".$id."'
" ;
  
if (mysqli_query($con, $sql)) { 
    echo 1 ; 

} else { 
    echo 0 ; 
} ?>


