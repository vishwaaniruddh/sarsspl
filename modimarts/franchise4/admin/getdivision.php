<?php 
 include('../config.php');  
 $state=$_POST['state'];

 $getdata=mysqli_query($con3,"SELECT * FROM `new_division` WHERE state ='".$state."' AND status='1'");
    ?>
<select class="form-control">
    <option value="0">Select Division</option>
    <?php
    foreach ($getdata as $key => $value) {
        ?>
        <option value="<?=$value['id']?>"><?=$value['division']?></option>
        <?php
    }
     ?>
     </select>