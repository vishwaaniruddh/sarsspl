<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired, Please login & continue');window.close();</script>";
}
else{
include("config.php");
if(!isset($_GET['tid']) && !isset($_GET['chqno']) && $_GET['tid']=='' && $_GET['chqno']=='')
echo "<script type='text/javascript'>window.close();</script>";

$tid=$_GET['tid'];
$chqno=$_GET['chqno'];
?>
<html>
<head><title><?php echo $_SESSION['user'] ?></title>
<script type="text/javascript">
function validate(form)
{
with(form)
{
alert("hi");
if(newchq.value=='')
{
alert("Please Enter new cheque number");
return false;
}

}
return true;
}
</script>
</head>
</body>
<?php
if(isset($_POST['cmdsub']))
{

if($_POST['newchq']!='' && $_POST['newchq']!='0' && strlen($_POST['newchq'])=='6' && $_POST['rem']!='')
{
//echo $_POST['newchq'];
//echo "update ebfundtransfers set chqno='".$_POST['newchq']."' where tid='".$_POST['trans']."'";
$tr=mysqli_query($con,"update ebfundtransfers set chqno='".$_POST['newchq']."' where tid='".$_POST['trans']."'");
if($tr)
{
$chk=mysqli_query($con,"update ebillfundrequests set chqno='".$_POST['newchq']."' where chqno='".$_POST['oldchq']."'");
if($chk)
{
$dt=date('Y-m-d H:i:s');
$st=str_replace("'","\'",$_POST['rem']);
$rem=mysqli_query($con,"INSERT INTO `ebchqchnge` (`id`, `tid`, `olchqno`, `newchqno`, `updtby`, `updt`, `remark`, `status`) VALUES (NULL, '".$_POST['trans']."', '".$_POST['oldchq']."', '".$_POST['newchq']."', '".$_SESSION['user']."', '".$dt."', '".$st."', '0')");
echo "<script type='text/javascript'>alert('Cheque Changed Successfully, Please Reload to see the changes'); window.close();</script>";
}
else
{
$tr2=mysqli_query($con,"update ebfundtransfers set chqno='".$_POST['oldchq']."' where tid='".$_POST['trans']."'");
echo "Some Error Occurred";
}
}
else
echo "Some Error Occurred";
}
else
echo "Invalid Data";

}
?>
<h2>Edit Cheque Number</h2><br>
<font color="red">*</font</sup> marked fields are compulsory
<form name=frm method="post" action="<?php $_SERVER['PHP_SELF'] ?>" id="frm" onsubmit="validate(this.id);">
<table>
<tr><td>Transaction ID</td><td><input type="hidden" name="trans" value="<?php echo $tid; ?>"><?php echo $tid; ?></td></tr>
<tr><td>Cheque no</td><td><input type="hidden" name="oldchq" value="<?php echo $chqno; ?>"><?php echo $chqno; ?></td></tr>
<tr><td>New Cheque no<sup><font color="red">*</font</sup></td><td><input type="text" name="newchq" id="newchq" value=""></td></tr>
<tr><td>Remark<sup><font color="red">*</font</sup></td><td><textarea name="rem" id="rem"></textarea></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="cmdsub" value="Submit"><input type="button" name="cmdcanc" value="Cancel" onclick="javascript:window.close();"></td></tr>
</table>
</form>
</body>
</html>
<?php
}

?>