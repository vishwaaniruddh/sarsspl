<?php
session_start();
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))  
{	
    $id=$_SESSION['id']; 
    include "config.php";  
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
            <h1 class="grid-6"><i>&#xf132;</i>
            <span>Welcome to Merchant Panel</span></h1>
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
                  <h3 class="widget-header-title">
                      <strong> Billing Report</strong>
                  </h3>
                </header>
                <div class="widget-body" id="bill_content" >
                 <div>
                    <div>
                    <form method='post' action=''>
                        <input type='hidden' value='<?php echo $id; ?>' name='mid'>
                      <table border='1' style='border-collapse:collapse;' class="table table-striped table-bordered">
                        <tr>
                            <th>Sr. No</th>
                             <th>Receipt No</th>
                             <th>Username</th>
                             <th>Total</th>
                             <th>Bill Date</th>
                             <th>Bill  From-Date</th>
                             <th>Bill To-Date</th>
                             <th>Payment Date</th>
                             <th>Action</th>
                        </tr>
                        <tbody style="background-color: white;">
                        <?php    
                            $cnt=1;
                            $user_arr = array();
                            $serialize_user_arr = '';
                            $query = mysqli_query($con1,"SELECT r.* ,c.name FROM receipt r left join clients c on r.merchant_id = c.code");
                            while($rows = mysqli_fetch_array($query)){
                                //var_dump($rows);exit;
                                $fdate = $rows['from_date'];
                                $todate = $rows['todate'];
                                    $query1 = "SELECT r.Firstname,o.user_id,od.oid,od.date as order_date,od.status as order_status,od.qty as quantity,od.total_amt,pd.category,pm.product_model FROM Registration r join Orders o on r.id = o.user_id join order_details od on o.id = od.oid join Productviewtable pd on od.item_id = pd.code join product_model pm on pd.name = pm.id WHERE od.mrc_id ='".$_SESSION['id']."' and od.status=1 and od.status=1 and od.date >= '".$fdate."' and od.date <= '".$todate."' ";
                                   
                                    $result = mysqli_query($con1,$query1);
                                    $user_arr = array();
                                    $user_arr[0] = array('Firstname','productName','quantity','order_status','total_amt');
                                    $c = 1;
                                    while($row = mysqli_fetch_array($result)){
                                         
                                        $id = $row['Firstname'];
                                        $uname = $row['product_model'];
                                        $q = $row['quantity'];
                                        $status = $row['order_status'];
                                        $amt = $row['total_amt'];
                                        $user_arr[$c] = array($id,$uname,$q,$status,$amt);
                                        $c++;
                                    }
                            ?>
                            
                            <?php 
                                $serialize_user_arr = serialize($user_arr);
                            ?>
                                  <textarea name='export_data<?php echo $cnt;?>' id='export_data<?php echo $cnt;?>' style='display: none;'><?php echo $serialize_user_arr; ?></textarea>
                            <tr >
                                <td class="text-center" ><?php echo $cnt;?></td>
                                <td class="text-center" ><?php echo $rows['receipt_no'];?></td>
                                <td class="text-center"> <?php echo $rows['name'];?>  </td>
                                <td class="text-center"><?php  echo $rows['total'];?></td>
                                <td class="text-center" ><?php echo $rows['creation_date'];?></td>
                                <td class="text-center" ><?php echo $rows['from_date'];?></td>
                                <td class="text-center" ><?php echo $rows['todate'];?></td>
                                <td class="text-center" ><?php echo $rows['payment_date'];?></td>
                                <td class="text-center">
                                    <input type='button' value='Export' name='Export' id="export<?php echo $cnt;?> " onclick="download(<?php echo $id; ?>,'<?php echo $fdate; ?>',<?php echo $cnt;?>);" class="btn-info">
                                </td>
                            </tr>
                        <?php $cnt++ ; }?> 
                        
                        </tbody>
                       </table>
                       <?php 
                        //$serialize_user_arr = serialize($user_arr);
                       ?>
                      <!--<textarea name='export_data' style='display: none;'><?php echo $serialize_user_arr; ?></textarea>-->
                     </form>
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
              <li>All Bills</li>
            </ul>
            <div class="copyright grid-12">
              Copyright © 2010 . All rights Reserved!
            </div>
        </footer>
        </div>
      </div>
     
     <script>
         function download(mid,fdate,cnt){
             var s = document.getElementById('export_data'+cnt).value;
             //alert('m: '+mid+' date: '+fdate+' c:'+cnt+'  S:'+s);
             window.location ="download_csv.php?mid="+mid+"&fdate="+fdate+"&export_data="+s;
         }
     </script>
    </body>
    </html>
    <?php
}else
{ 
 header("location: index.php");
}
?>