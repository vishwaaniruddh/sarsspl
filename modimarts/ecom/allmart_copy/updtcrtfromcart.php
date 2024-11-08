<?php
if (version_compare(phpversion(), '5.4.0', '<')) {
     if($_SESSION['gid'] == '') {
        session_start();
     }
 }
 else
 {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
 }
 include("config.php");
 
 
 //echo "delete from cart where id='".$_POST['cartid']."'";
 $getcrtdets=mysqli_query($con1,"select * from cart where id='".$_POST['cartid']."'");
 $getrws=mysqli_fetch_array($getcrtdets);
 
  //================ query for  get category which is under '0' ============

$qrya="select * from main_cat where id='".$getrws['cat_id']."'";
 $resulta=mysqli_query($con1,$qrya);
 $rowa = mysqli_fetch_row($resulta);
$aa=$rowa[2];

   
if($aa!=0){
    
     $qrya1="select * from main_cat where id='".$aa."'";
 $resulta1=mysqli_query($con1,$qrya1);
 $rowa1 = mysqli_fetch_row($resulta1);
    $Maincate= $rowa1[4];
   
} 
//===============================================================  
   if($Maincate==1){
 
 $getprdets=mysqli_query($con1,"select * from fashion where code='".$getrws['pid']."'");
   }
 else if($Maincate==190)
 {
 $getprdets=mysqli_query($con1,"select * from electronics where code='".$getrws['pid']."'");
 }
 else if($Maincate==218)
 {
 $getprdets=mysqli_query($con1,"select * from grocery where code='".$getrws['pid']."'");
 }
 else
 {
 $getprdets=mysqli_query($con1,"select * from products where code='".$getrws['pid']."'");
 }
 
 
 
 $getprdetsrws=mysqli_fetch_array($getprdets);
 
 $newqty=$_POST['qtyn'];
 //echo $newqty;
 //$orgqty=$getrws['qty']+$newqty;
 
 
 //$newtotamt=$orgqty*$getprdetsrws['total_amt'];
 
 $updqrqr=mysqli_query($con1,"update cart set p_price='".$getprdetsrws['total_amt']."',total_amt='".($getprdetsrws['total_amt']*$newqty)."',qty='".$newqty."',final_amt='".($getprdetsrws['total_amt']*$newqty)."' where id='".$_POST['cartid']."'");
 if($updqrqr)
 {
    //echo  "update cart set p_price='".$getprdetsrws['total_amt']."',total_amt='".$newtotamt."',qty='".$orgqty."' where id='".$_POST['cartid']."'";
   echo 1;  
 }else
 {

     echo 0;
 }
    

 
 ?>