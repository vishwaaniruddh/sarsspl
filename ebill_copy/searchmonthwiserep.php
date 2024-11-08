<?php
session_start();

//$_POST['cid']='Tata05';
include('config.php');

$cid="";



	
	
	$sql="Select * from mastersites where atm_id1<>''";
	
if(isset($_POST['atm']) && $_POST['atm']!='')
$sql.=" and atm_id1 like '%".$_POST['atm']."%'";
if(isset($_POST['cid']) && $_POST['cid']!='')
$sql.=" and cust_id like '%".$_POST['cid']."%'";

$table=mysqli_query($con,$sql);

$Num_Rows = mysqli_num_rows ($table);
 $sql2=$sql;
 
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

$sql.="  order by cust_id ASC LIMIT $Page_Start , $Per_Page";
 ?>
 <?php

//echo $sql;
$table=mysqli_query($con,$sql);
 if(isset($_POST['mon']) && isset($_POST['yr']) && isset($_POST['mon2']) && isset($_POST['yr2'])){
$startdate=$_POST['yr']."-".$_POST['mon']."-01";
$enddate=$_POST['yr2']."-".$_POST['mon2']."-31";
$timestamp_start = strtotime($startdate);

$timestamp_end = strtotime($enddate);

 $difference = abs($timestamp_end - $timestamp_start);
 $months = floor($difference/(60*60*24*30));
//echo 'Months '.$months;

 }
if(!$table)
echo mysqli_error();


?>

<form name="frm" method="post" action="exportmonthwiserep.php" target="_blank">
<input type="hidden" name="sql" value="<?php echo $sql2; ?>">
<input type="hidden" name="mon" value="<?php echo $_POST['mon']; ?>">
<input type="hidden" name="yr" value="<?php echo $_POST['yr']; ?>">
<input type="hidden" name="yr2" value="<?php echo $_POST['yr2']; ?>">
<input type="hidden" name="mon2" value="<?php echo $_POST['mon2']; ?>">
<input type="submit" name="cmdsub" value="Export to Excel">
</form>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th width="75">Sr NO</th>
<th>Customer</th>
<th width="75">ATM ID</th>

<th width="75">Bank</th>
<th width="200px">Address</th>

<?php for($i=0;$i<$months;$i++){
 $mon=$_POST['mon']+$i;
 if($mon>12)
 $mon=$mon-12;
 if($mon>0 && $mon<10)
$mon="0".$mon;

 ?><th>
<?php echo date('M',strtotime(date('Y-'.$mon.'-01'))); ?></th>
<th width="75">Paid Date</th>
<th width="75">Paid Amount</th>

<?php } ?>
<th>Active/Inactive</th>
</tr>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
$appamt=0;
$reqamt=0;
while($row= mysqli_fetch_row($table))
{
//echo "dept=".$dept;
//$count=$count+1;
$qry1=mysqli_query($con,"select bank,atmsite_address from ".$row[2]."_sites where trackerid='".$row[5]."'");
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
$brro=mysqli_fetch_row($branch);
/*$fundr=mysqli_query($con,"select reqid,pdate from ebfundtransfers where pdate like '2014-05-%' and reqid in (select req_no from ebillfundrequests where atmid like '%".$row[1]."%' and cust_id like '%".$row[2]."%')");
if(!$fundr)
echo mysqli_error();
echo mysqli_num_rows($fundr)."<br>";
*/
?><div class=article>
<div class=title><tr<?php if($row[25]=='1'){ ?> style="background:#FF7519" <?php } ?>>
<td width="75"><?php echo $count+1; ?></td>
<td width="75"><?php echo $row[2];  ?></td>


<td width="75"><a href="#" onclick="newwin('getebhistory.php?atmid=<?php echo $row[1]; ?>&custid=<?php echo $row[2]; ?>&trackid=<?php  echo $row[5]; ?>','display')"><?php echo $row[1]; ?></a></td>
<td width="75"><?php echo $qrrow[0]; ?></td>
<td width="50" style="overflow: hidden; width: 200px; word-break: keep-all; font-size:small;"><?php echo $qrrow[1]; ?></td>
<?php for($i=0;$i<$months;$i++){

  $mon=$_POST['mon']+$i;
 $yrr=$_POST['yr'];
if($mon>'12')
{
$yrr=$_POST['yr']+1;
$mon=$mon-12;

}
if($mon>0 && $mon<10)
$mon="0".$mon;

$dt=$yrr.'-'.$mon.'-';

$strr= "select reqid,pdate from ebfundtransfers where pdate like '".$dt."%' and reqid in (select req_no from ebillfundrequests where atmid like '%".$row[1]."%' and cust_id like '%".$row[2]."%')";
//$strr= "select reqid,pdate from ebfundtransfers where pdate like '".$dt."%'" and reqid in (select req_no from ebillfundrequests where atmid like '%".$row[1]."%' )";

//echo $strr;
$fundr=mysqli_query($con,$strr);
if(!$fundr)
echo mysqli_error();
//echo mysqli_num_rows($fundr)."<br>";
if(mysqli_num_rows($fundr)>0)
{
//echo "hello";
$amt=0;
$pddt=array();
while($req=mysqli_fetch_array($fundr))
{
$eb=mysqli_query($con,"select approvedamt from ebillfundrequests where req_no='".$req[0]."'");
$ebro=mysqli_fetch_row($eb);
$amt=$amt+$ebro[0];
$pddt[]=date('d/m/Y',strtotime($req[1]));
}
?>
<td width="75">YES</td>
<td width="75"><?php echo implode(",",$pddt); ?></td>
<td width="75"><?php echo $amt; ?></td>
<?php
}
else
{
?>
<td width="75">NO</td>
<td width="75">NA</td>
<td width="75">0</td>
<?php
}
 
 } ?>
<td><?php if($row[7]==0){ echo "Active"; }else{ echo "Inactive"; } ?></td>
<?php
$count=$count+1;

}
?></td></tr>

</div></div>

</table>
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