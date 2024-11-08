 <?php
 include('config.php');
 $cnt = $_GET['cnt'];
 $j=$cnt-1;
 ?>

 <td><input type="hidden" value="<?php echo $cnt; ?>" name="sr1[]" id="sr1" class="sr" /><?php echo $cnt; ?></td>
 <td>

     <select style="width:140px;" name="procs[]" id="procs<?php echo $j; ?>" class="proc"
         onchange="proces(<?php echo $j; ?>);">
         <option value="0">Select</option>
         <?php 
				$sq=mysqli_query($con,"select * from procedures where investigation<>'' order by investigation");
				while($ro=mysqli_fetch_row($sq)){
				?>
         <option value="<?php echo $ro[4]; ?>"><?php echo $ro[1]; ?></option>
         <?php } ?>
     </select>
 </td>

 <td><input type="text" name="codes[]" id="codes<?php echo $j; ?>" class="code"></td>

 <td><input type="text" name="others[]" id="others<?php echo $j; ?>" class="other"></td>

 <td><input type="text" name="rates[]" id="rates<?php echo $j; ?>" class="rate" style="width:140px;" /></td>
 <td width="40"><input type="text" name="qtys[]" id="qtys<?php echo $j; ?>" value="1" class="rate"
         style="width:40px;" /></td>
 <td><input type="text" name="amts[]" id="amts<?php echo $j; ?>" class="amt" style="width:140px;" /></td>
 <td><input type="text" name="amtads[]" id="amtads<?php echo $j; ?>" class="amt" style="width:140px;" /></td>
 <td><input type="text" name="rems[]" id="rems<?php echo $j; ?>" class="amt" style="width:140px;" /></td>