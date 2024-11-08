<? include('../config.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$id = $_REQUEST['id'];

$sql = mysqli_query($con,"select * from franchise_payment where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$name = $sql_result['name'];
$mobile = $sql_result['mobile'];
$email = $sql_result['email'];
$txn_id = $sql_result['txn_id'];
$created_at = $sql_result['created_at'];
$address = $sql_result['write_area'];

$originalDate = $created_at;
$newDate = date("d-m-Y", strtotime($originalDate));




?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Bill Page </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.0.63/print.min.js"></script>

    <style>

    </style>
<body>

<div class="outer" id="printElement">
    
    <div class="inner">
 <!-------------------------------------------------------------------------------->
    <div class="head">

        <div class="logo">
            <img src="2.png" id="logo_id">
        </div>

        <div class="head_line">
            <div class="head_line_1" >
                <p id="head_line_1_p">Allmart.World</p>
            </div>
            <div class="head_line_2">
                <!--<p id="head_line_2_p">Appki Apni Dukan</p>-->
            </div>
        </div>
            
        

        <div class="enterprise">
            <p id="enterprise_id"><b>Modi Enterprises</b></p>
        </div>

    </div>

     <!-------------------------------------------------------------------------------->

     <div>

            <div class="address">
                <p><b>Add:</b> Allmart Building No.2, Pragati Society, Near Pancholiya School, Mahavir Nagar,
                    Kandivali West, Mumbai - 400067, Maharashtra, India</p>
            </div>

            <div class="contact">
                <div id="contact_space">
                    <b>Mobile:</b> 7710835444
                </div>  
                <div id="contact_space">
                    <b>Email-Id:</b> enquiry.allmart@gmail.com 
                </div>    
                <div id="contact_space">
                    <b>Web:</b> <a href="http://allmart.world/">allmart.world</a>
                </div>
            </div>

            <div class="e_commerce">
                <p><b>On our E-Commerce platform we will sell FMCG, Electronic Goods & all other Products, Services like Software, Video Making, Insurance, Loan, Media and Properties</b></p>
            </div>

            <div class="gst">
                <p><b>Maharashtra GST No:</b> 27AAHPM3980E1ZL</p>
            </div>

    </div>

    <!------------------------------------------------------------------------------ -->

    <div>

        <div>
            <table style="width:100%">
                <tr>
                    <th>TAX INVOICE No: <b><u><? echo $id;?></u></b></th>
                    <th >Date: <? echo $newDate; ?></th>
                </tr>
                <tr>
                    <td>Name : <b><? echo $name;?></b></td>
                    <td rowspan="3">Add: <? echo $address; ?></td>
                </tr>
                <tr>
                    <td>Mob No: <b><? echo $mobile; ?></b></td>
                </tr>
                <tr>
                    <td>GST No:</td>
                </tr>
            </table>
        </div>

<!------------------------------------------------------------------------------ -->

        <div>
            <table style="width:100%">
                <tr>
                    <th>S No</th>
                    <th> Particulars</th>
                    <th>SAC Code</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th >Amount</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Franchise Fees (non-refundable)</td>
                    <td>998396</td>
                    <td>1</td>
                    <td>4238</td>
                    <td>4238</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>CGST</b></td>
                    <td><b>9%</b></td>
                    <td><b>381.42</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>SGST</b></td>
                    <td><b>9%</b></td>
                    <td><b>381.42</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>IGST</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2"><b>Round off</b></td>
                    <td><b>-0.84</b></td>
                </tr>
                <tr>
                    <td colspan="3"><b>Rupees: Five Thousand Only</b></td>
                    <td colspan="2"><b>Grand Total</b></td>
                    <td><b>5000</b></td>
                </tr>
            </table>
        </div>

    </div>

 <!------------------------------------------------------------------------------ -->


    <div class="note">
        <p><b>Notes: This is Non Refundable and charges will not be refunded under every and any circumstances</b></p>
    </div>

    <div class="recieved">
        <p>Recieved with thanks Rs. <b><u>Five Thousand</u></b> Rupees .  Only by RTGS/ Deposit 
            in account, Cheque/ Payment Gateway,Cr/Dr Card on Date: <b><u><? echo $newDate; ?></u></b> Time________,<br> having
            reference No: _____ through Bank _______, Branch ________.</p>
    </div>


 <!------------------------------------------------------------------------------ -->

    <div>

        <table style="width:100%">
            <tr>
                <th><b>For Modi Enterprises</b></th>
                <td><b>Bank Name:</b></td>
                <td>Kotak Mahindra Bank</td>
            </tr>
            <tr>
                <td rowspan="4"></td>
                <td><b>Account No:</b></td>
                <td>5013315448</td>
            </tr>
            <tr>
                <td><b>IFSC Code:</b></td>
                <td>KKBK0000665</td>
            </tr>
            <tr>
                <td><b>Branch Name:</b></td>
                <td>Kandivali West</td>
            </tr>
            <tr>
                <td><b>Account Type:</b></td>
                <td>Current Account</td>
            </tr>
            <tr>
                <th>Authorised Signatory</th>
                <th colspan="2" style="text-align: center;"><b>Thank You</b></th>
            </tr>
        </table>
    </div>


<div style="text-align: center; border: 1px solid black;">
    <p>This is computer generated Invoice so this does not requires signature.</p>
</div>









</div>


</div>

<br>
<br>
<br>
 
 
<div style="display:flex;justify-content:center;">
  <button class="btn btn-primary" id="printButton">Print</button>   
</div>

<br>
<br>
<br>
 

<script>
    function print() {
	printJS({
    printable: 'printElement',
    type: 'html',
    targetStyles: ['*']
 })
}

document.getElementById('printButton').addEventListener ("click", print)
</script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>