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
	
	$sql="Select * from ebillfundrequests where 1";
	if(isset($_POST['cid']) && $_POST['cid']!='')
	$sql.=" and cust_id='".$_POST['cid']."'";
	if(isset($_POST['pstat']) && $_POST['pstat']!='')
	$sql.=" and (reqstatus='".$_POST['pstat']."' and reqstatus<>100 or iFund_status='7')";
	else
	$sql.=" and (reqstatus<>'8' and reqstatus<>'0' and reqstatus<>100 or iFund_status='7')";
	
	if(isset($_POST['app']) and $_POST['app']!='')
	{
	if($_POST['app']=='arrear')
	$sql.=" and reqstatus ='5' and arrearstatus='1'";
	else
	$sql.=" and reqstatus ='".$_POST['app']."'";
	}
	
	
	

if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
 $sdate=$_REQUEST['sdate'];
$sdate=str_replace("/","-",$sdate);
$sdate=date("Y-m-d",strtotime($sdate));
$edate=$_REQUEST['edate'];
$edate=str_replace("/","-",$edate);
$edate=date("Y-m-d",strtotime($edate));

//echo $sdate2;

if($sdate!=$edate)
$sql.=" and entrydate between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y')";
else
$sql.=" and entrydate='".$sdate."'";
}
if(isset($_POST['atm']) && $_POST['atm']!='')
{
//echo $_POST['atm'];
$atm2=array();
$atm=str_replace("\n",",",$_POST['atm']);
$at=explode(",",$atm);

for($i=0;$i<count($at);$i++)
$atm2[]=trim($at[$i]);

$atm=str_replace(",","','",implode(",",$atm2));
$sql.=" and atmid in ('".$atm."')";
}
if(isset($_POST['reqid']) && $_POST['reqid']!='')
{
//echo $_POST['atm'];
$req2=array();
$req=str_replace("\n",",",$_POST['reqid']);
$at=explode(",",$req);

for($i=0;$i<count($at);$i++)
$req2[]=trim($at[$i]);

$req=str_replace(",","','",implode(",",$req2));
$sql.=" and req_no in ('".$req."')";
}
if($desig=="11" && $service=='3' && $dept=='4')
{
$qr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$qrro=mysqli_fetch_row($qr);
$sql.=" and reqby='".$qrro[0]."'";
}
else
{
if(isset($_POST['superv']) && $_POST['superv']!='')
	$sql.=" and supervisor LIKE '%".$_POST['superv']."%'";
}

/*if(isset($_POST['urgen']) && $_POST['urgen']!='All')
{
$urg=$_POST['urgen'];
$urg=str_replace(",","','",$urg);
$urg="'".$urg."'";
$sql.=" and priority in ($urg)";

}*/
if(isset($_POST['urg']) && $_POST['urg']!='All')
{
$urg=$_POST['urg'];
$urg=str_replace(",","','",$urg);
$urg="'".$urg."'";
$sql.=" and priority in ($urg)";

}
else if(isset($_POST['urgen']) && $_POST['urgen']!='All')
{
$urg=$_POST['urgen'];
$urg=str_replace(",","','",$urg);
$urg="'".$urg."'";
$sql.=" and priority in ($urg)";

}
if($desig!='6')
$sql.=" and reqby not in (select srno from login where designation='7')";

if(isset($_POST['actype']) && $_POST['actype']!='')
$sql.=" and supervisor in (select hname from fundaccounts where type='".$_POST['actype']."')";
//echo $sql;
$table=mysqli_query($con,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
// pagins
?>
 <div align="center">Total Records: <b><?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
 </select>&nbsp;&nbsp;&nbsp;<table><tr><td style="background:#FF7519"> Arrear Case</td><td style="background:#FFFFFF"> OLD Bills</td><td style="background:#36c9a4">Bymistake payment transferred</td></table>
 
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

$sql.="  order by req_no DESC LIMIT $Page_Start , $Per_Page";
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
if($desig=="1" && $service=='1' && $dept=='1')
{
?>
<form action="mast_approveebfund.php" method="post" onsubmit="return typealert();" >
<?php
}
else
{
?>
<form action="showpay.php" method="post" >
<?php
}
?>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th width="75">Sr NO</th>
<th width="75">Req no</th>
<th>Customer</th>
<th width="75">Requesting Person</th>
<th width="75">Request Date</th>
<th width="75">ATM ID</th>
<th width="75">Bank</th>
<th width="200px">Address</th>
<th width="75">Bill Date</th>
<th width="75">Due Date</th>
<th width="75">From</th>
<th width="75">To</th>
<th width="75">Days</th>
<th width="75">Units</th>
<th width="75">AVG AMT</th>
<th width="75">Request Amount</th>
<th width="75">Approved Amount</th>
<?php if($desig=='7'){ ?>
<th>Bill Paid Amt</th>
<?php } ?>
<th width="75">Priority</th>
<th width="75">Supervisor</th>
<th width="75">Remarks</th>
<th width="75">Last Approval Details</th>
<?php if($desig=='6'){ ?>
<th>Balance</th>
<th>Consumer No</th>
<th>Distributor</th>
<th>Weblink</th>
<th>Username</th>
<th>Password</th>
<?php } ?>
<th width="75">Approval</th>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
$appamt=0;
$reqamt=0;
while($row= mysqli_fetch_array($table))
{
//echo "dept=".$dept;
//$count=$count+1;
$qry1=mysqli_query($con,"select bank,atmsite_address from ".$row[12]."_sites where trackerid='".$row[14]."'");
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
$brro=mysqli_fetch_row($branch);
//echo "select contact_first from contacts where short_name='".$row[12]."'";
//$cl=mysqli_query($con,"select contact_first from contacts where short_name='".$row[12]."' and type='c'");
//$clr=mysqli_fetch_row($cl);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	
$appamt=$appamt+$row[16];
$reqamt=$reqamt+$row[4];
//echo "select * from ebfundtranscanc where reqid='".$row[0]."' and status=0";
$canc=mysqli_query($con,"select * from ebfundtranscanc where alert_id='".$row[0]."' and status=0");

$cust_name_qry = mysqli_query($con,"SELECT contact_first FROM contacts where short_name ='".$row[12]."'");
$cust_name_row=mysqli_fetch_array($cust_name_qry);
?><div class=article>
<div class=title><tr height="60px" <?php if($row[25]=='1' || $row[25]=='2'){ ?> style="background:#FF7519" <?php }else if(mysqli_num_rows($canc)>0){ ?> style="background:#36c9a4" <?php } if($row[6]<='2014-02-01'){  ?> style="background:#FFFFFF;color=#000000;border-color:black" <?php }else if(mysqli_num_rows($canc)>0){ ?> style="background:#36c9a4" <?php } ?>>
<td width="75" valign="top"><?php echo $count+1; ?></td>
<td width="75" valign="top"><?php echo $row[0]; ?></td>
<td width="75" valign="top"><?php echo $cust_name_row[0];  ?></td>
<td width="75" valign="top"><?php echo $brro[0]; //echo $row[6]; ?>
</td>
<td width="75" valign="top"><?php echo date("d/m/Y h:i:s",strtotime($row[18])); ?></td>

<td width="75" valign="top"><a href="javascript:void(0);" onclick="newwin('ebsitehist.php?atmid=<?php echo $row[1]; ?>&custid=<?php echo $row[12]; ?>&trackid=<?php  echo $row[14]; ?>','display',900,700)"><?php echo $row[1]; ?></a></td>
<td width="75" valign="top"><?php echo $qrrow[0]; ?></td>
<td width="50" style="overflow: hidden; width: 200px; word-break: break-all; font-size:small;" valign="top"><?php echo $qrrow[1]; ?></td>
<td width="75" valign="top"><?php if($row[2]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[2])); }else{ echo "NA"; } ?></td>
<td width="75" valign="top"><?php if($row[9]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[9])); }else{ echo "NA"; }// echo $row[9]; ?></td>
<td width="75" valign="top"><?php if($row[6]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[6])); }else{ echo "NA"; }//echo $row[6]; ?></td>
<td width="75" valign="top"><?php if($row[7]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[7])); }else{ echo "NA"; } //echo $row[7]; ?></td>
<td width="75" valign="top"><?php $nod=0; if($row[6]!='0000-00-00' and $row[7]!='0000-00-00'){echo $nod=floor((strtotime($row[7])-strtotime($row[6])) / 86400);}else{echo "NA";}  ?></td>
<td width="75" valign="top"><?php echo $row[3]; ?></td>
<td width="75" valign="top"><?php if($nod!=0)echo number_format ($row[4]*30.0/$nod,2); ?></td>
<!--<td width="75" valign="top"><?php echo $row[4];?></td>-->

<td width="75" valign="top">
<?php 
	if($row['iFund_status']==7)
	{
		$oldebreq_qry=mysqli_query($con,"SELECT amt  FROM `oldebreq` WHERE `reqid` = '".$row[0]."'");
		$oldebreq=mysqli_fetch_row($oldebreq_qry);
		echo $oldebreq[0];
	}
	else 
	{
		echo $row[4]; 
	}
?></td>
<td width="75" valign="top"><?php echo $row[16];?></td>
<?php if($desig=='7'){ $ebp=mysqli_query($con,"select paid_amount from ebpayment where Bill_No='".$row[0]."'");
$ebr=mysqli_fetch_row($ebp);
?>
<td width="75" valign="top"><?php if(mysqli_num_rows($ebp)>0){ echo $ebr[0];}else{ echo 0; }; ?></td>
<?php
}  ?>
<td width="75" valign="top"><?php echo $row[23]; ?></td>
<td width="75" valign="top"><?php echo $row[8]; ?></td>
<!-- <td width="75" valign="top"><?php echo date("d/m/Y h:i:s a",strtotime($row[10])); ?></td>
<td width="75" valign="top"><?php echo $row[1]; ?></td>-->
<td width="75" valign="top"><?php echo $row[19];
$scan=mysqli_query($con,"select * from ebillscancpy where reqid='".$row[0]."'");
if(mysqli_num_rows($scan))
{
$scanro=mysqli_fetch_row($scan);
?><br><a href="javascript:void(0);" onclick="newwin('../operations/scannedbill.php?reqid=<?php echo $scanro[2]; ?>','Scan Copy',900,400)">View Scanned Bill</a><?php
}
$email_attch_qry=mysqli_query($con,"select * from ebillemailcpy where reqid='".$row[0]."'");
if(mysqli_num_rows($email_attch_qry))
{
$email_attch=mysqli_fetch_array($email_attch_qry);
?><br><br><a href="../operations/ebemailcpy/<?php echo $email_attch['copy']; ?>">View Email</a><?php
}
 ?></td>
<td valign="top">
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
<a href="javascript:void(0);" onclick="newwin('viewefeed.php?id=<?php echo $row[0]; ?>','display','400','400')">Click to view all Feedbacks</a>
</td>

<?php
if($desig=="6")
{
$fund=mysqli_query($con,"select sum(amount) from onacctransfer where aid in (select aid from fundaccounts where hname='".$row[8]."')");
$fundro=mysqli_fetch_row($fund);
$fund2=mysqli_query($con,"select sum(approvedamt) from ebillfundrequests where supervisor ='".$row[8]."'");
$fundro2=mysqli_fetch_row($fund2);
$fund3=mysqli_query($con,"select sum(Paid_Amount) from ebpayment where Bill_No in(select req_no from ebillfundrequests where supervisor ='".$row[8]."')");
$fundro3=mysqli_fetch_row($fund3);
$bal=($fundro2[0]+$fundro[0])-$fundro3[0];

?>
<td>
<?php echo $bal; ?></td><?php
$WEB=mysqli_query($con,"select WEBLINK,USERNAME,PASSWORD from EBILL_WEBLINKS where TRACKER_ID='".$row[14]."'");
$WEBRO=mysqli_fetch_row($WEB);

$trid=mysqli_query($con,"select trackerid from ebillfundrequests where atmid='".$row[1]."' ");
$trida=mysqli_fetch_array($trid);

$tab=explode("_", $trida[0]);
//echo "select Consumer_no,Distributor from $tab[0]_ebill where atmtrackid='".$trida[0]."'";
$cons=mysqli_query($con,"select Consumer_no,Distributor from $tab[0]_ebill where atmtrackid='".$trida[0]."'");
$consa=mysqli_fetch_array($cons);
?>
<td><?php echo $consa[0];?></td>
<td><?php echo $consa[1];?></td>
<td>
<?php echo '<a href="'.$WEBRO[0].'" target="blank" >'.$WEBRO[0].'</a>'; ?></td>


<td>
<?php echo $WEBRO[1]; ?></td>
<td>
<?php echo $WEBRO[2]; ?></td><?php
}
?>
<td id="app<?php echo $count; ?>" valign="top"><input type="hidden" name="arrear<?php echo $count; ?>" id="arrear<?php echo $count; ?>" value=<?php echo $row[25]; ?>>
<?php 
if($row[15]=='8')
{
echo "Amount Paid: Rs. ".$row[16];
echo "<br> Cheque No : ".$row[17];
}
//echo "desig=".$desig." ".$service." ".$dept." ".$row[8];
/*
if($desig=="7" && $service=='1' && $dept=='2' && $row[15]=='4')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none"><input type="hidden" name="arrear<?php echo $count; ?>" id="arrear<?php echo $count; ?>" value=<?php echo $row[25]; ?>>
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','5')" value="Go" style="background:#FFFF99"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}

if($desig=="2" && $service=='1' && $dept=='1' && $row[15]=='5' && $row[25]=='1')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[4]; ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="arrearapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','2','Sorry. This is Arrear Case. Your Feedback is required')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}
if($desig=="1" && $service=='1' && $dept=='1' && $row[15]=='6')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[16]; ?>">

<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','7')" value="Go" style="background:#FFFF99">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}
*/
$status=0;
if($desig=="7" && $service=='1' && $dept=='2' && $row[15]=='4')
	$status=5;
/*if($desig=="6" && $service=='1' && $dept=='5' && $row[15]=='5' && $row[25]!='1')
	$status=6;
if($desig=="1" && $service=='1' && $dept=='1' && $row[15]=='6')
	$status=7;*/
if($status!=0)
{ if($row[8]=='ONLINE')$status=7;
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
    <td>Supervisor :</td>
    <td><?php echo $row[8]; ?></td>
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
    <td><?php if($nod!=0){ echo number_format ($row[4]*30.0/$nod,2); } ?></td>
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
if($desig=="6" && $service=='1' && $dept=='5' && $row[15]=='5' && $row[25]!='1')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php if($row[16]==0){ echo $row[4];}else{ echo $row[16]; } ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','6')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}
if($desig=="2" && $service=='1' && $dept=='1' && $row[15]=='5' && $row[25]=='1')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[4]; ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="arrearapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','2','Sorry. This is Arrear Case. Your Feedback is required')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}

if($desig=="1" && $service=='1' && $dept=='1' && $row[15]=='6')
{
?>
<input type="checkbox" name="mastapp[]" id="mastapp<?php echo $count; ?>" style="width: 50px;height: 50px;" onchange="chckmastapp(this.id);" value="<?php echo $row[0] ?>"/>
</div>
<?php
}
if($desig=="6" && $service=='1' && $dept=='5' && ($row[15]=='7' || $row[34]=='7'))
{
$inactive_acc=0;
//echo "select * from fundaccounts where hname like '".$row[8]."'";
$accs_qry=mysqli_query($con,"select * from fundaccounts where hname like '".$row[8]."'");
if(mysqli_num_rows($accs_qry)>0)
{
	$accs_row=mysqli_fetch_array($accs_qry);
	//echo $accs_row['status'];
	if($accs_row['status']=='1')
	$inactive_acc=1;
}
if($inactive_acc)
{
	echo "Inactived User";
}
else
{
?>
<br><br><input type="checkbox" name="apps[]" checked id="apps<?php echo $count;  ?>" value="<?php echo $row[0]; ?>" onclick="addamt('<?php echo $row[16]; ?>',this.id);" style="background:#FFFF99"  />
<?php
}
?>
<!-- <?php if(isset($_POST['actype']) && $_POST['actype']!='direct'){ echo 'checked=checked'; } ?>  -->
</td><td><input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">

<textarea id="rem<?php echo $count; ?>"></textarea>
<?php if($row[8]=="ONLINE")
{
?> 
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[4]; ?>" >

<select name="sv" id="sv<?php echo $count; ?>"><option value="-1">Select</option>
			   <?php
			  // $sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");
			  $sup=mysqli_query($con,"select distinct(hname) from fundaccounts where status=0 or status='2' or status=1 order by hname ASC");
				 while($supro=mysqli_fetch_array($sup))
				{ ?>
				   <option value="<?php echo $supro[0]; ?>" ><?php echo $supro[0]; ?></option>
			   <?php } ?>  
			    </select>
			  <?php }?>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','7')" value="Go" style="background:#FFFF99">
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

&nbsp;&nbsp;&nbsp;&nbsp;
</div></td>
<?php
}

if($desig=="6" && $service=='1' && $dept=='5' && $row[15]=='8' && mysqli_num_rows($canc)==0)
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Cancel" style="background:#FFFF99" /><br><br><br>
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="hidden" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[4]; ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="cancpay('<?php echo $count; ?>','<?php echo $row[0] ?>','9')" value="Cancel This Payment" style="background:#FFFF99">

<?php
}



$count=$count+1;

}
?></td></tr>
<tr><td><b></b></td><td colspan="2" align="right"><b>Total Requested Amt</b></td><td colspan="2"><h2><?php echo number_format($reqamt,2); ?></h2></td><td colspan="2" align="right"><b>Total Approved Amt</b></td><td colspan="2"><h2><?php echo number_format($appamt,2); ?></h2></td>
<td colspan="3"><?php if($desig==6){ ?><b>Selected Total :</b><input type="text" name=seltot id=seltot value="0" readonly><?php } ?></td>
</tr>
</div></div>
<?php if($desig=='6'){ ?><tr><td colspan=15 align='center' ><input type="hidden" value="<?php if(isset($_POST['actype'])){ echo $_POST['actype']; } ?>" name="acctype"  /><input type="submit" value="Payments" /></td></tr><?php } ?>
<?php if($desig=='1' && $service=='1' && $dept=='1'){ ?>
<tr>
	<td colspan=15 align='center' >
		<input type="text" required="required" placeholder="Remarks" name="remarks"  />
		<input  id="chcktot" value="0" />
		<input type="radio" name="stat" id="app_stat" value="7" checked />Approve<input type="radio" name="stat" id="rej_stat" value="0" />Reject
		<input type="submit" value="Submit" id="mast_sub" disabled=true />
	</td>
</tr>
<?php } ?>
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
?>