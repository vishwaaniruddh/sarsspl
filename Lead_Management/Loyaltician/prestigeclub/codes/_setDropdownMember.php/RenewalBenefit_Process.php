<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ("config.php");

  $Program = $_POST['Program'];
  $Level = $_POST['Level'];
  $RenewalBenefits = $_POST['RenewalBenefits'];

  $err = 0;
  if (is_array($RenewalBenefits)) {
    for ($i = 0; $i < count($RenewalBenefits); $i++) {
      $hotelinsert = mysqli_query($conn, "insert into  RenewalBenefits (Program_ID,level_id,RenewalBenefits)values('" . $Program . "','" . $Level . "','" . $RenewalBenefits[$i] . "')");
    }
    $err++;
  }

  if ($err > 0) { ?>
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
            window.open("RenewalBenefit.php", "_self");

          }
        });

    </script>

  <?php } else {
    swal("error");
    ;
  }



  ?>
</body>

</html>