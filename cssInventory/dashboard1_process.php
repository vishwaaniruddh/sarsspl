<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<?php
include 'config.php';
$oit=$_POST['oit'];
$fix='50';


$sql=" SELECT DISTINCT(material) from enventory_Stock where 1";

$result=mysqli_query($conn,$sql);
$Num_Rows=mysqli_num_rows($result);
// $sr='1';
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
	// echo "ram".($Page_Start* $Page)-$Page_Start;
	   // echo $fix."-".$Page."-".$fix;
	//   $sr=($Page_Start* $Page)-$Page_Start;
	  $sr=($fix* $Page)-$fix;
	  
	   $sr=$sr+1;
	}
 
?>
<div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b></div>

<table id="stock_in" border="1" style="width: 602px;margin-left: 372px;margin-right: 0px;margin-bottom: 0px;margin-top: ‒10;margin-top: -15;" align="center";>
&nbsp;
  <tr>
      <th>sr no</th>
    <th>material</th>
    <th>Stock In</th>
    <th>Stock Available</th>
    <th>Stock Out</th>
   
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) {
 $abc="select count(material) FROM enventory_Stock where material='".$row[0]."'";
 $result1=mysqli_query($conn,$abc);
 $rows=mysqli_fetch_array($result1);
 
 $abc2="select count(material) FROM enventory_Stock where material='".$row[0]."'and Status='Active' ";
 $result2=mysqli_query($conn,$abc2);
 $rows2=mysqli_fetch_array($result2);
 
 $abc3="select count(material) FROM enventory_Stock where material='".$row[0]."'and Status='L' ";
 $result3=mysqli_query($conn,$abc3);
 $rows3=mysqli_fetch_array($result3);

 ?>
<tr>
    <td><?php echo $sr;?></td>
    <td><?php echo $row["material"];?></td>
    <td><?php echo $rows[0];?></td>
    <td><?php echo $rows2[0];?></td>
    <td><?php echo $rows3[0];?></td>
   
  </tr>
  
     
    <?php 
  $sr++;   
 }
    ?>
     </table>  

<br /><br /><br />

<?php 
 
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:search('$Prev_Page','perpg')\"> << Back></center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:search('$Next_Page','perpg')\">Next >></center></a> ";
}

?>
<?php
}else
{ 
 header("location: login.php");
 
}

?>

