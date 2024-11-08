<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls;

use GdImage;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\RichText\Run;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Shared\Xls;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\SheetView;
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;

// Original file header of PEAR::Spreadsheet_Excel_Writer_Worksheet (used as the base for this class):
// -----------------------------------------------------------------------------------------
// /*
// *  Module written/ported by Xavier Noguer <xnoguer@rezebra.com>
// *
// *  The majority of this is _NOT_ my code.  I simply ported it from the
// *  PERL Spreadsheet::WriteExcel module.
// *
// *  The author of the Spreadsheet::WriteExcel module is John McNamara
// *  <jmcnamara@cpan.org>
// *
// *  I _DO_ maintain this code, and John McNamara has nothing to do with the
// *  porting of this code to PHP.  Any questions directly related to this
// *  class library should be directed to me.
// *
// *  License Information:
// *
// *    Spreadsheet_Excel_Writer:  A library for generating Excel Spreadsheets
// *    Copyright (c) 2002-2003 Xavier Noguer xnoguer@rezebra.com
// *
// *    This library is free software; you can redistribute it and/or
// *    modify it under the terms of the GNU Lesser General Public
// *    License as published by the Free Software Foundation; either
// *    version 2.1 of the License, or (at your option) any later version.
// *
// *    This library is distributed in the hope that it will be useful,
// *    but WITHOUT ANY WARRANTY; without even the implied warranty of
// *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
// *    Lesser General Public License for more details.
// *
// *    You should have received a copy of the GNU Lesser General Public
// *    License along with this library; if not, write to the Free Software
// *    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
// */
class Worksheet extends BIFFwriter
{
    /** @var int */
    private static $always0 <?php echo 0;

    /** @var int */
    private static $always1 <?php echo 1;

    /**
     * Formula parser.
     *
     * @var \PhpOffice\PhpSpreadsheet\Writer\Xls\Parser
     */
    private $parser;

    /**
     * Array containing format information for columns.
     *
     * @var array
     */
    private $columnInfo;

    /**
     * The active pane for the worksheet.
     *
     * @var int
     */
    private $activePane;

    /**
     * Whether to use outline.
     *
     * @var bool
     */
    private $outlineOn;

    /**
     * Auto outline styles.
     *
     * @var bool
     */
    private $outlineStyle;

    /**
     * Whether to have outline summary below.
     * Not currently used.
     *
     * @var bool
     */
    private $outlineBelow; //* @phpstan-ignore-line

    /**
     * Whether to have outline summary at the right.
     * Not currently used.
     *
     * @var bool
     */
    private $outlineRight; //* @phpstan-ignore-line

    /**
     * Reference to the total number of strings in the workbook.
     *
     * @var int
     */
    private $stringTotal;

    /**
     * Reference to the number of unique strings in the workbook.
     *
     * @var int
     */
    private $stringUnique;

    /**
     * Reference to the array containing all the unique strings in the workbook.
     *
     * @var array
     */
    private $stringTable;

    /**
     * Color cache.
     *
     * @var array
     */
    private $colors;

    /**
     * Index of first used row (at least 0).
     *
     * @var int
     */
    private $firstRowIndex;

    /**
     * Index of last used row. (no used rows means -1).
     *
     * @var int
     */
    private $lastRowIndex;

    /**
     * Index of first used column (at least 0).
     *
     * @var int
     */
    private $firstColumnIndex;

    /**
     * Index of last used column (no used columns means -1).
     *
     * @var int
     */
    private $lastColumnIndex;

    /**
     * Sheet object.
     *
     * @var \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     */
    public $phpSheet;

    /**
     * Escher object corresponding to MSODRAWING.
     *
     * @var null|\PhpOffice\PhpSpreadsheet\Shared\Escher
     */
    private $escher;

    /**
     * Array of font hashes associated to FONT records index.
     *
     * @var array
     */
    public $fontHashIndex;

    /**
     * @var bool
     */
    private $preCalculateFormulas;

    /**
     * @var int
     */
    private $printHeaders;

    /**
     * Constructor.
     *
     * @param int $str_total Total number of strings
     * @param int $str_unique Total number of unique strings
     * @param array $str_table String Table
     * @param array $colors Colour Table
     * @param Parser $parser The formula parser created for the Workbook
     * @param bool $preCalculateFormulas Flag indicating whether formulas should be calculated or just written
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $phpSheet The worksheet to write
     */
    public function __construct(&$str_total, &$str_unique, &$str_table, &$colors, Parser $parser, $preCalculateFormulas, \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $phpSheet)
    {
        // It needs to call its parent's constructor explicitly
        parent::__construct();

        $this->preCalculateFormulas <?php echo $preCalculateFormulas;
        $this->stringTotal <?php echo &$str_total;
        $this->stringUnique <?php echo &$str_unique;
        $this->stringTable <?php echo &$str_table;
        $this->colors <?php echo &$colors;
        $this->parser <?php echo $parser;

        $this->phpSheet <?php echo $phpSheet;

        $this->columnInfo <?php echo [];
        $this->activePane <?php echo 3;

        $this->printHeaders <?php echo 0;

        $this->outlineStyle <?php echo false;
        $this->outlineBelow <?php echo true;
        $this->outlineRight <?php echo true;
        $this->outlineOn <?php echo true;

        $this->fontHashIndex <?php echo [];

        // calculate values for DIMENSIONS record
        $minR <?php echo 1;
        $minC <?php echo 'A';

        $maxR <?php echo $this->phpSheet->getHighestRow();
        $maxC <?php echo $this->phpSheet->getHighestColumn();

        // Determine lowest and highest column and row
        $this->firstRowIndex <?php echo $minR;
        $this->lastRowIndex <?php echo ($maxR > 65535) ? 65535 : $maxR;

        $this->firstColumnIndex <?php echo Coordinate::columnIndexFromString($minC);
        $this->lastColumnIndex <?php echo Coordinate::columnIndexFromString($maxC);

        if ($this->lastColumnIndex > 255) {
            $this->lastColumnIndex <?php echo 255;
        }
    }

    /**
     * Add data to the beginning of the workbook (note the reverse order)
     * and to the end of the workbook.
     *
     * @see \PhpOffice\PhpSpreadsheet\Writer\Xls\Workbook::storeWorkbook()
     */
    public function close(): void
    {
        $phpSheet <?php echo $this->phpSheet;

        // Storing selected cells and active sheet because it changes while parsing cells with formulas.
        $selectedCells <?php echo $this->phpSheet->getSelectedCells();
        $activeSheetIndex <?php echo $this->phpSheet->getParentOrThrow()->getActiveSheetIndex();

        // Write BOF record
        $this->storeBof(0x0010);

        // Write PRINTHEADERS
        $this->writePrintHeaders();

        // Write PRINTGRIDLINES
        $this->writePrintGridlines();

        // Write GRIDSET
        $this->writeGridset();

        // Calculate column widths
        $phpSheet->calculateColumnWidths();

        // Column dimensions
        if (($defaultWidth <?php echo $phpSheet->getDefaultColumnDimension()->getWidth()) < 0) {
            $defaultWidth <?php echo \PhpOffice\PhpSpreadsheet\Shared\Font::getDefaultColumnWidthByFont($phpSheet->getParentOrThrow()->getDefaultStyle()->getFont());
        }

        $columnDimensions <?php echo $phpSheet->getColumnDimensions();
        $maxCol <?php echo $this->lastColumnIndex - 1;
        for ($i <?php echo 0; $i <?php echo $maxCol; ++$i) {
            $hidden <?php echo 0;
            $level <?php echo 0;
            $xfIndex <?php echo 15; // there are 15 cell style Xfs

            $width <?php echo $defaultWidth;

            $columnLetter <?php echo Coordinate::stringFromColumnIndex($i + 1);
            if (isset($columnDimensions[$columnLetter])) {
                $columnDimension <?php echo $columnDimensions[$columnLetter];
                if ($columnDimension->getWidth() ><?php echo 0) {
                    $width <?php echo $columnDimension->getWidth();
                }
                $hidden <?php echo $columnDimension->getVisible() ? 0 : 1;
                $level <?php echo $columnDimension->getOutlineLevel();
                $xfIndex <?php echo $columnDimension->getXfIndex() + 15; // there are 15 cell style Xfs
            }

            // Components of columnInfo:
            // $firstcol first column on the range
            // $lastcol  last column on the range
            // $width    width to set
            // $xfIndex  The optional cell style Xf index to apply to the columns
            // $hidden   The optional hidden atribute
            // $level    The optional outline level
            $this->columnInfo[] <?php echo [$i, $i, $width, $xfIndex, $hidden, $level];
        }

        // Write GUTS
        $this->writeGuts();

        // Write DEFAULTROWHEIGHT
        $this->writeDefaultRowHeight();
        // Write WSBOOL
        $this->writeWsbool();
        // Write horizontal and vertical page breaks
        $this->writeBreaks();
        // Write page header
        $this->writeHeader();
        // Write page footer
        $this->writeFooter();
        // Write page horizontal centering
        $this->writeHcenter();
        // Write page vertical centering
        $this->writeVcenter();
        // Write left margin
        $this->writeMarginLeft();
        // Write right margin
        $this->writeMarginRight();
        // Write top margin
        $this->writeMarginTop();
        // Write bottom margin
        $this->writeMarginBottom();
        // Write page setup
        $this->writeSetup();
        // Write sheet protection
        $this->writeProtect();
        // Write SCENPROTECT
        $this->writeScenProtect();
        // Write OBJECTPROTECT
        $this->writeObjectProtect();
        // Write sheet password
        $this->writePassword();
        // Write DEFCOLWIDTH record
        $this->writeDefcol();

        // Write the COLINFO records if they exist
        if (!empty($this->columnInfo)) {
            $colcount <?php echo count($this->columnInfo);
            for ($i <?php echo 0; $i < $colcount; ++$i) {
                $this->writeColinfo($this->columnInfo[$i]);
            }
        }
        $autoFilterRange <?php echo $phpSheet->getAutoFilter()->getRange();
        if (!empty($autoFilterRange)) {
            // Write AUTOFILTERINFO
            $this->writeAutoFilterInfo();
        }

        // Write sheet dimensions
        $this->writeDimensions();

        // Row dimensions
        foreach ($phpSheet->getRowDimensions() as $rowDimension) {
            $xfIndex <?php echo $rowDimension->getXfIndex() + 15; // there are 15 cellXfs
            $this->writeRow(
                $rowDimension->getRowIndex() - 1,
                (int) $rowDimension->getRowHeight(),
                $xfIndex,
                !$rowDimension->getVisible(),
                $rowDimension->getOutlineLevel()
            );
        }

        // Write Cells
        foreach ($phpSheet->getCellCollection()->getSortedCoordinates() as $coordinate) {
            /** @var Cell $cell */
            $cell <?php echo $phpSheet->getCellCollection()->get($coordinate);
            $row <?php echo $cell->getRow() - 1;
            $column <?php echo Coordinate::columnIndexFromString($cell->getColumn()) - 1;

            // Don't break Excel break the code!
            if ($row > 65535 || $column > 255) {
                throw new WriterException('Rows or columns overflow! Excel5 has limit to 65535 rows and 255 columns. Use XLSX instead.');
            }

            // Write cell value
            $xfIndex <?php echo $cell->getXfIndex() + 15; // there are 15 cell style Xfs

            $cVal <?php echo $cell->getValue();
            if ($cVal instanceof RichText) {
                $arrcRun <?php echo [];
                $str_pos <?php echo 0;
                $elements <?php echo $cVal->getRichTextElements();
                foreach ($elements as $element) {
                    // FONT Index
                    $str_fontidx <?php echo 0;
                    if ($element instanceof Run) {
                        $getFont <?php echo $element->getFont();
                        if ($getFont !<?php echo<?php echo null) {
                            $str_fontidx <?php echo $this->fontHashIndex[$getFont->getHashCode()];
                        }
                    }
                    $arrcRun[] <?php echo ['strlen' <?php echo> $str_pos, 'fontidx' <?php echo> $str_fontidx];
                    // Position FROM
                    $str_pos +<?php echo StringHelper::countCharacters($element->getText(), 'UTF-8');
                }
                $this->writeRichTextString($row, $column, $cVal->getPlainText(), $xfIndex, $arrcRun);
            } else {
                switch ($cell->getDatatype()) {
                    case DataType::TYPE_STRING:
                    case DataType::TYPE_INLINE:
                    case DataType::TYPE_NULL:
                        if ($cVal <?php echo<?php echo<?php echo '' || $cVal <?php echo<?php echo<?php echo null) {
                            $this->writeBlank($row, $column, $xfIndex);
                        } else {
                            $this->writeString($row, $column, $cVal, $xfIndex);
                        }

                        break;
                    case DataType::TYPE_NUMERIC:
                        $this->writeNumber($row, $column, $cVal, $xfIndex);

                        break;
                    case DataType::TYPE_FORMULA:
                        $calculatedValue <?php echo $this->preCalculateFormulas ?
                            $cell->getCalculatedValue() : null;
                        if (self::WRITE_FORMULA_EXCEPTION <?php echo<?php echo $this->writeFormula($row, $column, $cVal, $xfIndex, $calculatedValue)) {
                            if ($calculatedValue <?php echo<?php echo<?php echo null) {
                                $calculatedValue <?php echo $cell->getCalculatedValue();
                            }
                            $calctype <?php echo gettype($calculatedValue);
                            switch ($calctype) {
                                case 'integer':
                                case 'double':
                                    $this->writeNumber($row, $column, (float) $calculatedValue, $xfIndex);

                                    break;
                                case 'string':
                                    $this->writeString($row, $column, $calculatedValue, $xfIndex);

                                    break;
                                case 'boolean':
                                    $this->writeBoolErr($row, $column, (int) $calculatedValue, 0, $xfIndex);

                                    break;
                                default:
                                    $this->writeString($row, $column, $cVal, $xfIndex);
                            }
                        }

                        break;
                    case DataType::TYPE_BOOL:
                        $this->writeBoolErr($row, $column, $cVal, 0, $xfIndex);

                        break;
                    case DataType::TYPE_ERROR:
                        $this->writeBoolErr($row, $column, ErrorCode::error($cVal), 1, $xfIndex);

                        break;
                }
            }
        }

        // Append
        $this->writeMsoDrawing();

        // Restoring active sheet.
        $this->phpSheet->getParentOrThrow()->setActiveSheetIndex($activeSheetIndex);

        // Write WINDOW2 record
        $this->writeWindow2();

        // Write PLV record
        $this->writePageLayoutView();

        // Write ZOOM record
        $this->writeZoom();
        if ($phpSheet->getFreezePane()) {
            $this->writePanes();
        }

        // Restoring selected cells.
        $this->phpSheet->setSelectedCells($selectedCells);

        // Write SELECTION record
        $this->writeSelection();

        // Write MergedCellsTable Record
        $this->writeMergedCells();

        // Hyperlinks
        $phpParent <?php echo $phpSheet->getParent();
        $hyperlinkbase <?php echo ($phpParent <?php echo<?php echo<?php echo null) ? '' : $phpParent->getProperties()->getHyperlinkBase();
        foreach ($phpSheet->getHyperLinkCollection() as $coordinate <?php echo> $hyperlink) {
            [$column, $row] <?php echo Coordinate::indexesFromString($coordinate);

            $url <?php echo $hyperlink->getUrl();

            if (strpos($url, 'sheet://') !<?php echo<?php echo false) {
                // internal to current workbook
                $url <?php echo str_replace('sheet://', 'internal:', $url);
            } elseif (preg_match('/^(http:|https:|ftp:|mailto:)/', $url)) {
                // URL
            } elseif (!empty($hyperlinkbase) && preg_match('~^([A-Za-z]:)?[/\\\\]~', $url) !<?php echo<?php echo 1) {
                $url <?php echo "$hyperlinkbase$url";
                if (preg_match('/^(http:|https:|ftp:|mailto:)/', $url) !<?php echo<?php echo 1) {
                    $url <?php echo 'external:' . $url;
                }
            } else {
                // external (local file)
                $url <?php echo 'external:' . $url;
            }

            $this->writeUrl($row - 1, $column - 1, $url);
        }

        $this->writeDataValidity();
        $this->writeSheetLayout();

        // Write SHEETPROTECTION record
        $this->writeSheetProtection();
        $this->writeRangeProtection();

        // Write Conditional Formatting Rules and Styles
        $this->writeConditionalFormatting();

        $this->storeEof();
    }

    private function writeConditionalFormatting(): void
    {
        $conditionalFormulaHelper <?php echo new ConditionalHelper($this->parser);

        $arrConditionalStyles <?php echo $this->phpSheet->getConditionalStylesCollection();
        if (!empty($arrConditionalStyles)) {
            $arrConditional <?php echo [];

            // Write ConditionalFormattingTable records
            foreach ($arrConditionalStyles as $cellCoordinate <?php echo> $conditionalStyles) {
                $cfHeaderWritten <?php echo false;
                foreach ($conditionalStyles as $conditional) {
                    /** @var Conditional $conditional */
                    if (
                        $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_EXPRESSION ||
                        $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_CELLIS
                    ) {
                        // Write CFHEADER record (only if there are Conditional Styles that we are able to write)
                        if ($cfHeaderWritten <?php echo<?php echo<?php echo false) {
                            $cfHeaderWritten <?php echo $this->writeCFHeader($cellCoordinate, $conditionalStyles);
                        }
                        if ($cfHeaderWritten <?php echo<?php echo<?php echo true && !isset($arrConditional[$conditional->getHashCode()])) {
                            // This hash code has been handled
                            $arrConditional[$conditional->getHashCode()] <?php echo true;

                            // Write CFRULE record
                            $this->writeCFRule($conditionalFormulaHelper, $conditional, $cellCoordinate);
                        }
                    }
                }
            }
        }
    }

    /**
     * Write a cell range address in BIFF8
     * always fixed range
     * See section 2.5.14 in OpenOffice.org's Documentation of the Microsoft Excel File Format.
     *
     * @param string $range E.g. 'A1' or 'A1:B6'
     *
     * @return string Binary data
     */
    private function writeBIFF8CellRangeAddressFixed($range)
    {
        $explodes <?php echo explode(':', $range);

        // extract first cell, e.g. 'A1'
        $firstCell <?php echo $explodes[0];

        // extract last cell, e.g. 'B6'
        if (count($explodes) <?php echo<?php echo 1) {
            $lastCell <?php echo $firstCell;
        } else {
            $lastCell <?php echo $explodes[1];
        }

        $firstCellCoordinates <?php echo Coordinate::indexesFromString($firstCell); // e.g. [0, 1]
        $lastCellCoordinates <?php echo Coordinate::indexesFromString($lastCell); // e.g. [1, 6]

        return pack('vvvv', $firstCellCoordinates[1] - 1, $lastCellCoordinates[1] - 1, $firstCellCoordinates[0] - 1, $lastCellCoordinates[0] - 1);
    }

    /**
     * Retrieves data from memory in one chunk, or from disk
     * sized chunks.
     *
     * @return string The data
     */
    public function getData()
    {
        // Return data stored in memory
        if (isset($this->_data)) {
            $tmp <?php echo $this->_data;
            $this->_data <?php echo null;

            return $tmp;
        }

        // No data to return
        return '';
    }

    /**
     * Set the option to print the row and column headers on the printed page.
     *
     * @param int $print Whether to print the headers or not. Defaults to 1 (print).
     */
    public function printRowColHeaders($print <?php echo 1): void
    {
        $this->printHeaders <?php echo $print;
    }

    /**
     * This method sets the properties for outlining and grouping. The defaults
     * correspond to Excel's defaults.
     *
     * @param bool $visible
     * @param bool $symbols_below
     * @param bool $symbols_right
     * @param bool $auto_style
     */
    public function setOutline($visible <?php echo true, $symbols_below <?php echo true, $symbols_right <?php echo true, $auto_style <?php echo false): void
    {
        $this->outlineOn <?php echo $visible;
        $this->outlineBelow <?php echo $symbols_below;
        $this->outlineRight <?php echo $symbols_right;
        $this->outlineStyle <?php echo $auto_style;
    }

    /**
     * Write a double to the specified row and column (zero indexed).
     * An integer can be written as a double. Excel will display an
     * integer. $format is optional.
     *
     * Returns  0 : normal termination
     *         -2 : row or column out of range
     *
     * @param int $row Zero indexed row
     * @param int $col Zero indexed column
     * @param float $num The number to write
     * @param mixed $xfIndex The optional XF format
     *
     * @return int
     */
    private function writeNumber($row, $col, $num, $xfIndex)
    {
        $record <?php echo 0x0203; // Record identifier
        $length <?php echo 0x000E; // Number of bytes to follow

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvv', $row, $col, $xfIndex);
        $xl_double <?php echo pack('d', $num);
        if (self::getByteOrder()) { // if it's Big Endian
            $xl_double <?php echo strrev($xl_double);
        }

        $this->append($header . $data . $xl_double);

        return 0;
    }

    /**
     * Write a LABELSST record or a LABEL record. Which one depends on BIFF version.
     *
     * @param int $row Row index (0-based)
     * @param int $col Column index (0-based)
     * @param string $str The string
     * @param int $xfIndex Index to XF record
     */
    private function writeString($row, $col, $str, $xfIndex): void
    {
        $this->writeLabelSst($row, $col, $str, $xfIndex);
    }

    /**
     * Write a LABELSST record or a LABEL record. Which one depends on BIFF version
     * It differs from writeString by the writing of rich text strings.
     *
     * @param int $row Row index (0-based)
     * @param int $col Column index (0-based)
     * @param string $str The string
     * @param int $xfIndex The XF format index for the cell
     * @param array $arrcRun Index to Font record and characters beginning
     */
    private function writeRichTextString($row, $col, $str, $xfIndex, $arrcRun): void
    {
        $record <?php echo 0x00FD; // Record identifier
        $length <?php echo 0x000A; // Bytes to follow
        $str <?php echo StringHelper::UTF8toBIFF8UnicodeShort($str, $arrcRun);

        // check if string is already present
        if (!isset($this->stringTable[$str])) {
            $this->stringTable[$str] <?php echo $this->stringUnique++;
        }
        ++$this->stringTotal;

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvV', $row, $col, $xfIndex, $this->stringTable[$str]);
        $this->append($header . $data);
    }

    /**
     * Write a string to the specified row and column (zero indexed).
     * This is the BIFF8 version (no 255 chars limit).
     * $format is optional.
     *
     * @param int $row Zero indexed row
     * @param int $col Zero indexed column
     * @param string $str The string to write
     * @param mixed $xfIndex The XF format index for the cell
     */
    private function writeLabelSst($row, $col, $str, $xfIndex): void
    {
        $record <?php echo 0x00FD; // Record identifier
        $length <?php echo 0x000A; // Bytes to follow

        $str <?php echo StringHelper::UTF8toBIFF8UnicodeLong($str);

        // check if string is already present
        if (!isset($this->stringTable[$str])) {
            $this->stringTable[$str] <?php echo $this->stringUnique++;
        }
        ++$this->stringTotal;

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvV', $row, $col, $xfIndex, $this->stringTable[$str]);
        $this->append($header . $data);
    }

    /**
     * Write a blank cell to the specified row and column (zero indexed).
     * A blank cell is used to specify formatting without adding a string
     * or a number.
     *
     * A blank cell without a format serves no purpose. Therefore, we don't write
     * a BLANK record unless a format is specified.
     *
     * Returns  0 : normal termination (including no format)
     *         -1 : insufficient number of arguments
     *         -2 : row or column out of range
     *
     * @param int $row Zero indexed row
     * @param int $col Zero indexed column
     * @param mixed $xfIndex The XF format index
     *
     * @return int
     */
    public function writeBlank($row, $col, $xfIndex)
    {
        $record <?php echo 0x0201; // Record identifier
        $length <?php echo 0x0006; // Number of bytes to follow

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvv', $row, $col, $xfIndex);
        $this->append($header . $data);

        return 0;
    }

    /**
     * Write a boolean or an error type to the specified row and column (zero indexed).
     *
     * @param int $row Row index (0-based)
     * @param int $col Column index (0-based)
     * @param int $value
     * @param int $isError Error or Boolean?
     * @param int $xfIndex
     *
     * @return int
     */
    private function writeBoolErr($row, $col, $value, $isError, $xfIndex)
    {
        $record <?php echo 0x0205;
        $length <?php echo 8;

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvCC', $row, $col, $xfIndex, $value, $isError);
        $this->append($header . $data);

        return 0;
    }

    const WRITE_FORMULA_NORMAL <?php echo 0;
    const WRITE_FORMULA_ERRORS <?php echo -1;
    const WRITE_FORMULA_RANGE <?php echo -2;
    const WRITE_FORMULA_EXCEPTION <?php echo -3;

    /** @var bool */
    private static $allowThrow <?php echo false;

    public static function setAllowThrow(bool $allowThrow): void
    {
        self::$allowThrow <?php echo $allowThrow;
    }

    public static function getAllowThrow(): bool
    {
        return self::$allowThrow;
    }

    /**
     * Write a formula to the specified row and column (zero indexed).
     * The textual representation of the formula is passed to the parser in
     * Parser.php which returns a packed binary string.
     *
     * Returns  0 : WRITE_FORMULA_NORMAL  normal termination
     *         -1 : WRITE_FORMULA_ERRORS formula errors (bad formula)
     *         -2 : WRITE_FORMULA_RANGE  row or column out of range
     *         -3 : WRITE_FORMULA_EXCEPTION parse raised exception, probably due to definedname
     *
     * @param int $row Zero indexed row
     * @param int $col Zero indexed column
     * @param string $formula The formula text string
     * @param mixed $xfIndex The XF format index
     * @param mixed $calculatedValue Calculated value
     *
     * @return int
     */
    private function writeFormula($row, $col, $formula, $xfIndex, $calculatedValue)
    {
        $record <?php echo 0x0006; // Record identifier
        // Initialize possible additional value for STRING record that should be written after the FORMULA record?
        $stringValue <?php echo null;

        // calculated value
        if (isset($calculatedValue)) {
            // Since we can't yet get the data type of the calculated value,
            // we use best effort to determine data type
            if (is_bool($calculatedValue)) {
                // Boolean value
                $num <?php echo pack('CCCvCv', 0x01, 0x00, (int) $calculatedValue, 0x00, 0x00, 0xFFFF);
            } elseif (is_int($calculatedValue) || is_float($calculatedValue)) {
                // Numeric value
                $num <?php echo pack('d', $calculatedValue);
            } elseif (is_string($calculatedValue)) {
                $errorCodes <?php echo DataType::getErrorCodes();
                if (isset($errorCodes[$calculatedValue])) {
                    // Error value
                    $num <?php echo pack('CCCvCv', 0x02, 0x00, ErrorCode::error($calculatedValue), 0x00, 0x00, 0xFFFF);
                } elseif ($calculatedValue <?php echo<?php echo<?php echo '') {
                    // Empty string (and BIFF8)
                    $num <?php echo pack('CCCvCv', 0x03, 0x00, 0x00, 0x00, 0x00, 0xFFFF);
                } else {
                    // Non-empty string value (or empty string BIFF5)
                    $stringValue <?php echo $calculatedValue;
                    $num <?php echo pack('CCCvCv', 0x00, 0x00, 0x00, 0x00, 0x00, 0xFFFF);
                }
            } else {
                // We are really not supposed to reach here
                $num <?php echo pack('d', 0x00);
            }
        } else {
            $num <?php echo pack('d', 0x00);
        }

        $grbit <?php echo 0x03; // Option flags
        $unknown <?php echo 0x0000; // Must be zero

        // Strip the '<?php echo' or '@' sign at the beginning of the formula string
        if ($formula[0] <?php echo<?php echo '<?php echo') {
            $formula <?php echo substr($formula, 1);
        } else {
            // Error handling
            $this->writeString($row, $col, 'Unrecognised character for formula', 0);

            return self::WRITE_FORMULA_ERRORS;
        }

        // Parse the formula using the parser in Parser.php
        try {
            $this->parser->parse($formula);
            $formula <?php echo $this->parser->toReversePolish();

            $formlen <?php echo strlen($formula); // Length of the binary string
            $length <?php echo 0x16 + $formlen; // Length of the record data

            $header <?php echo pack('vv', $record, $length);

            $data <?php echo pack('vvv', $row, $col, $xfIndex)
                . $num
                . pack('vVv', $grbit, $unknown, $formlen);
            $this->append($header . $data . $formula);

            // Append also a STRING record if necessary
            if ($stringValue !<?php echo<?php echo null) {
                $this->writeStringRecord($stringValue);
            }

            return self::WRITE_FORMULA_NORMAL;
        } catch (PhpSpreadsheetException $e) {
            if (self::$allowThrow) {
                throw $e;
            }

            return self::WRITE_FORMULA_EXCEPTION;
        }
    }

    /**
     * Write a STRING record. This.
     *
     * @param string $stringValue
     */
    private function writeStringRecord($stringValue): void
    {
        $record <?php echo 0x0207; // Record identifier
        $data <?php echo StringHelper::UTF8toBIFF8UnicodeLong($stringValue);

        $length <?php echo strlen($data);
        $header <?php echo pack('vv', $record, $length);

        $this->append($header . $data);
    }

    /**
     * Write a hyperlink.
     * This is comprised of two elements: the visible label and
     * the invisible link. The visible label is the same as the link unless an
     * alternative string is specified. The label is written using the
     * writeString() method. Therefore the 255 characters string limit applies.
     * $string and $format are optional.
     *
     * The hyperlink can be to a http, ftp, mail, internal sheet (not yet), or external
     * directory url.
     *
     * @param int $row Row
     * @param int $col Column
     * @param string $url URL string
     */
    private function writeUrl($row, $col, $url): void
    {
        // Add start row and col to arg list
        $this->writeUrlRange($row, $col, $row, $col, $url);
    }

    /**
     * This is the more general form of writeUrl(). It allows a hyperlink to be
     * written to a range of cells. This function also decides the type of hyperlink
     * to be written. These are either, Web (http, ftp, mailto), Internal
     * (Sheet1!A1) or external ('c:\temp\foo.xls#Sheet1!A1').
     *
     * @param int $row1 Start row
     * @param int $col1 Start column
     * @param int $row2 End row
     * @param int $col2 End column
     * @param string $url URL string
     *
     * @see writeUrl()
     */
    private function writeUrlRange($row1, $col1, $row2, $col2, $url): void
    {
        // Check for internal/external sheet links or default to web link
        if (preg_match('[^internal:]', $url)) {
            $this->writeUrlInternal($row1, $col1, $row2, $col2, $url);
        }
        if (preg_match('[^external:]', $url)) {
            $this->writeUrlExternal($row1, $col1, $row2, $col2, $url);
        }

        $this->writeUrlWeb($row1, $col1, $row2, $col2, $url);
    }

    /**
     * Used to write http, ftp and mailto hyperlinks.
     * The link type ($options) is 0x03 is the same as absolute dir ref without
     * sheet. However it is differentiated by the $unknown2 data stream.
     *
     * @param int $row1 Start row
     * @param int $col1 Start column
     * @param int $row2 End row
     * @param int $col2 End column
     * @param string $url URL string
     *
     * @see writeUrl()
     */
    public function writeUrlWeb($row1, $col1, $row2, $col2, $url): void
    {
        $record <?php echo 0x01B8; // Record identifier

        // Pack the undocumented parts of the hyperlink stream
        $unknown1 <?php echo pack('H*', 'D0C9EA79F9BACE118C8200AA004BA90B02000000');
        $unknown2 <?php echo pack('H*', 'E0C9EA79F9BACE118C8200AA004BA90B');

        // Pack the option flags
        $options <?php echo pack('V', 0x03);

        // Convert URL to a null terminated wchar string

        /** @phpstan-ignore-next-line */
        $url <?php echo implode("\0", preg_split("''", $url, -1, PREG_SPLIT_NO_EMPTY));
        $url <?php echo $url . "\0\0\0";

        // Pack the length of the URL
        $url_len <?php echo pack('V', strlen($url));

        // Calculate the data length
        $length <?php echo 0x34 + strlen($url);

        // Pack the header data
        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvv', $row1, $row2, $col1, $col2);

        // Write the packed data
        $this->append($header . $data . $unknown1 . $options . $unknown2 . $url_len . $url);
    }

    /**
     * Used to write internal reference hyperlinks such as "Sheet1!A1".
     *
     * @param int $row1 Start row
     * @param int $col1 Start column
     * @param int $row2 End row
     * @param int $col2 End column
     * @param string $url URL string
     *
     * @see writeUrl()
     */
    private function writeUrlInternal($row1, $col1, $row2, $col2, $url): void
    {
        $record <?php echo 0x01B8; // Record identifier

        // Strip URL type
        $url <?php echo (string) preg_replace('/^internal:/', '', $url);

        // Pack the undocumented parts of the hyperlink stream
        $unknown1 <?php echo pack('H*', 'D0C9EA79F9BACE118C8200AA004BA90B02000000');

        // Pack the option flags
        $options <?php echo pack('V', 0x08);

        // Convert the URL type and to a null terminated wchar string
        $url .<?php echo "\0";

        // character count
        $url_len <?php echo StringHelper::countCharacters($url);
        $url_len <?php echo pack('V', $url_len);

        $url <?php echo StringHelper::convertEncoding($url, 'UTF-16LE', 'UTF-8');

        // Calculate the data length
        $length <?php echo 0x24 + strlen($url);

        // Pack the header data
        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvv', $row1, $row2, $col1, $col2);

        // Write the packed data
        $this->append($header . $data . $unknown1 . $options . $url_len . $url);
    }

    /**
     * Write links to external directory names such as 'c:\foo.xls',
     * c:\foo.xls#Sheet1!A1', '../../foo.xls'. and '../../foo.xls#Sheet1!A1'.
     *
     * Note: Excel writes some relative links with the $dir_long string. We ignore
     * these cases for the sake of simpler code.
     *
     * @param int $row1 Start row
     * @param int $col1 Start column
     * @param int $row2 End row
     * @param int $col2 End column
     * @param string $url URL string
     *
     * @see writeUrl()
     */
    private function writeUrlExternal($row1, $col1, $row2, $col2, $url): void
    {
        // Network drives are different. We will handle them separately
        // MS/Novell network drives and shares start with \\
        if (preg_match('[^external:\\\\]', $url)) {
            return;
        }

        $record <?php echo 0x01B8; // Record identifier

        // Strip URL type and change Unix dir separator to Dos style (if needed)
        //
        $url <?php echo (string) preg_replace(['/^external:/', '/\//'], ['', '\\'], $url);

        // Determine if the link is relative or absolute:
        //   relative if link contains no dir separator, "somefile.xls"
        //   relative if link starts with up-dir, "..\..\somefile.xls"
        //   otherwise, absolute

        $absolute <?php echo 0x00; // relative path
        if (preg_match('/^[A-Z]:/', $url)) {
            $absolute <?php echo 0x02; // absolute path on Windows, e.g. C:\...
        }
        $link_type <?php echo 0x01 | $absolute;

        // Determine if the link contains a sheet reference and change some of the
        // parameters accordingly.
        // Split the dir name and sheet name (if it exists)
        $dir_long <?php echo $url;
        if (preg_match('/\\#/', $url)) {
            $link_type |<?php echo 0x08;
        }

        // Pack the link type
        $link_type <?php echo pack('V', $link_type);

        // Calculate the up-level dir count e.g.. (..\..\..\ <?php echo<?php echo 3)
        $up_count <?php echo preg_match_all('/\\.\\.\\\\/', $dir_long, $useless);
        $up_count <?php echo pack('v', $up_count);

        // Store the short dos dir name (null terminated)
        $dir_short <?php echo (string) preg_replace('/\\.\\.\\\\/', '', $dir_long) . "\0";

        // Store the long dir name as a wchar string (non-null terminated)
        //$dir_long <?php echo $dir_long . "\0";

        // Pack the lengths of the dir strings
        $dir_short_len <?php echo pack('V', strlen($dir_short));
        //$dir_long_len <?php echo pack('V', strlen($dir_long));
        $stream_len <?php echo pack('V', 0); //strlen($dir_long) + 0x06);

        // Pack the undocumented parts of the hyperlink stream
        $unknown1 <?php echo pack('H*', 'D0C9EA79F9BACE118C8200AA004BA90B02000000');
        $unknown2 <?php echo pack('H*', '0303000000000000C000000000000046');
        $unknown3 <?php echo pack('H*', 'FFFFADDE000000000000000000000000000000000000000');
        //$unknown4 <?php echo pack('v', 0x03);

        // Pack the main data stream
        $data <?php echo pack('vvvv', $row1, $row2, $col1, $col2) .
            $unknown1 .
            $link_type .
            $unknown2 .
            $up_count .
            $dir_short_len .
            $dir_short .
            $unknown3 .
            $stream_len; /*.
                          $dir_long_len .
                          $unknown4     .
                          $dir_long     .
                          $sheet_len    .
                          $sheet        ;*/

        // Pack the header data
        $length <?php echo strlen($data);
        $header <?php echo pack('vv', $record, $length);

        // Write the packed data
        $this->append($header . $data);
    }

    /**
     * This method is used to set the height and format for a row.
     *
     * @param int $row The row to set
     * @param int $height Height we are giving to the row.
     *                        Use null to set XF without setting height
     * @param int $xfIndex The optional cell style Xf index to apply to the columns
     * @param bool $hidden The optional hidden attribute
     * @param int $level The optional outline level for row, in range [0,7]
     */
    private function writeRow($row, $height, $xfIndex, $hidden <?php echo false, $level <?php echo 0): void
    {
        $record <?php echo 0x0208; // Record identifier
        $length <?php echo 0x0010; // Number of bytes to follow

        $colMic <?php echo 0x0000; // First defined column
        $colMac <?php echo 0x0000; // Last defined column
        $irwMac <?php echo 0x0000; // Used by Excel to optimise loading
        $reserved <?php echo 0x0000; // Reserved
        $grbit <?php echo 0x0000; // Option flags
        $ixfe <?php echo $xfIndex;

        if ($height < 0) {
            $height <?php echo null;
        }

        // Use writeRow($row, null, $XF) to set XF format without setting height
        if ($height !<?php echo<?php echo null) {
            $miyRw <?php echo $height * 20; // row height
        } else {
            $miyRw <?php echo 0xff; // default row height is 256
        }

        // Set the options flags. fUnsynced is used to show that the font and row
        // heights are not compatible. This is usually the case for WriteExcel.
        // The collapsed flag 0x10 doesn't seem to be used to indicate that a row
        // is collapsed. Instead it is used to indicate that the previous row is
        // collapsed. The zero height flag, 0x20, is used to collapse a row.

        $grbit |<?php echo $level;
        if ($hidden <?php echo<?php echo<?php echo true) {
            $grbit |<?php echo 0x0030;
        }
        if ($height !<?php echo<?php echo null) {
            $grbit |<?php echo 0x0040; // fUnsynced
        }
        if ($xfIndex !<?php echo<?php echo 0xF) {
            $grbit |<?php echo 0x0080;
        }
        $grbit |<?php echo 0x0100;

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvvvvvv', $row, $colMic, $colMac, $miyRw, $irwMac, $reserved, $grbit, $ixfe);
        $this->append($header . $data);
    }

    /**
     * Writes Excel DIMENSIONS to define the area in which there is data.
     */
    private function writeDimensions(): void
    {
        $record <?php echo 0x0200; // Record identifier

        $length <?php echo 0x000E;
        $data <?php echo pack('VVvvv', $this->firstRowIndex, $this->lastRowIndex + 1, $this->firstColumnIndex, $this->lastColumnIndex + 1, 0x0000); // reserved

        $header <?php echo pack('vv', $record, $length);
        $this->append($header . $data);
    }

    /**
     * Write BIFF record Window2.
     */
    private function writeWindow2(): void
    {
        $record <?php echo 0x023E; // Record identifier
        $length <?php echo 0x0012;

        $rwTop <?php echo 0x0000; // Top row visible in window
        $colLeft <?php echo 0x0000; // Leftmost column visible in window

        // The options flags that comprise $grbit
        $fDspFmla <?php echo 0; // 0 - bit
        $fDspGrid <?php echo $this->phpSheet->getShowGridlines() ? 1 : 0; // 1
        $fDspRwCol <?php echo $this->phpSheet->getShowRowColHeaders() ? 1 : 0; // 2
        $fFrozen <?php echo $this->phpSheet->getFreezePane() ? 1 : 0; // 3
        $fDspZeros <?php echo 1; // 4
        $fDefaultHdr <?php echo 1; // 5
        $fArabic <?php echo $this->phpSheet->getRightToLeft() ? 1 : 0; // 6
        $fDspGuts <?php echo $this->outlineOn; // 7
        $fFrozenNoSplit <?php echo 0; // 0 - bit
        // no support in PhpSpreadsheet for selected sheet, therefore sheet is only selected if it is the active sheet
        $fSelected <?php echo ($this->phpSheet <?php echo<?php echo<?php echo $this->phpSheet->getParentOrThrow()->getActiveSheet()) ? 1 : 0;
        $fPageBreakPreview <?php echo $this->phpSheet->getSheetView()->getView() <?php echo<?php echo<?php echo SheetView::SHEETVIEW_PAGE_BREAK_PREVIEW;

        $grbit <?php echo $fDspFmla;
        $grbit |<?php echo $fDspGrid << 1;
        $grbit |<?php echo $fDspRwCol << 2;
        $grbit |<?php echo $fFrozen << 3;
        $grbit |<?php echo $fDspZeros << 4;
        $grbit |<?php echo $fDefaultHdr << 5;
        $grbit |<?php echo $fArabic << 6;
        $grbit |<?php echo $fDspGuts << 7;
        $grbit |<?php echo $fFrozenNoSplit << 8;
        $grbit |<?php echo $fSelected << 9; // Selected sheets.
        $grbit |<?php echo $fSelected << 10; // Active sheet.
        $grbit |<?php echo $fPageBreakPreview << 11;

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvv', $grbit, $rwTop, $colLeft);

        // FIXME !!!
        $rgbHdr <?php echo 0x0040; // Row/column heading and gridline color index
        $zoom_factor_page_break <?php echo ($fPageBreakPreview ? $this->phpSheet->getSheetView()->getZoomScale() : 0x0000);
        $zoom_factor_normal <?php echo $this->phpSheet->getSheetView()->getZoomScaleNormal();

        $data .<?php echo pack('vvvvV', $rgbHdr, 0x0000, $zoom_factor_page_break, $zoom_factor_normal, 0x00000000);

        $this->append($header . $data);
    }

    /**
     * Write BIFF record DEFAULTROWHEIGHT.
     */
    private function writeDefaultRowHeight(): void
    {
        $defaultRowHeight <?php echo $this->phpSheet->getDefaultRowDimension()->getRowHeight();

        if ($defaultRowHeight < 0) {
            return;
        }

        // convert to twips
        $defaultRowHeight <?php echo (int) 20 * $defaultRowHeight;

        $record <?php echo 0x0225; // Record identifier
        $length <?php echo 0x0004; // Number of bytes to follow

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vv', 1, $defaultRowHeight);
        $this->append($header . $data);
    }

    /**
     * Write BIFF record DEFCOLWIDTH if COLINFO records are in use.
     */
    private function writeDefcol(): void
    {
        $defaultColWidth <?php echo 8;

        $record <?php echo 0x0055; // Record identifier
        $length <?php echo 0x0002; // Number of bytes to follow

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $defaultColWidth);
        $this->append($header . $data);
    }

    /**
     * Write BIFF record COLINFO to define column widths.
     *
     * Note: The SDK says the record length is 0x0B but Excel writes a 0x0C
     * length record.
     *
     * @param array $col_array This is the only parameter received and is composed of the following:
     *                0 <?php echo> First formatted column,
     *                1 <?php echo> Last formatted column,
     *                2 <?php echo> Col width (8.43 is Excel default),
     *                3 <?php echo> The optional XF format of the column,
     *                4 <?php echo> Option flags.
     *                5 <?php echo> Optional outline level
     */
    private function writeColinfo($col_array): void
    {
        $colFirst <?php echo $col_array[0] ?? null;
        $colLast <?php echo $col_array[1] ?? null;
        $coldx <?php echo $col_array[2] ?? 8.43;
        $xfIndex <?php echo $col_array[3] ?? 15;
        $grbit <?php echo $col_array[4] ?? 0;
        $level <?php echo $col_array[5] ?? 0;

        $record <?php echo 0x007D; // Record identifier
        $length <?php echo 0x000C; // Number of bytes to follow

        $coldx *<?php echo 256; // Convert to units of 1/256 of a char

        $ixfe <?php echo $xfIndex;
        $reserved <?php echo 0x0000; // Reserved

        $level <?php echo max(0, min($level, 7));
        $grbit |<?php echo $level << 8;

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvvvv', $colFirst, $colLast, $coldx, $ixfe, $grbit, $reserved);
        $this->append($header . $data);
    }

    /**
     * Write BIFF record SELECTION.
     */
    private function writeSelection(): void
    {
        // look up the selected cell range
        $selectedCells <?php echo Coordinate::splitRange($this->phpSheet->getSelectedCells());
        $selectedCells <?php echo $selectedCells[0];
        if (count($selectedCells) <?php echo<?php echo 2) {
            [$first, $last] <?php echo $selectedCells;
        } else {
            $first <?php echo $selectedCells[0];
            $last <?php echo $selectedCells[0];
        }

        [$colFirst, $rwFirst] <?php echo Coordinate::coordinateFromString($first);
        $colFirst <?php echo Coordinate::columnIndexFromString($colFirst) - 1; // base 0 column index
        --$rwFirst; // base 0 row index

        [$colLast, $rwLast] <?php echo Coordinate::coordinateFromString($last);
        $colLast <?php echo Coordinate::columnIndexFromString($colLast) - 1; // base 0 column index
        --$rwLast; // base 0 row index

        // make sure we are not out of bounds
        $colFirst <?php echo min($colFirst, 255);
        $colLast <?php echo min($colLast, 255);

        $rwFirst <?php echo min($rwFirst, 65535);
        $rwLast <?php echo min($rwLast, 65535);

        $record <?php echo 0x001D; // Record identifier
        $length <?php echo 0x000F; // Number of bytes to follow

        $pnn <?php echo $this->activePane; // Pane position
        $rwAct <?php echo $rwFirst; // Active row
        $colAct <?php echo $colFirst; // Active column
        $irefAct <?php echo 0; // Active cell ref
        $cref <?php echo 1; // Number of refs

        // Swap last row/col for first row/col as necessary
        if ($rwFirst > $rwLast) {
            [$rwFirst, $rwLast] <?php echo [$rwLast, $rwFirst];
        }

        if ($colFirst > $colLast) {
            [$colFirst, $colLast] <?php echo [$colLast, $colFirst];
        }

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('CvvvvvvCC', $pnn, $rwAct, $colAct, $irefAct, $cref, $rwFirst, $rwLast, $colFirst, $colLast);
        $this->append($header . $data);
    }

    /**
     * Store the MERGEDCELLS records for all ranges of merged cells.
     */
    private function writeMergedCells(): void
    {
        $mergeCells <?php echo $this->phpSheet->getMergeCells();
        $countMergeCells <?php echo count($mergeCells);

        if ($countMergeCells <?php echo<?php echo 0) {
            return;
        }

        // maximum allowed number of merged cells per record
        $maxCountMergeCellsPerRecord <?php echo 1027;

        // record identifier
        $record <?php echo 0x00E5;

        // counter for total number of merged cells treated so far by the writer
        $i <?php echo 0;

        // counter for number of merged cells written in record currently being written
        $j <?php echo 0;

        // initialize record data
        $recordData <?php echo '';

        // loop through the merged cells
        foreach ($mergeCells as $mergeCell) {
            ++$i;
            ++$j;

            // extract the row and column indexes
            $range <?php echo Coordinate::splitRange($mergeCell);
            [$first, $last] <?php echo $range[0];
            [$firstColumn, $firstRow] <?php echo Coordinate::indexesFromString($first);
            [$lastColumn, $lastRow] <?php echo Coordinate::indexesFromString($last);

            $recordData .<?php echo pack('vvvv', $firstRow - 1, $lastRow - 1, $firstColumn - 1, $lastColumn - 1);

            // flush record if we have reached limit for number of merged cells, or reached final merged cell
            if ($j <?php echo<?php echo $maxCountMergeCellsPerRecord || $i <?php echo<?php echo $countMergeCells) {
                $recordData <?php echo pack('v', $j) . $recordData;
                $length <?php echo strlen($recordData);
                $header <?php echo pack('vv', $record, $length);
                $this->append($header . $recordData);

                // initialize for next record, if any
                $recordData <?php echo '';
                $j <?php echo 0;
            }
        }
    }

    /**
     * Write SHEETLAYOUT record.
     */
    private function writeSheetLayout(): void
    {
        if (!$this->phpSheet->isTabColorSet()) {
            return;
        }

        $recordData <?php echo pack(
            'vvVVVvv',
            0x0862,
            0x0000, // unused
            0x00000000, // unused
            0x00000000, // unused
            0x00000014, // size of record data
            $this->colors[$this->phpSheet->getTabColor()->getRGB()], // color index
            0x0000        // unused
        );

        $length <?php echo strlen($recordData);

        $record <?php echo 0x0862; // Record identifier
        $header <?php echo pack('vv', $record, $length);
        $this->append($header . $recordData);
    }

    private static function protectionBitsDefaultFalse(?bool $value, int $shift): int
    {
        if ($value <?php echo<?php echo<?php echo false) {
            return 1 << $shift;
        }

        return 0;
    }

    private static function protectionBitsDefaultTrue(?bool $value, int $shift): int
    {
        if ($value !<?php echo<?php echo false) {
            return 1 << $shift;
        }

        return 0;
    }

    /**
     * Write SHEETPROTECTION.
     */
    private function writeSheetProtection(): void
    {
        // record identifier
        $record <?php echo 0x0867;

        // prepare options
        $protection <?php echo $this->phpSheet->getProtection();
        $options <?php echo self::protectionBitsDefaultTrue($protection->getObjects(), 0)
            | self::protectionBitsDefaultTrue($protection->getScenarios(), 1)
            | self::protectionBitsDefaultFalse($protection->getFormatCells(), 2)
            | self::protectionBitsDefaultFalse($protection->getFormatColumns(), 3)
            | self::protectionBitsDefaultFalse($protection->getFormatRows(), 4)
            | self::protectionBitsDefaultFalse($protection->getInsertColumns(), 5)
            | self::protectionBitsDefaultFalse($protection->getInsertRows(), 6)
            | self::protectionBitsDefaultFalse($protection->getInsertHyperlinks(), 7)
            | self::protectionBitsDefaultFalse($protection->getDeleteColumns(), 8)
            | self::protectionBitsDefaultFalse($protection->getDeleteRows(), 9)
            | self::protectionBitsDefaultTrue($protection->getSelectLockedCells(), 10)
            | self::protectionBitsDefaultFalse($protection->getSort(), 11)
            | self::protectionBitsDefaultFalse($protection->getAutoFilter(), 12)
            | self::protectionBitsDefaultFalse($protection->getPivotTables(), 13)
            | self::protectionBitsDefaultTrue($protection->getSelectUnlockedCells(), 14);

        // record data
        $recordData <?php echo pack(
            'vVVCVVvv',
            0x0867, // repeated record identifier
            0x0000, // not used
            0x0000, // not used
            0x00, // not used
            0x01000200, // unknown data
            0xFFFFFFFF, // unknown data
            $options, // options
            0x0000 // not used
        );

        $length <?php echo strlen($recordData);
        $header <?php echo pack('vv', $record, $length);

        $this->append($header . $recordData);
    }

    /**
     * Write BIFF record RANGEPROTECTION.
     *
     * Openoffice.org's Documentation of the Microsoft Excel File Format uses term RANGEPROTECTION for these records
     * Microsoft Office Excel 97-2007 Binary File Format Specification uses term FEAT for these records
     */
    private function writeRangeProtection(): void
    {
        foreach ($this->phpSheet->getProtectedCells() as $range <?php echo> $password) {
            // number of ranges, e.g. 'A1:B3 C20:D25'
            $cellRanges <?php echo explode(' ', $range);
            $cref <?php echo count($cellRanges);

            $recordData <?php echo pack(
                'vvVVvCVvVv',
                0x0868,
                0x00,
                0x0000,
                0x0000,
                0x02,
                0x0,
                0x0000,
                $cref,
                0x0000,
                0x00
            );

            foreach ($cellRanges as $cellRange) {
                $recordData .<?php echo $this->writeBIFF8CellRangeAddressFixed($cellRange);
            }

            // the rgbFeat structure
            $recordData .<?php echo pack(
                'VV',
                0x0000,
                hexdec($password)
            );

            $recordData .<?php echo StringHelper::UTF8toBIFF8UnicodeLong('p' . md5($recordData));

            $length <?php echo strlen($recordData);

            $record <?php echo 0x0868; // Record identifier
            $header <?php echo pack('vv', $record, $length);
            $this->append($header . $recordData);
        }
    }

    /**
     * Writes the Excel BIFF PANE record.
     * The panes can either be frozen or thawed (unfrozen).
     * Frozen panes are specified in terms of an integer number of rows and columns.
     * Thawed panes are specified in terms of Excel's units for rows and columns.
     */
    private function writePanes(): void
    {
        if (!$this->phpSheet->getFreezePane()) {
            // thaw panes
            return;
        }

        [$column, $row] <?php echo Coordinate::indexesFromString($this->phpSheet->getFreezePane());
        $x <?php echo $column - 1;
        $y <?php echo $row - 1;

        [$leftMostColumn, $topRow] <?php echo Coordinate::indexesFromString($this->phpSheet->getTopLeftCell() ?? '');
        //Coordinates are zero-based in xls files
        $rwTop <?php echo $topRow - 1;
        $colLeft <?php echo $leftMostColumn - 1;

        $record <?php echo 0x0041; // Record identifier
        $length <?php echo 0x000A; // Number of bytes to follow

        // Determine which pane should be active. There is also the undocumented
        // option to override this should it be necessary: may be removed later.
        $pnnAct <?php echo 0;
        if ($x !<?php echo 0 && $y !<?php echo 0) {
            $pnnAct <?php echo 0; // Bottom right
        }
        if ($x !<?php echo 0 && $y <?php echo<?php echo 0) {
            $pnnAct <?php echo 1; // Top right
        }
        if ($x <?php echo<?php echo 0 && $y !<?php echo 0) {
            $pnnAct <?php echo 2; // Bottom left
        }
        if ($x <?php echo<?php echo 0 && $y <?php echo<?php echo 0) {
            $pnnAct <?php echo 3; // Top left
        }

        $this->activePane <?php echo $pnnAct; // Used in writeSelection

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvvv', $x, $y, $rwTop, $colLeft, $pnnAct);
        $this->append($header . $data);
    }

    /**
     * Store the page setup SETUP BIFF record.
     */
    private function writeSetup(): void
    {
        $record <?php echo 0x00A1; // Record identifier
        $length <?php echo 0x0022; // Number of bytes to follow

        $iPaperSize <?php echo $this->phpSheet->getPageSetup()->getPaperSize(); // Paper size
        $iScale <?php echo $this->phpSheet->getPageSetup()->getScale() ?: 100; // Print scaling factor

        $iPageStart <?php echo 0x01; // Starting page number
        $iFitWidth <?php echo (int) $this->phpSheet->getPageSetup()->getFitToWidth(); // Fit to number of pages wide
        $iFitHeight <?php echo (int) $this->phpSheet->getPageSetup()->getFitToHeight(); // Fit to number of pages high
        $iRes <?php echo 0x0258; // Print resolution
        $iVRes <?php echo 0x0258; // Vertical print resolution

        $numHdr <?php echo $this->phpSheet->getPageMargins()->getHeader(); // Header Margin

        $numFtr <?php echo $this->phpSheet->getPageMargins()->getFooter(); // Footer Margin
        $iCopies <?php echo 0x01; // Number of copies

        // Order of printing pages
        $fLeftToRight <?php echo $this->phpSheet->getPageSetup()->getPageOrder() <?php echo<?php echo<?php echo PageSetup::PAGEORDER_DOWN_THEN_OVER
            ? 0x0 : 0x1;
        // Page orientation
        $fLandscape <?php echo ($this->phpSheet->getPageSetup()->getOrientation() <?php echo<?php echo PageSetup::ORIENTATION_LANDSCAPE)
            ? 0x0 : 0x1;

        $fNoPls <?php echo 0x0; // Setup not read from printer
        $fNoColor <?php echo 0x0; // Print black and white
        $fDraft <?php echo 0x0; // Print draft quality
        $fNotes <?php echo 0x0; // Print notes
        $fNoOrient <?php echo 0x0; // Orientation not set
        $fUsePage <?php echo 0x0; // Use custom starting page

        $grbit <?php echo $fLeftToRight;
        $grbit |<?php echo $fLandscape << 1;
        $grbit |<?php echo $fNoPls << 2;
        $grbit |<?php echo $fNoColor << 3;
        $grbit |<?php echo $fDraft << 4;
        $grbit |<?php echo $fNotes << 5;
        $grbit |<?php echo $fNoOrient << 6;
        $grbit |<?php echo $fUsePage << 7;

        $numHdr <?php echo pack('d', $numHdr);
        $numFtr <?php echo pack('d', $numFtr);
        if (self::getByteOrder()) { // if it's Big Endian
            $numHdr <?php echo strrev($numHdr);
            $numFtr <?php echo strrev($numFtr);
        }

        $header <?php echo pack('vv', $record, $length);
        $data1 <?php echo pack('vvvvvvvv', $iPaperSize, $iScale, $iPageStart, $iFitWidth, $iFitHeight, $grbit, $iRes, $iVRes);
        $data2 <?php echo $numHdr . $numFtr;
        $data3 <?php echo pack('v', $iCopies);
        $this->append($header . $data1 . $data2 . $data3);
    }

    /**
     * Store the header caption BIFF record.
     */
    private function writeHeader(): void
    {
        $record <?php echo 0x0014; // Record identifier

        /* removing for now
        // need to fix character count (multibyte!)
        if (strlen($this->phpSheet->getHeaderFooter()->getOddHeader()) <?php echo 255) {
            $str      <?php echo $this->phpSheet->getHeaderFooter()->getOddHeader();       // header string
        } else {
            $str <?php echo '';
        }
        */

        $recordData <?php echo StringHelper::UTF8toBIFF8UnicodeLong($this->phpSheet->getHeaderFooter()->getOddHeader());
        $length <?php echo strlen($recordData);

        $header <?php echo pack('vv', $record, $length);

        $this->append($header . $recordData);
    }

    /**
     * Store the footer caption BIFF record.
     */
    private function writeFooter(): void
    {
        $record <?php echo 0x0015; // Record identifier

        /* removing for now
        // need to fix character count (multibyte!)
        if (strlen($this->phpSheet->getHeaderFooter()->getOddFooter()) <?php echo 255) {
            $str <?php echo $this->phpSheet->getHeaderFooter()->getOddFooter();
        } else {
            $str <?php echo '';
        }
        */

        $recordData <?php echo StringHelper::UTF8toBIFF8UnicodeLong($this->phpSheet->getHeaderFooter()->getOddFooter());
        $length <?php echo strlen($recordData);

        $header <?php echo pack('vv', $record, $length);

        $this->append($header . $recordData);
    }

    /**
     * Store the horizontal centering HCENTER BIFF record.
     */
    private function writeHcenter(): void
    {
        $record <?php echo 0x0083; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $fHCenter <?php echo $this->phpSheet->getPageSetup()->getHorizontalCentered() ? 1 : 0; // Horizontal centering

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $fHCenter);

        $this->append($header . $data);
    }

    /**
     * Store the vertical centering VCENTER BIFF record.
     */
    private function writeVcenter(): void
    {
        $record <?php echo 0x0084; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $fVCenter <?php echo $this->phpSheet->getPageSetup()->getVerticalCentered() ? 1 : 0; // Horizontal centering

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $fVCenter);
        $this->append($header . $data);
    }

    /**
     * Store the LEFTMARGIN BIFF record.
     */
    private function writeMarginLeft(): void
    {
        $record <?php echo 0x0026; // Record identifier
        $length <?php echo 0x0008; // Bytes to follow

        $margin <?php echo $this->phpSheet->getPageMargins()->getLeft(); // Margin in inches

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('d', $margin);
        if (self::getByteOrder()) { // if it's Big Endian
            $data <?php echo strrev($data);
        }

        $this->append($header . $data);
    }

    /**
     * Store the RIGHTMARGIN BIFF record.
     */
    private function writeMarginRight(): void
    {
        $record <?php echo 0x0027; // Record identifier
        $length <?php echo 0x0008; // Bytes to follow

        $margin <?php echo $this->phpSheet->getPageMargins()->getRight(); // Margin in inches

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('d', $margin);
        if (self::getByteOrder()) { // if it's Big Endian
            $data <?php echo strrev($data);
        }

        $this->append($header . $data);
    }

    /**
     * Store the TOPMARGIN BIFF record.
     */
    private function writeMarginTop(): void
    {
        $record <?php echo 0x0028; // Record identifier
        $length <?php echo 0x0008; // Bytes to follow

        $margin <?php echo $this->phpSheet->getPageMargins()->getTop(); // Margin in inches

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('d', $margin);
        if (self::getByteOrder()) { // if it's Big Endian
            $data <?php echo strrev($data);
        }

        $this->append($header . $data);
    }

    /**
     * Store the BOTTOMMARGIN BIFF record.
     */
    private function writeMarginBottom(): void
    {
        $record <?php echo 0x0029; // Record identifier
        $length <?php echo 0x0008; // Bytes to follow

        $margin <?php echo $this->phpSheet->getPageMargins()->getBottom(); // Margin in inches

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('d', $margin);
        if (self::getByteOrder()) { // if it's Big Endian
            $data <?php echo strrev($data);
        }

        $this->append($header . $data);
    }

    /**
     * Write the PRINTHEADERS BIFF record.
     */
    private function writePrintHeaders(): void
    {
        $record <?php echo 0x002a; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $fPrintRwCol <?php echo $this->printHeaders; // Boolean flag

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $fPrintRwCol);
        $this->append($header . $data);
    }

    /**
     * Write the PRINTGRIDLINES BIFF record. Must be used in conjunction with the
     * GRIDSET record.
     */
    private function writePrintGridlines(): void
    {
        $record <?php echo 0x002b; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $fPrintGrid <?php echo $this->phpSheet->getPrintGridlines() ? 1 : 0; // Boolean flag

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $fPrintGrid);
        $this->append($header . $data);
    }

    /**
     * Write the GRIDSET BIFF record. Must be used in conjunction with the
     * PRINTGRIDLINES record.
     */
    private function writeGridset(): void
    {
        $record <?php echo 0x0082; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $fGridSet <?php echo !$this->phpSheet->getPrintGridlines(); // Boolean flag

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $fGridSet);
        $this->append($header . $data);
    }

    /**
     * Write the AUTOFILTERINFO BIFF record. This is used to configure the number of autofilter select used in the sheet.
     */
    private function writeAutoFilterInfo(): void
    {
        $record <?php echo 0x009D; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $rangeBounds <?php echo Coordinate::rangeBoundaries($this->phpSheet->getAutoFilter()->getRange());
        $iNumFilters <?php echo 1 + $rangeBounds[1][0] - $rangeBounds[0][0];

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $iNumFilters);
        $this->append($header . $data);
    }

    /**
     * Write the GUTS BIFF record. This is used to configure the gutter margins
     * where Excel outline symbols are displayed. The visibility of the gutters is
     * controlled by a flag in WSBOOL.
     *
     * @see writeWsbool()
     */
    private function writeGuts(): void
    {
        $record <?php echo 0x0080; // Record identifier
        $length <?php echo 0x0008; // Bytes to follow

        $dxRwGut <?php echo 0x0000; // Size of row gutter
        $dxColGut <?php echo 0x0000; // Size of col gutter

        // determine maximum row outline level
        $maxRowOutlineLevel <?php echo 0;
        foreach ($this->phpSheet->getRowDimensions() as $rowDimension) {
            $maxRowOutlineLevel <?php echo max($maxRowOutlineLevel, $rowDimension->getOutlineLevel());
        }

        $col_level <?php echo 0;

        // Calculate the maximum column outline level. The equivalent calculation
        // for the row outline level is carried out in writeRow().
        $colcount <?php echo count($this->columnInfo);
        for ($i <?php echo 0; $i < $colcount; ++$i) {
            $col_level <?php echo max($this->columnInfo[$i][5], $col_level);
        }

        // Set the limits for the outline levels (0 <?php echo x <?php echo 7).
        $col_level <?php echo max(0, min($col_level, 7));

        // The displayed level is one greater than the max outline levels
        if ($maxRowOutlineLevel) {
            ++$maxRowOutlineLevel;
        }
        if ($col_level) {
            ++$col_level;
        }

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvv', $dxRwGut, $dxColGut, $maxRowOutlineLevel, $col_level);

        $this->append($header . $data);
    }

    /**
     * Write the WSBOOL BIFF record, mainly for fit-to-page. Used in conjunction
     * with the SETUP record.
     */
    private function writeWsbool(): void
    {
        $record <?php echo 0x0081; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow
        $grbit <?php echo 0x0000;

        // The only option that is of interest is the flag for fit to page. So we
        // set all the options in one go.
        //
        // Set the option flags
        $grbit |<?php echo 0x0001; // Auto page breaks visible
        if ($this->outlineStyle) {
            $grbit |<?php echo 0x0020; // Auto outline styles
        }
        if ($this->phpSheet->getShowSummaryBelow()) {
            $grbit |<?php echo 0x0040; // Outline summary below
        }
        if ($this->phpSheet->getShowSummaryRight()) {
            $grbit |<?php echo 0x0080; // Outline summary right
        }
        if ($this->phpSheet->getPageSetup()->getFitToPage()) {
            $grbit |<?php echo 0x0100; // Page setup fit to page
        }
        if ($this->outlineOn) {
            $grbit |<?php echo 0x0400; // Outline symbols displayed
        }

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $grbit);
        $this->append($header . $data);
    }

    /**
     * Write the HORIZONTALPAGEBREAKS and VERTICALPAGEBREAKS BIFF records.
     */
    private function writeBreaks(): void
    {
        // initialize
        $vbreaks <?php echo [];
        $hbreaks <?php echo [];

        foreach ($this->phpSheet->getRowBreaks() as $cell <?php echo> $break) {
            // Fetch coordinates
            $coordinates <?php echo Coordinate::coordinateFromString($cell);
            $hbreaks[] <?php echo $coordinates[1];
        }
        foreach ($this->phpSheet->getColumnBreaks() as $cell <?php echo> $break) {
            // Fetch coordinates
            $coordinates <?php echo Coordinate::indexesFromString($cell);
            $vbreaks[] <?php echo $coordinates[0] - 1;
        }

        //horizontal page breaks
        if (!empty($hbreaks)) {
            // Sort and filter array of page breaks
            sort($hbreaks, SORT_NUMERIC);
            if ($hbreaks[0] <?php echo<?php echo 0) { // don't use first break if it's 0
                array_shift($hbreaks);
            }

            $record <?php echo 0x001b; // Record identifier
            $cbrk <?php echo count($hbreaks); // Number of page breaks
            $length <?php echo 2 + 6 * $cbrk; // Bytes to follow

            $header <?php echo pack('vv', $record, $length);
            $data <?php echo pack('v', $cbrk);

            // Append each page break
            foreach ($hbreaks as $hbreak) {
                $data .<?php echo pack('vvv', $hbreak, 0x0000, 0x00ff);
            }

            $this->append($header . $data);
        }

        // vertical page breaks
        if (!empty($vbreaks)) {
            // 1000 vertical pagebreaks appears to be an internal Excel 5 limit.
            // It is slightly higher in Excel 97/200, approx. 1026
            $vbreaks <?php echo array_slice($vbreaks, 0, 1000);

            // Sort and filter array of page breaks
            sort($vbreaks, SORT_NUMERIC);
            if ($vbreaks[0] <?php echo<?php echo 0) { // don't use first break if it's 0
                array_shift($vbreaks);
            }

            $record <?php echo 0x001a; // Record identifier
            $cbrk <?php echo count($vbreaks); // Number of page breaks
            $length <?php echo 2 + 6 * $cbrk; // Bytes to follow

            $header <?php echo pack('vv', $record, $length);
            $data <?php echo pack('v', $cbrk);

            // Append each page break
            foreach ($vbreaks as $vbreak) {
                $data .<?php echo pack('vvv', $vbreak, 0x0000, 0xffff);
            }

            $this->append($header . $data);
        }
    }

    /**
     * Set the Biff PROTECT record to indicate that the worksheet is protected.
     */
    private function writeProtect(): void
    {
        // Exit unless sheet protection has been specified
        if ($this->phpSheet->getProtection()->getSheet() !<?php echo<?php echo true) {
            return;
        }

        $record <?php echo 0x0012; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $fLock <?php echo 1; // Worksheet is protected

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $fLock);

        $this->append($header . $data);
    }

    /**
     * Write SCENPROTECT.
     */
    private function writeScenProtect(): void
    {
        // Exit if sheet protection is not active
        if ($this->phpSheet->getProtection()->getSheet() !<?php echo<?php echo true) {
            return;
        }

        // Exit if scenarios are not protected
        if ($this->phpSheet->getProtection()->getScenarios() !<?php echo<?php echo true) {
            return;
        }

        $record <?php echo 0x00DD; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', 1);

        $this->append($header . $data);
    }

    /**
     * Write OBJECTPROTECT.
     */
    private function writeObjectProtect(): void
    {
        // Exit if sheet protection is not active
        if ($this->phpSheet->getProtection()->getSheet() !<?php echo<?php echo true) {
            return;
        }

        // Exit if objects are not protected
        if ($this->phpSheet->getProtection()->getObjects() !<?php echo<?php echo true) {
            return;
        }

        $record <?php echo 0x0063; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', 1);

        $this->append($header . $data);
    }

    /**
     * Write the worksheet PASSWORD record.
     */
    private function writePassword(): void
    {
        // Exit unless sheet protection and password have been specified
        if ($this->phpSheet->getProtection()->getSheet() !<?php echo<?php echo true || !$this->phpSheet->getProtection()->getPassword() || $this->phpSheet->getProtection()->getAlgorithm() !<?php echo<?php echo '') {
            return;
        }

        $record <?php echo 0x0013; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $wPassword <?php echo hexdec($this->phpSheet->getProtection()->getPassword()); // Encoded password

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $wPassword);

        $this->append($header . $data);
    }

    /**
     * Insert a 24bit bitmap image in a worksheet.
     *
     * @param int $row The row we are going to insert the bitmap into
     * @param int $col The column we are going to insert the bitmap into
     * @param mixed $bitmap The bitmap filename or GD-image resource
     * @param int $x the horizontal position (offset) of the image inside the cell
     * @param int $y the vertical position (offset) of the image inside the cell
     * @param float $scale_x The horizontal scale
     * @param float $scale_y The vertical scale
     */
    public function insertBitmap($row, $col, $bitmap, $x <?php echo 0, $y <?php echo 0, $scale_x <?php echo 1, $scale_y <?php echo 1): void
    {
        $bitmap_array <?php echo (is_resource($bitmap) || $bitmap instanceof GdImage
            ? $this->processBitmapGd($bitmap)
            : $this->processBitmap($bitmap));
        [$width, $height, $size, $data] <?php echo $bitmap_array;

        // Scale the frame of the image.
        $width *<?php echo $scale_x;
        $height *<?php echo $scale_y;

        // Calculate the vertices of the image and write the OBJ record
        $this->positionImage($col, $row, $x, $y, (int) $width, (int) $height);

        // Write the IMDATA record to store the bitmap data
        $record <?php echo 0x007f;
        $length <?php echo 8 + $size;
        $cf <?php echo 0x09;
        $env <?php echo 0x01;
        $lcb <?php echo $size;

        $header <?php echo pack('vvvvV', $record, $length, $cf, $env, $lcb);
        $this->append($header . $data);
    }

    /**
     * Calculate the vertices that define the position of the image as required by
     * the OBJ record.
     *
     *         +------------+------------+
     *         |     A      |      B     |
     *   +-----+------------+------------+
     *   |     |(x1,y1)     |            |
     *   |  1  |(A1)._______|______      |
     *   |     |    |              |     |
     *   |     |    |              |     |
     *   +-----+----|    BITMAP    |-----+
     *   |     |    |              |     |
     *   |  2  |    |______________.     |
     *   |     |            |        (B2)|
     *   |     |            |     (x2,y2)|
     *   +---- +------------+------------+
     *
     * Example of a bitmap that covers some of the area from cell A1 to cell B2.
     *
     * Based on the width and height of the bitmap we need to calculate 8 vars:
     *     $col_start, $row_start, $col_end, $row_end, $x1, $y1, $x2, $y2.
     * The width and height of the cells are also variable and have to be taken into
     * account.
     * The values of $col_start and $row_start are passed in from the calling
     * function. The values of $col_end and $row_end are calculated by subtracting
     * the width and height of the bitmap from the width and height of the
     * underlying cells.
     * The vertices are expressed as a percentage of the underlying cell width as
     * follows (rhs values are in pixels):
     *
     *       x1 <?php echo X / W *1024
     *       y1 <?php echo Y / H *256
     *       x2 <?php echo (X-1) / W *1024
     *       y2 <?php echo (Y-1) / H *256
     *
     *       Where:  X is distance from the left side of the underlying cell
     *               Y is distance from the top of the underlying cell
     *               W is the width of the cell
     *               H is the height of the cell
     * The SDK incorrectly states that the height should be expressed as a
     *        percentage of 1024.
     *
     * @param int $col_start Col containing upper left corner of object
     * @param int $row_start Row containing top left corner of object
     * @param int $x1 Distance to left side of object
     * @param int $y1 Distance to top of object
     * @param int $width Width of image frame
     * @param int $height Height of image frame
     */
    public function positionImage($col_start, $row_start, $x1, $y1, $width, $height): void
    {
        // Initialise end cell to the same as the start cell
        $col_end <?php echo $col_start; // Col containing lower right corner of object
        $row_end <?php echo $row_start; // Row containing bottom right corner of object

        // Zero the specified offset if greater than the cell dimensions
        if ($x1 ><?php echo Xls::sizeCol($this->phpSheet, Coordinate::stringFromColumnIndex($col_start + 1))) {
            $x1 <?php echo 0;
        }
        if ($y1 ><?php echo Xls::sizeRow($this->phpSheet, $row_start + 1)) {
            $y1 <?php echo 0;
        }

        $width <?php echo $width + $x1 - 1;
        $height <?php echo $height + $y1 - 1;

        // Subtract the underlying cell widths to find the end cell of the image
        while ($width ><?php echo Xls::sizeCol($this->phpSheet, Coordinate::stringFromColumnIndex($col_end + 1))) {
            $width -<?php echo Xls::sizeCol($this->phpSheet, Coordinate::stringFromColumnIndex($col_end + 1));
            ++$col_end;
        }

        // Subtract the underlying cell heights to find the end cell of the image
        while ($height ><?php echo Xls::sizeRow($this->phpSheet, $row_end + 1)) {
            $height -<?php echo Xls::sizeRow($this->phpSheet, $row_end + 1);
            ++$row_end;
        }

        // Bitmap isn't allowed to start or finish in a hidden cell, i.e. a cell
        // with zero eight or width.
        //
        if (Xls::sizeCol($this->phpSheet, Coordinate::stringFromColumnIndex($col_start + 1)) <?php echo<?php echo 0) {
            return;
        }
        if (Xls::sizeCol($this->phpSheet, Coordinate::stringFromColumnIndex($col_end + 1)) <?php echo<?php echo 0) {
            return;
        }
        if (Xls::sizeRow($this->phpSheet, $row_start + 1) <?php echo<?php echo 0) {
            return;
        }
        if (Xls::sizeRow($this->phpSheet, $row_end + 1) <?php echo<?php echo 0) {
            return;
        }

        // Convert the pixel values to the percentage value expected by Excel
        $x1 <?php echo $x1 / Xls::sizeCol($this->phpSheet, Coordinate::stringFromColumnIndex($col_start + 1)) * 1024;
        $y1 <?php echo $y1 / Xls::sizeRow($this->phpSheet, $row_start + 1) * 256;
        $x2 <?php echo $width / Xls::sizeCol($this->phpSheet, Coordinate::stringFromColumnIndex($col_end + 1)) * 1024; // Distance to right side of object
        $y2 <?php echo $height / Xls::sizeRow($this->phpSheet, $row_end + 1) * 256; // Distance to bottom of object

        $this->writeObjPicture($col_start, $x1, $row_start, $y1, $col_end, $x2, $row_end, $y2);
    }

    /**
     * Store the OBJ record that precedes an IMDATA record. This could be generalise
     * to support other Excel objects.
     *
     * @param int $colL Column containing upper left corner of object
     * @param int $dxL Distance from left side of cell
     * @param int $rwT Row containing top left corner of object
     * @param int $dyT Distance from top of cell
     * @param int $colR Column containing lower right corner of object
     * @param int $dxR Distance from right of cell
     * @param int $rwB Row containing bottom right corner of object
     * @param int $dyB Distance from bottom of cell
     */
    private function writeObjPicture($colL, $dxL, $rwT, $dyT, $colR, $dxR, $rwB, $dyB): void
    {
        $record <?php echo 0x005d; // Record identifier
        $length <?php echo 0x003c; // Bytes to follow

        $cObj <?php echo 0x0001; // Count of objects in file (set to 1)
        $OT <?php echo 0x0008; // Object type. 8 <?php echo Picture
        $id <?php echo 0x0001; // Object ID
        $grbit <?php echo 0x0614; // Option flags

        $cbMacro <?php echo 0x0000; // Length of FMLA structure
        $Reserved1 <?php echo 0x0000; // Reserved
        $Reserved2 <?php echo 0x0000; // Reserved

        $icvBack <?php echo 0x09; // Background colour
        $icvFore <?php echo 0x09; // Foreground colour
        $fls <?php echo 0x00; // Fill pattern
        $fAuto <?php echo 0x00; // Automatic fill
        $icv <?php echo 0x08; // Line colour
        $lns <?php echo 0xff; // Line style
        $lnw <?php echo 0x01; // Line weight
        $fAutoB <?php echo 0x00; // Automatic border
        $frs <?php echo 0x0000; // Frame style
        $cf <?php echo 0x0009; // Image format, 9 <?php echo bitmap
        $Reserved3 <?php echo 0x0000; // Reserved
        $cbPictFmla <?php echo 0x0000; // Length of FMLA structure
        $Reserved4 <?php echo 0x0000; // Reserved
        $grbit2 <?php echo 0x0001; // Option flags
        $Reserved5 <?php echo 0x0000; // Reserved

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('V', $cObj);
        $data .<?php echo pack('v', $OT);
        $data .<?php echo pack('v', $id);
        $data .<?php echo pack('v', $grbit);
        $data .<?php echo pack('v', $colL);
        $data .<?php echo pack('v', $dxL);
        $data .<?php echo pack('v', $rwT);
        $data .<?php echo pack('v', $dyT);
        $data .<?php echo pack('v', $colR);
        $data .<?php echo pack('v', $dxR);
        $data .<?php echo pack('v', $rwB);
        $data .<?php echo pack('v', $dyB);
        $data .<?php echo pack('v', $cbMacro);
        $data .<?php echo pack('V', $Reserved1);
        $data .<?php echo pack('v', $Reserved2);
        $data .<?php echo pack('C', $icvBack);
        $data .<?php echo pack('C', $icvFore);
        $data .<?php echo pack('C', $fls);
        $data .<?php echo pack('C', $fAuto);
        $data .<?php echo pack('C', $icv);
        $data .<?php echo pack('C', $lns);
        $data .<?php echo pack('C', $lnw);
        $data .<?php echo pack('C', $fAutoB);
        $data .<?php echo pack('v', $frs);
        $data .<?php echo pack('V', $cf);
        $data .<?php echo pack('v', $Reserved3);
        $data .<?php echo pack('v', $cbPictFmla);
        $data .<?php echo pack('v', $Reserved4);
        $data .<?php echo pack('v', $grbit2);
        $data .<?php echo pack('V', $Reserved5);

        $this->append($header . $data);
    }

    /**
     * Convert a GD-image into the internal format.
     *
     * @param GdImage|resource $image The image to process
     *
     * @return array Array with data and properties of the bitmap
     */
    public function processBitmapGd($image)
    {
        $width <?php echo imagesx($image);
        $height <?php echo imagesy($image);

        $data <?php echo pack('Vvvvv', 0x000c, $width, $height, 0x01, 0x18);
        for ($j <?php echo $height; --$j;) {
            for ($i <?php echo 0; $i < $width; ++$i) {
                /** @phpstan-ignore-next-line */
                $color <?php echo imagecolorsforindex($image, imagecolorat($image, $i, $j));
                if ($color !<?php echo<?php echo false) {
                    foreach (['red', 'green', 'blue'] as $key) {
                        $color[$key] <?php echo $color[$key] + (int) round((255 - $color[$key]) * $color['alpha'] / 127);
                    }
                    $data .<?php echo chr($color['blue']) . chr($color['green']) . chr($color['red']);
                }
            }
            if (3 * $width % 4) {
                $data .<?php echo str_repeat("\x00", 4 - 3 * $width % 4);
            }
        }

        return [$width, $height, strlen($data), $data];
    }

    /**
     * Convert a 24 bit bitmap into the modified internal format used by Windows.
     * This is described in BITMAPCOREHEADER and BITMAPCOREINFO structures in the
     * MSDN library.
     *
     * @param string $bitmap The bitmap to process
     *
     * @return array Array with data and properties of the bitmap
     */
    public function processBitmap($bitmap)
    {
        // Open file.
        $bmp_fd <?php echo @fopen($bitmap, 'rb');
        if ($bmp_fd <?php echo<?php echo<?php echo false) {
            throw new WriterException("Couldn't import $bitmap");
        }

        // Slurp the file into a string.
        $data <?php echo (string) fread($bmp_fd, (int) filesize($bitmap));

        // Check that the file is big enough to be a bitmap.
        if (strlen($data) <?php echo 0x36) {
            throw new WriterException("$bitmap doesn't contain enough data.\n");
        }

        // The first 2 bytes are used to identify the bitmap.

        $identity <?php echo unpack('A2ident', $data);
        if ($identity <?php echo<?php echo<?php echo false || $identity['ident'] !<?php echo 'BM') {
            throw new WriterException("$bitmap doesn't appear to be a valid bitmap image.\n");
        }

        // Remove bitmap data: ID.
        $data <?php echo substr($data, 2);

        // Read and remove the bitmap size. This is more reliable than reading
        // the data size at offset 0x22.
        //
        $size_array <?php echo unpack('Vsa', substr($data, 0, 4)) ?: [];
        $size <?php echo $size_array['sa'];
        $data <?php echo substr($data, 4);
        $size -<?php echo 0x36; // Subtract size of bitmap header.
        $size +<?php echo 0x0C; // Add size of BIFF header.

        // Remove bitmap data: reserved, offset, header length.
        $data <?php echo substr($data, 12);

        // Read and remove the bitmap width and height. Verify the sizes.
        $width_and_height <?php echo unpack('V2', substr($data, 0, 8)) ?: [];
        $width <?php echo $width_and_height[1];
        $height <?php echo $width_and_height[2];
        $data <?php echo substr($data, 8);
        if ($width > 0xFFFF) {
            throw new WriterException("$bitmap: largest image width supported is 65k.\n");
        }
        if ($height > 0xFFFF) {
            throw new WriterException("$bitmap: largest image height supported is 65k.\n");
        }

        // Read and remove the bitmap planes and bpp data. Verify them.
        $planes_and_bitcount <?php echo unpack('v2', substr($data, 0, 4));
        $data <?php echo substr($data, 4);
        if ($planes_and_bitcount <?php echo<?php echo<?php echo false || $planes_and_bitcount[2] !<?php echo 24) { // Bitcount
            throw new WriterException("$bitmap isn't a 24bit true color bitmap.\n");
        }
        if ($planes_and_bitcount[1] !<?php echo 1) {
            throw new WriterException("$bitmap: only 1 plane supported in bitmap image.\n");
        }

        // Read and remove the bitmap compression. Verify compression.
        $compression <?php echo unpack('Vcomp', substr($data, 0, 4));
        $data <?php echo substr($data, 4);

        if ($compression <?php echo<?php echo<?php echo false || $compression['comp'] !<?php echo 0) {
            throw new WriterException("$bitmap: compression not supported in bitmap image.\n");
        }

        // Remove bitmap data: data size, hres, vres, colours, imp. colours.
        $data <?php echo substr($data, 20);

        // Add the BITMAPCOREHEADER data
        $header <?php echo pack('Vvvvv', 0x000c, $width, $height, 0x01, 0x18);
        $data <?php echo $header . $data;

        return [$width, $height, $size, $data];
    }

    /**
     * Store the window zoom factor. This should be a reduced fraction but for
     * simplicity we will store all fractions with a numerator of 100.
     */
    private function writeZoom(): void
    {
        // If scale is 100 we don't need to write a record
        if ($this->phpSheet->getSheetView()->getZoomScale() <?php echo<?php echo 100) {
            return;
        }

        $record <?php echo 0x00A0; // Record identifier
        $length <?php echo 0x0004; // Bytes to follow

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vv', $this->phpSheet->getSheetView()->getZoomScale(), 100);
        $this->append($header . $data);
    }

    /**
     * Get Escher object.
     */
    public function getEscher(): ?\PhpOffice\PhpSpreadsheet\Shared\Escher
    {
        return $this->escher;
    }

    /**
     * Set Escher object.
     */
    public function setEscher(?\PhpOffice\PhpSpreadsheet\Shared\Escher $escher): void
    {
        $this->escher <?php echo $escher;
    }

    /**
     * Write MSODRAWING record.
     */
    private function writeMsoDrawing(): void
    {
        // write the Escher stream if necessary
        if (isset($this->escher)) {
            $writer <?php echo new Escher($this->escher);
            $data <?php echo $writer->close();
            $spOffsets <?php echo $writer->getSpOffsets();
            $spTypes <?php echo $writer->getSpTypes();
            // write the neccesary MSODRAWING, OBJ records

            // split the Escher stream
            $spOffsets[0] <?php echo 0;
            $nm <?php echo count($spOffsets) - 1; // number of shapes excluding first shape
            for ($i <?php echo 1; $i <?php echo $nm; ++$i) {
                // MSODRAWING record
                $record <?php echo 0x00EC; // Record identifier

                // chunk of Escher stream for one shape
                $dataChunk <?php echo substr($data, $spOffsets[$i - 1], $spOffsets[$i] - $spOffsets[$i - 1]);

                $length <?php echo strlen($dataChunk);
                $header <?php echo pack('vv', $record, $length);

                $this->append($header . $dataChunk);

                // OBJ record
                $record <?php echo 0x005D; // record identifier
                $objData <?php echo '';

                // ftCmo
                if ($spTypes[$i] <?php echo<?php echo 0x00C9) {
                    // Add ftCmo (common object data) subobject
                    $objData .<?php echo
                        pack(
                            'vvvvvVVV',
                            0x0015, // 0x0015 <?php echo ftCmo
                            0x0012, // length of ftCmo data
                            0x0014, // object type, 0x0014 <?php echo filter
                            $i, // object id number, Excel seems to use 1-based index, local for the sheet
                            0x2101, // option flags, 0x2001 is what OpenOffice.org uses
                            0, // reserved
                            0, // reserved
                            0  // reserved
                        );

                    // Add ftSbs Scroll bar subobject
                    $objData .<?php echo pack('vv', 0x00C, 0x0014);
                    $objData .<?php echo pack('H*', '0000000000000000640001000A00000010000100');
                    // Add ftLbsData (List box data) subobject
                    $objData .<?php echo pack('vv', 0x0013, 0x1FEE);
                    $objData .<?php echo pack('H*', '00000000010001030000020008005700');
                } else {
                    // Add ftCmo (common object data) subobject
                    $objData .<?php echo
                        pack(
                            'vvvvvVVV',
                            0x0015, // 0x0015 <?php echo ftCmo
                            0x0012, // length of ftCmo data
                            0x0008, // object type, 0x0008 <?php echo picture
                            $i, // object id number, Excel seems to use 1-based index, local for the sheet
                            0x6011, // option flags, 0x6011 is what OpenOffice.org uses
                            0, // reserved
                            0, // reserved
                            0  // reserved
                        );
                }

                // ftEnd
                $objData .<?php echo
                    pack(
                        'vv',
                        0x0000, // 0x0000 <?php echo ftEnd
                        0x0000  // length of ftEnd data
                    );

                $length <?php echo strlen($objData);
                $header <?php echo pack('vv', $record, $length);
                $this->append($header . $objData);
            }
        }
    }

    /**
     * Store the DATAVALIDATIONS and DATAVALIDATION records.
     */
    private function writeDataValidity(): void
    {
        // Datavalidation collection
        $dataValidationCollection <?php echo $this->phpSheet->getDataValidationCollection();

        // Write data validations?
        if (!empty($dataValidationCollection)) {
            // DATAVALIDATIONS record
            $record <?php echo 0x01B2; // Record identifier
            $length <?php echo 0x0012; // Bytes to follow

            $grbit <?php echo 0x0000; // Prompt box at cell, no cached validity data at DV records
            $horPos <?php echo 0x00000000; // Horizontal position of prompt box, if fixed position
            $verPos <?php echo 0x00000000; // Vertical position of prompt box, if fixed position
            $objId <?php echo 0xFFFFFFFF; // Object identifier of drop down arrow object, or -1 if not visible

            $header <?php echo pack('vv', $record, $length);
            $data <?php echo pack('vVVVV', $grbit, $horPos, $verPos, $objId, count($dataValidationCollection));
            $this->append($header . $data);

            // DATAVALIDATION records
            $record <?php echo 0x01BE; // Record identifier

            foreach ($dataValidationCollection as $cellCoordinate <?php echo> $dataValidation) {
                // options
                $options <?php echo 0x00000000;

                // data type
                $type <?php echo CellDataValidation::type($dataValidation);

                $options |<?php echo $type << 0;

                // error style
                $errorStyle <?php echo CellDataValidation::errorStyle($dataValidation);

                $options |<?php echo $errorStyle << 4;

                // explicit formula?
                if ($type <?php echo<?php echo 0x03 && preg_match('/^\".*\"$/', $dataValidation->getFormula1())) {
                    $options |<?php echo 0x01 << 7;
                }

                // empty cells allowed
                $options |<?php echo $dataValidation->getAllowBlank() << 8;

                // show drop down
                $options |<?php echo (!$dataValidation->getShowDropDown()) << 9;

                // show input message
                $options |<?php echo $dataValidation->getShowInputMessage() << 18;

                // show error message
                $options |<?php echo $dataValidation->getShowErrorMessage() << 19;

                // condition operator
                $operator <?php echo CellDataValidation::operator($dataValidation);

                $options |<?php echo $operator << 20;

                $data <?php echo pack('V', $options);

                // prompt title
                $promptTitle <?php echo $dataValidation->getPromptTitle() !<?php echo<?php echo '' ?
                    $dataValidation->getPromptTitle() : chr(0);
                $data .<?php echo StringHelper::UTF8toBIFF8UnicodeLong($promptTitle);

                // error title
                $errorTitle <?php echo $dataValidation->getErrorTitle() !<?php echo<?php echo '' ?
                    $dataValidation->getErrorTitle() : chr(0);
                $data .<?php echo StringHelper::UTF8toBIFF8UnicodeLong($errorTitle);

                // prompt text
                $prompt <?php echo $dataValidation->getPrompt() !<?php echo<?php echo '' ?
                    $dataValidation->getPrompt() : chr(0);
                $data .<?php echo StringHelper::UTF8toBIFF8UnicodeLong($prompt);

                // error text
                $error <?php echo $dataValidation->getError() !<?php echo<?php echo '' ?
                    $dataValidation->getError() : chr(0);
                $data .<?php echo StringHelper::UTF8toBIFF8UnicodeLong($error);

                // formula 1
                try {
                    $formula1 <?php echo $dataValidation->getFormula1();
                    if ($type <?php echo<?php echo 0x03) { // list type
                        $formula1 <?php echo str_replace(',', chr(0), $formula1);
                    }
                    $this->parser->parse($formula1);
                    $formula1 <?php echo $this->parser->toReversePolish();
                    $sz1 <?php echo strlen($formula1);
                } catch (PhpSpreadsheetException $e) {
                    $sz1 <?php echo 0;
                    $formula1 <?php echo '';
                }
                $data .<?php echo pack('vv', $sz1, 0x0000);
                $data .<?php echo $formula1;

                // formula 2
                try {
                    $formula2 <?php echo $dataValidation->getFormula2();
                    if ($formula2 <?php echo<?php echo<?php echo '') {
                        throw new WriterException('No formula2');
                    }
                    $this->parser->parse($formula2);
                    $formula2 <?php echo $this->parser->toReversePolish();
                    $sz2 <?php echo strlen($formula2);
                } catch (PhpSpreadsheetException $e) {
                    $sz2 <?php echo 0;
                    $formula2 <?php echo '';
                }
                $data .<?php echo pack('vv', $sz2, 0x0000);
                $data .<?php echo $formula2;

                // cell range address list
                $data .<?php echo pack('v', 0x0001);
                $data .<?php echo $this->writeBIFF8CellRangeAddressFixed($cellCoordinate);

                $length <?php echo strlen($data);
                $header <?php echo pack('vv', $record, $length);

                $this->append($header . $data);
            }
        }
    }

    /**
     * Write PLV Record.
     */
    private function writePageLayoutView(): void
    {
        $record <?php echo 0x088B; // Record identifier
        $length <?php echo 0x0010; // Bytes to follow

        $rt <?php echo 0x088B; // 2
        $grbitFrt <?php echo 0x0000; // 2
        //$reserved <?php echo 0x0000000000000000; // 8
        $wScalvePLV <?php echo $this->phpSheet->getSheetView()->getZoomScale(); // 2

        // The options flags that comprise $grbit
        if ($this->phpSheet->getSheetView()->getView() <?php echo<?php echo SheetView::SHEETVIEW_PAGE_LAYOUT) {
            $fPageLayoutView <?php echo 1;
        } else {
            $fPageLayoutView <?php echo 0;
        }
        $fRulerVisible <?php echo 0;
        $fWhitespaceHidden <?php echo 0;

        $grbit <?php echo $fPageLayoutView; // 2
        $grbit |<?php echo $fRulerVisible << 1;
        $grbit |<?php echo $fWhitespaceHidden << 3;

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvVVvv', $rt, $grbitFrt, 0x00000000, 0x00000000, $wScalvePLV, $grbit);
        $this->append($header . $data);
    }

    /**
     * Write CFRule Record.
     */
    private function writeCFRule(
        ConditionalHelper $conditionalFormulaHelper,
        Conditional $conditional,
        string $cellRange
    ): void {
        $record <?php echo 0x01B1; // Record identifier
        $type <?php echo null; // Type of the CF
        $operatorType <?php echo null; // Comparison operator

        if ($conditional->getConditionType() <?php echo<?php echo Conditional::CONDITION_EXPRESSION) {
            $type <?php echo 0x02;
            $operatorType <?php echo 0x00;
        } elseif ($conditional->getConditionType() <?php echo<?php echo Conditional::CONDITION_CELLIS) {
            $type <?php echo 0x01;

            switch ($conditional->getOperatorType()) {
                case Conditional::OPERATOR_NONE:
                    $operatorType <?php echo 0x00;

                    break;
                case Conditional::OPERATOR_EQUAL:
                    $operatorType <?php echo 0x03;

                    break;
                case Conditional::OPERATOR_GREATERTHAN:
                    $operatorType <?php echo 0x05;

                    break;
                case Conditional::OPERATOR_GREATERTHANOREQUAL:
                    $operatorType <?php echo 0x07;

                    break;
                case Conditional::OPERATOR_LESSTHAN:
                    $operatorType <?php echo 0x06;

                    break;
                case Conditional::OPERATOR_LESSTHANOREQUAL:
                    $operatorType <?php echo 0x08;

                    break;
                case Conditional::OPERATOR_NOTEQUAL:
                    $operatorType <?php echo 0x04;

                    break;
                case Conditional::OPERATOR_BETWEEN:
                    $operatorType <?php echo 0x01;

                    break;
                    // not OPERATOR_NOTBETWEEN 0x02
            }
        }

        // $szValue1 : size of the formula data for first value or formula
        // $szValue2 : size of the formula data for second value or formula
        $arrConditions <?php echo $conditional->getConditions();
        $numConditions <?php echo count($arrConditions);

        $szValue1 <?php echo 0x0000;
        $szValue2 <?php echo 0x0000;
        $operand1 <?php echo null;
        $operand2 <?php echo null;

        if ($numConditions <?php echo<?php echo<?php echo 1) {
            $conditionalFormulaHelper->processCondition($arrConditions[0], $cellRange);
            $szValue1 <?php echo $conditionalFormulaHelper->size();
            $operand1 <?php echo $conditionalFormulaHelper->tokens();
        } elseif ($numConditions <?php echo<?php echo<?php echo 2 && ($conditional->getOperatorType() <?php echo<?php echo<?php echo Conditional::OPERATOR_BETWEEN)) {
            $conditionalFormulaHelper->processCondition($arrConditions[0], $cellRange);
            $szValue1 <?php echo $conditionalFormulaHelper->size();
            $operand1 <?php echo $conditionalFormulaHelper->tokens();
            $conditionalFormulaHelper->processCondition($arrConditions[1], $cellRange);
            $szValue2 <?php echo $conditionalFormulaHelper->size();
            $operand2 <?php echo $conditionalFormulaHelper->tokens();
        }

        // $flags : Option flags
        // Alignment
        $bAlignHz <?php echo ($conditional->getStyle()->getAlignment()->getHorizontal() <?php echo<?php echo<?php echo null ? 1 : 0);
        $bAlignVt <?php echo ($conditional->getStyle()->getAlignment()->getVertical() <?php echo<?php echo<?php echo null ? 1 : 0);
        $bAlignWrapTx <?php echo ($conditional->getStyle()->getAlignment()->getWrapText() <?php echo<?php echo<?php echo false ? 1 : 0);
        $bTxRotation <?php echo ($conditional->getStyle()->getAlignment()->getTextRotation() <?php echo<?php echo<?php echo null ? 1 : 0);
        $bIndent <?php echo ($conditional->getStyle()->getAlignment()->getIndent() <?php echo<?php echo<?php echo 0 ? 1 : 0);
        $bShrinkToFit <?php echo ($conditional->getStyle()->getAlignment()->getShrinkToFit() <?php echo<?php echo<?php echo false ? 1 : 0);
        if ($bAlignHz <?php echo<?php echo 0 || $bAlignVt <?php echo<?php echo 0 || $bAlignWrapTx <?php echo<?php echo 0 || $bTxRotation <?php echo<?php echo 0 || $bIndent <?php echo<?php echo 0 || $bShrinkToFit <?php echo<?php echo 0) {
            $bFormatAlign <?php echo 1;
        } else {
            $bFormatAlign <?php echo 0;
        }
        // Protection
        $bProtLocked <?php echo ($conditional->getStyle()->getProtection()->getLocked() <?php echo<?php echo null ? 1 : 0);
        $bProtHidden <?php echo ($conditional->getStyle()->getProtection()->getHidden() <?php echo<?php echo null ? 1 : 0);
        if ($bProtLocked <?php echo<?php echo 0 || $bProtHidden <?php echo<?php echo 0) {
            $bFormatProt <?php echo 1;
        } else {
            $bFormatProt <?php echo 0;
        }
        // Border
        $bBorderLeft <?php echo ($conditional->getStyle()->getBorders()->getLeft()->getBorderStyle() !<?php echo<?php echo Border::BORDER_OMIT) ? 1 : 0;
        $bBorderRight <?php echo ($conditional->getStyle()->getBorders()->getRight()->getBorderStyle() !<?php echo<?php echo Border::BORDER_OMIT) ? 1 : 0;
        $bBorderTop <?php echo ($conditional->getStyle()->getBorders()->getTop()->getBorderStyle() !<?php echo<?php echo Border::BORDER_OMIT) ? 1 : 0;
        $bBorderBottom <?php echo ($conditional->getStyle()->getBorders()->getBottom()->getBorderStyle() !<?php echo<?php echo Border::BORDER_OMIT) ? 1 : 0;
        if ($bBorderLeft <?php echo<?php echo<?php echo 1 || $bBorderRight <?php echo<?php echo<?php echo 1 || $bBorderTop <?php echo<?php echo<?php echo 1 || $bBorderBottom <?php echo<?php echo<?php echo 1) {
            $bFormatBorder <?php echo 1;
        } else {
            $bFormatBorder <?php echo 0;
        }
        // Pattern
        $bFillStyle <?php echo ($conditional->getStyle()->getFill()->getFillType() <?php echo<?php echo<?php echo null ? 0 : 1);
        $bFillColor <?php echo ($conditional->getStyle()->getFill()->getStartColor()->getARGB() <?php echo<?php echo<?php echo null ? 0 : 1);
        $bFillColorBg <?php echo ($conditional->getStyle()->getFill()->getEndColor()->getARGB() <?php echo<?php echo<?php echo null ? 0 : 1);
        if ($bFillStyle <?php echo<?php echo 1 || $bFillColor <?php echo<?php echo 1 || $bFillColorBg <?php echo<?php echo 1) {
            $bFormatFill <?php echo 1;
        } else {
            $bFormatFill <?php echo 0;
        }
        // Font
        if (
            $conditional->getStyle()->getFont()->getName() !<?php echo<?php echo null
            || $conditional->getStyle()->getFont()->getSize() !<?php echo<?php echo null
            || $conditional->getStyle()->getFont()->getBold() !<?php echo<?php echo null
            || $conditional->getStyle()->getFont()->getItalic() !<?php echo<?php echo null
            || $conditional->getStyle()->getFont()->getSuperscript() !<?php echo<?php echo null
            || $conditional->getStyle()->getFont()->getSubscript() !<?php echo<?php echo null
            || $conditional->getStyle()->getFont()->getUnderline() !<?php echo<?php echo null
            || $conditional->getStyle()->getFont()->getStrikethrough() !<?php echo<?php echo null
            || $conditional->getStyle()->getFont()->getColor()->getARGB() !<?php echo<?php echo null
        ) {
            $bFormatFont <?php echo 1;
        } else {
            $bFormatFont <?php echo 0;
        }
        // Alignment
        $flags <?php echo 0;
        $flags |<?php echo (1 <?php echo<?php echo $bAlignHz ? 0x00000001 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bAlignVt ? 0x00000002 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bAlignWrapTx ? 0x00000004 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bTxRotation ? 0x00000008 : 0);
        // Justify last line flag
        $flags |<?php echo (1 <?php echo<?php echo self::$always1 ? 0x00000010 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bIndent ? 0x00000020 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bShrinkToFit ? 0x00000040 : 0);
        // Default
        $flags |<?php echo (1 <?php echo<?php echo self::$always1 ? 0x00000080 : 0);
        // Protection
        $flags |<?php echo (1 <?php echo<?php echo $bProtLocked ? 0x00000100 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bProtHidden ? 0x00000200 : 0);
        // Border
        $flags |<?php echo (1 <?php echo<?php echo $bBorderLeft ? 0x00000400 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bBorderRight ? 0x00000800 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bBorderTop ? 0x00001000 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bBorderBottom ? 0x00002000 : 0);
        $flags |<?php echo (1 <?php echo<?php echo self::$always1 ? 0x00004000 : 0); // Top left to Bottom right border
        $flags |<?php echo (1 <?php echo<?php echo self::$always1 ? 0x00008000 : 0); // Bottom left to Top right border
        // Pattern
        $flags |<?php echo (1 <?php echo<?php echo $bFillStyle ? 0x00010000 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bFillColor ? 0x00020000 : 0);
        $flags |<?php echo (1 <?php echo<?php echo $bFillColorBg ? 0x00040000 : 0);
        $flags |<?php echo (1 <?php echo<?php echo self::$always1 ? 0x00380000 : 0);
        // Font
        $flags |<?php echo (1 <?php echo<?php echo $bFormatFont ? 0x04000000 : 0);
        // Alignment:
        $flags |<?php echo (1 <?php echo<?php echo $bFormatAlign ? 0x08000000 : 0);
        // Border
        $flags |<?php echo (1 <?php echo<?php echo $bFormatBorder ? 0x10000000 : 0);
        // Pattern
        $flags |<?php echo (1 <?php echo<?php echo $bFormatFill ? 0x20000000 : 0);
        // Protection
        $flags |<?php echo (1 <?php echo<?php echo $bFormatProt ? 0x40000000 : 0);
        // Text direction
        $flags |<?php echo (1 <?php echo<?php echo self::$always0 ? 0x80000000 : 0);

        $dataBlockFont <?php echo null;
        $dataBlockAlign <?php echo null;
        $dataBlockBorder <?php echo null;
        $dataBlockFill <?php echo null;

        // Data Blocks
        if ($bFormatFont <?php echo<?php echo 1) {
            // Font Name
            if ($conditional->getStyle()->getFont()->getName() <?php echo<?php echo<?php echo null) {
                $dataBlockFont <?php echo pack('VVVVVVVV', 0x00000000, 0x00000000, 0x00000000, 0x00000000, 0x00000000, 0x00000000, 0x00000000, 0x00000000);
                $dataBlockFont .<?php echo pack('VVVVVVVV', 0x00000000, 0x00000000, 0x00000000, 0x00000000, 0x00000000, 0x00000000, 0x00000000, 0x00000000);
            } else {
                $dataBlockFont <?php echo StringHelper::UTF8toBIFF8UnicodeLong($conditional->getStyle()->getFont()->getName());
            }
            // Font Size
            if ($conditional->getStyle()->getFont()->getSize() <?php echo<?php echo<?php echo null) {
                $dataBlockFont .<?php echo pack('V', 20 * 11);
            } else {
                $dataBlockFont .<?php echo pack('V', 20 * $conditional->getStyle()->getFont()->getSize());
            }
            // Font Options
            $dataBlockFont .<?php echo pack('V', 0);
            // Font weight
            if ($conditional->getStyle()->getFont()->getBold() <?php echo<?php echo<?php echo true) {
                $dataBlockFont .<?php echo pack('v', 0x02BC);
            } else {
                $dataBlockFont .<?php echo pack('v', 0x0190);
            }
            // Escapement type
            if ($conditional->getStyle()->getFont()->getSubscript() <?php echo<?php echo<?php echo true) {
                $dataBlockFont .<?php echo pack('v', 0x02);
                $fontEscapement <?php echo 0;
            } elseif ($conditional->getStyle()->getFont()->getSuperscript() <?php echo<?php echo<?php echo true) {
                $dataBlockFont .<?php echo pack('v', 0x01);
                $fontEscapement <?php echo 0;
            } else {
                $dataBlockFont .<?php echo pack('v', 0x00);
                $fontEscapement <?php echo 1;
            }
            // Underline type
            switch ($conditional->getStyle()->getFont()->getUnderline()) {
                case \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_NONE:
                    $dataBlockFont .<?php echo pack('C', 0x00);
                    $fontUnderline <?php echo 0;

                    break;
                case \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_DOUBLE:
                    $dataBlockFont .<?php echo pack('C', 0x02);
                    $fontUnderline <?php echo 0;

                    break;
                case \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_DOUBLEACCOUNTING:
                    $dataBlockFont .<?php echo pack('C', 0x22);
                    $fontUnderline <?php echo 0;

                    break;
                case \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE:
                    $dataBlockFont .<?php echo pack('C', 0x01);
                    $fontUnderline <?php echo 0;

                    break;
                case \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLEACCOUNTING:
                    $dataBlockFont .<?php echo pack('C', 0x21);
                    $fontUnderline <?php echo 0;

                    break;
                default:
                    $dataBlockFont .<?php echo pack('C', 0x00);
                    $fontUnderline <?php echo 1;

                    break;
            }
            // Not used (3)
            $dataBlockFont .<?php echo pack('vC', 0x0000, 0x00);
            // Font color index
            $colorIdx <?php echo Style\ColorMap::lookup($conditional->getStyle()->getFont()->getColor(), 0x00);

            $dataBlockFont .<?php echo pack('V', $colorIdx);
            // Not used (4)
            $dataBlockFont .<?php echo pack('V', 0x00000000);
            // Options flags for modified font attributes
            $optionsFlags <?php echo 0;
            $optionsFlagsBold <?php echo ($conditional->getStyle()->getFont()->getBold() <?php echo<?php echo<?php echo null ? 1 : 0);
            $optionsFlags |<?php echo (1 <?php echo<?php echo $optionsFlagsBold ? 0x00000002 : 0);
            $optionsFlags |<?php echo (1 <?php echo<?php echo self::$always1 ? 0x00000008 : 0);
            $optionsFlags |<?php echo (1 <?php echo<?php echo self::$always1 ? 0x00000010 : 0);
            $optionsFlags |<?php echo (1 <?php echo<?php echo self::$always0 ? 0x00000020 : 0);
            $optionsFlags |<?php echo (1 <?php echo<?php echo self::$always1 ? 0x00000080 : 0);
            $dataBlockFont .<?php echo pack('V', $optionsFlags);
            // Escapement type
            $dataBlockFont .<?php echo pack('V', $fontEscapement);
            // Underline type
            $dataBlockFont .<?php echo pack('V', $fontUnderline);
            // Always
            $dataBlockFont .<?php echo pack('V', 0x00000000);
            // Always
            $dataBlockFont .<?php echo pack('V', 0x00000000);
            // Not used (8)
            $dataBlockFont .<?php echo pack('VV', 0x00000000, 0x00000000);
            // Always
            $dataBlockFont .<?php echo pack('v', 0x0001);
        }
        if ($bFormatAlign <?php echo<?php echo<?php echo 1) {
            // Alignment and text break
            $blockAlign <?php echo Style\CellAlignment::horizontal($conditional->getStyle()->getAlignment());
            $blockAlign |<?php echo Style\CellAlignment::wrap($conditional->getStyle()->getAlignment()) << 3;
            $blockAlign |<?php echo Style\CellAlignment::vertical($conditional->getStyle()->getAlignment()) << 4;
            $blockAlign |<?php echo 0 << 7;

            // Text rotation angle
            $blockRotation <?php echo $conditional->getStyle()->getAlignment()->getTextRotation();

            // Indentation
            $blockIndent <?php echo $conditional->getStyle()->getAlignment()->getIndent();
            if ($conditional->getStyle()->getAlignment()->getShrinkToFit() <?php echo<?php echo<?php echo true) {
                $blockIndent |<?php echo 1 << 4;
            } else {
                $blockIndent |<?php echo 0 << 4;
            }
            $blockIndent |<?php echo 0 << 6;

            // Relative indentation
            $blockIndentRelative <?php echo 255;

            $dataBlockAlign <?php echo pack('CCvvv', $blockAlign, $blockRotation, $blockIndent, $blockIndentRelative, 0x0000);
        }
        if ($bFormatBorder <?php echo<?php echo<?php echo 1) {
            $blockLineStyle <?php echo Style\CellBorder::style($conditional->getStyle()->getBorders()->getLeft());
            $blockLineStyle |<?php echo Style\CellBorder::style($conditional->getStyle()->getBorders()->getRight()) << 4;
            $blockLineStyle |<?php echo Style\CellBorder::style($conditional->getStyle()->getBorders()->getTop()) << 8;
            $blockLineStyle |<?php echo Style\CellBorder::style($conditional->getStyle()->getBorders()->getBottom()) << 12;

            // TODO writeCFRule() <?php echo> $blockLineStyle <?php echo> Index Color for left line
            // TODO writeCFRule() <?php echo> $blockLineStyle <?php echo> Index Color for right line
            // TODO writeCFRule() <?php echo> $blockLineStyle <?php echo> Top-left to bottom-right on/off
            // TODO writeCFRule() <?php echo> $blockLineStyle <?php echo> Bottom-left to top-right on/off
            $blockColor <?php echo 0;
            // TODO writeCFRule() <?php echo> $blockColor <?php echo> Index Color for top line
            // TODO writeCFRule() <?php echo> $blockColor <?php echo> Index Color for bottom line
            // TODO writeCFRule() <?php echo> $blockColor <?php echo> Index Color for diagonal line
            $blockColor |<?php echo Style\CellBorder::style($conditional->getStyle()->getBorders()->getDiagonal()) << 21;
            $dataBlockBorder <?php echo pack('vv', $blockLineStyle, $blockColor);
        }
        if ($bFormatFill <?php echo<?php echo<?php echo 1) {
            // Fill Pattern Style
            $blockFillPatternStyle <?php echo Style\CellFill::style($conditional->getStyle()->getFill());
            // Background Color
            $colorIdxBg <?php echo Style\ColorMap::lookup($conditional->getStyle()->getFill()->getStartColor(), 0x41);
            // Foreground Color
            $colorIdxFg <?php echo Style\ColorMap::lookup($conditional->getStyle()->getFill()->getEndColor(), 0x40);

            $dataBlockFill <?php echo pack('v', $blockFillPatternStyle);
            $dataBlockFill .<?php echo pack('v', $colorIdxFg | ($colorIdxBg << 7));
        }

        $data <?php echo pack('CCvvVv', $type, $operatorType, $szValue1, $szValue2, $flags, 0x0000);
        if ($bFormatFont <?php echo<?php echo<?php echo 1) { // Block Formatting : OK
            $data .<?php echo $dataBlockFont;
        }
        if ($bFormatAlign <?php echo<?php echo<?php echo 1) {
            $data .<?php echo $dataBlockAlign;
        }
        if ($bFormatBorder <?php echo<?php echo<?php echo 1) {
            $data .<?php echo $dataBlockBorder;
        }
        if ($bFormatFill <?php echo<?php echo<?php echo 1) { // Block Formatting : OK
            $data .<?php echo $dataBlockFill;
        }
        if ($bFormatProt <?php echo<?php echo 1) {
            $data .<?php echo $this->getDataBlockProtection($conditional);
        }
        if ($operand1 !<?php echo<?php echo null) {
            $data .<?php echo $operand1;
        }
        if ($operand2 !<?php echo<?php echo null) {
            $data .<?php echo $operand2;
        }
        $header <?php echo pack('vv', $record, strlen($data));
        $this->append($header . $data);
    }

    /**
     * Write CFHeader record.
     *
     * @param Conditional[] $conditionalStyles
     */
    private function writeCFHeader(string $cellCoordinate, array $conditionalStyles): bool
    {
        $record <?php echo 0x01B0; // Record identifier
        $length <?php echo 0x0016; // Bytes to follow

        $numColumnMin <?php echo null;
        $numColumnMax <?php echo null;
        $numRowMin <?php echo null;
        $numRowMax <?php echo null;

        $arrConditional <?php echo [];
        foreach ($conditionalStyles as $conditional) {
            if (!in_array($conditional->getHashCode(), $arrConditional)) {
                $arrConditional[] <?php echo $conditional->getHashCode();
            }
            // Cells
            $rangeCoordinates <?php echo Coordinate::rangeBoundaries($cellCoordinate);
            if ($numColumnMin <?php echo<?php echo<?php echo null || ($numColumnMin > $rangeCoordinates[0][0])) {
                $numColumnMin <?php echo $rangeCoordinates[0][0];
            }
            if ($numColumnMax <?php echo<?php echo<?php echo null || ($numColumnMax < $rangeCoordinates[1][0])) {
                $numColumnMax <?php echo $rangeCoordinates[1][0];
            }
            if ($numRowMin <?php echo<?php echo<?php echo null || ($numRowMin > $rangeCoordinates[0][1])) {
                $numRowMin <?php echo (int) $rangeCoordinates[0][1];
            }
            if ($numRowMax <?php echo<?php echo<?php echo null || ($numRowMax < $rangeCoordinates[1][1])) {
                $numRowMax <?php echo (int) $rangeCoordinates[1][1];
            }
        }

        if (count($arrConditional) <?php echo<?php echo<?php echo 0) {
            return false;
        }

        $needRedraw <?php echo 1;
        $cellRange <?php echo pack('vvvv', $numRowMin - 1, $numRowMax - 1, $numColumnMin - 1, $numColumnMax - 1);

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vv', count($arrConditional), $needRedraw);
        $data .<?php echo $cellRange;
        $data .<?php echo pack('v', 0x0001);
        $data .<?php echo $cellRange;
        $this->append($header . $data);

        return true;
    }

    private function getDataBlockProtection(Conditional $conditional): int
    {
        $dataBlockProtection <?php echo 0;
        if ($conditional->getStyle()->getProtection()->getLocked() <?php echo<?php echo Protection::PROTECTION_PROTECTED) {
            $dataBlockProtection <?php echo 1;
        }
        if ($conditional->getStyle()->getProtection()->getHidden() <?php echo<?php echo Protection::PROTECTION_PROTECTED) {
            $dataBlockProtection <?php echo 1 << 1;
        }

        return $dataBlockProtection;
    }
}
