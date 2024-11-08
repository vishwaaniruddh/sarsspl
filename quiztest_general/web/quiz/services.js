var CommUrl = "http://sarmicrosystems.in/quiztest/";
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