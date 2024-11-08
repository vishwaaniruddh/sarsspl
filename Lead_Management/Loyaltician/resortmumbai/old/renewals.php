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

                            <h4 class=""> <span class="btn btn-white-translucent">
                                    <i class="mdi mdi-table "></i></span> Membership Renewals
                            </h4>
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


                            $qrys = mysqli_query($conn, "SELECT * FROM Members where ExpiryDate <= '" . $next_due_date . "' ORDER BY ExpiryDate ASC");

                            ?>
                            <div class="card-body">
                                <div style="display:flex;justify-content:center;">
                                    <span class="expired">

                                    </span>Membership expired

                                    <span class="about_to_expired">

                                    </span> Membership expiry within 30 days

                                </div>
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table   " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>srno</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Expiry Date</th>
                                                <th>Renew</th>
                                                <th>Update</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $srn = 1;

                                            while ($_row = mysqli_fetch_array($qrys)) {

                                                ?>
                                                <tr <?php if ($_row['ExpiryDate'] > date('Y-m-d')) {
                                                    echo 'class="about_to_expire"';
                                                } else {
                                                    echo 'class="expire"';
                                                } ?>>


                                                    <td>
                                                        <?php echo $srn; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $_row['Primary_nameOnTheCard']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $_row['Spouse_mob1MArid1']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $_row['ExpiryDate']; ?>
                                                    </td>
                                                    <td><a class="btn btn-danger"
                                                            href="custom_renew.php?id=<?php echo $_row['Static_LeadID']; ?>">Renew</a>
                                                    </td>
                                                    <td><a class="btn btn-success"
                                                            href="MemberEdit.php?id=<?php echo $_row['Static_LeadID']; ?>">Update</a>
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