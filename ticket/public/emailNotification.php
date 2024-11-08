<?php

// Include PHPMailer classes (ensure PHPMailer is autoloaded)
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PDO;

// Database connection function (replace with your own database credentials)
function dbConnect() {
    $host = 'localhost';
    $dbname = 'u444388293_tickets';
    $username = 'u444388293_ticketAdmin';
    $password = 'AVav@@2020';
    
    return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
}
// Function to store or retrieve Message-ID from the database
function getOrCreateMessageId($ticketId) {
    $pdo = dbConnect();

    // Check if there's already a message ID for the ticket
    $stmt = $pdo->prepare("SELECT message_id FROM email_messages WHERE ticket_id = :ticketId LIMIT 1");
    $stmt->execute(['ticketId' => $ticketId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Return existing message ID
        return $result['message_id'];
    } else {
        // Create a new Message-ID and store it
        $newMessageId = uniqid() . "@sarsspl.com"; // Create a unique message ID

        $stmt = $pdo->prepare("INSERT INTO email_messages (ticket_id, message_id) VALUES (:ticketId, :messageId)");
        $stmt->execute(['ticketId' => $ticketId, 'messageId' => $newMessageId]);

        return $newMessageId;
    }
}

// Function to send email with optional attachments
// Function to send email with optional attachments

// Function to send email with optional attachments
function sendTicketEmail($toEmail, $toName, $subject, $ticketDetails, $ccEmails = [], $attachments = []) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                          
        $mail->Host       = 'smtp.hostinger.com';                   
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = 'tickets@sarsspl.com';               
        $mail->Password   = 'AVav@@2020';                        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
        $mail->Port       = 587;                                   

        // Recipients
        $mail->setFrom('tickets@sarsspl.com', 'Ticketing System');
        $mail->addAddress($toEmail, $toName);


        // Add CC recipients
        foreach ($ccEmails as $ccEmail) {
            $mail->addCC($ccEmail);
        }
        
                    $mail->addCC('kvaljani@gmail.com');


        // Email headers
        $mail->isHTML(true);                                 
        $mail->Subject = $subject;

        // Remove this part as PHPMailer automatically generates Message-ID
        // $messageId = getOrCreateMessageId($ticketDetails['ticket_id']);
        // $mail->addCustomHeader('Message-ID', $messageId); // Remove this line

        // Email body with HTML template
        $mail->Body = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #2c3e50;
                    margin-top: 0;
                }
                .ticket-details {
                    margin: 20px 0;
                }
                .ticket-details p {
                    line-height: 1.5;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                    color: #999;
                    font-size: 12px;
                }
                .button {
                    background-color: #28a745;
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                    display: inline-block;
                    margin-top: 20px;
                }
                .button:hover {
                    background-color: #218838;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Ticket Notification</h2>
                <p>Hello $toName,</p>
                <p>A new ticket has been created with the following details:</p>
                
                <div class='ticket-details'>
                    <p><strong>Ticket ID:</strong> {$ticketDetails['ticket_id']}</p>
                    <p><strong>Title:</strong> {$ticketDetails['title']}</p>
                    <p><strong>Status:</strong> {$ticketDetails['status']}</p>
                    <p><strong>Description:</strong> {$ticketDetails['description']}</p>
                </div>
                
                <a href='https://sarsspl.com/ticket/public/view_ticket.php?ticket_id={$ticketDetails['ticket_id']}' class='button'>View Ticket</a>

                <p>For any queries, feel free to contact us.</p>
            </div>
        </body>
        </html>";

        // Add attachments if any
        foreach ($attachments as $attachment) {
            $mail->addAttachment($attachment);
        }

        // Send email
        $mail->send();
        echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// function sendTicketEmail($toEmail, $toName, $subject, $ticketDetails, $ccEmails = [], $attachments = []) {
//     $mail = new PHPMailer(true);

//     try {
//         // Server settings
//         $mail->isSMTP();                                          
//         $mail->Host       = 'smtp.hostinger.com';                   
//         $mail->SMTPAuth   = true;                                 
//         $mail->Username   = 'tickets@sarsspl.com';              
//         $mail->Password   = 'AVav@@2020';                        
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
//         $mail->Port       = 587;                                   

//         // Content
//         $mail->setFrom('tickets@sarsspl.com', 'Ticketing System');
//         $mail->addAddress($toEmail, $toName);

//         // Add CC recipients
//         foreach ($ccEmails as $ccEmail) {
//             $mail->addCC($ccEmail);
//         }

//         // Email headers
//         $mail->isHTML(true);                                 
//         $mail->Subject = $subject;

//         // Create a unique Message-ID if needed
//         $messageId = getOrCreateMessageId($ticketDetails['ticket_id']); // your custom function to get/create Message-ID
//         $mail->addCustomHeader('Message-ID', $messageId); // Set custom Message-ID

//         // Email body with HTML template
//         $mail->Body = "
//         <html>
//         <head>
//             <style>
//                 body {
//                     font-family: Arial, sans-serif;
//                     background-color: #f4f4f4;
//                     color: #333;
//                     margin: 0;
//                     padding: 0;
//                 }
//                 .container {
//                     width: 100%;
//                     max-width: 600px;
//                     margin: 0 auto;
//                     padding: 20px;
//                     background-color: #fff;
//                     border-radius: 10px;
//                     box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
//                 }
//                 h2 {
//                     color: #2c3e50;
//                     margin-top: 0;
//                 }
//                 .ticket-details {
//                     margin: 20px 0;
//                 }
//                 .ticket-details p {
//                     line-height: 1.5;
//                 }
//                 .footer {
//                     text-align: center;
//                     margin-top: 20px;
//                     color: #999;
//                     font-size: 12px;
//                 }
//                 .button {
//                     background-color: #28a745;
//                     color: white;
//                     padding: 10px 20px;
//                     text-decoration: none;
//                     border-radius: 5px;
//                     display: inline-block;
//                     margin-top: 20px;
//                 }
//                 .button:hover {
//                     background-color: #218838;
//                 }
//             </style>
//         </head>
//         <body>
//             <div class='container'>
//                 <h2>Ticket Notification</h2>
//                 <p>Hello $toName,</p>
//                 <p>A new ticket has been created with the following details:</p>
                
//                 <div class='ticket-details'>
//                     <p><strong>Ticket ID:</strong> {$ticketDetails['ticket_id']}</p>
//                     <p><strong>Title:</strong> {$ticketDetails['title']}</p>
//                     <p><strong>Status:</strong> {$ticketDetails['status']}</p>
//                     <p><strong>Description:</strong> {$ticketDetails['description']}</p>
//                 </div>
                
//                 <a href='https://sarsspl.com/ticket/public/view_ticket.php?ticket_id={$ticketDetails['ticket_id']}' class='button'>View Ticket</a>

//                 <p>For any queries, feel free to contact us.</p>
//             </div>
//         </body>
//         </html>";

//         // Add attachments if any
//         foreach ($attachments as $attachment) {
//             $mail->addAttachment($attachment); // Add attachment
//         }

//         // Send email
//         $mail->send();
//         echo 'Email sent successfully!';
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }
// }

