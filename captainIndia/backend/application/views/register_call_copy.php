<!DOCTYPE html>
<html> 
<head> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
     
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js" type="text/javascript"></script>
      <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
    <?php
        echo "<pre>";
	    error_reporting(E_ALL);        ini_set('display_errors', '1');
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
        
        $verb = strtoupper("POST");
        $secret = "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI";
        $utcNow = $current_Date;
        //$contentHash = base64_encode(hash('sha256', $body));// M1Jg4opA1xgATQGW0JxQfevaGTz3CI1iA0v8r4UbZzw= // CryptoJS.SHA256(body).toString(CryptoJS.enc.Base64);
       
        $contentHash_body = hash('sha256', $body);
        $contentHash = base64_encode($contentHash_body);
        $contentHash = '/lOGKuNyI7nwZNQbQ7dBJlL2IrLmxxPKCMOkwHD/y8Q=';
        //print_r($newsign);      ///  die;
        $url = '/tps/v1/register/';//'https://api.myresqr.life/tps/v1/register/';
        $host = 'api.myresqr.life';
        // $stringToSign = $verb  . '\n' . $url . '\n' . $utcNow .';' . $host .  ';' .  $contentHash;
        $stringToSign = $verb  .  $url .  $utcNow .';' . $host .  ';' .  $contentHash;
       
        
        $signature = base64_encode(hash_hmac('sha256', $stringToSign, $secret, true));
      
        
        $HMAccredentials = "20394hjendicaw08g212w"; 
        $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials;
        $newsign2 = "&Signature=" . $signature;
        $result_newsign = $newsign . $newsign2 ;
        echo '<br>';
    ?>
 <script>
 
  function signRequest(host, method, url, body, secret="zD077AOGlzJEmKyJC0c0lYofgQaGIaTI")
{
        var verb = method.toUpperCase();
        var utcNow = new Date().toUTCString();
        var contentHash = CryptoJS.SHA256(body).toString(CryptoJS.enc.Base64);
        var stringToSign = verb + '\n' + url + '\n' + utcNow + ';' + host + ';' + contentHash;
        var signature = CryptoJS.HmacSHA256(stringToSign, secret).toString(CryptoJS.enc.Base64);
        var HMAccredentials = "20394hjendicaw08g212w"; 
        var newsign = "HMAC-SHA256 Credential=" + HMAccredentials;
        var newsign2 = "&Signature=" + signature;
        newsign = newsign + newsign2 ;
        var ddd='abcd';
        var aaa= CryptoJS.SHA256(ddd).toString(CryptoJS.enc.Base64);
        return [
            {key: "x-myresqr-date", value: utcNow},
            {key: "Authorization", value: newsign},
           // {key: "contentHash", value:  contentHash }
        ];
}

let body = <?php echo $body; ?>;//pm.request.body.toString();
let method =   'POST';// pm.request.method;
let url ='/tps/v1/register/';; // pm.request.url.getPathWithQuery();
let host = "api.myresqr.life";
let headers = signRequest(host, method, url, body);
 
var js_Authorization =   headers[1].key+': '+ headers[1].value;
var js_myresqr_date =   headers[0].key+': '+ headers[0].value;
 
//headers.forEach(val =>  addHeader(val));
console.log(headers);
var secret="zD077AOGlzJEmKyJC0c0lYofgQaGIaTI";
  var verb = method.toUpperCase();
        var utcNow = new Date().toUTCString();
       // alert(utcNow);
        var contentHash = CryptoJS.SHA256(body).toString(CryptoJS.enc.Base64);
        var stringToSign = verb + '\n' + url + '\n' + utcNow + ';' + host + ';' + contentHash;
        var signature = CryptoJS.HmacSHA256(stringToSign, secret).toString(CryptoJS.enc.Base64);
        var HMAccredentials = "20394hjendicaw08g212w"; 
        var newsign = "HMAC-SHA256 Credential=" + HMAccredentials;
        var newsign2 = "&Signature=" + signature;
        newsign = newsign + newsign2 ;
//alert(newsign);
</script>
  <?php
$php_Authorization = "<script>document.write(js_Authorization)</script>";
$php_myresqr_date = "<script>document.write(js_myresqr_date)</script>";
$php_newsign= "<script>document.write(newsign)</script>";
var_dump( $php_Authorization);
//die;
$header_arr= array(
'x-myresqr-date: '.$utcNow,
'Authorization: '.$php_newsign,
'Content-Type: application/json',
'Host: api.myresqr.life',
);
print_r($header_arr);
print_r($php_myresqr_date);
?> 
 <?php
 $logFileHandle = fopen("/curl-error-log.txt", 'a+');
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
                       CURLOPT_FILE =>  $logFileHandle ,
  CURLOPT_STDERR  =>  $logFileHandle,
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