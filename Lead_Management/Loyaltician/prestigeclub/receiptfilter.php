<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("header.php") ?>
    <!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <style>
        .expire,
        .expired {
            background: #faebd7;
        }

        .about_to_expire {
            background: #FFC107;
            color: white;
        }

        .about_to_expired {
            background: #FFC107;
        }

        .about_to_expired,
        .expired {
            height: 25px;
            width: 25px;
            margin: auto 1%;
            /*border-radius: 20px;*/

        }
    </style>

</head>

<body class="sidebar-pinned">


    <?php include ("vertical_menu.php") ?>
    <main class="admin-main">
        <?php include ('navbar.php'); ?>

        <section class="admin-content">
            <div class="bg-dark">
                <div class="container  m-b-30">
                    <div class="row">
                        <div class="col-12 text-white p-t-40 p-b-90">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container  pull-up">

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <?php include ("config.php");


                            $date = date("Y-m-d");



                            $next_due_date = date('Y-m-d', strtotime("+30 days"));



                            if ($_SESSION['roll_id'] == 1) {
                                // $qrys= mysqli_query($conn,"SELECT * FROM Members where ExpiryDate <= '".$next_due_date."' and canceledMember='0' and is_delegate='1' ORDER BY ExpiryDate ASC");
                                $qrys = mysqli_query($conn, "SELECT * FROM Members");
                            }
                            if ($_SESSION['roll_id'] == '15') {


                                // $qrys= mysqli_query($conn,"SELECT * FROM Members where Static_LeadID in(SELECT member_id from renewalDelegation where sales_id='".$_SESSION['id']."' ) and canceledMember='0' and ExpiryDate <= '".$next_due_date."' and is_delegate='2' ORDER BY ExpiryDate ASC");
                                $qrys = mysqli_query($conn, "SELECT * FROM Members");
                            } else {
                                $qrys = mysqli_query($conn, "SELECT * FROM Members");
                            }



                            ?>
                            <div class="card-body">
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table   " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>srno</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Expiry Date</th>
                                                <th>Receipt</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $srn = 1;

                                            while ($_row = mysqli_fetch_array($qrys)) {

                                                ?>
                                                <tr>


                                                    <td><?php echo $srn; ?></td>
                                                    <td><?php echo $_row['Primary_nameOnTheCard']; ?></td>
                                                    <td><?php echo $_row['Spouse_mob1MArid1']; ?></td>
                                                    <td><?php echo $_row['ExpiryDate']; ?></td>
                                                    <td><a class="btn btn-primary"
                                                            href="receipt.php?id=<?php echo $_row['Static_LeadID']; ?>">Receipt</a>
                                                    </td>

                                                </tr>

                                                <?php $srn++;
                                            } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <?php include ('belowScript.php'); ?>
    <script src="assets/vendor/DataTables/datatables.min.js"></script>
    <script src="assets/js/datatable-data.js"></script>
</body>

</html>