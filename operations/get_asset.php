<?php
include('config.php');

$po=$_GET['po'];
$out="";
$qry="SELECT * FROM atm where po='$po'";
$res=mysqli_query($con,$qry);

?>
<select name="ref_id" id="ref_id" onchange="atmid();">
<option value="0">select</option>
<?php
while($atmrow=mysqli_fetch_row($res)){ 
?>
<option value="<?php echo $atmrow[10]; ?>"><?php echo $atmrow[10]; ?></option>
<?php
}
?>
</select>