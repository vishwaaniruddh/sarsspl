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
	
	//echo "hello";
	
	
	$qry="Select * from quotation1 where status!='c'  ";
	
	if($_POST['stat']!="")
	{
	$qry.=" and local_status='".$_POST['stat']."' ";
	
	}
	
	if($_POST['atm']!="")
	{
	$qry.="and atm='".$_POST['atm']."'";
	}
	elseif($_POST['strdt']!="" & $_POST['endt']!="")
	{
	$dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
	
	/*echo "Select * from quotation1 where status!='c' and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";*/

	$qry.=" and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";
	}
	
	
	
	if($_POST['cust']!="")
	{

	$qry.=" and cust='".$_POST['cust']."' ";
	}
        

      if($_POST['accname']!="-1")
	{

	$qry.=" and reqby='".$_POST['accname']."' ";
	}
       
	 if($_POST['type']!="-1")
	{

	$qry.=" and category='".$_POST['type']."' ";
	}





$qry.=" ORDER BY cust ASC ";
	


	/*else
	 {
       $srdt=date('Y-m-01');
       $erdt=date('Y-m-t');
	
	$qry="Select * from quotation1 where status!='c' and DATE(entrydate)>='".$srdt."' and DATE(entrydate)<='".$erdt."'   ";
	
	}*/
	
/*
if($_SESSION['custid']!='all')
{
$qry.=" and cust='".$_SESSION['custid']."'";
}
*/
//echo $qry;
	$qrys=mysqli_query($con,$qry);
	
	
	?>


	<input type="hidden" id="expqry" name="expqry" value="<?php echo $qry;?>">
	<!--<input type="submit" id="exp" value="Export To Excel"/>-->	
	
	
	
	<table id="custtable" name="custtable" border="2">
	<th  align="center">Sr No</th>
	<th width="75">Category</th>
	<th style="display:none" >Qid</th>
	<th  align="center">Made By</th>
	<th  align="center">Quotation ID</th>
	<th  align="center">Customer</th>
	<th  align="center">Atm</th>
	<th  align="center">Bank</th>
	<th  align="center" style="width:450px">Location</th>
	<th  align="center">City</th>
	<th  align="center">State</th>

	<th  align="center">Work Details</th>
	<th  align="center">Beneficiary Name</th>	
	<th align="center">Amount</th>
	<th align="center">Approved Amount</th>
      <th align="center">Required Amount</th>
        <th align="center">Approved By</th>
                <th align="center">Approved Date</th>
	<th align="center">Attatchment</th>
	<th  align="center">View Quotation</th>
	
		
	<th  align="center">History</th>
	<th  align="center">Status</th>
	<th  align="center">Call Status</th>	
      <th  align="center">Call Status History</th>

	
	
				
	<?php
	$srno=1;
	$totamt=0;
	$apptotamt=0;
        $reqtotamt=0;
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
	     
	     <td  style="display:none" align="center" width="150">
	       <input type="text"  id="qid<?php echo $srno?>" name="qid" value="<?php echo  $row[0]; ?>" onclick="alert(this.id);" readonly="readonly">
	       
	    </td> 
	    
	    <td>
	    
	      <?php echo $mdrow[0]." ".date( 'd/m/Y g:i A', strtotime($row[10])); ?>
	    
	     </td>
	    
	    
	    <?php 
                  $qrynm=mysqli_query($con,"select cust_name from  $row[2]_sites where cust_id='".$row[2]."' ");
                  $qname=mysqli_fetch_array($qrynm);
                 // $nm=explode('/',$row[1]);
              ?>
	    
	    
	    
	    
	    <td  align="center" style="width:180px">
	       <?php echo  $row[1]; ?>
	       
	    </td> 
	
	
	<td  align="center" width="80">
	       <input type="text" style="width:60px;border: none;
    background: transparent;" id="customer<?php echo $srno ?>" value="<?php echo  $qname[0]; ?> " readonly="readonly"/>
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
	     <table  >
<?php

$qdetc=mysqli_query($con,"select distinct(particular) from quotation_details where qid='".$row[0]."'");
 while($gdetca=mysqli_fetch_array($qdetc))
 {
?>
<tr><td colspan="2" align="center"><b><?php echo $gdetca[0];?></b></td></tr>
<?php
  $gpart=mysqli_query($con,"select * from quotation_details where particular='".$gdetca[0]."' and qid='".$row[0]."'");
$str='a';
while($gparta=mysqli_fetch_array($gpart))
 {
?>
  <tr><td width="500"><?php echo "(".$str.")".$gparta[3];?></td>
<td  align="left"><?php echo "(".$gparta[4]."*".round($gparta[5]).")" ;?></td>
</tr>

<?
$str++;
 }

  
 }

 ?>

</table>




  
	      </td>





	    <td>
	    
	    <?php 
	    $sup=mysqli_query($con,"select hname from fundaccounts where aid='".$row[17]."'");
	    $sname=mysqli_fetch_array($sup);
	    echo $sname[0];
	    ?>
	    
	    
	    </td>
	     
	
	  <td  align="center" width="150">
	       <?php echo  round($tamt[0]); $totamt=$totamt+round($tamt[0]);?> 
	    </td> 
	    
	    <td  align="center" width="150">
	   <?php 
             $rowamt="";
           $nr="";
	      if($row[11]=='a' || $row[11]=='app' )
	      {
	      $amtqry=mysqli_query($con,"select app_amt,filename,app_by,approved_date from quotation_approve_details where qid='".$row[0]."'");
               $nr=mysqli_num_rows($amtqry);
	      $rowamt=mysqli_fetch_array($amtqry);
	      echo round($rowamt[0]);
	       $apptotamt=$apptotamt+round($rowamt[0]);
	      }
	      
	   ?> 
	       
	    </td> 


            <td align="center">
              <?php 
            $greamt=mysqli_query($con,"select req_amt from quotation1_req where qid='".$row[0]."'");
            $reqamtw=mysqli_fetch_array($greamt);
               echo round($reqamtw[0]);
             $reqtotamt=$reqtotamt+round($reqamtw[0]);
              ?>
              

            </td>
         

 
         <td align="center">
              <?php echo $rowamt[2];?>     
         </td>

            
            
            <td align="center">
	<?php 
	
	if($nr>0 & ($row[11]=='a' || $row[11]=='app'))
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
                      <a href='../operations/quotuploads/approve/<?php echo $rowamt[1]; ?>' download>Download</a>
                           <?php
                           }
                       ?>

            </td>
             
	
	 <td  align="center" width="150">
	       <input type="button" name="vdet" id="vdet<?php echo $srno?>" value="View" onclick="vdtefunc(this.id);">
	    </td> 
	    
	 
	    
	   
	    
	    
	    
	    
	    <td  align="center" width="150">
	   <?php if($hisv!=0)
	    {?>
	        <input type="button" name="vhis" id="vhis<?php echo $srno?>" value="View History" onclick="vhisfunc(this.id);">
	       <?php } ?>
	    </td> 
	    
	    
	<td width="150"><?php if($row[11]=='y'){ echo "Pending"; }elseif($row[11]=='a'){ echo "Approve By"; }elseif($row[11]=='app'){echo "Approved";} ?></td>
	    
	   <td  align="center" width="150"><?php if($row[16]=="0"){echo "Opened";}else{ echo "Closed"; }?></td>
	     
	  
	  <td width="250" align="center" >
	  
	  <?php if($row[16]=="1")
	  {
	 // echo "select * from quotaion_close_detail where qid='".$row[0]."'";
	  $gqhis=mysqli_query($con,"select * from quotation_close_detail where qid='".$row[0]."'");
	  $ghrw=mysqli_fetch_array($gqhis);
	  $qcdt=date("d-m-Y",strtotime($ghrw[2]));
	   echo $qcdt."<br>".$ghrw[3]."<br>".$ghrw[4];
	  
	  
	  }
	  
	  ?>
	  
	  
	  
	  
	  </td>
	  
	 
	

       


           <?php

if($_SESSION['designation']=="6" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='5')

{



	 
	
	 ?>  

          
   <td><input type="button" name="trv" id="trv<?php echo $srno;?>" value="Update" onclick="transdiv(this.id);" >
<div id="trdiv<?php echo $srno?>" style="display:none">
<label>Required amount</label><br>
<input type="text" name="trreqamt<?php echo $srno?>" id="trreqamt<?php echo $srno?>" /><br>

<label>Voucher No</label><br>
<input type="text" name="vcno<?php echo $srno?>" id="vcno<?php echo $srno?>" /><br>

<label>Supervisor</label><br>
<select name="sv<?php echo $srno?>" id="sv<?php echo $srno?>">
<option value="-1">Select</option>
   <?php
 //  $sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");
 $sup=mysqli_query($con,"select hname,aid,accno from fundaccounts where status=0 order by hname ASC");
 
    
	 while($supro=mysqli_fetch_array($sup))
	{ ?>
	   <option value="<?php echo $supro[1]; ?>" <?php if($row[17]==$supro[1]){echo "selected";} ?>><?php echo $supro[0]."/".$supro[2]; ?></option>
   <?php } ?>  
    </select>


<input type="button" name="transfer" id="transfer<?php echo $srno?>" value="Submit" onclick="transfunc(this.id);"/>

</div>


 </td>

             <?php } 
 

             ?>

	  
	</tr>
	<?php 
	
	$srno++;
	}
	?>
	
	
	<tr height="40">
	<td colspan="12" align="center">Total</td>
	<td align="center"><b><?php echo round($totamt); ?><b></td>
	<td align="center"><b><?php echo round($apptotamt); ?><b></td>
       <td align="center"><b><?php echo round($reqtotamt); ?><b></td>


 
	</tr>
	
             

           
	
	
	</table>