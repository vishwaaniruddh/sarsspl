<?php session_start();
include_once('header.php');?>
<?php include_once('menu.php');?>


<style>
    .module{
        background: 
        linear-gradient(
        rgba(0, 0, 0, 0.6),
        rgba(0, 0, 0, 0.6)
        ),
        url(httpa://sarmicrosystems.in/quiztest/web/asset/woman_sitting.jpg);
        background-size: cover;
        width: 100%;
        height: 700px;
        /*margin: 10px 0 0 10px;*/
        position: relative;
        float: left;
    }
.heading h2 {
  font-family: 'Roboto', sans-serif;
  font-weight: 900;
  color: white;
  text-transform: uppercase;
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 2rem;
  transform: translate(-50%, -50%);
}
    
</style>   

    <div class="banner">
        <div class="module">
            <h2 class="heading">Notification</h2>
        </div>
    </div>








<div class="custom_margin"></div>

            <div class="container">
        <div class="row" >
<?

$nodes = array('http://sarmicrosystems.in/quiztest_general/api/like_minded/notification.php','http://sarmicrosystems.in/quiztest_general/api/player/notification.php','http://sarmicrosystems.in/quiztest_general/api/group/group_create_join_req.php');



$node_count = count($nodes);


$userid=$_SESSION['userid'];



$data = array('player2' => $userid,);

for($i=0;$i<$node_count;$i++){
    
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

 $context  = stream_context_create($options);

$result[] = file_get_contents($nodes[$i], false, $context);

}

if ($result === FALSE) { 
    
    echo '0';
    
}
else{



// Like Minded Quiz Notification
$like_minded=json_decode($result[0]);

 for($i=0;$i<sizeof($like_minded);$i++){ 

  $player_id=$like_minded[$i]->notification;
 $player_id=$like_minded[$i]->player1;
  $player_name=$like_minded[$i]->player1_name;
  $testid=$like_minded[$i]->testid;
  $topic=$like_minded[$i]->topic;
  $subject=$like_minded[$i]->subject;
  $notification_type=$like_minded[$i]->notification;
  
  
  if($testid){ ?>
    <div class="col-md-5 custom_col <? echo $subject;?>">
                <p class="name">Name: <? echo ucfirst($player_name);?></p>
                <p class="subject">subject: <? echo ucfirst($subject); ?></p>
                <p class="topic">Topic: <? echo ucfirst($topic) ?></p>
                <p>
                    <a href="#" class="btn btn-danger">Reject</a> | 
                    <a href="#" class="btn btn-success">Accept</a>
                </p>
            </div>
  
  <?}
  
  
 }
 
 // Friends Quiz Notification
 
$friends=json_decode($result[1]);

 for($i=0;$i<sizeof($friends);$i++){ 

  $player_id=$friends[$i]->notification;
 $player_id=$friends[$i]->player1;
  $player_name=$friends[$i]->player1_name;
  $testid=$friends[$i]->testid;
  $topic=$friends[$i]->topic;
  $subject=$friends[$i]->subject;
  $notification_type=$friends[$i]->notification;
  
  
  
    if($testid){ ?>
    <div class="col-md-5 custom_col <? echo $subject;?>">
                <p class="name">Name: <? echo ucfirst($player_name);?></p>
                <p class="subject">subject: <? echo ucfirst($subject); ?></p>
                <p class="topic">Topic: <? echo ucfirst($topic) ?></p>
                <p>
                    <a href="#" class="btn btn-danger">Reject</a> | 
                    <a href="#" class="btn btn-success">Accept</a>
                </p>
            </div>
  
  <?}
  
  
  
  
 }




   

          
      
    
  } ?>

  </div>    
    </div>
<div class="custom_margin"></div>



<style>

    
</style>




<?php include_once('footer.php');?>