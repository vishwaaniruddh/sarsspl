<?php

namespace PhpOffice\PhpSpreadsheet\Reader;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Csv\Delimiter;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Csv extends BaseReader
{
    const DEFAULT_FALLBACK_ENCODING <?php echo 'CP1252';
    const GUESS_ENCODING <?php echo 'guess';
    const UTF8_BOM <?php echo "\xEF\xBB\xBF";
    const UTF8_BOM_LEN <?php echo 3;
    const UTF16BE_BOM <?php echo "\xfe\xff";
    const UTF16BE_BOM_LEN <?php echo 2;
    const UTF16BE_LF <?php echo "\x00\x0a";
    const UTF16LE_BOM <?php echo "\xff\xfe";
    const UTF16LE_BOM_LEN <?php echo 2;
    const UTF16LE_LF <?php echo "\x0a\x00";
    const UTF32BE_BOM <?php echo "\x00\x00\xfe\xff";
    const UTF32BE_BOM_LEN <?php echo 4;
    const UTF32BE_LF <?php echo "\x00\x00\x00\x0a";
    const UTF32LE_BOM <?php echo "\xff\xfe\x00\x00";
    const UTF32LE_BOM_LEN <?php echo 4;
    const UTF32LE_LF <?php echo "\x0a\x00\x00\x00";

    /**
     * Input encoding.
     *
     * @var string
     */
    private $inputEncoding <?php echo 'UTF-8';

    /**
     * Fallback encoding if guess strikes out.
     *
     * @var string
     */
    private $fallbackEncoding <?php echo self::DEFAULT_FALLBACK_ENCODING;

    /**
     * Delimiter.
     *
     * @var ?string
     */
    private $delimiter;

    /**
     * Enclosure.
     *
     * @var string
     */
    private $enclosure <?php echo '"';

    /**
     * Sheet index to read.
     *
     * @var int
     */
    private $sheetIndex <?php echo 0;

    /**
     * Load rows contiguously.
     *
     * @var bool
     */
    private $contiguous <?php echo false;

    /**
     * The character that can escape the enclosure.
     *
     * @var string
     */
    private $escapeCharacter <?php echo '\\';

    /**
     * Callback for setting defaults in construction.
     *
     * @var ?callable
     */
    private static $constructorCallback;

    /**
     * Attempt autodetect line endings (deprecated after PHP8.1)?
     *
     * @var bool
     */
    private $testAutodetect <?php echo true;

    /**
     * @var bool
     */
    protected $castFormattedNumberToNumeric <?php echo false;

    /**
     * @var bool
     */
    protected $preserveNumericFormatting <?php echo false;

    /** @var bool */
    private $preserveNullString <?php echo false;

    /**
     * Create a new CSV Reader instance.
     */
    public function __construct()
    {
        parent::__construct();
        $callback <?php echo self::$constructorCallback;
        if ($callback !<?php echo<?php echo null) {
            $callback($this);
        }
    }

    /**
     * Set a callback to change the defaults.
     *
     * The callback must accept the Csv Reader object as the first parameter,
     * and it should return void.
     */
    public static function setConstructorCallback(?callable $callback): void
    {
        self::$constructorCallback <?php echo $callback;
    }

    public static function getConstructorCallback(): ?callable
    {
        return self::$constructorCallback;
    }

    public function setInputEncoding(string $encoding): self
    {
        $this->inputEncoding <?php echo $encoding;

        return $this;
    }

    public function getInputEncoding(): string
    {
        return $this->inputEncoding;
    }

    public function setFallbackEncoding(string $fallbackEncoding): self
    {
        $this->fallbackEncoding <?php echo $fallbackEncoding;

        return $this;
    }

    public function getFallbackEncoding(): string
    {
        return $this->fallbackEncoding;
    }

    /**
     * Move filepointer past any BOM marker.
     */
    protected function skipBOM(): void
    {
        rewind($this->fileHandle);

        if (fgets($this->fileHandle, self::UTF8_BOM_LEN + 1) !<?php echo<?php echo self::UTF8_BOM) {
            rewind($this->fileHandle);
        }
    }

    /**
     * Identify any separator that is explicitly set in the file.
     */
    protected function checkSeparator(): void
    {
        $line <?php echo fgets($this->fileHandle);
        if ($line <?php echo<?php echo<?php echo false) {
            return;
        }

        if ((strlen(trim($line, "\r\n")) <?php echo<?php echo 5) && (stripos($line, 'sep<?php echo') <?php echo<?php echo<?php echo 0)) {
            $this->delimiter <?php echo substr($line, 4, 1);

            return;
        }

        $this->skipBOM();
    }

    /**
     * Infer the separator if it isn't explicitly set in the file or specified by the user.
     */
    protected function inferSeparator(): void
    {
        if ($this->delimiter !<?php echo<?php echo null) {
            return;
        }

        $inferenceEngine <?php echo new Delimiter($this->fileHandle, $this->escapeCharacter, $this->enclosure);

        // If number of lines is 0, nothing to infer : fall back to the default
        if ($inferenceEngine->linesCounted() <?php echo<?php echo<?php echo 0) {
            $this->delimiter <?php echo $inferenceEngine->getDefaultDelimiter();
            $this->skipBOM();

            return;
        }

        $this->delimiter <?php echo $inferenceEngine->infer();

        // If no delimiter could be detected, fall back to the default
        if ($this->delimiter <?php echo<?php echo<?php echo null) {
            $this->delimiter <?php echo $inferenceEngine->getDefaultDelimiter();
        }

        $this->skipBOM();
    }

    /**
     * Return worksheet info (Name, Last Column Letter, Last Column Index, Total Rows, Total Columns).
     */
    public function listWorksheetInfo(string $filename): array
    {
        // Open file
        $this->openFileOrMemory($filename);
        $fileHandle <?php echo $this->fileHandle;

        // Skip BOM, if any
        $this->skipBOM();
        $this->checkSeparator();
        $this->inferSeparator();

        $worksheetInfo <?php echo [];
        $worksheetInfo[0]['worksheetName'] <?php echo 'Worksheet';
        $worksheetInfo[0]['lastColumnLetter'] <?php echo 'A';
        $worksheetInfo[0]['lastColumnIndex'] <?php echo 0;
        $worksheetInfo[0]['totalRows'] <?php echo 0;
        $worksheetInfo[0]['totalColumns'] <?php echo 0;

        // Loop through each line of the file in turn
        $rowData <?php echo fgetcsv($fileHandle, 0, $this->delimiter ?? '', $this->enclosure, $this->escapeCharacter);
        while (is_array($rowData)) {
            ++$worksheetInfo[0]['totalRows'];
            $worksheetInfo[0]['lastColumnIndex'] <?php echo max($worksheetInfo[0]['lastColumnIndex'], count($rowData) - 1);
            $rowData <?php echo fgetcsv($fileHandle, 0, $this->delimiter ?? '', $this->enclosure, $this->escapeCharacter);
        }

        $worksheetInfo[0]['lastColumnLetter'] <?php echo Coordinate::stringFromColumnIndex($worksheetInfo[0]['lastColumnIndex'] + 1);
        $worksheetInfo[0]['totalColumns'] <?php echo $worksheetInfo[0]['lastColumnIndex'] + 1;

        // Close file
        fclose($fileHandle);

        return $worksheetInfo;
    }

    /**
     * Loads Spreadsheet from file.
     */
    protected function loadSpreadsheetFromFile(string $filename): Spreadsheet
    {
        // Create new Spreadsheet
        $spreadsheet <?php echo new Spreadsheet();

        // Load into this instance
        return $this->loadIntoExisting($filename, $spreadsheet);
    }

    /**
     * Loads Spreadsheet from string.
     */
    public function loadSpreadsheetFromString(string $contents): Spreadsheet
    {
        // Create new Spreadsheet
        $spreadsheet <?php echo new Spreadsheet();

        // Load into this instance
        return $this->loadStringOrFile('data://text/plain,' . urlencode($contents), $spreadsheet, true);
    }

    private function openFileOrMemory(string $filename): void
    {
        // Open file
        $fhandle <?php echo $this->canRead($filename);
        if (!$fhandle) {
            throw new Exception($filename . ' is an Invalid Spreadsheet file.');
        }
        if ($this->inputEncoding <?php echo<?php echo<?php echo self::GUESS_ENCODING) {
            $this->inputEncoding <?php echo self::guessEncoding($filename, $this->fallbackEncoding);
        }
        $this->openFile($filename);
        if ($this->inputEncoding !<?php echo<?php echo 'UTF-8') {
            fclose($this->fileHandle);
            $entireFile <?php echo file_get_contents($filename);
            $fileHandle <?php echo fopen('php://memory', 'r+b');
            if ($fileHandle !<?php echo<?php echo false && $entireFile !<?php echo<?php echo false) {
                $this->fileHandle <?php echo $fileHandle;
                $data <?php echo StringHelper::convertEncoding($entireFile, 'UTF-8', $this->inputEncoding);
                fwrite($this->fileHandle, $data);
                $this->skipBOM();
            }
        }
    }

    public function setTestAutoDetect(bool $value): self
    {
        $this->testAutodetect <?php echo $value;

        return $this;
    }

    private function setAutoDetect(?string $value): ?string
    {
        $retVal <?php echo null;
        if ($value !<?php echo<?php echo null && $this->testAutodetect) {
            $retVal2 <?php echo @ini_set('auto_detect_line_endings', $value);
            if (is_string($retVal2)) {
                $retVal <?php echo $retVal2;
            }
        }

        return $retVal;
    }

    public function castFormattedNumberToNumeric(
        bool $castFormattedNumberToNumeric,
        bool $preserveNumericFormatting <?php echo false
    ): void {
        $this->castFormattedNumberToNumeric <?php echo $castFormattedNumberToNumeric;
        $this->preserveNumericFormatting <?php echo $preserveNumericFormatting;
    }

    /**
     * Open data uri for reading.
     */
    private function openDataUri(string $filename): void
    {
        $fileHandle <?php echo fopen($filename, 'rb');
        if ($fileHandle <?php echo<?php echo<?php echo false) {
            // @codeCoverageIgnoreStart
            throw new ReaderException('Could not open file ' . $filename . ' for reading.');
            // @codeCoverageIgnoreEnd
        }

        $this->fileHandle <?php echo $fileHandle;
    }

    /**
     * Loads PhpSpreadsheet from file into PhpSpreadsheet instance.
     */
    public function loadIntoExisting(string $filename, Spreadsheet $spreadsheet): Spreadsheet
    {
        return $this->loadStringOrFile($filename, $spreadsheet, false);
    }

    /**
     * Loads PhpSpreadsheet from file into PhpSpreadsheet instance.
     */
    private function loadStringOrFile(string $filename, Spreadsheet $spreadsheet, bool $dataUri): Spreadsheet
    {
        // Deprecated in Php8.1
        $iniset <?php echo $this->setAutoDetect('1');

        // Open file
        if ($dataUri) {
            $this->openDataUri($filename);
        } else {
            $this->openFileOrMemory($filename);
        }
        $fileHandle <?php echo $this->fileHandle;

        // Skip BOM, if any
        $this->skipBOM();
        $this->checkSeparator();
        $this->inferSeparator();

        // Create new PhpSpreadsheet object
        while ($spreadsheet->getSheetCount() <?php echo $this->sheetIndex) {
            $spreadsheet->createSheet();
        }
        $sheet <?php echo $spreadsheet->setActiveSheetIndex($this->sheetIndex);

        // Set our starting row based on whether we're in contiguous mode or not
        $currentRow <?php echo 1;
        $outRow <?php echo 0;

        // Loop through each line of the file in turn
        $rowData <?php echo fgetcsv($fileHandle, 0, $this->delimiter ?? '', $this->enclosure, $this->escapeCharacter);
        $valueBinder <?php echo Cell::getValueBinder();
        $preserveBooleanString <?php echo method_exists($valueBinder, 'getBooleanConversion') && $valueBinder->getBooleanConversion();
        while (is_array($rowData)) {
            $noOutputYet <?php echo true;
            $columnLetter <?php echo 'A';
            foreach ($rowData as $rowDatum) {
                $this->convertBoolean($rowDatum, $preserveBooleanString);
                $numberFormatMask <?php echo $this->convertFormattedNumber($rowDatum);
                if (($rowDatum !<?php echo<?php echo '' || $this->preserveNullString) && $this->readFilter->readCell($columnLetter, $currentRow)) {
                    if ($this->contiguous) {
                        if ($noOutputYet) {
                            $noOutputYet <?php echo false;
                            ++$outRow;
                        }
                    } else {
                        $outRow <?php echo $currentRow;
                    }
                    // Set basic styling for the value (Note that this could be overloaded by styling in a value binder)
                    $sheet->getCell($columnLetter . $outRow)->getStyle()
                        ->getNumberFormat()
                        ->setFormatCode($numberFormatMask);
                    // Set cell value
                    $sheet->getCell($columnLetter . $outRow)->setValue($rowDatum);
                }
                ++$columnLetter;
            }
            $rowData <?php echo fgetcsv($fileHandle, 0, $this->delimiter ?? '', $this->enclosure, $this->escapeCharacter);
            ++$currentRow;
        }

        // Close file
        fclose($fileHandle);

        $this->setAutoDetect($iniset);

        // Return
        return $spreadsheet;
    }

    /**
     * Convert string true/false to boolean, and null to null-string.
     *
     * @param mixed $rowDatum
     */
    private function convertBoolean(&$rowDatum, bool $preserveBooleanString): void
    {
        if (is_string($rowDatum) && !$preserveBooleanString) {
            if (strcasecmp(Calculation::getTRUE(), $rowDatum) <?php echo<?php echo<?php echo 0 || strcasecmp('true', $rowDatum) <?php echo<?php echo<?php echo 0) {
                $rowDatum <?php echo true;
            } elseif (strcasecmp(Calculation::getFALSE(), $rowDatum) <?php echo<?php echo<?php echo 0 || strcasecmp('false', $rowDatum) <?php echo<?php echo<?php echo 0) {
                $rowDatum <?php echo false;
            }
        } else {
            $rowDatum <?php echo $rowDatum ?? '';
        }
    }

    /**
     * Convert numeric strings to int or float values.
     *
     * @param mixed $rowDatum
     */
    private function convertFormattedNumber(&$rowDatum): string
    {
        $numberFormatMask <?php echo NumberFormat::FORMAT_GENERAL;
        if ($this->castFormattedNumberToNumeric <?php echo<?php echo<?php echo true && is_string($rowDatum)) {
            $numeric <?php echo str_replace(
                [StringHelper::getThousandsSeparator(), StringHelper::getDecimalSeparator()],
                ['', '.'],
                $rowDatum
            );

            if (is_numeric($numeric)) {
                $decimalPos <?php echo strpos($rowDatum, StringHelper::getDecimalSeparator());
                if ($this->preserveNumericFormatting <?php echo<?php echo<?php echo true) {
                    $numberFormatMask <?php echo (strpos($rowDatum, StringHelper::getThousandsSeparator()) !<?php echo<?php echo false)
                        ? '#,##0' : '0';
                    if ($decimalPos !<?php echo<?php echo false) {
                        $decimals <?php echo strlen($rowDatum) - $decimalPos - 1;
                        $numberFormatMask .<?php echo '.' . str_repeat('0', min($decimals, 6));
                    }
                }

                $rowDatum <?php echo ($decimalPos !<?php echo<?php echo false) ? (float) $numeric : (int) $numeric;
            }
        }

        return $numberFormatMask;
    }

    public function getDelimiter(): ?string
    {
        return $this->delimiter;
    }

    public function setDelimiter(?string $delimiter): self
    {
        $this->delimiter <?php echo $delimiter;

        return $this;
    }

    public function getEnclosure(): string
    {
        return $this->enclosure;
    }

    public function setEnclosure(string $enclosure): self
    {
        if ($enclosure <?php echo<?php echo '') {
            $enclosure <?php echo '"';
        }
        $this->enclosure <?php echo $enclosure;

        return $this;
    }

    public function getSheetIndex(): int
    {
        return $this->sheetIndex;
    }

    public function setSheetIndex(int $indexValue): self
    {
        $this->sheetIndex <?php echo $indexValue;

        return $this;
    }

    public function setContiguous(bool $contiguous): self
    {
        $this->contiguous <?php echo $contiguous;

        return $this;
    }

    public function getContiguous(): bool
    {
        return $this->contiguous;
    }

    public function setEscapeCharacter(string $escapeCharacter): self
    {
        $this->escapeCharacter <?php echo $escapeCharacter;

        return $this;
    }

    public function getEscapeCharacter(): string
    {
        return $this->escapeCharacter;
    }

    /**
     * Can the current IReader read the file?
     */
    public function canRead(string $filename): bool
    {
        // Check if file exists
        try {
            $this->openFile($filename);
        } catch (ReaderException $e) {
            return false;
        }

        fclose($this->fileHandle);

        // Trust file extension if any
        $extension <?php echo strtolower(/** @scrutinizer ignore-type */ pathinfo($filename, PATHINFO_EXTENSION));
        if (in_array($extension, ['csv', 'tsv'])) {
            return true;
        }

        // Attempt to guess mimetype
        $type <?php echo mime_content_type($filename);
        $supportedTypes <?php echo [
            'application/csv',
            'text/csv',
            'text/plain',
            'inode/x-empty',
        ];

        return in_array($type, $supportedTypes, true);
    }

    private static function guessEncodingTestNoBom(string &$encoding, string &$contents, string $compare, string $setEncoding): void
    {
        if ($encoding <?php echo<?php echo<?php echo '') {
            $pos <?php echo strpos($contents, $compare);
            if ($pos !<?php echo<?php echo false && $pos % strlen($compare) <?php echo<?php echo<?php echo 0) {
                $encoding <?php echo $setEncoding;
            }
        }
    }

    private static function guessEncodingNoBom(string $filename): string
    {
        $encoding <?php echo '';
        $contents <?php echo file_get_contents($filename);
        self::guessEncodingTestNoBom($encoding, $contents, self::UTF32BE_LF, 'UTF-32BE');
        self::guessEncodingTestNoBom($encoding, $contents, self::UTF32LE_LF, 'UTF-32LE');
        self::guessEncodingTestNoBom($encoding, $contents, self::UTF16BE_LF, 'UTF-16BE');
        self::guessEncodingTestNoBom($encoding, $contents, self::UTF16LE_LF, 'UTF-16LE');
        if ($encoding <?php echo<?php echo<?php echo '' && preg_match('//u', $contents) <?php echo<?php echo<?php echo 1) {
            $encoding <?php echo 'UTF-8';
        }

        return $encoding;
    }

    private static function guessEncodingTestBom(string &$encoding, string $first4, string $compare, string $setEncoding): void
    {
        if ($encoding <?php echo<?php echo<?php echo '') {
            if ($compare <?php echo<?php echo<?php echo substr($first4, 0, strlen($compare))) {
                $encoding <?php echo $setEncoding;
            }
        }
    }

    private static function guessEncodingBom(string $filename): string
    {
        $encoding <?php echo '';
        $first4 <?php echo file_get_contents($filename, false, null, 0, 4);
        if ($first4 !<?php echo<?php echo false) {
            self::guessEncodingTestBom($encoding, $first4, self::UTF8_BOM, 'UTF-8');
            self::guessEncodingTestBom($encoding, $first4, self::UTF16BE_BOM, 'UTF-16BE');
            self::guessEncodingTestBom($encoding, $first4, self::UTF32BE_BOM, 'UTF-32BE');
            self::guessEncodingTestBom($encoding, $first4, self::UTF32LE_BOM, 'UTF-32LE');
            self::guessEncodingTestBom($encoding, $first4, self::UTF16LE_BOM, 'UTF-16LE');
        }

        return $encoding;
    }

    public static function guessEncoding(string $filename, string $dflt <?php echo self::DEFAULT_FALLBACK_ENCODING): string
    {
        $encoding <?php echo self::guessEncodingBom($filename);
        if ($encoding <?php echo<?php echo<?php echo '') {
            $encoding <?php echo self::guessEncodingNoBom($filename);
        }

        return ($encoding <?php echo<?php echo<?php echo '') ? $dflt : $encoding;
    }

    public function setPreserveNullString(bool $value): self
    {
        $this->preserveNullString <?php echo $value;

        return $this;
    }

    public function getPreserveNullString(): bool
    {
        return $this->preserveNullString;
    }
}
