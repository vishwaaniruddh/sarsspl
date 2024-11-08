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
	
	$qry1="select * from quotation1 where status!='c' ";
// echo $_POST['sup'];




        if($_POST['accname']!="-1" && $_POST['accname']!="" )
	{
	$qry1.=" and reqby='".$_POST['accname']."'";
	
	}


if($_POST['cst']!="")
	{
	$qry1.=" and cust='".$_POST['cst']."'";
	
	}
	if($_POST['sup']!="-1")
	{
	$qry1.=" and supervisor='".$_POST['sup']."'";
	
	}

if($_POST['atms']!="")
	{
	$qry1.=" and atm='".$_POST['atms']."'";
	
	}



if($_POST['bank']!="0")
	{
	$qry1.=" and bank='".$_POST['bank']."'";
	
	}

	if($_POST['strdt']!="" & $_POST['endt']!=""  )
	{
 
                $sdate=str_replace("/","-",$_REQUEST['strdt']);
                 $strt=date("Y-m-d",strtotime($sdate));

                 $edate=str_replace("/","-",$_REQUEST['endt']);
                 $endt=date("Y-m-d",strtotime($edate));
	//$qry1.=" and pdate>='".$strt."' and pdate<='". $endt."'";

          $qry1.=" and id in (Select qid from quotation1ftransfers where status!='0' and date(entrydt)>='".$strt."' and date(entrydt)<='". $endt."')";
	
	}
 else
{
$qry1.=" and id in (Select * from quotation1ftransfers where status!='0' )";
}
	
	
	
	
	$table=mysqli_query($con,$qry1);

$Num_Rows = mysqli_num_rows ($table);






//echo $qry1;
	$qrys=mysqli_query($con,$qry1);
	
	
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
	

	
	$qry1.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con,$qry1);
//	echo $qry1;	
	?>











	<input type="hidden" id="expqry" name="expqry" value="<?php echo $qry1;?>">
	<input type="submit" id="exp" value="Export To Excel"/>
	
	
	
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
	
	<th align="center">Amount</th>
	<th align="center">Approved Amount</th>
      <th align="center">Required Amount</th>
        <th align="center">Approved By</th>
                <th align="center">Approved Date</th>
	<th align="center">Attatchment</th>
	<th  align="center">View Quotation</th>
	<th  align="center">Beneficiary Name</th>
        <th  align="center">Beneficiary Account No</th>
		
	<!---<th  align="center">History</th>
	<th  align="center">Status</th>
	<th  align="center">Call Status</th>	
      <th  align="center">Call Status History</th>	

	<th  align="center">Approve</th>	-->
	
	<th align="center">Transferred Date</th>
        <th align="center">Transferred Amount</th>
	<th align="center">Cheque No</th>
		<th align="center">Ticket No/Job ID/PO_No</th>
		
	
				
	<?php

	$transamttot=0;
	$srno=1;
	$totamt=0;
	$apptotamt=0;
           $reqamtot=0;
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
	     $custname="";
	    if($row[2]=='ICICI' || $row[2]=='RATNAKAR' || $row[2]=='ICICI_Direct' || $row[2]=='Knight_Frank' )
                {

	       $custname=$row[2];
	       }
	       else
	       {
                  $qrynm=mysqli_query($con,"select cust_name from  $row[2]_sites where cust_id='".$row[2]."' ");
                  $qname=mysqli_fetch_array($qrynm);
                  $custname=$qname[0];
                 // $nm=explode('/',$row[1]);
                 }
              ?>
	    
	    
	    
	    
	    <td  align="center" style="width:180px">
	       <?php echo  $row[1]; ?>
	       
	    </td> 
	
	
	<td  align="center" width="80">
	       <input type="text" style="width:60px;" id="customer<?php echo $srno ?>" value="<?php echo  $custname; ?> " readonly="readonly"/>
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
	<?php

if($row[2]=='ICICI' || $row[2]=='RATNAKAR' || $row[2]=='ICICI_Direct' || $row[2]=='Knight_Frank' )
{
?>
<table border='1'>
<?php
$qdetici=mysqli_query($con,"select * from icici_quot_details where qid='".$row[0]."'");
 while($gdetca2=mysqli_fetch_array($qdetici))
 {
 ?>
<tr>

  <td width="100"><?php echo $gdetca2[2];?></td>
  <td width="100"><?php echo $gdetca2[3];?></td>
<td width="200"><?php echo $gdetca2[4];?></td>
<td width="100"><?php echo $gdetca2[5];?></td>
<td width="100"><?php echo $gdetca2[6];?></td>
<td width="100"><?php echo $gdetca2[7];?></td>
<td width="100"><?php echo $gdetca2[8];?></td>
<td width="100"><?php echo $gdetca2[9];?></td>


</tr>
<?php
}
?>
</table>
<?php
 } 
 else
{
 ?>
 <table >
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
  <tr><td width=""><?php echo "(".$str.")".$gparta[3];?></td>
<td  align="left"><?php echo "(".$gparta[4]."*".round($gparta[5]).")" ;?></td>
</tr>

<?
$str++;
 }

  
 }
?>
</table>
<?php
}?>

  
	      </td>





	
	     
	
	  <td  align="center" width="150">
	      <?php
            if($row[2]=='ICICI' || $row[2]=='RATNAKAR' || $row[2]=='ICICI_Direct' || $row[2]=='Knight_Frank' )
            {
          
           $icitot=mysqli_query($con,"select sum(amt) from icici_quot_details where qid='".$row[0]."'");
           $gicictot=mysqli_fetch_array($icitot);

             
             echo  round( $gicictot[0]); $totamt=$totamt+round( $gicictot[0]);
	       
            }
            else
            { 
            
            
 echo  round($tamt[0]); $totamt=$totamt+round($tamt[0]);

            }  
            ?>
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


            <td align="center">
              <?php 
           /* $greamt=mysqli_query($con,"select req_amt from quotation1_req where qid='".$row[0]."'");
            $reqamtw=mysqli_fetch_array($greamt);*/
               echo round($rowamt[4]); $reqamtot=$reqamtot+round($rowamt[4]);  
              ?>
              

            </td>
         

 
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
                      <a href='../operations/quotuploads/approve/<?php echo $rowamt[1]; ?>' download>Download</a>
                           <?php
                           }
                       ?>

            </td>
             
	
	 <td  align="center" width="150">
	       <input type="button" name="vdet" id="vdet<?php echo $srno?>" value="View" onclick="vdtefunc(this.id);">
	    </td> 
	    
	
	  	 <td  align="center" width="150">
	      <?php 
	      if($row[17]!="" && $row[17]!="-1")
          {
             $sup2=mysqli_query($con,"select hname,accno from fundaccounts where aid='".$row[17]."'");
	    $sname2=mysqli_fetch_array($sup2);
	     echo $sname2[0];
             }
             else
             {
             $sup1=mysqli_query($con,"select chq_name from quotation1ftransfers where qid='".$row[0]."'");
	    $sname1=mysqli_fetch_array($sup1);
	   // echo "select supervisor from quotation1ftransfers where qid='".$row[0]."'";
	     
             echo $sname1[0];
             }

              
               ?>
	    </td> 
	   
             <td  align="center" width="150">
	       <?php 
               echo $sname2[1];
               ?>
	    </td>
	   
	    
	    
	    
	  
	  
	 
	
           
<td width="250" align="center" >
	
<?php $trandate=mysqli_query($con,"select * from  quotation1ftransfers where qid='".$row[0]."'");
$tdarow=mysqli_fetch_array($trandate); ?>

<?php if($tdarow[3]!='0000-00-00') { echo date('d-m-Y',strtotime($tdarow[3])); } ?>


</td>

<td width="250" align="center" >
	  
<?php echo round($tdarow[7]); $transamttot=$transamttot+round($tdarow[7]); ?>


</td>
<td width="250" align="center" >
	  
<?php echo $tdarow[5]; ?>


</td>
<?php

 $amtqry1=mysqli_query($con,"select ticket_no,job,po from quotation_approve_details where qid='".$row[0]."'");
	      $rowamt1=mysqli_fetch_array($amtqry1);


?>

<td><?php echo $rowamt1[0]; echo $rowamt1[1];   echo $rowamt1[2];?></td>

	  
	</tr>
	<?php 
	
	$srno++;


}
	?>
	
	
	<tr height="40">
	<td colspan="11" align="center">Total</td>
	<td align="center"><b><?php echo round($totamt); ?><b></td>
	<td align="center"><b><?php echo round($apptotamt); ?><b></td>
      
       <td align="center"><b><?php echo round($reqamtot); ?><b></td>
        <td colspan="7" align="center"></td>
<td align="center"><b><?php echo round($transamttot); ?><b></td>



        
	</tr>
	
             

           
	
	
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


</div>

<?php 
}
?>








