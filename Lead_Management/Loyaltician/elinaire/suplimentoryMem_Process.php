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

  // part 2.Spouse
  

  $Memberid = $_POST['Spouse_Memberid'];
  $Title = $_POST['Spouse_Title'];
  $FirstName = $_POST['Spouse_FirstName'];
  $LastName = $_POST['Spouse_LastName'];
  $Gmail1 = $_POST['Spouse_GmailMArrid1'];
  // $Spouse_PhotoUpload=$_POST['Spouse_PhotoUpload'];   
  $mcode1 = $_POST['mcode1'];
  $mob1 = $_POST['mob1'];
  $nameOnTheCard = $_POST['Spouse_nameOnTheCardMarried'];
  $Relationship = $_POST['Spouse_Relationship'];
  $DOB = $_POST['Spouse_DOB'];
  $PaymentMode = $_POST['MembershipDts_PaymentMode'];
  $amount = $_POST['Spouse_amount'];

  $DOBreal = date('Y-m-d', strtotime($DOB));
  $entryDate = date("Y-m-d H:i:s");
  ////////////////////////////////////////////////////////////////////////
  
  $insert = mysqli_query($conn, "INSERT INTO `suplimentoryMember`(`Memberid`, `Title`,`FirstName`, `LastName`,`Relationship`, `DateOfBirth`,`Email`, `MobileCode`,`MobileNumber`, `NameOnTheCard`,`PaymentMode`, `Amount`,entryDate) VALUES('" . $Memberid . "','" . $Title . "','" . $FirstName . "','" . $LastName . "','" . $Relationship . "','" . $DOBreal . "','" . $Gmail1 . "','" . $mcode1 . "','" . $mob1 . "','" . $nameOnTheCard . "','" . $PaymentMode . "','" . $amount . "','" . $entryDate . "')");
  if ($insert) { ?>
    <script>
      swal({
        title: "Successful!",
        text: "Supplementary Member Added !",
        icon: "warning",
        // buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            // window.open("suplimentory.php", "_self");
              window.location.href = "suplimentory.php";

          }
        });

    </script>
  <?php } else {
    swal("error");
  }

  ?>