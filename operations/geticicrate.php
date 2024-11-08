<?php
include("access.php");
include("config.php");



$servno=$_POST['servno'];

if($_POST['custd']=="kotak")
{

$qry="select * from kotak_rate where 1";
}
else
{
$qry="select * from icici_rate where 1";    
}

if($servno!="")
{

$qry.=" and service_no='".$servno."'";
}



$qra=mysqli_query($con,$qry);

$qrynum=mysqli_num_rows($qra);

if($qrynum==0)
{

echo "1";


}
else
{
//echo $qry;
$row=mysqli_fetch_array($qra);
echo '#'.$row['material_group']."#".$row['service_no']."#".$row['material_text']."#".$row['gross_price'];
//."#".row[23]."#".row[25]."#".row[13]."#";

}

?>