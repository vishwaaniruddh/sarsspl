<?php 
// date_default_timezone_set('Asia/Kolkata');
// $host="localhost";
// $user="allmart_sarmicro";
// $pass="SARsar@@2020";
// $dbname="allmart_web";
// $con = new mysqli($host, $user, $pass, $dbname);
// // Check connection
// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// } else {
// // echo "Connected succesfull";
   
// }

// $con1=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_ecommerce");
// $con3=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_web");

date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="allmart_sarmicro";
$pass="SARsar@@2020";
$dbname="allmart_web";
$conn = new mysqli($host, $user, $pass, $dbname);
		
		// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $con->connect_error);
		}
		
		// Taking all 5 values from the form data(input)
		$name = $_REQUEST['name'];
		$address = $_REQUEST['address'];
		$content = $_REQUEST['content'];
		$image = $_REQUEST['image'];
		$logo = $_REQUEST['logo'];
		$status = $_REQUEST['status'];
		
		// Performing insert query execution
		// here our table name is college
		$sql = "INSERT INTO 'customer_promotion`(`id`, `name`, `address`, `content`, `logo`, `image`, `status`)";
		
		if(mysqli_query($conn, $sql)){
			echo "<h3>data stored in a database successfully."
				. " Please browse your localhost php my admin"
				. " to view the updated data</h3>";

			echo nl2br("\n$name\n $address\n "
				. "$content\n $image\n $logo\n status");
		} else{
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($conn);
		}
		
$con1=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_ecommerce");
$con3=mysqli_connect("localhost", "allmart_ecomm20", "AZk=8fzX2s!3","allmart_web");
		
		// Close connection
		mysqli_close($conn);
		
		?>
		

