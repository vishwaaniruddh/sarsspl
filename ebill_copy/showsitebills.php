<?php ini_set( "display_errors", 0);

include("access.php");


// header('Location:managesite1.php?id='.$id); 
 


//echo "comp=".$_POST['comp'];
if(!isset($_POST['comp']) || $_POST['comp']=='-1')
{

?>

<script type="text/javascript">
alert("All fields are compulsory");
window.location.href='sitebills.php?id=<?php echo $_POST['id']; ?>';
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
function save(comp,cid,bank,frmdt,todt,service,amt,atm,city,tkdt,hddt,numofd,billamt,siterate,citycategory,subcitycat)
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
 var url="insertinv.php";
  //alert("insertinv.php?comp="+comp+"&cid="+cid+"&frmdt="+frmdt+"&todt="+todt+"&serv="+service+"&amt="+amt+"&bank="+bank+"&atm="+atm+"&city="+city);
  //alert("getcustbank.php?val="+val);
//xmlhttp.open("GET","insertinv.php?comp="+comp+"&cid="+cid+"&frmdt="+frmdt+"&todt="+todt+"&serv="+service+"&amt="+amt+"&bank="+bank+"&atm="+atm+"&city="+city,true);
//xmlhttp.send();
var dat="comp="+comp+"&cid="+cid+"&frmdt="+frmdt+"&todt="+todt+"&serv="+service+"&amt="+amt+"&bank="+bank+"&atm="+atm+"&city="+city+'&tkdt='+tkdt+'&hddt='+hddt+"&nod="+numofd+"&billamt="+billamt+"&siterate="+siterate+"&citycat="+citycategory+"&subcat="+subcitycat;
//alert(dat);
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(dat);
}
function bill(val,id)
{
	//alert(val);

//var val;
//val=val+"&comp="+comp;
//alert(num);
//	document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
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
    $bk = $_POST['bank'];
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
<!--<p align="center" >Customer ID &nbsp;<?php echo $cid; ?> <br> Bank &nbsp; <?php if($bk==-1) echo "All" ; else echo $bk; ?>
  <br> Bill From <?php echo $from; ?> To <?php echo $to; ?></p>-->
  <p align="center" height="8px"><?php if($bk==-1) echo "All" ; else echo $bk; ?><?php echo " ".ucfirst($service) ; ?> billing data for the month of <?php echo date("M y",strtotime($start_date)); ?></center>
 
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
  <th scope="col"><div align="center"> Category</div></th>
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
  <th scope="col"><div align="center"> Category</div></th> 
  <?php } ?>
  <th scope="col"><div align="center">TakeOver Date </div></th> 
  <th scope="col"><div align="center"><?php if($cid=='FIS03'){ echo "Bills Period<hr>"; } ?>From </div></th> 
  <th scope="col"><div align="center"><?php if($cid=='FIS03'){ echo "Bills Period<hr>"; } ?>To</div></th> 
  <th scope="col"><div align="center">Handover Date </div></th> 
  <th scope="col"><div align="center">Days </div></th> 
  <th scope="col"><div align="center">Rate </div></th> 
  <th scope="col"><div align="center">Billing Amount </div></th>
  <?php if($cid=='DIE002'){ ?> 
  <!--<th scope="col"><div align="center">DSPL Remarks </div></th>--> <?php } ?>
  
    <!--<th scope="col"><div align="center">Customer Id </div></th>   
    <th scope="col"><div align="center">Customer Name</div></th> 
    <th scope="col"><div align="center">A/C Manager name</div></th>
    <th scope="col"><div align="center">A/C Manager contact no.</div></th>   
	<th scope="col"><div align="center">Site Old MDN No</div></th>
	<th scope="col"><div align="center">Site New MDN No</div></th>
	<th scope="col"><div align="center">MDN RSN No</div></th>
	<th scope="col"><div align="center">Take Over Date</div></th>
	<th scope="col"><div align="center">Handover Date</div></th>
	<th scope="col"><div align="center">Site Id</div></th>
	<th scope="col"><div align="center">I ATM ID</div></th>
	<th scope="col"><div align="center">II ATM ID</div></th>
	<th scope="col"><div align="center">III ATM ID</div></th>
	<th scope="col"><div align="center">DUMMY ATM ID</div></th>
	<th scope="col"><div align="center">Location</div></th>
	<th scope="col" width="50px"><div align="center">Address:</div></th>
	<th scope="col"><div align="center">Site type</div></th>
	<th scope="col"><div align="center">CSS Branch</div></th>
	<th scope="col"><div align="center">Region</div></th>
    <th scope="col"><div align="center">Zone</div></th>
    <th scope="col"><div align="center">State </div></th>
	<th scope="col"><div align="center">City Category</div></th>
	<th scope="col"><div align="center">City </div></th>
    <th scope="col"><div align="center">Rate</div></th>
    <th scope="col"><div align="center">Total Days</div></th>
    <th scope="col"><div align="center">Amount</div></th>-->
  </tr></thead><tbody>
  <?php
$brkcnt=0;
   
	//echo "".$cid."-".$bk;
	        $i = 1;
	       if($bk==-1 && $cty==-1) {
	      	$sql = "SELECT * FROM ".$custname."_sites where active='Y' and $service='Y'";
			
			if($_POST['project']!='' && $_POST['project']!='-1')
			$sql.=" and projectid='".$_POST['project']."'";
			if($cid=='Tata05')
			{
			if($_POST['pono']!='' && $_POST['pono']!='-1')
			$sql.=" and atm_id1 in (select atm_id1 from tatapo where po='".$_POST['pono']."')";
			}
	      /*	echo "1";  and (handover_date>'$start_date' or handover_date='0000-00-00')*/
	      	}
	       else if($bk==-1)		 {
	      // echo "2";
                $sql = "SELECT * FROM ".$custname."_sites where  active='Y' and city='$cty' and $service='Y' ";
				if($_POST['project']!='' && $_POST['project']!='-1')
			$sql.=" and projectid='".$_POST['project']."'";
			if($cid=='Tata05')
			{
			if($_POST['pono']!='' && $_POST['pono']!='-1')
			$sql.=" and atm_id1 in (select atm_id1 from tatapo where po='".$_POST['pono']."')";
			}
				 }
               else if($cty==-1) {
                $sql = "SELECT * FROM ".$custname."_sites where active='Y' and bank='$bk' and $service='Y' "; 
				
				if($_POST['project']!='' && $_POST['project']!='-1')
			$sql.=" and projectid='".$_POST['project']."'";
			if($cid=='Tata05')
			{
			if($_POST['pono']!='' && $_POST['pono']!='-1')
			$sql.=" and atm_id1 in (select atm_id1 from tatapo where po='".$_POST['pono']."')";
			}
              //  echo "3";
              }
               else {
		$sql = "SELECT * FROM ".$custname."_sites where active='Y' and bank='$bk' and city='$cty' and $service='Y' ";
		
		if($_POST['project']!='' && $_POST['project']!='-1')
			$sql.=" and projectid='".$_POST['project']."'";
			if($cid=='Tata05')
			{
			if($_POST['pono']!='' && $_POST['pono']!='-1')
			$sql.=" and atm_id1 in (select atm_id1 from tatapo where po='".$_POST['pono']."')";
			}
			
			//$sql.=" takeover_date<='".."'";
		//echo "4";
		}
		if($_POST['zone']!='')
		{
		$sql.=" and zone='".$_POST['zone']."'";
		}
		if($service=='caretaker')
		{
		$sql.=" and takeover_date<='".$end_date."' and (handover_date>='".$start_date."' or handover_date='0000-00-00' or handover_date='null') order by city_category ASC";
		}
		else
		{
		$sql.=" and ".$service."_tkdt<='".$end_date."' and (".$service."_hodt>='".$start_date."' or ".$service."_hodt='0000-00-00' ) order by city_category ASC";
		}
		//$sql.=" and takeover_date<'".$end_date."' order by city_category ASC";
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
		//echo $sr;
		
	//echo $sql;
	//echo $hkdtsr." ".$hkhosr;
		$atm='';
		$ndays='';
$tkdt='';
$hddt='';
$billamount='';
$siterate='';
$scat='';
$ssubcat='';
		$brkcnt=0;
		$result = mysqli_query($con,$sql);
		//echo mysqli_num_rows($result);
		while($row = mysqli_fetch_row($result))
		{	
		if($i==1)
{
		$atm=$row[53];

$tkdt=$row[$hkdtsr];
$hddt=$row[$hkhosr];


$scat=$row[27];


}
		else{
		$atm=$atm.",".$row[53];
$tkdt=$tkdt.",".$row[$hkdtsr];
$hddt=$hddt.",".$row[$hkhosr];

$scat=$scat.",".$row[27];

		$brkcnt=$brkcnt+1;
		}
		?>
		
		 <tr height="8px" >
         <td><?php echo $i;
//echo $row[54];
 ?></td>
         <td><?php echo $row[52]; ?></td>
         <?php if($cid=='Prizm07'){ ?><td scope="col"><div align="center">&nbsp;<?php echo $row[0]; ?></div></td>
  <td scope="col"><div align="center">&nbsp;<?php echo $row[10]; ?> </div></td>
  <td scope="col"><div align="center">&nbsp;<?php echo $row[23]; ?></div></td> 
  <td scope="col"><div align="center">&nbsp;<?php echo $row[13]; ?> </div></td>
  <td scope="col"><div align="center">&nbsp;<?php echo $row[12]; ?> </div></td>
  <td scope="col"><div align="center">&nbsp;<?php echo $row[16]; ?></div></td>
  <td scope="col"><div align="center">&nbsp;<?php echo $row[15]; ?></div></td>
  <td scope="col"><div align="center">&nbsp;<?php echo $row[17]; ?></div></td>
  <td scope="col"><div align="center">&nbsp;<?php echo $row[24]; ?></div></td>
  <td><?php echo $row[27]; ?></td>
  
   <?php } 
    elseif($cid=='FIS03')
   {
   ?>
   <td scope="col"><div align="center">&nbsp;<?php echo $row[10]; ?></div></td>
   <td scope="col"><div align="center">&nbsp;<?php echo $row[12]; ?> </div></td>
   <td scope="col"><div align="center">&nbsp;<?php echo $row[16]; ?></div></td>
    <td scope="col"><div align="center">&nbsp;<?php echo $row[15]; ?></div></td>
    <td scope="col"><div align="center">&nbsp;<?php echo $row[17]; ?></div></td>
   <td scope="col"><div align="center">&nbsp;<?php echo $row[24]; ?></div></td>
   <td scope="col"><div align="center">&nbsp;<?php echo $row[25]; ?> </div></td>
     <td scope="col"><div align="center">&nbsp;<?php echo $row[23]; ?></div></td> 
  <td scope="col"><div align="center">&nbsp;<?php echo $row[13]; ?> </div></td>
  <td>&nbsp;<?php echo $row[27]; ?></td>
   <?php
   }
  else{ ?>
         
         <td>&nbsp;<?php echo $row[10]; ?></td>
         <td>&nbsp;<?php echo $row[16]; ?></td>
          <td scope="col"><div align="center">&nbsp;<?php echo $row[15]; ?></div></td>
         <td>&nbsp;<?php echo $row[17]; ?></td>
         <!--<td><?php //echo $row[17]; ?></td>-->
         <td>&nbsp;<?php echo $row[25]; ?></td>
         <td>&nbsp;<?php //echo $row[10]; ?></td>
         <td>&nbsp;<?php echo $row[24]; ?></td>
         <td>&nbsp;<?php //echo $row[10]; ?></td>
         <td>&nbsp;<?php echo $row[23]; ?></td>
         <td>&nbsp;<?php echo $row[13]; ?></td>
         <td>&nbsp;<?php echo "India"; ?></td>
         <td>&nbsp;<?php echo $row[12]; ?></td>
         <td>&nbsp;<?php echo $row[27]; ?></td>
         <?php } ?>
         <td align='center'>&nbsp;<?php  if($row[$hkdtsr]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[$hkdtsr])); }else{ echo "-";} ?></td>
         <td>&nbsp;<?php if($row[$hkdtsr]>$start_date){ echo date('d/m/Y',strtotime($row[$hkdtsr]));}else{ echo date('d/m/Y',strtotime($start_date));} ?></td>
         <td>&nbsp;<?php if($row[$hkhosr]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[$hkhosr]));}else{ echo date('d/m/Y',strtotime($end_date));  }  ?></td>
         <td>&nbsp;<?php if($row[$hkhosr]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[$hkhosr]));} ?></td>
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
                                            $t = strtotime($row[$hkhosr], 0);
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
                                   else{    $fr = strtotime($row[$hkdtsr], 0);
                                            $t = strtotime($end_date, 0);
                                            $difference = $t - $fr;
                                            $dd1 = intval($difference/(3600*24)+1);
                                           echo $dd1;
                                            if($i==1)
		  $ndays=$dd1;
		  else
		  $ndays=$ndays.",".$dd1;
                                       }	 
		
      if($row[55]=='')
                                {
                                $sub='NA';
                                }
                                else
                                $sub=$row[55];
//echo $sub;
 if($i==1)
{

$ssubcat=$sub;
} 
else
{
$ssubcat=$ssubcat.",".$sub;
}
   
                              // echo $sub;
		 if($row[27]=="A" || $row[27]=='a'){$ca++; $ra=$row[$sr];
		 $numaa=0;
                      $counta=0;
                                if(in_array($sub,$acnt))
                                       {
                                   $key=array_search($sub, $acnt);
                                $numaa=$caaa[$key];
                                $caaa[$key]=$numaa+1;
                                    $net=0;
                                    if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
                                    if($row[$hkhosr]=='0000-00-00')
         {
  $aamt[$key]=(($aamt[$key])+round(($dd/$nod)*$row[$sr]));
         }
         else{
   $aamt[$key]=(($aamt[$key])+round(($dd1/$nod)*$row[$sr]));
         }
                                    }
                                    else
                                    {
     $aamt[$key]=(($aamt[$key])+round(($dd1/$nod)*$row[$sr]));
                                    } 
                                   // echo "<br>";
                                      
                                    //echo "<br>";
                                       }
                                       else
                                       {
                                   $acnt[]=$sub;
                                      $key=array_search($sub, $acnt);
                                          
                                          $caaa[$key]=0;
                                    $numaa=$caaa[$key];
                                $caaa[$key]=$numaa+1;
                                  $acom[$key]=$row[$sr];
                                  if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
                                    if($row[$hkhosr]=='0000-00-00')
         {
       $aamt[$key]=(($aamt[$key])+round(($dd/$nod)*$row[$sr]));
         }
         else{
        $aamt[$key]=(($aamt[$key])+round(($dd1/$nod)*$row[$sr]));
         }
                                    }
                                    else
                                    {
        $aamt[$key]=(($aamt[$key])+round(($dd1/$nod)*$row[$sr]));
                                    }
                                       }  
                               
                                }
                            else if($row[27]=="B" || $row[27]=='b'){  $cb++; $rb=$row[$sr];
                            //B Category Subtype
                             $numbb=0;
                              
                               // echo " subcat= ".$row[55]."****<br>";
                                
  // echo $sub;
       $countb=0;
                                if(in_array($sub,$bcnt))
                                       {
                                   $key=array_search($sub, $bcnt);
                                $numbb=$cbbb[$key];
                                $cbbb[$key]=$numbb+1;
                                    $net=0;
                                    if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
                                    if($row[$hkhosr]=='0000-00-00')
         {
  $bamt[$key]=(($bamt[$key])+round(($dd/$nod)*$row[$sr]));
         }
         else{
   $bamt[$key]=(($bamt[$key])+round(($dd1/$nod)*$row[$sr]));
         }
                                    }
                                    else
                                    {
     $bamt[$key]=(($bamt[$key])+round(($dd1/$nod)*$row[$sr]));
                                    } 
                                    }
                                       else
                                       {
                                   $bcnt[]=$sub;
                                      $key=array_search($sub, $bcnt);
                                          
                                          $cbbb[$key]=0;
                                    $numbb=$cbbb[$key];
                                $cbbb[$key]=$numbb+1;
                                  $bcom[$key]=$row[$sr];
                                  if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
                                    if($row[$hkhosr]=='0000-00-00')
         {
       $bamt[$key]=(($bamt[$key])+round(($dd/$nod)*$row[$sr]));
         }
         else{
        $bamt[$key]=(($bamt[$key])+round(($dd1/$nod)*$row[$sr]));
         }
                                    }
                                    else
                                    {
        $bamt[$key]=(($bamt[$key])+round(($dd1/$nod)*$row[$sr]));
                                    }
                                       } 
                             }
                               else if($row[27]=="C" || $row[27]=='c'){$cc++; $rc=$row[$sr];
                                  //C Category Subtype
                             $numcc=0;
                              
                               // echo " subcat= ".$row[55]."****<br>";
                                
   //echo $sub;
       $countc=0;
                                if(in_array($sub,$ccnt))
                                       {
                                   $key=array_search($sub, $ccnt);
                                $numcc=$cccc[$key];
                                $cccc[$key]=$numcc+1;
                                    $net=0;
                                    if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
                                    if($row[$hkhosr]=='0000-00-00')
         {
  $camt[$key]=(($camt[$key])+round(($dd/$nod)*$row[$sr]));
         }
         else{
   $camt[$key]=(($camt[$key])+round(($dd1/$nod)*$row[$sr]));
         }
                                    }
                                    else
                                    {
     $camt[$key]=(($camt[$key])+round(($dd1/$nod)*$row[$sr]));
                                    } 
                                    }
                                       else
                                       {
                                   $ccnt[]=$sub;
                                      $key=array_search($sub, $ccnt);
                                          
                                         $cccc[$key]=0;
                                    $numcc=$cccc[$key];
                                $cccc[$key]=$numcc+1;
                                  $ccom[$key]=$row[$sr];
                                  if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
                                    if($row[$hkhosr]=='0000-00-00')
         {
       $camt[$key]=(($camt[$key])+round(($dd/$nod)*$row[$sr]));
         }
         else{
        $camt[$key]=(($camt[$key])+round(($dd1/$nod)*$row[$sr]));
         }
                                    }
                                    else
                                    {
        $camt[$key]=(($camt[$key])+round(($dd1/$nod)*$row[$sr]));
                                    }
                                       } 
                               
                               
                               
                                }
                               else {$cn++; $rn=$row[$sr];
                       //Subcategory of NA type       
                                $numna=0;
                                $nat=0;
                              //  echo " subcat= ".$row[55]."****<br>";
                                /*if($row[55]=='')
                                {
                                $sub='NAqqqqq';
                                }
                                else
                                $sub=$row[55];*/
//echo $sub." <br>";
       $countna=0;
                                if(in_array($sub,$nacnt))
                                       {
                                 // echo "****".    $key=array_search($row[55], $nacnt);
                                      $key=array_search($sub, $nacnt);
                               // echo " **** ";
                                   $numna=$cnaa[$key];
                                  // echo "to amt=".$nattt[$key];
                              // echo "<br>";
                                   $cnaa[$key]=$numna+1;
                                    $net=0;
                                    if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
                                    if($row[$hkhosr]=='0000-00-00')
         {
     $naamt[$key]=(($naamt[$key])+round(($dd/$nod)*$row[$sr]));
         }
         else{
      $naamt[$key]=(($naamt[$key])+round(($dd1/$nod)*$row[$sr]));
         }
                                    }
                                    else
                                    {
               $naamt[$key]=(($naamt[$key])+round(($dd1/$nod)*$row[$sr]));
                                    } 
                                    }
                                       else
                                       {
                                  $nacnt[]=$sub;
                                     $key=array_search($sub, $nacnt);
                                         $cnaa[$key]=0;
                                    $numna=$cnaa[$key];
                                $cnaa[$key]=$numna+1;
                                     
                                $nacom[$key]=$row[$sr];
                                  if(strtotime($row[$hkdtsr],0)<strtotime($start_date,0)){
                                    if($row[$hkhosr]=='0000-00-00')
         {
      $naamt[$key]=(($naamt[$key])+round(($dd/$nod)*$row[$sr]));
         }
         else{
      $naamt[$key]=(($naamt[$key])+round(($dd1/$nod)*$row[$sr]));
         }
                                    }
                                    else
                                    {
       $naamt[$key]=(($naamt[$key])+round(($dd1/$nod)*$row[$sr]));
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
         echo $var= number_format(round(($dd/$nod)*$row[$sr]), 2, '.', '');
          $tot=$tot+round((($dd/$nod)*$row[$sr]));
          if($row[27]=="A")$aa=$aa+round(($dd/$nod)*$row[$sr]);
                                       else if($row[27]=="B")$ab=$ab+round(($dd/$nod)*$row[$sr]);
                                       else if($row[27]=="C")$ac=round($ac+($dd/$nod)*$row[$sr]);    
                                       else $an=$an+round(($dd/$nod)*$row[$sr]); 
         }
	 else
	 {
//echo "hi";
         echo $var= number_format(round(($dd1/$nod)*$row[$sr]), 2, '.', '');
         $tot=$tot+round((($dd1/$nod)*$row[$sr]));
          if($row[27]=="A")$aa=$aa+($dd1/$nod)*$row[$sr];
                                       else if($row[27]=="B")$ab=$ab+round(($dd1/$nod)*$row[$sr]);
                                       else if($row[27]=="C")$ac=$ac+round(($dd1/$nod)*$row[$sr]);    
                                       else $an=$an+round(($dd1/$nod)*$row[$sr]); 
         }
         
		 //$tot=$tot+(($var/$nod)*$row[$sr]);
                                     
                                       }
                                   else{ //echo "here".$dd1."<br> ".$nod."<br> ".$row[$sr]."<br>";
                                         echo $var= number_format(round(($dd1/$nod)*$row[$sr]), 2, '.', '');
					 $tot=$tot+round(($dd1/$nod)*$row[$sr]);
                                       if($row[27]=="A")$aa=$aa+round(($dd1/$nod)*$row[$sr]);
                                       else if($row[27]=="B")$ab=$ab+round(($dd1/$nod)*$row[$sr]);
                                       else if($row[27]=="C")$ac=$ac+round(($dd1/$nod)*$row[$sr]);
                                       else $an=$an+round(($dd1/$nod)*$row[$sr]); 
                                        
                                       
                                       }
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
<tr><td colspan="<?php if($cid=='FIS03'){ echo "18";}else{ echo "21"; } ?>" align="center"><b>Total Billing Amount</b><?php //echo round($tot,2); ?></td><td align="right"><?php echo number_format(round($tot), 2, '.', ''); ?></td></tr>
</tbody></table></div><center>
<?php
//echo $ca." ".$cb." ".$cc." ".$cn;
$totalsites=$i;
if($cid=='Tata05')
$po=$_POST['pono'];
else
$po='';

$subcat2c='';
$ccnt2='';
$camt2='';
$ccom2='';
$cccc2='';
//echo "<br>";
for($i=0;$i<count($cccc);$i++)
{

if($i==0)
{
$cccc2=$cccc[$i];
$subcat2c=$cccc[$i];
$ccnt2=$ccnt[$i];
 $camt2=$camt[$i];
 $ccom2=$ccom[$i];
//echo "<br>";
}
else
{
 $cccc2=$cccc2.",".$cccc[$i];

$subcat2c=$subcat2c.",".$cccc[$i];
$ccnt2=$ccnt2.",".$ccnt[$i];
 $camt2=$camt2.",".$camt[$i];
 $ccom2=$ccom2.",".$ccom[$i];
//echo "<br>";
}
}
//echo $subcat2c." **** ".$ccnt2." **** ".$camt2." **** ".$ccom2." **** ".$cccc2;

//echo "<br><br><br>";
$subcat2b='';
$bcnt2='';
$bamt2='';
$bcom2='';
$cbbb2='';
//echo "<br>";
for($i=0;$i<count($cbbb);$i++)
{

if($i==0)
{
$cbbb2=$cbbb[$i];
$subcat2b=$cbbb[$i];
$bcnt2=$bcnt[$i];
 $bamt2=$bamt[$i];
 $bcom2=$bcom[$i];
//echo "<br>";
}
else
{
 $cbbb2=$cbbb2.",".$cbbb[$i];

$subcat2b=$subcat2b.",".$cbbb[$i];
$bcnt2=$bcnt2.",".$bcnt[$i];
 $bamt2=$bamt2.",".$bamt[$i];
 $bcom2=$bcom2.",".$bcom[$i];
//echo "<br>";
}
}
//echo $subcat2b." **** ".$bcnt2." **** ".$bamt2." **** ".$bcom2." **** ".$cbbb2;

//echo "<br><br><br>";
//print_r($caaa)."<br>";
//print_r($acnt)."<br>";
//print_r($aamt)."<br>";
//print_r($acom)."<br>";

$subcat2a='';
$acnt2='';
$aamt2='';
$acom2='';
$caaa2='';
//echo "<br>";
for($i=0;$i<count($caaa);$i++)
{

if($i==0)
{
$caaa2=$caaa[$i];
$subcat2a=$caaa[$i];
$acnt2=$acnt[$i];
 $aamt2=$aamt[$i];
 $acom2=$acom[$i];
//echo "<br>";
}
else
{
 $caaa2=$caaa2.",".$caaa[$i];

$subcat2a=$subcat2a.",".$caaa[$i];
$acnt2=$acnt2.",".$acnt[$i];
 $aamt2=$aamt2.",".$aamt[$i];
 $acom2=$acom2.",".$acom[$i];
//echo "<br>";
}
}
//echo $subcat2a." **** ".$acnt2." **** ".$aamt2." **** ".$acom2." **** ".$caaa2;

//echo "<br><br><br>";
$subcat=implode(",",$cnaa);
$subcat2='';
$nacnt2='';
$naamt2='';
$nacom2='';
$cnaa2='';
//echo "<br>";
for($i=0;$i<count($cnaa);$i++)
{

if($i==0)
{
$cnaa2=$cnaa[$i];
$subcat2=$cnaa[$i];
$nacnt2=$nacnt[$i];
 $naamt2=$naamt[$i];
 $nacom2=$nacom[$i];
//echo "<br>";
}
else
{
 $cnaa2=$cnaa2.",".$cnaa[$i];

$subcat2=$subcat2.",".$cnaa[$i];
$nacnt2=$nacnt2.",".$nacnt[$i];
 $naamt2=$naamt2.",".$naamt[$i];
 $nacom2=$nacom2.",".$nacom[$i];
//echo "<br>";
}
}
echo $subcat2." **** ".$nacnt2." **** ".$naamt2." **** ".$nacom2." **** ".$cnaa2;
 $proj=strtoupper($_POST['project']);
 
 //echo "<br>";
 //echo "count".$cn;
//echo "atm ".$atm."<br>";
		//echo "num of days ".$ndays."<br>";
//echo "takeoverdt ".$tkdt."<br>";
//echo "handoverdt ".$hddt."<br>";
//echo "billamt ".$billamount."<br>";
//echo "siterate ".$siterate."<br>";
//echo "cat ".$scat."<br>";
//echo "subcat ".$ssubcat."<br>";
?>
<div id=resshow></div>
<script type="text/javascript">

bill('caretakerbill.php?cid=<?php echo $cid; ?>&bank=<?php echo $bk; ?>&mon=<?php echo $mon; ?>&serv=<?php echo $service; ?>&ca=<?php echo $ca; ?>&cb=<?php echo $cb; ?>&cc=<?php echo $cc; ?>&cn=<?php echo $cn; ?>&aa=<?php echo $aa; ?>&ab=<?php echo $ab; ?>&ac=<?php echo $ac; ?>&an=<?php echo $an; ?>&id=<?php echo $id; ?>&year=<?php echo $date_parts2[2]; ?>&stdt=<?php echo $start_date; ?>&todt=<?php echo $end_date;  ?>&comp=<?php echo $_POST['comp']; ?>&city=<?php echo $cty; ?>&atm=<?php echo $atm; ?>&po=<?php echo $po; ?>&subcatna=<?php echo $subcat2; ?>&nacnt=<?php echo $nacnt2; ?>&naamt=<?php echo $naamt2; ?>&nacom=<?php echo $nacom2; ?>&subcata=<?php echo $subcat2a; ?>&acnt=<?php echo $acnt2; ?>&aamt=<?php echo $aamt2; ?>&acom=<?php echo $acom2; ?>&subcatb=<?php echo $subcat2b; ?>&bcnt=<?php echo $bcnt2; ?>&bamt=<?php echo $bamt2; ?>&bcom=<?php echo $bcom2; ?>&subcatc=<?php echo $subcat2c; ?>&ccnt=<?php echo $ccnt2; ?>&camt=<?php echo $camt2; ?>&ccom=<?php echo $ccom2; ?>&prjct=<?php echo $proj; ?>&tot=<?php echo $totalsites; ?>&zone=<?php echo $_POST['zone']; ?>&tkdt=<?php echo $tkdt ?>&hddt=<?php echo $hddt; ?>&numofd=<?php echo $ndays; ?>&billamt=<?php echo $billamount; ?>&siterate=<?php echo $siterate; ?>&citycategory=<?php echo $scat; ?>&subcitycat=<?php echo $ssubcat; ?>','bill');
</script>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--SELECT COMPANY :<select name="comp" id="comp" ><option value="-1">select</option>
<?php $res=mysqli_query($con,"select * from company_details");
      while($row=mysqli_fetch_array($res))
      { ?>
       <option value='<?php echo $row[0]; ?>' ><?php echo $row[1]; ?></option>
     <?php } ?></select>

<a href="#" onclick="bill('caretakerbill.php?cid=<?php echo $cid; ?>&bank=<?php echo $bk; ?>&mon=<?php echo $mon; ?>&serv=<?php echo $service; ?>&ca=<?php echo $ca; ?>&cb=<?php echo $cb; ?>&cc=<?php echo $cc; ?>&cn=<?php echo $cn; ?>&aa=<?php echo $aa; ?>&ab=<?php echo $ab; ?>&ac=<?php echo $ac; ?>&an=<?php echo $an; ?>&id=<?php echo $id; ?>&year=<?php echo $date_parts2[2]; ?>&stdt=<?php echo $start_date; ?>&todt=<?php echo $end_date;  ?>&city=<?php echo $cty; ?>&cnaa=<?php echo $cnaa; ?>&nacnt=<?php echo $nacnt; ?>&proj=<?php echo $proj; ?>','bill')" >GENERATE BILL</a>--><a onClick="PrintDiv('annexure');" href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Annexure</font></a>&nbsp;&nbsp;<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button></center>
<div id="bill">

</div>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>