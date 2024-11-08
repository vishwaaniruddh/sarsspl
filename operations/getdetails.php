<?php
include("access.php");
include("config.php");

$atm=$_POST['atm'];


$cid=$_POST['cid'];
$qry=mysqli_query($con,"select * from ".$cid."_sites where atm_id1='".$atm."'");




$qrynum=mysqli_num_rows($qry);

if($qrynum==0)
{

echo "1";

}
else
{
$row=mysqli_fetch_array($qry);
echo '#'.$row[10]."#".$row[23]."#".$row[25]."#".$row[13]."#".$row[52];
//."#".row[23]."#".row[25]."#".row[13]."#";

}

?>