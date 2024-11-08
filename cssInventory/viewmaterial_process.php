<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

$fix=10;
$strPage=$_POST['Page'];

$oit=$_POST['oit'];
date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');
$from=$_POST['fromdt'];
$to=$_POST['todt'];

$fromdt = date("Y-m-d", strtotime($from));
$todt = date("Y-m-d", strtotime($to)); 



$sql="select a.Name,a.entrydate,b.modelno  from material a, model_no b where (a.id=b.material_id)";
$strPage=$_POST['Page'];
	if($oit!="")
			{
			    
			    $sql.= " and iout like '".$oit."%'";
			}
					
if($from!="" && $to!="" ){
$sql.=" and entrydate between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
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
	    
	   //$sr=($Page_Start* $Page)-$Page_Start;
	   $sr=($fix* $Page)-$fix;
	   
	   $sr=$sr+1;
	}

?>
<html>
<head>

</head>
<div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b></div>
<body>
<Form>
<table  border=1>
&nbsp;
  <tr>
      <th>sr no</th>
    <th>Name</th>
   
    <th>model</th>
      <th> entrydate </th>
   
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) { ?>


 <tr>
    <td><?php echo $sr;?></td>
    <td><?php echo $row["Name"];?></td>
    
    <td><?php echo $row["modelno"];?></td>
    <td><?php echo $row["entrydate"];?></td>
   
  </tr>
  
     
    <?php 
  $sr++;   
 }
    ?>
     </table>  

   
 <?php 
 /*
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:search('$Prev_Page','perpg')\"> << Back></a></center> ";
}

if($Page!=$Num_Pages)
{
	echo "<center> <a href=\"JavaScript:search('$Next_Page','perpg')\">Next >></a></center> ";
}
*/

if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:search('$Prev_Page','perpg')\"> << Back></center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:search('$Next_Page','perpg')\">Next >></center></a> ";
}
?>
</form>


</body>
</html>
<?php
}else
{ 
 header("location: login.php");
}
?>

