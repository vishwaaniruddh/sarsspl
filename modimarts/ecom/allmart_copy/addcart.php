<?php session_start();

//---------------this page is used for app also----------------------//
include('config.php');

$pid=$_POST['pid'];
$qty=$_POST['qty'];
$colrcod=$_POST['colrcod'];

$colrsize=$_POST['colrsize'];
$cid=$_POST['cid'];

$andr=$_POST["andr"];

$cart=mysqli_query($con1,"select quantity from Productviewtable where  code='".$pid."' and category='".$cid."'");
//echo "select quantity from Productviewtable where  code='".$pid."' and category='".$cid."'";
$cartst=mysqli_fetch_array($cart);

if($qty=="")
{
    
  $qty=1;  
    
}

if(isset($_SESSION['gid']) && $_SESSION['gid']!="")
{
    $usrid=$_SESSION['gid'];
} else
{
    
    $usrid=$_POST['sendQuickUserid'];//----means it came from app----//
    $productName=$_POST['sendQuickProductStringName'];//----means it came from app----//
    $productPrice=$_POST['sendQuickProductStringPrice'];//----means it came from app----//
    $productFinalPrice=$_POST['sendQuickFinalPrice'];//----means it came from app----//
     $productCategoryId=$_POST['sendQuickCategoryProductId'];//----means it came from app----//
    
    
    
    
}


$dt= $date = date('Y-m-d H:i:s');

if($usrid!="")
{
//================ query for  get category which is under '0' ============

$qrya="select * from main_cat where id='".$cid."'";

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
    $getprddets=mysqli_query($con1,"select total_amt,quantity from fashion where code='".$pid."' and category='".$cid."'");
    
   
    }
    else if($Maincate==190)
    {
         $getprddets=mysqli_query($con1,"select total_amt,quantity from electronics where code='".$pid."' and category='".$cid."'");
    }
     else if($Maincate==218)
    {
         $getprddets=mysqli_query($con1,"select total_amt,quantity from grocery where code='".$pid."' and category='".$cid."'");
    }
     else 
    {
      $getprddets=mysqli_query($con1,"select total_amt,quentity from products where code='".$pid."' and category='".$cid."'");   
    }
    
    
    
   // echo $getprddets;
    $gprws=mysqli_fetch_array($getprddets);
    
 
$qryqty=mysqli_query($con1,"select id,qty from cart where user_id='".$usrid."' and pid='".$pid."' and cat_id='".$cid."' and status=0");
//echo "select id,qty from cart where user_id='".$usrid."' and pid='".$pid."' and status=0";
$fetchqty=mysqli_fetch_array($qryqty);
$fetchqty1=mysqli_num_rows($qryqty);

if($andr=="")
{
$qt=($fetchqty[1]+$qty);

}else //edit from adroid
{
    
$qt=$qty; 
    
}


$qryUserId=mysqli_query($con1,"select regid from login where regid='".$usrid."' ");
//echo "select regid from login where regid='".$usrid."' ";
$countUid=mysqli_num_rows($qryUserId);

if($countUid >0)
{
    $uid=$usrid;
}
else
{
    $uid_app=$usrid;
}


if($fetchqty1 > 0)
{

$totamtcalc=$gprws[0]*$qt;



$qryinsert=mysqli_query($con1,"update cart set qty='".$qt."',p_price='".$gprws[0]."',total_amt='".$totamtcalc."',final_amt='".$totamtcalc."'  where id='".$fetchqty[0]."'");

}
else
{
    $totamtcalc=$gprws[0]*$qty;
$qryinsert=mysqli_query($con1,"INSERT INTO `cart`(`user_id`,guest_id ,`pid`, `qty`, `dt`,p_price,total_amt,final_amt,color,size,cat_id) VALUES ('".$usrid."','".$uid_app."','".$pid."','".$qty."','".$dt."','".$gprws[0]."','".$totamtcalc."','".$totamtcalc."','".$colrcod."','".$colrsize."','".$cid."')");

  

}


if($qryinsert)
{
echo 1;
}
else
{
    echo mysqli_error($con1);
echo 0;
}

}else
{
    echo 2;
}


?>