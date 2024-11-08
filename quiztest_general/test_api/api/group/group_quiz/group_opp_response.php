<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');

// test
// $testid=908;
// $groupid=85;
// $questionid=16076;
// end


// enable for live reponses
$testid=$_POST['testid'];
$groupid=$_POST['groupid'];
$questionid=$_POST['qid'];
// end


// $testid=3141;
// $groupid=48;
// $questionid=14695;


// $testid=3438;
// $userid=85;
// $questionid=13919;
// $groupid=54;



$sql=mysql_query("SELECT * FROM quiz_result where id='".$testid."'",$con);
$get_result=mysql_fetch_assoc($sql);

    // set groupid for group1 or group2

        $group1=$get_result['p1'];
        $group2=$get_result['p2'];
        
         $group1 = preg_replace('/[^0-9]/', '', $group1);
         $group2 = preg_replace('/[^0-9]/', '', $group2);
        
    

if($groupid==$group2){
    
    $sql=mysql_query("SELECT * from group_result where groupid='".$group1."' and testid='".$testid."' and question_id='".$questionid."'");
    
    $sql_result=mysql_fetch_assoc($sql);
    
    if(!$sql_result){
        
        echo -1;
        
    }
    
    else{
          $count_sql=mysql_query("SELECT sum(point) as oppcount from group_result where groupid='".$group1."' and testid='".$testid."'",$con);
          $count_sql_result=mysql_fetch_assoc($count_sql);
          $opp= $count_sql_result['oppcount'];
          
          
          $count_sql1=mysql_query("SELECT sum(point) as oppcount from group_result where groupid='".$group2."' and testid='".$testid."'",$con); 
          $count_sql_result1=mysql_fetch_assoc($count_sql1);
          $my= $count_sql_result1['oppcount'];
          
          
          $data=['oppcount'=>$opp,'mycount'=>$my];
          echo json_encode($data);
        
    }
    
    

      
    

    }
   
   
else{
    
      $sql=mysql_query("SELECT * from group_result where groupid='".$group2."' and testid='".$testid."' and question_id='".$questionid."'");
    
    $sql_result=mysql_fetch_assoc($sql);
    
    if(!$sql_result){
        
        echo -1;
        
    }
    
    else{
          $count_sql=mysql_query("SELECT sum(point) as oppcount from group_result where groupid='".$group2."' and testid='".$testid."'",$con);
          $count_sql_result=mysql_fetch_assoc($count_sql);
          $opp=$count_sql_result['oppcount'];        
          
          $count_sql1=mysql_query("SELECT sum(point) as oppcount from group_result where groupid='".$group1."' and testid='".$testid."'",$con); 
          $count_sql_result1=mysql_fetch_assoc($count_sql1);
          $my=$count_sql_result1['oppcount'];  
          
          
                  $data=['oppcount'=>$opp,'mycount'=>$my];
                  
                  echo json_encode($data);
    }
    
    


  }



?>