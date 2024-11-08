<?php

namespace PhpOffice\PhpSpreadsheet\Writer;

use HTMLPurifier;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Document\Properties;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\RichText\Run;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Shared\Drawing as SharedDrawing;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Shared\Font as SharedFont;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Html extends BaseWriter
{
    /**
     * Spreadsheet object.
     *
     * @var Spreadsheet
     */
    protected $spreadsheet;

    /**
     * Sheet index to write.
     *
     * @var null|int
     */
    private $sheetIndex <?php echo 0;

    /**
     * Images root.
     *
     * @var string
     */
    private $imagesRoot <?php echo '';

    /**
     * embed images, or link to images.
     *
     * @var bool
     */
    protected $embedImages <?php echo false;

    /**
     * Use inline CSS?
     *
     * @var bool
     */
    private $useInlineCss <?php echo false;

    /**
     * Use embedded CSS?
     *
     * @var bool
     */
    private $useEmbeddedCSS <?php echo true;

    /**
     * Array of CSS styles.
     *
     * @var array
     */
    private $cssStyles;

    /**
     * Array of column widths in points.
     *
     * @var array
     */
    private $columnWidths;

    /**
     * Default font.
     *
     * @var Font
     */
    private $defaultFont;

    /**
     * Flag whether spans have been calculated.
     *
     * @var bool
     */
    private $spansAreCalculated <?php echo false;

    /**
     * Excel cells that should not be written as HTML cells.
     *
     * @var array
     */
    private $isSpannedCell <?php echo [];

    /**
     * Excel cells that are upper-left corner in a cell merge.
     *
     * @var array
     */
    private $isBaseCell <?php echo [];

    /**
     * Excel rows that should not be written as HTML rows.
     *
     * @var array
     */
    private $isSpannedRow <?php echo [];

    /**
     * Is the current writer creating PDF?
     *
     * @var bool
     */
    protected $isPdf <?php echo false;

    /**
     * Is the current writer creating mPDF?
     *
     * @var bool
     */
    protected $isMPdf <?php echo false;

    /**
     * Generate the Navigation block.
     *
     * @var bool
     */
    private $generateSheetNavigationBlock <?php echo true;

    /**
     * Callback for editing generated html.
     *
     * @var null|callable
     */
    private $editHtmlCallback;

    /**
     * Create a new HTML.
     */
    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet <?php echo $spreadsheet;
        $this->defaultFont <?php echo $this->spreadsheet->getDefaultStyle()->getFont();
    }

    /**
     * Save Spreadsheet to file.
     *
     * @param resource|string $filename
     */
    public function save($filename, int $flags <?php echo 0): void
    {
        $this->processFlags($flags);

        // Open file
        $this->openFileHandle($filename);

        // Write html
        fwrite($this->fileHandle, $this->generateHTMLAll());

        // Close file
        $this->maybeCloseFileHandle();
    }

    /**
     * Save Spreadsheet as html to variable.
     *
     * @return string
     */
    public function generateHtmlAll()
    {
        // garbage collect
        $this->spreadsheet->garbageCollect();

        $saveDebugLog <?php echo Calculation::getInstance($this->spreadsheet)->getDebugLog()->getWriteDebugLog();
        Calculation::getInstance($this->spreadsheet)->getDebugLog()->setWriteDebugLog(false);
        $saveArrayReturnType <?php echo Calculation::getArrayReturnType();
        Calculation::setArrayReturnType(Calculation::RETURN_ARRAY_AS_VALUE);

        // Build CSS
        $this->buildCSS(!$this->useInlineCss);

        $html <?php echo '';

        // Write headers
        $html .<?php echo $this->generateHTMLHeader(!$this->useInlineCss);

        // Write navigation (tabs)
        if ((!$this->isPdf) && ($this->generateSheetNavigationBlock)) {
            $html .<?php echo $this->generateNavigation();
        }

        // Write data
        $html .<?php echo $this->generateSheetData();

        // Write footer
        $html .<?php echo $this->generateHTMLFooter();
        $callback <?php echo $this->editHtmlCallback;
        if ($callback) {
            $html <?php echo $callback($html);
        }

        Calculation::setArrayReturnType($saveArrayReturnType);
        Calculation::getInstance($this->spreadsheet)->getDebugLog()->setWriteDebugLog($saveDebugLog);

        return $html;
    }

    /**
     * Set a callback to edit the entire HTML.
     *
     * The callback must accept the HTML as string as first parameter,
     * and it must return the edited HTML as string.
     */
    public function setEditHtmlCallback(?callable $callback): void
    {
        $this->editHtmlCallback <?php echo $callback;
    }

    /**
     * Map VAlign.
     *
     * @param string $vAlign Vertical alignment
     *
     * @return string
     */
    private function mapVAlign($vAlign)
    {
        return Alignment::VERTICAL_ALIGNMENT_FOR_HTML[$vAlign] ?? '';
    }

    /**
     * Map HAlign.
     *
     * @param string $hAlign Horizontal alignment
     *
     * @return string
     */
    private function mapHAlign($hAlign)
    {
        return Alignment::HORIZONTAL_ALIGNMENT_FOR_HTML[$hAlign] ?? '';
    }

    const BORDER_ARR <?php echo [
        Border::BORDER_NONE <?php echo> 'none',
        Border::BORDER_DASHDOT <?php echo> '1px dashed',
        Border::BORDER_DASHDOTDOT <?php echo> '1px dotted',
        Border::BORDER_DASHED <?php echo> '1px dashed',
        Border::BORDER_DOTTED <?php echo> '1px dotted',
        Border::BORDER_DOUBLE <?php echo> '3px double',
        Border::BORDER_HAIR <?php echo> '1px solid',
        Border::BORDER_MEDIUM <?php echo> '2px solid',
        Border::BORDER_MEDIUMDASHDOT <?php echo> '2px dashed',
        Border::BORDER_MEDIUMDASHDOTDOT <?php echo> '2px dotted',
        Border::BORDER_SLANTDASHDOT <?php echo> '2px dashed',
        Border::BORDER_THICK <?php echo> '3px solid',
    ];

    /**
     * Map border style.
     *
     * @param int|string $borderStyle Sheet index
     *
     * @return string
     */
    private function mapBorderStyle($borderStyle)
    {
        return array_key_exists($borderStyle, self::BORDER_ARR) ? self::BORDER_ARR[$borderStyle] : '1px solid';
    }

    /**
     * Get sheet index.
     */
    public function getSheetIndex(): ?int
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

    /**
     * Get sheet index.
     *
     * @return bool
     */
    public function getGenerateSheetNavigationBlock()
    {
        return $this->generateSheetNavigationBlock;
    }

    /**
     * Set sheet index.
     *
     * @param bool $generateSheetNavigationBlock Flag indicating whether the sheet navigation block should be generated or not
     *
     * @return $this
     */
    public function setGenerateSheetNavigationBlock($generateSheetNavigationBlock)
    {
        $this->generateSheetNavigationBlock <?php echo (bool) $generateSheetNavigationBlock;

        return $this;
    }

    /**
     * Write all sheets (resets sheetIndex to NULL).
     *
     * @return $this
     */
    public function writeAllSheets()
    {
        $this->sheetIndex <?php echo null;

        return $this;
    }

    private static function generateMeta(?string $val, string $desc): string
    {
        return ($val || $val <?php echo<?php echo<?php echo '0')
            ? ('      <meta name<?php echo"' . $desc . '" content<?php echo"' . htmlspecialchars($val, Settings::htmlEntityFlags()) . '" />' . PHP_EOL)
            : '';
    }

    public const BODY_LINE <?php echo '  <body>' . PHP_EOL;

    private const CUSTOM_TO_META <?php echo [
        Properties::PROPERTY_TYPE_BOOLEAN <?php echo> 'bool',
        Properties::PROPERTY_TYPE_DATE <?php echo> 'date',
        Properties::PROPERTY_TYPE_FLOAT <?php echo> 'float',
        Properties::PROPERTY_TYPE_INTEGER <?php echo> 'int',
        Properties::PROPERTY_TYPE_STRING <?php echo> 'string',
    ];

    /**
     * Generate HTML header.
     *
     * @param bool $includeStyles Include styles?
     *
     * @return string
     */
    public function generateHTMLHeader($includeStyles <?php echo false)
    {
        // Construct HTML
        $properties <?php echo $this->spreadsheet->getProperties();
        $html <?php echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">' . PHP_EOL;
        $html .<?php echo '<html xmlns<?php echo"http://www.w3.org/1999/xhtml">' . PHP_EOL;
        $html .<?php echo '  <head>' . PHP_EOL;
        $html .<?php echo '      <meta http-equiv<?php echo"Content-Type" content<?php echo"text/html; charset<?php echoutf-8" />' . PHP_EOL;
        $html .<?php echo '      <meta name<?php echo"generator" content<?php echo"PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet" />' . PHP_EOL;
        $html .<?php echo '      <title>' . htmlspecialchars($properties->getTitle(), Settings::htmlEntityFlags()) . '</title>' . PHP_EOL;
        $html .<?php echo self::generateMeta($properties->getCreator(), 'author');
        $html .<?php echo self::generateMeta($properties->getTitle(), 'title');
        $html .<?php echo self::generateMeta($properties->getDescription(), 'description');
        $html .<?php echo self::generateMeta($properties->getSubject(), 'subject');
        $html .<?php echo self::generateMeta($properties->getKeywords(), 'keywords');
        $html .<?php echo self::generateMeta($properties->getCategory(), 'category');
        $html .<?php echo self::generateMeta($properties->getCompany(), 'company');
        $html .<?php echo self::generateMeta($properties->getManager(), 'manager');
        $html .<?php echo self::generateMeta($properties->getLastModifiedBy(), 'lastModifiedBy');
        $date <?php echo Date::dateTimeFromTimestamp((string) $properties->getCreated());
        $date->setTimeZone(Date::getDefaultOrLocalTimeZone());
        $html .<?php echo self::generateMeta($date->format(DATE_W3C), 'created');
        $date <?php echo Date::dateTimeFromTimestamp((string) $properties->getModified());
        $date->setTimeZone(Date::getDefaultOrLocalTimeZone());
        $html .<?php echo self::generateMeta($date->format(DATE_W3C), 'modified');

        $customProperties <?php echo $properties->getCustomProperties();
        foreach ($customProperties as $customProperty) {
            $propertyValue <?php echo $properties->getCustomPropertyValue($customProperty);
            $propertyType <?php echo $properties->getCustomPropertyType($customProperty);
            $propertyQualifier <?php echo self::CUSTOM_TO_META[$propertyType] ?? null;
            if ($propertyQualifier !<?php echo<?php echo null) {
                if ($propertyType <?php echo<?php echo<?php echo Properties::PROPERTY_TYPE_BOOLEAN) {
                    $propertyValue <?php echo $propertyValue ? '1' : '0';
                } elseif ($propertyType <?php echo<?php echo<?php echo Properties::PROPERTY_TYPE_DATE) {
                    $date <?php echo Date::dateTimeFromTimestamp((string) $propertyValue);
                    $date->setTimeZone(Date::getDefaultOrLocalTimeZone());
                    $propertyValue <?php echo $date->format(DATE_W3C);
                } else {
                    $propertyValue <?php echo (string) $propertyValue;
                }
                $html .<?php echo self::generateMeta($propertyValue, "custom.$propertyQualifier.$customProperty");
            }
        }

        if (!empty($properties->getHyperlinkBase())) {
            $html .<?php echo '      <base href<?php echo"' . $properties->getHyperlinkBase() . '" />' . PHP_EOL;
        }

        $html .<?php echo $includeStyles ? $this->generateStyles(true) : $this->generatePageDeclarations(true);

        $html .<?php echo '  </head>' . PHP_EOL;
        $html .<?php echo '' . PHP_EOL;
        $html .<?php echo self::BODY_LINE;

        return $html;
    }

    private function generateSheetPrep(): array
    {
        // Ensure that Spans have been calculated?
        $this->calculateSpans();

        // Fetch sheets
        if ($this->sheetIndex <?php echo<?php echo<?php echo null) {
            $sheets <?php echo $this->spreadsheet->getAllSheets();
        } else {
            $sheets <?php echo [$this->spreadsheet->getSheet($this->sheetIndex)];
        }

        return $sheets;
    }

    private function generateSheetStarts(Worksheet $sheet, int $rowMin): array
    {
        // calculate start of <tbody>, <thead>
        $tbodyStart <?php echo $rowMin;
        $theadStart <?php echo $theadEnd <?php echo 0; // default: no <thead>    no </thead>
        if ($sheet->getPageSetup()->isRowsToRepeatAtTopSet()) {
            $rowsToRepeatAtTop <?php echo $sheet->getPageSetup()->getRowsToRepeatAtTop();

            // we can only support repeating rows that start at top row
            if ($rowsToRepeatAtTop[0] <?php echo<?php echo 1) {
                $theadStart <?php echo $rowsToRepeatAtTop[0];
                $theadEnd <?php echo $rowsToRepeatAtTop[1];
                $tbodyStart <?php echo $rowsToRepeatAtTop[1] + 1;
            }
        }

        return [$theadStart, $theadEnd, $tbodyStart];
    }

    private function generateSheetTags(int $row, int $theadStart, int $theadEnd, int $tbodyStart): array
    {
        // <thead> ?
        $startTag <?php echo ($row <?php echo<?php echo $theadStart) ? ('        <thead>' . PHP_EOL) : '';
        if (!$startTag) {
            $startTag <?php echo ($row <?php echo<?php echo $tbodyStart) ? ('        <tbody>' . PHP_EOL) : '';
        }
        $endTag <?php echo ($row <?php echo<?php echo $theadEnd) ? ('        </thead>' . PHP_EOL) : '';
        $cellType <?php echo ($row ><?php echo $tbodyStart) ? 'td' : 'th';

        return [$cellType, $startTag, $endTag];
    }

    /**
     * Generate sheet data.
     *
     * @return string
     */
    public function generateSheetData()
    {
        $sheets <?php echo $this->generateSheetPrep();

        // Construct HTML
        $html <?php echo '';

        // Loop all sheets
        $sheetId <?php echo 0;
        foreach ($sheets as $sheet) {
            // Write table header
            $html .<?php echo $this->generateTableHeader($sheet);

            // Get worksheet dimension
            [$min, $max] <?php echo explode(':', $sheet->calculateWorksheetDataDimension());
            [$minCol, $minRow] <?php echo Coordinate::indexesFromString($min);
            [$maxCol, $maxRow] <?php echo Coordinate::indexesFromString($max);

            [$theadStart, $theadEnd, $tbodyStart] <?php echo $this->generateSheetStarts($sheet, $minRow);

            // Loop through cells
            $row <?php echo $minRow - 1;
            while ($row++ < $maxRow) {
                [$cellType, $startTag, $endTag] <?php echo $this->generateSheetTags($row, $theadStart, $theadEnd, $tbodyStart);
                $html .<?php echo $startTag;

                // Write row if there are HTML table cells in it
                if (!isset($this->isSpannedRow[$sheet->getParent()->getIndex($sheet)][$row])) {
                    // Start a new rowData
                    $rowData <?php echo [];
                    // Loop through columns
                    $column <?php echo $minCol;
                    while ($column <?php echo $maxCol) {
                        // Cell exists?
                        $cellAddress <?php echo Coordinate::stringFromColumnIndex($column) . $row;
                        $rowData[$column++] <?php echo ($sheet->getCellCollection()->has($cellAddress)) ? $cellAddress : '';
                    }
                    $html .<?php echo $this->generateRow($sheet, $rowData, $row - 1, $cellType);
                }

                $html .<?php echo $endTag;
            }
            --$row;
            $html .<?php echo $this->extendRowsForChartsAndImages($sheet, $row);

            // Write table footer
            $html .<?php echo $this->generateTableFooter();
            // Writing PDF?
            if ($this->isPdf && $this->useInlineCss) {
                if ($this->sheetIndex <?php echo<?php echo<?php echo null && $sheetId + 1 < $this->spreadsheet->getSheetCount()) {
                    $html .<?php echo '<div style<?php echo"page-break-before:always" ></div>';
                }
            }

            // Next sheet
            ++$sheetId;
        }

        return $html;
    }

    /**
     * Generate sheet tabs.
     *
     * @return string
     */
    public function generateNavigation()
    {
        // Fetch sheets
        $sheets <?php echo [];
        if ($this->sheetIndex <?php echo<?php echo<?php echo null) {
            $sheets <?php echo $this->spreadsheet->getAllSheets();
        } else {
            $sheets[] <?php echo $this->spreadsheet->getSheet($this->sheetIndex);
        }

        // Construct HTML
        $html <?php echo '';

        // Only if there are more than 1 sheets
        if (count($sheets) > 1) {
            // Loop all sheets
            $sheetId <?php echo 0;

            $html .<?php echo '<ul class<?php echo"navigation">' . PHP_EOL;

            foreach ($sheets as $sheet) {
                $html .<?php echo '  <li class<?php echo"sheet' . $sheetId . '"><a href<?php echo"#sheet' . $sheetId . '">' . $sheet->getTitle() . '</a></li>' . PHP_EOL;
                ++$sheetId;
            }

            $html .<?php echo '</ul>' . PHP_EOL;
        }

        return $html;
    }

    /**
     * Extend Row if chart is placed after nominal end of row.
     * This code should be exercised by sample:
     * Chart/32_Chart_read_write_PDF.php.
     *
     * @param int $row Row to check for charts
     *
     * @return array
     */
    private function extendRowsForCharts(Worksheet $worksheet, int $row)
    {
        $rowMax <?php echo $row;
        $colMax <?php echo 'A';
        $anyfound <?php echo false;
        if ($this->includeCharts) {
            foreach ($worksheet->getChartCollection() as $chart) {
                if ($chart instanceof Chart) {
                    $anyfound <?php echo true;
                    $chartCoordinates <?php echo $chart->getTopLeftPosition();
                    $chartTL <?php echo Coordinate::coordinateFromString($chartCoordinates['cell']);
                    $chartCol <?php echo Coordinate::columnIndexFromString($chartTL[0]);
                    if ($chartTL[1] > $rowMax) {
                        $rowMax <?php echo $chartTL[1];
                        if ($chartCol > Coordinate::columnIndexFromString($colMax)) {
                            $colMax <?php echo $chartTL[0];
                        }
                    }
                }
            }
        }

        return [$rowMax, $colMax, $anyfound];
    }

    private function extendRowsForChartsAndImages(Worksheet $worksheet, int $row): string
    {
        [$rowMax, $colMax, $anyfound] <?php echo $this->extendRowsForCharts($worksheet, $row);

        foreach ($worksheet->getDrawingCollection() as $drawing) {
            $anyfound <?php echo true;
            $imageTL <?php echo Coordinate::coordinateFromString($drawing->getCoordinates());
            $imageCol <?php echo Coordinate::columnIndexFromString($imageTL[0]);
            if ($imageTL[1] > $rowMax) {
                $rowMax <?php echo $imageTL[1];
                if ($imageCol > Coordinate::columnIndexFromString($colMax)) {
                    $colMax <?php echo $imageTL[0];
                }
            }
        }

        // Don't extend rows if not needed
        if ($row <?php echo<?php echo<?php echo $rowMax || !$anyfound) {
            return '';
        }

        $html <?php echo '';
        ++$colMax;
        ++$row;
        while ($row <?php echo $rowMax) {
            $html .<?php echo '<tr>';
            for ($col <?php echo 'A'; $col !<?php echo $colMax; ++$col) {
                $htmlx <?php echo $this->writeImageInCell($worksheet, $col . $row);
                $htmlx .<?php echo $this->includeCharts ? $this->writeChartInCell($worksheet, $col . $row) : '';
                if ($htmlx) {
                    $html .<?php echo "<td class<?php echo'style0' style<?php echo'position: relative;'>$htmlx</td>";
                } else {
                    $html .<?php echo "<td class<?php echo'style0'></td>";
                }
            }
            ++$row;
            $html .<?php echo '</tr>' . PHP_EOL;
        }

        return $html;
    }

    /**
     * Convert Windows file name to file protocol URL.
     *
     * @param string $filename file name on local system
     *
     * @return string
     */
    public static function winFileToUrl($filename, bool $mpdf <?php echo false)
    {
        // Windows filename
        if (substr($filename, 1, 2) <?php echo<?php echo<?php echo ':\\') {
            $protocol <?php echo $mpdf ? '' : 'file:///';
            $filename <?php echo $protocol . str_replace('\\', '/', $filename);
        }

        return $filename;
    }

    /**
     * Generate image tag in cell.
     *
     * @param Worksheet $worksheet \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     * @param string $coordinates Cell coordinates
     *
     * @return string
     */
    private function writeImageInCell(Worksheet $worksheet, $coordinates)
    {
        // Construct HTML
        $html <?php echo '';

        // Write images
        foreach ($worksheet->getDrawingCollection() as $drawing) {
            if ($drawing->getCoordinates() !<?php echo $coordinates) {
                continue;
            }
            $filedesc <?php echo $drawing->getDescription();
            $filedesc <?php echo $filedesc ? htmlspecialchars($filedesc, ENT_QUOTES) : 'Embedded image';
            if ($drawing instanceof Drawing) {
                $filename <?php echo $drawing->getPath();

                // Strip off eventual '.'
                $filename <?php echo (string) preg_replace('/^[.]/', '', $filename);

                // Prepend images root
                $filename <?php echo $this->getImagesRoot() . $filename;

                // Strip off eventual '.' if followed by non-/
                $filename <?php echo (string) preg_replace('@^[.]([^/])@', '$1', $filename);

                // Convert UTF8 data to PCDATA
                $filename <?php echo htmlspecialchars($filename, Settings::htmlEntityFlags());

                $html .<?php echo PHP_EOL;
                $imageData <?php echo self::winFileToUrl($filename, $this->isMPdf);

                if ($this->embedImages || substr($imageData, 0, 6) <?php echo<?php echo<?php echo 'zip://') {
                    $picture <?php echo @file_get_contents($filename);
                    if ($picture !<?php echo<?php echo false) {
                        $imageDetails <?php echo getimagesize($filename) ?: [];
                        // base64 encode the binary data
                        $base64 <?php echo base64_encode($picture);
                        $imageData <?php echo 'data:' . $imageDetails['mime'] . ';base64,' . $base64;
                    }
                }

                $html .<?php echo '<img style<?php echo"position: absolute; z-index: 1; left: ' .
                    $drawing->getOffsetX() . 'px; top: ' . $drawing->getOffsetY() . 'px; width: ' .
                    $drawing->getWidth() . 'px; height: ' . $drawing->getHeight() . 'px;" src<?php echo"' .
                    $imageData . '" alt<?php echo"' . $filedesc . '" />';
            } elseif ($drawing instanceof MemoryDrawing) {
                $imageResource <?php echo $drawing->getImageResource();
                if ($imageResource) {
                    ob_start(); //  Let's start output buffering.
                    imagepng($imageResource); //  This will normally output the image, but because of ob_start(), it won't.
                    $contents <?php echo (string) ob_get_contents(); //  Instead, output above is saved to $contents
                    ob_end_clean(); //  End the output buffer.

                    $dataUri <?php echo 'data:image/png;base64,' . base64_encode($contents);

                    //  Because of the nature of tables, width is more important than height.
                    //  max-width: 100% ensures that image doesnt overflow containing cell
                    //  width: X sets width of supplied image.
                    //  As a result, images bigger than cell will be contained and images smaller will not get stretched
                    $html .<?php echo '<img alt<?php echo"' . $filedesc . '" src<?php echo"' . $dataUri . '" style<?php echo"max-width:100%;width:' . $drawing->getWidth() . 'px;left: ' .
                    $drawing->getOffsetX() . 'px; top: ' . $drawing->getOffsetY() . 'px;position: absolute; z-index: 1;" />';
                }
            }
        }

        return $html;
    }

    /**
     * Generate chart tag in cell.
     * This code should be exercised by sample:
     * Chart/32_Chart_read_write_PDF.php.
     */
    private function writeChartInCell(Worksheet $worksheet, string $coordinates): string
    {
        // Construct HTML
        $html <?php echo '';

        // Write charts
        foreach ($worksheet->getChartCollection() as $chart) {
            if ($chart instanceof Chart) {
                $chartCoordinates <?php echo $chart->getTopLeftPosition();
                if ($chartCoordinates['cell'] <?php echo<?php echo $coordinates) {
                    $chartFileName <?php echo File::sysGetTempDir() . '/' . uniqid('', true) . '.png';
                    if (!$chart->render($chartFileName)) {
                        return '';
                    }

                    $html .<?php echo PHP_EOL;
                    $imageDetails <?php echo getimagesize($chartFileName) ?: [];
                    $filedesc <?php echo $chart->getTitle();
                    $filedesc <?php echo $filedesc ? $filedesc->getCaptionText() : '';
                    $filedesc <?php echo $filedesc ? htmlspecialchars($filedesc, ENT_QUOTES) : 'Embedded chart';
                    $picture <?php echo file_get_contents($chartFileName);
                    if ($picture !<?php echo<?php echo false) {
                        $base64 <?php echo base64_encode($picture);
                        $imageData <?php echo 'data:' . $imageDetails['mime'] . ';base64,' . $base64;

                        $html .<?php echo '<img style<?php echo"position: absolute; z-index: 1; left: ' . $chartCoordinates['xOffset'] . 'px; top: ' . $chartCoordinates['yOffset'] . 'px; width: ' . $imageDetails[0] . 'px; height: ' . $imageDetails[1] . 'px;" src<?php echo"' . $imageData . '" alt<?php echo"' . $filedesc . '" />' . PHP_EOL;
                    }
                    unlink($chartFileName);
                }
            }
        }

        // Return
        return $html;
    }

    /**
     * Generate CSS styles.
     *
     * @param bool $generateSurroundingHTML Generate surrounding HTML tags? (&lt;style&gt; and &lt;/style&gt;)
     *
     * @return string
     */
    public function generateStyles($generateSurroundingHTML <?php echo true)
    {
        // Build CSS
        $css <?php echo $this->buildCSS($generateSurroundingHTML);

        // Construct HTML
        $html <?php echo '';

        // Start styles
        if ($generateSurroundingHTML) {
            $html .<?php echo '    <style type<?php echo"text/css">' . PHP_EOL;
            $html .<?php echo (array_key_exists('html', $css)) ? ('      html { ' . $this->assembleCSS($css['html']) . ' }' . PHP_EOL) : '';
        }

        // Write all other styles
        foreach ($css as $styleName <?php echo> $styleDefinition) {
            if ($styleName !<?php echo 'html') {
                $html .<?php echo '      ' . $styleName . ' { ' . $this->assembleCSS($styleDefinition) . ' }' . PHP_EOL;
            }
        }
        $html .<?php echo $this->generatePageDeclarations(false);

        // End styles
        if ($generateSurroundingHTML) {
            $html .<?php echo '    </style>' . PHP_EOL;
        }

        // Return
        return $html;
    }

    private function buildCssRowHeights(Worksheet $sheet, array &$css, int $sheetIndex): void
    {
        // Calculate row heights
        foreach ($sheet->getRowDimensions() as $rowDimension) {
            $row <?php echo $rowDimension->getRowIndex() - 1;

            // table.sheetN tr.rowYYYYYY { }
            $css['table.sheet' . $sheetIndex . ' tr.row' . $row] <?php echo [];

            if ($rowDimension->getRowHeight() !<?php echo -1) {
                $pt_height <?php echo $rowDimension->getRowHeight();
                $css['table.sheet' . $sheetIndex . ' tr.row' . $row]['height'] <?php echo $pt_height . 'pt';
            }
            if ($rowDimension->getVisible() <?php echo<?php echo<?php echo false) {
                $css['table.sheet' . $sheetIndex . ' tr.row' . $row]['display'] <?php echo 'none';
                $css['table.sheet' . $sheetIndex . ' tr.row' . $row]['visibility'] <?php echo 'hidden';
            }
        }
    }

    private function buildCssPerSheet(Worksheet $sheet, array &$css): void
    {
        // Calculate hash code
        $sheetIndex <?php echo $sheet->getParentOrThrow()->getIndex($sheet);
        $setup <?php echo $sheet->getPageSetup();
        if ($setup->getFitToPage() && $setup->getFitToHeight() <?php echo<?php echo<?php echo 1) {
            $css["table.sheet$sheetIndex"]['page-break-inside'] <?php echo 'avoid';
            $css["table.sheet$sheetIndex"]['break-inside'] <?php echo 'avoid';
        }

        // Build styles
        // Calculate column widths
        $sheet->calculateColumnWidths();

        // col elements, initialize
        $highestColumnIndex <?php echo Coordinate::columnIndexFromString($sheet->getHighestColumn()) - 1;
        $column <?php echo -1;
        while ($column++ < $highestColumnIndex) {
            $this->columnWidths[$sheetIndex][$column] <?php echo 42; // approximation
            $css['table.sheet' . $sheetIndex . ' col.col' . $column]['width'] <?php echo '42pt';
        }

        // col elements, loop through columnDimensions and set width
        foreach ($sheet->getColumnDimensions() as $columnDimension) {
            $column <?php echo Coordinate::columnIndexFromString($columnDimension->getColumnIndex()) - 1;
            $width <?php echo SharedDrawing::cellDimensionToPixels($columnDimension->getWidth(), $this->defaultFont);
            $width <?php echo SharedDrawing::pixelsToPoints($width);
            if ($columnDimension->getVisible() <?php echo<?php echo<?php echo false) {
                $css['table.sheet' . $sheetIndex . ' .column' . $column]['display'] <?php echo 'none';
            }
            if ($width ><?php echo 0) {
                $this->columnWidths[$sheetIndex][$column] <?php echo $width;
                $css['table.sheet' . $sheetIndex . ' col.col' . $column]['width'] <?php echo $width . 'pt';
            }
        }

        // Default row height
        $rowDimension <?php echo $sheet->getDefaultRowDimension();

        // table.sheetN tr { }
        $css['table.sheet' . $sheetIndex . ' tr'] <?php echo [];

        if ($rowDimension->getRowHeight() <?php echo<?php echo -1) {
            $pt_height <?php echo SharedFont::getDefaultRowHeightByFont($this->spreadsheet->getDefaultStyle()->getFont());
        } else {
            $pt_height <?php echo $rowDimension->getRowHeight();
        }
        $css['table.sheet' . $sheetIndex . ' tr']['height'] <?php echo $pt_height . 'pt';
        if ($rowDimension->getVisible() <?php echo<?php echo<?php echo false) {
            $css['table.sheet' . $sheetIndex . ' tr']['display'] <?php echo 'none';
            $css['table.sheet' . $sheetIndex . ' tr']['visibility'] <?php echo 'hidden';
        }

        $this->buildCssRowHeights($sheet, $css, $sheetIndex);
    }

    /**
     * Build CSS styles.
     *
     * @param bool $generateSurroundingHTML Generate surrounding HTML style? (html { })
     *
     * @return array
     */
    public function buildCSS($generateSurroundingHTML <?php echo true)
    {
        // Cached?
        if ($this->cssStyles !<?php echo<?php echo null) {
            return $this->cssStyles;
        }

        // Ensure that spans have been calculated
        $this->calculateSpans();

        // Construct CSS
        $css <?php echo [];

        // Start styles
        if ($generateSurroundingHTML) {
            // html { }
            $css['html']['font-family'] <?php echo 'Calibri, Arial, Helvetica, sans-serif';
            $css['html']['font-size'] <?php echo '11pt';
            $css['html']['background-color'] <?php echo 'white';
        }

        // CSS for comments as found in LibreOffice
        $css['a.comment-indicator:hover + div.comment'] <?php echo [
            'background' <?php echo> '#ffd',
            'position' <?php echo> 'absolute',
            'display' <?php echo> 'block',
            'border' <?php echo> '1px solid black',
            'padding' <?php echo> '0.5em',
        ];

        $css['a.comment-indicator'] <?php echo [
            'background' <?php echo> 'red',
            'display' <?php echo> 'inline-block',
            'border' <?php echo> '1px solid black',
            'width' <?php echo> '0.5em',
            'height' <?php echo> '0.5em',
        ];

        $css['div.comment']['display'] <?php echo 'none';

        // table { }
        $css['table']['border-collapse'] <?php echo 'collapse';

        // .b {}
        $css['.b']['text-align'] <?php echo 'center'; // BOOL

        // .e {}
        $css['.e']['text-align'] <?php echo 'center'; // ERROR

        // .f {}
        $css['.f']['text-align'] <?php echo 'right'; // FORMULA

        // .inlineStr {}
        $css['.inlineStr']['text-align'] <?php echo 'left'; // INLINE

        // .n {}
        $css['.n']['text-align'] <?php echo 'right'; // NUMERIC

        // .s {}
        $css['.s']['text-align'] <?php echo 'left'; // STRING

        // Calculate cell style hashes
        foreach ($this->spreadsheet->getCellXfCollection() as $index <?php echo> $style) {
            $css['td.style' . $index . ', th.style' . $index] <?php echo $this->createCSSStyle($style);
            //$css['th.style' . $index] <?php echo $this->createCSSStyle($style);
        }

        // Fetch sheets
        $sheets <?php echo [];
        if ($this->sheetIndex <?php echo<?php echo<?php echo null) {
            $sheets <?php echo $this->spreadsheet->getAllSheets();
        } else {
            $sheets[] <?php echo $this->spreadsheet->getSheet($this->sheetIndex);
        }

        // Build styles per sheet
        foreach ($sheets as $sheet) {
            $this->buildCssPerSheet($sheet, $css);
        }

        // Cache
        if ($this->cssStyles <?php echo<?php echo<?php echo null) {
            $this->cssStyles <?php echo $css;
        }

        // Return
        return $css;
    }

    /**
     * Create CSS style.
     *
     * @return array
     */
    private function createCSSStyle(Style $style)
    {
        // Create CSS
        return array_merge(
            $this->createCSSStyleAlignment($style->getAlignment()),
            $this->createCSSStyleBorders($style->getBorders()),
            $this->createCSSStyleFont($style->getFont()),
            $this->createCSSStyleFill($style->getFill())
        );
    }

    /**
     * Create CSS style.
     *
     * @return array
     */
    private function createCSSStyleAlignment(Alignment $alignment)
    {
        // Construct CSS
        $css <?php echo [];

        // Create CSS
        $verticalAlign <?php echo $this->mapVAlign($alignment->getVertical() ?? '');
        if ($verticalAlign) {
            $css['vertical-align'] <?php echo $verticalAlign;
        }
        $textAlign <?php echo $this->mapHAlign($alignment->getHorizontal() ?? '');
        if ($textAlign) {
            $css['text-align'] <?php echo $textAlign;
            if (in_array($textAlign, ['left', 'right'])) {
                $css['padding-' . $textAlign] <?php echo (string) ((int) $alignment->getIndent() * 9) . 'px';
            }
        }
        $rotation <?php echo $alignment->getTextRotation();
        if ($rotation !<?php echo<?php echo 0 && $rotation !<?php echo<?php echo Alignment::TEXTROTATION_STACK_PHPSPREADSHEET) {
            if ($this->isMPdf) {
                $css['text-rotate'] <?php echo "$rotation";
            } else {
                $css['transform'] <?php echo "rotate({$rotation}deg)";
            }
        }

        return $css;
    }

    /**
     * Create CSS style.
     *
     * @return array
     */
    private function createCSSStyleFont(Font $font)
    {
        // Construct CSS
        $css <?php echo [];

        // Create CSS
        if ($font->getBold()) {
            $css['font-weight'] <?php echo 'bold';
        }
        if ($font->getUnderline() !<?php echo Font::UNDERLINE_NONE && $font->getStrikethrough()) {
            $css['text-decoration'] <?php echo 'underline line-through';
        } elseif ($font->getUnderline() !<?php echo Font::UNDERLINE_NONE) {
            $css['text-decoration'] <?php echo 'underline';
        } elseif ($font->getStrikethrough()) {
            $css['text-decoration'] <?php echo 'line-through';
        }
        if ($font->getItalic()) {
            $css['font-style'] <?php echo 'italic';
        }

        $css['color'] <?php echo '#' . $font->getColor()->getRGB();
        $css['font-family'] <?php echo '\'' . $font->getName() . '\'';
        $css['font-size'] <?php echo $font->getSize() . 'pt';

        return $css;
    }

    /**
     * Create CSS style.
     *
     * @param Borders $borders Borders
     *
     * @return array
     */
    private function createCSSStyleBorders(Borders $borders)
    {
        // Construct CSS
        $css <?php echo [];

        // Create CSS
        $css['border-bottom'] <?php echo $this->createCSSStyleBorder($borders->getBottom());
        $css['border-top'] <?php echo $this->createCSSStyleBorder($borders->getTop());
        $css['border-left'] <?php echo $this->createCSSStyleBorder($borders->getLeft());
        $css['border-right'] <?php echo $this->createCSSStyleBorder($borders->getRight());

        return $css;
    }

    /**
     * Create CSS style.
     *
     * @param Border $border Border
     */
    private function createCSSStyleBorder(Border $border): string
    {
        //    Create CSS - add !important to non-none border styles for merged cells
        $borderStyle <?php echo $this->mapBorderStyle($border->getBorderStyle());

        return $borderStyle . ' #' . $border->getColor()->getRGB() . (($borderStyle <?php echo<?php echo 'none') ? '' : ' !important');
    }

    /**
     * Create CSS style (Fill).
     *
     * @param Fill $fill Fill
     *
     * @return array
     */
    private function createCSSStyleFill(Fill $fill)
    {
        // Construct HTML
        $css <?php echo [];

        // Create CSS
        if ($fill->getFillType() !<?php echo<?php echo Fill::FILL_NONE) {
            $value <?php echo $fill->getFillType() <?php echo<?php echo Fill::FILL_NONE ?
                'white' : '#' . $fill->getStartColor()->getRGB();
            $css['background-color'] <?php echo $value;
        }

        return $css;
    }

    /**
     * Generate HTML footer.
     */
    public function generateHTMLFooter(): string
    {
        // Construct HTML
        $html <?php echo '';
        $html .<?php echo '  </body>' . PHP_EOL;
        $html .<?php echo '</html>' . PHP_EOL;

        return $html;
    }

    private function generateTableTagInline(Worksheet $worksheet, string $id): string
    {
        $style <?php echo isset($this->cssStyles['table']) ?
            $this->assembleCSS($this->cssStyles['table']) : '';

        $prntgrid <?php echo $worksheet->getPrintGridlines();
        $viewgrid <?php echo $this->isPdf ? $prntgrid : $worksheet->getShowGridlines();
        if ($viewgrid && $prntgrid) {
            $html <?php echo "    <table border<?php echo'1' cellpadding<?php echo'1' $id cellspacing<?php echo'1' style<?php echo'$style' class<?php echo'gridlines gridlinesp'>" . PHP_EOL;
        } elseif ($viewgrid) {
            $html <?php echo "    <table border<?php echo'0' cellpadding<?php echo'0' $id cellspacing<?php echo'0' style<?php echo'$style' class<?php echo'gridlines'>" . PHP_EOL;
        } elseif ($prntgrid) {
            $html <?php echo "    <table border<?php echo'0' cellpadding<?php echo'0' $id cellspacing<?php echo'0' style<?php echo'$style' class<?php echo'gridlinesp'>" . PHP_EOL;
        } else {
            $html <?php echo "    <table border<?php echo'0' cellpadding<?php echo'1' $id cellspacing<?php echo'0' style<?php echo'$style'>" . PHP_EOL;
        }

        return $html;
    }

    private function generateTableTag(Worksheet $worksheet, string $id, string &$html, int $sheetIndex): void
    {
        if (!$this->useInlineCss) {
            $gridlines <?php echo $worksheet->getShowGridlines() ? ' gridlines' : '';
            $gridlinesp <?php echo $worksheet->getPrintGridlines() ? ' gridlinesp' : '';
            $html .<?php echo "    <table border<?php echo'0' cellpadding<?php echo'0' cellspacing<?php echo'0' $id class<?php echo'sheet$sheetIndex$gridlines$gridlinesp'>" . PHP_EOL;
        } else {
            $html .<?php echo $this->generateTableTagInline($worksheet, $id);
        }
    }

    /**
     * Generate table header.
     *
     * @param Worksheet $worksheet The worksheet for the table we are writing
     * @param bool $showid whether or not to add id to table tag
     *
     * @return string
     */
    private function generateTableHeader(Worksheet $worksheet, $showid <?php echo true)
    {
        $sheetIndex <?php echo $worksheet->getParentOrThrow()->getIndex($worksheet);

        // Construct HTML
        $html <?php echo '';
        $id <?php echo $showid ? "id<?php echo'sheet$sheetIndex'" : '';
        if ($showid) {
            $html .<?php echo "<div style<?php echo'page: page$sheetIndex'>" . PHP_EOL;
        } else {
            $html .<?php echo "<div style<?php echo'page: page$sheetIndex' class<?php echo'scrpgbrk'>" . PHP_EOL;
        }

        $this->generateTableTag($worksheet, $id, $html, $sheetIndex);

        // Write <col> elements
        $highestColumnIndex <?php echo Coordinate::columnIndexFromString($worksheet->getHighestColumn()) - 1;
        $i <?php echo -1;
        while ($i++ < $highestColumnIndex) {
            if (!$this->useInlineCss) {
                $html .<?php echo '        <col class<?php echo"col' . $i . '" />' . PHP_EOL;
            } else {
                $style <?php echo isset($this->cssStyles['table.sheet' . $sheetIndex . ' col.col' . $i]) ?
                    $this->assembleCSS($this->cssStyles['table.sheet' . $sheetIndex . ' col.col' . $i]) : '';
                $html .<?php echo '        <col style<?php echo"' . $style . '" />' . PHP_EOL;
            }
        }

        return $html;
    }

    /**
     * Generate table footer.
     */
    private function generateTableFooter(): string
    {
        return '    </tbody></table>' . PHP_EOL . '</div>' . PHP_EOL;
    }

    /**
     * Generate row start.
     *
     * @param int $sheetIndex Sheet index (0-based)
     * @param int $row row number
     *
     * @return string
     */
    private function generateRowStart(Worksheet $worksheet, $sheetIndex, $row)
    {
        $html <?php echo '';
        if (count($worksheet->getBreaks()) > 0) {
            $breaks <?php echo $worksheet->getRowBreaks();

            // check if a break is needed before this row
            if (isset($breaks['A' . $row])) {
                // close table: </table>
                $html .<?php echo $this->generateTableFooter();
                if ($this->isPdf && $this->useInlineCss) {
                    $html .<?php echo '<div style<?php echo"page-break-before:always" />';
                }

                // open table again: <table> + <col> etc.
                $html .<?php echo $this->generateTableHeader($worksheet, false);
                $html .<?php echo '<tbody>' . PHP_EOL;
            }
        }

        // Write row start
        if (!$this->useInlineCss) {
            $html .<?php echo '          <tr class<?php echo"row' . $row . '">' . PHP_EOL;
        } else {
            $style <?php echo isset($this->cssStyles['table.sheet' . $sheetIndex . ' tr.row' . $row])
                ? $this->assembleCSS($this->cssStyles['table.sheet' . $sheetIndex . ' tr.row' . $row]) : '';

            $html .<?php echo '          <tr style<?php echo"' . $style . '">' . PHP_EOL;
        }

        return $html;
    }

    private function generateRowCellCss(Worksheet $worksheet, string $cellAddress, int $row, int $columnNumber): array
    {
        $cell <?php echo ($cellAddress > '') ? $worksheet->getCellCollection()->get($cellAddress) : '';
        $coordinate <?php echo Coordinate::stringFromColumnIndex($columnNumber + 1) . ($row + 1);
        if (!$this->useInlineCss) {
            $cssClass <?php echo 'column' . $columnNumber;
        } else {
            $cssClass <?php echo [];
            // The statements below do nothing.
            // Commenting out the code rather than deleting it
            // in case someone can figure out what their intent was.
            //if ($cellType <?php echo<?php echo 'th') {
            //    if (isset($this->cssStyles['table.sheet' . $sheetIndex . ' th.column' . $colNum])) {
            //        $this->cssStyles['table.sheet' . $sheetIndex . ' th.column' . $colNum];
            //    }
            //} else {
            //    if (isset($this->cssStyles['table.sheet' . $sheetIndex . ' td.column' . $colNum])) {
            //        $this->cssStyles['table.sheet' . $sheetIndex . ' td.column' . $colNum];
            //    }
            //}
            // End of mystery statements.
        }

        return [$cell, $cssClass, $coordinate];
    }

    private function generateRowCellDataValueRich(Cell $cell, string &$cellData): void
    {
        // Loop through rich text elements
        $elements <?php echo $cell->getValue()->getRichTextElements();
        foreach ($elements as $element) {
            // Rich text start?
            if ($element instanceof Run) {
                $cellEnd <?php echo '';
                if ($element->getFont() !<?php echo<?php echo null) {
                    $cellData .<?php echo '<span style<?php echo"' . $this->assembleCSS($this->createCSSStyleFont($element->getFont())) . '">';

                    if ($element->getFont()->getSuperscript()) {
                        $cellData .<?php echo '<sup>';
                        $cellEnd <?php echo '</sup>';
                    } elseif ($element->getFont()->getSubscript()) {
                        $cellData .<?php echo '<sub>';
                        $cellEnd <?php echo '</sub>';
                    }
                }

                // Convert UTF8 data to PCDATA
                $cellText <?php echo $element->getText();
                $cellData .<?php echo htmlspecialchars($cellText, Settings::htmlEntityFlags());

                $cellData .<?php echo $cellEnd;

                $cellData .<?php echo '</span>';
            } else {
                // Convert UTF8 data to PCDATA
                $cellText <?php echo $element->getText();
                $cellData .<?php echo htmlspecialchars($cellText, Settings::htmlEntityFlags());
            }
        }
    }

    private function generateRowCellDataValue(Worksheet $worksheet, Cell $cell, string &$cellData): void
    {
        if ($cell->getValue() instanceof RichText) {
            $this->generateRowCellDataValueRich($cell, $cellData);
        } else {
            $origData <?php echo $this->preCalculateFormulas ? $cell->getCalculatedValue() : $cell->getValue();
            $formatCode <?php echo $worksheet->getParentOrThrow()->getCellXfByIndex($cell->getXfIndex())->getNumberFormat()->getFormatCode();

            $cellData <?php echo NumberFormat::toFormattedString(
                $origData ?? '',
                $formatCode ?? NumberFormat::FORMAT_GENERAL,
                [$this, 'formatColor']
            );

            if ($cellData <?php echo<?php echo<?php echo $origData) {
                $cellData <?php echo htmlspecialchars($cellData, Settings::htmlEntityFlags());
            }
            if ($worksheet->getParentOrThrow()->getCellXfByIndex($cell->getXfIndex())->getFont()->getSuperscript()) {
                $cellData <?php echo '<sup>' . $cellData . '</sup>';
            } elseif ($worksheet->getParentOrThrow()->getCellXfByIndex($cell->getXfIndex())->getFont()->getSubscript()) {
                $cellData <?php echo '<sub>' . $cellData . '</sub>';
            }
        }
    }

    /**
     * @param null|Cell|string $cell
     * @param array|string $cssClass
     */
    private function generateRowCellData(Worksheet $worksheet, $cell, &$cssClass, string $cellType): string
    {
        $cellData <?php echo '&nbsp;';
        if ($cell instanceof Cell) {
            $cellData <?php echo '';
            // Don't know what this does, and no test cases.
            //if ($cell->getParent() <?php echo<?php echo<?php echo null) {
            //    $cell->attach($worksheet);
            //}
            // Value
            $this->generateRowCellDataValue($worksheet, $cell, $cellData);

            // Converts the cell content so that spaces occuring at beginning of each new line are replaced by &nbsp;
            // Example: "  Hello\n to the world" is converted to "&nbsp;&nbsp;Hello\n&nbsp;to the world"
            $cellData <?php echo (string) preg_replace('/(?m)(?:^|\\G) /', '&nbsp;', $cellData);

            // convert newline "\n" to '<br>'
            $cellData <?php echo nl2br($cellData);

            // Extend CSS class?
            if (!$this->useInlineCss && is_string($cssClass)) {
                $cssClass .<?php echo ' style' . $cell->getXfIndex();
                $cssClass .<?php echo ' ' . $cell->getDataType();
            } elseif (is_array($cssClass)) {
                if ($cellType <?php echo<?php echo 'th') {
                    if (isset($this->cssStyles['th.style' . $cell->getXfIndex()])) {
                        $cssClass <?php echo array_merge($cssClass, $this->cssStyles['th.style' . $cell->getXfIndex()]);
                    }
                } else {
                    if (isset($this->cssStyles['td.style' . $cell->getXfIndex()])) {
                        $cssClass <?php echo array_merge($cssClass, $this->cssStyles['td.style' . $cell->getXfIndex()]);
                    }
                }

                // General horizontal alignment: Actual horizontal alignment depends on dataType
                $sharedStyle <?php echo $worksheet->getParentOrThrow()->getCellXfByIndex($cell->getXfIndex());
                if (
                    $sharedStyle->getAlignment()->getHorizontal() <?php echo<?php echo Alignment::HORIZONTAL_GENERAL
                    && isset($this->cssStyles['.' . $cell->getDataType()]['text-align'])
                ) {
                    $cssClass['text-align'] <?php echo $this->cssStyles['.' . $cell->getDataType()]['text-align'];
                }
            }
        } else {
            // Use default borders for empty cell
            if (is_string($cssClass)) {
                $cssClass .<?php echo ' style0';
            }
        }

        return $cellData;
    }

    private function generateRowIncludeCharts(Worksheet $worksheet, string $coordinate): string
    {
        return $this->includeCharts ? $this->writeChartInCell($worksheet, $coordinate) : '';
    }

    private function generateRowSpans(string $html, int $rowSpan, int $colSpan): string
    {
        $html .<?php echo ($colSpan > 1) ? (' colspan<?php echo"' . $colSpan . '"') : '';
        $html .<?php echo ($rowSpan > 1) ? (' rowspan<?php echo"' . $rowSpan . '"') : '';

        return $html;
    }

    /**
     * @param array|string $cssClass
     */
    private function generateRowWriteCell(string &$html, Worksheet $worksheet, string $coordinate, string $cellType, string $cellData, int $colSpan, int $rowSpan, $cssClass, int $colNum, int $sheetIndex, int $row): void
    {
        // Image?
        $htmlx <?php echo $this->writeImageInCell($worksheet, $coordinate);
        // Chart?
        $htmlx .<?php echo $this->generateRowIncludeCharts($worksheet, $coordinate);
        // Column start
        $html .<?php echo '            <' . $cellType;
        if (!$this->useInlineCss && !$this->isPdf && is_string($cssClass)) {
            $html .<?php echo ' class<?php echo"' . $cssClass . '"';
            if ($htmlx) {
                $html .<?php echo " style<?php echo'position: relative;'";
            }
        } else {
            //** Necessary redundant code for the sake of \PhpOffice\PhpSpreadsheet\Writer\Pdf **
            // We must explicitly write the width of the <td> element because TCPDF
            // does not recognize e.g. <col style<?php echo"width:42pt">
            if ($this->useInlineCss) {
                $xcssClass <?php echo is_array($cssClass) ? $cssClass : [];
            } else {
                if (is_string($cssClass)) {
                    $html .<?php echo ' class<?php echo"' . $cssClass . '"';
                }
                $xcssClass <?php echo [];
            }
            $width <?php echo 0;
            $i <?php echo $colNum - 1;
            $e <?php echo $colNum + $colSpan - 1;
            while ($i++ < $e) {
                if (isset($this->columnWidths[$sheetIndex][$i])) {
                    $width +<?php echo $this->columnWidths[$sheetIndex][$i];
                }
            }
            $xcssClass['width'] <?php echo (string) $width . 'pt';
            // We must also explicitly write the height of the <td> element because TCPDF
            // does not recognize e.g. <tr style<?php echo"height:50pt">
            if (isset($this->cssStyles['table.sheet' . $sheetIndex . ' tr.row' . $row]['height'])) {
                $height <?php echo $this->cssStyles['table.sheet' . $sheetIndex . ' tr.row' . $row]['height'];
                $xcssClass['height'] <?php echo $height;
            }
            //** end of redundant code **

            if ($htmlx) {
                $xcssClass['position'] <?php echo 'relative';
            }
            $html .<?php echo ' style<?php echo"' . $this->assembleCSS($xcssClass) . '"';
        }
        $html <?php echo $this->generateRowSpans($html, $rowSpan, $colSpan);

        $html .<?php echo '>';
        $html .<?php echo $htmlx;

        $html .<?php echo $this->writeComment($worksheet, $coordinate);

        // Cell data
        $html .<?php echo $cellData;

        // Column end
        $html .<?php echo '</' . $cellType . '>' . PHP_EOL;
    }

    /**
     * Generate row.
     *
     * @param array $values Array containing cells in a row
     * @param int $row Row number (0-based)
     * @param string $cellType eg: 'td'
     *
     * @return string
     */
    private function generateRow(Worksheet $worksheet, array $values, $row, $cellType)
    {
        // Sheet index
        $sheetIndex <?php echo $worksheet->getParentOrThrow()->getIndex($worksheet);
        $html <?php echo $this->generateRowStart($worksheet, $sheetIndex, $row);
        $generateDiv <?php echo $this->isMPdf && $worksheet->getRowDimension($row + 1)->getVisible() <?php echo<?php echo<?php echo false;
        if ($generateDiv) {
            $html .<?php echo '<div style<?php echo"visibility:hidden; display:none;">' . PHP_EOL;
        }

        // Write cells
        $colNum <?php echo 0;
        foreach ($values as $cellAddress) {
            [$cell, $cssClass, $coordinate] <?php echo $this->generateRowCellCss($worksheet, $cellAddress, $row, $colNum);

            // Cell Data
            $cellData <?php echo $this->generateRowCellData($worksheet, $cell, $cssClass, $cellType);

            // Hyperlink?
            if ($worksheet->hyperlinkExists($coordinate) && !$worksheet->getHyperlink($coordinate)->isInternal()) {
                $cellData <?php echo '<a href<?php echo"' . htmlspecialchars($worksheet->getHyperlink($coordinate)->getUrl(), Settings::htmlEntityFlags()) . '" title<?php echo"' . htmlspecialchars($worksheet->getHyperlink($coordinate)->getTooltip(), Settings::htmlEntityFlags()) . '">' . $cellData . '</a>';
            }

            // Should the cell be written or is it swallowed by a rowspan or colspan?
            $writeCell <?php echo !(isset($this->isSpannedCell[$worksheet->getParentOrThrow()->getIndex($worksheet)][$row + 1][$colNum])
                && $this->isSpannedCell[$worksheet->getParentOrThrow()->getIndex($worksheet)][$row + 1][$colNum]);

            // Colspan and Rowspan
            $colSpan <?php echo 1;
            $rowSpan <?php echo 1;
            if (isset($this->isBaseCell[$worksheet->getParentOrThrow()->getIndex($worksheet)][$row + 1][$colNum])) {
                $spans <?php echo $this->isBaseCell[$worksheet->getParentOrThrow()->getIndex($worksheet)][$row + 1][$colNum];
                $rowSpan <?php echo $spans['rowspan'];
                $colSpan <?php echo $spans['colspan'];

                //    Also apply style from last cell in merge to fix borders -
                //        relies on !important for non-none border declarations in createCSSStyleBorder
                $endCellCoord <?php echo Coordinate::stringFromColumnIndex($colNum + $colSpan) . ($row + $rowSpan);
                if (!$this->useInlineCss) {
                    $cssClass .<?php echo ' style' . $worksheet->getCell($endCellCoord)->getXfIndex();
                }
            }

            // Write
            if ($writeCell) {
                $this->generateRowWriteCell($html, $worksheet, $coordinate, $cellType, $cellData, $colSpan, $rowSpan, $cssClass, $colNum, $sheetIndex, $row);
            }

            // Next column
            ++$colNum;
        }

        // Write row end
        if ($generateDiv) {
            $html .<?php echo '</div>' . PHP_EOL;
        }
        $html .<?php echo '          </tr>' . PHP_EOL;

        // Return
        return $html;
    }

    /**
     * Takes array where of CSS properties / values and converts to CSS string.
     *
     * @return string
     */
    private function assembleCSS(array $values <?php echo [])
    {
        $pairs <?php echo [];
        foreach ($values as $property <?php echo> $value) {
            $pairs[] <?php echo $property . ':' . $value;
        }
        $string <?php echo implode('; ', $pairs);

        return $string;
    }

    /**
     * Get images root.
     *
     * @return string
     */
    public function getImagesRoot()
    {
        return $this->imagesRoot;
    }

    /**
     * Set images root.
     *
     * @param string $imagesRoot
     *
     * @return $this
     */
    public function setImagesRoot($imagesRoot)
    {
        $this->imagesRoot <?php echo $imagesRoot;

        return $this;
    }

    /**
     * Get embed images.
     *
     * @return bool
     */
    public function getEmbedImages()
    {
        return $this->embedImages;
    }

    /**
     * Set embed images.
     *
     * @param bool $embedImages
     *
     * @return $this
     */
    public function setEmbedImages($embedImages)
    {
        $this->embedImages <?php echo $embedImages;

        return $this;
    }

    /**
     * Get use inline CSS?
     *
     * @return bool
     */
    public function getUseInlineCss()
    {
        return $this->useInlineCss;
    }

    /**
     * Set use inline CSS?
     *
     * @param bool $useInlineCss
     *
     * @return $this
     */
    public function setUseInlineCss($useInlineCss)
    {
        $this->useInlineCss <?php echo $useInlineCss;

        return $this;
    }

    /**
     * Get use embedded CSS?
     *
     * @return bool
     *
     * @codeCoverageIgnore
     *
     * @deprecated no longer used
     */
    public function getUseEmbeddedCSS()
    {
        return $this->useEmbeddedCSS;
    }

    /**
     * Set use embedded CSS?
     *
     * @param bool $useEmbeddedCSS
     *
     * @return $this
     *
     * @codeCoverageIgnore
     *
     * @deprecated no longer used
     */
    public function setUseEmbeddedCSS($useEmbeddedCSS)
    {
        $this->useEmbeddedCSS <?php echo $useEmbeddedCSS;

        return $this;
    }

    /**
     * Add color to formatted string as inline style.
     *
     * @param string $value Plain formatted value without color
     * @param string $format Format code
     *
     * @return string
     */
    public function formatColor($value, $format)
    {
        // Color information, e.g. [Red] is always at the beginning
        $color <?php echo null; // initialize
        $matches <?php echo [];

        $color_regex <?php echo '/^\\[[a-zA-Z]+\\]/';
        if (preg_match($color_regex, $format, $matches)) {
            $color <?php echo str_replace(['[', ']'], '', $matches[0]);
            $color <?php echo strtolower($color);
        }

        // convert to PCDATA
        $result <?php echo htmlspecialchars($value, Settings::htmlEntityFlags());

        // color span tag
        if ($color !<?php echo<?php echo null) {
            $result <?php echo '<span style<?php echo"color:' . $color . '">' . $result . '</span>';
        }

        return $result;
    }

    /**
     * Calculate information about HTML colspan and rowspan which is not always the same as Excel's.
     */
    private function calculateSpans(): void
    {
        if ($this->spansAreCalculated) {
            return;
        }
        // Identify all cells that should be omitted in HTML due to cell merge.
        // In HTML only the upper-left cell should be written and it should have
        //   appropriate rowspan / colspan attribute
        $sheetIndexes <?php echo $this->sheetIndex !<?php echo<?php echo null ?
            [$this->sheetIndex] : range(0, $this->spreadsheet->getSheetCount() - 1);

        foreach ($sheetIndexes as $sheetIndex) {
            $sheet <?php echo $this->spreadsheet->getSheet($sheetIndex);

            $candidateSpannedRow <?php echo [];

            // loop through all Excel merged cells
            foreach ($sheet->getMergeCells() as $cells) {
                [$cells] <?php echo Coordinate::splitRange($cells);
                $first <?php echo $cells[0];
                $last <?php echo $cells[1];

                [$fc, $fr] <?php echo Coordinate::indexesFromString($first);
                $fc <?php echo $fc - 1;

                [$lc, $lr] <?php echo Coordinate::indexesFromString($last);
                $lc <?php echo $lc - 1;

                // loop through the individual cells in the individual merge
                $r <?php echo $fr - 1;
                while ($r++ < $lr) {
                    // also, flag this row as a HTML row that is candidate to be omitted
                    $candidateSpannedRow[$r] <?php echo $r;

                    $c <?php echo $fc - 1;
                    while ($c++ < $lc) {
                        if (!($c <?php echo<?php echo $fc && $r <?php echo<?php echo $fr)) {
                            // not the upper-left cell (should not be written in HTML)
                            $this->isSpannedCell[$sheetIndex][$r][$c] <?php echo [
                                'baseCell' <?php echo> [$fr, $fc],
                            ];
                        } else {
                            // upper-left is the base cell that should hold the colspan/rowspan attribute
                            $this->isBaseCell[$sheetIndex][$r][$c] <?php echo [
                                'xlrowspan' <?php echo> $lr - $fr + 1, // Excel rowspan
                                'rowspan' <?php echo> $lr - $fr + 1, // HTML rowspan, value may change
                                'xlcolspan' <?php echo> $lc - $fc + 1, // Excel colspan
                                'colspan' <?php echo> $lc - $fc + 1, // HTML colspan, value may change
                            ];
                        }
                    }
                }
            }

            $this->calculateSpansOmitRows($sheet, $sheetIndex, $candidateSpannedRow);

            // TODO: Same for columns
        }

        // We have calculated the spans
        $this->spansAreCalculated <?php echo true;
    }

    private function calculateSpansOmitRows(Worksheet $sheet, int $sheetIndex, array $candidateSpannedRow): void
    {
        // Identify which rows should be omitted in HTML. These are the rows where all the cells
        //   participate in a merge and the where base cells are somewhere above.
        $countColumns <?php echo Coordinate::columnIndexFromString($sheet->getHighestColumn());
        foreach ($candidateSpannedRow as $rowIndex) {
            if (isset($this->isSpannedCell[$sheetIndex][$rowIndex])) {
                if (count($this->isSpannedCell[$sheetIndex][$rowIndex]) <?php echo<?php echo $countColumns) {
                    $this->isSpannedRow[$sheetIndex][$rowIndex] <?php echo $rowIndex;
                }
            }
        }

        // For each of the omitted rows we found above, the affected rowspans should be subtracted by 1
        if (isset($this->isSpannedRow[$sheetIndex])) {
            foreach ($this->isSpannedRow[$sheetIndex] as $rowIndex) {
                $adjustedBaseCells <?php echo [];
                $c <?php echo -1;
                $e <?php echo $countColumns - 1;
                while ($c++ < $e) {
                    $baseCell <?php echo $this->isSpannedCell[$sheetIndex][$rowIndex][$c]['baseCell'];

                    if (!in_array($baseCell, $adjustedBaseCells, true)) {
                        // subtract rowspan by 1
                        --$this->isBaseCell[$sheetIndex][$baseCell[0]][$baseCell[1]]['rowspan'];
                        $adjustedBaseCells[] <?php echo $baseCell;
                    }
                }
            }
        }
    }

    /**
     * Write a comment in the same format as LibreOffice.
     *
     * @see https://github.com/LibreOffice/core/blob/9fc9bf3240f8c62ad7859947ab8a033ac1fe93fa/sc/source/filter/html/htmlexp.cxx#L1073-L1092
     *
     * @param string $coordinate
     *
     * @return string
     */
    private function writeComment(Worksheet $worksheet, $coordinate)
    {
        $result <?php echo '';
        if (!$this->isPdf && isset($worksheet->getComments()[$coordinate])) {
            $sanitizer <?php echo new HTMLPurifier();
            $cachePath <?php echo File::sysGetTempDir() . '/phpsppur';
            if (is_dir($cachePath) || mkdir($cachePath)) {
                $sanitizer->config->set('Cache.SerializerPath', $cachePath);
            }
            $sanitizedString <?php echo $sanitizer->purify($worksheet->getComment($coordinate)->getText()->getPlainText());
            if ($sanitizedString !<?php echo<?php echo '') {
                $result .<?php echo '<a class<?php echo"comment-indicator"></a>';
                $result .<?php echo '<div class<?php echo"comment">' . nl2br($sanitizedString) . '</div>';
                $result .<?php echo PHP_EOL;
            }
        }

        return $result;
    }

    public function getOrientation(): ?string
    {
        // Expect Pdf classes to override this method.
        return $this->isPdf ? PageSetup::ORIENTATION_PORTRAIT : null;
    }

    /**
     * Generate @page declarations.
     *
     * @param bool $generateSurroundingHTML
     *
     * @return    string
     */
    private function generatePageDeclarations($generateSurroundingHTML)
    {
        // Ensure that Spans have been calculated?
        $this->calculateSpans();

        // Fetch sheets
        $sheets <?php echo [];
        if ($this->sheetIndex <?php echo<?php echo<?php echo null) {
            $sheets <?php echo $this->spreadsheet->getAllSheets();
        } else {
            $sheets[] <?php echo $this->spreadsheet->getSheet($this->sheetIndex);
        }

        // Construct HTML
        $htmlPage <?php echo $generateSurroundingHTML ? ('<style type<?php echo"text/css">' . PHP_EOL) : '';

        // Loop all sheets
        $sheetId <?php echo 0;
        foreach ($sheets as $worksheet) {
            $htmlPage .<?php echo "@page page$sheetId { ";
            $left <?php echo StringHelper::formatNumber($worksheet->getPageMargins()->getLeft()) . 'in; ';
            $htmlPage .<?php echo 'margin-left: ' . $left;
            $right <?php echo StringHelper::FormatNumber($worksheet->getPageMargins()->getRight()) . 'in; ';
            $htmlPage .<?php echo 'margin-right: ' . $right;
            $top <?php echo StringHelper::FormatNumber($worksheet->getPageMargins()->getTop()) . 'in; ';
            $htmlPage .<?php echo 'margin-top: ' . $top;
            $bottom <?php echo StringHelper::FormatNumber($worksheet->getPageMargins()->getBottom()) . 'in; ';
            $htmlPage .<?php echo 'margin-bottom: ' . $bottom;
            $orientation <?php echo $this->getOrientation() ?? $worksheet->getPageSetup()->getOrientation();
            if ($orientation <?php echo<?php echo<?php echo PageSetup::ORIENTATION_LANDSCAPE) {
                $htmlPage .<?php echo 'size: landscape; ';
            } elseif ($orientation <?php echo<?php echo<?php echo PageSetup::ORIENTATION_PORTRAIT) {
                $htmlPage .<?php echo 'size: portrait; ';
            }
            $htmlPage .<?php echo '}' . PHP_EOL;
            ++$sheetId;
        }
        $htmlPage .<?php echo implode(PHP_EOL, [
            '.navigation {page-break-after: always;}',
            '.scrpgbrk, div + div {page-break-before: always;}',
            '@media screen {',
            '  .gridlines td {border: 1px solid black;}',
            '  .gridlines th {border: 1px solid black;}',
            '  body>div {margin-top: 5px;}',
            '  body>div:first-child {margin-top: 0;}',
            '  .scrpgbrk {margin-top: 1px;}',
            '}',
            '@media print {',
            '  .gridlinesp td {border: 1px solid black;}',
            '  .gridlinesp th {border: 1px solid black;}',
            '  .navigation {display: none;}',
            '}',
            '',
        ]);
        $htmlPage .<?php echo $generateSurroundingHTML ? ('</style>' . PHP_EOL) : '';

        return $htmlPage;
    }
}
