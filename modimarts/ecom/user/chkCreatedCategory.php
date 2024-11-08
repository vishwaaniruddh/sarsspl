<?php session_start();
include('config.php');

$Category=$_POST['Category'];
$MainCat=$_POST['MainCat'];

$qrya="select id,name from main_cat where name ='".$Category."'  and base_cat='".$MainCat."'  ";

 $resulta=mysqli_query($con1,$qrya);
if(mysqli_num_rows($resulta)>0){
    echo 1;
}else{
    echo 0;
}

?>