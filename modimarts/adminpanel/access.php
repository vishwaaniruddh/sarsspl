<?php
	if(!isset($_SESSION['SESS_USER_NAME']) || $_SESSION['designation']!="0") 
	{
		?>
		<script>
			 window.location.href='/adminpanel/';        
		</script>
		<?php
	}


?>