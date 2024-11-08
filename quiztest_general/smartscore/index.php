<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.3/MathJax.js?config=TeX-MML-AM_CHTML"></script>
    </head>
    
    <style>
        .header{
            display:flex;
            justify-content:center;
            border-bottom: 1px solid black;
            margin: 2%;
        }
        .header div{
            margin:auto;
            width:100%;
            text-align:center;
        }
        
        .inner{
            margin:auto 5%;
        }
        p.mcq{
            font-size:20px;
        }
        .inner .row p{
            font-size:18px;
        }
        
    </style>
    <body>
        <div class="header">
            <div>
                <h1>SMARTSCORE ANALYTICS</h1>
            </div>
            
            <div>
                <form action="http://sarmicrosystems.in/quiztest/smartscore/index.php?srno=$srno" method="GET">
                    <input type="text" name="srno" class="form-control" placeholder="Enter Question Id OR Detailed steps ID eg: DSN24">
                </form>

            </a>
            </div>
        </div>
        
        
        
        <?
        $srno=$_GET['srno'];
        
if($srno){
    

    
            if(is_numeric($srno)){
$url = 'http://sarmicrosystems.in/quiztest/smartscore/check_question.php';
$data = array('qid' => $srno);

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


$result=json_decode($result);

//  var_dump($result);
 $mcq=$result[0]->data->mcq;
 
  $is_image=$result[0]->data->is_image;
  
  $a=$result[0]->data->options->a;
  $b=$result[0]->data->options->b;
  $c=$result[0]->data->options->c;
  $d=$result[0]->data->options->d;
  
  $topic=$result[0]->data->topic;
  $sub_topic=$result[0]->data->sub_topic;
  
  $correct_ans=$result[0]->data->correct_ans;
  $final_ans=$result[0]->data->final_a;
  $std=$result[0]->data->std;




if($mcq){
    

?>


        
        <div class="container">
            <div class="row">
                
                <? if($is_image==1){ ?>
                    
                    <p><img src="<? echo  $mcq; ?>"> </p>
                    
                <? } 
                else{ ?>
                    <p class="mcq"><? echo  $mcq; ?></p>                    
                <? }
                ?>

                
                
            </div>
            
            <div class="container">
                
            <div class="inner">
                <div class="row">
                    <p>a: <span><? echo $a; ?></span></p>
                </div>
                <div class="row">
                    <p>b: <span><? echo $b; ?></span></p>
                </div>
                <div class="row">
                    <p>c:  <span><? echo $c; ?></span></p>
                </div>
                <div class="row">
                    <p>d: <span><? echo $d; ?></span></p>
                </div>
                </div>
            </div>
            
            <h3>
                Additionals
            </h3>
            
            <div>
                 <p><label>Standard</label> <span><? echo $std;?></span></p>
                <p><label>Topic</label> <span><? echo $topic;?></span></p>
               <p><label>Sub Topic</label> <span><? echo $sub_topic;?></span></p>
               
                <p><label>Correct Answer</label> <span><? echo $correct_ans;?></span></p>
                
                 <p><label>Final Answer</label> <span><? echo $final_ans;?></span></p>

            </div>   
        </div>
        
        <? }
        else{
            echo 'MCQ empty';
        }
        
            }
            else{



$url = 'http://sarmicrosystems.in/quiztest/smartscore/check_ds.php';
$data = array('ds' => $srno);

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


$result=json_decode($result);

// var_dump($result);
for($i=0;$i<sizeof($result);$i++){
    
  $id=$result[$i]->data->id;
  $mcq=$result[$i]->data->mcq;
 
  $is_image=$result[$i]->data->is_image;
  
  $a=$result[$i]->data->options->a;
  $b=$result[$i]->data->options->b;
  $c=$result[$i]->data->options->c;
  $d=$result[$i]->data->options->d;
  
  $topic=$result[$i]->data->topic;
  $sub_topic=$result[$i]->data->sub_topic;
  
  $correct_ans=$result[$i]->data->correct_ans;
  $final_ans=$result[$i]->data->final_a;
  $std=$result[$i]->data->std;




if($mcq){
    
$counter=$i+1;
?>


        
        <div class="container">
            <div class="row">
                
                <? if($is_image==1){ ?>
                    
                    <p><? echo $counter; ?><img src="<? echo  $mcq; ?>"> </p>
                    
                <? } 
                else{ ?>
                    <p class="mcq"><? echo $counter; ?>. : <? echo  $mcq; ?></p>                    
                <? }
                ?>

                
                
            </div>
            
            <div class="container">
                
                        <div class="inner">
                <div class="row">
                    <p>a: <span><? echo $a; ?></span></p>
                </div>
                <div class="row">
                    <p>b: <span><? echo $b; ?></span></p>
                </div>
                <div class="row">
                    <p>c:  <span><? echo $c; ?></span></p>
                </div>
                <div class="row">
                    <p>d: <span><? echo $d; ?></span></p>
                </div>
                </div>
            </div>
            
            <h3>
                Additionals
            </h3>
            
            <div class="inner">
                
                <p><label>Question ID</label> <span><? echo $id; ?></span></p>
                 <p><label>Standard</label> <span><? echo $std;?></span></p>
                <p><label>Topic</label> <span><? echo $topic;?></span></p>
               <p><label>Sub Topic</label> <span><? echo $sub_topic;?></span></p>
               
                <p><label>Correct Answer</label> <span><? echo $correct_ans;?></span></p>
                
                 <p><label>Final Answer</label> <span><? echo $final_ans;?></span></p>

<hr style="border-bottom:1px solid black;">
            </div>   
        </div>
        
}

        
        <? } 
        
        else{
            echo 'NOT FOUND DS NUMBER';
        }
        
                
}   
                
                
            }
}
        ?>
        
        

        
    </body>
</html>