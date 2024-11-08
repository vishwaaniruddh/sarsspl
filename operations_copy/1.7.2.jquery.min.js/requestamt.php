<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
//echo $_SESSION['custid'];
/*if($_SESSION['custid']=='all')
{
?>
<script type="text/javascript">
alert("You dont have access to this page.");
window.close();
</script>
<?php
}*/

define("ok","Fund Request Sent Successfully");
define("notok","Fund Request Failed");
//echo $_SESSION['user'];
//echo "user ".$_SESSION['userid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
function validate(form)
{
with(form)
{
if(bank.value=='')
{
alert("Please Select Bank");
bank.focus();
return false;
}
if(department.value=='')
{
alert("Please Enter Department");
department.focus();
return false;
}
if(amount.value=='')
{
alert("Please Enter Amount");
amount.focus();
return false;
}
if(amount.value<='0')
{
alert("Please Enter Valid Amount");
amount.focus();
return false;
}
if(memo.value=='')
{
alert("Please Enter Description for usage of this amount");
amount.focus();
return false;
}
return true;
}
}
</script>

</head><body>

<center>
<?php include("menubar.php"); ?>
<h2>Request for Fund</h2>
<?php
if(isset($_SESSION['success']))
echo "<div style='background: lightgreen'><h3>". ok."</h3></div>";
if(isset($_SESSION['error']))
echo "<div style='background:#FF0000'><h3>". notok."</h3></div>";
?>
<form name="requestamt" method="post" action="processreqamt.php" onSubmit="return validate(this)">

<table>
	<tr>
    	<td>Select Bank</td>
        <td>
        <?php
		include("config.php");
		$qry=mysqli_query($con,"select short_name, contact_first from contacts where type='c' order by contact_first ASC");
		?>
        	<select name="bank" id="bank"><option value="">SELECT BANK</option>
            	<?php
			while($cl=mysqli_fetch_array($qry))
			{
			?>
            <option value="<?php  echo $cl[0]; ?>"><?php  echo $cl[1]; ?></option>
            <?php
			}	
				?>
            </select>
        </td>
    </tr>
   <tr>
    	<td>Select Type</td>
        <td>
        <?php
		//echo "select `deptid`, `desc` from department where deptid<>'1' AND deptid<>'4'";
		$tp=mysqli_query($con,"select `deptid`, `desc` from department where deptid='2' OR deptid='3'");
			if(!$tp)
			echo mysqli_error();
		?>
        <select name="department" id="department"><option value="">Select Concerned Department</option>
        	<?php
			
			while($tpro=mysqli_fetch_array($tp))
			{
			?>
            <option value="<?php echo $tpro[0]; ?>"><?php echo $tpro[1]; ?></option>
            <?php
			}
			?>
           </select>
        </td>
    </tr>
    <tr>
    	<td>Amount</td>
        <td>
        	<input type="text" name="amount" id="amount" value="0">
           
        </td>
    </tr>
    <tr>
    	<td>Memo</td>
        <td>
        	<textarea name="memo" id="memo" rows="10" cols="30"></textarea>
        </td>
    </tr>
     <tr>
    	<td colspan="2" align="center">
        	<input type="submit" name="submit" id="submit"><!--<a href="javascript:if(confirm('Close window?'))window.close()">cancel</a>-->
        </td>
    </tr>
</table>
</form></center><?php
unset($_SESSION['success']);
unset($_SESSION['error']);

?>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body></html>