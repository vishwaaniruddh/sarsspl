<?php
include("config.php");
$id=$_GET['id'];

$tkdt=str_replace("/","-",$_GET['tkdt']);
$tkdt=date('Y-m-d',strtotime($tkdt));
if($htdt!=''){
$htdt=str_replace("/","-",$_GET['htdt']);
$htdt=date('Y-m-d',strtotime($htdt));
}
else
$htdt='0000-00-00';
$rate=$_GET['rate'];
$amt=$_GET['amt'];
$amt2=$_GET['amt2'];
$ndays=$_GET['ndays'];
$inv=$_GET['invid'];
mysqli_query($con,"update siteinvoice set amt=amt-".$amt2." where invid='".$inv."'");
mysqli_query($con,"update siteinvoice set amt=amt+".$amt." where invid='".$inv."'");
//echo "update siteinvoiceatmme set handoverdt='".$htdt."',takeoverdt='".$tkdt."',rate='".$rate."',amt='".$amt."',no_of_days='".$ndays."' where id='".$id."' ";
$qry=mysqli_query($con,"update siteinvoiceatm set handoverdt='".$htdt."',takeoverdt='".$tkdt."',rate='".$rate."',amt='".$amt."',no_of_days='".$ndays."' where id='".$id."' ");
if($qry)
echo "1";
else
echo "0".mysqli_error();
?>