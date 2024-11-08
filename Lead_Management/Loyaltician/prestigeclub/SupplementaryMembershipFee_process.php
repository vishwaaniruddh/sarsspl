<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ("config.php");

  $Program = $_POST['Program'];
  $P_Level = $_POST['P_Level'];
  $MembershipFee = $_POST['MembershipFee'];
  $Fee = $_POST['Fee'];

  $hotelinsert = mysqli_query($conn, "INSERT INTO `SupplementaryMembershipFee`(`Program_ID`, `P_Level_id`, `MembershipFee`, `Fee`) VALUES('" . $Program . "','" . $P_Level . "','" . $MembershipFee . "','" . $Fee . "')");


  if ($hotelinsert) { ?>
    <script>
      swal({
        title: "Success!",
        text: "Thank you, Add Successfully.!",
        icon: "success",
        // buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            // swal("Poof! Your imaginary file has been deleted!", {
            //  icon: "success",
            //  });
            window.open("SupplementaryMembershipFee.php", "_self");

          }
        });

    </script>

  <?php } else {
    echo "error";
  }


  ?>
</body>

</html>