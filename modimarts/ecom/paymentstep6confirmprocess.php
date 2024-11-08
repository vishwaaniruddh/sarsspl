<?php
session_start();
include('config.php');
$id=$_SESSION['gid'];
//echo $id;
if(isset($_SESSION['gid']) & $_SESSION['gid']!="")
{
$prdid=$_POST['prdid'];
$cate_id=$_POST['cate_id'];
$pric=$_POST['pric'];
$qtty=$_POST['qtty']; 
   
$addressid=$_POST['addressid'];
$pmode=$_POST['paymode'];
$cCod=$_POST['cCod'];

$cSize=$_POST['cSize'];
$carids=$_POST['ctid'];   
//$wl=$_POST['wl'];
$amt=$_POST['amt'];
$date = date('Y-m-d H:i:s');
 $errs=0;
 mysqli_query($con1,"BEGIN"); 

//===================code for Round Robin (start)============================== 
$reg_query=mysqli_query($con1,"SELECT pincode FROM `Registration` where id='".$id."'");
$reg_fetch=mysqli_fetch_array($reg_query);

//$pname_query=mysqli_query($con1,"SELECT name FROM `Productviewtable` where code='".$prdid."' and category='".$cate_id."' ");
//$pname_fetch=mysqli_fetch_array($reg_query);

$client_query= mysqli_query($con1,"select code from clients where pincode='".$reg_fetch[0]."' and code NOT IN(select DISTINCT mrc_id from order_details where item_id='".$prdid."' and cat_id='".$cate_id."' ) ");
$client_fetch=mysqli_fetch_array($client_query);

if($client_fetch[0]==""){
    $max_query= mysqli_query($con1,"select mrc_id,max(date) from order_details where mrc_id IN(select code from clients where pincode='".$reg_fetch[0]."') GROUP BY mrc_id order by  date desc");
    $client_fetch=mysqli_fetch_array($max_query);
//echo "select max(date),mrc_id from order_details where mrc_id IN(select code from clients where pincode='".$reg_fetch[0]."') GROUP BY mrc_id order by date desc ";

    
}



 //===================code for Round Robin (End)============================== 

 
 if($_POST['addressid']=="")
 {
    $getaddr=mysqli_query($con1,"select id FROM `user_address` where user_id='".$id."' "); 
    $getradd=mysqli_fetch_array($getaddr);
    $addressid=$getradd[0];
 }
 
 if($prdid!="" && $cate_id!="")
 {
     $crtsrwstry=$pric;
 }
 else
 {
$qrycartsumamt=mysqli_query($con1,"select sum(total_amt) from cart where user_id='".$id."' and status=0 and id in($carids)");
$crtsrws=mysqli_fetch_array($qrycartsumamt);
$crtsrwstry=$crtsrws[0];
}

$qryorder=mysqli_query($con1,"INSERT INTO `Orders`(`user_id`, `date`, `amount`, `discount`, `coupon no`, `status`, `pmode`,mrc_id,address_id,color,size) VALUES ('".$id."','".$date."','".round($crtsrwstry,2)."','','','pending','".$pmode."','0','".$addressid."','".$cCod."','".$cSize."')");
if(!$qryorder)
{
  $errs++;  
}


$fetchorder=mysqli_insert_id();
$insertid=$fetchorder;
$orderno=$insertid;

//$eamt=$amt/100;
//$qrywallet=mysqli_query($con1,"INSERT INTO `ewallets`(`user_id`, `dt`, `type`, `amount`) VALUES ('".$id."','".$date."','".$pmode."','".$eamt."')");

 if($prdid!="" && $cate_id!="")
 {
     
         $getprdets=mysqli_query($con1,"select * from Productviewtable where code='".$prdid."' and category='".$cate_id."' ");
         $prdrws=mysqli_fetch_array($getprdets);
    
         $getprdets1=mysqli_query($con1,"select img from Productviewimg where product_id='".$prdid."' and category='".$cate_id."' ");
         $prdrws1=mysqli_fetch_array($getprdets1);
         
         $getprcolor=mysqli_query($con1,"select * from fashioncolor where id='".$cCod."'");
         $pcolor=mysqli_fetch_array($getprcolor);
     
 //========= Generate Random Number ============
         $a=  mt_rand(100000,999999);
 //==========================================

//======================= code for normal order==============================

//$qryorderdetails=mysqli_query($con1,"INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size) VALUES ('".$insertid."','".$prdid."','".$pric."','".$qtty."','".$prdrws[8]."','".$pric."','".$prdrws[2]."','".$cate_id."','".$a."','pending','".$cCod."','".$cSize."')");
//echo "INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size) VALUES ('".$insertid."','".$prdid."','".$pric."','".$qtty."','".$prdrws[8]."','".$pric."','".$prdrws[2]."','".$cate_id."','".$a."','pending','".$cCod."','".$cSize."')";

//============================================================================

//======================= code for Round Robin order==============================

$qryorderdetails=mysqli_query($con1,"INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size,date) VALUES ('".$insertid."','".$prdid."','".$pric."','".$qtty."','".$prdrws[8]."','".$pric."','".$client_fetch['code']."','".$cate_id."','".$a."','pending','".$cCod."','".$cSize."','".$date."')");
//echo "INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size) VALUES ('".$insertid."','".$prdid."','".$pric."','".$qtty."','".$prdrws[8]."','".$pric."','".$client_fetch['code']."','".$cate_id."','".$a."','pending','".$cCod."','".$cSize."')";

//============================================================================

if(!$qryorderdetails)
{
  $errs++;  
}
     if($errs==0)
{
mysqli_query($con1,"COMMIT");
echo $insertid;
}
else
{
    mysqli_query($con1,"ROLLBACK");
echo 0;
}
}
else{

$qrycart=mysqli_query($con1,"select * from cart where user_id='".$id."' and status=0 and id in($carids)");
while($fetchcart=mysqli_fetch_array($qrycart))
{
   $c= $fetchcart['cat_id'];
    //================ query for  get category which is under '0' ============

$qrya="select * from main_cat where id='".$fetchcart['cat_id']."'";

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
    $qryp=mysqli_query($con1,"select price,total_amt,ccode from fashion where code='".$fetchcart[2]."'");
    }
    else if($Maincate==190)
    {
       $qryp=mysqli_query($con1,"select price,total_amt,ccode from electronics where code='".$fetchcart[2]."'"); 
    }
    else if($Maincate==218)
    {
       $qryp=mysqli_query($con1,"select price,total_amt,ccode from grocery where code='".$fetchcart[2]."'"); 
    }
    else 
    {
        $qryp=mysqli_query($con1,"select price,total_amt,ccode from products where code='".$fetchcart[2]."'");
    }
    
    
    

$fetchp=mysqli_fetch_array($qryp);

//========= Generate Random Number ============
 $a=  mt_rand(100000,999999);
 //==========================================

//$qryp1=mysqli_query($con1,"select code from clients where code=(select mrc_id from order_details )");
//$fetchp1=mysqli_fetch_array($qryp1);

//echo "INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id) VALUES ('".$insertid."','".$fetchcart[2]."','".$fetchcart[6]."','".$fetchcart[3]."','0','".$fetchcart[10]."','".$fetchp[2]."')"; 
$qryorderdetails=mysqli_query($con1,"INSERT INTO `order_details`(`oid`, `item_id`, `rate`, `qty`, `discount`,total_amt,mrc_id,cat_id,track_id,status,color,size) VALUES ('".$insertid."','".$fetchcart[2]."','".$fetchcart[6]."','".$fetchcart[3]."','0','".$fetchcart[10]."','".$fetchp[2]."','".$c."','".$a."','pending','".$fetchcart['color']."','".$fetchcart['size']."')");
if(!$qryorderdetails)
{
  $errs++;  
}
}

$updtcrt=mysqli_query($con1,"update cart set status='1',order_id='".$insertid."' where user_id='".$id."' and status=0 and id in($carids)");
if(!$updtcrt)
{
  $errs++;  
}


if($errs==0)
{
mysqli_query($con1,"COMMIT");
echo $insertid;
}
else
{
    mysqli_query($con1,"ROLLBACK");
echo 0;
}
}
}else
{
    echo 2;
}
?>