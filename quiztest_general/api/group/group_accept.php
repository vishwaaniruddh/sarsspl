<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $userid=85;
// $groupid=40;


// live response
$userid=$_POST['userid'];
$groupid=$_POST['groupid'];


// for accepting group request
$sql="UPDATE group_initiate set is_accepted=1 WHERE group_id='".$groupid."' and requested_to='".$userid."'";
   
  if(mysqli_query($con,$sql)){
    //   echo json_encode('1');
      
       $check_sql=mysqli_query($con,"select * from groups where id='".$groupid."'"); 
    
    $check_sql_result=mysqli_fetch_assoc($check_sql);
    

    for($i=0;$i<4;$i++){
    
        $var="member$i";
        if(empty($check_sql_result[$var])){
    
            $update_sql="UPDATE groups set $var='".$userid."' where id='".$groupid."'";

            if(mysqli_query($con,$update_sql)){
                  echo json_encode('1'); return;
              }
              else{
                  echo json_encode('0');
              }
    
        }
        
    }
    
    
  }
  else{
      echo json_encode('0');
  }
   
//   end
   
   
   
//   to update on groups table 
   
   
    
    // end
    
   
   

    
?>