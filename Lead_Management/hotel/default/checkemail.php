<?Php
include ('config.php');
//ECHO 'TR';
error_reporting(0);
$email=$_POST['email'];
$Table=$_POST['Table'];
$column=$_POST['column'];

//echo $email;
//echo "SELECT * FROM `login` where username='".$email."'";
$qr=mysqli_query($conn,"SELECT * FROM $Table where $column='".$email."' ");
//echo "SELECT * FROM $Table where $column='".$email."' ";
$nrws=mysqli_num_rows($qr);
if($nrws >0){
   echo "1"; 
}else{
    echo "0";
}


?>