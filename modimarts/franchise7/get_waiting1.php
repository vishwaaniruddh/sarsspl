<? include('config.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function get_Totalintro($id){
    global $con;
    $sql = mysqli_query($con,"select count(id) as intro_count from new_waiting where intro_id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    $intro_count =$sql_result['intro_count'];
    return $intro_count; 
}

function get_Activeintro($id){
    global $con;
    $sql = mysqli_query($con,"select count(id) as intro_count from new_waiting where intro_id='".$id."' and status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    $intro_count =$sql_result['intro_count'];
    return $intro_count; 
}



$country = $_POST['country'];
$zone = $_POST['zone'];
$state = $_POST['state'];
$division = $_POST['division'];
$district = $_POST['district'];
$taluka = $_POST['taluka'];
$pincode = $_POST['pincode'];
$village = $_POST['village'];

if($zone==''){
    $zone = '0';
}
if($state==''){
    $state = '0';
}
if($division==''){
    $division = '0';
}
if($district==''){
    $district = '0';
}
if($taluka==''){
    $taluka = '0';
}
if($pincode==''){
    $pincode = '0';
}
if($village==''){
    $village = '0';
} ?>

<style>
    #waiting_data td,#waiting_data th{
            vertical-align: middle;
    }
</style>


<? if($village > 0){ ?>
    



     <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Position Name</th>
                                            <th>Profile</th>
                                            <th>ID No</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Total Introduction Done</th>
                                            <th>Total Introduced Qualified</th>
                                            <th>Days Over</th>
                                            <th>Turnover</th>
                                            
                                            <th>Status</th>
                                            <th>Visiting Card</th>
                                            <th>View Down Line</th>
                                            <th>Direct Introduction</th>
                                            <th>Promotions</th>
                                            <th>Edit Profile</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                   
                                
<?
$sql = mysqli_query($con,"select * from new_waiting where country = '".$country."' and zone='".$zone."' and state='".$state."' and division='".$division."' and district='".$district."' and taluka='".$taluka."' and pincode='".$pincode."' and village ='".$village."' and status=2 order by id asc");


$counter = 0; 
while($sql_result = mysqli_fetch_assoc($sql)){


    $id            = $sql_result['id'];
    $position_name = $sql_result['position_name'];
    $star          = $sql_result['star'];
    $name          = $sql_result['name'];
    $status        = $sql_result['status'];
    $mobile        = $sql_result['mobile'];

    $total_intro  = get_Totalintro($id);
    $active_intro = get_Activeintro($id);
    
    $image_sql = mysqli_query($con,"select * from new_member_waiting_images where member_id='".$id."' and type='passport'");
    $image_sql_result = mysqli_fetch_assoc($image_sql);
    $image = $image_sql_result['image'];
?>
   
           
                    <tr>
                        <td><? echo $counter+1;?></td>
                        <td><? echo $star;?></td>
                        <td><img src="<? echo $image;?>" style="height:150px;"></td>
                        <td><? echo $id; ?> </td>
                        <td><? echo $name;?></td>
                        <td><? echo $mobile;?></td>
                        <td><? echo $total_intro; ?></td>
                        <td><? echo $active_intro; ?></td>
                        <td></td>
                        <td></td>
                        
                        <td>W/L</td>
                        <td>
                            <a href="new_wait_visiting.php?id=<? echo $id; ?>" class="btn btn-danger">Visiting Card</a>
                        </td>
                        <td></td>
                        <td>
                            
                            <!--<button class="waiting_intro_bt" id="waiting_<? echo $id; ?>">Introduced To</button>-->


                            <button id="waiting_intro_btn" onclick="show_wait('<? echo $id; ?>')" type="button" class="btn btn-info waiting_intro_bt" data-toggle="modal" data-original-title="<? echo $id; ?>" data-target="#waiting_intro_to">Introduced To</button>
                            
                        </td>
                        <td>
                            <a class="btn btn-danger" href="waiting_promotions.php?id=<? echo $id; ?>"> Promotions </a>
                        </td>
                        <td>
                            <a type="button" href="waiting_login.php?id=<? echo $id; ?>" class="btn btn-danger">Edit</button>
                        </td>
                    </tr>
                                        

 
<? 
$counter++;  } 

if($counter <= 10){
    
    $remaining = 10-$counter;
    

for($i = 0;$i<$remaining;$i++){ ?>
   
                       <tr>
                        <td><? echo $counter+$i+1;?></td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        
                        <td>
                            <a id="waiting" href="waiting.php?country=<? echo $country; ?>&zone=<? echo $zone;?>&state=<? echo $state;?>&division=<? echo $division;?>&district=<? echo $district;?>&taluka=<? echo $taluka;?>&pincode=<? echo $pincode;?>&village=<? echo $village;?>" class="btn btn-danger">Apply Waiting</a>
                        </td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    
<? }
}

?>






                                    </tbody>
                                </table>
                            </div>
                     <? } ?>       
                     
                     
                     
                     <script>
                                     function show_wait(waiting_member_id){

            $.ajax({
                type: "POST",
                url: 'get_waiting_child.php',
                data: 'member_id='+waiting_member_id,
                success:function(msg) {
                    $("#waiting_intro").html(msg);
                    }
            });
   
                                        
            }
        
                     </script>