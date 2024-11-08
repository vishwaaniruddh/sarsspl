<?php
include("config.php");
include("access.php");
	
	session_start();
//include("access.php");
if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="index.php";
</script>
<?php
}
	
	
	
	$qid=$_POST['qid'];
	//echo $qid;
	$qry="";
	
	
	if($_POST['atm']!="")
	{
	$qry="Select * from quotation1 where status!='c' and atm='".$_POST['atm']."'";
	}
	elseif($qid=="" & ($_POST['strdt']!="" & $_POST['endt']!=""))
	{
	$dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
	
	/*echo "Select * from quotation1 where status!='c' and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";*/

	$qry="Select * from quotation1 where status!='c' and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";
	}
	else if($qid!="")
	{

	$qry="Select * from quotation1 where id='".$qid."' and status!='c' ";
	}
	else
	{
       $srdt=date('Y-m-01');
       $erdt=date('Y-m-t');
	
	$qry="Select * from quotation1 where status!='c' and DATE(entrydate)>='".$srdt."' and DATE(entrydate)<='".$erdt."'   ";
	
	}
	

if($_SESSION['custid']!='all')
{

$qry.=" and cust='".$_SESSION['custid']."'";
}

	$nxtdet=$_POST['pnxt'];
if($nxtdet=="0")
{

$qry.=" LIMIT 50 ";
}
else
{

$qry.=" LIMIT 50 OFFSET ".$nxtdet;
}


	$qrys=mysqli_query($con,$qry);
	

echo $qry;
	
	?>
	<input type="hidden" id="expqry" name="expqry" value="<?php echo $qry;?>">
	<input type="submit" id="exp" value="Export To Excel"/>	
	<div id='exptexcl' name="exptexcl" align="center">
	
	<table id='quotdettab' name='quotdettab' width="750" border="2" >
	<th  align="center">Sr No</th>
	<th width="75">Category</th>
	<th style="display:none"  align="center" width="200">Qid</th>
	<th  align="center">Made By</th>
	<th  align="center" width="200">Quotation ID</th>
	<th  align="center">Customer</th>
	<th  align="center">Atm</th>
	<th  align="center">Bank</th>
	<th  align="center">Location</th>
	<th  align="center">Work Details</th>
	<th align="center">Amount</th>
	<th align="center">Approved Amount</th>
	<th align="center">Approved By</th>
		<th align="center">Approved Date</th>
	<th align="center">Attatchment</th>
	<th  align="center">View Quotation</th>
	<th  align="center">Edit Quotation</th>
	<th  align="center">History</th>
	<th  align="center">Status</th>
	
	
				
	<?php
	$srno=1;
	
	$totamt=0;
	$apptotamt=0;
	while($row=mysqli_fetch_array($qrys))
	{
	   //echo "select sum(Total) where qid='".$row[0]."'";
	   $getamt=mysqli_query($con,"select sum(Total) from quotation_details where qid='".$row[0]."'");
	   $tamt=mysqli_fetch_array($getamt);
	   
	    $ckhis=mysqli_query($con,"select qid from quotation_edit_history where qid='".$row[0]."' limit 0,1");
	  $hisv=mysqli_num_rows($ckhis);
	  
	  $mdby=mysqli_query($con,"select username from login where srno='".$row[9]."'");
	  $mdrow=mysqli_fetch_array($mdby);
	  
	?>
	<tr>
	    <td  align="center" width="50">
	       <?php echo  $srno; ?> 
	    </td>
	    
	     <td align="center"><?php if($row[12]=="a"){ echo "Approval Basis"; }elseif($row[12]=="f"){echo "Fixed Cost"; };?></td>
	     
	     <td style="display:none"  align="center" width="150">
	       <input type="text" id="qid<?php echo $srno?>" name="qid" value="<?php echo  $row[0]; ?>" onclick="alert(this.id);" readonly="readonly">
	       
	    </td>
	    
	   
	    
	    <td>
	    
	      <?php echo $mdrow[0]." ".date( 'd/m/Y g:i A', strtotime($row[10])); ?>
	    
	     </td>
	    <?php 
                  $qrynm=mysqli_query($con,"select cust_name from  $row[2]_sites where cust_id='".$row[2]."' ");
                  $qname=mysqli_fetch_array($qrynm);
                 // $nm=explode('/',$row[1]);
              ?>
	    
	    <td  align="center" >
	        <?php echo  $row[1]; ?>
	       
	    </td> 
	
	
	    <td  align="center" width="150">
	       <input type="text" style="width:65px" id="customer<?php echo $srno ?>" value="<?php echo  $qname[0]; ?> " readonly="readonly"/>
	    </td> 
	   
	  
	    
	    
	    
	    <td  align="center" width="150">
	       <?php echo  $row[3]; ?> 
	    </td> 
	    
	     <td  align="center" width="150">
	       <?php echo  $row[4]; ?> 
	    </td> 
	
	
	 <td  align="center" width="150">
	       <?php echo  $row[6]; ?> 
	    </td>
	    
	       <td  align="left" width="150">
	       <?php 
	       $gwrdet=mysqli_query($con,"select description from quotation_details where qid='".$row[0]."'");
	       while($rdet=mysqli_fetch_array($gwrdet))
	       {
	       
	       echo $rdet[0].",";
	       }
	       
	        ?> 
	    </td>
	
	
	
	
	
	
	  <td  align="center" width="150">
	       <?php echo  round($tamt[0]); $totamt=$totamt+round($tamt[0]); ?> 
	    </td> 
	
	 <td  align="center" width="150">
	   <?php 
	   $rowamt="";
	      if($row[11]=='a' || $row[11]=='app' )
	      {
	      $amtqry=mysqli_query($con,"select app_amt,filename,app_by,approved_date from quotation_approve_details where qid='".$row[0]."'");
	      $rowamt=mysqli_fetch_array($amtqry);
	      echo round($rowamt[0]);
	      $apptotamt=$apptotamt+round($rowamt[0]);
	      }
	      
	   ?> 
	       
	    </td> 
	    
	     <td align="center">
              <?php echo $rowamt[2];?>     
         </td>
	<td align="center">
	<?php 
	if($rowamt[3]!="0000-00-00")
	{
	echo date("d-m-Y",strtotime($rowamt[3]));
	}
	?>
	</td>
	
            <td align="center">


                               <?php if($rowamt[1]!="")
  {
 ?>
 <a href='quotuploads/approve/<?php echo $rowamt[1]; ?>' download>Download</a>
 <?php
 }
 ?>

            </td>
	
	
	
	
	 <td  align="center" width="150">
	       <input type="button" name="vdet" id="vdet<?php echo $srno?>" value="View Details" onclick="vdtefunc(this.id);">
	    </td> 
	    
	    <td  align="center" width="150">
	    <?php 
	    if($row[11]=='y' )
	    {
	    ?>
	        <input type="button" name="editq" id="editq<?php echo $srno?>" value="Edit" onclick="editfunc(this.id);">
	        <?php }?>
	    </td> 
	    
	    <td  align="center" width="150">
	   <?php if($hisv!=0)
	    {?>
	        <input type="button" name="vhis" id="vhis<?php echo $srno?>" value="View History" onclick="vhisfunc(this.id);">
	       <?php } ?>
	    </td> 
	    
	    <td width="150"><?php if($row[11]=='y'){ echo "Pending"; }elseif($row[11]=='a'){ echo "Approve By"; }elseif($row[11]=='app'){echo "Approved";} ?></td>
	
	    
	    
	     
	  
	</tr>
	<?php 
	
	$srno++;
	}
	
	?>
	
	
	
	<tr height="40">
	<td colspan="9" align="center">Total</td>
	<td align="center"><b><?php echo round($totamt); ?><b></td>
	<td align="center"><b><?php echo round($apptotamt); ?><b></td>
	</tr>
	
	
	
	
	</table>
	
	<input type="button" id="nxt" value="next" onclick="func();">
	</div>