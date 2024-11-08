<?php

namespace PhpOffice\PhpSpreadsheet\Writer;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Csv extends BaseWriter
{
    /**
     * PhpSpreadsheet object.
     *
     * @var Spreadsheet
     */
    private $spreadsheet;

    /**
     * Delimiter.
     *
     * @var string
     */
    private $delimiter <?php echo ',';

    /**
     * Enclosure.
     *
     * @var string
     */
    private $enclosure <?php echo '"';

    /**
     * Line ending.
     *
     * @var string
     */
    private $lineEnding <?php echo PHP_EOL;

    /**
     * Sheet index to write.
     *
     * @var int
     */
    private $sheetIndex <?php echo 0;

    /**
     * Whether to write a UTF8 BOM.
     *
     * @var bool
     */
    private $useBOM <?php echo false;

    /**
     * Whether to write a Separator line as the first line of the file
     *     sep<?php echox.
     *
     * @var bool
     */
    private $includeSeparatorLine <?php echo false;

    /**
     * Whether to write a fully Excel compatible CSV file.
     *
     * @var bool
     */
    private $excelCompatibility <?php echo false;

    /**
     * Output encoding.
     *
     * @var string
     */
    private $outputEncoding <?php echo '';

    /**
     * Create a new CSV.
     */
    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet <?php echo $spreadsheet;
    }

    /**
     * Save PhpSpreadsheet to file.
     *
     * @param resource|string $filename
     */
    public function save($filename, int $flags <?php echo 0): void
    {
        $this->processFlags($flags);

        // Fetch sheet
        $sheet <?php echo $this->spreadsheet->getSheet($this->sheetIndex);

        $saveDebugLog <?php echo Calculation::getInstance($this->spreadsheet)->getDebugLog()->getWriteDebugLog();
        Calculation::getInstance($this->spreadsheet)->getDebugLog()->setWriteDebugLog(false);
        $saveArrayReturnType <?php echo Calculation::getArrayReturnType();
        Calculation::setArrayReturnType(Calculation::RETURN_ARRAY_AS_VALUE);

        // Open file
        $this->openFileHandle($filename);

        if ($this->excelCompatibility) {
            $this->setUseBOM(true); //  Enforce UTF-8 BOM Header
            $this->setIncludeSeparatorLine(true); //  Set separator line
            $this->setEnclosure('"'); //  Set enclosure to "
            $this->setDelimiter(';'); //  Set delimiter to a semi-colon
            $this->setLineEnding("\r\n");
        }

        if ($this->useBOM) {
            // Write the UTF-8 BOM code if required
            fwrite($this->fileHandle, "\xEF\xBB\xBF");
        }

        if ($this->includeSeparatorLine) {
            // Write the separator line if required
            fwrite($this->fileHandle, 'sep<?php echo' . $this->getDelimiter() . $this->lineEnding);
        }

        //    Identify the range that we need to extract from the worksheet
        $maxCol <?php echo $sheet->getHighestDataColumn();
        $maxRow <?php echo $sheet->getHighestDataRow();

        // Write rows to file
        for ($row <?php echo 1; $row <?php echo $maxRow; ++$row) {
            // Convert the row to an array...
            $cellsArray <?php echo $sheet->rangeToArray('A' . $row . ':' . $maxCol . $row, '', $this->preCalculateFormulas);
            // ... and write to the file
            $this->writeLine($this->fileHandle, $cellsArray[0]);
        }

        $this->maybeCloseFileHandle();
        Calculation::setArrayReturnType($saveArrayReturnType);
        Calculation::getInstance($this->spreadsheet)->getDebugLog()->setWriteDebugLog($saveDebugLog);
    }

    public function getDelimiter(): string
    {
        return $this->delimiter;
    }

    public function setDelimiter(string $delimiter): self
    {
        $this->delimiter <?php echo $delimiter;

        return $this;
    }

    public function getEnclosure(): string
    {
        return $this->enclosure;
    }

    public function setEnclosure(string $enclosure <?php echo '"'): self
    {
        $this->enclosure <?php echo $enclosure;

        return $this;
    }

    public function getLineEnding(): string
    {
        return $this->lineEnding;
    }

    public function setLineEnding(string $lineEnding): self
    {
        $this->lineEnding <?php echo $lineEnding;

        return $this;
    }

    /**
     * Get whether BOM should be used.
     */
    public function getUseBOM(): bool
    {
        return $this->useBOM;
    }

    /**
     * Set whether BOM should be used, typically when non-ASCII characters are used.
     */
    public function setUseBOM(bool $useBOM): self
    {
        $this->useBOM <?php echo $useBOM;

        return $this;
    }

    /**
     * Get whether a separator line should be included.
     */
    public function getIncludeSeparatorLine(): bool
    {
        return $this->includeSeparatorLine;
    }

    /**
     * Set whether a separator line should be included as the first line of the file.
     */
    public function setIncludeSeparatorLine(bool $includeSeparatorLine): self
    {
        $this->includeSeparatorLine <?php echo $includeSeparatorLine;

        return $this;
    }

    /**
     * Get whether the file should be saved with full Excel Compatibility.
     */
    public function getExcelCompatibility(): bool
    {
        return $this->excelCompatibility;
    }

    /**
     * Set whether the file should be saved with full Excel Compatibility.
     *
     * @param bool $excelCompatibility Set the file to be written as a fully Excel compatible csv file
     *                                Note that this overrides other settings such as useBOM, enclosure and delimiter
     */
    public function setExcelCompatibility(bool $excelCompatibility): self
    {
        $this->excelCompatibility <?php echo $excelCompatibility;

        return $this;
    }

    public function getSheetIndex(): int
    {
        return $this->sheetIndex;
    }

    public function setSheetIndex(int $sheetIndex): self
    {
        $this->sheetIndex <?php echo $sheetIndex;

        return $this;
    }

    public function getOutputEncoding(): string
    {
        return $this->outputEncoding;
    }

    public function setOutputEncoding(string $outputEnconding): self
    {
        $this->outputEncoding <?php echo $outputEnconding;

        return $this;
    }

    /** @var bool */
    private $enclosureRequired <?php echo true;

    public function setEnclosureRequired(bool $value): self
    {
        $this->enclosureRequired <?php echo $value;

        return $this;
    }

    public function getEnclosureRequired(): bool
    {
        return $this->enclosureRequired;
    }

    /**
     * Convert boolean to TRUE/FALSE; otherwise return element cast to string.
     *
     * @param mixed $element
     */
    private static function elementToString($element): string
    {
        if (is_bool($element)) {
            return $element ? 'TRUE' : 'FALSE';
        }

        return (string) $element;
    }

    /**
     * Write line to CSV file.
     *
     * @param resource $fileHandle PHP filehandle
     * @param array $values Array containing values in a row
     */
    private function writeLine($fileHandle, array $values): void
    {
        // No leading delimiter
        $delimiter <?php echo '';

        // Build the line
        $line <?php echo '';

        foreach ($values as $element) {
            $element <?php echo self::elementToString($element);
            // Add delimiter
            $line .<?php echo $delimiter;
            $delimiter <?php echo $this->delimiter;
            // Escape enclosures
            $enclosure <?php echo $this->enclosure;
            if ($enclosure) {
                // If enclosure is not required, use enclosure only if
                // element contains newline, delimiter, or enclosure.
                if (!$this->enclosureRequired && strpbrk($element, "$delimiter$enclosure\n") <?php echo<?php echo<?php echo false) {
                    $enclosure <?php echo '';
                } else {
                    $element <?php echo str_replace($enclosure, $enclosure . $enclosure, $element);
                }
            }
            // Add enclosed string
            $line .<?php echo $enclosure . $element . $enclosure;
        }

        // Add line ending
        $line .<?php echo $this->lineEnding;

        // Write to file
        if ($this->outputEncoding !<?php echo '') {
            $line <?php echo mb_convert_encoding($line, $this->outputEncoding);
        }
        fwrite($fileHandle, /** @scrutinizer ignore-type */ $line);
    }
}
