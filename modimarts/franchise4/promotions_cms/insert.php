<html>
 <? 


include('../../config.php'); 
   error_reporting(0); 
   
   
$sql="INSERT INTO total_promotions (right_image) VALUES ('$_POST[image1]')";

 

if (!mysql_query($sql,$con))

  {

  die('Error: ' . mysql_error());

  }

echo "1 record added";

?>
<body>
    
<form action="insert.php" method="POST">

Right Image: <input type="text" name="rimage" />

<input type="submit" />

</form>

</body>

</html>