<?php
include("config.php");
$id = $_POST['id'];

 $proj=$_POST['prjct'];
     $cid = $_POST['cid'];
     $bk = $_POST['bank'];
   $mon = $_POST['mon'];
    $year=$_POST['year'];
    $service = $_POST['serv'];
    $ca = $_POST['ca'];
    $cb = $_POST['cb'];
    $cc = $_POST['cc'];
   $cn = $_POST['cn'];
    $aa = $_POST['aa'];
    $ab = $_POST['ab'];
    $ac = $_POST['ac'];
    $an = $_POST['an'];
 $comp=$_POST['comp'];
 $city=$_POST['city'];
 $po=$_POST['po'];
 $zone=$_POST['zone'];
 $inv=0;
 $tkdt=$_POST['tkdt'];
 $hddt=$_POST['hddt']; 
 $numofd=$_POST['numofd'];
 $billamt=$_POST['billamt'];
 $siterate=$_POST['siterate'];
  $citycategory=$_POST['citycategory'];
 $subcitycat=$_POST['subcitycat'];
 $totalsites=$_POST['tot'];
 //echo "select max(invid) from siteinvoice where compid='".$comp."' and status='0'";
 $invd='';

if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); }else{ $invd=date('y',strtotime('-1 year'))."-".date('y'); }

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

if(isset($_POST['invid']))
$inv=$_POST['invid'];
    $nwords = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty", 50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty", 90 => "Ninety" ); 
function int_to_words($x)
       {
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
           return $w;
       }
	//echo $cid." -".$bk;
	
   // $sqll = "SELECT distinct category,amount FROM sitebills where cid='$cid' ";
	//echo "".$cid."-".$bk;
	 $sr=$service."_rate";
	        $i = 1;
	       //if($bk==-1 && $cty==-1) 
	       
	      //	$sql = "SELECT $sr FROM sites where cid='$cid' and city_category='A'";
	      // else if($bk==-1)		 
              //  $sql = "SELECT distinct category,amount FROM sitebills where cid='$cid' and city='$cty'"; 
             //  if($cty==-1) {
			// echo "SELECT $sr FROM sites where cust_name='$cid' and bank='$bk' and city_category='A'";;
                $sql = "SELECT $sr FROM ".$cid."_sites where city_category='A' and ".$service."='Y'";
                 if($bk!='-1')
                {
                $sql.=" and bank='$bk'";
                
                }
                if($proj!='-1' || $proj!='')
                $sql.=" and projectid='$proj'";
            //    echo $sql;
                $result = mysqli_query($con,$sql);
                $row=mysqli_fetch_row($result); 
                $ra=$row[0];// echo $ra;
                $sql = "SELECT $sr FROM ".$cid."_sites where city_category='B' and ".$service."='Y'";
                 if($bk!='-1')
                {
                $sql.=" and bank='$bk'";
                
                }
                if($proj!='-1' || $proj!='')
                $sql.=" and projectid='$proj'";
                $result = mysqli_query($con,$sql);
                $row=mysqli_fetch_row($result); 
                $rb=$row[0];// echo $rb;
                $sql = "SELECT $sr FROM ".$cid."_sites where city_category='C' and ".$service."='Y'";
                 if($bk!='-1')
                {
                $sql.=" and bank='$bk'";
                
                }
                if($proj!='-1' || $proj!='')
                $sql.=" and projectid='$proj'";
                $result = mysqli_query($con,$sql);
                $row=mysqli_fetch_row($result); 
                $rc=$row[0]; //echo $rc;
                $sql = "SELECT distinct($sr) FROM ".$cid."_sites where not city_category='A' and not city_category='B' and not city_category='C' and ".$service."='Y'";
                if($bk!='-1')
                {
                $sql.=" and bank='$bk'";
                
                }
                if($zone!='')
                $sql.=" and zone='$zone'";
                if($proj!='-1' || $proj!='')
                $sql.=" and projectid='$proj'";
              //echo $sql;
                $result = mysqli_query($con,$sql);
                //$co=mysqli_num_rows($result);
                $cnttt=0;
                
                $naamt=array();
               $row=mysqli_fetch_row($result);
             // echo "ro=".$row[0];
                $ro=$row[0];
                //echo $row[1];
                
               // print_r($ro);
                //echo "count of na ".$cnttt;
              //  $result=mysqli_query($con,"select cust_id from sites where cust_name='$cid' limit 1");
               // $row=mysqli_fetch_row($result); 
                $cust_id=$cid;
                $result=mysqli_query($con,"select id from contacts where short_name='$cust_id'");
                $row=mysqli_fetch_row($result); 
                $uid=$row[0];
                $result=mysqli_query($con,"select * from address_book where ref_id='$uid'");
                $addrow=mysqli_fetch_row($result); 
                $result=mysqli_query($con,"select billname from billcompany where cust_id='$cust_id'");
                $brow=mysqli_fetch_row($result); 
				$comp33=mysqli_query($con,"select * from company_details where compid='".$comp."'");
				$compro=mysqli_fetch_row($comp33);
             //   }
             //  else 
		//$sql = "SELECT distinct category,amount FROM sitebills where cid='$cid' and bank='$bk' and city='$cty'";
		//$result = mysqli_query($con,$sql);
			?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bill</title>
</head>

                
<body>


 
 <div id='front'>
<!--<img src="image002.jpg" width="520" height="60" />-->

<center>

<table border="0" id="billtable">

<thead>
 <tr height="300px"><td colspan="2" align="center">&nbsp;</td></tr>

</thead>

<tbody>
<tr><td colspan="2" align="center"><p><b>TAX INVOICE </b></p></td></tr>
<tr><td colspan="2">
  
<?php //echo "company=".$_POST['comp'] ?>
<?php $invdate='';
	if(date('m')>='4'){ $invdate=date('y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('y',strtotime('-1 year'))."-".date('y'); } ?>

<table width="921" height="53" align="center" cellpadding="0" cellspacing="0" border="1" >
  <col width="151" />
  <col width="72" />
  <tr height="50"><td width="50%" valign="top"><?php echo "<b>".$addrow[3]."</b><br>".$addrow[4]."<br>".$addrow[5]."<br>".$addrow[6]."<br>".$addrow[7]."<br>".$addrow[8]."<br>"; ?></td><td width="50%" valign="top" align="right"><table border="0">
  <tr>
  <td align="left" colspan="">Invoice No :</td><td> <?php if($_POST['comp']=='1'){ echo "CSS"; }elseif($_POST['comp']=='2'){ echo "C&C"; }elseif($_POST['comp']=='3'){ echo "CS"; }?>/<?php if($service=='caretaker'){ echo "CT"; }elseif($service=='housekeeping'){ echo "HK"; }elseif($service=='maintenance' || $service=='maintenance HK' || $service=='maintenance CT'){ echo "FM"; }elseif($service=='Repair&Maintenance'){ echo "RNM"; } ?>/<span id="inv"><?php echo $inv; ?></span>/<?php echo $invdate; ?>
  </td></tr><?php if($po!=''){ ?><tr><td align="right">PO Number :</td><td><?php echo $po.""; ?></td></tr> <?php }  ?><tr><td align="right">
 Date :</td><td align="left"> <?php if(!isset($_POST['invoicedt'])){ echo date("d M,Y"); }else{ echo date("d M,Y",strtotime($_POST['invoicedt'])); } ?> </td></tr></table>
  </td></tr>
 <!--  <tr>
    <td height="18" colspan="2" align="center"><?php echo ucfirst($service); ?> bill for the Month Of <?php echo $mon." ".$year; ?>  </td>
  </tr>-->
  <tr><td colspan="2">
  <table width="918" border="1">
  <tr><td width="800" align="center"><b>PARTICULAR</b></td><td align="center"><b>AMT. INR</b></td></tr>
 
  <tr><td width="80%" colspan="2">
  <table width="908" border="0">
    <tr><td colspan="6">
  <?php echo ucfirst($service); ?> bill for <?php 
   if($bk=='-1'){  if($proj=='SBI - OTHER BANK'){ echo "SBI"; }else{ echo "All";} }else{ echo $bk; } ?> Bank ATMs for the Month Of <?php echo $mon." ".$year;
   if($zone!=''){ echo " - ".$zone." Zone"; }
  $no=0;
   ?> 
  </td></tr>
  <tr><td width="110">&nbsp;</td>
  
  <td width="177" align="center"><b>Bank</b></td>
  <td width="125" align="left"><b>Category</b></td>
 <td width="209" align="center"> &nbsp;<?php if($cid!='Tata05'){ ?><b>Commercial</b><?php } ?></td>
  <td width="132" align="center"><b>No of sites</b></td>
  <td width="130" align="center">
    </td>
  </tr>
<?php if($ca>0){
  $caaa=$_POST['subcata'];
 $acnt=$_POST['acnt'];
 $aamt=$_POST['aamt'];
 $caaa2=explode(",",$caaa);
 $aamt2=explode(",",$aamt);
 $acnt2=explode(",",$acnt);
 $acom2=explode(",",$_POST['acom']);
 if(count($caaa2)>1){
  for($abc=0;$abc<count($caaa2);$abc++)
  {
 
  ?>
 <tr><td colspan=""><?php //echo $cnaa2[$abc]." cnaa2<br>";
 // echo $naamt2[$abc]." naamt2<br>";
 // echo $nacnt2[$abc]." nacnt2<br>"; ?></td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk;} ?></td>
  <td align="left"><?php echo  "A (".$acnt2[$abc].")"; ?></td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $acom2[$abc]; ?><?php } ?></td>
  <td align="center"><?php 
  
   $no=$no+$caaa2[$abc];

  echo $caaa2[$abc]; ?></td><td align="right" style="padding-right:25px"><?php echo number_format(round($aamt2[$abc]), 2, '.', ''); ?></td></tr>
  <?php
  }
 }else{
  ?> <tr><td colspan="">&nbsp;</td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk; } ?></td>
  <td align="left">A</td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $ra; ?><?php } ?></td>
  <td align="center"><?php 
  $no=$no+$ca;
  echo $ca; ?></td><td align="right" style="padding-right:25px"><?php echo number_format(round($aa), 2, '.', ''); ?></td></tr>
 <?php } } if($cb>0){
 
  $cbbb=$_POST['subcatb'];
 $bcnt=$_POST['bcnt'];
 $bamt=$_POST['bamt'];
 $cbbb2=explode(",",$cbbb);
 $bamt2=explode(",",$bamt);
 $bcnt2=explode(",",$bcnt);
 $bcom2=explode(",",$_POST['bcom']);
 if(count($cbbb2)>1){
  for($abc=0;$abc<count($cbbb2);$abc++)
  {
 
  ?>
 <tr><td colspan=""><?php //echo $cnaa2[$abc]." cnaa2<br>";
 // echo $naamt2[$abc]." naamt2<br>";
 // echo $nacnt2[$abc]." nacnt2<br>"; ?></td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk;} ?></td>
  <td align="left"><?php echo  "B (".$bcnt2[$abc].")"; ?></td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $bcom2[$abc]; ?><?php } ?></td>
  <td align="center"><?php 
  
   $no=$no+$cbbb2[$abc];

  echo $cbbb2[$abc]; ?></td><td align="right" style="padding-right:25px"><?php echo number_format(round($bamt2[$abc]), 2, '.', ''); ?></td></tr>
  <?php
  }
 }else{
 ?>
  <tr><td colspan="">&nbsp;</td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk; } ?></td>
  <td align="left">B</td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $rb; ?><?php } ?></td>
  <td align="center"><?php
   $no=$no+$cb;
   echo $cb; ?></td><td  align="right" style="padding-right:25px"><?php echo number_format(round($ab), 2, '.', ''); ?></td></tr>
  <?php } } if($cc>0){
   $cccc=$_POST['subcatc'];
 $ccnt=$_POST['ccnt'];
 $camt=$_POST['camt'];
 $cccc2=explode(",",$cccc);
 $camt2=explode(",",$camt);
 $ccnt2=explode(",",$ccnt);
 $ccom2=explode(",",$_POST['ccom']);
 if(count($cccc2)>1){
  for($abc=0;$abc<count($cccc2);$abc++)
  {
 
  ?>
 <tr><td colspan=""><?php //echo $cnaa2[$abc]." cnaa2<br>";
 // echo $naamt2[$abc]." naamt2<br>";
 // echo $nacnt2[$abc]." nacnt2<br>"; ?></td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk;} ?></td>
  <td align="left"><?php echo  "C (".$ccnt2[$abc].")"; ?></td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $ccom2[$abc]; ?><?php } ?></td>
  <td align="center"><?php 
  
   $no=$no+$cccc2[$abc];

  echo $cccc2[$abc]; ?></td><td align="right" style="padding-right:25px"><?php echo number_format(round($camt2[$abc]), 2, '.', ''); ?></td></tr>
  <?php
  }
 }else{
  ?>
  <tr><td colspan="">&nbsp;</td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk;} ?></td>
  <td align="left">C</td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $rc; ?><?php } ?></td>
  <td align="center"><?php
   $no=$no+$cc;
   echo $cc; ?></td><td  align="right" style="padding-right:25px"><?php echo number_format(round($ac), 2, '.', ''); ?></td></tr>
  <?php } } ?>
  <?php
  
 // echo "cn=".$cn;
   if($cn>0){ 
  if($cid=='EUR08'){
  
  if($service=='maintenance')
  {
   ?>
  <tr><td colspan="">&nbsp;</td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk;} ?></td>
  <td align="left">NA</td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $ro; ?><?php } ?></td>
  <td align="center"><?php 
   $no=$no+$cn;
  echo $cn; ?></td><td align="right" style="padding-right:25px"><?php echo number_format(round($an), 2, '.', ''); ?></td></tr>
  <?php
  }
  else{
 $cnaa=$_POST['subcatna'];
 $nacnt=$_POST['nacnt'];
 $naamt=$_POST['naamt'];
$nacom=$_POST['nacom'];
 $cnaa2=explode(",",$cnaa);
 $naamt2=explode(",",$naamt);
 $nacnt2=explode(",",$nacnt);
 $nacom2=explode(",",$nacom);
//print_r($nacom2);
  for($abc=0;$abc<count($cnaa2);$abc++)
  {
 
  ?>
 <tr><td colspan=""><?php //echo $cnaa2[$abc]." cnaa2<br>";
 // echo $naamt2[$abc]." naamt2<br>";
 // echo $nacnt2[$abc]." nacnt2<br>"; ?></td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk;} ?></td>
  <td align="left"><?php echo  "NA (".$nacnt2[$abc].")"; ?></td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $nacom2[$abc]; ?><?php } ?></td>
  <td align="center"><?php 
  
   $no=$no+$cnaa2[$abc];

  echo $cnaa2[$abc]; ?></td><td align="right" style="padding-right:25px"><?php echo number_format(round($naamt2[$abc]), 2, '.', ''); ?></td></tr>
  <?php
  }
  }
  }
  else
  {
  ?>
  <!--<tr><td colspan="">&nbsp;</td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk;} ?></td>
  <td align="left">NA</td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $ro; ?><?php } ?></td>
  <td align="center"><?php 
   $no=$no+$cn;
  echo $cn; ?></td><td align="right" style="padding-right:25px"><?php echo number_format(round($an), 2, '.', ''); ?></td></tr>-->
  <?php
  $cnaa=$_POST['subcatna'];
 $nacnt=$_POST['nacnt'];
 $naamt=$_POST['naamt'];
$nacom=$_POST['nacom'];
 $cnaa2=explode(",",$cnaa);
 $naamt2=explode(",",$naamt);
 $nacnt2=explode(",",$nacnt);
 $nacom2=explode(",",$nacom);
//print_r($nacom2);
  for($abc=0;$abc<count($cnaa2);$abc++)
  {
 
  ?>
 <tr><td colspan=""><?php //echo $cnaa2[$abc]." cnaa2<br>";
 // echo $naamt2[$abc]." naamt2<br>";
 // echo $nacnt2[$abc]." nacnt2<br>"; ?></td>
  <td align="center"><?php if($bk=='-1'){ echo "All"; }else{ echo $bk;} ?></td>
  <td align="left"><?php echo  "NA (".$nacnt2[$abc].")"; ?></td>
  <td align="center"><?php if($cid!='Tata05'){ ?><?php echo $nacom2[$abc]; ?><?php } ?></td>
  <td align="center"><?php 
  
   $no=$no+$cnaa2[$abc];

  echo $cnaa2[$abc]; ?></td><td align="right" style="padding-right:25px"><?php echo number_format(round($naamt2[$abc]), 2, '.', ''); ?></td></tr>
  <?php
  }
  }
  } ?>
  
  <tr><td colspan="6"></td></tr>
   <tr height="22"><td></td>
    <td height="22" colspan="3" align="right">
  <b>  Total</b> </td>
    <td height="22" colspan="" align="center">
    <b><?php echo  $totalsites-1; ?></b></td>
    <td  align="right" style="padding-right:25px" ><?php 
	$total=$aa+$ab+$ac+$an;
	
	print_r(number_format($total, 2));
	$tx1=0;
	if($cid=='EUR08' && $service=='maintenance')
	$tx1=$total*0.03;
	else
	 $tx1=$total*0.12;
  $tx2=$tx1*0.02;
 $tx3=$tx1*0.01;
	 ?></td>

  </tr>
  <tr height="22"><td></td>
    <td height="22" colspan="4" align="right">Service Tax@<?php  if($cid=='EUR08' && $service=='maintenance'){ echo "3"; }else{ echo "12"; } ?>%</td> 
    <td  align="right" style="padding-right:25px"><?php  echo number_format($tx1, 2); ?></td>
   
  </tr>
  <tr height="22"><td></td>
    <td height="22" colspan="4" align="right">
    Education Cess @2%</td>
    <td  align="right" style="padding-right:25px"><?php echo number_format($tx2, 2); ?></td>
    
  </tr>
  <tr height="22"><td></td>
    <td height="22" colspan="4" align="right">
   Secondary &amp; Higher Education Cess    @1%</td>
    <td  align="right" style="padding-right:25px"><?php echo number_format($tx3, 2); ?></td>
   
  </tr>
  <tr><td colspan="6" ><hr/></td></tr>
  <tr height="22">
  
    <td height="21" colspan="4" align="left"><b>[Rs.  <?php 
	$gt=round(($total+$tx1+$tx2+$tx3));
	//$gt2=
	$st=int_to_words($gt); echo $st; ?> Only  ]</b></td><td>
    
    
    <b>Grand Total INR</b></td>
    <td  align="right" style="padding-right:25px"><b><?php  echo number_format($gt,2); ?></b></td>
   
  </tr>
  <tr height="22">
  
    <td height="21" colspan="6" ><hr /></td>
   
  </tr>
  
  <tr><td colspan="3"><b>PAN NO :</b> <?php echo $compro[2]; ?></td></td>
  <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TAN No. :</b><?php echo $compro[4]; ?></td>
  </tr>
  <tr><td colspan="3"><b>VAT NO :</b><?php  if($compro[0]=='1'){ ?>27250728717v w.e.f. 06-10-09<?php } //if($brow[0]=="Clean and Clear")echo "AEDPD7193L"; else echo "AADCC5952H"; ?></td>
  <td colspan="3"><b>Service Tax No. :</b><?php echo $compro[3]; ?></td>
  </tr>
  <?php 
  if($comp=='1')
  {
  ?>
  <tr><td colspan="6"><b>CIN NO :</b> U74920MH2008PTC187508</td></tr>
  <?php } ?>
  <tr><td colspan="6"><hr /></td></tr>
  <tr><td colspan="6">Service Tax Category : <?php echo ucfirst($service); ?> service</td>
  </tr>
  <tr><td colspan="6"><hr /></td></tr>
  <tr height="40px"><td colspan="6"><p align="justify">I/We hereby certify that my/our registration certificate under the Maharashtra Value Added Tax Act. 2002 is in force on the date on which the sale of the goods specified in this "Tax Invoice" is made by me/us and that the transaction of sales covered by this "Tax Invoice" has been effected by me/us and it shall be accounted for in the turnover of sales while filing return and due tax, if any payable on the sales has been paid shall be paid.</p></td></tr>
   <tr><td colspan="6"><hr /></td></tr>
  <tr height="50px"><td colspan="6">
  <table width="903" height="104">
    <tr><td height="28"><b>E & O.E.</b></td>
    <td colspan="5"><b>Terms & Conditions:</b></td></tr> 
  <tr><td height="26"><b>Note :-</b></td>
  <td colspan="5">1. Payment to be made in favour of <?php echo $compro[1]; ?><br>
                  2. Payment to be made within 30 days of bill date.
  </td></tr>
  <tr height="30px"><td colspan="6" valign="bottom" align="right"><b>For <?php echo $compro[1]; ?></b></td></tr>
  <tr height="90px"><td colspan="6" valign="bottom" align="right"><b>Authorised Signatory</b></td></tr>
   </table></td></tr>
  </table>
  
  </td></tr>
  </table>
  
  
  </td></tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<!--<div align="center">Regd. Off.:Runwal & Omkar E-Square, 201-D, 2nd Floor, Sion (East), Mumbai-400 022.<br />
Tel.: 022-24022435. Visit us : www.cssindia.in</div>-->
</td></tr></tbody></table>
</center><br/><br/></div>
<div id="hide">
<center><a onclick="PrintDiv('front');" href="#" onmouseover="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print</font></a>

<?php if(!isset($_POST['tttt'])){ ?><input type="button" name="cmd" value="Save And Print" onclick="save('<?php echo $_POST['comp']; ?>','<?php echo $cid; ?>','<?php echo $bk; ?>','<?php echo $_POST['stdt']; ?>','<?php echo $_POST['todt']; ?>','<?php echo $service; ?>','<?php echo $gt; ?>','<?php echo $_POST['atm']; ?>','<?php echo $city; ?>','<?php echo $tkdt; ?>','<?php echo $hddt; ?>','<?php echo $numofd; ?>','<?php echo $billamt; ?>','<?php echo $siterate; ?>','<?php echo $citycategory; ?>','<?php echo $subcitycat; ?>');" /><?php  } ?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="myButtonControlID" onClick="tableToExcel('billtable', 'Table Export Example')">Export Table data into Excel</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a  href="sitebillsme.php?cid=<?php echo $cid ?>&stdt=<?php echo $_POST['stdt']; ?>&todt=<?php echo $_POST['todt']; ?>&serv=<?php echo $service; ?>&comp=<?php echo $_POST['comp']; ?>" onmouseover="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333">Back</font></a><br/>



</center></div>
</form>
</body>
</html>