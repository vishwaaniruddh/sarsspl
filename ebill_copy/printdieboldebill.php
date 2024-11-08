<style>
th
{
font-size:12px;
}
</style>
<?php ini_set( "display_errors", 0);
$id = $_GET['id'];

include("config.php");
$sendid=$_GET['sendid'];
$send=mysqli_query($con,"select * from send_bill where send_id='".$sendid."'");
$sendro=mysqli_fetch_row($send);
$cid=$sendro[1];
$bid=$sendro[2];
$comp=$sendro[6];

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

			
              	
$qr=mysqli_query($con,"select * from send_bill_detail where send_id='".$sendid."'");
$bills=array();
while($qrro=mysqli_fetch_array($qr))
{
$bills[]=$qrro[0];
}
//$bill=$_SESSION['$bills'];

$cb= count($bills);
//print_r($bill);
//echo "<br>".$cb;		
$rescomp=mysqli_query($con,"select * from company_details where compid='$comp'");
$qry=mysqli_query($con,"select cust_name from sites where cust_id='$cid'");
                $r1=mysqli_fetch_row($qry); 
                $cust_name=$r1[0];
           $rowcomp=mysqli_fetch_row($rescomp); 
		  // echo "select * from ebillcharges where Cid='$cid' and Bid='$bid'";
$qry1=mysqli_query($con,"select * from ebillcharges where Cid='$cid' and Bid='$bid'");  
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
</head>

<body>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('front');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
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
$newinvoice_no=$sendro[5];
//$res4=mysqli_query($con,"insert into send_bill(customer_name,bank,date,invoice_no,comp) values('$cust_name','$bid','$currentdate','$newinvoice_no','$comp')");


$send_id=$sendid;
$resul3=mysqli_query($con,"select cust_id,atmsite_address from sites where cust_name='$cid'");
                $ro3=mysqli_fetch_row($resul3); 
                $cust_id1=$ro3[0];
				
						
				$resul4=mysqli_query($con,"select id from contacts where short_name='$cust_id1'");
                $ro4=mysqli_fetch_row($resul4); 
                $uid1=$ro4[0];
				
                $resul5=mysqli_query($con,"select * from address_book where ref_id='$uid1'");
                $addrow1=mysqli_fetch_row($resul5); 
                $resul6=mysqli_query($con,"select billname from billcompany where cust_id='$cust_id1'");
                $brow1=mysqli_fetch_row($resul6); 
?>



<p>
</p>
<table width="997" cellpadding="0" cellspacing="0">
 
  <tr height="17">
    <td height="17" width="393"><b>To,</b></td>
    <td width="300">&nbsp;</td>
     <td width="302" rowspan="8" align="right" valign="bottom"><div align="center">Date : <?php echo date("d.m.Y"); ?></div></td>
    
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
    </tr><tr>
    <td colspan="2"><table width="737" height="84" align="right" cellpadding="0" cellspacing="0">
 <tr><td height="41">&nbsp;</td>
 </tr>
  <tr height="18">
  
    <td height="19" colspan="2"><div align="left">Invoice No:-
    <?php 
    if($comp==1){
		echo "CSS";
	}else if($comp==2){
		echo "C&C";
	}else if($comp==3){
		echo "CS";
	}
    ?>
    /EB/<?php echo $newinvoice_no; ?>/<?php echo date("Y"); ?></div></td>
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

<form method="post" action="showEbill.php" ><table width="988" border="1" cellpadding="4" cellspacing="0">
  <tr>
    <th width="28" scope="col"><div align="center">Sr No. </div></th>
    <th width="44" scope="col" ><div align="center">BANK</div></th>
    <th width="44" scope="col" ><div align="center">ATM ID</div></th>
      <th width="75" scope="col" ><div align="center">SITE ID</div></th>
       <th width="185" scope="col" >
         <div align="center">CONSUMER NO.</div>       </th> 
          <th width="185" scope="col" >
         <div align="center">CONSUMER Name</div>       </th> 
    <th width="90" scope="col" ><div align="center">LOCATION</div></th>
  
    <th width="53" scope="col" colspan="2"><div align="center">BILLING PERIOD </div></th>       
   
    <th width="48" scope="col"><div align="center">PAID DATE</div></th>  
     <th width="83" scope="col"><div align="center">BILL DATE </div></th>
        <th width="67" scope="col"><div align="center">UNITS</div></th> 
        
    <th width="72" scope="col"><div align="center"> AMOUNT</div></th>   
  </tr>
  <?php $sum=0;$schrg=0;
        for($i=0;$i<count($bills);$i++)///$i=0
             {
				
         $qry=mysqli_query($con,"select * from send_bill_detail where detail_id='".$bills[$i]."'");
$qryro=mysqli_fetch_row($qry);

$res=mysqli_query($con,"select location,site_id,bank from sites where atm_id1='$qryro[2]' or atm_id2='$qryro[2]'");
                $rows=mysqli_fetch_row($res); 
                $location=$rows[0];
				//echo "select * from ebill where ATM_ID='$qryro[2]'";
 $nsql = "select * from ebill where ATM_ID='$qryro[2]'"; //echo $nsql;
				 //$nsql = "select * from ebdetails where site_id='SN000523'";
                $result = mysqli_query($con,$nsql);
             
		$row = mysqli_fetch_row($result);
				 
//$res5=mysqli_query($con,"insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date) values('$send_id','$row1[1]','$row[2]','$location','$row[1]','$row1[2]','$row1[9]','$row1[3]','$row1[6]','$row1[7]','$month','$row1[4]','$row3[2]')");
				 	                                              
			?>
		 <tr><td height="28" align="center"><?php echo $i+1; ?></td>
         <td align="center"><?php echo $rows[2]; ?></td>
		     <td align="center"><?php echo $qryro[2]; ?></td>
             <td align="center"><?php echo $rows[1]; ?></td>
             <td align="center"><?php echo $row[1]; ?></td>
             <td align="center"><?php echo $row[5]; ?></td>
			 <td align="center"><?php echo  $location; ?></td>
			 
			 <td align="center"><?php echo date('d/m/Y',strtotime($qryro[9])); ?></td>			 			              
			  <td align="center"><?php echo date('d/m/Y',strtotime($qryro[10])); ?></td>			 			              
		      <td align="center"><?php   echo date('d/m/Y',strtotime($qryro[13])); //$bills[$i]; ?></td>
                <td align="center"><?php echo date('d/m/Y',strtotime($qryro[6])); ?></td>
                 <td align="center"><?php echo $qryro[8]; ?></td>
               		 			              
			 <td align="center"><?php
			 $sum=$sum+$qryro[12];
			  echo $qryro[12]; ?></td>			
		</tr>
		<?php
	

		}
		
$res6=mysqli_query($con,"update send_bill set amount='".$sum."' where send_id='".$send_id."'");
?>
<tr><td colspan="12" align="center"><b>Total Billing Amount</b></td>
<td align="center"><?php echo $sum.".00" ?></td></tr>
<!--<tr><td height="29" colspan="12"><b>[Rs.  <?php $st=int_to_words($sum); echo $st; ?>  ]</b>
</td></tr>-->
</table>
</form>

<!--</br><div  align="right">For Clear Secured Services Pvt Ltd. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></br></br>



    <div  align="right">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>


-->
</td></tr>
</table></div>
<br/><br/>
<center><a onclick='PrintDiv();' href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 1 </font></a><br/></center>


<?php
        
/////////////////////////////////////	
$atm=$row[3];	
    
	$result3=mysqli_query($con,"select cust_id,atmsite_address from sites where atm_id1='$atm'");
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
	 <div id='back' >
			
			<table height="564">
           
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
    ?>
    /EB/<?php echo $newinvoice_no; ?>-A/<?php echo date("Y"); //if(date('m')<'4'){ echo date("Y",strtotime("-1 year"))."-".date('y'); }else{ echo date("Y")."-"date("y",strtotime("+1 year")) } ?></td>
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

<table width="982" height="261" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
<tr><td colspan="5">PARTICULARS</td><td>AMOUNT</td><td></td></tr>
<tr>
<td height="186" colspan="5" align="left"><b>Reimbursement for electricity bills paid towards Axis  Bank ATM</b><br /><br /><br /><br />
Service Category : Electricity Bill</td>
<td width="80" align="right" valign="top"><br />
  <br /><br /><?php echo  $to=$cb*$raterow[2]; ?></td>
<td width="79">&nbsp;</td>
</tr>

<?php
//echo "select * from ebillcharges where Bid='$bid' and Cid='".$cid."'";
$sl=mysqli_query($con,"select * from ebillcharges where Bid='$bid' and Cid='".$cid."'");
$rs=mysqli_fetch_row($sl); 
if($rs[3]==0){

}
else{

//echo $to;
$svt=$to*0.12;
$ec=$svt*0.02;
$shec=$svt*0.01;
$gtotal=$to+$svt+$ec+$shec;



?><tr>
<td colspan="5" align="right">Service Tax@<?php echo $rs[3]; ?>%</td><td width="424" align="right"><?php echo $svt; ?></td><td></td>
</tr>
<td colspan="5" align="right"> Education Cess @<?php echo $rs[4]; ?>%</td><td align="right"><?php echo $ec; ?></td><td></td></tr>
<td colspan="5" align="right">Secondary &amp; Higher Education Cess    @<?php echo $rs[5]; ?>%</td><td align="right"><?php echo $shec; ?></td><td></td></tr>
<tr>


  <td colspan="5" align="right"><b>Grand Total</b></td>
    
    <td align="right"><?php echo formatTwoDecimals($gtotal, "."); ?></td>
    <td></td>
</tr>

<?php } ?>
</table>
<br/><br/></br>
 
</br></br></br></br>

    <div  align="right">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

</td></tr></table>
</div><br/><br/><center><a onclick='PrintDiv1(); 'href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 2 </font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="generateEbill.php?cid=<?php echo $cid ?>&bid=<?php echo $bid ?>" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Back </font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;





			 


<!--  page 3 -->

<div id='page3' >
			<?php
			function formatTwoDecimals($value, $trim)
{
   $after_comma = substr(strrchr($value, $trim), 0, 3);
   $in_front_of_comma = (int) $value;


   $final = $in_front_of_comma . $after_comma;

   return $final;
}
			?>
			<table height="564">
         
            <tr><td width="983">
			<table width="242" align="right" cellpadding="0" cellspacing="0">
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
    ?>
    /EB/<?php echo $newinvoice_no; ?>-A/2013-14</td>
  </tr>
  <tr height="20">
    <td width="208" height="20">Bill Date : <?php echo date("d.m.Y"); ?></td>
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

<table width="1005" height="261" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">

<?php   $to=$cb*$raterow[2]; ?>
<tr><td width="87"><b>Sr.No </b></td>

<td width="176"><b>Bank</b></td>

<td width="176"><b>ATM ID</b></td>
<td width="114"><b>Service Charges Amount</b> </td>
</tr>
<?php
$srno=0;
//echo $cb;

 //$sl=mysqli_query($con,"select * from ebillcharges where Bid='$bid' and Cid='".$cid."'");
//$rs=mysqli_fetch_row($sl);
for($i=0;$i<$cb;$i++)
{
$srno=$srno+1;
//echo "select * from ebdetails where bill_no='$bills[$i]'";
  $n1sql = "select * from ebdetails where bill_no='$bills[$i]'";
              $result1 = mysqli_query($con,$n1sql);
              $row1 = mysqli_fetch_row($result1);
			 
?>
<tr>

<td width="176"><?php echo $srno; ?></td>
<td width="176"><?php echo $bid; ?></td>
<td width="176"><?php echo $row1[1]; ?></td>
<td align="right"><?php

 echo $rs[2].".00"; ?></td>
</tr>
<?php
}
//}
//echo "select * from ebillcharges where Bid='$bid' and Cid='".$cid."'"; 

if($rs[3]==0){

}
else{
?>
<tr height="150px" align="right"><td height="129" colspan="3">Gross Amount</td>
<td valign="top"><?php echo $to; ?></td></tr>

<tr>
<td colspan="3" align="right">Service Tax@<?php

 $to;
 $svt=$to*0.12;
 $ec=$svt*0.02;
 $shec=$svt*0.01;
 $gtotal=round($to+$svt+$ec+$shec);




 echo $rs[3]; ?>%</td><td align="right"><?php echo $svt; ?></td></tr>
<td colspan="3" align="right"> Education Cess @<?php echo $rs[4]; ?>%</td><td align="right"><?php echo $ec; ?></td></tr>
<td colspan="3" align="right">Secondary &amp; Higher Education Cess    @<?php echo $rs[5]; ?>%</td><td align="right"><?php echo $shec; ?></td></tr>


<?php }
 ?>
 <tr>


  <td colspan="3" align="right"><b>Grand Total</b></td>
    
    <td align="right"><?php echo formatTwoDecimals($gtotal, "."); ?></td>
   
</tr>
</table>

  
<div  align="left"> 
<table width="1006">
<tr height="50px"><td colspan="2">(Rs.  <?php $gtot=int_to_words($gtotal); echo $gtot." only"; ?>) </td></tr>
  <tr><td width="276">
    <p>Service    Tax No:- <?php echo $rowcomp[3]; ?> </p>
<p>      PAN    No:- <?php echo $rowcomp[2]; ?></p>
    <p>Service Category : Electricity Bill<br/>
      
        </p></td><td width="210">


For :<?php echo $rowcomp[1]; ?></td>
  </tr></table></div> 

</br></br></br></br>

    <div  align="right">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

</td></tr></table>
</div>
<a onclick='PrintDiv2(); 'href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 3 </font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<!--<a href="generateEbill.php?cid=<?php echo $cid ?>&bid=<?php echo $bid ?>" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Back </font></a>-->
 
</center>

</body>
</html>
<?php
/* if($comp==1){
		$st= "CSS";
	}else if($comp==2){
		$st="C&C";
	}else if($comp==3){
		$st="CS";
	}
$bill_no=$st."/EB/".$newinvoice_no."/2012";
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
@mail($pfw_email_to, $pfw_subject ,$pfw_message, $pfw_header ) ;
}*/
?>