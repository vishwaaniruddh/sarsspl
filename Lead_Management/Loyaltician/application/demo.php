<?php

$host = 'mail.khil.com';
$hostusername = 'orchidgoldpune@orchidhotel.com';
$hostpassword = 'Orchid#2022';
$port = '587';


$host = 'mail.clubfourpoints.com';
$hostusername = 'contactus@clubfourpoints.com';
$hostpassword = 'QKAc&mn,[xY%';
$port = '587';



$nodes = 'https://arpeeindustries.in/mail.php';
// $nodes = 'https://sarmicrosystems.in/SarMailor_APIS/mail.php';
// $nodes = 'https://avoservice.in/SarMailor_APIS/mail.php';

$EmailSubject2 = "Test Welcome to Orchid First!";
$subject = $EmailSubject2;

$message = 'HI';

$leadsmail2 = " Orchidmembership@loyaltician.com";
$leadsmail = $leadsmail2;

$mailheader2 = "From: " . $leadsmail2 . "\r\n";
$mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

//==============mail end===



$from = 'orchidgoldpune@orchidhotel.com';
$fromname = 'The Orchid Hotel Pune';
$member_email = 'vishwaaniruddh@gmail.com';
$to = [$member_email];

$bcc = ['vishwaaniruddh@gmail.com'];

$data = array(
    'subject' => $subject,
    'message' => $message,
    'leadsmail' => $leadsmail,
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