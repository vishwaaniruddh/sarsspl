<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Document</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.3/MathJax.js?config=TeX-MML-AM_CHTML"></script>

   <style>
      .active_option {
         color: #fff !important;
         background-color: #205480 !important;
         border-color: #2e6da4 !important;
      }

      #question-img {
         display: none;
      }

      .label,
      .answer-option {
         white-space: normal !important;
      }
   </style>
</head>

<body>
   <p id="score">loading..</p>

   <div id="main">

      <!-- ** Container ** -->
      <div class="container">
         <!-- Primary -->my
         <section id="primary" class="content-full-width">
            <!-- #post-11040 -->
            <div id="post-11040" class="post-11040 page type-page status-publish hentry">

               <div data-vc-full-width="true" data-vc-full-width-init="true"
                  class="vc_row wpb_row vc_row-fluid weather vc_custom_1528895397433"
                  style="position: relative; box-sizing: border-box; width: 100%; padding-left: 116.5px; padding-right: 116.5px;">
                  <div class="wpb_column vc_column_container vc_col-sm-12">
                     <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                           <div id="1512644171714-e11e0be0-eaa8" class="dt-sc-empty-space"></div>
                           <article id="post-8700"
                              class="blog-entry blog-default-style format-standard post-8700 post type-post status-publish has-post-thumbnail hentry category-kindergarten tag-dexterity">
                              <!-- Featured Image -->
                              <div class="entry-thumb">
                                 <div class="custom_margin"></div>
                                 <div class="custom_margin"></div>
                                 <div class="entry-format hidden">
                                    <a class="ico-format" href=""></a>
                                 </div>
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
                                       <div class="row score_show">
                                          <div class="col-md-6">
                                             <h3>Timer</h3>
                                             <p><span class="fa fa-clock-o"></span><span id="timer">0</span></p>
                                          </div>
                                       </div>

                                       <div class="row modal-header">
                                          <h3>
                                             <span id='qno'>loading..</span>
                                             <span class="label label-warning" id="questions">
                                             </span>
                                             <img src="" id="question-img">
                                          </h3>
                                          <div id="app"></div>
                                       </div>
                                       <div class="row quiz" id="quiz" data-toggle="buttons" style="display: block;">
                                          <p class="element-animation1 btn btn-lg btn-primary btn-block answer-option"
                                             name="q_answer" id="a" value="1" onclick="OptionClicked('a')">Loading ..
                                          </p>
                                          <p class="element-animation2 btn btn-lg btn-primary btn-block answer-option"
                                             name="q_answer" id="b" value="2" onclick="OptionClicked('b')">Loading ..
                                          </p>
                                          <p class="element-animation3 btn btn-lg btn-primary btn-block answer-option"
                                             name="q_answer" id="c" value="3" onclick="OptionClicked('c')">Loading ..
                                          </p>
                                          <p class="element-animation4 btn btn-lg btn-primary btn-block answer-option"
                                             name="q_answer" id="d" value="4" onclick="OptionClicked('d')">Loading ..
                                          </p>
                                       </div>
                                       <div class="questionsRow">
                                          <a href="#" class="button" id="myBtn">Next</a>
                                          <span id="qNo"><label id="current_question"></label> of 10</span>
                                       </div>
                                       <input type="hidden" id="given_ans" value="">
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
   <script type="text/javascript" src="background_process.js"></script>
   <script type="text/javascript">
      var CommUrl = "http://sarmicrosystems.in/quiztest/";
      var question = [
         { "data": { "id": "3109", "sub": "1", "topic": "57", "sub_topic": "126", "is_image": "0", "mcq": "What is the square root of 2025? ", "options": { "a": "42", "b": "225", "c": "25", "d": "45" }, "final_ans": "d", "ideal_time": "30", "given_ans": "" } },
         { "data": { "id": "2951", "sub": "1", "topic": "57", "sub_topic": "125", "is_image": "0", "mcq": "Write a Pythagorean triplet whose smallest number is 3.", "options": { "a": "3, 5, 7", "b": "3, 5, 6", "c": "3, 4, 6", "d": "3, 4, 5" }, "final_ans": "d", "ideal_time": "30", "given_ans": "" } },
         { "data": { "id": "10568", "sub": "1", "topic": "57", "sub_topic": "124", "is_image": "0", "mcq": "How many numbers lie between squares of 23 and 24", "options": { "a": "47", "b": "49", "c": "46", "d": "43" }, "final_ans": "c", "ideal_time": "30", "given_ans": "" } },
         { "data": { "id": "27624", "sub": "1", "topic": "57", "sub_topic": "127", "is_image": "1", "mcq": "http:\/\/smartscoreanalytics.com\/qstn_img\/8_SQUARES AND SQUARE ROOTS\/SRZC.jpg", "options": { "a": "I", "b": "F", "c": "D", "d": "G" }, "final_ans": "d", "ideal_time": "30", "given_ans": "" } },
         { "data": { "id": "3047", "sub": "1", "topic": "57", "sub_topic": "126", "is_image": "0", "mcq": "Complete the statement: The next two numbers in the number pattern 16, 49, 100, ... are ______", "options": { "a": "121, 144", "b": "169, 256", "c": "81, 196", "d": "169, 225" }, "final_ans": "b", "ideal_time": "30", "given_ans": "" } },
         { "data": { "id": "10577", "sub": "1", "topic": "57", "sub_topic": "125", "is_image": "0", "mcq": "Find the area of a square whose one of the side is 5 cm.", "options": { "a": "5 sq. cm", "b": "25 sq. cm", "c": "<math xmlns=\"http:\/\/www.w3.org\/1998\/Math\/MathML\">\n  <mstyle displaystyle=\"true\">\n    <msqrt>\n      <mrow>\n        <mn>5<\/mn>\n      <\/mrow>\n    <\/msqrt>\n  <\/mstyle>\n<\/math> sq. cm", "d": "20 sq. cm" }, "final_ans": "b", "ideal_time": "30", "given_ans": "" } },
         { "data": { "id": "10598", "sub": "1", "topic": "57", "sub_topic": "124", "is_image": "0", "mcq": "Number in units place for <math xmlns=\"http:\/\/www.w3.org\/1998\/Math\/MathML\">\n  <mstyle displaystyle=\"true\">\n    <msup>\n      <mn>26<\/mn>\n      <mrow>\n        <mn>2<\/mn>\n      <\/mrow>\n    <\/msup>\n  <\/mstyle>\n<\/math> is", "options": { "a": "2", "b": "8", "c": "1", "d": "6" }, "final_ans": "d", "ideal_time": "30", "given_ans": "" } },
         { "data": { "id": "2918", "sub": "1", "topic": "57", "sub_topic": "127", "is_image": "0", "mcq": "Which of the following will have 6 at its units place?", "options": { "a": "<math xmlns=\"http:\/\/www.w3.org\/1998\/Math\/MathML\">\n  <mstyle displaystyle=\"true\" scriptlevel=\"0\">\n    <mrow class=\"MJX-TeXAtom-ORD\">\n      <msup>\n        <mn>93<\/mn>\n        <mn>2<\/mn>\n      <\/msup>\n    <\/mrow>\n  <\/mstyle>\n<\/math>", "b": "<math xmlns=\"http:\/\/www.w3.org\/1998\/Math\/MathML\">\n  <mstyle displaystyle=\"true\" scriptlevel=\"0\">\n    <mrow class=\"MJX-TeXAtom-ORD\">\n      <msup>\n        <mn>94<\/mn>\n        <mn>2<\/mn>\n      <\/msup>\n    <\/mrow>\n  <\/mstyle>\n<\/math>", "c": "<math xmlns=\"http:\/\/www.w3.org\/1998\/Math\/MathML\">\r\n  <mstyle displaystyle=\"true\" scriptlevel=\"0\">\r\n    <mrow class=\"MJX-TeXAtom-ORD\">\r\n      <msup>\r\n        <mn>98<\/mn>\r\n        <mn>2<\/mn>\r\n      <\/msup>\r\n    <\/mrow>\r\n  <\/mstyle>\r\n<\/math>", "d": "<math xmlns=\"http:\/\/www.w3.org\/1998\/Math\/MathML\">\n  <mstyle displaystyle=\"true\" scriptlevel=\"0\">\n    <mrow class=\"MJX-TeXAtom-ORD\">\n      <msup>\n        <mn>99<\/mn>\n        <mn>2<\/mn>\n      <\/msup>\n    <\/mrow>\n  <\/mstyle>\n<\/math>" }, "final_ans": "b", "ideal_time": "30", "given_ans": "" } },
         { "data": { "id": "6392", "sub": "1", "topic": "57", "sub_topic": "126", "is_image": "0", "mcq": "While finding the square root of a decimal number using division method, what is the criteria to put bars on integral part?", "options": { "a": "Put pairs of bar from left to right", "b": "Put single bar from right to left", "c": "Put triple bar from left to right", "d": "Put pairs of bar from right to left" }, "final_ans": "d", "ideal_time": "30", "given_ans": "" } },
         { "data": { "id": "3041", "sub": "1", "topic": "57", "sub_topic": "125", "is_image": "0", "mcq": "Complete the statement: If one member of a Pythagorean triplet is 24m, then the other two members are ____", "options": { "a": "129m, 139m", "b": "143m, 145m", "c": "cant say", "d": "142m, 141m" }, "final_ans": "b", "ideal_time": "30", "given_ans": "" } },
         { "testid": "5487" }];
      var againstId = '1';
      var ai_type = '2';
      var correct_count = 0;
      var OppCorrect = 0;
      var timecount = 1;
      var currQNum = 0;
      var opp_correct_counter = document.getElementById("opp_score");
      var my_correct_counter = document.getElementById("my_score");

      var CorrectTimeCount = 0;
      var text = document.getElementById("questions");
      var q_img = document.getElementById("question-img");
      var option_a = document.getElementById("a");
      var option_b = document.getElementById("b");
      var option_c = document.getElementById("c");
      var option_d = document.getElementById("d");
      var current_question = document.getElementById("qno");
      var final_ans_html = document.getElementById("final_ans");
      var timerHtml = document.getElementById("timer");
      var IsExamEnded = false;
      var FetchingNextQuestion = true;
      var IsLikeMindedAIFriend = false;
      var reduceArrayIndex = 0;
      $(document).ready(function () {
         againstId = localStorage.getItem('AgainstId');
         ai_type = localStorage.getItem("LevelId");

         if (currQNum == 0) {
            if (againstId == 1 || againstId == '1') {
                reduceArrayIndex = 2;
               SetAIQuestions();
            } else if ((againstId == 2 || againstId == '2') || (againstId == 3 || againstId == '3')) {
               reduceArrayIndex = 1;
               TwoPlayerQuestions();
            }

         }
      });
      function SetAIQuestions() {
         let myFd = new FormData();
         myFd.append('userid', localStorage.getItem('userid'));
         myFd.append('stdid', localStorage.getItem('std'));
         myFd.append('topicid', localStorage.getItem('topics'));
         myFd.append('against', againstId);
         myFd.append('level', ai_type);
         myFd.append('friendid', 0);
         myFd.append('sub', localStorage.getItem('subid'));

         /* $.post("http://sarmicrosystems.in/quiztest_general/api/ai/get_questions.php", myFd, function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
         }); */

         $.ajax({
            url: "http://sarmicrosystems.in/quiztest_general/api/ai/get_questions.php",
            data: myFd,
            type: 'post',
            processData: false,
            contentType: false,
            success: function (data, status) {
               console.log("Data: ");
               console.log(data);
               question = data;
               setTimeout(() => {
                  localStorage.setItem('testId', question[question.length - 1]['testid']);
                  var questions = question[currQNum]['data'].mcq;
                  console.log("questions : ", questions);
                  var final_ans = question[currQNum]['data'].final_ans;

                  var a = question[currQNum]['data']['options'].a;
                  var b = question[currQNum]['data']['options'].b;
                  var c = question[currQNum]['data']['options'].c;
                  var d = question[currQNum]['data']['options'].d;
                  question[currQNum]['data']['given_ans'] = '1';
                  question[currQNum]['data']['time_taken'] = '';
                  
                  final_ans_html.innerHTML = final_ans;
                  timecount = question[currQNum]['data'].ideal_time;

                  $(timerHtml).html(timecount);

                  if (+question[currQNum]['data'].is_image == 1) {
                     text.style.display = "none";
                     q_img.style.display = "block";
                     q_img.src = questions;
                  } else {
                     text.style.display = "block";
                     q_img.style.display = "none";
                     text.innerHTML = questions;
                  }
                  option_a.innerHTML = a;
                  option_b.innerHTML = b;
                  option_c.innerHTML = c;
                  option_d.innerHTML = d;
                  qno.innerHTML = currQNum + 1 + (' ) ');
                  FetchingNextQuestion = false;
                  QuizTimer();
               }, 200);
               console.log("Status: " + status);
            },
            error: function (e) {
               console.error(e);
            }
         });
      }
      $("#submit").click(function () {
         console.log("Clicked");
         if (againstId == 1 || againstId == '1') {
            btnNextClicked();
         } else if ((againstId == 2 || againstId == '2') || (againstId == 3 || againstId == '3')) {
            btnNextTwoPlayer();
         }
      });
      $('.answer-option').click(function () {
         $('.answer-option').removeClass('active_option');
         $(this).addClass('active_option');
      });
      function OptionClicked(option) {
         $("#given_ans").val(option);
         clickedRow(option);
      }
      //------------------------------------From App-----------------------------------------
      function QuizTimer() {
         setInterval(function () {
            if (timecount == 0 && !IsExamEnded) {
               if (againstId == 1 || againstId == '1') {
                    NextQuestion();
                 } else if (((againstId == 2 || againstId == '2') || (againstId == 3 || againstId == '3')) && FetchingNextQuestion === false) {
                    TwoPlayerNextQue();
                 }
               FetchingNextQuestion = true;
            } else {
               if (timecount > 0) {
                  timecount--;
                  $(timerHtml).html(timecount);
               }
            }
         }, 1000);
      }
      function clickedRow(Option) {
         //this.audioService.AnswerSelected();
         if (FetchingNextQuestion == false) {
            question[currQNum]["data"]['given_ans'] = Option.toLowerCase();
            if (this.againstId === '4') {
               this.groupService.SendMyResponce(this.question[this.currQNum]["data"]['given_ans'],
                  (this.question[this.currQNum]["data"].ideal_time - this.timecount), +this.question["data"][this.currQNum].id, this.currQNum);
            }
         }
      }
      function NextQuestion() {
         console.log("nextq");
         if (againstId == '1') {
            AIResponce();
            if (!IsExamEnded) {
               opp_correct_counter.innerHTML = OppCorrect;
            }
         }
         console.log("currQNum : ", currQNum);
         if (question.length > (currQNum + reduceArrayIndex)) {
            $('.answer-option').removeClass('active_option');
            PreviousAnswer = '';
            currQNum++;
            var questions = question[currQNum]['data'].mcq;

            var correct_counter = document.getElementById("my_score");

            /* if (ai_type == 'ai1') {
               opp_correct_counter.innerHTML = currQNum;
            } */

            opp_correct_counter.innerHTML = OppCorrect;
            var a = question[currQNum]['data']['options'].a;
            var b = question[currQNum]['data']['options'].b;
            var c = question[currQNum]['data']['options'].c;
            var d = question[currQNum]['data']['options'].d;
            question[currQNum]['data']['given_ans'] = '1';
            question[currQNum]['data']['time_taken'] = '';
            var final_ans = question[currQNum]['data'].final_ans;

            timecount = question[currQNum]['data'].ideal_time;
            final_ans_html.innerHTML = final_ans;

            if (+question[currQNum]['data'].is_image == 1) {
               text.style.display = "none";
               q_img.style.display = "block";
               q_img.src = questions;
            } else {
               text.style.display = "block";
               q_img.style.display = "none";
               text.innerHTML = questions;
            }
            //text.innerHTML = questions;
            current_question.innerHTML = currQNum + 1;
            option_a.innerHTML = a;
            option_b.innerHTML = b;
            option_c.innerHTML = c;
            option_d.innerHTML = d;
            FetchingNextQuestion = false;
         } else {
            IsExamEnded = true;
            FetchingNextQuestion = false;
            let MyResult = (correct_count / question.length) * 100;
            localStorage.setItem("MyResult", MyResult.toString());
            if (againstId == '1') {
               let OppResult = (OppCorrect / question.length) * 100;
                localStorage.setItem("OppResult", OppResult.toString());
                localStorage.setItem("MyCorrectTime", this.CorrectTimeCount.toString());
                localStorage.setItem("OppCorrectTime", this.AICorrectAnsTime());
                localStorage.setItem("currQuiz", JSON.stringify(this.question));
                EndExam(question, IsLikeMindedAIFriend);
            }
            //ShowAlert();
            console.log("end exam");
         }
         localStorage.setItem("is_submit", '0');
         setTimeout(() => {
            FetchingNextQuestion = false;
         }, 200);
      }
      function CreateEndExamObject(AllQuestionsData) {
         return new Promise((resolve) => {
            console.log("AllQuestionsData", AllQuestionsData);
            var allData = [];
            let q;
            for (let i = 0; i < (AllQuestionsData.length - 1); i++) {
               q = AllQuestionsData[i].data;
               allData.push({
                  qid: q.id,
                  sub_topic: q.subTopicId,
                  final_ans: q.final_ans,
                  ans: q.given_ans,
                  time: q.time_taken,
                  opp_ans: q.OppAns,
                  OppTime: q.OppTime
               });
               if (i == (AllQuestionsData.length - 2)) {
                  console.log("allData", allData);
               }
            }
            setTimeout(() => {
               resolve(allData);
            }, 2000);
         });
      }
      function ProvideEndExamLoop(testId) {
         let fd = new FormData();
         fd.append("testid", testId);
         PostData(CommUrl + 'api/ai/ai_result.php', fd).then(() => {
            PostData(CommUrl + 'api/ai/ai_result.php', fd).then(data => {
               console.log("end result:", data);
            });
         });
      }
      function EndExam(All, IsAIForLikeMinded) {
         let ServerLink = "api/ai/100.php";
         if (IsAIForLikeMinded) {
            ServerLink = "api/ai_player/send_ai_result.php";
         }
         let fd = new FormData();
         let topicId = localStorage.getItem("topics");
         CreateEndExamObject(All).then(res => {
            console.log("Sending response : ", res);
            GetPropertyAsPromise("userid").then(ui => {
               GetPropertyAsPromise("testId").then(tId => {
                  console.log("UserId", ui);
                  console.log("testId : ", tId);

                  fd.append("userid", ui);
                  fd.append("topic", topicId);
                  fd.append("testid", tId);
                  fd.append("response", JSON.stringify(res));

                  setTimeout(() => {
                     PostData(CommUrl + ServerLink, fd).then(
                        data => {
                           console.log(data);
                           ProvideEndExamLoop(tId);
                        },
                        error => {
                           console.error(error);
                           ProvideEndExamLoop(tId);
                        }
                     );
                  }, 1000)
               })
            });
         });
      }
      function AIResponce() {
         console.log("currQNum : ", this.currQNum);
         if (againstId == '1' && (question.length > (currQNum + 1))) {
            if (ai_type == '1') {
               OppCorrect++;
               question[currQNum]["data"]["OppAns"] = question[currQNum]["data"]['final_ans'];
               question[currQNum]["data"].OppTime = question[currQNum]["data"]['ideal_time'];
            } else if (ai_type == '2') {
               question[currQNum]["data"].OppTime = 15;
               if (currQNum != 1 && currQNum != 3 && currQNum != 5) {
                  OppCorrect++;
                  question[currQNum]["data"]["OppAns"] = question[currQNum]["data"]['final_ans'];
               } else if (question[currQNum]["data"]['final_ans'] == 'a') {
                  question[currQNum]["data"]["OppAns"] = "d";
               } else {
                  question[currQNum]["data"]["OppAns"] = "a"
               }
            } else if (ai_type == '3') {
               question[currQNum]["data"].OppTime = 10;
               if (currQNum != 1 && currQNum != 3 && currQNum != 5 && currQNum != 7 && currQNum != 9) {
                  OppCorrect++;
                  question[currQNum]["data"]["OppAns"] = question[currQNum]["data"]['final_ans'];
               } else if (question[currQNum]["data"]['final_ans'] == 'a') {
                  question[currQNum]["data"]["OppAns"] = "d";
               } else {
                  question[currQNum]["data"]["OppAns"] = "a"
               }
            } else if (ai_type == '4') {
               question[currQNum]["data"].OppTime = 2;
               question[currQNum]["data"]["OppAns"] = AIRandomAns().toLowerCase();
               if (question[currQNum]["data"]['final_ans'].toUpperCase() === question[currQNum]["data"]['OppAns'].toUpperCase()) {
                  OppCorrect++;
               }
            }
         }
      }
      function AICorrectAnsTime() {
         if (ai_type == '1') {
            return "max";
         } else if (ai_type == '2') {
            return "105";
         } else if (ai_type == '3') {
            return "50";
         } else if (ai_type == '4') {
            return "0";
         }
         return "";
      }
      function AIRandomAns() {
         var x = Math.floor((Math.random() * 4) + 1);
         var ans = "";
         ans = (x == 1) ? "A" : (x == 2) ? "B" : (x == 3) ? "C" : (x == 4) ? "D" : "A";
         return ans;
      }
      function btnNextClicked() {
         console.log("btnNextClicked");
         if (!FetchingNextQuestion && !IsExamEnded) {
            var corr = document.getElementById("final_ans").innerHTML;
            var id = $("#given_ans").val();
            console.log('corr=' + corr + '  given_ans=' + id)
            if (corr == id) {
               correct_count++;
               my_correct_counter.innerHTML = correct_count;
               console.log("correct_count");
               question[currQNum]['data']['time_taken'] = (question[currQNum]['data'].ideal_time - timecount).toString();
               this.CorrectTimeCount = this.CorrectTimeCount + (this.question[this.currQNum]['data'].ideal_time - this.timecount);
            }
            FetchingNextQuestion = true;
            NextQuestion();
            /* setTimeout(() => {
               NextQuestion();
            }, 1000); */
         }
      }
      //------------------------------------Two Player---------------------------------------
      var OppName = "";
      function TwoPlayerQuestions() {
         console.log("geting q");
         //this.LoadingStart("Finding...", 40000);
         GetPropertyAsPromise("testId").then(_tId => {
            GetPropertyAsPromise("friendId").then(_fId => {
               //if(!(_fId > 0)){
               _fId = null;
               //}
               CheckIfQuestionGot(againstId, null, _tId).then(
                  data => {
                     console.log(data);
                     if (data.length != 0) {
                        //NumOfQ = question.length;
                        localStorage.setItem("OppName", data[0]["oppname"]);
                        OppName = data[0]["oppname"];
                        data.splice(0, 1);

                        question = data;
                        //---------------------------------
                        setTimeout(() => {
                           //localStorage.setItem('testId', question[question.length - 1]['testid']);
                           var questions = question[currQNum]['data'].mcq;
                           console.log("questions : ", questions);
                           var final_ans = question[currQNum]['data'].final_ans;

                           final_ans_html.innerHTML = final_ans;
                           timecount = question[currQNum]['data'].ideal_time;

                           $(timerHtml).html(timecount);

                           if (+question[currQNum]['data'].is_image == 1) {
                              text.style.display = "none";
                              q_img.style.display = "block";
                              q_img.src = questions;
                           } else {
                              text.style.display = "block";
                              q_img.style.display = "none";
                              text.innerHTML = questions;
                           }
                           option_a.innerHTML = question[currQNum]['data']['options'].a;
                           option_b.innerHTML = question[currQNum]['data']['options'].b;
                           option_c.innerHTML = question[currQNum]['data']['options'].c;
                           option_d.innerHTML = question[currQNum]['data']['options'].d;
                           this.question[this.currQNum]['data']['given_ans'] = '1';
                           
                           this.question[this.currQNum]['data']['time_taken'] = '';
                           qno.innerHTML = currQNum + 1 + (' ) ');
                           FetchingNextQuestion = false;
                           QuizTimer();
                        }, 200);
                        //----------------------------------

                     } else {
                        if (this.againstId === '3') {
                           //this.SetQuestionForUnknownAI();
                        } else {
                           //this.ShowAlertNoUserFound();
                        }
                     }
                  }
               );
            });
         });
      }
      function btnNextTwoPlayer() {
         let GotRespond = true;
         if (IsExamEnded === false && FetchingNextQuestion === false) {
            FetchingNextQuestion = true;
            console.log(this.question[this.currQNum]['data']);
            question[this.currQNum]['data']['time_taken'] = (question[currQNum]['data'].ideal_time - timecount).toString();
            SendTwoPlayerAnswer(+this.againstId, +this.question[this.currQNum]['data']['question_id'], this.question[this.currQNum]['data']['given_ans'], this.question[this.currQNum]['data']['time_taken'])
               .then(_d => {
                  var timerCheck = 5;
                  var ChkOppResponce = setInterval(() => {
                     if (GotRespond) {
                        GotRespond = false;
                        this.ShouldShowNexQuestion(+this.question[this.currQNum]['data']['question_id']).then(
                           _res => {
                            console.log("Response: ", _res);
                              if (_res.IsResponce === true) {
                                console.log("Inside if");
                                 //this.LoadingStop();
                                 this.OppCorrect = +_res.OppCorrectCount;
                                 this.TwoPlayerNextQue();
                                 clearInterval(ChkOppResponce);
                              }
                              GotRespond = true;
                           }
                        ).catch(() => { GotRespond = true });
                     }
                     if ((timerCheck) <= 0 && !GotRespond) {
                        GotRespond = true;
                        //this.LoadingStop();
                        this.TwoPlayerNextQue();
                        clearInterval(ChkOppResponce);
                     }
                     if (this.timecount <= 0) {
                        timerCheck--;
                     }
                  }, 1000);
               });
         } else {
            if (this.IsExamEnded) {
               this.ShowAlert();
            }
         }
      }
      function TwoPlayerNextQue() {
         if (this.question[this.currQNum]['data']['final_ans'].toUpperCase() === this.question[this.currQNum]['data']['given_ans'].toUpperCase()) {
            this.Correct++;
            this.CorrectTimeCount = this.CorrectTimeCount + (this.question[this.currQNum]['data'].ideal_time - this.timecount);
         } else {
            this.Wrong++;
         }
         //this.question[this.currQNum]['data']['time_taken'] = (this.question[this.currQNum]['data'].ideal_time - this.timecount).toString();

         setTimeout(() => {
            NextQuestion();
         }, 1000);

      }
      function SendTwoPlayerAnswer(against, QId, Option, TimeTaken) {
        let Link = "like_minded/get_answer2.php";
        if (against == 2) {
            Link = "player/get_answer2.php";
        } else if (against == 3) {
            Link = "like_minded/get_answer2.php";
        }
        return new Promise((resolve, reject) => {
            this.GetPropertyAsPromise("userid").then(
                _uid => {
                    this.GetPropertyAsPromise("testId").then(
                        _tId => {
                            this.GetPropertyAsPromise("std").then(_std => {
                                console.log("time taken: ", TimeTaken);
                                var fd = new FormData();
                                fd.append("userid", _uid);
                                fd.append("testid", _tId);
                                fd.append("qid", QId.toString());
                                fd.append("ans", Option);
                                fd.append("timetaken", TimeTaken);
                                fd.append("std", _std);
                                this.PostData(this.CommUrl + "api/" + Link, fd).then(
                                    data => {
                                        if (data && data !== null && typeof data !== undefined) {
                                            resolve(1);
                                        } else {
                                            resolve(0);
                                        }
                                    }
                                ).catch(error => { reject(1) });

                            });
                        }
                    )
                }
            );
        });
    }
      function ShouldShowNexQuestion(QuestionId) {
            var res = {
                IsResponce: false,
                OppCorrectCount: ''
            };
            return new Promise((resolve) => {
                this.GetPropertyAsPromise("userid").then(_uId => {
                    this.GetPropertyAsPromise("testId").then(_tId => {
                        var fd = new FormData();
                        fd.append("userid", _uId);
                        fd.append("testid", _tId);
                        fd.append("qid", QuestionId.toString());
                        this.PostData(this.CommUrl + "api/like_minded/get_opposition_response.php", fd).then(
                            data => {
                                console.log("opp count : ", data);
    
                                if (data !== null && typeof data !== undefined && (+data > -1 || data === 0)) {
                                    res = {
                                        IsResponce: true,
                                        OppCorrectCount: data
                                    }
                                    resolve(res);
                                } else {
                                    resolve(res);
                                }
                            }
                        ).catch(err => { resolve(res); });
                    });
                });
            });
        }
      //----------------------------------General-------------------------------------------
      function LogFormData(formData) {
         for (let pair of formData.entries()) {
            console.log(pair[0] + " : ", pair[1]);
         }
      }
      function PostData(postUrl, FData) {
         LogFormData(FData);
         console.log("postUrl: ", postUrl);
         return new Promise((resolve, reject) => {
            $.ajax({
               url: postUrl,
               data: FData,
               type: 'post',
               processData: false,
               contentType: false,
               success: function (data, status) {
                  console.log(data);
                  resolve(data);
               },
               error: function (e) {
                  console.error(e);
                  reject(e);
               }
            });
         });
      }
      function GetPropertyAsPromise(Key) {
         return new Promise((resolve, reject) => resolve(localStorage.getItem(Key)));
      }
   </script>

   <style>
      .score_show h3,
      .score_show p {
         text-align: center;
      }
   </style>
</body>

</html>