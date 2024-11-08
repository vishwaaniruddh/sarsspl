<html>

<head>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
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
            // window.open("MembershipNumberSeries.php", "_self");
              window.location.href = "MembershipNumberSeries.php";

          }
        });

    </script>

  <?php } else {
    echo "error";
  }


  ?>
</body>

</html>