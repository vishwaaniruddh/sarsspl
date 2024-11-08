<?php
session_start();

include('config.php');

   /* var_dump($_POST);*/
    $id = $_POST['id'];
    $period = $_POST['period'];
    $type = $_POST['type'];
    $rate = $_POST['rate'];
    $discount = $_POST['discount'];
    $gperiod = $_POST['gperiod'];
    $gtype = $_POST['gtype'];
    $status = $_POST['status'];
    $date = date('Y-m-d H:i:s');
    if($_POST['type']=='Days'){
        $cnt = $_POST['period'];
    } else if($_POST['period'] == 'Week'){
        $cnt = $_POST['period'] * 7;
    } else if($_POST['period'] == 'Months'){
        // Months
        $cnt = $_POST['period'] * 30;
    } else if($_POST['period'] == 'Year'){
        $cnt = $_POST['period'] * 365;
    }
    
    //get completion date 
    $compltDate = mysql_query("SELECT `start_date`, DATE_ADD(`start_date`, INTERVAL '".$cnt."' DAY) AS completionDate FROM subscription_details;");
    
    $final_date = mysql_fetch_assoc($compltDate);
    $completion_date = $final_date['completionDate'];
 if($id>0){
    $update_qry = mysql_query("update subscription_details set end_date='".$date."' , status=2 where id=".$id);
    $subid = $_POST['sid'];
    $qry_details="insert into subscription_details(`rate`,`discount`,`subscription_id`,`start_date`,`completion_date`,`status`,`grace_type`,`grace_period`) values('".$rate."','".$discount."','".$subid."','".$date."','".$completion_date."','".$status."','".$gtype."','".$gperiod."')";
    $result=mysql_query($qry_details);
    $message = "Subscription updated successfully!";  
} else {
    $qry="insert into subscriptions(`period`,`type`,`status`,`creation_date`) values('".$period."','".$gtype."','".$status."','".$date."')";
    $res=mysql_query($qry);
    $subid= mysql_insert_id();
    echo $subid;
    if($subid>0){
        $qry_details="insert into subscription_details(`rate`,`discount`,`subscription_id`,`start_date`,`completion_date`,`status`,`grace_type`,`grace_period`) values('".$rate."','".$discount."','".$subid."','".$date."','".$completion_date."','".$status."','".$gtype."','".$gperiod."')";
        echo $qry_details;exit;
        $result=mysql_query($qry_details);
    }
    $message = "Subscription Added Successfully !!";
}
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<script>window.open("add_subscription.php", "_self");</script>';
?>
