<?php
include('config.php');
$val=$_GET['val'];
$j=0;
$str="select distinct(problem) from atmassets where status=0";
$str2="select distinct(now) from atmassets where status=0";
?>
<table width="100%"><tr style="background-color:grey"><td align="center">Sr No</td><td align="center">Nature of Problem</td><td align="center">Work Type</td><td align="center">Issues</td><td align="center">Remark</td><td align="center">Client Docket Number</td><!--<td align="center">Quantity</td><td align="center">Unit (e.g. pc,nos)</td><td align="center">Rate</td>--></tr>
<tr><td colspan="2" id="mater2">
    </td></tr>
    
    <?php for($i=0;$i<$val;$i++){
	?>
	<tr><td><?php echo $j=$j+1; ?></td>
	<td width="175">
	<select style="width:170px;"  name="now[]" id="now<?php echo $i; ?>" /> 
        <option value="housekeeping">Housekeeping</option>
<option value="caretaker">Caretaker</option>
<option value="maintenance">Maintenance</option>
<option value="other">Other</option>


	</select>
	</td>
	
	<td  width="175">
	<input  style="width:170px;" type="text" name="asst[]" id="asst<?php echo $i; ?>" 
	
	</td>
        <td  width="175"><input  style="width:170px;" type="text" name="material[]" id="material<?php echo $i; ?>" style="width:100px;" /></td>

      <td ><input style="width:170px;" type="text" name="memo[]" id="memo<?php echo $i; ?>"/></td>
      <td><input style="width:170px;" type="text" name="docno[]" id="docno<?php echo $i; ?>"/></td>
      <td><input type="hidden" name="qty[]" id="qty<?php echo $i; ?>" value="1"/></td>
      <td><input type="hidden" name="unit[]" id="unit<?php echo $i; ?>" /></td>
      <td><input type="hidden" name="rate[]" id="rate<?php echo $i; ?>" value="0" style="text-align:right" /></td>
     </tr>
	<?php
	} ?>
    </table>