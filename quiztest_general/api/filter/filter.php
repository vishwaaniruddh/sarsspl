<?php //include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
include('../functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



// For Live Response
$time=$_POST['durationid'];
$std=$_POST['std'];
$subject=$_POST['subjectid'];
$_user_id = $_POST['userid'];


// For Test Response
// 1 or for all
// time 2 for current month

// 0 overall, and respective subject ID




// $time=1;
// $std=8;
// $subject=1;

if($time == 1){


// FOR CUMULATIVE LEADERBOARD eg. overalll leaderboard

if($time==1 && $subject>0){
    
      //  $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and standard='".$std."' and p2!='AI'  and subject='".$subject."' and is_count_points1=1 and p1 not like '%Gr%' and p2 not like '%Gr%' GROUP BY p1 ORDER BY points DESC LIMIT 10";
          $sql="SELECT sum(points) as points,playerid from leaderboards where subject='".$subject."' GROUP BY playerid ORDER BY points DESC LIMIT 10";
}


if($time==1  && $subject==0){
        
    //    $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and standard='".$std."' and is_count_points1=1 and p2!='AI' and p1 not like '%Gr%' and p2 not like '%Gr%' GROUP BY p1 ORDER BY points DESC LIMIT 10";
          $sql="SELECT sum(points) as points,playerid from leaderboards where quizid in (select id from quiz_result where standard='".$std."') GROUP BY playerid ORDER BY points DESC LIMIT 10";
    }
   

$usercheck = 0;
$sql=mysqli_query($con,$sql);

if(mysqli_num_rows($sql)>0){

    while($sql_result=mysqli_fetch_assoc($sql)){
        
        
        $p1=$sql_result['playerid'];
        $points1=$sql_result['points'];
    
        
        if($p1 || !empty($p1)){
            $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$p1."'");
            $sql_resulta=mysqli_fetch_assoc($sqla);
            $name=$sql_resulta['name'];
            
            if($p1==$_user_id){
                $usercheck = 1;
              //  $name = "You";
            }
            
            // Referral points
            if($time==1  && $subject==0){
                $referal_sql = mysqli_query($con,"SELECT sum(points) from referal_points where userid='".$p1."'");
                if(!empty($referal_sql)){
                    $referal_point = 0;
                    $referalsql_resulta=mysqli_fetch_row($referal_sql);
                    $referal_point=$referalsql_resulta[0];
                    $points1 = $points1 + $referal_point;
                }
            }
            
            $data[]=['id'=>$p1,'name'=>$name,'points'=>$points1];        
        }
      }

 }
 if($usercheck == 0){
         // Referral points
        if($time==1  && $subject==0){
            $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$_user_id."'");
            $sql_resulta=mysqli_fetch_assoc($sqla);
            $name=$sql_resulta['name'];
            $points1 = 0;
            $referal_sql = mysqli_query($con,"SELECT sum(points) from referal_points where userid='".$_user_id."'");
            if(!empty($referal_sql)){
                $referal_point = 0;
                $referalsql_resulta=mysqli_fetch_row($referal_sql);
                $referal_point=$referalsql_resulta[0];
                $points1 = $points1 + $referal_point;
            }
           // $name = "You";
            $data[]=['id'=>$_user_id,'name'=>$name,'points'=>$points1];  
        }
        
        
 }

// $json1=json_encode($data);
//echo $json1;
if($data){

/*    foreach($data as $array)
    $counts[$array['id']][] = $array['points'];
    $counts = array_map('array_sum', $counts);

    // var_dump($counts);
        foreach($data as $k => $array)
            $data[$k]['points'] = $counts[$array['id']];
            $data = array_unique($data, SORT_REGULAR);

        $data=array_values($data);
        
            $price = array();
            foreach ($data as $key => $row)
            {
            $price[$key] = $row['points'];
            }
            array_multisort($price, SORT_DESC, $data);
  */          
                         
            echo json_encode($data);


    
}
else{
    echo json_encode('No Records !');
}


}


// FOR Monthly LEADERBOARD 

if($time == 2){
    $time = 2;
    
    
if($time==2 && $subject>0){
    
    //    $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' and p2!='AI'  and subject='".$subject."' and is_count_points1=1 and p1 not like '%Gr%' and p2 not like '%Gr%' GROUP BY p1 ORDER BY points DESC LIMIT 10";
        $sql="SELECT sum(points) as points,playerid from leaderboards where MONTH(quizdate) = MONTH(CURRENT_DATE()) AND YEAR(quizdate) = YEAR(CURRENT_DATE()) and subject='".$subject."' GROUP BY playerid ORDER BY points DESC LIMIT 10";
}        
        
        
if($time==2  && $subject==0){
        
   //     $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and  standard='".$std."' and is_count_points1=1 and p2!='AI' and p1 not like '%Gr%' and p2 not like '%Gr%' GROUP BY p1 ORDER BY points DESC LIMIT 10";
        $sql="SELECT sum(points) as points,playerid from leaderboards where MONTH(quizdate) = MONTH(CURRENT_DATE()) AND YEAR(quizdate) = YEAR(CURRENT_DATE()) and quizid in (select id from quiz_result where standard='".$std."') GROUP BY playerid ORDER BY points DESC LIMIT 10";
    }
 
$sql=mysqli_query($con,$sql);
$usercheck = 0;

if(mysqli_num_rows($sql)>0){
    while($sql_result=mysqli_fetch_assoc($sql)){
        
        $p1=$sql_result['playerid'];
        
        if($p1 || !empty($p1)){
            
            $points1=$sql_result['points'];
            //$p1=$sql_result['p1'];
            $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$p1."'");
            $sql_resulta=mysqli_fetch_assoc($sqla);
            $name=$sql_resulta['name'];  
            
            if($p1==$_user_id){
                $usercheck = 1;
              //  $name = "You";
            }
            
            // Referral points
            if($time==2  && $subject==0){
                $referal_sql = mysqli_query($con,"SELECT sum(points) from referal_points where userid='".$p1."' AND MONTH(CAST(created_at AS DATE)) = MONTH(CURRENT_DATE()) AND YEAR(CAST(created_at AS DATE)) = YEAR(CURRENT_DATE())");
                if(!empty($referal_sql)){
                    $referal_point = 0;
                    $referalsql_resulta=mysqli_fetch_row($referal_sql);
                    $referal_point=$referalsql_resulta[0];
                    $points1 = $points1 + $referal_point;
                }
            }
            
            
            $data[]=['id'=>$p1,'name'=>$name,'points'=>$points1];   
        
            
        }
    }
}
if($usercheck == 0){
         // Referral points
        if($time==2  && $subject==0){
            $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$_user_id."'");
            $sql_resulta=mysqli_fetch_assoc($sqla);
            $name=$sql_resulta['name'];
            $points1 = 0;
            $referal_sql = mysqli_query($con,"SELECT sum(points) from referal_points where userid='".$_user_id."'");
            if(!empty($referal_sql)){
                $referal_point = 0;
                $referalsql_resulta=mysqli_fetch_row($referal_sql);
                $referal_point=$referalsql_resulta[0];
                $points1 = $points1 + $referal_point;
            }
        }
       // $name = "You";
        $data[]=['id'=>$_user_id,'name'=>$name,'points'=>$points1];  
 }
// echo json_encode($data);
// return;


if($data){
   
/*    foreach($data as $array)
    $counts[$array['id']][] = $array['points'];
    $counts = array_map('array_sum', $counts);
    
        foreach($data as $k => $array)
            $data[$k]['points'] = $counts[$array['id']];
            $data = array_unique($data, SORT_REGULAR);

            $data=array_values($data);
        
            $price = array();
            foreach ($data as $key => $row)
            {
                $price[$key] = $row['points'];
            }
            array_multisort($price, SORT_DESC, $data);
  */          
            echo json_encode($data);


}
    else{
            echo json_encode('No Records !');
        }
    }
?>