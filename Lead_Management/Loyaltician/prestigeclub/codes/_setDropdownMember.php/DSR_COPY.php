<?php session_Start();
include ("config.php");


function get_member_details($parameter, $id)
{
    global $conn;


    $sql = mysqli_query($conn, "SELECT * FROM `Members`,`RenewalMembersDetails` where Members.Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and Members.Static_LeadID = RenewalMembersDetails.Static_LeadID and  (DATE(Members.entryDate)='" . date("Y-m-d") . "' or DATE(RenewalMembersDetails.entryDate)='" . date("Y-m-d") . "' or date(CancelationDate)='" . date("Y-m-d") . "' ) and Members.Static_LeadID='" . $id . "'");

    $sql_result = mysqli_fetch_assoc($sql);

    if ($sql_result) {
        return $sql_result[$parameter];
    } else {
        return false;
    }

}


function getNew_booklet($member_id)
{

    global $conn;

    $sql = mysqli_query($conn, "select * from Extension_history where member_id = '" . $member_id . "' and extention_type='' order by id desc");

    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['new_booklet_series'];
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



        function searchfiltter() {

            var Ab_Filtter = document.getElementById('Ab_Filtter').value;
            var cancel_Filtter = document.getElementById('cancel_Filtter').value;
            var FromDt = document.getElementById('FromDt').value;
            var Todt = document.getElementById('Todt').value;



            if (Ab_Filtter == "") {
                swal("Please Select Dropdown");
            } else if (FromDt == "") {
                swal("Please Select From Date");
            } else if (Todt == "") {
                swal("Please Select To Date");
            } else {

                $.ajax({

                    type: 'POST',
                    url: 'DSRsearch_Filtter.php',
                    data: 'FromDt=' + FromDt + '&Todt=' + Todt + '&Ab_Filtter=' + Ab_Filtter + '&cancel_Filtter=' + cancel_Filtter,

                    success: function (msg) {
                        //alert(msg);
                        $('#setTable').empty();
                        var json = $.parseJSON(msg);
                        for (var i = 0; i < json.length; ++i) {
                            //  alert(json[i].FirstName)


                            var srno = i + 1;
                            $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">' + srno + '</td><td>' + json[i].Primary_nameOnTheCard + '</td><td>' + json[i].Type + '</td><td>' + json[i].level_name + '</td><td>' + json[i].GenerateMember_Id + '</td><td>' + json[i].entryDate + '</td><td>' + json[i].R + '</td><td>' + json[i].Primary_Anniversary + '</td><td>' + json[i].Primary_DateOfBirth + '</td><td>' + json[i].booklet_Series + '</td><td>' + json[i].TypeNR + '</td><td>' + json[i].MembershipDts_PaymentMode + '</td><td>' + json[i].MembershipDts_InstrumentNumber + '</td><td>' + json[i].Recipt + '</td> <td>' + json[i].MembershipDts_NetPayment + '</td>  <td>' + json[i].MembershipDts_GST + '</td> <td>' + json[i].MembershipDts_GrossTotal + '</td><td>' + json[i].canceledMember + '</td> </tr>');
                        }

                        document.getElementById('qr').value = "";
                        document.getElementById('qr').value = json['0'].Qry;

                        document.getElementById('qr1').value = "";
                        document.getElementById('qr1').value = json['0'].Qry;
                        document.getElementById('From1').value = "";
                        document.getElementById('From1').value = json['0'].FromDat;
                        document.getElementById('To1').value = "";
                        document.getElementById('To1').value = json['0'].Todt;

                        document.getElementById('cancel1').value = json['0'].cancel_Filtter;

                    }
                })


            }
        }

    </script>

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
                                    <i class="mdi mdi-table "></i></span> view DSR
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



                            $View = "SELECT * FROM `Members`,`RenewalMembersDetails` where Members.Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and Members.Static_LeadID = RenewalMembersDetails.Static_LeadID and  (DATE(Members.entryDate)='" . date("Y-m-d") . "' or DATE(RenewalMembersDetails.entryDate)='" . date("Y-m-d") . "' or date(CancelationDate)='" . date("Y-m-d") . "' )";

                            //echo $View;
                            // for supplimentary member
                            
                            $supp = "SELECT * FROM `suplimentoryMember` where DATE(entryDate)='" . date("Y-m-d") . "' ";

                            //	SELECT * FROM `Members` where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and DATE(entryDate)='2019-06-25' or date(CancelationDate)='2019-06-25' OR GenerateMember_Id=(select Memberid from suplimentoryMember);
                            
                            $qrys = mysqli_query($conn, $View);
                            $supqry = mysqli_query($conn, $supp);

                            ?>
                            <div class="card-body">
                                <div class="form-group col-md-3" style="display:none">
                                    <select class="form-control" name="Ab_Filtter" id="Ab_Filtter">
                                        <option value="">Select</option>
                                        <option value="DSR" selected>DSR</option>
                                    </select>
                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-3">
                                        <select class="form-control" name="cancel_Filtter" id="cancel_Filtter">
                                            <option value="">Select</option>
                                            <option value="1">Cancel</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="js-datepicker form-control" id="FromDt" name="FromDt"
                                            autocomplete="off" placeholder="From Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="js-datepicker form-control" id="Todt" name="Todt"
                                            autocomplete="off" placeholder="To Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="button" class="btn btn-primary" onclick="searchfiltter()"
                                            value="Search">
                                    </div>

                                </div>



                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>srno</th>
                                                <th> Name on the Card</th>
                                                <th> Type</th>
                                                <th> Level</th>
                                                <th> Membership No.</th>
                                                <th> DSR_Date</th>
                                                <th> Expiry Date</th>
                                                <th> Anniversary Date</th>
                                                <th> DOB_Date</th>
                                                <th> Booklet Number</th>
                                                <th> Type(N/R)</th>
                                                <th> Payment Mode</th>
                                                <th> Instrument No.</th>
                                                <!-- <th> Authorisation</th>-->
                                                <th> Receipt No.</th>
                                                <th> Amount</th>
                                                <th> GST</th>
                                                <th> Total Amount</th>
                                                <th> Discount Remarks</th>
                                                <!--<th> Cancel Member</th>-->





                                            </tr>
                                        </thead>
                                        <tbody id="setTable">

                                            <?php
                                            $srn = 1;
                                            while ($_row = mysqli_fetch_array($qrys)) {


                                                $member_id = $_row['Static_LeadID'];



                                                $sql2 = "select * from Leads_table where Lead_id='" . $_row['Static_LeadID'] . "' ";
                                                //echo $sql2;
                                                $runsql2 = mysqli_query($conn, $sql2);
                                                $sql2fetch = mysqli_fetch_array($runsql2);



                                                $sql3 = "SELECT * FROM `Level` where Leval_id='" . $_row['MembershipDetails_Level'] . "' ";
                                                // 	echo $sql3;
                                                $runsql3 = mysqli_query($conn, $sql3);
                                                $sql3fetch = mysqli_fetch_array($runsql3);

                                                $sql4 = "SELECT Expiry_month FROM `validity` where Leval_id='" . $_row['MembershipDetails_Level'] . "' ";
                                                $runsql4 = mysqli_query($conn, $sql4);
                                                $sql4fetch = mysqli_fetch_array($runsql4);
                                                $exm = $sql4fetch['Expiry_month'];


                                                $sql5 = "SELECT state FROM `state` where state_id='" . $sql2fetch['State'] . "' ";
                                                $runsql5 = mysqli_query($conn, $sql5);
                                                $sql5fetch = mysqli_fetch_array($runsql5);


                                                $dd = date('Y-m-d', strtotime($_row['entryDate']));


                                                if (date('d', strtotime($_row['entryDate'])) >= 25) {
                                                    $exm += 1;
                                                }

                                                $d = strtotime("+" . $exm . " months", strtotime($dd));
                                                //   $R=  date("M-Y",$d);
                                                $R = date('M, Y', strtotime($_row['ExpiryDate']));
                                                ?>
                                                <tr>



                                                    <td> <?php echo $srn; ?></td>
                                                    <td><?php echo $_row['Primary_nameOnTheCard']; ?></td>
                                                    <td><?php echo ''; ?></td>

                                                    <td><?php echo $sql3fetch['level_name']; ?></td>


                                                    <?php if (get_member_details('NewGenerateMember_Id', $member_id) > 0) { ?>


                                                        <td>
                                                            <?php echo get_member_details('NewGenerateMember_Id', $member_id); ?>
                                                        </td>

                                                    <?php } else { ?>
                                                        <td><?php echo $_row['GenerateMember_Id']; ?></td>
                                                    <?php } ?>





                                                    <td><?php echo $dd; ?></td>
                                                    <td><?php echo $R; ?></td>
                                                    <td><?php echo $_row['Primary_Anniversary']; ?></td>
                                                    <td><?php echo $_row['Primary_DateOfBirth']; ?></td>


                                                    <td>

                                                        <?php
                                                        if (getNew_booklet($member_id)) {
                                                            echo getNew_booklet($member_id);
                                                        } else {
                                                            echo $_row['booklet_Series'];
                                                        }
                                                        ?>
                                                    </td>

                                                    <?
                                                    if (get_member_details('NewGenerateMember_Id', $member_id) > 0) { ?>

                                                        <td><?php echo 'Renew'; ?></td>

                                                    <?php } elseif ($_row['canceledMember'] == 1) { ?>

                                                        <td><?php echo 'Cancel'; ?></td>
                                                    <?php } else { ?>
                                                        <td><?php echo 'New'; ?></td>
                                                    <?php } ?>




                                                    <td><?php echo $_row['MembershipDts_PaymentMode']; ?></td>
                                                    <td><?php echo $_row['MembershipDts_InstrumentNumber']; ?></td>
                                                    <!-- <td><?php echo $_row['Member_bankName']; ?></td>-->
                                                    <td><?php echo ''; ?></td>
                                                    <td><?php echo $_row['MembershipDts_NetPayment']; ?></td>
                                                    <td><?php echo $_row['MembershipDts_GST']; ?></td>
                                                    <td><?php echo $_row['MembershipDts_GrossTotal']; ?></td>
                                                    <!-- <td><?php echo $_row['MemshipDts_Remarks']; ?></td>-->
                                                    <td><?php if ($_row['canceledMember'] == 1) {
                                                        echo "Cancel";
                                                    } ?></td>



                                                    <!-- 
    <td><?php echo $_row['GenerateMember_Id']; ?></td>
    <td><?php echo $_row['Primary_Title']; ?></td>
    <td><?php echo $sql2fetch['FirstName']; ?></td>
    <td><?php echo $sql2fetch['LastName']; ?></td>
    <td><?php echo $_row['Primary_nameOnTheCard']; ?></td>

    <td><?php echo $_row['Spouse_FirstName']; ?></td>
    <td><?php echo $sql2fetch['MobileNumber']; ?></td>
    <td><?php echo $sql3fetch['level_name']; ?></td>
    <td><?php echo $_row['entryDate']; ?></td>
    <td><?php echo $sql4fetch['Expiry_month'] . " " . Month; ?></td>

    <td><?php echo $_row['Primary_mob1']; ?></td>
    <td><?php echo $_row['Primary_Contact1']; ?></td>
    <td><?php echo $_row['Primary_Contact2']; ?></td>
    <td><?php echo $_row['Primary_Contact3']; ?></td>
    <td><?php echo $_row['Primary_Email_ID2']; ?></td>

    <td><?php echo $_row['Spouse_GmailMArrid1']; ?></td>
    <td><?php echo $sql2fetch['Company']; ?></td>
    <td><?php echo $sql2fetch['Designation']; ?></td>
    <td><?php echo $_row['Primary_AddressType1']; ?></td>
    <td><?php echo $_row['Primary_BuldNo_addrss'] . $_row['Primary_Area_addrss'] . $_row['Primary_Landmark_addrss']; ?></td>
    <td><?php echo $sql2fetch['City']; ?></td>
    <td><?php echo $sql5fetch['state']; ?></td>
    <td><?php echo $sql2fetch['Country']; ?></td>
    <td><?php echo $sql2fetch['PinCode']; ?></td>

    <td><?php echo $_row['Primary_DateOfBirth']; ?></td>
    <td><?php echo $_row['Primary_MaritalStatus']; ?></td>
   <td></td>	-->







                                                </tr>

                                                <?php

                                                $srn++;
                                            }

                                            while ($_row = mysqli_fetch_array($supqry)) {
                                                ?>
                                                <tr>



                                                    <td><?php echo "anand" . $srn; ?></td>
                                                    <td><?php echo $_row['NameOnTheCard']; ?></td>
                                                    <td><?php echo ''; ?></td>
                                                    <td><?php echo ''; ?></td>
                                                    <td><?php echo $_row['Memberid']; ?></td>
                                                    <td><?php echo $_row['entryDate']; ?></td>
                                                    <td><?php echo ''; ?></td>
                                                    <td><?php echo ''; ?></td>
                                                    <td><?php echo $_row['DateOfBirth']; ?></td>


                                                    <td><?php echo ''; ?></td>
                                                    <td><?php echo 'SUP'; ?></td>
                                                    <td><?php echo $_row['PaymentMode']; ?></td>
                                                    <td><?php echo ''; ?></td>
                                                    <!-- <td><?php echo ''; ?></td>-->
                                                    <td><?php echo ''; ?></td>
                                                    <td><?php echo $_row['Amount']; ?></td>
                                                    <td><?php echo $_row['Amount'] * 0.18; ?></td>
                                                    <td><?php echo $_row['Amount'] * 1.18; ?></td>
                                                    <!-- <td><?php echo $_row['MemshipDts_Remarks']; ?></td>-->
                                                    <td><?php echo $_row['MembershipDts_Discount_Remark']; ?></td>

                                                    <!--<td><?php echo ''; ?></td>-->

                                                </tr>
                                                <?php
                                                $srn++;
                                            }
                                            ?>


                                        </tbody>

                                    </table>
                                </div>
                                <div class="row">
                                    <div class="cols-md-8">
                                        <form name="frm" method="post" action="exportDSR.php" target="_new">
                                            <input type="hidden" name="qr" id="qr" value="<?php echo $View; ?>"
                                                readonly>
                                            <input type="submit" name="cmdsub" value="Export" class="btn btn-primary">
                                            <span>(From here you can Export MAX 860 Record at one Time.)</span>
                                        </form>
                                    </div>&nbsp;&nbsp;
                                    <div class="cols-md-4">
                                        <form name="frm" method="post" action="Leadpdf/DSRreportPDF.php" target="_new">
                                            <input type="hidden" name="qr1" id="qr1" value="<?php echo $View; ?>"
                                                readonly>
                                            <input type="hidden" name="From1" id="From1" readonly>
                                            <input type="hidden" name="To1" id="To1" readonly>
                                            <input type="hidden" name="cancel1" id="cancel1" readonly>
                                            <input type="submit" name="cmdsub" value="Generate PDF"
                                                class="btn btn-primary">
                                        </form>
                                    </div>
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
    <!--<script src="assets/js/datatable-data.js"></script>-->
</body>

</html>