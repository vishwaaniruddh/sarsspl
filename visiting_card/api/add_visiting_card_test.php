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

$data = json_decode(file_get_contents("php://input"), true);
$id = isset($data['id']) ? $data['id'] : '';

$allowed_mime_types = ['image/jpeg', 'image/png', 'image/jpg'];

// Initialize the response array
$response = array();

if ($id) {
    // Fetch existing visiting card details for this user
    $sql_existing = "SELECT profile_image, background_img, visiting_card_img FROM visiting_card_details WHERE id = '$id'";
    $result_existing = mysqli_query($con, $sql_existing);
    
    if ($result_existing && mysqli_num_rows($result_existing) > 0) {
        $existing_data = mysqli_fetch_assoc($result_existing);
    } else {
        $existing_data = ['profile_image' => '', 'background_img' => '', 'visiting_card_img' => '']; 
    }
    
    $visitsql = mysqli_query($con, "SELECT * FROM visiting_card_details WHERE id = '$id'");
    
    if (mysqli_num_rows($visitsql) > 0) {
        $update_fields = [];
        
        if (isset($data['first_name']) && !empty($data['first_name'])) {
            $first_name = mysqli_real_escape_string($con, $data['first_name']);
            $update_fields[] = "first_name = '$first_name'";
        }
        
        if (isset($data['last_name']) && !empty($data['last_name'])) {
            $last_name = mysqli_real_escape_string($con, $data['last_name']);
            $update_fields[] = "last_name = '$last_name'";
        }

        if (isset($data['contact_no1']) && !empty($data['contact_no1'])) {
            $mob1 = mysqli_real_escape_string($con, $data['contact_no1']);
            $update_fields[] = "contact_no1 = '$mob1'";
        }

        if (isset($data['contact_no2']) && !empty($data['contact_no2'])) {
            $mob2 = mysqli_real_escape_string($con, $data['contact_no2']);
            $update_fields[] = "contact_no2 = '$mob2'";
        }

        if (isset($data['email_id']) && !empty($data['email_id'])) {
            $email = mysqli_real_escape_string($con, $data['email_id']);
            $update_fields[] = "email_id = '$email'";
        }
        
        if (isset($data['company_name']) && !empty($data['company_name'])) {
            $company_name = mysqli_real_escape_string($con, $data['company_name']);
            $update_fields[] = "company_name = '$company_name'";
        }
        
        if (isset($data['business_type']) && !empty($data['business_type'])) {
            $business_type = mysqli_real_escape_string($con, $data['business_type']);
            $update_fields[] = "business_type = '$business_type'";
        }
        
        if (isset($data['residence_address']) && !empty($data['residence_address'])) {
            $residence_address = mysqli_real_escape_string($con, $data['residence_address']);
            $update_fields[] = "residence_address = '$residence_address'";
        }
        
        if (isset($data['website']) && !empty($data['website'])) {
            $website = mysqli_real_escape_string($con, $data['website']);
            $update_fields[] = "website = '$website'";
        }
        
        if (isset($data['font_color']) && !empty($data['font_color'])) {
            $font_color = mysqli_real_escape_string($con, $data['font_color']);
            $update_fields[] = "font_color = '$font_color'";
        }
        
        if (isset($data['font_size']) && !empty($data['font_size'])) {
            $font_size = mysqli_real_escape_string($con, $data['font_size']);
            $update_fields[] = "font_size = '$font_size'";
        }
        
        if (isset($data['keywords']) && !empty($data['keywords'])) {
            $keywords = mysqli_real_escape_string($con, $data['keywords']);
            $update_fields[] = "keywords = '$keywords'";
        }

        // Handling Profile Image Update
        if (isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name'])) {
            // Move uploaded profile image to the correct directory
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $base_folder = $_SERVER['DOCUMENT_ROOT'] . "/visiting_card/assets/$year/$month/$day/$id/";
            $profile_folder = $base_folder . "profile/";

            if (!is_dir($profile_folder)) {
                mkdir($profile_folder, 0777, true); 
            }

            $profile_image = basename($_FILES['profile_image']['name']);
            $profile_image_tmp = $_FILES['profile_image']['tmp_name'];
            $profile_image_target = $profile_folder . $profile_image;

            if (move_uploaded_file($profile_image_tmp, $profile_image_target)) {
                // Remove old profile image if exists
                if ($existing_data['profile_image'] && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $existing_data['profile_image'])) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $existing_data['profile_image']);
                }
                // Update the database field with the new image path
                $profile_image_path = "visiting_card/assets/$year/$month/$day/$id/profile/" . $profile_image;
                $complete_profile_image_path = $baseurl.$profile_image_path;
                $update_fields[] = "profile_image = '$complete_profile_image_path'";
            } else {
                $response['Code'] = 201;
                $response['msg'] = "Error uploading profile image";
                echo json_encode($response);
                exit;
            }
        }

        // Handling Background Image Update
        if (isset($_FILES['background_img']['name']) && !empty($_FILES['background_img']['name'])) {
            // Move uploaded background image to the correct directory
            $background_folder = $base_folder . "background/";

            if (!is_dir($background_folder)) {
                mkdir($background_folder, 0777, true); 
            }

            $background_image = basename($_FILES['background_img']['name']);
            $background_image_tmp = $_FILES['background_img']['tmp_name'];
            $background_image_target = $background_folder . $background_image;

            if (move_uploaded_file($background_image_tmp, $background_image_target)) {
                // Remove old background image if exists
                if ($existing_data['background_img'] && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $existing_data['background_img'])) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $existing_data['background_img']);
                }
                // Update the database field with the new image path
                $background_image_path = "visiting_card/assets/$year/$month/$day/$id/background/" . $background_image;
                $complete_background_image_path = $baseurl.$background_image_path;
                $update_fields[] = "background_img = '$complete_background_image_path'";
            } else {
                $response['Code'] = 201;
                $response['msg'] = "Error uploading background image";
                echo json_encode($response);
                exit;
            }
        }

        // Only proceed to update if there are fields to update
        if (count($update_fields) > 0) {
            // Join the update fields into a string
            $update_query = "UPDATE visiting_card_details SET " . implode(", ", $update_fields) . ", updated_at = '$datetime' WHERE user_id = '$id'";

            // Execute the update query
            $updatesql = mysqli_query($con, $update_query);
            
            if ($updatesql) {
                $response['Code'] = 200;
                $response['msg'] = "File Updated Successfully";
                $response['upd_qry'] = $update_query;
            } else {
                $response['Code'] = 201;
                $response['msg'] = "Unable to update the record!!";
                $response['error'] = mysqli_error($con); 
            }
        } else {
            $response['Code'] = 202;
            $response['msg'] = "No fields to update.";
        }
    }else {
        $response['Code'] = 400;
        $response['msg'] = "User ID is required.";
    }
    } else {
        // Allowed MIME types for images
        // $allowed_mime_types = ['image/jpeg', 'image/png', 'image/jpeg'];
        
        // If no record exists for this user ID, proceed to insert new record
        $user_id = mysqli_real_escape_string($con, $data['user_id']);
        $first_name = mysqli_real_escape_string($con, $data['first_name']);
        $last_name = mysqli_real_escape_string($con, $data['last_name']);
        $company_name = isset($data['company_name']) ? mysqli_real_escape_string($con, $data['company_name']) : "";
        $business_type = isset($data['business_type']) ? mysqli_real_escape_string($con, $data['business_type']) : "";
        $residence_address = isset($data['residence_address']) ? mysqli_real_escape_string($con, $data['residence_address']) : "";
        $office_address = isset($data['office_address']) ? mysqli_real_escape_string($con, $data['office_address']) : "";
        $contact_no1 = isset($data['contact_no1']) ? mysqli_real_escape_string($con, $data['contact_no1']) : "";
        $contact_no2 = isset($data['contact_no2']) ? mysqli_real_escape_string($con, $data['contact_no2']) : "";
        $email_id = isset($data['email_id']) ? mysqli_real_escape_string($con, $data['email_id']) : "";
        $website = isset($data['website']) ? mysqli_real_escape_string($con, $data['website']) : "";
        $font_color = isset($data['font_color']) ? mysqli_real_escape_string($con, $data['font_color']) : "";
        $font_size = isset($data['font_size']) ? mysqli_real_escape_string($con, $data['font_size']) : "";
        $keywords = isset($data['keywords']) ? mysqli_real_escape_string($con, $data['keywords']) : "";
        $status = "1";  
        $datetime = date('Y-m-d H:i:s');
        
        
    
        $selectqry = mysqli_query($con, "SELECT MAX(id) AS max_id FROM visiting_card_details");
        if (mysqli_num_rows($selectqry) > 0) {
            $fetchqry = mysqli_fetch_assoc($selectqry);
            $last_user_id = $fetchqry['max_id'];
            $new_id = $last_user_id + 1;
        } 
        
        // $new_id = mysqli_insert_id($con);
        // $new_id = $id+1;
        
        // Base folder creation
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $base_folder = $_SERVER['DOCUMENT_ROOT'] . "/visiting_card/assets/$year/$month/$day/$new_id/";
        
        if (!is_dir($base_folder)) {
            mkdir($base_folder, 0777, true); 
        }
        
        // File upload handling
        $profile_image = "";
        $background_image = "";
        $visiting_card_img = "";
        
        // Unlinking previous images
        if (!empty($existing_data['profile_image'])) {
            $old_profile_image_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $existing_data['profile_image'];
            if (file_exists($old_profile_image_path)) {
                unlink($old_profile_image_path);
            }
        }
        
        if (!empty($existing_data['background_img'])) {
            $old_background_image_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $existing_data['background_img'];
            if (file_exists($old_background_image_path)) {
                unlink($old_background_image_path);
            }
        }
        
        
        if (!empty($existing_data['visiting_card_img'])) {
            $old_visiting_card_img_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $existing_data['visiting_card_img'];
            if (file_exists($old_visiting_card_img_path)) {
                unlink($old_visiting_card_img_path);
            }
        }
        
        
        // Handle Profile Image Upload
        if (isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name'])) {
            $profile_image = basename($_FILES['profile_image']['name']);
            $profile_image_tmp = $_FILES['profile_image']['tmp_name'];
            $profile_folder = $base_folder . "profile/";
        
            if (!is_dir($profile_folder)) {
                mkdir($profile_folder, 0777, true); 
            }
        
            // Check MIME type
            $mime_type = mime_content_type($profile_image_tmp);
            if (!in_array($mime_type, $allowed_mime_types)) {
                $response['Code'] = 201;
                $response['msg'] = "Invalid profile image type. Allowed types are JPG, PNG, and JPEG.";
                echo json_encode($response);
                exit;
            }
        
            $profile_image_target = $profile_folder . $profile_image;
        
            // Move the uploaded profile image
            if (move_uploaded_file($profile_image_tmp, $profile_image_target)) {
                $profile_image = "visiting_card/assets/$year/$month/$day/$new_id/profile/" . $profile_image;
                $complete_profile_image_path = $baseurl.$profile_image;
            } else {
                $response['Code'] = 201;
                $response['msg'] = "Error uploading profile image";
                echo json_encode($response);
                exit;
            }
        }
        
        // Handle Background Image Upload
        if (isset($_FILES['background_img']['name']) && !empty($_FILES['background_img']['name'])) {
            $background_image = basename($_FILES['background_img']['name']);
            $background_image_tmp = $_FILES['background_img']['tmp_name'];
            $background_folder = $base_folder . "background/";
        
            if (!is_dir($background_folder)) {
                mkdir($background_folder, 0777, true); 
            }
        
            // Check MIME type
            $mime_type = mime_content_type($background_image_tmp);
            if (!in_array($mime_type, $allowed_mime_types)) {
                $response['Code'] = 201;
                $response['msg'] = "Invalid background image type. Allowed types are JPG, PNG, and JPEG.";
                echo json_encode($response);
                exit;
            }
        
            $background_image_target = $background_folder . $background_image;
        
            // Move the uploaded background image
            if (move_uploaded_file($background_image_tmp, $background_image_target)) {
                $background_image = "visiting_card/assets/$year/$month/$day/$new_id/background/" . $background_image;
                $complete_background_image_path = $baseurl.$background_image;
            } else {
                $response['Code'] = 201;
                $response['msg'] = "Error uploading background image";
                echo json_encode($response);
                exit;
            }
        }
      
        // Handle Visiting Card Image
        if (isset($_FILES['visiting_card_img']['name']) && !empty($_FILES['visiting_card_img']['name'])) {
            $visiting_card_img = basename($_FILES['visiting_card_img']['name']);
            $visiting_card_img_tmp = $_FILES['visiting_card_img']['tmp_name'];
            $visiting_card_folder = $base_folder . "visiting_card_img/";
        
            if (!is_dir($visiting_card_folder)) {
                mkdir($visiting_card_folder, 0777, true); 
            }
        
            // Check MIME type
            $mime_type = mime_content_type($visiting_card_img_tmp);
            if (!in_array($mime_type, $allowed_mime_types)) {
                $response['Code'] = 201;
                $response['msg'] = "Invalid visiting card image type. Allowed types are JPG, PNG, and JPEG.";
                echo json_encode($response);
                exit;
            }
        
            $visiting_cards_img_target = $visiting_card_folder . $visiting_card_img;
        
            // Move the uploaded visiting card image
            if (move_uploaded_file($visiting_card_img_tmp, $visiting_cards_img_target)) {
                $visiting_card_img = "visiting_card/assets/$year/$month/$day/$new_id/visiting_card_img/" . $visiting_card_img;
                $complete_visiting_card_img_path = $baseurl.$visiting_card_img;
            } else {
                $response['Code'] = 201;
                $response['msg'] = "Error uploading visiting card image";
                echo json_encode($response);
                exit;
            }
        } else {
            $complete_visiting_card_img_path = '';
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
    $pdf->SetAutoPageBreak(true, 10);
    
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
    
    // HTML content with Font Awesome icon for "View Map"
    $pdfContent = "
    <div style='border: 1px solid #cccccc; padding: 15px; background-color: #f9f9f9;'>
        <h1 style='text-align:center;'>Visiting Card</h1>
        <p><strong>Name: </strong> $first_name $last_name</p>
        <p><strong>Company Name: </strong> $company_name</p>
        
        <p><strong>Office Address: </strong> 
          	<a href='https://maps.google.com/?q=" . urlencode($office_address) . "' target='_blank'>$office_address </a>
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
    $pdfOutputPath_url = $baseurl."visiting_card/assets/$year/$month/$day/$new_id/pdf/visiting_card_$user_id.pdf";
    $pdf->Output($pdfOutputPath, 'FI'); // 'F' means save to file

        
        
      /*  
        // Prepare the insert SQL query
        $sql = "INSERT INTO visiting_card_details (user_id, first_name, last_name, company_name, business_type, residence_address, office_address, contact_no1, contact_no2, email_id, website, profile_image, background_img, font_color, font_size, keywords, status, created_at,visiting_card_pdf) 
                VALUES ('$user_id', '$first_name', '$last_name', '$company_name', '$business_type', '$residence_address', '$office_address', '$contact_no1', '$contact_no2', '$email_id', '$website', '$complete_profile_image_path', '$complete_background_image_path', '$font_color', '$font_size', '$keywords', '$status', '$datetime','$pdfOutputPath_url')";  */
                
               $sql = "INSERT INTO visiting_card_details (user_id, first_name, last_name, company_name, business_type, residence_address, office_address, contact_no1, contact_no2, email_id, website, profile_image, background_img, font_color, font_size, keywords, status, created_at, visiting_card_img,visiting_card_pdf) 
                VALUES ('$user_id', '$first_name', '$last_name', '$company_name', '$business_type', '$residence_address', '$office_address', '$contact_no1', '$contact_no2', '$email_id', '$website', '$complete_profile_image_path', '$complete_background_image_path', '$font_color', '$font_size', '$keywords', '$status', '$datetime','$complete_visiting_card_img_path','$pdfOutputPath_url')"; 
        
        if (mysqli_query($con, $sql)) {
            $response['Code'] = 200;
            $response['msg'] = "Visiting card details inserted successfully";
            $response['newid'] = $new_id;
            $response['pdf_url'] = $pdfOutputPath_url;
            
            
        } else {
            $response['Code'] = 201;
            $response['msg'] = "Error inserting visiting card details!";
            $response['error'] = mysqli_error($con);
        }
    }


echo json_encode($response);
?>
