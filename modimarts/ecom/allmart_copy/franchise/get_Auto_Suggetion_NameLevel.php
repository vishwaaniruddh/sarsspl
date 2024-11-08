<?php
include 'config.php';
$RefMobile=$_POST['RefMobile'];

$data=array();
 $result=mysqli_query($conn,"select name,level_id,loc_id,position_id from member where mobile='".$RefMobile."' ");
 $row = mysqli_fetch_array($result);
 //var_dump ($row);
  $result2=mysqli_query($conn,"SELECT dasignation_name FROM `committee_structure`  where id='".$row['position_id']."' ");
 $row2 = mysqli_fetch_array($result2);

                if($row[1] ==1){  $level='country';}
                 else if($row[1] ==2){  $level='zone';}
                  else if($row[1] ==3){  $level='state';}
                   else if($row[1] ==4){  $level='city';}
                    else if($row[1] ==5){  $level='district';}
                     else if($row[1] ==6){  $level='taluka';}
                      else if($row[1] ==7){  $level='pincode';}  
                       else if($row[1] ==8){  $level='village';}


$result3=mysqli_query($conn,"SELECT $level FROM `$level`  where id='".$row[2]."' ");
 $row3 = mysqli_fetch_array($result3);

 
    $data[]=['name'=>$row[0],'level_id'=>$level,'loc_id'=>$row3[0],'position_id'=>$row2[0]];
 
 echo json_encode($row) ;
 //var_dump( $row);
?>