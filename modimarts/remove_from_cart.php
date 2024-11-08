<?
include('connect.php');

$id=$_POST['id'];



$delete_sql="delete from cart where id='".$id."'";

    if(mysqli_query($con1,$delete_sql)){
        echo '1';
    }
    else{
        echo '0';    }




?>