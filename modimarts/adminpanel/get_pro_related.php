<?php 
session_start();
include 'config.php';
$type=$_REQUEST['data'];

            $proopt=mysqli_query($con1,"SELECT * FROM `related_group_products` WHERE group_id ='".$type."'");
            $cnt = 1;
            while($row=mysqli_fetch_assoc($proopt)) { 
               
            ?>
            <tr>
                <td><?=$cnt?></td>
                <td><?=$row['product_name']?></td>
                <td><?=$row['cat_id']?></td>
                <td><?=$row['product_status']?></td>
                <td><label class="switch">
                <input type="checkbox" id="<?=$row['id']?>" onchange="checkstatus(this)" <?php if($row['product_status']==1){ echo "checked";}?>>
                <span class="slider round"></span>
                </label></td>
            </tr>
            <?php $cnt++; }?>