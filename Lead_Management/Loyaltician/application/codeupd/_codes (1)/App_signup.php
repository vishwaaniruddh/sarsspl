<?php include ('config.php');

$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$mobile = $_REQUEST['mobile'];
$hotelname = $_REQUEST['hotelname'];
$designation = $_REQUEST['designation'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$CurrentDate = date('Y-m-d H:i:s');


$run1 = mysqli_query($conn, "SELECT * FROM  signUpBarcodUserDets WHERE  mobile='" . $mobile . "' and email='" . $email . "' ");
$num = mysqli_num_rows($run1);

if ($num > 0) {
    echo '2';//2-means Allready Exist;
} else {
    $Q = mysqli_query($conn, "insert into signUpBarcodUserDets (firstname,lastname,mobile,hotelname,designation,email,password,entryDate,ActiveStatus) values ('" . $firstname . "','" . $lastname . "','" . $mobile . "','" . $hotelname . "','" . $designation . "','" . $email . "','" . $password . "','" . $CurrentDate . "','1') ");

    if ($Q) {
        echo "1";
    }// 1-means Successfull insert
    else {
        echo "0";
    }//0-means used error
}

?>