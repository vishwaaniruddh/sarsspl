<?php
include("config.php");
//echo $_GET['tp'];

 $proj=$_GET['project'];
$proj=str_replace(",","','",$proj);
$proj="'".$proj."'";
 $service=$_GET['service'];
 $cid=$_GET['cid'];
$str='';
$service2=explode(" ",$service);
$service=$service2[0];
$qrstr='';
if($service2[1]=='CT')
$qrstr=" and caretaker='Y'";
if($service2[1]=='HK')
$qrstr=" and housekeeping='Y'";

$str="select distinct(bank) from ".$cid."_sites where active='Y' and ".$service."='Y' ".$qrstr." ";
if($_GET['project']!='-1')
$str.=" and projectid in($proj) ";

$str.=" order by bank ASC";

//echo $str;
$sql=mysqli_query($con,$str);
?>
<option value="x@">Select Bank</option>
<?php
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}



?><option value="-1">All</option>