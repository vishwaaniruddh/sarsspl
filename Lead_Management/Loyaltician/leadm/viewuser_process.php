<?php
session_start(); //Start the session
include ("config.php");

$strPage = $_POST['Page'];
/*
$strdt=$_POST['strdt'];
//echo $strdt;

$endt=$_POST['endt'];*/

$Types=$_POST['Types'];
$fname=$_POST['fname'];

    $View="select * from Users where 1=1";
 //echo $View;
       /*if($_POST['strdt']!="" & $_POST['endt']!="")
	{

	$dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
 

	$View.=" and Creation between '".$start."' and '".$end."'";
//	echo $View;
}
         */
         
        
if($fname!=""){
  $View.=" and UserName='".$fname."'";  
  
}
if($Types!=""){
  $View.=" and UserType='".$Types."'";  
}

$table=mysqli_query($conn,$View);

$Num_Rows = mysqli_num_rows ($table);

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
	


$View.=" ORDER BY UserId  DESC ";
//$View.=" Name LIKE '%".$Name."%' ";
	$View.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($conn,$View);
//	echo $qry;	
//echo $View;
	?>
	
	<table align="center" class="table" style="width:40%" border='1'>
			
			<tr>
			    <th>Sr No</th>
				<th>User Name</th>
				<th>Password</th>
				<th>Type</th>
			<!--	<th>Edit</th>-->
			</tr>
			<?php 
		
			while($_row=mysqli_fetch_array($qrys))
			{
	
  ?>
	<tr>
	<td><?php echo $srn; ?></td>
	<td><?php echo $_row['UserName']; ?></td>
	<td><?php echo $_row['Password']; ?></td>
	<td><?php echo $_row['UserType']; ?></td>
	
<!--<td><input type="button" onclick="window.open('edituser.php?id=<?php echo $_row['UserId'];?>','_self');" value="Edit">  </td>-->
<!--<td><input type="button" id="qtnview<?php echo $srn;?>" onclick="window.open('leadupdate.php?id=<?php echo $_row['Lead_id'];?>','_self');" value="Lead Update">  </td>
	-->
	
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


	