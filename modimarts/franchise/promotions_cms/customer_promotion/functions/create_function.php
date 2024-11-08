<?php

include "../../../config.php";

function create($table,$field,$value)
{
    global $con;
   
    $create= "insert into `$table`($field) values ($value)";
    $sql=mysqli_query($con,$create);
    
    if($sql)
    {
        return true;
    }
    else
    {
        echo "Error: <br>" . mysqli_error($con);
        
    }
}

    $table="customer_promotion";
    $field="`customer_name`, `customer_address`, `content`, `image`,`logo`, `status`";
    $value="'".$customer_name."','".$customer_address."','".$content."', '".$target_dir."','".$target_dir1."','".$status."'";
    
    var_dump(create($table,$field,$value));

?>