<?php 
 include('../config.php');  
 $pincode=$_POST['pincode'];

 $getdata=mysqli_query($con3,"SELECT * FROM `new_village` WHERE pincode ='".$pincode."' AND status='1'");
    ?>
<select class="form-control">
    <option value="0">Select Vilage</option>
    <?php
    foreach ($getdata as $key => $value) {
        ?>
        <option value="<?=$value['id']?>"><?=$value['village']?></option>
        <?php
    }
     ?>
     </select>