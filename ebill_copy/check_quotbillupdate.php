<?php
include("access.php");
include("config.php");
//echo "hello";

$mnth=$_POST['mnth'];
$yr=$_POST['yr'];
$bnk=$_POST['bnk'];
$invno=$_POST['invno'];
$cust=$_POST['cust'];

//echo $invno;

//echo "select id from quotation1 where month='".$mnth."' and year='".$yr."' and bank='".$bnk."' and status='y' and id in(select qid from quotation_approve_details ) ";

$chqry=mysqli_query($con,"select * from quotation1 where cust='".$cust."' and status!='c' and category='a' and month='".$mnth."' and year='".$yr."' and bank='".$bnk."' and billing_status='y' and id in(select qid from quotation_approve_details ) ");

/*echo "select * from quotation1 where cust='".$cust."' and status!='c' and category='a' and month='".$mnth."' and year='".$yr."' and bank='".$bnk."' and billing_status='y' and id in(select qid from quotation_approve_details ) ";*/
$nors=mysqli_num_rows($chqry);
if($nors>0)
{
echo "1";
}
else
{
echo "0";
}
?>