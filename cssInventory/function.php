<? include('config.php');


function get_material($id){
    global $css;
    
    $sql = mysqli_query($css,"Select * from material where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['material'];
}

function mis_details_data($parameter,$id){
    global $css;
    
    $sql = mysqli_query($css,"select $parameter from mis_details where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
}

function mis_history_data($parameter,$id){
    global $css;
    // echo "select $parameter from mis_history where mis_id='".$id."' and $parameter is not null and $parameter <> '' order by id desc" ; 
    $sql = mysqli_query($css,"select $parameter from mis_history where mis_id='".$id."' and $parameter is not null and $parameter <> '' order by id desc");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
}

?>