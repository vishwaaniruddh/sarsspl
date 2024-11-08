<?php 

//connect to the database
//$connect = mysqli_connect("localhost","kevalj_cncindi","Satya1234sar56");
//mysqli_select_db("kevalj_cncindia",$connect); //select the table
//
include("config.php");
if ($_FILES['csv']['size'] > 0) {

    //get the csv file
    $file = $_FILES['csv']['tmp_name'];
    $handle = fopen($file,"r");
    echo "<table>";
    //loop through the csv file and insert into database
    do {
        if ($data[0]) {
        $city=explode("/",addslashes($data[2]));
        for($i=0;$i<count($city);$i++){
           $qr= mysqli_query($con,"INSERT INTO `csslocalbranch`(`state`, `csslocalbranch`, `area`, `supervisor`) VALUES('".trim(addslashes($data[0]))."','".trim(addslashes($data[1]))."','".trim($city[$i])."','".trim(addslashes($data[3]))."')");
           if($qr)
           echo mysqli_error();
           // echo "<tr><td>".trim(addslashes($data[0]))."</td><td>".trim(addslashes($data[1]))."</td><td>".trim(addslashes($city[$i]))."</td><td>".trim(addslashes($data[3]))."</td></tr>";
            }
        }
    } while ($data = fgetcsv($handle,1000,",","'"));
    //
echo "</table>";
    //redirect
    header('Location: import.php?success=1'); die;

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Import a CSV File with PHP & MySQL</title>
</head>

<body>

<?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?>

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  Choose your file: <br />
  <input name="csv" type="file" id="csv" />
  <input type="submit" name="Submit" value="Submit" />
</form>

</body>
</html> 