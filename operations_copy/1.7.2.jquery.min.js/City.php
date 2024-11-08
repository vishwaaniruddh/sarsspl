<?php 
include("access.php");
?>
<?php
include("config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" >
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>	
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" >
<script type="text/javascript" src="jquery-1.3.2.js"></script>
	
	<Script>
		function SUBFUNC()
		{
		 //var State=document.getElementById('State').value;
		 var City=document.getElementById('City').value;
		 //alert(City);
		 $.ajax({
            type: "POST",
            url: "processcity_add.php",
            data: 'City='+City,
			success: function(msg){
         
                 
             alert(msg);
             window.open('City.php','_self');
                   
                 
            },
            error: function (request, status, error) {
        alert(request.responseText);
    }
        });
		}
</script>
	</head>
	<body>
	<center>
	<?php include("menubar.php"); ?>
	<h2>Add City</h2>
		
		<form method="post" >
			<table border="1" align="center" cellpadding='10'>
				<tr>
					<td>City :</td>
					<td>
						<input type="text" Id="City" required>
					</td>
				</tr>
				
				
				<tr>
					<td colspan="2" align="center">
						<input type="button" name="submit" id="submit"  value="Submit" onclick='SUBFUNC();'>
						<input type="reset" name="reset" value="Reset">
					</td>
				</tr>
		</form>
		</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>	
	</body>
</html>