<?php
include("config.php");
include("access.php");
	
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{

//$Per_Page=$_POST['perpg'];
$strPage = $_POST['Page'];


$qry="select * from send_bill where status=0 and state!=''";



if(isset($_POST['cid']) && $_POST['cid']!='')
			{
			$qry.=" and customer_name = '".$_POST['cid']."'";
			}
if(isset($_POST['invoice_no']) && $_POST['invoice_no']!='')
{
	$qry.=" and invoice_no like '%".$_POST['invoice_no']."%'";
}
			
		if(isset($_POST['bank']) && $_POST['bank']!='' && $_POST['bank']!='-1')
			{
			$qry.=" and bank like '".$_POST['bank']."'";
			}
		
		if(isset($_POST['strdt']) && isset($_POST['endt']) && $_POST['strdt']!='' && $_POST['endt']!='')
			{
			$dt=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt));
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
			if($start!=$end)
			$qry.=" and entrydt Between '".$start."' and '".$end."'";
			else
			$qry.=" and entrydt Like '".$start."%'";
			}
			
	
	if($_POST["invoicetyp"]!="")
	{
	$qry.=" and open= '".$_POST["invoicetyp"]."%'";
	}
$table=mysqli_query($con,$qry);

$Num_Rows = mysqli_num_rows ($table);


	
	
	?>
	
	
	<div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="func('1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%50==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"  <?php if(isset($_POST['perpg']) && $_POST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
$Page = $strPage;
if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
	


$qry.=" ORDER BY send_id ASC ";
	
	$qry.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con,$qry);
//echo $qry;	
	?>
	
												
		<input type="hidden" id="expqry" name="expqry" value="<?php echo $qry;?>">
<button type="button" id="myButtonControlID" onClick="tableToExcel('tableexport', 'Table Export Example')">Export Table data into Excel</button>

<table id="tableexport" name="tableexport" border="2">
	<th  align="center">Sr No</th>
	<th width="75">GST NUMBER OF CUSTOMER</th>
	<th >SAC CODE</th>
	<th  align="center">FULL NAME OF THE CUSTOMER</th>
	<th  align="center">STATE CODE</th>
	<th  align="center">PLACE OF Billing</th>
	<th  align="center">PLACE OF SUPPLY</th>
	<th  align="center">Invoice	</th>
		<th  align="center">Customer ID	</th>
	<th  align="center">Bank	</th>
	<th  align="center">Project	</th>
<th  align="center">Invoice Date	</th>
<th  align="center">Type	</th>
<th  align="center">Invoice Amount	</th>
	<th  align="center">Bill amount	</th>
	<th  align="center">CGST @ 9%	</th>
	<th  align="center">SGST @ 9% 	</th>
	<th  align="center">IGST @ 18%	</th>
	<th  align="center">Total amt	</th>
	<th  align="center">Remarks	</th>
	<th  align="center">Status	</th>
	
	
	
	
	
	<?php
	
	if($Prev_Page)
	{
	    
	    $srn=($Prev_Page*$Per_Page)+1;
	    
	}
	else
	{
	    
	   $srn=1; 
	}
	
//	$srn=($Page*$Per_Page)-($Per_Page);
	while($row=mysqli_fetch_array($qrys))
    {
        
        
        $resul4=mysqli_query($con,"select id,contact_first,short_name from contacts where short_name='".$row["customer_name"]."'");
                $ro4=mysqli_fetch_array($resul4); 
                $uid1=$ro4[0];
				
                $resul5=mysqli_query($con,"select * from address_book where ref_id='$uid1'");
                $addrow1=mysqli_fetch_array($resul5); 
           
           $tabname="";
           if($row["customer_name"]=="EUR08")
           {
               $tabname="euronet";
               
           }
           if($row["customer_name"]=="DIE002")
           {
               $tabname="diebold";
               
           }
           if($row["customer_name"]=="FIS03")
           {
               $tabname="fis";
               
           }
           if($row["customer_name"]=="FSS04")
           {
               $tabname="fss";
               
           }
           if($row["customer_name"]=="HITACHI07")
           {
               $tabname="hitachi";
               
           }
           if($row["customer_name"]=="AGS01")
           {
               $tabname="ags";
               
           }
           
            if($row["customer_name"]=="Tata05")
           {
               $tabname="tata";
               
           }
           
            if($row["customer_name"]=="EPS")
           {
               $tabname="eps";
               
           }
           
           
          $qrn= "select * from ".$tabname."_gst where State ='".$row['state']."'";
           $sttcode=mysqli_query($con,"select * from ".$tabname."_gst where State ='".$row['state']."'");
         
$sttcodef=mysqli_fetch_array($sttcode);  
$ggs="";
if($tabname=="fss")
{
    
 $ggs=$sttcodef[3]; 
}
elseif($tabname=="eps")
{
    
 $ggs=$sttcodef[5]; 
}
elseif($tabname=="fis" || $tabname=="hitachi")
{
    
 $ggs=$sttcodef[2]; 
}
else
{
  $ggs=$sttcodef[3];
    
}



if($ggs=="" or $ggs=="na")
{
    
    $qrn="select * from ".$tabname."_gst where State= 'Maharashtra'";
 $sttcodemh=mysqli_query($con,"select * from ".$tabname."_gst where State= 'Maharashtra'");
$sttcodefmh=mysqli_fetch_array($sttcodemh);


if($tabname=="fss")
{

    
        $statename=$sttcodef[2];
$gstcode=$sttcodef[3];  

$statename1=$sttcodef[1];

    
}else
{
       if($tabname=="fis")
{
    $statename=$sttcodef[4];

}else

{
$statename=$sttcodefmh['state_Code'];
}
$gstcode=$sttcodefmh['GSTIN'];
$statename1=$sttcodefmh['State'];
}

//$arno=$sttcodefmh['ARN'];
}
else
{

if($tabname=="fss")
{
   
    
    $statename=$sttcodef[2];
$gstcode=$sttcodef[3];  

$statename1=$sttcodef[1];

}else
{
    if($tabname=="fis")
{
    $statename=$sttcodef[4];

}else

{
    
$statename=$sttcodef['state_Code'];
    
}
$gstcode=$sttcodef['GSTIN'];
$statename1=$sttcodef['State'];
$arno=$sttcodef['ARN']; 
}
}        






$sttcodemh1=mysqli_query($con,"select * from ".$tabname."_gst where State= '".$row["state"]."'");
$nrm=mysqli_num_rows($sttcodemh1);
if($nrm>0)
{
$sttcodefmh1=mysqli_fetch_array($sttcodemh1);

if($tabname=="fss")
{
    $addr1=$sttcodefmh1[6];
}
elseif($tabname=="tata" || $tabname=="eps")
{
 $addr1=$sttcodefmh1[7];   
}
elseif($tabname=="euronet" )
{
 $addr1=$sttcodefmh1[5];   
}

else
{
$addr1=$sttcodefmh1[3];
}
}else
{
  $sttcodemh1=mysqli_query($con,"select * from ".$tabname."_gst where State= 'Maharashtra'");  
 $sttcodefmh1=mysqli_fetch_array($sttcodemh1);
if($tabname=="fss")
{
    $addr1=$sttcodefmh1[6];
}else if($tabname=="tata")
{
 $addr1=$sttcodefmh1[7];   
}
else
{
$addr1=$sttcodefmh1[3];
}  
}
    ?>
    
    
    
    
    <tr>
    <td><?php echo $srn; ?></td>
     <td><?php //echo $gstcode; 
     echo $gstcode;
     ?></td> 
     <td><?php echo ""; ?></td> 
     <td><?php echo $addr1; ?></td>
    <td><?php echo $statename; ?></td> 
     <td><?php echo $statename1; ?></td> 
     <td><?php echo $row["state"]; ?></td> 
     <td><?php echo $row["invoice_no"]; ?></td> 
     <td><?php echo $ro4["contact_first"]; ?></td> 
     <td><?php echo $row["bank"]; ?></td>
 <td><?php echo $row["projectid"]; ?></td>
 <td><?php echo date("d-m-Y",strtotime($row["date"])); ?></td>
 <td><?php echo "INV"; ?></td>
 
 <td><?php echo $row["amount"]; ?></td>
 <td><?php echo ""; ?></td>
 <td><?php echo ""; ?></td>
 <td><?php echo ""; ?></td>
 <td><?php echo ""; ?></td>
 <td><?php echo ""; ?></td>
 <td><?php if($row["cgst"]>0){ echo "CGST/SGST"; }else{ echo "IGST"; } ?></td>
 <td><?php if($row["open"]=="1"){ echo "Active"; }else{ echo "Inactive"; }  ?></td>
 
     
     </tr>
    
    
    <tr>
    <td></td>
     <td><?php echo $gstcode; ?></td> 
     <td><?php echo ""; ?></td> 
     <td><?php echo $addr1; ?></td>
    <td><?php echo $statename; ?></td> 
     <td><?php echo $statename1; ?></td> 
     <td><?php echo $row["state"]; ?></td> 
     <td><?php echo $row["invoice2"]; ?></td> 
     <td><?php echo $ro4["contact_first"]; ?></td> 
     <td><?php echo $row["bank"]; ?></td>
 <td><?php echo $row["projectid"]; ?></td>
<td><?php echo date("d-m-Y",strtotime($row["date"])); ?></td>
  <td><?php echo "TAX"; ?></td>
 <?php
 $gstamt=$row["sgst"]+$row["cgst"]+$row["igst"];
 ?>
 <td><?php echo $row["servchrg"]; ?></td>
 <td><?php echo $row["servchrg"]-$gstamt; ?></td>
 <td><?php echo $row["cgst"]; ?></td>
 <td><?php echo $row["sgst"]; ?></td>
 <td><?php echo $row["igst"]; ?></td>
 <td><?php echo $row["servchrg"]; ?></td>
 <td><?php if($row["cgst"]>0){ echo "CGST/SGST"; }else{ echo "IGST"; } ?></td>
 <td><?php if($row["open"]=="1"){ echo "Active"; }else{ echo "Inactive"; }  ?></td>
 
     
     </tr>
    
    
    <?php
        
      $srn++; 
    }	
    
    
	?>

	
		</table>





<div class="pagination" style="width:100%;"><font size="4" color="#000">
 <?php 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:func('$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:func('$Next_Page','perpg')\">Next >></a> ";
}
?>



<?php } ?>