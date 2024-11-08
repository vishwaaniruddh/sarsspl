<?php


include 'config.php';
$bill=$_POST['bill'];
$name = $_POST['name'];
$agesex = $_POST['fd'];
$address = $_POST['inv'];
$contact = $_POST['datead'];
//$refno=$_POST['refno'];
// $dateref=$_POST['dateref'];y
$proc=$_POST['proc'];
$rate=$_POST['rate'];
$amt=$_POST['amt'];
$qty=$_POST['qty'];
$discount = $_POST['discount'];

$totalamt=$_POST['totalamt'];
$totalrem=$_POST['totalrem'];
$totaldisc = $_POST['totaldiscamt'];
$paytype = $_POST['paytype'];
$rem=$totalrem;
$d=count($proc);
$created_at = date("Y-m-d H:i:s");

mysqli_query($con,"insert into servicebill(name,agesex,address,contact,amt,discount,remark,department,billno,paytype,created_at) values('$name','$agesex','$address','$contact','$totalamt','$totaldisc','$rem','$dept','$bill','$paytype','$created_at')");

for($i=0;$i<$d;$i++)
{ 

mysqli_query($con,"insert into servicebill_details(code,rate,discount,qty,type,billno,created_at) values('$proc[$i]','$rate[$i]','$discount[$i]','$qty[$i]','1','$bill','$created_at')");		  
}


header('location:home.php');

?>