<?php ini_set( "display_errors", 0);
	
	include("access.php");
	
	
	// header('Location:managesite1.php?id='.$id); 
	 
	include("config.php");
	
	//$result1 = mysqli_query($con,"SELECT contact_first, short_name FROM contacts where type='c' order by short_name ASC");		
	//$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
	 ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Account</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="menu.css" rel="stylesheet" type="text/css" />
	<!--datepicker-->
	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	<script type="text/javascript">
function update(id)
{
	//alert(id);
	
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	
alert(xmlhttp.responseText);
if(xmlhttp.responseText=='1')
document.getElementById(id).innerHTML='Removed Successfully';
else
document.getElementById(id).innerHTML='Some Error Occurred';
	//document.getElementById(id).innerHTML=xmlhttp.responseText;
    }
  }
 
  //alert("updateqrypgme.php?id="+id);
xmlhttp.open("GET","updateqrypgme.php?id="+id,true);
xmlhttp.send();	
	
}
</script>
	
	</head>
	<body >
	<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?></center>
	<center>
	<form name="frm1" method="post" action="<?php $_SERVER['PHP-SELF']; ?>"  enctype="multipart/form-data" align="center">
	<h2 class="style1" align="center">View Account</h2>
	<table border="3" align="center" cellspacing="2" cellpadding="10">
	<tr>			<center>
				<th>Account Holder Name</th>
				<th>Account Name</th>
				 <th>Account No</th>
				<th>Bank</th>
				<th>Branch</th>
				<th>Edit</th>
				<th>Inactive</th>
				</tr>
				</center>
				<?php
				$qry=mysqli_query($con,"Select * from fundaccounts where status='0'");
				while($row=mysqli_fetch_row($qry))
					{
					
						
					?><tr>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[5]; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td> <?php echo $row[3]; ?></td>
					<td><?php echo $row[4]; ?></td>
			<td><a href="editaccountme.php?id=<?php echo $row[0]; ?>" target="_blank"><input type='button' name="edit" id="edit" value="Edit" style="font-weight:bold"/></td>
			<td id="<?php echo $row[0]; ?>"><input type='button' name="inactive" id="inactive" value="Inactive" style="font-weight:bold" onclick="update(<?php echo $row[0]; ?>);" /></td>
			
			<!--<td><u><a id="<?php echo $row[0]; ?>" onclick="update(<?php echo $row[0]; ?>);" >Inactive</a></u></td>-->
					</tr><?php
					}
					?>
				</table>
				
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
				</body>
				</html>
				
	
	
	
	
	
	
	
	