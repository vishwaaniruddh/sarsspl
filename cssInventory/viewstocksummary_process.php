<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';
$fix=1000;
$strPage=$_POST['Page'];

$oit=$_POST['oit'];
date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');
$from=$_POST['fromdt'];
$to=$_POST['todt'];
$ATMID=$_POST['ATMID'];
$Handover=$_POST['Handover'];

$fromdt = date("Y-m-d", strtotime($from));
$todt = date("Y-m-d", strtotime($to)); 

$sql="select * from enventory_Transfer_log where 1=1";
//echo $sql;
	if($oit!="")
			{
			    
			    $sql.= " and srno like '".$oit."%'";
			}
if($from!="" && $to!="" ){
$sql.=" and date between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
}			
			
if($ATMID!="")
			{
			    
			    $sql.= " and ATMID like '".$ATMID."%'";
			}
			
if($Handover!="")
			{
			    
			    $sql.= " and Handover like '".$Handover."%'";
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
$sql.=" order by log_id asc";
$sql.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$sql);

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
      <th>No.</th>
      <th>Vendor</th>
      <th>Model</th>
      <th>Material</th>
    <th>SRNO</th>
    <!--<th>qty</th>-->
    <th>address</th>
    <th>City</th>
    <th>loc</th>
    <th>Handover</th>
    <th>Atm Id</th>
    <th>Entry_date</th>
    <th>PO Number</th>
    <!--<th>Install</th>-->
    <th>Sitename</th>
    <th>Status</th>
    <th>return_eng_name</th>
    
    <!--<th>View</th>-->
       
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) { ?>


 <tr>
    <td><?php echo $sr;?></td>
    <td><?php echo $row["Vendor"];?></td>
    <td><?php echo $row["Model"];?></td>
    <td><?php echo $row["material"];?></td>
    <td><?php echo $row["srno"];?></td>
   <!-- <td><?php echo $row["qty"];?></td>-->
    <td><?php echo $row["address"];?></td>
    <td><?php echo $row["City"];?></td>
    <td><?php echo $row["loc"];?></td>
    <td><?php echo $row["Handover"];?></td>
    <td><?php echo $row["ATMID"];?></td>
    <td><?php echo $row["date"];?></td>
    <td><?php echo $row["PO_Number"];?></td>
   <!-- <td><?php echo $row["Install"];?></td>-->
    <td><?php echo $row["Sitename"];?></td>
    <td><?php echo $row["Status"];?></td>
    <td><?php echo $row["return_eng_name"];?></td>
    
 
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
