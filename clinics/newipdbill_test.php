<?php
session_start();
if (isset($_SESSION['SESS_USER_NAME'])) {

    include 'config.php';
    if (isset($id)) {
        $id = $_GET['id'];

        $sql = "select * from admission where ad_id='$id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);

        $sql1 = "select * from patient where no='$row[1]'";
        $result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_row($result1);
    }
    ?>
    <title>IPD BILL ENTRY</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js">
    </script>
    <script>
        $(document).ready(function () {

            $("input[name='quantity[]'], input[name='rate[]'], input[name='discount'], input[name='amount[]'], input[name='particulars[]'], input[name='AdvAmount']")
                .on(
                    'input',
                    function () {
                        calculateTotal();
                    });

            function calculateTotal() {
                var totalAmount = 0;
                var totalQuantity = 0;

                $("tr.data-row").each(function (index) {
                    var quantity = parseFloat($(this).find("input[name='quantity[]']").val()) || 0;
                    var rate = parseFloat($(this).find("input[name='rate[]']").val()) || 0;
                    var amount = quantity * rate;
                    totalAmount += amount;
                    totalQuantity += quantity;

                    $(this).find("input[name='amount[]']").val(amount.toFixed(2));
                });

                var discount = parseFloat($("input[name='discount']").val()) || 0;
                var advance = parseFloat($("input[name='AdvAmount']").val()) || 0;
                var totalDeduct = discount + advance;
                var finalAmount = totalAmount - totalDeduct;
                $("#totalAmount").val(totalAmount.toFixed(2));

                $("#finalAmount").val(finalAmount.toFixed(2));

                $("#totalQuantity").val(totalQuantity);
            }
        });

        // Print function
        $("#printButton").on("click", function () {
            var printContent = "<h1>Invoice</h1>";

            // Include table content
            printContent += $("table").clone().wrap('<div>').parent().html();

            // Include additional fields
            printContent += "<p>Total Quantity: " + $("#totalQuantity").val() + "</p>";
            printContent += "<p>Total Amount: " + $("#totalAmount").val() + "</p>";
            printContent += "<p>Discount: " + $("input[name='discount']").val() + "</p>";
            printContent += "<p>Final Amount: " + $("#finalAmount").val() + "</p>";

            // Create a new window and print
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print</title></head><body>' + printContent +
                '</body></html>');
            printWindow.document.close();
            printWindow.print();
        });

        // Form submission
        $("#invoiceForm").submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "ipdbill_process_test.php",
                data: formData,
                success: function (response) {
                    console.log(response);

                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    </script>

    <!--Datepicker-->
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        #mask {
            display: none;
            background: #000;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 10;
            width: 100%;
            height: 100%;
            opacity: 0.8;
            z-index: 999;
        }

        /* You can customize to your needs  */
        .login-popup {

            background: #00a4ae;
            padding: 10px;
            border: 2px solid #ac0404;
            float: left;
            font-size: 1.2em;
            position: relative;
            top: 0%;
            left: 3%;
            z-index: 99999;
            box-shadow: 0px 0px 20px #999;
            /* CSS3 */
            -moz-box-shadow: 0px 0px 20px #999;
            /* Firefox */
            -webkit-box-shadow: 0px 0px 20px #999;
            /* Safari, Chrome */
            border-radius: 3px 3px 3px 3px;
            -moz-border-radius: 3px;
            /* Firefox */
            -webkit-border-radius: 3px;
            /* Safari, Chrome */
        }

        img.btn_close {
            /* Position the close button float: right; */
            margin: -28px -28px 0 0;
        }

        fieldset {
            border: none;
        }

        form.signin .textbox label {
            display: block;
            padding-bottom: 7px;
        }

        form.signin .textbox span {
            display: block;
        }

        form.signin p,
        form.signin span {
            color: #fff;
            font-size: 13px;
            line-height: 18px;
        }

        form.signin .textbox input {
            background: #fff;
            border-bottom: 1px solid #ac0404;
            border-left: 1px solid #ac0404;
            border-right: 1px solid #ac0404;
            border-top: 1px solid #ac0404;
            color: #000;
            border-radius: 3px 3px 3px 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            font: 13px Arial, Helvetica, sans-serif;
            padding: 6px 6px 4px;
            width: 200px;
        }

        form.signin input:-moz-placeholder {
            color: #bbb;
            text-shadow: 0 0 2px #000;
        }

        form.signin input::-webkit-input-placeholder {
            color: #bbb;
            text-shadow: 0 0 2px #000;
        }

        .formbutton {
            background: -moz-linear-gradient(center top, #ac0404, #dddddd);
            background: -webkit-gradient(linear, left top, left bottom, from(#ac0404), to(#dddddd));
            background: -o-linear-gradient(top, #ac0404, #dddddd);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#ac0404', EndColorStr='#dddddd');
            border-color: #ac0404;
            border-width: 1px;
            border-radius: 4px 4px 4px 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            padding: 6px 6px 4px;
            margin-top: 10px;
            font: 12px;
            width: 100px;
        }

        form.signin td {
            font-size: 12px;
        }
    </style>
    <style>
        /* Add some spacing */
        .spacer {
            height: 20px;
        }
    </style>
    <!--DisCharges form-->
    <div class="login-popup">


        <form method="post" id="invoiceForm" action="ipdbill_process_test.php">

            <!-- <input type="hidden" name="myvar" value="0" id="theValue" /> -->
            <p style="color:#ac0404; font-weight:bold; font-size:20px;" align="center">IPD Bill Entry</p>

            <?php
            $ipdsql = mysqli_query($con, "select id from ipdbill order by id desc limit 1");
            $ipdbill_res = mysqli_fetch_row($ipdsql);
            $id = $ipdbill_res[0];

            ?>

            <table id="ds">

                <tr>
                    <td><label class="fdiag">IPD Bill No. :</label></td>
                    <td><input id="bill" name="bill" type="text" class="form-control" value="<?php if (isset($id)) {
                        echo $id;
                    } else
                        echo ""; ?>" readonly></td>
                </tr>

                <tr>
                    <td>
                        <label for="obs">Observation</label>
                    </td>
                    <td><select class="form-control" name="observation" id="obs">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select></td>
                </tr>

                <tr>
                    <td><label class="inv">Indoor Registration No. :</label></td>
                    <td><input type="text" class="form-control" name="indoor_reg_no" id="indoor_reg_no" /></td>
                </tr>

                <tr>
                    <td><label class="fdiag">Payment Method :</label></td>
                    <td>
                        <select name="payment" id="payment" class="form-control">
                            <option value="">Select</option>
                            <option value="Cash">Cash</option>
                            <option value="ESI">ESI</option>
                            <option value="Ayushman">Ayushman</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td width="306">Full Name :</td>
                    <td width="168"><input id="name" name="name" type="text" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td><label class="age">Age :</label></td>
                    <td><input id="age" name="age" type="text" class="form-control"></td>
                </tr>
                <tr>
                    <td><label class="gender">Gender :</label></td>
                    <td>
                        <select id="gender" name="gender" class="form-control">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label class="pro_diag">Address :</label></td>
                    <td><textarea name="address" rows="5" cols="50" class="form-control" style="resize:none;"></textarea>
                    </td>
                </tr>

                <tr>
                    <td><label>Contact No:</label></td>
                    <td> <input id="contact_no" name="contact_no" type="text" class="form-control" maxlength="10"></td>
                </tr>


                <tr>
                    <td><label>Date of Admission :</label></td>
                    <td><input id="add_date" name="add_date" type="date" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td><label>Time of Admission :</label></td>
                    <td><input id="add_time" name="add_time" type="time" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td><label>Primary Consultant Dr :</label></td>
                    <td>
                        <select name="consult_doc" id="consult_doc" class="form-control">
                            <option value="">Select</option>
                            <?php
                            $sql = mysqli_query($con, "select doc_id,name from doctor");

                            while ($sql_result = mysqli_fetch_assoc($sql)) { ?>
                                <option value="<?php echo $sql_result['name']; ?>">
                                    <?php echo $sql_result['name']; ?>
                                </option>

                            <?php }

                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td><label>Secondary Consultant Dr :</label></td>
                    <td>
                        <select name="consult_doc2" id="consult_doc2" class="form-control">
                            <option value="">Select</option>
                            <?php
                            $sql = mysqli_query($con, "select doc_id,name from doctor");

                            while ($sql_result = mysqli_fetch_assoc($sql)) { ?>
                                <option value="<?php echo $sql_result['name']; ?>">
                                    <?php echo $sql_result['name']; ?>
                                </option>

                            <?php }

                            ?>
                        </select>
                    </td>
                </tr>


                <tr>
                    <td><label>Date of DisCharges :</label></td>
                    <td><input id="datedis" name="datedis" type="date" class="form-control"></td>
                </tr>

                <tr>
                    <td><label>Time of DisCharges :</label></td>
                    <td><input id="timedis" name="timedis" type="time" class="form-control"></td>
                </tr>


            </table>
            <table>
                <br>
                <p><label style="color:white"><b>* NOTE: Please add Quantity if Rate is Entered *</b></label></p>
                <tr>
                    <td><label><b>Particulars</b></label></td>
                    <td><label><b>Quantity</b></label></td>
                    <td><label><b>Rate</b></label></td>
                    <td><label><b>Amount(Rupees)</b></label></td>
                </tr>


                <tr class="data-row">
                    <td><label>Room Rent :</label></td>
                    <input type="hidden" name="particulars[]" value="Room Rent">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>


                </tr>

                <tr class="data-row">
                    <td><label>Bed Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="Bed Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>


                <tr class="data-row">
                    <td><label>Nursing :</label></td>
                    <input type="hidden" name="particulars[]" value="Nursing">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Consultant Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="Consultant Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>
                
                <tr class="data-row">
                    <td><label>Secondary Consultant Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="Secondary Consultant Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Duty Doc Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="Duty Doctor Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Surgeon Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="Surgeon Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Anaesthetic Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="Anaesthetic Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>O.T./Labour Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="O.T./Labour Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Paediatrician Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="Paediatrician Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Oxygen/Nebulization :</label></td>
                    <input type="hidden" name="particulars[]" value="Oxygen/Nebulization">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>B.T. Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="B.T. Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Instrument Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="Instrument Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Procedure Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="Procedure Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Investigation :</label></td>
                    <input type="hidden" name="particulars[]" value="Investigation">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>X-Ray Charges :</label></td>
                    <input type="hidden" name="particulars[]" value="X-Ray Charges">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Blood Sugar :</label></td>
                    <input type="hidden" name="particulars[]" value="Blood Sugar">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Dressing :</label></td>
                    <input type="hidden" name="particulars[]" value="Dressing">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>E.C.G. :</label></td>
                    <input type="hidden" name="particulars[]" value="E.C.G.">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>OPD :</label></td>
                    <input type="hidden" name="particulars[]" value="OPD">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>MRD :</label></td>
                    <input type="hidden" name="particulars[]" value="MRD">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Medicine :</label></td>
                    <input type="hidden" name="particulars[]" value="Medicine">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="data-row">
                    <td><label>Miscellaneous :</label></td>
                    <input type="hidden" name="particulars[]" value="Miscellaneous">
                    <td><input name="quantity[]" type="text" class="form-control"></td>
                    <td><input name="rate[]" type="text" class="form-control"></td>
                    <td><input name="amount[]" type="text" class="form-control" readonly></td>

                </tr>

                <tr class="spacer">
                    <!-- Spacer row for some space -->
                </tr>
                <tr>
                    <td colspan="2"><label>Total Quantity:</label></td>
                    <td><input id="totalQuantity" type="text" class="form-control" readonly></td>
                </tr>

                <tr>
                    <td class="spacer">
                        <!-- Spacer row for some space -->
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><label class="datead">Discount :</label></td>
                    <td><input name="discount" type="text" class="form-control"></td>
                </tr>

                <tr>
                    <td class="spacer">
                        <!-- Spacer row for some space -->
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><label>Advance Amount:</label></td>
                    <td><input id="AdvAmount" name="AdvAmount" type="text" class="form-control"></td>
                </tr>

                <tr>
                    <td class="spacer">
                        <!-- Spacer row for some space -->
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><label>Total Amount:</label></td>
                    <td><input id="totalAmount" name="totalAmount" type="text" class="form-control" readonly></td>
                </tr>

                <tr>
                    <td class="spacer">
                        <!-- Spacer row for some space -->
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><label>Paid Amount:</label></td>
                    <td><input id="finalAmount" name="finalAmount" type="text" class="form-control" readonly></td>
                </tr>

            </table>

            <!-- <button id="printButton" name="printButton" class="btn btn-primary">Print</button> -->
            <input type="submit" value="Submit" name="submit" class="btn btn-success">
            <a href="home.php"> <input type="button" value="Cancel" name="cancel" class="btn btn-warning"> </a>
        </form>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
    </div>
    <?php
} else {
    header("location: home.php");
}
?>