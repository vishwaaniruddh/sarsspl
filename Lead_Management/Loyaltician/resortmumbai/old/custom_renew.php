<?php session_start();
include ('config.php');



function get_members_data($id, $parameter)
{

    global $conn;

    $sql = mysqli_query($conn, "select $parameter from Members where Static_LeadID='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result[$parameter];

}






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("header.php") ?>
    <!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">


    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>


</head>

<body class="sidebar-pinned">


    <?php include ("vertical_menu.php");

    $Mainid = $_GET['id'];
    if ($Mainid != "") {


        $QuryGetMem = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Mainid . "'");
        $fetchMem = mysqli_fetch_array($QuryGetMem);

    }
    ?>
    <main class="admin-main">
        <?php include ('navbar.php'); ?>

        <section class="admin-content">
            <div class="bg-dark">
                <div class="container  m-b-30">
                    <div class="row">
                        <div class="col-12 text-white p-t-40 p-b-90">

                            <h4 class=""> <span class="btn btn-white-translucent">
                                    <i class="mdi mdi-table "></i></span> Membership Details



                            </h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container  pull-up">

                <form action="custom_renewal_process.php" method="post">


                    <input type="hidden" name="memberid"
                        value="<?php echo get_members_data($_GET['id'], 'GenerateMember_Id'); ?>">

                    <input type="hidden" name="Static_LeadID" value="<?php echo $_GET['id']; ?>">

                    <div class="row">




                        <div class="col-12">
                            <div class="card">


                                <div class="card-body">




                                    <div class="bg-dark" style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Membership Details
                                    </div>

                                    <?php
                                    $QryStatic_LeadID = mysqli_query($conn, "SELECT * FROM `Members` where Static_LeadID='" . $_GET['id'] . "' ");
                                    $fetchStatic_LeadID = mysqli_fetch_array($QryStatic_LeadID);



                                    ?>









                                    <div class="form-group">
                                        <label for="inputPassword4">Membership Level</label>

                                        <select name="member_type" id="member_type" class="form-control">

                                            <option value="">Select Membership Type</option>

                                            <?
                                            $member_type_sql = mysqli_query($conn, "select * from Level");

                                            while ($member_type_sql_result = mysqli_fetch_assoc($member_type_sql)) {
                                                $level_id = $member_type_sql_result['Leval_id'];
                                                ?>

                                                <option value="<?php echo $level_id; ?>" <?php if (get_members_data($_GET['id'], 'MembershipDetails_Level') == $level_id) {
                                                       echo 'selected';
                                                   } ?>>
                                                    <?php echo $member_type_sql_result['level_name']; ?>
                                                </option>

                                            <?php }

                                            ?>
                                        </select>

                                    </div>




                                    <div class="form-group">
                                        <label for="inputEmail4">Membership Fee</label>
                                        <input type="text" class="form-control" id="MembershipDetails_Fee"
                                            name="MembershipDetails_Fee"
                                            value="<?php echo get_members_data($_GET['id'], 'MembershipDetails_Fee') ?>"
                                            readonly>

                                    </div>


                                    <div class="form-group">
                                        <label for="inputEmail4">% Discount</label>
                                        <input type="text" class="form-control" id="MembershipDts_Discount"
                                            name="MembershipDts_Discount"
                                            value="<?php echo $fetchStatic_LeadID['MembershipDts_Discount']; ?>">
                                    </div>


                                    <div class="form-group">
                                        <label for="inputEmail4">Net Payment</label>
                                        <input type="text" class="form-control" id="MembershipDts_NetPayment"
                                            name="MembershipDts_NetPayment"
                                            value="<?php echo $fetchStatic_LeadID['MembershipDts_NetPayment']; ?>"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail4">GST @ 18%</label>
                                        <input type="text" class="form-control" id="MembershipDts_GST"
                                            name="MembershipDts_GST"
                                            value="<?php echo $fetchStatic_LeadID['MembershipDts_GST']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Gross Total</label>
                                        <input type="text" class="form-control" id="MembershipDts_GrossTotal"
                                            name="MembershipDts_GrossTotal"
                                            value="<?php echo $fetchStatic_LeadID['MembershipDts_GrossTotal']; ?>"
                                            readonly>
                                    </div>





                                    <div class="form-group">
                                        <label for="inputEmail4">Payment Date</label>
                                        <input type="text" name="payment_date" id="datepicker" class="form-control"
                                            value="<?php echo date("Y/m/d") ?>">
                                    </div>



                                    <div class="form-group">
                                        <label for="inputEmail4">Payment Mode</label>

                                        <select class="form-control" name="MembershipDts_PaymentMode"
                                            id="MembershipDts_PaymentMode">
                                            <option value="">Select Mode *</option>

                                            <?php
                                            $runLevel = mysqli_query($conn, "select * from Level where Leval_id='" . $fetchMem['MembershipDetails_Level'] . "'");
                                            $fetchLevel = mysqli_fetch_array($runLevel);
                                            $runMode = mysqli_query($conn, "select * from MembershipPaymentMode where Program_ID='" . $fetchLevel['Program_ID'] . "'");
                                            while ($fetchMode = mysqli_fetch_array($runMode)) {
                                                ?>
                                                <option value="<?php echo $fetchMode['Payment_mode']; ?>" <?php if ($fetchMode['Payment_mode'] == $fetchMem['MembershipDts_PaymentMode']) { ?>Selected
                                                    <?php } ?>>
                                                    <?php echo $fetchMode['Payment_mode']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail4">Instrument Number</label>
                                        <input type="text" class="form-control" id="MembershipDts_InstrumentNumber"
                                            name="MembershipDts_InstrumentNumber"
                                            value="<?php echo $fetchStatic_LeadID['MembershipDts_InstrumentNumber']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail4">Bank Name</label>
                                        <input type="text" class="form-control" id="MemshipDts_BankName"
                                            name="MemshipDts_BankName"
                                            value="<?php echo $fetchStatic_LeadID['Member_bankName']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail4">Batch Number</label>
                                        <input type="text" class="form-control" id="MemshipDts_BatchNumber"
                                            name="MemshipDts_BatchNumber"
                                            value="<?php echo $fetchStatic_LeadID['MemshipDts_BatchNumber']; ?>">
                                    </div>


                                    <div class="form-group">
                                        <label for="inputEmail4">Remarks</label>
                                        <input type="text" class="form-control" id="MemshipDts_Remarks"
                                            name="MemshipDts_Remarks"
                                            value="<?php echo $fetchStatic_LeadID['MemshipDts_Remarks']; ?>">
                                    </div>


                                    <div class="form-group">
                                        <label for="inputEmail4">GST NO.</label>
                                        <input type="text" class="form-control" id="MemshipDts_GST_number"
                                            name="MemshipDts_GST_number"
                                            value="<?php if ($fetchStatic_LeadID['GST_Number'] != "") {
                                                echo $fetchStatic_LeadID['GST_Number'];
                                            } ?>"
                                            placeholder='GST NO.'>
                                    </div>



                                    <input type="submit" name="submit" class="btn btn-success" value="Renew">


                                </div>



                            </div>
                        </div>




                    </div>
                </form>
            </div>
        </section>

    </main>


    <script>


        $("document").ready(function () {

            $("#member_type").on('change', function () {

                var membership_type = $("#member_type").val();

                $.ajax({
                    type: "POST",
                    url: 'get_membership_fees.php',
                    data: 'membership_type=' + membership_type,

                    success: function (msg) {

                        $("#MembershipDetails_Fee").val(msg);

                        var memberfees = $("#MembershipDetails_Fee").val();
                        var per_discount = $("#MembershipDts_Discount").val();

                        var dis = (memberfees * per_discount) / 100;
                        var new_net_pay = memberfees - dis;

                        $("#MembershipDts_NetPayment").val(new_net_pay);

                        var gst = new_net_pay * 0.18;

                        $("#MembershipDts_GST").val(gst);

                        var gross_total = new_net_pay + gst;

                        $("#MembershipDts_GrossTotal").val(gross_total);

                    }
                });




            });



            $("#MembershipDts_Discount").on('change', function () {

                var memberfees = $("#MembershipDetails_Fee").val();
                var per_discount = $("#MembershipDts_Discount").val();

                var dis = (memberfees * per_discount) / 100;
                var new_net_pay = memberfees - dis;

                $("#MembershipDts_NetPayment").val(new_net_pay);

                var gst = new_net_pay * 0.18;

                $("#MembershipDts_GST").val(gst);

                var gross_total = new_net_pay + gst;

                $("#MembershipDts_GrossTotal").val(gross_total);


            });

            var memberfees = $("#MembershipDetails_Fee").val();
            var per_discount = $("#MembershipDts_Discount").val();

            var dis = (memberfees * per_discount) / 100;
            var new_net_pay = memberfees - dis;

            $("#MembershipDts_NetPayment").val(new_net_pay);

            var gst = new_net_pay * 0.18;

            $("#MembershipDts_GST").val(gst);

            var gross_total = new_net_pay + gst;

            $("#MembershipDts_GrossTotal").val(gross_total);



            $('html').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    return false;
                }
            });


        });
    </script>



    <?php include ('belowScript.php'); ?>
    <script src="assets/vendor/DataTables/datatables.min.js"></script>
    <script src="assets/js/datatable-data.js"></script>
</body>

</html>