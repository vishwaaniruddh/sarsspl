<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$subject = 'Hello Test Mail Orchid';
$message = ' Test Email ';
$leadsmail = 'Orchidmembership@loyaltician.com';
$host = 'mail.khil.com';
$hostusername = 'orchidgoldpune@orchidhotel.com';
$hostpassword = 'Orchid#2022';
$port = '587';
$from = 'orchidgoldpune@orchidhotel.com';
$fromname = 'The Orchid Hotel Pune';
$to = ['rajeshrungta719@gmail.com'];
$cc = ['aniruddhvishwa@gmail.com'];
$bcc = ['vishwaaniruddh@gmail.com'];




$nodes = 'https://arpeeindustries.com/mail.php';
$data = array(
    'subject' => $subject,
    'message' => $message,
    'leadsmail' => $leadsmail,
    'host' => $host,
    'hostusername' => $hostusername,
    'hostpassword' => $hostpassword,
    'port'=> $port ,
    'from'=>$from,
    'fromname'=>$fromname,
    'to'=>$to,
    'cc'=>$cc,
    'bcc'=>$bcc,
    );

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($nodes, false, $context);

var_dump($result);
?>