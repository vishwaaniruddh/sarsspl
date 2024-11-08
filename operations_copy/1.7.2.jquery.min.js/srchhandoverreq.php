<?php 
session_start();
//echo $_SESSION['custid'];
include("config.php");
 $cid=$_POST['cid'];
$bid=$_POST['bank'];
$desig= $_POST['desig'];
$service=$_POST['service'];
 $dept=$_POST['dept'];

$strPage = $_REQUEST['Page'];
 ?>
<!--<form method="post" name="level1" action="processtempsitelevel1.php">-->
<table width="800" border="1" id="custtable">
  <tr>
    <th scope="col"><div align="center">Sr no</div></th>
    <!--<th scope="col"><div align="center">Customer Name </div></th>
    <th scope="col"><div align="center">A/C Manager Name </div></th>
    <th scope="col"><div align="center">A/C Manager Phone No.</div></th>-->
    <th scope="col"><div align="center">HK </div></th>
	
   
    <th scope="col"><div align="center">CT </div></th>
	
  
    <th scope="col"><div align="center">M </div></th>
	
   
    <th scope="col"><div align="center">EB </div></th>
	
    
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
   
     <!--<th scope="col"><div align="center">Local Branch Manager </div></th>
     <th scope="col"><div align="center">Local Branch Manager Number </div></th>-->
      <th scope="col" width="150px"><div align="center">ATM SIte Address </div></th>
    <th scope="col"><div align="center">Site Type </div></th>
    <th scope="col"><div align="center">City Category </div></th>
    <th scope="col"><div align="center">Takeover Date </div></th>
    <th scope="col" width="70px"><div align="center">Handover date </div></th>
    
    
    
    <th scope="col"><div align="center">Active </div></th>
   <!-- <th scope="col"><div align="center">Edit</div></th>
    <th scope="col"><div align="center">Delete</div></th>-->
  </tr>
  <?php
        $sql='';	
		$sql.= "SELECT s.housekeeping,s.caretaker,s.maintenance,s.ebill,s.bank,s.csslocalbranch,s.zone,s.state,s.site_id,s.atm_id1,s.projectid,s.atm_id2,s.atm_id3,s.city,s.location,s.atmsite_address,s.site_type,s.city_category,s.takeover_date,h.handover_date,s.trackerid,h.id,h.status FROM Handoverform h,".$cid."_sites s where h.trackerid=s.trackerid and h.customer='$cid'";
		        
		/*if(isset($_POST['cid']) && $_POST['cid']!='')
			{
			$sql.=" and cust_id='$cid'";
			}*/
			if(isset($_POST['project']) && $_POST['project']!='')
			{
			$sql.=" and s.project like ('%".$_POST['proj']."%')";
			}
		if(isset($_POST['bank']) && $_POST['bank']!='')
			{
			$sql.=" and s.bank like ('%".$bid."%')";
			}
		if(isset($_POST['area']) && $_POST['area']!='')
			{
			$sql.=" and s.csslocalbranch like('%".$_POST['area']."%')";
			}
		if(isset($_POST['id']) && $_POST['id']!='')
			{
			$sql.=" and s.atm_id1 like ('%".$_POST['id']."%')";
			}
		if(isset($_POST['add']) && $_POST['add']!='')
			{
			$sql.=" and s.atmsite_address Like ('%".$_POST['add']."%')";
			}
		if(isset($_POST['zone']) && $_POST['zone']!='')
			{
			$sql.=" and s.zone Like ('%".$_POST['zone']."%')";
			}
			if(isset($_POST['city']) && $_POST['city']!='')
			{
			$sql.=" and s.city Like ('%".$_POST['city']."%')";
			}
			if(isset($_POST['state']) && $_POST['state']!='')
			{
			$sql.=" and s.state Like ('%".$_POST['state']."%')";
			}
		/*if(isset($_POST['service']) && $_POST['service']!='')
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
			}*/
		if(isset($_POST['sdate']) && ($_POST['sdate']!=''))
			{
			$dt=str_replace("/","-",$_POST['sdate']);
	$start=date('Y-m-d', strtotime($dt));
	//$dt2=str_replace("/","-",$_POST['dt2']);
	//$end=date('Y-m-d', strtotime($dt2));
			$sql.=" and s.handover_date like ( '".$start."%')";
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
$sql.=" order by handover_date DESC,status ASC LIMIT $Page_Start , $Per_Page";
echo $sql;
	$cnt=$Page_Start;		 
		$result = mysqli_query($con,$sql);
		$num=mysqli_num_rows($result); ?>
		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>
		<?php while($row = mysqli_fetch_row($result))
		{	
		$cnt=$cnt+1;
		?>
		 <tr>
	       <td><!--<input type="checkbox" name="siteid[]" id="siteid<?php echo $row[0]; ?>" value="<?php echo $row[0]; ?>">--><?php echo $cnt; ?></td>
			
			 <td><?php echo $row[0]; ?></td>
			 <td><?php echo $row[1]; ?></td>
			
		   <td><?php echo $row[2]; ?></td>
            
		
			
			 
			 <td><?php echo $row[3]; ?></td>
			
		 
			  
			 <td><?php echo $row[4]; ?></td>
			
           
             
			 <td><?php echo $row[5]; ?></td>
             
           
			 <td><?php echo $row[6]; ?></td>
		   <td><?php echo $row[7]; ?></td>
			 <td><?php echo $row[8]; ?></td>
			 <td><?php echo $row[9]; ?></td>
			 <td><?php echo $row[10]; ?></td>
			 <td><?php echo $row[11]; ?></td>
		   <td><?php echo $row[12]; ?></td>
			 <td><?php echo $row[13]; ?></td>
			 <td><?php echo $row[14]; ?></td>
			      <td><?php echo $row[15]; ?></td>
			       <td><?php echo $row[16]; ?></td>
			        <td><?php echo $row[17]; ?></td>
			         <td><?php echo date('d/m/Y',strtotime($row[18])); ?></td>
			          <td><?php echo date('d/m/Y',strtotime($row[19])); ?></td>
			          
           <td>

<div id="block<?php echo $cnt; ?>">
<?php
//echo $desig." ".$service." ".$dept." ".$row[22];
if($desig=="8" && $service=='2' && $dept=='4' && $row[22]=='0')
{
?>
<input type="button" onclick="approve('<?php echo $cnt; ?>','<?php echo $row[21]; ?>','1');" value="Approve">
<?php
}
if($desig=="8" && $service=='1' && $dept=='4' && $row[22]=='1')
{
?>
<input type="button" onclick="approve('<?php echo $cnt; ?>','<?php echo $row[21]; ?>','2');" value="Approve">
<?php
}
?>
          </div>
		  <a href="#" onclick="window.open('viewhandoverassets.php?trackerid=<?php echo $row[20]; ?>&cid=<?php echo $cid; ?>')"> View Assets</a>
		 
            </td>            
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

<?php  ?><!--</form>-->
<!--<p>&nbsp;<a href="excel.php?id=<?php echo $cid; ?>&bid=<?php echo $bid; ?>" >Export To Excel</a></p>-->