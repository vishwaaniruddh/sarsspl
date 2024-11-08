<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php'); ?>


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
        <h2 class="heading">History</h2>
    </div>
</div>




<section class="after-loop">
    <div class="container">
        <h1 class="h1_friend">Check Subject Wise</h1>
        <div class="row">
            
<?
$nodes = 'http://sarmicrosystems.in/quiztest_general/api/get_subject.php';
$node_count = count($nodes);
$std=$_SESSION['std'];
$data = array('std' => $std,);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($nodes, false, $context);
$result= json_decode($result);

for($i=0;$i<sizeof($result);$i++){ ?>

    <div class="col-md-5  custom_col <? echo $result[$i]->sub; ?>" id="<? echo $result[$i]->id; ?>">
                <a href="#" class="">
                    <div class="text-center">
                        <h4><? echo $result[$i]->sub; ?></h4>
                        
                        <? if($result[$i]->sub=='Physics'){ ?>
                        <p class="w-75">Physics layouts to help you get started!</p>
                        <? } ?>
                        
                     <? if($result[$i]->sub=='Chemistry'){ ?>
                        <p class="w-75">Chemistry layouts to help you get started!</p>
                        <? } ?>

                        <? if($result[$i]->sub=='Maths'){ ?>
                        <p class="w-75">Maths layouts to help you get started!</p>
                        <? } ?>
                        
                        <? if($result[$i]->sub=='Biology'){ ?>
                        <p class="w-75">Biology layouts to help you get started!</p>
                        <? } ?>
                        
                        
                        
                        <i class="fal fa-pencil-ruler"></i>
                    </div>
                </a>
     </div>
     
    
<? } ?>
        </div>
    </div>
</section>













<div class="container-fluid">
   <h1 class="h1_friend">Overall status</h1>
      <div class="row">
          
      
                 
<?
$nodes = 'http://sarmicrosystems.in/quiztest_general/api/ai/history.php';
$node_count = count($nodes);

$userid=$_SESSION['userid'];
$subid=0;

$data = array('userid' => $userid,'subid'=>$subid);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($nodes, false, $context);
$result= json_decode($result);

for($i=0;$i<sizeof($result);$i++){

    
  
?>
 
    
       <div class="col-xs-4  custom_col">
                <a href="#" class="">
                    <div class="text-center">
                        <h4>Topic: <? echo $result[$i]->topic; ?></h4>
                        
                        <h5>p2: <? echo $result[$i]->p2;?></h5>
                        
                        <p class="w-75">
                            <span>My Count: <? echo $result[$i]->p1_correct_count; ?></span>
                            
                             <span>Opp Count :<? echo $result[$i]->p2_correct_count; ?></span>
                        </p>
                                
                                 <p class="w-75">
                            <span>Winner: <? echo $result[$i]->player_won; ?></span>
                            
                             <span>Date: <? echo $result[$i]->timestamp; ?></span>
                        </p>
                                                
                                                
                        
                        
                        <i class="fal fa-pencil-ruler"></i>
                    </div>
                </a>
     </div>
    
    
<? }

?>

     
     </div>
</div>














<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php'); ?>
