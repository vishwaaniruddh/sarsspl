<?php 
 include('../config.php');  
 $taluka=$_POST['taluka'];

 $getdata=mysqli_query($con3,"SELECT * FROM `new_pincode` WHERE taluka ='".$taluka."' AND status='1'");
    ?>
<select class="form-control">
    <option value="0">Select Pincode</option>
    <?php
    foreach ($getdata as $key => $value) {
        ?>
        <option value="<?=$value['id']?>"><?=$value['pincode']?></option>
        <?php
    }
     ?>
     </select>