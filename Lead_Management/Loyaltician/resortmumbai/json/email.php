<?php

ini_set('memory_limit','-1');
include('config.php');

// $sql_details = array(
// 	'user' => 'sarmicro_LeadMg',
// 	'pass' => 'sar1234',
// 	'db'   => 'sarmicro_LeadManagementNew',
// 	'host' => 'localhost'
// );


// $table = 'Leads_table';

$table = "(
    select mem_id,Primary_nameOnTheCard from Members
    ) tbl";
$primaryKey = 'mem_id';

$columns = array(
    array( 'db' => 'mem_id', 'dt' => 0 ), 
    array( 'db' => 'Primary_nameOnTheCard', 'dt' => 1 ),

);


require( 'ssp.class.php' );
// $where ="order by Lead_id limit 30";
echo json_encode(SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,"",""));

