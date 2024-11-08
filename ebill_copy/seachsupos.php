<?php
session_start();
//echo $_SESSION['user'];
$desig=$_POST['desig'];
$service=$_POST['service'];
 $dept=$_POST['dept'];
//$_POST['cid']='Tata05';
include('config.php');

	$strPage = $_REQUEST['Page'];
	
	$sql="Select hname,aid,branch,debit,credit from  fundaccounts where 1";
if(isset($_POST['superv']) && $_POST['superv']!='')
	$sql.=" and hname LIKE '%".$_POST['superv']."%'";

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

$sql.="  order by hname ASC LIMIT $Page_Start , $Per_Page";
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
<th width="75">Supervisor</th>
<th width="75">Branch</th>
<th>Transferred Amount</th>
<th>Received Bills Amount</th>
</tr>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
$credit=0;
$debit=0;
while($row= mysqli_fetch_row($table))
{
$count=$count+1;
?><div class=article>
<div class=title><tr height="60px">
<td align="center"><?php echo $count; ?></td><td><?php echo $row[0]; ?></td><td><?php echo $row[2]; ?></td>
<?php
//echo "select sum(amount) from onacctransfer where aid='".$row[1]."' and reqstatus='8'<br>";
$onacc=mysqli_query($con,"select sum(amount) from onacctransfer where aid='".$row[1]."' and reqstatus='8'");
$onaccro=mysqli_fetch_row($onacc);
//echo "select sum(approvedamt) from ebillfundrequests where supervisor ='".$row[0]."' and chqno<>0<br>";
$fund2=mysqli_query($con,"select sum(approvedamt) from ebillfundrequests where supervisor ='".$row[0]."' and chqno<>0");
$fundro2=mysqli_fetch_row($fund2);
//echo "select sum(Paid_Amount) from ebpayment where Bill_No in(select req_no from ebillfundrequests where supervisor ='".$row[0]."' and  chqno<>0)<br>";
$fund3=mysqli_query($con,"select sum(Paid_Amount) from ebpayment where Bill_No in(select req_no from ebillfundrequests where supervisor ='".$row[0]."' and  chqno<>0)");
$fundro3=mysqli_fetch_row($fund3);
//$bal=($fundro2[0]+$fundro[0])-$fundro3[0];

?>
<td align="right">
<?php  echo number_format($onaccro[0]+$fundro2[0]+$row[3],2); $debit=$debit+($onaccro[0]+$fundro2[0]+$row[3]); ?></td>
<td align="right"><?php echo number_format(abs($fundro3[0]+$row[4]),2);  $credit=$credit+abs($fundro3[0]+$row[4]); ?></td>
<td align="right"><a href="viewsupdetails.php?aid=<?php echo $row[1]; ?>&hname=<?php echo $row[0]; ?>" target="_new">View Details</a></td>

</tr><?php 

}
?>
<tr>
<td></td><td></td><td></td><td align="right"><?php echo number_format($debit,2); ?></td><td align="right"><?php echo number_format($credit,2); ?></td>
</tr>
</div></div>

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