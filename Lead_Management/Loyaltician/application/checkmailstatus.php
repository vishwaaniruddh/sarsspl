<?php

$host = 'mail.khil.com';
$hostusername = 'orchidgoldpune@orchidhotel.com';
$hostpassword = 'Orchid#2022';
$port = '587';

$subject = 'mail test';
$message = 'test mail';
$from = 'orchidgoldpune@orchidhotel.com';
$fromname = 'The Orchid Hotel Pune';
$to = ['work.rajeshb@gmail.com', 'rajeshrungta719@gmail.com'];
$cc = ['hellbinderkumar@gmail.com'];
$cc = ['pratimabiswas657@gmail.com'];

$nodes = 'https://arpeeindustries.com/mail.php';
// $nodes = 'https://sarmicrosystems.in/phpmailerfiles/resortmumbai_mail.php';

$data = array(
    'subject' => $subject,
    'message' => $message,
    'leadsmail' => $to,
    'host' => $host,
    'hostusername' => $hostusername,
    'hostpassword' => $hostpassword,
    'port' => $port,
    'from' => $from,
    'fromname' => $fromname,
    'to' => $to,
    'cc' => $cc,
    'bcc' => $bcc,
);


// $ch = curl_init($nodes);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// // execute!
// $response = curl_exec($ch);

// // close the connection, release resources used
// curl_close($ch);

// // do anything you want with your response
// var_dump($response);

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$context = stream_context_create($options);
$result = file_get_contents($nodes, false, $context);
var_dump($result);


?>