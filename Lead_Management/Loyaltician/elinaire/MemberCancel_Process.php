<?php session_start(); ?>
<html>

<head>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>

<body>
  <?php
  include ('config.php');

  $Reson = $_POST['Reson'];
  $LeadId = $_POST['HiddenId'];



  $Qry = mysqli_query($conn, "Update Members set MemberCancelationReason='" . $Reson . "',canceledMember='1' where Static_LeadID='" . $LeadId . "' ");

  $Qry1 = mysqli_query($conn, "Update Leads_table set Status='8' where Lead_id='" . $LeadId . "' ");

  if ($Qry && $Qry1) {


    $log = mysqli_query($conn, "select Primary_nameOnTheCard,GenerateMember_Id,booklet_Series from Members where Static_LeadID='" . $LeadId . "'");
    $fetchLog = mysqli_fetch_array($log);
    //===========for mail (Canceled Member Log Details )===============
  
    $EmailSubject2 = "Member cancelaed by " . $_SESSION['user'];

    $message2 .= 'Member Cancel by ' . $_SESSION['user'] . '<br> The Following Details is :<br> Member Name : ' . $fetchLog['Primary_nameOnTheCard'] . '<br>  Member Number : ' . $fetchLog['GenerateMember_Id'] . '<br>  Booklet Series : ' . $fetchLog['booklet_Series'];


    $leadsmail2 = " Orchidmembership@loyaltician.com";
    $mailheader2 = "From: " . $leadsmail2 . "\r\n";
    $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

    require 'phpmail/src/PHPMailer.php';
    require 'phpmail/src/SMTP.php';
    require 'phpmail/src/Exception.php';

    $pagesource = "MemberCancel_Process";
    $memid = $LeadId;
    $msg = "";


    $mail2 = new PHPMailer\PHPMailer\PHPMailer();
    try {
      //Server settings
      //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail2->isSMTP();                                      // Set mailer to use SMTP
      $mail2->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
      $mail2->SMTPAuth = true;                               // Enable SMTP authentication
      $mail2->Username = 'contactus@theresortexperiences.com';                 // SMTP username
      $mail2->Password = '94Z6g.;d1CSq';                           // SMTP password
      $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail2->Port = 587;                                    // TCP port to connect to
  
      //Recipients
      $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'orchidhotel');
      $mail2->addAddress('meanand.gupta21@gmail.com');
      $mail2->mailheader = $mailheader2;// Add a recipient
      //  $mail->addCC('leads@loyaltician.com');
      $mail2->addBCC('kvaljani@gmail.com ');
      $mail2->addCC('admin.orchidpune@loyaltician.com');


      $mail2->isHTML(true);                                  // Set email format to HTML
      $mail2->Subject = $EmailSubject2 . "\r\n";
      $mail2->Body = $message2;
      $mail2->send();
      //==============mail end===
    } catch (Exception $e) {

      $msg = "Mail not send due to SMTP Host error!!!";

    }


    if ($msg != '') {
      $sqlr = mysqli_query($conn, "insert into testcatchdata (message,page_source,mem_id,status) values ('" . $msg . "','" . $pagesource . "','" . $memid . "',0) ");

    } else {
    }



    ?>






    <script>
      swal({
        title: "Success!",
        text: "Member Cancel Successfully.!",
        icon: "success",
        // buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            // window.open("Members_view.php", "_self");
              window.location.href = "Members_view.php";

          }
        });

    </script>
  <?php
  } else {
    echo "<script>swal('Error !')</script>";
  }

  ?>

</body>

</html>