<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$Zone1=$_POST['Zone2'];
$DVRIP1=$_POST['DVRIP'];
$DVRName1=$_POST['DVRName'];
$ATMShortName1=$_POST['ATMShortName'];
$atmid=$_POST['atmid'];

$strPage=$_POST['Page'];

$sql="select * from sites  where 1=1  ";

if($Zone1!=""){
$sql.=" and Zone='".$Zone1."'";
}

if($DVRIP1!=""){
$sql.=" and DVRIP='".$DVRIP1."'";
}
if($atmid!=""){
$sql.=" and ATMID like '%".$atmid."%'";
}
if($DVRName1!=""){
$sql.=" and DVRName='".$DVRName1."'";
}

if($ATMShortName1!=""){
$sql.=" and ATMShortName='".$ATMShortName1."'";
}

    $result=mysqli_query($conn,$sql);
    $Num_Rows=mysqli_num_rows($result);
   
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

$sql.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$sql);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	    
	   $sr=($Page_Start* $Page)-$Page_Start;
	   
	   $sr=$sr+1;
	}

?>
   
<?php 
$sr++;

?>
</table>



	

<html>

<style>
table{
	width:100%;
}
td{
	padding:10px;
	font-size:12px;
	font-weight: bold;
	color:#000;
}

tr:hover {
background-color:#eee !important;
}
tr,th{
	padding:10px;
	background-color:#8cb77e; 
	color:#fff;
	font-size:12px;
}
</style>

<center><div>total records:<?php echo $Num_Rows?></div></center>
  <table border=1 style="margin-top:30px">
  <tr>
      <th>SN</th>
    <!--<th>Status</th>
    <th>Phase</th>-->
    <th>Customer</th>
      <th>Bank</th>
       <th>ATMID</th>
	   <!--<th>ATMID_2</th>
    <th>ATMID_3</th>
    <th>ATMID_4</th>
      <th>TrackerNo</th-->
       <th>ATMShortName</th>
	   <th>SiteAddress</th>
    <th>City</th>
    <th>State</th>
      <th>Zone</th>
	  <th>View</th>
       <th>Panel_Make</th>
	   <th>OldPanelID</th>
	   <th>NewPanelID</th>
     <th>DVRIP</th>
    <th>DVRName</th>
      <th>UserName</th>
       <th>Password</th>
	   <th>Edit</th>
      
       
       
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) { ?>


 <tr style="background-color:#cfe8c7">

    <td><?php echo $row["SN"];?></td>
    <!--<td><?php echo $row["Status"];?></td>
    <td><?php echo $row["Phase"];?></td>-->
    <td><?php echo $row["Customer"];?></td>
    <td><?php echo $row["Bank"];?></td>
    <td><?php echo $row["ATMID"];?></td>
	
	<!--<td><?php echo $row["ATMID_2"];?></td>
    <td><?php echo $row["ATMID_3"];?></td>
    <td><?php echo $row["ATMID_4"];?></td>
    <td><?php echo $row["TrackerNo"];?></td>-->
    <td><?php echo $row["ATMShortName"];?></td>
	<td><?php echo $row["SiteAddress"];?></td>
    <td><?php echo $row["City"];?></td>
    <td><?php echo $row["State"];?></td>
    <td><?php echo $row["Zone"];?></td>
	<td> <a href="view.php?cmp=<?php echo $row["ATMID"]; ?>"  title="View" class="icon-1 info-tooltip">View</a></td>
    <td><?php echo $row["Panel_Make"];?></td>
	 <td><?php echo $row["OldPanelID"];?></td>
	<td><?php echo $row["NewPanelID"];?></td>
    <td><?php echo $row["DVRIP"];?></td>
    <td><?php echo $row["DVRName"];?></td>
    <td><?php echo $row["UserName"];?></td>
    <td><?php echo $row["Password"];?></td>
   <td> <a href="edit.php?atmid=<?php echo $row[0]; ?>"  title="Edit" class="icon-1 info-tooltip">Edit</a></td>
   
   
  </tr>
  
     
    <?php 
     
 }
    ?>
     </table>

	 </form>
<div>
 <?php 

if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></a></center> ";
}

if($Page!=$Num_Pages)
{
	echo "<center> <a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></a></center> ";
}
?>

</div>



	
</body>
</html>

<?php
}else
{ 
 header("location: index.php");
}
?>


