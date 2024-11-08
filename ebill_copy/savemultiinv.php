<?php
include('config.php');
$comp=$_POST['comp'];
$city=$_POST['city'];
$service=$_POST['service'];
$amt=$_POST['totamt'];
$state=$_POST['state'];
$svtx=$_POST['svtx'];
$edutx=$_POST['edutx'];
$hgedutx=$_POST['hgedutx'];
$cid=$_POST['cust'];
$project=$_POST['project'];
$bk=$_POST['bank'];
$po=$_POST['po'];
$zone=$_POST['zone'];
$stdt=$_POST['stdt'];
$todt=$_POST['todt'];
$inv=$_POST['inv'];
$invdt=$_POST['invdate'];
$autoid=explode(",",$_POST['autoid']);
$billfrm=explode(",",$_POST['billfrm']);
$billto=explode(",",$_POST['billto']);
$atm=explode(",",$_POST['atm']);
$atmid2=explode(",",$_POST['atmid2']);
$sitezone=explode(",",$_POST['sitezone']);
$tkdt=explode(",",$_POST['tkdt']);
$hodt=explode(",",$_POST['hodt']);
$nod=explode(",",$_POST['nod']);
$billamt=explode(",",$_POST['billamt']);
$siterate=explode(",",$_POST['siterate']);
$siteproject=explode(",",$_POST['siteproject']);
$citycat=explode(",",$_POST['citycat']);
$subcat=explode(",",$_POST['subcat']);
$sitebank=explode(",",$_POST['sitebank']);
$siteid=explode(",",$_POST['siteid']);
$invd='';

if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); }else{ $invd=date('y',strtotime('-1 year'))."-".date('y'); }


//echo "select max(invid) from siteinvoice where compid='".$comp."' and status='0' and fiscalyr='".$invd."'";
$invc=mysqli_query($con,"select max(invid) from siteinvoice where compid='".$comp."' and status='0' and fiscalyr='".$invd."'");
 $invcro=mysqli_fetch_row($invc);
// echo $invcro[0];
 if($invcro[0]=="null")
 {
 $inv='1';
 }
else
{
//echo "hi";
 $inv=($invcro[0]+1);
}

$dt=date('Y-m-d H:i:s');
//echo "INSERT INTO `siteinvoice` (`invid`, `compid`, `custid`, `bank`, `fromdt`, `todt`, `servicetype`, `amt`, `status`,`city`) VALUES ('$inv', '$comp', '$cid', '$bank', '$frmdt', '$todt', '$service', '$amt', '0','$city')<br>";
$ins=mysqli_query($con,"INSERT INTO `siteinvoice` (`invid`, `compid`, `custid`, `bank`, `fromdt`, `todt`, `servicetype`, `amt`, `status`,`city`,`fiscalyr`,`billdate`,`projectid`,`zone`,`pono`,`state`,`svtx`,`edutx`,`hgedutx`) VALUES ('$inv', '$comp', '$cid', '$bk', '$stdt', '$todt', '$service', '$amt', '0','$city','".$invd."','".$dt."','".$project."','".$zone."','".$po."','".$state."','".$svtx."','".$edutx."','".$hgedutx."')");
if($ins)
{
for($i=0;$i<count($autoid);$i++)
{
//echo "INSERT INTO `siteinvoiceatm` (`id`, `invid`, `atmid`, `status`, `compid`, `handoverdt`, `takeoverdt`, `billfrom`, `billto`, `no_of_days`, `amt`, `rate`, `category`, `subcat`,  `fiscalyr`, `projectid`, `bank`, `siteid`, `atmid2`,  `zone`, `atm_id`) VALUES (NULL, '".$inv."', '".$autoid[$i]."', '0', '".$comp."', '".$hodt[$i]."', '".$tkdt[$i]."', '".$billfrm[$i]."', '".$billto[$i]."', '".$nod[$i]."', '".$billamt[$i]."', '".$siterate[$i]."', '".$citycat[$i]."', '".$subcat[$i]."',  '".$invd."', '".$siteproject[$i]."', '".$sitebank[$i]."', '".$siteid[$i]."', '".$atmid2[$i]."',  '".$sitezone[$i]."', '".$atm[$i]."')";
$invatm=mysqli_query($con,"INSERT INTO `siteinvoiceatm` (`id`, `invid`, `atmid`, `status`, `compid`, `handoverdt`, `takeoverdt`, `billfrom`, `billto`, `no_of_days`, `amt`, `rate`, `category`, `subcat`,  `fiscalyr`, `projectid`, `bank`, `siteid`, `atmid2`,  `zone`, `atm_id`) VALUES (NULL, '".$inv."', '".$autoid[$i]."', '0', '".$comp."', '".$hodt[$i]."', '".$tkdt[$i]."', '".$billfrm[$i]."', '".$billto[$i]."', '".$nod[$i]."', '".$billamt[$i]."', '".$siterate[$i]."', '".$citycat[$i]."', '".$subcat[$i]."',  '".$invd."', '".$siteproject[$i]."', '".$sitebank[$i]."', '".$siteid[$i]."', '".$atmid2[$i]."',  '".$sitezone[$i]."', '".$atm[$i]."')");

}

echo $inv;
}
else
echo "0";
?>