<?php 

include("config.php");
 $cid=$_POST['cid'];
$bid=$_POST['bank'];

$strPage = $_REQUEST['Page'];
if(isset($cid)) { ?>
<form method="post" name="level1" action="processtempebillsite.php">
<table width="800" border="1" align="center" cellpadding="4" cellspacing="0"  id="custtable">
  <tr>
    <th scope="col"><div align="center">Customer ID </div></th>
    <th scope="col"><div align="center">Customer Name </div></th>
    <th scope="col"><div align="center">A/C Manager Name </div></th>
    <th scope="col"><div align="center">A/C Manager Phone No.</div></th>
    <th>Ebill</th>
    
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
      <th scope="col"><div align="center">Consumer Number</div></th>
      <th scope="col"><div align="center">Distributor </div></th>
      <!--<th scope="col"><div align="center">Due Date(Only Date) </div></th>-->
      <th scope="col"><div align="center">Landlord </div></th>
       <!--<th scope="col"><div align="center">Rate </div></th>
        <th scope="col"><div align="center">Average Bill </div></th>
         <th scope="col"><div align="center">Billing Unit </div></th>-->
          <th scope="col"><div align="center">Meter no </div></th>
   <!-- <th scope="col"><div align="center">Edit</div></th>
    <th scope="col"><div align="center">Delete</div></th>-->
    
  </tr>
  <?php
        $sql='';	
		$sql.= "SELECT * FROM newtempsites where 1 and (ebillstat='3' or ebillstat='4') and ebill='Y' and entrydt>'2014-04-20 00:00:00'";
		        
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
		
		if(isset($_POST['dt']) && isset($_POST['dt2']) && $_POST['dt']!='' && $_POST['dt2']!='')
			{
			$dt=str_replace("/","-",$_POST['dt']);
	$start=date('Y-m-d', strtotime($dt));
	$dt2=str_replace("/","-",$_POST['dt2']);
	$end=date('Y-m-d', strtotime($dt2));
			$sql.=" and takeover_date Between '".$start."' and '".$end."'";
			}
			if(isset($_POST['myapp']) && $_POST['myapp']!='')
			{
			$sql.=" and ebill='Y'";
			}
			//echo $sql;			
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
$sql.=" order by takeover_date ASC LIMIT $Page_Start , $Per_Page";
//echo $sql;
	$cnt=0;		 
		$result = mysqli_query($con,$sql);
		$num=mysqli_num_rows($result); ?>
		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>
		<?php while($row = mysqli_fetch_row($result))
		{	
		$cnt=$cnt+1;
		?>
		 <tr>
	       <td><?php //echo $row[0];
	       //echo "select * from tempebill where tempid='".$row[0]."'";
	       $chk=mysqli_query($con,"select * from tempebill where tempid='".$row[0]."'");
	       //echo mysqli_num_rows($chk);
	      //if(mysqli_num_rows($chk)>0){
	       if($row[53]=='Y'){
	         ?><input type="checkbox" name="siteid[]" id="siteid<?php echo $row[0]; ?>" value="<?php echo $row[0]; ?>"><?php } echo $row[1]; ?></td>
			 <td><?php echo $row[2]; ?></td>
			 <td><?php echo $row[3]; ?></td>
			 <td><?php echo $row[4]; ?></td>
			 <td><?php echo $row[53]; ?></td>
             
     
			  
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
			    <?php $cons=mysqli_query($con,"select * from tempebill where tempid='".$row[0]."'");
			    $consr=mysqli_fetch_row($cons);
			    if(mysqli_num_rows($cons)>0){ }
			     ?>
			<td><?php echo $consr[1]; ?></td>
            <td><?php echo $consr[2]; ?></td>
            <td><?php echo $consr[5]; ?></td>
            <td><?php echo $consr[12]; ?></td>
            <!--<td></td>
            <td></td>
             <td></td>
              <td></td>-->
			              
			 <!--<td><a href="editsite.php?sid=<?php echo $row[16]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?> ">EDIT</a></td>
			 <td><a href="deletesite.php?sid=<?php echo $row[16]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?> ">DELETE</a></td>-->
             
			  
		</tr>
		<?php
		}
?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">


<!--<input type="submit" name="cmdsub" value="Approve" style="width:100px; height:30px">-->
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

<?php } ?><input type="submit" name="cmdsub" value="Approve" style="width:100px; height:30px"></form>
<p>&nbsp;<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button><!---<a href="excel.php?id=<?php echo $cid; ?>&bid=<?php echo $bid; ?>" >Export To Excel</a></p>>>