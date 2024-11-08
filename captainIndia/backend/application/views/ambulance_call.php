<!DOCTYPE html>
<html> 
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
    <?php
        echo "<pre>";
        date_default_timezone_set('GMT');
        $body = '{
                "deviceId": "c1tou_IXSLOkJmDAbQHxWk:APA91bHzYsetcCE9MZjimL_Rsd3vJNZ5udSeuNPehbZz7VhE-BuBNlj0hAGIZ7akoA2iqE190zgA_ym1szB-fEGXfcG31hQPgho7xSJrvhNORB1ybZam8Hf6toqbQxDNwnx_AM4N9Sp4",
                "location": "[12.987558, 77.705589]",
                "uniqueId": "485435"
                }
                ';
 
        echo '<br>';
    ?>
 <script>
    // function signRequest(host, method, url, body, secret="zD077AOGlzJEmKyJC0c0lYofgQaGIaTI") {
    //     var verb = method.toUpperCase();
    //     var utcNow = new Date().toUTCString();
    //     var contentHash = CryptoJS.SHA256(body).toString(CryptoJS.enc.Base64);
    //     var stringToSign = verb + '\n' + url + '\n' + utcNow + ';' + host + ';' + contentHash;
    //     var signature = CryptoJS.HmacSHA256(stringToSign, secret).toString(CryptoJS.enc.Base64);
    //     var HMAccredentials = "20394hjendicaw08g212w"; 
    //     var newsign = "HMAC-SHA256 Credential=" + HMAccredentials;
    //     var newsign2 = "&Signature=" + signature;
    //     newsign = newsign + newsign2 ;
    //     return [
    //         {key: "x-myresqr-date", value: utcNow},
    //         {key: "Authorization", value: newsign}
    //     ];
    // }
    var utcNow = new Date().toUTCString();
    let body = <?php echo $body; ?>;//pm.request.body.toString();
    body=body.toString();
    let method =   'POST';// pm.request.method;
    var verb = method.toUpperCase();
    var contentHash = CryptoJS.SHA256(body).toString(CryptoJS.enc.Base64);
    var secret="zD077AOGlzJEmKyJC0c0lYofgQaGIaTI";
    let url ='/tps/v1/call-ambulance/';
    let host = "api.myresqr.life";
    var stringToSign = verb + '\n' + url + '\n' + utcNow + ';' + host + ';' + contentHash;
        var signature = CryptoJS.HmacSHA256(stringToSign, secret).toString(CryptoJS.enc.Base64);
        var HMAccredentials = "20394hjendicaw08g212w"; 
        var newsign = "HMAC-SHA256 Credential=" + HMAccredentials;
        var newsign2 = "&Signature=" + signature;
        newsign = newsign + newsign2 ;
  //  let headers = signRequest(host, method, url, body);
    var js_Authorization = 'Authorization: '+ newsign;
    var js_myresqr_date =  'x-myresqr-date: '+ utcNow;
    //console.log(headers);
</script>
<?php
    $php_Authorization = "<script>document.write(js_Authorization)</script>";
    $php_myresqr_date = "<script>document.write(js_myresqr_date)</script>";
    $php_newsign= "<script>document.write(newsign)</script>";
    $php_utcNow = "<script>document.write(utcNow)</script>";
    var_dump( $php_Authorization);
    //die;
    $header_arr= array(
        'x-myresqr-date: '.$php_utcNow,
        'Authorization: '.$php_newsign,
        'Content-Type: application/json',
     //   'Host: api.myresqr.life',
    );
    print_r($header_arr);
    //die;
    
   

$curl = curl_init();

curl_setopt($curl,   CURLOPT_URL , 'https://api.myresqr.life/tps/v1/call-ambulance/');
curl_setopt($curl,   CURLOPT_RETURNTRANSFER , true);
//curl_setopt($curl,  CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);

curl_setopt($curl,   CURLOPT_ENCODING , '');
curl_setopt($curl,   CURLOPT_MAXREDIRS , 10);
curl_setopt($curl,   CURLOPT_TIMEOUT ,  0);
curl_setopt($curl,   CURLOPT_FOLLOWLOCATION , true);
curl_setopt($curl,   CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
curl_setopt($curl,   CURLOPT_CUSTOMREQUEST , 'POST');
//   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
// curl_setopt($curl,   CURLOPT_POSTFIELDS ,'{
// "deviceId": "c1tou_IXSLOkJmDAbQHxWk:APA91bHzYsetcCE9MZjimL_Rsd3vJNZ5udSeuNPehbZz7VhE-BuBNlj0hAGIZ7akoA2iqE190zgA_ym1szB-fEGXfcG31hQPgho7xSJrvhNORB1ybZam8Hf6toqbQxDNwnx_AM4N9Sp4",
// "location": "[12.987558, 77.705589]",
// "uniqueId": "485435"
// }');
curl_setopt($curl, CURLOPT_POSTFIELDS, "{\n\"deviceId\": \"c1tou_IXSLOkJmDAbQHxWk:APA91bHzYsetcCE9MZjimL_Rsd3vJNZ5udSeuNPehbZz7VhE-BuBNlj0hAGIZ7akoA2iqE190zgA_ym1szB-fEGXfcG31hQPgho7xSJrvhNORB1ybZam8Hf6toqbQxDNwnx_AM4N9Sp4\",\n\"location\": \"[12.987558, 77.705589]\",\n\"uniqueId\": \"485435\"\n}\n");

//  curl_setopt($curl,   CURLOPT_HTTPHEADER , array(
//     'Content-Type: application/json',
//      'x-myresqr-date: '.$php_utcNow,
//         'Authorization: '.$php_newsign,
//         'Content-Type: application/json',
//   ));

   $headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'x-myresqr-date: '.$php_utcNow;
$headers[] =  'Authorization: '.$php_newsign;
 curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
   curl_setopt($curl, CURLOPT_HEADER, true);
   ///////////////
   curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
  
  //  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=UTF-8'));
 
$response = curl_exec($curl);

curl_close($curl);
echo $response;
 if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
}
    $info = curl_getinfo($curl);
  
    print_r($info);
    print_r($response);
    if ( $response === false ) {
        echo PHP_EOL . "ERROR: curl_exec() has failed." . PHP_EOL;
    } else {
    echo PHP_EOL . "INFO: Response Follows..." . PHP_EOL;
    echo PHP_EOL . $response;
    }
     $json_result = json_decode($response, true);
    print_r($json_result);//echo '</pre>';
  //die;
 ?>
<?php
    //$logFileHandle = fopen("/public_html/clientprojects/captainindia.anekalabs.com/backend/curlerr.txt", 'a+');
   // $logFileHandle = fopen("/home3/anekazcu/public_html/clientprojects/captainindia.anekalabs.com/backend/curlerr.txt", 'a+');
    //$logFileHandle = fopen("https://captainindia.anekalabs.com/backend/curlerr.txt", 'a+');
    
    $header  = "POST HTTP/1.0 \r\n";
$header .= "Content-type: text/xml \r\n";
$header .= "Content-length: ".strlen($body)." \r\n";
$header .= "Content-transfer-encoding: text \r\n";
$header .= "Connection: close \r\n\r\n"; 
$header .= $body;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.myresqr.life/tps/v1/call-ambulance/',
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
            CURLOPT_POSTFIELDS =>'{
                "deviceId": "c1tou_IXSLOkJmDAbQHxWk:APA91bHzYsetcCE9MZjimL_Rsd3vJNZ5udSeuNPehbZz7VhE-BuBNlj0hAGIZ7akoA2iqE190zgA_ym1szB-fEGXfcG31hQPgho7xSJrvhNORB1ybZam8Hf6toqbQxDNwnx_AM4N9Sp4",
                "location": "[12.987558, 77.705589]",
                "uniqueId": "485435"
                }
                ',
            //    CURLOPT_POSTFIELDS  =>json_encode($body) ,
              CURLOPT_HTTPHEADER =>  $header_arr,
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
         
         //   CURLOPT_FILE =>  $logFileHandle ,
        //    CURLOPT_STDERR  =>  $logFileHandle,
    //     CURLOPT_STDERR => $verbose = fopen('php://temp', 'rw+'),
        ));
    var_dump($curl);
    $response = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);
    print_r($info);
    print_r($response);
   // die;
    $curl_errno = curl_errno($curl);
    $curl_error = curl_error($curl);
    echo $curl_errno;
    echo " curl_error = ". $curl_error;
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
    
if ( $response === false )
{
echo PHP_EOL . "ERROR: curl_exec() has failed." . PHP_EOL;
}
else
{
echo PHP_EOL . "INFO: Response Follows..." . PHP_EOL;
echo PHP_EOL . $response;
}
    die;
    echo "Verbose information:\n", !rewind($verbose), stream_get_contents($verbose), "\n";
    //var_dump($response);
    die;
?>
</body>
</html>