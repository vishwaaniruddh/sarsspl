<?php
include("access.php");
if(isset($_REQUEST['Page']))
$strPage = $_REQUEST['Page'];
else
$strPage=1;
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Branch Heads</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_cityhead.php?id="+id;
	}
	
}
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>

<h2>View Branch Head</h2>
<div id="header" >



<?php
$count=0;
include("config.php");

$sql="Select * from branch_head where status=1";
$table=mysqli_query($con,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
########### pagins

$Per_Page =10;   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
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
$sql.=" order by loginid DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con,$sql);
if(mysqli_num_rows($table)>0)
{
?>
<table width="613" border="0" cellpadding="1" cellspacing="0" class="res">
<tr><th width="128">Name</th>
<!--<th width="128">UserId</th>
<th width="128">Password</th>-->
<th width="123">Branch</th>
<th width="137">Email</th>
<th width="85">Contact</th>
<th width="46">Add Branch</th>
<th width="46">Edit</th>
<th width="56">Delete</th></tr>
<?php
while($row=mysqli_fetch_row($table))
{
$state=array();
//echo "select * from branch_details where branchid='".$row[1]."'";
$qry2=mysqli_query($con,"select * from branch_details where branchid='".$row[1]."'");
$row3=mysqli_fetch_row($qry2);
$qry4=mysqli_query($con,"select * from login where srno='".$row[6]."'");
$row4=mysqli_fetch_row($qry4);

$br1=str_replace(",","','",$row4[3]);
$br1="'".$br1."'";
//echo "select state_id,state from state where state_id IN ($br1)";
//echo "select state_id,state from state where state_id NOT IN ($br1)";	
$qry=mysqli_query($con,"select id,location from cssbranch where id IN ($br1)");

while($row2=mysqli_fetch_row($qry))
{
$state[]=$row2[1];
}	

$count=$count+1;
?>

<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row[2]; ?></td>
<!--<td><?php echo $row4[1]; ?></td>
<td><?php echo $row4[2]; ?></td>-->
<td ><?php echo implode(",",$state); ?></td>
<td ><?php echo $row[3]; ?></td>
<td ><?php echo $row[4]; ?></td>
<td width="46" class="update" height="31"> <a href='addbranch.php?id=<?php echo $row[0]; ?>&hid=<?php echo $row[6];  ?>'> Add Branch </a></td>
<td width="46" class="update" height="31"> <a href='edit_cityhead.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
<td width="56" height="31" class="update">  <a href="javascript:confirm_delete(<?php echo $row[0]; ?>);"> Delete </a></td>
</tr>
<?php } 
?>
<tr><td colspan="9" align="center">
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<?php
if($Prev_Page) 
{
	echo " <a href=\"view_cityhead.php?Page=$Prev_Page\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"view_cityhead.php?Page=$Next_Page\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?></font></div></td></tr></table>
<?php
}
?>

</div>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>