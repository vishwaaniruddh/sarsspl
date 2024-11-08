<?php 
 include('../config.php');  
 $district=$_POST['district'];

 $getdata=mysqli_query($con3,"SELECT * FROM `new_taluka` WHERE district ='".$district."' AND status='1'");
    ?>
<select class="form-control">
    <option value="0">Select Taluka</option>
    <?php
    foreach ($getdata as $key => $value) {
        ?>
        <option value="<?=$value['id']?>"><?=$value['taluka']?></option>
        <?php
    }
     ?>
     </select>