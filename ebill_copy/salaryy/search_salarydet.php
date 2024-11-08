<?php
include("../config.php");
include("../access.php");
	
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='../index.php';</script>";
}
else
{
$strPage = $_POST['Page'];



$atm=$_POST['atmid'];

$qry="select * from caretaker_salary where 1";
if($atm!="")
{
$qry.=" and BillingIATMID='".$atm."'";
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
	


$qry.=" ORDER BY Sr ASC ";
	
	$qry.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con,$qry);
	//echo $qry;	
	?>


<input type="button" id="exp" onclick="tableToExcel('exptexcl', 'Table Export Example')" value="Export To Excel"/>	

<table border="2" name="exptexcl" id="exptexcl">

<th>SR No</th>
<th>Roll</th>
<th>ServiceStatus</th>
<th>Services</th>
<th>AcMangerName</th>
<th>Customer</th>
<th>Bank</th>
<th>CSSLocalBranch</th>
<th>CSSBranchHead</th>
<th>FundTransferTo</th>
<th>ActualZone</th>
<th>BillingZone</th>
<th>State</th>
<th>Site ID</th>

<th>BillingIATMID</th>
<th>IIATMID</th>
<th>IIIATMID</th>
<th>City</th>
<th>Location</th>
<th>ATMSiteAddress</th>
<th>SiteType</th>
<th>CityCategory</th>
<th>TakeOverDate</th>

<th>HandoverDate</th>
<th>CSSRemark</th>
<th>CustomerRemarks</th>
<th>CSSAcManagerRemarks</th>
<th>DutyHrs</th>
<th>SalaryPaidMonth</th>
<th>Billing</th>
<th>Wages</th>
<th>NoofGuard</th>

<?php 
$srn=1;
while($row=mysqli_fetch_array($qrys))
{

?>


<tr>
<td align="center"><?php echo $srn;?></td>
<td align="center"><?php echo $row[1];?></td>
<td align="center"><?php echo $row[2];?></td>
<td align="center"><?php echo $row[3];?></td>
<td align="center"><?php echo $row[4];?></td>
<td align="center"><?php echo $row[5];?></td>
<td align="center"><?php echo $row[6];?></td>
<td align="center"><?php echo $row[6];?></td>
<td align="center"><?php echo $row[8];?></td>
<td align="center"><?php echo $row[9];?></td>
<td align="center"><?php echo $row[10];?></td>
<td align="center"><?php echo $row[11];?></td>
<td align="center"><?php echo $row[12];?></td>
<td align="center"><?php echo $row[13];?></td>
<td align="center"><?php echo $row[14];?></td>
<td align="center"><?php echo $row[15];?></td>
<td align="center"><?php echo $row[16];?></td>
<td align="center"><?php echo $row[17];?></td>
<td align="center"><?php echo $row[18];?></td>

<td align="center"><?php echo $row[19];?></td>
<td align="center"><?php echo $row[20];?></td>
<td align="center"><?php echo $row[21];?></td>
<td align="center"><?php if($row[22]!='0000-00-00'){echo date('d-m-Y',strtotime($row[22])); } ?></td>
<td align="center"><?php if($row[23]!='0000-00-00'){echo date('d-m-Y',strtotime($row[23])); }?></td>
<td align="center"><?php echo $row[24];?></td>
<td align="center"><?php echo $row[25];?></td>
<td align="center"><?php echo $row[26];?></td>
<td align="center"><?php echo $row[27];?></td>
<td align="center"><?php echo $row[28];?></td>
<td align="center"><?php echo $row[29];?></td>
<td align="center"><?php echo $row[30];?></td>
<td align="center"><?php echo $row[31];?></td>
<td align="center"><input type="button" name="edt" id="edt" onclick="myFunc(<?php echo $row[0];?>);" value="Edit"></td>





</tr>


<?php
$srn++;
}
?>









<table>


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