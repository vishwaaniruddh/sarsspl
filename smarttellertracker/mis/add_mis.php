<?php include('../header.php'); 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


?>


<script src="<?php $_SERVER["DOCUMENT_ROOT"]; ?>/assets/js/jquery-3.7.min.js"></script>


<style>
    #emailToList {
        width: 100%;
    }

    input,
    select {
        background: #fff;
        border: none !important;
        border: 1px solid #cfd7df !important;
        border-radius: 4px !important;
        font-size: 11px !important;
        font-weight: 400 !important;
    }

    .requester-and-cc-link {
        padding-top: 0;
        color: #2c5cc5;
    }

    .requester-and-cc-link {
        color: #2c5cc5;
        margin-top: 7px;
        text-align: right;
        width: 100%;
    }

    .tox-statusbar__branding {
        display: none;
    }

    div.tagsinput span.tag {
        background: #0090e7;
        border: 0;
        color: #ffffff;
        padding: 6px 14px;
        font-size: 11px;
        font-family: inherit;
        line-height: 1;
    }

    div.tagsinput span.tag {
        border: 1px solid #a5d24a;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        display: block;
        float: left;
        padding: 5px;
        text-decoration: none;
        background: #0090e7;
        color: white;
        margin-right: 5px;
        margin-bottom: 5px;
        font-family: helvetica;
        font-size: 11px;
    }

    .tag {
        display: inline-block;
    }

    .tag:empty {
        display: none;
    }

    /* .removeTag {
        margin: auto 10px;
        display: inline-block;
        width: 24px;
        height: 24px;
        line-height: 24px;
        text-align: center;
        color: red;
        background: white;
        font-size: 11px;
        border-radius: 50%;
        border: 1px solid red;
        text-decoration: none;
    } */

    .removeTag {
        margin: auto 5px;
        display: inline-block;
        width: 16px;
        height: 16px;
        line-height: 16px;
        text-align: center;
        color: #666;
        background: #e0e0e0;
        font-size: 10px;
        border-radius: 50%;
        border: 1px solid #ccc;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.3s, color 0.3s;
    }

    .removeTag:hover {
        background: #ccc;
        color: #333;
    }

    div.tagsinput span.tag {
        background: #e8f0fe;
        border: 1px solid #c3dafb;
        color: #3c4043;
        padding: 3px 8px;
        font-size: 12px;
        font-family: Arial, sans-serif;
        line-height: 1.5;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        margin: 2px;
    }

    div.tagsinput span.tag a {
        margin-left: 8px;
        text-decoration: none;
        color: #666;
    }

    div.tagsinput span.tag a:hover {
        color: #333;
    }

    .removeTag:hover {
        background: red;
        color: white;
        border-color: red;
    }

    .border,
    .loader-demo-box {
        border: none !important;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 1000;
    }

    /* Centered loader styles */
    .loader-demo-box {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* Add any additional styling for your loader-demo-box here */
        z-index: 1001;
        /* Ensure the loader is above the overlay */
    }
</style>

<div class="misloader"></div>
<script src="<?php echo $base_url; ?>/assets/js/jquery-3.7.min.js"></script>

<form id="form" method="POST">
    <div class="row">
        <div class="col-sm-9 grid-margin">
            <input type="hidden" name="call_type" id="call_type" class="form-control" value="Service">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 grid-margin">
                            <label for="ATMID">ATMID</label>
                            <input type="text" id="atmid" class="form-control" list="atmidOptions" name="atmid" placeholder="Enter ATMID ..." />
                            <datalist id="atmidOptions"></datalist>
                        </div>
<div class="col-sm-3 grid-margin">
    <label>Component</label>
    <select name="comp" id="comp" class="form-control" required>
        <option value="">Select</option>
        <?php
        $component_query = "SELECT id, name FROM mis_component WHERE status = 1";
        $component_result = mysqli_query($con, $component_query);
        while ($component_row = mysqli_fetch_assoc($component_result)) {
            echo "<option value='".$component_row['id']."'>".$component_row['name']."</option>";
        }
        ?>
    </select>
</div>
<div class="col-sm-6 grid-margin">
    <label>Sub-Component</label>
    <select name="subcomp" id="subcomp" class="form-control" required>
        <option value="">Select Sub-Component</option>
    </select>
</div>
                        <div class="col-sm-3 grid-margin">
                            <label>Call Type</label>
                            <select class="form-control" name="call_receive" id="call_receive" reuqired>
                                <option value="">Select</option>
                                <option value="Customer / Bank">Customer / Bank</option>
                                <option value="Internal">Internal</option>
                            </select>
                        </div>
                        
                        
                      <div class="col-sm-12 grid-margin">
    <label for="callby">Call Receive From</label>
    <div class="input-group">
        <select name="callby" id="callby" class="form-control" required onchange="toggleCustomInput()">
            <option value="">--Select--</option>
            <?php
            $engsql_all = mysqli_query($con, "SELECT * FROM user WHERE user_status=1 ORDER BY name ASC");
            while ($engsql_all_result = mysqli_fetch_assoc($engsql_all)) {
            ?>
                <option value="<?php echo $engsql_all_result['userid']; ?>"><?php echo $engsql_all_result['name']; ?></option>
            <?php } ?>
            <option value="custom">Other...</option>
        </select>
        <input type="text" name="custom_callby" id="custom_callby" class="form-control" style="display:none;" placeholder="Enter custom name" />
    </div>
</div>

<script>
    function toggleCustomInput() {
        var select = document.getElementById('callby');
        var customInput = document.getElementById('custom_callby');
        if (select.value === 'custom') {
            customInput.style.display = 'inline';
        } else {
            customInput.style.display = 'none';
        }
    }
</script>

                        
                        

                        <div class="col-sm-12 grid-margin">
                            <label for="">Remark</label>
                            <textarea name="remark" id="remark" class="form-control" rows="10" required></textarea>
                        </div>




    <div class="col-sm-12 grid-margin">
        <label for="team_type">Team Type</label>
        <select name="team_type" id="team_type" class="form-control" required onchange="handleTeamChange()">
            <option value="">--Select Team Type--</option>
            <option value="technician">Technician</option>
            <option value="vendor">Vendor</option>
        </select>
    </div>

    <!-- Technician Dropdown -->
    <div class="col-sm-12 grid-margin" id="technician_div" style="display:none;">
        <label for="engineer">Technician</label>
        <select name="engineer" id="engineer" class="form-control" required>
            <option value="">--Select Technician--</option>
            <?php
            // Fetch technician data from the database
            $engsql = mysqli_query($con, "SELECT * FROM user WHERE level=3 AND user_status=1 ORDER BY name ASC");
            while ($engsql_result = mysqli_fetch_assoc($engsql)) {
                ?>
                <option value="<?php echo $engsql_result['name']; ?>" data-mobile="<?php echo $engsql_result['contact']; ?>">
                    <?php echo $engsql_result['name']; ?>
                </option>
            <?php } ?>
        </select>
        <input type="text" name="tech_mobile" id="tech_mobile" class="form-control" placeholder="Mobile Number" readonly>
    </div>

    <!-- Vendor Inputs -->
    <div class="col-sm-12 grid-margin" id="vendor_div" style="display:none;">
        <label for="vendor_name">Vendor Name</label>
        <input type="text" name="vendor_name" id="vendor_name" class="form-control" placeholder="Enter Vendor Name" required>

        <label for="vendor_number">Vendor Number</label>
        <input type="text" name="vendor_number" id="vendor_number" class="form-control" placeholder="Enter Vendor Number" required>
    </div>
    
    
    <script>
        function handleTeamChange() {
        var teamType = document.getElementById('team_type').value;
        var technicianDiv = document.getElementById('technician_div');
        var vendorDiv = document.getElementById('vendor_div');
        
        if (teamType === 'technician') {
            technicianDiv.style.display = 'block';
            vendorDiv.style.display = 'none';
        } else if (teamType === 'vendor') {
            technicianDiv.style.display = 'none';
            vendorDiv.style.display = 'block';
        } else {
            technicianDiv.style.display = 'none';
            vendorDiv.style.display = 'none';
        }
    }

    // Display mobile number when a technician is selected
    document.getElementById('engineer').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var mobileNumber = selectedOption.getAttribute('data-mobile');
        document.getElementById('tech_mobile').value = mobileNumber ? mobileNumber : '';
    });
    </script>
    
    
                     



                    </div>
                </div>
            </div>
            <br>


        </div>
        <div class="col-sm-3 grid-margin">
            <div class="card readonly-div" id="atminfo">
                <div class="card-body">
                    <span id="addContactLink" data-bs-toggle="modal" class="history-link requester-and-cc-link" data-bs-target="#historyModal" class="requester-and-cc" style="cursor:pointer;">View Previous
                        History</span>
                    <hr />

                    <div class="row">

                        <div class="col-sm-12">
                            <label class="label_label">Bank</label>
                            <input type="text" name="bank" id="bank" class="form-control">
                        </div>

                        <div class="col-sm-12">
                            <label>Customer</label>
                            <select class="form-control" id="customer" name="customer" required>
                                <option value="">Select Customer</option>
                                <?php $con_sql = mysqli_query($con, "select distinct(client) as customer from sitesmaster where status='Live'");
                                while ($con_sql_result = mysqli_fetch_assoc($con_sql)) { ?>
                                    <option value="<?php echo strtoupper($con_sql_result['customer']); ?>">
                                        <?php echo strtoupper($con_sql_result['customer']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label class="label_label">Region</label>
                            <input class="form-control" type="text" name="region" id="region" value="<?php echo $region; ?>">
                        </div>

                        <div class="col-sm-12">
                            <label class="label_label">City</label>
                            <input class="form-control" type="text" name="city" id="city" value="<?php echo $city; ?>" required>
                        </div>

                        <div class="col-sm-12">
                            <label class="label_label">State</label>
                            <select name="state" id="state" class="form-control" required>
                                <option value="">Select State</option>
                                <?php
                                $state_sql = mysqli_query($con, "select distinct(state) as state from sitesmaster where status='Live'");
                                while ($state_sql_result = mysqli_fetch_assoc($state_sql)) { ?>
                                    <option value="<?php echo $state_sql_result['state']; ?>" <?php if ($state == $state_sql_result['state']) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
                                        <?php echo $state_sql_result['state']; ?>
                                    </option>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="col-sm-12">
                            <label class="label_label">Locations</label>
                            <input class="form-control" type="text" name="location" id="location" value="<?php echo $location; ?>">
                        </div>

                    </div>
                </div>
            </div>





        </div>
    </div>

    <div class="modal__footer form-submission create-ticket-footer" data-identifyelement="422">

        <div class="form-submission__actions" data-identifyelement="431">
            <button name="button" class="modal__footer__btn btn btn--secondary" type="button">
                Cancel
            </button>
            <button type="button" id="saveButton" class="btn btn-primary"> Create Call
            </button>
        </div>
    </div>

</form>


<div class="modal fade" id="emailContactModal" tabindex="-1" aria-labelledby="ModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="" id="emailContactForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Add new contact</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-sm-12">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="">Company</label>
                            <input type="text" name="company" class="form-control" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="">Contact</label>
                            <input type="number" name="contact" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary">
                </div>

            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="ModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md" style="max-width:1000px;" role="document">
        <div class="modal-content" id="show_history">


        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#comp').on('change', function() {
        var component_id = $(this).val();
        if(component_id) {
            $.ajax({
                url: "fetch_subcomponents.php",
                method: "POST",
                data: {component_id: component_id},
                dataType: "json",
                success: function(data) {
                    $('#subcomp').html('<option value="">Select Sub-Component</option>');
                    $.each(data, function(key, value) {
                        $('#subcomp').append('<option value="'+value.name+'">'+value.name+'</option>');
                    });
                }
            });
        } else {
            $('#subcomp').html('<option value="">Select Sub-Component</option>');
        }
    });
});
</script>



<script>



    $(document).ready(function() {
        $("#atmid").focus();


        function checkOpenCall(atmid) {
            $.ajax({
                type: "POST",
                url: 'check_open_call.php',
                data: {
                    atmid: atmid
                },
                success: function(response) {
                    var latestid = response.openCall;
                    if (response.openCall) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Open Call Exists',
                            html: `An open call already exists for this ATM ID. <br><a href="viewticket.php?ticket=${latestid}">Click here</a> for more details.`,
                            confirmButtonText: 'OK'
                        }).then(function() {
                            // Reset the form
                            window.location.reload();
                            // $("#form")[0].reset();
                        });
                    }
                }
            });
        }

        $("#atmid").on('blur', function() {
            var atmid = $(this).val();
            if (atmid !== "") {
                checkOpenCall(atmid);
            }
        });


    });


    $(document).ready(function() {
        function populateATMData(atmid) {
            $.ajax({
                type: "POST",
                url: 'get_atm_data.php',
                data: 'atmid=' + atmid,
                success: function(msg) {
                    // console.log(msg);

                    if (msg != 0) {
                        var obj = JSON.parse(msg);
                        var fields = ['customer', 'bank', 'engineer', 'location', 'region', 'state', 'city', 'branch'];

                        fields.forEach(function(field) {
                            if (!obj[field]) {
                                $("#" + field).focus();
                            } else {
                                $("#" + field).val(obj[field]);
                                $('#' + field).attr('readonly', true);
                            }
                        });

                        if (obj.customer && obj.bank && obj.location && obj.region && obj.state && obj.city && obj.branch) {
                            $("#call_receive").focus();
                        }
                        $("#comp").focus();
                        $(".card").removeClass('readonly-div');
                        //populateToemails(obj.lho);
                        //populateCcemails(obj.lho);

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No Info With This ATM',
                        }).then(function() {
                            // Reset the form
                            $("#form")[0].reset();

                        });

                    }
                }
            });

            $.ajax({
                type: "POST",
                url: 'show_history.php',
                data: 'atmid=' + atmid,
                success: function(msg) {
                    $("#show_history").html(msg);
                }
            });
        }








        $("#atmid").on('input', function() {
            var input = $(this).val();

            $.ajax({
                type: "POST",
                url: 'get_suggestions.php',
                data: {
                    input: input
                },
                success: function(response) {
                    // console.log(response)
                    var datalist = $("#atmidOptions");
                    datalist.empty();

                    var suggestions = JSON.parse(response);

                    suggestions.forEach(function(suggestion) {
                        datalist.append($("<option>").attr('value', suggestion).text(suggestion));
                    });
                }
            });
        });

        $("#atmid").on('change', function() {
            var atmid = $(this).val();
            populateATMData(atmid);

            $("#atminfo").css('display', 'block');

        });
    });

    $("#saveButton").on('click', function() {

        // return ;
        var atmid = $("#atmid").val();
        var remarkField = document.getElementById('remark').value.trim();


        var engineer = $("#engineer").val();
        // var subject = $("#subject").val();
        var comp = $("#comp").val();
        var subcomp = $("#subcomp").val();
        var call_receive = $("#call_receive").val();

        var fieldsToHighlight = [];

        if (atmid == "") {
            fieldsToHighlight.push("#atmid");
        } else {
            // Remove the element from the array if it was previously added
            var index = fieldsToHighlight.indexOf("#atmid");
            if (index !== -1) {
                fieldsToHighlight.splice(index, 1);
            }
            $("#atmid").removeClass('chighlight');
        }


       


        if (comp == "") {
            fieldsToHighlight.push("#comp");
        } else {
            // Remove the element from the array if it was previously added
            var index = fieldsToHighlight.indexOf("#comp");
            if (index !== -1) {
                fieldsToHighlight.splice(index, 1);
            }
            $("#comp").removeClass('chighlight');
        }

        if (subcomp == "") {
            fieldsToHighlight.push("#subcomp");
        } else {
            // Remove the element from the array if it was previously added
            var index = fieldsToHighlight.indexOf("#subcomp");
            if (index !== -1) {
                fieldsToHighlight.splice(index, 1);
            }
            $("#subcomp").removeClass('chighlight');
        }

        if (call_receive == "") {
            fieldsToHighlight.push("#call_receive");
        } else {
            // Remove the element from the array if it was previously added
            var index = fieldsToHighlight.indexOf("#call_receive");
            if (index !== -1) {
                fieldsToHighlight.splice(index, 1);

            }
            $("#call_receive").removeClass('chighlight');
        }

        if (remarkField == "") {
            fieldsToHighlight.push("#remark");
        } else {
            // Remove the element from the array if it was previously added
            var index = fieldsToHighlight.indexOf("#remark");
            if (index !== -1) {
                fieldsToHighlight.splice(index, 1);
            }
            $("#remark").removeClass('chighlight');

        }



        if (fieldsToHighlight.length > 0) {
            fieldsToHighlight.forEach(function(fieldId) {
                // console.log(fieldId);
                $(fieldId).addClass("chighlight");
            });

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please fill in all required fields.'
            });

            return false; // Prevent form submission
        } else {
            $(".misloader").html(` <div class="overlay"></div>
    <div class="loader-demo-box">
        <div class="jumping-dots-loader">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>`);

            $(".chighlight").removeClass("chighlight");

            var formData = $("#form").serialize();
            // formData.append('emailbody', editorData);


            $.ajax({
                type: "POST",
                url: './process_addMis.php', // Replace with your PHP script to save form data
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(function() {
                            window.location.reload();
                        });
                    } else {
                        // Show error message using SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Show error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while saving the form data.'
                    });
                },
                complete: function() {
                    // This block will be executed after success or error
                    $(".misloader").html('');
                }
            });
        }

    });










    $(document).ready(function() {
        // Triggered when the form is submitted
        $('#emailContactForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting in the traditional way

            // Get form data
            var formData = {
                name: $('input[name="name"]').val(),
                email: $('input[name="email"]').val(),
                company: $('input[name="company"]').val(),
                contact: $('input[name="contact"]').val()
            };

            // Make AJAX request
            $.ajax({
                type: 'POST',
                url: './saveEmailContact.php',
                data: formData,
                success: function(response) {
                    // console.log(response)
                    if (response == 1) {
                        $('#emailContactModal').modal('hide');

                        // Success alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Contact added successfully!',
                            onClose: function() {
                                // Close the modal
                                $('#emailContactModal').modal('hide');
                            }
                        });
                    } else {
                        // Error alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to add contact. Please try again.'
                        });
                    }
                },
                error: function() {
                    // Error alert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to communicate with the server. Please try again later.'
                    });
                }
            });
        });
    });


    function removeTag(tag) {
        event.preventDefault();
        var tagText = $(tag).prev().text(); // Get the email address from the previous span element
        $(tag).parent().remove();

        // Remove the corresponding email address from the hidden input value
        var currentEmails = $('#toemailtoSendVal').val().split(',');
        var updatedEmails = currentEmails.filter(function(email) {
            return email.trim() !== tagText.trim();
        });
        $('#toemailtoSendVal').val(updatedEmails.join(','));
    }


    function removeTagCc(tag) {
        event.preventDefault();
        var tagText = $(tag).prev().text(); // Get the email address from the previous span element
        $(tag).parent().remove();

        // Remove the corresponding email address from the hidden input value
        var currentEmails = $('#ccemailtoSendVal').val().split(',');
        var updatedEmails = currentEmails.filter(function(email) {
            return email.trim() !== tagText.trim();
        });
        $('#ccemailtoSendVal').val(updatedEmails.join(','));
    }
</script>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



<?php include('../footer.php'); ?>