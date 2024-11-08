<?
$to = 'aniruddh@smartscoreanalytics.com';


// $to='aniruddhvishwa@gmail.com';

    $link= '<html><body>';
    $link .= '<h3>Mail Set !</h3> ';
    // $link .= '<span> The transaction id for your reference is  '.sasas.'! </span>';

  
    $link .= '</body></html>';
    
    $headers .= "Reply-To: The Sender aniruddh@sarmicrosystems.in\r\n"; 
    $headers .= "Return-Path: The Sender aniruddh@sarmicrosystems.in\r\n"; 
    $headers .= "From: aniruddh@sarmicrosystems.in" ."\r\n" .
    $headers .= "Organization: Sender Organization\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
    if(mail($to, "Message", $link, $headers)){
echo '1';
    }

?>