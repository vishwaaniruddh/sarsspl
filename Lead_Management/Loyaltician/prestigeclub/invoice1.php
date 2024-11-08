<?php session_start();
$userName = $_SESSION['user'];
include ('config.php');

$Static_LeadID = $_POST['Mainid'];

$QuryGetLead = mysqli_query($conn, "select * from Leads_table where Lead_id='" . $Static_LeadID . "'");
$fetchLead = mysqli_fetch_array($QuryGetLead);


$QL = mysqli_query($conn, "select * from Level where Leval_id='" . $_POST['MembershipDetails_Level'] . "' ");
$FL = mysqli_fetch_array($QL);

$sqlexpiry = "SELECT Expiry_month FROM `validity` where Leval_id='" . $_POST['MembershipDetails_Level'] . "' ";
//echo $sqlexpiry;
$QryExpiry = mysqli_query($conn, $sqlexpiry);
$fetchExpiry = mysqli_fetch_array($QryExpiry);

$currentDate = date('Y-m-d');
$dd = date("d-m-Y");
$d = strtotime("+" . $fetchExpiry['Expiry_month'] . " months", strtotime($currentDate));
$R = date("d-m-Y", $d);

$CGST = $_POST['MembershipDts_GST'] / 2;




// part 1. MemshipDts_UploadCopyOfTheInstmnt
$MemshipDts_banner = $_FILES['MemshipDts_UploadCopyOfTheInstmnt']['name'];
$MemshipDts_expbanner = explode('.', $MemshipDts_banner);
$MemshipDts_bannerexptype = $MemshipDts_expbanner[1];
date_default_timezone_set('Australia/Melbourne');
$MemshipDts_date = date('m/d/Yh:i:sa', time());
$MemshipDts_rand = rand(10000, 99999);
$MemshipDts_encname = $MemshipDts_date . $MemshipDts_rand;
$MemshipDts_bannername = md5($MemshipDts_encname) . '.' . $MemshipDts_bannerexptype;
$MemshipDts_bannerpath = "upload/CopyOfTheInstmnt/" . $MemshipDts_bannername;
move_uploaded_file($_FILES["MemshipDts_UploadCopyOfTheInstmnt"]["tmp_name"], $MemshipDts_bannerpath);
/////////////////////////////////////////////////////////////////////////////////////////////  


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include ('header.php'); ?>

    <script>
        function validation() {

            var level = document.getElementById("MembershipDetails_Level").value;
            if (level != "") {
                $('#submit').val('Please wait ...')
                    .attr('disabled', 'disabled');
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>

<body class="sidebar-pinned ">
    <?php include ('vertical_menu.php'); ?>

    <main class="admin-main">
        <!--site header begins-->


        <?php include ('navbar.php'); ?>
        <!--site header ends -->
        <section class="admin-content ">
            <div class="bg-dark m-b-30">
                <div class="container">
                    <div class="row p-b-60 p-t-60">

                        <div class="col-md-6 text-white p-b-30">
                            <div class="media">
                                <div class="avatar avatar mr-3">
                                    <div class="avatar-title bg-success rounded-circle mdi mdi-receipt  ">

                                    </div>
                                </div>
                                <div class="media-body">

                                    <!--  <button class="btn btn-white-translucent" id="printDiv" > <i class="mdi
                                mdi-printer"></i>
                                    Print</button>-->



                                    <form method="POST" action="Member_Payment_Process1.php"
                                        onsubmit="return validation()" enctype="multipart/form-data">


                                        <!--======================== Part 3 Membership Details (End)================================--->
                                        <div style="display:none">

                                            <div class="form-group">
                                                <label for="inputPassword4">Membership Level</label>
                                                <input type="text" class="form-control" id="MembershipDetails_Level"
                                                    name="MembershipDetails_Level"
                                                    value="<?php echo $_POST['MembershipDetails_Level']; ?>" readonly
                                                    required>
                                                <input type="text" class="form-control" id="Hidden_MembershipDetails_id"
                                                    name="Hidden_MembershipDetails_id"
                                                    value="<?php echo $_POST['Hidden_MembershipDetails_id']; ?>"
                                                    readonly required>
                                                <input type="text" value="<?php echo $_POST['Mainid']; ?>" id="Mainid"
                                                    name="Mainid">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail4">Membership Fee</label>
                                                <input type="text" class="form-control" id="MembershipDetails_Fee"
                                                    name="MembershipDetails_Fee"
                                                    value="<?php echo $_POST['MembershipDetails_Fee']; ?>" readonly
                                                    required>
                                            </div>

                                            <div class="custom-control custom-checkbox">&nbsp;&nbsp;&nbsp;
                                                <input type="checkbox" class="custom-control-input"
                                                    id="MembershipDetails_offerCheck1"
                                                    name="MembershipDetails_offerCheck1" <?php if ($_POST['MembershipDetails_offerCheck1'] == "") { ?>
                                                <?php } else { ?> checked
                                                <?php } ?>>
                                                <label class="custom-control-label"
                                                    for="MembershipDetails_offerCheck1">Offer</label>&nbsp;&nbsp;&nbsp;
                                            </div>

                                            <div class="custom-control custom-checkbox" id="sample">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="MembershipSampal_offerCheck1"
                                                    name="MembershipSampal_offerCheck1" <?php if ($_POST['MembershipSampal_offerCheck1'] == "") { ?>
                                                <?php } else { ?> checked
                                                <?php } ?> >
                                                <label class="custom-control-label"
                                                    for="MembershipSampal_offerCheck1">sampal</label>
                                            </div>



                                            <div class="form-group">
                                                <label for="inputEmail4">% Discount</label>
                                                <input type="text" class="form-control" id="MembershipDts_Discount"
                                                    name="MembershipDts_Discount"
                                                    value="<?php if ($_POST['MembershipDts_Discount'] == "") {
                                                        echo '0';
                                                    } else {
                                                        echo $_POST['MembershipDts_Discount'];
                                                    } ?>"
                                                    readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail4">% Discount Remark</label>
                                                <input type="textarea" class="form-control"
                                                    id="MembershipDts_Discount_Remark"
                                                    name="MembershipDts_Discount_Remark"
                                                    value="<?php if ($_POST['MembershipDts_Discount_Remark'] == "") {
                                                        echo '0';
                                                    } else {
                                                        echo $_POST['MembershipDts_Discount_Remark'];
                                                    } ?>"
                                                    readonly>
                                            </div>



                                            <div class="form-group">
                                                <label for="inputEmail4">Net Payment</label>
                                                <input type="text" class="form-control" id="MembershipDts_NetPayment"
                                                    name="MembershipDts_NetPayment"
                                                    value="<?php echo $_POST['MembershipDts_NetPayment']; ?>" required
                                                    readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail4">GST @ 18%</label>
                                                <input type="text" class="form-control" id="MembershipDts_GST"
                                                    name="MembershipDts_GST"
                                                    value="<?php echo $_POST['MembershipDts_GST']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail4">Gross Total</label>
                                                <input type="text" class="form-control" id="MembershipDts_GrossTotal"
                                                    name="MembershipDts_GrossTotal"
                                                    value="<?php echo $_POST['MembershipDts_GrossTotal']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail4">Payment Date</label>
                                                <input type="text" class="form-control" id="MembershipDts_PaymentDate"
                                                    name="MembershipDts_PaymentDate" Placeholder="dd-mm-yyyy"
                                                    value="<?php echo $_POST['MembershipDts_PaymentDate']; ?>" readonly
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail4">Payment Mode</label>
                                                <input type="text" class="form-control" id="MembershipDts_PaymentMode"
                                                    name="MembershipDts_PaymentMode" Placeholder="PaymentMode"
                                                    value="<?php echo $_POST['MembershipDts_PaymentMode']; ?>" readonly
                                                    required>


                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail4">Instrument Number</label>
                                                <input type="text" class="form-control"
                                                    id="MembershipDts_InstrumentNumber"
                                                    name="MembershipDts_InstrumentNumber"
                                                    placeholder='Credit Card/ Cheque/ Deposit Slip'
                                                    value="<?php echo $_POST['MembershipDts_InstrumentNumber']; ?>"
                                                    readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail4">Bank Name</label>
                                                <input type="text" class="form-control" id="BankName" name="BankName"
                                                    placeholder='Bank Name' value="<?php echo $_POST['BankName']; ?>"
                                                    readonly>
                                            </div>



                                            <div class="form-group">
                                                <label for="inputEmail4">Batch Number</label>
                                                <input type="text" class="form-control" id="MemshipDts_BatchNumber"
                                                    name="MemshipDts_BatchNumber" placeholder='Batch Number'
                                                    value="<?php echo $_POST['MemshipDts_BatchNumber']; ?>" readonly>
                                            </div>



                                            <div class="form-group">
                                                <label for="inputEmail4">Remarks</label>
                                                <input type="text" class="form-control" id="MemshipDts_Remarks"
                                                    name="MemshipDts_Remarks" placeholder='Remarks'
                                                    value="<?php echo $_POST['MemshipDts_Remarks']; ?>" readonly>
                                            </div>
                                        </div>
                                        <!--======================== Part 3 Membership Details (End)================================--->
                                        <div class="form-group">
                                            <input type="submit" id="submit" name="submit" class="btn btn-primary"
                                                value="Submit" />

                                            <a href="javascript:history.back()" class="btn btn-primary">Back to previous
                                                page</a>
                                        </div>





                                </div>
                            </div>

                        </div>



                    </div>
                </div>
            </div>
            <div class="pull-up">
                <div class="container" id="printableArea">
                    <div class="row">
                        <div class="col-md-12 m-b-40">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <h1 class="font-primary">INVOICE</h1>
                                            <!-- <div class="">Invoice Number: </div>
                                        <div class="">Date: <?php echo $dd; ?></div>-->
                                        </div>
                                    </div>


                                    <div class="table-responsive ">
                                        <table border=1 class="table  m-t-20">
                                            <thead>
                                                <tr>
                                                    <th class="" colspan="2"
                                                        style="border-bottom:gray;background-color:#ef9a9a;color:black">
                                                        Invoice to: (Customer Details)</th>

                                                    <th class="text-center" colspan="2"
                                                        style="border-bottom:gray;background-color:#ef9a9a;color:black">
                                                        Invoice Details</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="" colspan="2">
                                                        Company Name : <?php echo $fetchLead['Company']; ?>
                                                    </td>

                                                    <td class="text-center">Date :</td>
                                                    <td class="text-right"><?php echo $dd; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="" colspan="2">
                                                        <p class="text-black m-0">Name :
                                                            <?php echo $fetchLead['Title'] . " " . $fetchLead['FirstName'] . " " . $fetchLead['LastName']; ?>
                                                        </p>

                                                    </td>

                                                    <td class="text-center"></td>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <td class="" colspan="2">
                                                        Phone: <?php echo $fetchLead['MobileNumber']; ?>
                                                    </td>

                                                    <td class="text-center" colspan="2">Membership Details</td>

                                                </tr>


                                                <tr>
                                                    <td class="" colspan="2">Email : <?php echo $fetchLead['EmailId']; ?>
                                                    </td>
                                                    <td class="text-center">Level :</td>
                                                    <td class="text-right"><?php echo $FL['level_name']; ?></td>
                                                </tr>

                                                <tr>
                                                    <td class="" colspan="2">GSTN: 27AADCL8692D1Z8 </td>
                                                    <td class="text-center">Validity :</td>
                                                    <td class="text-right"><?php echo $R; ?></td>
                                                </tr>

                                                <tr style="background-color:#ef9a9a;color:black">
                                                    <td class="" colspan="1">Description</td>
                                                    <td class="text-center">Quantity :</td>
                                                    <td class="text-right">Unit Price</td>
                                                    <td class="text-right">Amount</td>
                                                </tr>

                                                <tr>
                                                    <td class="" colspan="1"
                                                        style="padding-top: 10px;padding-bottom: 60px;">
                                                        <?php echo $FL['level_name'] . " Membership:"; ?> </td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-right"><?php echo $_POST['MembershipDetails_Fee'] ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo $_POST['MembershipDts_NetPayment'] ?></td>

                                                </tr>

                                                <tr>
                                                    <td class="" colspan="1"
                                                        style="background-color:#ef9a9a;color:black">Payment Details:
                                                    </td>
                                                    <td class="text-center" colspan="2"
                                                        style="background-color:#FFFACD;color:black">Subtotal:</td>
                                                    <td class="text-right" colspan="1"
                                                        style="background-color:#FFFACD;color:black">
                                                        <?php echo $_POST['MembershipDts_NetPayment']; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="" colspan="1"
                                                        style="background-color:#ef9a9a;color:black">Received by :
                                                        <?php echo $_POST['MembershipDts_PaymentMode']; ?></td>
                                                    <td class="text-center" colspan="2"
                                                        style="background-color:#FFFACD;color:black">CGST @ 9% </td>
                                                    <td class="text-right" colspan="1"
                                                        style="background-color:#FFFACD;color:black"><?php echo $CGST; ?>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td class="" colspan="1"
                                                        style="background-color:#ef9a9a;color:black">Instrument Number/
                                                        Approval Code:
                                                        <?php echo $_POST['MembershipDts_InstrumentNumber']; ?></td>
                                                    <td class="text-center" colspan="2"
                                                        style="background-color:#FFFACD;color:black">GGST @ 9% </td>
                                                    <td class="text-right" colspan="1"
                                                        style="background-color:#FFFACD;color:black"><?php echo $CGST; ?>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td class="" colspan="1"
                                                        style="background-color:#ef9a9a;color:black">Cheque Favouring -
                                                        K. Raheja Corp Pvt. Ltd.</td>
                                                    <td class="text-center" colspan="2"
                                                        style="background-color:#ef9a9a;color:black">Total including
                                                        Taxes </td>
                                                    <td class="text-right" colspan="1"
                                                        style="background-color:#ef9a9a;color:black">
                                                        <?php echo $_POST['MembershipDts_GrossTotal']; ?></td>

                                                </tr>

                                                <tr>
                                                    <td class="" colspan="4"
                                                        style="padding-top: 10px;padding-bottom: 60px;">Terms and
                                                        Conditions</br>
                                                        1. To avail input credit (if available), GSTN number and State
                                                        is mandatory.</br>
                                                        2. This is the final invoice regarding the purchase.</br>
                                                        3. No refunds are entertained beyond 15 days of purchase</br>


                                            </tbody>
                                        </table>
                                    </div>










                                    <div class="p-t-10 p-b-20">
                                        <p class="text-muted ">
                                            Signed</br></br>
                                            Cheque Favouring - K. Raheja Corp Pvt. Ltd.
                                        </p>
                                        <hr>
                                        <div class="text-center opacity-75">
                                            &copy; Loyaltician 2019
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog"
        aria-labelledby="siteSearchModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body p-all-0" id="site-search">
                    <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots">
                        <h3 class="text-uppercase    text-center  fw-300 "> Search</h3>

                        <div class="container-fluid">
                            <div class="col-md-10 p-t-10 m-auto">
                                <input type="search" placeholder="Search Something"
                                    class=" search form-control form-control-lg">

                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
                            results
                        </div>
                        <div class="list-group list  ">


                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                            src="assets/img/users/user-3.jpg" alt="user-image"></div>
                                </div>
                                <div class="">
                                    <div class="name">Eric Chen</div>
                                    <div class="text-muted">Developer</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                            src="assets/img/users/user-4.jpg" alt="user-image"></div>
                                </div>
                                <div class="">
                                    <div class="name">Sean Valdez</div>
                                    <div class="text-muted">Marketing</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                            src="assets/img/users/user-8.jpg" alt="user-image"></div>
                                </div>
                                <div class="">
                                    <div class="name">Marie Arnold</div>
                                    <div class="text-muted">Developer</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-dark rounded"><i
                                                class="mdi mdi-24px mdi-file-pdf"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">SRS Document</div>
                                    <div class="text-muted">25.5 Mb</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-dark rounded"><i
                                                class="mdi mdi-24px mdi-file-document-box"></i></div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">Design Guide.pdf</div>
                                    <div class="text-muted">9 Mb</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar avatar-sm  ">
                                            <div class="avatar-title bg-primary rounded"><i
                                                    class="mdi mdi-24px mdi-code-braces"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">response.json</div>
                                    <div class="text-muted">15 Kb</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar avatar-sm ">
                                            <div class="avatar-title bg-info rounded"><i
                                                    class="mdi mdi-24px mdi-file-excel"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">June Accounts.xls</div>
                                    <div class="text-muted">6 Mb</div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <style>
        .table td,
        .table th {
            padding: 8px;
            vertical-align: top;
            border-top: 1px solid grey;
        }
    </style>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/vendor/popper/popper.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/vendor/listjs/listjs.min.js"></script>
    <script src="assets/vendor/moment/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/atmos.min.js"></script>
    <!--page specific scripts for demo-->
    <script src="assets/js/invoice-print.js"></script>
</body>

</html>