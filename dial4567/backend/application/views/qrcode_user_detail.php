
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QR Detail</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <style>
            .div_title {
                font-size: 12px;
            }
            .div_border {
                border:1px solid grey;
                padding: 5px;
                padding-left: 10px;
                font-weight:bold;
            }
            .code_img {
                box-shadow: 1px 1px 10px 2px gray;
            }
        </style>
    </head>
    <body>

        <header>
            <div class="container mt-3 text-center">
                <div class=" ">
                    <img src="<?php echo $captain_india_logo; ?>" width="100px" />
                </div>
                <!--<div class="mt-3">-->
                <!--    <h4 >Primary Information</h4>-->
                <!--</div>-->
            </div>
        </header>
        <?php if ($result['user_id'] != null) { ?>
        <div class="container mt-3">
            <div class="row mb-3">
                <div class="col-xs-4 col-sm-12 col-md-6 col-lg-8 col-xl-12">
                    <div class=" text-center">
                        <b >Primary Information</b>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-xs-2 col-sm-6 col-md-3 col-lg-4 col-xl-6  mt-2  mb-2 pr-2">
                    <div class="text-right pr-5">
                        <?php if ($result['image_path'] != null) { ?>
                            <img src="<?php echo $result['image_path']; ?>" width="200px" class="code_img" />
                        <?php } ?>
                    </div>
                    <?php if ($result['missing_status'] == '2') { ?>
                        <div class="text-right pr-5 mt-4">
                            <img src="<?php echo $missing_status; ?>" width="200px" class=" " />
                        </div>
                    <?php } ?>
                </div>
                <div class="col-xs-2 col-sm-6 col-md-3 col-lg-4 col-xl-6">
                    <div class=" ">

                        <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                            <div class="div_title">Code</div>
                            <div class=" div_border">
                                <?php echo $result['code']; ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                            <div class="div_title">Type</div>
                            <div class=" div_border">
                                <?php echo $result['type_title']; ?>
                            </div>
                        </div>

                        <?php if ($result['type'] == '1') { ?>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Name of user</div>
                                <div class=" div_border">
                                    <?php echo $result['first_name'] . " " . $result['last_name']; ?>
                                </div>
                            </div>
                        
                                <?php if ($result['blood_group'] != null) { ?>
                                    <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                        <div class="div_title">Blood group</div>
                                        <div class=" div_border">
                                            <?php echo $result['blood_group']; ?>
                                        </div>
                                    </div>
                                <?php } ?>

                            <?php if ($result['email'] != null) { ?>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Email</div>
                                <div class=" div_border">
                                    <?php echo $result['email']; ?>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Mobile no</div>
                                <div class=" div_border">
                                    <?php echo $result['mobile_no']; ?>
                                </div>
                            </div>
                              <div id="div_contact">

                                </div>

                            <?php if (!empty($result['emergency_contacts'])) { ?>
                                <div class="col-md-4 col-lg-8 col-xl-12  ">
                                    <div class="div_title">Emergency contacts</div>
                                </div>
                            <?php } ?>

                        <div>
                            <?php if (!empty($result['emergency_contacts'])) { ?>
                                <div class="col-md-4 col-lg-8 col-xl-12"><div class="div_title">Emergency contacts</div></div>
                                    <?php foreach ($result['emergency_contacts'] as $row) { ?>
                                        <div class="col-md-4 col-lg-8 col-xl-12 mb-2"><div class="div_title"></div>
                                            <div class=" div_border">
                                                <?php echo $row['name'] . " - " . $row['mobile_no']; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php } else { ?>
                                        <div class="col-md-4 col-lg-8 col-xl-12"><div >There is no emergency contacts.</div></div>
                                    <?php } ?>
                        <?php } ?>
                                </div>

                        <?php if ($result['type'] == '2') { ?>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Name of animal</div>
                                <div class=" div_border">
                                    <?php echo $result['name']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Color</div>
                                <div class=" div_border">
                                    <?php echo $result['color']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Description</div>
                                <div class=" div_border">
                                    <?php echo $result['description']; ?>
                                </div>
                            </div>
                        
                        <?php } ?>

                        <?php if ($result['type'] == '3') { ?>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Name of animal</div>
                                <div class=" div_border">
                                    <?php echo $result['name']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Device name</div>
                                <div class=" div_border">
                                    <?php echo $result['device_name']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Model number</div>
                                <div class=" div_border">
                                    <?php echo $result['model_number']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Serial number</div>
                                <div class=" div_border">
                                    <?php echo $result['serial_number']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Color</div>
                                <div class=" div_border">
                                    <?php echo $result['color']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Description</div>
                                <div class=" div_border">
                                    <?php echo $result['description']; ?>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
             <?php } else { ?>
            <div class="container mt-3">
                <div class="row mb-3">
                    <div class="col-xs-4 col-sm-12 col-md-6 col-lg-8 col-xl-12">
                        <div class=" text-center">
                            <b >QR Code is not linked.</b>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    <br/><br/><br/><br/>

        <footer>
            <div class="container">
                <p>
                <div class="text-center">
                    <img src="<?php echo $captain_india_support; ?>" width="50px" />
                </div>
                </p>
                <p>
                <div class="text-center" style="color:grey;">
                    Captain INDIA Customer Support
                </div>
                </p>
            </div>
        </footer>
    </body>
</html>
