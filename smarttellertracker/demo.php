<?php 

var_dump();

return; 
include('config.php');
return ; 
$sql = mysqli_query($con,"select * from mis_history");
while($sql_result = mysqli_fetch_assoc($sql)){
    $id = $sql_result['id'];
    $mis_id = $sql_result['mis_id'];

    $missql = mysqli_query($con,"Select * from mis where id='".$mis_id."'");
    $missqlresult = mysqli_fetch_assoc($missql) ; 
    $lho = $missqlresult['lho'];

    
    mysqli_query($con,"update mis_history set lho ='".$lho."' where id='".$id."'");

    echo "update mis_history set lho ='".$lho."' where id='".$id."'" ; 
    echo '<br />';
}



return ;
$sql = mysqli_query($con,"select * from projectinstallation where lho=''");
while($sql_result = mysqli_fetch_assoc($sql)){
$id = $sql_result['id'];
    $atmid = $sql_result['atmid'];

    $sitessql = mysqli_query($con,"select * from sites where atmid ='".$atmid."'");
    $sitessql_result = mysqli_fetch_assoc($sitessql);
    $lho = $sitessql_result['LHO'];

    mysqli_query($con,"update projectinstallation set lho ='".$lho."' where id='".$id."'");

    echo "update projectinstallation set lho ='".$lho."' where id='".$id."'" ; 
    echo '<br />';
}

?>