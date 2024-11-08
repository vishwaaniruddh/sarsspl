<html>
 <? 

include('../../config.php'); 
   error_reporting(0); 

$sql="INSERT INTO total_promotions (right_image)

VALUES

('$_GET[rimage]')";

 

if (!mysql_query($sql,$con))

  {

  die('Error: ' . mysql_error());

  }

echo "1 record added";

?>
<body>
    
<form action="insert.php" method="get">

Right Image: <input type="text" name="rimage" />

<input type="submit" />

</form>

</body>

</html>