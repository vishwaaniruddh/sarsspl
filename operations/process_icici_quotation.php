<?php 
include("access.php");
include("config.php");

//echo "hello";


$matgarr=$_POST['matgarr'];
$servnoarr=$_POST['servnoarr'];
$matextarr=$_POST['matextarr'];
$gpricearr=$_POST['gpricearr'];
$qntyarr=$_POST['qntyarr'];
$unitarr=$_POST['unitarr'];
$amtarr=$_POST['amtarr'];
$remarr=mysqli_real_escape_string($con,$_POST['remarr']);


$sol=$_POST['sol'];
$bank=$_POST['bank'];
$addr=mysqli_real_escape_string($con,$_POST['loc']);
$cust=$_POST['cust'];
$city=$_POST['city'];
$state=$_POST['state'];
$typ=$_POST['typ'];
$sv=$_POST['sv'];

//echo $sol."-".$bank."-".$addr."-".$proj."-".$city."-".$state;


$cmnth=date('M');

$mnthno=date('m');






/*
print_r($matgarr);
echo "<br>";
print_r($servnoarr);
echo "<br>";
print_r($matextarr);
echo "<br>";
print_r($gpricearr);
echo "<br>";
print_r($qntyarr);



print_r($unitarr);
echo "<br>";
print_r($amtarr);
echo "<br>";
print_r($remarr);
echo "<br>";
*/



$errors="0";

$dt=date('Y-m-d H:i:s');


try
{


$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);

$yr="";
if($mnthno>=4)
{
$yr=date('Y') .'-'. (date('y')+1);
}
elseif($mnthno<4)
{

$yr=(date('Y')-1) .'-'.date('y');
}

//echo "select max(qno) from quotation1 where cust='".$cust."' and month='".$cmonth."'";
$getmaxno=mysqli_query($con,"select max(qno) from quotation1 where cust='".$cust."' and month='".$cmnth."' and year='".$yr."'");
$numrows=mysqli_num_rows($getmaxno);

$qno="";
if($numrows>0)
{
$qryr=mysqli_fetch_array($getmaxno);
$qno=$qryr[0]+1;
}
else
{
$qno=1;

}

$qrynm=mysqli_query($con,"select cust_name from  ".$cust."_sites where cust_id='".$cust."' ");
                  $qname=mysqli_fetch_array($qrynm);
                 
$quotid="CSS/".$qname[0]."/".sprintf("%02d", $qno)."/".$cmnth."/".$yr;
// mysqli_query($con,"BEGIN");
mysqli_autocommit($con,FALSE);



 $qrins=mysqli_query($con,"Insert into quotation1 (`quot_id`,`cust`, `atm`, `bank`,`project_id`, `location`, `city`, `state`, `reqby`, `entrydate`,`category`, `month`,`year`, `qno`, `supervisor`)
values('".$quotid."','".$cust."','".$sol."','".$bank."','','".$addr."','".$city."','".$state."','".$srno[0]."','".$dt."','".$typ."','".$cmnth."','".$yr."','".$qno."','".$sv."')");

if(!$qrins)
{

$errors++;
}


$getqid=mysqli_insert_id($con);

for($i=0;$i<count($matgarr);$i++)
{



if($amtarr[$i]!="")
{
$qrins2=mysqli_query($con,"INSERT INTO `icici_quot_details`( `qid`, `material_group`, `service_no`, `material_text`, `gprice`, `qnty`, `unit`, `amt`, `remark`) values('".$getqid."','".$matgarr[$i]."','".$servnoarr[$i]."','".$matextarr[$i]."','".$gpricearr[$i]."','".$qntyarr[$i]."','".$unitarr[$i]."','".$amtarr[$i]."',
'".$remarr[$i]."')");
if(!$qrins2)
{
$errors++;
}

}


}


if($errors==0)
{
// mysqli_query($con,"COMMIT");
mysqli_commit($con);
echo "Quotation Submitted..Quotation ID is-".$getqid;

}
else
{
// mysqli_query($con,"ROLLBACK");
mysqli_rollback($con);
echo "Error";

}

}
catch (Exception $e) {
    echo 'exception: ',  $e->getMessage(), "\n";
}



?>