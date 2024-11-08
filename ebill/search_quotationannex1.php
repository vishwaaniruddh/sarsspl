<?php

//echo $_SESSION['user'];
include('access.php');
include('config.php');

session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{

$strPage = $_REQUEST['Page'];

$cid="";
$strt="";
$endt="";
$sql="";

if($_POST['sdate']!='' & $_POST['edate']!='')
                 {
                 $sdate=str_replace("/","-",$_REQUEST['sdate']);
                 $strt=date("Y-m-d",strtotime($sdate));
                 $edate=str_replace("/","-",$_REQUEST['edate']);
                 $endt=date("Y-m-d",strtotime($edate));
                 }




 $qry="Select * from quotation1 where ((status='a' or status='app') and category='a') and p_stat!='10'";
 
 $adq="SELECT qid FROM `quotation_approve_details` where filename!=''";
 
 $adq1="SELECT qid FROM `quotation_approve_details` where 1 ";
 
if($_POST['sdate']!='' & $_POST['edate']!='')
                 {
                 //$adq.=" and DATE(approved_date)>='".$strt."' and DATE(approved_date)<='".$endt."'   ";
                 //$adq1.=" and DATE(approved_date)>='".$strt."' and DATE(approved_date)<='".$endt."'   ";
    
$adq.=" and DATE(entrydate)>='".$strt."' and DATE(entrydate)<='".$endt."'   ";
$adq1.=" and DATE(entrydate)>='".$strt."' and DATE(entrydate)<='".$endt."'   ";
    
             }

$adqrnw="";
 if($_POST['cid']=="EUR08")
{          
$adqrnw=mysqli_query($con,$adq1);
}
else
{
$adqrnw=mysqli_query($con,$adq);
}

$qdarr=array();
while($gqidrws=mysqli_fetch_array($adqrnw))
{
$qdarr[]=$gqidrws[0];
}

$qidtostr=implode(',',$qdarr);
/*
if($_POST['cid']=="EUR08")
	{
	$qry.=" and id in(".$adq1.")";
	} 
	else
	
	{
	$qry.=" and id in(".$adq.")";
	
	
	}
	*/

$qry.=" and id in(".$qidtostr.")";

 if($_POST['qid']!="")
	   {
	   $qry.=" and quot_id LIKE '"."%".$qid."%"."'";
	   }

           
            


         

             if($_POST['atmid']!="")
	{
	$qry.=" and atm='".$_POST['atmid']."'";
	} 
         
	  if($_POST['cid']!="-1")
	{
	$qry.=" and cust='".$_POST['cid']."'";
	} 
	 if($_POST['bank']!="")
	{
	$qry.=" and bank='".$_POST['bank']."'";
	} 
	 
	  if($_POST['accname']!="-1")
	{
	$qry.=" and reqby='".$_POST['accname']."'";
	}  

     if($_POST['billtyp']!="")
	{
	$qry.=" and billing_status='".$_POST['billtyp']."'";
	}  

       //echo $qry;
$table=mysqli_query($con,$qry);

$Num_Rows = mysqli_num_rows ($table);
 
// pagins
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
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
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
	


$qry.=" ORDER BY cust ASC ";
	
	$qry.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con,$qry);
	echo $qry;	
	?>
<input type="hidden" name="expqry" id="expqry" value="<?php echo $qry;?>">
<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>
<table  border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th width="75">Sr NO</th>
<th width="75">Category</th>
<th  align="center">Made By</th>
<th width="175">CSS Ref No</th>
<th width="90">Customer</th>
<th width="90">Project</th>
<th width="100">Bank</th>
<th width="175">Atm ID</th>
<th width="175">Site ID</th>
<th width="175">VPR NO</th>
<th width="175">I O CODE</th>
<th width="175">JOB ID</th>
<th width="175">Ticket No</th>
<th width="175">Prime Code</th>
<th width="105">City</th>
<th width="175">State</th>

<th width="600">Location</th>
<th width="800">WorkDetails</th>

<th width="75">Zone</th>
<th width="75">Month</th>
<th width="75">Approval Date</th>

<th width="75">Approval Amount</th>


<th width="75">Transfer Date</th>
<th width="75">Transfer Amount</th>

<th width="75">Approved By</th>
<th width="300">Mail By</th>
<th width="300">Attachment</th>
<th width="300">Call Status</th>
<th width="300">Call Close Snaps</th>
<th width="300">Invoice No</th>

<?php

$count=0;
$srn=1;
$apptotamt=0;
while($row= mysqli_fetch_row($qrys))
{
//echo $row[10]."<br>";


$transfer=mysqli_query($con,"select * from quotation1ftransfers where qid='".$row[0]."' ");
$transdetail = mysqli_fetch_array($transfer);



// echo $transdetail[3];

$qry1=mysqli_query($con,"select short_name,contact_first from contacts where short_name='$row[2]'");
$qrrow=mysqli_fetch_array($qry1);


//echo "select username from login where srno='".$row[1]."'";
$branch=mysqli_query($con,"select username from login where srno='".$row[1]."'");
$brro=mysqli_fetch_row($branch);

//echo "select projectid from $row[2]_sites where atm_id1='".$row[3]."'";
$projq=mysqli_query($con,"select projectid,site_id,zone from $row[2]_sites where atm_id1='".$row[3]."'");
$projrow=mysqli_fetch_row($projq);

$gapdet=mysqli_query($con,"Select * from quotation_approve_details where qid='".$row[0]."'");
$nurws=mysqli_num_rows($gapdet);

 $mdby=mysqli_query($con,"select username from login where srno='".$row[9]."'");
	  $mdrow=mysqli_fetch_array($mdby);

$approw="";
if($nurws>0)
{
$approw=mysqli_fetch_array($gapdet);


}

$mdby=mysqli_query($con,"select username from login where srno='".$row[9]."'");
	  $mdrow=mysqli_fetch_array($mdby);

?>
<tr>
<td align="center"><?php echo $srn;?></td>
<td align="center"><?php if($row[12]=="a"){ echo "Approval Basis"; }elseif($row[12]=="f"){echo "Fixed Cost"; };?></td>
<td>
	    
	      <?php echo $mdrow[0]." ".date( 'd/m/Y g:i A', strtotime($row[10])); ?>
	    
	     </td>
<td align="center" width="170"><?php echo $row[1];?></td>
<td align="center"><?php echo $qrrow[1];?></td>
<td align="center"><?php echo $projrow[0];?></td>
<td align="center"><?php echo $row[4];?></td>
<td align="center"><?php echo $row[3];?></td>
<td align="center"><?php echo $projrow[1];?></td>
<td align="center"><?php echo $approw[3];?></td>
<td align="center" ><?php echo $approw[2];?></td>
<td align="center"><?php echo $approw[4];?></td>
<td align="center"><?php echo $approw[14];?></td>

<td align="center"><?php echo $approw[5];?></td>
<td align="center"><?php echo $row[7];?></td>
<td align="center"><?php echo $row[8];?></td>
<td align="center"><?php echo $row[6];?></td>



<td  align="center">
<?php

if($row[2]=='ICICI' || $row[2]=='RATNAKAR' || $row[2]=='ICICI_Direct' || $row[2]=='Knight_Frank' )
{
?>
<table border='1'>
<?php
$qdetici=mysqli_query($con,"select * from icici_quot_details where qid='".$row[0]."'");
 while($gdetca2=mysqli_fetch_array($qdetici))
 {
 ?>
<tr>

  <td width="100"><?php echo $gdetca2[2];?></td>
  <td width="100"><?php echo $gdetca2[3];?></td>
<td width="200"><?php echo $gdetca2[4];?></td>
<td width="100"><?php echo $gdetca2[5];?></td>


<td width="100"><?php echo $gdetca2[6];?></td>
<td width="100"><?php echo $gdetca2[7];?></td>
<td width="100"><?php echo $gdetca2[8];?></td>
<td width="100"><?php echo $gdetca2[9];?></td>


</tr>
<?php
}
?>
</table>
<?php
 } 
 else
{
 ?>
 <table >
<?php
$qdetc=mysqli_query($con,"select distinct(particular) from quotation_details where qid='".$row[0]."'");
 while($gdetca=mysqli_fetch_array($qdetc))
 {
?>
<tr><td colspan="2" align="center"><b><?php echo $gdetca[0];?></b></td></tr>
<?php
  $gpart=mysqli_query($con,"select * from quotation_details where particular='".$gdetca[0]."' and qid='".$row[0]."'");
$str='a';
while($gparta=mysqli_fetch_array($gpart))
 {
?>
  <tr><td width=""><?php echo "(".$str.")".$gparta[3];?></td>
<td  align="left"><?php echo "(".$gparta[4].")" ;?></td>
</tr>

<?
$str++;
 }

  
 }
?>
</table>
<?php
}?>



</td>
<td align="center"><?php echo $projrow[2]; ?></td>
<td align="center"><?php echo date("M-Y",strtotime($approw[12])); ?> </td>
<td align="center"><?php if($approw[12]!='0000-00-00')
{ echo date( 'd/m/Y ', strtotime($approw[12])); }?></td>
<td align="center"><?php if($nurws>0)
{ echo round($approw[9]); $apptotamt=$apptotamt+round($approw[9]); }?></td>

<td align="center"><?php if($transdetail[3]!="0000-00-00") {
    if(!is_null($transdetail[3])){
         echo date("d/m/Y",strtotime($transdetail[3])) ;  
    }
   
    }?></td>
<td align="center"><?php echo $transdetail[7];?></td>


<td align="center"><?php if($nurws>0)
{ echo $approw[7]; }?></td>
<td><?php echo $mdrow[0]; ?></td>



<td align="center"><?php if($approw[8]!=""){ 

$extn=explode('.',$approw[8]);
$dwnlname=$row[1]."/".$row[4]."/".$row[3]."/".round($approw[9]).".".$extn[1];
$arrexp=explode('/',$row[1]);

$dwnlname1=$arrexp[0]."-".$arrexp[1]."-".$arrexp[2]."-".$arrexp[3]."-".$arrexp[4]."-".$row[4]."-".$row[3]."-".round($approw[9]).".".$extn[1];
$fgh="../operations/quotuploads/approve/".$approw[8];
$ptyt="";

if (file_exists($fgh)) 
{
$ptyt="../operations/quotuploads/approve/".$approw[8];
}
else
{
$ptyt="http://192.254.233.144/~kevalj/xxxcncindia.in/operations/quotuploads/approve/".$approw[8];

}
?>
 <a href='<?php echo $ptyt;?>' target="_blank" download="<?php echo $dwnlname; ?>" >Download</a>
<input type="hidden" name="dnref[]" id="dnref" value="<?php   echo $ptyt;?>" /> 
<input type="hidden" name="dwlnm[]" id="dwlnm" value="<?php echo $dwnlname1; ?>"/>

 <?php
 }
 ?>
   
</td>


 <td  align="center" width="150"><?php if($row[16]=="0"){echo "Opened";}else{ echo "Closed"; }?></td>
	     
	<td width="250" align="center" >
	  
	  <?php if($row[16]=="1")
	  {
	 // echo "select * from quotaion_close_detail where qid='".$row[0]."'";
	  $gqhis=mysqli_query($con,"select * from quotation_close_detail where qid='".$row[0]."'");
	  $ghrw=mysqli_fetch_array($gqhis);
	  $qcdt=date("d-m-Y",strtotime($ghrw[2]));
	  
	    if($ghrw[7]!="")
              {

$clp1="../operations/quotuploads/close/".$ghrw[7];
$closeuplds="";
if (file_exists($clp1)) 
{
$closeuplds=$clp1;
}
else
{
$closeuplds="http://192.254.233.144/~kevalj/xxxcncindia.in/operations/quotuploads/close/".$ghrw[7];

}




     ?>
     
     
 <a href='<?php echo $closeuplds; ?>' target="_blank" download>Download</a>
  <input type="hidden" name="cls[]" id="dnref" value="<?php echo $closeuplds; ?>" /> 
 <?php

               }
	  
	  }
	  
	  ?>
	  
	  
	  
	  
	  </td>  
	  

<td  align="center" width="150">
<?php 
//echo "select invno from uotation1_bill_details where qid='".$row[0]."'";
$ginvnos=mysqli_query($con,"select invno from quotation1_bill_details where qid='".$row[0]."'");

$ginvrow=mysqli_fetch_array($ginvnos);

echo $ginvrow[0];

?>

</td>

<td><?php if($_POST['billtyp']=='n'){ ?><input type="checkbox" name="clbillqid[]" id="clbillqid<?php echo $srn;?>" value="<?php echo $row[0]; ?>"  checked/><?php }?></td>

</tr>



<?php
$srn++;
}
?>

<tr height="45">
<td colspan="21" align="center">Total</td>
<td align="center"><b><?php echo $apptotamt;?><b> </td>
</td>

</tr>
<tr>
<td colspan="29" align="center"><?php if($_POST['billtyp']=='n'){ ?>
<input type="button" name="clbtn" id="clbtn" value="Submit" onclick="subpfunc();">
<?php }?>
<input type="button" name="dwlatt" id="dwlatt" value="Download Attachments" onclick="dattach();">
<input type="button" name="dwlatt" id="dwlatt" value="Download Close Attachments" onclick="Closedattach();">
</td>
</tr>
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


}
?>