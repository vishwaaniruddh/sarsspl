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
            


$abc="SELECT  a.Material,a.Model,a.Vendor,a.qty,a.City,a.loc,a.address,a.remark,a.entrydate,b.id,b.srno,b.Status FROM faulty a,`faulty_details` b WHERE (a.fid=b.faulty_id)";


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
    <th>Material</th>
    <th>Model</th>
    <th>Vendor</th>
      <th>qty</th>
    <th>City</th>
    <th>loc</th>
    <th>address</th>
      <th>remark</th>
    <th>entrydate</th>
    <th>srno</th>
    <th>Status</th>
    <!--<th>Edit</th>
    <th>View</th>-->
       
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) {
 
$modd=mysqli_query($conn,"select * from model_no where material_id='".$row['Model']."'");
       $fetchmod= mysqli_fetch_array($modd);
 ?>


 <tr>
    <td><?php echo $sr;?></td>
    <td><?php echo $row["Material"];?></td>
    <td><?php echo $fetchmod["modelno"];?></td>
    <td><?php echo $row["Vendor"];?></td>
    <td><?php echo $row["qty"];?></td>
    <td><?php echo $row["City"];?></td>
    <td><?php echo $row["loc"];?></td>
    <td><?php echo $row["address"];?></td>
    <td><?php echo $row["remark"];?></td>
    <td><?php echo $row["entrydate"];?></td>
    <td><?php echo $row["srno"];?></td>
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
