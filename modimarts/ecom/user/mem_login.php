<?php session_start();
include ("config.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//subscription date check start code

$ret = mysqli_query($con1,"select tilldate,mid from Subscription");
       while($row= mysqli_fetch_array($ret)){
                            
        $sdate=date("Y-m-d");
        $mont=$row[0];
                                        
        if($mont=="")
        {
            $date1=date_create("$sdate");
            $date2=date_create("$mont");
            $diff=date_diff($date1,$date2);
            $diffck= $diff->format("%R%a ");
           //echo  $diffck; 
                                       
               if($diffck==+2 || $diffck==+1)
               {$txt="";
               
               $emailqry="select email from clients where code ='".$row[1]."'";
               $em= mysqli_query($con1,$emailqry);
               $ro= mysqli_fetch_array($em);
              
                 $to = "$ro[0]";
                 $subject = "Subscription Details";

                if($diffck==+2){$txt = "Subscription expire after two days"; echo "Subscription expire after two days";}
                if($diffck==+1){$txt = "Subscription expire after one days";}

                $headers = "From: webmaster@example.com" . "\r\n" .
                "CC: somebodyelse@example.com";

                mail($to,$subject,$txt,$headers);
                }
       }
       }

//subscription date check END code

$user=$_POST['uname'];
$passwd=$_POST['passwd'];

$sql="select id,password,cid from users where department='users' or department='admin' ";

$result=mysqli_query($con1,$sql);
$count=0;

$sql="select id,password,cid from users where department in('users','admin')  and id='".$user."'  and password='".$passwd."' ";
$result = mysqli_query($con1,$sql);
$count = mysqli_num_rows($result);

if($count>0){
    $row = mysqli_fetch_assoc($result);
    $aduser=$row['id'];
	$id=$row['cid'];
    $_SESSION['adminuser']=$aduser;
	$_SESSION['id']=$id;

    echo "<script>window.location.href='welcome.php';</script>";
} else {
    echo "<script>alert('SORRY, you have entered wrong details. Please go back and login again. Thank you')</script>";
}

?>



