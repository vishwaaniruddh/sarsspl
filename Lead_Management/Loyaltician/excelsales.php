<?php
session_start();

include ('config.php');
$check = $_POST['check'];
$_SESSION["delvalue"] = $check;
//print_r($check);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>excel upload</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css"
        href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CRoboto+Slab:400,300,700">
    <link rel="stylesheet" href="css/sig.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        .rounded {
            border-radius: 20px;
            height: 40px;
        }
    </style>

    <style>
        .busy * {
            cursor: wait !important;
        }

        .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .button2 {
            .button {
                background-color: #FBBA00;
                border: none;
                color: white;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                -webkit-transition-duration: 0.4s;
                /* Safari */
                transition-duration: 0.4s;
                cursor: pointer;
            }
        }

        .button1 {
            background-color: #FBBA00;
            color: #fff;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
            font-size: 22px;
            padding: 8px 10px;
        }




        /* unvisited link */
        .test2:link {
            color: #5B5B5B;
            text-decoration: none;
        }
        }

        /* visited link */
        .test2:visited {
            color: #5B5B5B;
        }

        /* mouse over link */
        .test2:hover {
            color: #00A0E3;
            text-decoration: underline;
        }

        /* selected link */
        .test2:active {
            color: #5B5B5B;
        }

        .col-md-6 {
            width: 33%;
        }

        .col-md-offset-3 {
            margin-left: 34%;
        }
    </style>


    <script>
        function validate(form) {
            with (form) {


                if (userfile.value.length < 1) {
                    alert("You Forgot to select an *.xls File to Import");
                    return false;
                }
            }
            return true;
        }
    </script>

</head>

<body>
    <?php include 'menu.php' ?>

    <div class="row" style="margin-right:0px;">
        <div class="col-md-12" style="
    right: 15px;
">

            <div class="row" style="margin-top:2%;">
                <div class="col-md-6 col-md-offset-3" style="border: 1px solid #bfbfbf;">
                    <h1>Upload Employee Details </h1>

                    <fieldset>

                        <form action="excelsales_process.php" method="post" enctype="multipart/form-data"
                            onSubmit="return validate(this)" name="form">

                            <table>
                                <tr>
                                    <td width="432" height="35"><b>Upload Excel: <a href="Excel/addsales.xls"
                                                download>Download format </a></b></td>
                                </tr>
                                <tr>
                                    <label>
                                        <td width="432" height="35"><b>Select *.xls File to Import :</b>
                                            <input type="file" name="userfile" value="" id="userfile" />
                                        </td>
                                    </label>
                                </tr>

                                <tr>

                                </tr>

                                <center>
                                    <tr>
                                        <td height="35" colspan="2"><input type="submit" value="submit"
                                                style="border-radius: 50px;width: 206px;height: 37px;background-color: #fbba00;" />
                                        </td>
                                    </tr>
                                </center></br>
                            </table>

                        </form>

                        <!--<center>
<button type="button" onclick="validation()" style="border-radius: 50px;width: 206px;height: 37px;background-color: #fbba00;">Submit</button>
</center></br>-->


                        </form>

                </div>
            </div>

        </div>
    </div>


</body>

</html>
<?php //echo $abc; ?>