<?php

ini_set('memory_limit','-1');

$sql_details = array(
	'user' => 'sarmicro_LeadMg',
	'pass' => 'sar1234',
	'db'   => 'sarmicro_LeadManagementNew',
	'host' => 'localhost'
);


// $table = 'Leads_table';

$table = "(
    select a.Lead_id,CONCAT(trim(a.FirstName),' ', trim(a.LastName)) AS fullname,a.EmailId,a.MobileNumber,a.ContactNo1,a.State,a.City,b.Name,a.Company,a.Designation,
    CONCAT(d.FirstName,' ',d.LastName) as associate_name , a.Status,
        case when a.Status = 1 then 'Open'
        when a.Status = 2 then 'Closed'
        when a.Status = 3 then 'Suspense'
        when a.Status = 4 then 'Payment Received'
        when a.Status = 5 then 'Member'
        when a.Status = 6 then 'Payment in Process..'
        when a.Status = 7 then 'Ready For Payment'
        else '' end as `associate_status` ,
        
        case when a.Status <> 0 then 'Delegated'
        else 'Pending' end as `delegated_status`
        
    from Leads_table a 
    LEFT JOIN Lead_Sources b ON a.LeadSource = b.SourceId
    LEFT JOIN LeadDelegation c ON a.Lead_id = c.LeadId
    LEFT JOIN SalesAssociate d ON c.SalesmanId = d.SalesmanId
    ) tbl";
$primaryKey = 'Lead_id';

$columns = array(
    array( 'db' => 'Lead_id', 'dt' => 0 ), 
    array( 'db' => 'fullname', 'dt' => 1 ),
    array( 'db' => 'EmailId', 'dt' => 2 ),
    array( 'db' => 'MobileNumber', 'dt' => 3 ),
    array( 'db' => 'ContactNo1', 'dt' => 4 ),
    array( 'db' => 'State', 'dt' => 5 ),
    array( 'db' => 'City', 'dt' => 6 ),
    array( 'db' => 'Name', 'dt' => 7 ),
    array( 'db' => 'Company', 'dt' => 8 ),
    array( 'db' => 'Designation', 'dt' => 9),
    array( 'db' => 'associate_name', 'dt' => 10),
    array( 'db' => 'associate_status', 'dt' => 11),
    array( 'db' => 'delegated_status', 'dt' => 12),
    
);


require( 'ssp.class.php' );
// $where ="order by Lead_id limit 30";
echo json_encode(SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,"",""));

