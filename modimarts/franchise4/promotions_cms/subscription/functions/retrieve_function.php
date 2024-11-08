<?php

include "../../../config.php";

function retrieve($table,$field,$value)
{
    global $con;
   
    $retrieve= "select $field from `$table`";
    $sql=mysqli_query($con,$retrieve);
    
    if($sql)
    {
        return true;
    }
    else
    {
        echo "Error: <br>" . mysqli_error($con);
        
    }
}

    $table="Subscription";
    $field="`name`, `price`, `description`, `validity`";
    $value="'".$name."','".$price."','".$description."','".$validity."''";
    
    var_dump(retrieve($table,$field,$value));
// $view_member= "SELECT `customer_id`, `customer_name`, `customer_address`, `content`, `logo`, `image`, `status`, `created_at`, `updated_at` FROM `customer_promotion`";

?>