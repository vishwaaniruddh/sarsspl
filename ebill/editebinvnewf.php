<?php 
session_start();

//echo $_SESSION['user'];
if(!isset($_SESSION['user']))
header('location:index.php');

include("config.php");
?>


<style>
th
{
font-size:12px;
}
</style>
<center><a href="viewoldebinv.php?invid=<?php echo $_GET['invid']; ?>"> View New Invoice</a></center>
<?php ini_set( "display_errors", 0);
$id = $_GET['invid'];
//echo "select * from send_bill where send_id='".$id."'";
//echo "select * from send_bill where send_id='".$id."'";
$inv=mysqli_query($con,"select * from send_bill where send_id='".$id."'");
$invro=mysqli_fetch_row($inv);
 $cid=$invro[1];
 $bid=$invro[2];
 $comp=$invro[6];

//echo $_SESSION['token']." ".$tok;	
//if($id!=2) echo "You are not authorised to see this page";
// header('Location:managesite1.php?id='.$id); 
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
include("config.php");


			
              	
//echo "select * from company_details where compid='$comp'";
$rescomp=mysqli_query($con,"select * from company_details where compid='$comp'");
//echo "select cust_name from ".$cid."_sites";
$qry=mysqli_query($con,"select cust_name from ".$cid."_sites");
                $r1=mysqli_fetch_row($qry); 
                $cust_name=$r1[0];
           $rowcomp=mysqli_fetch_row($rescomp); 
		  // echo "select * from ebillcharges where Cid='$cid' and Bid='$bid'";
		   $chrg="select * from ebillcharges where Cid='$cid'";
		   if($cid=='EUR08')
		   $chrg.=" and type='".$_POST['type']."'";
		  // echo $chrg;
$qry1=mysqli_query($con,$chrg);  
//echo mysqli_num_rows($qry1); 
if(mysqli_num_rows($qry1)>0)         







   $raterow=mysqli_fetch_row($qry1); 
   else
   {
    $qr=mysqli_query($con,"select * from ebillcharges where Cid='$cid' and Bid='All'");  
    $raterow=mysqli_fetch_row($qr); 
   }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	color: #0080FF;
	font-weight: bold;
}
body {
	background-color: #FFFFFF;
}


</style>
<script type="text/javascript">
 function removeatm(id,cnt)
  {
  var prevt=document.getElementById('prevtotal').value;

 	var prevt1=document.getElementById('prevtotal1').value;
  //alert(prevt);
  if (confirm('Are you sure you want to Remove this from list?')) {
    // Save it!
	 
 	//alert(prevt);
 	 	//alert(prevt1);
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
		
alert(xmlhttp.responseText);
if(xmlhttp.responseText=='1')
document.getElementById('rem'+cnt).innerHTML="Removed Successfully";
else
alert("Some Error Occurred. Please Refresh your page and try again");
	
	
    }
  }
//alert("reminvsite.php?id="+id+"&tbl=send_bill_detail&stat=1");
xmlhttp.open("GET","reminvsite.php?id="+id+"&prevtot="+prevt+"&prevtot1="+prevt1+"&tbl=send_bill_detail&stat=1&field=detail_id",true);
xmlhttp.send();
}
  }
  
  function showdiv(id)
  {
  //alert(id);
 // alert(document.getElementById('amt'+id).checked); 
  if(document.getElementById('amt'+id).checked=="true")
 document.getElementById('cngamt'+id).style.display="block";
  elseif(document.getElementById('amt'+id).checked=="false")
  document.getElementById('cngamt'+id).style.display="none";
  }
</script>
</head>

<body onload="getprevamt()">
<script type="text/javascript">  

var gtotal=0;   
        function PrintDiv() {    
           var divToPrint = document.getElementById('front');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
 function getprevamt()
 {
 var prevamt=document.getElementById('total').innerHTML;
 document.getElementById('prevtotal').value=prevamt;

 var prevamt1=document.getElementById('grandtotalamt').innerHTML;
 document.getElementById('prevtotal1').value=prevamt1;
 
 }

        function PrintDiv1() {    
           var divToPrint = document.getElementById('back');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
				 function PrintDiv2() {    
           var divToPrint = document.getElementById('page3');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
     <div id='front'>
  <!--
<center><img src="image002.jpg" width="520" height="60" /></center>-->
  <div align="center">
  <!-- <h2>E-BILL INVOICE</h2> -->
</div>
<?php 
$currentdate=date('Y-m-d');





                $cust_id1=$cid;
				
						
				$resul4=mysqli_query($con,"select id from contacts where short_name='$cust_id1'");
                $ro4=mysqli_fetch_row($resul4); 
                $uid1=$ro4[0];
				
                $resul5=mysqli_query($con,"select * from address_book where ref_id='$uid1'");
                $addrow1=mysqli_fetch_row($resul5); 
                $resul6=mysqli_query($con,"select billname from billcompany where cust_id='$cust_id1'");
                $brow1=mysqli_fetch_row($resul6); 
                $cm='';
               
   
		
	 ?>




<p>
</p><br><br><br>
<table width="997" cellpadding="0" cellspacing="0">
  <tr height="150px"><td>&nbsp;</td></tr>
  <tr height="17">
    <td height="17" width="393"><b>To,</b></td>
    <td width="300">&nbsp;</td>
     <td width="302" rowspan="8" align="left" valign="top"><div align="left">Invoice No:-<?php 
   echo  $invro[5]; ?>
    </div>
    <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date :- <?php echo date("d-F-Y"); ?></div></td>
    
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><b><?php echo $addrow1[3]; ?></b></td>
    </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[5]; ?></td>
    </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[6]; ?></td>
    </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[7]."-".$addrow1[9]; ?></td>
    </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[8].",".$addrow1[10]; ?></td>
    </tr>
<tr height="18">
    <td height="18" colspan="2"><?php echo "Phone:".$addrow1[11]; ?></td>
    </tr><tr>
    <td colspan="2"><table width="737" height="84" align="right" cellpadding="0" cellspacing="0">
 <tr><td height="41">&nbsp;</td>
 </tr>
  <tr height="18">
  
    <td height="19" colspan="2"></td>
  </tr>
  <tr height="20">
    <td width="158" height="22"></td>
    <td width="22"><div align="left"></div></td>
  </tr>
  
</table></td>
     </tr>
</table>


<table width="995" height="185" border="0">
  <tr>
  <td width="989" height="45"><b>Sub:</b>&nbsp;&nbsp;  Reimbursement Of Electricity Bills.</td>
  </tr>
  <tr><td>

<form method="post" action="procedtbill.php" ><table width="988" border="1" cellpadding="4" cellspacing="0">
<input type="hidden" name="invid" value="<?php echo $id; ?>">
<input type="hidden" name="fisyr" value="<?php echo $_GET['yr']; ?>">
  <tr>
    <th width="28" scope="col"><div align="center">Sr No. </div></th>
    <th width="44" scope="col" ><div align="center">BANK</div></th>
    <th width="44" scope="col" ><div align="center">ATM ID</div></th>
      <th width="75" scope="col" ><div align="center">SITE ID</div></th>
       <th width="185" scope="col" >
         <div align="center" onClick="this.contentEditable='true';">CONSUMER NO.</div>       </th> 
          <th width="185" scope="col" >
         <div align="center">CONSUMER Name</div>       </th> 
    <th width="90" scope="col" ><div align="center">LOCATION</div></th>
  
    <th width="53" scope="col" colspan="2"><div align="center">BILLING PERIOD </div></th>       
   
    <th width="48" scope="col"><div align="center">PAID DATE</div></th>  
     <th width="83" scope="col"><div align="center">BILL DATE </div></th>
        <th width="67" scope="col"><div align="center">UNITS</div></th> 
        <th width="83" scope="col">Remove</th>
        <th width="400px" scope="col"><div align="center">BILL DATE </div></th>
    <th width="72" scope="col"><div align="center"> Change Amount</div></th>   
      
  </tr>
  <?php $sum=0;$schrg=0;
$ij=0;
 // echo "select * from send_bill_detail where send_id='".$id."'";
  $ann=mysqli_query($con,"select * from send_bill_detail where send_id='".$id."' and status=0");
$cb=mysqli_num_rows($ann);
        while($annr=mysqli_fetch_array($ann))
             {
		$ij=$ij+1;
$sum=$sum+$annr[12];

                $nsql = "select * from ".$cid."_ebill where atmtrackid='$annr[2]'";// echo $nsql;
                
				
                $result = mysqli_query($con,$nsql);
             
		$row = mysqli_fetch_row($result);
		
	$ress = mysqli_query($con,$sqll);
	//	echo "select location,site_id,bank from ".$cid."_sites where trackerid='$annr[1]'";
		    $res=mysqli_query($con,"select location,site_id,bank,atm_id1 from ".$cid."_sites where trackerid='$annr[2]'");
                $rows=mysqli_fetch_row($res); 
                 //$rc=mysqli_query($con,"select extrachrg from ebpayment where Bill_No='$annr[20]'");
                //$rcrows=mysqli_fetch_row($rc); 
                $location=$rows[0];
				              
			// $sum=$sum+$row1[4];	
			 $schrg=$schrg+$row[7];	
			 $month=date('F',strtotime($row1[7]));	
			
		
				 
				 $row3 = mysqli_fetch_row($res1);
				 //echo $row3[2];
	?>
		 <tr><td height="28" align="center">&nbsp;<?php echo $ij; ?></td>
         <td align="center">&nbsp;<?php echo $rows[2]; ?></td>
		     <td align="center">&nbsp;<?php echo $rows[3]; ?></td>
             <td align="center">&nbsp;<?php echo $rows[1]; ?></td>
             <td align="center">&nbsp;<?php echo $row[1]; ?></td>
             <td align="center">&nbsp;<?php echo $row[5]; ?></td>
			 <td align="center">&nbsp;<?php echo  $location; ?></td>
			 
			 <td align="center" width="40" >&nbsp;<?php if(isset($annr[9]) and $annr[9]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[9])); } else{ echo "NA"; } ?></td>			 			              
			  <td align="center" width="40" >&nbsp;<?php if(isset($annr[10]) and $annr[10]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[10])); } else{ echo "NA"; } ?></td>			 			              
		      <td align="center" width="40" >&nbsp;<?php  if(isset($annr[13]) and $annr[13]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[13])); }
		      else{ echo "NA"; }//$bills[$i]; 
		      ?></td>
                <td align="center" width="40" >&nbsp;<?php if(isset($annr[6]) and $annr[6]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[6])); }
                else{ echo "NA"; } ?></td>
                 <td align="center" width="40" >&nbsp;<?php echo $annr[8]; ?></td>
               		 			              
			 <td align="right" width="72" ><?php echo number_format((float)($annr[12]), 2, '.', ''); ?></td>			
                      <td><div id="rem<?php echo $ij;  ?>"><a href="#" onclick="removeatm('<?php echo $annr[0]; ?>','<?php echo $ij;  ?>')"><img src="cancel.jpg" height="20px" width="20px"></a></div></td>
                      <td width="400px"><!--<input type="checkbox" name="amt[]" id="amt<?php echo $ij;  ?>" onclick="showdiv('<?php echo $ij;  ?>')">-->
                      <div id="cngamt<?php echo $ij;  ?>" style="display:block">
                      <input type="hidden" name="detid[]" value="<?php echo $annr[0]; ?>"><input type="hidden" name="reqid[]" value="<?php echo $annr[20]; ?>">
                      <table>
                      	<tr><td>Paid Amount:</td><td><input type="text" name="pamt[]" value="<?php echo $annr[12]; ?>" style="width:50px"></td></tr>
                      	<tr><td>Extra Charge:</td><td><input type="text" name="exchrg[]" value="<?php echo $annr['extrachrg']; ?>" style="width:50px"></td></tr>
                      	<tr><td>RC Charge:</td><td><input type="text" name="rcchrg[]" value="<?php echo $annr['recon_chrg']; ?>" style="width:50px"></td></tr>
                      	<tr><td>DC Charge:</td><td><input type="text" name="dcchrg[]" value="<?php echo $annr['discon_chrg']; ?>" style="width:50px"></td></tr>
                      	<tr><td>Security Deposit:</td><td><input type="text" name="sdchrg[]" value="<?php echo $annr['sd']; ?>" style="width:50px"></td></tr>
                      	<!--<tr><td>After Due Date Charges:</td><td><input type="text" name="adcchrg[]" value="<?php echo $annr['after_duedt_chrg']; ?>" style="width:50px">--></td></tr>
                      </table>
                      
                      <br></div></td>
		</tr>
		<?php
	

		}
		if(isset($_SESSION['token']))
$res6=mysqli_query($con,"update send_bill set amount='".$sum."' where send_id='".$send_id."'");
?>
<tr><td colspan="12" align="right"><b>Total Billing Amount</b></td>
<td align="right" id="total"><?php echo number_format((float)$sum, 2, '.', ''); ?></td>

</tr>

</table>

<input type="text" id="prevtotal" name="prevtotal" ></input>
<input type="text" id="prevtotal1" name="prevtotal1" ></input>


<p align="left"><b>(Rs.  <?php $st=int_to_words($sum); echo $st." Only"; ?>  )</b></p>

<input type="submit" name="cmdsub" value="Submit">

</form><br /><br />
<!--<table width="100%"><tr><td align="center" width="50%"><?php echo $_SESSION['user']; ?><br />E-Bill Executive</td>
<td width="50%" align="center">Bharat Pundit<br />E-Bill Head</td></tr></table><br /><br />-->
</br><div  align="right"><b>For :<?php echo $rowcomp[1]; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></br></br>
<br><br>


    <div  align="right"><b>Authorised Signatory<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>



</td></tr>
</table></div>
<br/><br/>
<center><a onclick='PrintDiv();' href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 1 </font></a><br/></center>


<?php
        
/////////////////////////////////////	
$atm=$row[3];	
    
	$result3=mysqli_query($con,"select cust_id,atmsite_address from ".$cid."_sites where atm_id1='$atm'");
                $row3=mysqli_fetch_row($result3); 
                $cust_id=$row3[0];
				
						
				$result4=mysqli_query($con,"select id from contacts where short_name='$cust_id'");
                $row4=mysqli_fetch_row($result4); 
                $uid=$row4[0];
				
                $result5=mysqli_query($con,"select * from address_book where ref_id='$uid'");
                $addrow=mysqli_fetch_row($result5); 
                $result6=mysqli_query($con,"select billname from billcompany where cust_id='$cust_id'");
                $brow=mysqli_fetch_row($result6);
				
     ?>
	 <!--<div id='back' >
	 
			
			<table height="564">
            <tr height="150px"><td></td></tr>
            <tr><td width="983">
			<table width="332" align="right" cellpadding="0" cellspacing="0">
  <col width="151" />
  <col width="72" />
  <tr height="18">
    <td height="18" colspan="2">Invoice No:-  <?php 
    if($comp==1){
		echo "CSS";
	}else if($comp==2){
		echo "C&C";
	}else if($comp==3){
		echo "CS";
	}
    ?>EB<?php echo $newinvoice_no; ?>A<?php if(date('m')>='4'){ echo date('y')."".date('y',strtotime('+1 year')); }else{ echo date('y',strtotime('-1 year'))."".date('y'); } ?></td>
  </tr>
  <tr height="20">
    <td width="208" height="20">Bill Date : <?php echo date("d.m.Y"); ?></td>
    <td width="4">&nbsp;</td>
  </tr>
  <tr height="20">
    <td width="208" height="20">Bank : <?php echo $bid; ?></td>
    <td width="4">&nbsp;</td>
  </tr>
   <tr height="20">
    <td width="208" height="20">Service Tax No : AADCC5952HST001</td>
    <td width="4">&nbsp;</td>
  </tr>
   <tr height="20">
    <td width="208" height="20">PAN. No : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AADCC5952H</td>
    <td width="4">&nbsp;</td>
  </tr>
</table>

 <table cellspacing="0" cellpadding="0">
 
  <tr height="17">
    <td height="17" width="74"><b>To,</b></td>
    <td width="189">&nbsp;</td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[3]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[5]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[6]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[7]."-".$addrow1[9]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[8].",".$addrow1[10]; ?></td>
  </tr>
<tr height="18">
    <td height="18" colspan="2"><?php echo "Phone:".$addrow1[11]; ?></td>
  </tr>
    <td height="18" colspan="2"></td>
  </tr>
</table>
<?php
  $billing=implode($bills);
$to=0;

$bnk=array();
//echo "select * from ebillfundrequests where bill_no in ($billing)";
 $n1sql44 = "select * from ebillfundrequests where bill_no in ($billing)";
              $result144 = mysqli_query($con,$n1sql44);
             while($row144 = mysqli_fetch_row($result144))
			 {
			 //echo "select bank from ".$cid."_sites where atm_id1='".$row144[1]."'";
			  $bnk44=mysqli_query($con,"select bank from ".$cid."_sites where atm_id1='".$row144[1]."'");
$bnkro44=mysqli_fetch_row($bnk44);
$bnk[]=$bnkro44[0];
//echo "select * from ebillcharges where Bid='$bnkro44[0]' and Cid='".$cid."'";
$sl44=mysqli_query($con,"select * from ebillcharges where Bid='$bnkro44[0]' and Cid='".$cid."'");
if(mysqli_num_rows($sl44)>0){
$rs44=mysqli_fetch_row($sl44);
}
else
{
$sl44='';
$sl44=mysqli_query($con,"select * from ebillcharges where Bid='-1' and Cid='".$cid."'");
$rs44=mysqli_fetch_row($sl44);
}
 $to=$to+$rs44[2];
}
?>
<table width="982" height="261" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
<tr><td colspan="5">PARTICULARS</td><td>AMOUNT</td><td></td></tr>
<tr>
<td height="186" colspan="5" align="left"><b>Reimbursement for electricity bills paid towards <?php echo implode(",",$bnk); ?> Bank ATM</b><br /><br /><br /><br />
Service Category : Electricity Bill</td>
<td width="80" align="right" valign="top"><br />
  <br /><br /><?php 

  
  echo  $to=$to; ?></td>
<td width="79">&nbsp;</td>
</tr>

<?php
//print_r($bills);

/*if($rs[3]==0){

}
else{*/

/*echo $to;
$svt=$to*0.12;
$ec=$svt*0.02;
$shec=$svt*0.01;
$gtotal=$to+$svt+$ec+$shec;*/



?><tr>
<td colspan="5" align="right">Service Tax@14%</td><td width="424" align="right"><?php echo $svt; ?></td><td></td>
</tr>
<td colspan="5" align="right"> Education Cess @<?php echo $rs[4]; ?>%</td><td align="right"><?php echo $svt1; ?></td><td></td></tr>
<td colspan="5" align="right">Secondary &amp; Higher Education Cess    @<?php echo $rs[5]; ?>%</td><td align="right"><?php echo $svt2; ?></td><td></td></tr>
<tr>


  <td colspan="5" align="right"><b>Grand Total</b></td>
    
    <td align="right" ><?php echo formatTwoDecimals($gtotal, "."); ?></td>
    <td></td>
</tr>

<?php // } ?>
</table>

<br/>
<table width="100%"><tr><td align="center" width="50%"><?php echo $_SESSION['user']; ?><br />E-Bill Executive</td>
<td width="50%" align="center">Bharat Pundit<br />E-Bill Head</td></tr></table>
</td></tr></table>
</div><br/><br/><center><a onclick='PrintDiv1(); 'href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 2 </font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="generateEbill.php?cid=<?php echo $cid ?>&bid=<?php echo $bid ?>" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Back </font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->





			 


<!--  page 3 -->
<div id='page3' ><br><br><br>
			<?php
			function formatTwoDecimals($value, $trim)
{
   $after_comma = substr(strrchr($value, $trim), 0, 3);
   $in_front_of_comma = (int) $value;


   $fin = $in_front_of_comma . $after_comma;

   return $fin;
}
			?>
			<table height="564" border='0'>
          <tr height="150px"><td></td></tr>
            <tr><td width="983">
			<table width="242" align="right" cellpadding="0" cellspacing="0" border='0'>
  <col width="151" />
  <col width="72" />
  <tr height="18">
    <td height="18" colspan="2" align="left">Invoice No:-  <?php 
 
   echo  $invro[9];
    ?></td>
  </tr>
  <tr height="20">
    <td width="208" height="20" colspan="2" align="left" >&nbsp;&nbsp;&nbsp;&nbsp;Bill Date :- <?php echo date("d-F-Y"); ?></td>
    
  </tr>

</table>

 <table cellspacing="0" cellpadding="0" border='0'>
 
  <tr height="17">
    <td height="17" width="74"><b>To,</b></td>
    <td width="189">&nbsp;</td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><b><?php echo $addrow1[3]; ?></b></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[5]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[6]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[7]."-".$addrow1[9]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><?php echo $addrow1[8].",".$addrow1[10]; ?></td>
  </tr>
<tr height="18">
    <td height="18" colspan="2"><?php echo "Phone:".$addrow1[11]; ?></td>
  </tr>
    <td height="18" colspan="2"></td>
  </tr>
</table>

<table width="1005" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">


<tr><td width="87"><b>Sr.No </b></td>

<td width="176"><b>Bank</b></td>

<td width="176"><b>ATM ID</b></td>
<td width="114"><b>Service Charges Amount in INR</b> </td>
</tr>
<?php

$srno=0;
$to=0;
//echo "hello";
$ann='';
$annr='';
 $ann=mysqli_query($con,"select * from send_bill_detail where send_id='".$id."' and status=0");
$cb=mysqli_num_rows($ann);
        while($annr=mysqli_fetch_array($ann))
{
$srno=$srno+1;

			  $bnk=mysqli_query($con,"select bank,atm_id1 from ".$cid."_sites where trackerid='".$annr[2]."'");
$bnkro=mysqli_fetch_row($bnk);
$s2="select * from ebillcharges where Cid='".$cid."'";
if($cid=='EUR08')
$s2.=" and type='".$invro[7]."'";

//if($bid!='' || $bid!='All' || $bid!='-1')
//$s2.=" and Bid='".$bid."'";

if($cid!='AGS01')
{
  if($_POST['proj']!=''){
$s2.=" and type='".$invro[7]."'";
}}
//echo $s2;
$sl=mysqli_query($con,$s2);

$rs=mysqli_fetch_row($sl);

?>
<tr>

<td width="176"><?php echo $srno; ?></td>
<td width="176"><?php echo $bnkro[0]; ?></td>
<td width="176"><?php echo $bnkro[1]; ?></td>
<td align="right"><?php
//echo $cid." ".$_POST['tata'];
if($cid=='Tata05')
{
if($_POST['tata']!=''){
$to=$to+$rs[2].".00";
 echo $rs[2].".00";
}
else
{
$to=0;
echo "0.00";
}
}
else{
$to=$to+$rs[2].".00";
 echo $rs[2].".00";} ?></td>
</tr>
<?php
} ?>
<tr align="right"><td colspan="3">Gross Amount</td>
<td valign="top"><?php echo formatTwoDecimals($to, "."); ?></td></tr>

<tr>
<td colspan="3" align="right">Service Tax@14%<?php

/*echo  $to;
 $svt=$to*0.12;
 $ec=$svt*0.02;
 $shec=$svt*0.01;
 $gtotal=round($to+$svt+$ec+$shec);*/

//$to=$rsnew[2];
//echo $to;
$svt=$to*0.14;
$svt1=$to*0.005;
$svt2=$to*0.005;
$gtotal=$svt+$svt1+$svt2+$to;


  ?></td><td align="right"><?php echo formatTwoDecimals($svt, "."); ?></td></tr>
<!--<td colspan="3" align="right"> Education Cess @2%</td><td align="right"><?php echo formatTwoDecimals($ec, "."); ?></td>--->
<td colspan="3" align="right"> SBC@0.5%</td><td align="right"><?php echo formatTwoDecimals($svt1, "."); ?></td>
</tr>
<!---<td colspan="3" align="right">Secondary &amp; Higher Education Cess    @1%</td><td align="right"><?php echo formatTwoDecimals($shec, "."); ?></td>-->
<td colspan="3" align="right">KKC@5%</td><td align="right"><?php echo formatTwoDecimals($svt1, "."); ?></td>
</tr>
<tr>


  <td colspan="3" align="right"><b>Grand Total</b></td>
    
    <td align="right" name="grandtotalamt" id="grandtotalamt"><?php echo formatTwoDecimals($gtotal, "."); ?></td>
   
</tr>
</table>

  
<div  align="left"> 
<table width="1006">
<tr height="50px"><td colspan="2">(Rs.  <?php $gtot=int_to_words($gtotal); echo $gtot." only"; ?>) </td></tr>
  <tr><td width="276" align="left">
    <p>Service    Tax No:- <?php echo $rowcomp[3]; ?> </p>
<p>      PAN    No:- <?php echo $rowcomp[2]; ?></p>
    <p>Service Category : Electricity Bill<br/>
      
        </p></td><td width="210" align="right">


<b>For :<?php echo $rowcomp[1]; ?></b><br><br><br><br><b>Authorised Signatory</b></td>
  </tr></table></div> 

<!--</br></br><table width="100%"><tr><td align="center" width="50%"><?php echo $_SESSION['user']; ?><br />E-Bill Executive</td>
<td width="50%" align="center">Bharat Pundit<br />E-Bill Head</td></tr></table></br></br>-->
</td></tr></table>
</div>
<a onclick='PrintDiv2(); 'href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 2 </font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="generateEbill.php?cid=<?php echo $cid ?>&bid=<?php echo $bid ?>" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Back </font></a>
 <?php //} ?>
</center>

</body>
</html>
<?php
if(isset($_SESSION['token']))
unset($_SESSION['token']);

 $_SESSION['token']=(rand(10,100000));
$final='';
 if($cid=='Tata05')
		{
   if($comp==1){
		$final.=$cm="CSSEB";
	}else if($comp==2){
		$final.=$cm="C&CEB";
	}else if($comp==3){
		$final.="CS";
	}
    $final.= $newinvoice_no;
    $finalinvoice=$final."".$invdate;
     }
    else
    {
     if($comp==1){
		$final.=$cm="CSS/EB/";
	}else if($comp==2){
		$final.=$cm="C&C/EB/";
	}else if($comp==3){
		$final.="CS/";
	}
    $final.= $newinvoice_no;
    $finalinvoice=$final."/".$invdate;
    
    } 
echo $bill_no=$finalinvoice;
$bdate=date("d.m.Y");

$email=array("sshinde@cssindia.in", "pgupta@cssindia.in", "ebill@cssindia.in", "vimal@cssindia.in","accounts@cssindia.in","billdesk@cssindia.in");

$em=count($email);
for($i=0;$i<$em;$i++){
$pfw_header = "From: support@sarmicrosystems.in";

// EDIT My Contact Form, to yours
$pfw_subject = "eBill details ";

// EDIT to your email address
$pfw_email_to = "$email[$i]";

$pfw_message = "Company Name: \t $addrow1[3] \n\n"  
. "Bill No.: \t $bill_no \n\n"
."Bill Date: \t $bdate \n\n"
."Amount: \t $sum \n\n"
."Bank name: \t $bid \n";
//@mail($pfw_email_to, $pfw_subject ,$pfw_message, $pfw_header ) ;
}
?>