<?php
session_start();
//echo $_SESSION['user'];
if(!isset($_SESSION['user']))
header('location:index.php');

include('config.php');
$cid=$_POST['custid'];
$state=$_POST['state'];
$bank=$_POST['bank'];
$comp=1;
//print_r($_POST['quotid']);
$invdate='';
$q='';
	if(date('m')>='4'){ $invdate=date('Y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('Y',strtotime('-1 year'))."-".date('y'); }
$rmnid=array();
for($i=0;$i<count($_POST['quotid']);$i++)
{
if(isset($_POST['quotid'][$i]))
{
$rmnid[]=$_POST['quotid'][$i];
if($i==0)
$q=$_POST['quotid'][$i];
else
$q=$q.",".$_POST['quotid'][$i];
}
}
$invd='';

if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); }else{ $invd=date('y',strtotime('-1 year'))."-".date('y'); }

//echo "select max(invid) from siteinvoice where compid='".$comp."' and status='0' and fiscalyr='".$invd."'";
 $invc=mysqli_query($con,"select max(invid) from siteinvoice where compid='".$comp."' and status='0' and fiscalyr='".$invd."'");
 $invcro=mysqli_fetch_row($invc);
 if($invcro[0]=="null")
 {
 $inv='1';
 /*if($comp=='1')
$inv='3207';
elseif($comp=='2')
$inv='1021';
*/ }
else
{
/*if($comp=='1' && $invcro[0]<3207)
$inv='3207';
elseif($comp=='2' && $invcro[0]<1021)
$inv='1021';
else*/
$inv=$invcro[0]+1;
}
$service="Repair&Maintenance";
 $nwords = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty", 50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty", 90 => "Ninety" ); 
function int_to_words($x)
       {
      // echo $x;
           global $nwords;
           if(!is_numeric($x))
           {
          // echo "hi";
               $w = '#';
           }else if(fmod($x, 1) != 0)
           {
         //  echo "hello";
               $w = '#'; 
           }else{
          // echo "here";
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
                       $w .= ' '. $nwords[$r];
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
          // echo $w;
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

h4{position:relative; clear:both;}
p {text-align:right; font-size:14px; background-color:transparent; color:#000;}


table{border:px solid #F00; width:100%;; margin-left:auto; margin-right:auto; border-collapse:collapse;}
table tr td{border:px solid #333; padding:2px; }

.td_bg_col{ }
img{}
p span{font-size:12px;}
/*th{background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;}*/

ul{display:block;}
ul li{list-style:decimal; list-style-position:inside;}
</style>
<script type="text/javascript">

function save(comp,cid,bank,state,amt,quotid,str)
{
//alert("hi");
//alert(comp+" "+cid+" "+frmdt+" "+todt+" "+service+" amt="+amt+" bank="+bank+" city="+city+"atm="+atm);
		if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	document.getElementById("test").innerHTML=xmlhttp.responseText;	
alert(xmlhttp.responseText);
if(xmlhttp.responseText=='0')
alert("Some Error Occurred");
else
{
//document.getElementById("resshow").innerHTML=xmlhttp.responseText;
//alert(document.getElementById("inv").innerHTML);
document.getElementById("inv").innerHTML=xmlhttp.responseText;
//alert(document.getElementById("inv").innerHTML);
PrintDiv('front');
}

	
	
    }
  }
 var url="insertrmninv.php";
  //alert("insertinv.php?comp="+comp+"&cid="+cid+"&frmdt="+frmdt+"&todt="+todt+"&serv="+service+"&amt="+amt+"&bank="+bank+"&atm="+atm+"&city="+city);
  //alert("getcustbank.php?val="+val);
//xmlhttp.open("GET","insertinv.php?comp="+comp+"&cid="+cid+"&frmdt="+frmdt+"&todt="+todt+"&serv="+service+"&amt="+amt+"&bank="+bank+"&atm="+atm+"&city="+city,true);
//xmlhttp.send();
var dat="comp="+comp+"&cid="+cid+"&bank="+bank+"&state="+state+"&amt="+amt+'&quot='+quotid+'&str='+str;
alert(dat);
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(dat);
}
</script>
</head>

<body>
<?php
         // echo "select id from contacts where short_name='$cid'";
          $result=mysqli_query($con,"select id,contact_first from contacts where short_name='$cid'");
                $row=mysqli_fetch_row($result); 
                $uid=$row[0];
              //  echo "select * from address_book where ref_id='$uid'";
                $result=mysqli_query($con,"select * from address_book where ref_id='$uid'");
                $addrow=mysqli_fetch_row($result); 
              //  echo "select billname from billcompany where cust_id='$cid'";
                $result=mysqli_query($con,"select billname from billcompany where cust_id='$cid'");
                $brow=mysqli_fetch_row($result); 
              // echo "select * from company_details where compid='".$comp."'";
				$compa=mysqli_query($con,"select * from company_details where compid='".$comp."'");
				$compro=mysqli_fetch_row($compa);
				$bk=$_POST['bank'];
                ?>
<div id="annexure">
<table border="1">

<tr><td>Sr No</td><td>Customer</td><td>Bank</td><td>ATM ID</td><td>CITY</td><td>State</td><td>Zone</td><td>Location</td><td width="120px">Work Details</td><td>Month</td><td>Approval Date</td><td>Approval Amount</td><td>Approved By</td></tr>
<?php
$total=0;

for($i=0;$i<count($rmnid);$i++){
$ann=mysqli_query($con,"select q.totalcost,q.mailperson,q.sitetype,q.trackerid,q.cust_id from quotation q,".$cid."_sites s where  q.quotid='".$rmnid[$i]."' and q.status<>'0'");
$anr=mysqli_fetch_row($ann);
if($anr[2]=='rnmsites')
$str="select bank,atm_id1,city,state,zone,location from rnmsites where id='".$anr[3]."'";
else
$str="select bank,atm_id1,city,state,zone,location from ".$anr[4]."_sites where trackerid='".$anr[3]."'";
//echo $str;
$site=mysqli_query($con,$str);
$sitero=mysqli_fetch_row($site);
//echo "select material from quot_details where quotid='".$rmnid[$i]."' and status=0";
$wrk=mysqli_query($con,"select material from quot_details where quotid='".$rmnid[$i]."' and status=0");
//echo "select apptime from quotapproval where quotid='".$rmnid[$i]."' and level='3'";
$mon=mysqli_query($con,"select apptime from quotapproval where quotid='".$rmnid[$i]."' and level='3'");
$monro=mysqli_fetch_row($mon);
$j=0;
$w='';

?>
<tr><td><?php echo $i+1; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $sitero[0]; ?></td><td><?php echo $sitero[1]; ?></td><td><?php echo $sitero[2]; ?></td><td><?php echo $sitero[3]; ?></td><td><?php echo $sitero[4]; ?></td><td><?php echo $sitero[5]; ?></td><td>
<?php while($wro=mysqli_fetch_row($wrk))
{
if($j==0)
 $w=$wro[0];
else
 $w=$w.", ".$wro[0];

$j=$j+1;
}
echo $w;
 ?></td>
 <td><?php echo date('F',strtotime($monro[0])); ?></td>
 <td><?php echo date('d/m/Y',strtotime($monro[0])); ?></td>
 <td align="right"><?php echo number_format($anr[0],2); ?></td>
 <td><?php 
 $amt=round($anr[0]);
  $total=($total+$amt);
 echo $anr[1]; ?>
 </td></tr>

<?php

}
?>
<tr><td colspan="11" align="center"><b>Total</b></td><td colspan='1' align="right">INR <?php echo number_format($total,2); ?></td><td></td>
</table>
</div







<br><br>
<center></center>

<br><br>

<div id="print_div">

<table border="1">
    <thead>
     <tr>
     <th colspan="6"><b>TAX INVOICE</b></th>
     </tr>
     
     
     </thead>
     <tbody>
     <tr ><td width="50%" valign="top">&nbsp;</td><td width="50%" valign="top" align="right"><table border="0">
  <tr>
  <td align="right" colspan="">Invoice No :</td><td id="inv"> CSS/RNM/<?php echo $inv; ?>/<?php echo $invdate; ?>
  </td></tr>
  <tr><td align="right">
 Date :</td><td align="left"> <?php echo date("d M,Y"); ?> </td></tr></table>
  </td></tr>
      
        
        
        <tr>
         <td colspan="" class="td_bg_col" width="50%" style="border:none;">
          <fieldset>
                   <legend> <b>To,</b></legend>
                   <?php echo "<b>".$addrow[3]."</b><br>".$addrow[5]."<br>".$addrow[6]."<br>".$addrow[7]."<br>".$addrow[8]."<br>".$addrow[11]; ?>             
              </fieldset>
        
        </td>
        
        <td style="text-align:left; border:none; padding-left:170px;"  colspan="4">
        
        <?php
        $vt='';
        $shrt='';
         if($_POST['state']!=''){
        $addr=mysqli_query($con,"select cssaddress,avatno,shortterm from statevat where state='".$_POST['state']."'");
        if(mysqli_num_rows($addr)>0){
        $add=mysqli_fetch_row($addr);
        if($add[0]!=''){
     
        ?>
        <b>From,</b><br />
        Clear Secured Services Pvt. Ltd.<br />
        <?php
        echo nl2br($add[0]);
        }
          $vt=$add[1];
       $shrt=$add[2];
        }
         ?>
     
	
   
	<?php } ?>

        
        
        
        </td>
        
        </tr>
        
        
        <tr>
            <td colspan="6" style="text-align:left;">
               
               <strong> Subject :- Bill for Approval Work Done for <?php if($_POST['bank']!=''){ echo $_POST['bank']; }else{ echo "All"; } ?> Bank of <?php if($_POST['state']!=''){ echo $_POST['state']; }else{ echo "All"; } ?> State (<?php echo date('F - Y') ?>.) </strong>
               
            </td>
        </tr>
       
        
        
        <tr>
        <td colspan="6">
     
        
        
        <table border="1" width="100%" style="border-collapse:collapse;">





 <tr>
 <td colspan="2" style="border-collapse:collapse;">
 <table width="100%" border="1" style="border-collapse:collapse;">
 
 
 <tr><td><b>S.NO.</b></td><td><b>DESCRIPTION</b></td><td> </td><td><b>Amount</b></td></tr>
  <tr><td>1</td><td>RNM Bill for <?php echo $_POST['bank']; ?></td><td> </td><td>&nbsp;</td></tr>
<?php 
for($i=0;$i<count($rmnid);$i++){
//echo "<br>select * from quotation where quotid='".$rmnid[$i]."'";
$qr=mysqli_query($con,"select * from quotation where quotid='".$rmnid[$i]."'");
$qrro=mysqli_fetch_row($qr);
//echo "<br>select * from ".$qrro[3]."_sites where trackerid='".$qrro[4]."'";
$site=mysqli_query($con,"select * from ".$qrro[3]."_sites where trackerid='".$qrro[4]."'");
$sitero=mysqli_fetch_row($site);


}

 ?>
 
  
 <tr><td><p></p></td><td>Total Amount</td><td></td><td class="numalign"> <?php echo number_format($total,2);
 $gtot=0;
 $gtot=$gtot+$total;
 $mtax=30;//material value tax
 $ltax=70;//labour value tax
 $stax=12;//service tax
 $edutax=2;//education tax
 $hedutax=1;//higher education tax
 $mval=($mtax/100)*$total;
$lval=($ltax/100)*$total;
$svch=($stax/100)*$lval;
//if no additional tax is applicable for this state
//echo "select vat from state where state='".$_POST['state']."' and vat='Y'";
 $st2=mysqli_query($con,"select vat from state where state='".$_POST['state']."' and vat='Y'");
 if(mysqli_num_rows($st2)==0)
$svch=($stax/100)*$total;


$gtot=$gtot+$svch;
$etx=($edutax/100)*$svch;
 $gtot=$gtot+$etx;
$hetx=($hedutax/100)*$svch;
 $gtot=$gtot+$hetx;
 $mv=0;
 $lv=0;
 $mvat=0;
 $lvat=0;
 $avat=0;
  ?> </td></tr>
 <?php 
// echo $_POST['state'];
 if($_POST['state']!=''){
 //echo "select vat from state where state='".$_POST['state']."'";
 $st=mysqli_query($con,"select vat from state where state='".$_POST['state']."'");
 $stro=mysqli_fetch_row($st);
 //echo $stro[0];
 $tttx=array();
 $ttxtype=array();
$ataxa='N';
$stvatid=0;
if($stro[0]=='Y')
 {
 //echo "select * from statevat where state='".$_POST['state']."'";
 $tax=mysqli_query($con,"select * from statevat where state='".$_POST['state']."'");
 if(mysqli_num_rows($tax)>0){
 
 $taxro=mysqli_fetch_row($tax);
 $stvatid=$taxro[0];
 $tttx[]=$taxro[2];
 $ttxtype[]="mvat";
 $tttx[]=$taxro[3];
 $ttxtype[]="avat";

 $ataxa='Y';
 $mvat=($taxro[2]/100.00)*$mval;
 $avat=($taxro[3]/100.00)*$lval;
 $mv=$taxro[2];
 $av=$taxro[3];
 ?>
 <tr><td width="5%"></td><td  width="30%">Material Value @ <?php echo $mtax; ?>% of Base Value</td><td  width="20%" class="numalign"><?php echo number_format($mval,2);  ?> </td><td  width="25%"></td></tr>
 
 <tr><td></td><td>Labour Value @ 70% of Base Value</td><td class="numalign"><?php echo number_format($lval,2);  ?> </td><td></td></tr>
 <?php if($mv>0){ ?>
 <tr><td></td><td>Add:<?php echo $shrt; ?> @<?php echo $mv; ?>% on Material Value</td><td></td><td class="numalign"><?php
 $gtot=$gtot+$mvat;
  echo number_format($mvat,2); ?> </td></tr>
 <?php  }
 if($av>0){ ?>
 <tr><td></td><td>Add: Additional VAT @<?php echo $av; ?>% on Material Value</td><td></td>
 <td class="numalign"><?php
 $gtot=$gtot+$avat;
  echo number_format($avat,2);  ?> </td></tr><?php } ?>
 <?php
 }
 }
 }
 $servtot=0;
 $servtot=$servtot+$svch+$etx+$hetx;
 
 
  ?>
 
 
 <tr><td></td><td >Add: Service tax @ 12%<?php if($stro[0]=='Y')
 { ?> on Labour Value <?php } ?></td><td class="numalign"><?php echo number_format($svch,2); ?> </td><td></td></tr>
 
 <tr><td></td><td >Education Cess @ 2 %  on S.Tax </td><td class="numalign"><?php echo number_format($etx,2); ?> </td><td></td></tr>
 <tr><td></td><td >H.Edu.Cess @ 1 %  on S.Tax</td><td class="numalign"><?php echo number_format($hetx,2); ?> </td><td class="numalign"><?php echo number_format($servtot,2); ?> </td></tr>
 
 
 
 
 <tr><td style="border-bottom:none;"></td><td style="border-bottom:none;"></td><td> Grand Total</td><td class="numalign">INR <?php echo number_format($gtot,2); ?> </td></tr>
<tr><td style="border-top:none; border-bottom:none;"></td><td style="border-top:none; border-bottom:none;"></td><td>Less Advance Received</td><td></td></tr>
 <tr><td style="border-bottom:none; border-top:none;"></td><td style="border-bottom:none; border-top:none;"></td><td>Less Debit</td><td></td></tr>
 <tr><td style="border-top:none; "></td><td style="border-top:none; "></td><td>NET PAYABLE</td><td class="numalign">INR <?php echo number_format(round($gtot),2); ?> </td></tr>
 
 
 
 </table>
 
 </td>



<!-- <td>                            </td>-->
 
 
 

 
 </tr>

</table>
        
       
        </td>
        </tr>
        
      
       
        <tr>
            <td colspan="<?php if($stro[0]=='Y'){}else{ echo "2"; } ?>" height="250" valign="top" style="border-right:none">
            {Rupees : <b><?php  $st=int_to_words(round($gtot)); echo $st; ?> Only.</b>}
             <br /><br /><br /><br />
            
            Service Tax No:- <?php echo $compro[3]; ?>.	<br />
			PAN. No:- <?php echo $compro[2]; ?>.<?php  if($stro[0]=='Y'){ ?>	<br />
			<?php echo $shrt." # ".$vt; ?><?php } ?> <br />	
			Service Tax Category : RNM	
                
            <?php
            if($stro[0]=='Y'){
            ?> </td>
            
            
            <td colspan="" style="border-left:none">
           <?php } ?> 
            <br /><br />
            <?php
            if($stro[0]!='Y'){
            ?><hr>
            <p align="justify">I/We hereby certify that my/our registration certificate under the Maharashtra Value Added Tax Act. 2002 is in force on the date on which the sale of  the goods specified in this "Tax Invoice"  is made by me/us and that the transaction of sales covered by this Tax Invoice has been effected by me/us and it shall be accounted  for in  the turn over of  sales while filing return and due tax, if any payable on the sales has been paid shall be paid.</p><hr>
            <table><tr><td><b>E & O.E.</b></td><td><u>Terms & Conditions:</u></td></tr>
            <tr><td><b>Note :-</b></td><td>1. Payment Should be made in favour of Clear Secured Services Pvt Ltd</td></tr></table>
            <?php
            }
            
            ?>
            
            <br /><br /><br />
                
                <p <?php if($stro[0]!='Y'){ echo "align='left'";  } ?>><strong>For Clear Secured Services Pvt Ltd</strong>
                    
                </p>
                <br />
                
                <p <?php if($stro[0]!='Y'){ ?> align='left'<?php  } ?>>
                   <h4  style="float:right"><strong> Authorized by </strong></h4>
                </p>
            </td>
            
        </tr>
        
    </tbody>
</table></div>
<div id="hide"><?php //echo $mtax;
 //echo "<br>".$ltax;//labour value tax
 //echo "<br>".$stax;//service tax
 //echo "<br>".$edutax;//education tax
 //echo "<br>".$hedutax;
 $atx=implode(",",$tttx);
 $atxtp=implode(",",$ttxtype);
 //echo "<br>".$ataxa;
// echo "<br>".$stvatid;
 $strr=$ataxa."-".$stvatid."-".$ltax."-".$stax."-".$edutax."-".$hedutax."-".$atx."**".$atxtp;
  ?>
<center><a onclick="PrintDiv('front');" href="#" onmouseover="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print</font></a>

<?php if(!isset($_POST['tttt'])){ ?><input type="button" name="cmd" value="Save And Print" onclick="save('1','<?php echo $cid; ?>','<?php echo $bk; ?>','<?php echo $_POST['state']; ?>','<?php echo round($gtot); ?>','<?php echo $q; ?>','<?php echo $strr; ?>');" /><?php  } ?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="myButtonControlID" onClick="tableToExcel('billtable', 'Table Export Example')">Export Table data into Excel</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a  href="viewRmn.php?cid=<?php echo $cid ?>&stdt=<?php echo $_POST['stdt']; ?>&todt=<?php echo $_POST['enddt']; ?>&serv=<?php echo $service; ?>&comp=<?php echo $comp; ?>" onmouseover="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333">Back</font></a><br/>



</center></div>
<div id="test"></div>
</body>
</html>
