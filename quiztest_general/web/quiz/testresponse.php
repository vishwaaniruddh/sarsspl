<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <button class="postdata">Click</button>
        <script>
            $(".postdata").click(function() {
                let myres = [
                        {"qid":"16240","final_ans":"d","ans":"b","opp_ans":"d","OppTime":10},
                        {"qid":"16270","final_ans":"d","ans":"c","opp_ans":"a","OppTime":10},
                        {"qid":"16387","final_ans":"b","ans":"b","opp_ans":"b","OppTime":10},
                        {"qid":"16160","final_ans":"b","ans":"c","opp_ans":"a","OppTime":10},
                        {"qid":"16219","final_ans":"b","ans":"b","opp_ans":"b","OppTime":10},
                        {"qid":"16302","final_ans":"d","ans":"a","opp_ans":"a","OppTime":10},
                        {"qid":"16391","final_ans":"a","ans":"c","opp_ans":"a","OppTime":10},
                        {"qid":"16346","final_ans":"d","ans":"b","opp_ans":"a","OppTime":10},
                        {"qid":"16392","final_ans":"c","ans":"a","opp_ans":"c","OppTime":10},
                        {"qid":"16226","final_ans":"c","ans":"a","opp_ans":"a","OppTime":10}
                    ];
                let FData = new FormData();
                //FData.append("topic", "313");
                FData.append("testid", "6615");
                //FData.append("response", JSON.stringify(myres));
                
                 //return new Promise((resolve, reject) => {
                    $.ajax({
                       url: "http://sarmicrosystems.in/quiztest_general/api/ai/ai_result.php",
                       data: FData,
                       type: 'POST',
                      contentType: false,
                      processData: false,
                       cache : false,
                       //dataType    : 'json',
                       //contentType: 'applicatiin/json',
                       success: function (data, status) {
                           console.log(data);
                           console.log();
                          //resolve(data);
                       },
                       error: function (e) {
                          console.error(e);
                          //reject(e);
                       }
                    });
                 //});
            }); 
            function PostData() {
                
              }
        </script>
    </body>
</html>