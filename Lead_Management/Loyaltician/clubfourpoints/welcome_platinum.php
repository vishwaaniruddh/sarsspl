<?php
include('config.php');

$qgen= mysqli_query($conn,"select * from Members where Static_LeadId='".$id."'");
$row=mysqli_fetch_row($qgen);
$Primary_nameOnTheCard = $row[13];
$memid=$row[1];
$validity = $row[73];
$level = $row[41];
$booklet_series = $row[66];
$payment_mode = $row[50];



// $Primary_nameOnTheCard = 'Aniruddh Vishwakarma';

$EmailSubject2="Welcome to Club Four Points !";


$message2 ='
<table width="50%" align="center">
<td>
<img style="width:100%;" id="Picture 4" src="http://loyaltician.in/clubfourpoints/newassets/image001.jpg">

</td>
</table>





<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image002.png" alt="The Orchid Gold"></span>
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image003.png" alt="The Orchid Platinum">
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

<p class=MsoNormal><span lang=EN-IN>Dear '.$Primary_nameOnTheCard.'</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN></span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Welcome to Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a
member at Four Points by Sheraton Navi Mumbai, Vashi. Your membership details
are as follows:</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - '.$level.'</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is '.$booklet_series.'. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till '.$validity.' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
The annual membership charge of Rs. 12000 + 18% Goods &amp; Services Tax amounting to Rs. 14160 /- (Rupees Fourteen Thousand One Hundred and Sixty only) has been received by  '.$payment_mode.'. A receipt is enclosed in
this email. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>You can present your membership number and a copy of this email to
start using your membership benefits.</span></p>

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
lang=EN-IN><a href="http://www.clubfourpoints.com">www.clubfourpoints.com</a></span><span
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
lang=EN-IN style="font-size:12.0pt;line-height:107%">Team Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 9808293333</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.clubfourpoints.com"><span style="font-size:12.0pt;
line-height:107%">www.clubfourpoints.com</span></a></span><span lang=EN-IN
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
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate
  Description</span></b></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">001</span></p>
  </td>
  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Stay with our
  Compliments</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">002</span></p>
  </td>
  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Stay with our
  Compliments</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">003</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Happy Extended
  Stay</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">004</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Happy Extended
  Stay</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">005</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Weekend Retreat</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">006</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Weekend Retreat</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">007</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Weekend Retreat</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">008</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">A Privileged Stay</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">009</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">A Privileged Stay</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">010</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">A Privileged Stay</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">011</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Buffet Meal with
  our Compliments</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">012</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Buffet Meal with
  our Compliments</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">013</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Cake with our
  Compliments</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">014</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Group Celebration</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">015</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Group Celebration</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">016</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Group Celebration</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">017</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Group Celebration</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">018</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Use our Pool with
  our compliments</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">019</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Use our Pool with
  our compliments</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">020</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Gym Membership
  with our compliments</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">021</span></p>
  </td>
  <td width=329 nowrap valign=top style="width:247.0pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Gym Membership
  with our compliments</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician
CRM India Private Limited for Chalet Hotels Limited. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This message is sent to you because your email
address is on our subscribers list as a Member with an express consent to
communicate with you. We will ensure only high quality / relevant information
is sent to you to manage your membership. If you wish to change any
communication preferences, please write to us at </span></em><span lang=EN-IN><a
href="mailto:contactus@clubfourpoints.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">contactus@clubfourpoints.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">Disclaimer: This
message has been sent as a part of discussion between ‘Club Four Points’ and
the addressee whose name is specified above. Should you receive this message by
mistake, we would be most grateful if you informed us that the message has been
sent to you. In this case, we also ask that you delete this message from your
mailbox, and do not forward it or any part of it to anyone else. Thank you for
your cooperation and understanding.</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';
echo $message2;
// //exit;


// return ; 
       
$leadsmail2=" Orchidmembership@loyaltician.com";
$mailheader2 = "From: ".$leadsmail2."\r\n"; 
$mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
require_once 'phpmail/src/Exception.php';
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';

$mail2 = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail2->isSMTP();                                      // Set mailer to use SMTP
    $mail2->Host = 'mail.clubfourpoints.com';  // Specify main and backup SMTP servers
    $mail2->SMTPAuth = true;                               // Enable SMTP authentication
    $mail2->Username = 'contactus@clubfourpoints.com';                 // SMTP username
    $mail2->Password = 'QKAc&mn,[xY%';                           // SMTP password
    $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail2->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail2->setFrom('contactus@clubfourpoints.com','Club Four Points');
    $mail2->addAddress('vishwaaniruddh@gmail.com');
    
    $mail2->isHTML(true);               // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    $mail2->send();
//==============mail end==============

?>