<html>

<head>
    <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>        -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>

<body>
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__ . '/phpmailer/src/Exception.php';
    require __DIR__ . '/phpmailer/src/PHPMailer.php';
    require __DIR__ . '/phpmailer/src/SMTP.php';

    // Sender and recipient details
    // $senderEmail = 'rajeshrungta719@gmail.com';
    $senderEmail = 'contactus@sarsspl.com';
    $senderName = 'SAR Software Solutions Website';

    $name = $_POST['username'];
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $message= $_POST['message'];
    $subject = $_POST['subject'];

    $from  = 'SAR Software Solutions | Contact Form !';
    $message = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .container {
                background-color: #f4f4f4;
                padding: 20px;
                border-radius: 5px;
                text-align: center;
            }
            .otp {
                font-size: 20px;
                color: #007bff;
            }

            .font {
                font-size: 22px;
                color : #000;
                font-weight: 550;
                text-align: justify-all;
            }

            .head {
                font-size : 24px;
                color: red;
                font-weight: 700;
            }

            .head1 {
                font-size : 20px;
                color: black;
                font-weight: 700;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2 class='head' ><u>Contacted Person's Details</u></h2>
            <p class='head1'>We have received the details of the contacted person.</p>
            <p class='font'>Name: <span class='otp'>$name</span></p>
            <p class='font'>Email: <span class='otp'>$email</span></p>
            <p class='font'>Contact Number: <span class='otp'>$phone</span></p>
            <p class='font'>Subject: <span class='otp'>$subject</span></p>
            <p class='font'>Message: <span class='otp'>$message</span></p>
        </div>
    </body>
    </html>
";

    // echo $message;
    // die;

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        // $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'contactus@sarsspl.com'; // Your Gmail address
        $mail->Password = 'Contactus@2024!*'; // Your Gmail app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable SSL encryption
        $mail->Port = 465; // TCP port to connect to

        // Disable SSL certificate verification (only for debugging)
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Recipients
        $mail->setFrom('contactus@sarsspl.com', 'SAR Software Solutions');
        $mail->addAddress($senderEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) { ?>

    <script>
    swal("Mail Sent Successfully", "We'll Contact You Shortly !", "success");

    setTimeout(function() {
        window.location.href = "contact.php";
    }, 3000);
    </script>

    <?php  } else { ?>
    <script>
    swal("Oops !", "Something Went Wrong !", "error");

    setTimeout(function() {
        window.history.back();
    }, 3000);
    </script>

    <?php }
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    ?>

</body>

</html>