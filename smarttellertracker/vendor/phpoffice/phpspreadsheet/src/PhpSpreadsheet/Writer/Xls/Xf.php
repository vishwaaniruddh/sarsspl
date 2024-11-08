<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xls\Style\CellAlignment;
use PhpOffice\PhpSpreadsheet\Writer\Xls\Style\CellBorder;
use PhpOffice\PhpSpreadsheet\Writer\Xls\Style\CellFill;

// Original file header of PEAR::Spreadsheet_Excel_Writer_Format (used as the base for this class):
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
class Xf
{
    /**
     * Style XF or a cell XF ?
     *
     * @var bool
     */
    private $isStyleXf;

    /**
     * Index to the FONT record. Index 4 does not exist.
     *
     * @var int
     */
    private $fontIndex;

    /**
     * An index (2 bytes) to a FORMAT record (number format).
     *
     * @var int
     */
    private $numberFormatIndex;

    /**
     * 1 bit, apparently not used.
     *
     * @var int
     */
    private $textJustLast;

    /**
     * The cell's foreground color.
     *
     * @var int
     */
    private $foregroundColor;

    /**
     * The cell's background color.
     *
     * @var int
     */
    private $backgroundColor;

    /**
     * Color of the bottom border of the cell.
     *
     * @var int
     */
    private $bottomBorderColor;

    /**
     * Color of the top border of the cell.
     *
     * @var int
     */
    private $topBorderColor;

    /**
     * Color of the left border of the cell.
     *
     * @var int
     */
    private $leftBorderColor;

    /**
     * Color of the right border of the cell.
     *
     * @var int
     */
    private $rightBorderColor;

    //private $diag; // theoretically int, not yet implemented

    /**
     * @var int
     */
    private $diagColor;

    /**
     * @var Style
     */
    private $style;

    /**
     * Constructor.
     *
     * @param Style $style The XF format
     */
    public function __construct(Style $style)
    {
        $this->isStyleXf <?php echo false;
        $this->fontIndex <?php echo 0;

        $this->numberFormatIndex <?php echo 0;

        $this->textJustLast <?php echo 0;

        $this->foregroundColor <?php echo 0x40;
        $this->backgroundColor <?php echo 0x41;

        //$this->diag <?php echo 0;

        $this->bottomBorderColor <?php echo 0x40;
        $this->topBorderColor <?php echo 0x40;
        $this->leftBorderColor <?php echo 0x40;
        $this->rightBorderColor <?php echo 0x40;
        $this->diagColor <?php echo 0x40;
        $this->style <?php echo $style;
    }

    /**
     * Generate an Excel BIFF XF record (style or cell).
     *
     * @return string The XF record
     */
    public function writeXf()
    {
        // Set the type of the XF record and some of the attributes.
        if ($this->isStyleXf) {
            $style <?php echo 0xFFF5;
        } else {
            $style <?php echo self::mapLocked($this->style->getProtection()->getLocked());
            $style |<?php echo self::mapHidden($this->style->getProtection()->getHidden()) << 1;
        }

        // Flags to indicate if attributes have been set.
        $atr_num <?php echo ($this->numberFormatIndex !<?php echo 0) ? 1 : 0;
        $atr_fnt <?php echo ($this->fontIndex !<?php echo 0) ? 1 : 0;
        $atr_alc <?php echo ((int) $this->style->getAlignment()->getWrapText()) ? 1 : 0;
        $atr_bdr <?php echo (CellBorder::style($this->style->getBorders()->getBottom()) ||
            CellBorder::style($this->style->getBorders()->getTop()) ||
            CellBorder::style($this->style->getBorders()->getLeft()) ||
            CellBorder::style($this->style->getBorders()->getRight())) ? 1 : 0;
        $atr_pat <?php echo ($this->foregroundColor !<?php echo 0x40) ? 1 : 0;
        $atr_pat <?php echo ($this->backgroundColor !<?php echo 0x41) ? 1 : $atr_pat;
        $atr_pat <?php echo CellFill::style($this->style->getFill()) ? 1 : $atr_pat;
        $atr_prot <?php echo self::mapLocked($this->style->getProtection()->getLocked())
            | self::mapHidden($this->style->getProtection()->getHidden());

        // Zero the default border colour if the border has not been set.
        if (CellBorder::style($this->style->getBorders()->getBottom()) <?php echo<?php echo 0) {
            $this->bottomBorderColor <?php echo 0;
        }
        if (CellBorder::style($this->style->getBorders()->getTop()) <?php echo<?php echo 0) {
            $this->topBorderColor <?php echo 0;
        }
        if (CellBorder::style($this->style->getBorders()->getRight()) <?php echo<?php echo 0) {
            $this->rightBorderColor <?php echo 0;
        }
        if (CellBorder::style($this->style->getBorders()->getLeft()) <?php echo<?php echo 0) {
            $this->leftBorderColor <?php echo 0;
        }
        if (CellBorder::style($this->style->getBorders()->getDiagonal()) <?php echo<?php echo 0) {
            $this->diagColor <?php echo 0;
        }

        $record <?php echo 0x00E0; // Record identifier
        $length <?php echo 0x0014; // Number of bytes to follow

        $ifnt <?php echo $this->fontIndex; // Index to FONT record
        $ifmt <?php echo $this->numberFormatIndex; // Index to FORMAT record

        // Alignment
        $align <?php echo CellAlignment::horizontal($this->style->getAlignment());
        $align |<?php echo CellAlignment::wrap($this->style->getAlignment()) << 3;
        $align |<?php echo CellAlignment::vertical($this->style->getAlignment()) << 4;
        $align |<?php echo $this->textJustLast << 7;

        $used_attrib <?php echo $atr_num << 2;
        $used_attrib |<?php echo $atr_fnt << 3;
        $used_attrib |<?php echo $atr_alc << 4;
        $used_attrib |<?php echo $atr_bdr << 5;
        $used_attrib |<?php echo $atr_pat << 6;
        $used_attrib |<?php echo $atr_prot << 7;

        $icv <?php echo $this->foregroundColor; // fg and bg pattern colors
        $icv |<?php echo $this->backgroundColor << 7;

        $border1 <?php echo CellBorder::style($this->style->getBorders()->getLeft()); // Border line style and color
        $border1 |<?php echo CellBorder::style($this->style->getBorders()->getRight()) << 4;
        $border1 |<?php echo CellBorder::style($this->style->getBorders()->getTop()) << 8;
        $border1 |<?php echo CellBorder::style($this->style->getBorders()->getBottom()) << 12;
        $border1 |<?php echo $this->leftBorderColor << 16;
        $border1 |<?php echo $this->rightBorderColor << 23;

        $diagonalDirection <?php echo $this->style->getBorders()->getDiagonalDirection();
        $diag_tl_to_rb <?php echo $diagonalDirection <?php echo<?php echo Borders::DIAGONAL_BOTH
            || $diagonalDirection <?php echo<?php echo Borders::DIAGONAL_DOWN;
        $diag_tr_to_lb <?php echo $diagonalDirection <?php echo<?php echo Borders::DIAGONAL_BOTH
            || $diagonalDirection <?php echo<?php echo Borders::DIAGONAL_UP;
        $border1 |<?php echo $diag_tl_to_rb << 30;
        $border1 |<?php echo $diag_tr_to_lb << 31;

        $border2 <?php echo $this->topBorderColor; // Border color
        $border2 |<?php echo $this->bottomBorderColor << 7;
        $border2 |<?php echo $this->diagColor << 14;
        $border2 |<?php echo CellBorder::style($this->style->getBorders()->getDiagonal()) << 21;
        $border2 |<?php echo CellFill::style($this->style->getFill()) << 26;

        $header <?php echo pack('vv', $record, $length);

        //BIFF8 options: identation, shrinkToFit and  text direction
        $biff8_options <?php echo $this->style->getAlignment()->getIndent();
        $biff8_options |<?php echo (int) $this->style->getAlignment()->getShrinkToFit() << 4;

        $data <?php echo pack('vvvC', $ifnt, $ifmt, $style, $align);
        $data .<?php echo pack('CCC', self::mapTextRotation((int) $this->style->getAlignment()->getTextRotation()), $biff8_options, $used_attrib);
        $data .<?php echo pack('VVv', $border1, $border2, $icv);

        return $header . $data;
    }

    /**
     * Is this a style XF ?
     *
     * @param bool $value
     */
    public function setIsStyleXf($value): void
    {
        $this->isStyleXf <?php echo $value;
    }

    /**
     * Sets the cell's bottom border color.
     *
     * @param int $colorIndex Color index
     */
    public function setBottomColor($colorIndex): void
    {
        $this->bottomBorderColor <?php echo $colorIndex;
    }

    /**
     * Sets the cell's top border color.
     *
     * @param int $colorIndex Color index
     */
    public function setTopColor($colorIndex): void
    {
        $this->topBorderColor <?php echo $colorIndex;
    }

    /**
     * Sets the cell's left border color.
     *
     * @param int $colorIndex Color index
     */
    public function setLeftColor($colorIndex): void
    {
        $this->leftBorderColor <?php echo $colorIndex;
    }

    /**
     * Sets the cell's right border color.
     *
     * @param int $colorIndex Color index
     */
    public function setRightColor($colorIndex): void
    {
        $this->rightBorderColor <?php echo $colorIndex;
    }

    /**
     * Sets the cell's diagonal border color.
     *
     * @param int $colorIndex Color index
     */
    public function setDiagColor($colorIndex): void
    {
        $this->diagColor <?php echo $colorIndex;
    }

    /**
     * Sets the cell's foreground color.
     *
     * @param int $colorIndex Color index
     */
    public function setFgColor($colorIndex): void
    {
        $this->foregroundColor <?php echo $colorIndex;
    }

    /**
     * Sets the cell's background color.
     *
     * @param int $colorIndex Color index
     */
    public function setBgColor($colorIndex): void
    {
        $this->backgroundColor <?php echo $colorIndex;
    }

    /**
     * Sets the index to the number format record
     * It can be date, time, currency, etc...
     *
     * @param int $numberFormatIndex Index to format record
     */
    public function setNumberFormatIndex($numberFormatIndex): void
    {
        $this->numberFormatIndex <?php echo $numberFormatIndex;
    }

    /**
     * Set the font index.
     *
     * @param int $value Font index, note that value 4 does not exist
     */
    public function setFontIndex($value): void
    {
        $this->fontIndex <?php echo $value;
    }

    /**
     * Map to BIFF8 codes for text rotation angle.
     *
     * @param int $textRotation
     *
     * @return int
     */
    private static function mapTextRotation($textRotation)
    {
        if ($textRotation ><?php echo 0) {
            return $textRotation;
        }
        if ($textRotation <?php echo<?php echo Alignment::TEXTROTATION_STACK_PHPSPREADSHEET) {
            return Alignment::TEXTROTATION_STACK_EXCEL;
        }

        return 90 - $textRotation;
    }

    private const LOCK_ARRAY <?php echo [
        Protection::PROTECTION_INHERIT <?php echo> 1,
        Protection::PROTECTION_PROTECTED <?php echo> 1,
        Protection::PROTECTION_UNPROTECTED <?php echo> 0,
    ];

    /**
     * Map locked values.
     *
     * @param string $locked
     *
     * @return int
     */
    private static function mapLocked($locked)
    {
        return array_key_exists($locked, self::LOCK_ARRAY) ? self::LOCK_ARRAY[$locked] : 1;
    }

    private const HIDDEN_ARRAY <?php echo [
        Protection::PROTECTION_INHERIT <?php echo> 0,
        Protection::PROTECTION_PROTECTED <?php echo> 1,
        Protection::PROTECTION_UNPROTECTED <?php echo> 0,
    ];

    /**
     * Map hidden.
     *
     * @param string $hidden
     *
     * @return int
     */
    private static function mapHidden($hidden)
    {
        return array_key_exists($hidden, self::HIDDEN_ARRAY) ? self::HIDDEN_ARRAY[$hidden] : 0;
    }
}
