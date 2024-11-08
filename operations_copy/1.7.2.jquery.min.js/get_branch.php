<?php 
include("config.php");
$city=$_GET['city'];

$qry=mysqli_query($con,"SELECT region,badd,city,pin FROM  cssbranch where location='$city' ");
$num=mysqli_num_rows($qry);
if($num>0)
{
$row=mysqli_fetch_row($qry);
echo $row[0]."##**".$row[1]."##**".$row[2]."##**".$row[3];
}
else
echo "0";
?>