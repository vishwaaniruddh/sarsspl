<?php

$oldimgid=$_GET['oldimgid'];
?>


<td>Product Image:</td><td colspan="3"><input type="file" id="image" name="image[]" class="form"> 
<?php 

if($oldimgid!="")
{
?>
<input type="hidden" name="oldimgid[]"  />
<?php
}
?>


</td>
