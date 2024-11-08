<?php

// $host = 'mail.khil.com';
// $hostusername = 'orchidgoldpune@orchidhotel.com';
// $hostpassword = 'Orchid#2022';



// $host = 'mail.clubfourpoints.com';
// $hostusername = 'contactus@clubfourpoints.com';
// $hostpassword = 'QKAc&mn,[xY%';


$host = 'smtp.hostinger.com';
$hostusername = 'contactus@theresortexperiences.com';
$hostpassword = 'mckyaUC,?z5H';


    $port = '587';

    $nodes = 'https://sarmicrosystems.in/SarMailor_APIS/mail.php';
    


$Static_LeadID = 'work.rajeshb@gmail.com';
$subject = 'mail chck test';
$message = 'check mail now';
$leadsmail = "rajeshrungta19@gmail.com";

    // $from = 'orchidgoldpune@orchidhotel.com';
     $from = 'contactus@theresortexperiences.com';
    $fromname = 'The Resort Mumbai' ; 
    
    $member_email = 'hellbinderkumar@gmail.com';    
    $to =[$member_email];
    // $cc = ['work.rajeshb@gmail.com','vishwaaniruddh@gmail.com'];
    $cc = ['work.rajeshb@gmail.com'];
    $bcc = ['pratimabiswas657@gmail.com'];

    
    
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
    $result =  file_get_contents($nodes, false, $context);
var_dump($result);

?>