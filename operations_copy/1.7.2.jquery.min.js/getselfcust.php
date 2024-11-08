<?php 
session_start();
  $custid=$_GET['cust'];
 $sescust= $_GET['sescust'];
  if($sescust!='all' && $sescust!='')
  {
  $sescust=explode(',',$_GET['sescust']);
$cid=array();
$cnt=0;

for($i=0;$i<count($sescust);$i++)
{
$cid[]=$sescust[$i];
if(in_array($custid,$cid))
{
$cnt='1';
break;
}
}
echo $cnt;
}
else
echo "1";
?>