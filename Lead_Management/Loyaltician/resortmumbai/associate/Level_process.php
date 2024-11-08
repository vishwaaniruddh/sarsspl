<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ("config.php");

  $Hotel = $_POST['Hotel'];
  $levelName = $_POST['levelName'];
  $price = $_POST['price'];

  $err = 0;
  if (is_array($levelName)) {
    for ($i = 0; $i < count($levelName); $i++) {
      $hotelinsert = mysqli_query($conn, "INSERT INTO `Level`(`hotel_id`, `level_name`,`price`) VALUES('" . $Hotel . "','" . $levelName[$i] . "','" . $price[$i] . "')");
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
            window.open("Level.php", "_self");

          }
        });

    </script>

  <?php } else {
    echo "error";
  }


  ?>
</body>

</html>