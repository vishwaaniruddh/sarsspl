<?php
header("Content-Type:  application/json");

$data = [
          'phone'=> 919768102829,
          'body'=> "'Sahi ha'"
        ];
    
    
    
      $json = json_encode($data); // Encode data to JSON

      echo $json;


      $url = 'https://api.chat-api.com/instance141128/sendMessage?token=l56fn1j0s74ju8vs';
        
      $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        
        
        var_dump($options);
        $result = file_get_contents($url, false, $options);


        // return;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
$json = curl_exec($ch);
if(!$json) {
    echo curl_error($ch);
}
curl_close($ch);
print_r(json_decode($json));



var_dump($result);

?>