<html>

<head>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>

<body>
  <?php
  include 'config.php';
  $UserName = $_POST['UserName'];
  $Password = $_POST['Password'];
  $UserType = $_POST['roll'];


  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $Designation = $_POST['Designation'];
  $UserLevel = $_POST['UserLevel'];
  $Address = $_POST['Address'];
  $Country = $_POST['Country'];
  $state = $_POST['state'];
  $City = $_POST['City'];
  $Pincode = $_POST['Pincode'];
  $ContactNo = $_POST['ContactNo'];
  $Location = $_POST['Location'];
  $Company = $_POST['Company'];
  $Brand = $_POST['Brand'];
  $Hotel = $_POST['Hotel'];




  //$drop=$_POST['drop'];
  
  $abc = "select * from roll where id='" . $UserType . "'";
  $runabc = mysqli_query($conn, $abc);
  $fetch = mysqli_fetch_array($runabc);
  /*
  $abc2="select * from SalesAssociate where SalesmanId='".$UserName."'";
  $runabc2=mysqli_query($conn,$abc2);
  $fetch2=mysqli_fetch_array($runabc2);
  */
  /*$sql="insert into Users(UserName,Password,UserType,permission,roll_id,reg_id) values('".$fetch2['FirstName']." ".$fetch2['LastName']."','".$Password."','".$fetch['roll']."','".$fetch['permission']."','".$fetch['id']."','".$fetch2['SalesmanId']."')";*/

  mysqli_autocommit($conn, FALSE);


  $sqlSales = "insert into SalesAssociate(FirstName,LastName,Designation,UserLevel,Address,Country,State,City,Pincode,ContactNo,Location,Company,`Add`) values('" . $FirstName . "','" . $LastName . "','" . $Designation . "','" . $UserLevel . "','" . $Address . "','" . $Country . "','" . $state . "','" . $City . "','" . $Pincode . "','" . $ContactNo . "','" . $Location . "','" . $Company . "','')";
  $runSqlSales = mysqli_query($conn, $sqlSales);




  $lastid = mysqli_insert_id($conn);

  $sql = "insert into Users(UserName,Password,UserType,permission,roll_id,reg_id,Brand_id,hotel_id,Active) values('" . $UserName . "','" . $Password . "','" . $fetch['roll'] . "','" . $fetch['permission'] . "','" . $fetch['id'] . "','" . $lastid . "','" . $Brand . "','" . $Hotel . "','1')";
  $runsql = mysqli_query($conn, $sql);




  $last = mysqli_insert_id($conn);

  if ($last && $runSqlSales) {
    mysqli_commit($conn);
  } else {
    mysqli_rollback($conn);
  }

  if ($last && $runSqlSales) { ?>
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
            // window.open("user.php", "_self");
              window.location.href = "user.php";

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