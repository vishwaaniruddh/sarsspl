<? include('config.php');

$member_id = $_POST['member_id']; 


// $member_id = 267;

if($member_id){

// echo "select * from new_member where intro_id = '".$member_id."' and status=1 and intro_id !='0' and id != '".$member_id."'";
$sql = mysqli_query($con,"select * from new_member where intro_id = '".$member_id."' and status=1 and intro_id !=0 and id != '".$member_id."'");



    echo '<table class="table table-hover table-striped"><thead><th>#</th><th>Name</th><th>Mobile</th></thead><tbody>';

$i=1;
while($sql_result = mysqli_fetch_assoc($sql)){ 
    
    $name = $sql_result['name'];
    $mobile = $sql_result['mobile'];

    
    echo '</tr><td>'.$i.'</td>';
        echo '<td>'.$name.'</td>';
        
        echo '<td>'.$mobile.'</td></tr>';

    $i++;
 
}

echo '</tbody>
</table>';
}