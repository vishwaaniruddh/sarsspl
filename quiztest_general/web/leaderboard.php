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
        url(httpa://sarmicrosystems.in/quiztest/web/asset/laptop.jpg);
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
    <h2 class="heading">Leaderboard</h2>
    </div>
</div>




<div class="custom_margin"></div>

  <h1 class="h1_friend">Leaderboard</h1>

<div class="custom_margin"></div>

<div class="container">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <!--<th scope="col">ID</th>-->
      <th scope="col">Name</th>
      <th scope="col">Points</th>
    </tr>
  </thead>
  <tbody>
      
                  
<?
$nodes = 'http://sarmicrosystems.in/quiztest/test_api/api/filter/filter.php';
$node_count = count($nodes);

$durationid=1;
$std=$_SESSION['std'];
$subject=1;

$data = array('std' => $std,'subjectid'=>0,'durationid'=>$durationid);

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

    if($result[$i]->name){ 
        
  ?>
    <tr>
      <td><? echo $i+1; ?></th>
      <!--<td><? echo $result[$i]->id?></td>-->
      <td><? echo ucfirst($result[$i]->name);?></td>
      <td><? echo $result[$i]->points?></td>
     
    </tr>
    
    <?          } 
    } ?>
  </tbody>
</table>




 
</div>







<?php include_once('footer.php');?>