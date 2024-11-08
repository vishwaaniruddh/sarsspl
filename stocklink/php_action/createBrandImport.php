<?php   
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
require '../vendor/autoload.php'; // Path to Composer's autoload file

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_FILES) {
    $type = pathinfo($_FILES['brandfile']['name'], PATHINFO_EXTENSION);
    $url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;

    if (in_array($type, ['csv', 'xls', 'xlsx'])) {
        if (is_uploaded_file($_FILES['brandfile']['tmp_name'])) {
            if (move_uploaded_file($_FILES['brandfile']['tmp_name'], $url)) {
                $spreadsheet = IOFactory::load($url);
                $sheet = $spreadsheet->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $no_error_data = [];
                $error = [];

                // Check if the number of rows exceeds 200
                if ($highestRow > 200) {
                    $valid['success'] = false;
                    $valid['messages'] = "Error: The file contains more than 200 rows.";
                    echo json_encode($valid);
                    exit();
                }

                for ($row = 2; $row <= $highestRow; $row++) {
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $sheet->getHighestColumn() . $row, NULL, TRUE, TRUE);
                    if (isset($rowData[0][0]) && !empty($rowData[0][0]) && isset($rowData[0][1])) {
                        $no_error_data[$row-1] = $rowData[0];
                    } else {
                        $error[] = $rowData[0];
                    }
                }

                if (!empty($no_error_data)) {
                    foreach ($no_error_data as $value) {
                        $select_sql = "SELECT * FROM stocklink_brands WHERE brand_name ='$value[0]'";
                        $result = $connect->query($select_sql);
                        if ($result->num_rows == 0) {
                            $sql = "INSERT INTO stocklink_brands (brand_name, brand_active, brand_status) VALUES ('$value[0]', '$value[1]', '$value[1]')";
                            if ($connect->query($sql) === TRUE) {
                                $valid['success'] = true;
                                $valid['messages'] = "Successfully Added";
                            } else {
                                $valid['success'] = false;
                                $valid['messages'] = "Error while adding the brands";
                            }
                        } else {
                            $valid['success'] = true;
                            $valid['messages'] = "Successfully Added";
                        }
                    }
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
