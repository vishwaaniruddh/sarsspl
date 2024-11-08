<?php
session_start();
include("config.php");

$pod=$_GET['podn'];
//echo $pod;

$error='';
$str2="select * from ebill_package where pod='".$pod."' and status='0'";
//echo $str2;
$gpod=mysqli_query($con,$str2);



?>

<input type="hidden" id="incr" name="incr" value="1"/>
<table border="1" align="center"  >
  <tr>
  <th width="120" height="30" style="display:none">Pid No</th>
  <th width="120" height="30">Pod No</th>
 <th width="120" height="30">Atm Id</th>
<th width="120" height="30">Rec From</th>
<th width="120" height="30">Supervisor</th>
<th width="120" height="30">RC</th>
<th width="120" height="30">DC</th>
<th width="120" height="30">SD</th>
<th width="120" height="30">Late Charge</th>
<th width="120" height="30">AMOUNT</th>
<th width="120" height="30">Total Amount</th>

<th width="120" height="30">Ebill Entry</th>

</tr>
  
  <?php	
		$cnt=0;
		$gtotal=0;
		while($row = mysqli_fetch_array($gpod))
		{
			 $gtotal=$gtotal+$row[10];
                 
                $sup=mysqli_query($con,"select hname from fundaccounts where  aid='".$row[3]."'");
                   $svname=mysqli_fetch_array($sup);
 
 
	?>


<tr>
<td style="display:none"><input type="text" name="pid" id="pid<?php echo $cnt; ?>" value="<?php echo $row[0]; ?>"  readonly="readonly"/></td>
<td style="display:none"><input type="text" name="supid" id="supid<?php echo $cnt; ?>" value="<?php echo $row[3]; ?>"  readonly="readonly" /></td>
<td align="center"><?php echo $row[1]; ?></td>
<td align="center"><input type="text" name="atm[]" id="atm<?php echo $cnt; ?>" value="<?php echo $row[4]; ?>"  readonly="readonly"/></td>

<td align="center"><?php echo $row[2]; ?></td>

<td align="center"><?php echo  $svname[0]; ?></td>

<td align="center"><?php echo $row[5]; ?></td>
<td align="center"><?php echo $row[6]; ?></td>

<td align="center"><?php echo $row[7]; ?></td>
<td align="center"><?php echo $row[8]; ?></td>
<td align="center"><?php echo $row[9]; ?></td>
<td align="center"><?php echo $row[10]; ?></td>
<td align="center"><input type="button"  id="vbe<?php echo $cnt; ?>" name="vbe" value="View Bill Entry" onclick="vbefunc(this.id);" /></td>


</tr>

<?php
$cnt++;

}
?>
<tr >
<td height="30" colspan="9" align="right"><b>Total<b> </td>
<td height="30" align="center"><?php echo $gtotal ?></td>
<td height="30" ></td>


</tr>



</table>



















