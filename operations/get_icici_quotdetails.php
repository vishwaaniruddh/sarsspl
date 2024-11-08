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
	$qry="Select * from quotation1 where status!='c'";
	
	 if($_POST['location']!="")
       {
       
       $qry.=" and location LIKE '%".$_POST['location']."%'";
       }
     

       if($_POST['cust']!="")
       {
       
       $qry.=" and cust='".$_POST['cust']."'";
       }
     // echo $_POST['pono'];
         if($_POST['pono']!="")
	{

	$qry.="and id in(select qid from quotation_approve_details where po='".$_POST['pono']."' ) ";
	  }  



	if($qid!="")
	{

	$qry.="and quot_id LIKE'"."%".$qid."%"."' ";
	 }
         
       elseif($_POST['atm']!="")
        {
         $qry.="and atm='".$_POST['atm']."' ";
         }

      elseif($_POST['strdt']!="" & $_POST['endt']!="")
       {
         $dt1=str_replace("/","-",$_POST['strdt']);
	 $start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
           
        $qry.=" and DATE(entrydate)>='".$start."' and DATE(entrydate)<='".$end."'   ";
   
       }
	else
	 {
       $srdt=date('Y-m-01');
       $erdt=date('Y-m-t');
	
	$qry.=" and DATE(entrydate)>='".$srdt."' and DATE(entrydate)<='".$erdt."'   ";

	
     }
	

if($_POST['typ']!="-1")
{

 $qry.="and category='".$_POST['typ']."' ";
}
	

echo $qry;
	$qrys=mysqli_query($con,$qry);
	
	
	?>
	<input type="hidden" id="expqry" name="expqry" value="<?php echo $qry;?>">
	<input type="submit" id="exp" value="Export To Excel"/>	
	
	
	
	<table id="apptab" border="2">
	<th  align="center">Sr No</th>
	<th width="75">Category</th>
	<th style="display:none" >Qid</th>
	<th  align="center">Made By</th>
	<th  align="center">Quotation ID</th>
	<th  align="center">Customer</th>
	<th  align="center">Sol ID</th>
	<th  align="center">Bank</th>
	<th  align="center" style="width:450px">Location</th>
	<th  align="center">City</th>
	<th  align="center">State</th>

	<th  align="center">Work Details</th>
	<th align="center">Amount</th>
	<th align="center">Approved Amount</th>
	<th align="center">Required Amount</th>
        <th align="center">Approved By</th>
        <th align="center">Approved Date</th>
	<th align="center">Attatchment</th>
	<th align="center">PO Number</th>
	<th  align="center">View Quotation</th>
	<th  align="center">Edit Quotation</th>
	<th  align="center">Approve Quotation</th>
		
	<th  align="center">History</th>
	<th  align="center">Status</th>
	<th  align="center">Call Status</th>	
      <th  align="center">Call Status History</th>	
	<th  align="center">Cancel Quotation</th>	
	 
				
	<?php
	$srno=1;
	$totamt=0;
	$apptotamt=0;
       $reqamttot=0;
	while($row=mysqli_fetch_array($qrys))
	{
	   //echo "select sum(Total) where qid='".$row[0]."'";
	   $getamt=mysqli_query($con,"select sum(amt) from icici_quot_details where qid='".$row[0]."'");
	   $tamt=mysqli_fetch_array($getamt);
	   
	    $ckhis=mysqli_query($con,"select qid from quotation_edit_history where qid='".$row[0]."' limit 0,1");
	  $hisv=mysqli_num_rows($ckhis);
	  
	  $mdby=mysqli_query($con,"select username from login where srno='".$row[9]."'");
	  $mdrow=mysqli_fetch_array($mdby);
 
         $podet=mysqli_query($con,"select po from quotation_approve_details where qid='".$row[0]."'");
	  $porow=mysqli_fetch_array($podet);
	  
	  
	?>
	<tr>
	    <td  align="center" width="50">
	       <?php echo  $srno; ?> 
	    </td>
	     
	      <td align="center"><?php if($row[12]=="a"){ echo "Approval Basis"; }elseif($row[12]=="f"){echo "Fixed Cost"; }else{ echo "Po Basis";};?></td>
	     
	     <td style="display:none"  align="center" width="150">
	       <input type="text"  id="qid<?php echo $srno?>" name="qid" value="<?php echo  $row[0]; ?>" onclick="alert(this.id);" readonly="readonly">
	       
	    </td> 
	    
	    <td>
	    
	      <?php echo $mdrow[0]." ".date( 'd/m/Y g:i A', strtotime($row[10])); ?>
	    
	     </td>
	    
	    
	    
	    
	    
	    
	    
	    <td  align="center" style="width:180px">
	       <?php echo  $row[1]; ?>
	       
	    </td> 
	
	
	<td  align="center" width="80">
	      <?php echo  $row[2]; ?>
	    </td> 
	
	   
	    
	    
	    
	    <td  align="center" width="150">
	       <?php echo  $row[3]; ?> 
	    </td> 
	    
	     <td  align="center" width="150">
	       <?php echo  $row[4]; ?> 
	    </td> 
	
	     <td  align="center" style="width:450px">
	       <?php echo  $row[6]; ?> 
	    </td>
	    
	    
	    <td  align="center" width="150">
	       <?php echo  $row[7]; ?> 
	    </td>
	    
	    <td  align="center" width="150">
	       <?php echo  $row[8]; ?> 
	    </td>
	    
	    
	       <td  align="left" width="150">
	           
	         <table width="300" border='2' valign="top">
<?php

$qdetc=mysqli_query($con,"select * from icici_quot_details where qid='".$row[0]."'");
 while($gdetca=mysqli_fetch_array($qdetc))
 {
?>
<tr>
<td>
<?php echo $gdetca[2];?>
</td>

<td>
<?php echo $gdetca[3];?>
</td>

<td>
<?php echo $gdetca[4];?>
</td>

<td>
<?php echo $gdetca[5];?>
</td>

<td>
<?php echo $gdetca[6];?>
</td>

<td>
<?php echo $gdetca[7];?>
</td>

<td>
<?php echo $gdetca[8];?>
</td>

<td>
<?php echo $gdetca[9];?>
</td>



</tr>


<?php
$str++;
 }

  


 ?>

</table>




	    </td>
	     
	
	  <td  align="center" width="150">
	       <?php echo  round($tamt[0]); $totamt=$totamt+round($tamt[0]);?> 
	    </td> 
	    
	    <td  align="center" width="150">
	   <?php 
             $rowamt="";
	      if($row[11]=='a' || $row[11]=='app' )
	      {
	      $amtqry=mysqli_query($con,"select app_amt,filename,app_by,approved_date,req_amt from quotation_approve_details where qid='".$row[0]."'");
	      $rowamt=mysqli_fetch_array($amtqry);
	      echo round($rowamt[0]);
	       $apptotamt=$apptotamt+round($rowamt[0]);
	      }
	      
	   ?> 
	       
	    </td> 


<td align="center"> <?php echo round($rowamt[4]); $reqamttot=$reqamttot+round($rowamt[4]); ?></td>

 
         <td align="center">
              <?php echo $rowamt[2];?>     
         </td>

            
            
            <td align="center">
	<?php 
	
	if($row[11]=='a' || $row[11]=='app' )
	      {
	if($rowamt[3]!="0000-00-00")
	{
	echo date("d-m-Y",strtotime($rowamt[3]));
	}
	}
	?>
	</td>
	
            <td align="center">
            


                               <?php if($rowamt[1]!=""){ 
  
 ?>
 <a href='quotuploads/approve/<?php echo $rowamt[1]; ?>' download>Download</a>
 <?php
 }
 ?>

            </td>

<td  align="center" width="150">
 <?php echo $porow[0];?>
             
	 </td> 
	 <td  align="center" width="150">
	       <input type="button" name="vdet" id="vdet<?php echo $srno?>" value="View" onclick="vdtefunc(this.id);">
	    </td> 
	    
	    
	    
	     <td  align="center" width="150">
	    <?php 
	    if($row[11]=='y' & $row[18]=='0' )
	    {
	    ?>
	        <input type="button" name="editq" id="editq<?php echo $srno?>" value="Edit" onclick="editfunc(this.id);">
	        <?php }?>
	    </td> 
	    
	    
	    
	    
	    <td  align="center" width="150">
	    <?php 
                $chnewq=mysqli_query($con,"select req_amt from quotation_approve_details where qid='".$row[0]."'");
               $chnewrow=mysqli_fetch_array($chnewq);
	    if(round($chnewrow[0])=='0')
	    {
	    ?>
	        <input type="button" name="updq" id="updq<?php echo $srno?>" value="Approve" onclick="qappfunc(this.id);">
	        
	        <?php }?>
	    </td> 
	    
	   
	    
	    
	    
	    
	    <td  align="center" width="150">
	   <?php if($hisv!=0)
	    {?>
	        <input type="button" name="vhis" id="vhis<?php echo $srno?>" value="View History" onclick="vhisfunc(this.id);">
	       <?php } ?>
	    </td> 
	    
	    
	<td width="150"><?php if($row[11]=='y'){ echo "Pending"; }elseif($row[11]=='a'){ echo "Approve By"; }elseif($row[11]=='app'){echo "Approved";} ?></td>
	    
	    <td  align="center" width="150"><?php if($row[16]=="0"){echo "Opened"."<br>";?> <input type="button" name="closeq" id="closeq<?php echo $srno?>" value="Close" onclick="closefunc(this.id);">  <?php }else{ echo "Closed"; }?></td>
	     
	  
	  <td width="250" align="center" >
	  
	  <?php if($row[16]=="1")
	  {
	 // echo "select * from quotaion_close_detail where qid='".$row[0]."'";
	  $gqhis=mysqli_query($con,"select * from quotation_close_detail where qid='".$row[0]."'");
	  $ghrw=mysqli_fetch_array($gqhis);
	  $qcdt=date("d-m-Y",strtotime($ghrw[2]));
	   echo $qcdt."<br>".$ghrw[3]."<br>".$ghrw[4];
              if($ghrw[7]!="")
              {

     ?>
 <a href='quotuploads/close/<?php echo $ghrw[7]; ?>' download>Download</a>
 <?php

               }
	  
	  
	  }
	  
	  ?>
	  
	  
	  
	  
	  </td>
	  
 </td>
	  
  <td><input type="button" name="cancelquot" id="cancelquot<?php echo $srno?>" value="Cancel Quotation" onclick="cancqfunc(this.id);"/></td>

<!--<td><?php if($row[18]=='0' & $row[19]=='0') {?><input type="button" name="trans" id="trans<?php echo $srno?>" value="Transfer to vijay" onclick="transfunc(this.id);"/>
<?php 

}?>
</td>-->



	</tr>
	<?php 
	
	$srno++;
	}
	?>
	
	
	<tr height="40">
	<td colspan="11" align="center">Total</td>
	<td align="center"><b><?php echo round($totamt); ?><b></td>
	<td align="center"><b><?php echo round($apptotamt); ?><b></td>
        <td align="center"><b><?php echo round($reqamttot); ?><b></td>

	</tr>
	
	
	
	
	
	</table>