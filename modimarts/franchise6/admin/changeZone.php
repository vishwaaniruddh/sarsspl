<?php 
 include('../config.php');	
 $country=$_POST['country'];

 $getdata=mysqli_query($con3,"SELECT * FROM `new_zone` WHERE country ='".$country."' AND status='1'");
    $count=mysqli_num_rows($getdata);
    $arrayName = array();
    ?>
<select>
    <option value="0">Select Zone</option>
    <?php
    foreach ($getdata as $key => $value) {
        ?>
        <option value="<?=$value['id']?>"><?=$value['zone']?></option>
        <?php
    }
     ?>
     </select>
