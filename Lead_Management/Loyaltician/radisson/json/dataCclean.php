<? include('Og_config.php');


function clean($string) {
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

$count = 0 ; 


$sql = mysqli_query($conn,"select * from Leads_table");
while($sql_result = mysqli_fetch_assoc($sql)){

    $FirstName = clean($sql_result['FirstName']);
    $LastName = clean($sql_result['LastName']);

    $id = $sql_result['Lead_id'];
    
    if(mysqli_query($conn,"update Leads_table set FirstName='".$FirstName."',LastName='".$LastName."' where Lead_id='".$id."'")){
        $count++;
    }
    
}

echo $count . ' Updated !'
?>