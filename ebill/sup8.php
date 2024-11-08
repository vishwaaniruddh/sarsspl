<?php session_start();
if(!$_SESSION['user'])
header('location:index.php');
//echo $_SESSION['user'];
//$desig=$_POST['desig'];
//$service=$_POST['service'];
//$dept=$_POST['dept'];
//$app=$_POST['apps'];
//echo count($app);
include('access.php');
include('config.php');


if (date('m') <4) {
    $financial_year = (date('Y')-1) . '-' . date('Y');

} else 
{
    $financial_year = date('Y') . '-' . (date('Y') + 1);
    
}


echo $financial_year;

?>
<html>
<head><title>Paid Ebill Fund</title>
<script src="excel.js" type="text/javascript"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
function consolidet()
{
	if(document.getElementById('report_type').value=="consolidate")
	{
	  document.getElementById("datahere").innerHTML ="<center><img src=loader.gif></center>";
	  if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	  else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
			
		//alert(xmlhttp.responseText);
		document.getElementById("datahere").innerHTML='';
		document.getElementById("datahere").innerHTML=xmlhttp.responseText;
		
		
	    }
	  }
	  	var sup=document.getElementById('sup').value;
		var frmdt=document.getElementById('frmdt').value;
		var todt=document.getElementById('todt').value;
		var dat="sup="+sup+"&frmdt="+frmdt+"&todt="+todt;
		//alert(dat);
		
		xmlhttp.open("POST","consolidate_sup5.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(dat);
	}
	else
		document.getElementById("frm1").submit();
}
</script>
</head>
<body>
<center>
<?php include("menubar.php"); ?>
</center>
<form name="frm1" id="frm1" method="post" action="<?php $_SERVER['PHP-SELF'] ?>" >
<?php
$reqid=array();
$sup=mysqli_query($con,"select * from fundaccounts order by hname ASC");
?>
<select name="sup" id="sup"><option value="-1">Select Supervisor</option>
<?php
while($supro=mysqli_fetch_array($sup))
{
?>
<option value="<?php echo $supro[0]; ?>" <?php if($_POST['sup']==$supro[0]){ echo "selected"; } ?>><?php echo $supro[1]."/ ".$supro[4]; ?></option>
<?php
}
?>
</select>
From Date:- <input type="text" name="frmdt" id="frmdt" value="<?php if(isset($_POST['frmdt'])){ echo $_POST['frmdt']; }else{ echo date('d/m/Y',strtotime('-2 days'));} ?>" onclick="displayDatePicker('frmdt');" >
To Date:- <input type="text" name="todt" id="todt" value="<?php  if(isset($_POST['todt'])){ echo $_POST['todt']; }else{ echo date('d/m/Y'); } ?>" onclick="displayDatePicker('todt');" >
<select id="report_type">
 <option value="">Detailed Report</option>
 <option value="consolidate">Consolidate Report</option>
</select>
<input type="button" value="Search" name="cmdsearch" onclick="consolidet();">

</form>
<div id="datahere">
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
<?php //echo $_SESSION['designation']; ?>
<form action='generatePayPDF.php' method='post' >
<center>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<tr>
<th width="25">Sr NO</th>
<th width="200">Name/Account No.</th>	
<th width="75">Amount</th>
<?php //if($_SESSION['designation']=='7' || $_SESSION['designation']=='2'){ 
?>
<th>Bill Paid Amt</th>
<th width="75">Invoice No</th>
<?php
if(isset($_POST['sup']) && $_POST['sup']!=-1)
{
?>
<th  width="50">Reversal</th>
<?php
}
 // }
  ?>
<th width="200">Site Address</th>
<th width="75">CUSTOMER NAME</th>
<th width="75">Bank Name</th>
<th width="75">Atm Id</th>

<th width="75">Supervisor Name</th>
<th width="75">Location</th>
<th width="75">Cheque No</th>
<th width="75">Cheque Date</th>
<th width="75">Paid Date</th>
<th width="75">Paid Entry Date</th>
<th width="75">Invoice Entry Date</th>

</tr>

<?php
//echo "select * from fundaccounts where aid='".$_POST['sup']."'";
$accsop=mysqli_query($con,"select * from fundaccounts_opbal where aid='".$_POST['sup']."' and financial_year='".$financial_year."'");

echo "select * from fundaccounts_opbal where aid='".$_POST['sup']."' and financial_year='".$financial_year."'";
$rxop=mysqli_fetch_row($accsop);
$nrw=mysqli_num_rows($accsop);
//echo $nrw;
?>
<tr>
<td colspan="2">
Opening Balance 2020-21
</td>
<td>


<?php 
$db=0;
$cr=0;

if($nrw>0)
{
   // echo "ok";
if($rxop[2] > 0) {$cr=$rxop[2];
    echo  $cr;
}else
{
 $db=$rxop[2];
 echo $db;
}
//echo "(".$db."/////".$cr.")";
}
?>

</td>
</tr>



<?php	$paidamt=0;
        $total=0;$x=0;
        $str="SELECT * FROM `ebfundtransfers` where reqid in (select req_no from ebillfundrequests) and status=0";
if(isset($_POST['sup']) && $_POST['sup']!='-1' && $_POST['sup']!='')
$str.=" and accid='".$_POST['sup']."'";
if(isset($_POST['frmdt']) && isset($_POST['todt']) && $_POST['frmdt']!='' && $_POST['todt']!='')
$str.=" and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND pdate<=STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y') ";
else
$str.=" and pdate>='".date('Y-m-d',strtotime('-2 days'))."' AND pdate<='".date('Y-m-d')."' ";

$str.="  order by pdate DESC,chqno ASC";
//echo $str;
$cnt=1;
        $tablex=mysqli_query($con,$str);
        if(mysqli_num_rows($tablex)>0){
	while($app=mysqli_fetch_row($tablex))
	{
	
	//echo $app[$x];
	$sql="Select * from ebillfundrequests where req_no='".$app[1]."'";
		
        $table=mysqli_query($con,$sql);    
        $row=mysqli_fetch_row($table);
        $reqid[]=$row[0];
$qry1=mysqli_query($con,"select bank,atmsite_address,location from ".$row[12]."_sites where trackerid='".$row[14]."'");
$qrrow=mysqli_fetch_array($qry1);

//$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
//$brro=mysqli_fetch_row($branch);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	
$accs=mysqli_query($con,"select * from fundaccounts where aid='".$app[2]."'");
$rx=mysqli_fetch_row($accs);



?>
<div class=article>
<div class=title>
</div></div>
<?php
$cnt++;
}
?>
<?php

}
?>


<?php
//onaccount
if(isset($_POST['sup']))
{
$total3=0;
$paidamt3=0;
//echo "select * from ebonacctransfers where  accid='".$_POST['sup']."' and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')";
$ebpay=mysqli_query($con,"select * from ebonacctransfers where  accid='".$_POST['sup']."' and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y') order by pdate");

while($ebpayro=mysqli_fetch_array($ebpay))
{

$accs2=mysqli_query($con,"select * from fundaccounts where aid='".$_POST['sup']."'");
$rx2=mysqli_fetch_row($accs2);
$onacc=mysqli_query($con,"select * from onacctransfer where reqid='".$ebpayro[1]."'");
$onaccro=mysqli_fetch_row($onacc);
?>
<tr><td><?php echo ++$x; ?></td>
<td width="200">
<?php echo $rx2[1]."/".$rx2[2]; ?>
</td>
<td><?php echo $onaccro[2]; $total3=$total3+$onaccro[2]; ?></td>
<td></td>
<td></td>
<td></td>
<td colspan=6 ><?php echo $onaccro[5]?></td><td><?php echo $ebpayro[6]; ?></td>
<td><?php echo date('d/m/Y',strtotime($ebpayro[3])); ?></td>
<?php
}
?>

<tr><td colspan=2 align='right' >Total Amount Transfer through Online Transaction (C)</td><td align='CENTER' ><?php echo $total3; ?></td><td> <?php echo $paidamt3; ?></td><td colspan=10 align='right' >&nbsp;</td></tr>
<?php
}
?>


<?php

$paidamt2=0;
        $total2=0;
//print_r($reqid);
if(isset($_POST['sup']))
{

$req=implode(",",$reqid);
//echo $req;
//echo "select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.req_no not in($req) and  r.supervisor=a.hname and a.aid='".$_POST['sup']."') and upby!='' and entrydt>=STR_TO_DATE('".$_POST['frmdt']." 00:00:00','%d/%m/%Y') AND  entrydt<=STR_TO_DATE('".$_POST['todt']." 23:59:00','%d/%m/%Y')";
//echo "select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.supervisor=a.hname and a.aid='".$_POST['sup']."') and upby!='' and entrydt>='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['frmdt'])))." 00:00:00' AND  entrydt<='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['todt'])))." 23:59:59'";
if($req=="")
$ebpay=mysqli_query($con,"select * from ebpayment where Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.supervisor=a.hname and a.aid='".$_POST['sup']."') and upby!='' and entrydt>='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['frmdt'])))." 00:00:00' AND  entrydt<='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['todt'])))." 23:59:59'");
else
$ebpay=mysqli_query($con,"select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.supervisor=a.hname and a.aid='".$_POST['sup']."') and upby!='' and entrydt>='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['frmdt'])))." 00:00:00' AND  entrydt<='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['todt'])))." 23:59:59'");

//echo "notin--".$req;

while($ebpayro=mysqli_fetch_array($ebpay))
{
$sql2="Select * from ebillfundrequests where req_no='".$ebpayro[0]."'";
		
        $table2=mysqli_query($con,$sql2);    
        $row2=mysqli_fetch_row($table2);
        
$qry4=mysqli_query($con,"select bank,atmsite_address,location from ".$row2[12]."_sites where trackerid='".$row2[14]."'");
//echo "select bank,atmsite_address,location from ".$row2[12]."_sites where trackerid='".$row2[14]."'";

$qrrow4=mysqli_fetch_array($qry4);

//$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
//$brro=mysqli_fetch_row($branch);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	
$accs2=mysqli_query($con,"select * from fundaccounts where aid='".$_POST['sup']."'");
$rx2=mysqli_fetch_row($accs2);

$ebfundtrans_qry=mysqli_query($con,"SELECT pdate FROM `ebfundtransfers` where reqid = '".$ebpayro[0]."'and status=0");
$ebfundtrans_row=mysqli_fetch_array($ebfundtrans_qry);
$ebfundr_qry=mysqli_query($con,"SELECT pdate FROM `ebfundtransfers` where reqid = '".$ebpayro[0]."'and status=0");
$ebfundr_row=mysqli_fetch_array($ebfundtrans_qry);
if($row2[16]==0 || ($row2[15] < 8 & $row2[15]!=0) || ($row2[16]!=0 & $row2[15]==8))
{
?>
<tr>
<td width="25"><?php echo ++$x."<br/>".$ebpayro[0]; ?></td>
<td width="200">
<?php echo $rx2[1]."/".$rx2[2]; ?>
</td> 
<td width="75" align='CENTER'>
<?php
	//if($ebfundtrans_row[0]!=''){echo $ebfundtrans_row[0]."<br/>"; }
	//echo $row2[16]; 
 //$total2=$total2+$row2[16]; 
echo "0";
$total2=$total2+0;


?>
</td>
<?php //if($_SESSION['designation']=='7' || $_SESSION['designation']=='2'){ 

$paidamt2=$paidamt2+$ebpayro[1];
$inv2=mysqli_query($con,"select s.send_id,s.entrydt,inv_no from send_bill s,send_bill_detail d where s.status='0' and s.send_id=d.send_id and d.status=0 and d.reqid='".$row2[0]."'");
$invro2=mysqli_fetch_row($inv2);

?>
<td width="75"><?php echo $ebpayro[1];
if(mysqli_num_rows($inv2)==0)
{
$club2=mysqli_query($con,"select * from ebillfundcancinv where reqid='".$row2[1]."' and status=0");
if(mysqli_num_rows($club2)>0)
echo "Clubed with next Bill";
}
//echo $row2[0]; ?></td>

<td width="75"><?php echo $invro2[2]; ?></td>
<td width="75"></td>
<?php
//}  ?>
<td width="200"><?php echo $qrrow4[1]; ?></td>
<td width="75"><?php echo $row2[12]; ?></td>

<td width="75"><?php echo $qrrow4[0]; ?></td>
<td width="75"><?php echo $row2[1]; ?></td>

<td width="75"><?php echo $row2[8]; ?></td>
<td width="75"><?php echo $qrrow4[2]; ?></td>
<td width="75"><?php if($row2[17]!=0){ echo $row2[17]; } ?></td>
<td width="75"><?php if($ebfundtrans_row[0]!=''){echo date('d/m/Y',strtotime($ebfundtrans_row[0])); } ?></td>
<td width="75"><?php if($ebpayro[2]!="0000-00-00" && $ebpayro[2]!="") { echo date('d/m/Y',strtotime($ebpayro[2]));} ?></td>
<td width="75"><?echo date('d/m/Y',strtotime($ebpayro[4]));?></td>
<td width="75"><?echo date('d/m/Y',strtotime($invro2[1]));?></td>
</tr>
<?php
}
}

?>
<tr><td colspan=2 align='right' >Total Amount Transfer through On Account - Company/Self & Receipt Received (B)</td><td align='CENTER' ><?php echo $total2; ?></td><td> <?php echo $paidamt2; ?></td><td colspan=10 align='right' >&nbsp;</td></tr>


<?php
//Reversal
$total6=0;
$paidamt6=0;
//$x=0;
$rev_qry=mysqli_query($con,"SELECT * FROM `onaccount_reversal` where  accid='".$_POST['sup']."' and status=8 and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')");


while($rev1=mysqli_fetch_array($rev_qry))
{

$accs22=mysqli_query($con,"select * from fundaccounts where aid='".$rev1['accid']."'");

$rx11=mysqli_fetch_array($accs22);

$qryonacc=mysqli_query($con,"select * from ebonacctransfers where accid='".$rev1['accid']."'");
$qryonacc_fth=mysqli_fetch_array($qryonacc);

$paidamt6+=$rev1['pamount'];
//echo $paidamt6;

/*
//echo "select * from fundaccounts where aid='".$rev1['accid']."'";



$ebfundreq_str1="Select * from  fundaccounts where accid='".$rev1['accid']."'";
$ebfundreq_qry1=mysqli_query($con,$ebfundreq_str1);    
//echo $ebfundreq_qry1;
$ebfundreq=mysqli_fetch_array($ebfundreq_qry1);

$qry1=mysqli_query($con,"select bank,atmsite_address,location from ".$ebfundreq[12]."_sites where trackerid='".$ebfundreq[14]."'");
echo "select bank,atmsite_address,location from ".$ebfundreq[12]."_sites where trackerid='".$ebfundreq[14]."'";
$qrrow1=mysqli_fetch_array($qry1);


echo $paidamt6;
*/

if($row3[21]==0 || ($row3[20] < 8 & $row3[20]!=0))
{
?>

<tr>
<td><?php echo ++$x; ?></td>
<td width="200">
<?php echo $rx11[1]."/".$rx11[2]; ?>
</td>
<td>&nbsp;</td>

<td>
	<?php
		echo $rev1['pamount'];

	?>
</td>
<td></td>
<td>&nbsp;</td>

<!--

<td><?php echo $qrrow1['atmsite_address']; ?></td>
<td><?php echo $row2['cust_id']; ?></td>
<td><?php echo $rx11['bank']; ?></td>
<td><?php echo $row2['atmid']; ?></td>
<td><?php echo $rev1['dbtacc']; ?></td>
<td><?php echo $qrrow1['location']; ?></td>
<td><?php echo $rev1['payment_type']." ".$rev1['chqno']; ?></td>-->
<td colspan="8"><b>Remarks:</b> <?php echo $rev1['remark']; ?></td>
<td colspan=""><?php echo date('d/m/Y',strtotime($rev1['pdate'])); ?></td>
<td colspan="2"/>

</tr>
<?php
}
}
?>

<?php


	if($_POST['sup']!=-1)
	{
		//echo "select debit,credit from fundaccounts where aid='".$_POST['sup']."'";
		$opening_fund_qry=mysqli_query($con,"select debit,credit,eb_received_bfsft from fundaccounts where aid='".$_POST['sup']."'");
		$opening_fund=mysqli_fetch_array($opening_fund_qry);


?>


<tr><td colspan=2 align="right" >Total Amount Reversal(R)</td><td align='CENTER' ><?php echo $total6; ?></td><td align="center"> <?php echo $paidamt6; ?></td><td colspan=10 align='right' >&nbsp;</td></tr>

<?php
}

?>
<!-----------------------------------------------pod here*************************************************************************** --------------------->





<?php 
/*
$podqry=mysqli_query($con,"select * from ebill_package where supervisor_id='".$_POST['sup']."' AND status!='1' AND DATE(entrydate)>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND DATE(entrydate)<=STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y') ");
$supname=mysqli_query($con,"select hname,accno from fundaccounts where aid='".$_POST['sup']."'");
$supn=mysqli_fetch_array($supname);
$podtotal=0;
$disputeamt=0;
while($podq=mysqli_fetch_array($podqry))
{

    if($podq[12]==2)
    {
    $disputeamt=$disputeamt+$podq[10];
    }
     else
     { 
     $podtotal=$podtotal+$podq[10];
     }

	//echo $podq[11];
	$st=explode("_", $podq[11]);
//echo $st[0];
	$siteadd=mysqli_query($con,"select  cust_id,bank,atmsite_address,location from ".$st[0]."_sites where trackerid='".$podq[11]."'");
        //echo "select  cust_id,bank,atmsite_address from ".$st[0]."_sites where trackerid='".$podq[11]."'";
	$getsite=mysqli_fetch_array($siteadd);*/

 ?>

<!--<tr>
<td width="200"  align="center"><?php echo $podq[1]; ?></td>
<td width="75"  align="center"><?php echo $supn[0]." /".$supn[1]; ?></td>

<td width="75" align="center">0</td>


<td width="75"  align="center"><?php echo $podq[10]; ?></td>








<td width="60"><?php $rid; ?></td>
<td width="75"></td>
<td width="75"><?php echo $getsite[2];  ?></td>
<td width="75"><?php  echo $getsite[0]; ?></td>
<td width="75"><?php echo $getsite[1];?></td>
<td width="75"><?php echo  $podq[4];?></td>
<td width="75"><?php echo $supn[0];?></td>
<td width="75"><?php echo $getsite[3];?></td>
<?php if($podq[12]==0) 
{
?>
<td width="75">Pending</td>
<td width="75"></td>
<?php 
}
elseif($podq[12]==2)
{

$getrem=mysqli_query($con,"select remark from pod_uploads where pid='".$podq[0]."'");
$remrk=mysqli_fetch_array($getrem);
?>
<td width="75">Dispute</td>
<td width="75"><?php echo $remrk[0];?></td>
<?php 
}
?>


<td width="75"><?php echo  date( "d/m/Y", strtotime ( $podq[14] ) );?></td>
</tr></div></div>-->

<?php /* } */ ?>
<!--<tr>
<td align="right"></td>
<td align="center">POD Total</td>
<td align="center">0</td>
<td align="center"><?php echo $podtotal+$disputeamt;?></td>
<td align="right" colspan=10></td>
</tr>
<tr>
<td align="right"></td>
<td align="center">Dispute Total</td>
<td align="center">0</td>
<td align="center"><?php echo $disputeamt;?></td>
<td align="right" colspan=10></td>
</tr>-->








<!-----------------------------------------------pod end --------------------->


<?php
//Transfer
$total5=0;
$paidamt5=0;
$x=0;
if(isset($_POST['sup']) && $_POST['sup']!=-1)
{
?>
<!--
<tr>
<th width="25">Sr NO</th>
<th width="200">Name/Account No.</th>	
<th width="75">Transfer To</th>
<th>Transfer From</th>
<th width="75">Docket No</th>
<th width="200">Site Address</th>
<th width="75">CUSTOMER NAME</th>
<th width="75">Bank Name</th>
<th width="75">Atm Id</th>
<th width="75">Supervisor Name</th>
<th width="75">Location</th>
<th width="75">Cheque No</th>
<th width="75">Cheque Date</th>
</tr>
-->
<?php
//echo "SELECT * FROM `transfer` where  to_accid='".$_POST['sup']."' and status=1 and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')";
$trans_qry=mysqli_query($con,"SELECT * FROM `transfer` where  to_accid='".$_POST['sup']."' and status=1 and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')");

while($trans=mysqli_fetch_array($trans_qry))
{
$accs2=mysqli_query($con,"select * from fundaccounts where aid='".$trans['to_accid']."'");
$rx2=mysqli_fetch_array($accs2);
$accs21=mysqli_query($con,"select * from fundaccounts where aid='".$trans['from_accid']."'");
$rx21=mysqli_fetch_array($accs21);
$ebfundreq_str="Select * from ebillfundrequests where req_no='".$trans[0]."'";
$ebfundreq_qry=mysqli_query($con,$ebfundreq_str);    
$ebfundreq=mysqli_fetch_array($ebfundreq_qry);
$qry1=mysqli_query($con,"select bank,atmsite_address,location from ".$ebfundreq[12]."_sites where trackerid='".$ebfundreq[14]."'");
$qrrow=mysqli_fetch_array($qry1);
?>
<!--
<tr>
<td><?php echo ++$x; ?></td>
<td width="200">
<?php echo $rx2[1]."/".$rx2[2]; ?>
</td>
<td><?php echo $trans['pamount']; $total5+=$trans['pamount']; ?></td>
<td>&nbsp;</td>
<td><?php echo $trans['reqid']; ?></td>
<td><?php echo $qrrow['atmsite_address']; ?></td>
<td><?php echo $ebfundreq['cust_id']; ?></td>
<td><?php echo $qrrow['bank']; ?></td>
<td><?php echo $ebfundreq['atmid']; ?></td>
<td><?php echo $rx21['hname']; ?></td>
<td><?php echo $qrrow['location']; ?></td>
<td><?php echo $trans['payment_type']." ".$trans['chqno']; ?></td>
<td><?php echo date('d/m/Y',strtotime($trans['pdate'])); ?></td>
</tr>
-->
<?php
}

$trans_qry=mysqli_query($con,"SELECT * FROM `transfer` where  from_accid='".$_POST['sup']."' and status=1 and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')");

while($trans=mysqli_fetch_array($trans_qry))
{
//echo "select * from fundaccounts where aid='".$trans['to_accid']."'";
$accs2=mysqli_query($con,"select * from fundaccounts where aid='".$trans['to_accid']."'");
$rx2=mysqli_fetch_array($accs2);
$accs21=mysqli_query($con,"select * from fundaccounts where aid='".$trans['from_accid']."'");
$rx21=mysqli_fetch_array($accs21);
$ebfundreq_str="Select * from ebillfundrequests where req_no='".$trans[0]."'";
$ebfundreq_qry=mysqli_query($con,$ebfundreq_str);    
$ebfundreq=mysqli_fetch_array($ebfundreq_qry);
$qry1=mysqli_query($con,"select bank,atmsite_address,location from ".$ebfundreq[12]."_sites where trackerid='".$ebfundreq[14]."'");
$qrrow=mysqli_fetch_array($qry1);
?>
<!--
<tr>
<td><?php echo ++$x; ?></td>
<td width="200">
<?php echo $rx21['hname']."/".$rx21[2]; ?>
</td>
<td>&nbsp;</td>
<td><?php echo $trans['pamount']; $paidamt5+=$trans['pamount']; ?></td>
<td><?php echo $trans['reqid']; ?></td>
<td><?php echo $qrrow['atmsite_address']; ?></td>
<td><?php echo $ebfundreq['cust_id']; ?></td>
<td><?php echo $qrrow['bank']; ?></td>
<td><?php echo $ebfundreq['atmid']; ?></td>
<td><?php echo $rx2['hname']."<br/>".$rx2['accno']; ?></td>
<td><?php echo $qrrow['location']; ?></td>
<td><?php echo $trans['payment_type']." ".$trans['chqno']; ?></td>
<td><?php echo date('d/m/Y',strtotime($trans['pdate'])); ?></td>
</tr>
-->
<?php
}
?>
<tr><td colspan=2 align='right' >Total Amount Transfer(T)</td><td align='CENTER' ><?php echo $total5; ?></td><td align="center"> <?php echo $paidamt5; ?></td><td colspan=10 align='right' >&nbsp;</td></tr>
<?php
//Reversal
$total6=0;
//$paidamt6=0;
$x=0;
$rev_qry=mysqli_query($con,"SELECT * FROM `reversal` where  accid='".$_POST['sup']."' and status=1 and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')");

while($rev=mysqli_fetch_array($rev_qry))
{
$accs2=mysqli_query($con,"select * from fundaccounts where aid='".$rev['accid']."'");
$rx2=mysqli_fetch_array($accs2);
$ebfundreq_str="Select * from ebillfundrequests where req_no='".$rev['reqid']."'";
$ebfundreq_qry=mysqli_query($con,$ebfundreq_str);    
$ebfundreq=mysqli_fetch_array($ebfundreq_qry);
$qry1=mysqli_query($con,"select bank,atmsite_address,location from ".$ebfundreq[12]."_sites where trackerid='".$ebfundreq[14]."'");
$qrrow=mysqli_fetch_array($qry1);
//$paidamt6+=$rev['pamount'];
?>
<!--
<tr>
<td><?php echo ++$x; ?></td>
<td width="200">
<?php echo $rx2[1]."/".$rx2[2]; ?>
</td>
<td>&nbsp;</td>
<td>
	<?php
		echo $rev['pamount'];
	?>
</td>
<td><?php echo $rev['reqid']; ?></td>
<td><?php echo $qrrow['atmsite_address']; ?></td>
<td><?php echo $ebfundreq['cust_id']; ?></td>
<td><?php echo $qrrow['bank']; ?></td>
<td><?php echo $ebfundreq['atmid']; ?></td>
<td><?php echo $rev['dbtacc']; ?></td>
<td><?php echo $qrrow['location']; ?></td>
<td><?php echo $rev['payment_type']." ".$rev['chqno']; ?></td>
<td><?php echo date('d/m/Y',strtotime($rev['pdate'])); ?></td>
</tr>
-->
<?php
}
?>

<?php
	}
?>

<?php
	/*if($_POST['sup']!=-1)
	{
		//echo "select debit,credit from fundaccounts where aid='".$_POST['sup']."'";
		$opening_fund_qry=mysqli_query($con,"select debit,credit,eb_received_bfsft from fundaccounts where aid='".$_POST['sup']."'");
		$opening_fund=mysqli_fetch_array($opening_fund_qry);
?>

<tr><td colspan=2 align='right' >Opening Balance (O)</td><td align='CENTER' ><?php echo $total4=$opening_fund[0]; ?></td><td> <?php echo $paidamt4=$opening_fund[1]; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>
<tr><td colspan=2 align='right' >Bill Received Before Software (B)</td><td align='CENTER' >&nbsp;</td><td> <?php echo $opening_fund[2]; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>
<?php
	}*/
?>


<!--<tr><td colspan=2 align='right' >Transferred Amt through Software</td><td align='CENTER' ><?php echo $total2+$total; ?></td><td></td><td colspan=8 align='right' >&nbsp;</td></tr>
<tr><td colspan=2 align='right' >Received Bills on Amount Transferred through Software</td><td align='CENTER' ><?php echo $paidamt; ?></td><td></td><td colspan=10 align='right' >&nbsp;</td></tr>
<tr><td colspan=2 align='right' >On Account - Company/Self</td><td align='CENTER' ><?php echo $paidamt2; ?></td><td></td><td colspan=10 align='right' >&nbsp;</td></tr>-->
<tr><td colspan=2 align='right' >Total D=A+B+C+O+T+R</td><td align='CENTER' ><?php
 //echo $total."-".$total2."-".$total3."-".$total4;
 echo $total+$total2+$total3+$total4+$total5+$total6+$cr+$db;

//echo "1tot".$total."<br>"."2tot".$total2."<br>"."3tot".$total3."<br>".$total4."<br>".$total5."<br>".$total6;

//echo $paidamt+$paidamt2+$paidamt3+$paidamt4+$paidamt5+$paidamt6+$opening_fund[2];
  ?>
  </td><td></td><td colspan=10 align='right' >&nbsp;</td></tr>
<!--<tr><td colspan=2 align='right' >Total Paid Amount (E)</td><td align='CENTER' ><?php echo $paidamt+$paidamt2+$paidamt3+$paidamt4; ?></td><td></td><td colspan=10 align='right' >&nbsp;</td></tr>

<tr><td colspan=2 align='right' >Total Amount Reversal(R)</td><td align='CENTER' ><?php echo $total6; ?></td><td align="center"> <?php echo $paidamt6; ?></td><td colspan=10 align='right' >&nbsp;</td></tr>-->
<?php
//+$cr-$db


$to=$total+$total2+$total3+$total4+$total5+$total6+$cr+$db;

$netam=$to-$paidamt6;

?>
<tr><td colspan=2 align='right' >NET AMOUNT</td><td align='CENTER' ><?php echo $netam; ?></td><td> </td><td colspan=10 align='right' >&nbsp;</td></tr>
<tr><td colspan=2 align='right' >NET PAID</td><td align='CENTER' ></td><td align="center"> <?php echo 
$paidamt+$paidamt2+$paidamt3+$paidamt4+$paidamt5+$podtotal+$disputeamt; ?></td><td colspan=10 align='right' >&nbsp;</td></tr>

<tr><td colspan=2 align='right' >Difference Amount </td><td align='CENTER' ><?php echo $netam-($paidamt+$paidamt2+$paidamt3+$paidamt4+$paidamt5)-($podtotal+$disputeamt); ?></td><td></td><td colspan=10 align='right' >&nbsp;</td></tr>
<?php
}

?>
<!--<tr><td colspan=10 align='CENTER' ><input type="submit" name="GENERATE" id="GENERATE" value="GENERATE PDF" /></td></tr>-->
</table>
</center>
</form>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</div>
</body>

</html>