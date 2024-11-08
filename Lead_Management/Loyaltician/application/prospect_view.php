<?php session_start();
include ('config.php');
ini_set('memory_limit', '-1');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("header.php") ?>
    <!-- Additional library for page -->


    <!-- jQuery library -->

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <script>

        function expfunc() {//alert("hii")

            $('#formf').attr('action', 'delegation.php').attr('target', '_self');
            $('#formf').submit();


        }


        function toggle(source) {

            chkboxes = document.getElementsByName('check[]');
            for (var i = 0, n = chkboxes.length; i < n; i++) {
                chkboxes[i].checked = source.checked;

            }

        }




    </script>

</head>

<body class="sidebar-pinned" id="rightclick">


    <?php include ("vertical_menu.php") ?>
    <main class="admin-main">
        <?php include ('navbar.php'); ?>
        <!--site header ends -->
        <section class="admin-content">
            <div class="bg-dark">
                <div class="container  m-b-30">
                    <div class="row">
                        <div class="col-12 text-white p-t-40 p-b-90">

                            <h4 class=""> <span class="btn btn-white-translucent">
                                    <i class="mdi mdi-table "></i></span> View Prospect
                            </h4>


                        </div>
                    </div>
                </div>
            </div>
            <form method="post" id="formf" action="delegation.php">
                <div class="container  pull-up">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <?php include ("config.php");
                                //  $View="select * from Leads_table where leadEntryef='".$_SESSION['id']."'";
                                
                                if ($_SESSION['usertype'] == 'Admin' || $_SESSION['usertype'] == 'Fulfillment Team') {
                                    $View = "select * from Leads_table where Status!='3' ";
                                } else {
                                    $View = "select * from Leads_table where Status!='3' and leadEntryef='" . $_SESSION['id'] . "'";
                                }
                                $qrys = mysqli_query($conn, $View);

                                ?>



                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress2">Lead Source
                                                <select class="form-control" name="Leadfilter" id="Leadfilter">
                                                    <option value="">Select Source</option>
                                                    <?php
                                                    $QuryLead_Sources = mysqli_query($conn, "SELECT * FROM `Lead_Sources` where Active='YES'");
                                                    while ($fetchLead_Sources = mysqli_fetch_array($QuryLead_Sources)) {
                                                        ?>
                                                        <option value="<?php echo $fetchLead_Sources['SourceId']; ?>">
                                                            <?php echo $fetchLead_Sources['Name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <input type="button" class="btn btn-primary" onclick="searchfiltter()"
                                                    value="Search">
                                        </div>

                                    </div>

                                    <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                        <div align="right"><button id="myButtonControlID" class="btn btn-primary"
                                                onClick="expfunc();">Delegate</button>

                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <lable>Checked All :-</lable><input type="checkbox" onClick="toggle(this)" />
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                                        </div><?php } ?>
                                    <div class="table-responsive p-t-10">
                                        <table id="example" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>srno</th>
                                                    <th>Full Name</th>
                                                    <th>Email-Id</th>
                                                    <th>Mobile Number</th>
                                                    <th>Office Number</th>
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>Lead Source</th>
                                                    <th>Company</th>
                                                    <th>Designation</th>


                                                    <?php if ($_SESSION['usertype'] == 'Admin' || $_SESSION['usertype'] == 'HOTEL MANGER') { ?>
                                                        <th>Associate Name</th><?php } ?>

                                                    <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                                        <th>Associate Status</th><?php } ?>
                                                    <th>Delegate Status</th>
                                                    <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                                        <th>Delegate</th> <?php } ?>
                                                    <th>Edit</th>
                                                    <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                                        <th>Convert To Member</th> <?php } ?>


                                                </tr>
                                            </thead>
                                            <tbody id="setTable">
                                                <?php
                                                $srn = 1;
                                                while ($_row = mysqli_fetch_array($qrys)) {


                                                    $sql3 = "select Name from Lead_Sources where SourceId='" . $_row['LeadSource'] . "'";
                                                    $runsql3 = mysqli_query($conn, $sql3);
                                                    $sql2fetch3 = mysqli_fetch_array($runsql3);


                                                    ?>
                                                    <tr>
                                                        <td><?php echo $srn; ?></td>
                                                        <td><?php echo $_row['FirstName'] . " " . $_row['LastName']; ?></td>
                                                        <td><?php echo $_row['EmailId']; ?></td>
                                                        <td><?php echo $_row['MobileNumber']; ?></td>
                                                        <td><?php echo $_row['ContactNo1']; ?></td>
                                                        <td><?php echo $_row['State']; ?></td>
                                                        <td><?php echo $_row['City']; ?></td>
                                                        <td><?php echo $sql2fetch3['Name']; ?></td>
                                                        <td><?php echo $_row['Company']; ?></td>
                                                        <td><?php echo $_row['Designation']; ?></td>

                                                        <?php if ($_SESSION['usertype'] == 'Admin' || $_SESSION['usertype'] == 'HOTEL MANGER') { ?>
                                                            <td><?php

                                                            $sql5 = "select FirstName, LastName from SalesAssociate where SalesmanId like (select SalesmanId from LeadDelegation where LeadId='" . $_row['Lead_id'] . "' order by DelegationId desc limit 1)";
                                                            $runsql5 = mysqli_query($conn, $sql5);
                                                            if ($runsql5 == false) {
                                                                echo "";
                                                            } else {

                                                                $sql2fetch5 = mysqli_fetch_assoc($runsql5);
                                                                echo $sql2fetch5["FirstName"] . " " . $sql2fetch5["LastName"];
                                                            }

                                                            ?></td><?php } ?>
                                                        <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                                            <td><?php


                                                            if ($_row['Status'] == '1') {
                                                                echo "Open";
                                                            }
                                                            if ($_row['Status'] == '2') {
                                                                echo "Closed";
                                                            }
                                                            if ($_row['Status'] == '3') {
                                                                echo "Suspense";
                                                            }
                                                            if ($_row['Status'] == '4') {
                                                                echo "Payment Received";
                                                            }
                                                            if ($_row['Status'] == '5') {
                                                                echo "Member";
                                                            }
                                                            if ($_row['Status'] == '6') {
                                                                echo "Payment in Process..";
                                                            }
                                                            if ($_row['Status'] == '7') {
                                                                echo "Ready For Payment";
                                                            }
                                                            ?>

                                                            </td><?php } ?>
                                                        <td><?php if ($_row['Status'] != '0') {
                                                            echo "Delegated";
                                                        } else {
                                                            echo "Pending";
                                                        } ?>
                                                        </td>


                                                        <?php if ($_SESSION['usertype'] == 'Admin') {
                                                            if ($_row['Status'] == '0') { ?>
                                                                <td><input type="checkbox" name="check[]"
                                                                        value="<?php echo $_row['Lead_id']; ?>"></td>
                                                            <?php } else { ?>
                                                                <td> </td> <?php }
                                                        } ?>



                                                        <td><?php if ($_row['Status'] == '0') { ?><input type="button"
                                                                    class="btn btn-primary"
                                                                    onclick="window.open('lead_entry1.php?id=<?php echo $_row['Lead_id']; ?>&excelid=0','_self');"
                                                                    value="Edit"><?php } ?> </td>



                                                        <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                                            <td><?php if ($_row['Status'] == '4') { ?><input type="button"
                                                                        class="btn btn-primary"
                                                                        onclick="window.open('MemberCreation.php?id=<?php echo $_row['Lead_id']; ?>','_self');"
                                                                        value="Convert To Member"><?php } ?> </td><?php } ?>


                                                    </tr>

                                                    <?php

                                                    $srn++;
                                                }
                                                ?>


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>srno</th>
                                                    <th>Full Name</th>
                                                    <th>Email-Id</th>
                                                    <th>Mobile Number</th>
                                                    <th>Office Number</th>
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>Lead Source</th>
                                                    <th>Company</th>
                                                    <th>Designation</th>

                                                    <?php if ($_SESSION['usertype'] == 'Admin' || $_SESSION['usertype'] == 'HOTEL MANGER') { ?>
                                                        <th>Associate Name</th><?php } ?>
                                                    <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                                        <th>Associate Status</th><?php } ?>
                                                    <th>Delegate Status</th>
                                                    <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                                        <th> Delegate</th> <?php } ?>
                                                    <th>Edit</th>
                                                    <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                                        <th>Convert To Member</th> <?php } ?>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div> <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                                        <div align="center"> <button id="myButtonControlID" class="btn btn-primary"
                                                onClick="expfunc();">Delegate</button></div><?php } ?>
                                </div>
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


    <script>


        function searchfiltter() {
            var Leadfilter = document.getElementById('Leadfilter').value;
            // alert(Leadfilter)


            $.ajax({

                type: 'POST',
                url: 'search_Filtter.php',
                data: 'Leadfilter=' + Leadfilter,

                success: function (msg) {
                    // alert(msg);
                    $('#setTable').empty();
                    var json = $.parseJSON(msg);
                    for (var i = 0; i < json.length; ++i) {
                        //  alert(json[i].FirstName)

                        var fullName = json[i].FirstName + " " + json[i].LastName;
                        var srno = i + 1;
                        var DelStatus = '';
                        if (json[i].Status != '0') {
                            DelStatus = 'Delegated';
                        } else { DelStatus = 'Pending'; }
                        var d = "";
                        if (json[i].Status == "0") { d = '<input type="checkbox" name="check[]" id="check" />'; }

                        var convrt = "";
                        if (json[i].Status == '4') {
                            convrt = '<input type="button" class="btn btn-primary" onclick="window.open("MemberCreation.php?id=<?php echo $_row['Lead_id']; ?>","_self");" value="Convert To Member">';
                        }


                        $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">' + srno + '</td><td>' + fullName + '</td><td>' + json[i].EmailId + '</td><td>' + json[i].MobileNumber + '</td><td>' + json[i].ContactNo1 + '</td><td>' + json[i].State + '</td><td>' + json[i].City + '</td><td>' + json[i].LeadSource + '</td><td>' + json[i].Company + '</td><td>' + json[i].Designation + '</td><td>' + json[i].Status + '</td><td>' + DelStatus + '</td> <td>' + d + '</td> </tr>');
                    }

                    test();

                }
            })



        }



        function test() {



            $('#example').DataTable();

        }
    </script>
</body>

</html>