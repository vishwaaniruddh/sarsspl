<?php 
include "config.php";
    $id=$_SESSION['id']; 
    $id =459;
    include "config.php";     
    //SELECT `todate` last_bill_date,datediff(CURRENT_DATE,`creation_date`) last_generate_date FROM receipt WHERE `merchant_id` ='459' order by `receipt_no` desc limit 1
    $check_query = mysqli_query($con1,"SELECT `todate`,datediff(CURRENT_DATE,`todate`) last_generate_date,DATE_ADD(`todate`, INTERVAL 30 DAY) from_bill_date FROM receipt WHERE merchant_id ='".$id."' order by `receipt_no` desc limit 1");
    $row_count = mysqli_num_rows($check_query);
    $dates = mysqli_fetch_array($check_query);
    $od_date = $dates['from_bill_date'];
    $cdate = date("Y-m-d");
    /*var_dump($dates);*/
    
    $reg = mysqli_query($con1,"SELECT `rdate`,datediff(CURRENT_DATE,`rdate`) reg_date FROM clients WHERE code ='".$_SESSION['id']."'");
    $count = mysqli_num_rows($reg);
    $rdate = mysqli_fetch_array($reg);
?>

<div class="container">
 
 <form method='post' action='test.php'>
  <input type='submit' value='Export' name='Export'>
  <table border='1' style='border-collapse:collapse;'>
    <tr>
     <th>ID</th>
     <th>Username</th>
     <th>Name</th>
     <th>Gender</th>
     <th>Email</th>
    </tr>
    <?php 
     /*$query = "SELECT * FROM clients ";*/
     $query = "SELECT r.Firstname,o.user_id,od.oid,od.date as order_date,od.status as order_status,od.qty as quantity,od.total_amt,pd.category,pm.product_model FROM Registration r join Orders o on r.id = o.user_id join order_details od on o.id = od.oid join Productviewtable pd on od.item_id = pd.code join product_model pm on pd.name = pm.id WHERE od.mrc_id ='".$id."' and od.status=1 and od.status=1 and od.date > '".$od_date."'";
     echo $query;
     $result = mysqli_query($con1,$query);
     $user_arr = array();
     $user_arr[0] = array('Firstname','product_model','quantity','order_status','total_amt');
     $c = 1;
     while($row = mysqli_fetch_array($result)){
         //var_dump($row);
      $id = $row['Firstname'];
      $uname = $row['product_model'];
      $name = $row['quantity'];
      $gender = $row['order_status'];
      $email = $row['total_amt'];
      $user_arr[$c] = array($id,$uname,$name,$gender,$email);
   ?>
      <tr>
       <td><?php echo $id; ?></td>
       <td><?php echo $uname; ?></td>
       <td><?php echo $name; ?></td>
       <td><?php echo $gender; ?></td>
       <td><?php echo $email; ?></td>
      </tr>
   <?php
    $c++;}
   ?>
   </table>
   <?php 
    $serialize_user_arr = serialize($user_arr);
   ?>
  <textarea name='export_data' style='display: none;'><?php echo $serialize_user_arr; ?></textarea>
 </form>
</div>