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

	$sql="Select q.quotid,q.quotby,q.cust_id,q.trackerid,q.description,q.dept,q.entrydt,q.status,q.approvalform,q.approvedamt,q.totalcost,q.sitetype from quotation q where q.cust_id='".$_POST['cid']."' and q.type='R&M'";
	
	/*if(isset($_POST['pstat']) && $_POST['pstat']!='')
	$sql.=" and q.status='".$_POST['pstat']."'";
	else
	$sql.=" and q.status='8'";*/
	$sql.=" and q.bill='n'";

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



//echo $sql;
$table=mysqli_query($con,$sql);

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
$sql.=" order by q.status ASC LIMIT $Page_Start , $Per_Page";
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
<form name="frm" method="post" action="guj.php">
<!--<div align="LEFT">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELECT COMPANY :<select name="comp" id="comp" ><option value="-1">select</option>
<?php $res=mysqli_query($con,"select * from company_details");
      while($row=mysqli_fetch_array($res))
      { ?>
       <option value='<?php echo $row[0]; ?>' ><?php echo $row[1]; ?></option>
     <?php } ?></select>
</div>-->
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:50px; "> 

<tr>
<th width="75">Sr NO</th>
<th width="75">Client</th>
<th width="75">State</th>
<th width="75">Atm ID</th>
<th width="75">Bank</th>
<th width="250">Address</th>
<th width="75">Requesting Person</th>
<th width="75">Department</th>

<th width="75">Memo</th>
<th width="75">Date</th>
<!--<th width="75">Amount</th>-->
<th width="75">Amount</th>

<th width="75">Billing</th></tr>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;

while($row= mysqli_fetch_row($table))
{
$qid=$row[0];
//echo "dept=".$dept;
//$count=$count+1;

//echo "select short_name,contact_first from contacts where short_name='$row[2]'";
$qry1=mysqli_query($con,"select short_name,contact_first from contacts where short_name='$row[2]'");
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[1]."'");
$brro=mysqli_fetch_row($branch);
$deptde=mysqli_query($con,"select `desc` from department where deptid='".$row[5]."'");
$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	
$str='';
//echo $row[11];
if($row[11]=='rnmsites')
$str=" select atmsite_address,bank,atm_id1,state from rnmsites where id='".$row[3]."'";
else
$str=" select atmsite_address,bank,atm_id1,state from ".$row[2]."_sites where trackerid='".$row[3]."'";
if(isset($_POST['bank']) && $_POST['bank']!='')
$str.=" and bank like '%".$_POST['bank']."%'";

if(isset($_POST['state']) && $_POST['state']!='')
$str.=" and state like '%".$_POST['state']."%'";
//echo $str;
$site=mysqli_query($con,$str);
if(mysqli_num_rows($site)>0){
$sitero=mysqli_fetch_row($site);
?><tr>
<td width="75"><?php echo $count+1; ?></td>
<td width="75"><?php echo $qrrow[1]; ?></td>
<td width="75"><?php echo $sitero[3]; ?></td>
<td width="75"><?php echo $sitero[2]; ?></td>
<td width="75"><?php echo $sitero[1]; ?></td>
<td width="250" style="overflow:hidden"><?php echo $sitero[0]; ?></td>
<td width="75"><?php echo $brro[0];  ?></td>
<td width="75"><?php echo $dtro[0]; //echo $row[6]; ?></td>
<td width="75"><?php echo $row[4]; //echo $row[6]; ?></td>
<td width="75"><?php echo $row[6]; //echo $row[6]; ?></td>
<td width="75"><?php echo $row[10]; //echo $row[6]; ?></td>


<td id="app<?php echo $count; ?>">
<a href="#" onClick="newwin('../operations/viewquoteformat.php?quotid=<?php echo $row[0]; ?>','display')">Click to view Quotation</a>
<input type="checkbox" name="quotid[]" value="<?php echo $row[0];  ?>">&nbsp;<?php echo $row[0];  ?>
</td></tr>
<?php
//echo "desig=".$desig." ".$service." ".$dept." ".$row[7];

$count=$count+1;
}
}
?>
<tr><td colspan="7">
<input type="hidden" name="stdt" id="stdt" value="<?php if($_POST['sdate']!=''){ echo $_POST['sdate']; } ?>" readonly>
<input type="hidden" name="enddt" id="enddt" value="<?php if($_POST['edate']!=''){ echo $_POST['edate']; } ?>" readonly>
<input type="hidden" name="state" id="state" value="<?php echo $_POST['state']; ?>" readonly>
<input type="hidden" name="bank" id="bank" value="<?php echo $_POST['bank']; ?>" readonly>
<input type="hidden" name="custid" id="custid" value="<?php echo $_POST['cid']; ?>" readonly><input type="submit" name="cmdsub" value="Generate RMN Bill"></td></tr>
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
?></font></div>