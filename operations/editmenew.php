<?php
include("access.php");
include("config.php");
$cid=$_POST['custid'];
$id=$_POST['autoid'];
//echo $cid;
//echo $id;
$ct='N';
$hk='N';
$fm='N';
$eb='N';
$cttkdt='0000-00-00';
$hktkdt='0000-00-00';
$fmtkdt='0000-00-00';
if(isset($_POST['ctchk']))
{
$cttkdt=$_POST['ctake'];
$ct='Y';
}
if(isset($_POST['mtchk']))
{
$fmtkdt=$_POST['mtake'];
$fm='Y';
}

if(isset($_POST['hkchk']))
{
$hktkdt=$_POST['htake'];
$hk='Y';
}
if(isset($_POST['ebill']))
{
$eb='Y';
}

echo "update ".$_POST['custid']."_sites set caretaker='".$ct."' set housekeeping='".$hk."',set maintenance='".$fm."',set ebill='".$eb."',set takeover_date='".$cttkdt."',set housekeeping_tkdt='".$hktkdt."',set maintenance_tkdt='".$fmtkdt."' where id='".$id."'";
?>