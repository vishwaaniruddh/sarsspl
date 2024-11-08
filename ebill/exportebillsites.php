<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysqli_query($con,$sqlme);

$contents='';

 $contents.="Client \t  Atm1 \tATM2 \t ATM3 \t Bank \t ProjectID \t Address \t City \t State \t Distributor\t Consumer Number \t Billing Unit \t Landlord \t Payment Type \t Max paid Date \t CSS Local Branch \t Supervisor Name \t Takeover date \t Handover Date";
while($row=mysqli_fetch_row($table))
{
$prov=mysqli_query($con,"select provider from eserviceprovider where code='".$row[9]."' and state='".$row[8]."'");
		$provro=mysqli_fetch_row($prov);
 //$contents.=preg_replace('/\s+/', ' ', $row[1])."\t";
 //$contents.="\n".preg_replace('/\s+/', ' ', $row[0])."\t";
 $contents.="\n".preg_replace('/\s+/', ' ', $row[0])."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[1]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[2]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[3]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[4]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[5]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[6]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[7]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[8]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $provro[0]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[10]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[11]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[12]))."\t";
   $mx=mysqli_query($con,"select max(p.Paid_Date),e.paytype from ebpayment p,ebillfundrequests e where e.trackerid='".$row[15]."' and e.req_no=p.Bill_No");
			   if(mysqli_num_rows($mx)>0)
			   {
		$mxro=mysqli_fetch_row($mx);
		$contents.=strtoupper(preg_replace('/\s+/', ' ', $mxro[1]))."\t";
		//echo "<td>".$mxro[1]."</td>";
		if($mxro[0]!=NULL)
		$contents.=strtoupper(date("d F Y",strtotime($mxro[0])))."\t";
		else
		$contents.="NA \t";
		}
		else{
		$contents.="NA \t";
		$contents.="NA \t";
		}
  $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[13]))."\t";
  $contents.=strtoupper(preg_replace('/\s+/', ' ', $row[14]))."\t";
  $tkdt=mysqli_query($con,"select takeoverdt,handoverdt from mastersites where trackerid='".$row[15]."'");
  $tkdtro=mysqli_fetch_row($tkdt);
  $contents.=strtoupper(date("d F Y",strtotime($tkdtro[0])))."\t";
  $contents.=strtoupper(date("d F Y",strtotime($tkdtro[1])))."\t"; 
  
} 
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])

  header("Content-Disposition: attachment; filename=ebillsites.xls");
  header("Content-Type: application/vnd.ms-excel");
 print $contents;
?>