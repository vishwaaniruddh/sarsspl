<?php

$oldimgid=$_GET['oldimgid'];
?>


<!--<td class="col-sm-1">Image:</td>-->
<td class="col-sm-4"><input type="file" id="image" name="image[]" class="form-control" style="margin: 0px 202px 8px -25px;" /> 
<?php 

if($oldimgid!="")
{
?>
<input type="hidden" name="oldimgid[]"  />
<?php
}
?>


</td>
