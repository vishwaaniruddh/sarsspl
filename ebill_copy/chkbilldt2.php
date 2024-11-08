<?php
include("config.php");
$val=$_GET['val'];
//$tbl=$_GET['tbl'];
$cid=$_GET['cid'];
$atmid=$_GET['atmid'];
$trackid=$_GET['trackid'];
$frmdt=str_replace('/','-',$_GET['frmdt']);
$billdt=str_replace('/','-',$_GET['billdt']);
$todt=str_replace('/','-',$_GET['todt']);
$duedt=str_replace('/','-',$_GET['duedt']);


 $frmdt2=date('Y-m-d',strtotime($frmdt));
//echo $frmdt2."<br>";
$billdt2=date('Y-m-d',strtotime($billdt));// echo $billdt2."<br>";
 $todt2=date('Y-m-d',strtotime($todt)); //echo $todt2."<br>";
 $duedt2=date('Y-m-d',strtotime($duedt));// echo $duedt2."<br>";
 $paiddt2=date('Y-m-d',strtotime($paiddt));
$dt=str_replace("/","-",$val);
$dt2=date('Y-m-',strtotime($dt));
$st=0;
if($frmdt2>=$todt2 || $todt2>$billdt2 || $billdt2>$duedt2)
 {
 echo "2";
 }
else
{
  $ebchkstr="select * from ebillfundrequests where reqstatus<>'0' and cust_id='".$cid."' and (atmid='".$atmid."' or trackerid='".$trackid."') and (due_date like '".$duedt2."%' OR start_date like '".$frmdt2."%' or end_date like '".$todt2."%' or bill_date like '".$billdt2."%' )";
  //echo $ebchkstr;
$ebchk=mysqli_query($con,$ebchkstr);

if(mysqli_num_rows($ebchk)>0)
echo "3";
else
{
//echo "select * from ebillfundrequests where reqstatus<>'0' and cust_id='".$cid."' and (atmid='".$atmid."' or trackerid='".$trackid."') and ((start_date<'".$frmdt2."' and end_date>'".$frmdt2."') or (start_date<'".$todt2."' and end_date>'".$todt2."')  )";
$ebchk2=mysqli_query($con,"select * from ebillfundrequests where reqstatus<>'0' and cust_id='".$cid."' and (atmid='".$atmid."' or trackerid='".$trackid."') and ((start_date<'".$frmdt2."' and end_date>'".$frmdt2."') or (start_date<'".$todt2."' and end_date>'".$todt2."')  )");

if(mysqli_num_rows($ebchk2)>0)
{
echo "3";
}
else
echo "1";
}
}
?>