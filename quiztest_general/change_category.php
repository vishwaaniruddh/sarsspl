<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');

 $query="SELECT * FROM `project_catT` where UNDER>21 and UNDER <82";
    $sql=mysqli_query($con,$query);
   
    while($result=mysqli_fetch_assoc($sql)) {
        $std=trim($result['name']);
        var_dump($std);
        mysqli_query($con,"UPDATE `findcat` SET `sub_topic`='".$result['id']."' WHERE sub_topic  ='".$std."'");
        echo"<br/>";
    }
    
?>