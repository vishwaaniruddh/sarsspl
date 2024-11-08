<html>

<head>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  include 'config.php';
  $Country = $_POST['Country'];

  $sqlCountry = "insert into Country(Country,Active) values('" . $Country . "',1)";
  $runSqlCountry = mysqli_query($conn, $sqlCountry);

  if ($runSqlCountry) { ?>
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
            window.open("add_country.php", "_self");

          }
        });

    </script>

  <?php } else {
    echo "error";
  }
  mysqli_close($conn);
  ?>
</body>

</html>