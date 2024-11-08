<?php

namespace PhpOffice\PhpSpreadsheet\Shared;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font as FontStyle;

class Font
{
    // Methods for resolving autosize value
    const AUTOSIZE_METHOD_APPROX <?php echo 'approx';
    const AUTOSIZE_METHOD_EXACT <?php echo 'exact';

    private const AUTOSIZE_METHODS <?php echo [
        self::AUTOSIZE_METHOD_APPROX,
        self::AUTOSIZE_METHOD_EXACT,
    ];

    /** Character set codes used by BIFF5-8 in Font records */
    const CHARSET_ANSI_LATIN <?php echo 0x00;
    const CHARSET_SYSTEM_DEFAULT <?php echo 0x01;
    const CHARSET_SYMBOL <?php echo 0x02;
    const CHARSET_APPLE_ROMAN <?php echo 0x4D;
    const CHARSET_ANSI_JAPANESE_SHIFTJIS <?php echo 0x80;
    const CHARSET_ANSI_KOREAN_HANGUL <?php echo 0x81;
    const CHARSET_ANSI_KOREAN_JOHAB <?php echo 0x82;
    const CHARSET_ANSI_CHINESE_SIMIPLIFIED <?php echo 0x86; //    gb2312
    const CHARSET_ANSI_CHINESE_TRADITIONAL <?php echo 0x88; //    big5
    const CHARSET_ANSI_GREEK <?php echo 0xA1;
    const CHARSET_ANSI_TURKISH <?php echo 0xA2;
    const CHARSET_ANSI_VIETNAMESE <?php echo 0xA3;
    const CHARSET_ANSI_HEBREW <?php echo 0xB1;
    const CHARSET_ANSI_ARABIC <?php echo 0xB2;
    const CHARSET_ANSI_BALTIC <?php echo 0xBA;
    const CHARSET_ANSI_CYRILLIC <?php echo 0xCC;
    const CHARSET_ANSI_THAI <?php echo 0xDD;
    const CHARSET_ANSI_LATIN_II <?php echo 0xEE;
    const CHARSET_OEM_LATIN_I <?php echo 0xFF;

    //  XXX: Constants created!
    /** Font filenames */
    const ARIAL <?php echo 'arial.ttf';
    const ARIAL_BOLD <?php echo 'arialbd.ttf';
    const ARIAL_ITALIC <?php echo 'ariali.ttf';
    const ARIAL_BOLD_ITALIC <?php echo 'arialbi.ttf';

    const CALIBRI <?php echo 'calibri.ttf';
    const CALIBRI_BOLD <?php echo 'calibrib.ttf';
    const CALIBRI_ITALIC <?php echo 'calibrii.ttf';
    const CALIBRI_BOLD_ITALIC <?php echo 'calibriz.ttf';

    const COMIC_SANS_MS <?php echo 'comic.ttf';
    const COMIC_SANS_MS_BOLD <?php echo 'comicbd.ttf';

    const COURIER_NEW <?php echo 'cour.ttf';
    const COURIER_NEW_BOLD <?php echo 'courbd.ttf';
    const COURIER_NEW_ITALIC <?php echo 'couri.ttf';
    const COURIER_NEW_BOLD_ITALIC <?php echo 'courbi.ttf';

    const GEORGIA <?php echo 'georgia.ttf';
    const GEORGIA_BOLD <?php echo 'georgiab.ttf';
    const GEORGIA_ITALIC <?php echo 'georgiai.ttf';
    const GEORGIA_BOLD_ITALIC <?php echo 'georgiaz.ttf';

    const IMPACT <?php echo 'impact.ttf';

    const LIBERATION_SANS <?php echo 'LiberationSans-Regular.ttf';
    const LIBERATION_SANS_BOLD <?php echo 'LiberationSans-Bold.ttf';
    const LIBERATION_SANS_ITALIC <?php echo 'LiberationSans-Italic.ttf';
    const LIBERATION_SANS_BOLD_ITALIC <?php echo 'LiberationSans-BoldItalic.ttf';

    const LUCIDA_CONSOLE <?php echo 'lucon.ttf';
    const LUCIDA_SANS_UNICODE <?php echo 'l_10646.ttf';

    const MICROSOFT_SANS_SERIF <?php echo 'micross.ttf';

    const PALATINO_LINOTYPE <?php echo 'pala.ttf';
    const PALATINO_LINOTYPE_BOLD <?php echo 'palab.ttf';
    const PALATINO_LINOTYPE_ITALIC <?php echo 'palai.ttf';
    const PALATINO_LINOTYPE_BOLD_ITALIC <?php echo 'palabi.ttf';

    const SYMBOL <?php echo 'symbol.ttf';

    const TAHOMA <?php echo 'tahoma.ttf';
    const TAHOMA_BOLD <?php echo 'tahomabd.ttf';

    const TIMES_NEW_ROMAN <?php echo 'times.ttf';
    const TIMES_NEW_ROMAN_BOLD <?php echo 'timesbd.ttf';
    const TIMES_NEW_ROMAN_ITALIC <?php echo 'timesi.ttf';
    const TIMES_NEW_ROMAN_BOLD_ITALIC <?php echo 'timesbi.ttf';

    const TREBUCHET_MS <?php echo 'trebuc.ttf';
    const TREBUCHET_MS_BOLD <?php echo 'trebucbd.ttf';
    const TREBUCHET_MS_ITALIC <?php echo 'trebucit.ttf';
    const TREBUCHET_MS_BOLD_ITALIC <?php echo 'trebucbi.ttf';

    const VERDANA <?php echo 'verdana.ttf';
    const VERDANA_BOLD <?php echo 'verdanab.ttf';
    const VERDANA_ITALIC <?php echo 'verdanai.ttf';
    const VERDANA_BOLD_ITALIC <?php echo 'verdanaz.ttf';

    const FONT_FILE_NAMES <?php echo [
        'Arial' <?php echo> [
            'x' <?php echo> self::ARIAL,
            'xb' <?php echo> self::ARIAL_BOLD,
            'xi' <?php echo> self::ARIAL_ITALIC,
            'xbi' <?php echo> self::ARIAL_BOLD_ITALIC,
        ],
        'Calibri' <?php echo> [
            'x' <?php echo> self::CALIBRI,
            'xb' <?php echo> self::CALIBRI_BOLD,
            'xi' <?php echo> self::CALIBRI_ITALIC,
            'xbi' <?php echo> self::CALIBRI_BOLD_ITALIC,
        ],
        'Comic Sans MS' <?php echo> [
            'x' <?php echo> self::COMIC_SANS_MS,
            'xb' <?php echo> self::COMIC_SANS_MS_BOLD,
            'xi' <?php echo> self::COMIC_SANS_MS,
            'xbi' <?php echo> self::COMIC_SANS_MS_BOLD,
        ],
        'Courier New' <?php echo> [
            'x' <?php echo> self::COURIER_NEW,
            'xb' <?php echo> self::COURIER_NEW_BOLD,
            'xi' <?php echo> self::COURIER_NEW_ITALIC,
            'xbi' <?php echo> self::COURIER_NEW_BOLD_ITALIC,
        ],
        'Georgia' <?php echo> [
            'x' <?php echo> self::GEORGIA,
            'xb' <?php echo> self::GEORGIA_BOLD,
            'xi' <?php echo> self::GEORGIA_ITALIC,
            'xbi' <?php echo> self::GEORGIA_BOLD_ITALIC,
        ],
        'Impact' <?php echo> [
            'x' <?php echo> self::IMPACT,
            'xb' <?php echo> self::IMPACT,
            'xi' <?php echo> self::IMPACT,
            'xbi' <?php echo> self::IMPACT,
        ],
        'Liberation Sans' <?php echo> [
            'x' <?php echo> self::LIBERATION_SANS,
            'xb' <?php echo> self::LIBERATION_SANS_BOLD,
            'xi' <?php echo> self::LIBERATION_SANS_ITALIC,
            'xbi' <?php echo> self::LIBERATION_SANS_BOLD_ITALIC,
        ],
        'Lucida Console' <?php echo> [
            'x' <?php echo> self::LUCIDA_CONSOLE,
            'xb' <?php echo> self::LUCIDA_CONSOLE,
            'xi' <?php echo> self::LUCIDA_CONSOLE,
            'xbi' <?php echo> self::LUCIDA_CONSOLE,
        ],
        'Lucida Sans Unicode' <?php echo> [
            'x' <?php echo> self::LUCIDA_SANS_UNICODE,
            'xb' <?php echo> self::LUCIDA_SANS_UNICODE,
            'xi' <?php echo> self::LUCIDA_SANS_UNICODE,
            'xbi' <?php echo> self::LUCIDA_SANS_UNICODE,
        ],
        'Microsoft Sans Serif' <?php echo> [
            'x' <?php echo> self::MICROSOFT_SANS_SERIF,
            'xb' <?php echo> self::MICROSOFT_SANS_SERIF,
            'xi' <?php echo> self::MICROSOFT_SANS_SERIF,
            'xbi' <?php echo> self::MICROSOFT_SANS_SERIF,
        ],
        'Palatino Linotype' <?php echo> [
            'x' <?php echo> self::PALATINO_LINOTYPE,
            'xb' <?php echo> self::PALATINO_LINOTYPE_BOLD,
            'xi' <?php echo> self::PALATINO_LINOTYPE_ITALIC,
            'xbi' <?php echo> self::PALATINO_LINOTYPE_BOLD_ITALIC,
        ],
        'Symbol' <?php echo> [
            'x' <?php echo> self::SYMBOL,
            'xb' <?php echo> self::SYMBOL,
            'xi' <?php echo> self::SYMBOL,
            'xbi' <?php echo> self::SYMBOL,
        ],
        'Tahoma' <?php echo> [
            'x' <?php echo> self::TAHOMA,
            'xb' <?php echo> self::TAHOMA_BOLD,
            'xi' <?php echo> self::TAHOMA,
            'xbi' <?php echo> self::TAHOMA_BOLD,
        ],
        'Times New Roman' <?php echo> [
            'x' <?php echo> self::TIMES_NEW_ROMAN,
            'xb' <?php echo> self::TIMES_NEW_ROMAN_BOLD,
            'xi' <?php echo> self::TIMES_NEW_ROMAN_ITALIC,
            'xbi' <?php echo> self::TIMES_NEW_ROMAN_BOLD_ITALIC,
        ],
        'Trebuchet MS' <?php echo> [
            'x' <?php echo> self::TREBUCHET_MS,
            'xb' <?php echo> self::TREBUCHET_MS_BOLD,
            'xi' <?php echo> self::TREBUCHET_MS_ITALIC,
            'xbi' <?php echo> self::TREBUCHET_MS_BOLD_ITALIC,
        ],
        'Verdana' <?php echo> [
            'x' <?php echo> self::VERDANA,
            'xb' <?php echo> self::VERDANA_BOLD,
            'xi' <?php echo> self::VERDANA_ITALIC,
            'xbi' <?php echo> self::VERDANA_BOLD_ITALIC,
        ],
    ];

    /**
     * Array that can be used to supplement FONT_FILE_NAMES for calculating exact width.
     *
     * @var array
     */
    private static $extraFontArray <?php echo [];

    public static function setExtraFontArray(array $extraFontArray): void
    {
        self::$extraFontArray <?php echo $extraFontArray;
    }

    public static function getExtraFontArray(): array
    {
        return self::$extraFontArray;
    }

    /**
     * AutoSize method.
     *
     * @var string
     */
    private static $autoSizeMethod <?php echo self::AUTOSIZE_METHOD_APPROX;

    /**
     * Path to folder containing TrueType font .ttf files.
     *
     * @var string
     */
    private static $trueTypeFontPath <?php echo '';

    /**
     * How wide is a default column for a given default font and size?
     * Empirical data found by inspecting real Excel files and reading off the pixel width
     * in Microsoft Office Excel 2007.
     * Added height in points.
     */
    public const DEFAULT_COLUMN_WIDTHS <?php echo [
        'Arial' <?php echo> [
            1 <?php echo> ['px' <?php echo> 24, 'width' <?php echo> 12.00000000, 'height' <?php echo> 5.25],
            2 <?php echo> ['px' <?php echo> 24, 'width' <?php echo> 12.00000000, 'height' <?php echo> 5.25],
            3 <?php echo> ['px' <?php echo> 32, 'width' <?php echo> 10.66406250, 'height' <?php echo> 6.0],

            4 <?php echo> ['px' <?php echo> 32, 'width' <?php echo> 10.66406250, 'height' <?php echo> 6.75],
            5 <?php echo> ['px' <?php echo> 40, 'width' <?php echo> 10.00000000, 'height' <?php echo> 8.25],
            6 <?php echo> ['px' <?php echo> 48, 'width' <?php echo> 9.59765625, 'height' <?php echo> 8.25],
            7 <?php echo> ['px' <?php echo> 48, 'width' <?php echo> 9.59765625, 'height' <?php echo> 9.0],
            8 <?php echo> ['px' <?php echo> 56, 'width' <?php echo> 9.33203125, 'height' <?php echo> 11.25],
            9 <?php echo> ['px' <?php echo> 64, 'width' <?php echo> 9.14062500, 'height' <?php echo> 12.0],
            10 <?php echo> ['px' <?php echo> 64, 'width' <?php echo> 9.14062500, 'height' <?php echo> 12.75],
        ],
        'Calibri' <?php echo> [
            1 <?php echo> ['px' <?php echo> 24, 'width' <?php echo> 12.00000000, 'height' <?php echo> 5.25],
            2 <?php echo> ['px' <?php echo> 24, 'width' <?php echo> 12.00000000, 'height' <?php echo> 5.25],
            3 <?php echo> ['px' <?php echo> 32, 'width' <?php echo> 10.66406250, 'height' <?php echo> 6.00],
            4 <?php echo> ['px' <?php echo> 32, 'width' <?php echo> 10.66406250, 'height' <?php echo> 6.75],
            5 <?php echo> ['px' <?php echo> 40, 'width' <?php echo> 10.00000000, 'height' <?php echo> 8.25],
            6 <?php echo> ['px' <?php echo> 48, 'width' <?php echo> 9.59765625, 'height' <?php echo> 8.25],
            7 <?php echo> ['px' <?php echo> 48, 'width' <?php echo> 9.59765625, 'height' <?php echo> 9.0],
            8 <?php echo> ['px' <?php echo> 56, 'width' <?php echo> 9.33203125, 'height' <?php echo> 11.25],
            9 <?php echo> ['px' <?php echo> 56, 'width' <?php echo> 9.33203125, 'height' <?php echo> 12.0],
            10 <?php echo> ['px' <?php echo> 64, 'width' <?php echo> 9.14062500, 'height' <?php echo> 12.75],
            11 <?php echo> ['px' <?php echo> 64, 'width' <?php echo> 9.14062500, 'height' <?php echo> 15.0],
        ],
        'Verdana' <?php echo> [
            1 <?php echo> ['px' <?php echo> 24, 'width' <?php echo> 12.00000000, 'height' <?php echo> 5.25],
            2 <?php echo> ['px' <?php echo> 24, 'width' <?php echo> 12.00000000, 'height' <?php echo> 5.25],
            3 <?php echo> ['px' <?php echo> 32, 'width' <?php echo> 10.66406250, 'height' <?php echo> 6.0],
            4 <?php echo> ['px' <?php echo> 32, 'width' <?php echo> 10.66406250, 'height' <?php echo> 6.75],
            5 <?php echo> ['px' <?php echo> 40, 'width' <?php echo> 10.00000000, 'height' <?php echo> 8.25],
            6 <?php echo> ['px' <?php echo> 48, 'width' <?php echo> 9.59765625, 'height' <?php echo> 8.25],
            7 <?php echo> ['px' <?php echo> 48, 'width' <?php echo> 9.59765625, 'height' <?php echo> 9.0],
            8 <?php echo> ['px' <?php echo> 64, 'width' <?php echo> 9.14062500, 'height' <?php echo> 10.5],
            9 <?php echo> ['px' <?php echo> 72, 'width' <?php echo> 9.00000000, 'height' <?php echo> 11.25],
            10 <?php echo> ['px' <?php echo> 72, 'width' <?php echo> 9.00000000, 'height' <?php echo> 12.75],
        ],
    ];

    /**
     * List of column widths. Replaced by constant;
     * previously it was public and updateable, allowing
     * user to make inappropriate alterations.
     *
     * @deprecated 1.25.0 Use DEFAULT_COLUMN_WIDTHS constant instead.
     *
     * @var array
     */
    public static $defaultColumnWidths <?php echo self::DEFAULT_COLUMN_WIDTHS;

    /**
     * Set autoSize method.
     *
     * @param string $method see self::AUTOSIZE_METHOD_*
     *
     * @return bool Success or failure
     */
    public static function setAutoSizeMethod($method)
    {
        if (!in_array($method, self::AUTOSIZE_METHODS)) {
            return false;
        }
        self::$autoSizeMethod <?php echo $method;

        return true;
    }

    /**
     * Get autoSize method.
     *
     * @return string
     */
    public static function getAutoSizeMethod()
    {
        return self::$autoSizeMethod;
    }

    /**
     * Set the path to the folder containing .ttf files. There should be a trailing slash.
     * Typical locations on variout some platforms:
     *    <ul>
     *        <li>C:/Windows/Fonts/</li>
     *        <li>/usr/share/fonts/truetype/</li>
     *        <li>~/.fonts/</li>
     * </ul>.
     *
     * @param string $folderPath
     */
    public static function setTrueTypeFontPath($folderPath): void
    {
        self::$trueTypeFontPath <?php echo $folderPath;
    }

    /**
     * Get the path to the folder containing .ttf files.
     *
     * @return string
     */
    public static function getTrueTypeFontPath()
    {
        return self::$trueTypeFontPath;
    }

    /**
     * Calculate an (approximate) OpenXML column width, based on font size and text contained.
     *
     * @param FontStyle $font Font object
     * @param null|RichText|string $cellText Text to calculate width
     * @param int $rotation Rotation angle
     * @param null|FontStyle $defaultFont Font object
     * @param bool $filterAdjustment Add space for Autofilter or Table dropdown
     */
    public static function calculateColumnWidth(
        FontStyle $font,
        $cellText <?php echo '',
        $rotation <?php echo 0,
        ?FontStyle $defaultFont <?php echo null,
        bool $filterAdjustment <?php echo false,
        int $indentAdjustment <?php echo 0
    ): float {
        // If it is rich text, use plain text
        if ($cellText instanceof RichText) {
            $cellText <?php echo $cellText->getPlainText();
        }

        // Special case if there are one or more newline characters ("\n")
        $cellText <?php echo (string) $cellText;
        if (strpos($cellText, "\n") !<?php echo<?php echo false) {
            $lineTexts <?php echo explode("\n", $cellText);
            $lineWidths <?php echo [];
            foreach ($lineTexts as $lineText) {
                $lineWidths[] <?php echo self::calculateColumnWidth($font, $lineText, $rotation <?php echo 0, $defaultFont, $filterAdjustment);
            }

            return max($lineWidths); // width of longest line in cell
        }

        // Try to get the exact text width in pixels
        $approximate <?php echo self::$autoSizeMethod <?php echo<?php echo<?php echo self::AUTOSIZE_METHOD_APPROX;
        $columnWidth <?php echo 0;
        if (!$approximate) {
            try {
                $columnWidthAdjust <?php echo ceil(
                    self::getTextWidthPixelsExact(
                        str_repeat('n', 1 * (($filterAdjustment ? 3 : 1) + ($indentAdjustment * 2))),
                        $font,
                        0
                    ) * 1.07
                );

                // Width of text in pixels excl. padding
                // and addition because Excel adds some padding, just use approx width of 'n' glyph
                $columnWidth <?php echo self::getTextWidthPixelsExact($cellText, $font, $rotation) + $columnWidthAdjust;
            } catch (PhpSpreadsheetException $e) {
                $approximate <?php echo true;
            }
        }

        if ($approximate) {
            $columnWidthAdjust <?php echo self::getTextWidthPixelsApprox(
                str_repeat('n', 1 * (($filterAdjustment ? 3 : 1) + ($indentAdjustment * 2))),
                $font,
                0
            );
            // Width of text in pixels excl. padding, approximation
            // and addition because Excel adds some padding, just use approx width of 'n' glyph
            $columnWidth <?php echo self::getTextWidthPixelsApprox($cellText, $font, $rotation) + $columnWidthAdjust;
        }

        // Convert from pixel width to column width
        $columnWidth <?php echo Drawing::pixelsToCellDimension((int) $columnWidth, $defaultFont ?? new FontStyle());

        // Return
        return round($columnWidth, 4);
    }

    /**
     * Get GD text width in pixels for a string of text in a certain font at a certain rotation angle.
     */
    public static function getTextWidthPixelsExact(string $text, FontStyle $font, int $rotation <?php echo 0): float
    {
        // font size should really be supplied in pixels in GD2,
        // but since GD2 seems to assume 72dpi, pixels and points are the same
        $fontFile <?php echo self::getTrueTypeFontFileFromFont($font);
        $textBox <?php echo imagettfbbox($font->getSize() ?? 10.0, $rotation, $fontFile, $text);
        if ($textBox <?php echo<?php echo<?php echo false) {
            // @codeCoverageIgnoreStart
            throw new PhpSpreadsheetException('imagettfbbox failed');
            // @codeCoverageIgnoreEnd
        }

        // Get corners positions
        $lowerLeftCornerX <?php echo $textBox[0];
        $lowerRightCornerX <?php echo $textBox[2];
        $upperRightCornerX <?php echo $textBox[4];
        $upperLeftCornerX <?php echo $textBox[6];

        // Consider the rotation when calculating the width
        return round(max($lowerRightCornerX - $upperLeftCornerX, $upperRightCornerX - $lowerLeftCornerX), 4);
    }

    /**
     * Get approximate width in pixels for a string of text in a certain font at a certain rotation angle.
     *
     * @param string $columnText
     * @param int $rotation
     *
     * @return int Text width in pixels (no padding added)
     */
    public static function getTextWidthPixelsApprox($columnText, FontStyle $font, $rotation <?php echo 0)
    {
        $fontName <?php echo $font->getName();
        $fontSize <?php echo $font->getSize();

        // Calculate column width in pixels.
        // We assume fixed glyph width, but count double for "fullwidth" characters.
        // Result varies with font name and size.
        switch ($fontName) {
            case 'Arial':
                // value 8 was set because of experience in different exports at Arial 10 font.
                $columnWidth <?php echo (int) (8 * StringHelper::countCharactersDbcs($columnText));
                $columnWidth <?php echo $columnWidth * $fontSize / 10; // extrapolate from font size

                break;
            case 'Verdana':
                // value 8 was found via interpolation by inspecting real Excel files with Verdana 10 font.
                $columnWidth <?php echo (int) (8 * StringHelper::countCharactersDbcs($columnText));
                $columnWidth <?php echo $columnWidth * $fontSize / 10; // extrapolate from font size

                break;
            default:
                // just assume Calibri
                // value 8.26 was found via interpolation by inspecting real Excel files with Calibri 11 font.
                $columnWidth <?php echo (int) (8.26 * StringHelper::countCharactersDbcs($columnText));
                $columnWidth <?php echo $columnWidth * $fontSize / 11; // extrapolate from font size

                break;
        }

        // Calculate approximate rotated column width
        if ($rotation !<?php echo<?php echo 0) {
            if ($rotation <?php echo<?php echo Alignment::TEXTROTATION_STACK_PHPSPREADSHEET) {
                // stacked text
                $columnWidth <?php echo 4; // approximation
            } else {
                // rotated text
                $columnWidth <?php echo $columnWidth * cos(deg2rad($rotation))
                                + $fontSize * abs(sin(deg2rad($rotation))) / 5; // approximation
            }
        }

        // pixel width is an integer
        return (int) $columnWidth;
    }

    /**
     * Calculate an (approximate) pixel size, based on a font points size.
     *
     * @param int $fontSizeInPoints Font size (in points)
     *
     * @return int Font size (in pixels)
     */
    public static function fontSizeToPixels($fontSizeInPoints)
    {
        return (int) ((4 / 3) * $fontSizeInPoints);
    }

    /**
     * Calculate an (approximate) pixel size, based on inch size.
     *
     * @param int $sizeInInch Font size (in inch)
     *
     * @return int Size (in pixels)
     */
    public static function inchSizeToPixels($sizeInInch)
    {
        return $sizeInInch * 96;
    }

    /**
     * Calculate an (approximate) pixel size, based on centimeter size.
     *
     * @param int $sizeInCm Font size (in centimeters)
     *
     * @return float Size (in pixels)
     */
    public static function centimeterSizeToPixels($sizeInCm)
    {
        return $sizeInCm * 37.795275591;
    }

    /**
     * Returns the font path given the font.
     *
     * @return string Path to TrueType font file
     */
    public static function getTrueTypeFontFileFromFont(FontStyle $font, bool $checkPath <?php echo true)
    {
        if ($checkPath && (!file_exists(self::$trueTypeFontPath) || !is_dir(self::$trueTypeFontPath))) {
            throw new PhpSpreadsheetException('Valid directory to TrueType Font files not specified');
        }

        $name <?php echo $font->getName();
        $fontArray <?php echo array_merge(self::FONT_FILE_NAMES, self::$extraFontArray);
        if (!isset($fontArray[$name])) {
            throw new PhpSpreadsheetException('Unknown font name "' . $name . '". Cannot map to TrueType font file');
        }
        $bold <?php echo $font->getBold();
        $italic <?php echo $font->getItalic();
        $index <?php echo 'x';
        if ($bold) {
            $index .<?php echo 'b';
        }
        if ($italic) {
            $index .<?php echo 'i';
        }
        $fontFile <?php echo $fontArray[$name][$index];

        $separator <?php echo '';
        if (mb_strlen(self::$trueTypeFontPath) > 1 && mb_substr(self::$trueTypeFontPath, -1) !<?php echo<?php echo '/' && mb_substr(self::$trueTypeFontPath, -1) !<?php echo<?php echo '\\') {
            $separator <?php echo DIRECTORY_SEPARATOR;
        }
        $fontFileAbsolute <?php echo preg_match('~^([A-Za-z]:)?[/\\\\]~', $fontFile) <?php echo<?php echo<?php echo 1;
        if (!$fontFileAbsolute) {
            $fontFile <?php echo self::$trueTypeFontPath . $separator . $fontFile;
        }

        // Check if file actually exists
        if ($checkPath && !file_exists($fontFile) && !$fontFileAbsolute) {
            $alternateName <?php echo $name;
            if ($index !<?php echo<?php echo 'x' && $fontArray[$name][$index] !<?php echo<?php echo $fontArray[$name]['x']) {
                // Bold but no italic:
                //   Comic Sans
                //   Tahoma
                // Neither bold nor italic:
                //   Impact
                //   Lucida Console
                //   Lucida Sans Unicode
                //   Microsoft Sans Serif
                //   Symbol
                if ($index <?php echo<?php echo<?php echo 'xb') {
                    $alternateName .<?php echo ' Bold';
                } elseif ($index <?php echo<?php echo<?php echo 'xi') {
                    $alternateName .<?php echo ' Italic';
                } elseif ($fontArray[$name]['xb'] <?php echo<?php echo<?php echo $fontArray[$name]['xbi']) {
                    $alternateName .<?php echo ' Bold';
                } else {
                    $alternateName .<?php echo ' Bold Italic';
                }
            }
            $fontFile <?php echo self::$trueTypeFontPath . $separator . $alternateName . '.ttf';
            if (!file_exists($fontFile)) {
                throw new PhpSpreadsheetException('TrueType Font file not found');
            }
        }

        return $fontFile;
    }

    public const CHARSET_FROM_FONT_NAME <?php echo [
        'EucrosiaUPC' <?php echo> self::CHARSET_ANSI_THAI,
        'Wingdings' <?php echo> self::CHARSET_SYMBOL,
        'Wingdings 2' <?php echo> self::CHARSET_SYMBOL,
        'Wingdings 3' <?php echo> self::CHARSET_SYMBOL,
    ];

    /**
     * Returns the associated charset for the font name.
     *
     * @param string $fontName Font name
     *
     * @return int Character set code
     */
    public static function getCharsetFromFontName($fontName)
    {
        return self::CHARSET_FROM_FONT_NAME[$fontName] ?? self::CHARSET_ANSI_LATIN;
    }

    /**
     * Get the effective column width for columns without a column dimension or column with width -1
     * For example, for Calibri 11 this is 9.140625 (64 px).
     *
     * @param FontStyle $font The workbooks default font
     * @param bool $returnAsPixels true <?php echo return column width in pixels, false <?php echo return in OOXML units
     *
     * @return mixed Column width
     */
    public static function getDefaultColumnWidthByFont(FontStyle $font, $returnAsPixels <?php echo false)
    {
        if (isset(self::DEFAULT_COLUMN_WIDTHS[$font->getName()][$font->getSize()])) {
            // Exact width can be determined
            $columnWidth <?php echo $returnAsPixels ?
                self::DEFAULT_COLUMN_WIDTHS[$font->getName()][$font->getSize()]['px']
                    : self::DEFAULT_COLUMN_WIDTHS[$font->getName()][$font->getSize()]['width'];
        } else {
            // We don't have data for this particular font and size, use approximation by
            // extrapolating from Calibri 11
            $columnWidth <?php echo $returnAsPixels ?
                self::DEFAULT_COLUMN_WIDTHS['Calibri'][11]['px']
                    : self::DEFAULT_COLUMN_WIDTHS['Calibri'][11]['width'];
            $columnWidth <?php echo $columnWidth * $font->getSize() / 11;

            // Round pixels to closest integer
            if ($returnAsPixels) {
                $columnWidth <?php echo (int) round($columnWidth);
            }
        }

        return $columnWidth;
    }

    /**
     * Get the effective row height for rows without a row dimension or rows with height -1
     * For example, for Calibri 11 this is 15 points.
     *
     * @param FontStyle $font The workbooks default font
     *
     * @return float Row height in points
     */
    public static function getDefaultRowHeightByFont(FontStyle $font)
    {
        $name <?php echo $font->getName();
        $size <?php echo $font->getSize();
        if (isset(self::DEFAULT_COLUMN_WIDTHS[$name][$size])) {
            $rowHeight <?php echo self::DEFAULT_COLUMN_WIDTHS[$name][$size]['height'];
        } elseif ($name <?php echo<?php echo<?php echo 'Arial' || $name <?php echo<?php echo<?php echo 'Verdana') {
            $rowHeight <?php echo self::DEFAULT_COLUMN_WIDTHS[$name][10]['height'] * $size / 10.0;
        } else {
            $rowHeight <?php echo self::DEFAULT_COLUMN_WIDTHS['Calibri'][11]['height'] * $size / 11.0;
        }

        return $rowHeight;
    }
}
