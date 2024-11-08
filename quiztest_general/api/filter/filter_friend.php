<?php //include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
include('../functions.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];
// $userid=2;

$sql=mysqli_query($con,"SELECT * from quiz_friends where user_id='".$userid."'");

while($sql_result=mysqli_fetch_assoc($sql)){
    $friend[]=$sql_result['friend_id'];
}

$sql=mysqli_query($con,"SELECT * from quiz_friends where friend_id='".$userid."'");

while($sql_result=mysqli_fetch_assoc($sql)){
    $friend[]=$sql_result['user_id'];
}


$friend = array_unique($friend, SORT_REGULAR);

$friends_id=json_encode($friend);

$friends_id=str_replace( array('[',']','"') , ''  , $friends_id);
$arr=explode(',',$friends_id);
$result_ar = "'" . implode ( "', '", $arr ) . "'";

// For Test Response
// $time='1';
// $std=8;
// $subject=302;

// For Live Response
$time=$_POST['durationid'];
$std=$_POST['std'];
$subject=$_POST['subjectid'];


if($time == 1){
    $time = 1;


// FOR CUMULATIVE LEADERBOARD eg. overalll leaderboard

if($time==1 && $subject>0){
    
    $sql="SELECT sum(points1) as points,p1 from quiz_result where p1 in($result_ar,'".$userid."') and points1>0 and standard='".$std."' and p2<>'AI' and subject='".$subject."' and is_count_points1=1 GROUP BY p1 ORDER BY points DESC LIMIT 10";
}

if($time==1  && $subject==0){
        
    $sql="SELECT sum(points1) as points,p1 from quiz_result where p1 in($result_ar,'".$userid."') and points1>0 and standard='".$std."' and p2<>'AI' and is_count_points1=1 GROUP BY p1 ORDER BY points DESC LIMIT 10";
    }

$sql=mysqli_query($con,$sql);

while($sql_result=mysqli_fetch_assoc($sql)){
    
    $p1=$sql_result['p1'];
    $points1=$sql_result['points'];
    $p1=$sql_result['p1'];
    
    $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$p1."'");
    $sql_resulta=mysqli_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
    
    $data[]=['id'=>$p1,'name'=>$name,'points'=>$points1];

 }

$json1=json_encode($data);

if($time==1 && $subject>0){
    
    $sql2="SELECT sum(points2) as points,p2 from quiz_result where p2 in($result_ar,'".$userid."') and points2>=0 and standard='".$std."' and subject='".$subject."' and is_count_points2=1 GROUP BY p2 ORDER BY points DESC LIMIT 10";
}

if($time==1  && $subject==0){
        
    $sql2="SELECT sum(points2) as points,p2 from quiz_result where p2 in($result_ar,'".$userid."') and points2>=0  and standard='".$std."' and is_count_points2=1 group by p2 ORDER BY points DESC LIMIT 10";
    }

$sql2=mysqli_query($con,$sql2);

while($sql_result2=mysqli_fetch_assoc($sql2)){
    
    $p2=$sql_result2['p2'];
    $points2=$sql_result2['points'];

    $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$p2."'");
    $sql_resulta=mysqli_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
        
        if($p1==$p2){
             $points=$points1+$points2;
        }
 
    $data[]=['id'=>$p2,'name'=>$name,'points'=>$points2];
   
}

if($data){

    foreach($data as $array)
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
            $price[$key] = $row['id'];
            $price[$key] = $row['name'];
            $price[$key] = $row['points'];
            }
            array_multisort($price, SORT_DESC, $data);
            
            echo json_encode($data);
}
        else{
            echo json_encode('No Records !');
        }

}



if($time == 2){
    $time = 2;


// FOR CUMULATIVE LEADERBOARD eg. overalll leaderboard

if($time==2 && $subject>0){
    
        $sql="SELECT sum(points1) as points,p1 from quiz_result where p1 in($result_ar,'".$userid."') and points1>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and p2<> 'AI' and standard='".$std."' and subject='".$subject."' and is_count_points1=1 GROUP BY p1 ORDER BY points DESC LIMIT 10";
}

if($time==2  && $subject==0){
        
        $sql="SELECT sum(points1) as points,p1 from quiz_result where p1 in($result_ar,'".$userid."') and points1>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and p2<> 'AI' and standard='".$std."' and is_count_points1=1 GROUP BY p1 ORDER BY points DESC LIMIT 10";
    }

//echo $sql;
$sql=mysqli_query($con,$sql);

while($sql_result=mysqli_fetch_assoc($sql)){

    $p1=$sql_result['p1'];
    $points1=$sql_result['points'];
    $p1=$sql_result['p1'];
//echo $points1;
    $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$p1."'");
    $sql_resulta=mysqli_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
 
        $data[]=['id'=>$p1,'name'=>$name,'points'=>$points1];   

}

    if($time==2 && $subject>0){
        $sql2="SELECT sum(points2) as points,p2 from quiz_result where p2 in($result_ar,'".$userid."') and points2>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' and subject='".$subject."' and is_count_points2=1 GROUP BY p2 ORDER BY points DESC LIMIT 10";
    }
    
    if($time==2  && $subject==0){
        $sql2="SELECT sum(points2) as points,p2 from quiz_result where p2 in($result_ar,'".$userid."') and points2>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' and is_count_points2=1 GROUP BY p2 ORDER BY points DESC LIMIT 10";
    }
//echo $sql2;
    $sql2=mysqli_query($con,$sql2);

    while($sql_result2=mysqli_fetch_assoc($sql2)){
    
    $p2=$sql_result2['p2'];
    $points2=$sql_result2['points'];
//echo $points2;
    $sqla=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$p2."'");
    $sql_resulta=mysqli_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
 
 
     if($p1==$p2){
         $points=$points1+$points2;
      }
    
        $data[]=['id'=>$p2,'name'=>$name,'points'=>$points2];
   
    }
    
    
    if($data){
   
    foreach($data as $array)
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
            
            echo json_encode($data);
    
        
    }
    
else{
    
    echo json_encode('No Records !');
}

}

?>