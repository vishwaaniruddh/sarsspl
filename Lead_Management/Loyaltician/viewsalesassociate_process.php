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




    $View="select * from SalesAssociate where 1=1";
 //echo $View;
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
  $View.=" and FirstName='".$fname."'";  
  
}
if($lname!=""){
  $View.=" and LastName='".$lname."'";  
}
if($Mobile!=""){
  $View.=" and ContactNo LIKE '%".$Mobile."%'";  
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
	


$View.=" ORDER BY SalesmanId  DESC ";
//$View.=" Name LIKE '%".$Name."%' ";
	$View.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($conn,$View);
//	echo $qry;	
//echo $View;
	?>
	<form  method="post" action="delegation.php">
	<table align="center" class="table" style="width:80%" border='1'>
			
			<tr>
			    <th>Sr No</th>
				<th>FirstName</th>
				<th>LastName</th>
				<th>Designation</th>
				<th>UserLevel</th>
				<th>Country</th>
				<th>State</th>
				<th>City</th>
				<th>Address</th>
				<th>ContactNo</th>
				<th>Location</th>
				<th>Company</th>
				<!--<th>Edit</th>
				<th>Update Lead</th>
				<th>Delegate</th>-->
				
			</tr>
			<?php 
		
			while($_row=mysqli_fetch_array($qrys))
			{
	$sql5="select state from state where state_id='".$_row['State']."'";
	$runsql5=mysqli_query($conn,$sql5);
	$sql5fetch=mysqli_fetch_array($runsql5);
  ?>
	<tr>
	<td><?php echo $srn; ?></td>

	<td><?php echo $_row['FirstName']; ?></td>
	<td><?php echo $_row['LastName']; ?></td>
	<td><?php echo $_row['Designation']; ?></td>
	<td><?php echo $_row['UserLevel']; ?></td>
	<td><?php echo $_row['Country']; ?></td>
	<td><?php echo $sql5fetch[0]; ?></td>
	<td><?php echo $_row['City']; ?></td>
	<td><?php echo $_row['Address']; ?></td>
	<td><?php echo $_row['ContactNo']; ?></td>
	<td><?php echo $_row['Location']; ?></td>
	<td><?php echo $_row['Company']; ?></td>
	

<!--<td><input type="button" onclick="window.open('editlead.php?id=<?php echo $_row['Lead_id'];?>','_self');" value="Edit Lead">  </td>
<td><input type="button" id="qtnview<?php echo $srn;?>" onclick="window.open('leadupdate.php?id=<?php echo $_row['Lead_id'];?>','_self');" value="Lead Update">  </td>
<td><input type="checkbox" name="check[]" value="<?php echo $_row['Lead_id'];?>"></td>-->
	
	
				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	
		</table>
		
	<!--<div align="center"><button id="myButtonControlID" onClick="expfunc();">Delegate</button></div>-->
	</form>
	
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


	