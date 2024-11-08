<?php

include "../../../config.php";

function update($table,$parameter,$where)
{
    global $con;
   
    $update= "update `$table` set $parameter where $where";
    $sql=mysqli_query($con,$update);
     
    if($sql)
    {
        return true;
    }
    else
    {
        echo "Error: <br>" . mysqli_error($con);
        
    }
}


$array= customer_id='16';
    
    $getdata= mysqli_query($con,"SELECT * FROM `customer_promotion` WHERE $array ");
   $getdatares = mysqli_fetch_assoc($getdata);
    
    var_dump($getdatares);
    
    

 
   
 
?>