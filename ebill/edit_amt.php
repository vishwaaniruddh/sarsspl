<?php 
include("config.php");

$a=$_POST["a"];
$b=$_POST["b"];
$c=$_POST["c"];
$d=$_POST["d"];
$e=$_POST["e"];
$amt=explode(",",$a);
$qid=explode(",",$b);
$atm=explode(",",$c);
$bank=explode(",",$d);
$state=explode(",",$e);
$result=0;
for($i=0;$i<count($amt);$i++){
 //  echo $amt[$i];
 //  echo "update rnm_invoice_details set ApprovalAmount='".$amt[$i]."' where id='".$qid[$i]."' ";
 $result=mysqli_query($con,"update rnm_invoice_details set ApprovalAmount='".$amt[$i]."',atm='".$atm[$i]."',bank='".$bank[$i]."',state='".$state[$i]."' where id='".$qid[$i]."' ");
       
}
if($result>0){
    echo 1;
}
else{
    echo 0;
}

?>