<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include 'config.php';

  $roll = $_POST['Roll'];
  $drop = $_POST['drop'];

  $sql = "insert into roll(`roll`,`permission`) values('" . $roll . "','" . $drop . "')";
  $runsql = mysqli_query($conn, $sql);
  $last = mysqli_insert_id($conn);

  if ($last) { ?>
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
            window.open("roll.php", "_self");

          }
        });

    </script>

  <?php } else {
    echo "error";
  }

  ?>
</body>

</html>