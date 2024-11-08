<?php
session_start();
include('config.php');
$fname=mysqli_real_escape_string($_POST['firstname']);
$lname=mysqli_real_escape_string($_POST['lastname']);
$email=mysqli_real_escape_string($_POST['email']);
$state=mysqli_real_escape_string($_POST['state']);

$PlotNO=mysqli_real_escape_string($_POST['PlotNO']);
$WingNo=mysqli_real_escape_string($_POST['WingNo']);
$BuildingName=mysqli_real_escape_string($_POST['BuildingName']);
$RoadNo=mysqli_real_escape_string($_POST['RoadNo']);
$LandMark=mysqli_real_escape_string($_POST['LandMark']);
$Locality=mysqli_real_escape_string($_POST['Locality']);

$address=mysqli_real_escape_string($_POST['address_1']);
$city=mysqli_real_escape_string($_POST['city']);
$pincode=mysqli_real_escape_string($_POST['pincode']);
$mob=mysqli_real_escape_string($_POST['contact']);
//$pass=$_POST['password'];

//Ruchi : 
 // Generating Password
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
$pass = substr( str_shuffle( $chars ), 0, 8 );
$phone=mysqli_real_escape_string($_POST['phoneNumber']);
$pan=mysqli_real_escape_string($_POST['pan']);
$adhar=mysqli_real_escape_string($_POST['adhar']);
$account_no=mysqli_real_escape_string($_POST['account_no']);
$bank_name=mysqli_real_escape_string($_POST['bank_name']);
$branch_name=mysqli_real_escape_string($_POST['branch']);
$ifsc=mysqli_real_escape_string($_POST['ifsc']);
$upi=mysqli_real_escape_string($_POST['upi']);
//$p=mysqli_real_escape_string($_POST['phoneNumber']);
//echo $bank_name;
/*$q=("INSERT INTO `Registration`(`Firstname`, `email`, `Mobile`, `address`, `pincode`,  `state`, `city`, `password`,`pan`,`adhar_no`,`bank_name`,`branch`,`account_no`,`ifsc`,`upi`,`phone`)
VALUES ('".$fname."','".$email."','".$mob."','".$address."','".$pincode."','".$state."','".$city."','".$pass."','".$pan."','".$adhar."','".$bank_name."','".$branch_name."','".$account_no."','".$ifsc."','".$upi."','".$phone."')");
echo $q;exit;
*/
if($_SESSION['gid']!="")
{
    $gtsts=mysqli_query($con1,"SELECT * FROM `states` where state_name='".$state."'");
    $stsrw=mysqli_fetch_array($gtsts);
    
    //echo "SELECT * FROM `states` where state_name='".$state."'";
    if(isset($_POST["submit"]))
    {
    
    //echo  "update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$state."',`city`='".$city."',`password`='".$pass."' where id='".$_SESSION['gid']."'";
    // Ruchi : 25july
    //$qry=mysqli_query($con1,"update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$stsrw[0]."',`city`='".$city."',`password`='".$pass."' where id='".$_SESSION['gid']."'");
    $qry=mysqli_query($con1,"update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$stsrw[0]."',`city`='".$city."',`password`='".$pass."' where id='".$_SESSION['gid']."'");
    $qrylogin=mysqli_query($con1,"INSERT INTO `login`(`email`, `password`, `regid`) VALUES ('".$email."','".$pass."','".$_SESSION['gid']."')");
    
    
    $qryaddrqr=mysqli_query($con1,"INSERT INTO `user_address`(`user_id`, `address`, `state`, `city`, `pin`) VALUES('".$_SESSION['gid']."','".$address."','".$stsrw[0]."','".$city."','".$pincode."')"); 
  
    $qrymail=mysqli_query($con1,"select id from verification where email='".$email."'");
    //echo "select * from verification where email='".$email."'";
    $fetchem=mysqli_fetch_array($qrymail);
    $fetch=mysqli_num_rows($qrymail);

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
  $string=random_string(7);
       $email = strip_tags($email);

$str="";

  if($fetchem[0]!="")
  {   
  	$str="update verification  set code='".$string ."' where EMAIL='".$email."' ";
  	//$update = 1;
   
   }
   else
   {
if($_SESSION['gid']!="")
{
 	$str="INSERT INTO verification(email,code,reg_id) VALUES ('".$email."','".$string ."','".$_SESSION['gid']."')";
}
else
{
$str="INSERT INTO verification(email,code,reg_id) VALUES ('".$email."','".$string ."','".$_SESSION['id']."')";
}
 	//echo $str;
 }
    }else if(isset($_POST["update"]))
    {
      //  echo "ok";PlotNO WingNo BuildingName RoadNo LandMark Locality
     // echo "update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$stsrw[0]."',`city`='".$city."' where id='".$_SESSION['gid']."'"; 
      //$qry=mysqli_query($con1,"update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$stsrw[0]."',`city`='".$city."',`wingNo`='".$WingNo."',`plotNo`='".$PlotNO."',`buildName`='".$BuildingName."',`roadNo`='".$RoadNo."',`landmark`='".$LandMark."',`Locality`='".$Locality."' where id='".$_SESSION['gid']."'");
      $qry=mysqli_query($con1,"update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$stsrw[0]."',`city`='".$city."',`wingNo`='".$WingNo."',`plotNo`='".$PlotNO."',`buildName`='".$BuildingName."',`roadNo`='".$RoadNo."',`landmark`='".$LandMark."',`Locality`='".$Locality."',`pan`='".$pan."',`adhar_no`='".$adhar."',`bank_name`='".$bank_name."',`branch`='".$branch."',`account_no`='".$account_no."',`ifsc`='".$ifsc."',`upi`='".$upi."' where id='".$_SESSION['gid']."'");
     echo mysqli_error();
    $getusaddr=mysqli_query($con1,"select id from user_address where user_id='".$_SESSION['gid']."' order by id asc limit 0,1");
    $gtuseraddrid=mysqli_fetch_array($getusaddr);
    $qryaddrqr=mysqli_query($con1,"update `user_address` set `address`='".$address."', `state`='".$stsrw[0]."', `city`='".$city."', `pin`='".$pincode."' where id='".$gtuseraddrid[0]."'"); 
     echo mysqli_error();
    }
}
else
{
    //Ruchi 
    //$qry=mysqli_query($con1,"INSERT INTO `Registration`(`Firstname`, `Lastname`, `email`, `Mobile`, `address`, `pincode`, `landmark`, `state`, `city`, `Gender`, `password`,wingNo ,plotNo ,buildName, roadNo, Locality)
    //VALUES ('".$fname."','".$lname."','".$email."','".$mob."','".$address."','".$pincode."','','".$state."','".$city."','','".$pass."','".$WingNo."','".$PlotNO."','".$BuildingName."','','".$RoadNo."','".$Locality."')");

    $qry=mysqli_query($con1,"INSERT INTO `Registration`(`Firstname`, `Lastname`, `email`, `Mobile`, `address`, `pincode`, `landmark`, `state`, `city`, `password`,`pan`,`adhar_no`,`bank_name`,`branch`,`account_no`,`ifsc`,`upi`,`phone`,wingNo ,plotNo ,buildName, roadNo, Locality)
    VALUES ('".$fname."','".$lname."','".$email."','".$mob."','".$address."','".$pincode."','','".$state."','".$city."','','".$pass."','','".$pan."','".$adhar."','".$bank_name."','".$branch_name."','".$account_no."','".$ifsc."','".$upi."','".$phone."','".$WingNo."','".$PlotNO."','".$BuildingName."','','".$RoadNo."','".$Locality."')");

    //echo "INSERT INTO `Registration`(`Firstname`, `Lastname`, `email`, `Mobile`, `address`, `pincode`, `landmark`, `state`, `city`, `Gender`, `password`)
    //VALUES ('".$fname."','".$lname."','".$email."','".$mob."','".$address."','".$pincode."','','".$state."','".$city."','".$address."','','".$pass."')";
    $id=mysqli_insert_id();

    $qrylogin=mysqli_query($con1,"INSERT INTO `login`(`email`, `password`, `regid`) VALUES ('".$email."','".$pass."','".$id."')");
    //var_dump($qry);
}
if($qry & $_SESSION['gid']!="")
{
    //var_dump($qry);
    
    /*Ruchi 
header("Location:RegisterWithoutHeaderORFooter.php?sts=1");*/
header("Location:resale_AddProduct.php?sts=1");
//echo $email;
}
else
{
    //var_dump($qry);exit;
header("Location:RegisterWithoutHeaderORFooter.php?sts=2");
}
//========================send mail=============

?>