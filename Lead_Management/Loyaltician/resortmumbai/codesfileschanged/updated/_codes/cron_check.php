<?php  include('config.php');


error_reporting(1);
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';


// Today Cal
$today_sqlgold = mysqli_query($conn,"select count(mem_id) as today from Members where MembershipDetails_Level=1 and DATE(entryDate) = DATE(NOW()) and canceledMember=0");
$today_sqlgold_result = mysqli_fetch_assoc($today_sqlgold);
$today_gold = $today_sqlgold_result['today'];

$today_sqlplat = mysqli_query($conn,"select count(mem_id) as today from Members where MembershipDetails_Level=2 and DATE(entryDate) = DATE(NOW()) and canceledMember=0");
$today_sqlplat_result = mysqli_fetch_assoc($today_sqlplat);
$today_plat = $today_sqlplat_result['today'];
$today = $today_plat+$today_gold ;
// End Today Cal



// // Month Cal
$monthsqlgold = mysqli_query($conn,"SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=1 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE()) and canceledMember=0");
$monthsqlgold_result = mysqli_fetch_assoc($monthsqlgold);
$monthgold = $monthsqlgold_result['monthss'];

$monthsqlplat = mysqli_query($conn,"SELECT count(mem_id) as monthss FROM Members WHERE MembershipDetails_Level=2 and MONTH(entryDate) = MONTH(CURDATE()) and YEAR(entryDate) = YEAR(CURDATE()) and canceledMember=0");
$monthsqlplat_result = mysqli_fetch_assoc($monthsqlplat);
$monthplat = $monthsqlplat_result['monthss'];

$month = $monthgold+$monthplat ;




// Year Cal

$date1 = '2021-04-01'; 
$date2 = date('Y-m-d') ;

$year_sqlgold = mysqli_query($conn,"SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=1 and CAST(entryDate AS DATE)>= '".$date1."' and CAST(entryDate AS DATE) <= '".$date2."' and canceledMember=0");
$year_sqlgold_result = mysqli_fetch_assoc($year_sqlgold);
$year_sqlgold_count = $year_sqlgold_result['years_count'];


$year_sqlplat = mysqli_query($conn,"SELECT count(mem_id) as years_count FROM Members WHERE MembershipDetails_Level=2 and CAST(entryDate AS DATE)>= '".$date1."' and CAST(entryDate AS DATE) <= '".$date2."' and canceledMember=0");
$year_sqlplat_result = mysqli_fetch_assoc($year_sqlplat);
$year_sqlplat_count = $year_sqlplat_result['years_count'];
$yearscount = $year_sqlplat_count + $year_sqlgold_count ; 


// echo $yearscount; 
 $goldpercent =($year_sqlgold_count / $yearscount )  * 100; 
$goldpercent =  round($goldpercent);
$platpercent = 100 - $goldpercent ;  

$EmailSubject1="The Resort Mumbai Daily MIS";


$chartConfigArr = "{
  type: 'doughnut',
  data: {
    datasets: [
      {
        data: ['$goldpercent', '$platpercent'],
        backgroundColor: [ '#f6d036', '#c5c6c8'],
      },
    ],
    labels: ['Gold', 'Platinum'],
  },
  options: {
    plugins: {
      datalabels: {
        formatter: (value) => {
          return value + '%';
        }
      }
    }
  }
}";


$chartUrl = 'https://quickchart.io/chart?w=500&h=300&c=' . urlencode($chartConfigArr);





$message1='<table  style="text-align:center; border-collapse: collapse; width: 436pt;"  align="center"   border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                    <td width="10.996563573883162%" style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; border: 0.5pt solid windowtext; height: 15pt; " height="20"></td>
                    <td width="31.257731958762886%" colspan="3" style="color: black;  font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; text-align:center; border-top: 0.5pt solid windowtext; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-image: initial; border-left: none; width: 110pt; ;">&nbsp;Enrollments Update&nbsp;</td>

                    </tr>
                    
        <tr>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;vertical-align: bottom; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right"></td>
        <td width="10.257731958762886%" style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">Gold</td>
        <td width="10.257731958762886%" style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">Platinum</td>
        <td width="10.257731958762886%" style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">Total</td>
        </tr>
        
        
        
        
        <tr>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">Today</td>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">'.$today_gold.'</td>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">'.$today_plat.'</td>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">'.$today.'</td>
        </tr>
        
        <tr>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">MTD</td>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">'.$monthgold.'</td>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">'.$monthplat.'</td>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">'.$month.'</td>
        </tr>
        
        <tr>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">YTD</td>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">'.$year_sqlgold_count.'</td>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">'.$year_sqlplat_count.'</td>
        <td style="color: black; font-size: 15px; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align:center;border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 0.5pt solid windowtext; border-image: initial; height: 15pt; border-top: none; ;" height="20" align="right">'.$yearscount.'</td>
        </tr>
        
        
                </tbody>
            </table>';
        
$message1 .='<table  align="center">

<tr>
<td>

</td>
</tr>

<tr>
<td>
    <img style="width:100%;" src=' .$chartUrl.'>
</td>

</tr>
</table>';



// echo $message1 ; 
// width="582" align="center" style="border-collapse: collapse; width: 436pt; ;" cellspacing="0" cellpadding="0" border="0"

$leadsmail1="contactus@theresortexperiences.com";

$mailheader1 .= "Reply-To: ".$leadsmail1."\r\n"; 
$mailheader1 .= "Return-Path: ".$leadsmail1."\r\n";
$mailheader1 .= "From: ".$leadsmail1."\r\n"; 
$mailheader1 .= "Organization: Sender Organization\r\n";
$mailheader1 .= "MIME-Version: 1.0\r\n";
$mailheader1 .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$mailheader1 .= "X-Priority: 3\r\n";
$mailheader1 .= "X-Mailer: PHP". phpversion() ."\r\n";

$pagesource = "cron_check";
$memid = "";
$msg = "";



    $mail1 = new PHPMailer\PHPMailer\PHPMailer();
    
    try{
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail1->isSMTP();                                      // Set mailer to use SMTP
    $mail1->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
    $mail1->SMTPAuth = true;                               // Enable SMTP authentication
    $mail1->Username = 'contactus@theresortexperiences.com';                 // SMTP username
    $mail1->Password = '94Z6g.;d1CSq';                           // SMTP password
    $mail1->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail1->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail1->setFrom('contactus@theresortexperiences.com','The Resort Mumbai');
    $mail1->addBCC('vishwaaniruddh@gmail.com'); 
    $mail1->mailheader=$mailheader1;// Add a recipient
    

$mail1->addAddress('contactus@theresortexperiences.com');
$mail1->addAddress('v.tulaskar@fourpointsvashi.com');
$mail1->addAddress('s.dsouza@fourpointsvashi.com');
$mail1->addAddress('a.anand@fourpointsvashi.com');
$mail1->addAddress('accounts@fourpointsvashi.com');
$mail1->addAddress('s.rawat@fourpointsvashi.com');
$mail1->addAddress('Roopal.hg@gmail.com');
$mail1->addAddress('Hitesh.gunwani@outlook.com');
$mail1->addAddress('Hitesh@loyaltician.com');

$mail1->addAddress('khannakaran67@gmail.com');
$mail1->addCC('hiteshgunwani@gmail.com');

//$mail1->addCC('karan@theresortmumbai.com');
$mail1->addCC('prabir.d06@gmail.com');


    $mail1->isHTML(true);                                  // Set email format to HTML
    $mail1->Subject = $EmailSubject1."\r\n";
    $mail1->Body    = $message1."\r\n";
     $mail1->send();
    }
catch(Exception $e){

    $msg = "Mail not send due to SMTP Host error!!!";
  
}


if($msg!='')
{
    $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,mem_id,status) values ('".$msg."','".$pagesource."','".$memid."',0) ");
}  
else{
    
}
  

?>