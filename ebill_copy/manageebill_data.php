<?php
include("config.php");
$qry='';
 $cid=$_POST['cid'];
$bid=$_POST['bank'];

$strPage = $_REQUEST['Page'];


$sql.="select s.cust_id,s.atm_id1,s.atm_id2,s.atm_id3,s.bank,s.projectid,s.atmsite_address,s.city,s.state,e.Distributor,e.Consumer_No,e.billing_unit,e.landlord,s.csslocalbranch,s.hsupervisor_name,s.trackerid,s.site_id from ".$cid."_ebill e,".$cid."_sites s where e.atmtrackid=s.trackerid and s.ebill='Y'";
//$sql.="select * from ebill where ATM_ID in(select atm_id1 from sites where cust_id ='$cid')";

/*if(isset($_POST['cid']) && $_POST['cid']!='')
			{
			$sql.=" ";
			}*/
			//echo $sql;
		if(isset($_POST['bank']) && $_POST['bank']!='' )
			{
			if($_POST['bank']!='-1')
			$sql.=" and s.bank = '".$bid."'";
			}
		if(isset($_POST['area']) && $_POST['area']!='')
			{
			$sql.="  and s.csslocalbranch like('%".$_POST['area']."%')";
			}
		if(isset($_POST['atmid']) && $_POST['atmid']!='')
			{
			$sql.=" and s.atm_id1 like ('%".$_POST['atmid']."%')";
			}
		if(isset($_POST['address']) && $_POST['address']!='')
			{
			$sql.=" and s.atmsite_address Like ('%".$_POST['address']."%')";
			}
			if(isset($_POST['state']) && $_POST['state']!='')
			{
			$state=str_replace(",","','",$_POST['state']);
			$sql.=" and s.state in ('$state')";
			}
		if(isset($_POST['zone']) && $_POST['zone']!='')
			{
			$sql.=" and s.zone Like ('%".$_POST['zone']."%')";
			}
			if(isset($_POST['dt']) && isset($_POST['dt2']) && $_POST['dt']!='' &&$_POST['dt2']!='')
			{
			if($_POST['dt']!=$_POST['dt2'])
			$sql.=" and s.takeover_date BETWEEN STR_TO_DATE('".$_POST['dt']."','%d/%m/%Y') AND STR_TO_DATE('".$_POST['dt2']."','%d/%m/%Y')";
			else
			$sql.=" and s.takeover_date Like STR_TO_DATE('".$_POST['dt']."%','%d/%m/%Y')";
			}
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
<!--<?php if($Num_Rows>0 && $bid!=''){  ?>
<a href="generateEbill.php?cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">generate Electric bill</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="history.php?cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>&id=<?php echo $id; ?>">Printed Electric bill</a><?php } ?>-->
</div>
<?php
if(isset($_POST['perpg']) && $_POST['perpg']!='0')
 $Per_Page =$_POST['perpg'];   // Records Per Page
 else
  $Per_Page ='50';
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
$qr22=$sql;
$sql.=" LIMIT $Page_Start , $Per_Page";
//echo $sql;









$result = mysqli_query($con,$sql);
		$num=mysqli_num_rows($result); ?>
		<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>
<table width="800" border="1" align="center" cellpadding="4" cellspacing="0">
  <tr>
  
  <th scope="col"><div align="center">Client </div></th>
  <th scope="col"><div align="center">  Atm1 </div></th>
  <th scope="col"><div align="center"> ATM2 </div></th>
  <th scope="col"><div align="center"> ATM3 </div></th>
  <th scope="col"><div align="center"> Bank </div></th>
  <th scope="col"><div align="center"> ProjectID </div></th>
  <th scope="col"><div align="center"> Address </div></th>
  <th scope="col"><div align="center"> City </div></th>
  <th scope="col"><div align="center"> State </div></th>
  
  <th scope="col"><div align="center"> Distributor</div></th>
  <th scope="col"><div align="center"> Consumer Number </div></th>
  <th scope="col"><div align="center"> Site ID </div></th>
  <th scope="col"><div align="center"> Billing Unit </div></th>
  <th scope="col"><div align="center"> Landlord </div></th>
  <th scope="col"><div align="center"> Payment Type </div></th>
  <th scope="col"><div align="center"> Max paid Date </div></th>
  <th scope="col"><div align="center"> CSS Local Branch </div></th>
  <th scope="col"><div align="center">  Supervisor Name</div></th>
  <th scope="col"><div align="center">EDIT</div></th> 
 
  </tr>
  
          
	
	<?php
	//echo $sql;
		while($row = mysqli_fetch_array($result))
		{
		//echo "select provider from eserviceprovider where code='".$row[9]."' and state='".$row[8]."'";
		$prov=mysqli_query($con,"select provider from eserviceprovider where code='".$row[9]."' and state='".$row[8]."'");
		$provro=mysqli_fetch_row($prov);
			?>
		 <tr><td><?php echo $row[0]; ?></td>
		     <td><?php echo $row[1]; ?></td>
			 <td><?php echo $row[2]; ?></td>
			 <td><?php echo $row[3]; ?></td>
			 <td><?php echo $row[4]; ?></td>			 			              
			  <td><?php echo $row[5]; ?></td>			 			              
			   <td><?php echo $row[6]; ?></td>
			    <td><?php echo $row[7]; ?></td>
			   <td><?php echo $row[8]; ?></td>
			   <td><?php echo $provro[0]; ?></td>
			   <td><?php echo $row[10]; ?></td>
			   <td><?php echo $row['site_id']; ?></td>			   
			    <td><?php echo $row[11]; ?></td>
			   <td><?php echo $row[12]; ?></td>
			   
			<?php
			//echo "select max(p.Paid_Date),e.paytype from ebpayment p,ebillfundrequests e where e.trackerid='".$row[15]."' and e.req_no=p.Bill_No<br>";
			   $mx=mysqli_query($con,"select max(p.Paid_Date),e.paytype from ebpayment p,ebillfundrequests e where e.trackerid='".$row[15]."' and e.req_no=p.Bill_No");
			   if(mysqli_num_rows($mx)>0)
			   {
		$mxro=mysqli_fetch_row($mx);
		echo "<td>".$mxro[1]."</td>";
		if($mxro[0]!=NULL)
		echo "<td>".date("d F Y",strtotime($mxro[0]))."</td>";
		else
		echo "<td>NA</td>";
		}
		else{
		echo "<td>NA</td>";
		echo "<td>NA</td>";
		}
		?>
			   <td><?php echo $row[13]; ?></td>
			   <td><?php echo $row[14]; ?></td>
			   			 			              
			 <td><a href="consumerdetails.php?trackid=<?php echo $row[15];  ?>&cid=<?php echo $row[0]; ?>">EDIT</a></td>			
             <!--<td><a href="viewebills.php?atmid=<?php echo $row[1]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $row[7]; ?>">VIEW</a></td>
             <td><a href="newebill.php?atmid=<?php echo $row[1]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $row[7]; ?>">ENTRY</a></td>-->			  
<!--             <td><a href="moneytransfer.php?atmid=<?php echo $row[1]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $row[7]; ?>">TRANSFER</a></td>	-->		  
		</tr>
		<?php
		}
	
?>
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
<form name="frm" method="post" action="exportebillsites.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >