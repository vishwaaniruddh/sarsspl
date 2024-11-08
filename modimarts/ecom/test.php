<?php 
    $data=array();
    $fetchorder = 90;
    /*$data[]=['orderId'=>$fetchorder];
    var_dump($data);*/
    echo json_encode($fetchorder);
    echo json_decode($fetchorder);
?>