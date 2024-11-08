<?php 

include("config.php");
 $cid=$_POST['cid'];
$bid=$_POST['bank'];

$strPage = $_REQUEST['Page'];
 ?>
<!--<form method="post" name="level1" action="processtempsitelevel1.php">-->
<table width="800" border="1">
  <tr>
    <th scope="col"><div align="center">Customer ID </div></th>
    <th scope="col"><div align="center">Customer Name </div></th>
    <th scope="col"><div align="center">A/C Manager Name </div></th>
    <th scope="col"><div align="center">A/C Manager Phone No.</div></th>
    <th scope="col"><div align="center">Housekeeping </div></th>
	
   
    <th scope="col"><div align="center">Caretaker </div></th>
	
  
    <th scope="col"><div align="center">Maintenance </div></th>
	
   
    <th scope="col"><div align="center">Ebill </div></th>
	
    
    <th scope="col"><div align="center">Bank</div></th>
    <th scope="col"><div align="center">CSS Local Branch </div></th>
    <th scope="col"><div align="center">Zone </div></th>
    <th scope="col"><div align="center">State </div></th>
    <th scope="col"><div align="center">Site ID </div></th>
    <th scope="col"><div align="center">ATM ID1 </div></th>
    <th scope="col"><div align="center">Project ID</div></th>
    <th scope="col"><div align="center">ATM ID2</div></th>
    <th scope="col"><div align="center">ATM ID3 </div></th>
   
    <th scope="col"><div align="center">City </div></th>
    <th scope="col"><div align="center">Location </div></th>
    <th scope="col"><div align="center">ATM SIte Address </div></th>
    <th scope="col"><div align="center">Site Type </div></th>
    <th scope="col"><div align="center">City Category </div></th>
    <th scope="col"><div align="center">Takeover Date </div></th>
    <th scope="col">Agreement Form Availability</th>
    <th scope="col">Approval</th>
    <th scope="col"><div align="center">Customer Remarks </div></th>
    
    <th scope="col"><div align="center">Active </div></th>
   <!-- <th scope="col"><div align="center">Edit</div></th>
    <th scope="col"><div align="center">Delete</div></th>-->
  </tr>
  <?php
        $sql='';	
		$sql.= "SELECT * FROM newtempsites where 1 and (active='1' or active='2')";
		        
		if(isset($_POST['cid']) && $_POST['cid']!='')
			{
			$sql.=" and cust_id='$cid'";
			}
			if(isset($_POST['proj']) && $_POST['proj']!='')
			{
			$sql.=" and projectid='".$_POST['proj']."'";
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
			elseif($_POST['service']=='4')
			$sql.=" and ebill = 'Y'";
			
			}
			}
		if(isset($_POST['dt']) && isset($_POST['dt2']) && $_POST['dt']!='' && $_POST['dt2']!='')
			{
			$dt=str_replace("/","-",$_POST['dt']);
	$start=date('Y-m-d', strtotime($dt));
	$dt2=str_replace("/","-",$_POST['dt2']);
	$end=date('Y-m-d', strtotime($dt2));
			$sql.=" and takeover_date Between '".$start."' and '".$end."'";
			}
			//echo $sql;			
		$table=mysql_query($sql);
if(!$table)
echo mysql_error();
$count=0;
$Num_Rows = mysql_num_rows ($table);
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
$sql.=" order by takeover_date DESC LIMIT $Page_Start , $Per_Page";
echo $sql;
	$cnt=0;		 
		$result = mysql_query($sql);
		$num=mysql_num_rows($result); ?>
		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>
		<?php while($row = mysql_fetch_row($result))
		{	
		$cnt=$cnt+1;
		?>
		 <tr>
	       <td><!--<input type="checkbox" name="siteid[]" id="siteid<?php echo $row[0]; ?>" value="<?php echo $row[0]; ?>">--><?php echo $row[1]; ?></td>
			 <td><?php echo $row[2]; ?></td>
			 <td><?php echo $row[3]; ?></td>
			 <td><?php echo $row[4]; ?></td>
			
		   <td><?php echo $row[5]; ?></td>
            
		
			
			 
			 <td><?php echo $row[7]; ?></td>
			
		 
			  
			 <td><?php echo $row[9]; ?></td>
			
           
             
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
			      <td><?php echo $row[24]; ?></td>
			       <td><?php echo $row[25]; ?></td>
			        <td><?php echo $row[26]; ?></td>
			         <td><?php echo $row[27]; ?></td>
			          <td><?php echo $row[28]; ?></td>
			          
           <td><?php if(isset($row[29]) and $row[29]!='0000-00-00'){  echo date('d/m/Y',strtotime($row[29]));}
		   ?>
    
           </td>
			<td><?php if(formpath==''){ echo "Not Available"; }else{ echo "Available"; } ?></td>
            <td> <div id="count<?php echo $cnt; ?>"><input type="button" name="btn<?php echo $cnt; ?>" id="btn<?php echo $cnt; ?>" onClick="app('count<?php echo $cnt; ?>',<?php echo $row[0]; ?>)"  value="Approve">      </div></td>
			<td><?php echo $row[47]; ?></td>
			             
			              <td><?php if($row[50]==0){echo "YES";} else{ echo "NO";} ?></td>
			    
			
		</tr>
		<?php
		}
?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">

<?php

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}

?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?></font></div>

