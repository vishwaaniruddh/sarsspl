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

//$Per_Page=$_POST['perpg'];
$strPage = $_POST['Page'];
	
//echo $_POST['stat'];
	//echo "hello";
	
	
	//$qry="Select * from quotation1 where status!='c'  and  local_status='0' ";
       $qry="Select * from quotation1 where local_status='0' and ( ((status='a' or status='app') and category='a') or (status='y' and category='f'))";
	
	if($_POST['stat']!="-1")
	{
           
          
           
              $qry.=" and p_stat='".$_POST['stat']."' ";
            
	
         
	
	}
	
	if($_POST['atm']!="")
	{
	$qry.="and atm='".$_POST['atm']."'";
	}

	if($_POST['strdt']!="" & $_POST['endt']!="")
	{


	$dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
        if( $_POST['stat']=='0')
	
        {
	/*echo "Select * from quotation1 where status!='c' and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";*/

	$qry.=" and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";

          }
        elseif($_POST['stat']=='1' || $_POST['stat']=='3' || $_POST['stat']=='4')

        {

       $qry.=" and id in (select qid from quotation1_req where DATE(entrydt)>='".$start."' and DATE(entrydt) <='".$end."')";
         }
	}
	
	//$excl=array();
         $excl=$_POST['exnm'];
          
            
        
          $exc=explode(',',$excl);
              //echo $exc[0];
          
         $cntx=count($exc);
        //echo $cntx;
        
        if($exc[0]!="")
        {
       $notin="";
        for($i=0;$i<$cntx;$i++)
        {
         if($i==$cntx-1)
         {
         $notin.="'".$exc[$i]."'";
         }
         else
         {
         $notin.="'".$exc[$i]."',";
         }
        }
         
       //echo $notin;
               
               
          
              $qry.=" and cust not in($notin) ";
          
        }
	
	
	if($_POST['cust']!="")
	{

	$qry.=" and cust='".$_POST['cust']."' ";
	}
         
       
        
if($_POST['qid']!='')
{
//echo $_POST['atm'];
$qidn=array();
$qidr=str_replace("\n",",",$_POST['qid']);
$qidt=explode(",",$qidr);

for($i=0;$i<count($qidt);$i++)
{
if($qidt[$i]!='')
{
$qidn[]=trim($qidt[$i]);
}
}

//$req=str_replace(",","','",implode(",",$req2));
//$sql.=" and req_no in ('".$req."')";


//print_r($qidn);
$ctn=count($qidn);

//echo $ctn;


$notin2="";
        for($i=0;$i<$ctn;$i++)
        {
         if($i==$ctn-1)
         {
         $notin2.="'".$qidn[$i]."'";
         }
         else
         {
         $notin2.="'".$qidn[$i]."',";
         }
        }
$qry.=" and id in($notin2) ";

}



        if($_POST['benf']!="0")
	{

	$qry.=" and supervisor='".$_POST['benf']."' ";
	}
           

      if($_POST['accname']!="-1")
	{

	$qry.=" and reqby='".$_POST['accname']."' ";
	}
       
          if($_POST['rnmtyp']!="")
	 {
          $qry.= " and id in(select qid from quotation1_req where reqby='".$_POST['rnmtyp']."' ) ";
         }

	 if($_POST['type']!="-1")
	{

	$qry.=" and category='".$_POST['type']."' ";
	}

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
	


$qry.=" ORDER BY cust ASC ";
	
	$qry.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con,$qry);
	//echo $qry;	
	?>







	<input type="hidden" id="expqry" name="expqry" value="<?php echo $qry;?>">
	<input type="button" id="btnExport" value="Export To Excel" onclick="expex();"/>
	<!---<input type="button" id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')" value="Export Table data into Excel"/>-->
	
	
	<table id="tableexport" name="tableexport" border="2">
	<th  align="center">Sr No</th>
	<th width="75">Category</th>
	<th >Qid</th>
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
      
       <th  align="center">Beneficiary Acc No</th>
         <th  align="center">Beneficiary IFSC Code</th>
	<th align="center">Amount</th>
	<th align="center">Approved Amount</th>


          <th align="center">Required Amount</th>
         <th align="center" style=" background-color: red;">Transfer Amount</th>
      <th align="center">Transfer Remark</th>


        <th align="center">Approved By</th>
                <th align="center">Approved Date</th>
                <th align="center">Approval Remark</th>
	<th align="center">Attatchment</th>
	<th  align="center">Ticket No</th>	
	<th  align="center">View Quotation</th>
	
		
	<th  align="center">History</th>
	<th  align="center">Status</th>
	<th  align="center">Call Status</th>	
      <th  align="center">Call Status History</th>

	<th  align="center">Approve</th>
<?php
if($_POST['stat']=="10")
{?>
<th  align="center">Rejected remark</th>
<?php }?>


	
	<?php
	if($_SESSION['designation']=="20" && $_SESSION['serviceauth']=='2' && ($_SESSION['dept']=='6' || $_SESSION['dept']=='7') && $_POST['stat']=="0"  )

{ ?>
<th  align="center">Archieve Quotation</th>	
<?php }?>
	
	
				
	<?php
	$srno=1;
	$totamt=0;
	$apptotamt=0;
        $reqtotamt=0;
       $requotamt=0;
	while($row=mysqli_fetch_array($qrys))
	{
           
	   //echo "select sum(Total) where qid='".$row[0]."'";
	   $getamt=mysqli_query($con,"select sum(Total) from quotation_details where qid='".$row[0]."'");
	   $tamt=mysqli_fetch_array($getamt);
	   
	    $ckhis=mysqli_query($con,"select qid from quotation_edit_history where qid='".$row[0]."' limit 0,1");
	  $hisv=mysqli_num_rows($ckhis);
	  
	  $mdby=mysqli_query($con,"select username from login where srno='".$row[9]."'");
	  $mdrow=mysqli_fetch_array($mdby);
	  
	  $chcatm=mysqli_query($con,"select atm from quotation1 where atm='".$row[3]."' and p_stat='1'");
	    $noratm=mysqli_num_rows($chcatm);
	?>
	<tr <?php if($noratm>1 & $_POST['stat']=='1'){?>
	style="background-color:red;"
	<?php
	}?>>
	    <td  align="center" width="50">
	       <?php echo  $srno; ?> 
	    </td>
	     
	      <td align="center"><?php if($row[12]=="a"){ echo "Approval Basis"; }elseif($row[12]=="f"){echo "Fixed Cost"; };?></td>
	     
	     <td  align="center" width="150">
	       <input type="text" style='width:75px;' id="qid<?php echo $srno?>" name="qid" value="<?php echo  $row[0]; ?>"  readonly="readonly" class="noExl">
	       <span style="display:none"><?php echo  $row[0]; ?></span>
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
	
	
	<td  align="center" width="170">
	       <input type="text" style="width:100px;border: none;
    background: transparent;" id="customer<?php echo $srno ?>" value="<?php echo  $qname[0]; ?> " readonly="readonly" class="noExl"/>
    
    <span style="display:none" ><?php echo  $qname[0]; ?></span>
	    </td> 
	
	   
	    
	    
	    
	    <td  align="center" width="150" class="noExl">
	      <a href="searchtest.php?atms=<?php echo  $row[3]; ?>" target="_blank"><?php echo  $row[3]; ?></a>  
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
	    
	    
	       <td  align="left" width="300">
	     
<?php

if($row[2]=='ICICI' || $row[2]=='RATNAKAR' || $row[2]=='ICICI_Direct' || $row[2]=='Knight_Frank' || $row[2]=='BajajFinance' || $row[2]=='kotak')
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
	    if($row[17]!='' && $row[17]!='-1')
	    {
	    $sup=mysqli_query($con,"select hname,ifsc_code,accno from fundaccounts where aid='".$row[17]."'");
	    $sname=mysqli_fetch_array($sup);
	    echo $sname[0];
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
	   
	    echo $sname[2];
	    ?>
	     </td>

             
             
            <td  align="center" width="150">
                <?php 
	   
	    echo $sname[1];
	    ?>
	     </td>


             


	
	  <td  align="center" width="150">
           <?php
            if($row[2]=='ICICI' || $row[2]=='RATNAKAR' || $row[2]=='ICICI_Direct' || $row[2]=='Knight_Frank' || $row[2]=='BajajFinance' || $row[2]=='kotak' )
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
            $nr="";
	      if($row[11]=='a' || $row[11]=='app' )
	      {
	      $amtqry=mysqli_query($con,"select app_amt,filename,app_by,approved_date,req_amt,ticket_no,remark from quotation_approve_details where qid='".$row[0]."'");
              $nr=mysqli_num_rows($amtqry);
	      $rowamt=mysqli_fetch_array($amtqry);
	      echo round($rowamt[0]);
	       $apptotamt=$apptotamt+round($rowamt[0]);
	      }
	      
	   ?> 
	       
	    </td> 

             <td align="center">
        <?php
                echo round($rowamt[4]);
               $requotamt=$requotamt+round($rowamt[4]);
            ?>
               </td>



            <td align="center">
              <?php 
            $greamt=mysqli_query($con,"select req_amt,remark from quotation1_req where qid='".$row[0]."'");
            $reqamtw=mysqli_fetch_array($greamt);
               echo round($reqamtw[0]);
             $reqtotamt=$reqtotamt+round($reqamtw[0]);
              ?>
              

            </td>


              
               <td align="center"><?php echo $reqamtw[1];?></td>    
         

 
         <td align="center">
             <?php echo  $rowamt[2]  ;?>  
         </td>

            
            
            <td align="center">
	<?php 
	
	if( $nr>0 & ($row[11]=='a' || $row[11]=='app')  )
	      {
	if($rowamt[3]!="0000-00-00")
	{
	echo date("d-m-Y",strtotime($rowamt[3]));
	}
	}
	?>
	</td>
	
	
	 <td align="center">
<?php
                echo $rowamt[6];
              
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
             
	 <td align="center">
            <?php 
               echo $rowamt[5];

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
	    if($ghrw[7]!="")
              {

     ?>
 <a href='../operations/quotuploads/close/<?php echo $ghrw[7]; ?>' download>Download</a>
 <?php

               }
	  
	  }
	  
	  ?>
	  
	  
	  
	  
	  </td>
	  
	 
	  
	 <?php 


if($_SESSION['designation']=="20" && $_SESSION['serviceauth']=='2' && ($_SESSION['dept']=='6' || $_SESSION['dept']=='7'))

{
/*  For approval by rnmfund       */

if ($_POST['stat']=="0" )
	 
	 {
	 ?>  
	  
	  <td> <?php if($row[12]=="f" & $row[18]=="0" ){ ?><input type="button" name="up" id="up<?php echo $srno?>" value="Update"   onclick="showdiv(this.id);"/>  <?php    }elseif( $row[11]!="y" & $row[12]=="a" & $row[18]=="0" ){ ?><input type="button" name="up" id="up<?php echo $srno?>" value="Update"   onclick="showdiv(this.id);"/> <?php  }elseif($row[18]=="1") { echo "processing";   }  ?>
	  <div id="udiv<?php echo $srno?>" style="display:none" >
	  <label>Approved Amount<label><br>
	  <input type="text" name="upappamt<?php echo $srno?>" id="upappamt<?php echo $srno?>" value="<?php echo round($rowamt[0]);?>" readonly="readonly"/><br>
	  
	  <label>Required Amount<label><br>
	  <input type="text" name="upreqamt<?php echo $srno?>" id="upreqamt<?php echo $srno?>"/><br>
	  
	   <label>Remark<label><br>
	  <input type="text" name="uprem<?php echo $srno?>" id="uprem<?php echo $srno?>"/><br>
          
         

          <label>Supervisor</label><br>
<select name="sv<?php echo $srno?>" id="sv<?php echo $srno?>">
<option value="-1">Select</option>
   <?php
 //$sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");
 $sup=mysqli_query($con,"select hname,aid,accno from fundaccounts where status=0 order by hname ASC");
 
    
	 while($supro=mysqli_fetch_array($sup))
	{ ?>
	   <option value="<?php echo $supro[1]; ?>" <?php if($row[17]==$supro[1]){echo "selected";} ?>><?php echo $supro[0]."/".$supro[2]; ?></option>
   <?php } ?>  
    </select>
        
	  
	  
	  <input type="button" name="go" id="go<?php echo $srno?>" value="Go" onclick="gofunc(this.id);">
	  <input type="button" name="rej" id="rej<?php echo $srno?>" value="Reject"  onclick="rejfunc(this.id);">
	  
	  </div>
	  
	  
	  </td>
	  
	  <?php 

                 
            }
         
           elseif($_POST['stat']=="3")
          {
           /*  For  approval and rejection of aproval done by rnmnorth     */

                  ?>
              <td width="170">
     <label>Remark</label>
           <input type="text" name="remnorth<?php echo $srno?>" id="remnorth<?php echo $srno?>" />
            <input type="button" value="approve" name="rnmapp" id="rnmapp<?php echo $srno?>" onclick="rnmnorthapp(this.id);"/>  
            <input type="button" value="Reject" name="rejnorth" id="rejnorth<?php echo $srno?>" onclick="rnmnorthrej(this.id);"    />
                  </td>
        <?php
         
          }
      elseif($_POST['stat']=="1")
       {
           /*  update details enterd by rnmnorth   */
$getrnmreq=mysqli_query($con,"select * from quotation1_req where qid='".$row[0]."'");
$rnmentdet=mysqli_fetch_array($getrnmreq);


        ?>
 <td width="170">


         <input type="button" name="updnw" id="updnw<?php echo $srno?>" value="Edit"   onclick="showdivnw(this.id);"/> 

             
         <div id="udivnew<?php echo $srno?>" style="display:none" >

	  <label>Approved Amount<label><br>
	  <input type="text" name="upappamtrnmm<?php echo $srno?>" id="upappamtrnmm<?php echo $srno?>" value="<?php echo round($rowamt[0]);?>" readonly="readonly"/><br>
	  
	  <label>Required Amount<label><br>
	  <input type="text" name="upreqamtrnm<?php echo $srno?>" id="upreqamtrnm<?php echo $srno?>" value="<?php echo round($rnmentdet[2]);?>"/><br>
	  
	   <label>Remark<label><br>
	  <input type="text" name="upremrnm<?php echo $srno?>" id="upremrnm<?php echo $srno?>"  value="<?php echo $rnmentdet[3];?>"/><br>
         
          
         

     
        
	  
	  
	  <input type="button" name="gornm" id="gornm<?php echo $srno?>" value="Update" onclick="updaternment(this.id);">
	 
	  
	  </div>
	  

</td>

     <?php

       }

      }

           ?>
           



           <?php

if($_SESSION['designation']=="6" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='5')

{


if($_POST['stat']=="1" )
	 
	 {
	 ?>  

          
           <td><input type="checkbox" name="pay[]" id="pay<?php echo $srno;?>" value="<?php echo $row[0]; ?>" onclick="addamt('<?php echo round($reqamtw[0]); ?>',this.id);" checked> 

<input type="hidden" name="chckpay[]" id="chckpay<?php echo $srno;?>" value="<?php echo round($reqamtw[0]); ?>" readonly="readonly"/>
</td>

             <?php } 
 }

             ?>


<!---------------------------archieve quotation------------------------------------------------------------------------------------>


<?php
	if($_SESSION['designation']=="20" && $_SESSION['serviceauth']=='2' && ($_SESSION['dept']=='6' || $_SESSION['dept']=='7')   )

{
?>
<td><?php if($_POST['stat']=="0") { ?><input type="button" name="qarch<?php echo $srno;?>" id="qarch<?php echo $srno;?>" value="Archieve "onclick="archquot(this.id);"> <?php } ?>

<?php if($_POST['stat']=="100") { ?><input type="button" name="remvarch<?php echo $srno;?>" id="remvarch<?php echo $srno;?>" value="Remove From Archieve" onclick="remvarchquot(this.id);"> <?php } ?>

</td>
<?php 
}
?>







<!------------------------------------------------------------------------------------------------------------------------------->


<?php

if($row[2]!='ICICI' && $row[2]!='ICICI_Direct' && $row[2]!='Knight_Frank' && $row[2]!='RATNAKAR' &&  $row[2]!='BajajFinance' &&  $row[2]!='kotak')
{
	if($_SESSION['designation']=="20" && $_SESSION['serviceauth']=='2' && ($_SESSION['dept']=='6'|| $_SESSION['dept']=='7')   && ($_POST['stat']=="0" || $_POST['stat']=="1" ))

{
?>
<td><?php 


if($_POST['stat']=="0" || $_POST['stat']=="1" ) { 



?><input type="button" name="edtsquot<?php echo $srno;?>" id="edtsquot<?php echo $srno;?>" value="Edit Quot" onclick="edtsqts(this.id,'<?php echo $row[2];?>','<?php echo $row[0];?>');"> <?php }?>


</td>
<?php 
}
}
else
{
?>
<td></td>
<?php
}
?>




<?php
	if($_SESSION['designation']=="20" && $_SESSION['serviceauth']=='2' && ($_SESSION['dept']=='6' || $_SESSION['dept']=='7')  && ($_POST['stat']=="0" || $_POST['stat']=="1"))

{
?>
<td><?php if($_POST['stat']=="0" || $_POST['stat']=="1") { ?><input type="button" name="edtappdet<?php echo $srno;?>" id="edtappdet<?php echo $srno;?>" value="Edit Approve Details" onclick="edtappdetfc(this.id,'<?php echo $row[0];?>');"> <?php } ?>


</td>
<?php 
}
?>


<?php
	if( $_POST['stat']=="10")

{
$rejrem=mysqli_query($con,"select remark from quotation1_reject where qid='".$row[0]."'");
$rwsarrrem=mysqli_fetch_array($rejrem);
?>


<td align="center"><?php echo $rwsarrrem[0];?></td>
<?php } ?>
	  
	</tr>
	<?php 
	
	$srno++;
          
	}
	?>
	
	
	<tr height="40">
	<td colspan="15" align="center">Total</td>
	<td align="center"><b><?php echo round($totamt); ?><b></td>
	<td align="center"><b><?php echo round($apptotamt); ?><b></td>
          <td align="center"><b><?php echo round($requotamt); ?><b></td>
       <td align="center"><b><?php echo round($reqtotamt); ?><b></td>
        


<?php

if($_SESSION['designation']=="6" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='5')

{


        if ($_POST['stat']=="1" )
           {
    ?>
           <td></td><td><b>Selected Total </b></td> <td ><b><input type="text" name=seltot id=seltot value="0" readonly></b></td><td colspan="5" align='center' ><input type="button" value="Payments" onclick="subm();" /></td>

          <?php
             }

}
	?>
	
	
	
	
	
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



<?php } ?>

