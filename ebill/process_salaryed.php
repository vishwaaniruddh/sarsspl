<?php
include("access.php");
include("config.php");
$tid=$_POST['tid'];

$name=$_POST['chn'];
$chno=$_POST['chno'];

$chqdt='000-00-00';
if($_POST['td']!="")
{
$dt2=str_replace("/","-",$_POST['td']);
	$chqdt=date('Y-m-d', strtotime($dt2));
}


$updqry=mysqli_query($con,"update salary_generate_details set name='".$name."',chq_no='".$chno."',pdate='".$chqdt."' where tid='".$tid."'");
if(!$updqry)
{
echo "Error";
}
else
{

echo "Updated";
}

?>