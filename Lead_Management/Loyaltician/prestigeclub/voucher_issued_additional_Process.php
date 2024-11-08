<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include ("config.php");

  $Program = $_POST['Program'];
  $voucher_id = $_POST['voucher'];
  $FromSerial = $_POST['FromSerial'];
  $ToSerial = $_POST['ToSerial'];



  if (isset($_POST['update'])) {
    $mainid = $_POST['mainid'];

    $err = 0;
    if (is_array($FromSerial)) {
      for ($i = 0; $i < count($FromSerial); $i++) {
        $hotelinsert = mysqli_query($conn, "update `voucher_issued_additional` set fromSerialNo='" . $FromSerial[$i] . "',toSerialNo='" . $ToSerial[$i] . "', where v_id='" . $mainid . "'");
        //  issued_voucher_code='".$FromSerial[$i]."'
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
              window.open("voucher_additional_issued_view.php", "_self");

            }
          });

      </script>

    <?php } else {
      swal("error");
      ;
    }

  }



  if (isset($_POST['submit'])) {
    $err = 0;
    if (is_array($FromSerial)) {
      for ($i = 0; $i < count($FromSerial); $i++) {
        $hotelinsert = mysqli_query($conn, "insert into `voucher_issued_additional` (Program_ID,fromSerialNo,toSerialNo,voucher_code,issued_voucher_code)values('" . $Program . "','" . $FromSerial[$i] . "','" . $ToSerial[$i] . "','" . $voucher_id[$i] . "',0)");
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
              window.open("voucher_issued_additional.php", "_self");

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