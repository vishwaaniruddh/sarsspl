<?php
session_start();
//echo $_SESSION['user'];
$desig= $_POST['desig'];
$service=$_POST['service'];
 $dept=$_POST['dept'];
// $atm=$_POST['atm'];

$branchmgr=0;
if($_SESSION['designation']==9 && $_SESSION['branch']!="all" && $_SESSION['branch']!="")
	$branchmgr=1;
include('config.php');

$cid="";

$sdate="";
$edate="";

	$strPage = $_REQUEST['Page'];
	
	$sql="Select * from ebillfundrequests where 1 ";
if(isset($_POST['cid']) && $_POST['cid']!='-1')
$sql.=" and cust_id='".$_POST['cid']."'";
	if(isset($_POST['pstat']) && $_POST['pstat']!='')
	$sql.=" and reqstatus='".$_POST['pstat']."' and reqstatus<>'100'";
	else
	$sql.=" and reqstatus<>'8' and reqstatus<>'0' and reqstatus<>'100'";
	
	if(isset($_POST['atm']) && $_POST['atm']!='')
	$sql.=" and atmid LIKE'%".$_POST['atm']."%'";
	if(isset($_POST['app']) && $_POST['app']!='')
	{
	if($_POST['app']=='arrear')
	$sql.=" and reqstatus ='5' and arrearstatus='1'";
	else
	$sql.=" and reqstatus ='".$_POST['app']."'";
	}
	/*if($_POST['pstat']=='8')
	$sql.=" and req_no in (select distinct(reqid) from ebillfundapp)";*/

if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
 $sdate=$_REQUEST['sdate'];
$sdate=str_replace("/","-",$sdate);
$sdate=date("Y-m-d",strtotime($sdate));
$edate=$_REQUEST['edate'];
$edate=str_replace("/","-",$edate);
$edate=date("Y-m-d",strtotime($edate));

if($sdate!=$edate){
if(isset($_POST['pstat']) && $_POST['pstat']=='8')
$sql.=" and req_no in (select reqid from ebfundtransfers where pdate between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y') order by pdate DESC,chqno ASC) ";
}
else
{
if(isset($_POST['pstat']) && $_POST['pstat']=='8')
$sql.=" and req_no in (select reqid from ebfundtransfers where pdate =STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y') order by pdate DESC,chqno ASC) ";
}
}
//echo $desig." ".$service." ".$dept;
if($desig=="11" && $dept=='4')
{
$qr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$qrro=mysqli_fetch_row($qr);
$qr1=mysqli_query($con,"SELECT hname FROM `fundaccounts` WHERE `srno` = '".$qrro[0]."'");
$qrro1=mysqli_fetch_array($qr1);
$sql.=" and (reqby='".$qrro[0]."' or supervisor ='".$_SESSION['user']."' or supervisor ='".$qrro1[0]."')";
}
else{
if(isset($_POST['sv']) && $_POST['sv']!='')
$sql.=" and supervisor ='".$_POST['sv']."'";
}
$sql.=" and reqby not in (select srno from login where designation='7')";
//echo $sql;
$table=mysqli_query($con,$sql);
$showpaging=1;
if($branchmgr)
{
	$showpaging=0;
}
if($showpaging)
{
$Num_Rows = mysqli_num_rows ($table);
 
// pagins
?>
 <div align="center">
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
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
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
$sql.=" order by req_no desc  LIMIT $Page_Start , $Per_Page";
}
else
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
<th width="75">Reqid</th>
<th width="75">Requesting Person</th>
<th width="75">Request Date</th>
<th width="75">ATM ID</th>
<th width="75">Address</th>
<th width="75">Bill Date</th>
<th width="75">Due Date</th>
<th width="75">From</th>
<th width="75">To</th>
<th width="75">Days</th>
<th width="75">Units</th>
<th width="75">Average Amount</th>
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
$login_srno_qry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$login_srno=mysqli_fetch_row($login_srno_qry);
while($row= mysqli_fetch_array($table))
{
//echo $row[25]." hii ";
//echo "dept=".$dept;
//$count=$count+1;
$ctt="select atmsite_address,bank,projectid  from ".$row[12]."_sites where trackerid='$row[14]'";
if($branchmgr)
{
	if($row['reqby']!=$login_srno[0])
	{
		if($_SESSION['branch']!="all" && $_SESSION['branch']!="")
			$ctt.=" and csslocalbranch in(select location from cssbranch where id in (".$_SESSION['branch']."))";
	}
}
//echo "<br>".$ctt."<br>";
$qry1=mysqli_query($con,$ctt);
if(mysqli_num_rows($qry1)>0){
$qrrow=mysqli_fetch_array($qry1);
//echo $row[5];
$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
$brro=mysqli_fetch_row($branch);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	
//echo "select Consumer_No,Distributor,landlord,meter_no from ".$row[12]."_ebill where atmtrackid='".$row[14]."'";
$cons=mysqli_query($con,"select Consumer_No,Distributor,landlord,meter_no from ".$row[12]."_ebill where atmtrackid='".$row[14]."'");
$consro=mysqli_fetch_row($cons);

$email_not_attach=0;
$nod=floor((strtotime($row[7])-strtotime($row[6])) / 86400);

$reject_reason_str='';
$back_pending=0;
//echo "<br/>SELECT threshhold FROM `threshhold` WHERE `cust_id` LIKE '".$row['cust_id']."' AND `project_id` LIKE '".$qrrow[2]."' AND `bank` LIKE '".$qrrow[1]."'";
$threshhold_qry=mysqli_query($con,"SELECT threshhold FROM `threshhold` WHERE `cust_id` LIKE '".$row['cust_id']."' AND `project_id` LIKE '".$qrrow[2]."' AND `bank` LIKE '".$qrrow[1]."'");
if(mysqli_num_rows($threshhold_qry)>0)
{
	$threshhold=mysqli_fetch_array($threshhold_qry);
	$threshhold_val=intval($threshhold[0]);
	$avgamt=intval($row['amount']*30.0/$nod);
	//echo $avgamt.">".$threshhold_val;
	if($avgamt>$threshhold_val)
	{
		//echo "select copy from ebillemailcpy where reqid='".$row[0]."' and status='1'";
		$email_attach_chck_qry=mysqli_query($con,"select copy from ebillemailcpy where reqid='".$row['req_no']."' and status='1'");
		if(mysqli_num_rows($email_attach_chck_qry)==0)
		{
			$reject_reason_str='Email Not attached';
			$email_not_attach=1;
		}
		/*else
		{*/
			//echo "hi";
			$pending_req=array();
			//echo "select * from ebillfundrequests f where f.reqstatus<>100 and f.reqstatus<>0 and f.req_no not in (select alert_id from ebfundtranscanc where status=0) and f.req_no not in (select reqid from ebillfundcancinv where status=0)  and f.atmid like ('".$row['atmid']."') and f.req_no<>".$row['req_no']." and f.print='n' order by f.req_no";
			$th_chck_qry=mysqli_query($con,"select * from ebillfundrequests f where f.reqstatus<>100 and f.reqstatus<>0 and f.req_no not in (select alert_id from ebfundtranscanc where status=0) and f.req_no not in (select reqid from ebillfundcancinv where status=0)  and f.atmid like ('".$row['atmid']."') and f.req_no<>".$row['req_no']." and f.print='n'  and f.req_no<".$row['req_no']." and f.req_no>41220 order by f.req_no");
			while($th_chck=mysqli_fetch_array($th_chck_qry))
			{
				$amtToComp=$th_chck['amount'];
				$ebpay_qry=mysqli_query($con,"select Paid_Amount from ebpayment where Bill_No='".$th_chck['req_no']."'");
				if(mysqli_num_rows($ebpay_qry)>0)
				{
					$ebpay_row=mysqli_fetch_array($ebpay_qry);
					$amtToComp=$ebpay_row[0];
				}
				$nod1=floor((strtotime($th_chck['end_date'])-strtotime($th_chck['start_date'])) / 86400);
				$chck_amt=intval($amtToComp*30.0/$nod1,2);
				echo $chck_amt.">".$threshhold_val." ".$th_chck['req_no']."<br/>";
				if($chck_amt>$threshhold_val)
				{
					$email_attach_chck_qry1=mysqli_query($con,"select copy from ebillemailcpy where reqid='".$th_chck[0]."' and status='1'");
					if(mysqli_num_rows($email_attach_chck_qry1)==0)
					{
						$back_pending++;
						$pending_req[]=$th_chck[0];
					}
				}
			}
			if($back_pending>0)
			{
				$reject_reason_str="Previous Email not attached. Request ids are ".implode(",", $pending_req);
				$email_not_attach=1;
			}
		//}
	}
}

?><tr<?php if($row[25]=='1'){ ?> style="background:#FF7519" <?php } ?>>
<td width="75"><?php echo $count+1; ?></td>
<td width="75"><?php echo $row[0]; ?></td>
<td width="75"><?php echo $brro[0]; //echo $row[6]; ?></td>
<td width="75"><?php echo date("d/m/Y h:i:s",strtotime($row[18])); ?></td>
<td width="75"><a href="javascript:void(0);" onclick="newwin('../ebill/ebsitehist.php?custid=<?php echo $row[12]; ?>&trackid=<?php echo $row[14]; ?>&atmid=<?php echo $row[1]; ?>','display',900,400)"><?php echo $row[1]; ?></a></td>
<td width="75"><?php echo $qrrow[0]; ?></td>
<td width="75"><?php if($row[2]!='0000-00-00'){echo date("d/m/Y",strtotime($row[2]));}else{ echo "NA"; } ?></td>
<td width="75"><?php if($row[9]!='0000-00-00'){echo date("d/m/Y",strtotime($row[9]));}else{ echo "NA"; }//echo $row[9]; ?></td>
<td width="75"><?php if($row[6]!='0000-00-00'){echo date("d/m/Y",strtotime($row[6]));}else{ echo "NA"; }//echo $row[6]; ?></td>
<td width="75"><?php if($row[7]!='0000-00-00'){echo date("d/m/Y",strtotime($row[7]));}else{ echo "NA"; }//echo $row[7]; ?></td>
<td width="75"><?php $nod=0; if($row[6]!='0000-00-00' and $row[7]!='0000-00-00'){echo $nod=floor((strtotime($row[7])-strtotime($row[6])) / 86400);}else{echo "NA";}  ?></td>
<td width="75"><?php echo $row[3]; ?></td>
<td width="75"><?php if($nod!=0)echo number_format ($row[4]*30.0/$nod,2); ?></td>
<td width="75"><?php echo $row[4]; ?></td>
<td width="75"><?php echo $row[8]; ?></td>
<td width="75"><?php echo $consro[0]; ?></td>
<td width="75"><?php echo $consro[1]; ?></td>
<td width="75"><?php echo $consro[2]; ?></td>
<td width="75"><?php echo $consro[3]; ?></td>
<!-- <td width="75"><?php echo date("d/m/Y h:i:s a",strtotime($row[10])); ?></td>
<td width="75"><?php echo $row[1]; ?></td>-->
<td width="75"><?php echo $row[19];
$scan=mysqli_query($con,"select * from ebillscancpy where reqid='".$row[0]."'");
if(mysqli_num_rows($scan))
{
$scanro=mysqli_fetch_row($scan);
?><br><a href="javascript:void(0);" onclick="newwin('scannedbill.php?reqid=<?php echo $scanro[2]; ?>','display',900,400)">View Scanned Bill</a><?php
}
$email_attch_qry=mysqli_query($con,"select * from ebillemailcpy where reqid='".$row[0]."'");
if(mysqli_num_rows($email_attch_qry))
{
$email_attch=mysqli_fetch_array($email_attch_qry);
?><br><br><a href="ebemailcpy/<?php echo $email_attch['copy']; ?>">View Email</a>
<?php
}
else
{
	if($desig==8 && $service==2 &&  $dept==4)
	{
?>
<br><br>
<form method="post" action="email_attch.php" enctype="multipart/form-data">
<input type="hidden" name="reqid" value="<?php echo $row[0]; ?>"/>
<input type="file" required="required" name="email_cpy">
<input type="submit" value="Attach"/>
</form>
<?php
	}
}
 ?>

</td>
<td>

<?php
//echo "select appid,appby,apptime,level,remarks from fundrequestapproval where reqid='".$row[0]."' order by appid DESC limit 1";
$lst=mysqli_query($con,"select appid,appby,apptime,level,remarks from ebillfundapp where reqid='".$row[0]."' order by appid DESC limit 1");
while($lstro=mysqli_fetch_array($lst))
{
if($lstro[3]=='0')
$stat="Rejected";
else
$stat="Approved";
echo $lstro[1]."<br> ".date("d/m/Y h:i:s a",strtotime($lstro[2]))." <br>".$stat."<br> ".$lstro[4];
}
?><br /><br />
<a href="javascript:void(0);" id='feefbk<?php echo $count; ?>' onclick="newwin('viewefeed.php?id=<?php echo $row[0]; ?>','display','400',400)">Click to view all Feedbacks</a>
</td>


<td id="app<?php echo $count; ?>" <?php if($email_not_attach){ ?> style="background:red" <?php } ?>>
<?php 
echo $reject_reason_str;
if($row[15]=='8')
echo "Amount Paid: Rs. ".$row[16];
///echo "desig=".$desig." ".$service." ".$dept." ".$row[8];
if($desig=="10" && $service=='3' && $dept=='4' && $row[15]=='1')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none"><input type="hidden" name="arrear<?php echo $count; ?>" id="arrear<?php echo $count; ?>" value=<?php echo $row[25]; ?>>
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','2')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>
<?php
}
/*
if($desig=="8" && $service=='2' && $dept=='4' && $row[15]=='2')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none"><input type="hidden" name="arrear<?php echo $count; ?>" id="arrear<?php echo $count; ?>" value=<?php echo $row[25]; ?>>
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','3')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}
if($desig=="8" && $service=='1' && $dept=='4' && $row[15]=='3')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none"><input type="hidden" name="arrear<?php echo $count; ?>" id="arrear<?php echo $count; ?>" value=<?php echo $row[25]; ?>>
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','4')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}*/

$status=0;

if($desig=="8" && $service=='2' && $dept=='4' && $row[15]=='2')
	$status=3;
else if($desig=="8" && $service=='1' && $dept=='4' && $row[15]=='3')
	$status=4;
//echo $status;
if($status!=0)
{
if($status==3 && $back_pending==0)
{ if($row[8]=='ONLINE')$status=4;
?>
<a href="#" onclick="pop('popDiv<?php echo $count; ?>');getPoints(<?php echo $count; ?>,<?php echo $status; ?>);" style="background:#FFFF99" >Update</a>
<div id="popDiv<?php echo $count; ?>" class="ontop">
    <div id="showrem<?php echo $count; ?>" class="popup"><input type="hidden" name="arrear<?php echo $count; ?>" id="arrear<?php echo $count; ?>" value="<?php echo $row[25]; ?>">
<table width="100%">
<!--<tr>
<th>Email :</th><td><input type="text" name="email" required id="email" value=""></td>
</tr>
<tr>
<th>CCEmail :</th><td><textarea rows="5" name="ccemail" required id="ccemail"></textarea></td>
</tr>-->
<tr>
	<td>Amount:</td>
    <td><input type="text" name="amount<?php echo $count; ?>" id="amount_<?php echo $count; ?>" value="<?php echo $row[4]; ?>"/></td>
</tr>
<tr>
    <td>Supervisor Amount :</td>
    <td><?php echo $row[4]; ?></td>
</tr>
<tr>
    <td>From:</td>
    <td><?php if($row[6]!='0000-00-00'){echo date("d/m/Y",strtotime($row[6]));}else{ echo "NA"; } ?></td>
</tr>
<tr>
    <td>To:</td>
    <td><?php if($row[7]!='0000-00-00'){echo date("d/m/Y",strtotime($row[7]));}else{ echo "NA"; } ?></td>
</tr>
<tr>
    <td>Number of Days:</td>
    <td><?php echo $nod; ?></td>
</tr>
<tr>
    <td>Average Amount:</td>
    <td><?php if($nod!=0) { echo number_format ($row[4]*30.0/$nod,2); } ?></td>
</tr>
<tr>
	<td>Status</td>
    <td><input type="radio" name="status<?php echo $count; ?>" id="approve_<?php echo $count; ?>" checked="checked" value="approve" onclick="getPoints(<?php echo $count; ?>,<?php echo $status; ?>);"/>Approval &nbsp;
        <input type="radio" name="status<?php echo $count; ?>" id="reject_<?php echo $count; ?>" value="reject" onclick="getPoints(<?php echo $count; ?>,0);"/>Reject
    </td>
</tr>

<tr>
<td colspan="2">Points</td>
</tr>
<tr>
<td colspan="2">
<div id="points_<?php echo $count; ?>"></div>
</td>
</tr>
<tr>
<th>Update :</th><td><textarea name="remarks" id="remarks_<?php echo $count; ?>" placeholder="Remarks"></textarea>
<input type="hidden" name="reqid" value="<?php echo $row[0] ?>"/>
<input type="hidden" name="stat" id="stat_<?php echo $count; ?>" value="<?php echo $status; ?>"/>
<input type="hidden" name="count" id="count_<?php echo $count; ?>" value="0"/>
</td>
</tr>
<tr>
<td colspan="2"><input type="button" onclick="approve1('<?php echo $count; ?>','<?php echo $row[0] ?>')" value="Update" name="submit"/>
<input type="button" onClick="hide('popDiv<?php echo $count; ?>');scrollto('<?php echo $count; ?>');" value="Cancel" style="background:#FFFF99"></td>
</tr>
</table>
    </div>
</div>
<?php
}
if($status==4)
{
?>
<a href="#" onclick="pop('popDiv<?php echo $count; ?>');getPoints(<?php echo $count; ?>,<?php echo $status; ?>);" style="background:#FFFF99" >Update</a>
<div id="popDiv<?php echo $count; ?>" class="ontop">
    <div id="showrem<?php echo $count; ?>" class="popup"><input type="hidden" name="arrear<?php echo $count; ?>" id="arrear<?php echo $count; ?>" value="<?php echo $row[25]; ?>">
<table width="100%">
<!--<tr>
<th>Email :</th><td><input type="text" name="email" required id="email" value=""></td>
</tr>
<tr>
<th>CCEmail :</th><td><textarea rows="5" name="ccemail" required id="ccemail"></textarea></td>
</tr>-->
<tr>
	<td>Amount:</td>
    <td><input type="text" name="amount<?php echo $count; ?>" id="amount_<?php echo $count; ?>" value="<?php echo $row[4]; ?>"/></td>
</tr>
<tr>
    <td>Supervisor Amount :</td>
    <td><?php echo $row[4]; ?></td>
</tr>
<tr>
    <td>From:</td>
    <td><?php if($row[6]!='0000-00-00'){echo date("d/m/Y",strtotime($row[6]));}else{ echo "NA"; } ?></td>
</tr>
<tr>
    <td>To:</td>
    <td><?php if($row[7]!='0000-00-00'){echo date("d/m/Y",strtotime($row[7]));}else{ echo "NA"; } ?></td>
</tr>
<tr>
    <td>Number of Days:</td>
    <td><?php echo $nod; ?></td>
</tr>
<tr>
    <td>Average Amount:</td>
    <td><?php if($nod!=0) { echo number_format ($row[4]*30.0/$nod,2); } ?></td>
</tr>
<tr>
	<td>Status</td>
    <td><input type="radio" name="status<?php echo $count; ?>" id="approve_<?php echo $count; ?>" checked="checked" value="approve" onclick="getPoints(<?php echo $count; ?>,<?php echo $status; ?>);"/>Approval &nbsp;
        <input type="radio" name="status<?php echo $count; ?>" id="reject_<?php echo $count; ?>" value="reject" onclick="getPoints(<?php echo $count; ?>,0);"/>Reject
    </td>
</tr>

<tr>
<td colspan="2">Points</td>
</tr>
<tr>
<td colspan="2">
<div id="points_<?php echo $count; ?>"></div>
</td>
</tr>
<tr>
<th>Update :</th><td><textarea name="remarks" id="remarks_<?php echo $count; ?>" placeholder="Remarks"></textarea>
<input type="hidden" name="reqid" value="<?php echo $row[0] ?>"/>
<input type="hidden" name="stat" id="stat_<?php echo $count; ?>" value="<?php echo $status; ?>"/>
<input type="hidden" name="count" id="count_<?php echo $count; ?>" value="0"/>
</td>
</tr>
<tr>
<td colspan="2"><input type="button" onclick="approve1('<?php echo $count; ?>','<?php echo $row[0] ?>')" value="Update" name="submit"/>
<input type="button" onClick="hide('popDiv<?php echo $count; ?>');scrollto('<?php echo $count; ?>');" value="Cancel" style="background:#FFFF99"></td>
</tr>
</table>
    </div>
</div>
<?php
}
}

if($row[17]!=0)
echo "<br> Cheque No".$row[17];

?>
</td></tr>
<?php
$count=$count+1;
}
}
?></table>
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
?>