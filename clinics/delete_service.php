<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service List</title>
</head>

<body>
</body>
</html><?php

include 'config.php' ;



try{

  		$id = $_GET['id'];

		$sql = "delete from service_master where `id`='".$id."'";

		$result = mysqli_query($con,$sql);

		if($result)

		{	

		 header('Location:view_services.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

