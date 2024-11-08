<html>

<head>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
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
            // window.open("roll.php", "_self");
              window.location.href = "roll.php";

          }
        });

    </script>

  <?php } else {
    echo "error";
  }

  ?>
</body>

</html>