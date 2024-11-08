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
	
	$sql="Select * from oldebreq where 1";
	
	if(isset($_POST['pstat']) && $_POST['pstat']!='')
	$sql.=" and status='".$_POST['pstat']."'";
	else
	$sql.=" and status<>'8' and status<>'0'";
	
	if(isset($_POST['app']) and $_POST['app']!='')
	$sql.=" and status ='".$_POST['app']."'";
	
	
	

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
$sql.=" and entrydt between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']." 11:59:59','%d/%m/%Y %H:%i:%s')";
else
$sql.=" and entrydt='".$sdate."'";
}

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
 </select>
 
 </div>
 <?php
// pagins
//echo $_POST['perpg'];
if((isset($_POST['cid']) && $_POST['cid']!='') || (isset($_POST['atm']) && $_POST['atm']!=''))
	$Per_Page =$Num_Rows;
else
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

$sql.="  order by reqid ASC LIMIT $Page_Start , $Per_Page";
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


<th width="75">Sr NO</th>
<th>Customer</th>
<th width="75">Requesting Person</th>
<th width="75">ATM ID</th>
<th width="75">Bank</th>
<th width="200px">Address</th>
<th width="75">Bill Date</th>
<th width="75">Due Date</th>
<th width="75">From</th>
<th width="75">To</th>
<th width="75">Units</th>
<th width="75">Amount</th>
<?php if($desig=='7'){ ?>
<th>Bill Paid Amt</th>
<?php } ?>
<th width="75">Priority</th>
<th width="75">Supervisor</th>
<th width="75">Remarks</th>
<th width="75">Last Approval Details</th>

<th width="75">Approval</th>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
$appamt=0;
$reqamt=0;
while($row2= mysqli_fetch_row($table))
{

$sql2="Select * from ebillfundrequests where req_no='".$row2[1]."'";
	if(isset($_POST['cid']) && $_POST['cid']!='')
	$sql2.=" and cust_id='".$_POST['cid']."'";
	
if(isset($_POST['atm']) && $_POST['atm']!='')
$sql2.=" and atmid like '%".$_POST['atm']."%'";
//echo $sql2;

	$tbl=mysqli_query($con,$sql2);

	if(mysqli_num_rows($tbl)>0){
$row=mysqli_fetch_row($tbl);

$qry1=mysqli_query($con,"select bank,atmsite_address from ".$row[12]."_sites where trackerid='".$row[14]."'");
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
$brro=mysqli_fetch_row($branch);

$appamt=$appamt+$row[16];
$reqamt=$reqamt+$row[4];
//echo "select * from ebfundtranscanc where reqid='".$row[0]."' and status=0";
$canc=mysqli_query($con,"select * from ebfundtranscanc where alert_id='".$row[0]."' and status=0");

?><div class=article>
<div class=title><tr height="60px" <?php if($row[25]=='1'){ ?> style="background:#FF7519" <?php }else if(mysqli_num_rows($canc)>0){ ?> style="background:#36c9a4" <?php } ?>>
<td width="75" valign="top"><?php echo $count+1; ?></td>
<td width="75" valign="top"><?php echo $row[12];  ?></td>
<td width="75" valign="top"><?php echo $row2[7];//$brro[0]; //echo $row[6]; ?></td>

<td width="75" valign="top"><a href="#" onclick="newwin('getebhistory.php?atmid=<?php echo $row[1]; ?>&custid=<?php echo $row[12]; ?>&trackid=<?php  echo $row[14]; ?>','display')"><?php echo $row[1]; ?></a></td>
<td width="75" valign="top"><?php echo $qrrow[0]; ?></td>
<td width="50" style="overflow: hidden; width: 200px; word-break: break-all; font-size:small;" valign="top"><?php echo $qrrow[1]; ?></td>
<td width="75" valign="top"><?php if($row[2]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[2])); }else{ echo "NA"; } ?></td>
<td width="75" valign="top"><?php if($row[9]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[9])); }else{ echo "NA"; }// echo $row[9]; ?></td>
<td width="75" valign="top"><?php if($row[6]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[6])); }else{ echo "NA"; }//echo $row[6]; ?></td>
<td width="75" valign="top"><?php if($row[7]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[7])); }else{ echo "NA"; } //echo $row[7]; ?></td>
<td width="75" valign="top"><?php echo $row[3]; ?></td>
<td width="75" valign="top"><?php echo $row2[2]." <br><br><br>Approved Amt:".$row[16]; ?></td>
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
<td width="75" valign="top"><?php echo $row2[4]; ?></td>
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
<a href="#" onclick="newwin('viewefeed.php?id=<?php echo $row[0]; ?>','display')">Click to view all Feedbacks</a>
</td>


<td id="app<?php echo $count; ?>" valign="top"><input type="hidden" name="arrear<?php echo $count; ?>" id="arrear<?php echo $count; ?>" value=<?php echo $row[25]; ?>>
<?php 
if($row[15]=='8')
echo "Amount Paid: Rs. ".$row[16];
//echo "desig=".$desig." ".$service." ".$dept." ".$row2[5];
/*if($desig=="7" && $service=='1' && $dept=='2' && $row[15]=='4')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none"><input type="hidden" name="arrear<?php echo $count; ?>" id="arrear<?php echo $count; ?>" value=<?php echo $row[25]; ?>>
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','5')" value="Go" style="background:#FFFF99"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}*/
if($desig=="6" && $service=='1' && $dept=='5' && $row2[5]=='5')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo round($row2[2]); ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','6')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}
/*if($desig=="2" && $service=='1' && $dept=='1' && $row[15]=='5' && $row[25]=='1')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[4]; ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="arrearapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','2','Sorry. This is Arrear Case. Your Feedback is required')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}*/
if($desig=="1" && $service=='1' && $dept=='1' && $row2[5]=='6')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo round($row[16]); ?>">

<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','7')" value="Go" style="background:#FFFF99">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

</div>
<?php
}
/*if($desig=="6" && $service=='1' && $dept=='5' && $row[15]=='7')
{
?>
<input type="checkbox" name="apps[]" id="apps<?php echo $count;  ?>" value="<?php echo $row[0]; ?>" onclick="addamt('<?php echo $row[16]; ?>',this.id);" style="background:#FFFF99" />
<!--<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[16]; ?>" readonly><br>
<input type="text" name="chkno<?php echo $count; ?>" id="chkno<?php echo $count; ?>" placeholder="Cheque No"><br>
<textarea id="rem<?php echo $count; ?>"></textarea><br>
<input type="button" onClick="financepayment('<?php echo $count; ?>','<?php echo $row[0] ?>','8')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
-->
<?php
}*/
/*if($desig=="6" && $service=='1' && $dept=='5' && $row2[5]=='8' && mysqli_num_rows($canc)==0)
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Cancel" style="background:#FFFF99" /><br><br><br>
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="hidden" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[4]; ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="cancpay('<?php echo $count; ?>','<?php echo $row[0] ?>','9')" value="Cancel This Payment" style="background:#FFFF99">

<?php
}*/
echo "<br> Cheque No : ".$row[17];


$count=$count+1;
}
}
?></td></tr>
<tr><td><b></b></td><td colspan="2" align="right"><b>Total Requested Amt</b></td><td colspan="2"><h2><?php echo number_format($reqamt,2); ?></h2></td><td colspan="2" align="right"><b>Total Approved Amt</b></td><td colspan="2"><h2><?php echo number_format($appamt,2); ?></h2></td>
<td colspan="3"><?php if($desig==6){ ?><b>Selected Total :</b><input type="text" name=seltot id=seltot value="0" readonly><?php } ?></td>
</tr>
</div></div>
<?php if($desig=='6'){ ?><tr><td colspan=15 align='center' ><input type="submit" value="Payments" /></td></tr><?php } ?>
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