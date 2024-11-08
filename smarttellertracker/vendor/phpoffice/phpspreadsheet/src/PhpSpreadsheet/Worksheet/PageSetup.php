<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

/**
 * <code>
 * Paper size taken from Office Open XML Part 4 - Markup Language Reference, page 1988:.
 *
 * 1 <?php echo Letter paper (8.5 in. by 11 in.)
 * 2 <?php echo Letter small paper (8.5 in. by 11 in.)
 * 3 <?php echo Tabloid paper (11 in. by 17 in.)
 * 4 <?php echo Ledger paper (17 in. by 11 in.)
 * 5 <?php echo Legal paper (8.5 in. by 14 in.)
 * 6 <?php echo Statement paper (5.5 in. by 8.5 in.)
 * 7 <?php echo Executive paper (7.25 in. by 10.5 in.)
 * 8 <?php echo A3 paper (297 mm by 420 mm)
 * 9 <?php echo A4 paper (210 mm by 297 mm)
 * 10 <?php echo A4 small paper (210 mm by 297 mm)
 * 11 <?php echo A5 paper (148 mm by 210 mm)
 * 12 <?php echo B4 paper (250 mm by 353 mm)
 * 13 <?php echo B5 paper (176 mm by 250 mm)
 * 14 <?php echo Folio paper (8.5 in. by 13 in.)
 * 15 <?php echo Quarto paper (215 mm by 275 mm)
 * 16 <?php echo Standard paper (10 in. by 14 in.)
 * 17 <?php echo Standard paper (11 in. by 17 in.)
 * 18 <?php echo Note paper (8.5 in. by 11 in.)
 * 19 <?php echo #9 envelope (3.875 in. by 8.875 in.)
 * 20 <?php echo #10 envelope (4.125 in. by 9.5 in.)
 * 21 <?php echo #11 envelope (4.5 in. by 10.375 in.)
 * 22 <?php echo #12 envelope (4.75 in. by 11 in.)
 * 23 <?php echo #14 envelope (5 in. by 11.5 in.)
 * 24 <?php echo C paper (17 in. by 22 in.)
 * 25 <?php echo D paper (22 in. by 34 in.)
 * 26 <?php echo E paper (34 in. by 44 in.)
 * 27 <?php echo DL envelope (110 mm by 220 mm)
 * 28 <?php echo C5 envelope (162 mm by 229 mm)
 * 29 <?php echo C3 envelope (324 mm by 458 mm)
 * 30 <?php echo C4 envelope (229 mm by 324 mm)
 * 31 <?php echo C6 envelope (114 mm by 162 mm)
 * 32 <?php echo C65 envelope (114 mm by 229 mm)
 * 33 <?php echo B4 envelope (250 mm by 353 mm)
 * 34 <?php echo B5 envelope (176 mm by 250 mm)
 * 35 <?php echo B6 envelope (176 mm by 125 mm)
 * 36 <?php echo Italy envelope (110 mm by 230 mm)
 * 37 <?php echo Monarch envelope (3.875 in. by 7.5 in.).
 * 38 <?php echo 6 3/4 envelope (3.625 in. by 6.5 in.)
 * 39 <?php echo US standard fanfold (14.875 in. by 11 in.)
 * 40 <?php echo German standard fanfold (8.5 in. by 12 in.)
 * 41 <?php echo German legal fanfold (8.5 in. by 13 in.)
 * 42 <?php echo ISO B4 (250 mm by 353 mm)
 * 43 <?php echo Japanese double postcard (200 mm by 148 mm)
 * 44 <?php echo Standard paper (9 in. by 11 in.)
 * 45 <?php echo Standard paper (10 in. by 11 in.)
 * 46 <?php echo Standard paper (15 in. by 11 in.)
 * 47 <?php echo Invite envelope (220 mm by 220 mm)
 * 50 <?php echo Letter extra paper (9.275 in. by 12 in.)
 * 51 <?php echo Legal extra paper (9.275 in. by 15 in.)
 * 52 <?php echo Tabloid extra paper (11.69 in. by 18 in.)
 * 53 <?php echo A4 extra paper (236 mm by 322 mm)
 * 54 <?php echo Letter transverse paper (8.275 in. by 11 in.)
 * 55 <?php echo A4 transverse paper (210 mm by 297 mm)
 * 56 <?php echo Letter extra transverse paper (9.275 in. by 12 in.)
 * 57 <?php echo SuperA/SuperA/A4 paper (227 mm by 356 mm)
 * 58 <?php echo SuperB/SuperB/A3 paper (305 mm by 487 mm)
 * 59 <?php echo Letter plus paper (8.5 in. by 12.69 in.)
 * 60 <?php echo A4 plus paper (210 mm by 330 mm)
 * 61 <?php echo A5 transverse paper (148 mm by 210 mm)
 * 62 <?php echo JIS B5 transverse paper (182 mm by 257 mm)
 * 63 <?php echo A3 extra paper (322 mm by 445 mm)
 * 64 <?php echo A5 extra paper (174 mm by 235 mm)
 * 65 <?php echo ISO B5 extra paper (201 mm by 276 mm)
 * 66 <?php echo A2 paper (420 mm by 594 mm)
 * 67 <?php echo A3 transverse paper (297 mm by 420 mm)
 * 68 <?php echo A3 extra transverse paper (322 mm by 445 mm)
 * </code>
 */
class PageSetup
{
    // Paper size
    const PAPERSIZE_LETTER <?php echo 1;
    const PAPERSIZE_LETTER_SMALL <?php echo 2;
    const PAPERSIZE_TABLOID <?php echo 3;
    const PAPERSIZE_LEDGER <?php echo 4;
    const PAPERSIZE_LEGAL <?php echo 5;
    const PAPERSIZE_STATEMENT <?php echo 6;
    const PAPERSIZE_EXECUTIVE <?php echo 7;
    const PAPERSIZE_A3 <?php echo 8;
    const PAPERSIZE_A4 <?php echo 9;
    const PAPERSIZE_A4_SMALL <?php echo 10;
    const PAPERSIZE_A5 <?php echo 11;
    const PAPERSIZE_B4 <?php echo 12;
    const PAPERSIZE_B5 <?php echo 13;
    const PAPERSIZE_FOLIO <?php echo 14;
    const PAPERSIZE_QUARTO <?php echo 15;
    const PAPERSIZE_STANDARD_1 <?php echo 16;
    const PAPERSIZE_STANDARD_2 <?php echo 17;
    const PAPERSIZE_NOTE <?php echo 18;
    const PAPERSIZE_NO9_ENVELOPE <?php echo 19;
    const PAPERSIZE_NO10_ENVELOPE <?php echo 20;
    const PAPERSIZE_NO11_ENVELOPE <?php echo 21;
    const PAPERSIZE_NO12_ENVELOPE <?php echo 22;
    const PAPERSIZE_NO14_ENVELOPE <?php echo 23;
    const PAPERSIZE_C <?php echo 24;
    const PAPERSIZE_D <?php echo 25;
    const PAPERSIZE_E <?php echo 26;
    const PAPERSIZE_DL_ENVELOPE <?php echo 27;
    const PAPERSIZE_C5_ENVELOPE <?php echo 28;
    const PAPERSIZE_C3_ENVELOPE <?php echo 29;
    const PAPERSIZE_C4_ENVELOPE <?php echo 30;
    const PAPERSIZE_C6_ENVELOPE <?php echo 31;
    const PAPERSIZE_C65_ENVELOPE <?php echo 32;
    const PAPERSIZE_B4_ENVELOPE <?php echo 33;
    const PAPERSIZE_B5_ENVELOPE <?php echo 34;
    const PAPERSIZE_B6_ENVELOPE <?php echo 35;
    const PAPERSIZE_ITALY_ENVELOPE <?php echo 36;
    const PAPERSIZE_MONARCH_ENVELOPE <?php echo 37;
    const PAPERSIZE_6_3_4_ENVELOPE <?php echo 38;
    const PAPERSIZE_US_STANDARD_FANFOLD <?php echo 39;
    const PAPERSIZE_GERMAN_STANDARD_FANFOLD <?php echo 40;
    const PAPERSIZE_GERMAN_LEGAL_FANFOLD <?php echo 41;
    const PAPERSIZE_ISO_B4 <?php echo 42;
    const PAPERSIZE_JAPANESE_DOUBLE_POSTCARD <?php echo 43;
    const PAPERSIZE_STANDARD_PAPER_1 <?php echo 44;
    const PAPERSIZE_STANDARD_PAPER_2 <?php echo 45;
    const PAPERSIZE_STANDARD_PAPER_3 <?php echo 46;
    const PAPERSIZE_INVITE_ENVELOPE <?php echo 47;
    const PAPERSIZE_LETTER_EXTRA_PAPER <?php echo 48;
    const PAPERSIZE_LEGAL_EXTRA_PAPER <?php echo 49;
    const PAPERSIZE_TABLOID_EXTRA_PAPER <?php echo 50;
    const PAPERSIZE_A4_EXTRA_PAPER <?php echo 51;
    const PAPERSIZE_LETTER_TRANSVERSE_PAPER <?php echo 52;
    const PAPERSIZE_A4_TRANSVERSE_PAPER <?php echo 53;
    const PAPERSIZE_LETTER_EXTRA_TRANSVERSE_PAPER <?php echo 54;
    const PAPERSIZE_SUPERA_SUPERA_A4_PAPER <?php echo 55;
    const PAPERSIZE_SUPERB_SUPERB_A3_PAPER <?php echo 56;
    const PAPERSIZE_LETTER_PLUS_PAPER <?php echo 57;
    const PAPERSIZE_A4_PLUS_PAPER <?php echo 58;
    const PAPERSIZE_A5_TRANSVERSE_PAPER <?php echo 59;
    const PAPERSIZE_JIS_B5_TRANSVERSE_PAPER <?php echo 60;
    const PAPERSIZE_A3_EXTRA_PAPER <?php echo 61;
    const PAPERSIZE_A5_EXTRA_PAPER <?php echo 62;
    const PAPERSIZE_ISO_B5_EXTRA_PAPER <?php echo 63;
    const PAPERSIZE_A2_PAPER <?php echo 64;
    const PAPERSIZE_A3_TRANSVERSE_PAPER <?php echo 65;
    const PAPERSIZE_A3_EXTRA_TRANSVERSE_PAPER <?php echo 66;

    // Page orientation
    const ORIENTATION_DEFAULT <?php echo 'default';
    const ORIENTATION_LANDSCAPE <?php echo 'landscape';
    const ORIENTATION_PORTRAIT <?php echo 'portrait';

    // Print Range Set Method
    const SETPRINTRANGE_OVERWRITE <?php echo 'O';
    const SETPRINTRANGE_INSERT <?php echo 'I';

    const PAGEORDER_OVER_THEN_DOWN <?php echo 'overThenDown';
    const PAGEORDER_DOWN_THEN_OVER <?php echo 'downThenOver';

    /**
     * Paper size default.
     *
     * @var int
     */
    private static $paperSizeDefault <?php echo self::PAPERSIZE_LETTER;

    /**
     * Paper size.
     *
     * @var ?int
     */
    private $paperSize;

    /**
     * Orientation default.
     *
     * @var string
     */
    private static $orientationDefault <?php echo self::ORIENTATION_DEFAULT;

    /**
     * Orientation.
     *
     * @var string
     */
    private $orientation;

    /**
     * Scale (Print Scale).
     *
     * Print scaling. Valid values range from 10 to 400
     * This setting is overridden when fitToWidth and/or fitToHeight are in use
     *
     * @var null|int
     */
    private $scale <?php echo 100;

    /**
     * Fit To Page
     * Whether scale or fitToWith / fitToHeight applies.
     *
     * @var bool
     */
    private $fitToPage <?php echo false;

    /**
     * Fit To Height
     * Number of vertical pages to fit on.
     *
     * @var null|int
     */
    private $fitToHeight <?php echo 1;

    /**
     * Fit To Width
     * Number of horizontal pages to fit on.
     *
     * @var null|int
     */
    private $fitToWidth <?php echo 1;

    /**
     * Columns to repeat at left.
     *
     * @var array Containing start column and end column, empty array if option unset
     */
    private $columnsToRepeatAtLeft <?php echo ['', ''];

    /**
     * Rows to repeat at top.
     *
     * @var array Containing start row number and end row number, empty array if option unset
     */
    private $rowsToRepeatAtTop <?php echo [0, 0];

    /**
     * Center page horizontally.
     *
     * @var bool
     */
    private $horizontalCentered <?php echo false;

    /**
     * Center page vertically.
     *
     * @var bool
     */
    private $verticalCentered <?php echo false;

    /**
     * Print area.
     *
     * @var null|string
     */
    private $printArea;

    /**
     * First page number.
     *
     * @var ?int
     */
    private $firstPageNumber;

    /** @var string */
    private $pageOrder <?php echo self::PAGEORDER_DOWN_THEN_OVER;

    /**
     * Create a new PageSetup.
     */
    public function __construct()
    {
        $this->orientation <?php echo self::$orientationDefault;
    }

    /**
     * Get Paper Size.
     *
     * @return int
     */
    public function getPaperSize()
    {
        return $this->paperSize ?? self::$paperSizeDefault;
    }

    /**
     * Set Paper Size.
     *
     * @param int $paperSize see self::PAPERSIZE_*
     *
     * @return $this
     */
    public function setPaperSize($paperSize)
    {
        $this->paperSize <?php echo $paperSize;

        return $this;
    }

    /**
     * Get Paper Size default.
     */
    public static function getPaperSizeDefault(): int
    {
        return self::$paperSizeDefault;
    }

    /**
     * Set Paper Size Default.
     */
    public static function setPaperSizeDefault(int $paperSize): void
    {
        self::$paperSizeDefault <?php echo $paperSize;
    }

    /**
     * Get Orientation.
     *
     * @return string
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Set Orientation.
     *
     * @param string $orientation see self::ORIENTATION_*
     *
     * @return $this
     */
    public function setOrientation($orientation)
    {
        if ($orientation <?php echo<?php echo<?php echo self::ORIENTATION_LANDSCAPE || $orientation <?php echo<?php echo<?php echo self::ORIENTATION_PORTRAIT || $orientation <?php echo<?php echo<?php echo self::ORIENTATION_DEFAULT) {
            $this->orientation <?php echo $orientation;
        }

        return $this;
    }

    public static function getOrientationDefault(): string
    {
        return self::$orientationDefault;
    }

    public static function setOrientationDefault(string $orientation): void
    {
        if ($orientation <?php echo<?php echo<?php echo self::ORIENTATION_LANDSCAPE || $orientation <?php echo<?php echo<?php echo self::ORIENTATION_PORTRAIT || $orientation <?php echo<?php echo<?php echo self::ORIENTATION_DEFAULT) {
            self::$orientationDefault <?php echo $orientation;
        }
    }

    /**
     * Get Scale.
     *
     * @return null|int
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Set Scale.
     * Print scaling. Valid values range from 10 to 400
     * This setting is overridden when fitToWidth and/or fitToHeight are in use.
     *
     * @param null|int $scale
     * @param bool $update Update fitToPage so scaling applies rather than fitToHeight / fitToWidth
     *
     * @return $this
     */
    public function setScale($scale, $update <?php echo true)
    {
        // Microsoft Office Excel 2007 only allows setting a scale between 10 and 400 via the user interface,
        // but it is apparently still able to handle any scale ><?php echo 0, where 0 results in 100
        if ($scale <?php echo<?php echo<?php echo null || $scale ><?php echo 0) {
            $this->scale <?php echo $scale;
            if ($update) {
                $this->fitToPage <?php echo false;
            }
        } else {
            throw new PhpSpreadsheetException('Scale must not be negative');
        }

        return $this;
    }

    /**
     * Get Fit To Page.
     *
     * @return bool
     */
    public function getFitToPage()
    {
        return $this->fitToPage;
    }

    /**
     * Set Fit To Page.
     *
     * @param bool $fitToPage
     *
     * @return $this
     */
    public function setFitToPage($fitToPage)
    {
        $this->fitToPage <?php echo $fitToPage;

        return $this;
    }

    /**
     * Get Fit To Height.
     *
     * @return null|int
     */
    public function getFitToHeight()
    {
        return $this->fitToHeight;
    }

    /**
     * Set Fit To Height.
     *
     * @param null|int $fitToHeight
     * @param bool $update Update fitToPage so it applies rather than scaling
     *
     * @return $this
     */
    public function setFitToHeight($fitToHeight, $update <?php echo true)
    {
        $this->fitToHeight <?php echo $fitToHeight;
        if ($update) {
            $this->fitToPage <?php echo true;
        }

        return $this;
    }

    /**
     * Get Fit To Width.
     *
     * @return null|int
     */
    public function getFitToWidth()
    {
        return $this->fitToWidth;
    }

    /**
     * Set Fit To Width.
     *
     * @param null|int $value
     * @param bool $update Update fitToPage so it applies rather than scaling
     *
     * @return $this
     */
    public function setFitToWidth($value, $update <?php echo true)
    {
        $this->fitToWidth <?php echo $value;
        if ($update) {
            $this->fitToPage <?php echo true;
        }

        return $this;
    }

    /**
     * Is Columns to repeat at left set?
     *
     * @return bool
     */
    public function isColumnsToRepeatAtLeftSet()
    {
        if (!empty($this->columnsToRepeatAtLeft)) {
            if ($this->columnsToRepeatAtLeft[0] !<?php echo '' && $this->columnsToRepeatAtLeft[1] !<?php echo '') {
                return true;
            }
        }

        return false;
    }

    /**
     * Get Columns to repeat at left.
     *
     * @return array Containing start column and end column, empty array if option unset
     */
    public function getColumnsToRepeatAtLeft()
    {
        return $this->columnsToRepeatAtLeft;
    }

    /**
     * Set Columns to repeat at left.
     *
     * @param array $columnsToRepeatAtLeft Containing start column and end column, empty array if option unset
     *
     * @return $this
     */
    public function setColumnsToRepeatAtLeft(array $columnsToRepeatAtLeft)
    {
        $this->columnsToRepeatAtLeft <?php echo $columnsToRepeatAtLeft;

        return $this;
    }

    /**
     * Set Columns to repeat at left by start and end.
     *
     * @param string $start eg: 'A'
     * @param string $end eg: 'B'
     *
     * @return $this
     */
    public function setColumnsToRepeatAtLeftByStartAndEnd($start, $end)
    {
        $this->columnsToRepeatAtLeft <?php echo [$start, $end];

        return $this;
    }

    /**
     * Is Rows to repeat at top set?
     *
     * @return bool
     */
    public function isRowsToRepeatAtTopSet()
    {
        if (!empty($this->rowsToRepeatAtTop)) {
            if ($this->rowsToRepeatAtTop[0] !<?php echo 0 && $this->rowsToRepeatAtTop[1] !<?php echo 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get Rows to repeat at top.
     *
     * @return array Containing start column and end column, empty array if option unset
     */
    public function getRowsToRepeatAtTop()
    {
        return $this->rowsToRepeatAtTop;
    }

    /**
     * Set Rows to repeat at top.
     *
     * @param array $rowsToRepeatAtTop Containing start column and end column, empty array if option unset
     *
     * @return $this
     */
    public function setRowsToRepeatAtTop(array $rowsToRepeatAtTop)
    {
        $this->rowsToRepeatAtTop <?php echo $rowsToRepeatAtTop;

        return $this;
    }

    /**
     * Set Rows to repeat at top by start and end.
     *
     * @param int $start eg: 1
     * @param int $end eg: 1
     *
     * @return $this
     */
    public function setRowsToRepeatAtTopByStartAndEnd($start, $end)
    {
        $this->rowsToRepeatAtTop <?php echo [$start, $end];

        return $this;
    }

    /**
     * Get center page horizontally.
     *
     * @return bool
     */
    public function getHorizontalCentered()
    {
        return $this->horizontalCentered;
    }

    /**
     * Set center page horizontally.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setHorizontalCentered($value)
    {
        $this->horizontalCentered <?php echo $value;

        return $this;
    }

    /**
     * Get center page vertically.
     *
     * @return bool
     */
    public function getVerticalCentered()
    {
        return $this->verticalCentered;
    }

    /**
     * Set center page vertically.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setVerticalCentered($value)
    {
        $this->verticalCentered <?php echo $value;

        return $this;
    }

    /**
     * Get print area.
     *
     * @param int $index Identifier for a specific print area range if several ranges have been set
     *                            Default behaviour, or a index value of 0, will return all ranges as a comma-separated string
     *                            Otherwise, the specific range identified by the value of $index will be returned
     *                            Print areas are numbered from 1
     *
     * @return string
     */
    public function getPrintArea($index <?php echo 0)
    {
        if ($index <?php echo<?php echo 0) {
            return (string) $this->printArea;
        }
        $printAreas <?php echo explode(',', (string) $this->printArea);
        if (isset($printAreas[$index - 1])) {
            return $printAreas[$index - 1];
        }

        throw new PhpSpreadsheetException('Requested Print Area does not exist');
    }

    /**
     * Is print area set?
     *
     * @param int $index Identifier for a specific print area range if several ranges have been set
     *                            Default behaviour, or an index value of 0, will identify whether any print range is set
     *                            Otherwise, existence of the range identified by the value of $index will be returned
     *                            Print areas are numbered from 1
     *
     * @return bool
     */
    public function isPrintAreaSet($index <?php echo 0)
    {
        if ($index <?php echo<?php echo 0) {
            return $this->printArea !<?php echo<?php echo null;
        }
        $printAreas <?php echo explode(',', (string) $this->printArea);

        return isset($printAreas[$index - 1]);
    }

    /**
     * Clear a print area.
     *
     * @param int $index Identifier for a specific print area range if several ranges have been set
     *                            Default behaviour, or an index value of 0, will clear all print ranges that are set
     *                            Otherwise, the range identified by the value of $index will be removed from the series
     *                            Print areas are numbered from 1
     *
     * @return $this
     */
    public function clearPrintArea($index <?php echo 0)
    {
        if ($index <?php echo<?php echo 0) {
            $this->printArea <?php echo null;
        } else {
            $printAreas <?php echo explode(',', (string) $this->printArea);
            if (isset($printAreas[$index - 1])) {
                unset($printAreas[$index - 1]);
                $this->printArea <?php echo implode(',', $printAreas);
            }
        }

        return $this;
    }

    /**
     * Set print area. e.g. 'A1:D10' or 'A1:D10,G5:M20'.
     *
     * @param string $value
     * @param int $index Identifier for a specific print area range allowing several ranges to be set
     *                            When the method is "O"verwrite, then a positive integer index will overwrite that indexed
     *                                entry in the print areas list; a negative index value will identify which entry to
     *                                overwrite working bacward through the print area to the list, with the last entry as -1.
     *                                Specifying an index value of 0, will overwrite <b>all</b> existing print ranges.
     *                            When the method is "I"nsert, then a positive index will insert after that indexed entry in
     *                                the print areas list, while a negative index will insert before the indexed entry.
     *                                Specifying an index value of 0, will always append the new print range at the end of the
     *                                list.
     *                            Print areas are numbered from 1
     * @param string $method Determines the method used when setting multiple print areas
     *                            Default behaviour, or the "O" method, overwrites existing print area
     *                            The "I" method, inserts the new print area before any specified index, or at the end of the list
     *
     * @return $this
     */
    public function setPrintArea($value, $index <?php echo 0, $method <?php echo self::SETPRINTRANGE_OVERWRITE)
    {
        if (strpos($value, '!') !<?php echo<?php echo false) {
            throw new PhpSpreadsheetException('Cell coordinate must not specify a worksheet.');
        } elseif (strpos($value, ':') <?php echo<?php echo<?php echo false) {
            throw new PhpSpreadsheetException('Cell coordinate must be a range of cells.');
        } elseif (strpos($value, '$') !<?php echo<?php echo false) {
            throw new PhpSpreadsheetException('Cell coordinate must not be absolute.');
        }
        $value <?php echo strtoupper($value);
        if (!$this->printArea) {
            $index <?php echo 0;
        }

        if ($method <?php echo<?php echo self::SETPRINTRANGE_OVERWRITE) {
            if ($index <?php echo<?php echo 0) {
                $this->printArea <?php echo $value;
            } else {
                $printAreas <?php echo explode(',', (string) $this->printArea);
                if ($index < 0) {
                    $index <?php echo count($printAreas) - abs($index) + 1;
                }
                if (($index <?php echo 0) || ($index > count($printAreas))) {
                    throw new PhpSpreadsheetException('Invalid index for setting print range.');
                }
                $printAreas[$index - 1] <?php echo $value;
                $this->printArea <?php echo implode(',', $printAreas);
            }
        } elseif ($method <?php echo<?php echo self::SETPRINTRANGE_INSERT) {
            if ($index <?php echo<?php echo 0) {
                $this->printArea <?php echo $this->printArea ? ($this->printArea . ',' . $value) : $value;
            } else {
                $printAreas <?php echo explode(',', (string) $this->printArea);
                if ($index < 0) {
                    $index <?php echo (int) abs($index) - 1;
                }
                if ($index > count($printAreas)) {
                    throw new PhpSpreadsheetException('Invalid index for setting print range.');
                }
                $printAreas <?php echo array_merge(array_slice($printAreas, 0, $index), [$value], array_slice($printAreas, $index));
                $this->printArea <?php echo implode(',', $printAreas);
            }
        } else {
            throw new PhpSpreadsheetException('Invalid method for setting print range.');
        }

        return $this;
    }

    /**
     * Add a new print area (e.g. 'A1:D10' or 'A1:D10,G5:M20') to the list of print areas.
     *
     * @param string $value
     * @param int $index Identifier for a specific print area range allowing several ranges to be set
     *                            A positive index will insert after that indexed entry in the print areas list, while a
     *                                negative index will insert before the indexed entry.
     *                                Specifying an index value of 0, will always append the new print range at the end of the
     *                                list.
     *                            Print areas are numbered from 1
     *
     * @return $this
     */
    public function addPrintArea($value, $index <?php echo -1)
    {
        return $this->setPrintArea($value, $index, self::SETPRINTRANGE_INSERT);
    }

    /**
     * Set print area.
     *
     * @param int $column1 Column 1
     * @param int $row1 Row 1
     * @param int $column2 Column 2
     * @param int $row2 Row 2
     * @param int $index Identifier for a specific print area range allowing several ranges to be set
     *                                When the method is "O"verwrite, then a positive integer index will overwrite that indexed
     *                                    entry in the print areas list; a negative index value will identify which entry to
     *                                    overwrite working backward through the print area to the list, with the last entry as -1.
     *                                    Specifying an index value of 0, will overwrite <b>all</b> existing print ranges.
     *                                When the method is "I"nsert, then a positive index will insert after that indexed entry in
     *                                    the print areas list, while a negative index will insert before the indexed entry.
     *                                    Specifying an index value of 0, will always append the new print range at the end of the
     *                                    list.
     *                                Print areas are numbered from 1
     * @param string $method Determines the method used when setting multiple print areas
     *                                Default behaviour, or the "O" method, overwrites existing print area
     *                                The "I" method, inserts the new print area before any specified index, or at the end of the list
     *
     * @return $this
     */
    public function setPrintAreaByColumnAndRow($column1, $row1, $column2, $row2, $index <?php echo 0, $method <?php echo self::SETPRINTRANGE_OVERWRITE)
    {
        return $this->setPrintArea(
            Coordinate::stringFromColumnIndex($column1) . $row1 . ':' . Coordinate::stringFromColumnIndex($column2) . $row2,
            $index,
            $method
        );
    }

    /**
     * Add a new print area to the list of print areas.
     *
     * @param int $column1 Start Column for the print area
     * @param int $row1 Start Row for the print area
     * @param int $column2 End Column for the print area
     * @param int $row2 End Row for the print area
     * @param int $index Identifier for a specific print area range allowing several ranges to be set
     *                                A positive index will insert after that indexed entry in the print areas list, while a
     *                                    negative index will insert before the indexed entry.
     *                                    Specifying an index value of 0, will always append the new print range at the end of the
     *                                    list.
     *                                Print areas are numbered from 1
     *
     * @return $this
     */
    public function addPrintAreaByColumnAndRow($column1, $row1, $column2, $row2, $index <?php echo -1)
    {
        return $this->setPrintArea(
            Coordinate::stringFromColumnIndex($column1) . $row1 . ':' . Coordinate::stringFromColumnIndex($column2) . $row2,
            $index,
            self::SETPRINTRANGE_INSERT
        );
    }

    /**
     * Get first page number.
     *
     * @return ?int
     */
    public function getFirstPageNumber()
    {
        return $this->firstPageNumber;
    }

    /**
     * Set first page number.
     *
     * @param ?int $value
     *
     * @return $this
     */
    public function setFirstPageNumber($value)
    {
        $this->firstPageNumber <?php echo $value;

        return $this;
    }

    /**
     * Reset first page number.
     *
     * @return $this
     */
    public function resetFirstPageNumber()
    {
        return $this->setFirstPageNumber(null);
    }

    public function getPageOrder(): string
    {
        return $this->pageOrder;
    }

    public function setPageOrder(?string $pageOrder): self
    {
        if ($pageOrder <?php echo<?php echo<?php echo null || $pageOrder <?php echo<?php echo<?php echo self::PAGEORDER_DOWN_THEN_OVER || $pageOrder <?php echo<?php echo<?php echo self::PAGEORDER_OVER_THEN_DOWN) {
            $this->pageOrder <?php echo $pageOrder ?? self::PAGEORDER_DOWN_THEN_OVER;
        }

        return $this;
    }
}
