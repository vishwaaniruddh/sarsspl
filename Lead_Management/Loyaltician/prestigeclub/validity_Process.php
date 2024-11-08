<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ("config.php");

  $Program = $_POST['Program'];
  $Level = $_POST['Level'];
  $Month = $_POST['Month'];

  if (isset($_POST['update'])) {
    $mainid = $_POST['mainid'];



    $hotelupdate = mysqli_query($conn, "update `validity` set Expiry_month='" . $Month . "' where validity_id='" . $mainid . "' ");
    // echo " update `validity` set Expiry_month='".$Month."' where validity_id='".$mainid."' ";
  


    if ($hotelupdate) { ?>
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
              window.open("validity_view.php", "_self");

            }
          });

      </script>

    <?php } else {

      echo "error";
    }



  }


  if (isset($_POST['submit'])) {
    $hotelinsert = mysqli_query($conn, "INSERT INTO `validity`(`Program_ID`,`Leval_id`, `Expiry_month`) VALUES('" . $Program . "','" . $Level . "','" . $Month . "')");


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
              window.open("validity.php", "_self");

            }
          });

      </script>

    <?php } else {
      echo "error";
    }
  }

  ?>
</body>

</html>