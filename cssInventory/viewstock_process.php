<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';
$fix=10;
$strPage=$_POST['Page'];
$sr_no=$_POST['srno'];
$vender=$_POST['vender'];
$modelno=$_POST['modelno'];
date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');
$from=$_POST['fromdt'];
$to=$_POST['todt'];

$fromdt = date("Y-m-d", strtotime($from));
$todt = date("Y-m-d", strtotime($to)); 


$query="select a.vendorname,a.material,a.modelno,a.entrydate,b.srno,b.Status,b.id from  Inventory_IN a,enventory_Stock b where (b.InventoryIN=a.id) and Status='Active'";
//echo $query;
	if($vender!="")
			{
			    
			    $query.= " and a.vendorname like '".$vender."%'";
			}
			
			if($sr_no!="")
			{
			    
			    $query.= " and b.srno like '".$sr_no."%'";
			}
					if($modelno!="")
			{
                                   $query.= " and a.modelno like '".$modelno."%'";
                                 }
                                 
if($from!="" && $to!="" ){
$query.=" and a.entrydate between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
}			
                                 
			    	
$result=mysqli_query($conn,$query);
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

$query.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$query);

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
      <th>Index</th>
      <th>sr no</th>
    <th>model no</th>
    <th>material</th>
    <!--<th>company name</th>-->
      <th>vendor name</th>
    <th>Status</th>
    <th>date</th>
    <th>delete</th>
       
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) { ?>


 <tr>
     <td><?php echo $sr;?></td>
    <td><?php echo $row["srno"];?></td>
    <td><?php echo $row["modelno"];?></td>
    <td><?php echo $row["material"];?></td>
    <!--<td><?php echo $row["companyname"];?></td>-->
    <td><?php echo $row["vendorname"];?></td>
    <td><?php echo $row["Status"];?></td>
    <td><?php echo $row["entrydate"];?></td>
   <td><a href="Delete_stock_in.php?srno=<?php echo $row["srno"];?> ">&nbsp;<font color="red" >Delete</font></a></td>
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