<?php 
foreach ($getbatch as $key => $batch) {
	?>
	<option value="<?=$batch->batch_no?>"><?=$batch->batch_no?></option>
	<?php
}
 ?>