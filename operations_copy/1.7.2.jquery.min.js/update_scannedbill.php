<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has Expired'); window.close();</script>";
}
else
{
$reqno=$_GET['reqid'];
?>
<input type="button" onclick="javascript:window.close();" value="Close Window"><br/>
<img src="http://cssmumbai.sarmicrosystems.com/operations/updatereceipt_scncpy/<?php echo $reqno; ?>">
<?php
}

?>