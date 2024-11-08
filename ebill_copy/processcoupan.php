<?php

session_start();

if(!$_SESSION['user'])

{

header('location:index.php');

}

elsemysqli_

{

include("config.php");

$dt=date('Y-m-d H:i:s');

$str2="Umysqli_`ebillfundrequests` SET `pstat`='1' WHERE req_no='".$_POST['reqno']."'";

echo $str2;

$qry=mysql_query($str2);

if($qmysqli_

{

/*if(isset($_POST['fundid']))

{

for(mysqli_i<count($_POST['fundid']);$i++)

{mysqli_

$ins="INSERT INTO `ebillfundcancinv` (`id`, `reqid`, `entrydt`, `updtby`, `status`) VALUES (NULL, '".$_POST['fundid'][$i]."', '".$dt."', '".$_SESSION['user']."', '0')";

$insqry=mysql_query($ins);

}
mysqli_
}*/

for($i=0;$i<$_POST['reccnt'];$i++)

{

echo "INSERT INTO `coupanrec` (`id`, `reqid`, `paiddt`, `amt`, `tarif`, `status`) VALUES (NULL, '".$_POST['reqno']."', STR_TO_DATE('".$_POST['paiddt'][$i]."','%d/%m/%Y'), '".$_POST['paidamt'][$i]."', '".$_POST['tariff'][$i]."', '0')";

$rec=mysql_query("INSERT INTO `coupanrec` (`id`, `reqid`, `paiddt`, `amt`, `tarif`, `status`) VALUES (NULL, '".$_POST['reqno']."', STR_TO_DATE('".$_POST['paiddt'][$i]."','%d/%m/%Y'), '".$_POST['paidamt'][$i]."', '".$_POST['tariff'][$i]."', '0')");

}



$memo=str_replace("'","\'",$_POST['memo']);

$pdt=str_replace('/','-',$_POST['pdt']);

$pdt2=date('Y-m-d',strtotime($pdt));

$dt=date('Y-m-d H:i:s');

//echo "INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`,`upby`,`status`,`extrachrg`) VALUES ('".$_POST['reqno']."', '".array_sum($_POST['paidamt'])."','".$pdt2."', '".$memo."','".$dt."','".$_SESSION['user']."','".$_POST['paid']."','0')";

$qr=mysql_query("INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`,`upby`,`status`,`extrachrg`) VALUES ('".$_POST['reqno']."', '".array_sum($_POST['paidamt'])."','".$pdt2."', '".$memo."','".$dt."','".$_SESSION['user']."','".$_POST['paid']."','0')");

if(!$qr)

echo mysql_error();

if(isset($_POST['page']) && $_POST['page']=='update')

header('location:viewpaidebill.php?cid='.$_POST['cid']);

else

header('location:generateEbill.php?cid='.$_POST['cid']);

}

else

echo "Error Updating data".mysql_error();

}

?>