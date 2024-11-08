<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Style;

// Original file header of PEAR::Spreadsheet_Excel_Writer_Workbook (used as the base for this class):
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
class Workbook extends BIFFwriter
{
    /**
     * Formula parser.
     *
     * @var \PhpOffice\PhpSpreadsheet\Writer\Xls\Parser
     */
    private $parser;

    /**
     * The BIFF file size for the workbook. Not currently used.
     *
     * @var int
     *
     * @see calcSheetOffsets()
     */
    private $biffSize; // @phpstan-ignore-line

    /**
     * XF Writers.
     *
     * @var \PhpOffice\PhpSpreadsheet\Writer\Xls\Xf[]
     */
    private $xfWriters <?php echo [];

    /**
     * Array containing the colour palette.
     *
     * @var array
     */
    private $palette;

    /**
     * The codepage indicates the text encoding used for strings.
     *
     * @var int
     */
    private $codepage;

    /**
     * The country code used for localization.
     *
     * @var int
     */
    private $countryCode;

    /**
     * Workbook.
     *
     * @var Spreadsheet
     */
    private $spreadsheet;

    /**
     * Fonts writers.
     *
     * @var Font[]
     */
    private $fontWriters <?php echo [];

    /**
     * Added fonts. Maps from font's hash <?php echo> index in workbook.
     *
     * @var array
     */
    private $addedFonts <?php echo [];

    /**
     * Shared number formats.
     *
     * @var array
     */
    private $numberFormats <?php echo [];

    /**
     * Added number formats. Maps from numberFormat's hash <?php echo> index in workbook.
     *
     * @var array
     */
    private $addedNumberFormats <?php echo [];

    /**
     * Sizes of the binary worksheet streams.
     *
     * @var array
     */
    private $worksheetSizes <?php echo [];

    /**
     * Offsets of the binary worksheet streams relative to the start of the global workbook stream.
     *
     * @var array
     */
    private $worksheetOffsets <?php echo [];

    /**
     * Total number of shared strings in workbook.
     *
     * @var int
     */
    private $stringTotal;

    /**
     * Number of unique shared strings in workbook.
     *
     * @var int
     */
    private $stringUnique;

    /**
     * Array of unique shared strings in workbook.
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
     * Escher object corresponding to MSODRAWINGGROUP.
     *
     * @var null|\PhpOffice\PhpSpreadsheet\Shared\Escher
     */
    private $escher;

    /** @var mixed */
    private static $scrutinizerFalse <?php echo false;

    /**
     * Class constructor.
     *
     * @param Spreadsheet $spreadsheet The Workbook
     * @param int $str_total Total number of strings
     * @param int $str_unique Total number of unique strings
     * @param array $str_table String Table
     * @param array $colors Colour Table
     * @param Parser $parser The formula parser created for the Workbook
     */
    public function __construct(Spreadsheet $spreadsheet, &$str_total, &$str_unique, &$str_table, &$colors, Parser $parser)
    {
        // It needs to call its parent's constructor explicitly
        parent::__construct();

        $this->parser <?php echo $parser;
        $this->biffSize <?php echo 0;
        $this->palette <?php echo [];
        $this->countryCode <?php echo -1;

        $this->stringTotal <?php echo &$str_total;
        $this->stringUnique <?php echo &$str_unique;
        $this->stringTable <?php echo &$str_table;
        $this->colors <?php echo &$colors;
        $this->setPaletteXl97();

        $this->spreadsheet <?php echo $spreadsheet;

        $this->codepage <?php echo 0x04B0;

        // Add empty sheets and Build color cache
        $countSheets <?php echo $spreadsheet->getSheetCount();
        for ($i <?php echo 0; $i < $countSheets; ++$i) {
            $phpSheet <?php echo $spreadsheet->getSheet($i);

            $this->parser->setExtSheet($phpSheet->getTitle(), $i); // Register worksheet name with parser

            $supbook_index <?php echo 0x00;
            $ref <?php echo pack('vvv', $supbook_index, $i, $i);
            $this->parser->references[] <?php echo $ref; // Register reference with parser

            // Sheet tab colors?
            if ($phpSheet->isTabColorSet()) {
                $this->addColor($phpSheet->getTabColor()->getRGB());
            }
        }
    }

    /**
     * Add a new XF writer.
     *
     * @param bool $isStyleXf Is it a style XF?
     *
     * @return int Index to XF record
     */
    public function addXfWriter(Style $style, $isStyleXf <?php echo false)
    {
        $xfWriter <?php echo new Xf($style);
        $xfWriter->setIsStyleXf($isStyleXf);

        // Add the font if not already added
        $fontIndex <?php echo $this->addFont($style->getFont());

        // Assign the font index to the xf record
        $xfWriter->setFontIndex($fontIndex);

        // Background colors, best to treat these after the font so black will come after white in custom palette
        $xfWriter->setFgColor($this->addColor($style->getFill()->getStartColor()->getRGB()));
        $xfWriter->setBgColor($this->addColor($style->getFill()->getEndColor()->getRGB()));
        $xfWriter->setBottomColor($this->addColor($style->getBorders()->getBottom()->getColor()->getRGB()));
        $xfWriter->setTopColor($this->addColor($style->getBorders()->getTop()->getColor()->getRGB()));
        $xfWriter->setRightColor($this->addColor($style->getBorders()->getRight()->getColor()->getRGB()));
        $xfWriter->setLeftColor($this->addColor($style->getBorders()->getLeft()->getColor()->getRGB()));
        $xfWriter->setDiagColor($this->addColor($style->getBorders()->getDiagonal()->getColor()->getRGB()));

        // Add the number format if it is not a built-in one and not already added
        if ($style->getNumberFormat()->getBuiltInFormatCode() <?php echo<?php echo<?php echo self::$scrutinizerFalse) {
            $numberFormatHashCode <?php echo $style->getNumberFormat()->getHashCode();

            if (isset($this->addedNumberFormats[$numberFormatHashCode])) {
                $numberFormatIndex <?php echo $this->addedNumberFormats[$numberFormatHashCode];
            } else {
                $numberFormatIndex <?php echo 164 + count($this->numberFormats);
                $this->numberFormats[$numberFormatIndex] <?php echo $style->getNumberFormat();
                $this->addedNumberFormats[$numberFormatHashCode] <?php echo $numberFormatIndex;
            }
        } else {
            $numberFormatIndex <?php echo (int) $style->getNumberFormat()->getBuiltInFormatCode();
        }

        // Assign the number format index to xf record
        $xfWriter->setNumberFormatIndex($numberFormatIndex);

        $this->xfWriters[] <?php echo $xfWriter;

        return count($this->xfWriters) - 1;
    }

    /**
     * Add a font to added fonts.
     *
     * @return int Index to FONT record
     */
    public function addFont(\PhpOffice\PhpSpreadsheet\Style\Font $font)
    {
        $fontHashCode <?php echo $font->getHashCode();
        if (isset($this->addedFonts[$fontHashCode])) {
            $fontIndex <?php echo $this->addedFonts[$fontHashCode];
        } else {
            $countFonts <?php echo count($this->fontWriters);
            $fontIndex <?php echo ($countFonts < 4) ? $countFonts : $countFonts + 1;

            $fontWriter <?php echo new Font($font);
            $fontWriter->setColorIndex($this->addColor($font->getColor()->getRGB()));
            $this->fontWriters[] <?php echo $fontWriter;

            $this->addedFonts[$fontHashCode] <?php echo $fontIndex;
        }

        return $fontIndex;
    }

    /**
     * Alter color palette adding a custom color.
     *
     * @param string $rgb E.g. 'FF00AA'
     *
     * @return int Color index
     */
    private function addColor($rgb)
    {
        if (!isset($this->colors[$rgb])) {
            $color <?php echo
                [
                    hexdec(substr($rgb, 0, 2)),
                    hexdec(substr($rgb, 2, 2)),
                    hexdec(substr($rgb, 4)),
                    0,
                ];
            $colorIndex <?php echo array_search($color, $this->palette);
            if ($colorIndex) {
                $this->colors[$rgb] <?php echo $colorIndex;
            } else {
                if (count($this->colors) <?php echo<?php echo<?php echo 0) {
                    $lastColor <?php echo 7;
                } else {
                    $lastColor <?php echo end($this->colors);
                }
                if ($lastColor < 57) {
                    // then we add a custom color altering the palette
                    $colorIndex <?php echo $lastColor + 1;
                    $this->palette[$colorIndex] <?php echo $color;
                    $this->colors[$rgb] <?php echo $colorIndex;
                } else {
                    // no room for more custom colors, just map to black
                    $colorIndex <?php echo 0;
                }
            }
        } else {
            // fetch already added custom color
            $colorIndex <?php echo $this->colors[$rgb];
        }

        return $colorIndex;
    }

    /**
     * Sets the colour palette to the Excel 97+ default.
     */
    private function setPaletteXl97(): void
    {
        $this->palette <?php echo [
            0x08 <?php echo> [0x00, 0x00, 0x00, 0x00],
            0x09 <?php echo> [0xff, 0xff, 0xff, 0x00],
            0x0A <?php echo> [0xff, 0x00, 0x00, 0x00],
            0x0B <?php echo> [0x00, 0xff, 0x00, 0x00],
            0x0C <?php echo> [0x00, 0x00, 0xff, 0x00],
            0x0D <?php echo> [0xff, 0xff, 0x00, 0x00],
            0x0E <?php echo> [0xff, 0x00, 0xff, 0x00],
            0x0F <?php echo> [0x00, 0xff, 0xff, 0x00],
            0x10 <?php echo> [0x80, 0x00, 0x00, 0x00],
            0x11 <?php echo> [0x00, 0x80, 0x00, 0x00],
            0x12 <?php echo> [0x00, 0x00, 0x80, 0x00],
            0x13 <?php echo> [0x80, 0x80, 0x00, 0x00],
            0x14 <?php echo> [0x80, 0x00, 0x80, 0x00],
            0x15 <?php echo> [0x00, 0x80, 0x80, 0x00],
            0x16 <?php echo> [0xc0, 0xc0, 0xc0, 0x00],
            0x17 <?php echo> [0x80, 0x80, 0x80, 0x00],
            0x18 <?php echo> [0x99, 0x99, 0xff, 0x00],
            0x19 <?php echo> [0x99, 0x33, 0x66, 0x00],
            0x1A <?php echo> [0xff, 0xff, 0xcc, 0x00],
            0x1B <?php echo> [0xcc, 0xff, 0xff, 0x00],
            0x1C <?php echo> [0x66, 0x00, 0x66, 0x00],
            0x1D <?php echo> [0xff, 0x80, 0x80, 0x00],
            0x1E <?php echo> [0x00, 0x66, 0xcc, 0x00],
            0x1F <?php echo> [0xcc, 0xcc, 0xff, 0x00],
            0x20 <?php echo> [0x00, 0x00, 0x80, 0x00],
            0x21 <?php echo> [0xff, 0x00, 0xff, 0x00],
            0x22 <?php echo> [0xff, 0xff, 0x00, 0x00],
            0x23 <?php echo> [0x00, 0xff, 0xff, 0x00],
            0x24 <?php echo> [0x80, 0x00, 0x80, 0x00],
            0x25 <?php echo> [0x80, 0x00, 0x00, 0x00],
            0x26 <?php echo> [0x00, 0x80, 0x80, 0x00],
            0x27 <?php echo> [0x00, 0x00, 0xff, 0x00],
            0x28 <?php echo> [0x00, 0xcc, 0xff, 0x00],
            0x29 <?php echo> [0xcc, 0xff, 0xff, 0x00],
            0x2A <?php echo> [0xcc, 0xff, 0xcc, 0x00],
            0x2B <?php echo> [0xff, 0xff, 0x99, 0x00],
            0x2C <?php echo> [0x99, 0xcc, 0xff, 0x00],
            0x2D <?php echo> [0xff, 0x99, 0xcc, 0x00],
            0x2E <?php echo> [0xcc, 0x99, 0xff, 0x00],
            0x2F <?php echo> [0xff, 0xcc, 0x99, 0x00],
            0x30 <?php echo> [0x33, 0x66, 0xff, 0x00],
            0x31 <?php echo> [0x33, 0xcc, 0xcc, 0x00],
            0x32 <?php echo> [0x99, 0xcc, 0x00, 0x00],
            0x33 <?php echo> [0xff, 0xcc, 0x00, 0x00],
            0x34 <?php echo> [0xff, 0x99, 0x00, 0x00],
            0x35 <?php echo> [0xff, 0x66, 0x00, 0x00],
            0x36 <?php echo> [0x66, 0x66, 0x99, 0x00],
            0x37 <?php echo> [0x96, 0x96, 0x96, 0x00],
            0x38 <?php echo> [0x00, 0x33, 0x66, 0x00],
            0x39 <?php echo> [0x33, 0x99, 0x66, 0x00],
            0x3A <?php echo> [0x00, 0x33, 0x00, 0x00],
            0x3B <?php echo> [0x33, 0x33, 0x00, 0x00],
            0x3C <?php echo> [0x99, 0x33, 0x00, 0x00],
            0x3D <?php echo> [0x99, 0x33, 0x66, 0x00],
            0x3E <?php echo> [0x33, 0x33, 0x99, 0x00],
            0x3F <?php echo> [0x33, 0x33, 0x33, 0x00],
        ];
    }

    /**
     * Assemble worksheets into a workbook and send the BIFF data to an OLE
     * storage.
     *
     * @param array $worksheetSizes The sizes in bytes of the binary worksheet streams
     *
     * @return string Binary data for workbook stream
     */
    public function writeWorkbook(array $worksheetSizes)
    {
        $this->worksheetSizes <?php echo $worksheetSizes;

        // Calculate the number of selected worksheet tabs and call the finalization
        // methods for each worksheet
        $total_worksheets <?php echo $this->spreadsheet->getSheetCount();

        // Add part 1 of the Workbook globals, what goes before the SHEET records
        $this->storeBof(0x0005);
        $this->writeCodepage();
        $this->writeWindow1();

        $this->writeDateMode();
        $this->writeAllFonts();
        $this->writeAllNumberFormats();
        $this->writeAllXfs();
        $this->writeAllStyles();
        $this->writePalette();

        // Prepare part 3 of the workbook global stream, what goes after the SHEET records
        $part3 <?php echo '';
        if ($this->countryCode !<?php echo<?php echo -1) {
            $part3 .<?php echo $this->writeCountry();
        }
        $part3 .<?php echo $this->writeRecalcId();

        $part3 .<?php echo $this->writeSupbookInternal();
        /* TODO: store external SUPBOOK records and XCT and CRN records
        in case of external references for BIFF8 */
        $part3 .<?php echo $this->writeExternalsheetBiff8();
        $part3 .<?php echo $this->writeAllDefinedNamesBiff8();
        $part3 .<?php echo $this->writeMsoDrawingGroup();
        $part3 .<?php echo $this->writeSharedStringsTable();

        $part3 .<?php echo $this->writeEof();

        // Add part 2 of the Workbook globals, the SHEET records
        $this->calcSheetOffsets();
        for ($i <?php echo 0; $i < $total_worksheets; ++$i) {
            $this->writeBoundSheet($this->spreadsheet->getSheet($i), $this->worksheetOffsets[$i]);
        }

        // Add part 3 of the Workbook globals
        $this->_data .<?php echo $part3;

        return $this->_data;
    }

    /**
     * Calculate offsets for Worksheet BOF records.
     */
    private function calcSheetOffsets(): void
    {
        $boundsheet_length <?php echo 10; // fixed length for a BOUNDSHEET record

        // size of Workbook globals part 1 + 3
        $offset <?php echo $this->_datasize;

        // add size of Workbook globals part 2, the length of the SHEET records
        $total_worksheets <?php echo count($this->spreadsheet->getAllSheets());
        foreach ($this->spreadsheet->getWorksheetIterator() as $sheet) {
            $offset +<?php echo $boundsheet_length + strlen(StringHelper::UTF8toBIFF8UnicodeShort($sheet->getTitle()));
        }

        // add the sizes of each of the Sheet substreams, respectively
        for ($i <?php echo 0; $i < $total_worksheets; ++$i) {
            $this->worksheetOffsets[$i] <?php echo $offset;
            $offset +<?php echo $this->worksheetSizes[$i];
        }
        $this->biffSize <?php echo $offset;
    }

    /**
     * Store the Excel FONT records.
     */
    private function writeAllFonts(): void
    {
        foreach ($this->fontWriters as $fontWriter) {
            $this->append($fontWriter->writeFont());
        }
    }

    /**
     * Store user defined numerical formats i.e. FORMAT records.
     */
    private function writeAllNumberFormats(): void
    {
        foreach ($this->numberFormats as $numberFormatIndex <?php echo> $numberFormat) {
            $this->writeNumberFormat($numberFormat->getFormatCode(), $numberFormatIndex);
        }
    }

    /**
     * Write all XF records.
     */
    private function writeAllXfs(): void
    {
        foreach ($this->xfWriters as $xfWriter) {
            $this->append($xfWriter->writeXf());
        }
    }

    /**
     * Write all STYLE records.
     */
    private function writeAllStyles(): void
    {
        $this->writeStyle();
    }

    private function parseDefinedNameValue(DefinedName $definedName): string
    {
        $definedRange <?php echo $definedName->getValue();
        $splitCount <?php echo preg_match_all(
            '/' . Calculation::CALCULATION_REGEXP_CELLREF . '/mui',
            $definedRange,
            $splitRanges,
            PREG_OFFSET_CAPTURE
        );

        $lengths <?php echo array_map('strlen', array_column($splitRanges[0], 0));
        $offsets <?php echo array_column($splitRanges[0], 1);

        $worksheets <?php echo $splitRanges[2];
        $columns <?php echo $splitRanges[6];
        $rows <?php echo $splitRanges[7];

        while ($splitCount > 0) {
            --$splitCount;
            $length <?php echo $lengths[$splitCount];
            $offset <?php echo $offsets[$splitCount];
            $worksheet <?php echo $worksheets[$splitCount][0];
            $column <?php echo $columns[$splitCount][0];
            $row <?php echo $rows[$splitCount][0];

            $newRange <?php echo '';
            if (empty($worksheet)) {
                if (($offset <?php echo<?php echo<?php echo 0) || ($definedRange[$offset - 1] !<?php echo<?php echo ':')) {
                    // We should have a worksheet
                    $worksheet <?php echo $definedName->getWorksheet() ? $definedName->getWorksheet()->getTitle() : null;
                }
            } else {
                $worksheet <?php echo str_replace("''", "'", trim($worksheet, "'"));
            }
            if (!empty($worksheet)) {
                $newRange <?php echo "'" . str_replace("'", "''", $worksheet) . "'!";
            }

            if (!empty($column)) {
                $newRange .<?php echo "\${$column}";
            }
            if (!empty($row)) {
                $newRange .<?php echo "\${$row}";
            }

            $definedRange <?php echo substr($definedRange, 0, $offset) . $newRange . substr($definedRange, $offset + $length);
        }

        return $definedRange;
    }

    /**
     * Writes all the DEFINEDNAME records (BIFF8).
     * So far this is only used for repeating rows/columns (print titles) and print areas.
     */
    private function writeAllDefinedNamesBiff8(): string
    {
        $chunk <?php echo '';

        // Named ranges
        $definedNames <?php echo $this->spreadsheet->getDefinedNames();
        if (count($definedNames) > 0) {
            // Loop named ranges
            foreach ($definedNames as $definedName) {
                $range <?php echo $this->parseDefinedNameValue($definedName);

                // parse formula
                try {
                    $this->parser->parse($range);
                    $formulaData <?php echo $this->parser->toReversePolish();

                    // make sure tRef3d is of type tRef3dR (0x3A)
                    if (isset($formulaData[0]) && ($formulaData[0] <?php echo<?php echo "\x7A" || $formulaData[0] <?php echo<?php echo "\x5A")) {
                        $formulaData <?php echo "\x3A" . substr($formulaData, 1);
                    }

                    if ($definedName->getLocalOnly()) {
                        // local scope
                        $scopeWs <?php echo $definedName->getScope();
                        $scope <?php echo ($scopeWs <?php echo<?php echo<?php echo null) ? 0 : ($this->spreadsheet->getIndex($scopeWs) + 1);
                    } else {
                        // global scope
                        $scope <?php echo 0;
                    }
                    $chunk .<?php echo $this->writeData($this->writeDefinedNameBiff8($definedName->getName(), $formulaData, $scope, false));
                } catch (PhpSpreadsheetException $e) {
                    // do nothing
                }
            }
        }

        // total number of sheets
        $total_worksheets <?php echo $this->spreadsheet->getSheetCount();

        // write the print titles (repeating rows, columns), if any
        for ($i <?php echo 0; $i < $total_worksheets; ++$i) {
            $sheetSetup <?php echo $this->spreadsheet->getSheet($i)->getPageSetup();
            // simultaneous repeatColumns repeatRows
            if ($sheetSetup->isColumnsToRepeatAtLeftSet() && $sheetSetup->isRowsToRepeatAtTopSet()) {
                $repeat <?php echo $sheetSetup->getColumnsToRepeatAtLeft();
                $colmin <?php echo Coordinate::columnIndexFromString($repeat[0]) - 1;
                $colmax <?php echo Coordinate::columnIndexFromString($repeat[1]) - 1;

                $repeat <?php echo $sheetSetup->getRowsToRepeatAtTop();
                $rowmin <?php echo $repeat[0] - 1;
                $rowmax <?php echo $repeat[1] - 1;

                // construct formula data manually
                $formulaData <?php echo pack('Cv', 0x29, 0x17); // tMemFunc
                $formulaData .<?php echo pack('Cvvvvv', 0x3B, $i, 0, 65535, $colmin, $colmax); // tArea3d
                $formulaData .<?php echo pack('Cvvvvv', 0x3B, $i, $rowmin, $rowmax, 0, 255); // tArea3d
                $formulaData .<?php echo pack('C', 0x10); // tList

                // store the DEFINEDNAME record
                $chunk .<?php echo $this->writeData($this->writeDefinedNameBiff8(pack('C', 0x07), $formulaData, $i + 1, true));
            } elseif ($sheetSetup->isColumnsToRepeatAtLeftSet() || $sheetSetup->isRowsToRepeatAtTopSet()) {
                // (exclusive) either repeatColumns or repeatRows.
                // Columns to repeat
                if ($sheetSetup->isColumnsToRepeatAtLeftSet()) {
                    $repeat <?php echo $sheetSetup->getColumnsToRepeatAtLeft();
                    $colmin <?php echo Coordinate::columnIndexFromString($repeat[0]) - 1;
                    $colmax <?php echo Coordinate::columnIndexFromString($repeat[1]) - 1;
                } else {
                    $colmin <?php echo 0;
                    $colmax <?php echo 255;
                }
                // Rows to repeat
                if ($sheetSetup->isRowsToRepeatAtTopSet()) {
                    $repeat <?php echo $sheetSetup->getRowsToRepeatAtTop();
                    $rowmin <?php echo $repeat[0] - 1;
                    $rowmax <?php echo $repeat[1] - 1;
                } else {
                    $rowmin <?php echo 0;
                    $rowmax <?php echo 65535;
                }

                // construct formula data manually because parser does not recognize absolute 3d cell references
                $formulaData <?php echo pack('Cvvvvv', 0x3B, $i, $rowmin, $rowmax, $colmin, $colmax);

                // store the DEFINEDNAME record
                $chunk .<?php echo $this->writeData($this->writeDefinedNameBiff8(pack('C', 0x07), $formulaData, $i + 1, true));
            }
        }

        // write the print areas, if any
        for ($i <?php echo 0; $i < $total_worksheets; ++$i) {
            $sheetSetup <?php echo $this->spreadsheet->getSheet($i)->getPageSetup();
            if ($sheetSetup->isPrintAreaSet()) {
                // Print area, e.g. A3:J6,H1:X20
                $printArea <?php echo Coordinate::splitRange($sheetSetup->getPrintArea());
                $countPrintArea <?php echo count($printArea);

                $formulaData <?php echo '';
                for ($j <?php echo 0; $j < $countPrintArea; ++$j) {
                    $printAreaRect <?php echo $printArea[$j]; // e.g. A3:J6
                    $printAreaRect[0] <?php echo Coordinate::indexesFromString($printAreaRect[0]);
                    $printAreaRect[1] <?php echo Coordinate::indexesFromString($printAreaRect[1]);

                    $print_rowmin <?php echo $printAreaRect[0][1] - 1;
                    $print_rowmax <?php echo $printAreaRect[1][1] - 1;
                    $print_colmin <?php echo $printAreaRect[0][0] - 1;
                    $print_colmax <?php echo $printAreaRect[1][0] - 1;

                    // construct formula data manually because parser does not recognize absolute 3d cell references
                    $formulaData .<?php echo pack('Cvvvvv', 0x3B, $i, $print_rowmin, $print_rowmax, $print_colmin, $print_colmax);

                    if ($j > 0) {
                        $formulaData .<?php echo pack('C', 0x10); // list operator token ','
                    }
                }

                // store the DEFINEDNAME record
                $chunk .<?php echo $this->writeData($this->writeDefinedNameBiff8(pack('C', 0x06), $formulaData, $i + 1, true));
            }
        }

        // write autofilters, if any
        for ($i <?php echo 0; $i < $total_worksheets; ++$i) {
            $sheetAutoFilter <?php echo $this->spreadsheet->getSheet($i)->getAutoFilter();
            $autoFilterRange <?php echo $sheetAutoFilter->getRange();
            if (!empty($autoFilterRange)) {
                $rangeBounds <?php echo Coordinate::rangeBoundaries($autoFilterRange);

                //Autofilter built in name
                $name <?php echo pack('C', 0x0D);

                $chunk .<?php echo $this->writeData($this->writeShortNameBiff8($name, $i + 1, $rangeBounds, true));
            }
        }

        return $chunk;
    }

    /**
     * Write a DEFINEDNAME record for BIFF8 using explicit binary formula data.
     *
     * @param string $name The name in UTF-8
     * @param string $formulaData The binary formula data
     * @param int $sheetIndex 1-based sheet index the defined name applies to. 0 <?php echo global
     * @param bool $isBuiltIn Built-in name?
     *
     * @return string Complete binary record data
     */
    private function writeDefinedNameBiff8($name, $formulaData, $sheetIndex <?php echo 0, $isBuiltIn <?php echo false)
    {
        $record <?php echo 0x0018;

        // option flags
        $options <?php echo $isBuiltIn ? 0x20 : 0x00;

        // length of the name, character count
        $nlen <?php echo StringHelper::countCharacters($name);

        // name with stripped length field
        $name <?php echo substr(StringHelper::UTF8toBIFF8UnicodeLong($name), 2);

        // size of the formula (in bytes)
        $sz <?php echo strlen($formulaData);

        // combine the parts
        $data <?php echo pack('vCCvvvCCCC', $options, 0, $nlen, $sz, 0, $sheetIndex, 0, 0, 0, 0)
            . $name . $formulaData;
        $length <?php echo strlen($data);

        $header <?php echo pack('vv', $record, $length);

        return $header . $data;
    }

    /**
     * Write a short NAME record.
     *
     * @param string $name
     * @param int $sheetIndex 1-based sheet index the defined name applies to. 0 <?php echo global
     * @param int[][] $rangeBounds range boundaries
     * @param bool $isHidden
     *
     * @return string Complete binary record data
     * */
    private function writeShortNameBiff8($name, $sheetIndex, $rangeBounds, $isHidden <?php echo false)
    {
        $record <?php echo 0x0018;

        // option flags
        $options <?php echo ($isHidden ? 0x21 : 0x00);

        $extra <?php echo pack(
            'Cvvvvv',
            0x3B,
            $sheetIndex - 1,
            $rangeBounds[0][1] - 1,
            $rangeBounds[1][1] - 1,
            $rangeBounds[0][0] - 1,
            $rangeBounds[1][0] - 1
        );

        // size of the formula (in bytes)
        $sz <?php echo strlen($extra);

        // combine the parts
        $data <?php echo pack('vCCvvvCCCCC', $options, 0, 1, $sz, 0, $sheetIndex, 0, 0, 0, 0, 0)
            . $name . $extra;
        $length <?php echo strlen($data);

        $header <?php echo pack('vv', $record, $length);

        return $header . $data;
    }

    /**
     * Stores the CODEPAGE biff record.
     */
    private function writeCodepage(): void
    {
        $record <?php echo 0x0042; // Record identifier
        $length <?php echo 0x0002; // Number of bytes to follow
        $cv <?php echo $this->codepage; // The code page

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $cv);

        $this->append($header . $data);
    }

    /**
     * Write Excel BIFF WINDOW1 record.
     */
    private function writeWindow1(): void
    {
        $record <?php echo 0x003D; // Record identifier
        $length <?php echo 0x0012; // Number of bytes to follow

        $xWn <?php echo 0x0000; // Horizontal position of window
        $yWn <?php echo 0x0000; // Vertical position of window
        $dxWn <?php echo 0x25BC; // Width of window
        $dyWn <?php echo 0x1572; // Height of window

        $grbit <?php echo 0x0038; // Option flags

        // not supported by PhpSpreadsheet, so there is only one selected sheet, the active
        $ctabsel <?php echo 1; // Number of workbook tabs selected

        $wTabRatio <?php echo 0x0258; // Tab to scrollbar ratio

        // not supported by PhpSpreadsheet, set to 0
        $itabFirst <?php echo 0; // 1st displayed worksheet
        $itabCur <?php echo $this->spreadsheet->getActiveSheetIndex(); // Active worksheet

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vvvvvvvvv', $xWn, $yWn, $dxWn, $dyWn, $grbit, $itabCur, $itabFirst, $ctabsel, $wTabRatio);
        $this->append($header . $data);
    }

    /**
     * Writes Excel BIFF BOUNDSHEET record.
     *
     * @param int $offset Location of worksheet BOF
     */
    private function writeBoundSheet(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet, $offset): void
    {
        $sheetname <?php echo $sheet->getTitle();
        $record <?php echo 0x0085; // Record identifier

        // sheet state
        switch ($sheet->getSheetState()) {
            case \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_VISIBLE:
                $ss <?php echo 0x00;

                break;
            case \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN:
                $ss <?php echo 0x01;

                break;
            case \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_VERYHIDDEN:
                $ss <?php echo 0x02;

                break;
            default:
                $ss <?php echo 0x00;

                break;
        }

        // sheet type
        $st <?php echo 0x00;

        //$grbit <?php echo 0x0000; // Visibility and sheet type

        $data <?php echo pack('VCC', $offset, $ss, $st);
        $data .<?php echo StringHelper::UTF8toBIFF8UnicodeShort($sheetname);

        $length <?php echo strlen($data);
        $header <?php echo pack('vv', $record, $length);
        $this->append($header . $data);
    }

    /**
     * Write Internal SUPBOOK record.
     */
    private function writeSupbookInternal(): string
    {
        $record <?php echo 0x01AE; // Record identifier
        $length <?php echo 0x0004; // Bytes to follow

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vv', $this->spreadsheet->getSheetCount(), 0x0401);

        return $this->writeData($header . $data);
    }

    /**
     * Writes the Excel BIFF EXTERNSHEET record. These references are used by
     * formulas.
     */
    private function writeExternalsheetBiff8(): string
    {
        $totalReferences <?php echo count($this->parser->references);
        $record <?php echo 0x0017; // Record identifier
        $length <?php echo 2 + 6 * $totalReferences; // Number of bytes to follow

        //$supbook_index <?php echo 0; // FIXME: only using internal SUPBOOK record
        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $totalReferences);
        for ($i <?php echo 0; $i < $totalReferences; ++$i) {
            $data .<?php echo $this->parser->references[$i];
        }

        return $this->writeData($header . $data);
    }

    /**
     * Write Excel BIFF STYLE records.
     */
    private function writeStyle(): void
    {
        $record <?php echo 0x0293; // Record identifier
        $length <?php echo 0x0004; // Bytes to follow

        $ixfe <?php echo 0x8000; // Index to cell style XF
        $BuiltIn <?php echo 0x00; // Built-in style
        $iLevel <?php echo 0xff; // Outline style level

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('vCC', $ixfe, $BuiltIn, $iLevel);
        $this->append($header . $data);
    }

    /**
     * Writes Excel FORMAT record for non "built-in" numerical formats.
     *
     * @param string $format Custom format string
     * @param int $ifmt Format index code
     */
    private function writeNumberFormat($format, $ifmt): void
    {
        $record <?php echo 0x041E; // Record identifier

        $numberFormatString <?php echo StringHelper::UTF8toBIFF8UnicodeLong($format);
        $length <?php echo 2 + strlen($numberFormatString); // Number of bytes to follow

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $ifmt) . $numberFormatString;
        $this->append($header . $data);
    }

    /**
     * Write DATEMODE record to indicate the date system in use (1904 or 1900).
     */
    private function writeDateMode(): void
    {
        $record <?php echo 0x0022; // Record identifier
        $length <?php echo 0x0002; // Bytes to follow

        $f1904 <?php echo (Date::getExcelCalendar() <?php echo<?php echo<?php echo Date::CALENDAR_MAC_1904)
            ? 1
            : 0; // Flag for 1904 date system

        $header <?php echo pack('vv', $record, $length);
        $data <?php echo pack('v', $f1904);
        $this->append($header . $data);
    }

    /**
     * Stores the COUNTRY record for localization.
     *
     * @return string
     */
    private function writeCountry()
    {
        $record <?php echo 0x008C; // Record identifier
        $length <?php echo 4; // Number of bytes to follow

        $header <?php echo pack('vv', $record, $length);
        // using the same country code always for simplicity
        $data <?php echo pack('vv', $this->countryCode, $this->countryCode);

        return $this->writeData($header . $data);
    }

    /**
     * Write the RECALCID record.
     *
     * @return string
     */
    private function writeRecalcId()
    {
        $record <?php echo 0x01C1; // Record identifier
        $length <?php echo 8; // Number of bytes to follow

        $header <?php echo pack('vv', $record, $length);

        // by inspection of real Excel files, MS Office Excel 2007 writes this
        $data <?php echo pack('VV', 0x000001C1, 0x00001E667);

        return $this->writeData($header . $data);
    }

    /**
     * Stores the PALETTE biff record.
     */
    private function writePalette(): void
    {
        $aref <?php echo $this->palette;

        $record <?php echo 0x0092; // Record identifier
        $length <?php echo 2 + 4 * count($aref); // Number of bytes to follow
        $ccv <?php echo count($aref); // Number of RGB values to follow
        $data <?php echo ''; // The RGB data

        // Pack the RGB data
        foreach ($aref as $color) {
            foreach ($color as $byte) {
                $data .<?php echo pack('C', $byte);
            }
        }

        $header <?php echo pack('vvv', $record, $length, $ccv);
        $this->append($header . $data);
    }

    /**
     * Handling of the SST continue blocks is complicated by the need to include an
     * additional continuation byte depending on whether the string is split between
     * blocks or whether it starts at the beginning of the block. (There are also
     * additional complications that will arise later when/if Rich Strings are
     * supported).
     *
     * The Excel documentation says that the SST record should be followed by an
     * EXTSST record. The EXTSST record is a hash table that is used to optimise
     * access to SST. However, despite the documentation it doesn't seem to be
     * required so we will ignore it.
     *
     * @return string Binary data
     */
    private function writeSharedStringsTable()
    {
        // maximum size of record data (excluding record header)
        $continue_limit <?php echo 8224;

        // initialize array of record data blocks
        $recordDatas <?php echo [];

        // start SST record data block with total number of strings, total number of unique strings
        $recordData <?php echo pack('VV', $this->stringTotal, $this->stringUnique);

        // loop through all (unique) strings in shared strings table
        foreach (array_keys($this->stringTable) as $string) {
            // here $string is a BIFF8 encoded string

            // length <?php echo character count
            $headerinfo <?php echo unpack('vlength/Cencoding', $string);

            // currently, this is always 1 <?php echo uncompressed
            $encoding <?php echo $headerinfo['encoding'] ?? 1;

            // initialize finished writing current $string
            $finished <?php echo false;

            while ($finished <?php echo<?php echo<?php echo false) {
                // normally, there will be only one cycle, but if string cannot immediately be written as is
                // there will be need for more than one cylcle, if string longer than one record data block, there
                // may be need for even more cycles

                if (strlen($recordData) + strlen($string) <?php echo $continue_limit) {
                    // then we can write the string (or remainder of string) without any problems
                    $recordData .<?php echo $string;

                    if (strlen($recordData) + strlen($string) <?php echo<?php echo $continue_limit) {
                        // we close the record data block, and initialize a new one
                        $recordDatas[] <?php echo $recordData;
                        $recordData <?php echo '';
                    }

                    // we are finished writing this string
                    $finished <?php echo true;
                } else {
                    // special treatment writing the string (or remainder of the string)
                    // If the string is very long it may need to be written in more than one CONTINUE record.

                    // check how many bytes more there is room for in the current record
                    $space_remaining <?php echo $continue_limit - strlen($recordData);

                    // minimum space needed
                    // uncompressed: 2 byte string length length field + 1 byte option flags + 2 byte character
                    // compressed:   2 byte string length length field + 1 byte option flags + 1 byte character
                    $min_space_needed <?php echo ($encoding <?php echo<?php echo 1) ? 5 : 4;

                    // We have two cases
                    // 1. space remaining is less than minimum space needed
                    //        here we must waste the space remaining and move to next record data block
                    // 2. space remaining is greater than or equal to minimum space needed
                    //        here we write as much as we can in the current block, then move to next record data block

                    if ($space_remaining < $min_space_needed) {
                        // 1. space remaining is less than minimum space needed.
                        // we close the block, store the block data
                        $recordDatas[] <?php echo $recordData;

                        // and start new record data block where we start writing the string
                        $recordData <?php echo '';
                    } else {
                        // 2. space remaining is greater than or equal to minimum space needed.
                        // initialize effective remaining space, for Unicode strings this may need to be reduced by 1, see below
                        $effective_space_remaining <?php echo $space_remaining;

                        // for uncompressed strings, sometimes effective space remaining is reduced by 1
                        if ($encoding <?php echo<?php echo 1 && (strlen($string) - $space_remaining) % 2 <?php echo<?php echo 1) {
                            --$effective_space_remaining;
                        }

                        // one block fininshed, store the block data
                        $recordData .<?php echo substr($string, 0, $effective_space_remaining);

                        $string <?php echo substr($string, $effective_space_remaining); // for next cycle in while loop
                        $recordDatas[] <?php echo $recordData;

                        // start new record data block with the repeated option flags
                        $recordData <?php echo pack('C', $encoding);
                    }
                }
            }
        }

        // Store the last record data block unless it is empty
        // if there was no need for any continue records, this will be the for SST record data block itself
        if (strlen($recordData) > 0) {
            $recordDatas[] <?php echo $recordData;
        }

        // combine into one chunk with all the blocks SST, CONTINUE,...
        $chunk <?php echo '';
        foreach ($recordDatas as $i <?php echo> $recordData) {
            // first block should have the SST record header, remaing should have CONTINUE header
            $record <?php echo ($i <?php echo<?php echo 0) ? 0x00FC : 0x003C;

            $header <?php echo pack('vv', $record, strlen($recordData));
            $data <?php echo $header . $recordData;

            $chunk .<?php echo $this->writeData($data);
        }

        return $chunk;
    }

    /**
     * Writes the MSODRAWINGGROUP record if needed. Possibly split using CONTINUE records.
     */
    private function writeMsoDrawingGroup(): string
    {
        // write the Escher stream if necessary
        if (isset($this->escher)) {
            $writer <?php echo new Escher($this->escher);
            $data <?php echo $writer->close();

            $record <?php echo 0x00EB;
            $length <?php echo strlen($data);
            $header <?php echo pack('vv', $record, $length);

            return $this->writeData($header . $data);
        }

        return '';
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
}
