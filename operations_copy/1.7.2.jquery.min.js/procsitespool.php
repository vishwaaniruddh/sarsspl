<?php
session_start();
include("config.php");
$contents='';
if($_POST['service']=='-1')
echo "<script type='text/javascript'>alert('PLease select Service');window.location='sitespool.php'</script>";
else
{
$clnt="SELECT contact_first, short_name FROM contacts where type='c'";
if(isset($_POST['cid']) && $_POST['cid']!='-1')
$clnt.=" and short_name='".$_POST['cid']."'";

$clnt.=" order by contact_first ASC";
//echo $clnt;
$client=mysqli_query($con,$clnt);

$contents.="Client \t Atm1 \t ATM2 \t ATM3 \t Bank \t ProjectID \t Address \t City \t State \t Distributor \t Consumer Number \t Billing Unit \t Landlord \t Payment Type \t Max paid Date \t CSS Local Branch \t Supervisor Name \t Takeover date \t Handover Date";
while($clientro=mysqli_fetch_array($client))
{

	//echo "SHOW TABLES LIKE '".$clientro[1]."_ebill'";
$chk=mysqli_query($con,"SHOW TABLES LIKE '".$clientro[1]."_sites'");

if(mysqli_num_rows($chk)>0)
			{
$chk2=mysqli_query($con,"SHOW TABLES LIKE '".$clientro[1]."_ebill'");
if(mysqli_num_rows($chk2)>0)
				{
				$cid=$clientro[1];
				//echo $clientro[1]."<br>";

$service='';
$tkdt='';
if($_POST['service']=='caretaker')
{
$tkdt="takeover_date";
$hodt="handover_date";
}
else
{
$tkdt=$_POST['service']."_tkdt";
$hodt=$_POST['service']."_hodt";
}
$st='';
if($_POST['service']=='ebill')
$st="select s.cust_id,s.atm_id1,s.atm_id2,s.atm_id3,s.bank,s.projectid,s.atmsite_address,s.city,s.state,e.Distributor,e.Consumer_No,e.billing_unit,e.landlord,s.csslocalbranch,s.hsupervisor_name,s.trackerid from ".$cid."_ebill e,".$cid."_sites s where e.atmtrackid=s.trackerid and s.ebill='Y'";
else
$st="select s.cust_id,s.atm_id1,s.atm_id2,s.atm_id3,s.bank,s.projectid,s.atmsite_address,s.city,s.state,e.Distributor,e.Consumer_No,e.billing_unit,e.landlord,s.csslocalbranch,s.hsupervisor_name,s.trackerid,s.".$tkdt.",s.".$hodt." from ".$cid."_ebill e,".$cid."_sites s where e.atmtrackid=s.trackerid and s.ebill='Y'";
if(isset($_POST['service']) && $_POST['service']!='-1')
$st.=" and s.".$_POST['service']."='Y'";
//echo count($_POST['formCountries']);
if(isset($_POST['formCountries']) && $_POST['formCountries']!='-1' && $_POST['formCountries']!='')
{
$bnk=implode(",",$_POST['formCountries']);
$bnk=str_replace(",","','",$bnk);
$bnk="'$bnk'";
if($bnk!="'-1'")
$st.=" and s.bank in($bnk)";
}
if(isset($_POST['project']) && $_POST['project']!='-1' && $_POST['project']!='' && $_POST['project']!='x@')
{

$project=$_POST['project'];
 
$project="'$project'";
$st.=" and s.projectid in($project)";
}
if(isset($_POST['state']) && $_POST['state']!='-1' && $_POST['state']!='')
{
//echo "hii";
$state=implode(",",$_POST['state']);
$state=str_replace(",","','",$state);

$state="'$state'";
if($state!="'-1'")
$st.=" and s.state in($state)";
}
//echo $st."<br>";

 
$site=mysqli_query($con,$st);
if(!$site)
echo mysqli_error();
while($stro=mysqli_fetch_array($site))
{
$prov=mysqli_query($con,"select provider from eserviceprovider where code='".$stro[9]."' and state='".$stro[8]."'");
		$provro=mysqli_fetch_row($prov);
 $contents.="\n".strtoupper($clientro[0])."\t";
 //$contents.=$stro[0]."\t";
 $contents.=strtoupper($stro[1])."\t";
 $contents.=strtoupper($stro[2])."\t";
 $contents.=strtoupper($stro[3])."\t";
 $contents.=strtoupper($stro[4])."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ',$stro[5]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ',$stro[6]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ',$stro[7]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ',$stro[8]))."\t";
 $contents.=strtoupper($provro[0])."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ',$stro[10]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ',$stro[11]))."\t";
 $contents.=strtoupper(preg_replace('/\s+/', ' ',$stro[12]))."\t";

//echo "select max(p.Paid_Date),e.paytype from ebpayment p,ebillfundrequests e where e.trackerid='".$row[15]."' and e.req_no=p.Bill_No<br>";
			   $mx=mysqli_query($con,"select max(p.Paid_Date),e.paytype from ebpayment p,ebillfundrequests e where e.trackerid='".$stro[15]."' and e.req_no=p.Bill_No");
			   if(mysqli_num_rows($mx)>0)
			   {
		$mxro=mysqli_fetch_row($mx);
		$contents.=strtoupper($mxro[1])."\t";
		if($mxro[0]!=NULL)
		$contents.=strtoupper(date("d F Y",strtotime($mxro[0])))."\t";
		else
		$contents.="NA\t";
		}
		else{
		$contents.="NA\t";
		$contents.="NA\t";
		}
		$contents.=strtoupper($stro[13])."\t";
		$contents.=strtoupper($stro[14])."\t";
		//$contents.=strtoupper($stro[15])."\t";
		if($_POST['service']=='ebill'){
		 $tkdt=mysqli_query($con,"select takeoverdt,handoverdt from mastersites where trackerid='".$stro[15]."'");
  $tkdtro=mysqli_fetch_row($tkdt);
  if($tkdtro[0]!='0000-00-00')
  $contents.=strtoupper(date("d F Y",strtotime($tkdtro[0])))."\t";
  else
  $contents.="NA\t";
  if($tkdtro[1]!='0000-00-00')
  $contents.=strtoupper(date("d F Y",strtotime($tkdtro[1])))."\t"; 
  else
  $contents.="NA\t";
  }
  else
  {
  if($stro[16]!='0000-00-00')
  $contents.=strtoupper(date("d F Y",strtotime($stro[16])))."\t";
  else
  $contents.="NA\t";
  
  if($stro[17]!='0000-00-00')
  $contents.=strtoupper(date("d F Y",strtotime($stro[17])))."\t";
  else
  $contents.="NA\t";
  }
/* $contents.=$_POST['service']."\t";
if($_POST['service']!='ebill')
 {
 $contents.=$stro[9]."\t";
 $contents.=$stro[10]."\t";
 }
 else
 {
 //echo "select * from mastersites where (atm_id1='".$stro[0]."' or trackerid='".$stro[16]."') and status=0<br>";
 $mastsite=mysqli_query($con,"select * from mastersites where (atm_id1='".$stro[0]."' or trackerid='".$stro[16]."') and status=0");
 if(mysqli_num_rows($mastsite)>0)
 {
 $mastro=mysqli_fetch_row($mastsite);
 $contents.=$mastro[8]."\t";
 $contents.=$mastro[9]."\t";
 //echo "select  `Distributor`,`Consumer_No`,billing_unit from ".$clientro[1]."_ebill where atmtrackid='".$stro[16]."'<br>";


 }
 }
 $contents.=$stro[10]."\t";
 $contents.=$stro[11]."\t";
 if($_POST['service']=='ebill')
 {
 $ebilldata=mysqli_query($con,"select `Distributor`,`Consumer_No`,billing_unit,landlord from ".$clientro[1]."_ebill where atmtrackid='".$stro[16]."'");


$ebillro=mysqli_fetch_row($ebilldata);
$contents.=$ebillro[0]."\t";
$contents.=$ebillro[3]."\t";
$contents.=$ebillro[1]."\t";
$contents.=$ebillro[2]."\t";
 }*/
}

}//end of checking ebill tables
}//end of checking site tables
}
//echo $contents;
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])

 header("Content-Disposition: attachment; filename=".$_POST['service'].".xls");
 header("Content-Type: application/vnd.ms-excel");
 print $contents;
 }
?>