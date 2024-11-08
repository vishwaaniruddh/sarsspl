<?php
foreach ($prodata as $key => $value) {
        $id= $value->item_id;
        $name= $value->name;
        $countryResult[] =  ['id'=>$id,'name'=>$name];
			}
			echo json_encode($countryResult);

?>