<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php'); ?>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.3/MathJax.js?config=TeX-MML-AM_CHTML"></script>
 
 
 
 
 
<!--QuizStarted_2.mp3-->
<? if(isset($_SESSION['topicid'])){ ?>

<audio id="bg_music" src="QuizStarted_2.mp3"></audio>
<audio id="click" src="click.wav"></audio>

<div class="sound_control" style ="display :flex;" >
    <h5 id="play" onclick="play()" >Play With Sound</h5>
    <h5 id="stop" onclick="pause()" >Play WithOut Sound</h5>
</div>






<p id="score">loading..</p>

<div id="main">

<!-- ** Container ** -->
<div class="container">
<!-- Primary -->
<section id="primary" class="content-full-width">	<!-- #post-11040 -->
<div id="post-11040" class="post-11040 page type-page status-publish hentry">

<div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid weather vc_custom_1528895397433" style="position: relative; left: -116.5px; box-sizing: border-box; width: 1343px; padding-left: 116.5px; padding-right: 116.5px;">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div id="1512644171714-e11e0be0-eaa8" class="dt-sc-empty-space"></div>
                    <article id="post-8700" class="blog-entry blog-default-style format-standard post-8700 post type-post status-publish has-post-thumbnail hentry category-kindergarten tag-dexterity">
                        <!-- Featured Image -->
                        <div class="entry-thumb">
                            
                            <div class="custom_margin"></div>
                                

                       <div class="custom_margin"></div>

                        <div class="entry-format hidden">
                            <a class="ico-format" href=""></a></div>
                        </div>
    
                    <div class="entry-details">


                <div class="privew">
                    <div class="questionsBox">
                        
                        <div class="row score_show"> 
                            
                            <div class="col-md-6">
                                <h3>My Score</h3>
                                <p id="my_score">0</p>
                            </div>
                            <div class="col-md-6">
                                <h3>Opponent Socre</h3>
                                <p id="opp_score">0</p>
                            </div>
                            
                        </div>
                        
                        
                        <div class="modal-header">
                               <h3>
                                   <span id='qno'>loading..</span>
                                    <span class="label label-warning" id="questions">
                                    </span>
                                </h3>
                               
                              <div id="app"></div>
                              
                        </div>
                        
                        <div class="quiz" id="quiz" data-toggle="buttons" style="display: block;">
                            
                            
                            
           <p name="q_answer" value="1" id="a" class="element-animation1 btn btn-lg btn-primary btn-block" onclick="playAudio()">Loading ..</p>

           
            <p class="element-animation2 btn btn-lg btn-primary btn-block" name="q_answer" id="b" value="2" onclick="playAudio()">Loading ..</p>


           <p class="element-animation3 btn btn-lg btn-primary btn-block" name="q_answer" id="c" value="3" onclick="playAudio()">Loading .. </p>
           
           <p class="element-animation4 btn btn-lg btn-primary btn-block" name="q_answer" id="d" value="4" onclick="playAudio()">Loading ..</p>

           
           
       </div>
                        <div class="questionsRow">
                            <a href="#" class="button" id="myBtn">Next</a>
                            <span id="qNo"><label id="current_question"></label> of 10</span>
                        </div>
                        
                        <button id='submit'>submit</button>
                    </div>
                </div>
                    </div>


                        </article>

            </div>

        </div>

    </div>

</div>



<div class="vc_row-full-width vc_clearfix">

</div>

</div>

</section>
</div>
</div>

<p id="final_ans">loading...</p>





<script>
   
   function timer(){
            
            const FULL_DASH_ARRAY = 283;
            const WARNING_THRESHOLD = 10;
            const ALERT_THRESHOLD = 5;
            
            const COLOR_CODES = {
            info: {
            color: "green"
            },
            warning: {
            color: "orange",
            threshold: WARNING_THRESHOLD
            },
            alert: {
            color: "red",
            threshold: ALERT_THRESHOLD
            }
            };
            
            let TIME_LIMIT = 15;
            let timePassed = 0;
            let timeLeft = TIME_LIMIT;
            let timerInterval = null;
            let remainingPathColor = COLOR_CODES.info.color;
            
            document.getElementById("app").innerHTML = `
            <div class="base-timer">
            <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <g class="base-timer__circle">
            <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
            <path
            id="base-timer-path-remaining"
            stroke-dasharray="283"
            class="base-timer__path-remaining ${remainingPathColor}"
            d="
            M 50, 50
            m -45, 0
            a 45,45 0 1,0 90,0
            a 45,45 0 1,0 -90,0
            "
            ></path>
            </g>
            </svg>
            <span id="base-timer-label" class="base-timer__label">${formatTime(
            timeLeft
            )}</span>
            </div>
            `;
            
            
            startTimer(); 
            function onTimesUp() {
            clearInterval(timerInterval);
            }
            
            function startTimer() {
            timerInterval = setInterval(() => {
            timePassed = timePassed += 1;
            timeLeft = TIME_LIMIT - timePassed;
            document.getElementById("base-timer-label").innerHTML = formatTime(
            timeLeft
            );
            setCircleDasharray();
            setRemainingPathColor(timeLeft);
            
            if (timeLeft === 0) {
            onTimesUp();
            }
            }, 1000);
            }
            
            function formatTime(time) {
            const minutes = Math.floor(time / 60);
            let seconds = time % 60;
            
            if (seconds < 10) {
            seconds = `0${seconds}`;
            }
            
            return `${minutes}:${seconds}`;
            }
            
            function setRemainingPathColor(timeLeft) {
            const { alert, warning, info } = COLOR_CODES;
            if (timeLeft <= alert.threshold) {
            document
            .getElementById("base-timer-path-remaining")
            .classList.remove(warning.color);
            document
            .getElementById("base-timer-path-remaining")
            .classList.add(alert.color);
            } else if (timeLeft <= warning.threshold) {
            document
            .getElementById("base-timer-path-remaining")
            .classList.remove(info.color);
            document
            .getElementById("base-timer-path-remaining")
            .classList.add(warning.color);
            }
            }
            
            function calculateTimeFraction() {
            const rawTimeFraction = timeLeft / TIME_LIMIT;
            return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
            }
            
            function setCircleDasharray() {
            const circleDasharray = `${(
            calculateTimeFraction() * FULL_DASH_ARRAY
            ).toFixed(0)} 283`;
            document
            .getElementById("base-timer-path-remaining")
            .setAttribute("stroke-dasharray", circleDasharray);
            }
   }

</script>







<?
$userid=$_SESSION['userid'];
$std=$_SESSION['std'];
$sub=$_SESSION['subjectid'];
$topic=$_SESSION['topicid'];
$ai_type=$_SESSION['ai_type'];

 

$url = 'http://sarmicrosystems.in/quiztest_general/api/ai/get_questions.php';
$data = array('userid'=>$userid,'stdid' => $std,'sub'=>$sub,'topicid'=>$topic);

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
if ($result === FALSE) { 
    
    echo '0';
    
}
else{
  


  $myPhpArray = $result;
  
?>
<script type="text/javascript">
  
    var data = <?= $myPhpArray; ?>;
    var ai_type = '<?= $ai_type; ?>';
    
    
    
    
    var correct_count=0;
    $(document).ready(function() {
 
    $('p').click(function() { 
    var corr = document.getElementById("final_ans").innerHTML;
    var id = $(this).attr('id');
    console.log('corr='+corr+'  given_ans='+id)
    if(corr == id){
        correct_count++;
    }

});



        var timecount=1;
        var counter=0;
        var opp_correct_counter=document.getElementById("opp_score");
        
        
  
    
    
        if(counter <11){
            
        setTimeout(function(){
          
        timer();
        setInterval(function() {
            if(timecount==15){
              counter++;
              timecount=1;
                if(ai_type=='ai1'){
                    opp_correct_counter.innerHTML=counter;    
                }
  }
  
    timecount++;
    
    var text = document.getElementById("questions");

    var option_a = document.getElementById("a");
    var option_b = document.getElementById("b");
    var option_c = document.getElementById("c");
    var option_d = document.getElementById("d");
        
    var current_question = document.getElementById("qno");
    var questions = data[counter]['data'].mcq;
    var final_ans = data[counter]['data'].final_ans;

       
    var final_ans_html=document.getElementById("final_ans"); 
    final_ans_html.innerHTML=final_ans;
    
    
    var a = data[counter]['data']['options'].a;
    var b = data[counter]['data']['options'].b;
    var c = data[counter]['data']['options'].c;
    var d = data[counter]['data']['options'].d;
        
  

    text.innerHTML = questions;
         
    option_a.innerHTML = a;
    option_b.innerHTML = b;
    option_c.innerHTML = c;
    option_d.innerHTML = d;
        
    qno.innerHTML=counter+1+(' ) ');
  

    if(timecount==14){
           timer();
    }
    //  console.log('final_ansa'+final_ans);
    
    },1000);
    
   
    
    
},2000);



    $("#submit").click(function() {
          
          
          
       
    counter = counter+1;
    timecount=0;
    timer();
        
   
    var questions = data[counter]['data'].mcq;
    
    
    var correct_counter=document.getElementById("my_score");
    correct_counter.innerHTML=correct_count;
    
    
    
    
    if(ai_type=='ai1'){
    opp_correct_counter.innerHTML=counter;    
    }
    
    var a = data[counter]['data']['options'].a;
    var b = data[counter]['data']['options'].b;
    var c = data[counter]['data']['options'].c;
    var d = data[counter]['data']['options'].d;
        
    text.innerHTML = questions;
    current_question.innerHTML=counter+1;
    option_a.innerHTML = a;
    option_b.innerHTML = b;
    option_c.innerHTML = c;
    option_d.innerHTML = d;
  
  
    
    
});    
 

}
    
    
    
    $('p').click(function(){
    $('p').removeClass('active_option');
    
    
    
    






  
   
    
    
    
    $(this).addClass('active_option');
        });
        


$('p').click(function() { 
    var id = $(this).attr('id');
    console.log('id='+id);
  
    if(corr==id){
        correct_count++;
        console.log('correct_count'+correct_count);
    }
    
});
    });




    var x = document.getElementById("click"); 
    var y = document.getElementById("bg_music"); 

    function playAudio() { 
      x.play(); 
    } 
    
    function play() { 
      y.volume = 0.2;
      y.play(); 
    } 
    function pause() { 
      y.pause(); 
    }

</script>
<? } ?>


<style>
       
.base-timer {
    position: relative;
    width: 120px;
    height: 120px;
}
.base-timer__svg {
  transform: scaleX(-1);
}

.base-timer__circle {
  fill: none;
  stroke: none;
}

.base-timer__path-elapsed {
  stroke-width: 7px;
  stroke: grey;
}

.base-timer__path-remaining {
  stroke-width: 7px;
  stroke-linecap: round;
  transform: rotate(90deg);
  transform-origin: center;
  transition: 1s linear all;
  fill-rule: nonzero;
  stroke: currentColor;
}

.base-timer__path-remaining.green {
  color: rgb(65, 184, 131);
}

.base-timer__path-remaining.orange {
  color: orange;
}

.base-timer__path-remaining.red {
  color: red;
}

.base-timer__label {
    position: absolute;
    width: 120px;
    height: 120px;
    top: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.score_show h3, .score_show p{
    text-align:center;
}

</style> <? }

else{
    echo 'please select topic';
}
?>


<? include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php'); ?>