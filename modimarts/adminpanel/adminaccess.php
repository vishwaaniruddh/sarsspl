
<?php
session_start();

	if(!isset($_SESSION['SESS_USER_NAME']) & ($_SESSION['designation']!="0" & $_SESSION['designation']!="1")) 
	
	{
		?>
		<script>
			 window.location.href='/adminpanel/index.php';        
		</script>
		<?php
	}


?>