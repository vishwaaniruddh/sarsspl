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

     <?php
 ini_set( "display_errors", 0);

//echo "select * from send_bill where send_id='".$id."'";
//echo "select * from send_bill where send_id='".$id."'";

 
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
       ?>
       <div id='exptexcl'>
<?php
$s=$_GET['s'];
$e=$_GET['e'];
$qrrr="select * from send_bill where amount!='0' limit ".$s.",".$e; 
echo $qrrr;
$inv=mysqli_query($con,$qrrr);
while($invro=mysqli_fetch_row($inv)){
$id = $invro[0];
//$id = $_GET['invid'];
//$qrrr="select * from send_bill where send_id='".$id."'";
//$inv=mysqli_query($con,$qrrr);
//$invro=mysqli_fetch_row($inv);
//echo "old date=" .$invro[8];
		$date1 = new DateTime($invro[8]);
        $date2 = new DateTime("2015-06-01");
        $date3 = new DateTime("2015-11-15");
        $date4 = new DateTime("2016-06-01");
        if($date1 >= $date2)$st_flag=1;
        if($date1 >= $date3)$st_flag=3;
        if($date1 >= $date4)$st_flag=4;
 $cid=$invro[1];
 $bid=$invro[2];
 $comp=$invro[6];

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
 
     if($cid=='AGS01'){
     ?>
    <!-- <form name="frm" method="post" action="agssoftcpy.php" target="_blank">
<input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>">
<input type="hidden" id="qr" name="qr" value="<?php echo $qrrr; ?>"><input type="submit" name="cmd" value="Get Soft Copy in EXCEL">
</form>-->
     <?php
     }
     
     if($cid=='FSS04')
     {
     ?>
    <!-- <form name="frm" method="post" action="fssdebitnote.php" target="_blank">
<input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>">
<input type="hidden" id="qrrr" name="qrrr" value="<?php echo $qrrr; ?>" readonly><input type="submit" name="cmd" value="Debit Note">
</form>-->
     <?php
     }
     ?>
     
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

<?php }
 ?>
 </div>
<script> tableToExcel('exptexcl', 'Data' ); </script>
</body>
</html>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
