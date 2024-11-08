<?php 
session_start();
//echo $_SESSION['custid'];
include("config.php");
 $cid=$_POST['cid'];
$bid=$_POST['bank'];

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
<?php
if($_POST['sttype']!='')
{
?>
<th>Consumer Name</th>
<th>Landlord Name</th>
<th>Meter Number</th>
<th>Distributor</th>
<?php
}
?>

    <th scope="col"><div align="center">Takeover Date </div></th>
    <th scope="col" width="70px"><div align="center">Agreement Form </div></th>
    
    <th scope="col"><div align="center">Customer Remarks </div></th>
    
    <th scope="col"><div align="center">Active </div></th>
   <!-- <th scope="col"><div align="center">Edit</div></th>
    <th scope="col"><div align="center">Delete</div></th>-->
  </tr>
  <?php
        $sql='';	
		$sql.= "SELECT * FROM newtempsites where 1 and (active='0' or  active='1' or active='2' or active='3') and cust_id='$cid'";
		        
		/*if(isset($_POST['cid']) && $_POST['cid']!='')
			{
			$sql.=" and cust_id='$cid'";
			}*/
			if(isset($_POST['proj']) && $_POST['proj']!='')
			{
			$sql.=" and project like ('%".$_POST['proj']."%')";
			}
		if(isset($_POST['bank']) && $_POST['bank']!='')
			{
			$sql.=" and bank like ('%".$bid."%')";
			}
		if(isset($_POST['area']) && $_POST['area']!='')
			{
			$sql.=" and csslocalbranch like('%".$_POST['area']."%')";
			}
		if(isset($_POST['id']) && $_POST['id']!='')
			{
			$sql.=" and atm_id1 like ('%".$_POST['id']."%')";
			}
		if(isset($_POST['add']) && $_POST['add']!='')
			{
			$sql.=" and atmsite_address Like ('%".$_POST['add']."%')";
			}
		if(isset($_POST['zone']) && $_POST['zone']!='')
			{
			$sql.=" and zone Like ('%".$_POST['zone']."%')";
			}
			if(isset($_POST['city']) && $_POST['city']!='')
			{
			$sql.=" and city Like ('%".$_POST['city']."%')";
			}
			if(isset($_POST['state']) && $_POST['state']!='')
			{
			$sql.=" and state Like ('%".$_POST['state']."%')";
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
		if(isset($_POST['sdate']) && ($_POST['sdate']!=''))
			{
			$dt=str_replace("/","-",$_POST['sdate']);
	$start=date('Y-m-d', strtotime($dt));
	//$dt2=str_replace("/","-",$_POST['dt2']);
	//$end=date('Y-m-d', strtotime($dt2));
			$sql.=" and entrydt like ( '".$start."%')";
			}
			if(isset($_POST['sttype']) && $_POST['sttype']!='')
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
//$sql.=" order by formpath ASC,takeover_date DESC LIMIT $Page_Start , $Per_Page";
$sql.=" order by entrydt DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
	$cnt=$Page_Start;		 
		$result = mysqli_query($con,$sql);
		$num=mysqli_num_rows($result); ?>
		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>
		<?php while($row = mysqli_fetch_row($result))
		{	
		$cnt=$cnt+1;
		?>
		 <tr<?php if($row[55]==''){ ?> style="background:#FF7519" <?php } ?>>
	       <td><!--<input type="checkbox" name="siteid[]" id="siteid<?php echo $row[0]; ?>" value="<?php echo $row[0]; ?>">--><?php echo $cnt; ?></td>
			<!-- <td><?php echo $row[2]; ?></td>
			 <td><?php echo $row[3]; ?></td>
			 <td><?php echo $row[4]; ?></td>-->
			
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
			        <?php
if($_POST['sttype']!='')
{
$eb=mysqli_query($con,"select * from tempebill where tempid='".$row[0]."'");
$ebr=mysqli_fetch_row($eb);
?>
<td><?php echo $ebr[1]; ?></td>
<td><?php echo $ebr[5]; ?></td>
<td><?php echo $ebr[11]; ?></td>
<td><?php echo $ebr[2]; ?></td>
<?php
}
?>  
           <td>
           <?php
             if($row[55]=='' || $row[29]=='0000-00-00' || $row[51]<=3) { ?>  <a href="#" onclick="window.open('edittempsites.php?id=<?php echo $row[0]; ?>')">Edit services</a><?php }
           ?>
        <br>
           
           <div id="count<?php echo $cnt; ?>"><?php
	 //echo $row[29]." ";
		   /* if($row[29]!='0000-00-00'){  echo date('d/m/Y',strtotime($row[29])); }
		   else
		   {
		   ?>Takeover Date: <input type="text" name="takedt<?php echo $cnt; ?>" id="takedt<?php echo $cnt; ?>" value="" onclick="displayDatePicker('takedt<?php echo $cnt; ?>');"><br>
           <input type="button" name="btn<?php echo $cnt; ?>" id="btn<?php echo $cnt; ?>" onClick="save('takedt<?php echo $cnt; ?>','count<?php echo $cnt; ?>',<?php echo $row[0]; ?>)"  value="Add Takeover Date"><?php }*/ ?></div>
           </td>
			<td>
          <?php
		  echo $row[55];
		  if($row[53]=='Y')
{
?>
<a href="edtcons.php?tempid=<?php echo $row[0]; ?>">Edit Consumer Details</a><br>
<?php
}
		 
		   //echo $_SESSION['serviceauth'];
		   if($row[51]=='1')
		   {
		   ?>
		 <div id="div<?php echo $cnt; ?>">  <input type="button" value="Approve" onclick="app('div<?php echo $cnt; ?>','<?php echo $row[0]; ?>','2')"></div>
		   <?php
		   }
		   
		   
		   $take=mysqli_query($con,"select * from Takeoverform where tempid='".$row[0]."'");
		   if(mysqli_num_rows($take)>0)
		   {
		   $taker=mysqli_fetch_row($take);
		   ?><br>
		  <a href="#" onclick="window.open('viewsiteassets.php?id=<?php echo $taker[0]; ?>&cid=<?php echo $cid; ?>')"> View Assets</a>
		   <?php
		   }
		    ?>
            <div id="fileup<?php echo $cnt; ?>" style="width:50px; display:none">
            <br>Agreement Form<input type="file" name="userfile<?php echo $cnt; ?>" id="userfile<?php echo $cnt; ?>"><br>
           <input type="button" name="btnfile<?php echo $cnt; ?>" id="btnfile<?php echo $cnt; ?>" onClick="save('takedt<?php echo $cnt; ?>','fileup<?php echo $cnt; ?>',<?php echo $row[0]; ?>)"  value="upload"></div></td>            
           <td><?php echo $row[48]; ?></td>
			             
			              <td><?php if($row[50]==0)echo "YES"; else echo "NO"; ?></td>
			    
			
            
			              
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

<?php  ?><!--</form>-->
<!--<p>&nbsp;<a href="excel.php?id=<?php echo $cid; ?>&bid=<?php echo $bid; ?>" >Export To Excel</a></p>-->