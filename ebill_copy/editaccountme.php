<?php ini_set( "display_errors", 0);
	
	include("access.php");
	
	
	// header('Location:managesite1.php?id='.$id); 
	 
	include("config.php");
	 $id=$_GET['id'];
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
	
	
	</head>
	<body >
	<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?></center>
	<center>
	<form name="frm1" method="post" action="<?php $_SERVER['PHP-SELF']; ?>"  enctype="multipart/form-data" align="center">
	<h2 class="style1" align="center">New Account</h2>
	<table border="3" align="center" cellspacing="2" cellpadding="10">
	<tr>
	<td>
	
	<b>Account Holder Name:</td><td> <?php
$qry2=mysqli_query($con,"select * from fundaccounts where aid='$id'");
$qry2row=mysqli_fetch_row($qry2);
//echo $qry2row[0];
?><input type="text" name="name" id="name" value="<?php echo $qry2row[1]; ?>" readonly>
	</td>
	</tr>
	
	<tr>
	<td>
	<b>Account Name: </td><td><input type="text" name="name1" id="name1" value="<?php echo $qry2row[5]; ?>">
	</td>
	</tr>
	
	<tr>
	<td>
	<b>Account No: </td><td><input type="text" name="accno" id="accno" value="<?php echo $qry2row[2]; ?>">
	</td>
	</tr>
	
	<tr>
	<td>
	<b>Bank: </td><td><input type="text" name="bnk" id="bnk" value="<?php echo $qry2row[3]; ?>">
	</td>
	</tr>
	
	<tr>
	<td>
	<b>Branch: </td><td><input type="text" name="brnch" id="brnch" value="<?php echo $qry2row[4]; ?>">
	</td>
	</tr>
	
	<tr>
	<td>
	<b>Ifsc Code: </td><td><input type="text" name="ifsc" id="ifsc" value="<?php echo $qry2row[12]; ?>">
	</td>
	</tr>
	
	<tr>
	<td colspan="2" align="center">
	<input type="submit" name="sub" id="sub" value="Edit" style="font-weight:bold" >
	</td>
	</tr>
	</table>
	</form>
	<?php
		include("config.php");
 			if(isset($_POST['sub']))
				 {
				 $name1=$_POST['name1'];
				  $name=$_POST['name'];
				$acntno=$_POST['accno'];
				$bank=$_POST['bnk'];
				 $brnch=$_POST['brnch'];
				 $ifsc=$_POST['ifsc'];
				 //echo "Update fundaccounts set hname='".$name."',accno='".$acntno."',bank='".$bank."',branch='".$brnch."' where aid='".$id."'";
				$qry=mysqli_query($con,"Update fundaccounts set hname='".$name."',accno='".$acntno."',bank='".$bank."',branch='".$brnch."',accountname='".$name1."',ifsc_code='".$ifsc."' where aid='".$id."'");
				 }
				 ?>
				 <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
	</body>
	</html>
	
	
	