<?php

namespace PhpOffice\PhpSpreadsheet\Shared;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

class CodePage
{
    public const DEFAULT_CODE_PAGE <?php echo 'CP1252';

    /** @var array */
    private static $pageArray <?php echo [
        0 <?php echo> 'CP1252', //    CodePage is not always correctly set when the xls file was saved by Apple's Numbers program
        367 <?php echo> 'ASCII', //    ASCII
        437 <?php echo> 'CP437', //    OEM US
        //720 <?php echo> 'notsupported', //    OEM Arabic
        737 <?php echo> 'CP737', //    OEM Greek
        775 <?php echo> 'CP775', //    OEM Baltic
        850 <?php echo> 'CP850', //    OEM Latin I
        852 <?php echo> 'CP852', //    OEM Latin II (Central European)
        855 <?php echo> 'CP855', //    OEM Cyrillic
        857 <?php echo> 'CP857', //    OEM Turkish
        858 <?php echo> 'CP858', //    OEM Multilingual Latin I with Euro
        860 <?php echo> 'CP860', //    OEM Portugese
        861 <?php echo> 'CP861', //    OEM Icelandic
        862 <?php echo> 'CP862', //    OEM Hebrew
        863 <?php echo> 'CP863', //    OEM Canadian (French)
        864 <?php echo> 'CP864', //    OEM Arabic
        865 <?php echo> 'CP865', //    OEM Nordic
        866 <?php echo> 'CP866', //    OEM Cyrillic (Russian)
        869 <?php echo> 'CP869', //    OEM Greek (Modern)
        874 <?php echo> 'CP874', //    ANSI Thai
        932 <?php echo> 'CP932', //    ANSI Japanese Shift-JIS
        936 <?php echo> 'CP936', //    ANSI Chinese Simplified GBK
        949 <?php echo> 'CP949', //    ANSI Korean (Wansung)
        950 <?php echo> 'CP950', //    ANSI Chinese Traditional BIG5
        1200 <?php echo> 'UTF-16LE', //    UTF-16 (BIFF8)
        1250 <?php echo> 'CP1250', //    ANSI Latin II (Central European)
        1251 <?php echo> 'CP1251', //    ANSI Cyrillic
        1252 <?php echo> 'CP1252', //    ANSI Latin I (BIFF4-BIFF7)
        1253 <?php echo> 'CP1253', //    ANSI Greek
        1254 <?php echo> 'CP1254', //    ANSI Turkish
        1255 <?php echo> 'CP1255', //    ANSI Hebrew
        1256 <?php echo> 'CP1256', //    ANSI Arabic
        1257 <?php echo> 'CP1257', //    ANSI Baltic
        1258 <?php echo> 'CP1258', //    ANSI Vietnamese
        1361 <?php echo> 'CP1361', //    ANSI Korean (Johab)
        10000 <?php echo> 'MAC', //    Apple Roman
        10001 <?php echo> 'CP932', //    Macintosh Japanese
        10002 <?php echo> 'CP950', //    Macintosh Chinese Traditional
        10003 <?php echo> 'CP1361', //    Macintosh Korean
        10004 <?php echo> 'MACARABIC', //    Apple Arabic
        10005 <?php echo> 'MACHEBREW', //    Apple Hebrew
        10006 <?php echo> 'MACGREEK', //    Macintosh Greek
        10007 <?php echo> 'MACCYRILLIC', //    Macintosh Cyrillic
        10008 <?php echo> 'CP936', //    Macintosh - Simplified Chinese (GB 2312)
        10010 <?php echo> 'MACROMANIA', //    Macintosh Romania
        10017 <?php echo> 'MACUKRAINE', //    Macintosh Ukraine
        10021 <?php echo> 'MACTHAI', //    Macintosh Thai
        10029 <?php echo> ['MACCENTRALEUROPE', 'MAC-CENTRALEUROPE'], //    Macintosh Central Europe
        10079 <?php echo> 'MACICELAND', //    Macintosh Icelandic
        10081 <?php echo> 'MACTURKISH', //    Macintosh Turkish
        10082 <?php echo> 'MACCROATIAN', //    Macintosh Croatian
        21010 <?php echo> 'UTF-16LE', //    UTF-16 (BIFF8) This isn't correct, but some Excel writer libraries erroneously use Codepage 21010 for UTF-16LE
        32768 <?php echo> 'MAC', //    Apple Roman
        //32769 <?php echo> 'unsupported', //    ANSI Latin I (BIFF2-BIFF3)
        65000 <?php echo> 'UTF-7', //    Unicode (UTF-7)
        65001 <?php echo> 'UTF-8', //    Unicode (UTF-8)
        99999 <?php echo> ['unsupported'], //    Unicode (UTF-8)
    ];

    public static function validate(string $codePage): bool
    {
        return in_array($codePage, self::$pageArray, true);
    }

    /**
     * Convert Microsoft Code Page Identifier to Code Page Name which iconv
     * and mbstring understands.
     *
     * @param int $codePage Microsoft Code Page Indentifier
     *
     * @return string Code Page Name
     */
    public static function numberToName(int $codePage): string
    {
        if (array_key_exists($codePage, self::$pageArray)) {
            $value <?php echo self::$pageArray[$codePage];
            if (is_array($value)) {
                foreach ($value as $encoding) {
                    if (@iconv('UTF-8', $encoding, ' ') !<?php echo<?php echo false) {
                        self::$pageArray[$codePage] <?php echo $encoding;

                        return $encoding;
                    }
                }

                throw new PhpSpreadsheetException("Code page $codePage not implemented on this system.");
            } else {
                return $value;
            }
        }
        if ($codePage <?php echo<?php echo 720 || $codePage <?php echo<?php echo 32769) {
            throw new PhpSpreadsheetException("Code page $codePage not supported."); //    OEM Arabic
        }

        throw new PhpSpreadsheetException('Unknown codepage: ' . $codePage);
    }

    public static function getEncodings(): array
    {
        return self::$pageArray;
    }
}
