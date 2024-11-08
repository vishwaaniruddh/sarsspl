<?php
session_start();
include('config.php');
//$odrid=$_POST['orderid'];
$odrid=$_GET['orderid'];
$trackid=$_GET['trackid'];

if($odrid!=""){

//echo "select * from `Orders` where id='".$odrid."'";
//$slctqry=mysqli_query($con1,"select * from `Orders` where id='".$odrid."'");


$slctqry=mysqli_query($con1,"select * from `Orders` where id='".$odrid."'");




//$slctqry=mysqli_query($con1,"select * from `order_details` where oid='".$odrid."' and track_id='".$trackid."'");

$slctqrychkf=mysqli_num_rows($slctqry);
if($slctqrychkf>0){

$slctqryf=mysqli_fetch_array($slctqry);

if($slctqryf['status']=="Accept"){
$trackstatus="c1";
}
else if($slctqryf['status']=="pr"){
$trackstatus="c2";
}
else if($slctqryf['status']=="dis"){
$trackstatus="c3";
}
else if($slctqryf['status']=="c"){
$trackstatus="c4";
}
else if($slctqryf['status']=="completed"){
$trackstatus="c5";
}

//echo "hi"."select * from `Order_log` where order_id='".$odrid."' and status='".$slctqryf[6]."'";
//echo "hi"."select * from `order_details` where oid='".$odrid."' and status='".$slctqryf[6]."'";


?>  

 <!--<h4>Your order status:</h4>

           

           <ul class="list-group">
                <li class="list-group-item">
                    <span class="prefix">Date created:</span>
                    <span class=""><?php echo $slctqryf['date'];?></span>
                </li>
               <!-- <li class="list-group-item">
                    <span class="prefix">Last update:</span>
                    <span class=""><?php echo $slctqrychkfo_log[2];?></span>
                </li>-->
              <!--  <li class="list-group-item">
                    <!--<span class="prefix">Comment:</span>
                    <span class="">customer's comment goes here</span>-->
                <!--</li>
        <!--        <li class="list-group-item">You can find out latest status of your order with the following link:</li>
                <li class="list-group-item"><a href="//tracking/link/goes/here">//tracking/link/goes/here</a></li>-->
            <!--</ul>-->
            <?php $qry=mysqli_query($con1,"select * from order_shipping where oid='".$odrid."'");
$fetch=mysqli_fetch_array($qry);
?>
<!--
 <table border=1>
        <tr>
        <th>Current Location</th>
         <th>Date</th>
        </tr>
        <tr>
            <td>
                <?php echo $fetch[7];?>
            </td>
        
         <td>
               <?php echo $fetch[8];?> 
            </td>
        </tr>
        </table>
        -->
        
        <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 4px;
}

tr:nth-child(even) {
  background-color: white;
}
</style>
        
         <table style=" background-color: #ffffff;" border=1>
        <tr>
        <th style="text-align:center">Product Name</th>
       <!--  <th>Rate</th>
         <th>Quantity</th>
         <th>Total Amount</th>-->
         <th style="text-align:center">Track Status</th>
          
        </tr>
         <?php 
        $slctqryo_logg=mysqli_query($con1,"select * from `order_details` where oid='".$odrid."' ");
       while($slctqrychkfo_logg=mysqli_fetch_array($slctqryo_logg)){
           
         $pn=mysqli_query($con1,"select name from Productviewtable where code='".$slctqrychkfo_logg['item_id']."' and category='".$slctqrychkfo_logg['cat_id']."' ");
           $ftname=mysqli_fetch_array($pn);
          
         if($slctqrychkfo_logg['status']=="pending"){
$trackstatusshow="Pending";
}  
      else  if( $slctqrychkfo_logg['status']=="Accept"){
$trackstatusshow="Accept";
}
else if($slctqrychkfo_logg['status']=="pr"){
$trackstatusshow="Processing";
}
else if($slctqrychkfo_logg['status']=="dis"){
$trackstatusshow="Shipped";
}
else if($slctqrychkfo_logg['status']=="c"){
$trackstatusshow="Delivered";
}
else if($slctqrychkfo_logg['status']=="completed"){
$trackstatusshow="Completed";
}
               ?>
        
        <tr>
          <td><?php echo $ftname['name'];?></td>
         <!-- <td><?php echo $slctqrychkfo_logg['rate'];?></td>
          <td><?php echo $slctqrychkfo_logg['qty'];?></td>
          <td><?php echo $slctqrychkfo_logg['total_amt'];?></td>
          <td><?php echo $trackstatusshow;?></td>-->
           <td style="text-align:center"> <input type="button" class="btn btn-default" style="padding-bottom: 4px;padding-top: 4px;border-radius: 20px;outline:none" onclick="getTrackstatus('<?php echo $odrid;?>','<?php echo $slctqrychkfo_logg['item_id'];?>','<?php echo $slctqrychkfo_logg['cat_id'];?>'); " value="Get Status"/> </td>
        
        </tr>
        
        
        <? } ?>
        </table>
        
        
        
        
        
        
        
        
        
        <!--
            <div class="order-status">

                <div class="order-status-timeline">
                    <!-- class names: c0 c1 c2 c3 and c4 -->
                   <!-- <div class="order-status-timeline-completion <?php echo $trackstatus;?>"></div>
                </div>

                <div class="image-order-status image-order-status-new active img-circle">
                    <span class="status">Accepted</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-active active img-circle">
                    <span class="status">In progress</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-intransit active img-circle">
                    <span class="status">Shipped</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-delivered active img-circle">
                    <span class="status">Delivered</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-completed active img-circle">
                    <span class="status">Completed</span>
                    <div class="icon"></div>
                </div>

            </div>-->
<?php }else{
?>
No orders yet ! 

<?php
}
}
?>