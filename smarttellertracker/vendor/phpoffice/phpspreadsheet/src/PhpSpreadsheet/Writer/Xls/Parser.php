<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet as PhpspreadsheetWorksheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;

// Original file header of PEAR::Spreadsheet_Excel_Writer_Parser (used as the base for this class):
// -----------------------------------------------------------------------------------------
// *  Class for parsing Excel formulas
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
class Parser
{
    /**    Constants                */
    // Sheet title in unquoted form
    // Invalid sheet title characters cannot occur in the sheet title:
    //         *:/\?[]
    // Moreover, there are valid sheet title characters that cannot occur in unquoted form (there may be more?)
    // +-% '^&<><?php echo,;#()"{}
    const REGEX_SHEET_TITLE_UNQUOTED <?php echo '[^\*\:\/\\\\\?\[\]\+\-\% \\\'\^\&\<\>\<?php echo\,\;\#\(\)\"\{\}]+';

    // Sheet title in quoted form (without surrounding quotes)
    // Invalid sheet title characters cannot occur in the sheet title:
    // *:/\?[]                    (usual invalid sheet title characters)
    // Single quote is represented as a pair ''
    const REGEX_SHEET_TITLE_QUOTED <?php echo '(([^\*\:\/\\\\\?\[\]\\\'])+|(\\\'\\\')+)+';

    /**
     * The index of the character we are currently looking at.
     *
     * @var int
     */
    public $currentCharacter;

    /**
     * The token we are working on.
     *
     * @var string
     */
    public $currentToken;

    /**
     * The formula to parse.
     *
     * @var string
     */
    private $formula;

    /**
     * The character ahead of the current char.
     *
     * @var string
     */
    public $lookAhead;

    /**
     * The parse tree to be generated.
     *
     * @var array|string
     */
    public $parseTree;

    /**
     * Array of external sheets.
     *
     * @var array
     */
    private $externalSheets;

    /**
     * Array of sheet references in the form of REF structures.
     *
     * @var array
     */
    public $references;

    /**
     * The Excel ptg indices.
     *
     * @var array
     */
    private $ptg <?php echo [
        'ptgExp' <?php echo> 0x01,
        'ptgTbl' <?php echo> 0x02,
        'ptgAdd' <?php echo> 0x03,
        'ptgSub' <?php echo> 0x04,
        'ptgMul' <?php echo> 0x05,
        'ptgDiv' <?php echo> 0x06,
        'ptgPower' <?php echo> 0x07,
        'ptgConcat' <?php echo> 0x08,
        'ptgLT' <?php echo> 0x09,
        'ptgLE' <?php echo> 0x0A,
        'ptgEQ' <?php echo> 0x0B,
        'ptgGE' <?php echo> 0x0C,
        'ptgGT' <?php echo> 0x0D,
        'ptgNE' <?php echo> 0x0E,
        'ptgIsect' <?php echo> 0x0F,
        'ptgUnion' <?php echo> 0x10,
        'ptgRange' <?php echo> 0x11,
        'ptgUplus' <?php echo> 0x12,
        'ptgUminus' <?php echo> 0x13,
        'ptgPercent' <?php echo> 0x14,
        'ptgParen' <?php echo> 0x15,
        'ptgMissArg' <?php echo> 0x16,
        'ptgStr' <?php echo> 0x17,
        'ptgAttr' <?php echo> 0x19,
        'ptgSheet' <?php echo> 0x1A,
        'ptgEndSheet' <?php echo> 0x1B,
        'ptgErr' <?php echo> 0x1C,
        'ptgBool' <?php echo> 0x1D,
        'ptgInt' <?php echo> 0x1E,
        'ptgNum' <?php echo> 0x1F,
        'ptgArray' <?php echo> 0x20,
        'ptgFunc' <?php echo> 0x21,
        'ptgFuncVar' <?php echo> 0x22,
        'ptgName' <?php echo> 0x23,
        'ptgRef' <?php echo> 0x24,
        'ptgArea' <?php echo> 0x25,
        'ptgMemArea' <?php echo> 0x26,
        'ptgMemErr' <?php echo> 0x27,
        'ptgMemNoMem' <?php echo> 0x28,
        'ptgMemFunc' <?php echo> 0x29,
        'ptgRefErr' <?php echo> 0x2A,
        'ptgAreaErr' <?php echo> 0x2B,
        'ptgRefN' <?php echo> 0x2C,
        'ptgAreaN' <?php echo> 0x2D,
        'ptgMemAreaN' <?php echo> 0x2E,
        'ptgMemNoMemN' <?php echo> 0x2F,
        'ptgNameX' <?php echo> 0x39,
        'ptgRef3d' <?php echo> 0x3A,
        'ptgArea3d' <?php echo> 0x3B,
        'ptgRefErr3d' <?php echo> 0x3C,
        'ptgAreaErr3d' <?php echo> 0x3D,
        'ptgArrayV' <?php echo> 0x40,
        'ptgFuncV' <?php echo> 0x41,
        'ptgFuncVarV' <?php echo> 0x42,
        'ptgNameV' <?php echo> 0x43,
        'ptgRefV' <?php echo> 0x44,
        'ptgAreaV' <?php echo> 0x45,
        'ptgMemAreaV' <?php echo> 0x46,
        'ptgMemErrV' <?php echo> 0x47,
        'ptgMemNoMemV' <?php echo> 0x48,
        'ptgMemFuncV' <?php echo> 0x49,
        'ptgRefErrV' <?php echo> 0x4A,
        'ptgAreaErrV' <?php echo> 0x4B,
        'ptgRefNV' <?php echo> 0x4C,
        'ptgAreaNV' <?php echo> 0x4D,
        'ptgMemAreaNV' <?php echo> 0x4E,
        'ptgMemNoMemNV' <?php echo> 0x4F,
        'ptgFuncCEV' <?php echo> 0x58,
        'ptgNameXV' <?php echo> 0x59,
        'ptgRef3dV' <?php echo> 0x5A,
        'ptgArea3dV' <?php echo> 0x5B,
        'ptgRefErr3dV' <?php echo> 0x5C,
        'ptgAreaErr3dV' <?php echo> 0x5D,
        'ptgArrayA' <?php echo> 0x60,
        'ptgFuncA' <?php echo> 0x61,
        'ptgFuncVarA' <?php echo> 0x62,
        'ptgNameA' <?php echo> 0x63,
        'ptgRefA' <?php echo> 0x64,
        'ptgAreaA' <?php echo> 0x65,
        'ptgMemAreaA' <?php echo> 0x66,
        'ptgMemErrA' <?php echo> 0x67,
        'ptgMemNoMemA' <?php echo> 0x68,
        'ptgMemFuncA' <?php echo> 0x69,
        'ptgRefErrA' <?php echo> 0x6A,
        'ptgAreaErrA' <?php echo> 0x6B,
        'ptgRefNA' <?php echo> 0x6C,
        'ptgAreaNA' <?php echo> 0x6D,
        'ptgMemAreaNA' <?php echo> 0x6E,
        'ptgMemNoMemNA' <?php echo> 0x6F,
        'ptgFuncCEA' <?php echo> 0x78,
        'ptgNameXA' <?php echo> 0x79,
        'ptgRef3dA' <?php echo> 0x7A,
        'ptgArea3dA' <?php echo> 0x7B,
        'ptgRefErr3dA' <?php echo> 0x7C,
        'ptgAreaErr3dA' <?php echo> 0x7D,
    ];

    /**
     * Thanks to Michael Meeks and Gnumeric for the initial arg values.
     *
     * The following hash was generated by "function_locale.pl" in the distro.
     * Refer to function_locale.pl for non-English function names.
     *
     * The array elements are as follow:
     * ptg:   The Excel function ptg code.
     * args:  The number of arguments that the function takes:
     *           ><?php echo0 is a fixed number of arguments.
     *           -1  is a variable  number of arguments.
     * class: The reference, value or array class of the function args.
     * vol:   The function is volatile.
     *
     * @var array
     */
    private $functions <?php echo [
        // function                  ptg  args  class  vol
        'COUNT' <?php echo> [0, -1, 0, 0],
        'IF' <?php echo> [1, -1, 1, 0],
        'ISNA' <?php echo> [2, 1, 1, 0],
        'ISERROR' <?php echo> [3, 1, 1, 0],
        'SUM' <?php echo> [4, -1, 0, 0],
        'AVERAGE' <?php echo> [5, -1, 0, 0],
        'MIN' <?php echo> [6, -1, 0, 0],
        'MAX' <?php echo> [7, -1, 0, 0],
        'ROW' <?php echo> [8, -1, 0, 0],
        'COLUMN' <?php echo> [9, -1, 0, 0],
        'NA' <?php echo> [10, 0, 0, 0],
        'NPV' <?php echo> [11, -1, 1, 0],
        'STDEV' <?php echo> [12, -1, 0, 0],
        'DOLLAR' <?php echo> [13, -1, 1, 0],
        'FIXED' <?php echo> [14, -1, 1, 0],
        'SIN' <?php echo> [15, 1, 1, 0],
        'COS' <?php echo> [16, 1, 1, 0],
        'TAN' <?php echo> [17, 1, 1, 0],
        'ATAN' <?php echo> [18, 1, 1, 0],
        'PI' <?php echo> [19, 0, 1, 0],
        'SQRT' <?php echo> [20, 1, 1, 0],
        'EXP' <?php echo> [21, 1, 1, 0],
        'LN' <?php echo> [22, 1, 1, 0],
        'LOG10' <?php echo> [23, 1, 1, 0],
        'ABS' <?php echo> [24, 1, 1, 0],
        'INT' <?php echo> [25, 1, 1, 0],
        'SIGN' <?php echo> [26, 1, 1, 0],
        'ROUND' <?php echo> [27, 2, 1, 0],
        'LOOKUP' <?php echo> [28, -1, 0, 0],
        'INDEX' <?php echo> [29, -1, 0, 1],
        'REPT' <?php echo> [30, 2, 1, 0],
        'MID' <?php echo> [31, 3, 1, 0],
        'LEN' <?php echo> [32, 1, 1, 0],
        'VALUE' <?php echo> [33, 1, 1, 0],
        'TRUE' <?php echo> [34, 0, 1, 0],
        'FALSE' <?php echo> [35, 0, 1, 0],
        'AND' <?php echo> [36, -1, 0, 0],
        'OR' <?php echo> [37, -1, 0, 0],
        'NOT' <?php echo> [38, 1, 1, 0],
        'MOD' <?php echo> [39, 2, 1, 0],
        'DCOUNT' <?php echo> [40, 3, 0, 0],
        'DSUM' <?php echo> [41, 3, 0, 0],
        'DAVERAGE' <?php echo> [42, 3, 0, 0],
        'DMIN' <?php echo> [43, 3, 0, 0],
        'DMAX' <?php echo> [44, 3, 0, 0],
        'DSTDEV' <?php echo> [45, 3, 0, 0],
        'VAR' <?php echo> [46, -1, 0, 0],
        'DVAR' <?php echo> [47, 3, 0, 0],
        'TEXT' <?php echo> [48, 2, 1, 0],
        'LINEST' <?php echo> [49, -1, 0, 0],
        'TREND' <?php echo> [50, -1, 0, 0],
        'LOGEST' <?php echo> [51, -1, 0, 0],
        'GROWTH' <?php echo> [52, -1, 0, 0],
        'PV' <?php echo> [56, -1, 1, 0],
        'FV' <?php echo> [57, -1, 1, 0],
        'NPER' <?php echo> [58, -1, 1, 0],
        'PMT' <?php echo> [59, -1, 1, 0],
        'RATE' <?php echo> [60, -1, 1, 0],
        'MIRR' <?php echo> [61, 3, 0, 0],
        'IRR' <?php echo> [62, -1, 0, 0],
        'RAND' <?php echo> [63, 0, 1, 1],
        'MATCH' <?php echo> [64, -1, 0, 0],
        'DATE' <?php echo> [65, 3, 1, 0],
        'TIME' <?php echo> [66, 3, 1, 0],
        'DAY' <?php echo> [67, 1, 1, 0],
        'MONTH' <?php echo> [68, 1, 1, 0],
        'YEAR' <?php echo> [69, 1, 1, 0],
        'WEEKDAY' <?php echo> [70, -1, 1, 0],
        'HOUR' <?php echo> [71, 1, 1, 0],
        'MINUTE' <?php echo> [72, 1, 1, 0],
        'SECOND' <?php echo> [73, 1, 1, 0],
        'NOW' <?php echo> [74, 0, 1, 1],
        'AREAS' <?php echo> [75, 1, 0, 1],
        'ROWS' <?php echo> [76, 1, 0, 1],
        'COLUMNS' <?php echo> [77, 1, 0, 1],
        'OFFSET' <?php echo> [78, -1, 0, 1],
        'SEARCH' <?php echo> [82, -1, 1, 0],
        'TRANSPOSE' <?php echo> [83, 1, 1, 0],
        'TYPE' <?php echo> [86, 1, 1, 0],
        'ATAN2' <?php echo> [97, 2, 1, 0],
        'ASIN' <?php echo> [98, 1, 1, 0],
        'ACOS' <?php echo> [99, 1, 1, 0],
        'CHOOSE' <?php echo> [100, -1, 1, 0],
        'HLOOKUP' <?php echo> [101, -1, 0, 0],
        'VLOOKUP' <?php echo> [102, -1, 0, 0],
        'ISREF' <?php echo> [105, 1, 0, 0],
        'LOG' <?php echo> [109, -1, 1, 0],
        'CHAR' <?php echo> [111, 1, 1, 0],
        'LOWER' <?php echo> [112, 1, 1, 0],
        'UPPER' <?php echo> [113, 1, 1, 0],
        'PROPER' <?php echo> [114, 1, 1, 0],
        'LEFT' <?php echo> [115, -1, 1, 0],
        'RIGHT' <?php echo> [116, -1, 1, 0],
        'EXACT' <?php echo> [117, 2, 1, 0],
        'TRIM' <?php echo> [118, 1, 1, 0],
        'REPLACE' <?php echo> [119, 4, 1, 0],
        'SUBSTITUTE' <?php echo> [120, -1, 1, 0],
        'CODE' <?php echo> [121, 1, 1, 0],
        'FIND' <?php echo> [124, -1, 1, 0],
        'CELL' <?php echo> [125, -1, 0, 1],
        'ISERR' <?php echo> [126, 1, 1, 0],
        'ISTEXT' <?php echo> [127, 1, 1, 0],
        'ISNUMBER' <?php echo> [128, 1, 1, 0],
        'ISBLANK' <?php echo> [129, 1, 1, 0],
        'T' <?php echo> [130, 1, 0, 0],
        'N' <?php echo> [131, 1, 0, 0],
        'DATEVALUE' <?php echo> [140, 1, 1, 0],
        'TIMEVALUE' <?php echo> [141, 1, 1, 0],
        'SLN' <?php echo> [142, 3, 1, 0],
        'SYD' <?php echo> [143, 4, 1, 0],
        'DDB' <?php echo> [144, -1, 1, 0],
        'INDIRECT' <?php echo> [148, -1, 1, 1],
        'CALL' <?php echo> [150, -1, 1, 0],
        'CLEAN' <?php echo> [162, 1, 1, 0],
        'MDETERM' <?php echo> [163, 1, 2, 0],
        'MINVERSE' <?php echo> [164, 1, 2, 0],
        'MMULT' <?php echo> [165, 2, 2, 0],
        'IPMT' <?php echo> [167, -1, 1, 0],
        'PPMT' <?php echo> [168, -1, 1, 0],
        'COUNTA' <?php echo> [169, -1, 0, 0],
        'PRODUCT' <?php echo> [183, -1, 0, 0],
        'FACT' <?php echo> [184, 1, 1, 0],
        'DPRODUCT' <?php echo> [189, 3, 0, 0],
        'ISNONTEXT' <?php echo> [190, 1, 1, 0],
        'STDEVP' <?php echo> [193, -1, 0, 0],
        'VARP' <?php echo> [194, -1, 0, 0],
        'DSTDEVP' <?php echo> [195, 3, 0, 0],
        'DVARP' <?php echo> [196, 3, 0, 0],
        'TRUNC' <?php echo> [197, -1, 1, 0],
        'ISLOGICAL' <?php echo> [198, 1, 1, 0],
        'DCOUNTA' <?php echo> [199, 3, 0, 0],
        'USDOLLAR' <?php echo> [204, -1, 1, 0],
        'FINDB' <?php echo> [205, -1, 1, 0],
        'SEARCHB' <?php echo> [206, -1, 1, 0],
        'REPLACEB' <?php echo> [207, 4, 1, 0],
        'LEFTB' <?php echo> [208, -1, 1, 0],
        'RIGHTB' <?php echo> [209, -1, 1, 0],
        'MIDB' <?php echo> [210, 3, 1, 0],
        'LENB' <?php echo> [211, 1, 1, 0],
        'ROUNDUP' <?php echo> [212, 2, 1, 0],
        'ROUNDDOWN' <?php echo> [213, 2, 1, 0],
        'ASC' <?php echo> [214, 1, 1, 0],
        'DBCS' <?php echo> [215, 1, 1, 0],
        'RANK' <?php echo> [216, -1, 0, 0],
        'ADDRESS' <?php echo> [219, -1, 1, 0],
        'DAYS360' <?php echo> [220, -1, 1, 0],
        'TODAY' <?php echo> [221, 0, 1, 1],
        'VDB' <?php echo> [222, -1, 1, 0],
        'MEDIAN' <?php echo> [227, -1, 0, 0],
        'SUMPRODUCT' <?php echo> [228, -1, 2, 0],
        'SINH' <?php echo> [229, 1, 1, 0],
        'COSH' <?php echo> [230, 1, 1, 0],
        'TANH' <?php echo> [231, 1, 1, 0],
        'ASINH' <?php echo> [232, 1, 1, 0],
        'ACOSH' <?php echo> [233, 1, 1, 0],
        'ATANH' <?php echo> [234, 1, 1, 0],
        'DGET' <?php echo> [235, 3, 0, 0],
        'INFO' <?php echo> [244, 1, 1, 1],
        'DB' <?php echo> [247, -1, 1, 0],
        'FREQUENCY' <?php echo> [252, 2, 0, 0],
        'ERROR.TYPE' <?php echo> [261, 1, 1, 0],
        'REGISTER.ID' <?php echo> [267, -1, 1, 0],
        'AVEDEV' <?php echo> [269, -1, 0, 0],
        'BETADIST' <?php echo> [270, -1, 1, 0],
        'GAMMALN' <?php echo> [271, 1, 1, 0],
        'BETAINV' <?php echo> [272, -1, 1, 0],
        'BINOMDIST' <?php echo> [273, 4, 1, 0],
        'CHIDIST' <?php echo> [274, 2, 1, 0],
        'CHIINV' <?php echo> [275, 2, 1, 0],
        'COMBIN' <?php echo> [276, 2, 1, 0],
        'CONFIDENCE' <?php echo> [277, 3, 1, 0],
        'CRITBINOM' <?php echo> [278, 3, 1, 0],
        'EVEN' <?php echo> [279, 1, 1, 0],
        'EXPONDIST' <?php echo> [280, 3, 1, 0],
        'FDIST' <?php echo> [281, 3, 1, 0],
        'FINV' <?php echo> [282, 3, 1, 0],
        'FISHER' <?php echo> [283, 1, 1, 0],
        'FISHERINV' <?php echo> [284, 1, 1, 0],
        'FLOOR' <?php echo> [285, 2, 1, 0],
        'GAMMADIST' <?php echo> [286, 4, 1, 0],
        'GAMMAINV' <?php echo> [287, 3, 1, 0],
        'CEILING' <?php echo> [288, 2, 1, 0],
        'HYPGEOMDIST' <?php echo> [289, 4, 1, 0],
        'LOGNORMDIST' <?php echo> [290, 3, 1, 0],
        'LOGINV' <?php echo> [291, 3, 1, 0],
        'NEGBINOMDIST' <?php echo> [292, 3, 1, 0],
        'NORMDIST' <?php echo> [293, 4, 1, 0],
        'NORMSDIST' <?php echo> [294, 1, 1, 0],
        'NORMINV' <?php echo> [295, 3, 1, 0],
        'NORMSINV' <?php echo> [296, 1, 1, 0],
        'STANDARDIZE' <?php echo> [297, 3, 1, 0],
        'ODD' <?php echo> [298, 1, 1, 0],
        'PERMUT' <?php echo> [299, 2, 1, 0],
        'POISSON' <?php echo> [300, 3, 1, 0],
        'TDIST' <?php echo> [301, 3, 1, 0],
        'WEIBULL' <?php echo> [302, 4, 1, 0],
        'SUMXMY2' <?php echo> [303, 2, 2, 0],
        'SUMX2MY2' <?php echo> [304, 2, 2, 0],
        'SUMX2PY2' <?php echo> [305, 2, 2, 0],
        'CHITEST' <?php echo> [306, 2, 2, 0],
        'CORREL' <?php echo> [307, 2, 2, 0],
        'COVAR' <?php echo> [308, 2, 2, 0],
        'FORECAST' <?php echo> [309, 3, 2, 0],
        'FTEST' <?php echo> [310, 2, 2, 0],
        'INTERCEPT' <?php echo> [311, 2, 2, 0],
        'PEARSON' <?php echo> [312, 2, 2, 0],
        'RSQ' <?php echo> [313, 2, 2, 0],
        'STEYX' <?php echo> [314, 2, 2, 0],
        'SLOPE' <?php echo> [315, 2, 2, 0],
        'TTEST' <?php echo> [316, 4, 2, 0],
        'PROB' <?php echo> [317, -1, 2, 0],
        'DEVSQ' <?php echo> [318, -1, 0, 0],
        'GEOMEAN' <?php echo> [319, -1, 0, 0],
        'HARMEAN' <?php echo> [320, -1, 0, 0],
        'SUMSQ' <?php echo> [321, -1, 0, 0],
        'KURT' <?php echo> [322, -1, 0, 0],
        'SKEW' <?php echo> [323, -1, 0, 0],
        'ZTEST' <?php echo> [324, -1, 0, 0],
        'LARGE' <?php echo> [325, 2, 0, 0],
        'SMALL' <?php echo> [326, 2, 0, 0],
        'QUARTILE' <?php echo> [327, 2, 0, 0],
        'PERCENTILE' <?php echo> [328, 2, 0, 0],
        'PERCENTRANK' <?php echo> [329, -1, 0, 0],
        'MODE' <?php echo> [330, -1, 2, 0],
        'TRIMMEAN' <?php echo> [331, 2, 0, 0],
        'TINV' <?php echo> [332, 2, 1, 0],
        'CONCATENATE' <?php echo> [336, -1, 1, 0],
        'POWER' <?php echo> [337, 2, 1, 0],
        'RADIANS' <?php echo> [342, 1, 1, 0],
        'DEGREES' <?php echo> [343, 1, 1, 0],
        'SUBTOTAL' <?php echo> [344, -1, 0, 0],
        'SUMIF' <?php echo> [345, -1, 0, 0],
        'COUNTIF' <?php echo> [346, 2, 0, 0],
        'COUNTBLANK' <?php echo> [347, 1, 0, 0],
        'ISPMT' <?php echo> [350, 4, 1, 0],
        'DATEDIF' <?php echo> [351, 3, 1, 0],
        'DATESTRING' <?php echo> [352, 1, 1, 0],
        'NUMBERSTRING' <?php echo> [353, 2, 1, 0],
        'ROMAN' <?php echo> [354, -1, 1, 0],
        'GETPIVOTDATA' <?php echo> [358, -1, 0, 0],
        'HYPERLINK' <?php echo> [359, -1, 1, 0],
        'PHONETIC' <?php echo> [360, 1, 0, 0],
        'AVERAGEA' <?php echo> [361, -1, 0, 0],
        'MAXA' <?php echo> [362, -1, 0, 0],
        'MINA' <?php echo> [363, -1, 0, 0],
        'STDEVPA' <?php echo> [364, -1, 0, 0],
        'VARPA' <?php echo> [365, -1, 0, 0],
        'STDEVA' <?php echo> [366, -1, 0, 0],
        'VARA' <?php echo> [367, -1, 0, 0],
        'BAHTTEXT' <?php echo> [368, 1, 0, 0],
    ];

    /** @var Spreadsheet */
    private $spreadsheet;

    /**
     * The class constructor.
     */
    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet <?php echo $spreadsheet;

        $this->currentCharacter <?php echo 0;
        $this->currentToken <?php echo ''; // The token we are working on.
        $this->formula <?php echo ''; // The formula to parse.
        $this->lookAhead <?php echo ''; // The character ahead of the current char.
        $this->parseTree <?php echo ''; // The parse tree to be generated.
        $this->externalSheets <?php echo [];
        $this->references <?php echo [];
    }

    /**
     * Convert a token to the proper ptg value.
     *
     * @param mixed $token the token to convert
     *
     * @return mixed the converted token on success
     */
    private function convert($token)
    {
        if (preg_match('/"([^"]|""){0,255}"/', $token)) {
            return $this->convertString($token);
        }
        if (is_numeric($token)) {
            return $this->convertNumber($token);
        }
        // match references like A1 or $A$1
        if (preg_match('/^\$?([A-Ia-i]?[A-Za-z])\$?(\d+)$/', $token)) {
            return $this->convertRef2d($token);
        }
        // match external references like Sheet1!A1 or Sheet1:Sheet2!A1 or Sheet1!$A$1 or Sheet1:Sheet2!$A$1
        if (preg_match('/^' . self::REGEX_SHEET_TITLE_UNQUOTED . '(\\:' . self::REGEX_SHEET_TITLE_UNQUOTED . ')?\\!\$?[A-Ia-i]?[A-Za-z]\$?(\\d+)$/u', $token)) {
            return $this->convertRef3d($token);
        }
        // match external references like 'Sheet1'!A1 or 'Sheet1:Sheet2'!A1 or 'Sheet1'!$A$1 or 'Sheet1:Sheet2'!$A$1
        if (preg_match("/^'" . self::REGEX_SHEET_TITLE_QUOTED . '(\\:' . self::REGEX_SHEET_TITLE_QUOTED . ")?'\\!\\$?[A-Ia-i]?[A-Za-z]\\$?(\\d+)$/u", $token)) {
            return $this->convertRef3d($token);
        }
        // match ranges like A1:B2 or $A$1:$B$2
        if (preg_match('/^(\$)?[A-Ia-i]?[A-Za-z](\$)?(\d+)\:(\$)?[A-Ia-i]?[A-Za-z](\$)?(\d+)$/', $token)) {
            return $this->convertRange2d($token);
        }
        // match external ranges like Sheet1!A1:B2 or Sheet1:Sheet2!A1:B2 or Sheet1!$A$1:$B$2 or Sheet1:Sheet2!$A$1:$B$2
        if (preg_match('/^' . self::REGEX_SHEET_TITLE_UNQUOTED . '(\\:' . self::REGEX_SHEET_TITLE_UNQUOTED . ')?\\!\$?([A-Ia-i]?[A-Za-z])?\$?(\\d+)\\:\$?([A-Ia-i]?[A-Za-z])?\$?(\\d+)$/u', $token)) {
            return $this->convertRange3d($token);
        }
        // match external ranges like 'Sheet1'!A1:B2 or 'Sheet1:Sheet2'!A1:B2 or 'Sheet1'!$A$1:$B$2 or 'Sheet1:Sheet2'!$A$1:$B$2
        if (preg_match("/^'" . self::REGEX_SHEET_TITLE_QUOTED . '(\\:' . self::REGEX_SHEET_TITLE_QUOTED . ")?'\\!\\$?([A-Ia-i]?[A-Za-z])?\\$?(\\d+)\\:\\$?([A-Ia-i]?[A-Za-z])?\\$?(\\d+)$/u", $token)) {
            return $this->convertRange3d($token);
        }
        // operators (including parentheses)
        if (isset($this->ptg[$token])) {
            return pack('C', $this->ptg[$token]);
        }
        // match error codes
        if (preg_match('/^#[A-Z0\\/]{3,5}[!?]{1}$/', $token) || $token <?php echo<?php echo '#N/A') {
            return $this->convertError($token);
        }
        if (preg_match('/^' . Calculation::CALCULATION_REGEXP_DEFINEDNAME . '$/mui', $token) && $this->spreadsheet->getDefinedName($token) !<?php echo<?php echo null) {
            return $this->convertDefinedName($token);
        }
        // commented so argument number can be processed correctly. See toReversePolish().
        /*if (preg_match("/[A-Z0-9\xc0-\xdc\.]+/", $token))
        {
            return($this->convertFunction($token, $this->_func_args));
        }*/
        // if it's an argument, ignore the token (the argument remains)
        if ($token <?php echo<?php echo 'arg') {
            return '';
        }
        if (preg_match('/^true$/i', $token)) {
            return $this->convertBool(1);
        }
        if (preg_match('/^false$/i', $token)) {
            return $this->convertBool(0);
        }

        // TODO: use real error codes
        throw new WriterException("Unknown token $token");
    }

    /**
     * Convert a number token to ptgInt or ptgNum.
     *
     * @param mixed $num an integer or double for conversion to its ptg value
     *
     * @return string
     */
    private function convertNumber($num)
    {
        // Integer in the range 0..2**16-1
        if ((preg_match('/^\\d+$/', $num)) && ($num <?php echo 65535)) {
            return pack('Cv', $this->ptg['ptgInt'], $num);
        }

        // A float
        if (BIFFwriter::getByteOrder()) { // if it's Big Endian
            $num <?php echo strrev($num);
        }

        return pack('Cd', $this->ptg['ptgNum'], $num);
    }

    private function convertBool(int $num): string
    {
        return pack('CC', $this->ptg['ptgBool'], $num);
    }

    /**
     * Convert a string token to ptgStr.
     *
     * @param string $string a string for conversion to its ptg value
     *
     * @return mixed the converted token on success
     */
    private function convertString($string)
    {
        // chop away beggining and ending quotes
        $string <?php echo substr($string, 1, -1);
        if (strlen($string) > 255) {
            throw new WriterException('String is too long');
        }

        return pack('C', $this->ptg['ptgStr']) . StringHelper::UTF8toBIFF8UnicodeShort($string);
    }

    /**
     * Convert a function to a ptgFunc or ptgFuncVarV depending on the number of
     * args that it takes.
     *
     * @param string $token the name of the function for convertion to ptg value
     * @param int $num_args the number of arguments the function receives
     *
     * @return string The packed ptg for the function
     */
    private function convertFunction($token, $num_args)
    {
        $args <?php echo $this->functions[$token][1];

        // Fixed number of args eg. TIME($i, $j, $k).
        if ($args ><?php echo 0) {
            return pack('Cv', $this->ptg['ptgFuncV'], $this->functions[$token][0]);
        }

        // Variable number of args eg. SUM($i, $j, $k, ..).
        return pack('CCv', $this->ptg['ptgFuncVarV'], $num_args, $this->functions[$token][0]);
    }

    /**
     * Convert an Excel range such as A1:D4 to a ptgRefV.
     *
     * @param string $range An Excel range in the A1:A2
     * @param int $class
     *
     * @return string
     */
    private function convertRange2d($range, $class <?php echo 0)
    {
        // TODO: possible class value 0,1,2 check Formula.pm
        // Split the range into 2 cell refs
        if (preg_match('/^(\$)?([A-Ia-i]?[A-Za-z])(\$)?(\d+)\:(\$)?([A-Ia-i]?[A-Za-z])(\$)?(\d+)$/', $range)) {
            [$cell1, $cell2] <?php echo explode(':', $range);
        } else {
            // TODO: use real error codes
            throw new WriterException('Unknown range separator');
        }
        // Convert the cell references
        [$row1, $col1] <?php echo $this->cellToPackedRowcol($cell1);
        [$row2, $col2] <?php echo $this->cellToPackedRowcol($cell2);

        // The ptg value depends on the class of the ptg.
        if ($class <?php echo<?php echo 0) {
            $ptgArea <?php echo pack('C', $this->ptg['ptgArea']);
        } elseif ($class <?php echo<?php echo 1) {
            $ptgArea <?php echo pack('C', $this->ptg['ptgAreaV']);
        } elseif ($class <?php echo<?php echo 2) {
            $ptgArea <?php echo pack('C', $this->ptg['ptgAreaA']);
        } else {
            // TODO: use real error codes
            throw new WriterException("Unknown class $class");
        }

        return $ptgArea . $row1 . $row2 . $col1 . $col2;
    }

    /**
     * Convert an Excel 3d range such as "Sheet1!A1:D4" or "Sheet1:Sheet2!A1:D4" to
     * a ptgArea3d.
     *
     * @param string $token an Excel range in the Sheet1!A1:A2 format
     *
     * @return mixed the packed ptgArea3d token on success
     */
    private function convertRange3d($token)
    {
        // Split the ref at the ! symbol
        [$ext_ref, $range] <?php echo PhpspreadsheetWorksheet::extractSheetTitle($token, true);

        // Convert the external reference part (different for BIFF8)
        $ext_ref <?php echo $this->getRefIndex($ext_ref);

        // Split the range into 2 cell refs
        [$cell1, $cell2] <?php echo explode(':', $range);

        // Convert the cell references
        if (preg_match('/^(\$)?[A-Ia-i]?[A-Za-z](\$)?(\\d+)$/', $cell1)) {
            [$row1, $col1] <?php echo $this->cellToPackedRowcol($cell1);
            [$row2, $col2] <?php echo $this->cellToPackedRowcol($cell2);
        } else { // It's a rows range (like 26:27)
            [$row1, $col1, $row2, $col2] <?php echo $this->rangeToPackedRange($cell1 . ':' . $cell2);
        }

        // The ptg value depends on the class of the ptg.
        $ptgArea <?php echo pack('C', $this->ptg['ptgArea3d']);

        return $ptgArea . $ext_ref . $row1 . $row2 . $col1 . $col2;
    }

    /**
     * Convert an Excel reference such as A1, $B2, C$3 or $D$4 to a ptgRefV.
     *
     * @param string $cell An Excel cell reference
     *
     * @return string The cell in packed() format with the corresponding ptg
     */
    private function convertRef2d($cell)
    {
        // Convert the cell reference
        $cell_array <?php echo $this->cellToPackedRowcol($cell);
        [$row, $col] <?php echo $cell_array;

        // The ptg value depends on the class of the ptg.
        $ptgRef <?php echo pack('C', $this->ptg['ptgRefA']);

        return $ptgRef . $row . $col;
    }

    /**
     * Convert an Excel 3d reference such as "Sheet1!A1" or "Sheet1:Sheet2!A1" to a
     * ptgRef3d.
     *
     * @param string $cell An Excel cell reference
     *
     * @return mixed the packed ptgRef3d token on success
     */
    private function convertRef3d($cell)
    {
        // Split the ref at the ! symbol
        [$ext_ref, $cell] <?php echo PhpspreadsheetWorksheet::extractSheetTitle($cell, true);

        // Convert the external reference part (different for BIFF8)
        $ext_ref <?php echo $this->getRefIndex($ext_ref);

        // Convert the cell reference part
        [$row, $col] <?php echo $this->cellToPackedRowcol($cell);

        // The ptg value depends on the class of the ptg.
        $ptgRef <?php echo pack('C', $this->ptg['ptgRef3dA']);

        return $ptgRef . $ext_ref . $row . $col;
    }

    /**
     * Convert an error code to a ptgErr.
     *
     * @param string $errorCode The error code for conversion to its ptg value
     *
     * @return string The error code ptgErr
     */
    private function convertError($errorCode)
    {
        switch ($errorCode) {
            case '#NULL!':
                return pack('C', 0x00);
            case '#DIV/0!':
                return pack('C', 0x07);
            case '#VALUE!':
                return pack('C', 0x0F);
            case '#REF!':
                return pack('C', 0x17);
            case '#NAME?':
                return pack('C', 0x1D);
            case '#NUM!':
                return pack('C', 0x24);
            case '#N/A':
                return pack('C', 0x2A);
        }

        return pack('C', 0xFF);
    }

    /** @var bool */
    private $tryDefinedName <?php echo false;

    private function convertDefinedName(string $name): string
    {
        if (strlen($name) > 255) {
            throw new WriterException('Defined Name is too long');
        }

        if ($this->tryDefinedName) {
            // @codeCoverageIgnoreStart
            $nameReference <?php echo 1;
            foreach ($this->spreadsheet->getDefinedNames() as $definedName) {
                if ($name <?php echo<?php echo<?php echo $definedName->getName()) {
                    break;
                }
                ++$nameReference;
            }

            $ptgRef <?php echo pack('Cvxx', $this->ptg['ptgName'], $nameReference);

            return $ptgRef;
            // @codeCoverageIgnoreEnd
        }

        throw new WriterException('Cannot yet write formulae with defined names to Xls');
    }

    /**
     * Look up the REF index that corresponds to an external sheet name
     * (or range). If it doesn't exist yet add it to the workbook's references
     * array. It assumes all sheet names given must exist.
     *
     * @param string $ext_ref The name of the external reference
     *
     * @return mixed The reference index in packed() format on success
     */
    private function getRefIndex($ext_ref)
    {
        $ext_ref <?php echo (string) preg_replace(["/^'/", "/'$/"], ['', ''], $ext_ref); // Remove leading and trailing ' if any.
        $ext_ref <?php echo str_replace('\'\'', '\'', $ext_ref); // Replace escaped '' with '

        // Check if there is a sheet range eg., Sheet1:Sheet2.
        if (preg_match('/:/', $ext_ref)) {
            [$sheet_name1, $sheet_name2] <?php echo explode(':', $ext_ref);

            $sheet1 <?php echo $this->getSheetIndex($sheet_name1);
            if ($sheet1 <?php echo<?php echo -1) {
                throw new WriterException("Unknown sheet name $sheet_name1 in formula");
            }
            $sheet2 <?php echo $this->getSheetIndex($sheet_name2);
            if ($sheet2 <?php echo<?php echo -1) {
                throw new WriterException("Unknown sheet name $sheet_name2 in formula");
            }

            // Reverse max and min sheet numbers if necessary
            if ($sheet1 > $sheet2) {
                [$sheet1, $sheet2] <?php echo [$sheet2, $sheet1];
            }
        } else { // Single sheet name only.
            $sheet1 <?php echo $this->getSheetIndex($ext_ref);
            if ($sheet1 <?php echo<?php echo -1) {
                throw new WriterException("Unknown sheet name $ext_ref in formula");
            }
            $sheet2 <?php echo $sheet1;
        }

        // assume all references belong to this document
        $supbook_index <?php echo 0x00;
        $ref <?php echo pack('vvv', $supbook_index, $sheet1, $sheet2);
        $totalreferences <?php echo count($this->references);
        $index <?php echo -1;
        for ($i <?php echo 0; $i < $totalreferences; ++$i) {
            if ($ref <?php echo<?php echo $this->references[$i]) {
                $index <?php echo $i;

                break;
            }
        }
        // if REF was not found add it to references array
        if ($index <?php echo<?php echo -1) {
            $this->references[$totalreferences] <?php echo $ref;
            $index <?php echo $totalreferences;
        }

        return pack('v', $index);
    }

    /**
     * Look up the index that corresponds to an external sheet name. The hash of
     * sheet names is updated by the addworksheet() method of the
     * \PhpOffice\PhpSpreadsheet\Writer\Xls\Workbook class.
     *
     * @param string $sheet_name Sheet name
     *
     * @return int The sheet index, -1 if the sheet was not found
     */
    private function getSheetIndex($sheet_name)
    {
        if (!isset($this->externalSheets[$sheet_name])) {
            return -1;
        }

        return $this->externalSheets[$sheet_name];
    }

    /**
     * This method is used to update the array of sheet names. It is
     * called by the addWorksheet() method of the
     * \PhpOffice\PhpSpreadsheet\Writer\Xls\Workbook class.
     *
     * @param string $name The name of the worksheet being added
     * @param int $index The index of the worksheet being added
     *
     * @see \PhpOffice\PhpSpreadsheet\Writer\Xls\Workbook::addWorksheet()
     */
    public function setExtSheet($name, $index): void
    {
        $this->externalSheets[$name] <?php echo $index;
    }

    /**
     * pack() row and column into the required 3 or 4 byte format.
     *
     * @param string $cell The Excel cell reference to be packed
     *
     * @return array Array containing the row and column in packed() format
     */
    private function cellToPackedRowcol($cell)
    {
        $cell <?php echo strtoupper($cell);
        [$row, $col, $row_rel, $col_rel] <?php echo $this->cellToRowcol($cell);
        if ($col ><?php echo 256) {
            throw new WriterException("Column in: $cell greater than 255");
        }
        if ($row ><?php echo 65536) {
            throw new WriterException("Row in: $cell greater than 65536 ");
        }

        // Set the high bits to indicate if row or col are relative.
        $col |<?php echo $col_rel << 14;
        $col |<?php echo $row_rel << 15;
        $col <?php echo pack('v', $col);

        $row <?php echo pack('v', $row);

        return [$row, $col];
    }

    /**
     * pack() row range into the required 3 or 4 byte format.
     * Just using maximum col/rows, which is probably not the correct solution.
     *
     * @param string $range The Excel range to be packed
     *
     * @return array Array containing (row1,col1,row2,col2) in packed() format
     */
    private function rangeToPackedRange($range)
    {
        preg_match('/(\$)?(\d+)\:(\$)?(\d+)/', $range, $match);
        // return absolute rows if there is a $ in the ref
        $row1_rel <?php echo empty($match[1]) ? 1 : 0;
        $row1 <?php echo $match[2];
        $row2_rel <?php echo empty($match[3]) ? 1 : 0;
        $row2 <?php echo $match[4];
        // Convert 1-index to zero-index
        --$row1;
        --$row2;
        // Trick poor inocent Excel
        $col1 <?php echo 0;
        $col2 <?php echo 65535; // FIXME: maximum possible value for Excel 5 (change this!!!)

        // FIXME: this changes for BIFF8
        if (($row1 ><?php echo 65536) || ($row2 ><?php echo 65536)) {
            throw new WriterException("Row in: $range greater than 65536 ");
        }

        // Set the high bits to indicate if rows are relative.
        $col1 |<?php echo $row1_rel << 15;
        $col2 |<?php echo $row2_rel << 15;
        $col1 <?php echo pack('v', $col1);
        $col2 <?php echo pack('v', $col2);

        $row1 <?php echo pack('v', $row1);
        $row2 <?php echo pack('v', $row2);

        return [$row1, $col1, $row2, $col2];
    }

    /**
     * Convert an Excel cell reference such as A1 or $B2 or C$3 or $D$4 to a zero
     * indexed row and column number. Also returns two (0,1) values to indicate
     * whether the row or column are relative references.
     *
     * @param string $cell the Excel cell reference in A1 format
     *
     * @return array
     */
    private function cellToRowcol($cell)
    {
        preg_match('/(\$)?([A-I]?[A-Z])(\$)?(\d+)/', $cell, $match);
        // return absolute column if there is a $ in the ref
        $col_rel <?php echo empty($match[1]) ? 1 : 0;
        $col_ref <?php echo $match[2];
        $row_rel <?php echo empty($match[3]) ? 1 : 0;
        $row <?php echo $match[4];

        // Convert base26 column string to a number.
        $expn <?php echo strlen($col_ref) - 1;
        $col <?php echo 0;
        $col_ref_length <?php echo strlen($col_ref);
        for ($i <?php echo 0; $i < $col_ref_length; ++$i) {
            $col +<?php echo (ord($col_ref[$i]) - 64) * 26 ** $expn;
            --$expn;
        }

        // Convert 1-index to zero-index
        --$row;
        --$col;

        return [$row, $col, $row_rel, $col_rel];
    }

    /**
     * Advance to the next valid token.
     */
    private function advance(): void
    {
        $token <?php echo '';
        $i <?php echo $this->currentCharacter;
        $formula_length <?php echo strlen($this->formula);
        // eat up white spaces
        if ($i < $formula_length) {
            while ($this->formula[$i] <?php echo<?php echo ' ') {
                ++$i;
            }

            if ($i < ($formula_length - 1)) {
                $this->lookAhead <?php echo $this->formula[$i + 1];
            }
            $token <?php echo '';
        }

        while ($i < $formula_length) {
            $token .<?php echo $this->formula[$i];

            if ($i < ($formula_length - 1)) {
                $this->lookAhead <?php echo $this->formula[$i + 1];
            } else {
                $this->lookAhead <?php echo '';
            }

            if ($this->match($token) !<?php echo '') {
                $this->currentCharacter <?php echo $i + 1;
                $this->currentToken <?php echo $token;

                return;
            }

            if ($i < ($formula_length - 2)) {
                $this->lookAhead <?php echo $this->formula[$i + 2];
            } else { // if we run out of characters lookAhead becomes empty
                $this->lookAhead <?php echo '';
            }
            ++$i;
        }
        //die("Lexical error ".$this->currentCharacter);
    }

    /**
     * Checks if it's a valid token.
     *
     * @param mixed $token the token to check
     *
     * @return mixed The checked token or false on failure
     */
    private function match($token)
    {
        switch ($token) {
            case '+':
            case '-':
            case '*':
            case '/':
            case '(':
            case ')':
            case ',':
            case ';':
            case '><?php echo':
            case '<?php echo':
            case '<?php echo':
            case '<>':
            case '^':
            case '&':
            case '%':
                return $token;

            case '>':
                if ($this->lookAhead <?php echo<?php echo<?php echo '<?php echo') { // it's a GE token
                    break;
                }

                return $token;

            case '<':
                // it's a LE or a NE token
                if (($this->lookAhead <?php echo<?php echo<?php echo '<?php echo') || ($this->lookAhead <?php echo<?php echo<?php echo '>')) {
                    break;
                }

                return $token;
        }

        // if it's a reference A1 or $A$1 or $A1 or A$1
        if (preg_match('/^\$?[A-Ia-i]?[A-Za-z]\$?\d+$/', $token) && !preg_match('/\d/', $this->lookAhead) && ($this->lookAhead !<?php echo<?php echo ':') && ($this->lookAhead !<?php echo<?php echo '.') && ($this->lookAhead !<?php echo<?php echo '!')) {
            return $token;
        }
        // If it's an external reference (Sheet1!A1 or Sheet1:Sheet2!A1 or Sheet1!$A$1 or Sheet1:Sheet2!$A$1)
        if (preg_match('/^' . self::REGEX_SHEET_TITLE_UNQUOTED . '(\\:' . self::REGEX_SHEET_TITLE_UNQUOTED . ')?\\!\$?[A-Ia-i]?[A-Za-z]\$?\\d+$/u', $token) && !preg_match('/\d/', $this->lookAhead) && ($this->lookAhead !<?php echo<?php echo ':') && ($this->lookAhead !<?php echo<?php echo '.')) {
            return $token;
        }
        // If it's an external reference ('Sheet1'!A1 or 'Sheet1:Sheet2'!A1 or 'Sheet1'!$A$1 or 'Sheet1:Sheet2'!$A$1)
        if (preg_match("/^'" . self::REGEX_SHEET_TITLE_QUOTED . '(\\:' . self::REGEX_SHEET_TITLE_QUOTED . ")?'\\!\\$?[A-Ia-i]?[A-Za-z]\\$?\\d+$/u", $token) && !preg_match('/\d/', $this->lookAhead) && ($this->lookAhead !<?php echo<?php echo ':') && ($this->lookAhead !<?php echo<?php echo '.')) {
            return $token;
        }
        // if it's a range A1:A2 or $A$1:$A$2
        if (preg_match('/^(\$)?[A-Ia-i]?[A-Za-z](\$)?\d+:(\$)?[A-Ia-i]?[A-Za-z](\$)?\d+$/', $token) && !preg_match('/\d/', $this->lookAhead)) {
            return $token;
        }
        // If it's an external range like Sheet1!A1:B2 or Sheet1:Sheet2!A1:B2 or Sheet1!$A$1:$B$2 or Sheet1:Sheet2!$A$1:$B$2
        if (preg_match('/^' . self::REGEX_SHEET_TITLE_UNQUOTED . '(\\:' . self::REGEX_SHEET_TITLE_UNQUOTED . ')?\\!\$?([A-Ia-i]?[A-Za-z])?\$?\\d+:\$?([A-Ia-i]?[A-Za-z])?\$?\\d+$/u', $token) && !preg_match('/\d/', $this->lookAhead)) {
            return $token;
        }
        // If it's an external range like 'Sheet1'!A1:B2 or 'Sheet1:Sheet2'!A1:B2 or 'Sheet1'!$A$1:$B$2 or 'Sheet1:Sheet2'!$A$1:$B$2
        if (preg_match("/^'" . self::REGEX_SHEET_TITLE_QUOTED . '(\\:' . self::REGEX_SHEET_TITLE_QUOTED . ")?'\\!\\$?([A-Ia-i]?[A-Za-z])?\\$?\\d+:\\$?([A-Ia-i]?[A-Za-z])?\\$?\\d+$/u", $token) && !preg_match('/\d/', $this->lookAhead)) {
            return $token;
        }
        // If it's a number (check that it's not a sheet name or range)
        if (is_numeric($token) && (!is_numeric($token . $this->lookAhead) || ($this->lookAhead <?php echo<?php echo '')) && ($this->lookAhead !<?php echo<?php echo '!') && ($this->lookAhead !<?php echo<?php echo ':')) {
            return $token;
        }
        if (preg_match('/"([^"]|""){0,255}"/', $token) && $this->lookAhead !<?php echo<?php echo '"' && (substr_count($token, '"') % 2 <?php echo<?php echo 0)) {
            // If it's a string (of maximum 255 characters)
            return $token;
        }
        // If it's an error code
        if (preg_match('/^#[A-Z0\\/]{3,5}[!?]{1}$/', $token) || $token <?php echo<?php echo<?php echo '#N/A') {
            return $token;
        }
        // if it's a function call
        if (preg_match("/^[A-Z0-9\xc0-\xdc\\.]+$/i", $token) && ($this->lookAhead <?php echo<?php echo<?php echo '(')) {
            return $token;
        }
        if (preg_match('/^' . Calculation::CALCULATION_REGEXP_DEFINEDNAME . '$/miu', $token) && $this->spreadsheet->getDefinedName($token) !<?php echo<?php echo null) {
            return $token;
        }
        if (preg_match('/^true$/i', $token) && ($this->lookAhead <?php echo<?php echo<?php echo ')' || $this->lookAhead <?php echo<?php echo<?php echo ',')) {
            return $token;
        }
        if (preg_match('/^false$/i', $token) && ($this->lookAhead <?php echo<?php echo<?php echo ')' || $this->lookAhead <?php echo<?php echo<?php echo ',')) {
            return $token;
        }
        if (substr($token, -1) <?php echo<?php echo<?php echo ')') {
            //    It's an argument of some description (e.g. a named range),
            //        precise nature yet to be determined
            return $token;
        }

        return '';
    }

    /**
     * The parsing method. It parses a formula.
     *
     * @param string $formula the formula to parse, without the initial equal
     *                        sign (<?php echo)
     *
     * @return mixed true on success
     */
    public function parse($formula)
    {
        $this->currentCharacter <?php echo 0;
        $this->formula <?php echo (string) $formula;
        $this->lookAhead <?php echo $formula[1] ?? '';
        $this->advance();
        $this->parseTree <?php echo $this->condition();

        return true;
    }

    /**
     * It parses a condition. It assumes the following rule:
     * Cond -> Expr [(">" | "<") Expr].
     *
     * @return mixed The parsed ptg'd tree on success
     */
    private function condition()
    {
        $result <?php echo $this->expression();
        if ($this->currentToken <?php echo<?php echo '<') {
            $this->advance();
            $result2 <?php echo $this->expression();
            $result <?php echo $this->createTree('ptgLT', $result, $result2);
        } elseif ($this->currentToken <?php echo<?php echo '>') {
            $this->advance();
            $result2 <?php echo $this->expression();
            $result <?php echo $this->createTree('ptgGT', $result, $result2);
        } elseif ($this->currentToken <?php echo<?php echo '<?php echo') {
            $this->advance();
            $result2 <?php echo $this->expression();
            $result <?php echo $this->createTree('ptgLE', $result, $result2);
        } elseif ($this->currentToken <?php echo<?php echo '><?php echo') {
            $this->advance();
            $result2 <?php echo $this->expression();
            $result <?php echo $this->createTree('ptgGE', $result, $result2);
        } elseif ($this->currentToken <?php echo<?php echo '<?php echo') {
            $this->advance();
            $result2 <?php echo $this->expression();
            $result <?php echo $this->createTree('ptgEQ', $result, $result2);
        } elseif ($this->currentToken <?php echo<?php echo '<>') {
            $this->advance();
            $result2 <?php echo $this->expression();
            $result <?php echo $this->createTree('ptgNE', $result, $result2);
        }

        return $result;
    }

    /**
     * It parses a expression. It assumes the following rule:
     * Expr -> Term [("+" | "-") Term]
     *      -> "string"
     *      -> "-" Term : Negative value
     *      -> "+" Term : Positive value
     *      -> Error code.
     *
     * @return mixed The parsed ptg'd tree on success
     */
    private function expression()
    {
        // If it's a string return a string node
        if (preg_match('/"([^"]|""){0,255}"/', $this->currentToken)) {
            $tmp <?php echo str_replace('""', '"', $this->currentToken);
            if (($tmp <?php echo<?php echo '"') || ($tmp <?php echo<?php echo '')) {
                //    Trap for "" that has been used for an empty string
                $tmp <?php echo '""';
            }
            $result <?php echo $this->createTree($tmp, '', '');
            $this->advance();

            return $result;
        } elseif (preg_match('/^#[A-Z0\\/]{3,5}[!?]{1}$/', $this->currentToken) || $this->currentToken <?php echo<?php echo '#N/A') { // error code
            $result <?php echo $this->createTree($this->currentToken, 'ptgErr', '');
            $this->advance();

            return $result;
        } elseif ($this->currentToken <?php echo<?php echo '-') { // negative value
            // catch "-" Term
            $this->advance();
            $result2 <?php echo $this->expression();

            return $this->createTree('ptgUminus', $result2, '');
        } elseif ($this->currentToken <?php echo<?php echo '+') { // positive value
            // catch "+" Term
            $this->advance();
            $result2 <?php echo $this->expression();

            return $this->createTree('ptgUplus', $result2, '');
        }
        $result <?php echo $this->term();
        while ($this->currentToken <?php echo<?php echo<?php echo '&') {
            $this->advance();
            $result2 <?php echo $this->expression();
            $result <?php echo $this->createTree('ptgConcat', $result, $result2);
        }
        while (
            ($this->currentToken <?php echo<?php echo '+') ||
            ($this->currentToken <?php echo<?php echo '-') ||
            ($this->currentToken <?php echo<?php echo '^')
        ) {
            if ($this->currentToken <?php echo<?php echo '+') {
                $this->advance();
                $result2 <?php echo $this->term();
                $result <?php echo $this->createTree('ptgAdd', $result, $result2);
            } elseif ($this->currentToken <?php echo<?php echo '-') {
                $this->advance();
                $result2 <?php echo $this->term();
                $result <?php echo $this->createTree('ptgSub', $result, $result2);
            } else {
                $this->advance();
                $result2 <?php echo $this->term();
                $result <?php echo $this->createTree('ptgPower', $result, $result2);
            }
        }

        return $result;
    }

    /**
     * This function just introduces a ptgParen element in the tree, so that Excel
     * doesn't get confused when working with a parenthesized formula afterwards.
     *
     * @return array The parsed ptg'd tree
     *
     * @see fact()
     */
    private function parenthesizedExpression()
    {
        return $this->createTree('ptgParen', $this->expression(), '');
    }

    /**
     * It parses a term. It assumes the following rule:
     * Term -> Fact [("*" | "/") Fact].
     *
     * @return mixed The parsed ptg'd tree on success
     */
    private function term()
    {
        $result <?php echo $this->fact();
        while (
            ($this->currentToken <?php echo<?php echo '*') ||
            ($this->currentToken <?php echo<?php echo '/')
        ) {
            if ($this->currentToken <?php echo<?php echo '*') {
                $this->advance();
                $result2 <?php echo $this->fact();
                $result <?php echo $this->createTree('ptgMul', $result, $result2);
            } else {
                $this->advance();
                $result2 <?php echo $this->fact();
                $result <?php echo $this->createTree('ptgDiv', $result, $result2);
            }
        }

        return $result;
    }

    /**
     * It parses a factor. It assumes the following rule:
     * Fact -> ( Expr )
     *       | CellRef
     *       | CellRange
     *       | Number
     *       | Function.
     *
     * @return mixed The parsed ptg'd tree on success
     */
    private function fact()
    {
        $currentToken <?php echo $this->currentToken;
        if ($currentToken <?php echo<?php echo<?php echo '(') {
            $this->advance(); // eat the "("
            $result <?php echo $this->parenthesizedExpression();
            if ($this->currentToken !<?php echo<?php echo ')') {
                throw new WriterException("')' token expected.");
            }
            $this->advance(); // eat the ")"

            return $result;
        }
        // if it's a reference
        if (preg_match('/^\$?[A-Ia-i]?[A-Za-z]\$?\d+$/', $this->currentToken)) {
            $result <?php echo $this->createTree($this->currentToken, '', '');
            $this->advance();

            return $result;
        }
        if (preg_match('/^' . self::REGEX_SHEET_TITLE_UNQUOTED . '(\\:' . self::REGEX_SHEET_TITLE_UNQUOTED . ')?\\!\$?[A-Ia-i]?[A-Za-z]\$?\\d+$/u', $this->currentToken)) {
            // If it's an external reference (Sheet1!A1 or Sheet1:Sheet2!A1 or Sheet1!$A$1 or Sheet1:Sheet2!$A$1)
            $result <?php echo $this->createTree($this->currentToken, '', '');
            $this->advance();

            return $result;
        }
        if (preg_match("/^'" . self::REGEX_SHEET_TITLE_QUOTED . '(\\:' . self::REGEX_SHEET_TITLE_QUOTED . ")?'\\!\\$?[A-Ia-i]?[A-Za-z]\\$?\\d+$/u", $this->currentToken)) {
            // If it's an external reference ('Sheet1'!A1 or 'Sheet1:Sheet2'!A1 or 'Sheet1'!$A$1 or 'Sheet1:Sheet2'!$A$1)
            $result <?php echo $this->createTree($this->currentToken, '', '');
            $this->advance();

            return $result;
        }
        if (
            preg_match('/^(\$)?[A-Ia-i]?[A-Za-z](\$)?\d+:(\$)?[A-Ia-i]?[A-Za-z](\$)?\d+$/', $this->currentToken) ||
            preg_match('/^(\$)?[A-Ia-i]?[A-Za-z](\$)?\d+\.\.(\$)?[A-Ia-i]?[A-Za-z](\$)?\d+$/', $this->currentToken)
        ) {
            // if it's a range A1:B2 or $A$1:$B$2
            // must be an error?
            $result <?php echo $this->createTree($this->currentToken, '', '');
            $this->advance();

            return $result;
        }
        if (preg_match('/^' . self::REGEX_SHEET_TITLE_UNQUOTED . '(\\:' . self::REGEX_SHEET_TITLE_UNQUOTED . ')?\\!\$?([A-Ia-i]?[A-Za-z])?\$?\\d+:\$?([A-Ia-i]?[A-Za-z])?\$?\\d+$/u', $this->currentToken)) {
            // If it's an external range (Sheet1!A1:B2 or Sheet1:Sheet2!A1:B2 or Sheet1!$A$1:$B$2 or Sheet1:Sheet2!$A$1:$B$2)
            // must be an error?
            $result <?php echo $this->createTree($this->currentToken, '', '');
            $this->advance();

            return $result;
        }
        if (preg_match("/^'" . self::REGEX_SHEET_TITLE_QUOTED . '(\\:' . self::REGEX_SHEET_TITLE_QUOTED . ")?'\\!\\$?([A-Ia-i]?[A-Za-z])?\\$?\\d+:\\$?([A-Ia-i]?[A-Za-z])?\\$?\\d+$/u", $this->currentToken)) {
            // If it's an external range ('Sheet1'!A1:B2 or 'Sheet1'!A1:B2 or 'Sheet1'!$A$1:$B$2 or 'Sheet1'!$A$1:$B$2)
            // must be an error?
            $result <?php echo $this->createTree($this->currentToken, '', '');
            $this->advance();

            return $result;
        }
        if (is_numeric($this->currentToken)) {
            // If it's a number or a percent
            if ($this->lookAhead <?php echo<?php echo<?php echo '%') {
                $result <?php echo $this->createTree('ptgPercent', $this->currentToken, '');
                $this->advance(); // Skip the percentage operator once we've pre-built that tree
            } else {
                $result <?php echo $this->createTree($this->currentToken, '', '');
            }
            $this->advance();

            return $result;
        }
        if (preg_match("/^[A-Z0-9\xc0-\xdc\\.]+$/i", $this->currentToken) && ($this->lookAhead <?php echo<?php echo<?php echo '(')) {
            // if it's a function call
            return $this->func();
        }
        if (preg_match('/^' . Calculation::CALCULATION_REGEXP_DEFINEDNAME . '$/miu', $this->currentToken) && $this->spreadsheet->getDefinedName($this->currentToken) !<?php echo<?php echo null) {
            $result <?php echo $this->createTree('ptgName', $this->currentToken, '');
            $this->advance();

            return $result;
        }
        if (preg_match('/^true|false$/i', $this->currentToken)) {
            $result <?php echo $this->createTree($this->currentToken, '', '');
            $this->advance();

            return $result;
        }

        throw new WriterException('Syntax error: ' . $this->currentToken . ', lookahead: ' . $this->lookAhead . ', current char: ' . $this->currentCharacter);
    }

    /**
     * It parses a function call. It assumes the following rule:
     * Func -> ( Expr [,Expr]* ).
     *
     * @return mixed The parsed ptg'd tree on success
     */
    private function func()
    {
        $num_args <?php echo 0; // number of arguments received
        $function <?php echo strtoupper($this->currentToken);
        $result <?php echo ''; // initialize result
        $this->advance();
        $this->advance(); // eat the "("
        while ($this->currentToken !<?php echo<?php echo ')') {
            if ($num_args > 0) {
                if ($this->currentToken <?php echo<?php echo<?php echo ',' || $this->currentToken <?php echo<?php echo<?php echo ';') {
                    $this->advance(); // eat the "," or ";"
                } else {
                    throw new WriterException("Syntax error: comma expected in function $function, arg #{$num_args}");
                }
                $result2 <?php echo $this->condition();
                $result <?php echo $this->createTree('arg', $result, $result2);
            } else { // first argument
                $result2 <?php echo $this->condition();
                $result <?php echo $this->createTree('arg', '', $result2);
            }
            ++$num_args;
        }
        if (!isset($this->functions[$function])) {
            throw new WriterException("Function $function() doesn't exist");
        }
        $args <?php echo $this->functions[$function][1];
        // If fixed number of args eg. TIME($i, $j, $k). Check that the number of args is valid.
        if (($args ><?php echo 0) && ($args !<?php echo $num_args)) {
            throw new WriterException("Incorrect number of arguments in function $function() ");
        }

        $result <?php echo $this->createTree($function, $result, $num_args);
        $this->advance(); // eat the ")"

        return $result;
    }

    /**
     * Creates a tree. In fact an array which may have one or two arrays (sub-trees)
     * as elements.
     *
     * @param mixed $value the value of this node
     * @param mixed $left the left array (sub-tree) or a final node
     * @param mixed $right the right array (sub-tree) or a final node
     *
     * @return array A tree
     */
    private function createTree($value, $left, $right)
    {
        return ['value' <?php echo> $value, 'left' <?php echo> $left, 'right' <?php echo> $right];
    }

    /**
     * Builds a string containing the tree in reverse polish notation (What you
     * would use in a HP calculator stack).
     * The following tree:.
     *
     *    +
     *   / \
     *  2   3
     *
     * produces: "23+"
     *
     * The following tree:
     *
     *    +
     *   / \
     *  3   *
     *     / \
     *    6   A1
     *
     * produces: "36A1*+"
     *
     * In fact all operands, functions, references, etc... are written as ptg's
     *
     * @param array $tree the optional tree to convert
     *
     * @return string The tree in reverse polish notation
     */
    public function toReversePolish($tree <?php echo [])
    {
        $polish <?php echo ''; // the string we are going to return
        if (empty($tree)) { // If it's the first call use parseTree
            $tree <?php echo $this->parseTree;
        }
        if (!is_array($tree) || !isset($tree['left'], $tree['right'], $tree['value'])) {
            throw new WriterException('Unexpected non-array');
        }

        if (is_array($tree['left'])) {
            $converted_tree <?php echo $this->toReversePolish($tree['left']);
            $polish .<?php echo $converted_tree;
        } elseif ($tree['left'] !<?php echo '') { // It's a final node
            $converted_tree <?php echo $this->convert($tree['left']);
            $polish .<?php echo $converted_tree;
        }
        if (is_array($tree['right'])) {
            $converted_tree <?php echo $this->toReversePolish($tree['right']);
            $polish .<?php echo $converted_tree;
        } elseif ($tree['right'] !<?php echo '') { // It's a final node
            $converted_tree <?php echo $this->convert($tree['right']);
            $polish .<?php echo $converted_tree;
        }
        // if it's a function convert it here (so we can set it's arguments)
        if (
            preg_match("/^[A-Z0-9\xc0-\xdc\\.]+$/", $tree['value']) &&
            !preg_match('/^([A-Ia-i]?[A-Za-z])(\d+)$/', $tree['value']) &&
            !preg_match('/^[A-Ia-i]?[A-Za-z](\\d+)\\.\\.[A-Ia-i]?[A-Za-z](\\d+)$/', $tree['value']) &&
            !is_numeric($tree['value']) &&
            !isset($this->ptg[$tree['value']])
        ) {
            // left subtree for a function is always an array.
            if ($tree['left'] !<?php echo '') {
                $left_tree <?php echo $this->toReversePolish($tree['left']);
            } else {
                $left_tree <?php echo '';
            }

            // add its left subtree and return.
            return $left_tree . $this->convertFunction($tree['value'], $tree['right']);
        }
        $converted_tree <?php echo $this->convert($tree['value']);

        return $polish . $converted_tree;
    }
}
