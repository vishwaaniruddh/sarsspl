<?php
session_start();
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))  
{  
    //echo $_SESSION['adminuser'];
    $id=$_SESSION['id'];    
    //echo $id;
    include "config.php";     
    //SELECT `todate` last_bill_date,datediff(CURRENT_DATE,`creation_date`) last_generate_date FROM receipt WHERE `merchant_id` ='459' order by `receipt_no` desc limit 1
    $check_query = mysqli_query($con1,"SELECT `todate`,datediff(CURRENT_DATE,`todate`) last_generate_date,DATE_ADD(`todate`, INTERVAL 30 DAY) from_bill_date FROM receipt WHERE merchant_id ='".$_SESSION['id']."' order by `receipt_no` desc limit 1");
    $row_count = mysqli_num_rows($check_query); 
    $dates = mysqli_fetch_array($check_query);
    $od_date = $dates['from_bill_date'];
    $cdate = date("Y-m-d");
    
    $reg = mysqli_query($con1,"SELECT `rdate`,datediff(CURRENT_DATE,`rdate`) reg_date FROM clients WHERE code ='".$_SESSION['id']."'");
    $row_count = mysqli_num_rows($reg);
    $rdate = mysqli_fetch_array($reg);
    //var_dump($rdate);
?>
    <!doctype html>
    <html lang="en"> 
    <head>
        <!-- Meta -->
        <meta charset="UTF-8">
        <meta name="author" content="Acura">
        <meta name="description" content="Acura - A Real Admin Template">
        <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
        <!-- Responsive viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Title -->
      <title>Claim Bill</title>
      <?php include('header.php'); ?>  
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
            <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to Merchant Panel</span></h1>
            <div class="sitemap grid-6">
                <ul>
                  <!--<li><span>1click</span><i>/</i></li>-->
                  <li><a href="index.php">Merchant Panel</a></li>
                </ul>
            </div>
        </div>
        <!-- Data -->
        <div class="data grid-12">
            <!-- Simple Chart -->
            <div class="grid-10">
              <div class="widget">
                <header class="widget-header">
                  <div class="widget-header-icon">&#xf109;</div>
                  <h3 class="widget-header-title"><strong>Claim Bill</strong>
                  </h3>
                  <?php if($dates['last_generate_date']>=45 || $rdate['reg_date']>=45 ){ ?>
                      <div style="padding: 3px 83%;">
                          <!--<form action="#">
                              <input type="submit" name='click' value="GenerateBill" class="btn btn-info txt-center" id="claim_bill">
                          </form>-->
                          <button type="button" class="btn btn-info txt-center" id="claim_bill">Generate Bill</button>
                      </div>
                  <?php } ?>
                </header>
                <div class="widget-body" id="bill_content" style="display:none;">
                 <div>
                    <div>
                        <?php /*
                        <table class="table table-bordered table-hover" >
                          <thead style="background-color: #15527f;color: white;">
                            <tr>
                            <!--id rate start_date end_date type period content content_file file_type city creation_date status mid of_date tilldate of_purchase_date-->
                              <td class="text-right">Order ID</td>
                              <td class="text-left">Customer</td>
                              <td class="text-left">Product Name</td>
                              <td class="text-right">No. of Products</td>
                              <td class="text-left">Status</td>
                              <td class="text-right">Total</td>
                              <td class="text-left">Date Added</td>
                              <td></td>
                            </tr>
                          </thead>
                        <tbody style="background-color: white;"> 
                        <?php    
                            $query = mysqli_query($con1,"SELECT r.Firstname,o.user_id,od.oid,od.date as order_date,od.status as order_status,od.qty as quantity,od.total_amt,pd.category,pm.product_model FROM Registration r join Orders o on r.id = o.Merchant_id join order_details od on o.id = od.oid join Productviewtable pd on od.item_id = pd.code join product_model pm on pd.name = pm.id WHERE od.mrc_id ='".$_SESSION['id']."' and od.status=1 and od.status=1 and od.date > '".$dates['from_bill_date']."'");
                            //echo "SELECT r.Firstname,o.user_id,od.oid,od.date as order_date,od.status as order_status,od.qty as quantity,od.total_amt,pd.category,pm.product_model FROM Registration r join Orders o on r.id = o.user_id join order_details od on o.id = od.oid join Productviewtable pd on od.item_id = pd.code join product_model pm on pd.name = pm.id WHERE od.mrc_id ='".$_SESSION['id']."' and od.status=1 and od.status=1 and od.date > '".$dates['from_bill_date']."'";
                            $cnt=1;
                            $total=0;
                            $oid = array();
                            
                            //csv 
                            $user_arr = array();
                            $user_arr[0] = array('Firstname','product_model','quantity','order_status','total_amt');
                            $c = 1;
                            while($rows = mysqli_fetch_array($query)){
                                //var_dump($rows);exit;    
                                //$total = $rows['total'];
                                $oid[] = $rows['oid'];
                                $Firstname = $row['Firstname'];
                              $product_model = $row['product_model'];
                              $quantity = $row['quantity'];
                              $order_status = $row['order_status'];
                              $total_amt = $row['total_amt'];
                              $user_arr[$cnt] = array($Firstname,$product_model,$quantity,$order_status,$total_amt);
                                ?>
                                    <tr >
                                      <td class="text-center" ><?php echo $cnt;?></td>
                                      <td class="text-center" ><?php echo $rows['Firstname'];?></td>
                                      <td class="text-center" ><?php echo $rows['product_model'];?></td>
                                      <td class="text-center" ><?php echo $rows['quantity'];?></td>
                                      <td class="text-center" ><?php echo $rows['order_status'];?></td>
                                      <td class="text-center"><?php echo $rows['total_amt'];?></td>
                                      <td class="text-center"><?php echo $rows['date'];?></td>
                                   </tr>
                                <?php $cnt++ ; }?>
                                <tfoot>
                                    <tr>
                                      <td>Total<?php echo count($oid);?></td>
                                      <?php 
                                        $q = mysqli_query($con1,"SELECT sum(od.total_amt) total from Orders o  join order_details od on o.id = od.oid join Productviewtable pd on od.item_id = pd.code join product_model pm on pd.name = pm.id WHERE od.mrc_id ='".$_SESSION['id']."' and od.status=1 and od.status=1 and od.date > '".$dates['from_bill_date']."'");
                                        $row = mysqli_fetch_array($q);
                                        //var_dump($row);
                                        $total = $row[0];
                                      ?>
                                      <td><?php echo $total; ?></td>
                                    </tr> 
                                </tfoot>
                            </tbody>
                        </table> 
                    */?>
                    <form enctype="multipart/form-data" method="POST" action="mail.php"> 
                        <label>Send Report to Admin <input type="file" name="attachment" /></label> 
                        <label><input type="submit" name="button" value="Send Mail" class="btn btn-info txt-center"/></label> 
                    </form> 
                    
                    <form method='post' action='download_csv.php'>
                        <input type='hidden' value='<?php echo $id; ?>' name='mid'>
                        <input type='hidden' value='<?php echo $od_date; ?>' name='from_date'>
                        <input type='submit' value='Export' name='Export' class="btn btn-info txt-center">
                        <table border='1' style='border-collapse:collapse;'>
                        <tr>
                         <th>ID</th>
                         <th>Username</th>
                         <th>Name</th>
                         <th>Gender</th>
                         <th>Email</th>
                        </tr>
                        <tbody style="background-color: white;"> 
                        <?php
                        $query = "SELECT r.Firstname,o.user_id,od.oid,od.date as order_date,od.status as order_status,od.qty as quantity,od.total_amt,pd.category,pd.code pid,pm.product_model FROM Registration r join Orders o on r.id = o.user_id join order_details od on o.id = od.oid join Productviewtable pd on od.item_id = pd.code join product_model pm on pd.name = pm.id WHERE od.mrc_id ='".$_SESSION['id']."' and od.status=1 and od.status=1 and od.date > '".$dates['from_bill_date']."'";
                        //echo $query;
                        $cnt=1;
                        $total=0;
                        $pid=array();
                        $oid = array();
                        $result = mysqli_query($con1,$query);
                        $user_arr = array();
                        $user_arr[0] = array('Firstname','product_model','quantity','order_status','total_amt');
                        $c = 1;
                        while($row = mysqli_fetch_array($result)){
                            //var_dump($row);
                            $oid[] = $rows['oid'];
                            $pid[] = $rows['pid'];
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
                       <tfoot>
                        <tr>
                          <td>Total</td>
                          <?php 
                            $q = mysqli_query($con1,"SELECT sum(od.total_amt) total from Orders o  join order_details od on o.id = od.oid join Productviewtable pd on od.item_id = pd.code join product_model pm on pd.name = pm.id WHERE od.mrc_id ='".$_SESSION['id']."' and od.status=1 and od.status=1 and od.date > '".$dates['from_bill_date']."'");
                            $row = mysqli_fetch_array($q);
                            //var_dump($row);
                            $total = $row[0];
                          ?>
                          <td><?php echo $total; ?></td>
                        </tr>
                    </tfoot>
                    </tbody>
                       </table>
                       <?php 
                        $serialize_user_arr = serialize($user_arr);
                       ?>
                      <textarea name='export_data' style='display: none;'><?php echo $serialize_user_arr; ?></textarea>
                     </form>
        <script>
        
            $("#claim_bill").click(function(){
              $("#bill_content").show();
              
              <?php 
                
                $ins = mysqli_query($con1,"insert into receipt(merchant_id,creation_date,from_date,todate,total,status) values('".$_SESSION['id']."','".$cdate."','".$dates['todate']."','".$dates['from_bill_date']."',$total,0)");
                $last_id = mysqli_insert_id();
                for($i=0;$i<count($oid);$i++){
                    $rect_ord = mysqli_query($con1,"insert into receipt_orders(receipt_id,mid,order_id,product_id) values($last_id,'".$_SESSION['id']."','".$oid[$i]."','".$pid[$i]."')"); 
                }
                
              ?>
            });
            function confirm_delete(id)
          {
            document.location="deleteoffer.php?offid="+id;  
          }
        </script>
                    </div>
                  </div>
                </div>
               </div>
            </div>
        </div>
        <!-- Footer -->
        <!-- Footer -->
        <footer class="footer grid-12">
            <ul class="footer-sitemap grid-12">
              <li><a href="index.php">Home</a><span>/</span></li>
              <li>Claim Bill</li>
            </ul>
            <div class="copyright grid-12">
              Copyright © 2019 . All rights Reserved!
            </div>
        </footer>
        </div>
      </div>
     
      <!-- Go top -->
     
    </body>
    </html>
    <?php
}else
{ 
 header("location: index.php");
}
?>