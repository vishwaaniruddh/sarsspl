<?php
session_start();
include("config.php");
$qr="";
mysqli_begin_transaction($con1);

$getdetrs=mysqli_query($con1,"select code from Productviewtable where code='".$_POST['newid']."'and category='".$_POST['cat']."'  ");
$prdetsrw=mysqli_fetch_array($getdetrs);
//==================code for testing to get booking_id=========================
        $getdetrs1=mysqli_query($con1,"select max(booking_id) as booking_id from advertise_booking   ");
$prdetsrw1=mysqli_fetch_array($getdetrs1);

//=============================================================

    
        if($_POST['updid']!="")
   {
       
    $qrup="update top_right_slider set stats='1',lastupdt='".date("Y-m-d H:i:s")."' where id='".$_POST['updid']."'";
    
    
   }
            $qr="INSERT INTO `top_right_slider`( `pid`, `user_id`, `slot_id`, `slot_pos`, `booking_id`,entrydt,cat) values ('".$_POST['newpid']."','".$_SESSION['id']."','".$_POST["slotid"]."','".$_POST['slotpos']."','".$prdetsrw1['booking_id']."','".date("Y-m-d H:i:s")."','".$_POST['cat']."')";  
  
  
    
    $err=0;
   if($_POST['updid']!="")
   {
 // echo $qrup;
$exwcqupd=mysqli_query($con1,$qrup);
if(!$exwcqupd)
{
    echo mysqli_error($con1);
      $err++;
} 

}

//echo $qr;
$exwcq=mysqli_query($con1,$qr);
if(!$exwcq)
{
     echo mysqli_error($con1);
   $err++;
}



if($err==0)
{
    echo 1;
    
mysqli_commit($con1);
}else
{
    echo 0;
    
mysqli_rollback($con1);
}
?>