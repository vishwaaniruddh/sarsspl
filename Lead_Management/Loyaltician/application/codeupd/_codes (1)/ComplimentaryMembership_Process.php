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

  $hotelinsert = mysqli_query($conn, "INSERT INTO `ComplimentaryMembership`(`Progm_id`, `level_id`, `MembershipFee`) VALUES('" . $Program . "','" . $P_Level . "','" . $MembershipFee . "')");

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
            window.open("ComplimentaryMembership.php", "_self");

          }
        });

    </script>

  <?php } else {
    echo "error";
  }


  ?>
</body>

</html>