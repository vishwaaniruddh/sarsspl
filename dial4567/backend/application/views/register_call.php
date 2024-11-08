<!DOCTYPE html>
<html> 
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
    <?php
        echo "<pre>";
        $php_input_body = array("uniqueId"=> "482DE5435",
            "firstname"=> "Ram",
            "lastname"=> "Verma",
            "mobile"=> "9876543210",
            "email"=> "ram@gmail.com",
            "gender"=> "Male",
            "address"=> "11, Hennur main road",
            "dob"=>"2016-02-05",
            "city"=> "Bengaluru",
            "state"=> "Karnataka",
            "pincode"=>"560077",
            "govtIdImageUrl"=>"https://some.com/ram-aadhar.png",
            "govtIdNumber"=>"451109443822",
            "govtIdType"=>"Aadhaar");
        $php_input_body_json_encode = json_encode($php_input_body);

        date_default_timezone_set('GMT');
        $body = '{
            "uniqueId": "482DE5435",
            "firstname": "Ram",
            "lastname": "Verma",
            "mobile": "9876543210",
            "email": "ram@gmail.com",
            "gender": "Male",
            "address": "11, Hennur main road",
            "dob": "2016-02-05",
            "city": "Bengaluru",
            "state": "Karnataka",
            "pincode": "560077",
            "govtIdImageUrl": "https://some.com/ram-aadhar.png",
            "govtIdNumber": "451109443822",
            "govtIdType": "Aadhaar"
        }';
       
        $current_Date =  date("D, d M Y h:i:s ").date_default_timezone_get();
       
        echo '<br>';
       // print_R($body);
       // die;
       

    ?>
 <script>
    var utcNow = new Date().toUTCString();
   // alert(utcNow);
    var body = '{"uniqueId": "482DE5435","firstname":"Ram","lastname":"Verma","mobile":"9876543210","email":"ram@gmail.com","gender":"Male","address":"11, Hennur main road","dob":"2016-02-05","city":"Bengaluru","state":"Karnataka","pincode": "560077","govtIdImageUrl":"https://some.com/ram-aadhar.png","govtIdNumber":"451109443822","govtIdType":"Aadhaar"}';
   
    let method =   'POST';
    var verb = method.toUpperCase();
    let url ='/tps/v1/register/'; // pm.request.url.getPathWithQuery();
    let host = "api.myresqr.life";
      var contentHash = CryptoJS.SHA256(body).toString(CryptoJS.enc.Base64);
 
  //  alert(contentHash);
    var secret="zD077AOGlzJEmKyJC0c0lYofgQaGIaTI";
    
    var stringToSign = verb + '\n' + url + '\n' + utcNow + ';' + host + ';' + contentHash;
    var signature = CryptoJS.HmacSHA256(stringToSign, secret).toString(CryptoJS.enc.Base64);
    var HMAccredentials = "20394hjendicaw08g212w"; 
    var newsign = "HMAC-SHA256 Credential=" + HMAccredentials;
    var newsign2 = "&Signature=" + signature;
    newsign = newsign + newsign2 ;
  //  let headers = signRequest(host, method, url, body);
    var js_Authorization = 'Authorization: '+ newsign;
    var js_myresqr_date =  'x-myresqr-date: '+ utcNow;
      
//console.log(newsign);
 
 //alert(newsign);
</script>
  <?php
// $php_Authorization = "<script>document.write(js_Authorization)</script>";
// $php_myresqr_date = "<script>document.write(js_myresqr_date)</script>";
// $php_newsign= "<script>document.write(newsign)</script>";
//     $php_contentHash= "<script>document.write(contentHash)</script>";
//     $php_stringToSign= "<script>document.write(stringToSign)</script>";
    
    
//  var_dump( $php_input_body_json_encode);
 // die;
    $php_utcNow =date("D, d M Y h:i:s ").date_default_timezone_get();
 //$php_newsign= "HMAC-SHA256 Credential=20394hjendicaw08g212w&Signature=/0EDecBpB0DT7qaKda2EVpv2aPYsREhRsEPXx/XH5I4=";
 
// echo $php_input_body_json_encode;
// $contentHash_body = hash('sha256', $php_input_body_json_encode);
// $contentHash = base64_encode($contentHash_body);
// $contentHash = utf8_decode($contentHash);



    
    
$php_newsign_value =   hash_hmac("sha256", $php_input_body_json_encode,  "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI", false) ;
$php_newsign_value_base64 = base64_encode($php_newsign_value);

$verb = strtoupper("POST");
$url = '/tps/v1/register/';
$host = 'api.myresqr.life';
$secret = "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI";

  $hexHash = hash_hmac('sha256', $php_input_body_json_encode, utf8_encode($secret));
    $contentHash = base64_encode(hex2bin($hexHash));
    
$stringToSign = $verb  .  $url .  $php_utcNow .';' . $host .  ';' .  $contentHash;


    
    
    
$signature = base64_encode(hash_hmac('sha256', $stringToSign, $secret, true));
  $HMAccredentials = "20394hjendicaw08g212w"; 
           $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials;
        $newsign2 = "&Signature=" . $signature;
        $newsign = $newsign . $newsign2 ;
$header_arr= array(
'x-myresqr-date: '.$php_utcNow,
'Authorization: '.$newsign,
'Content-Type: application/json',
'Host: api.myresqr.life',
//"User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36",
"Accept-Language:en-US,en;q=0.5",
"contentHash: ".$contentHash,
"stringToSign: ".$stringToSign,
"php_newsign_value: ".$php_newsign_value,
 
);



// 14-jul-2022 //Wed, 13 Jul 2022 08:55:51
$str = "{\"uniqueId\":\"482de5122\",\"firstname\":\"ram\",\"lastname\":\"verma\",\"mobile\":\"9876577111\",\"email\":\"ramqwer@gmail.com\",\"gender\":\"Male\",\"address\":\"11, Hennur main road\",\"dob\":\"2016-02-05\",\"city\":\"Bengaluru\",\"state\":\"Karnataka\",\"pincode\":\"560077\",\"govtIdImageUrl\":\"https:\/\/some.com\/ram-aadhar.png\",\"govtIdNumber\":\"451109443822\",\"govtIdType\":\"Aadhaar\"}";
$content_hash = base64_encode(hash("sha256", $str, true));
// $string_to_sign = "POST" . "\n" . "/tps/v1/register/" . "\n" . "Tue, 12 Jul 2022 11:13:41 GMT" . ";" . "api.myresqr.life" . ";" . $content_hash;
$string_to_sign = "POST" . "\n" . "/tps/v1/register/" . "\n" .$php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
$sig = base64_encode(hash_hmac('sha256', $string_to_sign, "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI", true));
echo $content_hash;
echo "\n";
echo $sig;
  $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials;
        $newsign2 = "&Signature=" . $sig;
        $newsign = $newsign . $newsign2 ;
       echo $newsign; 
$header_arr= array(
'x-myresqr-date: '.$php_utcNow,
'Authorization: '.$newsign,
'Content-Type: application/json',
'Host: api.myresqr.life',
//"Accept-Language:en-US,en;q=0.5",
//"contentHash: ".$content_hash,
//"stringToSign: ".$string_to_sign,
);
  print_r($header_arr);
 

   //die;
   
$curl = curl_init();

curl_setopt($curl,   CURLOPT_URL , 'https://api.myresqr.life/tps/v1/register/');
 curl_setopt($curl,   CURLOPT_RETURNTRANSFER , true);
// curl_setopt($curl,  CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, true);

//curl_setopt($curl,   CURLOPT_ENCODING , '');
curl_setopt($curl,   CURLOPT_MAXREDIRS , 10);
curl_setopt($curl,   CURLOPT_TIMEOUT ,  0);
curl_setopt($curl,   CURLOPT_FOLLOWLOCATION , true);
curl_setopt($curl,   CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
curl_setopt($curl,   CURLOPT_CUSTOMREQUEST , 'POST');

 curl_setopt($curl, CURLOPT_POSTFIELDS,    $str);
 curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);

   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
   curl_setopt($curl, CURLOPT_HEADER, true);
   ///////////////
   curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
   curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                           

  //  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=UTF-8'));
 
$response = curl_exec($curl);

curl_close($curl);
//var_dump($curl);
 echo $response;
 if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
}
    $info = curl_getinfo($curl);
  
    // print_r($info);
    // print_r($response);
    // if ( $response === false ) {
    //     echo PHP_EOL . "ERROR: curl_exec() has failed." . PHP_EOL;
    // } else {
    // echo PHP_EOL . "INFO: Response Follows..." . PHP_EOL;
    // echo PHP_EOL . $response;
    // }
    //  $json_result = json_decode($response, true);
    // print_r($json_result);//echo '</pre>';
    ////////////////
            
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

// echo 'HTTP code: ' . $httpcode;
// $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
// $header = substr($response, 0, $header_size);
// $body = substr($response, $header_size);
//  echo '<br> header ================ <br>';
//  var_dump($header_size);
//  echo '<br> header ================ <br>';
//  var_dump($header);
//  echo '<br> body  ================ <br>';
//  var_dump($body);
 
  die;
 ?>
 
 <?php
 //$logFileHandle = fopen("/curl-error-log.txt", 'a+');
        $curl = curl_init();
        curl_setopt_array($curl, array(
             CURLOPT_URL => 'https://api.myresqr.life/tps/v1/register/',
            CURLOPT_RETURNTRANSFER => true,
           //    CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
             //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
             CURLOPT_POSTREDIR => CURL_REDIR_POST_ALL,
           CURLINFO_HEADER_OUT => true,
             CURLOPT_POST=>1,
            // CURLOPT_POSTFIELDS =>'{
            //     "uniqueId": "482DE5435",
            //     "firstname": "Ram",
            //     "lastname": "Verma",
            //     "mobile": "9876543210",
            //     "email": "ram@gmail.com",
            //     "gender": "Male",
            //     "address": "11, Hennur main road",
            //     "dob": "2016-02-05",
            //     "city": "Bengaluru",
            //     "state": "Karnataka",
            //     "pincode": "560077",
            //     "govtIdImageUrl": "https://some.com/ram-aadhar.png",
            //     "govtIdNumber": "451109443822",
            //     "govtIdType": "Aadhaar"
            //     }',
              CURLOPT_HTTPHEADER =>  $header_arr,
                CURLOPT_POSTFIELDS  =>json_encode($body) ,
          
      //      array(
//                 //  'x-myresqr-date: '.$current_Date,
//                 //  'Authorization: '.$result_newsign,
//                 // 'Content-Type: application/json',
//                 //  'Host: api.myresqr.life',
//                 //   'Authorization: HMAC-SHA256 Credential=20394hjendicaw08g212w&Signature=ng6mS/QaC1nP7ppQ1/Tsghi9WIA2GO0kHx0aomkRDcM='
        //     ),
            // CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => FALSE,
                  CURLOPT_HEADER=> true,
                //   CURLOPT_HEADER=> 1,
                        CURLOPT_VERBOSE => TRUE,
                   //    CURLOPT_FILE =>  $logFileHandle ,
 // CURLOPT_STDERR  =>  $logFileHandle,
                      //     CURLOPT_STDERR => $verbose = fopen('php://temp', 'rw+'),
        ));
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
var_dump($curl);
$response = curl_exec($curl);
$info = curl_getinfo($curl);
 curl_close($curl);
print_r($info);
print_r($response);
die;
 $curl_errno = curl_errno($curl);
        $curl_error = curl_error($curl);
        echo $curl_errno;
        echo $curl_error;
        
        
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

echo 'HTTP code: ' . $httpcode;
$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);
 echo '<br> header ================ <br>';
 var_dump($header_size);
 echo '<br> header ================ <br>';
 var_dump($header);
 echo '<br> body  ================ <br>';
 var_dump($body);
 

 
 die;

 echo "Verbose information:\n", !rewind($verbose), stream_get_contents($verbose), "\n";


//var_dump($response);
 
die;
            
  ?>
</body>
</html>