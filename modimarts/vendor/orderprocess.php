<?php
session_start();

include "config.php"; 
$oid=$_POST['oid'];
$var=$_POST['num'];
$Session_merid=$_POST['Session_merid'];

//echo "heyj".$oid;
//$qry=mysqli_query($con1,"select status from Orders where  id='".$oid."'");
$qry=mysqli_query($con1,"select status,item_id,cat_id from order_details where  oid='".$oid."' and mrc_id='".$Session_merid."'");
$fetch=mysqli_fetch_array($qry);

$queryProduct=mysqli_query($con1,"select name from Productviewtable where code='".$fetch['item_id']."' and category='".$fetch['cat_id']."'");
$FetchProduct=mysqli_fetch_array($queryProduct);
$name=$FetchProduct['name'];
$s= $fetch[0];
//echo "heys".$s;

if($s=="pending" || $s=="rej" || $s=="c" || $s=="Accept" || $s=="pr" || $s=="dis" ){

$qry1=mysqli_query($con1,"select user_id from Orders where  id='".$oid."'");
$fetch_uid=mysqli_fetch_array($qry1);
$qry2=mysqli_query($con1,"select email from Registration where  id='".$fetch_uid[0]."'");
$fetch_email=mysqli_fetch_array($qry2);
//echo $fetch_email[0];

//$to =$fetch_email[0];

$to="meanand.gupta21@gmail.com";
$subject = "Product Details";
$txtacp = "Your product ($name) accepted!";
$txtrej = "Your product ($name) Rejected!";
$txtProcess = "Your product ($name) packaged!";
$txtdispatch = "Your product ($name) dispatched!";
//$txtdelivered = "Your product ($name) delivered!";


//$txtcomlp = " Dear sir/Madam,
$txtdelivered = " Dear sir/Madam,
                     Thank you for purchasing the order $name from our site (Merabazaar.com). 

Thanking You,
(Merabazaar)";


$headers = "From: Merabazaar@example.com" . "\r\n" .
"CC: sarmicrosystems@example.com";
 
 if($s=="pending" && $var=="0" ){
mail($to,$subject,$txtacp,$headers);
}else if($s=="pending" && $var=="4"){
    mail($to,$subject,$txtrej,$headers);
}
else if($s=="c" && $var=="5"){
   
    mail($to,$subject,$txtcomlp,$headers);
}
else if($s=="Accept" && $var=="1"){
   
    mail($to,$subject,$txtProcess,$headers);
}
else if($s=="pr" && $var=="2"){
   
    mail($to,$subject,$txtdispatch,$headers);
}
else if($s=="dis" && $var=="3"){
   
    mail($to,$subject,$txtdelivered,$headers);
}



}

$st="";
if($var==0)
{
$st="Accept";

}

else if($var==1)
{
$st="pr";

}
else if($var==2)
{
$st="dis";

}
else if($var==3)
{
$st="c";
}
else if($var==4)
{
$st="rej";
}
else if($var==5)
{
$st="completed";
}

$date = date('Y-m-d H:i:s');
//echo "stststt  :  ".$st."varrrrn ".$var;
//$qryinsert=mysqli_query($con1,"INSERT INTO `order_details`(`oid`, `dt`, `status`) VALUES ('".$oid."','".$date."','".$st."')");

//$qryinsert=mysqli_query($con1,"INSERT INTO `order_details`(`oid`,`status`) VALUES ('".$oid."','".$st."')");

$qryinsert=mysqli_query($con1,"update `order_details` set `status`='".$st."' where oid='".$oid."' and mrc_id='".$Session_merid."' ");

//echo "ram"."update `order_details` set `status`='".$st."' where oid='".$oid."'";

$qryupdt=mysqli_query($con1,"update `Orders` set `status`='".$st."' where id='".$oid."'");

//echo "ramgupta"."update `Orders` set `status`='".$st."' where id='".$oid."'";
?>