<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();

include($_SERVER['DOCUMENT_ROOT'].'/visiting_card/config/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); 

// require_once('../generatepdf/TCPDF-master/examples/tcpdf_include.php');
// include('../generatepdf/TCPDF-master/tcpdf.php');

// Convert hex color to RGB
function hexToRgb($hex) {
    // Remove the '#' symbol if it's there
    $hex = ltrim($hex, '#');

    // Convert hex to RGB components
    if (strlen($hex) == 6) {
        list($r, $g, $b) = sscanf($hex, "%02x%02x%02x");
    } elseif (strlen($hex) == 3) {
        list($r, $g, $b) = sscanf($hex, "%1x%1x%1x");
        $r = $r * 17;
        $g = $g * 17;
        $b = $b * 17;
    }

    return [$r, $g, $b];
}



require_once('../generatepdf/TCPDF-main/tcpdf.php');


$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');

$baseurl = "https://sarsspl.com/";

$data = $_POST;

$id = isset($data['id']) ? $data['id'] : '';

$allowed_mime_types = ['image/jpeg', 'image/png', 'image/jpg'];

if($id){
    
    $sqlfetch = mysqli_query($con,"select * from visiting_card_details where id = '$id'  ");
    $sqlfetch_res = mysqli_fetch_assoc($sqlfetch);
    
    
    
    
    
    $user_id = mysqli_real_escape_string($con, $sqlfetch_res['user_id']);
        $first_name = mysqli_real_escape_string($con, $sqlfetch_res['first_name']);
        $last_name = mysqli_real_escape_string($con, $sqlfetch_res['last_name']);
        $company_name = isset($sqlfetch_res['company_name']) ? mysqli_real_escape_string($con, $sqlfetch_res['company_name']) : "";
        $business_type = isset($sqlfetch_res['business_type']) ? mysqli_real_escape_string($con, $sqlfetch_res['business_type']) : "";
        $residence_address = isset($sqlfetch_res['residence_address']) ? mysqli_real_escape_string($con, $sqlfetch_res['residence_address']) : "";
        $office_address = isset($sqlfetch_res['office_address']) ? mysqli_real_escape_string($con, $sqlfetch_res['office_address']) : "";
        $contact_no1 = isset($sqlfetch_res['contact_no1']) ? mysqli_real_escape_string($con, $sqlfetch_res['contact_no1']) : "";
        $contact_no2 = isset($sqlfetch_res['contact_no2']) ? mysqli_real_escape_string($con, $sqlfetch_res['contact_no2']) : "";
        $email_id = isset($sqlfetch_res['email_id']) ? mysqli_real_escape_string($con, $sqlfetch_res['email_id']) : "";
        $website = isset($sqlfetch_res['website']) ? mysqli_real_escape_string($con, $sqlfetch_res['website']) : "";
        $font_color = isset($sqlfetch_res['font_color']) ? mysqli_real_escape_string($con, $sqlfetch_res['font_color']) : "";
        $font_size = isset($sqlfetch_res['font_size']) ? mysqli_real_escape_string($con, $sqlfetch_res['font_size']) : "";
        $keywords = isset($sqlfetch_res['keywords']) ? mysqli_real_escape_string($con, $sqlfetch_res['keywords']) : "";
        $complete_profile_image_path = isset($sqlfetch_res['profile_image']) ? mysqli_real_escape_string($con, $sqlfetch_res['profile_image']) : "";
        $complete_background_image_path = isset($sqlfetch_res['background_img']) ? mysqli_real_escape_string($con, $sqlfetch_res['background_img']) : "";
        $status = "1";  
        $datetime = date('Y-m-d H:i:s');
        
        
        
        // Base folder creation
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $base_folder = $_SERVER['DOCUMENT_ROOT'] . "/visiting_card/assets/$year/$month/$day/$id/";
        
        if (!is_dir($base_folder)) {
            mkdir($base_folder, 0777, true); 
        }
        

// Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($first_name . ' ' . $last_name);
    $pdf->SetTitle('Visiting Card');
    $pdf->SetSubject('Generated Visiting Card');
    
    // Center the title
    $pdf->SetFont('helvetica', 'B', 16); // Set a font and size for the title
    $pdf->SetY(10); // Set the Y position of the title
    $pdf->Cell(0, 10, 'Visiting Card', 0, 1, 'C'); // Add the title text in the center
    
    // Add additional content below the title
    $pdf->SetFont('helvetica', '', $font_size); // Reset font for normal content
    $pdf->SetY(30); // Move down for regular content
    
    // Set text color using hex code
    $hexColor = $font_color; // Example hex color
    list($r, $g, $b) = hexToRgb($hexColor);
    $pdf->SetTextColor($r, $g, $b); // Set text color to hex #FF5733
    
    // Set margins and auto page breaks
    $pdf->SetMargins(10, 10, 10);
    // $pdf->SetAutoPageBreak(true, 10);
     $pdf->SetAutoPageBreak(false,0);
    
    // Add a page
    $pdf->AddPage();
    
    // Background Image
    $pdf->Image($complete_background_image_path, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), '', '', '', true, 300, '', false, false, 0, 'C', false, false, false);
    
    // Define image width and page width
    $imageWidth = 30; // Width of your image in units
    $padding = 10; // Padding from the right edge
    
    // Set X-coordinate to the page width minus image width and padding
    $xPosition = $pdf->getPageWidth() - $imageWidth - $padding;
    
    // Place the image at the calculated position on the right
    $pdf->Image($complete_profile_image_path, $xPosition, 20, $imageWidth, 30, '', '', '', true, 150, '', false, false, 0, '', false, false, false);

    $office_address1= "Charoda";
    
    $pdfContent = "
    <div style='border: 1px solid #cccccc; padding: 15px; background-color: #f9f9f9;'>
        <h1 style='text-align:center;'>Visiting Card</h1>
        <p><strong>Name: </strong> $first_name $last_name</p>
        <p><strong>Company Name: </strong> $company_name</p>
        
        <p><strong>Office Address: </strong> 
          	<a href='https://maps.google.com/?q=" . urlencode($office_address) . "' target='_blank'> <img src='assets/images/location-icon.png'> $office_address </a>
        </p>
        
        <p><strong>Residence Address: </strong> 
            <a href='https://maps.google.com/?q=" . urlencode($residence_address) . "' target='_blank' style='color: #0f0f0f; text-decoration: none;'>$residence_address</a>
        </p>
        <p><strong>Contact Number 1: </strong> <a href='tel:$contact_no1'>$contact_no1</a></p>
        <p><strong>Contact Number 2: </strong> <a href='tel:$contact_no2'>$contact_no2</a></p>
        <p><strong>Email: </strong> <a href='mailto:$email_id' style=' text-decoration: none;'>$email_id</a></p>
        <p><strong>Website: </strong> <a href='$website' target='_blank'>$website</a></p>
       
    </div>
";

    
    // Output HTML content to the PDF
    $pdf->writeHTML($pdfContent, true, false, true, false, '');
    
    // Output the PDF to browser
    // $pdf->Output('visiting_card.pdf', 'I'); // I = Display in browser, D = Download
        
    $pdf_folder = $base_folder . "pdf/";

    if (!is_dir($pdf_folder)) {
        mkdir($pdf_folder, 0777, true);
    }
    
        // Define PDF output path and save the PDF
    $pdfOutputPath = $pdf_folder . "visiting_card_$user_id.pdf";
    $pdfOutputPath_url = $baseurl."visiting_card/assets/$year/$month/$day/$id/pdf/visiting_card_$user_id.pdf";
    $pdf->Output($pdfOutputPath, 'FI'); // 'F' means save to file
    

//   $sql = "INSERT INTO visiting_card_details (user_id, first_name, last_name, company_name, business_type, residence_address, office_address, contact_no1, contact_no2, email_id, website, profile_image, background_img, font_color, font_size, keywords, status, created_at, visiting_card_img,visiting_card_pdf) 
// VALUES ('$user_id', '$first_name', '$last_name', '$company_name', '$business_type', '$residence_address', '$office_address', '$contact_no1', '$contact_no2', '$email_id', '$website', '$complete_profile_image_path', '$complete_background_image_path', '$font_color', '$font_size', '$keywords', '$status', '$datetime','$complete_visiting_card_img_path','$pdfOutputPath_url')"; 


$sql = "update visiting_card_details set visiting_card_pdf = '$pdfOutputPath_url'  where id = '$id' ";

if (mysqli_query($con, $sql)) {
            $response['Code'] = 200;
            $response['msg'] = "PDF generated successfully";
            $response['id'] = $id;
            $response['pdf_url'] = $pdfOutputPath_url;
            
        } else {
            $response['Code'] = 201;
            $response['msg'] = "Error generating PDF!";
            $response['error'] = mysqli_error($con);
        }
    
} else {
    $response['Code'] = 400;
    $response['msg'] = "Unable to fetch id";
    $response['error'] = mysqli_error($con);
}


        


echo json_encode($response);
    ?>




