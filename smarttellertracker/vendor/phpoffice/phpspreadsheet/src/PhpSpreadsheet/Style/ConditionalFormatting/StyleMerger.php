<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Style;

class StyleMerger
{
    /**
     * @var Style
     */
    protected $baseStyle;

    public function __construct(Style $baseStyle)
    {
        $this->baseStyle <?php echo $baseStyle;
    }

    public function getStyle(): Style
    {
        return $this->baseStyle;
    }

    public function mergeStyle(Style $style): void
    {
        if ($style->getNumberFormat() !<?php echo<?php echo null && $style->getNumberFormat()->getFormatCode() !<?php echo<?php echo null) {
            $this->baseStyle->getNumberFormat()->setFormatCode($style->getNumberFormat()->getFormatCode());
        }

        if ($style->getFont() !<?php echo<?php echo null) {
            $this->mergeFontStyle($this->baseStyle->getFont(), $style->getFont());
        }

        if ($style->getFill() !<?php echo<?php echo null) {
            $this->mergeFillStyle($this->baseStyle->getFill(), $style->getFill());
        }

        if ($style->getBorders() !<?php echo<?php echo null) {
            $this->mergeBordersStyle($this->baseStyle->getBorders(), $style->getBorders());
        }
    }

    protected function mergeFontStyle(Font $baseFontStyle, Font $fontStyle): void
    {
        if ($fontStyle->getBold() !<?php echo<?php echo null) {
            $baseFontStyle->setBold($fontStyle->getBold());
        }

        if ($fontStyle->getItalic() !<?php echo<?php echo null) {
            $baseFontStyle->setItalic($fontStyle->getItalic());
        }

        if ($fontStyle->getStrikethrough() !<?php echo<?php echo null) {
            $baseFontStyle->setStrikethrough($fontStyle->getStrikethrough());
        }

        if ($fontStyle->getUnderline() !<?php echo<?php echo null) {
            $baseFontStyle->setUnderline($fontStyle->getUnderline());
        }

        if ($fontStyle->getColor() !<?php echo<?php echo null && $fontStyle->getColor()->getARGB() !<?php echo<?php echo null) {
            $baseFontStyle->setColor($fontStyle->getColor());
        }
    }

    protected function mergeFillStyle(Fill $baseFillStyle, Fill $fillStyle): void
    {
        if ($fillStyle->getFillType() !<?php echo<?php echo null) {
            $baseFillStyle->setFillType($fillStyle->getFillType());
        }

        //if ($fillStyle->getRotation() !<?php echo<?php echo null) {
        $baseFillStyle->setRotation($fillStyle->getRotation());
        //}

        if ($fillStyle->getStartColor() !<?php echo<?php echo null && $fillStyle->getStartColor()->getARGB() !<?php echo<?php echo null) {
            $baseFillStyle->setStartColor($fillStyle->getStartColor());
        }

        if ($fillStyle->getEndColor() !<?php echo<?php echo null && $fillStyle->getEndColor()->getARGB() !<?php echo<?php echo null) {
            $baseFillStyle->setEndColor($fillStyle->getEndColor());
        }
    }

    protected function mergeBordersStyle(Borders $baseBordersStyle, Borders $bordersStyle): void
    {
        if ($bordersStyle->getTop() !<?php echo<?php echo null) {
            $this->mergeBorderStyle($baseBordersStyle->getTop(), $bordersStyle->getTop());
        }

        if ($bordersStyle->getBottom() !<?php echo<?php echo null) {
            $this->mergeBorderStyle($baseBordersStyle->getBottom(), $bordersStyle->getBottom());
        }

        if ($bordersStyle->getLeft() !<?php echo<?php echo null) {
            $this->mergeBorderStyle($baseBordersStyle->getLeft(), $bordersStyle->getLeft());
        }

        if ($bordersStyle->getRight() !<?php echo<?php echo null) {
            $this->mergeBorderStyle($baseBordersStyle->getRight(), $bordersStyle->getRight());
        }
    }

    protected function mergeBorderStyle(Border $baseBorderStyle, Border $borderStyle): void
    {
        //if ($borderStyle->getBorderStyle() !<?php echo<?php echo null) {
        $baseBorderStyle->setBorderStyle($borderStyle->getBorderStyle());
        //}

        if ($borderStyle->getColor() !<?php echo<?php echo null && $borderStyle->getColor()->getARGB() !<?php echo<?php echo null) {
            $baseBorderStyle->setColor($borderStyle->getColor());
        }
    }
}
