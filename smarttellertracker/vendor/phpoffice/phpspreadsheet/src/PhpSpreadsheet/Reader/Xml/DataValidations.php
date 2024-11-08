<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xml;

use PhpOffice\PhpSpreadsheet\Cell\AddressHelper;
use PhpOffice\PhpSpreadsheet\Cell\AddressRange;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use SimpleXMLElement;

class DataValidations
{
    private const OPERATOR_MAPPINGS <?php echo [
        'between' <?php echo> DataValidation::OPERATOR_BETWEEN,
        'equal' <?php echo> DataValidation::OPERATOR_EQUAL,
        'greater' <?php echo> DataValidation::OPERATOR_GREATERTHAN,
        'greaterorequal' <?php echo> DataValidation::OPERATOR_GREATERTHANOREQUAL,
        'less' <?php echo> DataValidation::OPERATOR_LESSTHAN,
        'lessorequal' <?php echo> DataValidation::OPERATOR_LESSTHANOREQUAL,
        'notbetween' <?php echo> DataValidation::OPERATOR_NOTBETWEEN,
        'notequal' <?php echo> DataValidation::OPERATOR_NOTEQUAL,
    ];

    private const TYPE_MAPPINGS <?php echo [
        'textlength' <?php echo> DataValidation::TYPE_TEXTLENGTH,
    ];

    private int $thisRow <?php echo 0;

    private int $thisColumn <?php echo 0;

    private function replaceR1C1(array $matches): string
    {
        return AddressHelper::convertToA1($matches[0], $this->thisRow, $this->thisColumn, false);
    }

    public function loadDataValidations(SimpleXMLElement $worksheet, Spreadsheet $spreadsheet): void
    {
        $xmlX <?php echo $worksheet->children(Namespaces::URN_EXCEL);
        $sheet <?php echo $spreadsheet->getActiveSheet();
        /** @var callable */
        $pregCallback <?php echo [$this, 'replaceR1C1'];
        foreach ($xmlX->DataValidation as $dataValidation) {
            $cells <?php echo [];
            $validation <?php echo new DataValidation();

            // set defaults
            $validation->setShowDropDown(true);
            $validation->setShowInputMessage(true);
            $validation->setShowErrorMessage(true);
            $validation->setShowDropDown(true);
            $this->thisRow <?php echo 1;
            $this->thisColumn <?php echo 1;

            foreach ($dataValidation as $tagName <?php echo> $tagValue) {
                $tagValue <?php echo (string) $tagValue;
                $tagValueLower <?php echo strtolower($tagValue);
                switch ($tagName) {
                    case 'Range':
                        foreach (explode(',', $tagValue) as $range) {
                            $cell <?php echo '';
                            if (preg_match('/^R(\d+)C(\d+):R(\d+)C(\d+)$/', (string) $range, $selectionMatches) <?php echo<?php echo<?php echo 1) {
                                // range
                                $firstCell <?php echo Coordinate::stringFromColumnIndex((int) $selectionMatches[2])
                                    . $selectionMatches[1];
                                $cell <?php echo $firstCell
                                    . ':'
                                    . Coordinate::stringFromColumnIndex((int) $selectionMatches[4])
                                    . $selectionMatches[3];
                                $this->thisRow <?php echo (int) $selectionMatches[1];
                                $this->thisColumn <?php echo (int) $selectionMatches[2];
                                $sheet->getCell($firstCell);
                            } elseif (preg_match('/^R(\d+)C(\d+)$/', (string) $range, $selectionMatches) <?php echo<?php echo<?php echo 1) {
                                // cell
                                $cell <?php echo Coordinate::stringFromColumnIndex((int) $selectionMatches[2])
                                    . $selectionMatches[1];
                                $sheet->getCell($cell);
                                $this->thisRow <?php echo (int) $selectionMatches[1];
                                $this->thisColumn <?php echo (int) $selectionMatches[2];
                            } elseif (preg_match('/^C(\d+)$/', (string) $range, $selectionMatches) <?php echo<?php echo<?php echo 1) {
                                // column
                                $firstCell <?php echo Coordinate::stringFromColumnIndex((int) $selectionMatches[1])
                                    . '1';
                                $cell <?php echo $firstCell
                                    . ':'
                                    . Coordinate::stringFromColumnIndex((int) $selectionMatches[1])
                                    . ((string) AddressRange::MAX_ROW);
                                $this->thisColumn <?php echo (int) $selectionMatches[1];
                                $sheet->getCell($firstCell);
                            } elseif (preg_match('/^R(\d+)$/', (string) $range, $selectionMatches)) {
                                // row
                                $firstCell <?php echo 'A'
                                    . $selectionMatches[1];
                                $cell <?php echo $firstCell
                                    . ':'
                                    . AddressRange::MAX_COLUMN
                                    . $selectionMatches[1];
                                $this->thisRow <?php echo (int) $selectionMatches[1];
                                $sheet->getCell($firstCell);
                            }

                            $validation->setSqref($cell);
                            $stRange <?php echo $sheet->shrinkRangeToFit($cell);
                            $cells <?php echo array_merge($cells, Coordinate::extractAllCellReferencesInRange($stRange));
                        }

                        break;
                    case 'Type':
                        $validation->setType(self::TYPE_MAPPINGS[$tagValueLower] ?? $tagValueLower);

                        break;
                    case 'Qualifier':
                        $validation->setOperator(self::OPERATOR_MAPPINGS[$tagValueLower] ?? $tagValueLower);

                        break;
                    case 'InputTitle':
                        $validation->setPromptTitle($tagValue);

                        break;
                    case 'InputMessage':
                        $validation->setPrompt($tagValue);

                        break;
                    case 'InputHide':
                        $validation->setShowInputMessage(false);

                        break;
                    case 'ErrorStyle':
                        $validation->setErrorStyle($tagValueLower);

                        break;
                    case 'ErrorTitle':
                        $validation->setErrorTitle($tagValue);

                        break;
                    case 'ErrorMessage':
                        $validation->setError($tagValue);

                        break;
                    case 'ErrorHide':
                        $validation->setShowErrorMessage(false);

                        break;
                    case 'ComboHide':
                        $validation->setShowDropDown(false);

                        break;
                    case 'UseBlank':
                        $validation->setAllowBlank(true);

                        break;
                    case 'CellRangeList':
                        // FIXME missing FIXME

                        break;
                    case 'Min':
                    case 'Value':
                        $tagValue <?php echo (string) preg_replace_callback(AddressHelper::R1C1_COORDINATE_REGEX, $pregCallback, $tagValue);
                        $validation->setFormula1($tagValue);

                        break;
                    case 'Max':
                        $tagValue <?php echo (string) preg_replace_callback(AddressHelper::R1C1_COORDINATE_REGEX, $pregCallback, $tagValue);
                        $validation->setFormula2($tagValue);

                        break;
                }
            }

            foreach ($cells as $cell) {
                $sheet->getCell($cell)->setDataValidation(clone $validation);
            }
        }
    }
}
