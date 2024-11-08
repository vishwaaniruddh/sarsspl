<?php
 session_start();
 
if(!isset($_SESSION['user']) && !isset($_SESSION['branch']) && !isset($_SESSION['designation']) && !isset($_SESSION['dept']) && !isset($_SESSION['serviceauth']))
{
session_destroy();
?>
	<script type="text/javascript">
	alert("Sorry, Your Session has Expired, You need to login again");
	window.location="index.php";
	</script>
	<?php
	header("location:index.php");
	
}
	
?>