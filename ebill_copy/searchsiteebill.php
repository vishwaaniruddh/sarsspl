<?php
session_start();
//echo $_SESSION['designation']." ".$_SESSION['custid'];
include("config.php");
$qry='';
 $cid=$_POST['cid'];
$bid=$_POST['bank'];

$strPage = $_REQUEST['Page'];
$sql.="select atmid,reqby, entrydate,bill_date,unit, amount,start_date, end_date, due_date,opening_reading,  closing_reading, req_no, print,   cust_id, status, memo, trackerid,req_no ,pstat,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg` from ebillfundrequests where   pstat in (0,2) and reqstatus<>0 and reqstatus<>100 and req_no not in (select alert_id from ebfundtranscanc where status=0)  and req_no not in (select reqid from ebillfundcancinv where status=0)";
//$sql.=" and due_date>='2014-01-01'";
if(isset($_POST['atm']) && $_POST['atm']!='')
			{
			$sql.=" and  atmid like ('%".$_POST['atm']."%')";
			}
//$sql.="select * from ebill where ATM_ID in(select atm_id1 from sites where cust_id ='$cid')";
if(isset($_POST['cid']) && $_POST['cid']!='')
			{
			$sql.=" and cust_id='".$_POST['cid']."'";
			}
			//echo $sql;
			
		
		
		if(isset($_POST['dt']) && isset($_POST['dt2']) && $_POST['dt']!='' && $_POST['dt2']!='')
			{
			$dt=str_replace("/","-",$_POST['dt']);
	$start=date('Y-m-d', strtotime($dt));
	$dt2=str_replace("/","-",$_POST['dt2']);
	$end=date('Y-m-d', strtotime($dt2));
			if($start!=$end)
			$sql.=" and  entrydate Between '".$start."' and '".$end."'";
			else
			$sql.=" and  entrydate Like '".$start."%'";
			}
			/*if($_SESSION['custid']!='all')
			{
			$sql.=" (print='y' or print='n')";
			}*/
			
			
	//	echo $sql;
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
$sql.=" order by  pstat DESC,print DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;


$result = mysqli_query($con,$sql);
if(!$result)
echo mysqli_error();
		$num=mysqli_num_rows($result); ?>
        
		<!--<b>Total Number Of Records:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $Num_Rows; ?></b>-->

<table border="1" align="center"  id="tblebill">
  <tr >
   <!--<?php if($_SESSION['designation']=='7' && $_SESSION['serviceauth']=='1'){ ?> <th>Approve</th><?php } ?>-->
   <th>Tracker ID</th>
    <th>Atm ID</th>
    <th>Docket NO</th>
	<th>Request By</th>
	<th>Entry Date</th>
    <th>Bank</th>
    <th>CSS Local Branch</th>
    <th>Zone</th>
    <th>State</th>
     <th>City</th>
    <th>Location</th>
    <th>Address</th>
    <th>Distributor</th>
    <th>Landlord</th>
    <th>Consumer No</th>
    <th>Takeover Date</th>
    
    <th>Bill Date</th>
    <th>Unit </th>
    <th>Amount</th>
                <th>Start date</th>
                 <th>End date</th>
                 <th>Due Date</th>
                 <th>Opening Reading</th>
                 <th>Closing reading</th>
                 <!--<th>Extra Charge</th>-->
                <th>Remarks</th>
    <th></th>
  </tr>
  
          
	
	<?php	
$cnt=0;
while($row = mysqli_fetch_array($result))
		{
		$sitestr= "select bank,csslocalbranch,zone,state,city,location,atmsite_address,takeover_date from ".$row[13]."_sites where trackerid='".$row[16]."'";
		if(isset($_POST['bank']) && $_POST['bank']!='' && $_POST['bank']!='-1')
			{
			$sitestr.=" and bank like ('%".$_POST['bank']."%')";
			}
		//echo "<br>".$sitestr;
		$site=mysqli_query($con,$sitestr);
		if(mysqli_num_rows($site)>0){
		$sitero=mysqli_fetch_row($site);
		
		$dist='';
		//echo "select Distributor,Consumer_No,landlord from ".$row[13]."_ebill where atmtrackid='".$row[16]."'<br>";
		$siteebill= mysqli_query($con,"select Distributor,Consumer_No,landlord from ".$row[13]."_ebill where atmtrackid='".$row[16]."'");
		if(mysqli_num_rows($siteebill)>0){
		$ebro=mysqli_fetch_row($siteebill);
		$prov=mysqli_query($con,"select provider from eserviceprovider where code='".$ebro[0]."'");
		$provro=mysqli_fetch_row($prov);
		$dist=$provro[0];
		}
		//echo "<br>select last(remarks) from ebillfundapp where reqid='".$row[17]."'";
		$qry=mysqli_query($con,"select remarks from ebillfundapp where reqid='".$row[17]."' order by appid DESC limit 1");
		$ro=mysqli_fetch_row($qry);
		//echo "<br>select username from login where srno='".$row[1]."'";
		$sr=mysqli_query($con,"select username from login where srno='".$row[1]."'");
		$srno=mysqli_fetch_row($sr);
			?>
		 <tr <?php if($row['pstat']==2){?>style="background-color:#F00;"<?php }?>>
		 <td><?php echo $row[16]; ?></td>
		
        <td><!--<a href="javascript:void(0);" onclick="newwin('getebhistory.php?custid=<?php echo $row[13]; ?>&trackid=<?php echo $row[16]; ?>&atmid=<?php echo $row[0]; ?>','display')">-->
        <a href="javascript:void(0);" onclick="newwin('ebsitehist.php?atmid=<?php echo $row[0]; ?>&custid=<?php echo $row[13]; ?>&trackid=<?php  echo $row[16]; ?>','display',900,700)"><?php echo $row[0]; ?></a></td>
        <td><b><?php echo $row[11]; ?></b></td>
		  <td><?php echo $srno[0]; ?></td>
		  
		   <td><?php echo $row[2]; ?></td>
		 <td><?php echo $sitero[0]; ?></td>
    <td><?php echo $sitero[1];; ?></td>
    <td><?php echo $sitero[2];; ?></td>
    <td><?php echo $sitero[3];; ?></td>
    <td><?php echo $sitero[4];; ?></td>
    <td><?php echo $sitero[5];; ?></td>
    <td><?php echo $sitero[6];; ?></td>
    <td><?php echo $dist;; ?></td>
    <td><?php echo $ebro[2];; ?></td>
    <td><?php echo $ebro[1];; ?></td>
	<td>
	<?php if($sitero[7]!='0000-00-00'){ echo date("d/m/Y",strtotime($sitero[7])); }else{ echo "NA"; } ?></td>	 
		     <td><?php if($row[3]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[3])); } ?>
		    <!-- <input type="text" name="billdt<?php echo $cnt; ?>" id="billdt<?php echo $cnt; ?>" placeholder="Bill Date" <?php if($row[3]=='0000-00-00'){ ?> onclick="displayDatePicker('billdt<?php echo $cnt; ?>');"<?php } ?> value="<?php if($row[3]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[3])); } ?>" <?php if($row[3]!='0000-00-00'){ ?> <?php } ?>  />-->
		     <?php //if($row[3]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[3])); }else{ echo "NA"; } ?></td>
			 <td><?php echo $row[4]; ?></td>
             <td><?php echo $row[5]; ?></td>
			 <td><?php if($row[6]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[6])); } ?>
			 <!--<input type="text" name="startdt<?php echo $cnt; ?>" id="startdt<?php echo $cnt; ?>" placeholder="Start Date" <?php if($row[6]=='0000-00-00'){ ?> onclick="displayDatePicker('startdt<?php echo $cnt; ?>');"<?php } ?> value="<?php if($row[6]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[6])); } ?>" <?php if($row[6]!='0000-00-00'){ ?>  <?php } ?> />-->
		     <?php //if($row[6]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[6])); }else{ echo "NA"; } ?></td>
             <td><?php if($row[7]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[7])); } ?>
			<!-- <input type="text" name="enddt<?php echo $cnt; ?>" id="enddt<?php echo $cnt; ?>" placeholder="End Date" <?php if($row[7]=='0000-00-00'){ ?> onclick="displayDatePicker('enddt<?php echo $cnt; ?>');"<?php } ?> value="<?php if($row[7]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[7])); } ?>" <?php if($row[7]!='0000-00-00'){ ?>  <?php } ?>  />-->
		     
			 <?php
	     
			// if($row[7]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[7])); }else{ echo "NA"; } ?></td>
             <td><?php if($row[8]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[8])); } ?>
			<!-- <input type="text" name="duedt<?php echo $cnt; ?>" id="duedt<?php echo $cnt; ?>" placeholder="Due Date"  value="<?php if($row[8]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[8])); } ?>" <?php  ?>  <?php  ?>  />
			<div id="edited<?php echo $cnt; ?>"> <input type="button" value="Edit" id="editt<?php echo $cnt; ?>" onclick="Editdata('<?php echo $cnt; ?>','<?php echo $row[17]; ?>');"></div>-->
	
			 <?php // if($row[8]!='0000-00-00'){ echo date("d/m/Y",strtotime($row[8])); }else{ echo "NA"; } ?>
			 </td>
             <td><?php echo $row[9]; ?></td>
             <td><?php echo $row[10]; ?></td>
             <!--<td><?php echo $row[17]; ?></td>-->
             <td><?php echo $ro[0]; ?></td>
			   			 			              
				  <td>
				  
				  <a href="editbill.php?reqid=<?php echo $row[11]; ?>&cid=<?php echo $cid; ?>&page=update" target="_self">Edit Details</a><br>
				  
				  <div id="out<?php echo $cnt; ?>"><div id="paid<?php echo $cnt;  ?>"><a href="#" onclick="show('edtpaid<?php echo $cnt;  ?>');">Update</a></div>
<div id="edtpaid<?php echo $cnt;  ?>" style="display:none;">Paid Amt:<input type="text" name="pamt<?php echo $cnt;  ?>" id="pamt<?php echo $cnt;  ?>" value="<?php echo $row[5]; ?>"><br>
Reconnection Charge:<input type="text" name="recon_chrg<?php echo $cnt;  ?>" id="recon_chrg<?php echo $cnt;  ?>" value="<?php echo $row['recon_chrg']; ?>" onkeypress="return isNumberKey(event);" /><br>
Disconnection Charge:<input type="text" name="discon_chrg<?php echo $cnt;  ?>" id="discon_chrg<?php echo $cnt;  ?>" value="<?php echo $row['discon_chrg']; ?>" onkeypress="return isNumberKey(event);" /><br>
Security Deposit:<input type="text" name="sd<?php echo $cnt;  ?>" id="sd<?php echo $cnt;  ?>" value="<?php echo $row['sd']; ?>" onkeypress="return isNumberKey(event);" /><br>
After due date charges:<input type="text" name="after_duedt_chrg<?php echo $cnt;  ?>" id="after_duedt_chrg<?php echo $cnt;  ?>" value="<?php echo $row['after_duedt_chrg']; ?>" onkeypress="return isNumberKey(event);" /><br>
Paid Date:<input type="text" name="pdt<?php echo $cnt;  ?>" id="pdt<?php echo $cnt;  ?>" value="" readonly="readonly" onclick="displayDatePicker('pdt<?php echo $cnt;  ?>');"  ><br>
<input type="radio" name='paid<?php echo $cnt;  ?>' id='paid<?php echo $cnt;  ?>' value='paid' checked>&nbsp;Paid &nbsp;<input type="radio" name='paid<?php echo $cnt;  ?>' id='paid<?php echo $cnt;  ?>' value='unpaid' >  Unpaid<br>
Remarks:<input type="text" name="memo<?php echo $cnt;  ?>" id="memo<?php echo $cnt;  ?>" placeholder="memo" ><br>
<input type="button" id="btn<?php echo $cnt;  ?>" value="Enter" onclick="edtpay('<?php echo $cnt;  ?>','<?php echo $row[17]; ?>');"><input type="button" id="canc<?php echo $cnt;  ?>" value="Cancel" onclick="show('edtpaid<?php echo $cnt;  ?>')">
</div></div>
<!--<a href="javascript:void(0);" onclick="newwin('<?php echo "reject_update_paidbill.php?reqid=".$row[17]; ?>','display',600,600)">Reject</a><br>-->
<!--<div id="out1<?php echo $cnt; ?>"><div id="rej<?php echo $cnt;  ?>"><a href="#" onclick="show('edtrej<?php echo $cnt;  ?>');">Reject</a></div>
<div id="edtrej<?php echo $cnt;  ?>" style="display:none;">
	Email :<input type="text" name="rejemail<?php echo $cnt;  ?>" id="rejemail<?php echo $cnt;  ?>" value="<?php //echo $row[5]; ?>"><br>
	CCEmail :<textarea name="rejccemail<?php echo $cnt;  ?>" id="rejccemail<?php echo $cnt;  ?>"></textarea><br>
	Reason :<br/>
	<input type="radio" name='rejradio<?php echo $cnt;  ?>' id='rejradio<?php echo $cnt;  ?>' value='duplicate' checked>&nbsp;Duplicate &nbsp;<input type="radio" name='rejradio<?php echo $cnt;  ?>' id='rejradio<?php echo $cnt;  ?>' value='false' >  False<br>
	Remarks:<input type="text" name="reason1<?php echo $cnt;  ?>" id="reason1<?php echo $cnt;  ?>" placeholder="Reason" ><br>
	<input type="button" id="btn<?php echo $cnt;  ?>" value="Enter" onclick="reject('<?php echo $cnt;  ?>','<?php echo $row[17]; ?>');"><input type="button" id="canc<?php echo $cnt;  ?>" value="Cancel" onclick="show('edtrej<?php echo $cnt;  ?>')">
</div></div>-->
</td>
		</tr>
		<?php
$cnt=$cnt+1;
}
		}
	
?>
<!--<tr><td>Total</td><td colspan='6' align="right"><?php echo $tot; ?></td></tr>-->
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
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