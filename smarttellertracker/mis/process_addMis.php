<?php 
include('../config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$response = array();
$response['success'] = false;
$response['message'] = "";


$status = 'open';
$created_by = $userid;
$created_at = $datetime;


$atmid = $_POST['atmid'];
$bank = $_POST['bank'];
$customer = $_POST['customer'];
$zone = $_POST['zone'];
$city = $_POST['city'];
$state = $_POST['state'];
$location = $_POST['location'];
$branch = $_POST['branch'];
$bm = $_POST['bm'];

// $remarks = htmlspecialchars($_POST['emailbody']);
$remarks = filter_var($_POST['remark'], FILTER_SANITIZE_STRING);

$comp = $_POST['comp'];
$subcomp = $_POST['subcomp'];
$docket_no = $_POST['docket_no'];
$call_type = $_REQUEST['call_type'];
$engineer = $_REQUEST['engineer'];

$callby = isset($_REQUEST['callby']) ? $_REQUEST['callby'] : '';
$custom_callby = isset($_REQUEST['custom_callby']) ? $_REQUEST['custom_callby'] : '';

if ($callby == 'custom' && !empty($custom_callby)) {
    $final_callby = $custom_callby;
} else {
    $final_callby = $callby;
}


$callby = $final_callby ; 

$team_type = $_REQUEST['team_type'];

if($team_type == 'technician'){
        $engineer = $_REQUEST['engineer'];
        $engineer_mobile = $_REQUEST['tech_mobile'];
}else if($team_type = 'vendor'){
        $engineer = $_REQUEST['vendor_name'];
        $engineer_mobile = $_REQUEST['vendor_number'];
}




$comsql = mysqli_query($con,"select * from mis_component where id='".$comp."'");
$comsql_result = mysqli_fetch_assoc($comsql);
$comp = $comsql_result['name'];



function generateUniqueReferenceCode() {
    $length = 10;
    $characters = '0123456789abcdefghijlmnopqrstuvwxyz';

    do {
        // Generate a random alphanumeric string
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, strlen($characters) - 1)];
        }

        // Check if the generated code already exists in the mis table
        $isUnique = isReferenceCodeUnique($randomCode);

    } while (!$isUnique);

    return $randomCode;
}

function isReferenceCodeUnique($code) {
    global $con;
    $query = "SELECT COUNT(*) as count FROM mis WHERE reference_code = '$code'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // If count is 0, the code is unique; otherwise, it already exists
    return $row['count'] == 0;
}

// Example usage
$uniqueReferenceCode = generateUniqueReferenceCode();




$sitesql = mysqli_query($con,"select * from sites where atmid='".$atmid."'");
$sitesql_result = mysqli_fetch_assoc($sitesql);
$delegatedToVendorName = $sitesql_result['delegatedToVendorName'];
$delegatedToVendorId = $sitesql_result['delegatedToVendorId'];



$statement = "INSERT INTO mis(reference_code,atmid, bank, customer, zone, city, state, location, call_receive_from, remarks, status, created_by, created_at, branch, bm, call_type,callby) 
VALUES ('".$uniqueReferenceCode."','" . $atmid . "','" . $bank . "','" . $customer . "','" . $zone . "','" . $city . "','" . $state . "','" . $location . "','" . $call_receive . "','" . $remarks . "','open','" . $created_by . "','" . $created_at . "','" . $branch . "','" . $bm . "','" . $call_type . "','".$callby."')";
if (mysqli_query($con, $statement)) {
    $mis_id = $con->insert_id;

    $last_sql = mysqli_query($con, "select id from mis_details order by id desc");
    $last_sql_result = mysqli_fetch_assoc($last_sql);
    $last = $last_sql_result['id'];

    if (!$last) {
        $last = 0;
    }
    $ticket_id = mb_substr(date('M'), 0, 1) . date('Y') . date('m') . date('d') . sprintf('%04u', $last);
    $detail_statement = "insert into mis_details(mis_id,atmid,component,subcomponent,engineer,docket_no,status,created_at,ticket_id,
             mis_city,zone,call_type,case_type,branch,teamType,engineer_number) 
             values('" . $mis_id . "','" . $atmid . "','" . $comp . "','" . $subcomp . "','" . $engineer . "','" . $docket_no[$i] . "','" . $status . "','" . $created_at . "','" . $ticket_id . "','" . $city . "','" . $zone . "','Service','" . $call_receive . "','" . $branch . "','".$team_type."','".$engineer_mobile."')";
    if (mysqli_query($con, $detail_statement)) {

      
            $response['success'] = true;
            $response['message'] = "Call Logged successfully ! TICKET ID : " . $ticket_id;






    }

} else {
    echo mysqli_error($con);
    $response['message'] = "An error occurred while saving the form data.";
}

// Output response as JSON
header('Content-Type: application/json');
echo json_encode($response);