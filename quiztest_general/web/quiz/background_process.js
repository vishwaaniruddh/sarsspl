var CommUrl = "http://sarmicrosystems.in/quiztest/";
function CheckIfQuestionGot(againstId, friendId, testId) {
     let SecondsCount = 0;
     let RequestValid = true;
     let q=[]; 
      //this.IntervalTocheckAcceptedRequest;
      return new Promise((resolve) => {
         let qT = setInterval(() => {
               GetTwoPlayerExam(againstId, friendId, testId).then(data => {
                  if(RequestValid){
                     console.log("questions ", data);
                     if(data.length !== 0 && data !== null && typeof data !== undefined && data){
                           clearInterval(qT);
                           resolve(data);
                     } else {
                        console.log("getting Questions");
                     }
                  }
               })
               if(SecondsCount > 16){
                  RequestValid = false;
                  clearInterval(qT);
                  resolve(q); // returning empty array
               }
               SecondsCount++;
         }, 2000);
      });
      
   }
   
   
   function GetTwoPlayerExam(againstId, friendId, testId) {
        console.log("a = ", againstId);
        let link = 'like_minded/get_questions.php';
        if (againstId == 2) {
            link = "player/get_questions.php";
        } else if (againstId == 3) {
            link = "like_minded/get_questions.php";
        }
        var question = [];
        return new Promise((resolve) => {
            PrepareDataToGetQuiz(againstId, 0, friendId).then(fd => {
                console.log("fd : ", fd);
                fd.append("friendId", friendId);
                fd.append("testid", testId);
                PostData(CommUrl + 'api/' + link, fd).then(
                    data => {
                        console.log("Data", data);
                        resolve(data);
                    },
                    error => console.error(error)
                );
            });
        });
    }
    
    function PrepareDataToGetQuiz(againstId, levelId, friendId) {
        let f = new FormData();
        f.append("test", "Mytest");
        console.log(f);
        return new Promise((resolve) => {
            GetPropertyAsPromise("subid").then(_SubId => {
                console.log("subId : ", _SubId);
                let myFd = new FormData();
                myFd.append('userid', localStorage.getItem('userid'));
                myFd.append('stdid', localStorage.getItem('std'));
                myFd.append('topicid', localStorage.getItem('topics'));
                myFd.append('against', againstId);
                myFd.append('level', levelId);
                myFd.append('friendid', friendId);
                myFd.append('sub', _SubId);
                console.log(localStorage.getItem('topics'));
                setTimeout(() => {
                    resolve(myFd);
                }, 500);
            });
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