<?php
include("config.php");
$comp=$_POST['comp'];

$cid=$_POST['cid'];
$service='Repair & Maintenance';
$state=$_POST['state'];
$amt=$_POST['amt'];
$bank=$_POST['bank'];
$quot=explode(",",$_POST['quot']);
 $str=$_POST[str];
$str2=explode('-',$str);

$inv=0;
$stat1=0;
$stat2=0;
$invdate='';

	if(date('m')>='4'){ $invdate=date('Y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('Y',strtotime('-1 year'))."-".date('y'); }
$invd='';

if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); }else{ $invd=date('y',strtotime('-1 year'))."-".date('y'); }

$invc=mysqli_query($con,"select max(invid) from siteinvoice where compid='".$comp."' and status='0' and fiscalyr='".$invd."'");
 $invcro=mysqli_fetch_row($invc);
 if($invcro[0]=="null")
 {
 $inv='1';
 /*if($comp=='1')
$inv='3207';
elseif($comp=='2')
$inv='1021';
*/ }
else
{
/*if($comp=='1' && $invcro[0]<3207)
$inv='3207';
elseif($comp=='2' && $invcro[0]<1021)
$inv='1021';
else*/
$inv=$invcro[0]+1;
}
//echo($atm);
//echo "<br>".count($atm)."<br>";
/*if($row[0]=="null")
$inv=1;
else
$inv=$row[0]+1;*/
$bk=0;
$dt=date('Y-m-d H:i:s');
//echo "INSERT INTO `siteinvoice` (`invid`, `compid`, `custid`, `bank`, `servicetype`, `amt`, `status`,`state`,`type`,`fiscalyr`,`billdate`,`atax`,`statetaxid`,`svtx`,`edutx`,`hgedutx`) VALUES ('$inv', '$comp', '$cid', '$bank',  '$service', '$amt', '0','".$state."','rmn','".$invd."','".$dt."','".$str2[0]."','".$str2[1]."','".$str2[3]."','".$str2[4]."','".$str2[5]."')<br>";
$ins=mysqli_query($con,"INSERT INTO `siteinvoice` (`invid`, `compid`, `custid`, `bank`, `servicetype`, `amt`, `status`,`state`,`type`,`fiscalyr`,`billdate`,`atax`,`statetaxid`,`svtx`,`edutx`,`hgedutx`) VALUES ('$inv', '$comp', '$cid', '$bank',  '$service', '$amt', '0','".$state."','rmn','".$invd."','".$dt."','".$str2[0]."','".$str2[1]."','".$str2[3]."','".$str2[4]."','".$str2[5]."')");
if(!$ins)
echo mysqli_error();
if($ins)
{
if($str2[0]=='Y')
{
$str3=explode("**",$str2[6]);
$tx1=explode(",",$str3[0]);
$tx2=explode(",",$str3[1]);
for($i=0;$i<count($tx1);$i++)
{
$qr=mysqli_query($con,"INSERT INTO `siteinvoicernmtax` (`id`, `tax`, `type`, `status`, `invid`, `fiscalyr`, `compid`) VALUES (NULL, '".$tx1[$i]."', '".$tx2[$i]."', '0', '".$inv."', '".$invd."', '".$comp."')");
}
//mysqli_query($con,)
}
$stat1=1;
for($i=0;$i<count($quot);$i++)
{
//echo "INSERT INTO `siteinvoicermnquot` (`id`, `invid`, `quotid`, `compid`,`fiscalyr`,`status`) VALUES (NULL, '".$inv."', '".$quot[$i]."','".$comp."','".$invd."', '0')";
$qr=mysqli_query($con,"INSERT INTO `siteinvoicermnquot` (`id`, `invid`, `quotid`, `compid`,`fiscalyr`, `status`) VALUES (NULL, '".$inv."', '".$quot[$i]."','".$comp."','".$invd."', '0')");
if(!$qr)
echo mysqli_error();
if($qr)
 $stat2=1;
else
 $stat2=0;
}


}
else
 $stat1=0;
 
 if($stat1=='1' && $stat2=='1')
 {

 $up=mysqli_query($con,"update quotation set bill='y' where req_no in (".$_POST['quot'].")");
 echo "CSS/RNM/".$inv."/".$invdate;
 }
 else
 {
$del=mysqli_query($con,"Delete from siteinvoice where invid='".$inv."' and compid='".$comp."'");
 $del2=mysqli_query($con,"Delete from siteinvoiceatm where invid='".$inv."' and compid='".$comp."'");
 echo 0;
 }

?>