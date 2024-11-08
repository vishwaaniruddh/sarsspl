<?php session_start();
ini_set('memory_limit', '-1');
include ('config.php');

$Lead = $_POST['Lead'];
$Status = $_POST['Status'];
$Leadid = $_POST['Leadfilter'];
$LeadDelegated = $_POST['LeadDelegated'];
$fromDt = $_POST['fromDt'];
$ToDt = $_POST['ToDt'];
$fromdate = date("Y-m-d", strtotime($fromDt));
$todate = date("Y-m-d", strtotime($ToDt));



if ($_SESSION['usertype'] == 'Admin' || $_SESSION['usertype'] == 'Fulfillment Team') {
    $sql = " ";




    if ($Lead == '1' && $Status != "" && $Leadid != "" && $LeadDelegated != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Status= '" . $Status . "' and l.LeadSource='" . $Leadid . "' and D.SalesmanId='" . $LeadDelegated . "' ";
    } else if ($Lead == '1' && $Status != "" && $Leadid != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l where l.Status= '" . $Status . "' and l.LeadSource='" . $Leadid . "'  ";
    } else if ($Lead == '1' && $Status != "" && $LeadDelegated != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Status= '" . $Status . "'  and D.SalesmanId='" . $LeadDelegated . "' ";
    } else if ($Lead == '1' && $Leadid != "" && $LeadDelegated != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Status!= '3' and l.LeadSource='" . $Leadid . "' and D.SalesmanId='" . $LeadDelegated . "' ";
    } else if ($Lead == '1' && $Status != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l   where    l.Status='" . $Status . "' ";
    } else if ($Lead == '1' && $Leadid != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l   where    l.Status!= '3' and l.LeadSource='" . $Leadid . "' ";
    } else if ($Lead == '1' && $LeadDelegated != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Status!= '3'  and D.SalesmanId='" . $LeadDelegated . "' ";
    } else if ($Lead == '1') {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason from Leads_table l where l.Status!= '3'   ";
    } else if ($Lead == '2' && $Status != "" && $Leadid != "" && $LeadDelegated != "") {

        if ($Status == '1') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Excel!='0' and l.LeadSource='" . $Leadid . "' and D.SalesmanId='" . $LeadDelegated . "' ";
        }
        if ($Status == '2') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Excel='1' and l.LeadSource='" . $Leadid . "' and D.SalesmanId='" . $LeadDelegated . "' ";
        }
        if ($Status == '3') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Excel='2' and l.LeadSource='" . $Leadid . "' and D.SalesmanId='" . $LeadDelegated . "' ";
        }

    } else if ($Lead == '2' && $Status != "" && $Leadid != "") {
        if ($Status == '1') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l where l.Excel!='0' and l.LeadSource='" . $Leadid . "'  ";
        }
        if ($Status == '2') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l where l.Excel= '1' and l.LeadSource='" . $Leadid . "'  ";
        }
        if ($Status == '3') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l where l.Excel= '2' and l.LeadSource='" . $Leadid . "'  ";
        }

    } else if ($Lead == '2' && $Status != "" && $LeadDelegated != "") {

        if ($Status == '1') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Excel!= '0'  and D.SalesmanId='" . $LeadDelegated . "' ";
        }
        if ($Status == '2') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Excel= '1'  and D.SalesmanId='" . $LeadDelegated . "' ";
        }
        if ($Status == '3') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Excel= '2'  and D.SalesmanId='" . $LeadDelegated . "' ";
        }


    } else if ($Lead == '2' && $Leadid != "" && $LeadDelegated != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Excel= '2' and l.LeadSource='" . $Leadid . "' and D.SalesmanId='" . $LeadDelegated . "' ";
    } else if ($Lead == '2' && $Status != "") {

        if ($Status == '1') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l   where  l.Excel!= '0'    ";
        }
        if ($Status == '2') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l   where  l.Excel= '1'    ";
        }
        if ($Status == '3') {
            $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l   where  l.Excel= '2'    ";
        }
    } else if ($Lead == '2' && $Leadid != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason	from Leads_table l   where    l.Excel= '2' and l.LeadSource='" . $Leadid . "' ";
    } else if ($Lead == '2' && $LeadDelegated != "") {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason,D.SalesmanId,D.DelegatedTIme	from Leads_table l   inner join LeadDelegation D  where  l.Lead_id=D.LeadId  and   l.Excel= '2'  and D.SalesmanId='" . $LeadDelegated . "' ";
    } else if ($Lead == '2') {
        $sql .= " select l.Lead_id,l.Title,l.FirstName,l.LastName	,l.MobileCode,l.MobileNumber,l.MobileCode2,l.MobileNumber2,l.contact1Code,l.ContactNo1,l.contact2Code,l.ContactNo2,l.contact3Code,l.ContactNo3,l.EmailId	,l.FacebookId,l.Address1,l.Address2,l.Address3,l.Country,l.State,l.City	,l.PinCode,l.pincodeOfArea,l.Nationality,l.Company,l.Designation,l.LeadSource,l.Status	,l.DelegationStatus,l.Creation	,l.Assigned,l.CloseReason	,l.Close,l.leadEntryef,l.Hotel_Name,l.Excel	,l.ExcelReason from Leads_table l where l.Excel= '2'   ";
    }

    if ($fromDt != "" and $todate != "") {
        $sql .= " and date(l.Creation) between '" . $fromdate . "' and '" . $todate . "' ";
    } else if ($fromDt != "") {
        $sql .= " and date(l.Creation) >= '" . $fromdate . "'  ";
    } else if ($todate != "") {
        $sql .= " and date(l.Creation) <= '" . $todate . "'  ";
    }


} else {

    $sql = "select * from Leads_table where LeadSource='" . $Leadid . "' and leadEntryef='" . $_SESSION['id'] . "' and Status!='3' ";

}
// echo $sql;

$result = mysqli_query($conn, $sql);

$Num_Rows = mysqli_fetch_row($result)[0];

//$Per_Page =$_POST['perpg'];   // Records Per Page
$Per_Page = $Num_Rows;
$Page = $strPage;

if ($strPage == "") {
    $Page = 1;
}

$Prev_Page = $Page - 1;
$Next_Page = $Page + 1;


$Page_Start = (($Per_Page * $Page) - $Per_Page);
if ($Num_Rows <= $Per_Page) {
    $Num_Pages = 1;
} else if (($Num_Rows % $Per_Page) == 0) {
    $Num_Pages = ($Num_Rows / $Per_Page);
} else {
    $Num_Pages = ($Num_Rows / $Per_Page) + 1;
    $Num_Pages = (int) $Num_Pages;
}
if ($Per_Page != "all")
    //$sql.=" LIMIT $Page_Start , $Per_Page";

    //	echo $sql;
    $qrys = mysqli_query($conn, $sql);

//$count=mysqli_num_rows($qrys);

$sr = 1;
if ($Page == "1" or $Page == "") {
    $sr = "1";
} else {
    //   echo $Page_Start."-".$Page."-".$Page_Start;
    $sr = ($Per_Page * ($Page - 1)) + 1;

    //$sr=$sr+1;
}

?>



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
                } ?></td>


                <?php if ($_SESSION['usertype'] == 'Admin') {
                    if ($_row['Status'] == '0') { ?>
                        <td><input type="checkbox" name="check[]" value="<?php echo $_row['Lead_id']; ?>"></td>
                    <?php } else { ?>
                        <td> </td> <?php }
                } ?>



                <td><?php if ($_row['Status'] == '0') { ?><input type="button" class="btn btn-primary"
                            onclick="window.open('lead_entry1.php?id=<?php echo $_row['Lead_id']; ?>&excelid=0','_self');"
                            value="Edit"><?php } ?> </td>



                <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                    <td><?php if ($_row['Status'] == '4') { ?><input type="button" class="btn btn-primary"
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