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

    $table="Subscription";
    $field="`name`, `price`, `description`, `validity`";
    $value="'".$name."','".$price."','".$description."','".$validity."'";
    
    var_dump(create($table,$field,$value));
// $insert_member= "insert into `Subscription`(`name`, `price`, `description`, `validity`) values ('".$name."','".$price."','".$description."','".$validity."')";

?>