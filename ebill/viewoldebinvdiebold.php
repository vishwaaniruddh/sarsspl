<?php 
session_start();
//echo $_SESSION['user'];
if(!isset($_SESSION['user']))
header('location:index.php');

include("config.php");
$st_flag=0;


?>

<script src="excel.js" type="text/javascript"></script>
<script type="text/javascript">
 function canceleinv(id,cust)
  {
  var answer = confirm ("Do you really want to cancel this invoice?")
if (answer){
window.location='canceleinv.php?eid='+id+'&cid='+cust;
  }
  }
</script>
<style>
th
{
font-size:12px;
}
</style>
<?php
$id = $_GET['invid'];
$qrrr="select * from send_bill where send_id='".$id."'";
$inv=mysqli_query($con,$qrrr);
$invro=mysqli_fetch_row($inv);
echo "old date=" .$invro[8];
		$date1 = new DateTime($invro[8]);
        $date2 = new DateTime("2015-06-01");
        $date3 = new DateTime("2015-11-15");
        $date4 = new DateTime("2016-06-01");
        if($date1 >= $date2)$st_flag=1;
        if($date1 >= $date3)$st_flag=3;
        if($date1 >= $date4)$st_flag=4;
 ?>
<center>
	<?php 
		if( $_SESSION['designation']=='7' && $invro[10]=='0'){ 
		//echo "select * from send_bill_dispatch where send_id='".$invro[0]."' and ficalyr='".$invro[14]."' order by id DESC limit 1";
		$dis=mysqli_query($con,"select * from send_bill_dispatch where send_id='".$invro[0]."' and ficalyr='".$invro[14]."' order by id DESC limit 1");
		$disro=mysqli_fetch_row($dis);
		 
		
		/*if(mysqli_num_rows($dis)==0 || $disro[4]=='1'){*/
		?>
 <td>
 	<a href="#" onclick=canceleinv('<?php echo $invro[0]; ?>','<?php echo $invro[1]; ?>')>Cancel this invoice</a></td>&nbsp;&nbsp;&nbsp;
 	<a href="editebinv.php?invid=<?php echo $_GET['invid']; ?>&yr=<?php echo $_GET['yr']; ?>"> Edit This Invoice</a>&nbsp;&nbsp;&nbsp;
	<a href="scan_viewoldebinv.php?invid=<?php echo $_GET['invid']; ?>&yr=<?php echo $_GET['yr']; ?>">Attach Scan</a>
 <?php /* }  */ } ?>

<button id="myButtonControlID" onClick="tableToExcel('exptexcl', 'Table Export Example')">Export Table data into Excel</button>
	<br />
</center>
<?php ini_set( "display_errors", 0);

//echo "select * from send_bill where send_id='".$id."'";
//echo "select * from send_bill where send_id='".$id."'";

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
       
      /* define("MAJOR", 'Rupees');
define("MINOR", 'p');
class toWords  {
           var $pounds;
           var $pence;
           var $major;
           var $minor;
           var $words = '';
           var $number;
           var $magind;
           var $units = array('','One','Two','Three','Four','Five','Six','Seven','Eight','Nine');
           var $teens = array('Ten','Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen');
           var $tens = array('','Ten','Twenty','Thirty','Forty','Fifty','Sixty','Seventy','Eighty','Ninety');
           var $mag = array('','Thousand','Lakh','Crore');
    function toWords($amount, $major=MAJOR, $minor=MINOR) {
             $this->major = $major;
             $this->minor = $minor;
             $this->number = number_format($amount,2);
             list($this->pounds,$this->pence) = explode('.',$this->number);
             $this->words = " $this->major $this->pence$this->minor";
             if ($this->pounds==0)
                 $this->words = "Zero $this->words";
             else {
                 $groups = explode(',',$this->pounds);
                 $groups = array_reverse($groups);
                 for ($this->magind=0; $this->magind<count($groups); $this->magind++) {
                      if (($this->magind==1)&&(strpos($this->words,'hundred') === false)&&($groups[0]!='000'))
                           $this->words = ' and ' . $this->words;
                      $this->words = $this->_build($groups[$this->magind]).$this->words;
                 }
             }
    }
    function _build($n) {
             $res = '';
             $na = str_pad("$n",3,"0",STR_PAD_LEFT);
             if ($na == '000') return '';
             if ($na{0} != 0)
                 $res = ' '.$this->units[$na{0}] . ' hundred';
             if (($na{1}=='0')&&($na{2}=='0'))
                  return $res . ' ' . $this->mag[$this->magind];
             $res .= $res==''? '' : ' and';
             $t = (int)$na{1}; $u = (int)$na{2};
             switch ($t) {
                     case 0: $res .= ' ' . $this->units[$u]; break;
                     case 1: $res .= ' ' . $this->teens[$u]; break;
                     default:$res .= ' ' . $this->tens[$t] . ' ' . $this->units[$u] ; break;
             }
             $res .= ' ' . $this->mag[$this->magind];
             return $res;
    }
}*/
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

/*#front {
   position:relative;
   display:table;
   table-layout:fixed;
   padding-top:25px;
   padding-bottom:20px;
   width: 94%;
   height:auto;
}*/
@page {
      margin: 80px;
   }
  /* @page{ margin-top: 130px;}*/
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


function PrintDiv3() {    
           var divToPrint = document.getElementById('pg4');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
     <?php
     if($cid=='AGS01'){
     ?>
     <form name="frm" method="post" action="agssoftcpy.php" target="_blank">
<input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>">
<input type="hidden" id="qr" name="qr" value="<?php echo $qrrr; ?>"><input type="submit" name="cmd" value="Get Soft Copy in EXCEL">
</form>
     <?php
     }
     
     if($cid=='FSS04')
     {
     ?>
     <form name="frm" method="post" action="fssdebitnote.php" target="_blank">
<input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>">
<input type="hidden" id="qrrr" name="qrrr" value="<?php echo $qrrr; ?>" readonly><input type="submit" name="cmd" value="Debit Note">
</form>
     <?php
     }
     ?>
     <div id='exptexcl'>
     <div id='front' style="width:850px;"><div style="height:15px"></div>
  <!--
<center><img src="image002.jpg" width="520" height="60" /></center>-->
 
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

<table width="850" cellpadding="0" cellspacing="0">
  <tr height="150px"><td>&nbsp;</td></tr>
  <tr height="17">
    <td height="17" width="393"><b>To,</b></td>
    <td width="300">&nbsp;</td>
     <td width="302" rowspan="8" align="right" valign="top" style="padding-right:8px"><div align="right">Invoice No:-<?php 
   echo  $invro[5]; ?>
    </div>
    <div align="right">Date :- <?php echo date("d-F-Y",strtotime($invro[3])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
    
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
    </tr>
    <?php } ?>
</table>


<table width="850"  border="0">

&nbsp;&nbsp;
<?php if($invro[1]=='AGS01'){?><tr><td><?php echo "PAN No. AAECA0901H"; ?></td></tr><?php } ?>
  <tr>


  <tr>
  <td width="850" height="45"><b>Sub:</b>&nbsp;&nbsp;  Reimbursement Of Electricity Bills.</td>
  </tr>
  <tr><td>

<form method="post" action="showEbill.php" ><table border="1" style="border-collapse:collapse; table-layout: fixed; width: 900px;"><thead>
  <tr>
   <?php if($cid=='FIS03'){?>
		<th style="overflow: hidden; width: 28px; "><div align="center">Sr No. </div></th>	  
		<th style="overflow: hidden; width: 60px; font-size:small;"  ><div align="center">ATM ID</div></th> 
		<th align="center" style="overflow: hidden; width: 202px;" ><div align="center">SITE NAME</div></th> 
		<th style="overflow: hidden; width: 40px; font-size:small;"  ><div align="center">BANK</div></th>
		
		<th style="overflow: hidden; width: 124px;" colspan="2"><div align="center">MONTH </div></th>    
		<th style="overflow: hidden; width: 72px;" ><div align="center"> AMOUNT</div></th>
   <?php }else{?>
    <th style="overflow: hidden; width: 28px; "><div align="center">Sr No. </div></th>
    <th style="overflow: hidden; width: 40px; font-size:small;" ><div align="center">Project ID </div></th>
    <th style="overflow: hidden; width: 40px; font-size:small;"  ><div align="center">BANK</div></th>
    <th style="overflow: hidden; width: 75px; font-size:small;"  ><div align="center">ATM ID</div></th>
    <th style="overflow: hidden; width: 95px;" ><div align="center">SITE ID</div></th>
    <th style="overflow: hidden; width: 75px; font-size:small;" >
    <div align="center">CONSUMER NO.</div>       </th>         
    <th align="center" style="overflow: hidden; width: 202px;" ><div align="center">LOCATION</div></th>  
	<th style="overflow: hidden; width: 134px;" colspan="2"><div align="center">BILLING PERIOD </div></th>          
    <th style="overflow: hidden; width: 67px;" ><div align="center">PAID DATE</div></th>  
    <th style="overflow: hidden; width: 67px;" ><div align="center">BILL DATE </div></th>
    <th style="overflow: hidden; width: 40px; font-size:small;" ><div align="center">UNITS</div></th> 
    <th style="overflow: hidden; width: 72px;" ><div align="center"> AMOUNT IN INR</div></th>   
   <?php } ?>
  </tr>
  </thead><tbody>
  <?php $sum=0;$schrg=0;
$ij=0;
  //echo "select * from send_bill_detail where send_id='".$id."'";
  	$ann=mysqli_query($con,"select * from send_bill_detail where send_id='".$id."' and status=0");
	$cb=mysqli_num_rows($ann);
        while($annr=mysqli_fetch_array($ann))
             {
		
				 
		$ij=$ij+1;
//$sum=$sum+$annr[12]+$annr['extrachrg']+$annr['recon_chrg']+$annr['discon_chrg']+$annr['sd']+$annr['after_duedt_chrg'];
$sum=$sum+$annr[12];
                $nsql = "select * from ".$cid."_ebill where atmtrackid='$annr[2]' and Consumer_No!=''";// echo $nsql;
		//echo  $nsql;		
                

$result = mysqli_query($con,$nsql);
	$row = mysqli_fetch_row($result);
		
	$ress = mysqli_query($con,$sqll);
		//echo "select location,site_id,bank,atm_id1,projectid,atmsite_address from ".$cid."_sites where trackerid='$annr[2]'";
		    $res=mysqli_query($con,"select location,site_id,bank,atm_id1,projectid,atmsite_address from ".$cid."_sites where trackerid='$annr[2]'");
               if(!$res)
               echo mysqli_error();
                $rows=mysqli_fetch_row($res); 
                $location=$rows[5];
				              
			 //$sum=$sum+$row1[4];	
			 $schrg=$schrg+$row[7];	
			 $month=date('F',strtotime($row1[7]));	
			
		
				 
				 $row3 = mysqli_fetch_row($res1);
				 //echo $row3[2];
	?>
	 <tr height="20">
	  <?php if($cid=='FIS03'){?>
	   <td align="center" style="overflow: hidden; width: 28px;">&nbsp;<?php echo $ij; ?></td>
		 <td align="center" style="word-break: break-all;overflow: hidden; width: 75px; font-size:small;">&nbsp;<?php echo $row[3]; ?></td>
		 <td align="center" style="overflow: hidden; width: 202px; word-break: keep-all; font-size:small;">&nbsp;<?php echo  $location; ?></td>
		 <td align="center" style="overflow: hidden; width: 40px; font-size:small;">&nbsp;<?php echo $rows[2]; ?></td>	 
		
	<td align="center" style="font-size:small;" ><?php if(isset($annr[9]) and $annr[9]!='0000-00-00'){ echo date('M-Y',strtotime($annr[9])); } else{ echo "NA"; } ?></td>			 			              
	<td align="center" style="font-size:small;" ><?php if(isset($annr[10]) and $annr[10]!='0000-00-00'){ echo date('M-Y',strtotime($annr[10])); } else{ echo "NA"; } ?></td>			 			              
		<td align="right" style="overflow: hidden; width: 72px;" ><?php echo number_format((float)($annr[12]), 2, '.', ''); ?></td>	
	  <?php }else{?>
	<td align="center" style="overflow: hidden; width: 28px;">&nbsp;<?php echo $ij; ?></td>
	 <td align="center" style="overflow: hidden; width: 40px; font-size:small;" >&nbsp;<?php echo $rows[4]; ?></td>
	 <td align="center" style="word-wrap: break-word; width: 40px; font-size:small;">&nbsp;<?php echo $rows[2]; ?></td>
	 <td align="center" style="word-break: break-all;overflow: hidden; width: 75px; font-size:small;" >&nbsp;<?php echo $rows[3]; ?></td>
	 <td align="center" style="overflow: hidden; width: 80px; font-size:x-small;" >&nbsp;<?php echo $rows[1]; ?></td>
	 <td align="center" style="width: 80px; font-size:small;word-break: break-all;" >&nbsp;<?php echo $row[1]; ?></td>
	 <!--<td align="center" width="28" >&nbsp;<?php echo $row[5]; ?></td>-->
	 <td align="left" style="overflow: hidden; width: 202px; word-break: keep-all; font-size:small;" ><?php echo  $location; ?></td>
			 
	 <td align="center" style="font-size:small;" ><?php if(isset($annr[9]) and $annr[9]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[9])); } else{ echo "NA"; } ?></td>			 			              
	<td align="center" style="font-size:small;" ><?php if(isset($annr[10]) and $annr[10]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[10])); } else{ echo "NA"; } ?></td>			 			              
    <td align="center" style="font-size:small;" ><?php  if(isset($annr[13]) and $annr[13]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[13])); }
     else{ echo "NA"; }//$bills[$i]; 
	  ?></td>
	<td align="center" style="font-size:small;" ><?php if(isset($annr[6]) and $annr[6]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[6])); }
	else{ echo "NA"; } ?></td>
    <td align="center" style="overflow: hidden; width: 40px;" >&nbsp;<?php echo $annr[8]; ?></td>               		 			              
    <td align="right" style="overflow: hidden; width: 72px;" ><?php echo number_format((float)($annr[12]), 2, '.', ''); ?></td>	
	  <?php }?>
	 		
                      
</tr>
		<?php
	

		}
		
?>
<tr><td colspan="<?php if($cid=='FIS03'){echo '6';}else{echo '12';}?>" align="right"><b>Total Billing Amount</b></td>
<td align="right"><?php echo number_format((float)$sum, 2, '.', ''); ?></td></tr><tbody>

</table>
<p align="left"><b>(Rs.  <?php $st=int_to_words(round($sum)); echo $st." Only";

 ?>  )</b></p>
</form>

</br>Corporate Identification Number  (CIN) :              U74920MH2008PTC187508.<div  align="right"><b>For :<?php echo $rowcomp[1]; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></br>
<br><br>


    <div  align="right"><b>Authorised Signatory<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>



</td></tr>
</table></div>
<br/><br/>


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

//echo $to;
//$svt=$to*0.12;
//$ec=$svt*0.02;
//$shec=$svt*0.01;
//$gtotal=$to+$svt+$ec+$shec;

//echo "flag".$st_flag;
if($st_flag==1)
{
$svt=$to*0.14;
$gtotal=$to+$svt;
}
elseif($st_flag==3)
{
$svt=($to*0.14)+.005;
$gtotal=$to+$svt;
}
elseif($st_flag==4)
{
$svt=$to*0.145;
$svt=$svt+0.005;
$svt=$svt+0.005+0.005;

$gtotal=$to+$svt;

}
else
{
$svt=$to*0.12;
$ec=$svt*0.02;
$shec=$svt*0.01;
$gtotal=$to+$svt+$ec+$shec;
}

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
            <tr><td width="983" align="left">
			<table width="300" align="right" celldpading="0" cellspacing="0" border='0'>
  <col width="151" />
  <col width="151" />
  <tr height="18">
    <td height="18" colspan="2" align="left">Invoice No:-  <?php 
 
   echo  $invro[9];
    ?></td>
  </tr>
  <tr height="20">
    <td width="208" height="20" colspan="2" align="left" >&nbsp;&nbsp;&nbsp;&nbsp;Bill Date :- <?php echo date("d-F-Y",strtotime($invro[3])); ?></td>
    
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
    <td height="18" colspan="2"></td>
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
$bnknew="";
$srno=0;
$to=0;
//echo "hello";
$ann='';
$annr='';
 $ann=mysqli_query($con,"select * from send_bill_detail where send_id='".$id."' and status=0");
$cb=mysqli_num_rows($ann);
        while($annr=mysqli_fetch_array($ann))
{
$bnknew=$bnkro[0];
$srno=$srno+1;

			  $bnk=mysqli_query($con,"select bank,atm_id1,projectid from ".$cid."_sites where trackerid='".$annr[2]."'");
$bnkro=mysqli_fetch_row($bnk);
/*$s2="select * from ebillcharges where Cid='".$cid."'";
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
*/
?>
<tr>

<td ><?php echo $srno; ?></td>
<td width="176">&nbsp;<?php echo $bnkro[2]; ?></td>
<td width="176">&nbsp<?php echo $bnkro[0]; ?></td>
<td width="176"><?php echo $bnkro[1]; ?></td>
<td align="right"><?php
//echo $cid." ".$_POST['tata'];
$to=$to+round($annr[15]);
echo number_format(round($annr[15]),2);
/*if($cid=='Tata05')
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
 echo $rs[2].".00";} */ ?></td>
</tr>
<?php
} ?>
<tr align="right"><td colspan="4">Gross Amount</td>
<td valign="top"><?php echo number_format(round($to),2); ?></td></tr>

<tr>
<?php if($st_flag==1)
{
?>
<td colspan="4" align="right">Service Tax@14%
<?php }elseif($st_flag==3)
{
?>
<td colspan="4" align="right">Service Tax@14%

<?php }
elseif($st_flag==4)
{

?>
<td colspan="4" align="right">Service Tax@14%
<?php
}


else{ ?>
<td colspan="4" align="right">Service Tax@12%
<?php }
$servcechg=$to/count($bills);
//echo  "flag".$st_flag;
if($st_flag==1)
{
$svt=$to*0.14;
$gtotal=$to+$svt;
}
elseif($st_flag==3)
{
$svt=$to*0.14;
$svt1=$to*0.005;
$gtotal=$svt+$svt1+$to;
}
elseif($st_flag==4)
{
$svt=$to*0.14;
$svt1=$to*0.005;
$svt2=$to*0.005;
$gtotal=$svt+$svt1+$svt2+$to;
}
else
{
$svt=$to*0.12;
$ec=$svt*0.02;
$shec=$svt*0.01;
$gtotal=$to+$svt+$ec+$shec;
}

/*
 $svt=$to*0.12;
 $ec=$svt*0.02;
 $shec=$svt*0.01;
 $gtotal=round($to+$svt+$ec+$shec);
*/



  ?>
  	</td>
<td align="right"><?php echo number_format($svt,2); ?></td>
<tr>
    <td colspan="4" align="right">SBC @ 0.5%</td>

   <td align="right"><?php echo $svt1; ?></td>

</tr>

   <?php if($st_flag==4)
{ ?>
    <td colspan="4" align="right">KKC @ 0.5%</td>
<td align="right"><?php echo $svt2; ?></td>
<?php } ?> 

    <?php if($st_flag==0){ ?>
	<td colspan="4" align="right"> Education Cess @2%</td><td align="right"><?php echo number_format($ec,2); ?></td></tr>
	<td colspan="4" align="right">Secondary &amp; Higher Education Cess    @1%</td><td align="right"><?php echo number_format($shec,2); ?></td></tr>
    <?php } ?>





<tr>


  <td colspan="4" align="right"><b>Grand Total</b></td>
    
    <td align="right"><?php echo number_format(round($gtotal),2); ?></td>
   
</tr>
</table>

  
<div  align="left"> 
<table width="1006">
<tr height="50px"><td colspan="2">(Rs.  <?php $rsword=round($gtotal); $gtot=int_to_words($rsword); echo $gtot." only"; ?>) </td></tr>
  <tr><td width="276" align="left">
    <p>Service    Tax No:- <?php echo $rowcomp[3]; ?> </p>
<p>      PAN    No:- <?php echo $rowcomp[2]; ?></p>
    <p>Service Category : Electricity Bill<br/>
      Corporate Identification Number  (CIN) :&nbsp;&nbsp;U74920MH2008PTC187508.
        </p></td><td width="210" align="right">


<b>For :<?php echo $rowcomp[1]; ?></b><br><br><br><br><b>Authorised Signatory</b></td>
  </tr></table></div> 

<!--</br></br><table width="100%"><tr><td align="center" width="50%"><?php echo $_SESSION['user']; ?><br />E-Bill Executive</td>
<td width="50%" align="center">Bharat Pundit<br />E-Bill Head</td></tr></table></br></br>-->
</td></tr></table>
</div></div>


<!--------new format------>


			
<div id='pg4' ><br><br><br>
			
			
<table cellspacing="0" cellpadding="0" border='2' width="100%">
 
  <tr height="17" >
    <td height="17" width="485" colspan="4" rowspan="4"><table><tr><td><b>To,</b></tr>
   <tr>
<?php if($addrow1[18]!=''){ ?><tr height="18">
?>
    <td height="18" colspan="2"><b><?php echo nl2br($addrow1[18]); ?></b></td>

</tr>
<?php
}
else
{
?>
<tr height="18">
    <td height="18" colspan="6"><b><?php echo $addrow1[3]; ?></b></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="6"><?php echo $addrow1[5]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="6"><?php echo $addrow1[6]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="6"><?php echo $addrow1[7]."-".$addrow1[9]; ?></td>
  </tr>
  <tr height="18">
    <td height="18" colspan="6"><?php echo $addrow1[8].",".$addrow1[10]; ?></td>
  </tr>
<tr height="18">
    <td height="18" colspan="6"><?php echo "Phone:".$addrow1[11]; ?></td>
<?php }?>

<tr></tr>

</table>


</td>
   
<td><table><tr><td width="505" align="right">Invoice No:- <?php echo $invro[5];
    ?></td></tr>
    <tr height="20">
    <td width="208" height="20" colspan="2" align="right" >&nbsp;&nbsp;&nbsp;&nbsp;Bill Date :- <?php echo date("d-F-Y",strtotime($invro[3])); ?></td>
    
  </tr>
    
    
    </table></td>

</table>

<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">

<tr><td colspan="5" width="440" align="center"><b>Bill for the month of <?php echo date("M-Y",strtotime($invro[3])); ?></b></td><tr>
<tr><td colspan="4" width="440" align="center"><b>Particulars<b></td><td align="center" style="width:20%">Amount</td><tr>



<tr><td colspan="4"  style="width:100%"><table border='0' style="width:100%; height:250px; ">
   <tr>
     <td style='border-bottom:none;border-top:none; padding:8px;'>
Reimbursement Of Electricity Bills For The Month Of <?php echo date("F-Y",strtotime($invro[3])); ?>
</td>
     
</tr>

<tr>
<td >
</td>

<td align="center" style="width:18%;padding:0px;">
Bank
</td>


<td align="center" style="width:18%">
Commercials
</td>


<td align="center" style="width:18%">No of Sites
</td>

</tr>
<tr>
<td align="center" style="padding:0px;">PO No
</td>


<td align="center"><?php echo $bnknew;?>
</td>


<td>
</td>


<td align="center"><?php echo $cb; ?>
</td>

</tr>

</table>



</td><td align="center"></td><tr>


<tr>  
<td width="500" style='border-bottom:none;border-top:none;border-right:none;'>
 
</td>
<td width="500" style='border-bottom:none;border-top:none;border-left:none;border-right:none;'>
 
</td>

<td style='border-bottom:none;border-top:none;border-left:none;border-right:none; ' width="500">Total</td>

<td style='border-bottom:none;border-top:none;border-left:none;border-right:none;' width="176"><?php echo number_format((float)$sum, 2, '.', ''); ?></td><td width="100px;" style='border-bottom:none;border-top:none;border-right:none;'><?php echo number_format((float)$sum, 2, '.', ''); ?></td>
</tr>
<tr>
<td style='' colspan="4" align="center"><b> Total:-<?php $rsword1=round($sum); $gtot1=int_to_words($sum); echo $gtot1." only"; ?></b></td>
  <td  align="right" ><?php echo number_format(round($sum),2); ?></td>
  
</tr>

<tr>
<td width="485" colspan="2">
<table>
<tr>
<td>PAN No:
</td>
<td align="center">AADCC5952H
</td>
</tr>

<tr>
<td>

</td>
<td align="center">
</td>
</tr>


</table>
</td>
<td colspan="2">
<table>
<tr>
<td >TAN No :
</td>
<td align="right" >MUMC16631G
</td>
</tr>

<tr>
<td>SERVICE TAX No:
</td>
<td width="176"align="right">AADCC5952HST001
</td>
</tr>

</table>




</td>

</tr>

<tr>
<td colspan="5" align="center">
Service Tax Category : Electricity Bill.						
</td>
</tr>

<tr>
<td colspan="5" align="center">

I/We hereby certify that my/our registration certificate under the Maharashtra Value Added Tax Act. 2002 is in force on the date on which the sale of  the goods specified in this " Tax Invoice"  is made by me/us and that the transaction of sales covered by this "Tax Invoice has been effected by me/us and it shall be accounted  for in  the turn over of  sales while filing return and due tax , if any payable on the sales has been paid shall be paid. 						
</td>
</tr>
</tr>





<tr><td colspan="5">
<table>
<tr>

<td width="176">
E & O.E.

</td>

<td width="176">
Terms & Conditions:				
</td>




</tr>

<table width="910">

<tr>
<td style='border-bottom:none;border-top:none;border-left:none;border-right:none;' width="186" >
Note :-


</td>

<td width="800" style='border-bottom:none;border-top:none;border-left:none;border-right:none;'>
1:Payment Should be made in favour of Clear Secured Services Pvt. Ltd.</td>
</tr>



<tr>
<td width="186" style='border-right:none;border-left:none;border-bottom:none;border-top:none'>
</td>

<td width="800" style='border-bottom:none;border-top:none;border-left:none;border-right:none;'>
2:Paymnet to be made within 30 days of bill date.
</td>
</tr>





</table>
</td>
</tr>
<tr>
<td  colspan="5"  >
<br></br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font style="border-top:1px solid rgb(0, 0, 0);">Prepared By</font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font style="border-top:1px solid rgb(0, 0, 0);">Authorized By</font>
<br>
<br>
</td>
</tr>




</td>
</tr>


</table>
</div>







<!--------new format end ------>
<center><a onclick='PrintDiv();' href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 1 </font></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a onclick='PrintDiv2(); 'href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 2 </font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<a onclick='PrintDiv3(); 'href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 3 </font></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
//echo $bill_no=$finalinvoice;
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