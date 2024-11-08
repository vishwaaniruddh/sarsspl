<?php 

include("config.php");
 $cid=$_POST['cid'];
$bid=$_POST['bank'];

$strPage = $_REQUEST['Page'];
if(isset($cid)) { ?>
<form method="post" name="level1" action="processtempsitelevel1.php">
<table width="800" border="1" align="center" cellpadding="4" cellspacing="0"  id="custtable">
  <tr>
    <th scope="col"><div align="center">Customer ID </div></th>
   
    <th scope="col"><div align="center">Customer Name </div></th>
    <th scope="col"><div align="center">A/C Manager Name </div></th>
    <th scope="col"><div align="center">A/C Manager Phone No.</div></th>
    <th scope="col"><div align="center">Housekeeping </div></th>
	
   <th>Housekeeping rate</th>
    <th scope="col"><div align="center">Caretaker </div></th>
	<th scope="col"><div align="center">Caretaker rate </div></th>
    <th scope="col"><div align="center">Maintenance </div></th>
    <th scope="col"><div align="center">Maintenance Rate</div></th>
	 <th scope="col"><div align="center">Trackid (Please Do not Modify this Field) </div></th>
    <th scope="col"><div align="center">Bank</div></th>
    <th scope="col"><div align="center">CSS Local Branch </div></th>
    <th scope="col"><div align="center">Zone </div></th>
    <th scope="col"><div align="center">State </div></th>
    <th scope="col"><div align="center">Site ID </div></th>
    <th scope="col"><div align="center">ATM ID1 </div></th>
    <th scope="col"><div align="center">Project ID</div></th>
    <th scope="col"><div align="center">ATM ID2</div></th>
    <th scope="col"><div align="center">ATM ID3 </div></th>
    <th scope="col"><div align="center">Dummy ATM ID </div></th>
    <th scope="col"><div align="center">Site Old MDN No. </div></th>
    <th scope="col"><div align="center">Site New MDN No. </div></th>
    <th scope="col"><div align="center">MDN RSN No. </div></th>
    <th scope="col"><div align="center">City </div></th>
    <th scope="col"><div align="center">Location </div></th>
    <th scope="col"><div align="center">ATM SIte Address </div></th>
    <th scope="col"><div align="center">Site Type </div></th>
    <th scope="col"><div align="center">City Category </div></th>
    <th scope="col"><div align="center">Takeover Date </div></th>
    
    <th scope="col"><div align="center">Customer Remarks </div></th>
    <th scope="col"><div align="center">CSS Billing Remarks </div></th>
    <th scope="col"><div align="center">CSS A/C Manager Remarks </div></th>
      <th scope="col"><div align="center">Active </div></th>
       <th scope="col"><div align="center">Sub Category </div></th>
  <!--  <th scope="col"><div align="center">Edit</div></th>
    <th scope="col"><div align="center">Delete</div></th>-->
    
  </tr>
  <?php
        $sql='';	
		$sql.= "SELECT * FROM newtempsites where 1 and (active>='3' and active<'5') ";
		        
		if(isset($_POST['cid']) && $_POST['cid']!='')
			{
			$sql.=" and cust_id='$cid'";
			}
			if(isset($_POST['proj']) && $_POST['proj']!='')
			{
			$sql.=" and project='".$_POST['proj']."'";
			}
		if(isset($_POST['bank']) && $_POST['bank']!='')
			{
			$sql.=" and bank='$bid'";
			}
		if(isset($_POST['area']) && $_POST['area']!='')
			{
			$sql.=" and csslocalbranch like('%".$_POST['area']."')";
			}
		if(isset($_POST['atmid']) && $_POST['atmid']!='')
			{
			$sql.=" and atm_id1 like ('%".$_POST['atmid']."%')";
			}
		if(isset($_POST['address']) && $_POST['address']!='')
			{
			$sql.=" and atmsite_address Like ('%".$_POST['address']."%')";
			}
		if(isset($_POST['zone']) && $_POST['zone']!='')
			{
			$sql.=" and zone Like ('%".$_POST['zone']."%')";
			}
		if(isset($_POST['service']) && $_POST['service']!='')
			{
			if($_POST['service']=='all')
			$sql.=" and (housekeeping='Y' or caretaker='Y' or maintenance='Y')";
			else
			{
			if($_POST['service']=='1')
			$sql.=" and housekeeping='Y' ";
			elseif($_POST['service']=='2')
			$sql.=" and caretaker='Y'";
			elseif($_POST['service']=='3')
			$sql.=" and maintenance='Y'";
			
			
			}
			}
		if(isset($_POST['dt']) && isset($_POST['dt2']) && $_POST['dt']!='' && $_POST['dt2']!='')
			{
			$dt=str_replace("/","-",$_POST['dt']);
	$start=date('Y-m-d', strtotime($dt));
	$dt2=str_replace("/","-",$_POST['dt2']);
	$end=date('Y-m-d', strtotime($dt2));
	if($start!=$end)
			$sql.=" and entrydt Between '".$start."' and '".$end."'";
			else
			$sql.=" and entrydt like ('".$start."%')";
			}
			echo $sql;			
		$table=mysqli_query($con,$sql);
if(!$table)
echo mysqli_error();
$count=0;
$Num_Rows = mysqli_num_rows ($table);
		?>
        
        <div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
 
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
$sql.=" order by active DESC,takeover_date DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
	$cnt=0;		 
		$result = mysqli_query($con,$sql);
		$num=mysqli_num_rows($result); ?>
		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>
		<?php while($row = mysqli_fetch_row($result))
		{	
		$cnt=$cnt+1;
		$hs=0;
		$cr=0;
		$mn=0;
		?>
		 <tr>
	       <td>
           <?php
         //  echo $row[5]." ".$row[7]." ".$row[9]." ".$row[6]." ".$row[8]." ".$row[10]."<br>";
		   if($row[5]=='Y')
		   {
//echo $row[5]." ".$row[6];
		   if($row[6]!='')
		   $hs=0;
		   else
		   $hs='1';
		   }
		  if($row[7]=='Y')
		   {
//echo $row[7]." ".$row[8];
		   if($row[8]!='')
		   $cr=0;
		   else
		   $cr='1';
		   }
		   if($row[9]=='Y')
		   {
//echo $row[9]." ".$row[10];
		   if($row[10]!='')
		   $mn=0;
		   else
		   $mn='1';
		   }
		// echo $hs." ".$cr." ".$mn;
echo $row[51];
		   if($hs=='0' && $cr=='0' && $mn=='0')
		   {
		   ?>
           <input type="checkbox" name="siteid[]" id="siteid<?php echo $row[0]; ?>" value="<?php echo $row[0]; ?>"><?php } ?><?php echo $row[1]; ?></td>
			 <td><?php echo $row[2]; ?></td>
			 <td><?php echo $row[3]; ?></td>
			 <td><?php echo $row[4]; ?></td>
			
			 <td><?php echo $row[5]; ?></td>
            
		<td><?php echo $row[6]; ?></td>
			
			 
		   <td><?php echo $row[7]; ?></td>
			
	<td><?php echo $row[8]; ?></td>
			  
		   <td><?php echo $row[9]; ?></td>
				
			<td><?php echo $row[10]; ?></td> 
            <td><?php echo $row[0]; ?></td> 
		   <td><?php echo $row[11]; ?></td>
		   <td><?php echo $row[12]; ?></td>
			 <td><?php echo $row[13]; ?></td>
			 <td><?php echo $row[14]; ?></td>
			 <td><?php echo $row[16]; ?></td>
			 <td><?php echo $row[17]; ?></td>
			 <td><?php echo $row[52]; ?></td>
			 <td><?php echo $row[18]; ?></td>
			 <td><?php echo $row[19]; ?></td>
			  <td><?php echo $row[20]; ?></td>
			   <td><?php echo $row[21]; ?></td>
			    <td><?php echo $row[22]; ?></td>
			     <td><?php echo $row[23]; ?></td>
			      <td><?php echo $row[24]; ?></td>
			       <td><?php echo $row[25]; ?></td>
			        <td><?php echo $row[26]; ?></td>
			         <td><?php echo $row[27]; ?></td>
			          <td><?php echo $row[28]; ?></td>
			          
           <td><?php if(isset($row[29]) and $row[29]!='0000-00-00') echo date('d/m/Y',strtotime($row[29])); ?></td>
			            
			              <td><?php echo $row[47]; ?></td>
			              <td><?php echo $row[48]; ?></td>
			              <td><?php echo $row[49]; ?></td>
			              <td><?php if($row[50]==0)echo "YES"; else echo "NO"; ?></td>
			    
			<td></td>
            
			              
			<!-- <td><a href="editsite.php?sid=<?php echo $row[16]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?> ">EDIT</a></td>
			 <td><a href="deletesite.php?sid=<?php echo $row[16]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?> ">DELETE</a></td>-->
			  
		</tr>
		<?php
		}
?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">


<input type="submit" name="cmdsub" value="Approve" style="width:100px; height:30px">
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

<?php } ?></form>
<p>&nbsp;<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button><!---<a href="excel.php?id=<?php echo $cid; ?>&bid=<?php echo $bid; ?>" >Export To Excel</a></p>