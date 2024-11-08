
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <h1>test</h1>
        <script>
            $(document).ready(function(){
                var u = "https://www.googleapis.com/urlshortener/v1/url/?key=AIzaSyDlU7Mfsn6RELJGsPTn-NW15KXN6jBJbWU";
                var mydata = {"longUrl": "https://shyambabadham.com/Committee/vm.php?mobile=9415121284"};
                var saveData = $.ajax({
                      type: 'POST',
                      url: u,
                      data: mydata,
                      dataType: "application/json",
                      success: function(resultData) { console.log("Save Complete", resultData) },
                      error: function(e) { console.log("Something went wrong", e); }
                });
                //saveData.error(function() { alert("Something went wrong"); });
            });
        </script>
    </body>
</html>
<?php /*
$url = 'https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyCx6ZfTv4PeP50mYl5d0Hc7rf0nFtmuoZM';//'http://server.com/path';
$data = array('longUrl' => 'https://shyambabadham.com/Committee/vm.php?mobile=9415121284');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { 
    echo "error";// Handle error  
}

var_dump($result);
*/
?>