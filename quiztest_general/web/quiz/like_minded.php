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
        url(httap://sarmicrosystems.in/quiztest/web/asset/woman_sitting.jpg);
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
        
    
    
    <h2 class="heading">Play With Like Minded Peoples</h2>
    </div>
</div>



<div class="custom_margin"></div>



<div class="container">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Select Subject</label>
        <select class="form-control" id="subject"> 
        
        <option>Select</option>
<?

$std=$_SESSION['std'];
$url = 'http://sarmicrosystems.in/quiztest_general/api/get_subject.php';
$data = array('std' => $std);

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

$result=json_decode($result);

for($i=0;$i<sizeof($result);$i++){ ?>


<option id="<? echo $result[$i]->id; ?>"><? echo $result[$i]->sub; ?>    </option>

<?}
} ?>
    

        
    </select>
  </div>
  
  
  
  
  
  
  



  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Topic</label>
    <select class="form-control" id="topics">
     
    </select>
  </div>
  

  
  
    
    <div class="flex">
        <button class="btn btn-primary" id="start">Start</button>
    </div>  
    

  
  <div class="custom_margin"></div>



</div>
    <script>
    var CommUrl = "http://sarmicrosystems.in/quiztest/";
    $( "#subject" ).change(function() {
        
        $( "#topics option" ).remove();
        
        
        var id = $(this).children(":selected").attr("id");
        // alert(id);
        $.ajax({
            type: "POST",
            url: 'http://sarmicrosystems.in/quiztest_general/api/get_topics.php',
            data: 'sub='+id,
            success: function(msg){                       
                for(i=0;i<msg.length;i++){
                    

            $('#topics').append($('<option>', {
                    text: msg[i]['name'],
                    value: msg[i]['id']
                }));
                    
                }
            }
            });
        });
        
    $('#start').click(function() {
       var subid = $('#subject').children(":selected").attr("id");
       var topicid = $('#topics').children(":selected").attr("value");
       
       console.log('subid: ' + subid + ', topicid: ' + topicid + ', AgainstId: ' + "3");
       if(!(+subid>=1)){
          alert("Please select subject.");
          return 0;
       } else if(!(+topicid >= 1)){
          alert("Please select topic.");
          return 0;
       }
       localStorage.setItem("subid",subid);
       localStorage.setItem("topics",topicid);
       localStorage.setItem("AgainstId","3");
       localStorage.setItem("LevelId","0");


       $.ajax({
          type: "POST",
          url: 'http://sarmicrosystems.in/quiztest/web/quiz/setvalues.php',
          data: 'subjectid=' + subid + "&topicid=" + topicid + "&ai_type=" + 0,
          success: function(msg) {
             console.log(msg);
             if (msg == 1) {
                
                console.log('set');
             } else {
                console.log('not set');
             }
          }
       });
       SendQuizRequestToLikeMinded().then(
            data => {
               console.log("Request Sent : ", data);
               if (data !== 0) {
                  localStorage.setItem("testId", data);
                  setTimeout(()=>{
                      window.location.href = "http://sarmicrosystems.in/quiztest/web/quiz/playquiz.php";
                  }, 2000);
                  //this.navCtrl.navigateForward('home/playquiz');
               }
               else {
                  localStorage.setItem("testId", 0);
               }
            }
         ).catch((e) => { console.log(e); });
    });
    function SendQuizRequestToLikeMinded() {
        console.log("Sending request");
        return new Promise((resolve) => {
            let myFd = new FormData();
            myFd.append('player1', localStorage.getItem('userid'));
            myFd.append('stdid', localStorage.getItem('std'));
            myFd.append('topicid', localStorage.getItem('topics'));
            myFd.append('subid', localStorage.getItem('subid'));
            setTimeout(() => {
                PostData(CommUrl + "api/like_minded/like_minded.php", myFd).then(
                    data => {
                        console.log("Request sent : ", data);
                        if (data && typeof data !== undefined && data !== null) {
                            myFd.append("testid", data.testid);
                            setTimeout(() => {
                                PostData(CommUrl + 'api/like_minded/set_questions.php', myFd)
                                    .then(data => console.log("echo: ", data),
                                        error => console.error("echo : ", error)

                                    );
                            }, 500);
                            setTimeout(() => {
                                PostData(CommUrl + 'api/like_minded/set_questions.php', myFd);
                            }, 2500);
                            resolve(data.testid);
                        } else {
                            resolve(0);
                        }
                        //resolve(data);
                        //localStorage.setItem("testId", data);
                    },
                    error => {
                        console.error(error);
                        resolve(0);
                    }
                );
            }, 2000);
        });
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
      function LogFormData(formData){
         for(let pair of formData.entries()){
            console.log(pair[0]+" : ", pair[1]);
         }
      }
</script>





<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php'); ?>