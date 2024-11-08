<?php
include("config.php");
include("access.php");
	
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{


$strPage = $_POST['Page'];
$qry="SELECT * FROM `ebillfundrequests` where req_no='".$_POST['reqid']."'";
	


//echo $qry;
$table=mysqli_query($con,$qry);

$Num_Rows = mysqli_num_rows ($table);


	
	
	?>
	
	
	<div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="func('1','perpg');">
 
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
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
$Page = $strPage;
if($strPage=="")
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
	


$qry.=" ORDER BY cust_id ASC ";
	
	$qry.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con,$qry);
//	echo $qry;	
	?>

	
	<table id="tableexport" name="tableexport" border="2">
	<th  align="center">SL NO</th>
	<th width="75">Client</th>
	<th >Vendor Name</th>
	<th >Reqby</th>
	<th  align="center">BAU/MOF</th>
	<th  align="center">Bank Name</th>
	<th  align="center">ATM ID</th>
	<th  align="center">Site ID</th>
	<th  align="center">Old Atm id</th>
	<th  align="center">IIND ATM ID</th>
	<th  align="center">Location</th>
	<th  align="center">Address</th>
	<th  align="center">City</th>
	<th  align="center">State</th>
       <th  align="center">Zone</th>
         <th  align="center">Onsite/Offsite</th>
	<th align="center">Consumer Name</th>
	<th align="center">Consumer No.</th>
          <th align="center">Billing Unit</th>
         <th align="center">Unit No./meter no./tn.no./section</th>
      <th align="center">Energy Provider</th>
        <th align="center">Mode of Payment</th>
                <th align="center">Bill Period From</th>
                <th align="center">Bill Period To</th>
	<th align="center">Number of Months</th>
	<th  align="center">Total Unit Consumed </th>	
	<th  align="center">Rate per Unit (ONLY FOR SUBMETER)</th>
	<th  align="center">Bill Date</th>
	<th  align="center">Due Date</th>
	<th  align="center">Disconnection Date</th>	
      <th  align="center">Bill Amount</th>
	<th  align="center">Penalty / Surcharges/other charges</th>
	<th  align="center">Actual Paid (Amount)</th>
	<th  align="center">Paid Date</th>
	<th  align="center">Payment Receipt Number</th>
	<th  align="center">Generation of Payment</th>
		<th  align="center">Remark</th>
	<th  align="center">CARD NAME</th>
	<th  align="center">Supervisor Name</th>
	<th  align="center">Regional Name</th>
	<th align="center">Edit</th>

	
				
	<?php
		$numcalc=$Page*$Per_Page;

				$srno=$numcalc-($Per_Page-1);
	//$srno=1;
	$totamt=0;
	$apptotamt=0;
        $reqtotamt=0;
       $requotamt=0;
	while($row=mysqli_fetch_array($qrys))
	{
           
	//echo "select * from  ".$row['cust_id']."_sites where atm_id1='".$row['atmid ']."'";
	   $getatmdets=mysqli_query($con,"select * from  ".$row['cust_id']."_sites where atm_id1='".$row['atmid']."'");
	   $atmdetsrow=mysqli_fetch_array($getatmdets);
	   
	   $getatmdets2=mysqli_query($con,"select * from  ".$row['cust_id']."_ebill where atm_id='".$row['atmid']."'");
	   $atmdetsrow2=mysqli_fetch_array($getatmdets2);
	    
	    
	    $getebpaymentdets=mysqli_query($con,"select * from  ebpayment where Bill_No='".$row['req_no']."'");
	   $paydetsrow=mysqli_fetch_array($getebpaymentdets);
	  
	?>
	<tr>
	    <td  align="center" width="50">
	       <?php echo  $srno; ?> 
	    </td>
	    
	<td  align="center" width="50">
	       <?php echo  $atmdetsrow['cust_name']; ?> 
	    </td>
	
	<td  align="center" width="50">
	       <?php echo "CSS"; ?> 
	    </td>
	 <?php $reqbydets=mysqli_query($con,"select * from login where srno='".$row['reqby']."'"); 
	 $reqbyrws=mysqli_fetch_array($reqbydets);
	 ?>  
	    <td  align="center" width="50">
	       <?php echo $reqbyrws['username']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow['projectid']; ?> 
	    </td>
	    
	     <td  align="center" width="50">
	       <?php echo $atmdetsrow['bank']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow['atm_id1']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow['site_id']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo ''; ?> 
	    </td>
	    
	    
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow['atm_id2']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow['location']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow['atmsite_address']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow['city']; ?> 
	    </td>
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow['state']; ?> 
	    </td>
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow['zone']; ?> 
	    </td>
	    
	     <td  align="center" width="50">
	       <?php echo $atmdetsrow['site_type']; ?> 
	    </td>
	    
	     
	    <td  align="center" width="50">
	       <?php echo ''; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow2['Consumer_No']; ?> 
	    </td>
	    
	    
	    
	    <td  align="center" width="50">
	       <?php echo ''; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo ''; ?> 
	    </td>
	    
	    
	    
	    <td  align="center" width="50">
	       <?php echo $atmdetsrow2['Distributor']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $row['paytype']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo date("d-m-Y",strtotime($row["start_date"])); ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo date("d-m-Y",strtotime($row["end_date"])); ?> 
	    </td>
	    
	   <td  align="center" width="50">
	       <?php echo "0"; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $row['unit']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo ""; ?> 
	    </td>
	    
	    
	    <td  align="center" width="50">
	       <?php echo date("d-m-Y",strtotime($row["bill_date"])); ?> 
	    </td>
	    
	    
	    <td  align="center" width="50">
	       <?php echo date("d-m-Y",strtotime($row["due_date"])); ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo ""; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $paydetsrow['Paid_Amount']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $row['extrachrg']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo round($paydetsrow['Paid_Amount']+$row['extrachrg'],2); ?> 
	    </td>
	
	<td  align="center" width="50">
	       <?php if($paydetsrow['Paid_Date']!="0000-00-00" & $paydetsrow['Paid_Date']!=''){ echo date("d-m-Y",strtotime($paydetsrow['Paid_Date'])); } ?> 
	    </td>
	 
	 
	 <td  align="center" width="50">
	       <?php echo $row['trans_id']; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo ""; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo ""; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo $row['cardname']; ?> 
	    </td>
	 
	 <td  align="center" width="50">
	       <?php echo $row['supervisor']; 
	       $gettfnid=mysqli_query($con,"select aid from fundaccounts where hname='".$row['supervisor']."'");
	       $rwss=mysqli_fetch_array($gettfnid);
	       
	       ?>
	       <input type="text" name="supvorg<?php echo $srno; ?>" id="supvorg<?php echo $srno; ?>" value="<?php echo $rwss[0]; ?>">
	    </td>
	    
	    <td  align="center" width="50">
	       <?php echo ""; ?> 
	    </td>
	    
	    <td  align="center" width="50">
	       <button type="button" onclick="pop('popDiv<?php echo $srno; ?>');" >Transfer To</button>
	       <div id="popDiv<?php echo $srno; ?>" class="ontop" style="display:none;">
    <div id="showrem<?php echo $count; ?>" class="popup">
        <input type="hidden" name="reqid<?php echo $srno; ?>" id="reqid<?php echo $srno; ?>" value="<?php echo $row['req_no']; ?>" readonly>
<table width="100%">

<tr>
<td>
    <select name="sv<?php echo $srno; ?>" id="sv<?php echo $srno; ?>"><option value="">Select</option>
    <?php
     $sup=mysqli_query($con,"select distinct(hname),aid from fundaccounts where status=0 or status='2'  order by hname ASC");
				 while($supro=mysqli_fetch_array($sup))
				{ ?>
				   <option value="<?php echo $supro[1]; ?>" ><?php echo $supro[0]; ?></option>
			   <?php 
                                 } ?>
    </select>
</td>
</tr>
<tr>
    
    <td><input type="button" id="updtbtn<?php echo $srno; ?>" onclick='updtfn(this.id,"<?php echo $row['req_no']; ?>","<?php echo $srno; ?>");' value="Update"></td>
    <td><input type="button" id="canclbtn<?php echo $srno; ?>" onclick="hide('popDiv<?php echo $srno; ?>');" value="Cancel"></td>
    
</tr>
</table>
</div>
</div>
	       
	       
	    </td>
	    
	    
	</tr>
	
         <?php 
         $srno++;
         
         } ?>    

           
	
	
	</table>



<div class="pagination" style="width:100%;"><font size="4" color="#000">
 <?php 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:func('$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:func('$Next_Page','perpg')\">Next >></a> ";
}
?>



<?php } ?>