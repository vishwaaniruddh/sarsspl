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
	<script>
	/*function validate()
	{
	alert("hi");
		if(name.value=='')
		{
		alert("Please Enter Name");
		name.focus();
		return false;
		}
		return true;
	}*/
	</script>
	
	</head>
	<body >
	<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?></center>
	<center>
	<form name="frm1" method="post" action="<?php $_SERVER['PHP-SELF']; ?>" enctype="multipart/form-data" align="center">
	<h2 class="style1" align="center">New Account</h2>
	<table border="3" align="center" cellspacing="2" cellpadding="10">
	<tr>
	<td>
	<b>Account Holder Name:</td><td> <input type="text" name="name" id="name">
	</td>
	</tr>
	
	<tr>
	<td>
	<b>Account Name:</td><td> <input type="text" name="name1" id="name1">
	</td>
	</tr>
	
	<tr>
	<td>
	<b>Account No: </td><td><input type="text" name="accno" id="accno">
	</td>
	</tr>
	
	<tr>
	<td>
	<b>Bank: </td><td><input type="text" name="bnk" id="bnk">
	</td>
	</tr>
	
	<tr>
	<td>
	<b>Branch: </td><td><input type="text" name="brnch" id="brnch">
	</td>
	</tr>

         <tr>
	<td>
	<b>IFSC Code: </td><td><input type="text" name="ifsc" id="ifsc">
	</td>
	</tr>
     
	<tr>
	<td>
	<b>Branch: </td><td><select name="type" id="type">
	<option value="personal">personal</option>
	
	<option value="css">css</option>
	<option value="direct">direct</option>
	</select>
	</td>
	</tr>
	<tr>
	<td>
	<b>Service: </td><td><input type="checkbox" name="ebill" id="ebill" checked> EBILL <br><input type="checkbox" name="rnm" id="rnm" checked> RNM
	</td>
	</tr>
	<tr>
	<td colspan="2" align="center">
	<input type="submit" name="sub" id="sub" value="ADD" style="font-weight:bold" >
	</td>
	</tr>
	</table>
	</form>
	<?php
		include("config.php");
 			if(isset($_POST['sub']))
				 {
				 
				  $name=$_POST['name'];
				  $name1=$_POST['name1'];
				$acntno=$_POST['accno'];
				$bank=$_POST['bnk'];
				 $brnch=$_POST['brnch'];
				 $type=$_POST['type'];
                                 $ifsc=$_POST['ifsc'];
				if($name!='' && $name1!='' && $acntno!='' && $bank!='' && $brnch!=''){
				$stat=0;
				$stat2=0;
				
				 if(isset($_POST['ebill'])){
				$qry=mysqli_query($con,"Insert into fundaccounts(hname,accno,bank,branch,accountname,status,type,ifsc_code)values('".$name."','".$acntno."','".$bank."','".$brnch."','".$name1."','0','".$type."','".$ifsc."')");
				if(!$qry){
			$stat=1;
			echo "Error for EBill Fund Account ";mysqli_error();
			}
			else
			echo "EBill fund Account added Succesfully";
				}
				if(isset($_POST['rnm'])){
				$qry2=mysqli_query($con,"Insert into rnmfundaccounts(hname,accno,bank,branch,accountname,status,type)values('".$name."','".$acntno."','".$bank."','".$brnch."','".$name1."','0','".$type."')");
				if(!$qry2){
			$stat2=1;
			echo "<br>Error for RNM Fund Account ".mysqli_error();
			}
			else
			echo "<br>EBill fund Account added Succesfully";
				}
				
				}
				else{
				echo "All fields are compulsory";
				}
				//if($stat==0 && $stat2==0)
				//echo "<script type='text/javascript'>alert('Entry Added Successfully');window.location='newaccountme.php';</script>'>";
				 }
				 ?>
				 <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
	</body>
	</html>
	
	
	