 <?php ini_set( "display_errors", 0);

include("access.php");


// header('Location:managesite1.php?id='.$id); 
 


//echo "comp=".$_POST['comp'];
if(!isset($_POST['comp']) || $_POST['comp']=='-1')
{

?>

<script type="text/javascript">
alert("All fields are compulsory");
window.location.href='newsitebills.php?id=<?php echo $_POST['id']; ?>';
</script>
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Site Bills</title>
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">     
        function PrintDiv(id) {   
      // document.getElementById('hide').style.display='none'; 
           var divToPrint = document.getElementById(id);
           
           var popupWin = window.open('', '_blank', 'width=800,height=400');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }


</script>
<script src="excel.js" type="text/javascript"></script>
<script type="text/javascript">
function save(val)
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
		
alert(xmlhttp.responseText);
if(xmlhttp.responseText=='0')
alert("Some Error Occurred");
else
{
//document.getElementById("resshow").innerHTML=xmlhttp.responseText;
document.getElementById("inv").innerHTML=xmlhttp.responseText;
PrintDiv('front');
}

	
	
    }
  }
  //alert(val);
 var dat=val.split("?");
xmlhttp.open("POST",dat[0],true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(dat[1]);
}

function bill(val,id)
{
	//alert("hi");
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
		
//alert(xmlhttp.responseText);
document.getElementById(id).innerHTML='';
	document.getElementById(id).innerHTML=xmlhttp.responseText;
	
	
    }
  }
  //alert(val);
  //alert("getcustbank.php?val="+val);
//xmlhttp.open("GET",val,true);
//xmlhttp.send();
var dat=val.split("?");
xmlhttp.open("POST",dat[0],true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(dat[1]);
}
	

</script>
<!--<style type="text/css">
   /*table { page-break-inside:auto }
   tr    { page-break-inside:avoid; page-break-after:auto }
@media all {
 .page-break  { display: none; }
}

@media print {
 .page-break  { display: block; page-break-before: always; }
}
table.stat th, table.stat td {
  font-size : 50%;
  font-family : "Myriad Web",Verdana,Helvetica,Arial,sans-serif;
  }
 */
 table.stat th, table.stat td {
/* margin-top:0.5px;
 margin-left:0.5px;
 margin-right:0.5px;
 margin-bottom:0.5px;*/
  font-size : 8px;
  font-family : "Myriad Web",Verdana,Helvetica,Arial,sans-serif;
  
  }
  table.stat tr:nth-child(14n+1)
{ 
   page-break-after,"always";
}
</style>-->
</head>

<body>
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?></center>
 
 
 
 <div align="center">
  <h2 class="style1">SITE BILL</h2>
 
<?php
include("config.php");
 $timezone = "Asia/Calcutta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
 $id = $_POST['id'];
 $cid = $_POST['cid'];
$custname = $_POST['cid'];
 $bkme = $_POST['formCountries'];
   // print_r($bkme);
   $bk='-1';
  if(in_array('-1',$bkme))
{
}
else
{
$bk=implode(",",$bkme);
$bk2=str_replace(",","','",$bk);

}
    //echo $bk;
	$tot=0;
    $cty = $_POST['city'];
    $service = $_POST['service'];
    $from = $_POST['from'];
    $to = $_POST['to'];
	$comp=$_POST['comp'];
//    $dd = datediff('y', $from, $to, false);
    $date_parts1=explode("/", $from);
    $date_parts2=explode("/", $to);
    //echo $from."  ".$to;
   // $start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
   // $end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
   $start_date=$date_parts1[2]."-".$date_parts1[1]."-".$date_parts1[0]; //echo $start_date;
   $end_date=$date_parts2[2]."-".$date_parts2[1]."-".$date_parts2[0];  //echo $end_date;
   $mon=date( 'F', mktime(0, 0, 0, $date_parts1[1]) ); //echo $mon;
  //  $dd = $end_date - $start_date;
  //  echo $dd/(3600*24)+1;
    $fr = strtotime($start_date, 0);
    $t = strtotime($end_date, 0);
    $difference = $t - $fr;
    $dd = intval($difference/(3600*24)+1);
   // echo $dd;
    $nod = cal_days_in_month(CAL_GREGORIAN, $date_parts1[1], $date_parts1[2]);
  //  echo $nod;
    $ca=0;$cb=0;$cc=0;$cn=0;$aa=0;$ab=0;$ac=0;$an;$ra=0;$rb=0;$rc=0;$rn=0;
    $acnt=array();
     $bcnt=array();
      $ccnt=array();
       $nacnt=array();
       $cnta=0;$caaa=array();
       $cntb=0;$cbbb=array();
       $cntc=0;$cccc=array();
       $cntna=0;$cnaa=array();
       $aamt=array();
       $bamt=array();
       $camt=array();
       $naamt=array();
       
    ?>
</div>
<div id="annexure">
<!--<p align="center" >Customer ID &nbsp;<?php echo $cid; ?> <br> Bank &nbsp; <?php if($bk==-1) echo "All Bank" ; else echo $bk; ?>
  <br> Bill From <?php echo $from; ?> To <?php echo $to; ?></p>-->
  <p align="center" height="8px"><?php //echo $bk; if($bk==-1){ echo "All"; } else{ echo $bk; } ?><?php echo " ".ucfirst($service) ; ?> billing data for the month of <?php echo date("M y",strtotime($start_date)); ?></center>
 
<table width="700px" border="1" align="center" cellpadding="2" cellspacing="0" id="custtable" style="font-size:8px" class='stat'>
  <thead><tr height="8px">
  <th scope="col"><div align="center">Sr No</div></th> 
  <th scope="col"><div align="center">Project ID</div></th> 
  <?php if($cid=='Prizm07'){ ?><th scope="col"><div align="center">Customer Id </div></th>
  <th scope="col"><div align="center">Bank </div></th>
  <th scope="col"><div align="center">City</div></th> 
  <th scope="col"><div align="center">State </div></th>
  <th scope="col"><div align="center">Region </div></th>
  <th scope="col"><div align="center">Atm ID</div></th>
  <th scope="col"><div align="center">Site ID</div></th>
  <th scope="col"><div align="center">II AtmID</div></th>
  <th scope="col"><div align="center">Location</div></th>
  <th scope="col"><div align="center">Category</div></th>
  
   <?php } 
   elseif($cid=='FIS03')
   {
   ?>
   <th scope="col"><div align="center">Bank </div></th>
   <th scope="col"><div align="center">Zone </div></th>
   <th scope="col"><div align="center">Atm ID</div></th>
   <th scope="col"><div align="center">Site ID</div></th>
     <th scope="col"><div align="center">II AtmID</div></th>
   <th scope="col"><div align="center">Location</div></th>
   <th scope="col"><div align="center" width="50px">Address </div></th>
     <th scope="col"><div align="center">City</div></th> 
  <th scope="col"><div align="center">State </div></th>
  
   <?php
   }
  else{ ?>
  <th scope="col"><div align="center">Bank </div></th> 
  <th scope="col"><div align="center">Atm ID</div></th> 
  <th scope="col"><div align="center">Site ID</div></th>
  <th scope="col"><div align="center">II Atm ID</div></th> 
 <!-- <th scope="col"><div align="center">Agency </div></th>--> 
  <th scope="col" width="30px"><div align="center">Address 1 </div></th> 
  <th scope="col" width="30px"><div align="center">Address2 (Landmark) </div></th> 
  <th scope="col" width="30px"><div align="center">Address3 (District)</div></th> 
  <th scope="col"><div align="center">Pincode </div></th> 
  <th scope="col"><div align="center">City</div></th> 
  <th scope="col"><div align="center">State </div></th> 
  <th scope="col"><div align="center">Country</div></th> 
  <th scope="col"><div align="center">Zone </div></th>
  
  <?php } ?>
  <th scope="col"><div align="center"> Category</div></th> 
  <th scope="col"><div align="center">TakeOver Date </div></th> 
  <th scope="col"><div align="center"><?php if($cid=='FIS03'){ echo "Bills Period<hr>"; } ?>From </div></th> 
  <th scope="col"><div align="center"><?php if($cid=='FIS03'){ echo "Bills Period<hr>"; } ?>To</div></th> 
  <th scope="col"><div align="center">Handover Date </div></th> 
  <th scope="col"><div align="center">Days </div></th> 
  <th scope="col"><div align="center">Rate </div></th> 
  <th scope="col"><div align="center">Billing Amount </div></th>
  
   
  </tr></thead><tbody>
  <?php
$brkcnt=0;
$actservc=$service;
   $service2=explode(" ",$service);
$service=$service2[0];
$qrstr='';
if($service2[1]=='CT')
$qrstr=" and takeover_date<='".$end_date."' and (handover_date>='".$start_date."' or handover_date='0000-00-00' or handover_date='null')";
if($service2[1]=='HK')
$qrstr=" and ".$service."_tkdt<='".$end_date."' and (".$service."_hodt>='".$start_date."' or ".$service."_hodt='0000-00-00' )";
	
	        $i = 1;
	       
	      	$sql = "SELECT * FROM ".$custname."_sites where active='Y' ".$qrstr." and ".$service."='Y'";
		
                if($_POST['city']!='' && $_POST['city']!='-1')
                $sql.=" and city='$cty'";
		
$pono='';
if($cid=='Tata05' && isset($_POST['po2']))
			{
		$pono='-1';
 echo "po=".($_POST['po2']);
if(!in_array('-1',$_POST['po2']) && !in_array('',$_POST['po2']))
{

$pono=implode(",",$_POST['po2']);
		$pono2=str_replace(",","','",$pono);
			
			$sql.=" and atm_id1 in (select atm_id1 from tatapo where po in ('$pono2'))";
		}	
}
if(isset($_POST['atm']) && !in_array('-1',$_POST['atm']))
{

$selatm=implode(",",$_POST['atm']);
		$selatm=str_replace(",","','",$selatm);
			
			$sql.=" and atm_id1 in ('$selatm')";
		}	

		$proj='-1';

		if(!in_array('-1',$_POST['project']))
		{
		
		$proj=implode(",",$_POST['project']);
		$pr=str_replace(",","','",$proj);
		$sql.=" and projectid in('$pr') ";
		}
if(isset($_POST['formCountries']) && !in_array('-1',$_POST['formCountries']))
		{
		
		$bk=implode(",",$_POST['formCountries']);
		$bnk=str_replace(",","','",$bk);
		$sql.=" and bank in('$bnk') ";
		}
		if($_POST['zone']!='' && $_POST['zone']!='-1')
		{
		$sql.=" and zone='".$_POST['zone']."'";
		}
		if($service=='caretaker')
		{
		$sql.=" and takeover_date<='".$end_date."' and (handover_date>='".$start_date."' or handover_date='0000-00-00' or handover_date='null') ";
		}
		else
		{
		$sql.=" and ".$service."_tkdt<='".$end_date."' and (".$service."_hodt>='".$start_date."' or ".$service."_hodt='0000-00-00' ) ";
		}
		$state=$_POST['state'];
		if($_POST['state']!='-1' && $_POST['state']!='')
		{
		$sql.=" and state in ('".$state."')";
		}
		$sql.=" order by bank,city_category,subcat,".$service."_rate ASC";
		//$sql.=" and takeover_date<'".$end_date."' order by bank ASC";
		
		if($service=='maintenance'){
		$sr=9;	
	$hkdtsr=58;$hkhosr=59;
}
		if($service=='caretaker')
		{
		$sr=7;
		$hkdtsr=28;$hkhosr=29;
		}
		if($service=='housekeeping'){$hkdtsr=56;$hkhosr=57;
		$sr=5;
		}
		
		
	echo $sql;
	//echo $hkdtsr." ".$hkhosr;
		$atm=array();
		$ndays='';
$tkdt=array();
$hddt=array();
$billamount='';
$siterate='';
$scat='';
$ssubcat=array();
		$brkcnt=0;
		$result = mysqli_query($con,$sql);
		//echo mysqli_num_rows($result);
$billfrm=array();
$billto=array();
//$siteadd=array();
$siteid=array();
$atmid2=array();
$atmautoid=array();
$sitezone=array();
$sitebank=array();
$siteproject=array();
$bnk2=array();
$bnkcnt=array();
 $sitecitycat[]=array();
	$numcat=array();							
		$citycatcnt=array();
 $citysubcat=array();		
		$subcatcnt=array();	
$catrate=array();
$siteamt=array();
		$naamount=0;
while($row = mysqli_fetch_row($result))
		{
$tkdt[]=$row[$hkdtsr];
$hddt[]=$row[$hkhosr];
$bnk2[]=strtolower($row[10]);
$atmautoid[]=$row[53];
 $atm[]=trim($row[16]);
//$siteadd[]=$row[25];
$siteid[]=$row[15];
$atmid2[]=$row[17];
$sitezone[]=$row[12];
$siteproject[]=strtolower($row[52]);


		if($i==1)
{

}
		else{
$brkcnt=$brkcnt+1;
		}
		?>
		
		 <tr height="8px" >
         <td><?php echo $i;
//echo $row[54];
 ?></td>
         <td><?php echo $row[52]; ?></td>
         <?php if($cid=='Prizm07'){ ?><td scope="col"><div align="left"><?php echo $row[0]; ?></div></td>
  <td scope="col"><div align="left"><?php echo $row[10]; ?> </div></td>
  <td scope="col"><div align="left"><?php echo $row[23]; ?></div></td> 
  <td scope="col"><div align="left"><?php echo $row[13]; ?> </div></td>
  <td scope="col"><div align="left"><?php echo $row[12]; ?> </div></td>
  <td scope="col"><div align="left"><?php echo $row[16]; ?></div></td>
  <td scope="col"><div align="left"><?php echo $row[15]; ?></div></td>
  <td scope="col"><div align="left"><?php echo $row[17]; ?></div></td>
  <td scope="col"><div align="left"><?php echo $row[24]; ?></div></td>
  <td><?php echo $row[27]; ?></td>
  
   <?php } 
    elseif($cid=='FIS03')
   {
   ?>
   <td scope="col"><div align="left"><?php echo $row[10]; ?></div></td>
   <td scope="col"><div align="left"><?php echo $row[12]; ?> </div></td>
   <td scope="col"><div align="left"><?php echo $row[16]; ?></div></td>
    <td scope="col"><div align="left"><?php echo $row[15]; ?></div></td>
    <td scope="col"><div align="left"><?php echo $row[17]; ?></div></td>
   <td scope="col"><div align="left"><?php echo $row[24]; ?></div></td>
   <td scope="col"><div align="left"><?php echo $row[25]; ?> </div></td>
     <td scope="col"><div align="left"><?php echo $row[23]; ?></div></td> 
  <td scope="col"><div align="left"><?php echo $row[13]; ?> </div></td>
  
   <?php
   }
  else{ ?>
         
         <td><?php echo $row[10]; ?></td>
         <td><?php echo $row[16]; ?></td>
          <td scope="col"><div align="left">&nbsp;<?php echo $row[15]; ?></div></td>
         <td><?php echo $row[17]; ?></td>
         <!--<td><?php //echo $row[17]; ?></td>-->
         <td><?php echo $row[25]; ?></td>
         <td><?php //echo $row[10]; ?></td>
         <td><?php echo $row[24]; ?></td>
         <td><?php //echo $row[10]; ?></td>
         <td><?php echo $row[23]; ?></td>
         <td><?php echo $row[13]; ?></td>
         <td><?php echo "India"; ?></td>
         <td><?php echo $row[12]; ?></td>
         
         <?php } ?>
		 <td><?php echo $row[27]; ?></td>
         <td align='center'>&nbsp;<?php  if($row[$hkdtsr]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[$hkdtsr])); }else{ echo "-";} ?></td>
         <td>&nbsp;<?php if($row[$hkdtsr]>$start_date){ $billfrm[]=$row[$hkdtsr];echo date('d/m/Y',strtotime($row[$hkdtsr]));}else{ $billfrm[]=$start_date;echo date('d/m/Y',strtotime($start_date));} ?></td>
         <td>&nbsp;<?php if($row[$hkhosr]!='0000-00-00' && $row[$hkhosr]<=$end_date){ $billto[]=$row[$hkhosr]; echo date('d/m/Y',strtotime($row[$hkhosr]));}else{ $billto[]=$end_date;echo date('d/m/Y',strtotime($end_date));  }  ?></td>
         <td>&nbsp;<?php if($row[$hkhosr]!='0000-00-00' && $row[$hkhosr]<=$end_date){ echo date('d/m/Y',strtotime($row[$hkhosr]));} ?></td>
        <td><?php
//echo $ndays."<br>";
	 if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
		   if($row[$hkhosr]=='0000-00-00'){
		  echo $dd;
		  if($i==1)
		  $ndays=$dd;
		  else
		  $ndays=$ndays.",".$dd;
		  }
		  else
		  {
		  $fr = strtotime($start_date, 0);
		  if(strtotime($row[$hkhosr],0)<strtotime($end_date,0))
                                            $t = strtotime($row[$hkhosr], 0);
                                            else
                                             $t = strtotime($end_date, 0);
                                            $difference = $t - $fr;
                                            $dd1 = intval($difference/(3600*24)+1);
                                 echo $dd1; 
                                  if($i==1)
		  $ndays=$dd1;
		  else
		  $ndays=$ndays.",".$dd1;        
		 // echo strtotime($row[$hkhosr])." ".
		  //echo strtotime($row[$hkhosr])-strtotime($start_date);
		  }
		  }
                                   else{   
                                    if($row[$hkhosr]=='0000-00-00'){
                                    $fr = strtotime($row[$hkdtsr], 0);
                                            $t = strtotime($end_date, 0);
                                            $difference = $t - $fr;
                                            $dd1 = intval($difference/(3600*24)+1);
                                           echo $dd1;
                                            if($i==1)
		  $ndays=$dd1;
		  else
		  $ndays=$ndays.",".$dd1;
		 
		  }
		  else
		  {
		  $fr = strtotime($row[$hkdtsr], 0);
		  if(strtotime($row[$hkhosr],0)<strtotime($end_date,0))
                                            $t = strtotime($row[$hkhosr], 0);
                                            else
                                             $t = strtotime($end_date, 0);
                                            
                                            $difference = $t - $fr;
                                            $dd1 = intval($difference/(3600*24)+1);
                                 echo $dd1; 
                                  if($i==1)
		  $ndays=$dd1;
		  else
		  $ndays=$ndays.",".$dd1;
                                    
                                       }	} 
									   
					 $var=0;
										  
										//echo "<br>";
									   $bank=strtoupper($row[10]);
									  // echo "<br>";
									   if($row[27]=='' || $row[27]=='-')
									   $city_category="NA";
									   else
									   $city_category=strtoupper($row[27]);
									   
									 //  echo "city category ".$city_category;
									 // echo "<br>";
									  
									  
									  if($row[55]=='')
                                        $sub='NA';
                                      else
                                        $sub=strtoupper($row[55]);
                                        
                                        
                                        $citycat[]=$city_category;
                                        $citysubcat[]=$sub;
										
										//echo "subcat=".$sub;
									   $bnkkey='';
									   $catkey='';
									   
									   if($city_category=='A'){
									   if(in_array($bank,$sitebanka))
									   {
									   
									    $bnkkey=array_search($bank, $sitebanka);
									  $numbnk=$bnkcnta[$bnkkey];
									   //echo "<br>";
									   $bnkcnta[$bnkkey]=$numbnk+1;
									   // echo "<br>";
										if(in_array($city_category,$sitecitycata))
										{
									$key=array_search($city_category, $sitecitycata);
									  $numba=$citycatcnta[$key];
									  $citycatcnta[$key]=$numba;
									  // echo "<br>";
									   if(in_array($sub,$citysubcata))
										{
									  $key=array_search($sub, $citysubcata);
									  $numba=$subcatcnta[$key]+1;
									 //  echo "<br>";
									  $subcatcnta[$key]=$numba;
									  if(in_array($row[$sr],$ratea))
									  {
									$key=array_search($row[$sr], $ratea);
									  // echo "<br>";
									 $numba=$ratecnta[$key]+1;
									 // echo "<br>";
									  $ratecnta[$key]=$numba;
									 $row[$hkdtsr]." ".$start_date."<br>if";
   if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
		 $var=0;
		// echo "hello";
  $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
       $aamount=$aamount+$var;	
	 //echo "<br>";
	 $cataamt[]=$var;
	 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
 $var= round(($dd1/$nod)*$row[$sr]);
        // $tot=$tot+$var;
		 //echo "Howdy";
         $aamount=$aamount+$var;	
	 //echo "<br>";
	 $cataamt[]=$var;
        
         }
									  
										}
									  }
									  else
									  {
									  //echo "<br>";
									   $ratea[]=$row[$sr];
									 // echo "<br>";
									 $ratecnta=1;
									    //echo $row[$hkdtsr]." ".$start_date."<br>else";
									     if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
		  $var=0;
		// echo "hello";
  $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
          $aamount=$aamount+$var;	
	 //echo "<br>";
	 $cataamt[]=$var;
 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
  $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
      $aamount=$aamount+$var;	
	// echo "<br>";
	 $cataamt[]=$var;
      
         }
									  
										}
									  }
									  }
									  else{
									  //echo "<br>";
									 $citysubcata[]=$sub;
									  //echo "<br>";
									   $subcatcnta[]=1;
									  }
										}
										else{
										//echo "<br>";
									   $sitecitycata[]=$city_category;
										//echo "<br>";
									 $citycatcnta[]=1;
										
										}
										}
										else{
										//echo "<br>";
									 $sitebanka[]=$bank;
										//echo "<br>";
									  $bnkcnta[]=1;
										//echo "<br>";
									   $sitecitycata[]=$city_category;
										//echo "<br>";
									   $citycatcnta[]=1;
										//echo "<br>";
									  $citysubcata[]=$sub;
									  //echo "<br>";
									   $subcatcnta[]=1;
									    $ratea[]=$row[$sr];
									 // echo "<br>";
									  $ratecnta=1;
									   if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
   $var=0;
		 //echo "hello";
  $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
         $aamount=$aamount+$var;	
	// echo "<br>";
	 $cataamt[]=$var;
 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
  $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
      $aamount=$aamount+$var;	
	 //echo "<br>";
	 $cataamt[]=$var;
         }
									  
										}
									   }
									   }
									   elseif($city_category=='B')
									   {
									   if(in_array($bank,$sitebankb))
									   {
									   
									    $bnkkey=array_search($bank, $sitebankb);
									  $numbnk=$bnkcntb[$bnkkey];
									   //echo "<br>";
									  $bnkcntb[$bnkkey]=$numbnk+1;
									//    echo "<br>";
										if(in_array($city_category,$sitecitycatb))
										{
										$key=array_search($city_category, $sitecitycatb);
									  $numbb=$citycatcntb[$key];
									  $citycatcntb[$key]=$numbb;
									   //echo "<br>";
									   if(in_array($sub,$citysubcatb))
										{
									  $key=array_search($sub, $citysubcatb);
									  $numbb=$subcatcntb[$key]+1;
									  // echo "<br>";
									$subcatcntb[$key]=$numbb;
									  if(in_array($row[$sr],$rateb))
									  {
									$key=array_search($row[$sr], $rateb);
									  // echo "<br>";
									  $numbb=$ratecntb[$key]+1;
									 // echo "<br>";
									   $ratecntb[$key]=$numbb;
									$row[$hkdtsr]." ".$start_date."<br>if";
   if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
		 $var=0;
		// echo "hello";
 $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
       $bamount=$bamount+$var;	
	// echo "<br>";
	 $catbamt[]=$var;
		 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
 $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
         $bamount=$bamount+$var;	
	// echo "<br>";
 $catbamt[]=$var;
         }
									  
										}
									  }
									  else
									  {
									 // echo "<br>";
									   $rateb[]=$row[$sr];
									 // echo "<br>";
									  $ratecntb=1;
									    $row[$hkdtsr]." ".$start_date."<br>else";
									     if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
  $var=0;
		// echo "hello";
 $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
        $bamount=$bamount+$var;	
	 //echo "<br>";
	 $catbamt[]=$var;
		 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
 $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
         $bamount=$bamount+$var;
 //echo "<br>";
	 $catbamt[]=$var;	 
         }
									  
										}
									  }
									  }
									  else{
									  //echo "<br>";
									 $citysubcatb[]=$sub;
									 // echo "<br>";
									  $subcatcntb[]=1;
									  }
										}
										else{
										//echo "<br>";
									 $sitecitycatb[]=$city_category;
										//echo "<br>";
									 $citycatcntb[]=1;
										
										}
										}
										else{
										//echo "<br>";
									  $sitebankb[]=$bank;
										//echo "<br>";
									  $bnkcntb[]=1;
										//echo "<br>";
									 $sitecitycatb[]=$city_category;
										//echo "<br>";
									   $citycatcntb[]=1;
									//	echo "<br>";
									  $citysubcatb[]=$sub;
									 // echo "<br>";
									 $subcatcntb[]=1;
									 $rateb[]=$row[$sr];
									  //echo "<br>";
									   $ratecntb=1;
									   if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
  $var=0;
		// echo "hello";
  $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
         $bamount=$bamount+$var;	
	// echo "<br>";
	 $catbamt[]=$var;
		 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
 $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
    $bamount=$bamount+$var;
 $catbamt[]=$var;	 
         }
									  
										}
									   }
									   }
									   elseif($city_category=='C')//c category
									   {
									   if(in_array($bank,$sitebankc))
									   {
									   
									   $bnkkey=array_search($bank, $sitebankc);
									  $numbnk=$bnkcntc[$bnkkey];
									   //echo "<br>";
									   $bnkcntc[$bnkkey]=$numbnk+1;
									    //echo "<br>";
										if(in_array($city_category,$sitecitycatc))
										{
										$key=array_search($city_category, $sitecitycatc);
									  $numbc=$citycatcntc[$key];
									  $citycatcntc[$key]=$numbc;
									  // echo "<br>";
									   if(in_array($sub,$citysubcatc))
										{
									   $key=array_search($sub, $citysubcatc);
									  $numbc=$subcatcntc[$key]+1;
									  // echo "<br>";
									 $subcatcntc[$key]=$numbc;
									  if(in_array($row[$sr],$ratec))
									  {
									  $key=array_search($row[$sr], $ratec);
									  // echo "<br>";
									   $numbc=$ratecntc[$key]+1;
									  //echo "<br>";
									   $ratecntc[$key]=$numbc;
									   $row[$hkdtsr]." ".$start_date."<br>if";
   if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
		 $var=0;
		 //echo "hello";
 $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
        $camount=$camount+$var;	
	// echo "<br>";
	 $catcamt[]=$var;
		 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
 $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
        $camount=$camount+$var;
$catcamt[]=$var;	 
         }
									  
										}
									  }
									  else
									  {
									 // echo "<br>";
									   $ratec[]=$row[$sr];
									 // echo "<br>";
									   $ratecntc=1;
									   // echo $row[$hkdtsr]." ".$start_date."<br>else";
									     if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
  $var=0;
		// echo "hello";
  $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
        $camount=$camount+$var;	
	// echo "<br>";
	 $catcamt[]=$var;
		 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
 $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
       $camount=$camount+$var;
$catcamt[]=$var;
         }
									  
										}
									  }
									  }
									  else{
									 // echo "<br>";
									   $citysubcatc[]=$sub;
									  //echo "<br>";
									  $subcatcntc[]=1;
									  }
										}
										else{
										//echo "<br>";
									  $sitecitycatc[]=$city_category;
										//echo "<br>";
									   $citycatcntc[]=1;
										
										}
										}
										else{
										//echo "<br>";
									  $sitebankc[]=$bank;
										//echo "<br>";
									 $bnkcntc[]=1;
										//echo "<br>";
									   $sitecitycatc[]=$city_category;
										//echo "<br>";
									   $citycatcntc[]=1;
										//echo "<br>";
									  $citysubcatc[]=$sub;
									  //echo "<br>";
									   $subcatcntc[]=1;
									    $ratec[]=$row[$sr];
									//  echo "<br>";
									   $ratecntc=1;
									   if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
  $var=0;
		// echo "hello";
 $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
          $camount=$camount+$var;	
	// echo "<br>";
	 $catcamt[]=$var;
		 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
 $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
        $camount=$camount+$var;
$catcamt[]=$var;
         }
									  
										}
									   }
									   }
									   elseif($city_category=='NA')//Na Category
									   {
									   if(in_array($bank,$sitebankna))
									   {
									   
									   $bnkkey=array_search($bank, $sitebankna);
									  $numbnk=$bnkcntna[$bnkkey];
									   //echo "<br>";
									 $bnkcntna[$bnkkey]=$numbnk+1;
									   // echo "<br>";
										if(in_array($city_category,$sitecitycatna))
										{
										$key=array_search($city_category, $sitecitycatna);
									  $numbna=$citycatcntna[$key];
									  $citycatcntna[$key]=$numbna;
									   //echo "<br>";
									   if(in_array($sub,$citysubcatna))
										{
									  $key=array_search($sub, $citysubcatna);
									  $numbna=$subcatcntna[$key]+1;
									  // echo "<br>";
									   $subcatcntna[$key]=$numbna;
									  if(in_array($row[$sr],$ratena))
									  {
									  $key=array_search($row[$sr], $ratena);
									  // echo "<br>";
									  $numbna=$ratecntna[$key]+1;
									  //echo "<br>";
									  $ratecntna[$key]=$numbna;
									  // $row[$hkdtsr]." ".$start_date."<br>if";
   if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
		  $var=0;
		// echo "hello";
 $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
        $naamount=$naamount+$var;	
	// echo "<br>";
	 $catnaamt[]=$var;
		 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
 $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
       $naamount=$naamount+$var;
$catnaamt[]=$var; 
         }
									  
										}
									  }
									  else
									  {
									 // echo "<br>";
									  $ratena[]=$row[$sr];
									 // echo "<br>";
									   $ratecntna=1;
									   // echo $row[$hkdtsr]." ".$start_date."<br>else";
									     if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
  $var=0;
	//	 echo "hello";
  $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
         $naamount=$naamount+$var;	
	// echo "<br>";
	 $catnaamt[]=$var;
		 
         }
	 else
	 {
	  $var=0;
	//	 echo "hello";
 $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
         $naamount=$naamount+$var;
$catnaamt[]=$var;  
         }
									  
										}
									  }
									  }
									  else{
									 // echo "<br>";
									  $citysubcatna[]=$sub;
									 // echo "<br>";
									 $subcatcntna[]=1;
									  }
										}
										else{
										//echo "<br>";
									 $sitecitycatna[]=$city_category;
										//echo "<br>";
									  $citycatcntna[]=1;
										
										}
										}
										else{
										//echo "<br>";
									  $sitebankna[]=$bank;
										//echo "<br>";
									 $bnkcntna[]=1;
										//echo "<br>";
									  $sitecitycatna[]=$city_category;
										//echo "<br>";
									  $citycatcntna[]=1;
										//echo "<br>";
									  $citysubcatna[]=$sub;
									  //echo "<br>";
									   $subcatcntna[]=1;
									   $ratena[]=$row[$sr];
									  //echo "<br>";
									   $ratecntna=1;
									   if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
  $var=0;
		// echo "hello";
 $var= round(($dd/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
        $naamount=$naamount+$var;	
	// echo "<br>";
	 $catnaamt[]=$var;
		 
         }
	 else
	 {
	  $var=0;
		// echo "hello";
  $var= round(($dd1/$nod)*$row[$sr]);
         //$tot=$tot+$var;
		 //echo "Howdy";
      $naamount=$naamount+$var;
$catnaamt[]=$var;  
         }
									  
										}
									   }
									   			   
									   }
									   
									   
									  
									   
				       ?></td>
         <td>&nbsp;<?php echo $row[$sr]; if($i==1){ $siterate=$row[$sr]; }else{  $siterate=$siterate.",".$row[$sr]; } ?></td>
         <td><?php 
		 $var='0.00';
		 if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
         if($row[$hkhosr]=='0000-00-00')
         {
//echo "hello";

         echo $var= round(($dd/$nod)*$row[$sr]);
        
          $tot=$tot+round((($dd/$nod)*$row[$sr]));
          if($row[27]=="A")$aa=$aa+round(($dd/$nod)*$row[$sr]);
                                       else if($row[27]=="B")$ab=$ab+round(($dd/$nod)*$row[$sr]);
                                       else if($row[27]=="C")$ac=round($ac+($dd/$nod)*$row[$sr]);    
                                       else $an=$an+round(($dd/$nod)*$row[$sr]); 
         }
	 else
	 {
//echo "hi";
         echo $var= round(($dd1/$nod)*$row[$sr]);
       
         $tot=$tot+round((($dd1/$nod)*$row[$sr]));
          if($row[27]=="A")$aa=$aa+($dd1/$nod)*$row[$sr];
                                       else if($row[27]=="B")$ab=$ab+round(($dd1/$nod)*$row[$sr]);
                                       else if($row[27]=="C")$ac=$ac+round(($dd1/$nod)*$row[$sr]);    
                                       else $an=$an+round(($dd1/$nod)*$row[$sr]); 
         }
         
		 //$tot=$tot+(($var/$nod)*$row[$sr]);
                                     
                                       }
                                   else{ //echo "here".$dd1."<br> ".$nod."<br> ".$row[$sr]."<br>";
                                         echo $var= round(($dd1/$nod)*$row[$sr]);
                                        
					 $tot=$tot+round(($dd1/$nod)*$row[$sr]);
                                       if($row[27]=="A")$aa=$aa+round(($dd1/$nod)*$row[$sr]);
                                       else if($row[27]=="B")$ab=$ab+round(($dd1/$nod)*$row[$sr]);
                                       else if($row[27]=="C")$ac=$ac+round(($dd1/$nod)*$row[$sr]);
                                       else $an=$an+round(($dd1/$nod)*$row[$sr]); 
                                        
                                       
                                       }
                                        $siteamt[]=$var;
                                     if($i==1)  
                          $billamount=$var;
						  else
						  $billamount=$billamount.",".$var;  
						  
						 // echo "<br>".$billamount;  
                                       
                             ?></td>
      <!-- <?php if($cid=='Diebold'){ ?>  <td>&nbsp;</td><?php } ?>-->
         
       
		</tr>
		<?php
		/*if($brkcnt%25==0){
		?>
		<tr height="1px"><td align="center" valign="middle" colspan="22">
<div style="page-break-after:always" style="width:1px"></div></td></tr>
		<?php
		}*/
		
		$i=$i+1;;
		}
?>
<tr><td colspan="<?php if($cid=='FIS03'){ echo "18";}else{ echo "21"; } ?>" align="center"><b>Total Billing Amount</b><?php //echo round($tot,2); ?></td><td align="right"><?php echo number_format($tot, 2); ?></td></tr>
</tbody></table></div><center>
<?php
//echo $ca." ".$cb." ".$cc." ".$cn;
$totalsites=$i;
if($cid=='Tata05')
$po=$_POST['pono'];
else
$po='';


//echo count($bnk2)." ".count($citycat)." ".count($citysubcat)." ".count($siteproject);
  "sitezone=".$sitezone=implode();
  "<br>";
  "poject=".$siteproject=implode(',',$siteproject);
  "<br>";
  "bank=".$bnk2=implode(',',$bnk2);
  "<br>";
  "citycat=".$citycat=implode(',',$citycat);
  "<br>";
  "citysubcat=".$citysubcat=implode(',',$citysubcat);
  "<br>";
  "cat a=".$cataamt=implode(',',$cataamt);
  "<br>";

  "cat b=".$catbamt=implode(',',$catbamt);
  "<br>";
  "cat c=".$catcamt=implode(',',$catcamt);
  "<br>";
  "cat na=".$catnaamt=implode(',',$catnaamt);
  "<br>";
  //$siterate;
  
  $siteamt=implode(',',$siteamt);
  "<br>";
$tkdt=implode(',',$tkdt);
$hddt=implode(',',$hddt);
$atmautoid=implode(',',$atmautoid);
//print_r($atm);
  $atm2=implode(',',$atm);
 $atmid2=implode(',',$atmid2);
$siteid=implode(',',$siteid);
   "<br>";
   $billfrm=implode(',',$billfrm);
   "<br>";
   $billto=implode(',',$billto);
 print_r($scat);
//echo $atm2;
 /* $comp=$_POST['comp'];
$zone='';
if(isset($_POST['zone']))
$zone=$_POST['zone'];*/
?>

<script type="text/javascript">

bill('newcaretakerbill.php?cid=<?php echo $cid; ?>&bank=<?php echo $bk; ?>&mon=<?php echo $mon; ?>&serv=<?php echo $service; ?>&ca=<?php echo $ca; ?>&cb=<?php echo $cb; ?>&cc=<?php echo $cc; ?>&cn=<?php echo $cn; ?>&aa=<?php echo $aa; ?>&ab=<?php echo $ab; ?>&ac=<?php echo $ac; ?>&an=<?php echo $an; ?>&id=<?php echo $id; ?>&year=<?php echo $date_parts2[2]; ?>&stdt=<?php echo $start_date; ?>&todt=<?php echo $end_date;  ?>&comp=<?php echo $_POST['comp']; ?>&city=<?php echo $cty; ?>&po=<?php echo $po; ?>&subcatna=<?php echo $subcat2; ?>&nacnt=<?php echo $nacnt2; ?>&naamt=<?php echo $naamt2; ?>&nacom=<?php echo $nacom2; ?>&subcata=<?php echo $subcat2a; ?>&acnt=<?php echo $acnt2; ?>&aamt=<?php echo $aamt2; ?>&acom=<?php echo $acom2; ?>&subcatb=<?php echo $subcat2b; ?>&bcnt=<?php echo $bcnt2; ?>&bamt=<?php echo $bamt2; ?>&bcom=<?php echo $bcom2; ?>&subcatc=<?php echo $subcat2c; ?>&ccnt=<?php echo $ccnt2; ?>&camt=<?php echo $camt2; ?>&ccom=<?php echo $ccom2; ?>&prjct=<?php echo $proj; ?>&tot=<?php echo $totalsites; ?>&zone=<?php echo $_POST['zone']; ?>&tkdt=<?php echo $tkdt; ?>&hddt=<?php echo $hddt; ?>&numofd=<?php echo $ndays; ?>&billamt=<?php echo $billamount; ?>&siterate=<?php echo $siterate; ?>&citycategory=<?php echo $citycat; ?>&subcitycat=<?php echo $citysubcat; ?>&sitebank=<?php echo $bnk2; ?>&siteproject=<?php echo $siteproject; ?>&sitezone=<?php echo $sitezone; ?>&tkdt=<?php echo $tkdt; ?>&hddt=<?php  echo $hddt; ?>&autoid=<?php echo $atmautoid; ?>&billfrm=<?php echo $billfrm; ?>&billto=<?php echo $billto; ?>&atmid2=<?php echo $atmid2; ?>&siteid=<?php  echo $siteid; ?>&state=<?php echo $state; ?>&atm=<?php echo $atm2; ?>','bill');
</script>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onClick="PrintDiv('annexure');" href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Annexure</font></a>&nbsp;&nbsp;<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button></center>

<div id="bill">

</div>


<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>
</body>
</html>