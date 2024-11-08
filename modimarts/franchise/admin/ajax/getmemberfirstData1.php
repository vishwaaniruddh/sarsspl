<?php
include 'config.php';
include '../config.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function get_position_name($level)
{
    global $con;

    if ($level == 1) {
        $level = 'Country';
    } else if ($level == 2) {
        $level = 'Zone';

    } else if ($level == 3) {
        $level = 'State';
    } else if ($level == 4) {
        $level = 'Division';
    } else if ($level == 5) {
        $level = 'District';
    } else if ($level == 6) {
        $level = 'Taluka';
    } else if ($level == 7) {
        $level = 'Pincode';
    } else if ($level == 8) {
        $level = 'Village';
    }

    return $level;
}

function country_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_country where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['country'];
}

function zone_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_zone where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['zone'];
}

function state_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_state where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['state'];
}

function division_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_division where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['division'];
}

function district_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_district where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['district'];
}

function taluka_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_taluka where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['taluka'];
}

function pincode_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_pincode where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['pincode'];
}

function village_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_village where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['village'];
}

function get_mem_bred($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from greetings_member where id = '" . $id . "' ");
    $sql_result = mysqli_fetch_assoc($sql);

    $country = $sql_result['country'];
    $country = country_name($country);

    $zone = $sql_result['zone'];
    $zone = zone_name($zone);

    $state = $sql_result['state'];
    $state = state_name($state);

    $division = $sql_result['division'];
    $division = division_name($division);

    $district = $sql_result['district'];
    $district = district_name($district);

    $taluka = $sql_result['taluka'];
    $taluka = taluka_name($taluka);

    $pincode = $sql_result['pincode'];
    $pincode = pincode_name($pincode);

    $village = $sql_result['village'];
    $village = village_name($village);

    $string = $country;
    if ($zone) {
        $string .= ' > ' . $zone;
    }
    if ($state) {
        $string .= '  > ' . $state;
    }
    if ($division) {
        $string .= ' > ' . $division;
    }

    if ($district) {
        $string .= ' > ' . $district;
    }
    if ($taluka) {
        $string .= ' > ' . $taluka;
    }

    if ($pincode) {
        $string .= ' > ' . $pincode;
    }

    if ($village) {
        $string .= ' >' . $village;
    }

    return $string;

}

function get_Activeintro($id)
{
    global $con;
    $sql         = mysqli_query($con, "select count(id) as intro_count from greetings_member where intro_id='" . $id . "' and status=1");
    $sql_result  = mysqli_fetch_assoc($sql);
    $intro_count = $sql_result['intro_count'];
    return $intro_count;
}

function get_Totalintro($id)
{
    global $con;
    $sql        = mysqli_query($con, "select count(id) as intro_count from greetings_member where intro_id = '" . $id . "' and status=1 and id <> '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['intro_count'];
}

function total_qualify($id)
{
    global $con;

    $sql     = mysqli_query($con, "select * from greetings_member where intro_id='" . $id . "' and status=1 and id <> '" . $id . "'");
    $qualify = 0;
    while ($sql_result = mysqli_fetch_assoc($sql)) {

        $id_array[]  = $sql_result['id'];
        $intro_to_id = $sql_result['id'];

        // echo "select count(id) as check_mem from greetings_member where intro_id='".$intro_to_id."' and status=1 and id<> '".$intro_to_id."'";

        $check_sql = mysqli_query($con, "select count(id) as check_mem from greetings_member where intro_id='" . $intro_to_id . "' and status=1 and id<> '" . $intro_to_id . "'");

        $check_sql_result = mysqli_fetch_assoc($check_sql);

        if ($check_sql_result['check_mem'] >= 6) {
            $qualify++;
        }
    }

    return $qualify;
}

        // $type=$_POST['type'];
        // $id=$_POST['id'];

        // $query= $type."=".$id;

$sql = mysqli_query($con, "select * from greetings_member where status=1 AND id='58' order by id ASC ");

$i = 1;

 $columns = array();
while ($sql_result = mysqli_fetch_assoc($sql)) {

        $id = $sql_result['id'];
        $bread         = get_mem_bred($id);
        $position_name = $sql_result['position_name'];
        $star          = $sql_result['star'];
        $name          = $sql_result['name'];
        $status        = $sql_result['status'];

         if ($status==1) {
            $statusA="<a class='btn btn-success btn-sm'>Active</a>";
        }
        if ($status==2) {
            $statusA="<a class='btn btn-warning btn-sm'>Waiting</a>";
        }
        if ($status==0) {
            $statusA="<a class='btn btn-success btn-sm'>Disactive</a>";
        }
        
        $mobile        = $sql_result['mobile'];
        $level         = $sql_result['level_id'];
        $position      = get_position_name($level);
        $from_date     = $sql_result['created_at'];
        $date          = date('Y-m-d');

        $turn_sql        = mysqli_query($con, "select datediff( '" . $date . "',  '" . $from_date . "') as days from greetings_member where id = '" . $id . "'");
        $turn_sql_result = mysqli_fetch_assoc($turn_sql);

        $days_over    = $turn_sql_result['days'];
        $total_intro  = get_Totalintro($id);
        $active_intro = get_Activeintro($id);
        $qualify      = total_qualify($id);

       
        $image            ="";

        $level_id=$sql_result['level_id'];
        $star=$sql_result['star'];
        $country= country_name($sql_result['country']);
        $zone= zone_name($sql_result['zone']);
        $state= state_name($sql_result['state']);
        $division= division_name($sql_result['division']);
        $district= district_name($sql_result['district']);
        $taluka= taluka_name($sql_result['taluka']);
        $pincode= pincode_name($sql_result['pincode']);
        $village=$sql_result['village'];
        $location=$sql_result['location'];
        $pan=$sql_result['pan'];
        $adhar_card=$sql_result['adhar_card'];
        $gst=$sql_result['gst'];
        $intro_id=$sql_result['intro_id'];
        $introducer_name=$sql_result['introducer_name'];
        $introduced_mobile=$sql_result['introducer_mobile'];
        if ($sql_result['mem_status'] == 'p') {
            $mem_status = 'Paid';
        } else {
            $mem_status = 'Unpaid';
        }

        if ($sql_result['is_product_received'] == 1) {
            $is_product_received = '<p id="CNGProst_'.$id.'"><span onclick="CNGProst(0,'.$id.')">Given</span></p>';
        } else {
            $is_product_received = '<p id="CNGProst_'.$id.'"><span onclick="CNGProst(1,'.$id.')">Not Given</span></p>';
        }

        if ($sql_result['created_at'] < '2020-10-22') {
            $amount = 5000;
        } else {
            $amount = 1000;
        }





         $prosql   = mysqli_query($con, "SELECT id,franchise_id FROM `franchise_product` WHERE franchise_id='" . $sql_result['id'] . "' ");
                $procount = mysqli_num_rows($prosql);
            if ($procount) {
                $prodata = mysqli_fetch_assoc($prosql);
                $product_select='<a class="btn btn-info" href="Selected_product.php?id='.$prodata['id'].'">Selected product</a>';
               }
               else
               {
                $product_select="";
               }
               $edit='<a class="btn btn-danger" href="member_edit.php?id='.$sql_result['id'].'">Edit</a>';
               $view='<a class="btn btn-danger" href="member_view.php?id='.$sql_result['id'].'">View</a>';

        $columns[] = ['id' => $id,
         'star' => $star ,
        'position' => $position, 'position_name' => $position_name, 'mobile' => $mobile, 'name' => $name, 'status' => $statusA, 'image' => $image, 'total_intro' => $total_intro, 'active_intro' => $active_intro, 'qualify' => $qualify, 'days_over' => $days_over, 'bread' => $bread,
         'created_at' => $from_date,
         'country' => $country,
         'zone' => $zone,
         'state' => $state,
         'division' => $division,
         'district' => $district,
         'taluka' => $taluka,
         'pincode' => $pincode,
         'village' => $village,
         'location' => $location,
         'pan_card' => $pan,
         'aadhar_card' => $adhar_card,
         'gst' => $gst,
         'introduced_id' => $intro_id,
         'introduced_name' => $introducer_name,
         'introduced_mobile' => $introduced_mobile,
         'paid_status' => $mem_status,
         'product_given_status' => $is_product_received,
         'amount' => $amount,
         'view' => $view,
         'edit' => $edit,
         'product_select' => $product_select
     ];


$i++;}
 // Add the the thead data to the ajax response
$out['data'] = $columns;
// $out['columns'] = ['title'=>'ID','data'=>"id"];
// Send the data back to the client
echo json_encode($out);
?>