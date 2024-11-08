<?php
session_start();
include("config.php");
$val=$_GET['val'];
$id=$_GET['id'];
$quotamt=0;
//echo $val." ".$id;
?>
 <table width="100%"><tr><td align="center">Sr No</td><td align="center">Nature of work</td><td align="center">Component</td><td align="center">Material</td><td align="center">Quantity</td><td align="center">Unit</td><td align="center">Rate</td><td>Supervisor Rate</td></tr>
    
    <?php 
	$i=0;
	$j=0;
	$det=mysqli_query($con,"select * from quot_details where quotid='".$id."' and status='0' order by quotdetid ASC");
	while($detro=mysqli_fetch_row($det)){
	 $quotamt=$quotamt+($detro[3]*$detro[5]);
	 $ck=mysqli_query($con,"select incquot from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' ");
$ckro=mysqli_fetch_row($ck);
	?>
	<tr><td><?php echo $j=$j+1; ?><?php if($ckro[0]=='0'){ ?> <input type="checkbox" name="" onclick="removedet('<?php echo $detro[0]; ?>','1','<?php echo $quotid; ?>','idq<?php echo $i; ?>');"> <?php } ?></td>
	<td>
	
	<select name="now[]" id="now<?php echo $i; ?>" style="width:100px;">
	
	 <option value="<?php echo $detro[9];  ?>" ><?php echo $detro[9];  ?></option>
	 </select></td>
	<td><?php 
	$asst="select distinct(problem) from atmassets where problem<>'' order by problem ASC";
	?>
	
	<select name="asst[]" id="asst<?php echo $i; ?>" onchange="getmat(this.value,'material<?php echo $i; ?>');" style="width:100px;">
	<?php /*$query=mysqli_query($con,$asst);
	while($row=mysqli_fetch_array($query))
	{
	?>
	<option value="<?php echo $row[0];  ?>" <?php if($row[0]==$detro[7]){ echo "selected"; }  ?>><?php echo $row[0];  ?></option>
	<?php
	}*/
	 ?>
	 <option value="<?php echo $detro[7];  ?>" ><?php echo $detro[7];  ?></option>
	 </select></td>
    <td>
    
    <input type="hidden" name="id[<?php echo $i; ?>]" value="<?php echo $detro[0]; ?>" readonly="readonly" id="idq<?php echo $i; ?>" />
    <select name="material[]" id="material<?php echo $i; ?>" />
    <option value="<?php echo $detro[2]; ?>"><?php echo $detro[2]; ?></option>
    </select></td>
    <td><input type="text" name="qty[]" id="qty<?php echo $i; ?>" value="<?php echo $detro[3]; ?>"/></td>
     <td><input type="text" name="unit[]" id="unit<?php echo $i; ?>" value="<?php echo $detro[4]; ?>" <?php if($ckro[0]=='0'){ echo "readonly"; } ?> /></td>
    
    <td><input type="text" name="rate[]" id="rate<?php echo $i; ?>" value="<?php echo round($detro[5]); ?>" onkeyup="calc();" <?php if($ckro[0]=='0'){ echo "readonly"; } ?>  /></td>
     <?php if($_SESSION['designation']=='8'){ ?><td><input type="text" name="suprate[]" id="suprate<?php echo $i; ?>" value="<?php if($detro[8]==0){ echo round($detro[5]); }else echo round($detro[8]); ?>" style='text-align:right'  onkeyup="calc2();" <?php if($ckro[0]=='0'){ echo "readonly"; } ?> /></td><?php } ?>
    <td><div id="del<?php echo $detro[0];  ?>">
	<?php if($_SESSION['designation']==8){ ?><!--<a href="#" onclick="removedet('<?php echo $detro[0]; ?>','1','<?php echo $id; ?>','idq<?php echo $i; ?>');">--><a href="removequotmat.php?detid=<?php echo $detro[0]; ?>" ><img src="images/delete.jpg" height="20px" width="20px"></a><?php } ?></div>
	</td>
    </tr>
	<?php
	$i=$i+1;
	} ?>
    </table>###$$$^^^<?php echo $quotamt; ?>
