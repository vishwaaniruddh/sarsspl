<?php
session_start();
//echo $_SESSION['user'];
$desig= $_POST['desig'];
$service=$_POST['service'];
 $dept=$_POST['dept'];

include('config.php');

$cid="";

$sdate="";
$edate="";

	$strPage = $_REQUEST['Page'];
	
	$sql="Select q.quotid,q.quotby,q.cust_id,q.trackerid,q.description,q.dept,l.username,q.entrydt,q.status,q.approvalform,q.sitetype,q.supervisor,q.reqamt,q.approvedamt,q.totalcost,q.clientappdate,q.mailperson,q.type,q.chqno from quotation q,login l where l.srno=q.quotby";
if(isset($_POST['cid']) && $_POST['cid']!='-1' && $_POST['cid']!='')
 $sql.=" and q.cust_id='".$_POST['cid']."'";
	if(isset($_POST['pstat']) && $_POST['pstat']!='')
	$sql.=" and q.status='".$_POST['pstat']."'";
	else
	$sql.=" and q.status<>'8'";
if(isset($_POST['app']) && $_POST['app']!='')
	$sql.=" and q.status='".$_POST['app']."'";
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
$sql.=" and q.entrydt between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y')";
else
$sql.=" and q.entrydt='".$sdate."'";
}

if($desig=="11" && $service=='3' && $dept=='4')
{
$qr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$qrro=mysqli_fetch_row($qr);
//$sql.=" and requestby='".$qrro[0]."'";
$sql.=" and q.quotby='".$qrro[0]."'";
}

//echo $sql;
$table=mysqli_query($con,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
// pagins
?>
 <div align="center"><b>Total Number of records: <?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;
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
$sql.=" order by q.quotid DESC LIMIT $Page_Start , $Per_Page";
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
<form action="rnm_mast_approveebfund.php" method="post" onsubmit="return typealert();" >
<?php
}
else
{
?>
<form action="showrnmpay.php" method="post" >
<?php
}
?>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px; margin-top:50px;;"> 


<th width="75">Sr NO</th>
<th width="75">Client ID</th>
<th width="75">Requesting Person</th>
<th width="75">Entered By</th>
<th width="75">Department</th>
<th width="75">ATM ID</th>
<th width="250">Address</th>
<th width="75">Bank</th>
<th width="175">Materials</th>
<th width="175">Quot Type</th>
<th width="75">Date</th>
<th width="75">Client Approval Amount</th>
<th width="75">Client Approval Date</th>
<th width="75">Client name</th>
<th width="75">Fund Required</th>
<th width="75">Supervisor</th>
<th width="75">Last Approval Details</th>

<th width="75">Approval</th>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
while($row= mysqli_fetch_row($table))
{
$appamt=$appamt+$row[13];
$reqamt=$reqamt+$row[12];
$qry1=mysqli_query($con,"select short_name,contact_first from contacts where short_name='$row[2]'");
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[1]."'");
$brro=mysqli_fetch_row($branch);
$deptde=mysqli_query($con,"select `desc` from department where deptid='".$row[5]."'");
$dtro=mysqli_fetch_row($deptde);

$str='';	
if($row[10]=='rnmsites')
$str=" select atmsite_address,bank,atm_id1 from rnmsites where id='".$row[3]."'";
else
$str=" select atmsite_address,bank,atm_id1 from ".$row[2]."_sites where trackerid='".$row[3]."'";
//echo $str;
if(isset($_POST['atmid']) && $_POST['atmid']!='')
$str.=" and (atm_id1 like '%".$_POST['atmid']."%' or atm_id2 like '%".$_POST['atmid']."%' or atm_id3 like '%".$_POST['atmid']."%')";
$site=mysqli_query($con,$str);
if(mysqli_num_rows($site)>0){
$sitero=mysqli_fetch_row($site);
?>
<div class=article>
<div class=title><tr>
<td width="75" valign="top"><?php echo $count+1; ?></td>
<td width="75" valign="top"><?php echo $row[2]; //echo $row[6]; ?></td>
<td width="75" valign="top"><?php echo $row[11]; //echo $row[6]; ?></td>
<td width="75" valign="top"><?php echo $brro[0]; //echo $row[6]; ?></td>
<td width="75" valign="top"><?php echo $dtro[0]; ?></td>
<td width="75" valign="top"><a href="javascript:void(0);" onclick="newwin('oldrnmhist.php?atmid=<?php echo $sitero[2]; ?>&custid=<?php echo $row[2]; ?>&trackid=<?php  echo $row[3]; ?>','display',400,700)"><?php echo $sitero[2]; //echo $row[6]; ?></a></td>
<td width="250" valign="top"><?php echo $sitero[0]; ?></td>
<td width="75" valign="top"><?php echo $sitero[1]; ?></td>

<td width="175" valign="top">
<?php
$stat=0;
$tot=0;
$num=0;
$asst=array();

//echo "select * from quot_details where quotid='".$row[0]."'  and status='0' order by component,material ASC";
$det=mysqli_query($con,"select * from quot_details where quotid='".$row[0]."'  and status='0' order by component,material ASC");
while($detro=mysqli_fetch_array($det))
{
//echo "select * from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' and incquot=1";
$ck=mysqli_query($con,"select * from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' and incquot=1");
if(mysqli_num_rows($ck)>0){
$stat=$stat+1;

  if(in_array($detro[7],$asst)){  $num=$num+1;
 echo $num.". ".$detro[2]." ".$detro[12]."(".$detro[3]." ".$detro[4]." * ".$detro[8].")<br>";
 }else{ 
$num=$num+1;
echo "<b><u>".$detro[7]."</u></b><br>".$num.". ".$detro[2]." ".$detro[12]."(".$detro[3]." ".$detro[4]." * ".$detro[8].")<br>";$asst[]=$detro[7]; } 
}
}
?>
</td>
<td width="75" valign="top"><?php echo $row[17]; ?>
</td>
<td width="75" valign="top"><?php echo date("d/m/Y h:i:s a",strtotime($row[7])); ?></td>
<td width="75" valign="top"><?php echo number_format($row[14],2); ?></td>
<td width="75" valign="top"><?php if($row[15]!="0000-00-00"){ echo date("d/m/Y",strtotime($row[15])); }else{ echo "Approval Pending"; } ?></td>
<td width="75" valign="top"><?php echo $row[16]; ?></td>
<td width="75" valign="top"><?php echo $row[12]."<br><br>Appoved Amount: ".$row[13]; ?></td>
<td width="75" valign="top"><?php echo $row[11]; ?>


</td>



<td valign="top">
<?php

$lst=mysqli_query($con,"select appid,appby,apptime,level,remarks from quotapproval where quotid='".$row[0]."' order by appid DESC limit 1");
while($lstro=mysqli_fetch_array($lst))
{
$rem=explode("***###",$lstro[4]);
if($lstro[3]=='0')
$stat="Rejected";
else
$stat="Approved";
echo $lstro[1]."<br> ".date("d/m/Y h:i:s a",strtotime($lstro[2]))." <br>".$stat."<br> ".$rem[0];
}
?><br /><a href="#" onClick="newwin('../operations/viewquotedet.php?quotid=<?php echo $row[0]; ?>','display')">View Remarks</a>
<br /><br>
<a href="#" onClick="newwin('../operations/viewquoteformat.php?quotid=<?php echo $row[0]; ?>','display')">Click to view Quotation</a>
</td>


<td id="app<?php echo $count; ?>" valign="top">
<?php 

if($row[8]=='0' && ($desig=='7' || $desig=='6'))
{
$cancap=mysqli_query($con,"select * from quotapproval where quotid='".$row[0]."' and appby='".$_SESSION['user']."' and level=0");
if(mysqli_num_rows($cancap)>0){
?>
<div id="showrem<?php echo $count; ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','<?php if($desig=='6'){ echo '5'; }elseif($desig=='7'){ echo '6'; } ?>')" value="Reapprove" style="background:#FFFF99">

</div>
<?php
}
}


if($row[8]=='8')
echo "Amount Paid ".$row[13]."<br>cheque no: ".$row[18];
//echo "desig=".$desig." ".$service." ".$dept." ".$row[8];
if($desig=="7" && $service=='1' && $dept=='3' && $row[8]=='4')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','5')" value="Go" style="background:#FFFF99">
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>
<?php
}
if($desig=="7" && $service=='1' && $dept=='2' && $row[8]=='4')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','5')" value="Go" style="background:#FFFF99">
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>
<?php
}
if($desig=="6" && $service==('1' or '2')  && $dept=='5' && $row[8]=='4')
{
//echo "hi";
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[12]; ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','6')" value="Go" style="background:#FFFF99">
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>
<?php
}
/*
if($desig=="1" && $service=='1' && $dept=='1' && $row[8]=='6')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[13]; ?>">

<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','7')" value="Go" style="background:#FFFF99">
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>
<?php
}
*/
if($desig=="1" && $service=='1' && $dept=='1' && $row[8]=='6')
{
?>
<input type="checkbox" name="mastapp[]" id="mastapp<?php echo $count; ?>" style="width: 50px;height: 50px;" onchange="chckmastapp(this.id);" value="<?php echo $row[0] ?>"/>
<?php
}
if($desig=="6" && $service==('1' or '2') && $dept=='5' && $row[8]=='7')
{
?>
<input type="checkbox" name="apps[]" id="apps<?php echo $count;  ?>" value="<?php echo $row[0]; ?>" onclick="addamt('<?php echo $row[13]; ?>',this.id);" style="background:#FFFF99" />
<!--<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[12]; ?>" readonly><br>
<input type="text" name="chkno<?php echo $count; ?>" id="chkno<?php echo $count; ?>" placeholder="Cheque No"><br>
<textarea id="rem<?php echo $count; ?>"></textarea><br>
<input type="button" onClick="financepayment('<?php echo $count; ?>','<?php echo $row[0] ?>','8')" value="Go" style="background:#FFFF99">

</div>-->
<!--<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">--><?php
}
$count=$count+1;
}
}
?></td></tr>
<tr><td><b></b></td><td colspan="2" align="right"><b>Total Requested Amt</b></td><td colspan="2"><h2><?php echo number_format($reqamt,2); ?></h2></td><td colspan="2" align="right"><b>Total Approved Amt</b></td><td colspan="2"><h2><?php echo number_format($appamt,2); ?></h2></td>
<td colspan="3"><?php if($desig==6){ ?><b>Selected Total :</b><input type="text" name=seltot id=seltot value="0" readonly><?php } ?></td>
</tr>
<?php if($desig=='6'){ ?><tr><td colspan=15 align='center' ><input type="submit" value="Payments" /></td></tr><?php } ?>

<?php if($desig=='1' && $service=='1' && $dept=='1'){ ?>
<tr>
	<td colspan=15 align='center' >
		<input type="text" required="required" placeholder="Remarks" name="remarks"  />
		<input type="hidden" id="chcktot" value="0" />
		<input type="radio" name="stat" id="app_stat" value="7" checked />Approve<input type="radio" name="stat" id="rej_stat" value="0" />Reject
		<input type="submit" value="Submit" id="mast_sub" disabled=true />
	</td>
</tr>
<?php } ?>

</div></div></table></form>
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