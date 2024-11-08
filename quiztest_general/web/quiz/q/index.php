<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <h1>Quiz on Important Facts</h1>
<div class="quiz-container">
  <div id="quiz"></div>
</div>
<button id="previous">Previous Question</button>
<button id="next">Next Question</button>
<button id="submit">Submit Quiz</button>
<div id="results"></div>











<?

$userid=179;
$std=8;
$sub=5;
$topic=430;


// $userid=$_SESSION['userid'];
// $std=$_SESSION['std'];
// $sub=$_SESSION['subjectid'];
// $topic=$_SESSION['topicid'];
// $ai_type=$_SESSION['ai_type'];

 

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
  
  
  var_dump($myPhpArray);
  
  
}
?>




<style>
    @import url(https://fonts.googleapis.com/css?family=Work+Sans:300,600);

body{
	font-size: 20px;
	font-family: 'Work Sans', sans-serif;
	color: #333;
  font-weight: 300;
  text-align: center;
  background-color: #f8f6f0;
}
h1{
  font-weight: 300;
  margin: 0px;
  padding: 10px;
  font-size: 20px;
  background-color: #444;
  color: #fff;
}
.question{
  font-size: 30px;
  margin-bottom: 10px;
}
.answers {
  margin-bottom: 20px;
  text-align: left;
  display: inline-block;
}
.answers label{
  display: block;
  margin-bottom: 10px;
}
button{
  font-family: 'Work Sans', sans-serif;
	font-size: 22px;
	background-color: #279;
	color: #fff;
	border: 0px;
	border-radius: 3px;
	padding: 20px;
	cursor: pointer;
	margin-bottom: 20px;
}
button:hover{
	background-color: #38a;
}





.slide{
  position: absolute;
  left: 0px;
  top: 0px;
  width: 100%;
  z-index: 1;
  opacity: 0;
  transition: opacity 0.5s;
}
.active-slide{
  opacity: 1;
  z-index: 2;
}
.quiz-container{
  position: relative;
  height: 200px;
  margin-top: 40px;
}

</style>
    </body>
</html>

<script>
 $(document).ready(function() {
      var data = <?= $myPhpArray; ?>;
    (function(){
  // Functions
  function buildQuiz(){
    // variable to store the HTML output
    const output = [];

    // for each question...
    myQuestions.forEach(
      (currentQuestion, questionNumber) => {

        // variable to store the list of possible answers
        const answers = [];

        // and for each available answer...
        for(letter in currentQuestion.answers){

          // ...add an HTML radio button
          answers.push(
            `<label>
              <input type="radio" name="question${questionNumber}" value="${letter}">
              ${letter} :
              ${currentQuestion.answers[letter]}
            </label>`
          );
        }

        // add this question and its answers to the output
        output.push(
          `<div class="slide">
            <div class="question"> ${currentQuestion.question} </div>
            <div class="answers"> ${answers.join("")} </div>
          </div>`
        );
      }
    );

    // finally combine our output list into one string of HTML and put it on the page
    quizContainer.innerHTML = output.join('');
  }

  function showResults(){

    // gather answer containers from our quiz
    const answerContainers = quizContainer.querySelectorAll('.answers');

    // keep track of user's answers
    let numCorrect = 0;

    // for each question...
    myQuestions.forEach( (currentQuestion, questionNumber) => {

      // find selected answer
      const answerContainer = answerContainers[questionNumber];
      const selector = `input[name=question${questionNumber}]:checked`;
      const userAnswer = (answerContainer.querySelector(selector) || {}).value;

      // if answer is correct
      if(userAnswer === currentQuestion.correctAnswer){
        // add to the number of correct answers
        numCorrect++;

        // color the answers green
        answerContainers[questionNumber].style.color = 'lightgreen';
      }
      // if answer is wrong or blank
      else{
        // color the answers red
        answerContainers[questionNumber].style.color = 'red';
      }
    });

    // show number of correct answers out of total
    resultsContainer.innerHTML = `${numCorrect} out of ${myQuestions.length}`;
  }

  function showSlide(n) {
    slides[currentSlide].classList.remove('active-slide');
    slides[n].classList.add('active-slide');
    currentSlide = n;
    if(currentSlide === 0){
      previousButton.style.display = 'none';
    }
    else{
      previousButton.style.display = 'inline-block';
    }
    if(currentSlide === slides.length-1){
      nextButton.style.display = 'none';
      submitButton.style.display = 'inline-block';
    }
    else{
      nextButton.style.display = 'inline-block';
      submitButton.style.display = 'none';
    }
  }

  function showNextSlide() {
    showSlide(currentSlide + 1);
  }

  function showPreviousSlide() {
    showSlide(currentSlide - 1);
  }

  // Variables
  const quizContainer = document.getElementById('quiz');
  const resultsContainer = document.getElementById('results');
  const submitButton = document.getElementById('submit');
  const myQuestions = [
    {
      question: data[0]['data'].mcq,
      answers: {
        a: data[0]['data']['options'].a,
        b: data[0]['data']['options'].b,
        c: data[0]['data']['options'].c,
        d: data[0]['data']['options'].d
      },
      correctAnswer: data[0]['data'].final_ans
    },
    {
      question: data[1]['data'].mcq,
      answers: {
        a: data[1]['data']['options'].a,
        b: data[1]['data']['options'].b,
        c: data[1]['data']['options'].c,
        d: data[1]['data']['options'].d
      },
      correctAnswer: data[1]['data'].final_ans
    },
    {
      question: data[2]['data'].mcq,
      answers: {
        a: data[2]['data']['options'].a,
        b: data[2]['data']['options'].b,
        c: data[2]['data']['options'].c,
        d: data[2]['data']['options'].d
      },
      correctAnswer: data[2]['data'].final_ans
    },
     {
      question: data[3]['data'].mcq,
      answers: {
        a: data[3]['data']['options'].a,
        b: data[3]['data']['options'].b,
        c: data[3]['data']['options'].c,
        d: data[3]['data']['options'].d
      },
      correctAnswer: data[3]['data'].final_ans
    },
     {
      question: data[4]['data'].mcq,
      answers: {
        a: data[4]['data']['options'].a,
        b: data[4]['data']['options'].b,
        c: data[4]['data']['options'].c,
        d: data[4]['data']['options'].d
      },
      correctAnswer: data[4]['data'].final_ans
    },
    {
      question: data[5]['data'].mcq,
      answers: {
        a: data[5]['data']['options'].a,
        b: data[5]['data']['options'].b,
        c: data[5]['data']['options'].c,
        d: data[5]['data']['options'].d
      },
      correctAnswer: data[5]['data'].final_ans
    },
    {
      question: data[6]['data'].mcq,
      answers: {
        a: data[6]['data']['options'].a,
        b: data[6]['data']['options'].b,
        c: data[6]['data']['options'].c,
        d: data[6]['data']['options'].d
      },
      correctAnswer: data[6]['data'].final_ans
    },
     {
      question: data[7]['data'].mcq,
      answers: {
        a: data[7]['data']['options'].a,
        b: data[7]['data']['options'].b,
        c: data[7]['data']['options'].c,
        d: data[7]['data']['options'].d
      },
      correctAnswer: data[7]['data'].final_ans
    },
     {
      question: data[8]['data'].mcq,
      answers: {
        a: data[8]['data']['options'].a,
        b: data[8]['data']['options'].b,
        c: data[8]['data']['options'].c,
        d: data[8]['data']['options'].d
      },
      correctAnswer: data[8]['data'].final_ans
    },
     {
      question: data[9]['data'].mcq,
      answers: {
        a: data[9]['data']['options'].a,
        b: data[9]['data']['options'].b,
        c: data[9]['data']['options'].c,
        d: data[9]['data']['options'].d
      },
      correctAnswer: data[9]['data'].final_ans
    }
  ];

  // Kick things off
  buildQuiz();

  // Pagination
  const previousButton = document.getElementById("previous");
  const nextButton = document.getElementById("next");
  const slides = document.querySelectorAll(".slide");
  let currentSlide = 0;

  // Show the first slide
  showSlide(currentSlide);

  // Event listeners
  submitButton.addEventListener('click', showResults);
  previousButton.addEventListener("click", showPreviousSlide);
  nextButton.addEventListener("click", showNextSlide);
})();
 });
</script>