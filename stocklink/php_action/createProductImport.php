<?php   
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
require '../vendor/autoload.php'; // Path to Composer's autoload file

use PhpOffice\PhpSpreadsheet\IOFactory;

function downloadImage($url, $path) {
    $ch = curl_init($url);
    $fp = fopen($path, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}

if ($_FILES) {
    $type = pathinfo($_FILES['brandfile']['name'], PATHINFO_EXTENSION);
    $url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;

    if (in_array($type, ['csv', 'xls', 'xlsx'])) {
        if (is_uploaded_file($_FILES['brandfile']['tmp_name'])) {
            if (move_uploaded_file($_FILES['brandfile']['tmp_name'], $url)) {
                $spreadsheet = IOFactory::load($url);
                $sheet = $spreadsheet->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn(); // Get highest column
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

                $no_error_data = [];
                $error = [];

                // Check if the number of rows exceeds 200
                if ($highestRow > 1000) {
                    $valid['success'] = false;
                    $valid['messages'] = "Error: The file contains more than 1000 rows.";
                    echo json_encode($valid);
                    exit();
                }

                $row = 2; // Start reading from row 2
                while ($row <= $highestRow) {
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(min($highestColumnIndex, 8)) . $row, NULL, TRUE, TRUE);
                    $mainData = $rowData[0];

                    if (!empty($mainData[0])) {
                        $productSerialNumbers = [];
                        $quantity = $mainData[2]; // Quantity column
                        $image_url = $mainData[7]; // Image URL column

                        // Download and save the image
                        $imagePath = '../assets/' . date('Y') . '/' . date('m');
                        if (!file_exists($imagePath)) {
                            mkdir($imagePath, 0777, true);
                        }
                        $imageName = uniqid() . '.' . pathinfo($image_url, PATHINFO_EXTENSION);
                        $imageFullPath = $imagePath . '/' . $imageName;
                        downloadImage($image_url, $imageFullPath);

                        // Read serial numbers for the current product
                        for ($i = 0; $i < $quantity; $i++) {
                            $serialRow = $row + $i; // Move down rows to get serial numbers
                            $serialData = $sheet->rangeToArray('A' . $serialRow . ':' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(min($highestColumnIndex, 8)) . $serialRow, NULL, TRUE, TRUE);
                            if (!empty($serialData[0][6])) { // Check if serial number is present
                                $productSerialNumbers[] = $serialData[0][6];
                            } else {
                                break;
                            }
                        }

                        // Prepare data for insertion
                        $no_error_data[] = [
                            'product_name' => $mainData[1],
                            'quantity' => $quantity,
                            'price' => $mainData[3],
                            'brand_name' => $mainData[4],
                            'status' => $mainData[5],
                            'serial_numbers' => $productSerialNumbers,
                            'image_url' => $imageFullPath
                        ];

                        // Skip rows that have already been read
                        $row += $quantity;
                    } else {
                        $row++;
                    }
                }

                if (!empty($no_error_data)) {
                    foreach ($no_error_data as $product) {
                        // Example of inserting product and serial numbers into the database
                        // You might need to adjust this based on your actual database schema and requirements

                        $brand_name = $product['brand_name'];
                        
                        $brandsql = mysqli_query($connect, "SELECT * FROM stocklink_brands WHERE brand_name='".$brand_name."' AND brand_active=1 AND brand_status=1");
                        if ($brandsql_result = mysqli_fetch_assoc($brandsql)) {
                            $brandId = $brandsql_result['brand_id'];
                        } else {
                            $insertbrandsql = "INSERT INTO stocklink_brands (brand_name, brand_active, brand_status) VALUES ('".$brand_name."', 1, 1)";
                            mysqli_query($connect, $insertbrandsql);
                            $brandId = $connect->insert_id;
                        }

                        $totalAmount = $product['price'] * $product['quantity'] ; 
                        $sql = "INSERT INTO stocklink_product (product_name, quantity, rate, brand_id, status, product_image,active,totalAmount) 
                        VALUES ('".$product['product_name']."', '".$product['quantity']."', '".$product['price']."', '".$brandId."', 1, '".$product['image_url']."',1,'$totalAmount')";
                        if ($connect->query($sql) === TRUE) {
                            $productId = $connect->insert_id;
                            foreach ($product['serial_numbers'] as $serial) {
                                $serialSql = "INSERT INTO stocklink_inventory (product_id, product_name, serialNumber, availabilityStatus, activityStatus, created_at) VALUES ('".$productId."', '".$product['product_name']."', '".$serial."', 'available', 'Active', '".$datetime."')";
                                $connect->query($serialSql);
                            }
                        } else {
                            $valid['success'] = false;
                            $valid['messages'] = "Error while adding the product";
                            echo json_encode($valid);
                            exit();
                        }
                    }
                    $valid['success'] = true;
                    $valid['messages'] = "Successfully Added";
                }
            } else {
                $valid['success'] = false;
                $valid['messages'] = "Error while moving the uploaded file";
            }
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while uploading the file";
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Invalid file type";
    }
    $connect->close();
    echo json_encode($valid);
}
?>
