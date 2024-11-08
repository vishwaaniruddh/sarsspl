<?php session_start();


include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php'); 
    
    $userid=$_SESSION['userid'];
    $friend_id=$_GET['id'];

    $url = 'http://sarmicrosystems.in/quiztest_general/api/friend/unfriend.php';
$data = array('userid' => $userid, 'friendid' => $friend_id);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if($result==1 || $result=='1'){
    ?> 
   <script>
       swal("Unfriend failed!");
       setTimeout(function(){
           window.history.back();
           
       }, 3000);

   </script>
<?

}
else{ ?> 
   <script>
       swal("Unfriend success !");
        setTimeout(function(){
           window.history.back();
           
       }, 3000);
   </script>
<? }
    ?>




<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php'); ?>