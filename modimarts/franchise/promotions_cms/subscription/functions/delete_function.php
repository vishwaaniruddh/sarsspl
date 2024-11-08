<?php

include "../../../config.php";

function delete($table,$field,$parameter)
{
    global $con;
   
    $deleted= "delete from `$table` where $field=$parameter";
    $sql=mysqli_query($con,$deleted);
    
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
    $field="`id`";
    $value="'".$id."'";
    
    var_dump(delete($table,$field,$parameter));
// $id=$_GET['id'] ;
// // var_dump($id);
// $delete_sql = mysqli_query($con,"DELETE FROM `customer_promotion` WHERE customer_id='".$id."'");

$parameter=array(
    '$id'=>$_GET['$id']
    
    )

?>