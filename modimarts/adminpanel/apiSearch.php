<?php 
include '../apidata.php';
$search=$_POST['proname'];
$records=Prosearch($search);
foreach ($records as $key => $record) {
	?>
	<option data-proid="<?=$record->Product_id?>"  value="<?=$record->Title?>~<?=$record->Product_id?>">
	<?php
}
 ?>