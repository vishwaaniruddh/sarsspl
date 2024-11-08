<?php
session_start();
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
    $merchantid = $_SESSION['id'];
$oid1=$_GET['id'];
include "config.php"; 
//$qry =mysql_query("SELECT s.id as sid,s.period,s.type,sd.rate,sd.discount,sb.sdate,sb.tilldate,sb.s_purchase_date FROM subscriptions s join  subscription_details sd on s.id=sd.subscription_id join Subscription sb on sd.subscription_id=sb.sid where sd.status!=2 and sb.mid=".$id);
$qry =mysqli_query($con1,"SELECT o.* ,mo.mid,mo.of_date,mo.tilldate,mo.of_purchase_date FROM merchant_offers o join  merchant_purchased_offers mo on o.id=mo.of_id  where o.status!=2 and mo.mid=".$id);

$num_rows = mysqli_num_rows($qry);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Acura">
        <meta name="description" content="Acura - A Real Admin Template">
        <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <title>View My Orders</title>
        <?php include('header.php'); ?>
        <div class="title-sitemap grid-12">
            <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
            <div class="sitemap grid-6">
                <ul>
                    <li><a href="index.php">User Panel</a></li>
                </ul>
            </div>
        </div>
        
        <div class="data grid-12">
            <div class="grid-10">
                <div class="widget">
                    <header class="widget-header">
                        <div class="widget-header-icon">&#xf109;</div>
                        <h3 class="widget-header-title"><strong>Order History</strong></h3>
                    </header>
                    <div class="widget-body">
                        <div>
                            <div>
                                <div class="row">
                                    <div id="content" class="col-sm-9" style="left: 5%;">
                                        <h2>Order Information</h2>
                                        <table class="table table-bordered table-hover" style="background-color: white;">
                                            <?php
                                            $query = mysqli_query($con1,"SELECT * FROM Order_ent WHERE mrc_id ='".$_SESSION['id']."' ");
                                            
                                            $rows = mysqli_fetch_array($query);
                                            $query1 = mysqli_query($con1,"SELECT  * FROM clients WHERE code ='".$_SESSION['id']."'  ");
                                            $rows1 = mysqli_fetch_array($query1); 
                                            $query2 = mysqli_query($con1,"SELECT qty,item_id,oid,product_name FROM order_details WHERE oid ='".$oid1."'  and mrc_id='".$merchantid."'");
                                            
                                            $rows2 = mysqli_fetch_array($query2);
                                            
                                            /*$query3 = mysqli_query($con1,"SELECT address,state,city,pin FROM user_address WHERE user_id ='".$rows[1]."'  ");
                                            $rows3 = mysqli_fetch_array($query3);*/ 
                                            
                                            $query4 = mysqli_query($con1,"SELECT * FROM states WHERE state_code ='".$rows1[3]."'  ");
                                            $rows4 = mysqli_fetch_array($query4);
                                            
                                            $query5 = mysqli_query($con1,"SELECT * FROM cities WHERE code ='".$rows1[2]."'  ");
                                            $rows5 = mysqli_fetch_array($query5);
                                            
                                            $dt=date('d-m-Y',strtotime($rows['date']));
                                            ?>
                                            <?php 
                                            if($rows['status']==0)
                                            {
                                                $p="Pending";
                                            } else if($rows['status']==1)
                                            {
                                                $p="Accepted";
                                            }
                                            else if($rows['status']==2)
                                            {
                                                $p="Processing";
                                            }
                                            else if($rows['status']==3)
                                            {
                                                $p="Dispatch";
                                            }
                                            else if($rows['status']==4)
                                            {
                                                $p="compltete";
                                            }
                                            else if($rows['status']==5)
                                            {
                                                $p="Reject";
                                            }
                                            else {
                                             
                                            }
                                            ?>              
                                            <thead>
                                                <tr>
                                                    <td class="text-left" colspan="2"><b style="color:#666666">Order Details</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-left" style="width: 50%;">
                                                        <b>Order ID:</b> <?php echo $rows2[2];?><br />
                                                        <b>Date Added:</b> <?php echo $dt;?>
                                                    </td>
                                                    <td class="text-left" style="width: 50%;">
                                                        <b>Payment Method:</b> <?php echo $rows[7];?><br />
                                                        <!--<b>Shipping Method:</b>-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <td class="text-left" style="width: 50%; vertical-align: top;"><b style="color:#666666">Payment Address</b></td>
                                                    <td class="text-left" style="width: 50%; vertical-align: top;"><b style="color:#666666">Shipping Address</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-left"><?php echo $rows1[2];?><br /><?php echo $rows5[2];?><br /><?php echo $rows4[1];?><br /><?php echo $rows3[3];?></td>
                                                    <td class="text-left"><?php echo $rows1[0];?> <?php echo $rows1[1];?><br /><?php echo $rows3[0];?><br /><?php echo $rows5[2];?><br /><?php echo $rows4[1];?><br /><?php echo $rows3[3];?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" style="background-color: white;">
                                                <thead>
                                                    <tr>
                                                        <td class="text-left"><b style="color:#666666">Product Name</b></td>
                                                        <td class="text-right"><b style="color:#666666">Quantity</b></td>
                                                        <td class="text-right"><b style="color:#666666">Price</b></td>
                                                        <td class="text-right"><b style="color:#666666">Total</b></td>
                                                        <td class="text-right"><b style="color:#666666">Action</b></td>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                    <?php 
                                                    $query8 = mysqli_query($con1,"SELECT qty,item_id,oid,rate,total_amt,cat_id,product_name,id,status FROM order_details WHERE oid ='".$oid1."' and mrc_id='".$merchantid."' ");
                                                     
                                                    while($rows6 = mysqli_fetch_array($query8)) {
                                                        // print_r($rows6);
                                                        
                                                        /*$query7 = mysqli_query($con1,"SELECT * FROM Productviewtable WHERE code ='".$rows6[1]."' and category='".$rows6['cat_id']."' ");
                                                        $rows7=mysqli_fetch_array($query7);*/
                                                    ?>
                                                        <tr>
                                                            <td class="text-left"><?php echo $rows6[6].' '.$rows6['status'];?> </td>
                                                            <td class="text-right"><?php echo $rows6[0];?></td>
                                                            <td class="text-right"><?php echo $rows6[3];?></td>
                                                            <td class="text-right"><?php echo $rows6[4];?></td>
                                                            <td class="text-right">
                                                                <select name='status' id='status' onchange="order_status(<?php echo $rows6['id'];?>);">
                                                                    <option id='0' value='0' <?php if($rows6['status']==0){echo 'selected'; }?> >pending</option>
                                                                    <option id='1' value='1'  <?php if($rows6['status']==1){echo 'selected';} ?>>Accept</option>
                                                                    <option id='2' value='2' <?php if($rows6['status']==2){echo 'selected';} ?>>processing</option>
                                                                    <option id='3' value='3' <?php if($rows6['status']==3){echo 'selected';} ?> >Dispatch</option>
                                                                    <option id='4' value='4' <?php if($rows6['status']==4){echo 'selected'; }?>>compltete</option>
                                                                    <option id='4' value='4' <?php if($rows6['status']==5){echo 'selected';} ?>>reject</option>
                                                                </select>
                                                            </td>
                                                            <input type="hidden" name="tracking_id" value="tracking_id">
                                                            
                                                            <!-- The Modal -->
                                                          <div class="modal" id="myModal">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                              
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                  <h4 class="modal-title">Enter track id</h4>
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                 <form method="post" >
                                                                     <input type="text" name="trackid" id="trackid" onblur="track_id(this);">
                                                                     <!--<input type="button" onclick="track_id();"  value="submit">-->
                                                                 </form>
                                                                </div>
                                                                
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>
                                                                
                                                              </div>
                                                            </div>
                                                          </div>

                                                        </tr>
                                                    <?php }?> 
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <?php
                                                        $query10=mysqli_query($con1,"select sum(total_amt) as total ,round(sum(total_amt))  from order_details where oid='".$oid1 ."'  and mrc_id='".$merchantid."'");
                                                        
                                                        $rows10=mysqli_fetch_array($query10);
                                                        ?>
                                                        <td colspan="2"></td>
                                                        <td class="text-right"><b>Sub-Total</b></td>
                                                        <td class="text-right">Rs.<?php echo $rows10[0];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="text-right"><b>Total</b></td>
                                                        <td class="text-right">Rs.<?php echo $rows10[1]; ?></td>
                                                    </tr>
                                                </tfoot> 
                                            </table>
                                        </div>
                                        <h3>Order History</h3>
                                        <table class="table table-bordered table-hover" style="background-color: white;">
                                            <thead>
                                              <tr>
                                                <td class="text-left">Date Added</td>
                                                <td class="text-left">Status</td>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-left"><?php echo $dt;?></td>
                                                    <td class="text-left"><?php echo $p;?></td>
                                                    
                                                </tr>
                                            </tbody>
                                      </table> <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer grid-12">
            <ul class="footer-sitemap grid-12">
              <li><a href="index.php">Home</a><span>/</span></li>
              <li>Order History</li>
            </ul>
            <div class="copyright grid-12">
              Copyright © 2020 . All rights Reserved!
            </div>
        </footer>
    </div>
  </div>
</body>
</html>
<?php
}else
{ 
    header("location: index.php");
}
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
function track_id(id){
    alert(id.value);
    var trackid = document.getElementById('trackid').value;
    document.getElementById('tracking_id').value = trackid
}

function order_status(oid){
    var status = document.getElementById("status").value;
    swal({
        title: "Are you sure , you want to change your order's status?",
        //text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
            type: "POST",
            url: "change_status.php",
    		//datatype:'json',	
            data:'status='+status+"&oid="+oid,
            success: function(msg){
                //alert(msg);
                //var jsr=JSON.parse(msg);
            }
            });
            swal("Done!", {
                icon: "success",
            });
        } else {
            swal("Process canceled.!");
        }
    });
}

function change(oid,status)
{
    var status = document.getElementById("status").value;
    /*if(status == 3){
        //alert(status)
        $("#myModal").modal();
    }  else {
    */    $.ajax({
            type: "POST",
            url: "change_status.php",
    		//datatype:'json',	
            data:'status='+status+"&oid="+oid,
            success: function(msg){
                //alert(msg);
                //var jsr=JSON.parse(msg);
            }
            });
    //}
    
    
    
    // setTimeout(function(){change(oid,status)},5000);

}
</script>