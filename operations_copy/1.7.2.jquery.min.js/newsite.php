<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
//////////////////////////////site type function

function validate(form){
 with(form)
 {

if(cust.value=="0")
{
	alert("Please Select Customer Name.");
	cust.focus();
	return false;
}
if(userfile.value.length < 1)
{
    alert("You Forgot to select an *.xls File to Import");
     return false;
}
 
 return true;
 }
 
  }


</script>

</head>

<body>
<center>
<?php include("menubar.php");
include("config.php"); ?>

<h2>Add New Site</h2>
<div id="header">

<form id="form1" name="form1" method="post" action="processnewsiteup.php" onsubmit="return validate(this)" enctype="multipart/form-data" >
 <table width="518" border="1" align="center" cellpadding="4" cellspacing="0">
 
  <?php

	
		 $sql = "SELECT short_name, contact_first FROM contacts where short_name='".$_SESSION['custid']."' and type='c'";
		$result = mysqli_query($con,$sql);
		$cust=mysqli_fetch_row($result);
		
		?>
		<input type="hidden" name="cust" value="<?php echo $_SESSION['custid']; ?>">
		<tr><td colspan="2" align="center"><h2><font color="#FF0000">*</font> marked fields are compulsory in your Excel sheet</h2></td>
       <tr><td>Customer</td><td align="left"><input type="text" name="custname" value="<?php echo $cust[1]; ?>" readonly="readonly" />
        <!-- <select name="cust" id="cust"><option value="">-Select Customer-</option>
        <?php
		while($cust=mysqli_fetch_array($result))
		{
		?>
        <option value="<?php echo $cust[0]; ?>"><?php echo $cust[1]; ?></option>
        <?php
		}
	?></select>--></td></tr>
   <tr>
    <td> Project ID</td>
    <td><div align="left">
    <input type="text" name="project" id="project" /> 
    </div></td>
  </tr> 

  <tr>
    <td><div align="center">Import .xls file </div></td>
    <td><div align="center"><input type="file" name="userfile" id="userfile" />
    </div></td>
  </tr>
  <tr><td colspan="2"><b>Format:</b> 	Caretaker,	Housekeeping,	Maintainence, Ebill, Bank, csslocalbranch, ATM_Id1<font color="#FF0000">*</font>, Site_Id, Site type,	Site Address<font color="#FF0000">*</font>, State<font color="#FF0000">*</font>,Region, City<font color="#FF0000">*</font>,Location, Zone<font color="#FF0000">*</font>,	CSSLocalSupervisorName,	CSSLocalSupervisorNumber,Takeover_date (dd/md/yyyy), Remarks

</td></tr>
  
  <tr>
    <td colspan="2" align="center">
    
    <input type="submit" value="submit" /></td>
  </tr>
</table>

</form>

</div>

</center>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>