<?php
session_start();

//$_POST['cid']='Tata05';
include('config.php');

 $sql=$_POST['sql'];
$table=mysqli_query($con,$sql);
 if(isset($_POST['mon']) && isset($_POST['yr']) && isset($_POST['mon2']) && isset($_POST['yr2'])){
$startdate=$_POST['yr']."-".$_POST['mon']."-01";
$enddate=$_POST['yr2']."-".$_POST['mon2']."-31";
$timestamp_start = strtotime($startdate);

$timestamp_end = strtotime($enddate);

 $difference = abs($timestamp_end - $timestamp_start);
 $months = floor($difference/(60*60*24*30));
 }
if(!$table)
echo mysqli_error();
$contents.="Sr NO \t Customer \t ATM ID \t Bank \t Address \t";

 for($i=0;$i<$months;$i++){
 $mon=$_POST['mon']+$i;
 if($mon>12)
 $mon=$mon-12;
 
$contents.=date('M', strtotime(date('Y-'. $mon .'-01')))."\t";
$contents.="Paid Date \t Paid Amount \t"; } 
$contents.="Active/Inactive \n";

// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
$appamt=0;
$reqamt=0;
while($row= mysqli_fetch_row($table))
{
$qry1=mysqli_query($con,"select bank,atmsite_address from ".$row[2]."_sites where trackerid='".$row[5]."'");
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
$brro=mysqli_fetch_row($branch);

$contents.="\n".($count+1)."\t".$row[2]."\t".$row[1]."\t".$qrrow[0]."\t";
$contents.=preg_replace('/\s+/', ' ', $qrrow[1])."\t";
 for($i=0;$i<$months;$i++){

  $mon=$_POST['mon']+$i;
 $yrr=$_POST['yr'];
if($mon>'12')
{
$yrr=$_POST['yr']+1;
$mon=$mon-12;

}
if($mon>0 && $mon<10)
$mon="0".$mon;

  
 $dt= $yrr.'-'.$mon.'-';
//echo "select reqid,pdate from ebfundtransfers where pdate like '".$dt."%' and reqid in (select req_no from ebillfundrequests where atmid='".$row[1]."' and cust_id='".$row[2]."')";
$fund=mysqli_query($con,"select reqid,pdate from ebfundtransfers where pdate like '".$dt."%' and reqid in (select req_no from ebillfundrequests where atmid='".$row[1]."' and cust_id='".$row[2]."')");

//echo mysqli_num_rows($fund)."<br>";
if(mysqli_num_rows($fund)>0)
{
//echo "hello";
$amt=0;
$pddt=array();
while($req=mysqli_fetch_array($fund))
{
$eb=mysqli_query($con,"select approvedamt from ebillfundrequests where req_no='".$req[0]."'");
$ebro=mysqli_fetch_row($eb);
$amt=$amt+$ebro[0];
$pddt[]=$req[1];
}
$contents.="YES\t".implode(",",$pddt)."\t".$amt."\t";
}
else
{
$contents.="NO \t NA \t0\t";
}

 } 
  if($row[7]==0){ 
  $contents.="Active"; }else{ $contents.="Inactive"; } 
$count=$count+1;

}
}
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=monthwiserep.xls");
  header("Content-Disposition: attachment; filename=fsssoftcopy.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  ?>