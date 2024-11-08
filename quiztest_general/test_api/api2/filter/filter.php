<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// For Test Response
// 1 or for all
// time 2 for current month

// $time='6';
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
    
        $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and standard='".$std."' and p2<>'AI' and subject='".$subject."' GROUP BY p1 ORDER BY points DESC LIMIT 10";
}

if($time==1  && $subject==0){
        
        $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and standard='".$std."' and p2<>'AI' GROUP BY p1 ORDER BY points DESC LIMIT 10";
    }


$sql=mysql_query($sql,$con);





while($sql_result=mysql_fetch_assoc($sql)){
    
    
    

$p1=$sql_result['p1'];
    
 $points1=$sql_result['points'];

    $p1=$sql_result['p1'];
    $sqla=mysql_query("SELECT * from quiz_regdetails where id='".$p1."'",$con);
    $sql_resulta=mysql_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
    
    $data[]=['id'=>$p1,'name'=>$name,'points'=>$points1];

 }

$json1=json_encode($data);
// $json1_decode=json_decode($json1);
// }

// var_dump($json1_decode);

//  return;
 
if($time==1 && $subject>0){
    



        $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>=0 and standard='".$std."' and subject='".$subject."' GROUP BY p2 ORDER BY points DESC LIMIT 10";
}

if($time==1  && $subject==0){
        
        $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>=0  and standard='".$std."' group by p2 ORDER BY points DESC LIMIT 10";
    }


$sql2=mysql_query($sql2,$con);





while($sql_result2=mysql_fetch_assoc($sql2)){
    
    
    

$p2=$sql_result2['p2'];
    
 $points2=$sql_result2['points'];

    // $p1=$sql_result2['p1'];

    $sqla=mysql_query("SELECT * from quiz_regdetails where id='".$p2."'",$con);
    $sql_resulta=mysql_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
 
 
 if($p1==$p2){
 $points=$points1+$points2;
      
 }
 


  $data[]=['id'=>$p2,'name'=>$name,'points'=>$points2];
   
}
    $json2=json_encode($data);
    $json2_decode=json_decode($json2);
// }

// var_dump($json2_decode);


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
    
        $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and p2<> 'AI' and standard='".$std."' and subject='".$subject."' GROUP BY p1 ORDER BY points DESC LIMIT 10";
}

if($time==2  && $subject==0){
        
        $sql="SELECT sum(points1) as points,p1 from quiz_result where points1>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and p2<> 'AI' and standard='".$std."' GROUP BY p1 ORDER BY points DESC LIMIT 10";
    }


$sql=mysql_query($sql,$con);





while($sql_result=mysql_fetch_assoc($sql)){
    
    
    

$p1=$sql_result['p1'];
    
 $points1=$sql_result['points'];

    $p1=$sql_result['p1'];
    $sqla=mysql_query("SELECT * from quiz_regdetails where id='".$p1."'",$con);
    $sql_resulta=mysql_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
 
 

 

     $data[]=['id'=>$p1,'name'=>$name,'points'=>$points1];   

}

// $json1=json_encode($data);
// $json1_decode=json_decode($json1);
// }

// var_dump($json1_decode);

//  return;
 
if($time==2 && $subject>0){
    



        $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' and subject='".$subject."' GROUP BY p2 ORDER BY points DESC LIMIT 10";
}

if($time==2  && $subject==0){
        
        $sql2="SELECT sum(points2) as points,p2 from quiz_result where points2>0 and MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and standard='".$std."' GROUP BY p2 ORDER BY points DESC LIMIT 10";
    }


$sql2=mysql_query($sql2,$con);





while($sql_result2=mysql_fetch_assoc($sql2)){
    
    
    

$p2=$sql_result2['p2'];
    
 $points2=$sql_result2['points'];

    // $p1=$sql_result2['p1'];

    $sqla=mysql_query("SELECT * from quiz_regdetails where id='".$p2."'",$con);
    $sql_resulta=mysql_fetch_assoc($sqla);
    $name=$sql_resulta['name'];
 
 
 if($p1==$p2){
 $points=$points1+$points2;
      
 }
 


  $data[]=['id'=>$p2,'name'=>$name,'points'=>$points2];
   
}
    $json2=json_encode($data);
    $json2_decode=json_decode($json2);
// }

// var_dump($json2_decode);

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