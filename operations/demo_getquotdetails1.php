<?php
include("config.php");
include("access.php");
	
	session_start();
//include("access.php");
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{
$strPage = $_POST['Page'];

$tik_id=$_POST['tik_id'];
$atm=$_POST['atm'];
$bank=$_POST['bank'];
$qid=$_POST['qid'];
$reqby=$_POST['accname'];
$category=$_POST['type'];
$custs=$_POST['cust1']; 
$fundtyp=$_POST['fundtyp'];
$strdt=$_POST['strdt'];
$endt=$_POST['endt'];
$calltyp=$_POST['calltyp'];
$qtst=$_POST['qtst'];

//echo $calltyp;


           $srdt=date('Y-m-01');
           $erdt=date('Y-m-t');
           
        $qry="select * from quotation1 where status!='c'";
         
         if($custs=='all' || $custs=='')
            {
                $qry ="select * from quotation1 where status!='c' and DATE(entrydate)>='".$srdt."' and DATE(entrydate)<='".$erdt."'";
            }
        

         else if($atm=="" & $qid=="" & $reqby=="-1" & $category=="-1"  & $strdt=="" & $endt=="" & $qtst=="" & ($fundtyp=="" || $fundtyp=="-1") & $calltyp=='')
        {
          
	$qry.=" and DATE(entrydate)>='".$srdt."' and DATE(entrydate)<='".$erdt."'   ";
	if($custs!='' && $custs!='-1')
       {
           $qry.=" and cust='". $_POST['cust1']."'";
           }
           
       
           



	}
       else
        {

       if($atm!="")
	{
	$qry.=" and atm='".$atm."'";
	}
         
        if($qid!="")
	{
	$qry.=" and quot_id LIKE '"."%".$qid."%"."'";
	}

        if($reqby!="-1")
	{
	$qry.="and reqby='".$reqby."'";
	}


       if($category!="-1")
	{

	$qry.=" and category='".$category."' ";
	}


      if($custs!='' && $custs!='-1')
       {
           $qry.=" and cust='". $_POST['cust1']."'";
           }

       if($calltyp!='')
       {

           $qry.=" and call_status='".$calltyp."'";
        }

        if($qtst!='')
       {

           $qry.=" and status='".$qtst."'";
        }






        if($strdt!="" & $endt!="")
	{
	$dt1=str_replace("/","-",$strdt);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$endt);
	$end=date('Y-m-d', strtotime($dt2));
	
	/*echo "Select * from quotation1 where status!='c' and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";*/

	$qry.=" and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";
	}else
	{
	    
	     $srdt=date('Y-m-01');
           $erdt=date('Y-m-t');
	$qry.=" and DATE(entrydate)>='".$srdt."' and DATE(entrydate)<='".$erdt."'   ";
	}

         if($fundtyp!='' && $fundtyp!='-1')
       {
           $qry.=" and local_status='0' and (((status='a' or status='app') and category='a') or (status='y' and category='f')) and p_stat='".$fundtyp."'";
           }



    
        }



 if($bank!="0")
       {
           $qry.=" and bank='".$bank."'";
        }

if($tik_id!=""){
$tik=mysqli_query($con,"SELECT qid FROM `quotation_approve_details` where wbs='".$tik_id."' or vpr='".$tik_id."' or prime='".$tik_id."' or  ticket_no='".$tik_id."' or ref_no='".$tik_id."' or job='".$tik_id."' ");
$fetchTik=mysqli_fetch_array($tik);
    
    $qry.=" and id='".$fetchTik['qid']."'";
}


	
	/*
          
if($_SESSION['custid']!='all')
{
$carr=explode(',',$_SESSION['custid']);

$cnt=count($carr);

for($i=0;$i<$cnt;$i++)
{
 if($i==0)
{


$qry.=" and short_name='".$carr[$i]."'";
}
else
{
$qry.=" or short_name='".$carr[$i]."'";

}
}

}
*/


$table=mysqli_query($con,$qry);

$Num_Rows = mysqli_num_rows ($table);





 
      
	$getcalldetcntt="select count(id) from quotation1 where status!='c' and call_status='0' ";
        
        

        $getcalldetcntt1="select count(id) from quotation1 where status!='c' and call_status='1' ";

         
       $totcalldets="select count(id) from quotation1 where status!='c' ";
        
         if($reqby!="-1")
	{
	$getcalldetcntt.="and reqby='".$reqby."'";
        $getcalldetcntt1.="and reqby='".$reqby."'";
        $totcalldets.="and reqby='".$reqby."'";
	}

            if($custs!='' && $custs!='-1')
           {
           $getcalldetcntt.=" and cust='". $_POST['cust1']."'";
           $getcalldetcntt1.=" and cust='". $_POST['cust1']."'";
          $totcalldets.=" and cust='". $_POST['cust1']."'";
            }


if($atm=="" & $qid=="" & $reqby=="-1" & $category=="-1" & $strdt=="" & $endt=="" & ($fundtyp=="" || $fundtyp=="-1") & $calltyp=='')
        {
           $srdtt=date('Y-m-01');
           $erdtt=date('Y-m-t');
	$getcalldetcntt.=" and DATE(entrydate)>='".$srdtt."' and DATE(entrydate)<='".$erdtt."' ";
        $getcalldetcntt1.=" and DATE(entrydate)>='".$srdtt."' and DATE(entrydate)<='".$erdtt."'";
         $totcalldets.=" and DATE(entrydate)>='".$srdtt."' and DATE(entrydate)<='".$erdtt."'";

      // echo $getcalldetcntt;
          //echo $getcalldetcntt1;
	}
	else
       {

          $dtt1=str_replace("/","-",$strdt);
	$startt=date('Y-m-d', strtotime($dtt1));
 
	$dtt2=str_replace("/","-",$endt);
	$endtt=date('Y-m-d', strtotime($dtt2));


         if($strdt!="" & $endt!="")
        {
         $getcalldetcntt.=" and DATE(entrydate)>='".$startt."' and DATE(entrydate)<='".$endtt."' ";
        $getcalldetcntt1.=" and DATE(entrydate)>='".$startt."' and DATE(entrydate)<='".$endtt."'"; 
         $totcalldets.=" and DATE(entrydate)>='".$startt."' and DATE(entrydate)<='".$endtt."'";  
        }


      }



$getcalldetcnt=mysqli_query($con,$getcalldetcntt);
$calldetcntrs=mysqli_fetch_array($getcalldetcnt);


$getcalldetcnt1=mysqli_query($con,$getcalldetcntt1);
        $calldetcnt1=mysqli_fetch_array($getcalldetcnt1);
  

        $tpdetscs=mysqli_query($con,$totcalldets);
        $tocntts=mysqli_fetch_array($tpdetscs);     


 if($custs=='all' || $custs==''){
     
     $totcalldets="select count(*) from quotation1 where status!='c' and DATE(entrydate)>='".$srdt."' and DATE(entrydate)<='".$erdt."'";

        $tpdetscs=mysqli_query($con,$totcalldets);
        $tocntts=mysqli_fetch_array($tpdetscs);
        
        
        $getcalldetcntt="select count(*) from quotation1 where status!='c' and DATE(entrydate)>='".$srdt."' and DATE(entrydate)<='".$erdt."' and call_status='0' ";
        	
        $getcalldetcnt=mysqli_query($con,$getcalldetcntt);
        $calldetcntrs=mysqli_fetch_array($getcalldetcnt);
        
        
        $getcalldetcntt1="select count(*) from quotation1 where status!='c' and DATE(entrydate)>='".$srdt."' and DATE(entrydate)<='".$erdt."' and call_status='1' ";
        
        $getcalldetcnt1=mysqli_query($con,$getcalldetcntt1);
        $calldetcnt1=mysqli_fetch_array($getcalldetcnt1);
     
 }


	?>
<div align="left">
<h2>Total Calls-<?php echo $tocntts[0];?></h2>
<h2>Total Open Calls-<?php echo $calldetcntrs[0];?></h2>
<h2>Total Closed Calls-<?php echo $calldetcnt1[0];?></h2>
</div>
	<div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="func('1','perpg');"><br>
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
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
	


$qry.=" ORDER BY cust ASC ";
	
	$qry.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con,$qry);
	//echo $qry;	
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
	<th  align="center">Atm</th>
	<th  align="center">Bank</th>
	<th  align="center" style="width:450px">Location</th>
	<th  align="center">City</th>
	<th  align="center">State</th>

	<th  align="center">Work Details</th>
	<th  align="center">Beneficiary Name</th>
	<th align="center">Amount</th>
	<th align="center"><b>Expectation Approval Amount</b></th>
	<th align="center">Approved Amount</th>
	<th align="center">Required Amount</th>
        <th align="center">Approved By</th>
        <th align="center">Approved Date</th>
        <th align="center">Remark</th>
	<th align="center">Attatchment</th>
	<th  align="center">View Quotation</th>
	<th  align="center">Edit Quotation</th>
	<th  align="center">Approve Quotation</th>
		
	<th  align="center">History</th>
	<th  align="center">Status</th>
	<th  align="center">Call Status</th>	
      <th  align="center">Call Status History</th>	
	<th  align="center">Cancel Quotation</th>	
        <th  align="center">Transferred Amount</th>
        <th  align="center">Transferred Date</th>
        <th  align="center">Cheque No</th>
         <th  align="center">WBS/VPR/Prime/Tik/Ref_No/JobId</th>
				
	<?php
	$srno=1;
	$totamt=0;
	$apptotamt=0;
       $reqamttot=0;
       $tottransamt=0;
	while($row=mysqli_fetch_array($qrys))
	{
	   //echo "select sum(Total) where qid='".$row[0]."'";


         //echo   $row[0]."</br>";




	   $getamt=mysqli_query($con,"select sum(Total) from quotation_details where qid='".$row[0]."'");
	   $tamt=mysqli_fetch_array($getamt);
	   
	    $ckhis=mysqli_query($con,"select qid from quotation_edit_history where qid='".$row[0]."' limit 0,1");
	  $hisv=mysqli_num_rows($ckhis);
	  
	  $mdby=mysqli_query($con,"select username from login where srno='".$row[9]."'");
	  $mdrow=mysqli_fetch_array($mdby);
	  
          // echo "select tamount,pdate,chqno from quotation1ftransfers where qid='".$row[0]."'";
	  $trdet=mysqli_query($con,"select tamount,pdate,chqno from quotation1ftransfers where qid='".$row[0]."'");
	  $trdrow=mysqli_fetch_array($trdet);
	  
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
	    <!--   <input type="text" style="width:60px;" id="customer<?php echo $srno ?>" value="<?php   echo  $qname[0]; ?> " readonly="readonly"/>
	    -->
	      <input type="text" style="width:60px;" id="customer<?php echo $srno ?>" value="<?php  if($qname[0]=='DLB'){echo 'DLB Branch';}else{  echo  $qname[0];} ?> " readonly="readonly"/>
	   
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
<?php  ?>
<td align="center" width="150">
<?php $gsup=mysqli_query($con,"select hname from fundaccounts where aid='".$row[17]."'");
$supr=mysqli_fetch_array($gsup);

echo $supr[0];
?>

</td>
	     
	
	  <td  align="center" width="150">
	       <?php echo  round($tamt[0]); $totamt=$totamt+round($tamt[0]);?> 
	    </td> 
	    <td><?php
	    $expectamtqry=mysqli_query($con,"select expectedApprovalAmt,app_amt,wbs,vpr,prime,ticket_no,ref_no,job from quotation_approve_details where qid='".$row[0]."'");
	      $rowExpectamt=mysqli_fetch_array($expectamtqry);
	    
	    echo $rowExpectamt[0] ;?> </td>
	    <td align="center" width="150">
	   <?php 
             $rowamt="";
	      if($row[11]=='a' || $row[11]=='app' )
	      {
	      $amtqry=mysqli_query($con,"select app_amt,filename,app_by,approved_date,req_amt,remark from quotation_approve_details where qid='".$row[0]."'");
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

<?php echo $rowamt[5]; ?>

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
	   
	    
	 //  if($row[11]!='app' & $row[18]=='0')    // comment by anand
	    if($rowExpectamt[1]=="0" || $rowExpectamt[1]==""  )
	    {
	    ?>
	        <input type="button" name="updq" id="updq<?php echo $srno?>" value="Approve" onclick="qappfunc(this.id);">
	        
	        <?php }
	        ?>
	    </td> 
	    
	   
	    
	    
	    
	    
	    <td  align="center" width="150">
	   <?php if($hisv!=0)
	    {?>
	        <input type="button" name="vhis" id="vhis<?php echo $srno?>" value="View History" onclick="vhisfunc(this.id);">
	       <?php } ?>
	    </td> 
	    
	    
	<td width="150"><?php if($row[11]=='y'){ echo "Pending"; }elseif($row[11]=='a'){ echo "Approve By"; }elseif($row[11]=='app'){echo "Approved";} ?></td>
	    
	    <td  align="center" width="150"><?php if($row[16]=="0"){echo "Opened"."<br>";?> <input type="button" name="closeq" id="closeq<?php echo $srno?>" value="Close" onclick="closefuncdiv('clsfdiv<?php echo $srno?>');"><div name="clsfdiv<?php echo $srno?>" id="clsfdiv<?php echo $srno?>" style="display:none">
<table border="1" align="center" >

<tr>
<td width="150">Completion Date</td>
<td align="center">
<input type="text" name="date1<?php echo $srno?>" id="date1<?php echo $srno?>" onclick="displayDatePicker('date1<?php echo $srno?>');" readonly>

</td>
</tr>


<tr>
<td width="150">Completed By</td>
<td align="center"><input type="text" name="comby<?php echo $srno?>" id="comby<?php echo $srno?>" /></td>
</tr>


<tr>
<td width="150">Remark</td>
<td align="center"><textarea name="rem<?php echo $srno?>" id="rem<?php echo $srno?>" ></textarea></td>
</tr>

<tr>
<td width="150">Attach email</td>
<td><input type="file" name="email_cpy<?php echo $srno?>" id="email_cpy<?php echo $srno?>"  ></td>
</tr>


<tr>
<td></td>
<td align="center"><input type="button" name="closecall<?php echo $srno?>" id="closecall<?php echo $srno?>"  value="Submit" onclick="clsfunc(this.id,'<?php echo $row[2];?>');"/>&nbsp;&nbsp;&nbsp;
<input type="button" name="closecalldiv" id="closecalldiv" value="Cancel"  onclick="closefuncdivhide('clsfdiv<?php echo $srno?>');"/></td>

</table>






</div>  <?php }else{ echo "Closed"; }?></td>
	     
	  
	  <td width="250" align="center" >
	  
	  <?php if($row[16]=="1")
	  {
	 // echo "select * from quotaion_close_detail where qid='".$row[0]."'";
	  $gqhis=mysqli_query($con,"select * from quotation_close_detail where qid='".$row[0]."'");
	  $ghrw=mysqli_fetch_array($gqhis);
	  $qcdt=date("d-m-Y",strtotime($ghrw[2]));
	   echo $qcdt."<br>".$ghrw[3]."<br>".$ghrw[4]."<br>";
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
	  
  <td><?php if($row[18]=='0') {?><input type="button" name="cancelquot" id="cancelquot<?php echo $srno?>" value="Cancel Quotation" onclick="cancqfunc(this.id);"/><?php } ?></td>
  
  




<td align="center"><?php echo round($trdrow[0]); $tottransamt=$tottransamt+round($trdrow[0]); ?></td>
<td align="center"><?php if($trdrow[1]!='0000-00-00' && $trdrow[1]!=''){ echo date('d-m-Y',strtotime($trdrow[1])); }?></td>
<td align="center"><?php echo $trdrow[2]; ?></td>
<td align="center"><?php  if($rowExpectamt[2]!=""){ echo $rowExpectamt[2];}else if($rowExpectamt[3]!=""){echo $rowExpectamt[3];}else if($rowExpectamt[4]!=""){echo $rowExpectamt[4];}else if($rowExpectamt[5]!=""){echo $rowExpectamt[5];}else if($rowExpectamt[6]!=""){echo $rowExpectamt[6];}else if($rowExpectamt[7]!=""){echo $rowExpectamt[7];} ?></td>



	</tr>
	<?php 
	
	$srno++;
	}
	?>
	
	
	<tr height="40">
	<td colspan="12" align="center">Total</td>
	<td align="center"><b><?php echo round($totamt);  ?><b></td>
	<td align="center"><b><b></td>
	<td align="center"><b><?php echo round($apptotamt); ?><b></td>
        <td align="center"><b><?php echo round($reqamttot); ?><b></td>
        <td colspan="12"></td>
        <td align="center"><b><?php echo round($tottransamt); ?><b></td>
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
	<?php } ?>