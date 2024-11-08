<div id="no_of_partners">
<?php

$nomem=$_GET['nomem'];
$b=1;
for($i=0; $i<$nomem;$i++){ 
?>

<div class="form-group " >
    <div class="col-md-4 inputGroupContainer">
        <div class="input-group "><span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
            <input type="text" id="pancard" name="pancard[]" class="form-control" placeholder="Pancard No of Partner <?php $b=$i+1; echo $b;?>" >
        </div>
    </div>
    <div class="col-md-4 inputGroupContainer">
        <div class="input-group "><span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
            <input type="text" id="Pname" name="Pname[]" class="form-control" placeholder="Name of Partner <?php $b=$i+1; echo $b;?>" >
        </div>
    </div>
    <div class="col-md-4 inputGroupContainer">
        <div class="input-group "><span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
            <input type="text" id="Aadharcard" name="Aadharcard[]" class="form-control" placeholder="Aadhar card of Partner <?php $b=$i+1; echo $b;?>" >
        </div>
    </div> 
</div>
<!--
<div><input type="text" id="pancard" name="pancard[]" class="form-control" placeholder="Pancard No of Partner <?php $b=$i+1; echo $b;?>" required> </div>
<div><input type="text" id="Pname" name="Pname[]" class="form-control" placeholder="Name of Partner <?php $b=$i+1; echo $b;?>" required> </div>
<div><input type="text" id="Aadharcard" name="Aadharcard[]" class="form-control" placeholder="Aadhar card of Partner <?php $b=$i+1; echo $b;?>" required> </div>
-->
<?php
}
?>
</div>