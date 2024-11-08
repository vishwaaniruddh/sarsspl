<?php 
 include('../config.php');  
 $division=$_POST['division'];

 $getdata=mysqli_query($con3,"SELECT * FROM `new_district` WHERE division ='".$division."' AND status='1'");
    ?>
<select class="form-control">
    <option value="0">Select District</option>
    <?php
    foreach ($getdata as $key => $value) {
        ?>
        <option value="<?=$value['id']?>"><?=$value['district']?></option>
        <?php
    }
     ?>
     </select>