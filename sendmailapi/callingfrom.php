<?php 

$nodes = 'https://sendmailapi.sarmicrosystems.in/api.php';
$EmailSubject2="Welcome to Orchid First!";
$subject = $EmailSubject2 ; 
      
        $message2.='<table width="70%" align="center">';
          $message2.='<tr>';
           $message2.='<th><img src="http://loyaltician.in/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';
           
        $message2.='<th><img src="http://loyaltician.in/application/FIRST.png" alt="FIRST.png" />    </th>';
        $message2.='</tr><tr>';
        $message2.='<th style="text-align: left;"><b >Dear Aniruddh  ,</b></th></tr><tr></br>';
         $message2.='<td>Welcome to Orchid First and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.<br><br>
         Your Membership Card number is here to view the Summary of Benefits of the membership.<br><br>
         The annual membership charge of Rs.<br><br>
         You can present your membership number or a copy of this email to start using your membership benefits.<br></br>
         The complete welcome package will reach you within 10 working days of this e-mail. Your membership gift certificates along with the membership are given at the bottom of this email.<br><br>
         We look forward to welcoming you as our esteemed Orchid First member.<br></br>
         </td>';
       
       
        $message2.='</tr></table>';
       
         
$message2.='</table>';


$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2.='</table>';


$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><img src="http://loyaltician.in/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://loyaltician.in/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://loyaltician.in/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://loyaltician.in/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



$message2.='<tr><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com)
and the addressee whose name is specified above. Should you receive this message by mistake, we would be
most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete
this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your
cooperation and understanding.</td></tr>';

$message2.='</table>';

$message =$message2 ;

$from = 'rajeshbiswas@sarmicrosystems.in';
$to = 'vishwaaniruddh@gmail.com';

        $data = array(
        'subject' => $subject,
        'from' => $from,
        'to' => $to,
        'message' => $message,
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