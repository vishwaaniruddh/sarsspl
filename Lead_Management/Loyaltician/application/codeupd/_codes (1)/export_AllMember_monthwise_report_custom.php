<?php
include ('config.php');
$sqlme = $_POST['qr'];
$sqlme = $sqlme;//.' limit 400';
function get_member_details($parameter, $id)
{
    global $conn;



    $sql = mysqli_query($conn, "SELECT * FROM `Members`,`RenewalMembersDetails` where Members.Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and Members.Static_LeadID = RenewalMembersDetails.Static_LeadID and Members.Static_LeadID='" . $id . "'");

    $sql_result = mysqli_fetch_assoc($sql);

    if ($sql_result) {
        return $sql_result[$parameter];
    } else {
        return false;
    }

}


function get_leadsource_name($id)
{
    global $conn;

    $sql = mysqli_query($conn, "select * from Lead_Sources where SourceId='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['Name'];
}


$table = mysqli_query($conn, $sqlme);

$contents = '';
$contents .= "Srno \t MEMBER_ID \t FIRSTNAME \t LASTNAME \t Level \t ExpiryDate \t MOBILENUMBER \t PRIMARYMAIL \t COMPANY \t DESIGNATION \t Primary_mob2 \t Primary_BuldNo_addrss \t Primary_Area_addrss \t Primary_Landmark_addrss \t MembershipDts_GrossTotal \t MembershipDts_PaymentMode \t booklet_Series \t entryDate \t Sales Associate \t ";

$cnt = 0;

while ($_row = mysqli_fetch_array($table)) {
    $cnt++;


    $sql4 = "SELECT Expiry_month FROM `validity` where Leval_id='" . $_row['MembershipDetails_Level'] . "' ";
    $runsql4 = mysqli_query($conn, $sql4);
    $sql4fetch = mysqli_fetch_array($runsql4);



    if ($_row['MembershipDetails_Level'] == "1") {
        $lev = "Orchid First";
    } else if ($_row['MembershipDetails_Level'] == "2") {
        $lev = "Orchid Gold";
    } else if ($_row['MembershipDetails_Level'] == "3") {
        $lev = "Orchid Platinum";
    }

    $dd = date('Y-m-d', strtotime($_row['entryDate']));
    $exm = "";
    $exm = $sql4fetch['Expiry_month'];

    if (date('d', strtotime($_row['entryDate'])) >= "25") {
        if (date("Y-m-d") >= "2019-11-25") {
            $exm += 1;
        }
    }

    $d = strtotime("+" . $exm . " months", strtotime($dd));
    $expiryDt = date("M-Y", $d);


    $birth = $_row['Primary_DateOfBirth'];
    $birthDt = date("d-M", strtotime($birth));

    $Anniver = $_row['Primary_Anniversary'];
    $AnniverDt = date("d-M", strtotime($Anniver));


    if ($_row['Spouse_DateOfBirth'] == "0000-00-00") {
        $Spouse_DateOfBirth = "00-00-0000";
    } else {
        $Spouse_DateOfBirth = date('d-m-Y', strtotime($_row[17]));
    }

    if ($_row['MembershipDts_PaymentDate'] == "0000-00-00") {
        $MembershipDts_PaymentDate = "00-00-0000";
    } else {
        $MembershipDts_PaymentDate = date('d-m-Y', strtotime($_row[22]));
    }

    if ($_row['entryDate'] == "0000-00-00") {
        $entryDate = "00-00-0000";
    } else {
        $entryDate = date('d-m-Y', strtotime($_row['entryDate']));
    }







    $member_id = $_row['GenerateMember_Id'];

    $sales_sql = mysqli_query($conn, "select Static_LeadID from Members where GenerateMember_Id = '" . $member_id . "'");
    $sales_sql_result = mysqli_fetch_assoc($sales_sql);
    $static_leadid = $sales_sql_result['Static_LeadID'];

    $LeadDelegation_sql = mysqli_query($conn, "select * from LeadDelegation where LeadId='" . $static_leadid . "'");
    $LeadDelegation_sql_result = mysqli_fetch_assoc($LeadDelegation_sql);
    $SalesmanId = $LeadDelegation_sql_result['SalesmanId'];

    $SalesAssociate_sql = mysqli_query($conn, "select * from SalesAssociate where SalesmanId='" . $SalesmanId . "'");
    $SalesAssociate_sql_result = mysqli_fetch_assoc($SalesAssociate_sql);
    $sales_associate_name = $SalesAssociate_sql_result['FirstName'] . ' ' . $SalesAssociate_sql_result['LastName'];




    if (get_member_details('NewGenerateMember_Id', $static_leadid) > 0) {
        $type = 'Renew';
    } elseif ($_row['canceledMember'] == 1) {
        $type = 'Cancel';
    } else {
        $type = 'New';
    }


    $contents .= "\n" . $cnt . "\t";
    $contents .= $_row['GenerateMember_Id'] . "\t";
    $contents .= $_row['FirstName'] . "\t";
    $contents .= $_row['LastName'] . "\t";
    $contents .= $lev . "\t";
    $contents .= $expiryDt . "\t";
    $contents .= $_row['MobileNumber'] . "\t";

    $contents .= $_row['EmailId'] . "\t";
    $contents .= $_row['Company'] . "\t";
    $contents .= $_row['Designation'] . "\t";

    $contents .= $_row['Primary_mob2'] . "\t";
    $contents .= $_row['Primary_BuldNo_addrss'] . "\t";
    $contents .= $_row['Primary_Area_addrss'] . "\t";
    $contents .= $_row['Primary_Landmark_addrss'] . "\t";
    $contents .= $_row['MembershipDts_GrossTotal'] . "\t";

    $contents .= $_row['MembershipDts_PaymentMode'] . "\t";
    $contents .= $_row['booklet_Series'] . "\t";
    $contents .= $_row['entryDate'] . "\t";
    $contents .= $sales_associate_name . "\t";

}

$contents = strip_tags($contents);

header("Content-Disposition: attachment; filename=mis.xls");
header("Content-Type: application/vnd.ms-excel");
print $contents;

?>