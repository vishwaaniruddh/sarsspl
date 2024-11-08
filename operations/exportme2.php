<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysqli_query($con,$sqlme);

$contents='';
 $contents.="Complain ID \t  Name \t ATM \t Bank \t CSS Local Branch \t Address \t City \t State \tService Type \tNature of Work \tIssue \t Materials \t Alert Date \t Contact Person \t Phone \t Supervisor Name\t Call close time \t Call Status \t Quotation Status \t ";
while($row=mysqli_fetch_row($table))
{
if($row[2]!='temp_'){
	
	if($row[17]=='sites')
$atm="select atm_id1,csslocalbranch from ".$row[1]."_sites where trackerid='".$row[2]."'";
elseif($row[17]=='rnmsites')
$atm="select atm_id1,csslocalbranch from rnmsites where trackerid='".$trackid."'";

	$qry=mysqli_query($con,"select contact_first from contacts where short_name='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	$tab=mysqli_query($con,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	$row1=mysqli_fetch_row($tab);
	//echo "select engg_name from area_engg where engg_id=select engineer from alert_delegation where alert_id='".$row[0]."'";

 $contents.="\n".$row[25]."\t";
	// $contents.=$row[31]."\t";
	 $contents.=$custrow[0]."\t";
	 $atm2=mysqli_query($con,$atm);
   $atmrow=mysqli_fetch_row($atm2);
   	$contents.=$atmrow[0]."\t";
   
	// print $contents;
	 $contents.=$row[3]."\t";
	 //$contents.=$row[27]."\t";
	 
$contents.=preg_replace('/\s+/', ' ', $row[4])."\t";
	// $contents.=$row[4]."\t";
$contents.=preg_replace('/\s+/', ' ', $row[5])."\t";
	$contents.=$row[6]."\t";
	 
	  $contents.=$row[27]."\t";
$stp=mysqli_query($con,"select type from quotation where quotid='".$row[30]."'");
$stpro=mysqli_fetch_array($stp);
$contents.=$stpro[0]."\t";
$now=split("_",$row[32]);
 $contents.=$now[0]."\t";
$contents.=$now[1]."\t";
$contents.=preg_replace('/\s+/', ' ', $row[9])."\t";


if($row[17]=='service' || $row[17]=='new temp')
{
 $contents.= date('d/m/Y h:i:s a',strtotime($row[10])); 
} 
  else
  { 
  if(isset($row[11]) and $row[11]!='0000-00-00') 
  $contents.= date('d/m/Y h:i:s a',strtotime($row[11]));
   }
   $contents.="\t";
   $contents.=$row[12]."\t";
    $contents.=$row[13]."\t";
	$engr=mysqli_query($con,"select engg_name from area_engg where loginid=(select engineer from alert_delegation where alert_id='".$row[0]."')");
if(mysqli_num_rows($engr)>0){
	$engro=mysqli_fetch_row($engr);
	$contents.=$engro[0]."\t";
}
else
{
$log=mysqli_query($con,"select username from login where srno =(select engineer from alert_delegation where alert_id='".$row[0]."')");

$logro=mysqli_fetch_row($log);
//echo $logro[0]."<br>";
	 $contents.=$logro[0]."\t";
}
    
    
   
$contents.=$row[18]."\t";
 /*if($row1[0]!='')
 {  $contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row1[0])); }else
 { 
$al=mysqli_query($con,"select max(id),feedback from eng_feedback where alert_id='".$row[0]."'");
$alro=mysqli_fetch_row($al);
 $engf=preg_replace('/\s+/', ' ', $alro[1]);
$engf=str_replace("\n"," ",$alro[1]);
$contents.=$engf;
 }
 $contents.="\t";
$a2=mysqli_query($con,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id ASC ");
while($alro2=mysqli_fetch_row($a2))
{
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $alro2[0])).",";
}
$contents.="\t";*/

//$contents.=$row[15];
$a3=mysqli_query($con,"select up from alert_updates where alert_id='".$row[0]."' order by id ASC ");
while($alro3=mysqli_fetch_row($a3))
{
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $alro3[0])).",";
}
$contents.="\t";
//echo "select remarks from quotapproval where quotid='".$row[30]."' order by appid ASC <br>";
$quot=mysqli_query($con,"select remarks from quotapproval where quotid='".$row[30]."' order by appid ASC ");
if(!$quot)
echo mysqli_error();
while($qro3=mysqli_fetch_array($quot))
{
//echo $qro3[0]."<br>";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $qro3[0])).",";
}
 
}
 } 
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>