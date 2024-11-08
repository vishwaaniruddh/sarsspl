<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("header.php") ?>
    <!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>

<body class="sidebar-pinned" id="rightclick">


    <?php include ("vertical_menu.php") ?>
    <main class="admin-main">
        <?php include ('navbar.php'); ?>

        <section class="admin-content">
            <div class="bg-dark">
                <div class="container  m-b-30">
                    <div class="row">
                        <div class="col-12 text-white p-t-40 p-b-90">

                            <h4 class=""> <span class="btn btn-white-translucent">
                                    <i class="mdi mdi-table "></i></span> view Members
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


                            echo "SELECT * FROM `Members` where ExpiryDate <= '" . $next_due_date . "' ORDER BY `Members`.`ExpiryDate` DESC";

                            // echo "select * from Members,Leads_table where  Members.Static_LeadID=Leads_table.Lead_id and Members.ExpiryDate < '".$date."' or Month(ExpiryDate) in (month(now()),month(now())+1) and Leads_table.Status='5'";
                            
                            // echo "select * from Members,Leads_table where  Members.Static_LeadID=Leads_table.Lead_id and Members.ExpiryDate < '".$date."' and Leads_table.Status='5'";
                            
                            $qrys = mysqli_query($conn, "select * from Members,Leads_table where  Members.Static_LeadID=Leads_table.Lead_id and Members.ExpiryDate < '" . $date . "' and Leads_table.Status='5'");

                            ?>
                            <div class="card-body">
                                <a class="btn btn-danger" href="renewals.php" style="color:white;">Expired Renewals</a>
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
                                                <tr>
                                                    <td><?php echo $srn; ?></td>
                                                    <td><?php echo $_row['Primary_nameOnTheCard']; ?></td>
                                                    <td><?php echo $_row['Spouse_mob1MArid1']; ?></td>
                                                    <td><?php echo $_row['ExpiryDate']; ?></td>
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