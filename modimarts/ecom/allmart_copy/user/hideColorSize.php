<?php 
session_start();
include('config.php');

$pcat=$_POST['proct'];
$qrya="select * from main_cat where id='".$pcat."'";
 $resulta=mysqli_query($con1,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   echo $Maincate;
} 

?>