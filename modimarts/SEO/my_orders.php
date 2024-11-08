<?php

session_start();
 include('head.php');
 if(!isset($_SESSION['gid']))
 {
  ?>
  <script>
    alert('Login Please');
    window.location.href="login.php";
  </script>
  <?php
 }
 else
 {
  $user_id=$_SESSION['gid'];
 }
?>



<nav class="breadcrumb" aria-label="breadcrumbs">

        <div class="container-bg">

          <h1>Orders</h1>

          <a href="index.php" title="Back to the frontpage">Home</a>



          <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>

          <span>Order</span>

        </div>

      </nav>



      <main class="main-content">

        <div class="dt-sc-hr-invisible-small"></div>



        <div class="wrapper">

          <div class="grid-uniform">

            <div class="grid__item">

              <div class="container-bg">

                <div class="grid__item">

                  <div class="user-account">

                    <div class="grid__item text-center">
                      <div id="CustomerLoginForm">
                        <table>
                          <tr>
                            <th>S No</th>
                            <th>Order Id</th>
                            <th>Order Date</th>
                            <th>Order amount</th>
                            <th>Order Status</th>
                            <th>Order Details</th>
                          </tr>
                          <?php 

                          $sql11        = mysqli_query($con1, "select * from Order_ent where user_id='" . $user_id . "'  ORDER BY `Order_ent`.`id` DESC");
                            $i=1;
                            while ($sql11_result = mysqli_fetch_assoc($sql11)) {
                              ?>
                              <tr>
                                <td><?=$i?></td>
                                <td>#<?=$sql11_result['id']?></td>
                                <td><?=date('D, d-m-Y',strtotime($sql11_result['date']))?></td>
                                <td><b>Rs. <?=$sql11_result['amount']?></b></td>
                                <td>
                                  <?php
                                  if ($sql11_result['status']==0) {
                                   echo "<span class='btn btn-default' style='color:yellow;'>Waiting For approval</span>";
                                  }
                                  if ($sql11_result['status']==1) {
                                   echo "<span class='btn btn-default' style='color:blue;'>Waiting For Dispatch</span>";
                                  }
                                  if ($sql11_result['status']==2) {
                                     echo "<span class='btn btn-default' style='color:orange;'>Dispatch</span>";
                                  }
                                  if ($sql11_result['status']==3) {
                                     echo "<span class='btn btn-default' style='color:green;'>Delivard</span>";
                                  }
                                  if ($sql11_result['status']==4) {
                                    echo "<span class='btn btn-default' style='color:red;'>Rejected</span>";
                                    
                                  }
                                  ?>
                                </td>
                                <td><a href="order_details.php?orderid=<?=$sql11_result['id']?>" class="btn btn-primary">Details</a></td>
                              </tr>
                              <?php  
                              $i++;                            
                            }
                          ?>
                        </table>
                       

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>



        <div class="dt-sc-hr-invisible-large"></div>

      </main>

<?php include('footer.php');?>