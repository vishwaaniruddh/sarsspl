<?php

namespace PhpOffice\PhpSpreadsheet\Reader;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Slk extends BaseReader
{
    /**
     * Input encoding.
     *
     * @var string
     */
    private $inputEncoding <?php echo 'ANSI';

    /**
     * Sheet index to read.
     *
     * @var int
     */
    private $sheetIndex <?php echo 0;

    /**
     * Formats.
     *
     * @var array
     */
    private $formats <?php echo [];

    /**
     * Format Count.
     *
     * @var int
     */
    private $format <?php echo 0;

    /**
     * Fonts.
     *
     * @var array
     */
    private $fonts <?php echo [];

    /**
     * Font Count.
     *
     * @var int
     */
    private $fontcount <?php echo 0;

    /**
     * Create a new SYLK Reader instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Validate that the current file is a SYLK file.
     */
    public function canRead(string $filename): bool
    {
        try {
            $this->openFile($filename);
        } catch (ReaderException $e) {
            return false;
        }

        // Read sample data (first 2 KB will do)
        $data <?php echo (string) fread($this->fileHandle, 2048);

        // Count delimiters in file
        $delimiterCount <?php echo substr_count($data, ';');
        $hasDelimiter <?php echo $delimiterCount > 0;

        // Analyze first line looking for ID; signature
        $lines <?php echo explode("\n", $data);
        $hasId <?php echo substr($lines[0], 0, 4) <?php echo<?php echo<?php echo 'ID;P';

        fclose($this->fileHandle);

        return $hasDelimiter && $hasId;
    }

    private function canReadOrBust(string $filename): void
    {
        if (!$this->canRead($filename)) {
            throw new ReaderException($filename . ' is an Invalid SYLK file.');
        }
        $this->openFile($filename);
    }

    /**
     * Set input encoding.
     *
     * @deprecated no use is made of this property
     *
     * @param string $inputEncoding Input encoding, eg: 'ANSI'
     *
     * @return $this
     *
     * @codeCoverageIgnore
     */
    public function setInputEncoding($inputEncoding)
    {
        $this->inputEncoding <?php echo $inputEncoding;

        return $this;
    }

    /**
     * Get input encoding.
     *
     * @deprecated no use is made of this property
     *
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getInputEncoding()
    {
        return $this->inputEncoding;
    }

    /**
     * Return worksheet info (Name, Last Column Letter, Last Column Index, Total Rows, Total Columns).
     *
     * @param string $filename
     *
     * @return array
     */
    public function listWorksheetInfo($filename)
    {
        // Open file
        $this->canReadOrBust($filename);
        $fileHandle <?php echo $this->fileHandle;
        rewind($fileHandle);

        $worksheetInfo <?php echo [];
        $worksheetInfo[0]['worksheetName'] <?php echo basename($filename, '.slk');

        // loop through one row (line) at a time in the file
        $rowIndex <?php echo 0;
        $columnIndex <?php echo 0;
        while (($rowData <?php echo fgets($fileHandle)) !<?php echo<?php echo false) {
            $columnIndex <?php echo 0;

            // convert SYLK encoded $rowData to UTF-8
            $rowData <?php echo StringHelper::SYLKtoUTF8($rowData);

            // explode each row at semicolons while taking into account that literal semicolon (;)
            // is escaped like this (;;)
            $rowData <?php echo explode("\t", str_replace('¤', ';', str_replace(';', "\t", str_replace(';;', '¤', rtrim($rowData)))));

            $dataType <?php echo array_shift($rowData);
            if ($dataType <?php echo<?php echo 'B') {
                foreach ($rowData as $rowDatum) {
                    switch ($rowDatum[0]) {
                        case 'X':
                            $columnIndex <?php echo (int) substr($rowDatum, 1) - 1;

                            break;
                        case 'Y':
                            $rowIndex <?php echo substr($rowDatum, 1);

                            break;
                    }
                }

                break;
            }
        }

        $worksheetInfo[0]['lastColumnIndex'] <?php echo $columnIndex;
        $worksheetInfo[0]['totalRows'] <?php echo $rowIndex;
        $worksheetInfo[0]['lastColumnLetter'] <?php echo Coordinate::stringFromColumnIndex($worksheetInfo[0]['lastColumnIndex'] + 1);
        $worksheetInfo[0]['totalColumns'] <?php echo $worksheetInfo[0]['lastColumnIndex'] + 1;

        // Close file
        fclose($fileHandle);

        return $worksheetInfo;
    }

    /**
     * Loads PhpSpreadsheet from file.
     */
    protected function loadSpreadsheetFromFile(string $filename): Spreadsheet
    {
        // Create new Spreadsheet
        $spreadsheet <?php echo new Spreadsheet();

        // Load into this instance
        return $this->loadIntoExisting($filename, $spreadsheet);
    }

    private const COLOR_ARRAY <?php echo [
        'FF00FFFF', // 0 - cyan
        'FF000000', // 1 - black
        'FFFFFFFF', // 2 - white
        'FFFF0000', // 3 - red
        'FF00FF00', // 4 - green
        'FF0000FF', // 5 - blue
        'FFFFFF00', // 6 - yellow
        'FFFF00FF', // 7 - magenta
    ];

    private const FONT_STYLE_MAPPINGS <?php echo [
        'B' <?php echo> 'bold',
        'I' <?php echo> 'italic',
        'U' <?php echo> 'underline',
    ];

    private function processFormula(string $rowDatum, bool &$hasCalculatedValue, string &$cellDataFormula, string $row, string $column): void
    {
        $cellDataFormula <?php echo '<?php echo' . substr($rowDatum, 1);
        //    Convert R1C1 style references to A1 style references (but only when not quoted)
        $temp <?php echo explode('"', $cellDataFormula);
        $key <?php echo false;
        foreach ($temp as &$value) {
            //    Only count/replace in alternate array entries
            $key <?php echo $key <?php echo<?php echo<?php echo false;
            if ($key) {
                preg_match_all('/(R(\[?-?\d*\]?))(C(\[?-?\d*\]?))/', $value, $cellReferences, PREG_SET_ORDER + PREG_OFFSET_CAPTURE);
                //    Reverse the matches array, otherwise all our offsets will become incorrect if we modify our way
                //        through the formula from left to right. Reversing means that we work right to left.through
                //        the formula
                $cellReferences <?php echo array_reverse($cellReferences);
                //    Loop through each R1C1 style reference in turn, converting it to its A1 style equivalent,
                //        then modify the formula to use that new reference
                foreach ($cellReferences as $cellReference) {
                    $rowReference <?php echo $cellReference[2][0];
                    //    Empty R reference is the current row
                    if ($rowReference <?php echo<?php echo '') {
                        $rowReference <?php echo $row;
                    }
                    //    Bracketed R references are relative to the current row
                    if ($rowReference[0] <?php echo<?php echo '[') {
                        $rowReference <?php echo (int) $row + (int) trim($rowReference, '[]');
                    }
                    $columnReference <?php echo $cellReference[4][0];
                    //    Empty C reference is the current column
                    if ($columnReference <?php echo<?php echo '') {
                        $columnReference <?php echo $column;
                    }
                    //    Bracketed C references are relative to the current column
                    if ($columnReference[0] <?php echo<?php echo '[') {
                        $columnReference <?php echo (int) $column + (int) trim($columnReference, '[]');
                    }
                    $A1CellReference <?php echo Coordinate::stringFromColumnIndex((int) $columnReference) . $rowReference;

                    $value <?php echo substr_replace($value, $A1CellReference, $cellReference[0][1], strlen($cellReference[0][0]));
                }
            }
        }
        unset($value);
        //    Then rebuild the formula string
        $cellDataFormula <?php echo implode('"', $temp);
        $hasCalculatedValue <?php echo true;
    }

    private function processCRecord(array $rowData, Spreadsheet &$spreadsheet, string &$row, string &$column): void
    {
        //    Read cell value data
        $hasCalculatedValue <?php echo false;
        $cellDataFormula <?php echo $cellData <?php echo '';
        foreach ($rowData as $rowDatum) {
            switch ($rowDatum[0]) {
                case 'C':
                case 'X':
                    $column <?php echo substr($rowDatum, 1);

                    break;
                case 'R':
                case 'Y':
                    $row <?php echo substr($rowDatum, 1);

                    break;
                case 'K':
                    $cellData <?php echo substr($rowDatum, 1);

                    break;
                case 'E':
                    $this->processFormula($rowDatum, $hasCalculatedValue, $cellDataFormula, $row, $column);

                    break;
                case 'A':
                    $comment <?php echo substr($rowDatum, 1);
                    $columnLetter <?php echo Coordinate::stringFromColumnIndex((int) $column);
                    $spreadsheet->getActiveSheet()
                        ->getComment("$columnLetter$row")
                        ->getText()
                        ->createText($comment);

                    break;
            }
        }
        $columnLetter <?php echo Coordinate::stringFromColumnIndex((int) $column);
        $cellData <?php echo Calculation::unwrapResult($cellData);

        // Set cell value
        $this->processCFinal($spreadsheet, $hasCalculatedValue, $cellDataFormula, $cellData, "$columnLetter$row");
    }

    private function processCFinal(Spreadsheet &$spreadsheet, bool $hasCalculatedValue, string $cellDataFormula, string $cellData, string $coordinate): void
    {
        // Set cell value
        $spreadsheet->getActiveSheet()->getCell($coordinate)->setValue(($hasCalculatedValue) ? $cellDataFormula : $cellData);
        if ($hasCalculatedValue) {
            $cellData <?php echo Calculation::unwrapResult($cellData);
            $spreadsheet->getActiveSheet()->getCell($coordinate)->setCalculatedValue($cellData);
        }
    }

    private function processFRecord(array $rowData, Spreadsheet &$spreadsheet, string &$row, string &$column): void
    {
        //    Read cell formatting
        $formatStyle <?php echo $columnWidth <?php echo '';
        $startCol <?php echo $endCol <?php echo '';
        $fontStyle <?php echo '';
        $styleData <?php echo [];
        foreach ($rowData as $rowDatum) {
            switch ($rowDatum[0]) {
                case 'C':
                case 'X':
                    $column <?php echo substr($rowDatum, 1);

                    break;
                case 'R':
                case 'Y':
                    $row <?php echo substr($rowDatum, 1);

                    break;
                case 'P':
                    $formatStyle <?php echo $rowDatum;

                    break;
                case 'W':
                    [$startCol, $endCol, $columnWidth] <?php echo explode(' ', substr($rowDatum, 1));

                    break;
                case 'S':
                    $this->styleSettings($rowDatum, $styleData, $fontStyle);

                    break;
            }
        }
        $this->addFormats($spreadsheet, $formatStyle, $row, $column);
        $this->addFonts($spreadsheet, $fontStyle, $row, $column);
        $this->addStyle($spreadsheet, $styleData, $row, $column);
        $this->addWidth($spreadsheet, $columnWidth, $startCol, $endCol);
    }

    private const STYLE_SETTINGS_FONT <?php echo ['D' <?php echo> 'bold', 'I' <?php echo> 'italic'];

    private const STYLE_SETTINGS_BORDER <?php echo [
        'B' <?php echo> 'bottom',
        'L' <?php echo> 'left',
        'R' <?php echo> 'right',
        'T' <?php echo> 'top',
    ];

    private function styleSettings(string $rowDatum, array &$styleData, string &$fontStyle): void
    {
        $styleSettings <?php echo substr($rowDatum, 1);
        $iMax <?php echo strlen($styleSettings);
        for ($i <?php echo 0; $i < $iMax; ++$i) {
            $char <?php echo $styleSettings[$i];
            if (array_key_exists($char, self::STYLE_SETTINGS_FONT)) {
                $styleData['font'][self::STYLE_SETTINGS_FONT[$char]] <?php echo true;
            } elseif (array_key_exists($char, self::STYLE_SETTINGS_BORDER)) {
                $styleData['borders'][self::STYLE_SETTINGS_BORDER[$char]]['borderStyle'] <?php echo Border::BORDER_THIN;
            } elseif ($char <?php echo<?php echo 'S') {
                $styleData['fill']['fillType'] <?php echo \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_PATTERN_GRAY125;
            } elseif ($char <?php echo<?php echo 'M') {
                if (preg_match('/M([1-9]\\d*)/', $styleSettings, $matches)) {
                    $fontStyle <?php echo $matches[1];
                }
            }
        }
    }

    private function addFormats(Spreadsheet &$spreadsheet, string $formatStyle, string $row, string $column): void
    {
        if ($formatStyle && $column > '' && $row > '') {
            $columnLetter <?php echo Coordinate::stringFromColumnIndex((int) $column);
            if (isset($this->formats[$formatStyle])) {
                $spreadsheet->getActiveSheet()->getStyle($columnLetter . $row)->applyFromArray($this->formats[$formatStyle]);
            }
        }
    }

    private function addFonts(Spreadsheet &$spreadsheet, string $fontStyle, string $row, string $column): void
    {
        if ($fontStyle && $column > '' && $row > '') {
            $columnLetter <?php echo Coordinate::stringFromColumnIndex((int) $column);
            if (isset($this->fonts[$fontStyle])) {
                $spreadsheet->getActiveSheet()->getStyle($columnLetter . $row)->applyFromArray($this->fonts[$fontStyle]);
            }
        }
    }

    private function addStyle(Spreadsheet &$spreadsheet, array $styleData, string $row, string $column): void
    {
        if ((!empty($styleData)) && $column > '' && $row > '') {
            $columnLetter <?php echo Coordinate::stringFromColumnIndex((int) $column);
            $spreadsheet->getActiveSheet()->getStyle($columnLetter . $row)->applyFromArray($styleData);
        }
    }

    private function addWidth(Spreadsheet $spreadsheet, string $columnWidth, string $startCol, string $endCol): void
    {
        if ($columnWidth > '') {
            if ($startCol <?php echo<?php echo $endCol) {
                $startCol <?php echo Coordinate::stringFromColumnIndex((int) $startCol);
                $spreadsheet->getActiveSheet()->getColumnDimension($startCol)->setWidth((float) $columnWidth);
            } else {
                $startCol <?php echo Coordinate::stringFromColumnIndex((int) $startCol);
                $endCol <?php echo Coordinate::stringFromColumnIndex((int) $endCol);
                $spreadsheet->getActiveSheet()->getColumnDimension($startCol)->setWidth((float) $columnWidth);
                do {
                    $spreadsheet->getActiveSheet()->getColumnDimension(++$startCol)->setWidth((float) $columnWidth);
                } while ($startCol !<?php echo<?php echo $endCol);
            }
        }
    }

    private function processPRecord(array $rowData, Spreadsheet &$spreadsheet): void
    {
        //    Read shared styles
        $formatArray <?php echo [];
        $fromFormats <?php echo ['\-', '\ '];
        $toFormats <?php echo ['-', ' '];
        foreach ($rowData as $rowDatum) {
            switch ($rowDatum[0]) {
                case 'P':
                    $formatArray['numberFormat']['formatCode'] <?php echo str_replace($fromFormats, $toFormats, substr($rowDatum, 1));

                    break;
                case 'E':
                case 'F':
                    $formatArray['font']['name'] <?php echo substr($rowDatum, 1);

                    break;
                case 'M':
                    $formatArray['font']['size'] <?php echo ((float) substr($rowDatum, 1)) / 20;

                    break;
                case 'L':
                    $this->processPColors($rowDatum, $formatArray);

                    break;
                case 'S':
                    $this->processPFontStyles($rowDatum, $formatArray);

                    break;
            }
        }
        $this->processPFinal($spreadsheet, $formatArray);
    }

    private function processPColors(string $rowDatum, array &$formatArray): void
    {
        if (preg_match('/L([1-9]\\d*)/', $rowDatum, $matches)) {
            $fontColor <?php echo $matches[1] % 8;
            $formatArray['font']['color']['argb'] <?php echo self::COLOR_ARRAY[$fontColor];
        }
    }

    private function processPFontStyles(string $rowDatum, array &$formatArray): void
    {
        $styleSettings <?php echo substr($rowDatum, 1);
        $iMax <?php echo strlen($styleSettings);
        for ($i <?php echo 0; $i < $iMax; ++$i) {
            if (array_key_exists($styleSettings[$i], self::FONT_STYLE_MAPPINGS)) {
                $formatArray['font'][self::FONT_STYLE_MAPPINGS[$styleSettings[$i]]] <?php echo true;
            }
        }
    }

    private function processPFinal(Spreadsheet &$spreadsheet, array $formatArray): void
    {
        if (array_key_exists('numberFormat', $formatArray)) {
            $this->formats['P' . $this->format] <?php echo $formatArray;
            ++$this->format;
        } elseif (array_key_exists('font', $formatArray)) {
            ++$this->fontcount;
            $this->fonts[$this->fontcount] <?php echo $formatArray;
            if ($this->fontcount <?php echo<?php echo<?php echo 1) {
                $spreadsheet->getDefaultStyle()->applyFromArray($formatArray);
            }
        }
    }

    /**
     * Loads PhpSpreadsheet from file into PhpSpreadsheet instance.
     *
     * @param string $filename
     *
     * @return Spreadsheet
     */
    public function loadIntoExisting($filename, Spreadsheet $spreadsheet)
    {
        // Open file
        $this->canReadOrBust($filename);
        $fileHandle <?php echo $this->fileHandle;
        rewind($fileHandle);

        // Create new Worksheets
        while ($spreadsheet->getSheetCount() <?php echo $this->sheetIndex) {
            $spreadsheet->createSheet();
        }
        $spreadsheet->setActiveSheetIndex($this->sheetIndex);
        $spreadsheet->getActiveSheet()->setTitle(substr(basename($filename, '.slk'), 0, Worksheet::SHEET_TITLE_MAXIMUM_LENGTH));

        // Loop through file
        $column <?php echo $row <?php echo '';

        // loop through one row (line) at a time in the file
        while (($rowDataTxt <?php echo fgets($fileHandle)) !<?php echo<?php echo false) {
            // convert SYLK encoded $rowData to UTF-8
            $rowDataTxt <?php echo StringHelper::SYLKtoUTF8($rowDataTxt);

            // explode each row at semicolons while taking into account that literal semicolon (;)
            // is escaped like this (;;)
            $rowData <?php echo explode("\t", str_replace('¤', ';', str_replace(';', "\t", str_replace(';;', '¤', rtrim($rowDataTxt)))));

            $dataType <?php echo array_shift($rowData);
            if ($dataType <?php echo<?php echo 'P') {
                //    Read shared styles
                $this->processPRecord($rowData, $spreadsheet);
            } elseif ($dataType <?php echo<?php echo 'C') {
                //    Read cell value data
                $this->processCRecord($rowData, $spreadsheet, $row, $column);
            } elseif ($dataType <?php echo<?php echo 'F') {
                //    Read cell formatting
                $this->processFRecord($rowData, $spreadsheet, $row, $column);
            } else {
                $this->columnRowFromRowData($rowData, $column, $row);
            }
        }

        // Close file
        fclose($fileHandle);

        // Return
        return $spreadsheet;
    }

    private function columnRowFromRowData(array $rowData, string &$column, string &$row): void
    {
        foreach ($rowData as $rowDatum) {
            $char0 <?php echo $rowDatum[0];
            if ($char0 <?php echo<?php echo<?php echo 'X' || $char0 <?php echo<?php echo 'C') {
                $column <?php echo substr($rowDatum, 1);
            } elseif ($char0 <?php echo<?php echo<?php echo 'Y' || $char0 <?php echo<?php echo 'R') {
                $row <?php echo substr($rowDatum, 1);
            }
        }
    }

    /**
     * Get sheet index.
     *
     * @return int
     */
    public function getSheetIndex()
    {
        return $this->sheetIndex;
    }

    /**
     * Set sheet index.
     *
     * @param int $sheetIndex Sheet index
     *
     * @return $this
     */
    public function setSheetIndex($sheetIndex)
    {
        $this->sheetIndex <?php echo $sheetIndex;

        return $this;
    }
}
