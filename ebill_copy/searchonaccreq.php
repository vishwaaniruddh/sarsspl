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
	
	$sql="Select * from onacctransfer where 1";
	
	if(isset($_POST['pstat']) && $_POST['pstat']!='')
	$sql.=" and reqstatus='".$_POST['pstat']."'";
	else
	$sql.=" and reqstatus<>'8'";
	/*if(isset($_POST['atm']) && $_POST['atm']!='')
	$sql.=" and atmid LIKE'%".$_POST['atm']."%'";*/

if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
 $sdate=$_REQUEST['sdate'];
$sdate=str_replace("/","-",$sdate);
$sdate=date("Y-m-d",strtotime($sdate));
$edate=$_REQUEST['edate'];
$edate=str_replace("/","-",$edate);
$edate=date("Y-m-d",strtotime($edate));

//echo $sdate2;
if($_POST['pstat']=='8' || $_POST['pstat']=='0'){
if($sdate!=$edate)
$sql.=" and entrydt between '".$sdate."' and '".$edate."' ";
else
$sql.=" and entrydt like '".$sdate."%'";
}
else
{
if($sdate!=$edate)
$sql.=" and entrydt between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y') ";
else
$sql.=" and entrydate like '".$sdate."%'";
}
}

if($desig=="11" && $service=='3' && $dept=='4')
{
$qr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$qrro=mysqli_fetch_row($qr);
$sql.=" and reqby='".$qrro[0]."'";
}


echo $sql ; 
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

$sql.=" order by reqid DESC LIMIT $Page_Start , $Per_Page";
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
<form action="onacc_showpay.php" method="post" >
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th width="75">Sr NO</th>
<!--<th width="75">Requesting Person</th>-->
<th width="75">SuperVisor</th>
<th width="75">Account Number</th>
<th width="75">Bank</th>
<th width="75px">Branch</th>
<th width="75">Request Date</th>
<th width="75">Amount</th>
<th width="75">Approved Amount</th>
<th width="75">Approval</th>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
while($row= mysqli_fetch_row($table))
{
//echo "dept=".$dept;
//$count=$count+1;
$qry1=mysqli_query($con,"select hname,accno,bank,branch from fundaccounts where aid='".$row[1]."'");
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[4]."'");
$brro=mysqli_fetch_row($branch);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	

?><div class=article>
<div class=title><tr>
<td width="75"><?php echo $count+1; ?></td>
<td width="75"><?php echo $qrrow[0]; ?></td>
<td width="75"><?php echo $qrrow[1]; ?></td>
<td width="75"><?php if($_POST['pstat']=='8'){ echo $qrrow[7]; }else{  echo $qrrow[2]; } ?></td>
<td width="75"><?php echo $qrrow[3]; ?></td>
<td width="75"><?php echo date('d/m/Y',strtotime($row[6])); ?></td>
<td width="75"><?php echo $row[2]; ?></td>
<td width="75"><?php echo $row[7]; ?></td>
<td width="75">
<?php
echo $row[5];
?><br /><br />
<a href="#" onclick="newwin('viewefeed.php?id=<?php echo $row[0]; ?>&type=onaccount','display',600,600)">Click to view all Feedbacks</a>
</td>


<td id="app<?php echo $count; ?>">
<?php 
if($row[3]=='8')
echo "Amount Paid: Rs. ".$row[7];
//echo "desig=".$desig." ".$service." ".$dept." ".$row[8];
if($desig=="7" && $service=='1' && $dept=='2' && $row[3]=='4')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','5')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">

<?php
}
if($desig=="6" && $service=='1' && $dept=='5' && $row[3]=='5')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[2]; ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','6')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
<?php
}
if($desig=="1" && $service=='1' && $dept=='1' && $row[3]=='6')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[2]; ?>">

<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','7')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99"><?php
}
if($desig=="6" && $service=='1' && $dept=='5' && $row[3]=='7')
{
?>
<!--<input type="checkbox" name="apps" value="<?php echo $row[0]; ?>" style="background:#FFFF99" />-->
<input type="checkbox" name="apps[]" id="apps<?php echo $count;  ?>" value="<?php echo $row[0]; ?>" onclick="addamt('<?php echo $row[2]; ?>',this.id);" style="background:#FFFF99"  />
<!--<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[2]; ?>" readonly><br>
<input type="text" name="chkno<?php echo $count; ?>" id="chkno<?php echo $count; ?>" placeholder="Cheque No"><br>
<textarea id="rem<?php echo $count; ?>"></textarea><br>
<input type="button" onClick="financepayment('<?php echo $count; ?>','<?php echo $row[0] ?>','8')" value="Go" style="background:#FFFF99">
</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">-->

<?php
}
if($row[8]!=''){
echo "<br> Cheque No : ".$row[8];
$ebonacctransfers_qry=mysqli_query($con,"SELECT pdate  FROM `ebonacctransfers` WHERE `reqid` = '".$row[0]."'");
$ebonacctransfers=mysqli_fetch_array($ebonacctransfers_qry);
echo "<br/> Paid Date : ".date('d-m-Y',strtotime($ebonacctransfers['pdate']));
}
$count=$count+1;

}
?></td></tr>.</div></div>
<tr>
<td><input type="text" name="seltot" id="seltot" value="0" readonly><input type="submit" value="Payments" /></td>
</tr>
</table>
</form>
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