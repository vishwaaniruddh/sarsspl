<?php
include("access.php");
include("config.php");

$cust=$_POST['cust'];
$atm=$_POST['atm'];


//$cid=$_POST['cid'];
//echo "select * from ".$cust."_sites where atm_id1='".$atm."'";

$qry=mysqli_query($con,"select * from ".$cust."_sites where atm_id1='".$atm."'");

$qrynum=mysqli_num_rows($qry);

if($qrynum==0)
{

echo "1";

}
else
{
$row=mysqli_fetch_array($qry);
echo '#'.$row[10]."#".$row[25]."#".$row[23]."#".$row[13];
//."#".row[23]."#".row[25]."#".row[13]."#";

}

?>