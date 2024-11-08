<?php
include("config.php");
$tempid=$_POST['tempid'];
$custid=$_POST['custid'];
//echo "Select * from tempebill where tempid='".$tempid."'";
$qry=mysqli_query($con,"Select * from tempebill where tempid='".$tempid."'");
if(mysqli_num_rows($qry)>0)
{
/*echo $up="update tempebill set `Consumer_No`='".$_POST['con_no']."',`Distributor`='".$_POST['distributor']."',`landlord`='".$_POST['landlord']."', `billing_unit`='".$_POST['billunit']."',`meter_no`='".$_POST['meterno']."' where tempid='".$_POST['tempid']."'";*/

$up=mysqli_query($con,"update tempebill set `Consumer_No`='".$_POST['con_no']."',`Distributor`='".$_POST['distributor']."',`landlord`='".$_POST['landlord']."', `billing_unit`='".$_POST['billunit']."',`meter_no`='".$_POST['meterno']."' where tempid='".$_POST['tempid']."'");
}
else
{
/*echo "insert into tempebill(Distributor,Consumer_No,landlord,billing_unit,meter_no,tempid,ATM_ID,custid) values('".$_POST['distributor']."','".$_POST['con_no']."','".$_POST['landlord']."','".$_POST['billunit']."','".$_POST['meterno']."','".$tempid."','".$_POST['atmid']."','".$custid."')";

echo "update newtempsites set ebill='Y' where id='".$tempid."'";*/
$up=mysqli_query($con,"insert into tempebill(Distributor,Consumer_No,landlord,billing_unit,meter_no,tempid,ATM_ID,custid) values('".$_POST['distributor']."','".$_POST['con_no']."','".$_POST['landlord']."','".$_POST['billunit']."','".$_POST['meterno']."','".$tempid."','".$_POST['atmid']."','".$custid."')");

$qryup=mysqli_query($con,"update newtempsites set ebill='Y' where id='".$tempid."'");
}
if($up)
header('location:newsitelevel1.php?cid='.$_POST['custid']);
else
echo "Some Error Occurred".mysqli_error();
?>