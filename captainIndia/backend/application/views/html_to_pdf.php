<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        <style>
            body {
                position: relative;
                height: 100vh;
                font-family: 'Open Sans', sans-serif;
            }
            header {
                width: 100%;
            }
            .logo {
                text-align: center;
                padding: 20px 0px 10px 0px;
                border-bottom: 1px solid #eee;
            }
            .logo_img{
                width:100px;
                height:100px;
            }
            footer {
                position: absolute;
                bottom: 0px;
                width: 100%;
                border-top: 1px solid #eee;
            }
            .footer {
                text-align: center;
                color: #999;
            }
            .border_bottom {
                border-bottom: 1px solid #eee;
                padding-bottom: 5px;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="logo">
                <img src="../img/captain_india_pdf.png" class="logo_img" alt="">
            </div>
        </header>
        <div>
            <div class="col-md-12 col-lg-12 border_bottom">
                <h3>User Detail</h3>
                <div style="float: left; margin: 2px;position: relative;">
                    <b>Name: </b><?php echo $user_evidence['first_name'] . " " . $user_evidence['last_name']; ?>
                    <br/>
                    <b>Email: </b><?php echo $user_evidence['email']; ?>
                    <br/>
                    <b>Mobile No: </b><?php echo $user_evidence['mobile_no']; ?>
                    <br/>
                    <b>Lattitude: </b><?php echo $user_evidence['user_lat']; ?>
                    <br/>
                    <b>Logitude: </b><?php echo $user_evidence['user_long']; ?>
                    <br/>
                    <b>Gender: </b><?php echo $user_evidence['gender']; ?>
                    <br/>
                    <b>Blood Group: </b><?php echo $user_evidence['blood_group']; ?>
                    <br/>
                    <b>Critical Illness: </b><?php echo $user_evidence['critical_illness_value']; ?>
                    <br/>
                    <b>Date/Time: </b><?php echo $user_evidence['created_at']; ?>
                    <br/>
                </div>
            </div>

            <?php if($content_type !=4) { ?>
            <div class="col-md-12 col-lg-12 border_bottom">
                <h3>Images</h3>
                <?php foreach ($img_result as $row) { ?>
                    <div style="float: left; margin: 2px;position: relative;">
                        <img src="<?php echo $row['thumbnail']; ?>" alt=""  style="cursor: pointer; width: 271px; height: 180px; margin-left: 0px; margin-top: 0px;">
                        <br/>
                        <br/>
                        <a href="<?php echo $row['thumbnail']; ?>"><?php echo $row['thumbnail']; ?></a>
                        <br/>
                        <br/>
                    </div>
                <?php } ?>
            </div>

            <div class="col-md-12 col-lg-12 border_bottom">
                <h3>Videos</h3>
                <?php foreach ($video_result as $row) { ?>
                    <div style="float: left; margin: 2px;position: relative;">
                        <a href="<?php echo $row['src']; ?>"><?php echo $row['src']; ?></a>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-12 col-lg-12 border_bottom">
                <h3>Audio</h3>
                <?php foreach ($audio_result as $row) { ?>
                    <div style="float: left; margin: 2px;position: relative;">
                        <a href="<?php echo $row['src']; ?>"><?php echo $row['src']; ?></a>
                    </div>
                <?php } ?>
            </div>
            <?php } ?>
            <div class="col-md-12 col-lg-12">
                <h3>Emergency Contacts</h3>
                <?php
                $ct = 1;
                foreach ($contact_result as $row) {
                    ?>
                    <div style="float: left; margin: 2px;position: relative;">
                        <?php echo $ct . ". " . $row['first_name'] . " " . $row['last_name'] . " | " . 'Mobile No: ' . $row['mobile_no']; ?>
                    </div>
                    <?php
                    $ct++;
                }
                ?>
            </div>
        </div>
        <!--        <footer>
                    <div class="footer">
                        <p>Page Number</p>
                    </div>
                </footer>-->
    </body>
</html>