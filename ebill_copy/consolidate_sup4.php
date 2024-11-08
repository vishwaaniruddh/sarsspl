<?php 
include('config.php');

?>
<center>
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Consolidate Supervisor Outstanding Report')">Export Table data into Excel</button>
<?php //echo "Sup :".$_REQUEST['sup']."From : ".$_REQUEST['frmdt']." To : ".$_REQUEST['todt']; ?>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<tr>
<th width="75">Sr NO</th>
<th width="75">Supervisor</th>
<th width="75">Account No.</th>
<th width="75">Branch</th>
<th>Opening Balance</th>
<!--<th>Bill Received Before Software</th>-->
<th>Transferred Amount</th>
<th>Opening Balance + Transferred Amount</th>
<th>Invoiced to Customer/ Pending for invoice</th>
<th>Transfer To</th>
<th>Transfer From</th>

<!--<th>Pod</th>
<th>Dispute</th>-->

<th>Net paid</th>
<th>Reversal</th>
<!--<th>Pending For entry at HO</th>-->
<th>Outstanding</th>
</tr>

<?php	
	$sql="Select hname,aid,branch,debit,credit,accno,eb_received_bfsft from  fundaccounts where 1";
	if(isset($_REQUEST['sup']) && $_REQUEST['sup']!=-1)
		$sql.=" and aid='".$_REQUEST['sup']."'";
		//echo $sql;
	$opening_fund_qry=mysqli_query($con,$sql);
	$i=1;
	while($opening_fund=mysqli_fetch_array($opening_fund_qry))
	{
	$aid=$opening_fund[1];
	
	//Opening Balance is set to zero(0).
	//$total4=$opening_fund['debit'];
	//$paidamt4=$opening_fund['credit'];
	
	
	$total4=0;
	$paidamt4=0;
	$paidamt=0;
        $total=0;
        $x=0;
        $str="SELECT * FROM `ebfundtransfers` where reqid in (select req_no from ebillfundrequests) and status=0";
		$str.=" and accid='".$aid."'";
if(isset($_REQUEST['frmdt']) && isset($_REQUEST['todt']) && $_REQUEST['frmdt']!='' && $_REQUEST['todt']!='')
$str.=" and pdate>=STR_TO_DATE('".$_REQUEST['frmdt']."','%d/%m/%Y') AND pdate<=STR_TO_DATE('".$_REQUEST['todt']."','%d/%m/%Y') ";
else
$str.=" and pdate>='".date('Y-m-d',strtotime('-2 days'))."' AND pdate<='".date('Y-m-d')."' ";

$str.="  order by pdate DESC,chqno ASC";
//echo $str;
        $tablex=mysqli_query($con,$str);
        if(mysqli_num_rows($tablex)>0){
		while($app=mysqli_fetch_row($tablex))
		{
			
			//echo $app[$x];
			$sql="Select * from ebillfundrequests where req_no='".$app[1]."'";
				
		        $table=mysqli_query($con,$sql);    
		        $row=mysqli_fetch_row($table);
		        $reqid[]=$row[0];
		        $ebp=mysqli_query($con,"select paid_amount from ebpayment where Bill_No='".$app[1]."'");
			$ebr=mysqli_fetch_row($ebp);
		        $total=$total+$row[16]; 
			$paidamt=$paidamt+$ebr[0];
		}
	}

$paidamt2=0;
        $total2=0;

$req=implode(",",$reqid);
//echo "select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.req_no not in($req) and  r.supervisor=a.hname and a.aid='".$aid."') and upby!='' and entrydt>=STR_TO_DATE('".$_REQUEST['frmdt']." 00:00:00','%d/%m/%Y') AND  entrydt<=STR_TO_DATE('".$_REQUEST['todt']." 23:59:00','%d/%m/%Y')";
//$ebpay=mysqli_query($con,"select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.req_no not in($req) and  r.supervisor=a.hname and a.aid='".$aid."') and upby!='' and entrydt>=STR_TO_DATE('".$_REQUEST['frmdt']." 00:00:00','%d/%m/%Y') AND  entrydt<=STR_TO_DATE('".$_REQUEST['todt']." 23:59:00','%d/%m/%Y')");
if($req=="")
$ebpay=mysqli_query($con,"select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.supervisor=a.hname and a.aid='".$opening_fund['aid']."') and upby!='' and Paid_Date>='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['frmdt'])))." 00:00:00' AND  Paid_Date<='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['todt'])))." 23:59:59'");
else
$ebpay=mysqli_query($con,"select * from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.req_no not in($req) and r.supervisor=a.hname and a.aid='".$opening_fund['aid']."') and upby!='' and Paid_Date>='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['frmdt'])))." 00:00:00' AND  Paid_Date<='".date('Y-m-d',strtotime(str_replace("/","-",$_POST['todt'])))." 23:59:59'");
while($ebpayro=mysqli_fetch_array($ebpay))
{
	$sql2="Select * from ebillfundrequests where req_no='".$ebpayro[0]."'";
		
	$table2=mysqli_query($con,$sql2);    
	$row2=mysqli_fetch_row($table2);
        if($row2[16]==0 || $row2[15] < 8 & $row2[15]!=0)
	{
		  $total2=$total2+0;
		$paidamt2=$paidamt2+$ebpayro[1];
	 }
}
//onaccount
$total3=0;
$paidamt3=0;
//echo "select * from ebonacctransfers where  accid='".$aid."' and pdate>=STR_TO_DATE('".$_REQUEST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_REQUEST['todt']." ','%d/%m/%Y')";
$ebpay=mysqli_query($con,"select * from ebonacctransfers where  accid='".$aid."' and pdate>=STR_TO_DATE('".$_REQUEST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_REQUEST['todt']." ','%d/%m/%Y')");

while($ebpayro=mysqli_fetch_array($ebpay))
{
$onacc=mysqli_query($con,"select * from onacctransfer where reqid='".$ebpayro[1]."'");
$onaccro=mysqli_fetch_row($onacc);
$total3=$total3+$onaccro[2];
}

$total5=0;
$paidamt5=0;
$trans_qry=mysqli_query($con,"SELECT sum(pamount) FROM `transfer` where  to_accid='".$aid."' and status=1 and pdate>=STR_TO_DATE('".$_REQUEST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')");
$trans=mysqli_fetch_array($trans_qry);
$total5=$trans[0];
$trans_qry=mysqli_query($con,"SELECT sum(pamount) FROM `transfer` where  from_accid='".$aid."' and status=1 and pdate>=STR_TO_DATE('".$_REQUEST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')");
$trans=mysqli_fetch_array($trans_qry);
$paidamt5=$trans[0];

$total6=0;
$paidamt6=0;
$x=0;
$rev_qry=mysqli_query($con,"SELECT sum(pamount) FROM `reversal` where  accid='".$aid."' and status=1 and pdate>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND  pdate<=STR_TO_DATE('".$_POST['todt']." ','%d/%m/%Y')");
$rev=mysqli_fetch_array($rev_qry);
$paidamt6=$rev[0];

$update_receipt_amt=0;
$update_reqno=array();
//echo "SELECT * FROM `update_receipt` WHERE `req_status` = 1 and reqid not in ($str_ebpay)";
$update_receipt_qry=mysqli_query($con,"SELECT * FROM `update_receipt` WHERE `req_status` = 1 and reqid not in (select Bill_No  from ebpayment where  Bill_No in(select r.req_no from ebillfundrequests r,fundaccounts a where r.supervisor=a.hname and a.aid='".$opening_fund['aid']."') and upby!='')");
while($update_receipt=mysqli_fetch_array($update_receipt_qry))
{
	$ur_ebreq_qry=mysqli_query($con,"SELECT req_no FROM `ebillfundrequests` WHERE `req_no` = '".$update_receipt['reqid']."' and supervisor='".$opening_fund[0]."'");
	if(mysqli_num_rows($ur_ebreq_qry)>0)
	{
		$update_reqno[]=$update_receipt['reqid'];
		$update_receipt_amt+=$update_receipt['amt'];
	}
}
?>

<tr>
<td><?php echo $i; ?>

</td>
<td><?php echo $opening_fund['hname']; ?></td>
<td><?php echo $opening_fund['accno']; ?></td>
<td><?php echo $opening_fund['branch']; ?></td>
<td><?php if($total4!=0){ echo $total4; }else if($paidamt4!=0){ echo "-".$paidamt4;}else{ echo "0";} ?>
<!--<td><?php if($opening_fund['eb_received_bfsft']!='0'){echo $opening_fund['eb_received_bfsft'];}else{ echo "0";} ?></td>-->
<td><?php echo $total+$total2+$total3; ?></td>
<td><?php echo $total+$total2+$total3+$total4-$paidamt4; ?></td>
<td><?php echo $paidamt+$paidamt2+$paidamt3 ?></td>


<td><?php echo $total5; ?></td>
<td><?php echo $paidamt5; ?></td>


<?php
/*
$podqry=mysqli_query($con,"select sum(total_amount)from ebill_package where supervisor_id='".$_POST['sup']."' AND status='0' AND DATE(entrydate)>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND DATE(entrydate)<=STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y') ");
$podqrya=mysqli_fetch_array($podqry);

$podqry1=mysqli_query($con,"select sum(total_amount)from ebill_package where supervisor_id='".$_POST['sup']."' AND status='2' AND DATE(entrydate)>=STR_TO_DATE('".$_POST['frmdt']."','%d/%m/%Y') AND DATE(entrydate)<=STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y') ");
$podqrya1=mysqli_fetch_array($podqry1);

*/
?>
<!--<td><?php echo $podqrya[0]; ?></td>
<td><?php echo  $podqrya1[0]; ?></td>-->


<td><?php echo $podqrya[0]+$podqrya1[0]+$paidamt+$paidamt2+$paidamt3; ?></td>
<td><?php echo $paidamt6."test"; ?></td>

<!--<td>
	<?php 
		//echo $update_receipt_amt."<br/>".implode(",",$update_reqno); 
		echo $update_receipt_amt;
	?>
</td>-->

<td><?php 
//echo ($total+$total2+$total3+$total4+$total5+$total6)-($paidamt+$paidamt2+$paidamt3+$paidamt4+$paidamt5+$paidamt6+$opening_fund['eb_received_bfsft']+$update_receipt_amt);
$tot1=($total+$total2+$total3+$total4+$total5+$total6)-($paidamt+$paidamt2+$paidamt3+$paidamt4+$paidamt5+$paidamt6);
$outs=($total+$total2+$total3+$total4-$paidamt4)-($podqrya1[0]+$podqrya[0]+$paidamt+$paidamt2+$paidamt3+$paidamt6);
echo $outs; ?></td>
</tr>
<?php
	$i++;
	}
?>
</table>
</center>