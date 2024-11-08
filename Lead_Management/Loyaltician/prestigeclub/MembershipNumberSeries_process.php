<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ("config.php");

  $Program = $_POST['Program'];
  $P_Level = $_POST['P_Level'];
  $FromSeries = $_POST['FromSeries'];
  $ToSeries = $_POST['ToSeries'];

  $hotelinsert = mysqli_query($conn, "INSERT INTO `MembershipNumberSeries`(`program_id`, `p_level_id`, `FromSeries`, `ToSeries`) VALUES('" . $Program . "','" . $P_Level . "','" . $FromSeries . "','" . $ToSeries . "')");


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
            window.open("MembershipNumberSeries.php", "_self");

          }
        });

    </script>

  <?php } else {
    echo "error";
  }


  ?>
</body>

</html>