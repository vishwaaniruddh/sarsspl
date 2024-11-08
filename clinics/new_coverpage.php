<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice Range Selection</title>
    <style>
        body {
            background-color: #CCCCCC;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            margin-top: 50px;
        }

        .form-table {
            margin: 0 auto;
            width: 40%;
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-table td {
            padding: 10px;
        }

        .form-table input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-table input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #FFFFFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-table input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Select Range of Invoice to Print Cover Page</h2>
        <form action="consolidatednew.php" method="post">
            <table class="form-table">
                <tr>
                    <td><label for="from">From</label></td>
                    <td><input type="date" id="from" name="from" required /></td>
                    <td><label for="to">To</label></td>
                    <td><input type="date" id="to" name="to" required /></td>
                    <td><input type="submit" value="Submit" /></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>