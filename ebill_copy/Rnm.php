<?php
session_start();
echo $_SESSION['user']."".$_SESSION['designation']." ".$_SESSION['dept']." ".$_SESSION['serviceauth'];
?>

<?php
if($_SESSION['designation']=='8' && $_SESSION['dept']=='4' && $_SESSION['serviceauth']=='2')
{
?>
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
<?php
}
include("config.php");
$quot=$_GET['quotid'];
//echo $quot;
$qry=mysqli_query($con,"select * from quotation where quotid='".$quot."'");
$row=mysqli_fetch_row($qry);
$resul3=mysqli_query($con,"select cust_id,atmsite_address,bank,atm_id1 from ".$row[3]."_sites where trackerid='".$row[4]."'");
                $ro3=mysqli_fetch_row($resul3); 
                $cust_id1=$cid;
									
		$resul4=mysqli_query($con,"select id from contacts where short_name='$row[3]'");
                $ro4=mysqli_fetch_row($resul4); 
                $uid1=$ro4[0];
				
                $resul5=mysqli_query($con,"select * from address_book where ref_id='$uid1'");
                $addrow1=mysqli_fetch_row($resul5); 
                $resul6=mysqli_query($con,"select billname from billcompany where cust_id='$cust_id1'");
                $brow1=mysqli_fetch_row($resul6); 
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Repair and Maintains</title>

<style>

.numalign{text-align:right;}

h1,h2,h3{text-align:center; vertical-align:top; background-color:transparent; color:#000;}

h6{position:absolute; clear:both;}
p {text-align:left; font-size:14px; background-color:transparent; color:#000;}


table{border:px solid #F00; width:100%;; margin-left:auto; margin-right:auto; border-collapse:collapse;}
table tr td{border:px solid #000; padding:2px; }

.td_bg_col{ }
img{}
p span{font-size:12px;}
/*th{background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;}*/

ul{display:block;}
ul li{list-style:decimal; list-style-position:inside;}
</style>

</head>

<body>
<div id="print_div">

<table style="border:1px #000 solid;" border="1">
    <thead>
     <tr>
     <th colspan="6"><b>TAX INVOICE</b></th>
     </tr>
     </thead>
     
     
     <tbody>
        <tr>
            <td colspan="2" class="td_bg_col" width="50%" >
                <p>
                       EURONET SERVICES INDIA PVT, LTD.<br>
                       I-Think Techno Campus,<br />
                       Office No. 1, 8th Floor, Wing "A",<br />		
		       Off Pokhran Road No. 2, <br />		
		       Behind TCS, Eastern Express Highway,<br />               
                </p>
            </td>
            <td style="text-align:right;" colspan="4" >
                
                   Invoice No:CSS/RNM/3339/2013-14 <br />
                           Date :	24-Mar-14.                
            </td>
        </tr>
        
        
        <tr>
            <td colspan="6" style="text-align:center;">   
             <strong>Bill for Approval Work Done for the month of February - 2014.</strong>
               
            </td>
        </tr>
        <!--<tr>
            <td colspan="4" style="text-align:center;" >
                
                    <strong>PARTICULAR </strong>
                
            </td>
            


            <td  style="text-align:right;" colspan="2" width="200" >
                
                    <strong>AMOUNT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                
            </td>
        </tr>-->
        
        <!--<tr>
            <td colspan="6" >
                
                <strong>Being Repair & Maintenance Work for SCB Bank sites during the month of February - 2014.</strong>
                
            </td>
            
        </tr>-->
        
        
        <tr>
        <td colspan="6">
        <!--<table border="0">
        
        
        <tr>
        
        <td colspan="6">
        
         <strong>Being Repair & Maintenance Work for SCB Bank sites during the month of February - 2014.</strong>
        </td>
        </tr>
             
        <tr>
        <td></td>
        <td></td>
            <td colspan="2" >
                
                    <strong>Bank</strong>
                
            </td>
            <td colspan="" >
                
                    <strong>Description</strong>
                
            </td>
            <td >
                <p>
                    <strong></strong>
                </p>
            </td>
        </tr>
        
        
        <tr>
        
        <td></td>
        <td></td>
            <td colspan="2" >
                
                    SCB
               
            </td>
            <td colspan="" >
               
                    Repair & Maintenance
                
            </td>
            <td >
            <table border="1"><tr><td>
                
                      5,300.00
                      </td></tr></table>
               
            </td>
        </tr>
        
        
        <tr> 
        <td colspan="5"></td>
        <td colspan=""><strong>5,300.00</strong></td>
        </tr>
        
        <tr>
        <td>Add :</td>
        
        <td>Bill Amount</td>
        <td colspan="4"></td>
        
        </tr>
        
        <tr><td></td> <td>Service Tax@12%</td> <td colspan="3"></td> <td>636.00</td></tr>
        
        
        <tr><td></td> <td>Education Cess @ 2%</td> <td colspan="3"></td> <td>12.72</td></tr>
        
        
        <tr><td></td> <td>Secondary & Higher Education Cess @ 1%</td> <td colspan="3"></td> <td>6.36</td></tr>
       
        <tr>
            <td colspan="4" >
                <p>
                    <strong>(Rupees : Five Thousand Nine Hundred Fifty Five Only)</strong>
                </p>
            </td>
            <td colspan="" >
                <p>
                    <strong>TOTAL :-</strong>
                </p>
            </td>

            
            <td >
                <p>
                    <strong>5,955.00</strong>
                </p>
            </td>
        </tr>
       
        </table>-->
        
        
        <table border="1" width="100%" style="border-collapse:collapse;">

<tr><td width="80%" style="text-align:center"><b>PARTICULAR</b></td> <td width="20%" style="text-align:center"><b>AMOUNT</b></td></tr>

<tr><td><p></p></td> <td><p></p></td></tr>

 <tr>
 <td>
 <table width="100%" style="border-collapse:collapse;">
 <tr><td colspan="4">Being Repair & Maintenance Work for SCB Bank sites during the month of February - 2014. </td></tr>
 
 <tr><td></td><td></td><td><b>Bank</b></td><td><b>Description</b></td></tr>
 
  <tr><td></td><td></td><td>SCB</td><td>Repair & Maintenance</td></tr>
 
 <tr><td><p></p></td><td></td><td></td><td></td></tr>
 
 <tr><td width="15%"><b>Add :</b></td><td  width="30%"><b>Bill Amount</b></td><td  width="10%"></td><td  width="25%"></td></tr>
 
 <tr><td></td><td>Service Tax@12%</td><td></td><td></td></tr>
 
 <tr><td></td><td>Education Cess @ 2%</td><td></td><td></td></tr>
 
 <tr><td></td><td >Secondary & Higher Education Cess @ 1%</td><td></td><td></td></tr>
 
 <tr><td colspan="3" style="padding-top:200px;"><b>(Rupees : Five Thousand Nine Hundred Fifty Five Only)</b></td>
  <td style="padding-top:200px;" class="numalign"><b>TOTAL :-</b></td></tr>
 
 </table>
 
 </td>



 <td>
 <table border="" width="100%" style="border-collapse:collapse; border:none;">
 
 <tr><td style="border-bottom:none; border-top:none; border-left:none; border-right:none;"><p></p></td></tr>
 <tr><td style="border-top:none; border-left:none;  border-right:none;"><p></p> </td></tr>
 <tr><td style="border-left:none; border-right:none;" class="numalign">5,300.00</td></tr>
 <tr><td style="border-left:none; border-right:none;" class="numalign"><b>5,300.00</b></td></tr>
 <tr><td style="border-left:none; border-right:none; border-bottom:none;"><p></p></td></tr>
 <tr><td style="border-bottom:none; border-top:none; border-left:none; border-right:none;" class="numalign">636.00</td></tr>
 <tr><td style="border-bottom:none; border-top:none; border-left:none; border-right:none;" class="numalign">12.72</td></tr>
 <tr><td style="border-top:none; border-left:none; border-right:none;" class="numalign">6.36</td></tr>
 <tr><td style="border-bottom:none; border-left:none; border-right:none; padding-top:200px;" class="numalign"><b>5,955.00</b></td></tr>
 

 </table>
 
 </td>
 
 </tr>

</table>
      
        </td>
        </tr>
        <tr>
        
            <td  colspan="2">
                
                    <strong>PAN NO: AADCC5952H   </strong> <br />
                    
                    <strong>VAT NO : 27250728717v w.e.f. 06-10-09   </strong>
                
            </td>
            
            <td  colspan="4">
               
                    <strong>TAN No.: MUMC16631G	 </strong><br />
                    
                    <strong>SERVICE TAX No.: AADCC5952HST001.	 </strong>
                
            </td>
        </tr>
        
        
        
        <tr>
            <td colspan="6">
                
                    <strong>Service Tax Category : Repair & Maintenance Service</strong>
                
            </td>
         </tr>
         
         
        <tr>
            <td colspan="6" class="td_bg_col" >
                <p>
                    I/We hereby certify that my/our registration certificate under the Maharashtra Value Added Tax Act. 2002 is in force on the date on which the sale of  the goods specified in this " Tax Invoice"  is made by me/us and that the transaction of sales covered by this "Tax Invoice has been effected by me/us and it shall be accounted  for in  the turn over of  sales while filing return and due tax , if any payable on the sales has been paid shall be paid. 
                </p>
            </td>
        </tr>
        
        
        <tr>
        
        <td colspan="6">
        <table><tr>
            <td  colspan="">
                
                    <strong>E & O.E.</strong>
               
            </td>
            <td  colspan="5">
                
                    Terms & Conditions:
                
            </td>
                    </tr>
                    
                    
              <tr>
            <td colspan="">
                
                    <strong>Note:.</strong>
                
            </td>
            <td colspan="5">
                
                    1. Payment Should be made in favour of Clear Secured Services Pvt Ltd.
                
            </td>
            </tr>
            </table>
            </td>
            
            </tr>      
       
        <tr>
            <td colspan="6" height="230" valign="top">
                <br /><br /><br /><br /><br />
                
                <p><strong><font style="color:#F00;">For Clear Secured Services Pvt Ltd</font></strong>
                    
                </p>
                <br />
                
                <p>
                   <h4 align="left" >
                   <strong> ____________________________ </strong><br />
                   <strong> Authorized by </strong>
                   </h4>
                </p>
            </td>
        </tr>
        
    </tbody>
</table></div>

</body>
</html>