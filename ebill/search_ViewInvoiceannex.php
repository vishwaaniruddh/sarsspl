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




 $qry="Select * from rnm_invoice where 1=1";
 
 
if($_POST['sdate']!='' & $_POST['edate']!='')
                 {
                 
$qry.=" and DATE(entrydate)>='".$strt."' and DATE(entrydate)<='".$endt."'   ";

             }
             
             
             if($_POST['atmid']!="")
	{
	$qry.=" and atm='".$_POST['atmid']."'";
	} 
         
	  if($_POST['cid']!="-1")
	{
	$qry.=" and customer='".$_POST['cid']."'";
	} 
	 if($_POST['bank']!="")
	{
	$qry.=" and bank='".$_POST['bank']."'";
	} 
	 

    

 if($_POST['state']!="")
	{
	$qry.=" and state='".$_POST['state']."'";
	} 
	

      
     // echo $qry;
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
	


$qry.=" ORDER BY customer ASC ";
	
	$qry.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con,$qry);
	//echo $qry;	
	?>
<input type="hidden" name="expqry" id="expqry" value="<?php echo $qry;?>">
<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>
<table  border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th width="75">Sr NO</th>
<th width="175">Invoice</th>
<th width="75">Customer</th>
<th  align="center">Bank</th>
<th width="175">Project ID</th>
<th width="90">Date</th>
<th width="90">Amount</th>
<th width="100">CGST</th>
<th width="175">SGST</th>
<th width="175">IGST</th>
<th width="175">Total Amt</th>
<th width="175">State</th>

<th width="300">View</th>
<?php

$count=0;
$srn=1;
$apptotamt=0;
while($row= mysqli_fetch_row($qrys))
{



?>
<tr>
<td align="center"><?php echo $srn;?></td>
<td align="center"><?php echo $row[16];?></td>
<td align="center" width="170"><?php echo $row[1];?></td>
<td align="center"><?php echo $row[2];?></td>
<td align="center"><?php echo $row[3];?></td>

<td align="center"><?php if($row[4]!='0000-00-00')
{ echo date( 'd/m/Y ', strtotime($row[4])); }?></td>

<td align="center"><?php echo $row[5];?></td>
<td align="center"><?php echo $row[6];?></td>
<td align="center"><?php echo $row[7];?></td>
<td align="center" ><?php echo $row[8];?></td>
<td align="center"><?php echo $row[9];?></td>
<td align="center"><?php echo $row[10];?></td>

<td align="center"><a target="_blank" href="ViewQuot_invoice_Details.php?sendId=<?php echo $row[0];?>">View</a></td>




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
    
    
}
?>