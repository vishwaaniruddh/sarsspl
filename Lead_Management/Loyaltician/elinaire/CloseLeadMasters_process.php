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
  $CloseLeadReason = $_POST['CloseLeadReason'];

  $err = 0;
  if (is_array($CloseLeadReason)) {
    for ($i = 0; $i < count($CloseLeadReason); $i++) {
      $hotelinsert = mysqli_query($conn, "insert into CloseLead (Program_ID,CloseLeadReason)values('" . $Program . "','" . $CloseLeadReason[$i] . "')");
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

            // window.open("CloseLeadMasters.php", "_self");
              window.location.href = "CloseLeadMasters.php";

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