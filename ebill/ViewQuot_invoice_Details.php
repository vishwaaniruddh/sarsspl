<?php 
session_start();
//echo $_SESSION['user'];
if(!isset($_SESSION['user']))
header('location:index.php');
include("config.php");
$st_flag=0;
$sendid=$_GET["sendId"];
//$sendid="21";

$nwords = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty", 50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty", 90 => "Ninety" ); 
function int_to_words($x)
       {
	   //echo $x;
           global $nwords;
           if(!is_numeric($x))
           {
               $w = '#';
           }else if(fmod($x, 1) != 0)
           {
               $w = '#'; 
           }else{
               if($x < 0)
               {
                   $w = 'minus ';
                   $x = -$x;
               }else{
                   $w = '';
               } 
               if($x < 21)
               {
                   $w .= $nwords[$x];
               }else if($x < 100)
               {
                   $w .= $nwords[10 * floor($x/10)];
                   $r = fmod($x, 10); 
                   if($r > 0)
                   {
                       $w .= '-'. $nwords[$r];
                   }
               } else if($x < 1000)
               {
                   $w .= $nwords[floor($x/100)] .' Hundred'; 
                   $r = fmod($x, 100);
                   if($r > 0)
                   {
                       $w .= ' and '. int_to_words($r);
                   }
               } else if($x < 100000) 
               {
                   $w .= int_to_words(floor($x/1000)) .' Thousand';
                   $r = fmod($x, 1000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $w .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               } else if($x < 10000000){
                   $w .= int_to_words(floor($x/100000)) .' Lakh';
                   $r = fmod($x, 100000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }else {
                   $w .= int_to_words(floor($x/10000000)) .' Crore';
                   $r = fmod($x, 10000000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }
           }
           return $w;
       }
       
 
?>
<script src="excel.js" type="text/javascript"></script>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('annexp');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }

        function PrintDiv1() {    
           var divToPrint = document.getElementById('inv');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
				 function PrintDiv2() {    
           var divToPrint = document.getElementById('page2');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
                
                
                	 function PrintDiv3() {    
           var divToPrint = document.getElementById('page3');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
                
                
                
                
     </script>
     
<!--------------------------------- annexure start-------------------------------->

<div> <a href="#">Cancel This Invoice</a> <a href="Edit_Quot_invoice_Details.php?sendId=<?php echo $sendid;?>">Edit This Invoice</a></div>

<div id="annexp">
    
    <table width="100%" border="1" cellpadding="0"  cellspacing="0">
  <th>Sr No</th>
   <th>Customer</th>
   <th>Project</th>
   <th>Bank</th>
   <th>Atm ID</th>
   <th>Site ID</th>
   <th>City</th>
   <th>State</th>
   <th>Location</th>
   <th>Work Details</th>
   <th>Month</th>
   <th>Approval Date</th>
   <th>Approval Amount</th>
   <th>Approved By</th>
   
   
   <?php 
   
   $getinvm=mysqli_query($con,"select * from  rnm_invoice where send_id='".$sendid."'");
   $mnrow=mysqli_fetch_array($getinvm);
   
   
   
   $getanexdets=mysqli_query($con,"select * from  rnm_invoice_details where send_id='".$sendid."'");
             $getanexdets_NumRows=mysqli_num_rows($getanexdets);
             
             
   $srno=1;
   $ttmt=0;
   $bk="";
   while($annexrows=mysqli_fetch_array($getanexdets))
   {
       
       $gtdetsfrmquot=mysqli_query($con,"select * from quotation1 where id='".$annexrows["qid"]."'");
       $gdtsrwss=mysqli_fetch_array($gtdetsfrmquot);
       
      $bk= $gdtsrwss["bank"];
       
     //  echo "select * from ".$gdtsrwss["cust"]."_sites where atm_id1='".$gdtsrwss["atm"]."'";
       $stts=mysqli_query($con,"select * from ".$gdtsrwss["cust"]."_sites where atm_id1='".$gdtsrwss["atm"]."'");
       $sttsrws=mysqli_fetch_array($stts);
       
      // echo "Select * from quotation_approve_details where qid='".$gdtsrwss[0]."'";
       $gapdet=mysqli_query($con,"Select * from rnm_invoice_details where qid='".$gdtsrwss[0]."'");
$nurws=mysqli_num_rows($gapdet);

if($nurws>0)
{
$approw=mysqli_fetch_array($gapdet);


}
   ?>
   
   <tr>
       <td><?php echo $srno; ?></td>
   <td><?php echo $annexrows["cust"];?></td>
   <td><?php echo $annexrows["project"];?></td>
   <td><?php echo $annexrows["bank"];?></td>
   <td><?php echo $annexrows["atm"];?></td>
   <td><?php echo $annexrows["site_id"];?></td>
   <td><?php echo $annexrows["city"];?></td>
   <td><?php echo $annexrows["state"];?></td>
   <td><?php echo $annexrows["location"];?></td>
   	       <td  align="left" width="300">
	     
<?php

if($gdtsrwss[2]=='ICICI' || $gdtsrwss[2]=='RATNAKAR' || $gdtsrwss[2]=='ICICI_Direct' || $gdtsrwss[2]=='Knight_Frank' || $gdtsrwss[2]=='BajajFinance' || $gdtsrwss[2]=='kotak')
{
?>
<table border='1'>
<?php
$qdetici=mysqli_query($con,"select * from icici_quot_details where qid='".$gdtsrwss[0]."'");
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
 
$qdetc=mysqli_query($con,"select distinct(particular) from Rnm_quotation_details where qid='".$gdtsrwss[0]."'");
 while($gdetca=mysqli_fetch_array($qdetc))
 {
?>
<tr><td colspan="2" align="center"><b><?php echo $gdetca[0];?></b></td></tr>
<?php
  $gpart=mysqli_query($con,"select * from Rnm_quotation_details where particular='".$gdetca[0]."' and qid='".$gdtsrwss[0]."'");
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

   <td><?php echo date("M-Y",strtotime($approw["ApprovalDate"]));?></td>
   <td><?php
   $mnth=date("M-Y",strtotime($approw["ApprovalDate"]));
   if($approw["ApprovalDate"]!="0000-00-00"){ echo date("d-M-Y",strtotime($approw["ApprovalDate"])); } ?></td>
   <td align="right"><?php echo $approw["ApprovalAmount"]; $ttmt=$ttmt+$approw["ApprovalAmount"];?></td>
   <td ><?php echo $approw["ApprovedBy"]; ?></td>
   </tr>
   <?php
   $srno++;
   } ?>
   <tr>
      <td colspan="12" align="center">Total Amount</td>
      <td colspan="" align="right"><?php echo $ttmt;?></td>
      <td></td>
       </tr>
   </table>
</div>    
     
<!--------------------------------- annexure end-------------------------------->


<!--------------------------------- invoice format-------------------------------->
</br>
</br>

<?php
$cid=$mnrow["customer"];
$resul4=mysqli_query($con,"select id from contacts where short_name='".$mnrow["customer"]."'");
                $ro4=mysqli_fetch_array($resul4); 
                $uid1=$ro4[0];
				
                $resul5=mysqli_query($con,"select * from address_book where ref_id='$uid1'");
                $addrow1=mysqli_fetch_array($resul5); 
     ?>           
<div id="inv">
    
    <table cellspacing="0" cellpadding="0" border='1' width="100%" style="font-size:12;margin-top: 180px;">
    <tr>
        <td colspan="15" align="center"><h3>TAX INVOICE</h3></td>
      
    </tr>
    
    <?php
    
     $tabname="";
           if($cid=="EUR08")
           {
               $tabname="euronet";
               
           }
           if($cid=="DIE002")
           {
               $tabname="diebold";
               
           }
           if($cid=="FIS03")
           {
               $tabname="fis";
               
           }
           if($cid=="FSS04")
           {
               $tabname="fss";
               
           }
           if($cid=="HITACHI07")
           {
               $tabname="hitachi";
               
           }
           if($cid=="AGS01")
           {
               $tabname="ags";
               
           }
           
            if($cid=="Tata05")
           {
               $tabname="tata";
               
           }
           
            if($cid=="EPS")
           {
               $tabname="eps";
               
           }
     
    // echo "select * from ".$tabname."_gst where State ='".$mnrow["state"]."'";
    
     $sttcode=mysqli_query($con,"select * from ".$tabname."_gst where State ='".$mnrow["state"]."'");
    $ftch=mysqli_fetch_array($sttcode);
    
    if($tabname=="fss")
{
    $addr1=$sttcodefmh1[6];
    
}
elseif($tabname=="tata" || $tabname=="eps") 
{
 $addr1=$ftch[7];   
}
else
{
$addr1=$ftch[3];
}
    
 $gstno1=$ftch["GSTIN"]; 
    
    
    $gtstqr=mysqli_query($con,"select address,gst from gst_no_os where gst!='na' and state='".$state."'");
    $gstrrws=mysqli_num_rows($gtstqr);
    
    if($gstrrws>0)
    {
        $frstcd=mysqli_fetch_array($gtstqr);
        $addr2=$frstcd[0];
         $gstno2=$frstcd[1];
        
    }else
    {
         $gtstqr=mysqli_query($con,"select address,gst from gst_no_os where state='Maharashtra'");
          $frstcd=mysqli_fetch_array($gtstqr);
        $addr2=$frstcd[0];
    $gstno2=$frstcd[1];
        
    }
    
    ?>
    <tr>
        <td colspan=6 align="left" width="40%" >
            <b>To,</br>
            <?php echo  ucfirst($tabname) ;?>
           </b> 
            <p><?php echo $addr1; ?></p>
            
            
        </td>
        
        <td colspan=6 align="left" width="40%">
            <b>From,</br>
            Clear Secured Services Pvt. Ltd
            </b>
            <p><?php echo $addr2;?></p>
            
        </td>
        <td colspan=3 align="CENTER" width="100%" style="border-bottom:none;">
            <b>
            <p>InvoiceNo :<?php echo $mnrow["invoice"];?><br />
            
            <?php
            $expl=explode("/",$mnrow["invoice"]);
            
            ?>
             Date : <?php echo date("d-M-Y",strtotime($mnrow["date"]));?><br />
              SAC Code: 998719<br />
              <!-- <p>State Code: <?php echo $expl[0];?></p>-->
              Prime Code/PO No.: 12345 <br />
               PO Date: <?php echo date("d-M-Y",strtotime($mnrow["date"]));?> </p>
            
           
            
            </b>
            
        </td>
    </tr>  






<tr>
     <td colspan=3 align="left" width="17%">
           <p>Place Of Supply:Maharashtra </p>
            
        </td>
    
    
     <td colspan=3 align="left" width="17%">
            <p>State Code: <?php echo $expl[0];?></p>
            
        </td>
        
        
        <td colspan=3 align="left" width="17%">
            <p>State:Maharashtra</p>
            
        </td>
        
        <td colspan=3 align="left" width="17%">
           
            <p>State Code: <?php echo $expl[0];?></p>
           
            
        </td>
        
        <td colspan=3 align="left" width="32%" style="border-bottom:none;border-top:none;">
            
           
        </td>
        
    
    
    </tr>
    














<tr>
     <td colspan=3 align="left" width="17%">
            <p>
           
           GST NO. <?php echo $gstno1;?>
          
           </p>
            
        </td>
    
    
     <td colspan=3 align="left" width="17%">
            <p>
          PAN NO.
           </p>
            
        </td>
        
        
        <td colspan=3 align="left" width="17%">
            <p>
            GST NO. <?php echo $gstno2;?>
            </p>
            
        </td>
        
        <td colspan=3 align="left" width="17%">
            <p>
            PAN No:  AADCC5952H
            </p>
            
        </td>
        
        <td colspan=3 align="left" width="32%" style="border-bottom:none;border-top:none;">
            
           
        </td>
        
    
    
    </tr>
    
     <tr>
     <td align="center" colspan="15">
        <b>Bill For Maintenance Or Repair Services</b>
         
     </td>
      </tr>

<tr>
     <td align="center" colspan="12">
        <b>PARTICULAR</b>
         
     </td>
     
     <td align="center" colspan="3">
        <b>Amount</b>
         
     </td>
      </tr>


<tr>
    
<td colspan="12" style="border-bottom:none;border-top:none;">
    
  <table>  
    <tr>
    <td colspan="12" >
        
        Being: Bill for Aproval Work Done for <?php echo $mnrow["bank"]; ?> sites of <?php echo $mnrow["state"]; ?> for the Month of (<?php echo $mnth;?>)(As per Annexure Attached)
        </td>
    
    </tr>
    </table>
    <br /><br />
    <table style="font-size:13" >  
    <tr>
        <td width="100px"></td>
    <td ><b width="200px"><p>No. Of Sites:<?php echo $getanexdets_NumRows;?></p></br></b></td> 
   <td width="100px"></td>
   
    <?php if($getanexdets_NumRows>1){ $bnk="All Bank" ; }else{ $bnk=$bk;} ?>
    
     <td ><b><p>Bank:<?php echo $bnk; ?></p></br></b></td>     
     
       
    
    </tr>
    </table>
    
    
<table height="60px;" width="100%">

<tr>
    
    <td width=100% align="center" style="border-bottom:none;border-top:none;"><b>Total</b></td>
</tr>

</table>
</td>


<td colspan="3" align="right" valign="top" style="border-bottom:none;border-top:none;">
     <table>  
     <tr>
     <td>
        <?php echo $mnrow["amount"];?>
</td>
</tr>
</table>
<table  width="100%" >

<tr>
    
    <td width=100% height="50px;" align="right" style="border-top:1px;" style="border-bottom:none;border-top:none;"><b></b></td>
</tr>
<tr>
    
    <td widt=100% align="right" style="border-top:1px;"><b><?php echo $mnrow["amount"];?></b></td>
</tr>

<tr>
    
    <td width=100% height="50px;" align="right" style="border-top:1px;" style="border-bottom:none;border-top:none;"><b></b></td>
</tr>
</table>







</td>

</tr>

  <?php if($mnrow["cgst"]>0.00)
    {
    ?>
<tr>
  <td colspan="12"align="right" style="border-bottom:none;border-top:none">  
    CGST @9%
    
    </td>
    
    <td colspan="3"align="right" style="border-bottom:none">  
   <?php echo $mnrow["cgst"];?>
    
    </td>
    
    </tr>
    <?php } ?>
    
     <?php if($mnrow["sgt"]>0.00)
    {
    ?>
<tr>
  <td colspan="12"align="right" style="border-bottom:none;border-top:none">  
    SGST @9%
    
    </td>
    
    <td colspan="3"align="right"style="border-bottom:none;border-top:none;">  
   <?php echo $mnrow["sgt"];?>
    
    </td>
    </tr>
    
    <?php } ?>
    
    <?php if($mnrow["igst"]>0.00)
    {
    ?>
    <tr>
    
    
  <td colspan="12"align="right" style="border-bottom:none;border-top:none;">  
    IGST @18%
    
    </td>
    
    <td colspan="3"align="right" style="border-bottom:none;border-top:none;">  
   <?php echo $mnrow["igst"];?>
    
    </td>
    </tr>
    
    <?php }?>
    
    <?php $fmt=$mnrow["amount"]+$mnrow["igst"]+$mnrow["cgst"]+$mnrow["sgt"];?>
    <tr>
        
    <td align="left" colspan="12" style="width:100%;height:30px">
      <b>
        (Rupees : <?php $st=int_to_words(round($fmt)); echo $st." Only";

 ?>  )</b>
        </td> 
    
    <td align="left"colspan="1" ><b>Grand Total INR</b></td>
    
    <td align="right" colspan="2"><b><?php echo   number_format($fmt, 2);  ;?></b></td>
    </tr>
    
   <!-- <tr>
    
     <td align="left" colspan="6">PAN NO     AADCC5952H</td>
     <td align="left" colspan="6">TAN NO     MUMC16631G</td>
     <td align="left" colspan="3"></td>
    
    </tr>-->
    
    <tr>
    
     <td align="left" colspan="15">Service Category :Maintenance Or Repair Service</td>
     
    
    </tr>
    
     <tr>
    
     <td align="left" colspan="15"><b>
        E & O.E  Terms & Conditions:</br>
        Note:-   1.Payment Should be made in the favour of Clear Secured Services Pvt. Ltd.</br>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.Payment to be made within 30 days of bill date.  
         </b>
         </td>
     
    
    </tr>
     <tr>
    
     <td align="left" colspan="15">
        Reverse Charge Mechanism-No.
         </td>
     
    
    </tr>
    
    <tr>
    
     <td align="left" colspan="15">
        <b>SAC-998719</b> Description:Maintenance And Repair Services Of Other Machinery & Equipment.
         </td>
     
    
    </tr>
    
    
    
    <tr>
    <td align="left" colspan="3" height="150px;" >
    <table border=1 style="font-size:13;border:none;">
        <tr>
            <td><b>Name Of Company</b></td><td><b>Clear Secured Services Pvt Ltd.</b></td>
        </tr>
        <tr>
            <td><b>A/C No.</b></td><td><b>916030057692521</b></td>
        </tr>
        <tr>
            <td><b>Bank</b></td><td><b>Axis Bank</b></td>
        </tr>
        <tr>
            <td><b>IFSC CODE</b></td><td><b>UTIB0000654</b></td>
        </tr>
        <tr>
            <td><b>Branch</b></td><td><b>Sion Mumbai</b></td>
        </tr>
    </table>
    
    
    
    
    
         </td>
         
         
     <td align="right" colspan="11" height="150px;" style="border-bottom:none;">
        For Clear Secured Services Pvt Ltd
         </td>
     
    
    </tr>
    
    
     
    
    
    <tr>
    
     <td align="right" colspan="15" style="border-top:none;">
        Authorized Signatory
         </td>
     
    
    </tr>
</table>
    
</div>

<!--------------------------------- invoice format end-------------------------------->


<div>
<center><a onclick='PrintDiv();' href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Annexure </font></a><br/></center>
<center><a onclick='PrintDiv1();' href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Inv </font></a><br/></center>
</div>