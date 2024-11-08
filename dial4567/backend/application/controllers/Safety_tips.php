<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Safety_tips extends CI_Controller {

    public function __construct() {
        //error_reporting(E_ALL);
        //ini_set('display_errors', '1');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');  // cache for 1 day

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        parent::__construct();

        $this->load->model('User_model', 'login'); // Loading model 
        $this->load->model('api_model'); // Loading model 
        $this->load->model('Safety_tips_message_model', 'safety_tips_message_model'); // Loading model 
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    public function getSafetyTipsView($id) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->safety_tips_message_model->getSafetyTipsMessageById($id);
                echo json_encode($result);
                break;
        }
    }

    public function getSafetyTips($uid='') {
//error_reporting(E_ALL);
  //        ini_set('display_errors', '1');
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $result = $this->safety_tips_message_model->getSafetyTips($uid);
                $i = 1;
                foreach ($result as $key => $value) {
                    if ($value['message'] != null) {
                        if (strlen($value['message']) > 30) {
                            $message_string = mb_substr($value['message'], 0, 30) . "...";
                        } else {
                            $message_string = $value['message'];
                        }
                        $result[$key]['message'] = $message_string;
                    }
                    $i++;
                }
                echo json_encode($result);
                break;
        }
    }

    public function downloadexcelsheetSafetytips() {
        //error_reporting(E_ALL);
        //ini_set('display_errors', '1');
        require 'vendor/autoload.php';
        // Creates New Spreadsheet 
        $spreadsheet = new Spreadsheet();
        // Retrieve the current active worksheet 
        $sheet = $spreadsheet->getActiveSheet();
        // Set the value of cell A1 
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Date (yyyy-mm-dd)');
        $sheet->setCellValue('C1', 'Message Title');
        $sheet->setCellValue('D1', 'Message Description');
        // $sheet->setCellValue('D1', 'Days');

        $sheet->setCellValue('A2', '1');
        $sheet->setCellValue('B2', date('Y-m-d'));
        $sheet->setCellValue('C2', 'Title');
        $sheet->setCellValue('D2', 'Message');
        // $sheet->setCellValue('D2', '30');
        // Write an .xlsx file
        $writer = new Xlsx($spreadsheet);
        // Save .xlsx file to the current directory 
        $fileName = "Sample_safety_tips_" . time() . ".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
        die;
    }

    public function getUpdateSafetyTipsInfo($id) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->safety_tips_message_model->getSafetyTipsMessageById($id);
                if ($result) {
                    $result->message_date = $result->message_date;
                    $result->message = $result->message;
                    //   $result->days = $result->days;
                    $result->created_at = $result->created_at;
                }
                echo json_encode($result);
                break;
        }
    }

    public function checkDateSafetyTips($id = "") {
        $datas = json_decode(file_get_contents("php://input"));
        $result = $this->safety_tips_message_model->checkDateSafetyTips($datas, $id);
        echo json_encode($result);
    }

    public function AddSafetyTipsInfo() {
        $datas = json_decode(file_get_contents("php://input"));
        $result = $this->safety_tips_message_model->AddSafetyTipsInfo($datas);
        echo json_encode($result);
    }

    public function deleteSafetyTips() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->safety_tips_message_model->deleteSafetyTips($datas);
                echo json_encode($result);
                break;
        }
    }

    public function LatestMorningGreetingsImport() {
        $path = "morning_greetings_result";
        $latest_ctime = 0;
        $latest_filename = '';
        $d = dir($path);
        while (false !== ($entry = $d->read())) {
            $filepath = "{$path}/{$entry}";
            if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
                $latest_ctime = filectime($filepath);
                $latest_filename = $entry;
            }
        }
        return $latest_filename;
    }

    public function LatestSafetyTipsImport() {
        $path = "safety_tips_result";
        $latest_ctime = 0;
        $latest_filename = '';
        $d = dir($path);
        while (false !== ($entry = $d->read())) {
            $filepath = "{$path}/{$entry}";
            if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
                $latest_ctime = filectime($filepath);
                $latest_filename = $entry;
            }
        }
        return $latest_filename;
    }

    public function uploadexcelsheetSafetyTips() {
        require 'vendor/autoload.php';

        $path = $_FILES['morning_greetings_file']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext == "xlsx") {
            if ($_FILES['morning_greetings_file']['name']) {
                $added_file_name = "add_safety_tips_" . time() . '.xlsx';
                $result_file_name = "result_safety_tips_" . time() . '.xlsx';
                $targetPath = 'safety_tips_upload/' . basename($added_file_name);
                move_uploaded_file($_FILES['morning_greetings_file']['tmp_name'], $targetPath);
                $path = 'safety_tips_upload/';
                $import_xls_file = $added_file_name;
                $inputFileName = $path . $import_xls_file;
                try {
                    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                    /**  Create a new Reader of the type that has been identified  * */
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                    /**  Load $inputFileName to a Spreadsheet Object  * */
                    $spreadsheet = $reader->load($inputFileName);
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }
                $sheet = $spreadsheet->getActiveSheet();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
// Store data from the activeSheet to the varibale in the form of Array
                $data = array(1, $sheet->toArray(null, true, true, true));
//  Loop through each row of the worksheet in turn
                $result_spreadsheet = new Spreadsheet();
                $insert_sheet = $result_spreadsheet->getActiveSheet();
                $row_ct = 1;
                for ($row = 1; $row <= $highestRow; $row++) {
                    $err_msg = array();
                    $insert_excel_data = array();
                    $err_column = 'E';
                    if ($row == 1) {
                        //  Read a row of data into an array
                        $rowDataHeader = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        $rowDataHeader = $rowDataHeader[0];
                        // Set the value of cell 
                        $insert_sheet->setCellValue('A1', $rowDataHeader[0]);
                        $insert_sheet->setCellValue('B1', $rowDataHeader[1]);
                        $insert_sheet->setCellValue('C1', $rowDataHeader[2]);
                        $insert_sheet->setCellValue('D1', $rowDataHeader[3]);
                        $row_ct++;
                    } else {
                        //  Read a row of data into an array
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        $rowData = $rowData[0];
                        $number_col = $rowData[0]; // A
                        $date_col = $rowData[1]; // B
                        $title_col = $rowData[2]; // C
                        $message_col = $rowData[3]; // D
//                        $days_col = $rowData[3]; // C
                        $insert_excel_data['message_date'] = $date_col;
                        $insert_excel_data['title'] = $title_col;
                        $insert_excel_data['message'] = $message_col;
//                        $insert_excel_data['days'] = $days_col;
                        // START - date
                        if ($date_col == NULL) {
                            $err_msg[] = "Date required";
                        } else {
                            if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date_col)) {
                                //    return true;
                                $result = $this->safety_tips_message_model->getSafetyTipsByDate($date_col);
                                if ($result != 0) {
                                    $err_msg[] = "Same date record already exists.";
                                }
                            } else {
//                                //    return false;
                                $err_msg[] = "Use date format like yyyy-mm-dd";
                            }
                        }
                        // END - date
                        // START - Message
                        if ($title_col == NULL) {
                            $err_msg[] = "Title required";
                        }
                        // END - Message                        
                        // START - Message
                        if ($message_col == NULL) {
                            $err_msg[] = "Message required";
                        }
                        // END - Message                        
                        // START - Days
//                        if ($days_col == NULL) {
//                            $err_msg[] = "Days required";
//                        } else {
//                            
//                        }
                        // END - Days                        
                        // Set the value of cell 
                        $insert_sheet->setCellValue('A' . $row_ct, $number_col);
                        $insert_sheet->setCellValue('B' . $row_ct, $date_col);
                        $insert_sheet->setCellValue('C' . $row_ct, $title_col);
                        $insert_sheet->setCellValue('D' . $row_ct, $message_col);
//                        $insert_sheet->setCellValue('D' . $row_ct, $days_col);
                        // $insert_sheet->setCellValue('E' . $row_ct, "Error message");
                        if (empty($err_msg)) {
                            $result = $this->safety_tips_message_model->addSafetyTipsMsg($insert_excel_data);
                            if ($result) {
                                $insert_sheet->SetCellValue($err_column . $row_ct, "");
                            }
                        } else {
                            $err_msg = implode(",", $err_msg);
                            $insert_sheet->setCellValue('E' . $row_ct, $err_msg);
                        }
                        $row_ct++;
                    }
                }
                $writer = new Xlsx($result_spreadsheet);
                $writer->save('safety_tips_result/' . $result_file_name);
                $latest_filename = $this->LatestSafetyTipsImport();
                $result = array('msg_file' => base_url("/safety_tips_result/" . $latest_filename));
                echo json_encode($result);
                die;
//                session()->setFlashdata('message', 'File uploaded');
//                session()->setFlashdata('alert-class', 'alert-success');
//                session()->setFlashdata('msg_file', 'show');
//                return redirect()->to('/admin/literature-excel-import');
            }
        } else {
            die;
//            session()->setFlashdata('message', 'File allowed type - xlsx');
//            session()->setFlashdata('alert-class', 'alert-danger');
//            session()->setFlashdata('msg_file', 'hide');
//            return redirect()->to('/admin/literature-excel-import');
        }
    }

    public function downloadExcelsheetSafetyTips22() {
        require 'vendor/autoload.php';
        // Creates New Spreadsheet 
        $spreadsheet = new Spreadsheet();
        // Retrieve the current active worksheet 
        $sheet = $spreadsheet->getActiveSheet();
        // Set the value of cell A1 
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Date (yyyy-mm-dd)');
        $sheet->setCellValue('C1', 'Message');
        $sheet->setCellValue('C1', 'Days');

        // Write an .xlsx file
        $writer = new Xlsx($spreadsheet);
        // Save .xlsx file to the current directory 
        $fileName = "Sample_literature_excel_" . time() . ".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
        die;
    }

    public function UpdateSafetyTipsInfo($id = '') {
        $datas = json_decode(file_get_contents("php://input"));
        $result = $this->safety_tips_message_model->UpdateSafetyTipsInfo($datas, $id);
        echo json_encode($result);
    }

}
