<?php  
		include("config.php");
		$cid=$_POST['cid'];
		// $bid=$_POST['bank'];

		$strPage = $_REQUEST['Page'];
 ?>

<table width="95%" border="1" id="custtable">
  <tr>
  <th>SN</th>
<th>ATMID</TH>
<TH>CONSUMER NO.</TH>
<TH>DUE DATE</TH>
<TH>CUSTOMER NAME</TH>
<TH>BANK NAME</TH>
<TH>CITY</TH>
<TH>DISTRIBUTOR</TH>
<TH>SUPERVISOR_NAME</TH>
	

  </tr>
  <?php
		session_start();
		$sql='';	
		$sql.= "SELECT * FROM `".$_SESSION['custid']."_ebill` where Due_Date between ".date('d')." and ".(date('d')+7);
		
		if(isset($_POST['id']) && $_POST['id']!='')
		{
		$sql.=" and `atm_id` like ('%".$_POST['id']."%')";
		}
		
		$count=0;
		$table=mysqli_query($con,$sql);
		$Num_Rows = mysqli_num_rows ($table);
		?>
		
		<div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i<=150)
 {
 if($i%20==0)
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
 ?>
 </select>
 </div>
		
	<?php	//echo $sql;
		########### pagins
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
//$sql.=" order by formpath ASC,takeover_date DESC LIMIT $Page_Start , $Per_Page";
$sql.=" order by `Due_Date` ASC LIMIT $Page_Start , $Per_Page";
//echo $sql;
		$cnt=$Page_Start;		 
		$result = mysqli_query($con,$sql);
		$num=mysqli_num_rows($result); ?>
		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Num_Rows ?> </b>
		<?php while($row = mysqli_fetch_row($result)){
		$cnt=$cnt+1;
		?>
		 <tr>
		 <?php 
		 //echo "select `cust_name`,`city`,`bank` from `".$_SESSION['custid']."_sites` where `atm_id1`='".$row[3]."'";
		 $cust_detail=mysqli_query($con,"select `cust_name`,`city`,`bank`,`hsupervisor_name` from `".$_SESSION['custid']."_sites` where `atm_id1`='".$row[3]."'");
		 $cust_detail1=mysqli_fetch_row($cust_detail);
		 ?>
			<td><?php echo $cnt; ?></td>
			<td><?php echo $row[3]; ?></td>
			<td><?php echo $row[1]; ?></td> 
			<td><?php echo $row[4]; ?></td>     
			<td><?php echo $cust_detail1[0]; ?></td>

			<td><?php echo $cust_detail1[2]; ?> </td>
			 
			<td><?php echo $cust_detail1[1]; ?></td>
						 
			<td><?php echo $row[2];  ?></td>
			<td><?php echo $cust_detail1[3]; ?></td>

		</tr>
 <?php       
       
 } 
?>
		

</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php echo $Num_Rows;?> Record : -->
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

<?php  ?><!--</form>-->
<!--<p>&nbsp;<a href="excel.php?id=<?php echo $cid; ?>&bid=<?php echo $bid; ?>" >Export To Excel</a></p>-->