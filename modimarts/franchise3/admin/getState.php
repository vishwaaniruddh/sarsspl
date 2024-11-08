<?php 
 include('../config.php');	
 $zone=$_POST['zone'];

 $getdata=mysqli_query($con3,"SELECT * FROM `new_state` WHERE zone ='".$zone."' AND status='1'");
    ?>
<select class="form-control">
    <option value="0">Select State</option>
    <?php
    foreach ($getdata as $key => $value) {
        ?>
        <option value="<?=$value['id']?>"><?=$value['state']?></option>
        <?php
    }
     ?>
     </select>