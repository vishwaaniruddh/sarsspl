<?php

//echo $_SESSION['user'];
include('access.php');
include('config.php');

$qid=$_POST['qrrarry'];

//print_r($qid);
$error='0';
$cnt=count($qid);

mysqli_query($con,'BEGIN');
for($i=0;$i<$cnt;$i++)
{
$upqry=mysqli_query($con,"update quotation1 set billing_status='p' where id='".$qid[$i]."' ");
if(!$upqry)
{
$error++;
}
}


if($error==0)
{
mysqli_query($con,'COMMIT');
echo "Updated";
}
else
{

mysqli_query($con,'ROLLBACK');
echo "Error";
}
?>