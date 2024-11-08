<?php

include "../../../config.php";

function read($table,$field)
{
    global $con;
   
    $read= "select $field from `$table`";
    $sql=mysqli_query($con,$read);
    
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
    $field="`customer_name`, `customer_address`, `content`, `image`,`logo`, `status`, `created_at`, `updated_at`";
    // $value="'".$customer_name."','".$customer_address."','".$content."', '".$target_dir."','".$target_dir1."','".$status."'";
    
    var_dump(read($table,$field));
// $view_member= "SELECT `customer_id`, `customer_name`, `customer_address`, `content`, `logo`, `image`, `status`, `created_at`, `updated_at` FROM `customer_promotion`";

?>