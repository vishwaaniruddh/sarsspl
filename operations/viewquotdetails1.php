<?php include("config.php");
$qid = $_GET['qid'];
function no_to_words($num){
    $no = round($num);
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety'
    );
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
        } else $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $points = ($point) ?
        "." . $words[$point / 10] . " " .
        $words[$point = $point % 10] : '';
    echo "<b>" . "(Rupees : " . strtoupper($result) . "ONLY ) " . "<b>";
}
?>

<html>
    <head>
        <script src="excel.js" type="text/javascript"></script>
        <script type="text/javascript">
        function PrintDiv(id) {
            var divToPrint = document.getElementById(id);
            var popupWin = window.open('', '_blank', 'width=800,height=400');
            popupWin.document.open();
            popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
        }
    </script>
</head>
<body>
    <?php 

    $qry1 = mysqli_query($con,"select * from quotation1 where id='" . $qid . "'");
    $qrrow = mysqli_fetch_array($qry1);
    $ticketNo = $qrrow['ticketNo'];
    $categoryName = $qrrow['categoryName'];
    $location = $qrrow[6];
    $branchCode = $qrrow['atm'] ; 
    $entrydate = $qrrow['entrydate'];
    $quotationDate = $qrrow['quotationDate'];
    $qrynm = mysqli_query($con,"select cust_name,site_id from $qrrow[2]_sites where cust_id='" . $qrrow[2] . "' ");
    $qname = mysqli_fetch_array($qrynm);
    ?>
    
    
    
    
    
    
    <div id="exptexcl" align="center"><br><br><br><br><br><br><br><br><br>
    <table  border="1" cellpadding="2" cellspacing="0" id="custtable">
    <thead>
        <tr><td colspan="14" align="center" style="background:#9cc2e5"><b>Quatation :</b> <?= $qrrow[1] ; ?></td></tr>
        <tr style="background:red; color:white;">
            <th>S.No.</th>
            <th>Ticket No.</th>
            <th>Category</th>
            <th>LOC</th>
            <th>Location</th>
            <th>Description of Work</th>
            <th>Unit</th>
            <th>Qty.</th>
            <th>Rate</th>
            <th>Quotation Amount</th>
            <th>Approval Amount</th>
            <th>RC No.</th>
            <th>Date of Quote</th>
            <th>Date of Approval</th>
        </tr>
    </thead>
    <tbody>
         <tr>
                <?php
                $qdetc = mysqli_query($con,"select distinct(particular) from quotation_details where qid='" . $qid . "'");
                $num = mysqli_num_rows($qdetc);
                $i = 1;
                $count = 1 ;
                $grandTotal = 0 ;
                while ($gdetca = mysqli_fetch_array($qdetc)) {
                    
                    // echo "select * from quotation_details where particular='" . $gdetca[0] . "' and qid='" . $qid . "'" ; 
                    $gpart = mysqli_query($con,"select * from quotation_details where particular='" . $gdetca[0] . "' and qid='" . $qid . "'");
                    $str = 'a';
                    while ($gparta = mysqli_fetch_array($gpart)) {
                        $total = $gparta['Total'] ;
                        $grandTotal = $grandTotal + $total ;
                        ?>
                        <tr class="first">
                            <td><?= $count; ?></td>
                            
                            <td><?php echo $ticketNo ; ?></td>
                            <td><?php echo $categoryName ; ?></td>
                            <td><?php echo $branchCode ; ?></td>
                            <td><?php echo $location; ?></td>

                            <td align="center">
                                <?= $gparta['description']; ?>
                            </td>
                            <td align="center">
                                <?= $gparta['unit'] ; ?>
                            </td>
                            <td align="center">
                                <?= $gparta['quantity']; ?>
                            </td>
                            <td align="center">
                                <?= $gparta['rate']; ?>
                            </td>
                            <td align="center">
                                <?= $total; ?>
                            </td>
                            <td align="center">
                                <?= $gparta['uom']; ?>
                            </td>
                            <td align="left"><?= $gparta['tcode']; ?></td>
                            <td><?php echo $quotationDate ; ?></td>
                            <td></td>
                            </tr>
                            
                            
                            <?php
                            $ticketNo = '';
                            $categoryName= '';
                            $location = '';
                            $branchCode = '' ;
                            $entrydate = '';
                            $quotationDate = '';
                                $str++;
                                $count++;
                        }
                    $i++;
                }
                ?>
</tr>

<tr>
    <td style="background:#ffff00;white-space: nowrap;" colspan="3"><center>GST Extra as per applicable</center></td>
    <td style="background:#ffff00;" colspan="2"><center>Total Amount</center></td>
    <td style="background:#ffff00;"></td>
        <td style="background:#ffff00;"></td>
            <td style="background:#ffff00;"></td>
                <td style="background:#ffff00;"></td>
    <td style="background:#ffff00;"><center><?= number_format((float)$grandTotal, 2, '.', '') ; ?></center></td>
    <td style="background:#ffff00;"></td>
        <td style="background:#ffff00;"></td>
            <td style="background:#ffff00;"></td>
                <td style="background:#ffff00;"></td>

    </tbody>
</table>
    
</div>
<br/>
<center>
    &nbsp;&nbsp;&nbsp;
    <input type="button" name="GENERATE" id="GENERATE" value="PRINT PDF" onclick="PrintDiv('exptexcl');" />
    <input type="button" id="exp" onclick="tableToExcel('exptexcl', 'Table Export Example')" value="Export To Excel" />
    </center>
    </body>
</head>
</html>
