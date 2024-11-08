<?php
include("config.php");
$comp=$_POST['comp'];
$frmdt=$_POST['frmdt'];
$todt=$_POST['todt'];
$cid=$_POST['cid'];
$service=$_POST['serv'];

$amt=$_POST['amt'];
$bank=$_POST['bank'];
$atm=explode(",",$_POST['atm']);
$city=$_POST['city'];
$inv=0;
$stat1=0;
$stat2=0;
$tkdt=explode(",",$_POST['tkdt']);
$hddt=explode(",",$_POST['hddt']);
$nod=explode(",",$_POST['nod']);
$billamt=explode(",",$_POST['billamt']);
$siterate=explode(",",$_POST['siterate']);
$citycat=explode(",",$_POST['citycat']);
$subcat=explode(",",$_POST['subcat']);
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
//echo "INSERT INTO `siteinvoice` (`invid`, `compid`, `custid`, `bank`, `fromdt`, `todt`, `servicetype`, `amt`, `status`,`city`) VALUES ('$inv', '$comp', '$cid', '$bank', '$frmdt', '$todt', '$service', '$amt', '0','$city')<br>";
$ins=mysqli_query($con,"INSERT INTO `siteinvoice` (`invid`, `compid`, `custid`, `bank`, `fromdt`, `todt`, `servicetype`, `amt`, `status`,`city`,`fiscalyr`,`billdate`) VALUES ('$inv', '$comp', '$cid', '$bank', '$frmdt', '$todt', '$service', '$amt', '0','$city','".$invd."','".$dt."')");
if($ins)
{
$stat1=1;
for($i=0;$i<count($atm);$i++)
{
//echo "INSERT INTO `siteinvoiceatmme` (`id`, `invid`, `atmid`, `status`, `handoverdt`, `takeoverdt`, `no of days`, `amt`, `rate`, `category`, `subcat`) VALUES (NULL, '".$inv."', '".$atm[$i]."', '0', '".$hddt[$i]."', '".$tkdt[$i]."', '".$nod[$i]."', '".$billamt[$i]."', '".$siterate[$i]."', '".$citycat[$i]."', '".$subcat[$i]."')<br>";
$qr=mysqli_query($con,"INSERT INTO `siteinvoiceatm` (`id`, `invid`, `atmid`, `status`, `handoverdt`, `takeoverdt`, `no_of_days`, `amt`, `rate`, `category`, `subcat`,`fiscalyr`,`compid`) VALUES (NULL, '".$inv."', '".$atm[$i]."', '0', '".$hddt[$i]."', '".$tkdt[$i]."', '".$nod[$i]."', '".$billamt[$i]."', '".$siterate[$i]."', '".$citycat[$i]."', '".$subcat[$i]."','".$invd."','".$comp."')");
if(!$qr)
echo mysqli_error();
}

if($qr)
 $stat2=1;
else
 $stat2=0;
}
else
 $stat1=0;
 
 if($stat1=='1' && $stat2=='1')
 {
 echo $inv;
 }
 else
 {
 $del=mysqli_query($con,"Delete from siteinvoice where invid='".$inv."'");
 $del2=mysqli_query($con,"Delete from siteinvoiceatm where invid='".$inv."'");
 echo 0;
 }

?>