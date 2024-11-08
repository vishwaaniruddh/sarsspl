<?php session_start();?>
<html>
 <head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
             <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php 
    include('config.php');
    $Membership_Level=$_POST['Membership_Level'];   
    $editor=$_POST['editor']; 
    $Subject=$_POST['Subject'];
    $drop=$_POST['drop'];
     $GeoPincode=$_POST['GeoPincode']; 
    
      // part 1. Primary_PhotoUpload
 $Primary_banner=$_FILES['Primary_PhotoUpload']['name']; 
 $Primary_expbanner=explode('.',$Primary_banner);
 $Primary_bannerexptype=$Primary_expbanner[1];
 date_default_timezone_set('Australia/Melbourne');
 $Primary_date = date('m/d/Yh:i:sa', time());
 $Primary_rand=rand(10000,99999);
 $Primary_encname=$Primary_date.$Primary_rand;
 $Primary_bannername=md5($Primary_encname).'.'.$Primary_bannerexptype;
 $Primary_bannerpath="upload/NewsLetter/".$Primary_bannername;
 move_uploaded_file($_FILES["Primary_PhotoUpload"]["tmp_name"],$Primary_bannerpath);
    
    $message2='';
 $message2.='<table width="70%" align="center">';
    $message2.='<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p><a target="_blank"><span style="text-decoration:none">
        <img border="0" width="130" height="67" style="width:1.3541in;height:.6944in" src="https://www.tlcgroup.com/tlc/orchid/logo.png" alt="The Orchid Gold">
        </span>
        </a>
        <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right"><a target="_blank" >
<span style="text-decoration:none"><img border="0" width="130" height="67" style="width:1.3541in;height:.6944in" id="m_822947543924888395_x0000_i1046" src="https://www.tlcgroup.com/tlc/orchid/logo_1.png" alt="The Orchid Platinum" class="CToWUd"></span></a><u></u><u></u></p>
</td>
</tr>';

        //   $message2.='<tr><th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/logoOrchid5star.png" alt="logo.png"   style="width:300px"/>  </th></tr>';
          $message2.='<tr><th style="text-align: left;"><b>Dear '. $fetchMem['Primary_nameOnTheCard'].',</b></th></tr></br></br>';
          $message2.='<tr><td>'.$editor.'</br></td></tr>';
          $message2.='<tr><th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/'.$Primary_bannerpath.'" alt="gold_logo.png" align="left" style="height:350px" />  </th></tr><tr>';
          $message2.='</tr></table>';
          
$message2.='<table width="70%" align="center">';
$message2.='<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid '.$level.' </b><br>+91 9169166789 (IVRS)</td>

</tr>';
$message2.='</table>';




$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2.='</table>';


$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



$message2.='<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
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

echo $message2;

 
?>
<form id="myForm" method="POST" action="news_p.php"  enctype="multipart/form-data">
<input type="hidden" id="Membership_Level" name="Membership_Level" value="<?php echo $Membership_Level;?>"/>
<input type="hidden" id="editor" name="editor"  value="<?php echo $editor;?>"/>
<input type="hidden" id="Subject" name="Subject"  value="<?php echo $Subject;?>"/>
<input type="hidden" id="Primary_bannerpath" name="Primary_bannerpath" value="<?php echo $Primary_bannerpath;?>"/>
<input type="hidden" id="drop" name="drop" value="<?php echo $drop;?>"/>
<input type="hidden" id="GeoPincode" name="GeoPincode" value="<?php echo $GeoPincode;?>"/>

<div class="w3-panel" style="width:80%">
  <input type="submit" class="w3-btn w3-block w3-red " style="margin-left: 134px;" value="Send Mail" />
</div>


</form>
</body>
</html>
