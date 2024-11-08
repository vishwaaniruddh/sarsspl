<?php
session_start();
include("config.php");
include("access.php");

$pod=$_GET['pd'];
$rec=$_GET['recf'];

 $dt1=str_replace("/","-",$_GET['st']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_GET['end']);
	$end=date('Y-m-d', strtotime($dt2));



//echo $pod;
$error='';
$str2="select * from ebill_package where pod='".$pod."' and received_from='".$rec."' and DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."' ";
//echo $str2;
$gpod=mysqli_query($con,$str2);


?>




<input type="hidden" id="incr" name="incr" value="1"/>
<table border="1" align="center"  >
  <tr>
  <th width="120" height="30" >Sr No</th>
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
<td align="center"> <?php echo $cnt+1; ?></td>
<td style="display:none"><input type="text" name="pid" id="pid<?php echo $cnt; ?>" value="<?php echo $row[0]; ?>"  readonly="readonly"/></td>
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


</tr>

<?php
$cnt++;

}
?>
<tr>
<td height="30" colspan="10" align="right">Total </td>
<td height="30" align="center"><?php echo $gtotal; ?></td>



</tr>



</table>
