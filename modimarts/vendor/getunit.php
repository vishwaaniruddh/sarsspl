<?php
session_start();
include 'config.php';
 $id= $_POST['id'];
                             $getquery= mysqli_query($con1, "SELECT * FROM `product_variant_master` WHERE under ='$id'");
                            //  $getq =  mysqli_fetch_array($getquery);
                             $count=mysqli_num_rows($getquery);
                             if($count)
                             {
                               while ($qtrow=mysqli_fetch_assoc($getquery)) {
                             ?>
                              <option value="<?=$qtrow['name']?>">
                             <?php
                             }
                             }
?>