<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';


$oit=$_POST['oit'];
$vid=$_POST['vid'];

$sql="select * from InventoryOUT_Stock where Inventory_OUT='".$vid."'";

	if($oit!="")
			{
			    
			    $sql.= " and Inventory_OUT like '".$oit."%'";
			}
					
	$sql;		    	
$result=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($result);
$sr=1;
$strPage=$_POST['Page'];
$fix=20;
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

	//$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	    
	   $sr=($fix* $Page)-$fix;
	   
	   $sr=$sr=+1;
	}

?>

<table  border=1>
&nbsp;
  <tr>
      <th>sr no</th>
      <th>srno</th>
    <th>Material</th>
    <th>Status</th>
    <th> entrydate </th>
      <!--<th>Faulty</th>-->
    
       
  </tr>
 <?php  while($row = mysqli_fetch_array($result)) { ?>


 <tr>
    <td><?php echo $sr;?></td>
    <td><?php echo $row["srno"];?></td>
    <td><?php echo $row["Material"];?></td>
    <td><?php echo $row["Status"];?></td>
    <td><?php echo $row["entrydate"];?></td>
   <?php 
   if($row["Status"]=='L')
   {?>
   <!--<td><a href="faulty_stock_out.php?id=<?php // echo $row["id"];?> ">&nbsp;<font color="red" >Faulty</font></a></td>-->
<?php
}?>
  </tr>
  
     
    <?php 
  $sr++;   
 }
    ?>
     </table>  
<div>
   
 <?php 
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:search('$Prev_Page','perpg')\"> << Back></a></center> ";
}

if($Page!=$Num_Pages)
{
	echo "<center> <a href=\"JavaScript:search('$Next_Page','perpg')\">Next >></a></center> ";
}
?>

</div>
<?php
}else
{ 
 header("location: login.php");
}
?>
