<?php
include("access.php");
include("config.php");
//echo "hello";

$qidarr=$_POST['qidarrs'];

$invno=$_POST['invno'];

$error='0';

$dt=date('y-m-d H:i:s');

$cnt=count($qidarr);

//echo $invno;

//echo $cnt; 
//print_r($qidarr);

mysqli_query($con,'BEGIN');

for($i=0;$i<$cnt;$i++)
{

$insqry=mysqli_query($con,"insert into quotation1_bill_details(qid,invno,entrydt)values('".$qidarr[$i]."','".$invno."','".$dt."')");
if(!$insqry)
{
$error++;
}

$updqry=mysqli_query($con,"update quotation1 set billing_status='y' where id='".$qidarr[$i]."'");
if(!$updqry)
{
$error++;
}



}


if($error==0)
{
mysqli_query($con,'COMMIT');
echo "Invoice Done";
}
else
{
mysqli_query($con,'ROLLBACK');
echo "Error";
}


?>

