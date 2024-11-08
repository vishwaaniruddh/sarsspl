<?php
include ('config.php');
//var_dump($_POST);
$column=$_POST['col'];
$column_value=$_POST['column_value'];
$ptable=$_POST['ptable']; 
$ctable=$_POST['ctable'];
$data=array();
    /*$sql="select * from ".$table." where ".$column."=".$column_value;*/
    $sql="select * from ".$ptable." where id=(select ".$column." from ".$ctable." where id=".$column_value.")";
    //echo $sql;
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result))
    {
        $data[]=['id'=>$row['id'],'value'=>$row[$ptable]];
    }
//print_r ($data);
echo json_encode($data);

?>