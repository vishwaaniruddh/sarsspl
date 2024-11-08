<?php
include 'config.php';

$lid = $_REQUEST['ids'];
$sql = "select * from RenewalLeadUpdates where LeadId='" . $lid . "' order by UpdateId desc";
$sqlrun = mysqli_query($conn, $sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("header.php") ?>
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>

<body class="sidebar-pinned">


    <main class="">
        <!--site header ends -->
        <section class="admin-content">

            <form method="post" id="formf">
                <div class="container  ">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive p-t-10">
                                    <table align="center" class="table" style="width:100%" id="example">

                                        <tr>
                                            <th>Sr No</th>
                                            <th>Comments</th>
                                            <th>Update Time</th>
                                            <th>Next Update</th>


                                        </tr>
                                        <?php
                                        $srn = '1';
                                        while ($row = mysqli_fetch_array($sqlrun)) { ?>
                                            <tr>
                                                <td><?php echo $srn; ?></td>

                                                <td><?php echo $row['Comments']; ?></td>
                                                <td><?php echo $row['UpdateTime']; ?></td>
                                                <td><?php echo $row['NextUpdate']; ?></td>

                                            </tr>
                                            <?php
                                            $srn++;

                                        }

                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </section>

    </main>

    <?php include ('belowScript.php'); ?>
    <!--page specific scripts for demo-->
    <script src="assets/vendor/DataTables/datatables.min.js"></script>
    <script src="assets/js/datatable-data.js"></script>

</body>

</html>