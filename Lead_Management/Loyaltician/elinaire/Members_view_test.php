<?php
session_start();

include ("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("header.php") ?>
    <!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function promotional_voucher(id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You cannot revert this !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed it!'
        }).then((result) => {
            if (result.isConfirmed) {

                jQuery.ajax({
                    type: "POST",
                    url: 'assign_promotionalvoucher.php',
                    data: 'id=' + id,
                    success: function (msg) {
                        debugger;
                        console.log(msg);

                        if (msg == 1) {
                            Swal.fire(
                                'Updated!',
                                'Voucher has been assigned.',
                                'success'
                            );

                            setTimeout(function () {
                                window.location.reload();
                            }, 4000);

                        } else if (msg == 0 || msg == 2) {

                            Swal.fire(
                                'Cancelled',
                                'Your imaginary file is safe :)',
                                'error'
                            );
                        }

                    }
                });


            }
        })

    }
</script>

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
                                    <i class="mdi mdi-table "></i></span> View Members
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            $userssql = mysqli_query($contest, "select roll_id from Users where UserId = '" . $_SESSION['id'] . "' ");
            $usrsql_res = mysqli_fetch_assoc($usersql);
            $rollId = $usrsql_res['roll_id'];

            if (isset($_POST['submit'])) {

                $fname = $_POST['fname'];
                $contact = $_POST['contact'];
                $contact2 = $_POST['contact2'];
                // echo $contact;
                $memid = $_POST['memid'];

                if ($fname) {
                    $View = "select * from Members  where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and Primary_nameOnTheCard like '%" . $fname . "%' ";

                } elseif ($contact) {
                    $View = "select * from Members  where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and Primary_mob2 like '%" . $contact . "%' ";

                } elseif ($contact2) {
                    $View = "select * from Members  where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5' and MobileNumber = '" . $contact2 . "')  ";

                } elseif ($memid) {

                    $View = "select * from Members  where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and GenerateMember_Id like '%" . $memid . "%' ";

                }
                // else {
                //     $View = "select * from Members  where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') ";
                // }
            

                // $View = "select * from Members  where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and Primary_mob2 like '%".$contact."%'  ";
                $qrys = mysqli_query($contest, $View);
            }
            ?>

            <div class="container  pull-up">

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="contact_form">
                                    <div class="form-row">

                                        <div class="form-group col-md-3">
                                            <label for="fname">First Name</label>
                                            <input type="text" name="fname" class="form-control"
                                                value="<?php echo $_POST['fname']; ?>" id="fname">


                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="contact">Contact</label>
                                            <input type="text" name="contact" class="form-control"
                                                value="<?php echo $_POST['contact']; ?>" id="contact">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="contact">Contact2</label>
                                            <input type="text" name="contact2" class="form-control"
                                                value="<?php echo $_POST['contact2']; ?>" id="contact2">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="memid">Membership Number</label>
                                            <input type="text" name="memid" class="form-control"
                                                value="<?php echo $_POST['memid']; ?>" id="memid">

                                        </div>

                                    </div>
                                    <input type="submit" class="btn btn-primary" name="submit" value="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table   " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>srno</th>
                                                <th>Card Number</th>
                                                <th> Title</th>
                                                <th> First Name</th>
                                                <th> Last Name</th>
                                                <th> Name on the Card</th>
                                                <th>Spouse Name</th>
                                                <th> Mobile Number</th>
                                                <th> Membership Level</th>
                                                <th> Member Since</th>
                                                <th> Validity</th>
                                                <th> Mobile Number 2</th>
                                                <th> Contact 1</th>

                                                <th>Contact 2</th>
                                                <th> Contact 3</th>
                                                <th>Email ID</th>
                                                <th>Email ID 2 (Gmail)</th>
                                                <th> Company Name</th>
                                                <th> Designation</th>
                                                <th> Address Type 1</th>
                                                <th> Address</th>
                                                <th>City</th>
                                                <th> State</th>
                                                <th>Country</th>
                                                <th>Pin Code</th>
                                                <th>DateOfBirth</th>
                                                <th>Marital Status</th>

                                                <th>Dispatch</th>
                                                <th>Edit</th>
                                                <th>Member Cancel</th>

                                                <th>Promotional Voucher</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $srn = 1;
                                            while ($_row = mysqli_fetch_array($qrys)) {
                                                $date = $_row['ExpiryDate'];
                                                $date = strtotime($date);
                                                $expiry = date('M Y', $date);

                                                $sql2 = "select * from Leads_table where Lead_id='" . $_row['Static_LeadID'] . "' ";
                                                //echo $sql2;
                                                $runsql2 = mysqli_query($contest, $sql2);
                                                $sql2fetch = mysqli_fetch_array($runsql2);


                                                $sql3 = "SELECT * FROM `Level` where Leval_id='" . $_row['MembershipDetails_Level'] . "' ";
                                                //echo $sql2;
                                                $runsql3 = mysqli_query($contest, $sql3);
                                                $sql3fetch = mysqli_fetch_array($runsql3);




                                                $sql4 = "SELECT Expiry_month FROM `validity` where Leval_id='" . $_row['MembershipDetails_Level'] . "' ";

                                                $runsql4 = mysqli_query($contest, $sql4);
                                                $sql4fetch = mysqli_fetch_array($runsql4);

                                                $photo = $_row['Primary_PhotoUpload'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $srn; ?></td>
                                                    <td><?php echo $_row['GenerateMember_Id']; ?></td>
                                                    <td><?php echo $_row['Primary_Title']; ?></td>
                                                    <td><?php echo $sql2fetch['FirstName']; ?></td>
                                                    <td><?php echo $sql2fetch['LastName']; ?></td>
                                                    <td><?php echo $_row['Primary_nameOnTheCard']; ?></td>
                                                    <td><?php echo $_row['Spouse_FirstName']; ?></td>
                                                    <td><?php echo $sql2fetch['MobileNumber']; ?></td>
                                                    <td><?php echo $sql3fetch['level_name']; ?></td>
                                                    <?php
                                                    $entryDatetimestamp = strtotime($_row['member_since']);
                                                    $entry_Date = date("d-m-Y", $entryDatetimestamp); ?>

                                                    <td><?php echo $entry_Date; ?></td>

                                                    <td><?php echo $expiry; ?></td>


                                                    <td><?php echo $_row['Primary_mob2']; ?></td>
                                                    <td><?php echo $_row['Primary_Contact1']; ?></td>
                                                    <td><?php echo $_row['Primary_Contact2']; ?></td>
                                                    <td><?php echo $_row['Primary_Contact3']; ?></td>
                                                    <td><?php echo $_row['Primary_Email_ID2']; ?></td>

                                                    <td><?php echo $_row['Spouse_GmailMArrid1']; ?></td>
                                                    <td><?php echo $sql2fetch['Company']; ?></td>
                                                    <td><?php echo $sql2fetch['Designation']; ?></td>
                                                    <td><?php echo $_row['Primary_AddressType1']; ?></td>
                                                    <td><?php echo $_row['Primary_BuldNo_addrss'] . $_row['Primary_Area_addrss'] . $_row['Primary_Landmark_addrss']; ?>
                                                    </td>
                                                    <td><?php echo $sql2fetch['City']; ?></td>
                                                    <td><?php echo $sql2fetch['State']; ?></td>
                                                    <td><?php echo $sql2fetch['Country']; ?></td>
                                                    <td><?php echo $sql2fetch['PinCode']; ?></td>
                                                    <?php
                                                    $DOBtimestamp = strtotime($_row['Primary_DateOfBirth']);
                                                    $DOB_Date = date("d-m-Y", $DOBtimestamp); ?>
                                                    <td><?php echo $DOB_Date; ?></td>
                                                    <td><?php echo $_row['Primary_MaritalStatus']; ?></td>

                                                    <?php
                                                    $chkDispatch = mysqli_query($contest, "SELECT dispatchDate FROM `dispatchDetails` where Member_ID =(select mem_id from Members where dispatched_status='1' and GenerateMember_Id='" . $_row['GenerateMember_Id'] . "') ");
                                                    $fetch_dispatch = mysqli_fetch_array($chkDispatch);

                                                    $timestamp = strtotime($fetch_dispatch['dispatchDate']);
                                                    $dis_Date = date("d-m-Y", $timestamp);

                                                    if ($rollId < '3') {
                                                        ?>
                                                        <td><?php if ($_row['dispatched_status'] == 0) { ?><a
                                                                    href='dispatch_popup.php?id=<?php echo $_row['mem_id'] ?>'
                                                                    class="btn btn-primary">Dispatch</a><?php } else {
                                                            echo $dis_Date;
                                                        } ?>
                                                        </td>
                                                        <td><a href='MemberEdit.php?id=<?php echo $_row['Static_LeadID'] ?>'
                                                                class="btn btn-primary">Edit</a></td>
                                                        <td><a href='MemberCancel.php?id=<?php echo $_row['Static_LeadID'] ?>'
                                                                class="btn btn-primary">Cancel</a></td>
                                                    <?php } ?>
                                                    <td>
                                                        <?php
                                                        $promotional_voucher_code = $_row['promotional_voucher_code'];

                                                        if ($promotional_voucher_code == '') { ?>
                                                            <a href="#" class="btn btn-danger"
                                                                onclick="promotional_voucher(<?php echo $_row['Static_LeadID']; ?>)">Assign
                                                                Voucher</a>
                                                        <?php } else {
                                                            echo $promotional_voucher_code;
                                                        } ?>
                                                    </td>

                                                </tr>
                                                <?php

                                                $srn++;
                                            }
                                            ?>


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>srno</th>
                                                <th>Card Number</th>
                                                <th> Title</th>
                                                <th> First Name</th>
                                                <th> Last Name</th>
                                                <th> Name on the Card</th>
                                                <th>Spouse Name</th>
                                                <th> Mobile Number</th>
                                                <th> Membership Level</th>
                                                <th> Member Since</th>
                                                <th> Validity</th>
                                                <th> Mobile Number 2</th>
                                                <th> Contact 1</th>
                                                <th>Contact 2</th>
                                                <th> Contact 3</th>
                                                <th>Email ID</th>
                                                <th>Email ID 2 (Gmail)</th>
                                                <th> Company Name</th>
                                                <th> Designation</th>
                                                <th> Address Type 1</th>
                                                <th> Address</th>
                                                <th>City</th>
                                                <th> State</th>
                                                <th>Country</th>
                                                <th>Pin Code</th>
                                                <th>Date of Birth</th>
                                                <th>Marital Status</th>
                                                <th>Action</th>
                                                <th>Edit</th>
                                                <th> Member Cancel</th>
                                                <th>Promotional Voucher</th>
                                            </tr>
                                        </tfoot>
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
    <script>
        function prospect_filter() {
            $("#contact_form").submit()
        }
    </script>
</body>

</html>