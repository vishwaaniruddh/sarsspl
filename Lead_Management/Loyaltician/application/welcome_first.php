<?php
include ('config.php');
$id = '63';
$qgen = mysqli_query($conn, "select * from Members where Static_LeadId='" . $id . "'");
$row = mysqli_fetch_row($qgen);
$Primary_nameOnTheCard = $row[13];
$memid = $row[1];


$EmailSubject2 = "Renewal Welcome Email - Orchid First";

$message2 .= '<table width="50%" align="center">';

$message2 .= '<tr>';
$message2 .= '<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/img/orchid-first.png" alt="gold_logo.png" width="700"/>  </th></tr><tr>';

$message2 .= '<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/img/first.png" alt="first.png" width="200"/>    </th>';
$message2 .= '</tr><tr>';
$message2 .= '<th  style="text-align: left;"><b>Dear ' . $Primary_nameOnTheCard . ' , </b></th></tr><tr></br>';
$message2 .= '<td>


Welcome to Orchid First and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.
<br>
We have renewed your membership and thank you for your continuous patronage.

.<br><br>
    
Your Membership Card number is ' . $memid . '. The membership is valid till ' . $row[73] . ' You may refer to the enclosed attachment to view the Summary of Benefits of the membership.
.<br>
The annual membership charge of Rs. 8,500 + 18% Goods & Services Tax amounting to Rs. 10,030/- (Rupees Eight Thousand Eight Hundred and Fifty only) has been received by ' . $row[48] . '. 

</br>
<br>You can present your membership number or a copy of this email to start using your membership benefits.
<br>
The complete welcome package will reach you within 10 -12 working days of this e-mail. Your membership gift certificates along with the membership are given at the bottom of this email.
<br>
We look forward to welcoming you as our esteemed Orchid First member.
</td>';
$message2 .= '</tr></table>';

$message2 .= '</table>';

$message2 .= '<table width="50%" align="center">';
$message2 .= '<tr height="5px">
<td><br>Yours sincerely,<br><b>
Team Orchid Gold / Platinum 
 </b><br>+91 9169166789 <br>www.orchidhotel.com</td>
</tr>';
$message2 .= '</table>';

$message2 .= '<p>&nbsp;</p>
<p  width="40%" align="center" style="margin-right: 484px;"><span style="font-weight: 400;">Gift Certificates issued – Orchid First</span></p>

<div align="left" dir="ltr" style="margin-left:-5.75pt;">
    <table style="border:none;border-collapse:collapse;" width="50%" align="center">
        <tbody>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">SN</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Type</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p>Certificate Number</p>
                </td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">001</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Complimentary Buffet Meal</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX001<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">002</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Complimentary Buffet Meal</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX002<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">003</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Complimentary Chocolate Cake</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX003<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">004</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Complimentary Chocolate Cake</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX004<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">005</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Celebration Offer</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX005<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">006</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Celebration Offer</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX006<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">007</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Complimentary Night Stay (Pune&amp; Orissa)</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX007<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">008</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Complimentary Night Stay (Pune&amp; Orissa)</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX008<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">009</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Exclusive Room Night Offer</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX009<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">010</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Exclusive Room Night Offer</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX010<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">011</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Buy One Night, Get One Night</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX011<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">012</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Buy One Night, Get One Night</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX012<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">013</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Swimming Pool Usage</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX013<br></td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">014</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Swimming Pool Usage</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX014</td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">015</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Spa Usage @ 50%</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX015</td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">016</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Spa Usage @ 50%</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX016</td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-left: 0.5pt solid rgb(0, 0, 0); border-right: 0.5pt solid rgb(0, 0, 0); border-top: 0.5pt solid rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">017</span></p>
                </td>
                <td style="border-left: 0.5pt solid rgb(0, 0, 0); border-right: 0.5pt solid rgb(0, 0, 0); border-top: 0.5pt solid rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Banquet Referral</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX017</td>
            </tr>
            <tr style="height:14.5pt;">
                <td style="border-left: 0.5pt solid rgb(0, 0, 0); border-right: 0.5pt solid rgb(0, 0, 0); border-bottom: 0.5pt solid rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:#ffff00;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">018</span></p>
                </td>
                <td style="border-left: 0.5pt solid rgb(0, 0, 0); border-right: 0.5pt solid rgb(0, 0, 0); border-bottom: 0.5pt solid rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 58.2583%;">
                    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:#ffff00;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">RENEWAL CERTIFICATE</span></p>
                </td>
                <td style="border-width: 0.5pt; border-style: solid; border-color: rgb(0, 0, 0); vertical-align: bottom; padding: 0pt 5.75pt; overflow: hidden; overflow-wrap: break-word; width: 8.2082%;">23XXXXXX018</td>
            </tr>
        </tbody>
    </table>
</div>

<table  width="50%" align="center">
<tbody>
<tr>
<td>
<p ><span style="font-weight: 400;">For any Escalations regarding your membership, please do write to us at </span><a href="mailto:orchidgoldpune@orchidhotel.com"><span style="font-weight: 400;">orchidgoldpune@orchidhotel.com</span></a><span style="font-weight: 400;">&nbsp;&nbsp;</span></p>
</td>
</tr>
<tr><td><br /></td></tr>

</tbody>
</table>

<table width="50%" align="center">
<tr><td><p ><em><span style="font-weight: 400;">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.&nbsp;</span></em></p></td></tr>


<tr><td><p><em><span style="font-weight: 400;">This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at </span></em><a href="mailto:escalations@loyaltician.com"><span style="font-weight: 400;">escalations@loyaltician.com</span></a><em><span style="font-weight: 400;">&nbsp;</span></em></p></td></tr>
<tr><td><br /></td></tr>
<tr><td><p><em><span style="font-weight: 400;">Disclaimer: This message has been sent as a part of discussion between (</span></em><a href="mailto:orchidgoldpune@orchidhotel.com"><em><span style="font-weight: 400;">orchidgoldpune@orchidhotel.com</span></em></a><em><span style="font-weight: 400;">) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.</span></em></p></td></tr>
<tr><td><br /></td></tr>
<tr><td><br /></td></tr></table>';
$message2 .= '<table width="50%" align="center">
                <tr><td><img align="center" alt="" src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/img/renewal_footer.jpg" width="600" style="max-width:877px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" >
                </td>';

$message2 .= '<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited. <br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at <a href="mailto:escalations@loyaltician.com"><em><span style="font-weight: 400;">escalations@loyaltician.com</span></em></a> 
<br><br>
Disclaimer: This message has been sent as a part of discussion between (<a href="mailto:orchidgoldpune@orchidhotel.com"><em><span style="font-weight: 400;">orchidgoldpune@orchidhotel.com</span></em></a>) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.
.</td></tr>';

$message2 .= '</table>';

echo $message2;
//exit;


$leadsmail2 = " Orchidmembership@loyaltician.com";
$mailheader2 = "From: " . $leadsmail2 . "\r\n";
$mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';

$mail2 = new PHPMailer\PHPMailer\PHPMailer();

//Server settings
//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
$mail2->isSMTP();                                      // Set mailer to use SMTP
$mail2->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
$mail2->SMTPAuth = true;                               // Enable SMTP authentication
$mail2->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
$mail2->Password = 'Orchid#2022';                           // SMTP password
$mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail2->Port = 587;                                    // TCP port to connect to

//Recipients
$mail2->setFrom('orchidgoldpune@orchidhotel.com', 'The Orchid Hotel Pune');
//$mail2->addAddress('satyendra1111@gmail.com'); 
//   $mail2->mailheader=$mailheader2;// Add a recipient
//$mail2->addCC('orchidgoldpune@orchidhotel.com');
$mail2->addAddress('developer.ruchi@gmail.com');

$mail2->isHTML(true);                                  // Set email format to HTML
$mail2->Subject = $EmailSubject2 . "\r\n";
$mail2->Body = $message2;
$mail2->send();
//==============mail end==============

?>