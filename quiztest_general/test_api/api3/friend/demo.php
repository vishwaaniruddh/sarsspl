<!--<a href="https://api.whatsapp.com/share" >send </a>-->
<a href="whatsapp://send?text=The text to share!" data-action="share/whatsapp/share">Share via Whatsapp</a>
<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');



$sql=mysql_query("select srno,imgf from quiztest", $con);

$i=0;

while($sql_result=mysql_fetch_assoc($sql)) {

if(!empty($sql_result['imgf'])){
    
    $path_info = pathinfo($sql_result['imgf']);

if($path_info['extension']=='jp' || $path_info['extension']=='j' || $path_info['extension']==''){
    echo $i.' : '.$sql_result['srno'].'=='.$path_info['extension']; // "bill"    
    echo '<br>';  

$i++;    
}







}

}






?>