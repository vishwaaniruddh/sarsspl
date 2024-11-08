<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ("config.php");

  $getid = $_POST['getid'];
  $NewMembership = $_POST['NewMembership'];
  $RenewalMembership = $_POST['RenewalMembership'];
  $gst = $_POST['gst'];



  $hotelinsert = mysqli_query($conn, "update  `PrimaryMembershipFee` set `NewMembership`='" . $NewMembership . "', `RenewalMembership`='" . $RenewalMembership . "' , `GST`='" . $gst . "' where MembershipFee_id='" . $getid . "'");


  if ($hotelinsert) { ?>
    <script>
      swal({
        title: "Success!",
        text: "Thank you, Update Successfully.!",
        icon: "success",
        // buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            // swal("Poof! Your imaginary file has been deleted!", {
            //  icon: "success",
            //  });
            window.open("PrimaryMembershipFee_view.php", "_self");

          }
        });

    </script>

  <?php } else {
    echo "error";
  }


  ?>
</body>

</html>