<?php
session_start();
if(!$_SESSION['user'])
header('location:index.php');
include("config.php");
$status=0;

$errors=0;

$pro_qry=mysqli_query($con,"select projectid,bank,state from ".$_POST['cust']."_sites where trackerid like '".$_POST['trackid']."'");
$pro=mysqli_fetch_array($pro_qry);
$state=$pro[2];

if($_POST['cust']=='FSS04' || $_POST['cust']=='DIE002' || $_POST['cust']=='AGS01')
{
$state='Maharashtra';
}else
{
    
$state=$pro[2];
}


$invd='';
$totcnt='0';
if($_POST['cust']=='Tata05')
{
$totcnt='10';
}
elseif($_POST['cust']=='AGS01')
{
$totcnt='80';
}

elseif($_POST['cust']=='HITACHI07')
{
$totcnt='15';
}
elseif($_POST['cust']=='DIE002')
{
$totcnt='200';
}
elseif($_POST['cust']=='FIS03')
{
$totcnt='100';
}
else
{
$totcnt='20';
}



if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); }else{ $invd=date('y',strtotime('-1 year'))."-".date('y'); }
$sql5ss="";
if($_POST['cust']=='AGS01')
{


if($_POST['projectid']=='PSU')
{
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."' and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and state='".$state."' and open='0'";

}
else
{
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."'  and projectid='".$_POST['projectid']."' and bank='".$_POST['bank']."' and createdby='".$_SESSION['user']."' and state='".$state."' and open='0'";

}

}
elseif($_POST['cust']=='FIS03')
{
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."' and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and state='".$state."' and open='0'";
}
elseif($_POST['cust']=='Tata05')
{
    
    if($_POST['projectid']=="MOF")
    {
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."'  and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and state='".$state."' and open='0'";
  }else
  {
      $sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."' and bank='".$_POST['bank']."' and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and state='".$state."' and open='0'";
      
  }
  
}
else
{
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."' and bank='".$_POST['bank']."' and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and state='".$state."' and open='0'";
}

echo $sql5ss."<br>";
?>