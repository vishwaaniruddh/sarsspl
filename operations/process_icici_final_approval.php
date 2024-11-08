<?php
include("access.php");
include("config.php");

//echo "hello";

$qid=$_POST['qid'];
$appamt=$_POST['appamtu'];

$pocap=$_POST['pocap'];
$po=$_POST['po'];
$pr=$_POST['pr'];
$sr=$_POST['sr'];

$reqamt=$_POST['reqamt'];
$svn=$_POST['svn'];

//echo $qid;
//echo $pocap."-".$po."-".$pr."-".$sr;

$error=0;




mysqli_query($con,"BEGIN");



$qryup=mysqli_query($con,"UPDATE quotation_approve_details set app_amt='".$appamt."',pocap='".$pocap."',po='".$po."',pr='".$pr."',sr='".$sr."',req_amt='".$reqamt."' where qid='".$qid."'");
if(!$qryup)
{
$error++;
}




if($reqamt!="0")
{
$qryup2=mysqli_query($con,"UPDATE quotation1 set status='app' where id='".$qid."'");
if(!$qryup2)
{
$error++;
}
}

if($svn!=-1)
{
$qryup3=mysqli_query($con,"UPDATE quotation1 set supervisor='".$svn."' where id='".$qid."'");
if(!$qryup3)
{
$error++;
}

}


if($error==0)
{
mysqli_query($con,"COMMIT");
echo "Approved";
}
else

{
mysqli_query($con,"ROLLBACK");

echo "Error";

}

?>