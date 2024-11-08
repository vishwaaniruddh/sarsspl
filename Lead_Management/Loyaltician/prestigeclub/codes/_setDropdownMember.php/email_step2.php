<?php include ('config.php');
$bcc = ['digambar@loyaltician.com', 'Bharati@theresortexperiences.com'];
function classic($Primary_Gmail_1, $Primary_nameOnTheCard, $member_id, $validity, $payment_mode, $level_id, $Static_LeadID, $AdditionalRenewalAssignBooklet, $AdditionalPromotionalAssignBooklet, $pdf, $MembershipDts_NetPayment, $MembershipDts_GrossTotal, $AssignBooklet)
{
    global $conn;
    global $bcc;


    include ('Leadpdf/generatepdf/TCPDF-master/examples/tcpdf_include.php');
    include ('Leadpdf/generatepdf/TCPDF-master/tcpdf.php');

    class MYPDF extends TCPDF
    {
        public function Header()
        {
        }

        public function Footer()
        {
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Satyendra Sharma');
    $pdf->SetTitle($Primary_nameOnTheCard);
    $pdf->SetSubject('DER Report');
    $pdf->SetKeywords('E-FSR, PDF');
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once (dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    $pdf->SetFont('times', '', 12);
    $pdf->AddPage();
    $pdf->SetMargins(5, 0, 10, true);
    $pdf->SetFillColor(255, 255, 127);



    $host = 'mail.theresortexperiences.com';
    $hostusername = 'contactus@theresortexperiences.com';
    $hostpassword = '94Z6g.;d1CSq';
    $port = '587';
    $nodes = 'https://arpeeindustries.com/mail.php';

    $attachment = "https://loyaltician.in/resortmumbai/Leadpdf/memberpdf/$Primary_nameOnTheCard.pdf";

    $EmailSubject2 = "Welcome to The Resort Mumbai !";
    $message2 = '<table width="50%" align="center"><td><img style="width:100%;" id="Picture 4" src="http://loyaltician.in/resortmumbai/newassets/image001.jpg"></td></table>
                <table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
                      <p>
                        <span style="text-decoration:none">
                          <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/resortmumbai/newassets/image002.png" alt="The Resort Mumbai Classic"></span>
                        <u></u><u></u></p>
                    </td>
                    <td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
                        <p align="right" style="text-align:right">
                          <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/resortmumbai/newassets/image003.png" alt="The Resort Mumbai Classic">
                          </span>
                       <u></u><u></u></p>
                    </td>
                  </tr>
                </tbody>
                </table>
                <table width="50%" align="center">
                    <tbody>
                       <td>
                          <p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
                          <p class=MsoNormal><span lang=EN-IN>Dear ' . $Primary_nameOnTheCard . '</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN></span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>A Warm Welcome to The Resort Experiences.</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>&nbsp;</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in">
                          <span lang=EN-IN style="color:black">We thank you for your decision to become a Member at The Resort, Mumbai. Our new membership brings
enhanced benefits, unparalleled experiences and a great time for you with us this upcoming year!</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>&nbsp;</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>Your membership details are as follows:</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>&nbsp;</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>Membership Level - Classic</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>Your Membership Card number is ' . $member_id . '. </span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>The membership is valid till ' . date('M Y', strtotime($validity)) . ' </span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN> </span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in">
                          <span lang=EN-IN>The annual membership charge of Rs. ' . $MembershipDts_NetPayment . '.  + 18% Goods &amp; Services Tax amounting to Rs. ' . $MembershipDts_GrossTotal . '.  /- ( ' . getIndianCurrency($MembershipDts_GrossTotal) . ')
has been received by ' . $payment_mode . '.  A receipt is enclosed in
this email. A Final Tax Invoice will be sent on a separate email. </span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>&nbsp;</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>You can present your membership number and a copy of this email to
start using your membership card benefits.</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>&nbsp;</span></p>
                          <p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span lang=EN-IN>The complete welcome package will reach you within 10 working days
of this e-mail. Your membership gift certificates along with the membership are
given at the bottom of this email.</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Do take a moment to view all benefits and terms at </span><span
lang=EN-IN><a href="http://www.theresortexperiences.com">www.theresortexperiences.com</a></span><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Yours sincerely,</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">The Resort Experiences Team</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 22 50555809</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.theresortexperiences.com"><span style="font-size:12.0pt;
line-height:107%">www.theresortexperiences.com</span></a></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><span style="font-size:12.0pt;
line-height:107%">experiences@theresortmumbai.com</span></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal align=center style="text-align:center"><span lang=EN-IN
style="font-size:12.0pt;line-height:107%">Gift Certificates issued</span></p>


                        <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
                         style="border-collapse:collapse;border:none">

                         <tr style="height:14.5pt">

                          <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
                          padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
                          <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
                          lang=EN-IN style="font-size:10.5pt;
                          border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
                          </td>

                          <td width=329 nowrap valign=top style="width:247.0pt;border:solid windowtext 1.0pt;
                          border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
                          <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
                          lang=EN-IN style="font-size:10.5pt;
                          border:none windowtext 1.0pt;padding:0in;background:white">Certificate Description</span></b></p>
                          </td>

                          <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
                          border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
                          <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
                          lang=EN-IN style="font-size:10.5pt;
                          border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
                          </td>
                          </tr>';

    $srno = 1;
    $qry = "select Leval_id,level_name from Level where Leval_id='" . $level_id . "' ";
    $did = $level_id;
    $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "' and serviceName not like '%RENEWAL%'";
    $runsql2 = mysqli_query($conn, $sql2);
    while ($sql2fetch = mysqli_fetch_array($runsql2)) {
        $remaining1 = substr($sql2fetch['serialNumber'], 8);
        $remaining1 = sprintf("%03s", $remaining1);

        $value = $AssignBooklet + 1;

        $AssignBooklet1 = $value . $remaining1;

        $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>

  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $sql2fetch['serviceName'] . '</span></p>
  </td>


  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AssignBooklet1 . '</span></p>
  </td>

 </tr>';
        $srno++;
    }
    if ($AdditionalRenewalAssignBooklet != "") {
        $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>

  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Renewal Voucher Code</span></p>
  </td>


  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AdditionalRenewalAssignBooklet . '</span></p>
  </td>

 </tr>';
        $srno++;
    }
    if ($AdditionalPromotionalAssignBooklet != "") {
        $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>

  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Promotional Voucher Code</span></p>
  </td>


  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AdditionalPromotionalAssignBooklet . '</span></p>
  </td>

 </tr>';
        $srno++;
    }

    $message2 .= '</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician
CRM India Private Limited for K Raheja Corp Private Limited. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This message is sent to you because your email
address is on our subscribers list as a Member with an express consent to
communicate with you. We will ensure only high quality / relevant information
is sent to you to manage your membership. If you wish to change any
communication preferences, please write to us at </span></em><span lang=EN-IN><a
href="mailto:experiences@theresortmumbai.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">experiences@theresortmumbai.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">Disclaimer: This
message has been sent as a part of discussion between ‘The Resort Experiences’ and
the addressee whose name is specified above. Should you receive this message by
mistake, we would be most grateful if you informed us that the message has been
sent to you. In this case, we also ask that you delete this message from your
mailbox, and do not forward it or any part of it to anyone else. Thank you for
your cooperation and understanding.</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';

    $pdfsql = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Static_LeadID . "'");
    $pdfsql_result = mysqli_fetch_assoc($pdfsql);

    $receiptNO = $pdfsql_result['receipt_no'];
    $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
    $memGST = $pdfsql_result['GST_Number'];
    if ($memGST) {

    } else {
        // $memGST ='27AADCL8692D1Z8';
    }


    $pdfleads_sql = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Static_LeadID . "'");
    $pdfleads_sql_result = mysqli_fetch_assoc($pdfleads_sql);


    $Primary_nameOnTheCard = $pdfsql_result['Primary_nameOnTheCard'];
    $receipt_no = $pdfsql_result['receipt_no'];
    $entryDate = $pdfsql_result['entryDate'];
    $entryDate = date("d-m-Y", strtotime($entryDate));
    $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
    if ($MembershipDetails_Level == 1) {
        $level = 'Classic';
    } elseif ($MembershipDetails_Level == 2) {
        $level = 'Signature';
    } elseif ($MembershipDetails_Level == 3) {
        $level = 'Ivory';
    }

    $ExpiryDate = $pdfsql_result['ExpiryDate'];
    $ExpiryDate = date("d-m-Y", strtotime($ExpiryDate));
    $MembershipDetails_Fee = $pdfsql_result['MembershipDetails_Fee'];
    $MembershipDts_NetPayment = $pdfsql_result['MembershipDts_NetPayment'];
    // $MembershipDts_GrossTotal = $sql_result['MembershipDts_GrossTotal'];
    $MembershipDts_PaymentMode = $pdfsql_result['MembershipDts_PaymentMode'];

    $CGST = $pdfsql_result['MembershipDts_GST'] / 2;
    $MembershipDts_GrossTotal = $pdfsql_result['MembershipDts_GrossTotal'];

    $MobileNumber = $pdfleads_sql_result['MobileNumber'];
    $Company = $pdfleads_sql_result['Company'];
    $EmailId = $pdfleads_sql_result['EmailId'];
    $State = $pdfleads_sql_result['State'];
    $City = $pdfleads_sql_result['City'];
    $CGST = $pdfsql_result['MembershipDts_GST'] / 2;

    $htmtab1 = '<table border="1" cellpadding="5">
                                        <tbody>
                                            <tr>
                                            <th colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/resortmumbai/Leadpdf/logoai.jpg" style="margin-left:200px;height:60px;">
                                            </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;"> K. Raheja Corp Pvt. Ltd. </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Aksa Beach, Madh-Marve Road, Malad(West),Mumbai:400 095. Tel:(91) 22 2844 7777/5055 5777 </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> E Mail: resv@theresortmumbai.com Website: www.theresortmumbai.com </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> GSTN ID- 27AAACP0522B2Z5      State- Maharashtra     Code -27 </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;text-align:center;"> Receipt</th>
                                            </tr>



                                        <tr>
                                            <th colspan="4" style="padding:10pt; background-color: #b48a1c; color: black; "><b>Invoice to: (Customer Details)</b></th>
                                            <th colspan="2" style="background-color: #b48a1c; color: black; "><b>Invoice Details</b></th>
                                        </tr>


                                        <tr>
                                            <td colspan="4"><b>Company Name :</b> ' . $Company . ' </td>
                                            <td border="0" colspan="1"><b>Date :</b></td>
                                            <td border="0" colspan="1">' . $entryDate . '</td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><b>Name :</b> ' . $Primary_nameOnTheCard . ' </td>
                                            <td colspan="1"><b>Invoice / Receipt: </b></td>
                                            <td colspan="1">' . $receipt_no . '</td>
                                        </tr>
                                        <tr>

                                            <td colspan="4"><b>Phone: </b>' . $MobileNumber . '</td>
                                            <td colspan="2"><b>Membership Details</b></td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>Email :</b> ' . $EmailId . ' </td>
                                            <td colspan="1"><b>Level :</b></td>
                                            <td colspan="1">' . $level . '</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>GSTN: </b>' . $memGST . ' </td>
                                           <td colspan="1"><b>Validity :</b></td>
                                            <td colspan="1">' . date('M Y', strtotime($ExpiryDate)) . '</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="3"><b>City: </b>' . $City . ' </td>
                                           <td colspan="3"><b>State :</b>' . $State . '</td>
                                        </tr>




                                        <tr style="background-color: #b48a1c; color: black; ">
                                            <td class="" colspan="3"><b>Description</b></td>
                                           <td colspan="1"><b>Quantity :</b></td>
                                            <td colspan="1"><b>Unit Price</b></td>
                                            <td colspan="1"><b>Amount</b></td>
                                        </tr>



                                    <tr>
                                            <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">' . $level . ' Membership: </td>
                                           <td colspan="1">1</td>
                                            <td colspan="1">' . $MembershipDetails_Fee . '</td>
                                            <td colspan="1">' . $MembershipDts_NetPayment . '</td>

                                        </tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #e9c877; color: black; "><b>Subtotal:</b></td>
                                            <td colspan="1" style="background-color: #e9c877; color: black; ">' . $MembershipDts_NetPayment . '</td>

                                        </tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; ">Received by : ' . $MembershipDts_PaymentMode . '</td>';

    if ($State == "MAHARASHTRA" || $State == "Maharashtra") {

        $htmtab1 .= '<td colspan="2" style="background-color: #e9c877; color: black; "><b>CGST @ 9% </b></td>
                                                    <td colspan="1" style="background-color: #e9c877; color: black; ">' . $CGST . '</td>';

    } else {
        $htmtab1 .= '<td colspan="2"rowspan="2" style="background-color: #e9c877; color: black; "><b>IGST @ 18% </b></td>
                                                    <td colspan="1" rowspan="2" style="background-color: #e9c877; color: black; ">' . ($CGST * 2) . '</td>';
    }


    $htmtab1 .= '</tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; ">Instrument Number/ Approval Code</td>';

    if ($State == "MAHARASHTRA" || $State == "Maharashtra") {
        $htmtab1 .= '<td colspan="2" style="background-color: #e9c877; color: black; "><b>GGST @ 9% </b></td>
                                            <td colspan="1" style="background-color: #e9c877; color: black; ">' . $CGST . '</td>';
    } else {


    }


    $htmtab1 .= '</tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; "><b>Cheque Favouring -  K. Raheja Corp Pvt. Ltd.</b></td>
                                           <td colspan="2" style="background-color: #b48a1c; color: black; "><b>Total including Taxes </b></td>
                                            <td colspan="1" style="background-color: #b48a1c; color: black; "><b>' . $MembershipDts_GrossTotal . '</b></td>
                                        </tr>

                                       <tr>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">Terms and Conditions<br>
1. To avail input credit (if available), GSTN number and State is mandatory.<br>
2. This is not the final tax invoice regarding the purchase and is a receipt.<br>
3. No refunds are entertained beyond 15 days of purchase<br>
</td>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">
                                        <br><br><br><br><br><br>
                                        <b>Signed</b><br>
                                        K Raheja Corp Pvt. Ltd.<br>
                                        (Computer Generated Receipt)
                                        </td>


                                    </tr>
                                </tbody>
                            </table>';


    $pdf->writeHTML($htmtab1, true, false, false, false, '');
    $pdf->Output('Leadpdf/memberpdf/' . $Primary_nameOnTheCard . '.pdf', 'F');

    $leadsmail2 = "contactus@theresortexperiences.com";
    $mailheader2 = "From: " . $leadsmail2 . "\r\n";
    $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";


    $subject = $EmailSubject2;
    $message = $message2;
    $leadsmail = $leadsmail2;

    $from = 'contactus@theresortexperiences.com';
    $fromname = 'The Resort Mumbai';


    $Primary_Gmail_1 = 'aniruddhvishwa@gmail.com';
    // $to =['contactus@theresortexperiences.com'];
    $to = [$Primary_Gmail_1];
    $cc = [];

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
        'pdfstructure' => $htmtab1,
        'attachment' => $attachment,
        'primary_name' => $Primary_nameOnTheCard,
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
    ?>
    <script>
        alert('Mail Sent !');
        window.location = 'email.php';
    </script>
<?php
}

function signature($Primary_Gmail_1, $Primary_nameOnTheCard, $member_id, $validity, $payment_mode, $level_id, $Static_LeadID, $AdditionalRenewalAssignBooklet, $AdditionalPromotionalAssignBooklet, $pdf, $MembershipDts_NetPayment, $MembershipDts_GrossTotal, $AssignBooklet)
{
    include ('Leadpdf/generatepdf/TCPDF-master/examples/tcpdf_include.php');
    include ('Leadpdf/generatepdf/TCPDF-master/tcpdf.php');

    class MYPDF extends TCPDF
    {
        public function Header()
        {
        }

        public function Footer()
        {
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Satyendra Sharma');
    $pdf->SetTitle($Primary_nameOnTheCard);
    $pdf->SetSubject('DER Report');
    $pdf->SetKeywords('E-FSR, PDF');
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once (dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    $pdf->SetFont('times', '', 12);
    $pdf->AddPage();
    $pdf->SetMargins(5, 0, 10, true);
    $pdf->SetFillColor(255, 255, 127);


    global $conn, $bcc;
    $host = 'mail.theresortexperiences.com';
    $hostusername = 'contactus@theresortexperiences.com';
    $hostpassword = '94Z6g.;d1CSq';
    $port = '587';
    $nodes = 'https://arpeeindustries.com/mail.php';

    $attachment = "https://loyaltician.in/resortmumbai/Leadpdf/memberpdf/$Primary_nameOnTheCard.pdf";

    $EmailSubject2 = "Welcome to The Resort Mumbai !";

    $message2 = '
<table width="50%" align="center">
<td>
<img style="width:100%;" id="Picture 4" src="http://loyaltician.in/resortmumbai/newassets/image001.jpg">

</td>
</table>


<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>

      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/resortmumbai/newassets/image002.png" alt="The Resort Mumbai Signature"></span>
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/resortmumbai/newassets/image003.png" alt="The Resort Mumbai Signature">
  </span>

<u></u><u></u></p>
</td>
</tr>
</tbody>
</table>

<table width="50%" align="center">
<tbody>
<td>
<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal><span lang=EN-IN>Dear ' . $Primary_nameOnTheCard . '</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN></span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>A Warm Welcome to The Resort Experiences.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a Member at The Resort, Mumbai. Our new membership brings
enhanced benefits, unparalleled experiences and a great time for you with us this upcoming year!</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your membership details are as follows:</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - Signature</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is ' . $member_id . '. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till ' . date('M Y', strtotime($validity)) . ' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The annual membership charge of Rs. ' . $MembershipDts_NetPayment . '. + 18% Goods &amp; Services
Tax amounting to Rs. ' . $MembershipDts_GrossTotal . '. /- ( ' . getIndianCurrency($MembershipDts_GrossTotal) . ')
has been received by ' . $payment_mode . '.  A receipt is enclosed in
this email. A Final Tax Invoice will be sent on a separate email. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>You can present your membership number and a copy of this email to
start using your membership card benefits.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The complete welcome package will reach you within 10 working days
of this e-mail. Your membership gift certificates along with the membership are
given at the bottom of this email.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Do take a moment to view all benefits and terms at </span><span
lang=EN-IN><a href="http://www.theresortexperiences.com">www.theresortexperiences.com</a></span><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Yours sincerely,</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">The Resort Experiences Team</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 22 50555809</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.theresortexperiences.com"><span style="font-size:12.0pt;
line-height:107%">www.theresortexperiences.com</span></a></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><span style="font-size:12.0pt;
line-height:107%">experiences@theresortmumbai.com</span></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal align=center style="text-align:center"><span lang=EN-IN
style="font-size:12.0pt;line-height:107%">Gift Certificates issued</span></p>


<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none">

 <tr style="height:14.5pt">

  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
  </td>

  <td width=329 nowrap valign=top style="width:247.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Description</span></b></p>
  </td>

  <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>

 </tr>';



    $srno = 1;

    $qry = "select Leval_id,level_name from Level where Leval_id='" . $level_id . "' ";
    $did = $level_id;

    $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "' and serviceName not like '%RENEWAL%'";

    $runsql2 = mysqli_query($conn, $sql2);
    while ($sql2fetch = mysqli_fetch_array($runsql2)) {


        $remaining1 = substr($sql2fetch['serialNumber'], 8);
        //$value= $sql5fetch['AssignBooklet']+1;
        //$AssignBooklet1=$value.$remaining1;
        $remaining1 = sprintf("%03s", $remaining1);


        $value = $AssignBooklet + 1;

        $AssignBooklet1 = $value . $remaining1;



        $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>

  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $sql2fetch['serviceName'] . '</span></p>
  </td>


  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AssignBooklet1 . '</span></p>
  </td>

 </tr>';
        $srno++;
    }

    if ($AdditionalRenewalAssignBooklet != "") {
        $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>

  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Renewal Voucher Code</span></p>
  </td>


  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AdditionalRenewalAssignBooklet . '</span></p>
  </td>

 </tr>';
        $srno++;
    }
    if ($AdditionalPromotionalAssignBooklet != "") {
        $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>

  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Promotional Voucher Code</span></p>
  </td>


  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AdditionalPromotionalAssignBooklet . '</span></p>
  </td>

 </tr>';
        $srno++;
    }

    $message2 .= '</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician
CRM India Private Limited for K Raheja Corp Private Limited. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This message is sent to you because your email
address is on our subscribers list as a Member with an express consent to
communicate with you. We will ensure only high quality / relevant information
is sent to you to manage your membership. If you wish to change any
communication preferences, please write to us at </span></em><span lang=EN-IN><a
href="mailto:experiences@theresortmumbai.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">experiences@theresortmumbai.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">Disclaimer: This
message has been sent as a part of discussion between ‘The Resort Experiences’ and
the addressee whose name is specified above. Should you receive this message by
mistake, we would be most grateful if you informed us that the message has been
sent to you. In this case, we also ask that you delete this message from your
mailbox, and do not forward it or any part of it to anyone else. Thank you for
your cooperation and understanding.</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';
    // echo $message2;
// //exit;


    $pdfsql = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Static_LeadID . "'");
    $pdfsql_result = mysqli_fetch_assoc($pdfsql);

    $receiptNO = $pdfsql_result['receipt_no'];
    $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
    $memGST = $pdfsql_result['GST_Number'];
    if ($memGST) {

    } else {
        // $memGST ='27AADCL8692D1Z8';
    }


    $pdfleads_sql = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Static_LeadID . "'");
    $pdfleads_sql_result = mysqli_fetch_assoc($pdfleads_sql);


    $Primary_nameOnTheCard = $pdfsql_result['Primary_nameOnTheCard'];
    $receipt_no = $pdfsql_result['receipt_no'];
    $entryDate = $pdfsql_result['entryDate'];
    $entryDate = date("d-m-Y", strtotime($entryDate));
    $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
    if ($MembershipDetails_Level == 1) {
        $level = 'Classic';
    } elseif ($MembershipDetails_Level == 2) {
        $level = 'Signature';
    } elseif ($MembershipDetails_Level == 3) {
        $level = 'Ivory';
    }

    $ExpiryDate = $pdfsql_result['ExpiryDate'];
    $ExpiryDate = date("d-m-Y", strtotime($ExpiryDate));
    $MembershipDetails_Fee = $pdfsql_result['MembershipDetails_Fee'];
    $MembershipDts_PaymentMode = $pdfsql_result['MembershipDts_PaymentMode'];
    $MembershipDts_NetPayment = $pdfsql_result['MembershipDts_NetPayment'];


    $CGST = $pdfsql_result['MembershipDts_GST'] / 2;
    $MembershipDts_GrossTotal = $pdfsql_result['MembershipDts_GrossTotal'];

    $MobileNumber = $pdfleads_sql_result['MobileNumber'];
    $Company = $pdfleads_sql_result['Company'];
    $EmailId = $pdfleads_sql_result['EmailId'];
    $State = $pdfleads_sql_result['State'];
    $City = $pdfleads_sql_result['City'];

    $CGST = $pdfsql_result['MembershipDts_GST'] / 2;


    $htmtab1 = '<table border="1" cellpadding="5">



                                            <tbody>

                                            <tr>
                                            <th colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/resortmumbai/Leadpdf/logoai.jpg" style="margin-left:200px;height:60px;">
                                            </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;">  K. Raheja Corp Pvt. Ltd. </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Aksa Beach, Madh-Marve Road, Malad(West),Mumbai:400 095. Tel:(91) 22 2844 7777/5055 5777 </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> E Mail: resv@theresortmumbai.com Website: www.theresortmumbai.com </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> GSTN ID- 27AAACP0522B2Z5      State- Maharashtra     Code -27 </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;text-align:center;"> Receipt</th>
                                            </tr>



                                        <tr>
                                            <th colspan="4" style="padding:10pt; background-color: #b48a1c; color: black; "><b>Invoice to: (Customer Details)</b></th>
                                            <th colspan="2" style="background-color: #b48a1c; color: black; "><b>Invoice Details</b></th>
                                        </tr>


                                        <tr>
                                            <td colspan="4"><b>Company Name :</b> ' . $Company . ' </td>
                                            <td border="0" colspan="1"><b>Date :</b></td>
                                            <td border="0" colspan="1">' . $entryDate . '</td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><b>Name :</b> ' . $Primary_nameOnTheCard . ' </td>
                                            <td colspan="1"><b>Invoice / Receipt: </b></td>
                                            <td colspan="1">' . $receipt_no . '</td>
                                        </tr>
                                        <tr>

                                            <td colspan="4"><b>Phone: </b>' . $MobileNumber . '</td>
                                            <td colspan="2"><b>Membership Details</b></td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>Email :</b> ' . $EmailId . ' </td>
                                            <td colspan="1"><b>Level :</b></td>
                                            <td colspan="1">' . $level . '</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>GSTN: </b>' . $memGST . ' </td>
                                           <td colspan="1"><b>Validity :</b></td>
                                            <td colspan="1">' . date('M Y', strtotime($ExpiryDate)) . '</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="3"><b>City: </b>' . $City . ' </td>
                                           <td colspan="3"><b>State :</b>' . $State . '</td>
                                        </tr>




                                        <tr style="background-color: #b48a1c; color: black; ">
                                            <td class="" colspan="3"><b>Description</b></td>
                                           <td colspan="1"><b>Quantity :</b></td>
                                            <td colspan="1"><b>Unit Price</b></td>
                                            <td colspan="1"><b>Amount</b></td>
                                        </tr>



                                    <tr>
                                            <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">' . $level . ' Membership: </td>
                                           <td colspan="1">1</td>
                                            <td colspan="1">' . $MembershipDetails_Fee . '</td>
                                            <td colspan="1">' . $MembershipDts_NetPayment . '</td>

                                        </tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #e9c877; color: black; "><b>Subtotal:</b></td>
                                            <td colspan="1" style="background-color: #e9c877; color: black; ">' . $MembershipDts_NetPayment . '</td>

                                        </tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; ">Received by : ' . $MembershipDts_PaymentMode . '</td>';

    if ($State == "MAHARASHTRA" || $State == "Maharashtra") {

        $htmtab1 .= '<td colspan="2" style="background-color: #e9c877; color: black; "><b>CGST @ 9% </b></td>
                                                    <td colspan="1" style="background-color: #e9c877; color: black; ">' . $CGST . '</td>';

    } else {
        $htmtab1 .= '<td colspan="2"rowspan="2" style="background-color: #e9c877; color: black; "><b>IGST @ 18% </b></td>
                                                    <td colspan="1" rowspan="2" style="background-color: #e9c877; color: black; ">' . ($CGST * 2) . '</td>';
    }


    $htmtab1 .= '</tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; ">Instrument Number/ Approval Code</td>';

    if ($State == "MAHARASHTRA" || $State == "Maharashtra") {
        $htmtab1 .= '<td colspan="2" style="background-color: #e9c877; color: black; "><b>GGST @ 9% </b></td>
                                            <td colspan="1" style="background-color: #e9c877; color: black; ">' . $CGST . '</td>';
    } else {


    }


    $htmtab1 .= '</tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; "><b>Cheque Favouring -  K. Raheja Corp Pvt. Ltd.</b></td>
                                           <td colspan="2" style="background-color: #b48a1c; color: black; "><b>Total including Taxes </b></td>
                                            <td colspan="1" style="background-color: #b48a1c; color: black; "><b>' . $MembershipDts_GrossTotal . '</b></td>
                                        </tr>

                                       <tr>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">Terms and Conditions<br>
1. To avail input credit (if available), GSTN number and State is mandatory.<br>
2. This is not the final tax invoice regarding the purchase and is a receipt.<br>
3. No refunds are entertained beyond 15 days of purchase<br>
</td>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">
                                        <br><br><br><br><br><br>
                                        <b>Signed</b><br>
                                        K Raheja Corp Pvt. Ltd.<br>
                                        (Computer Generated Receipt)
                                        </td>


                                    </tr>
                                </tbody>
                            </table>';



    // echo $htmtab1 ;
// return ;

    $pdf->writeHTML($htmtab1, true, false, false, false, '');
    $pdf->Output('Leadpdf/memberpdf/' . $Primary_nameOnTheCard . '.pdf', 'F');

    $leadsmail2 = " contactus@theresortexperiences.com";
    $mailheader2 = "From: " . $leadsmail2 . "\r\n";
    $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

    $subject = $EmailSubject2;
    $message = $message2;
    $leadsmail = $leadsmail2;

    $from = 'contactus@theresortexperiences.com';
    $fromname = 'The Resort Mumbai';

    // 'attachment' => "https://loyaltician.in/resortmumbai/Leadpdf/memberpdf/$Primary_nameOnTheCard.pdf",    

    $Primary_Gmail_1 = 'aniruddhvishwa@gmail.com';
    // $to =['contactus@theresortexperiences.com'];
    $to = [$Primary_Gmail_1];
    $cc = [];


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
        'pdfstructure' => $htmtab1,
        'attachment' => $attachment,
        'primary_name' => $Primary_nameOnTheCard,
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
    ?>
    <script>
        alert('Mail Sent !');
        window.location = 'email.php';
    </script>
<?php

}

function ivory($Primary_Gmail_1, $Primary_nameOnTheCard, $member_id, $validity, $payment_mode, $level_id, $Static_LeadID, $AdditionalRenewalAssignBooklet, $AdditionalPromotionalAssignBooklet, $pdf, $MembershipDts_NetPayment, $MembershipDts_GrossTotal, $AssignBooklet)
{


    include ('Leadpdf/generatepdf/TCPDF-master/examples/tcpdf_include.php');
    include ('Leadpdf/generatepdf/TCPDF-master/tcpdf.php');

    class MYPDF extends TCPDF
    {
        public function Header()
        {
        }

        public function Footer()
        {
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Satyendra Sharma');
    $pdf->SetTitle($Primary_nameOnTheCard);
    $pdf->SetSubject('DER Report');
    $pdf->SetKeywords('E-FSR, PDF');
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once (dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    $pdf->SetFont('times', '', 12);
    $pdf->AddPage();
    $pdf->SetMargins(5, 0, 10, true);
    $pdf->SetFillColor(255, 255, 127);

    global $conn, $bcc;

    $host = 'mail.theresortexperiences.com';
    $hostusername = 'contactus@theresortexperiences.com';
    $hostpassword = '94Z6g.;d1CSq';
    $port = '587';
    $nodes = 'https://arpeeindustries.com/mail.php';


    $attachment = "https://loyaltician.in/resortmumbai/Leadpdf/memberpdf/$Primary_nameOnTheCard.pdf";

    $EmailSubject2 = "Welcome to The Resort Mumbai !";

    $message2 = '
<table width="50%" align="center">
<td>
<img style="width:100%;" id="Picture 4" src="http://loyaltician.in/resortmumbai/newassets/image001.jpg">

</td>
</table>





<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>

      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/resortmumbai/newassets/image002.png" alt="The Resort Mumbai Ivory"></span>
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/resortmumbai/newassets/image003.png" alt="The Resort Mumbai Ivory">
  </span>

<u></u><u></u></p>
</td>
</tr>
</tbody>
</table>









<table width="50%" align="center">
<tbody>
<td>
<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal><span lang=EN-IN>Dear ' . $Primary_nameOnTheCard . '</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN></span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>A Warm Welcome to The Resort Experiences.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a Member at The Resort, Mumbai. Our new membership brings
enhanced benefits, unparalleled experiences and a great time for you with us this upcoming year!</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your membership details are as follows:</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - Ivory</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is ' . $member_id . '. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till ' . date('M Y', strtotime($validity)) . ' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The annual membership charge of Rs. ' . $MembershipDts_NetPayment . '. + 18% Goods &amp; Services
Tax amounting to Rs. ' . $MembershipDts_GrossTotal . '. /- (' . getIndianCurrency($MembershipDts_GrossTotal) . ')
has been received by ' . $payment_mode . '.  A receipt is enclosed in
this email. A Final Tax Invoice will be sent on a separate email. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>You can present your membership number and a copy of this email to
start using your membership card benefits.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The complete welcome package will reach you within 10 working days
of this e-mail. Your membership gift certificates along with the membership are
given at the bottom of this email.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Do take a moment to view all benefits and terms at </span><span
lang=EN-IN><a href="http://www.theresortexperiences.com">www.theresortexperiences.com</a></span><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Yours sincerely,</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">The Resort Experiences Team</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 22 50555809</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.theresortexperiences.com"><span style="font-size:12.0pt;
line-height:107%">www.theresortexperiences.com</span></a></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><span style="font-size:12.0pt;
line-height:107%">experiences@theresortmumbai.com</span></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal align=center style="text-align:center"><span lang=EN-IN
style="font-size:12.0pt;line-height:107%">Gift Certificates issued</span></p>


<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none">

 <tr style="height:14.5pt">

  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
  </td>

  <td width=329 nowrap valign=top style="width:247.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Description</span></b></p>
  </td>

  <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>

 </tr>';
    $srno = 1;

    $qry = "select Leval_id,level_name from Level where Leval_id='" . $level_id . "' ";
    $did = $level_id;

    $sql2 = "SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='" . $did . "' and serviceName not like '%RENEWAL%'";

    $runsql2 = mysqli_query($conn, $sql2);
    while ($sql2fetch = mysqli_fetch_array($runsql2)) {


        $remaining1 = substr($sql2fetch['serialNumber'], 8);
        //$value= $sql5fetch['AssignBooklet']+1;
        //$AssignBooklet1=$value.$remaining1;
        $remaining1 = sprintf("%03s", $remaining1);


        $value = $AssignBooklet + 1;

        $AssignBooklet1 = $value . $remaining1;



        $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>

  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $sql2fetch['serviceName'] . '</span></p>
  </td>


  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AssignBooklet1 . '</span></p>
  </td>

 </tr>';
        $srno++;
    }

    if ($AdditionalRenewalAssignBooklet != "") {
        $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>

  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Renewal Voucher Code</span></p>
  </td>


  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AdditionalRenewalAssignBooklet . '</span></p>
  </td>

 </tr>';
        $srno++;
    }
    if ($AdditionalPromotionalAssignBooklet != "") {
        $message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $srno . '</span></p>
  </td>

  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Promotional Voucher Code</span></p>
  </td>


  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">' . $AdditionalPromotionalAssignBooklet . '</span></p>
  </td>

 </tr>';
        $srno++;
    }

    $message2 .= '</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician
CRM India Private Limited for K Raheja Corp Private Limited. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This message is sent to you because your email
address is on our subscribers list as a Member with an express consent to
communicate with you. We will ensure only high quality / relevant information
is sent to you to manage your membership. If you wish to change any
communication preferences, please write to us at </span></em><span lang=EN-IN><a
href="mailto:experiences@theresortmumbai.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">experiences@theresortmumbai.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">Disclaimer: This
message has been sent as a part of discussion between ‘The Resort Experiences’ and
the addressee whose name is specified above. Should you receive this message by
mistake, we would be most grateful if you informed us that the message has been
sent to you. In this case, we also ask that you delete this message from your
mailbox, and do not forward it or any part of it to anyone else. Thank you for
your cooperation and understanding.</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';
    // echo $message2;
// //exit;






    $pdfsql = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Static_LeadID . "'");
    $pdfsql_result = mysqli_fetch_assoc($pdfsql);

    $receiptNO = $pdfsql_result['receipt_no'];
    $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
    $memGST = $pdfsql_result['GST_Number'];
    if ($memGST) {

    } else {
        // $memGST ='27AADCL8692D1Z8';
    }


    $pdfleads_sql = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Static_LeadID . "'");
    $pdfleads_sql_result = mysqli_fetch_assoc($pdfleads_sql);


    $Primary_nameOnTheCard = $pdfsql_result['Primary_nameOnTheCard'];
    $receipt_no = $pdfsql_result['receipt_no'];
    $entryDate = $pdfsql_result['entryDate'];
    $entryDate = date("d-m-Y", strtotime($entryDate));
    $MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
    if ($MembershipDetails_Level == 1) {
        $level = 'Classic';
    } elseif ($MembershipDetails_Level == 2) {
        $level = 'Signature';
    } elseif ($MembershipDetails_Level == 3) {
        $level = 'Ivory';
    }

    $ExpiryDate = $pdfsql_result['ExpiryDate'];
    $ExpiryDate = date("d-m-Y", strtotime($ExpiryDate));
    $MembershipDetails_Fee = $pdfsql_result['MembershipDetails_Fee'];
    $MembershipDts_PaymentMode = $pdfsql_result['MembershipDts_PaymentMode'];
    $MembershipDts_NetPayment = $pdfsql_result['MembershipDts_NetPayment'];


    $CGST = $pdfsql_result['MembershipDts_GST'] / 2;
    $MembershipDts_GrossTotal = $pdfsql_result['MembershipDts_GrossTotal'];

    $MobileNumber = $pdfleads_sql_result['MobileNumber'];
    $Company = $pdfleads_sql_result['Company'];
    $EmailId = $pdfleads_sql_result['EmailId'];
    $State = $pdfleads_sql_result['State'];
    $City = $pdfleads_sql_result['City'];

    $CGST = $pdfsql_result['MembershipDts_GST'] / 2;


    $htmtab1 = '<table border="1" cellpadding="5">



                                            <tbody>

                                            <tr>
                                            <th colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/resortmumbai/Leadpdf/logoai.jpg" style="margin-left:200px;height:60px;">
                                            </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;"> K. Raheja Corp Pvt. Ltd. </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Representative for, The Resort Mumbai by K Raheja Corp Private Limited,  contactus@theresortexperiences.com </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> E Mail: resv@theresortmumbai.com Website: www.theresortmumbai.com </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> GSTN ID- 27AAACP0522B2Z5      State- Maharashtra     Code -27 </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;text-align:center;"> Receipt</th>
                                            </tr>



                                        <tr>
                                            <th colspan="4" style="padding:10pt; background-color: #b48a1c; color: black; "><b>Invoice to: (Customer Details)</b></th>
                                            <th colspan="2" style="background-color: #b48a1c; color: black; "><b>Invoice Details</b></th>
                                        </tr>


                                        <tr>
                                            <td colspan="4"><b>Company Name :</b> ' . $Company . ' </td>
                                            <td border="0" colspan="1"><b>Date :</b></td>
                                            <td border="0" colspan="1">' . $entryDate . '</td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><b>Name :</b> ' . $Primary_nameOnTheCard . ' </td>
                                            <td colspan="1"><b>Invoice / Receipt: </b></td>
                                            <td colspan="1">' . $receipt_no . '</td>
                                        </tr>
                                        <tr>

                                            <td colspan="4"><b>Phone: </b>' . $MobileNumber . '</td>
                                            <td colspan="2"><b>Membership Details</b></td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>Email :</b> ' . $EmailId . ' </td>
                                            <td colspan="1"><b>Level :</b></td>
                                            <td colspan="1">' . $level . '</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>GSTN: </b>' . $memGST . ' </td>
                                           <td colspan="1"><b>Validity :</b></td>
                                            <td colspan="1">' . date('M Y', strtotime($ExpiryDate)) . '</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="3"><b>City: </b>' . $City . ' </td>
                                           <td colspan="3"><b>State :</b>' . $State . '</td>
                                        </tr>




                                        <tr style="background-color: #b48a1c; color: black; ">
                                            <td class="" colspan="3"><b>Description</b></td>
                                           <td colspan="1"><b>Quantity :</b></td>
                                            <td colspan="1"><b>Unit Price</b></td>
                                            <td colspan="1"><b>Amount</b></td>
                                        </tr>



                                    <tr>
                                            <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">' . $level . ' Membership: </td>
                                           <td colspan="1">1</td>
                                            <td colspan="1">' . $MembershipDetails_Fee . '</td>
                                            <td colspan="1">' . $MembershipDts_NetPayment . '</td>

                                        </tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #e9c877; color: black; "><b>Subtotal:</b></td>
                                            <td colspan="1" style="background-color: #e9c877; color: black; ">' . $MembershipDts_NetPayment . '</td>

                                        </tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; ">Received by : ' . $MembershipDts_PaymentMode . '</td>';

    if ($State == "MAHARASHTRA" || $State == "Maharashtra") {

        $htmtab1 .= '<td colspan="2" style="background-color: #e9c877; color: black; "><b>CGST @ 9% </b></td>
                                                    <td colspan="1" style="background-color: #e9c877; color: black; ">' . $CGST . '</td>';

    } else {
        $htmtab1 .= '<td colspan="2"rowspan="2" style="background-color: #e9c877; color: black; "><b>IGST @ 18% </b></td>
                                                    <td colspan="1" rowspan="2" style="background-color: #e9c877; color: black; ">' . ($CGST * 2) . '</td>';
    }


    $htmtab1 .= '</tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; ">Instrument Number/ Approval Code</td>';

    if ($State == "MAHARASHTRA" || $State == "Maharashtra") {
        $htmtab1 .= '<td colspan="2" style="background-color: #e9c877; color: black; "><b>GGST @ 9% </b></td>
                                            <td colspan="1" style="background-color: #e9c877; color: black; ">' . $CGST . '</td>';
    } else {


    }


    $htmtab1 .= '</tr>

                                        <tr>
                                            <td class="" colspan="3" style="background-color: #b48a1c; color: black; "><b>Cheque Favouring -  K. Raheja Corp Pvt. Ltd.</b></td>
                                           <td colspan="2" style="background-color: #b48a1c; color: black; "><b>Total including Taxes </b></td>
                                            <td colspan="1" style="background-color: #b48a1c; color: black; "><b>' . $MembershipDts_GrossTotal . '</b></td>
                                        </tr>

                                       <tr>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">Terms and Conditions<br>
1. To avail input credit (if available), GSTN number and State is mandatory.<br>
2. This is not the final tax invoice regarding the purchase and is a receipt.<br>
3. No refunds are entertained beyond 15 days of purchase<br>
</td>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">
                                        <br><br><br><br><br><br>
                                        <b>Signed</b><br>
                                        K Raheja Corp Pvt. Ltd.<br>
                                        (Computer Generated Receipt)
                                        </td>


                                    </tr>
                                </tbody>
                            </table>';



    // echo $htmtab1 ;
// return ;

    $pdf->writeHTML($htmtab1, true, false, false, false, '');
    $pdf->Output('Leadpdf/memberpdf/' . $Primary_nameOnTheCard . '.pdf', 'F');


    $leadsmail2 = " contactus@theresortexperiences.com";
    $mailheader2 = "From: " . $leadsmail2 . "\r\n";
    $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

    $subject = $EmailSubject2;
    $message = $message2;
    $leadsmail = $leadsmail2;

    $from = 'contactus@theresortexperiences.com';
    $fromname = 'The Resort Mumbai';

    $Primary_Gmail_1 = 'aniruddhvishwa@gmail.com';
    // $to =['contactus@theresortexperiences.com'];
    $to = [$Primary_Gmail_1];
    $cc = [];

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
        'pdfstructure' => $htmtab1,
        'attachment' => $attachment,
        'primary_name' => $Primary_nameOnTheCard,

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

    ?>
    <script>
        alert('Mail Sent !');
        window.location = 'email.php';
    </script>
<?php

}

function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        0 => '',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety'
    );
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_length) {
        $divider = (2 == $i) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += 10 == $divider ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? null : null;
            $hundred = (1 == $counter && $str[0]) ? ' And ' : null;
            $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else {
            $str[] = null;
        }

    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? " " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . ' only';
}













































$id = $_REQUEST['id'];
$sql = mysqli_query($conn, "select * from Members where mem_id='" . $id . "'");
$sql_result = mysqli_fetch_assoc($sql);

$MembershipDetails_Level = $sql_result['MembershipDetails_Level'];
$Primary_Gmail_1 = $sql_result['Primary_Email_ID2'];
$Primary_nameOnTheCard = $sql_result['Primary_nameOnTheCard'];
$member_id = $sql_result['GenerateMember_Id'];
$validity = $sql_result['ExpiryDate'];
$level = $sql_result['MembershipDetails_Level'];
$payment_mode = $sql_result['MembershipDts_PaymentMode'];
$Static_LeadID = $sql_result['Static_LeadID'];
$AdditionalRenewalAssignBooklet = $sql_result['renewal_voucher_code'];
$AdditionalPromotionalAssignBooklet = $sql_result['promotional_voucher_code'];
$pdf = '';
$MembershipDts_NetPayment = $sql_result['MembershipDts_NetPayment'];
$MembershipDts_GrossTotal = $sql_result['MembershipDts_GrossTotal'];
$AssignBooklet = $sql_result['booklet_Series'];



if ($MembershipDetails_Level == '1') {
    classic($Primary_Gmail_1, $Primary_nameOnTheCard, $member_id, $validity, $payment_mode, 1, $Static_LeadID, $AdditionalRenewalAssignBooklet, $AdditionalPromotionalAssignBooklet, $pdf, $MembershipDts_NetPayment, $MembershipDts_GrossTotal, $AssignBooklet);
} else if ($MembershipDetails_Level == '2') {
    signature($Primary_Gmail_1, $Primary_nameOnTheCard, $member_id, $validity, $payment_mode, 2, $Static_LeadID, $AdditionalRenewalAssignBooklet, $AdditionalPromotionalAssignBooklet, $pdf, $MembershipDts_NetPayment, $MembershipDts_GrossTotal, $AssignBooklet);
} else if ($MembershipDetails_Level == '3') {
    ivory($Primary_Gmail_1, $Primary_nameOnTheCard, $member_id, $validity, $payment_mode, 3, $Static_LeadID, $AdditionalRenewalAssignBooklet, $AdditionalPromotionalAssignBooklet, $pdf, $MembershipDts_NetPayment, $MembershipDts_GrossTotal, $AssignBooklet);
}


?>