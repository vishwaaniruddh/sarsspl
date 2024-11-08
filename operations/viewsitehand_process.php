<?php
include 'config.php';
$sql="select * from surveilance_sites  where 1";

//echo $sql;
/*
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
*/
    $result=mysqli_query($con,$sql);
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
	
$qrys=mysqli_query($con,$sql);
//echo $qrys;
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



	

<html><head>
 
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
th{
	padding:10px;
	background-color:#d20000; 
	color:#fff;
	font-size:12px;
}
</style>
</head>
<body>


<center><div>total records:<?php echo $Num_Rows?></div></center>
  <table border=1 style="margin-top:30px">
  <tr>
      <th>SN</th>
   
    <th>Customer</th>
      <th>Bank</th>
       <th>ATMID</th>
	  
       <th>ATMShortName</th>
	   <th>SiteAddress</th>
    <th>City</th>
    <th>State</th>
      <th>Zone</th>
	 
       <th>Panel_Make</th>
	   <th>OldPanelID</th>
	   <th>NewPanelID</th>
     <th>DVRIP</th>
    <th>DVRName</th>
    <th>Live</th>
    <th>site handover</th>
    <th>Site over </th>
    <th>Update</th>
    
  </tr>
 <?php  
 $sno='1';
 while($row = mysqli_fetch_array($qrys)) { ?>

 <tr style="background-color:white">
     
    <td><?php echo $sno;?></td>
  
   
    <td><?php echo $row["Customer"];?></td>
    <td><?php echo $row["Bank"];?></td>
    <td><?php echo $row["ATMID"];?></td>
	
    <td><?php echo $row["ATMShortName"];?></td>
	<td><?php echo $row["SiteAddress"];?></td>
    <td><?php echo $row["City"];?></td>
    <td><?php echo $row["State"];?></td>
    <td><?php echo $row["Zone"];?></td>

	<td><?php echo $row["Panel_Make"];?></td>
	 <td><?php echo $row["OldPanelID"];?></td>
	<td><?php echo $row["NewPanelID"];?></td>
    <td><?php echo $row["DVRIP"];?></td>
    <td><?php echo $row["DVRName"];?></td>
    <td><?php echo $row["live"];?></td>
    <td><?php echo $row['takeover'];?></td>
    <td><?php echo $row['handover'];?></td>
    <?php
    if($row["live"]!='N'){
    ?>
 <td> <a onclick="window.open('updatehandsite.php?atmid=<?php echo $row[0]; ?>','_blank', 'location=yes,height=400,width=600,left=400,scrollbars=yes,status=yes');" style="color: red;">Update</a></td>
 <?php }?>
  <!--<td><a onclick="window.open('view.php?cmp=<?php echo $row[5];?>', '_blank', 'location=yes,height=400,width=600,left=400,scrollbars=yes,status=yes');" style="color: red;">view</a></td>-->

  </tr>
  
     
    <?php 
    $sno++; 
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