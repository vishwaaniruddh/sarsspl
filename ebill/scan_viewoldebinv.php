<?php 
session_start();
//echo $_SESSION['user'];
if(!isset($_SESSION['user']))
header('location:index.php');

include("config.php");
?>

<script src="excel.js" type="text/javascript"></script>
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
 ?>
<center>
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
     </script>
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
  <tr>
  <td width="850" height="45"><b>Sub:</b>&nbsp;&nbsp;  Reimbursement Of Electricity Bills.</td>
  </tr>
  <tr><td>

<table border="1" style="border-collapse:collapse; table-layout: fixed; width: 900px;"><thead>
  <tr>
    <th style="overflow: hidden; width: 28px; "><div align="center">Sr No. </div></th>
      <th style="overflow: hidden; width: 40px; font-size:small;" ><div align="center">Project ID </div></th>
    <th style="overflow-x: visible; width: 40px; font-size:small;"  ><div align="center">BANK</div></th>
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
      
  </tr></thead><tbody>
  <?php $sum=0;$schrg=0;
$ij=0;
  //echo "select * from send_bill_detail where send_id='".$id."'";
  $ann=mysqli_query($con,"select * from send_bill_detail where send_id='".$id."' and status=0");
$cb=mysqli_num_rows($ann);
        while($annr=mysqli_fetch_array($ann))
             {
		$ij=$ij+1;
$sum=$sum+$annr[12]+$annr['extrachrg']+$annr['recon_chrg']+$annr['discon_chrg']+$annr['sd']+$annr['after_duedt_chrg'];
                $nsql = "select * from ".$cid."_ebill where atmtrackid='$annr[2]'";// echo $nsql;
				
                $result = mysqli_query($con,$nsql);
             
		$row = mysqli_fetch_row($result);
		
	$ress = mysqli_query($con,$sqll);
		//echo "select location,site_id,bank from ".$cid."_sites where trackerid='$annr[1]'";
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
				 
		$invscncpy_qry=mysqli_query($con,"SELECT * FROM `invscncpy` WHERE `detail_id` = '".$annr[0]."' AND `status` = 1");		
	?>
		 <tr height="20"><td align="center" style="overflow: hidden; width: 28px;">&nbsp;<?php echo $ij; ?></td>
		 <td align="center" style="overflow: hidden; width: 40px; font-size:small;" >&nbsp;<?php echo $rows[4]; ?></td>
         <td align="center" style="word-wrap: break-word; width: 40px; font-size:small;">&nbsp;<?php echo $rows[2]; ?></td>
		     <td align="center" style="word-break: break-all;overflow: hidden; width: 75px; font-size:small;" >&nbsp;<?php echo $rows[3]; ?></td>
             <td align="center" style="overflow: hidden; width: 80px; font-size:x-small;" >&nbsp;<?php echo $rows[1]; ?></td>
             <td align="center" style="width: 80px; font-size:small;word-break: break-all;" >&nbsp;<?php echo $row[1]; ?></td>
             <!--<td align="center" width="28" >&nbsp;<?php echo $row[5]; ?></td>-->
			 <td align="left" style="overflow: hidden; width: 202px; word-break: keep-all; font-size:small;" ><?php echo  $location; ?></td>
			 
			 <td align="center" style="font-size:small;" >&nbsp;<?php if(isset($annr[9]) and $annr[9]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[9])); } else{ echo "NA"; } ?></td>			 			              
			  <td align="center" style="font-size:small;" >&nbsp;<?php if(isset($annr[10]) and $annr[10]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[10])); } else{ echo "NA"; } ?></td>			 			              
		      <td align="center" style="font-size:small;" >&nbsp;<?php  if(isset($annr[13]) and $annr[13]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[13])); }
		      else{ echo "NA"; }//$bills[$i]; 
		      ?></td>
                <td align="center" style="font-size:small;" >&nbsp;<?php if(isset($annr[6]) and $annr[6]!='0000-00-00'){ echo date('d/m/Y',strtotime($annr[6])); }
                else{ echo "NA"; } ?></td>
                 <td align="center" style="overflow: hidden; width: 40px;" >&nbsp;<?php echo $annr[8]; ?></td>
               		 			              
			 <td align="right" style="overflow: hidden; width: 72px;" ><?php echo number_format((float)($annr[12]+$annr['extrachrg']+$annr['recon_chrg']+$annr['discon_chrg']+$annr['sd']+$annr['after_duedt_chrg']), 2, '.', ''); ?></td>	
	<td>
	<?php 
		if(mysqli_num_rows($invscncpy_qry)>0)
		{
			$invscncpy_row=mysqli_fetch_array($invscncpy_qry);
			echo "<a href=\"invscncpy/".$invscncpy_row['filename']."\" target=\"_blank\">View</a>";
		}
		else
		{
	?>
	<br><br>
	<form method="post" action="process_scan_viewoldebinv.php" enctype="multipart/form-data">
	<input type="hidden" name="detail_id" value="<?php echo $annr[0]; ?>"/>
	<input type="hidden" name="send_id" value="<?php echo $id ?>"/>
	<input type="file" required="required" name="email_cpy">
	<input type="submit" value="Attach"/>
</form>
	<?php
		}
	?>
	</td>		
                      
		</tr>
		<?php
	

		}
		
?>
<tr><td colspan="12" align="right"><b>Total Billing Amount</b></td>
<td align="right"><?php echo number_format((float)$sum, 2, '.', ''); ?></td></tr><tbody>

</table>
<p align="left"><b>(Rs.  <?php $st=int_to_words($sum); echo $st." Only";

 ?>  )</b></p>
 <script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>