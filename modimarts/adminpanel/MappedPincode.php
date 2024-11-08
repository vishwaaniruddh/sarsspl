<?php
include 'config.php';

// 1. Update pincode

function UpdatePincode($pincode, $talukaid)
{
    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_pincode` WHERE pincode='" . $pincode . "'");
    $count      = mysqli_num_rows($pincodesql);
    if ($count) {
        $pindata    = mysqli_fetch_assoc($pincodesql);
        $pincodesql = mysqli_query($con, "UPDATE `new_pincode` SET `taluka`='" . $talukaid . "' WHERE id='" . $pindata['id'] . "'");
        return $pincodesql;
    } else {
        return false;
    }
}

function CheckPincode($pincode)
{
    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_pincode` WHERE pincode='" . $pincode . "' AND taluka=0");
    $count      = mysqli_num_rows($pincodesql);
    if ($count) {

        return true;
    } else {
        return false;
    }
}

// 2. check taluka

function CheckTaluka($taluka)
{
    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_taluka` WHERE taluka='" . $taluka . "'");
    $count      = mysqli_num_rows($pincodesql);
    if ($count) {
        return true;
    } else {
        return false;
    }

}
function getTaluka($taluka)
{
    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_taluka` WHERE taluka='" . $taluka . "'");
    $count      = mysqli_fetch_assoc($pincodesql);

    return $count['id'];

}

// 3. addtaluka

function AddTaluka($taluka, $districtid)
{

    global $con;
    $pincodesql = mysqli_query($con, "INSERT INTO `new_taluka`(`taluka`, `district`, `status`) VALUES ('" . $taluka . "','" . $districtid . "','1')");
    $last_id    = mysqli_insert_id($con);
    return $last_id;

}

// 4. update taluka

function UpdateTaluka($taluka, $districtid)
{
    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_taluka` WHERE taluka='" . $taluka . "'");
    $count      = mysqli_num_rows($pincodesql);
    if ($count) {
        $pindata    = mysqli_fetch_assoc($pincodesql);
        $pincodesql = mysqli_query($con, "UPDATE `new_taluka` SET `district`='" . $districtid . "' WHERE id='" . $pindata['id'] . "'");
        return true;
    } else {
        return false;
    }
}

// 5. check district

function CheckDistrict($district)
{
    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_district` WHERE district LIKE '%" . $district . "%'");
    $count      = mysqli_num_rows($pincodesql);
    if ($count) {
        return true;
    } else {
        return false;
    }

}

function GetDistrict($district)
{
    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_district` WHERE district LIKE '%" . $district . "%'");
    $count      = mysqli_fetch_assoc($pincodesql);
    return $count['id'];

}

// 6. update district

function UpdateDistrict($district, $divisionid)
{
    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_district` WHERE district='" . $district . "'");
    $count      = mysqli_num_rows($pincodesql);
    if ($count) {
        $pindata    = mysqli_fetch_assoc($pincodesql);
        $pincodesql = mysqli_query($con, "UPDATE `new_district` SET `division`='" . $divisionid . "' WHERE id='" . $pindata['id'] . "'");
        return true;
    } else {
        return false;
    }
}

// 7. add district

function AddDistrict($district, $divisionid)
{

    global $con;
    $pincodesql = mysqli_query($con, "INSERT INTO `new_district`(`district`, `division`, `status`) VALUES ('" . $district . "','" . $divisionid . "','1')");
    $last_id    = mysqli_insert_id($con);
    return $last_id;

}

// 8.Check division

function Checkdivision($division)
{

    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_division` WHERE division='" . $division . "'");
    $count      = mysqli_num_rows($pincodesql);
    if ($count) {
        return true;
    } else {
        return false;
    }

}
function CheckState($state)
{

    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_state` WHERE state='" . $state . "' AND status='1'");
    $count      = mysqli_num_rows($pincodesql);
    if ($count) {
        return true;
    } else {
        return false;
    }

}
// 8.get division

function getdivision($division)
{

    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_division` WHERE division='" . $division . "'");
    $count      = mysqli_fetch_assoc($pincodesql);
    return $count['id'];

}
// 8.get division

function GetStateid($state)
{

    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_state` WHERE state='" . $state . "' AND status='1'");
    $count      = mysqli_fetch_assoc($pincodesql);
    return $count['id'];

}

// 8.get division

function UpdateDivision($division, $stateid)
{
    global $con;
    $pincodesql = mysqli_query($con, "SELECT id FROM `new_division` WHERE division='" . $division . "'");
    $count      = mysqli_num_rows($pincodesql);
    if ($count) {
        $pindata    = mysqli_fetch_assoc($pincodesql);
        $pincodesql = mysqli_query($con, "UPDATE `new_division` SET `state`='" . $stateid . "' WHERE id='" . $pindata['id'] . "'");
        return true;
    } else {
        return false;
    }

}
// 9. add division

function AddDivision($division, $stateid)
{
    global $con;
    $pincodesql = mysqli_query($con, "INSERT INTO `new_division`(`division`, `state`, `status`) VALUES ('" . $division . "','" . $stateid . "','1')");
    $last_id    = mysqli_insert_id($con);
    return $last_id;

}

if (isset($_POST['AddPincode'])) {

    $file   = $_FILES['file']['tmp_name'];
    $handle = fopen($file, "r");
    $c      = 0;
    while (($filesop = fgetcsv($handle, 5000, ",")) !== false) {
        $pincode  = trim($filesop[0]);
        $taluka   = trim($filesop[1]);
        $district = trim($filesop[2]);
        $division = trim($filesop[3]);
        $state    = trim($filesop[4]);

        // check Taluka

        if ($taluka == '') {$taluka = $district;}

        $checkPincode = CheckPincode($pincode);

        if ($checkPincode) {
        	echo "Pincode - ".$pincode;
        	echo "<br/>";

            $talukacount = CheckTaluka($taluka);
            echo "Taluka - ".$talukacount;
            echo "<br/>";

            if ($talukacount) {
                $talukaid = getTaluka($taluka);
                $retn     = UpdatePincode($pincode, $talukaid);
                if ($retn) {
                    echo "Update Pincode" . $pincode;
                    echo "<br/>";
                } else {
                    echo "Not Update Pincode" . $pincode;
                    echo "<br/>";
                }

            } else {
                $CheckDistrict = CheckDistrict($district);

                echo "district - ".$district." ".$CheckDistrict;
                echo "<br/>";

                if ($CheckDistrict) {
                    $distid   = GetDistrict($district);
                    $talukaid = AddTaluka($taluka, $distid);
                    $retn     = UpdatePincode($pincode, $talukaid);
                    if ($retn) {
                        echo "Update Pincode" . $pincode;
                        echo "<br/>";
                    } else {
                        echo "Not Update Pincode" . $pincode;
                        echo "<br/>";
                    }
                } else {
                    $checkdivision = Checkdivision($division);
                    if ($checkdivision) {
                        $divisionid = getdivision($division);
                        $districtid = addDistrict($district, $divisionid);
                        // $distid=GetDistrict($district);
                        $addtaluka = AddTaluka($taluka, $districtid);
                        // $talukaid=getTaluka($taluka);
                        $retn = UpdatePincode($pincode, $addtaluka);
                        if ($retn) {
                            echo "Update Pincode" . $pincode;
                            echo "<br/>";
                        } else {
                            echo "Not Update Pincode" . $pincode;
                            echo "<br/>";
                        }

                    }
                    else
                    {
                    	$checkState=CheckState($state);

                    	if($checkState)
                    	{
                    		$getStateId=GetStateid($state);
                    		$division_id= AddDivision($division,$getStateId);
                    		$districtid = addDistrict($district, $division_id);
                        // $distid=GetDistrict($district);
                        $addtaluka = AddTaluka($taluka, $districtid);
                        // $talukaid=getTaluka($taluka);
                        $retn = UpdatePincode($pincode, $addtaluka);
                        if ($retn) {
                            echo "Update Pincode" . $pincode;
                            echo "<br/>";
                        } else {
                            echo "Not Update Pincode" . $pincode;
                            echo "<br/>";
                        }


                    	}
                    }
                }
            }
        }

        $c = $c + 1;
    }

}
?>

 <!DOCTYPE html>
<html>
<body>
<form enctype="multipart/form-data" method="post" role="form">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="file" id="file" size="150">
        <input type="hidden" name="AddPincode">
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>
    <button type="submit" class="btn btn-default" name="submit" value="submit">Upload</button>
</form>
</body>
</html>
