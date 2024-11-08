<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ("config.php");

  $Hotel = $_POST['Hotel'];
  $Level_id = $_POST['Level_id'];
  $FromSerial = $_POST['FromSerial'];
  $ToSerial = $_POST['ToSerial'];

  $err = 0;
  if (is_array($FromSerial)) {
    for ($i = 0; $i < count($FromSerial); $i++) {
      $hotelinsert = mysqli_query($conn, "insert into voucher_Booklet (hotel_id,FromSerialNo,ToSerialNo,Level_id)values('" . $Hotel . "','" . $FromSerial[$i] . "','" . $ToSerial[$i] . "','" . $Level_id[$i] . "')");
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
            window.open("voucher_booklet.php", "_self");

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