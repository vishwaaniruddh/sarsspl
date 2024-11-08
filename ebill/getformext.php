<?php
$val=$_GET['val'];

?>
<table>
<tr><th>Sr No</th><th>Recharge Date</th><th>Recharge Amount</th><th>Tariff Number</th></tr>
<?php
for($i=0;$i<$val;$i++)
{
?>
<tr><td><?php echo $i+1; ?></td>
<td><input type="date" name="paiddt[<?php echo $i; ?>]" id="paiddt<?php echo $i; ?>" value="" placeholder="dd/mm/yyyy"  onclick="displayDatePicker('paiddt<?php echo $i; ?>');"></td>
<td><input type="text" name="paidamt[<?php echo $i; ?>]" id="paidamt<?php echo $i; ?>" value="" placeholder="Amount<?php echo $i+1; ?>" onBlur="gettot()"></td>
<td>*<input type="text" name="tariff[<?php echo $i; ?>]" id="tariff<?php echo $i; ?>" value="" placeholder="Tariff no <?php echo $i+1; ?>">#</td>
</tr>

<?php
}
?>