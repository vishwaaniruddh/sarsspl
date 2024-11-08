<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

$fix=10;
$strPage=$_POST['Page'];

date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');

$oit=$_POST['oit'];
$from=$_POST['fromdt'];
$to=$_POST['todt'];


$fromdt = date("Y-m-d", strtotime($from));
$todt = date("Y-m-d", strtotime($to));            
            


$abc="SELECT  a.Status,b.Description,b.Qty,b.Perrate,b.Gst,b.Total FROM po_in a,`po` b WHERE (a.id=b.po_in_id)";


	if($oit!="")
			{
			    
			    $abc.= " and iout like '".$oit."%'";
			}

if($from!="" && $to!="" ){
$abc.=" and a.entrydate between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
}

$result=mysqli_query($conn,$abc);
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

$abc.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$abc);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	    
	   //$sr=($Page_Start* $Page)-$Page_Start;
	   $sr=($fix* $Page)-$fix;
	   
	   $sr=$sr+1;
	}
?>

    <center><div>total records:<?php echo $Num_Rows?></div></center>
<table  border=1>
&nbsp;
  <tr>
      <th>sr no</th>
    <th>Description</th>
    <th>Qty</th>
    <th>Perrate</th>
      <th>Gst</th>
    <th>Total</th>
    <th>entrydate</th>
    <th>Status</th>
     
    <th>Edit</th>
    <th>View</th>
       
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) { ?>


 <tr>
    <td><?php echo $sr;?></td>
    <td><?php echo $row["Description"];?></td>
    <td><?php echo $row["Qty"];?></td>
    <td><?php echo $row["Perrate"];?></td>
    <td><?php echo $row["Gst"];?></td>
    <td><?php echo $row["Total"];?></td>
    <td><?php echo $row["entrydate"];?></td>
    <td><?php echo $row["Status"];?></td>
  
   <!--<td><a href="Edit_stock_out.php?srno=<?php echo $row["iout"];?> ">&nbsp;<font color="red" >Edit</font></a></td>
   <td><a href="view_stock_out.php?srno=<?php echo $row["iout"];?> ">&nbsp;<font color="green" >View</font></a></td>-->
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
