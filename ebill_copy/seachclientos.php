<?php
session_start();
//echo $_SESSION['user'];
$desig=$_POST['desig'];
$service=$_POST['service'];
 $dept=$_POST['dept'];
//$_POST['cid']='Tata05';
include('config.php');

	$strPage = $_REQUEST['Page'];
	
	$sql="Select custid,compid,invid,servicetype,amt,fiscalyr,billdate,bank from  siteinvoice where status=0 and custid<>''";
if(isset($_POST['superv']) && $_POST['superv']!='')
	$sql.=" and custid LIKE '%".$_POST['superv']."%'";

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

$sql.="  order by invid,fiscalyr,compid,bank ASC LIMIT $Page_Start , $Per_Page";
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
<th>Sr NO</th>
<th>Client</th>
<th>Bank</th>
<th>Company</th>
<th>Invoice Number</th>
<th>Service</th>
<th>Month</th>
<th>Debit</th>
<th>Credit</th>
</tr>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
$credit=0;
$debit=0;
while($row= mysqli_fetch_row($table))
{
$service=$row[3];
$count=$count+1;
?><div class=article>
<div class=title><tr height="60px">
<td align="center"><?php echo $count; ?></td><td><?php $clnt=mysqli_query($con,"select contact_first from contacts where short_name='".$row[0]."'");
$clro=mysqli_fetch_row($clnt); echo $clro[0]; ?></td>
<td><?php echo str_replace("-1","All",$row[7]); ?></td>
<td><?php  
$comp=mysqli_query($con,"select company_name from company_details where compid='".$row[1]."'");
$compro=mysqli_fetch_row($comp);
echo $compro[0];
?></td>
<td><?php if($row[1]=='1'){ echo "CSS"; }elseif($row[1]=='2'){ echo "C&C"; }elseif($row[1]=='3'){ echo "CS"; }?>/<?php if($service=='caretaker'){ echo "CT"; }elseif($service=='housekeeping'){ echo "HK"; }elseif($service=='maintenance' || $service=='maintenance HK' || $service=='maintenance CT'){ echo "FM"; }elseif($service=='Repair&Maintenance'){ echo "RNM"; } ?>/<?php echo $row[2]; ?>/<?php echo $row[5]; ?></td>
<td><?php echo ucfirst($service); ?></td>
<td><?php echo date('F',strtotime($row[6])); ?></td>
<td align="right">
<?php 
//echo "select amount from siteinvpayrec where compid='".$row[1]."' and fiscalyr='".$row[5]."' and invid='".$row[2]."'";
$pay=mysqli_query($con,"select amount from siteinvpayrec where compid='".$row[1]."' and fiscalyr='".$row[5]."' and invid='".$row[2]."'");
$payro=mysqli_fetch_row($pay);
echo $payro[0];
$credit=$credit+$payro[0];
 ?></td><td align="right">
<?php echo number_format($row[4],2);
$debit=$debit+$row[4];
 ?></td><?php

?>
</tr><?php 

}
?>
<tr>
<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align="right"><?php echo number_format($credit,2); ?></td><td align="right"><?php echo number_format($debit,2); ?></td>
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