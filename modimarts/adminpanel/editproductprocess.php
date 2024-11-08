<?php
session_start();
include('config.php');
include('adminaccess.php');

    $id=$_POST['ccode'];
    $pcode=$_POST['pcode'];
    $pcat=$_POST['pcat'];
    $maxqty=$_POST['maxqty'];
    $maxqty = ($maxqty=='') ? 1: $maxqty ;
    $minqty=$_POST['minqty'];
    $minqty = ($minqty=='') ? 1: $minqty ;
    $prodid=$_POST['prodid'];
    $status=$_POST['status'];
    $is_online=$_POST['is_online'];

    $franchise_price=$_POST['franchise_price'];
    $total_amt=$_POST['total_amt'];
    $HSN=$_POST['HSN'];
    $gst=$_POST['gst'];




    if (isset($_POST['Editprod'])) {
       
       // var_dump($_POST);die();

    if($pcat==1)
    {
             
         $qry2="UPDATE `fashion` SET `minqty`='$minqty',`maxqty`='$maxqty',`franchise_price`='".$franchise_price."',`total_amt`='".$total_amt."',`HSN`='".$HSN."',`gst`='".$gst."' WHERE code='$pcode' and ccode='$id'";
    }
    else if($pcat==190)
    {
             
         $qry2="UPDATE `electronics` SET `minqty`='$minqty',`maxqty`='$maxqty',`franchise_price`='".$franchise_price."',`total_amt`='".$total_amt."',`HSN`='".$HSN."',`gst`='".$gst."' WHERE code='$pcode' and ccode='$id'";
    }
    else if($pcat==218)
    {
              
         $qry2="UPDATE `grocery` SET `minqty`='$minqty',`maxqty`='$maxqty',`franchise_price`='".$franchise_price."',`total_amt`='".$total_amt."',`HSN`='".$HSN."',`gst`='".$gst."' WHERE code='$pcode' and ccode='$id'";
    }else if($pcat==482)
    {
             
         $qry2="UPDATE `Resale` SET `minqty`='$minqty',`maxqty`='$maxqty',`franchise_price`='".$franchise_price."',`total_amt`='".$total_amt."',`HSN`='".$HSN."',`gst`='".$gst."' WHERE code='$pcode' and ccode='$id'";
    }
    else
    {

     $qry2="UPDATE `products` SET `minqty`='$minqty',`maxqty`='$maxqty',`franchise_price`='".$franchise_price."',`total_amt`='".$total_amt."',`HSN`='".$HSN."',`gst`='".$gst."' WHERE code='$pcode' and ccode='$id'";
    }

    $update=mysqli_query($con1,$qry2);

    if ($update) {
    
        $prod = mysqli_query($con1,"UPDATE product_model SET `status`='$status',`is_online`='$is_online' where id='".$prodid."'");
       ?>
       <script>
         window.location.href="Editproduct.php?pcode=<?=$pcode?>&cat=<?=$pcat?>&ccode=<?=$id?>&prodid=<?=$prodid?>&status=success"  ;
       </script>
       <?php      
    }
    else
    {
        ?>
       <script>
         window.location.href="Editproduct.php?pcode=<?=$pcode?>&cat=<?=$pcat?>&ccode=<?=$id?>&prodid=<?=$prodid?>&status=failed"  ;
       </script>
       <?php 

    }
}
