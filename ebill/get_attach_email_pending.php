<?php
session_start();
//echo $_SESSION['user'];
include('config.php');
	$sql="Select * from ebillfundrequests where 1 ";
if(isset($_POST['cid']) && $_POST['cid']!='-1')
$sql.=" and cust_id='".$_POST['cid']."'";
	$sql.=" and reqstatus<>0 and reqstatus<>100 ";
	
	if(isset($_POST['atm']) && $_POST['atm']!='')
	$sql.=" and atmid LIKE'%".$_POST['atm']."%'";
	/*if($_POST['pstat']=='8')
	$sql.=" and req_no in (select distinct(reqid) from ebillfundapp)";*/
//echo $desig." ".$service." ".$dept;
if(isset($_POST['sv']) && $_POST['sv']!='')
$sql.=" and supervisor ='".$_POST['sv']."'";
//echo $sql;
$sql.=" order by req_no desc";
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
//echo $_SESSION['branch'];
include("config.php");
?>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 

<tr>
<th width="75">Sr NO</th>
<th width="75">Requesting Person</th>
<th width="75">Request Date</th>
<th width="75">ATM ID</th>
<th width="75">Address</th>
<th width="75">Bill Date</th>
<th width="75">Due Date</th>
<th width="75">From</th>
<th width="75">To</th>
<th width="75">Units</th>
<th width="75">Amount</th>
<th width="75">Supervisor</th>
<th width="75">Consumer_No</th><th width="75">Distributor</th><th width="75">landlord</th><th width="75">meter_no</th>
<th width="75">Remarks</th>
<th width="75">Last Approval Details</th>

<th width="75">Approval</th></tr>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
while($row= mysqli_fetch_array($table))
{
//echo $row[25]." hii ";
//echo "dept=".$dept;
//$count=$count+1;
$ctt="select atmsite_address,bank,projectid from ".$row[12]."_sites where trackerid='$row[14]'";
//if($_SESSION['branch']!="all" && $_SESSION['branch']!="")
//$ctt.=" and csslocalbranch in(select location from cssbranch where id in (".$_SESSION['branch']."))";

//echo "<br>".$ctt."<br>";
$qry1=mysqli_query($con,$ctt);
if(mysqli_num_rows($qry1)>0){
$qrrow=mysqli_fetch_array($qry1);
$amtToComp=$row['amount'];
$ebpay_qry=mysqli_query($con,"select Paid_Amount from ebpayment where Bill_No='".$row[0]."'");
if(mysqli_num_rows($ebpay_qry)>0)
{
	$ebpay_row=mysqli_fetch_array($ebpay_qry);
	$amtToComp=$ebpay_row[0];
}
//echo "SELECT threshhold FROM `threshhold` WHERE `cust_id` LIKE '".$row['cust_id']."' AND `project_id` LIKE '".$qrrow[2]."' AND `bank` LIKE '".$qrrow[1]."'<br/>";
$threshhold_qry=mysqli_query($con,"SELECT threshhold FROM `threshhold` WHERE `cust_id` LIKE '".$row['cust_id']."' AND `project_id` LIKE '".$qrrow[2]."' AND `bank` LIKE '".$qrrow[1]."'");
if(mysqli_num_rows($threshhold_qry)>0)
{
	$threshhold=mysqli_fetch_array($threshhold_qry);
	$threshhold_val=intval($threshhold[0]);
	$nod=floor((strtotime($row['end_date'])-strtotime($row['start_date'])) / 86400);
	$avgamt=intval($amtToComp*30.0/$nod);
	//echo "<br/>".$row[0]." ".$avgamt.">".$threshhold_val;
	if($avgamt>$threshhold_val)
	{
		//echo "select copy from ebillemailcpy where reqid='".$row[0]."' and status='1'";
		$email_attach_chck_qry=mysqli_query($con,"select copy from ebillemailcpy where reqid='".$row[0]."' and status='1'");
		if(mysqli_num_rows($email_attach_chck_qry)==0)
		{
			//echo "Email not attached.<br/>";
//echo $row[5];
$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
$brro=mysqli_fetch_row($branch);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	
//echo "select Consumer_No,Distributor,landlord,meter_no from ".$row[12]."_ebill where atmtrackid='".$row[14]."'";
$cons=mysqli_query($con,"select Consumer_No,Distributor,landlord,meter_no from ".$row[12]."_ebill where atmtrackid='".$row[14]."'");
$consro=mysqli_fetch_row($cons);

?><tr<?php if($row[25]=='1'){ ?> style="background:#FF7519" <?php } ?>>
<td width="75"><?php echo ($count+1)." ".$row[0]; ?></td>
<td width="75"><?php echo $brro[0]; //echo $row[6]; ?></td>
<td width="75"><?php echo date("d/m/Y h:i:s",strtotime($row[18])); ?></td>
<td width="75"><a href="javascript:void(0);" onclick="newwin('../ebill/ebsitehist.php?custid=<?php echo $row[12]; ?>&trackid=<?php echo $row[14]; ?>&atmid=<?php echo $row[1]; ?>','display',900,400)"><?php echo $row[1]; ?></a></td>
<td width="75"><?php echo $qrrow[0]; ?></td>
<td width="75"><?php if($row[2]!='0000-00-00'){echo date("d/m/Y",strtotime($row[2]));}else{ echo "NA"; } ?></td>
<td width="75"><?php if($row[9]!='0000-00-00'){echo date("d/m/Y",strtotime($row[9]));}else{ echo "NA"; }//echo $row[9]; ?></td>
<td width="75"><?php if($row[6]!='0000-00-00'){echo date("d/m/Y",strtotime($row[6]));}else{ echo "NA"; }//echo $row[6]; ?></td>
<td width="75"><?php if($row[7]!='0000-00-00'){echo date("d/m/Y",strtotime($row[7]));}else{ echo "NA"; }//echo $row[7]; ?></td>
<td width="75"><?php echo $row[3]; ?></td>
<td width="75"><?php echo $row[4]; ?></td>
<td width="75"><?php echo $row[8]; ?></td>
<td width="75"><?php echo $consro[0]; ?></td>
<td width="75"><?php echo $consro[1]; ?></td>
<td width="75"><?php echo $consro[2]; ?></td>
<td width="75"><?php echo $consro[3]; ?></td>
<!-- <td width="75"><?php echo date("d/m/Y h:i:s a",strtotime($row[10])); ?></td>
<td width="75"><?php echo $row[1]; ?></td>-->
<td width="75">
<br><br>
<form method="post" action="email_attch.php" enctype="multipart/form-data">
<input type="hidden" name="reqid" value="<?php echo $row[0]; ?>"/>
<input type="file" required="required" name="email_cpy">
<input type="submit" value="Attach"/>
</form>
</td>
<td><br /><br />
<a href="javascript:void(0);" id='feefbk<?php echo $count; ?>' onclick="newwin('viewefeed.php?id=<?php echo $row[0]; ?>','display','400',400)">Click to view all Feedbacks</a>
</td>


<td id="app<?php echo $count; ?>">
<?php 
if($row[15]=='8')
echo "Amount Paid: Rs. ".$row[16];
if($row[17]!=0)
echo "<br> Cheque No".$row[17];

?>
</td></tr>
<?php
$count=$count+1;


			}// End of Email attach
		}//End of Average amount
	}//End of Threshhold 

}
}
?></table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
?>