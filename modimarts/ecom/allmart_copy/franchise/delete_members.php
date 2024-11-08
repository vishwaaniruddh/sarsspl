<?php
session_start(); //Start the session
include ("config.php");
if(isset($_POST["m"])){
    $membersArray = ($_POST["m"]);
    $idstring="";
    for($i=0; $i<count($membersArray); $i++){
        $idstring = $idstring.($idstring==""?"":",").$membersArray[$i];
    }
    $deleteQ = "DELETE FROM `member` WHERE `id` IN (".$idstring.")";
    $delete = mysqli_query($conn,$deleteQ);
    if($delete){
        echo "1";
    } else {
        echo "0";
    }
} else {
    echo "0";
}
?>