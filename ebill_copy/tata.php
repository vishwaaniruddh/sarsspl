<?php 
session_start();
//echo $_SESSION['user'];
?>


<style>
th
{
font-size:12px;
}
</style>
<?php ini_set( "display_errors", 0);
$id = $_GET['id'];

$cid=$_POST['cid'];
$bid=$_POST['bid'];
$comp=$_POST['comp'];
$tok=$_POST['tok'];
$invd='';

if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); }else{ $invd=date('y',strtotime('-1 year'))."-".date('y'); }

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


			
              	
$bills=$_POST['bills'];
$bill=$_SESSION['bills'];
$cb= count($bills);

if($cb==0)
{
 ?>
   <script>
   alert("please select site for creating bill");
   window.location="<?php echo $_SERVER['HTTP_REFERER']; ?>"; 
   </script>
   <?php 
}
$rescomp=mysqli_query($con,"select * from company_details where compid='$comp'");
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

<link href="menu.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #0080FF;
	font-weight: bold;
}
body {
	background-color: #FFFFFF;
}
#front{
margin-top:130px;
}

</style>
</head>

<body>
<?php
include("menubar.php");
?>
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
     <div id='front' style="width:850px;"><div style="height:15px"></div>
  <!--
<center><img src="image002.jpg" width="520" height="60" /></center>-->
 
<?php 
$invoice1='';
$finalinvoice2='';
$innnnnnnnnn=0;
$currentdate=date('Y-m-d');
 $sql5 = "select max(send_id) from send_bill";
$res5 = mysqli_query($con,$sql5);
$row5 = mysqli_fetch_row($res5);
$newinvoice_no=$row5[0]+1;
//echo "insert into send_bill(customer_name,bank,date,invoice_no,comp) values('$cid','$bid','$currentdate','$newinvoice_no','$comp')";
if($_SESSION['token']==$tok){
$type=$_POST['proj'];
if($cid=='EUR08')
$type=$_POST['type'];
$res4=mysqli_query($con,"insert into send_bill(customer_name,bank,date,invoice_no,comp,projectid,createdby,fiscalyr) values('$cid','$bid','$currentdate','$newinvoice_no','$comp','".$type."','".$_SESSION['user']."','".$invd."')");
$inr=mysqli_query($con,"select max(send_id) from send_bill ");
$ir=mysqli_fetch_row($inr);
$innnnnnnnnn=$ir[0];
//echo "insert into send_bill(customer_name,bank,date,invoice_no,comp,projectid) values('$cid','$bid','$currentdate','$newinvoice_no','$comp','".$type."')";

}
$sql5 = "select max(send_id) from send_bill";
$res5 = mysqli_query($con,$sql5);
$row5 = mysqli_fetch_row($res5);
$send_id=$row5[0];

$resul3=mysqli_query($con,"select cust_id,atmsite_address from ".$cid."_sites ");
                $ro3=mysqli_fetch_row($resul3); 
                $cust_id1=$cid;
				
						
				$resul4=mysqli_query($con,"select id from contacts where short_name='$cust_id1'");
                $ro4=mysqli_fetch_row($resul4); 
                $uid1=$ro4[0];
				
                $resul5=mysqli_query($con,"select * from address_book where ref_id='$uid1'");
                $addrow1=mysqli_fetch_row($resul5); 
                $resul6=mysqli_query($con,"select billname from billcompany where cust_id='$cust_id1'");
                $brow1=mysqli_fetch_row($resul6); 
                $cm='';
               
   
		$old = substr($row['id'],5,9);
		//echo $old;
		//$l = substr($row['id'],2,2);
		$new = $newinvoice_no;
		//echo $new;
		if($newinvoice_no<=9)
		$newinvoice_no ="000".$newinvoice_no ;
		if($new>9 && $new <=99)
		$newinvoice_no = "00".$newinvoice_no ;
		if($new>99 && $new <=999)
		$newinvoice_no = "0".$newinvoice_no ;
		/*if($new>999 && $new <=9999)
		$newinvoice_no = "0".$newinvoice_no ;
		if($new>9999 && $new <=99999)
		$newinvoice_no="0".$newinvoice_no ;*/
		//echo $newinvoice_no;
	$invtype='A';
	$finalinvoice='';
	$final='';
	$invdate='';
	if(date('m')>='4'){ $invdate=date('y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('y',strtotime('-1 year'))."-".date('y'); }
		if($cid=='Tata05')
		{
		if(date('m')>='4'){ $invdate=date('y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('y',strtotime('-1 year'))."-".date('y'); }
		
   if($comp==1){
		$final.=$cm="CSSEB";
	}else if($comp==2){
		$final.=$cm="C&CEB";
	}else if($comp==3){
		$final.="CS";
	}
    $final.= $newinvoice_no;
    $finalinvoice=$final."/A".$invdate;
     }
    else
    {
    if(date('m')>='4'){ $invdate=date('Y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('Y',strtotime('-1 year'))."-".date('y'); }
		
     if($comp==1){
		$final.=$cm="CSS/EB/";
	}else if($comp==2){
		$final.=$cm="C&C/EB/";
	}else if($comp==3){
		$final.="CS/";
	}
    $final.= $newinvoice_no;
    $finalinvoice=$final."/A/".$invdate;
    
    } ?>





<table width="850" cellpadding="0" cellspacing="0">
  <tr height="150px"><td>&nbsp;</td></tr>
  <tr height="17">
    <td height="17" width="393"><b>To,</b></td>
    <td width="300">&nbsp;</td>
     <td width="302" rowspan="8" align="left" valign="top"><div align="left">Invoice No:-<?php 
   echo $finalinvoice2= $finalinvoice; ?>
    </div>
    <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date :- <?php echo date("d-F-Y"); ?></div></td>
    
  </tr>
  <tr height="18">
    <td height="18" colspan="2"><b><?php echo $addrow1[3]; ?></b></td>
    </tr>
     <?php if($addrow1[18]!=''){ ?><tr height="18">
    <td height="18" colspan="2"><b><?php echo nl2br($addrow1[18]); ?></b></td>
    </tr><?php }else{ ?>
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
    </tr><?php } ?>
    
</table>


<table width="850" height="185" border="0">
  <tr>
  <td width="850" height="45"><b>Sub:</b>&nbsp;&nbsp;  Reimbursement Of Electricity Bills.</td>
  </tr>
  <tr><td>

<form method="post" action="showEbill.php" ><table  style="border-collapse:collapse; table-layout: fixed; width: 900px;" border="1" cellpadding="4" cellspacing="0"><thead>
  <tr>
   <th style="overflow: hidden; width: 28px; "><div align="center">Sr No. </div></th>
      <th style="overflow: hidden; width: 40px; font-size:small;" ><div align="center">Project ID </div></th>
    <th style="overflow: hidden; width: 40px; font-size:small;"  ><div align="center">BANK</div></th>
    <th style="overflow: hidden; width: 60px; font-size:small;"  ><div align="center">ATM ID</div></th>
      <th style="overflow: hidden; width: 95px;" ><div align="center">SITE ID</div></th>
       <th style="overflow: hidden; width: 75px; font-size:small;" >
         <div align="center">CONSUMER NO.</div>       </th> 
        
    <th align="center" style="overflow: hidden; width: 202px;" ><div align="center">LOCATION</div></th>
  
    <th style="overflow: hidden; width: 124px;" colspan="2"><div align="center">BILLING PERIOD </div></th>       
   
    <th style="overflow: hidden; width: 62px;" ><div align="center">PAID DATE</div></th>  
     <th style="overflow: hidden; width: 62px;" ><div align="center">BILL DATE </div></th>
        <th style="overflow: hidden; width: 40px; font-size:small;" ><div align="center">UNITS</div></th> 
        
    <th style="overflow: hidden; width: 72px;" ><div align="center"> AMOUNT IN INR</div></th>    
      
  </tr></thead><tbody>
  <?php $sum=0;$schrg=0;
  $chrgid=array();
        for($i=0;$i<$cb;$i++)///$i=0
             {
				
           // echo "select * from ebdetails where bill_no='$bills[$i]'";;
              $n1sql = "select * from ebillfundrequests where req_no='$bills[$i]'";
              $result1 = mysqli_query($con,$n1sql);
              $row1 = mysqli_fetch_row($result1);
			  $num=mysqli_num_rows($result1);
                $nsql = "select * from ".$cid."_ebill where atmtrackid='$row1[14]'";// echo $nsql;
				 //$nsql = "select * from ebdetails where site_id='SN000523'";
                $result = mysqli_query($con,$nsql);
             
		$row = mysqli_fetch_row($result);
		if($_SESSION['token']==$tok){
		//echo "update ebillfundrequests set print='y' where req_no='$bills[$i]'";
		 $sqll="update ebillfundrequests set print='y' where req_no='$bills[$i]'";
		$ress = mysqli_query($con,$sqll);
		if(!$ress)
		echo mysqli_error();
		}
	
		//echo "select location from ".$cid."_sites where atm_id1='$row[3]'";
		    $res=mysqli_query($con,"select atmsite_address,site_id,bank,projectid from ".$cid."_sites where trackerid='$row1[14]'");
                $rows=mysqli_fetch_row($res); 
                $location=$rows[0];
				              
				
			 $schrg=$schrg+$row[7];	
			 $month=date('F',strtotime($row1[7]));	
			
			$sql1 = "select * from  ebpayment where Bill_No='$bills[$i]'"; //echo $nsql;
                  $res1 = mysqli_query($con,$sql1);
				 
				 $row3 = mysqli_fetch_row($res1);
				 //echo $row3[2];
		 $sum=$sum+$row3[1];
if($_SESSION['token']==$tok){
//echo "insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date,reqid) values('$send_id','$row1[14]','$row[2]','$location','$row[1]','$row1[2]','$row1[9]','$row1[3]','$row1[6]','$row1[7]','$month','$row3[1]','$row3[2]','".$bills[$i]."')";				 
$res5=mysqli_query($con,"insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date,reqid,fiscalyr) values('$send_id','$row1[14]','$row[2]','$location','$row[1]','$row1[2]','$row1[9]','$row1[3]','$row1[6]','$row1[7]','$month','$row3[1]','$row3[2]','".$bills[$i]."','".$invd."')");
$ccc=mysqli_query($con,"select max(detail_id) from send_bill_detail");
$cccr=mysqli_fetch_row($ccc);
$chrgid[]=$cccr[0];
	//if(!$res)
	//echo mysqli_error();			 	                                              
	}		?>
		 <tr height="20"><td align="center" style="overflow: hidden; width: 28px;">&nbsp;<?php echo $i+1; ?></td>
         <td align="center" style="overflow: hidden; width: 40px; font-size:small;" >&nbsp;<?php echo $rows[3]; ?></td>
         <td align="center" style="overflow: hidden; width: 40px; font-size:small;">&nbsp;<?php echo $rows[2]; ?></td>
		     <td align="center" style="word-break: break-all;overflow: hidden; width: 75px; font-size:small;">&nbsp;<?php echo $row[3]; ?></td>
             <td align="center" style="overflow: hidden; width: 80px; font-size:x-small;">&nbsp;<?php echo $rows[1]; ?></td>
             <td align="center" style="width: 80px; font-size:small;word-break: break-all;" >&nbsp;<?php echo $row[1]; ?></td>
             <!--<td align="center">&nbsp;<?php echo $row[5]; ?></td>-->
			 <td align="center" style="overflow: hidden; width: 202px; word-break: keep-all; font-size:small;">&nbsp;<?php echo  $location; ?></td>
			 
			 <td align="center" style="overflow: hidden; width: 62px; font-size:small;">&nbsp;<?php if(isset($row1[6]) and $row1[6]!='0000-00-00'){ echo date('d/m/Y',strtotime($row1[6])); }
			 else{ echo "NA"; } ?></td>			 			              
			  <td align="center" style="overflow: hidden; width: 62px; font-size:small;">&nbsp;<?php if(isset($row1[7]) and $row1[7]!='0000-00-00'){echo date('d/m/Y',strtotime($row1[7])); }
			 else{ echo "NA"; } ?></td>			 			              
		      <td align="center" style="overflow: hidden; width: 62px; font-size:small;" >&nbsp;<?php  if(isset($row3[2]) and $row3[2]!='0000-00-00'){ echo date('d/m/Y',strtotime($row3[2])); }
		      else{ echo "NA"; } ?></td>
                <td align="center" style="overflow: hidden; width: 62px; font-size:small;">&nbsp;<?php if(isset($row1[2]) and $row1[2]!='0000-00-00'){ echo date('d/m/Y',strtotime($row1[2])); }
                else{ echo "NA"; } ?></td>
                 <td align="center" style="overflow: hidden; width: 40px;">&nbsp;<?php echo $row1[3]; ?></td>
               		 			              
			 <td align="right" style="overflow: hidden; width: 72px;"><?php echo number_format((float)$row3[1], 2, '.', ''); ?></td>			
                      
		</tr>
		<?php
	

		}
		if(isset($_SESSION['token']))
$res6=mysqli_query($con,"update send_bill set amount='".$sum."' where send_id='".$send_id."'");
?>
<tr><td colspan="12" align="right"><b>Total Billing Amount</b></td>
<td align="right"><?php echo number_format((float)$sum, 2, '.', ''); ?></td></tr>
<tbody>
</table>
<p align="left"><b>(Rs.  <?php $st=int_to_words($sum); echo $st." Only"; ?>  )</b></p>
</form><br /><br />Corporate Identification Number  (CIN) : &nbsp;&nbsp; U74920MH2008PTC187508.
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

  //echo $cb." ".$raterow[2];
  echo  $to=$to; ?></td>
<td width="79">&nbsp;</td>
</tr>

<?php
//print_r($bills);

/*if($rs[3]==0){

}
else{*/

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
    
    <td align="right"><?php echo number_format($gtotal,2); ?></td>
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
<div id='page3' ><br><br><br><br><br><br>
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
			<table width="327" align="right" cellpadding="0" cellspacing="0" border='0'>
  <col width="151" />
  <col width="72" />
  <tr height="18">
    <td height="18" colspan="2" align="left">Invoice No:-  <?php 
  // echo $final;
   if($cid=='Tata05')
		{
   
    $finalinvoice=$final."B".$invdate;
    }
    else
    {
     
    $finalinvoice=$final."/B/".$invdate;
     
    }
   echo $finalinvoice3= $finalinvoice;
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
  </tr> <?php if($addrow1[18]!=''){ ?><tr height="18">
    <td height="18" colspan="2"><b><?php echo nl2br($addrow1[18]); ?></b></td>
    </tr><?php }else{ ?>
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
  </tr><?php } ?>
    <td height="18" colspan="2"><b>Sub:- </b>Ebill Service Charges</td>
  </tr>
</table>

<table width="1005" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">


<tr><td width="20"><b>Sr.No </b></td>
<td width="176"><b>Project ID</b></td>
<td width="176"><b>Bank</b></td>

<td width="176"><b>ATM ID</b></td>
<td width="114"><b>Service Charges Amount in INR</b> </td>
</tr>
<?php

$srno=0;
$to=0;
$seramt=0;
//echo "hello";
for($i=0;$i<$cb;$i++)
{
$srno=$srno+1;

  $n1sql = "select * from ebillfundrequests where req_no='$bills[$i]'";
  //echo $n1sql;
              $result1 = mysqli_query($con,$n1sql);
              $row1 = mysqli_fetch_row($result1);
			  $bnk=mysqli_query($con,"select bank,projectid from ".$cid."_sites where trackerid='".$row1[14]."'");
$bnkro=mysqli_fetch_row($bnk);
$s2="select * from ebillcharges where Cid='".$cid."'";


//if($bid!='' || $bid!='All' || $bid!='-1')
//$s2.=" and Bid='".$bid."'";

if($cid!='AGS01')
{
  if(($cid!='EUR08' && $cid!='EPS') && ($_POST['proj']=='MOF' || $_POST['proj']=='Mphasis')){
$s2.=" and type='".$_POST['proj']."'";


}
elseif($cid=='EUR08')
$s2.=" and type='".$_POST['type']."'";
else
$s2.=" and type=''";
}
//echo $s2;
$sl=mysqli_query($con,$s2);

$rs=mysqli_fetch_row($sl);


//$rs=mysqli_fetch_row($sl);
			 
?>
<tr>

<td><?php echo $srno; ?></td>
<td width="176"><?php echo $bnkro[1]; ?></td>
<td width="176"><?php echo $bnkro[0]; ?></td>
<td width="176"><?php echo $row1[1]; ?></td>
<td align="right"><?php
//echo $cid." ".$_POST['tata'];
if($cid=='Tata05')
{
if($_POST['tata']!=''){
$to=$to+$rs[2].".00";
 echo $rs[2].".00";
 $seramt=$rs[2];
}
else
{
$to=$to+0;
$seramt=$rs[2];
echo "0.00";
}
}
else{
$seramt=$rs[2];
$to=$to+$rs[2].".00";
 echo $rs[2].".00";} ?></td>
</tr>
<?php
} ?>
<tr align="right"><td colspan="4">Gross Amount</td>
<td valign="top"><?php echo formatTwoDecimals($to, "."); ?></td></tr>

<tr>
<td colspan="4" align="right">Service Tax@12%<?php

//echo  $to;
 $svt=$to*0.12;
 $ec=$svt*0.02;
 $shec=$svt*0.01;
 $gtotal=round($to+$svt+$ec+$shec);




  ?></td><td align="right"><?php echo formatTwoDecimals($svt, "."); ?></td></tr>
<td colspan="4" align="right"> Education Cess @2%</td><td align="right"><?php echo formatTwoDecimals($ec, "."); ?></td></tr>
<td colspan="4" align="right">Secondary &amp; Higher Education Cess    @1%</td><td align="right"><?php echo formatTwoDecimals($shec, "."); ?></td></tr>
<tr>


  <td colspan="4" align="right"><b>Grand Total</b></td>
    
    <td align="right"><?php echo number_format($gtotal,2); ?></td>
   
</tr>
</table>

  
<div  align="left"> 
<table width="1006">
<tr height="50px"><td colspan="2">(Rs.  <?php $gtot=int_to_words($gtotal); echo $gtot." only"; ?>) </td></tr>
  <tr><td width="276" align="left">
    <p>Service    Tax No:- <?php echo $rowcomp[3]; ?> </p>
<p>      PAN    No:- <?php echo $rowcomp[2]; ?></p>
    <p>Service Category : Electricity Bill<br/>
      Corporate Identification Number  (CIN) :              U74920MH2008PTC187508.
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

//echo $_SESSION['token']." ".$tok;
if($_SESSION['token']==$tok)
{
//echo "update send_bill set invoice_no='".$finalinvoice2."', invoice2='".$finalinvoice3."',servchrg='".$gtotal."' where send_id='".$innnnnnnnnn."'";
$up=mysqli_query($con,"update send_bill set invoice_no='".$finalinvoice2."', invoice2='".$finalinvoice3."',servchrg='".$gtotal."' where send_id='".$innnnnnnnnn."'");
$chrg=implode(",",$chrgid);
//echo "update send_bill_detail set srvchrg='".seramt."' where detail_id in ($chrg)";
$up2=mysqli_query($con,"update send_bill_detail set srvchrg='".$seramt."' where detail_id in ($chrg)");
//echo "update send_bill set invoice_no='".$finalinvoice2."', invoice2='".$finalinvoice3."' where send_id='".$innnnnnnnnn."'";
}
if(isset($_SESSION['token'])){
unset($_SESSION['token']);

}

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
 $bill_no=$finalinvoice;
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
?><script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>