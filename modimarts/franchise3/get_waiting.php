<? include('config.php');

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


     <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <td>Name</td>
                                            <td>Mobile</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                   
                                
<?
$sql = mysqli_query($con,"select * from new_waiting where country = '".$country."' and zone='".$zone."' and state='".$state."' and division='".$division."' and district='".$district."' and taluka='".$taluka."' and pincode='".$pincode."' and village ='".$village."'");

$i = 1; 
while($sql_result = mysqli_fetch_assoc($sql)){  ?>
   
           
                    <tr>
                        <td><? echo $i;?></td>
                        <td><? echo $sql_result['name'];?></td>
                        <td><? echo $sql_result['mobile'];?></td>
                    </tr>
                                        

 
<? $i++;  } ?>


                                    </tbody>
                                </table>
                            </div>
                            