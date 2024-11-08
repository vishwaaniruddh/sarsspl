<?php
session_start();
//echo $_SESSION['designation']." ".$_SESSION['custid'];
include("config.php");
$qry='';
 $cid=$_POST['cid'];
$bid=$_POST['bank'];

$strPage = $_REQUEST['Page'];
$sql.="select * from send_bill e where 1";

//$sql.=" and e.reqstatus='8'";
if($_POST['invoice']!='-1')
$sql.=" and status='".$_POST['invoice']."'";
if(isset($_POST['cid']) && $_POST['cid']!='')
{
	$sql.=" and customer_name = '".$_POST['cid']."'";
}
if(isset($_POST['invoice_no']) && $_POST['invoice_no']!='')
{
	$sql.=" and invoice_no like '%".$_POST['invoice_no']."%'";
}

			
		if(isset($_POST['bank']) && $_POST['bank']!='' && $_POST['bank']!='-1')
			{
			$sql.=" and bank like '".$_POST['bank']."'";
			}
		
		if(isset($_POST['dt']) && isset($_POST['dt2']) && $_POST['dt']!='' && $_POST['dt2']!='')
			{
			$dt=str_replace("/","-",$_POST['dt']);
	$start=date('Y-m-d', strtotime($dt));
	$dt2=str_replace("/","-",$_POST['dt2']);
	$end=date('Y-m-d', strtotime($dt2));
			if($start!=$end)
			$sql.=" and e.entrydt Between '".$start."' and '".$end."'";
			else
			$sql.=" and e.entrydt Like '".$start."%'";
			}
			/*if($_SESSION['custid']!='all')
			{
			$sql.=" (print='y' or print='n')";
			}*/
			
			//$sql.=" order by e.entrydt ASC";
		//echo $sql;
	$table=mysqli_query($con,$sql);
if(!$table)
echo mysqli_error();
$count=0;
 $Num_Rows = mysqli_num_rows ($table);
?>
 <div align="center">
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 		if($i<=150)
 	{
 		if($i%50==0)
 		{
 		?>
 		<option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 		<?php
 		}
	 }
 }			
if($Num_Rows<=150)
 {
 ?>
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 <?php
 }			
?></select>

</div>
<?php
if(isset($_POST['perpg']) && $_POST['perpg']!='0')
 $Per_Page =$_POST['perpg'];   // Records Per Page
 else
  $Per_Page ='20';
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
$sql.=" order by send_id ASC LIMIT $Page_Start , $Per_Page";
echo $sql;


$result = mysqli_query($con,$sql);
if(!$result)
echo mysqli_error();
		$num=mysqli_num_rows($result); ?>
        
		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>

<table border="1" align="center"  id="tblebill">
  <tr>
   
    <th>Invoice </th>
    <th>Customer ID</th>
    <th>Bank</th>
    <th>Project</th>
    <th>Invoice Date</th>
    <th>Amount</th>
    <th>Status</th>
     <th>options</th>
  
  </tr>
  
          
	
	<?php	
$cnt=0;
$tot=0;
while($row = mysqli_fetch_row($result))
		{
		
			?>
		 <tr>
		
         <td><?php echo $row[5]; ?></td>
         
		 <td><?php echo $row[1]; ?></td>
    <td><?php if($row[2]=='-1'){ echo "All"; }else { echo $row[2]; } ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php echo date("d/m/Y",strtotime($row[3])); ?></td>
    <td><?php echo $row[4]; $tot=$tot+$row[4]; ?></td>
    <td><?php if($row[10]=='0'){ echo "Active";}elseif($row[10]=='1'){ echo "<b>Cancelled</b>"; } ?></td>
    <td><a href="viewoldebinv.php?invid=<?php echo $row[0]; ?>&yr=<?php echo $row[14]; ?>" target="_blank">View Bill</a></td>
    
		</tr>
		<?php
$cnt=$cnt+1;
if($row[11]>0){
?>
		 <tr>
		
         <td><?php echo $row[9]; ?></td>
         
		 <td><?php echo $row[1]; ?></td>
    <td><?php if($row[2]=='-1'){ echo "All"; }else { echo $row[2]; } ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php echo date("d/m/Y",strtotime($row[3])); ?></td>
    <td><?php echo $row[11]; $tot=$tot+$row[11]; ?></td>
    <td><?php if($row[10]=='0'){ echo "Active";}elseif($row[10]=='1'){ echo "<b>Cancelled</b>"; } ?></td>
    <td><a href="viewoldebinv.php?invid=<?php echo $row[0]; ?>&yr=<?php echo $row[14]; ?>" target="_blank">View Bill</a></td>
   
		</tr>
		<?php
$cnt=$cnt+1;
}
		}
	
?>
<tr><td colspan=4 ></td><td>Total</td><td colspan='2' align="left"><?php echo $tot; ?></td></tr>
</table><div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}

/*for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i','perpg')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?></font></div>