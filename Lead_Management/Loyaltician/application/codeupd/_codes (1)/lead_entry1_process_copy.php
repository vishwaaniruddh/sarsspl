<?php session_Start();
include ('config.php');

//   FirstName LastName offNum mob1 state City Company Designation Gmail

$Title = $_POST['Title'];
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$fullname = $FirstName . " " . $LastName;
$mcode1 = $_POST['mcode1'];
$mob1 = $_POST['mob1'];
$Contact1code = $_POST['Contact1code'];
$offNum = $_POST['offNum'];
$Contact2code = $_POST['Contact2code'];
$Contact2 = $_POST['Contact2'];
$Contact3code = $_POST['Contact3code'];
$Contact3 = $_POST['Contact3'];
$Country = $_POST['Country'];
$Nationality = $_POST['Nationality'];
$state = $_POST['state'];
$City = $_POST['City'];
$Company = $_POST['Company'];
$Designation = $_POST['Designation'];
$Gmail = $_POST['Gmail'];
$Relationship = $_POST['Relationship'];
$Facebook = $_POST['Facebook'];
$source = $_POST['Source'];
$Hotel = '2';
$PincodeOfArea = $_POST['PincodeOfArea'];
$Pincode = $_POST['Pincode'];
$LeadByLead = $_POST['LeadByLead'];
$LeadByMember = $_POST['LeadByMember'];

date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');



if ($_POST['action'] == "LeadUpdate") {
    $MainGetID = $_POST['MainGetID'];
    $sql = "update Leads_table set Title='" . $Title . "',FirstName='" . $FirstName . "',LastName='" . $LastName . "',MobileCode='" . $mcode1 . "',MobileNumber='" . $mob1 . "',contact1Code='" . $Contact1code . "',ContactNo1='" . $offNum . "',contact2Code='" . $Contact2code . "',ContactNo2='" . $Contact2 . "',contact3Code='" . $Contact3code . "',ContactNo3='" . $Contact3 . "',EmailId='" . $Gmail . "',FacebookId='" . $Facebook . "',Country='" . $Country . "',State='" . $state . "',City='" . $City . "',pincodeOfArea='" . $PincodeOfArea . "',PinCode='" . $Pincode . "',Nationality='" . $Nationality . "',Company='" . $Company . "',Designation='" . $Designation . "',DelegationStatus='" . $Relationship . "',Creation='" . $dates . "',LeadSource='" . $source . "',Status='0',leadEntryef='" . $_SESSION['id'] . "',Hotel_Name='" . $Hotel . "',LeadByLead='" . $LeadByLead . "',LeadByMember='" . $LeadByMember . "' where Lead_id='" . $MainGetID . "' ";
    $runsql1 = mysqli_query($conn, $sql);
}

if ($_POST['action'] == "excelUpdate") {
    $MainGetID = $_POST['MainGetID'];

    $sql = "update Leads_table set Title='" . $Title . "',FirstName='" . $FirstName . "',LastName='" . $LastName . "',MobileCode='" . $mcode1 . "',MobileNumber='" . $mob1 . "',contact1Code='" . $Contact1code . "',ContactNo1='" . $offNum . "',contact2Code='" . $Contact2code . "',ContactNo2='" . $Contact2 . "',contact3Code='" . $Contact3code . "',ContactNo3='" . $Contact3 . "',EmailId='" . $Gmail . "',FacebookId='" . $Facebook . "',Country='" . $Country . "',State='" . $state . "',City='" . $City . "',pincodeOfArea='" . $PincodeOfArea . "',PinCode='" . $Pincode . "',Nationality='" . $Nationality . "',Company='" . $Company . "',Designation='" . $Designation . "',DelegationStatus='" . $Relationship . "',Creation='" . $dates . "',LeadSource='" . $source . "',Status='0',leadEntryef='" . $_SESSION['id'] . "',Hotel_Name='" . $Hotel . "',LeadByLead='" . $LeadByLead . "',LeadByMember='" . $LeadByMember . "',Excel='2' where Lead_id='" . $MainGetID . "' ";
    $runsql = mysqli_query($conn, $sql);

}

if ($_POST['action'] == "submit") {

    $sql = "insert into Leads_table(Title,FirstName,LastName,MobileCode,MobileNumber,contact1Code,ContactNo1,contact2Code,ContactNo2,contact3Code,ContactNo3,EmailId,FacebookId,Country,State,City,pincodeOfArea,PinCode,Nationality,Company,Designation,DelegationStatus,Creation,LeadSource,Status,leadEntryef,Hotel_Name,LeadByLead,LeadByMember) values('" . $Title . "','" . $FirstName . "','" . $LastName . "','" . $mcode1 . "','" . $mob1 . "','" . $Contact1code . "','" . $offNum . "','" . $Contact2code . "','" . $Contact2 . "','" . $Contact3code . "','" . $Contact3 . "','" . $Gmail . "','" . $Facebook . "','" . $Country . "','" . $state . "','" . $City . "','" . $PincodeOfArea . "','" . $Pincode . "','" . $Nationality . "','" . $Company . "','" . $Designation . "','" . $Relationship . "','" . $dates . "','" . $source . "','0','" . $_SESSION['id'] . "','" . $Hotel . "','" . $LeadByLead . "','" . $LeadByMember . "')";
    // echo $sql;
    $runsql = mysqli_query($conn, $sql);

}

//echo $sql
if ($runsql) {


    //===========for mail===============

    $EmailSubject = "Thank you, lead submitted successfully!";

    $MESSAGE_BODY = "";
    $MESSAGE_BODY .= "Sincerely," . "\r\n";
    $MESSAGE_BODY .= "Team The Orchid Pune," . "\r\n";

    $message = "Dear " . $fullname . "\r\n" . "Thank you for your interest in our membership program at The Orchid Pune. We are scheduled to launch the membership in the first week of April. One of our associates will call you to discuss the member benefits and enroll you as a patron member with us." . "\r\n";

    $leadsmail = " Orchidmembership@loyaltician.com";
    $mailheader = "From: " . $leadsmail . "\r\n";
    $mailheader .= "Reply-To: " . $leadsmail . "\r\n";

    require_once 'phpmail/src/PHPMailer.php';
    require_once 'phpmail/src/SMTP.php';
    require_once 'phpmail/src/Exception.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
    $mail->Password = 'Orchid#2022';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('leads@loyaltician.com', 'loyaltician');
    // $mail->addAddress($Gmail); 
    $mail->addAddress('vishwaanirud@gmail.com');
    $mail->mailheader = $mailheader;// Add a recipient
    // $mail->addCC('leads@loyaltician.com');
    // $mail->addBCC('admin@loyaltician.com ');
    //  $mail->addBCC('meanand.gupta21@gmail.com');
    // $mail->addBCC('satyendra1111@gmail.com');


    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject . "\r\n";
    $mail->Body = $message . "\r\n" . $MESSAGE_BODY;
    $mail->send();
    //==============mail end===







    echo '1';


} else {

    if ($runsql1 > 0) {
        echo '3';
    } else {
        echo '0';
    }
}
?>