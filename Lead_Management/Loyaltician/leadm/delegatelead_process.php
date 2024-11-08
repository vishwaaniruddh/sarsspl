<?php
session_start(); //Start the session
include ("config.php");

$strPage = $_POST['Page'];

$strdt=$_POST['strdt'];
//echo $strdt;

$endt=$_POST['endt'];

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$Mobile=$_POST['Mobile'];
$Email=$_POST['Email'];
$Pincode=$_POST['Pincode'];



    /*$View="select * from LeadDelegation where SalesmanId='".$_SESSION['register_id']."'";
 echo $View;*/
 if($_SESSION['register_id']=='1'){
      $View="select a.LeadId,a.SalesmanId,b.Lead_id,b.FirstName,b.LastName,b.MobileNumber,b.EmailId,b.Country,b.State,b.City,b.LeadSource,b.Status,b.Nationality,b.Title,b.Company,b.LeadSource from LeadDelegation a,Leads_table b where a.LeadId=b.Lead_id";

 }else{
 $View="select a.LeadId,a.SalesmanId,b.Lead_id,b.FirstName,b.LastName,b.MobileNumber,b.EmailId,b.Country,b.State,b.City,b.LeadSource,b.Status,b.Nationality,b.Title,b.Company,b.LeadSource,b.PinCode from LeadDelegation a,Leads_table b where a.LeadId=b.Lead_id and a.SalesmanId='".$_SESSION['register_id']."'";
 }//echo $View;
       if($_POST['strdt']!="" & $_POST['endt']!="")
	{

	$dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
 

	$View.=" and Creation between '".$start."' and '".$end."'";
//	echo $View;
}
         
         
         if($_POST['typeoftest']!="")
         {
             	$View.=" and testtype='".$_POST['typeoftest']."'";
         }

//echo $View;
if($fname!=""){
  $View.=" and b.FirstName='".$fname."'";  
  
}
if($lname!=""){
  $View.=" and b.LastName='".$lname."'";  
}
if($Mobile!=""){
  $View.=" and b.MobileNumber LIKE '%".$Mobile."%'";  
}

if($Email!=""){
  $View.=" and b.EmailId='".$Email."'";  
}
if($Pincode!=""){
  $View.=" and b.PinCode='".$Pincode."'";  
}

$table=mysqli_query($conn,$View);

$Num_Rows = mysqli_num_rows ($table);

//echo $Num_Rows;
?>
<div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="func('1','perpg');"><br>
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
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
 
 
 //echo $Per_Page;
$Page = $strPage;
if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
//echo $Page_Start;
$srn=$Page_Start+1;
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
	


$View.=" ORDER BY DelegationId  DESC ";
//$View.=" Name LIKE '%".$Name."%' ";
	$View.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($conn,$View);
//	echo $qry;	
//echo $View;
	?>

	<table align="center" class="table" style="width:80%" border='1'>
			
			<tr>
			    <th>Sr No</th>
				<th>Title</th>
				<th>FirstName</th>
				<th>LastName</th>
				<th>MobileNumber</th>
				<th>EmailId</th>
				<th>Country</th>
				<th>State</th>
				<th>City</th>
				<th>Nationality</th>
				<th>Company</th>
				<th>Lead Source</th>
				<th>Status</th>
				<th>Update Lead</th>

				
			</tr>
			<?php 
		
			while($_row=mysqli_fetch_array($qrys))
			{
	
	
/*	$sql4="select * from Leads_table where Lead_id='".$_row['LeadId']."'";
	$runsql4=mysqli_query($conn,$sql4);
	$sql2fetch4=mysqli_fetch_array($runsql4);*/
	
	$sql2="select state from state where state_id='".$_row['State']."'";
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
	
	$sql3="select Name from Lead_Sources where SourceId='".$_row['LeadSource']."'";
	$runsql3=mysqli_query($conn,$sql3);
	$sql2fetch3=mysqli_fetch_array($runsql3);
  ?>
	<tr>
	<td><?php echo $srn; ?></td>
	<td><?php echo $_row['Title']; ?></td>
	<td><?php echo $_row['FirstName']; ?></td>
	<td><?php echo $_row['LastName']; ?></td>
	<td><?php echo $_row['MobileNumber']; ?></td>
	<td><?php echo $_row['EmailId']; ?></td>
	<td><?php echo $_row['Country']; ?></td>
	<td><?php echo $sql2fetch[0]; ?></td>
	<td><?php echo $_row['City']; ?></td>
	<td><?php echo $_row['Nationality']; ?></td>
	<td><?php echo $_row['Company']; ?></td>
	<td><?php echo $sql2fetch3[0]; ?></td>
	<td><?php if($_row['Status']!='0'){ echo "Incomplete"?></td>
	<td><input type="button" id="qtnview<?php echo $srn;?>" onclick="window.open('leadupdate.php?id=<?php echo $_row['LeadId'];?>','_self');" value="Lead Update">  </td>
<?php }else{?>
<td><?php echo "done";?></td>
<?php }?>
	
				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	
		</table>

	
<div class="pagination" style="width:100%; margin:0;" align="center"><font size="4" color="#000">
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
	</font>
	</div>


	