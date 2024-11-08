<?php
include("config.php");
$id = $_POST['id'];
$state=$_POST['state'];
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
 //"<br>";
 $tkdt=$_POST['tkdt'];
 $hddt=$_POST['hddt']; 
 $numofd=$_POST['numofd'];
 $billamt=$_POST['billamt'];
 $siterate=$_POST['siterate'];
  $citycategory=$_POST['citycategory'];
 $subcitycat=$_POST['subcitycat'];
 $totalsites=$_POST['tot'];
 $sitebank=$_POST['sitebank'];
 $siteproject=$_POST['siteproject']; 
 $sitezone=$_POST['$sitezone'];
 $siteid=$_POST['siteid'];
 $autoid=$_POST['autoid'];
 //"<br>";
 $billfrm=$_POST['billfrm'];
 //"<br>";
 $billto=$_POST['billto'];
 //"<br>";
  $atm=$_POST['atm']; 
//echo "<br><br><br>";
 // "select max(invid) from siteinvoice where compid='".$comp."' and status='0'";
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
				$company=mysqli_query($con,"select * from company_details where compid='".$comp."'");
				$compro=mysqli_fetch_row($company);
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
  <td width="125" align="center"><b>Category</b></td>
 <td width="209" align="center"> &nbsp;<?php if($cid!='Tata05'){ ?><b>Commercial</b><?php } ?></td>
  <td width="132" align="center"><b>No of sites</b></td>
  <td width="130" align="center">
    </td>
  </tr>
<?php
$bnkk=array();
$citycatt=array();
$citysubcatt=array();
$subcitycat2=array();
$siteratet=array();
$billamtt=array();
$sitebank2=explode(',',$sitebank);
$citycategory2=explode(',',$citycategory);
$subcitycat2=explode(',',$subcitycat);
$siterate2=explode(',',$siterate);
$billamt2=explode(',',$billamt);
$amtt=0;
$amtt2=array();
$nos=array();
/*for($i=0;$i<count($sitebank2);$i++)
{
if(in_array($sitebank2[$i],$bnkk))
{
$bnkkey=array_search($sitebank2[$i], $bnkk);
if(in_array($citycategory2[$i],$citycatt) && $bnkk[$bnkkey]==$sitebank2[$i])
{
$catkey=array_search($citycategory2[$i], $citycatt);
echo "<br>".$sitebank2[$i]." ".$bnkk[$bnkkey]." ".$citycategory2[$i]." ".$citycatt[$catkey]." ".$subcitycat2[$i]."<br>";
if(in_array($subcitycat2[$i],$citysubcatt) && $bnkk[$bnkkey]==$sitebank2[$i] && $citycatt[$catkey]==$citycategory2[$i])
{
$subkey=array_search($subcitycat2[$i], $citysubcatt);
echo "<br>".$sitebank2[$i]." ".$bnkk[$bnkkey]." ".$citycategory2[$i]." ".$citycatt[$catkey]." ".$subcitycat2[$i]." ".$citysubcatt[$subkey]."<br>";
}
else
{
echo $sitebank2[$i]."<br>";
echo "***".$citycategory2[$i];
echo "***".$citysubcatt[]=$subcitycat2[$i];
echo "***".$siteratet[]=$siterate2[$i];
echo "<br>";
$amtt=0;
$amtt=$amtt+$billamt2[$i];

}

}
else
{
echo "<br>";
echo $sitebank2[$i]."<br>";
echo "***".$citycatt[]=$citycategory2[$i];
echo "***".$citysubcatt[]=$subcitycat2[$i];
echo "***".$siteratet[]=$siterate2[$i];
$amtt=0;
$amtt=$amtt+$billamt2[$i];
echo "<br>";
}
}
else
{
echo "<br>";
echo "***".$bnkk[]=$sitebank2[$i];
echo "***".$citycatt[]=$citycategory2[$i];
echo "***".$citysubcatt[]=$subcitycat2[$i];
echo "***".$siteratet[]=$siterate2[$i];
}
}*/
/*for($i=0;$i<count($sitebank2);$i++)
{
if(in_array($sitebank2[$i],$bnkk))
{
$bnkkey=array_search($sitebank2[$i], $bnkk);
if(in_array($citycategory2[$i],$citycatt) && $bnkk[$bnkkey]==$sitebank2[$i])
{
//echo $citycategory2[$i];
$catkey=array_search($citycategory2[$i], $citycatt);
if(in_array($subcitycat2[$i],$citysubcatt) && $bnkk[$bnkkey]==$sitebank2[$i] && $citycatt[$catkey]==$citycategory2[$i])
{
echo "<br>Bank=".$sitebank2[$i]." city category=".$citycategory2[$i]." ".$subcitycat2[$i]."<br>";
$subkey=array_search($subcitycat2[$i], $citysubcatt);
if(in_array($siterate2[$i],$siteratet) && $bnkk[$bnkkey]==$sitebank2[$i] && $citycatt[$catkey]==$citycategory2[$i] && $subcitycat2[$i]==$citysubcatt[$subkey])
{
$ratekey=array_search($siterate2[$i], $siteratet);
if(in_array($siterate2[$i],$siteratet) && $bnkk[$bnkkey]==$sitebank2[$i] && $citycatt[$catkey]==$citycategory2[$i] && $subcitycat2[$i]==$citysubcatt[$subkey])
{
echo $amtt=$amtt+$billamt2[$i];

}
else
{
$siteratet[]=$siterate2[$i];
$amtt=0;
echo $amtt=$amtt+$billamt2[$i];

}

}
else
{
echo $sitebank2[$i]."<br>";
echo "***".$citycategory2[$i];
echo "***".$subcitycat2[$i];
echo "***".$siteratet[]=$siterate2[$i];echo "<br>";
$amtt=0;
echo $amtt=$amtt+$billamt2[$i];
}
}
else
{
echo $sitebank2[$i]."<br>";
echo "***".$citycategory2[$i];
echo "***".$citysubcatt[]=$subcitycat2[$i];
echo "***".$siteratet[]=$siterate2[$i];
echo "<br>";
$amtt=0;
echo $amtt=$amtt+$billamt2[$i];
}
}
else
{
echo $sitebank2[$i]."<br>";
echo "***".$citycatt[]=$citycategory2[$i];
echo "***".$citysubcatt[]=$subcitycat2[$i];
echo "***".$siteratet[]=$siterate2[$i];
$amtt=0;
echo $amtt=$amtt+$billamt2[$i];
echo "<br>";
}
}
else
{

echo "***".$bnkk[]=$sitebank2[$i];
echo "***".$citycatt[]=$citycategory2[$i];
echo "***".$citysubcatt[]=$subcitycat2[$i];
echo "***".$siteratet[]=$siterate2[$i];
$amtt=0;
echo $amtt=$amtt+$billamt2[$i];
echo "<br>Bank=".$sitebank2[$i]." city category=".$citycategory2[$i]." ".$subcitycat2[$i]."<br>";
}
//echo "%%%%";
//echo "<br><br>";
}*/
for($i=0;$i<count($sitebank2);$i++)
{
if(in_array($sitebank2[$i],$bnkk))
{
$bnkkey=array_search($sitebank2[$i], $bnkk);
if(in_array($citycategory2[$i],$citycatt) && $bnkk[$bnkkey]==$sitebank2[$i])
{
//echo $citycategory2[$i];
$catkey=array_search($citycategory2[$i], $citycatt);
if(in_array($subcitycat2[$i],$citysubcatt) && $bnkk[$bnkkey]==$sitebank2[$i] && $citycatt[$catkey]==$citycategory2[$i])
{
 
$subkey=array_search($subcitycat2[$i], $citysubcatt);
if(in_array($siterate2[$i],$siteratet) && $bnkk[$bnkkey]==$sitebank2[$i] && $citycatt[$catkey]==$citycategory2[$i] && $subcitycat2[$i]==$citysubcatt[$subkey])
{
$ratekey=array_search($siterate2[$i], $siteratet);
if( $bnkk[$bnkkey]==$sitebank2[$i] && $citycatt[$catkey]==$citycategory2[$i] && $subcitycat2[$i]==$citysubcatt[$subkey] && $siterate2[$i]==$siteratet[$ratekey])
{
 $amtt=$amtt+$billamt2[$i];
$amtt2[$subkey]=$amtt2[$subkey]+$billamt2[$i];
$nos[$subkey]=$nos[$subkey]+1;
}
else
{
 $bnkk[]=$sitebank2[$i];
 
 $citycatt[]=$citycategory2[$i];
 $citysubcatt[]=$subcitycat2[$i];
$siteratet[]=$siterate2[$i];
$amtt=0;
 $amtt=$amtt+$billamt2[$i];
$amtt2[]=$billamt2[$i];
$nos[]=1;
}

}
else
{
 $bnkk[]=$sitebank2[$i];
 
 $citycatt[]=$citycategory2[$i];
 $citysubcatt[]=$subcitycat2[$i];
 $siteratet[]=$siterate2[$i]; 
$amtt=0;
 $amtt=$amtt+$billamt2[$i];
$amtt2[]=$billamt2[$i];
$nos[]=1;
}
}
else
{

 $bnkk[]=$sitebank2[$i];
 
 $citycatt[]=$citycategory2[$i];
 $citysubcatt[]=$subcitycat2[$i];
 $siteratet[]=$siterate2[$i];

$amtt=0;
 $amtt=$amtt+$billamt2[$i];
$amtt2[]=$billamt2[$i];
$nos[]=1;
}
}
else
{
 $bnkk[]=$sitebank2[$i];
 
 $citycatt[]=$citycategory2[$i];
 $citysubcatt[]=$subcitycat2[$i];
 $siteratet[]=$siterate2[$i];
$amtt=0;
 $amtt=$amtt+$billamt2[$i];
$amtt2[]=$billamt2[$i];
 
$nos[]=1;
}
}
else
{

 $bnkk[]=$sitebank2[$i];
 $citycatt[]=$citycategory2[$i];
 $citysubcatt[]=$subcitycat2[$i];
 $siteratet[]=$siterate2[$i];
$amtt=0;
 $amtt=$amtt+$billamt2[$i];
$nos[]=1;
$amtt2[]=$billamt2[$i];
// "<br>Bank=".$sitebank2[$i]." city category=".$citycategory2[$i]." ".$subcitycat2[$i]."<br>";
}
// "%%%%";
// "<br><br>";
}

 //"<br><br>";
 //echo "bank=".count($bnkk)." citycat=".count($citycatt)." subcat=".count($citysubcatt)." rate=".count($siteratet)." amt=".count($amtt2)."<br>";
$finalamt=0;
for($i=0;$i<count($bnkk);$i++)
{
?>
<tr><td width="110">&nbsp;</td>
  
  

<td align="center" width="177"><?php echo ucfirst($bnkk[$i]); ?></td>
<td align="center" width="125"><?php echo $citycatt[$i]." (".$citysubcatt[$i].")"; ?></td>
<td align="center" width="209"><?php echo $siteratet[$i]; ?></td><td align="center" ><?php echo $nos[$i]; ?></td>
<td align="right" width="130" style="padding-right:25px"><?php $finalamt=$finalamt+$amtt2[$i];echo number_format($amtt2[$i],2); ?></td></tr>
<?php
}

//echo "finalamount ".$finalamt;
?>
 
  <tr><td colspan="6"></td></tr>
   <tr height="22"><td></td>
    <td height="22" colspan="3" align="right">
  <b>  Total</b> </td>
    <td height="22" colspan="" align="center">
    <b><?php echo  $totalsites-1; ?></b></td>
    <td  align="right" style="padding-right:25px" ><?php 
	$total=$aa+$ab+$ac+$an;
	$svtx=12;
if($cid=='EUR08')
	$svtx=3;

$edutx=2;
$hgedutx=1;
	print_r(number_format($total, 2));
	$tx1=0;

	if($cid=='EUR08')
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
  <tr><td colspan="6"><b>CIN No :</b> U74920MH2008PTC187508</td></tr>
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

<?php if(!isset($_POST['tttt'])){ ?><input type="button" name="cmd" value="Save And Print" onclick="save('savemultiinv.php?comp=<?php echo $comp; ?>&city=<?php echo $city; ?>&service=<?php echo $service; ?>&totamt=<?php echo $total; ?>&state=<?php echo $state; ?>&svtx=<?php echo $svtx; ?>&edutx=<?php echo $edutx; ?>&hgedutx=<?php echo $hgedutx; ?>&cust=<?php echo $cid; ?>&project=<?php echo $proj; ?>&bank=<?php echo $bk; ?>&po=<?php echo $po; ?>&zone=<?php echo $zone; ?>&stdt=<?php echo $_POST['stdt']; ?>&todt=<?php echo $_POST['todt']; ?>&inv=<?php echo $inv;  ?>&invdate=<?php echo $invdate; ?>&autoid=<?php echo $autoid; ?>&billfrm=<?php echo $billfrm; ?>&billto=<?php echo $billto; ?>&atm=<?php echo $atm; ?>&sitezone=<?php echo $sitezone; ?>&tkdt=<?php echo $tkdt; ?>&hddt=<?php echo $hddt; ?>&nod=<?php echo $numofd; ?>&billamt=<?php echo $billamt; ?>&siterate=<?php echo $siterate; ?>&siteproject=<?php echo $sitepoject; ?>&atmid2=<?php echo $_POST['atmid2']; ?>&citycat=<?php echo $citycategory; ?>&subcat=<?php echo $subcitycat; ?>&sitebank=<?php echo $sitebank; ?>&siteid=<?php echo $siteid; ?>');" /><?php  } ?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="myButtonControlID" onClick="tableToExcel('billtable', 'Table Export Example')">Export Table data into Excel</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a  href="newsitebills.php?cid=<?php echo $cid; ?>&stdt=<?php echo $_POST['stdt']; ?>&todt=<?php echo $_POST['todt']; ?>&serv=<?php echo $service; ?>&comp=<?php echo $_POST['comp']; ?>" onmouseover="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333">Back</font></a><br/>



</center></div>
</form>
</body>
</html>