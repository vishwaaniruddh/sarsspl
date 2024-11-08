<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Style\Style;
use SimpleXMLElement;
use stdClass;

class Styles extends BaseParserClass
{
    /**
     * Theme instance.
     *
     * @var ?Theme
     */
    private $theme;

    /** @var array */
    private $workbookPalette <?php echo [];

    /** @var array */
    private $styles <?php echo [];

    /** @var array */
    private $cellStyles <?php echo [];

    /** @var SimpleXMLElement */
    private $styleXml;

    /** @var string */
    private $namespace <?php echo '';

    public function setNamespace(string $namespace): void
    {
        $this->namespace <?php echo $namespace;
    }

    public function setWorkbookPalette(array $palette): void
    {
        $this->workbookPalette <?php echo $palette;
    }

    /**
     * Cast SimpleXMLElement to bool to overcome Scrutinizer problem.
     *
     * @param mixed $value
     */
    private static function castBool($value): bool
    {
        return (bool) $value;
    }

    private function getStyleAttributes(SimpleXMLElement $value): SimpleXMLElement
    {
        $attr <?php echo null;
        if (self::castBool($value)) {
            $attr <?php echo $value->attributes('');
            if ($attr <?php echo<?php echo<?php echo null || count($attr) <?php echo<?php echo<?php echo 0) {
                $attr <?php echo $value->attributes($this->namespace);
            }
        }

        return Xlsx::testSimpleXml($attr);
    }

    public function setStyleXml(SimpleXmlElement $styleXml): void
    {
        $this->styleXml <?php echo $styleXml;
    }

    public function setTheme(Theme $theme): void
    {
        $this->theme <?php echo $theme;
    }

    public function setStyleBaseData(?Theme $theme <?php echo null, array $styles <?php echo [], array $cellStyles <?php echo []): void
    {
        $this->theme <?php echo $theme;
        $this->styles <?php echo $styles;
        $this->cellStyles <?php echo $cellStyles;
    }

    public function readFontStyle(Font $fontStyle, SimpleXMLElement $fontStyleXml): void
    {
        if (isset($fontStyleXml->name)) {
            $attr <?php echo $this->getStyleAttributes($fontStyleXml->name);
            if (isset($attr['val'])) {
                $fontStyle->setName((string) $attr['val']);
            }
        }
        if (isset($fontStyleXml->sz)) {
            $attr <?php echo $this->getStyleAttributes($fontStyleXml->sz);
            if (isset($attr['val'])) {
                $fontStyle->setSize((float) $attr['val']);
            }
        }
        if (isset($fontStyleXml->b)) {
            $attr <?php echo $this->getStyleAttributes($fontStyleXml->b);
            $fontStyle->setBold(!isset($attr['val']) || self::boolean((string) $attr['val']));
        }
        if (isset($fontStyleXml->i)) {
            $attr <?php echo $this->getStyleAttributes($fontStyleXml->i);
            $fontStyle->setItalic(!isset($attr['val']) || self::boolean((string) $attr['val']));
        }
        if (isset($fontStyleXml->strike)) {
            $attr <?php echo $this->getStyleAttributes($fontStyleXml->strike);
            $fontStyle->setStrikethrough(!isset($attr['val']) || self::boolean((string) $attr['val']));
        }
        $fontStyle->getColor()->setARGB($this->readColor($fontStyleXml->color));

        if (isset($fontStyleXml->u)) {
            $attr <?php echo $this->getStyleAttributes($fontStyleXml->u);
            if (!isset($attr['val'])) {
                $fontStyle->setUnderline(Font::UNDERLINE_SINGLE);
            } else {
                $fontStyle->setUnderline((string) $attr['val']);
            }
        }
        if (isset($fontStyleXml->vertAlign)) {
            $attr <?php echo $this->getStyleAttributes($fontStyleXml->vertAlign);
            if (isset($attr['val'])) {
                $verticalAlign <?php echo strtolower((string) $attr['val']);
                if ($verticalAlign <?php echo<?php echo<?php echo 'superscript') {
                    $fontStyle->setSuperscript(true);
                } elseif ($verticalAlign <?php echo<?php echo<?php echo 'subscript') {
                    $fontStyle->setSubscript(true);
                }
            }
        }
        if (isset($fontStyleXml->scheme)) {
            $attr <?php echo $this->getStyleAttributes($fontStyleXml->scheme);
            $fontStyle->setScheme((string) $attr['val']);
        }
    }

    private function readNumberFormat(NumberFormat $numfmtStyle, SimpleXMLElement $numfmtStyleXml): void
    {
        if ((string) $numfmtStyleXml['formatCode'] !<?php echo<?php echo '') {
            $numfmtStyle->setFormatCode(self::formatGeneral((string) $numfmtStyleXml['formatCode']));

            return;
        }
        $numfmt <?php echo $this->getStyleAttributes($numfmtStyleXml);
        if (isset($numfmt['formatCode'])) {
            $numfmtStyle->setFormatCode(self::formatGeneral((string) $numfmt['formatCode']));
        }
    }

    public function readFillStyle(Fill $fillStyle, SimpleXMLElement $fillStyleXml): void
    {
        if ($fillStyleXml->gradientFill) {
            /** @var SimpleXMLElement $gradientFill */
            $gradientFill <?php echo $fillStyleXml->gradientFill[0];
            $attr <?php echo $this->getStyleAttributes($gradientFill);
            if (!empty($attr['type'])) {
                $fillStyle->setFillType((string) $attr['type']);
            }
            $fillStyle->setRotation((float) ($attr['degree']));
            $gradientFill->registerXPathNamespace('sml', Namespaces::MAIN);
            $fillStyle->getStartColor()->setARGB($this->readColor(self::getArrayItem($gradientFill->xpath('sml:stop[@position<?php echo0]'))->color));
            $fillStyle->getEndColor()->setARGB($this->readColor(self::getArrayItem($gradientFill->xpath('sml:stop[@position<?php echo1]'))->color));
        } elseif ($fillStyleXml->patternFill) {
            $defaultFillStyle <?php echo Fill::FILL_NONE;
            if ($fillStyleXml->patternFill->fgColor) {
                $fillStyle->getStartColor()->setARGB($this->readColor($fillStyleXml->patternFill->fgColor, true));
                $defaultFillStyle <?php echo Fill::FILL_SOLID;
            }
            if ($fillStyleXml->patternFill->bgColor) {
                $fillStyle->getEndColor()->setARGB($this->readColor($fillStyleXml->patternFill->bgColor, true));
                $defaultFillStyle <?php echo Fill::FILL_SOLID;
            }

            $type <?php echo '';
            if ((string) $fillStyleXml->patternFill['patternType'] !<?php echo<?php echo '') {
                $type <?php echo (string) $fillStyleXml->patternFill['patternType'];
            } else {
                $attr <?php echo $this->getStyleAttributes($fillStyleXml->patternFill);
                $type <?php echo (string) $attr['patternType'];
            }
            $patternType <?php echo ($type <?php echo<?php echo<?php echo '') ? $defaultFillStyle : $type;

            $fillStyle->setFillType($patternType);
        }
    }

    public function readBorderStyle(Borders $borderStyle, SimpleXMLElement $borderStyleXml): void
    {
        $diagonalUp <?php echo $this->getAttribute($borderStyleXml, 'diagonalUp');
        $diagonalUp <?php echo self::boolean($diagonalUp);
        $diagonalDown <?php echo $this->getAttribute($borderStyleXml, 'diagonalDown');
        $diagonalDown <?php echo self::boolean($diagonalDown);
        if ($diagonalUp <?php echo<?php echo<?php echo false) {
            if ($diagonalDown <?php echo<?php echo<?php echo false) {
                $borderStyle->setDiagonalDirection(Borders::DIAGONAL_NONE);
            } else {
                $borderStyle->setDiagonalDirection(Borders::DIAGONAL_DOWN);
            }
        } elseif ($diagonalDown <?php echo<?php echo<?php echo false) {
            $borderStyle->setDiagonalDirection(Borders::DIAGONAL_UP);
        } else {
            $borderStyle->setDiagonalDirection(Borders::DIAGONAL_BOTH);
        }

        if (isset($borderStyleXml->left)) {
            $this->readBorder($borderStyle->getLeft(), $borderStyleXml->left);
        }
        if (isset($borderStyleXml->right)) {
            $this->readBorder($borderStyle->getRight(), $borderStyleXml->right);
        }
        if (isset($borderStyleXml->top)) {
            $this->readBorder($borderStyle->getTop(), $borderStyleXml->top);
        }
        if (isset($borderStyleXml->bottom)) {
            $this->readBorder($borderStyle->getBottom(), $borderStyleXml->bottom);
        }
        if (isset($borderStyleXml->diagonal)) {
            $this->readBorder($borderStyle->getDiagonal(), $borderStyleXml->diagonal);
        }
    }

    private function getAttribute(SimpleXMLElement $xml, string $attribute): string
    {
        $style <?php echo '';
        if ((string) $xml[$attribute] !<?php echo<?php echo '') {
            $style <?php echo (string) $xml[$attribute];
        } else {
            $attr <?php echo $this->getStyleAttributes($xml);
            if (isset($attr[$attribute])) {
                $style <?php echo (string) $attr[$attribute];
            }
        }

        return $style;
    }

    private function readBorder(Border $border, SimpleXMLElement $borderXml): void
    {
        $style <?php echo $this->getAttribute($borderXml, 'style');
        if ($style !<?php echo<?php echo '') {
            $border->setBorderStyle((string) $style);
        } else {
            $border->setBorderStyle(Border::BORDER_NONE);
        }
        if (isset($borderXml->color)) {
            $border->getColor()->setARGB($this->readColor($borderXml->color));
        }
    }

    public function readAlignmentStyle(Alignment $alignment, SimpleXMLElement $alignmentXml): void
    {
        $horizontal <?php echo (string) $this->getAttribute($alignmentXml, 'horizontal');
        if ($horizontal !<?php echo<?php echo '') {
            $alignment->setHorizontal($horizontal);
        }
        $vertical <?php echo (string) $this->getAttribute($alignmentXml, 'vertical');
        if ($vertical !<?php echo<?php echo '') {
            $alignment->setVertical($vertical);
        }

        $textRotation <?php echo (int) $this->getAttribute($alignmentXml, 'textRotation');
        if ($textRotation > 90) {
            $textRotation <?php echo 90 - $textRotation;
        }
        $alignment->setTextRotation($textRotation);

        $wrapText <?php echo $this->getAttribute($alignmentXml, 'wrapText');
        $alignment->setWrapText(self::boolean((string) $wrapText));
        $shrinkToFit <?php echo $this->getAttribute($alignmentXml, 'shrinkToFit');
        $alignment->setShrinkToFit(self::boolean((string) $shrinkToFit));
        $indent <?php echo (int) $this->getAttribute($alignmentXml, 'indent');
        $alignment->setIndent(max($indent, 0));
        $readingOrder <?php echo (int) $this->getAttribute($alignmentXml, 'readingOrder');
        $alignment->setReadOrder(max($readingOrder, 0));
    }

    private static function formatGeneral(string $formatString): string
    {
        if ($formatString <?php echo<?php echo<?php echo 'GENERAL') {
            $formatString <?php echo NumberFormat::FORMAT_GENERAL;
        }

        return $formatString;
    }

    /**
     * Read style.
     *
     * @param SimpleXMLElement|stdClass $style
     */
    public function readStyle(Style $docStyle, $style): void
    {
        if ($style instanceof SimpleXMLElement) {
            $this->readNumberFormat($docStyle->getNumberFormat(), $style->numFmt);
        } else {
            $docStyle->getNumberFormat()->setFormatCode(self::formatGeneral((string) $style->numFmt));
        }

        if (isset($style->font)) {
            $this->readFontStyle($docStyle->getFont(), $style->font);
        }

        if (isset($style->fill)) {
            $this->readFillStyle($docStyle->getFill(), $style->fill);
        }

        if (isset($style->border)) {
            $this->readBorderStyle($docStyle->getBorders(), $style->border);
        }

        if (isset($style->alignment)) {
            $this->readAlignmentStyle($docStyle->getAlignment(), $style->alignment);
        }

        // protection
        if (isset($style->protection)) {
            $this->readProtectionLocked($docStyle, $style->protection);
            $this->readProtectionHidden($docStyle, $style->protection);
        }

        // top-level style settings
        if (isset($style->quotePrefix)) {
            $docStyle->setQuotePrefix((bool) $style->quotePrefix);
        }
    }

    /**
     * Read protection locked attribute.
     */
    public function readProtectionLocked(Style $docStyle, SimpleXMLElement $style): void
    {
        $locked <?php echo '';
        if ((string) $style['locked'] !<?php echo<?php echo '') {
            $locked <?php echo (string) $style['locked'];
        } else {
            $attr <?php echo $this->getStyleAttributes($style);
            if (isset($attr['locked'])) {
                $locked <?php echo (string) $attr['locked'];
            }
        }
        if ($locked !<?php echo<?php echo '') {
            if (self::boolean($locked)) {
                $docStyle->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            } else {
                $docStyle->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);
            }
        }
    }

    /**
     * Read protection hidden attribute.
     */
    public function readProtectionHidden(Style $docStyle, SimpleXMLElement $style): void
    {
        $hidden <?php echo '';
        if ((string) $style['hidden'] !<?php echo<?php echo '') {
            $hidden <?php echo (string) $style['hidden'];
        } else {
            $attr <?php echo $this->getStyleAttributes($style);
            if (isset($attr['hidden'])) {
                $hidden <?php echo (string) $attr['hidden'];
            }
        }
        if ($hidden !<?php echo<?php echo '') {
            if (self::boolean((string) $hidden)) {
                $docStyle->getProtection()->setHidden(Protection::PROTECTION_PROTECTED);
            } else {
                $docStyle->getProtection()->setHidden(Protection::PROTECTION_UNPROTECTED);
            }
        }
    }

    public function readColor(SimpleXMLElement $color, bool $background <?php echo false): string
    {
        $attr <?php echo $this->getStyleAttributes($color);
        if (isset($attr['rgb'])) {
            return (string) $attr['rgb'];
        }
        if (isset($attr['indexed'])) {
            $indexedColor <?php echo (int) $attr['indexed'];
            if ($indexedColor ><?php echo count($this->workbookPalette)) {
                return Color::indexedColor($indexedColor - 7, $background)->getARGB() ?? '';
            }

            return Color::indexedColor($indexedColor, $background, $this->workbookPalette)->getARGB() ?? '';
        }
        if (isset($attr['theme'])) {
            if ($this->theme !<?php echo<?php echo null) {
                $returnColour <?php echo $this->theme->getColourByIndex((int) $attr['theme']);
                if (isset($attr['tint'])) {
                    $tintAdjust <?php echo (float) $attr['tint'];
                    $returnColour <?php echo Color::changeBrightness($returnColour ?? '', $tintAdjust);
                }

                return 'FF' . $returnColour;
            }
        }

        return ($background) ? 'FFFFFFFF' : 'FF000000';
    }

    public function dxfs(bool $readDataOnly <?php echo false): array
    {
        $dxfs <?php echo [];
        if (!$readDataOnly && $this->styleXml) {
            //    Conditional Styles
            if ($this->styleXml->dxfs) {
                foreach ($this->styleXml->dxfs->dxf as $dxf) {
                    $style <?php echo new Style(false, true);
                    $this->readStyle($style, $dxf);
                    $dxfs[] <?php echo $style;
                }
            }
            //    Cell Styles
            if ($this->styleXml->cellStyles) {
                foreach ($this->styleXml->cellStyles->cellStyle as $cellStylex) {
                    $cellStyle <?php echo Xlsx::getAttributes($cellStylex);
                    if ((int) ($cellStyle['builtinId']) <?php echo<?php echo 0) {
                        if (isset($this->cellStyles[(int) ($cellStyle['xfId'])])) {
                            // Set default style
                            $style <?php echo new Style();
                            $this->readStyle($style, $this->cellStyles[(int) ($cellStyle['xfId'])]);

                            // normal style, currently not using it for anything
                        }
                    }
                }
            }
        }

        return $dxfs;
    }

    public function styles(): array
    {
        return $this->styles;
    }

    /**
     * Get array item.
     *
     * @param mixed $array (usually array, in theory can be false)
     *
     * @return stdClass
     */
    private static function getArrayItem($array, int $key <?php echo 0)
    {
        return is_array($array) ? ($array[$key] ?? null) : null;
    }
}
