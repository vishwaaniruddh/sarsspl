<?php
include('config.php');

$cust=$_GET['cust'];
  ?>
 
<select name="po" id="po" onchange="assets();">
<option value="0">select</option>
<?php 
			$result4=mysqli_query($con,"SELECT DISTINCT po FROM `atm`  where cust_id='$cust'");
			while ($row4=mysqli_fetch_row ($result4))
				{ ?>

            <option value="<?php echo $row4[0];?>"><?php echo $row4[0];?></option>
            <?php } ?>
</select>