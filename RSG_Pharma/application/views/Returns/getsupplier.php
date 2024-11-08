<?php
foreach ($supplier as $key => $value) {
        $id= $value->person_id;
        $name= $value->company_name;
        $countryResult[] =  ['id'=>$id,'name'=>$name];
			}
 echo json_encode($countryResult);

?>