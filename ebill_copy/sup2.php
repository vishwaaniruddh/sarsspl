<?php session_start();
if(!$_SESSION['user'])
header('location:index.php');
//echo $_SESSION['user'];
//$desig=$_POST['desig'];
//$service=$_POST['service'];
//$dept=$_POST['dept'];
//$app=$_POST['apps'];
//echo count($app);
include('config.php');

?><html><head><title>Paid Ebill Fund</title>
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
		
		xmlhttp.open("POST","consolidate_sup2.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(dat);
	}
	else
		document.getElementById("frm1").submit();
}
</script>
</head><body>
<center>
<?php include("menubar.php"); ?>
</center>
<form name="frm1" id="frm1" method="post" action="<?php $_SERVER['PHP-SELF'] ?>">
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
<th width="25">Sr NO</th>
<th width="200">Name/Account No.</th>	
<th width="75">Amount</th>
<?php //if($_SESSION['designation']=='7' || $_SESSION['designation']=='2'){ ?>
<th>Bill Paid Amt</th>
<th width="75">Invoice No</th>
<?php // } ?>
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
        $tablex=mysqli_query($con,$str);
        if(mysqli_num_rows($tablex)>0){
	while($app=mysqli_fetch_row($tablex))
	{
	
	//echo $app[1];
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


?><div class=article>
<div class=title><tr>
<td width="25"><?php echo $app[1]; ?></td>
<td width="200">
<?php echo $rx[1]."/".$rx[2]; ?>
</td>
<td width="75" align='CENTER'><?php echo $row[16]; $total=$total+$row[16]; ?></td>
<?php //if($_SESSION['designation']=='7' || $_SESSION['designation']=='2'){ 
$ebp=mysqli_query($con,"select paid_amount,entrydt  Paid_Date from ebpayment where Bill_No='".$app[1]."'");
$ebr=mysqli_fetch_row($ebp);

$inv=mysqli_query($con,"select s.send_id,s.entrydt from send_bill s,send_bill_detail d where s.status='0' and s.send_id=d.send_id and d.status=0 and d.reqid='".$app[1]."'");
$invro=mysqli_fetch_row($inv);

$cust_name_qry = mysqli_query($con,"SELECT contact_first FROM contacts where short_name ='".$row[12]."'");
$cust_name_row=mysqli_fetch_array($cust_name_qry);
?>
<td width="75"><?php 
if(mysqli_num_rows($inv)==0)
{
$club=mysqli_query($con,"select * from ebillfundcancinv where reqid='".$app[1]."' and status=0");
if(mysqli_num_rows($club)>0)
echo "Clubed with next Bill";
}
echo $ebr[0];$paidamt=$paidamt+$ebr[0]; ?></td>
<td width="75"><?php echo $invro[0]; ?></td>
<?php
//}  ?>
<td width="200"><?php echo $qrrow[1]; ?></td>
<td width="75"><?php echo $cust_name_row[0]; ?></td>
<td width="75"><?php echo $qrrow[0]; ?></td>
<td width="75"><?php echo $row[1]; ?></td>

<td width="75"><?php echo $row[8]; ?></td>
<td width="75"><?php echo $qrrow[2]; ?></td>
<td width="75"><?php echo $row[17]; ?></td>
<td width="75"><?php echo date('d/m/y',strtotime($app[3])); ?></td>
<td width="75"><?php if($ebr[1]!='0000-00-00' && $ebr[1]!='1970-01-01' && $ebr[1]!='' ) { echo date('d/m/Y',strtotime($ebr[1])); }?></td>
<td width="75"><?php if($ebr[2]!='0000-00-00' && $ebr[2]!='1970-01-01' && $ebr[2]!='' ) { echo date('d/m/Y',strtotime($ebr[2])); }?></td>
<td width="75"><?php if($invro[1]!='0000-00-00'  && $invro[1]!='1970-01-01'  && $invro[1]!='') { echo date('d/m/Y',strtotime($invro[1])); }?></td>
</tr></div></div>
<?php
}
?>
<tr><td colspan=2 align='right' >Total Amount Transfer through Software & Receipt Received (A) </td><td align='CENTER' ><?php echo $total; ?></td><td><?php echo $paidamt; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>
<?php

}
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
$ebpay=mysqli_query($con,"select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.supervisor=a.hname and a.aid='".$_POST['sup']."') and upby!='' and entrydt>='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['frmdt'])))." 00:00:00' AND  entrydt<='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['todt'])))." 23:59:59'");
else
$ebpay=mysqli_query($con,"select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.req_no not in($req) and r.supervisor=a.hname and a.aid='".$_POST['sup']."') and upby!='' and entrydt>='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['frmdt'])))." 00:00:00' AND  entrydt<='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['todt'])))." 23:59:59'");

//echo "select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.req_no not in($req) and r.supervisor=a.hname and a.aid='".$_POST['sup']."') and upby!='' and entrydt>='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['frmdt'])))." 00:00:00' AND  entrydt<='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['todt'])))." 23:59:59'";


while($ebpayro=mysqli_fetch_array($ebpay))
{
$sql2="Select * from ebillfundrequests where req_no='".$ebpayro[0]."'";
		
        $table2=mysqli_query($con,$sql2);    
        $row2=mysqli_fetch_row($table2);
        
$qry4=mysqli_query($con,"select bank,atmsite_address,location from ".$row2[12]."_sites where trackerid='".$row2[14]."'");
$qrrow4=mysqli_fetch_array($qry4);

//$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
//$brro=mysqli_fetch_row($branch);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	
$accs2=mysqli_query($con,"select * from fundaccounts where aid='".$_POST['sup']."'");
$rx2=mysqli_fetch_row($accs2);

?>
<tr>
<td width="25"><?php echo ++$x."/"."<br>".$ebpayro[0]; ?></td>
<td width="200">
<?php echo $rx2[1]."/".$rx2[2]; ?>
</td>
<td width="75" align='CENTER'><?php echo $row2[16]; $total2=$total2+$row2[16]; ?></td>
<?php //if($_SESSION['designation']=='7' || $_SESSION['designation']=='2'){ 

$paidamt2=$paidamt2+$ebpayro[1];
$inv2=mysqli_query($con,"select s.send_id,s.entrydt from send_bill s,send_bill_detail d where s.status='0' and s.send_id=d.send_id and d.status=0 and d.reqid='".$row2[0]."'");
$invro2=mysqli_fetch_row($inv2);

$cust_name_qry = mysqli_query($con,"SELECT contact_first FROM contacts where short_name ='".$row2[12]."'");
$cust_name_row=mysqli_fetch_array($cust_name_qry);
?>
<td width="75"><?php echo $ebpayro[1];
if(mysqli_num_rows($inv2)==0)
{
$club2=mysqli_query($con,"select * from ebillfundcancinv where reqid='".$row2[1]."' and status=0");
if(mysqli_num_rows($club2)>0)
echo "Clubed with next Bill";
}
//echo $row2[0]; ?></td>
<td width="75"><?php echo $invro2[0]; ?></td>
<?php
//}  ?>
<td width="200"><?php echo $qrrow4[1]; ?></td>
<td width="75"><?php echo $cust_name_row[0]; ?></td>
<td width="75"><?php echo $qrrow4[0]; ?></td>
<td width="75"><?php echo $row2[1]; ?></td>

<td width="75"><?php echo $row2[8]; ?></td>
<td width="75"><?php echo $qrrow4[2]; ?></td>
<td width="75"><?php echo $row2[17]; ?></td>
<td></td>
<td width="75"><?php if($ebpayro[2]!="0000-00-00" && $ebpayro[2]!="") { echo date('d/m/Y',strtotime($ebpayro[2]));} ?></td>
<td width="75"><?echo date('d/m/Y',strtotime($ebpayro[4]));?></td>
<td width="75"><?echo date('d/m/Y',strtotime($invro2[1]));?></td>
</tr></div></div>
<?php
}
?>
<tr><td colspan=2 align='right' >Total Amount Transfer through On Account - Company/Self & Receipt Received (B)</td><td align='CENTER' ><?php echo $total2; ?></td><td> <?php echo $paidamt2; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>
<?php
//onaccount
if(isset($_POST['sup']))
{
$total3=0;
$paidamt3=0;
//echo "select * from ebonacctransfers where  accid='".$_POST['sup']."' and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')";
$ebpay=mysqli_query($con,"select * from ebonacctransfers where  accid='".$_POST['sup']."' and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')");

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
<td colspan=8 align='right' >&nbsp;</td><td><?php echo $ebpayro[6]; ?></td>
<td><?php echo date('d/m/Y',strtotime($ebpayro[3])); ?></td>
<td>test</td>
<?php
}
}
?>
<tr><td colspan=2 align='right' >Total Amount Transfer through Online Transaction (C)</td><td align='CENTER' ><?php echo $total3; ?></td><td> <?php echo $paidamt3; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>

<?php
//Transfer
$total5=0;
$paidamt5=0;
$x=0;
if(isset($_POST['sup']) && $_POST['sup']!=-1)
{
?>
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
<tr><td><?php echo ++$x; ?></td>
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

$cust_name_qry = mysqli_query($con,"SELECT contact_first FROM contacts where short_name ='".$ebfundreq['cust_id']."'");
$cust_name_row=mysqli_fetch_array($cust_name_qry);
?>
<tr><td><?php echo ++$x;  ?></td>
<td width="200">
<?php echo $rx21['hname']."/".$rx21[2]; ?>
</td>
<td>&nbsp;</td>
<td><?php echo $trans['pamount']; $paidamt5+=$trans['pamount']; ?></td>
<td><?php echo $trans['reqid']; ?></td>
<td><?php echo $qrrow['atmsite_address']; ?></td>
<td><?php echo $cust_name_row[0]; ?></td>
<td><?php echo $qrrow['bank']; ?></td>
<td><?php echo $ebfundreq['atmid']; ?></td>
<td><?php echo $rx2['hname']."<br/>".$rx2['accno']; ?></td>
<td><?php echo $qrrow['location']; ?></td>
<td><?php echo $trans['payment_type']." ".$trans['chqno']; ?></td>
<td><?php echo date('d/m/Y',strtotime($trans['pdate'])); ?></td>
<?php
}
?>
<tr><td colspan=2 align='right' >Total Amount Transfer(T)</td><td align='CENTER' ><?php echo $total5; ?></td><td> <?php echo $paidamt5; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>
<?php
//Reversal
$total6=0;
$paidamt6=0;
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

$cust_name_qry = mysqli_query($con,"SELECT contact_first FROM contacts where short_name ='".$ebfundreq['cust_id']."'");
$cust_name_row=mysqli_fetch_array($cust_name_qry);
?>
<tr><td><?php echo ++$x; ?></td>
<td width="200">
<?php echo $rx2[1]."/".$rx2[2]; ?>
</td>
<td>&nbsp;</td>
<td><?php echo $rev['pamount']; $paidamt6+=$rev['pamount']; ?></td>
<td><?php echo $rev['reqid']; ?></td>
<td><?php echo $qrrow['atmsite_address']; ?></td>
<td><?php echo $cust_name_row[0]; ?></td>
<td><?php echo $qrrow['bank']; ?></td>
<td><?php echo $ebfundreq['atmid']; ?></td>
<td><?php echo $rev['dbtacc']; ?></td>
<td><?php echo $qrrow['location']; ?></td>
<td><?php echo $rev['payment_type']." ".$rev['chqno']; ?></td>
<td><?php echo date('d/m/Y',strtotime($rev['pdate'])); ?></td>
<?php
}
?>
<tr><td colspan=2 align='right' >Total Amount Reversal(R)</td><td align='CENTER' ><?php echo $total6; ?></td><td> <?php echo $paidamt6; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>
<?php
	}
?>

<?php
	if($_POST['sup']!=-1)
	{
		//echo "select debit,credit from fundaccounts where aid='".$_POST['sup']."'";
		$opening_fund_qry=mysqli_query($con,"select debit,credit,eb_received_bfsft from fundaccounts where aid='".$_POST['sup']."'");
		$opening_fund=mysqli_fetch_array($opening_fund_qry);
?>

<tr><td colspan=2 align='right' >Opening Balance (O)</td><td align='CENTER' ><?php echo $total4=$opening_fund[0]; ?></td><td> <?php echo $paidamt4=$opening_fund[1]; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>
<tr><td colspan=2 align='right' >Bill Received Before Software (B)</td><td align='CENTER' >&nbsp;</td><td> <?php echo $opening_fund[2]; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>
<?php
	}
?>


<!--<tr><td colspan=2 align='right' >Transferred Amt through Software</td><td align='CENTER' ><?php echo $total2+$total; ?></td><td></td><td colspan=8 align='right' >&nbsp;</td></tr>
<tr><td colspan=2 align='right' >Received Bills on Amount Transferred through Software</td><td align='CENTER' ><?php echo $paidamt; ?></td><td></td><td colspan=8 align='right' >&nbsp;</td></tr>
<tr><td colspan=2 align='right' >On Account - Company/Self</td><td align='CENTER' ><?php echo $paidamt2; ?></td><td></td><td colspan=8 align='right' >&nbsp;</td></tr>-->
<tr><td colspan=2 align='right' >Total D=A+B+C+O+T+R</td><td align='CENTER' ><?php
 //echo $total."-".$total2."-".$total3."-".$total4;
 echo $total+$total2+$total3+$total4+$total5+$total6;

  ?>
  </td><td><?php echo $paidamt+$paidamt2+$paidamt3+$paidamt4+$paidamt5+$paidamt6+$opening_fund[2]; ?></td><td colspan=8 align='right' >&nbsp;</td></tr>
<!--<tr><td colspan=2 align='right' >Total Paid Amount (E)</td><td align='CENTER' ><?php echo $paidamt+$paidamt2+$paidamt3+$paidamt4; ?></td><td></td><td colspan=8 align='right' >&nbsp;</td></tr>-->
<tr><td colspan=2 align='right' >Difference Amount (D-E)</td><td align='CENTER' ><?php echo ($total+$total2+$total3+$total4+$total5+$total6)-($paidamt+$paidamt2+$paidamt3+$paidamt4+$paidamt5+$paidamt6+$opening_fund[2]); ?></td><td></td><td colspan=8 align='right' >&nbsp;</td></tr>
<?php
}

?>
<!--<tr><td colspan=10 align='CENTER' ><input type="submit" name="GENERATE" id="GENERATE" value="GENERATE PDF" /></td></tr>-->
</table></center></form>
</div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script></body></html>