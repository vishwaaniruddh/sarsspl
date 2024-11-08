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
  $Level = $_POST['Level'];
  $CertificateBenefits = $_POST['CertificateBenefits'];

  $err = 0;
  if (is_array($CertificateBenefits)) {
    for ($i = 0; $i < count($CertificateBenefits); $i++) {
      $hotelinsert = mysqli_query($conn, "insert into CertificateBenefits (Program_ID,level_id,CertificateBenefits)values('" . $Program . "','" . $Level . "','" . $CertificateBenefits[$i] . "')");
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
            // window.open("CertificateBenefits.php", "_self");
  window.location.href = "CertificateBenefits.php";
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