<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';
include 'config.php';
$fix=10;
$strPage=$_POST['Page'];
$Handover=$_POST['Handover'];
$City=$_POST['City'];
date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');
$from=$_POST['fromdt'];
$to=$_POST['todt'];

$fromdt = date("Y-m-d", strtotime($from));
$todt = date("Y-m-d", strtotime($to)); 


$query="select * from handover_person where 1";

	if($Handover!="")
			{
			    
			    $query.= " and Handover like '".$Handover."%'";
			}
					if($City!="")
			{
                                   $query.= " and City like '".$City."%'";
                                 }
			    	
			    	if($from!="" && $to!="" ){
$query.=" and date between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
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
      <th> sr </th>
    <th> Handover Person Name </th>
    <th>City</th>
     <th>Date</th>
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) { ?>
 <tr>
     <td><?php echo $sr;?></td>
    <td><?php echo $row["Handover"];?></td>
    <td><?php echo $row["City"];?></td>
    <td><?php echo $row["date"];?></td>
    
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