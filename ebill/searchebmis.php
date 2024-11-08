<?php
session_start();
//echo $_SESSION['user'];
$desig=$_POST['desig'];
$service=$_POST['service'];
 $dept=$_POST['dept'];
//$_POST['cid']='Tata05';
include('config.php');

$cid="";

$sdate="";
$edate="";

	$strPage = $_REQUEST['Page'];
	
	$sql="Select * from login where designation='7' and deptid='2' and status=1";
	if(isset($_POST['user']) && $_POST['user']!='')
	{
	$sql.=" and username='".$_POST['user']."'";
	}
	
$table=mysqli_query($con,$sql);
$Num_Rows = mysqli_num_rows ($table);
 
// pagins
?>
 <center><div align="center">Total Records: <b><?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%50==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg']; //$_POST['perpg'];   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$sql.="  order by username ASC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con,$sql);
if(!$table)
echo mysqli_error();
//include_once('class_files/filter_new.php');
//$filter=new filter_new();
//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);

/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/
include("config.php");
?>
<form action="showpay.php" method="post" >
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 

<tr>
<th width="75">Sr NO</th>
<th>User</th>
<?php
if(isset($_POST['cid']) && $_POST['cid']!='')
{
echo "<th width='75'>Client</th>";
}
?>
<th width="75">Number of Bills Entered</th>
<th width="75">Number of Invoice Generated</th>
<th width="75">Bill Count</th>
<th width="75">Total Invoiced Amount</th>
<th width="75">Number of Bills Entered Total</th>
</tr>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
$appamt=0;
$reqamt=0;

$totbillcnt=0;
$totinvcnt=0;
$totinvbillcnt=0;
$totinvamt=0;
$totbillcntamt=0;
while($row= mysqli_fetch_row($table))
{
$sqlinv="select count(invoice_no) from send_bill where createdby='".$row[1]."' and status=0";
$eb="select count(Bill_No),sum(Paid_Amount) from ebpayment where upby='".$row[1]."'";
$billcnt="select * from send_bill where createdby='".$row[1]."' and status='0'";
if(isset($_POST['dt']) && isset($_POST['dt2']) && $_POST['dt']!='' && $_POST['dt2']!='')
{
$dt1=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt'])));
$dt2=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt2'])));
if($dt1==$dt2)
{
$eb.=" and entrydt like '".$dt1."%'";
$sqlinv.=" and entrydt like '".$dt1."%'";
$billcnt.=" and entrydt like '".$dt1."%'";
}
else{
$eb.=" and entrydt between '".$dt1."' and '".$dt2." 23:59:59'";
$sqlinv.=" and entrydt between '".$dt1."' and '".$dt2." 23:59:59'";

$billcnt.=" and entrydt between '".$dt1."' and '".$dt2." 23:59:59'";
}
}
else
{
$eb.=" and entrydt like '".date('Y-m-d')."%'";
$sqlinv.=" and entrydt like '".date('Y-m-d')."%'";
$billcnt.=" and entrydt like '".date('Y-m-d')."%'";
}

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$eb.=" and Bill_No in (select req_no from ebillfundrequests where cust_id='".$_POST['cid']."')";
$sqlinv.=" and customer_name = '".$_POST['cid']."'";
$billcnt.=" and customer_name = '".$_POST['cid']."'";
}
//echo $billcnt;
//echo $eb." ".$sqlinv."<br>";
$ebcount=mysqli_query($con,$eb);
$ebp=mysqli_fetch_row($ebcount);
 
$inv=mysqli_query($con,$sqlinv);
$invr=mysqli_fetch_row($inv);
$ebcn=mysqli_query($con,$billcnt);
$inebcn=0;
$amt=0;
while($ebcnro=mysqli_fetch_array($ebcn))
{
$amt=$amt+$ebcnro[4]+$ebcnro[11];
//echo "select * from send_bill_detail where send_id='".$ebcnro[0]."' and fiscalyr='".$ebcnro[14]."' and status=0";
$sendebdet=mysqli_query($con,"select * from send_bill_detail where send_id='".$ebcnro[0]."' and fiscalyr='".$ebcnro[14]."' and status=0");
$inebcn=$inebcn+mysqli_num_rows($sendebdet);
}
$totbillcnt=$totbillcnt+$ebp[0];
$totinvcnt=$totinvcnt+$invr[0];
$totinvbillcnt=$totinvbillcnt+$inebcn;
$totinvamt=$totinvamt+$amt;
$totbillcntamt+=$ebp[1];
?><div class=article>
<div class=title><tr>
<td width="75" align="center"><?php echo $count+1; ?></td>
<td width="75" align="center"><?php echo $row[1];  ?></td>
<?php
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cust_name_qry = mysqli_query($con,"SELECT contact_first FROM contacts where short_name ='".$_POST['cid']."'");
$cust_name_row=mysqli_fetch_array($cust_name_qry);
echo "<td width='75' align='center'>".$cust_name_row[0]."</td>";
}
?>
<td width="75" align="center"><?php echo $ebp[0];  ?></td>

<td  align="center"><?php echo $invr[0];  ?></td>
<td  align="center"><?php echo $inebcn;  ?></td>
<td align="right"><?php echo number_format($amt,2);  ?></td>
<td width="75" align="right"><?php echo number_format($ebp[1],2);  ?></td>
</tr>
<?php
$count=$count+1;

}
?>

</div></div>
<tr><th>Total</th><td>&nbsp;</td><?php
if(isset($_POST['cid']) && $_POST['cid']!='')
{
echo "<td width='75' align='center'>&nbsp;</td>";
}
?><td align="center"><?php echo $totbillcnt; ?></td><td align="center"><?php echo $totinvcnt; ?></td><td align="center"><?php echo $totinvbillcnt; ?></td><td align="right"><?php echo number_format($totinvamt,2); ?></td></td><td align="right"><?php echo number_format($totbillcntamt,2); ?></td></tr>
</table></form>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";
}
?></center>