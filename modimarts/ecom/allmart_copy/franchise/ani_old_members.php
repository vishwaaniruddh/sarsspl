<?
include('../config.php');

function get_country($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from country where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['country'];
}


function get_state($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from state where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['state'];
}


function get_zone($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from zone where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['zone'];
}

function get_division($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from city where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['city'];
}


function get_district($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from district where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['district'];
}


function get_taluka($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from taluka where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['taluka'];
}


function get_pincode($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from pincode where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['pincode'];
}




?>


<html>
    <head>
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    </head>
    <body>
<div class="container-fluid">
    
<h1 style="text-align:center; color:red;">Members Table</h1>

        <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <td>Count</td>

<td>Level Number  </td>
<td>Star</td>
<td>Position Name</td>
<td>Country</td>
<td>Zone</td>
<td>State</td>
<td>Division</td>
<td>Districts</td>
<td>Taluka</td>
<td>Pincode</td>
<td>Village</td>
<td>Location Name</td>
<td>FullyPaidDt</td>
<td>Client ID</td>
<td>Final Name</td>
<td>Final Mob Number</td>
<td>Appl Form</td>


<td>Intro ID</td>
<td>Introducer Name</td>
<td>Introducer Mobile No</td>
<td>Temparary Name</td>

<td>Payment Date</td>
<td>Paid</td>
<td>Payment Receivable</td>
<td>Payment Received</td>
<td>Balance Payment</td>
<td>Residing Area</td>

    </tr>
  </thead>
  <tbody>
<? $sql = mysqli_query($con,"select * from new_member order by id ASC");

$i=1;
while($sql_result = mysqli_fetch_assoc($sql)){ ?>
   
   
    <tr>
<td><? echo $i;?></td>
<td><? echo $sql_result['level_id'];?></td>
<td><? echo $sql_result['star'];?></td>
<td><? echo $sql_result['position_name'];?></td>
<td><? echo get_country($sql_result['country']);?></td>
<td><? echo get_zone($sql_result['zone']);?></td>
<td><? echo get_state($sql_result['state']);?></td>
<td><? echo get_division($sql_result['division']);?></td>
<td><? echo get_district($sql_result['district']);?></td>
<td><? echo get_taluka($sql_result['taluka']);?></td>
<td><? echo get_pincode($sql_result['pincode']);?></td>
<td><? if($sql_result['village'] != 0){ echo $sql_result['village']; }?></td>
<td><? echo $sql_result['location'];?></td>
<td><? echo $sql_result['full_pay_date'];?></td>
<td><? echo $sql_result['client_id'];?></td>
<td><? echo $sql_result['name'];?></td>
<td><? echo $sql_result['mobile'];?></td>
<td><? echo $sql_result['application'];?></td>



<td><? echo $sql_result['intro_id'];?></td>

<td><? echo $sql_result['introducer_name'];?></td>
<td><? echo $sql_result['introducer_mobile'];?></td>
<td><? echo $sql_result['temp_name'];?></td>
<td><? echo $sql_result['payment_date'];?></td>
<td><? echo $sql_result['is_paid'];?></td>

<td><? echo $sql_result['payment_receivable'];?></td>
<td><? echo $sql_result['payment_received'];?></td>
<td><? echo $sql_result['balance'];?></td>

<td><? echo $sql_result['residing_area'];?></td>

    </tr>
    
    
<? $i++; } ?>
   
  </tbody>
</table>
</div>
    </body>
</html>