<?php 
include("access.php");
include("config.php");

//echo "hello";


$matgarr=$_POST['matgarr'];
$servnoarr=$_POST['servnoarr'];
$matextarr=$_POST['matextarr'];
$gpricearr=$_POST['gpricearr'];
$qntyarr=$_POST['qntyarr'];
$unitarr=$_POST['unitarr'];
$amtarr=$_POST['amtarr'];
$remarr=$_POST['remarr'];
$qid=$_POST['qid'];

$errors="0";

mysqli_query($con,"BEGIN");

for($i=0;$i<count($matgarr);$i++)
{



if($amtarr[$i]!="")
{
$qrins2=mysqli_query($con,"INSERT INTO `icici_quot_details_tis`( `qid`, `material_group`, `service_no`, `material_text`, `gprice`, `qnty`, `unit`, `amt`, `remark`) values('".$qid."','".$matgarr[$i]."','".$servnoarr[$i]."','".$matextarr[$i]."','".$gpricearr[$i]."','".$qntyarr[$i]."','".$unitarr[$i]."','".$amtarr[$i]."',
'".$remarr[$i]."')");
if(!$qrins2)
{
$errors++;
}

}


}

if($errors==0)
{
mysqli_query($con,"COMMIT");
echo "Quotation Updated";

}
else
{
mysqli_query($con,"ROLLBACK");

echo "Error";

}



