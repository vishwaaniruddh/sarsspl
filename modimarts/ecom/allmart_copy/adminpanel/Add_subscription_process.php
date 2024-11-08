<?php
session_start();

include('config.php');
/*var_dump($_POST);
var_dump($_GET);exit;*/
if(isset($_GET['id'])) { 
    var_dump($_POST);
    $id = $_POST['id'];
    $period = $_POST['period'];
    $rate = $_POST['rate'];
    $discount = $_POST['discount'];
    $status = $_POST['status'];
} else {
    $id = $_POST['id'];
    $period = $_POST['period'.$id]; 
    $rate = $_POST['rate'.$id];
    $discount = $_POST['discount'.$id];
    $status = $_POST['status'.$id];
}
$date = date('Y-m-d H:i:s');
echo $period;
 if($_GET['id']>0){
    //Add new record
    /*$update_qry = mysql_query("update subscriptions set period='".$period."' ,rate='".$rate."' ,discount='".$discount."' , status='".$status."' where id=".$_GET['id']);*/
    $update_qry = mysql_query("update subscriptions set end_date='".$date."' , status=2 where id=".$_GET['id']);
    echo "update subscriptions set end_date='".$date."' , status=2 where id=".$_GET['id'];
    $qry="insert into subscriptions(`period`,`rate`,`discount`,`status`,`creation_date`) values('".$period."','".$rate."','".$discount."','".$status."','".$date."')";
    $res=mysql_query($qry);
    $message = "Subscription updated successfully!";  exit;
} else {
    $qry="insert into subscriptions(`period`,`rate`,`discount`,`status`,`creation_date`) values('".$period."','".$rate."','".$discount."','".$status."','".$date."')";
    /*echo $qry;
    var_dump($cnt);exit;*/
    $res=mysql_query($qry);
    $message = "Subscription Added Successfully !!";
    $subid= mysql_insert_id();
}
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<script>window.open("add_subscription.php", "_self");</script>';
?>
