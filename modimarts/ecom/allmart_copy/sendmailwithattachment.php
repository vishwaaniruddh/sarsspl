<?php
if(!isset($_SESSION))
{
session_start();
}
include('config.php');


$geteml3=mysqli_query($con1,"select * from `Orders` where id='".$orderno."' ");
$getemlrws3=mysqli_fetch_array($geteml3);
$pdfpath=$getemlrws3[8];



$c=0;
$data = array();
$ordrdetail=mysqli_query($con1,"select * from `order_details` where oid='".$orderno."' ");

$cout=mysqli_num_rows($ordrdetail);
while($fetchOrdDetails=mysqli_fetch_assoc($ordrdetail))
{
  $data[] = $fetchOrdDetails;

 $c++;
}
//echo $c;





$getemls23=mysqli_query($con1,"select email from Registration where id='".$_SESSION['gid']."'");
$rws23423=mysqli_fetch_array($getemls23);
$eml23=$rws23423[0];

require_once('phpmailerf/PHPMailer-master/class.phpmailer.php');
//$bodytext=nl2br("Your Order has been placed successfully :OrderNo is: ".$orderno ."\n",false);

$bodytext="We are Pleased to inform you that your order has been Successfully Delivered.";
$bodytext.="Your Order Number is:".$orderno ."\n";

for($i=0;$i<$c;$i++)
{
        $track=$data[$i]['track_id'];
    $prodcode=$data[$i]['item_id'];
    $prodCategory=$data[$i]['cat_id'];
    
    $QproductNm=mysqli_query($con1,"select * from Productviewtable where code='".$prodcode."' and category='".$prodCategory."' ");
    $fetchProdName=mysqli_fetch_array($QproductNm);
    
  
   $bodytext.=" Your Product Name is: ".$fetchProdName['name'] ."\n" ;
   
  
  //=====================send mail to merchant=================================
  $merchatEmail=mysqli_query($con1,"select id from users where cid='".$fetchProdName['ccode']."' ");
 $fetchmertantid= mysqli_fetch_array($merchatEmail);

 $merid= $fetchmertantid['id'];
 $subNewOrder="New Order";
 $messOrder="You have New order : OrderNo is: ".$orderno ."\n";
 $headersOrder = "From:".$eml23 . "\r\n" ;
 
  mail($merid,$subNewOrder,$messOrder,$headersOrder);
 //============================================================================ 
}

$bodytext.="Thank you for kind Purchese hope to see you soon...";

//$emlig='meanand.gupta21@gmail.com';
$email = new PHPMailer();
$email->From      = 'merabazar@sarmicrosystems.in';
$email->FromName  = 'Mera Bazar';
$email->Subject   = 'Order Details';
$email->Body      = $bodytext;
$email->AddAddress($eml123);
//$email->AddAddress($emlig);





if($eml23!="")
{

$em=explode(",",$eml23);


for($b=0;$b<count($em);$b++)
{

//$email->AddAddress($em[$b]);

$email->AddBCC($em[$b], '');
//$mail->AddCC('person2@domain.com', 'Person Two');

}
}


$file_to_attach =$pdfpath;

$email->AddAttachment( $file_to_attach , $orderno.'.pdf' );


if($email->Send())
{
//echo 1;
}else
{
//echo 2;
//echo $email->ErrorInfo;
}


?>