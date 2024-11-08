<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ("config.php");

  $Program = $_POST['Program'];
  $Level = $_POST['Level'];
  $CardBenefit = $_POST['CardBenefit'];

  if (isset($_POST['Update'])) {
    $MainID = $_POST['MainID'];


    $err = 0;
    if (is_array($CardBenefit)) {
      for ($i = 0; $i < count($CardBenefit); $i++) {
        $hotelinsert = mysqli_query($conn, "update CardBenefit set CardBenefit='" . $CardBenefit[$i] . "' where CardBenefit_id='" . $MainID . "'");
      }
      $err++;
    }

    if ($err > 0) { ?>
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
              window.open("CardBenefits_view.php", "_self");

            }
          });

      </script>

    <?php } else {
      swal("error");
      ;
    }



  }






  if (isset($_POST['Submit'])) {

    $err = 0;
    if (is_array($CardBenefit)) {
      for ($i = 0; $i < count($CardBenefit); $i++) {
        $hotelinsert = mysqli_query($conn, "insert into CardBenefit (Program_ID,level_id,CardBenefit)values('" . $Program . "','" . $Level . "','" . $CardBenefit[$i] . "')");
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
              window.open("Card_Benefits.php", "_self");

            }
          });

      </script>

    <?php } else {
      swal("error");
      ;
    }

  }

  ?>
</body>

</html>