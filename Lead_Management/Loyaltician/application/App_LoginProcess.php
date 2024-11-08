<?php include ('config.php');
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$run = mysqli_query($conn, "SELECT firstName,lastName,id FROM signUpBarcodUserDets WHERE email ='" . $email . "' and password ='" . $password . "'");
$num = mysqli_num_rows($run);

if ($num > 0) {
   $frws = mysqli_fetch_array($run);
   $_SESSION['fname'] = $frws['firstName'];
   $_SESSION['lname'] = $frws['lastName'];
   $_SESSION['id'] = $frws['id'];

   echo "1";
} else {
   echo "0";
}

?>