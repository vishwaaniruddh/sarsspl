<?php
include("access.php");
include('config.php');
$ctsalid=$_POST['ctsalid'];
$paymsel=$_POST['paymsel'];

//print_r($ctsalid);
//print_r($paymsel);

$error='0';
$dt=date('Y-m-d H:i:s');

$paytyps=$_POST['paytyps'];
$chqname=$_POST['chqname'];
$chqno=$_POST['chqno'];
$dbtacc=$_POST['dbtacc'];
$mbody=$_POST['mbody'];
$mby=$_POST['mby'];
$ctyp=$_POST['ctyp'];

$mnth=$_POST['mnth'];
$yr=$_POST['yr'];

$chqdt='000-00-00';
if($_POST['tdt']!="")
{
$dt2=str_replace("/","-",$_POST['tdt']);
	$chqdt=date('Y-m-d', strtotime($dt2));
}

$cnt=count($ctsalid);

$getmaxno=mysqli_query($con,"select max(tid) from salary_generate_details where  month='".$mnth."' and year='".$yr."'");
$numrows=mysqli_num_rows($getmaxno);






$qno="0";
if($numrows>0)
{
$qryr=mysqli_fetch_array($getmaxno);
$qno=$qryr[0]+1;
}
else
{
$qno=1;

}
mysqli_query($con,"BEGIN");

for($i=0;$i<$cnt;$i++)
{
$gsvid=mysqli_query($con,"select accid,total_salary from ct_salaryimport where  id='".$ctsalid[$i]."'");
$gsrow=mysqli_fetch_array($gsvid);

$gaccno=mysqli_query($con,"select accno from salary_acc where id='".$gsrow[0]."'");
$accrow=mysqli_fetch_array($gaccno);

$chckamt=mysqli_query($con,"select sum(tamount) from salary_generate_details where ctid='".$ctsalid[$i]."'");
$chamtrow=mysqli_fetch_array($chckamt);

$totalsal=round($gsrow[1]);
$transferred=round($chamtrow[0]);
$nw=round($transferred+$paymsel[$i]);
$diffr=round($totalsal-$nw);

//echo $totalsal."+".$transferred."+".$nw;

//print_r($paymsel);

$insq=mysqli_query($con,"INSERT INTO `salary_generate_details`(`ctid`,tid, `type`, `pay_typ`, `name`, `chq_no`, `pdate`, `dbtaccno`, `email_body`, `mail_by`, `entrydt`,month,year,tamount,accid,accno) VALUES('".$ctsalid[$i]."','".$qno."','".$ctyp."','".$paytyps."','".$chqname."','".$chqno."','".$chqdt."','".$dbtacc."','".$mbody."','".$mby."','".$dt."','".$mnth."','".$yr."','".$paymsel[$i]."','".$gsrow[0]."','".$accrow[0]."')");
if(!$insq)
{
$error++;
}

if($diffr=='0')
{

$updateqr=mysqli_query($con,"update ct_salaryimport set status='2' where id='".$ctsalid[$i]."'");
if(!$updateqr)
{
$error++;
}

}

}

if($error=='0')
{
mysqli_query($con,'COMMIT');
echo $qno;
}
else
{
mysqli_query($con,"ROLLBACK");
echo "Error";
}

?>