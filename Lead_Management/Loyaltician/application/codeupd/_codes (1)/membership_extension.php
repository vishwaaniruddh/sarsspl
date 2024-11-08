<?php session_start(); ?>
<?php include ("config.php"); ?>
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
                                    <i class="mdi mdi-table "></i></span> Close Renewal
                            </h4>
                        </div>
                    </div>
                </div>
            </div>



            <?php
            if (isset($_POST['submit'])) {

                $month = $_POST['month'];

                $insert_sql = "insert into extension(extension,status) values('" . $month . "','1')";


                if (mysqli_query($conn, $insert_sql)) { ?>

                    <script>
                        alert('Extension Added Succesfully !');
                        window.location.href = "membership_extension.php";
                    </script>

                <?php } else { ?>

                    <script>

                        alert('Extension Error! Try Again !');
                        window.location.href = "membership_extension.php";
                    </script>

                <?php }


            }

            if (isset($_GET['delete']) && isset($_GET['id'])) {

                $update_sql = "update extension set status='0' where id='" . $_GET['id'] . "'";

                echo $update_sql;
                if (mysqli_query($conn, $update_sql)) { ?>
                    <script>
                        alert('Extension Deleted Succesfully !');
                        window.location.href = "membership_extension.php";
                    </script>

                <?php } else { ?>

                    <script>
                        alert('Extension Delete Error  !');
                        window.location.href = "membership_extension.php";
                    </script>

                <?php }
            }


            ?>
            <div class="container">

                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            Add Extension Time in Months
                        </h5>

                    </div>


                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">



                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="segment">Months</label>
                                    <input type="text" class="form-control" id="month" name="month"
                                        placeholder="Months">
                                </div>
                            </div>



                            <div class="form-group">
                                <button name="submit" class="btn btn-primary">submit</button>
                            </div>
                        </div>


                    </form>


                </div>












                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            All Available Renewal Time (in months)
                        </h5>

                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="table dataTable no-footer" style="width: 100%;"
                                        role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1" style="width: 1019px;"
                                                    aria-label="Sr. No.: activate to sort column descending"
                                                    aria-sort="ascending">#</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1" style="width: 1019px;"
                                                    aria-label="Sr. No.: activate to sort column descending"
                                                    aria-sort="ascending">Months</th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1" style="width: 1019px;"
                                                    aria-label="Sr. No.: activate to sort column descending"
                                                    aria-sort="ascending">Delete</th>
                                            </tr>

                                        </thead>
                                        <tbody>

                                            <?php $get_sql = mysqli_query($conn, "SELECT * FROM extension where status='1' order by id ASC");

                                            $i = 1;
                                            while ($get_sql_result = mysqli_fetch_assoc($get_sql)) { ?>

                                                <tr role="row">

                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $get_sql_result['extension'] . ' Months'; ?>
                                                    </td>

                                                    <td>
                                                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action='delete'&id=<?php echo $get_sql_result['id']; ?>"
                                                            class="btn btn-danger">
                                                            Delete
                                                        </a>
                                                    </td>


                                                </tr>

                                                <?php $i++;
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