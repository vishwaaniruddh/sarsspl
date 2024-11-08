<?php
foreach ($invoice as $key => $value) {
        $id= $value->pur_id;
        $name= $value->bill_id;
        $countryResult[] =  ['id'=>$id,'name'=>$name];
			}
 echo json_encode($countryResult);

?>