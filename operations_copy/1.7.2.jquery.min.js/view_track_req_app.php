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
$sql.=" and entrydate between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y') ";
//if(isset($_POST['pstat']) && $_POST['pstat']=='8')
//$sql.=" and req_no in (select reqid from ebfundtransfers where pdate between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y') order by pdate DESC,chqno ASC) ";
}
else
{
$sql.=" and entrydate like '".$_POST['sdate']."% ";
//if(isset($_POST['pstat']) && $_POST['pstat']=='8')
//$sql.=" and req_no in (select reqid from ebfundtransfers where pdate =STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y') order by pdate DESC,chqno ASC) ";
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
<!--<th width="75">Consumer_No</th><th width="75">Distributor</th><th width="75">landlord</th><th width="75">meter_no</th>-->
<th width="75">Remarks</th>
<th width="75">Last Approval Details</th>

<!--<th width="75">Approval</th></tr>-->
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
<!--
<td width="75"><?php echo $consro[0]; ?></td>
<td width="75"><?php echo $consro[1]; ?></td>
<td width="75"><?php echo $consro[2]; ?></td>
<td width="75"><?php echo $consro[3]; ?></td>
-->
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
/*
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
}*/
 ?>

</td>
<td>
<table border="1" >
<tr><th>Sr No</th><th>Designation</th><th>From</th><th>Time</th><th>Remarks</th></tr>
<?php
if($row['reqstatus']<8 && $row['reqstatus']!=0)
{
$now_reqstatus_qry=mysqli_query($con,"SELECT description  FROM `designation` WHERE `statuslevel` = '".($row['reqstatus']+1)."'");
$now_reqstatus=mysqli_fetch_array($now_reqstatus_qry);
?>
<tr><td colspan="5">Now In Bucket of <?php echo $now_reqstatus['description']; ?></td></tr>
<?php
}
?>
<?php
$z=0;
$conf=mysqli_query($con,"select appid,appby,apptime,level,remarks from ebillfundapp where reqid='".$row[0]."' order by appid DESC");
while($row4=mysqli_fetch_array($conf))
{
$login_qry=mysqli_query($con,"SELECT *  FROM `login` WHERE `username` LIKE '".($row4['appby'])."'");
$login_row=mysqli_fetch_array($login_qry);
$desig_qry=mysqli_query($con,"SELECT name  FROM `designation_detail` WHERE `designation` = '".$login_row['designation']."' AND `serviceauth` = '".$login_row['serviceauth']."' AND `deptid` = '".$login_row['deptid']."'");
$desig_row=mysqli_fetch_array($desig_qry);
?>
<tr><td><?php echo $z=$z+1; ?></td><td><?php echo $desig_row['name']; ?></td><td><?php echo $row4[1]; ?></td><td><?php echo $row4[2]; ?></td><td><?php echo $row4[4]; ?></td></tr>
<?php
}
?>
</table>
</td>
</tr>
<?php
$count=$count+1;
}
}
?></table>
<br/><br/>
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