<?php session_start(); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php 

include('../config.php');

// var_dump($_POST);
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

// var_dump($con3);

function get_position_name($level)
{
    global $con3;

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
    global $con3;

    $sql        = mysqli_query($con3, "select * from new_country where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['country'];
}

function zone_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select * from new_zone where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['zone'];
}

function state_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select * from new_state where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['state'];
}

function division_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select * from new_division where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['division'];
}

function district_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select * from new_district where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['district'];
}

function taluka_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select * from new_taluka where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['taluka'];
}

function pincode_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select * from new_pincode where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['pincode'];
}

function village_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select * from new_village where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['village'];
}



$userid=$_POST["userid"];
$oldcountry=$_POST["oldcountry"];
$oldzone=$_POST["oldzone"];
$oldstate=$_POST["oldstate"];
$olddivision=$_POST["olddivision"];
$olddistrict=$_POST["olddistrict"];
$oldtaluka=$_POST["oldtaluka"];
$oldpincode=$_POST["oldpincode"];
$oldvillage=$_POST["oldvillage"];
$oldaddress=$_POST["oldaddress"];


$country=$_POST["country"];
$zone=$_POST["zone"];
$state=$_POST["state"];
$division=$_POST["division"];
$district=$_POST["district"];
$taluka=$_POST["taluka"];
$pincode=$_POST["pincode"];
$village=$_POST["village"];
$address=$_POST["address"];

$levelid=1;

if (isset($_POST["country"]) && $_POST["country"]!=0 ) {
	
	$levelid=1;
	$placename=country_name($country);
}
else
{
	$country=0;
}

if (isset($_POST["zone"]) && $_POST["zone"]!=0 ) {
	
	$levelid=2;
	$placename=zone_name($zone);
}
else
{
	$zone=0;
}

if (isset($_POST["state"]) && $_POST["state"]!=0 ) {
	

	$levelid=3;
	$placename=state_name($state);
}
else
{
	$state=0;
}

if (isset($_POST["division"])&& $_POST["division"]!=0 ) {
	
	$levelid=4;
	$placename=division_name($division);
}
else
{
 $division=0;	
}

if (isset($_POST["district"])&& $_POST["district"]!=0 ) {
	
	$levelid=5;
	$placename=district_name($district);
}
else
{
  $district=0;	
}

if (isset($_POST["taluka"])&& $_POST["taluka"]!=0 ) {
	
	$levelid=6;
	$placename=taluka_name($taluka);
}
else
{
	$taluka=0;
}

if (isset($_POST["pincode"])&& $_POST["pincode"]!=0 ) {
	
	$levelid=7;
	$placename=pincode_name($pincode);
}
else
{
	$pincode=0;
}

if (isset($_POST["village"])&& $_POST["village"]!=0 ) {
	
	$levelid=8;
	$placename=village_name($village);

}
else
{
	$village=0;
}


if(isset($_POST['submit']))
{
	$oldplace = array(
		'country' => $oldcountry,
		'zone' => $oldzone,
		'state' => $oldstate,
		'division' => $olddivision,
		'district' => $olddistrict,
		'taluka' => $oldtaluka,
		'pincode' => $oldpincode,
		'village' => $oldvillage,
		 );
	$oldplace=json_encode($oldplace);

	$newplace = array(
		'country' => $country,
		'zone' => $zone,
		'state' => $state,
		'division' => $division,
		'district' => $district,
		'taluka' => $taluka,
		'pincode' => $pincode,
		'village' => $village,
		 );
	$newplace=json_encode($newplace);

	
    $positionname=get_position_name($levelid);
	$date=date('Y-m-d H:i:s');

	$userName=$_SESSION['username'];
	$getrecentdata=mysqli_fetch_assoc(mysqli_query($con3,"SELECT created_at,updated_date FROM `new_member` WHERE id='".$userid."'"));

	$enddate = ($getrecentdata['updated_date']!='') ? $getrecentdata['updated_date'] : $getrecentdata['created_at'] ;


	$updatedQuery=mysqli_query($con3,"UPDATE `new_member` SET `level_id`='".$levelid."',`country`='".$country."',`zone`='".$zone."',`state`='".$state."',`division`='".$division."',`district`='".$district."',`taluka`='".$taluka."',`village`='".$village."',`location`='".$address."',`pincode`='".$pincode."',`status`='2',`star`='".$positionname."',`position_name`='".$placename."',`updated_by`='".$userName."',`updated_date`='".$date."' WHERE id='".$userid."'");

	
	if ($updatedQuery) {

		$getpostionStatus=mysqli_query($con3,"SELECT id FROM `new_member` WHERE `level_id`='".$levelid."' AND  `country`='".$country."' AND `zone`='".$zone."' AND `state`='".$state."' AND `division`='".$division."' AND `district`='".$district."'  AND `taluka`='".$taluka."' AND `village`='".$village."' AND status='1'");
		$spacefound=mysqli_num_rows($getpostionStatus);
		if($spacefound)
		{
         echo "Position Filled";
        ?>
		<script>
		    Swal.fire(
		  'Failed',
		  'Position Filled  Stay In Waiting Position',
		  'error'
		).then(function() {
		     window.location = "https://www.modimart.world/franchise2/admin/member_edit.php?id=<?=$userid?>"
		});
		</script>
		<?php
		}
		else
		{
        $updatedQuery=mysqli_query($con3,"UPDATE `new_member` SET `status`='1' WHERE id='".$userid."'");
        echo "Position Not Filled";
		?>
		<script>


		    Swal.fire(
		  'Success',
		  'Allote Position And Change Status',
		  'success'
		).then(function() {
		    window.location = "https://www.modimart.world/franchise2/admin/member_edit.php?id=<?=$userid?>"
		});

		</script>
		<?php
       
		}

		$retVal = ($spacefound==1) ? 0 : 1 ;


	$mysql=mysqli_query($con3,"INSERT INTO `franchise_transfer_history`(`mem_id`, `before_place`, `updated_place`, `start_date`, `end_date`, `update_at`, `updated_by`,`allot_Status`) VALUES ('".$userid."','".$oldplace."','".$newplace."','".$enddate."','".$date."','".$date."','".$userName."','".$retVal."')");
?>

<?php
} else {
    echo "There Are Some Error";
      ?>
<script>
    
    Swal.fire(
  'Failed',
  'Process Not Completed',
  'error'
).then(function() {
    window.location = "https://www.modimart.world/franchise2/admin/member_edit.php?id=<?=$userid?>";
});
</script>
<?php
}

}



 ?>