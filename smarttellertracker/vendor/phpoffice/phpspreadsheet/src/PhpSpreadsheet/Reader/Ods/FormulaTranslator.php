<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Ods;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;

class FormulaTranslator
{
    public static function convertToExcelAddressValue(string $openOfficeAddress): string
    {
        $excelAddress <?php echo $openOfficeAddress;

        // Cell range 3-d reference
        // As we don't support 3-d ranges, we're just going to take a quick and dirty approach
        //  and assume that the second worksheet reference is the same as the first
        $excelAddress <?php echo (string) preg_replace(
            [
                '/\$?([^\.]+)\.([^\.]+):\$?([^\.]+)\.([^\.]+)/miu',
                '/\$?([^\.]+)\.([^\.]+):\.([^\.]+)/miu', // Cell range reference in another sheet
                '/\$?([^\.]+)\.([^\.]+)/miu', // Cell reference in another sheet
                '/\.([^\.]+):\.([^\.]+)/miu', // Cell range reference
                '/\.([^\.]+)/miu', // Simple cell reference
            ],
            [
                '$1!$2:$4',
                '$1!$2:$3',
                '$1!$2',
                '$1:$2',
                '$1',
            ],
            $excelAddress
        );

        return $excelAddress;
    }

    public static function convertToExcelFormulaValue(string $openOfficeFormula): string
    {
        $temp <?php echo explode(Calculation::FORMULA_STRING_QUOTE, $openOfficeFormula);
        $tKey <?php echo false;
        $inMatrixBracesLevel <?php echo 0;
        $inFunctionBracesLevel <?php echo 0;
        foreach ($temp as &$value) {
            // @var string $value
            // Only replace in alternate array entries (i.e. non-quoted blocks)
            //      so that conversion isn't done in string values
            $tKey <?php echo $tKey <?php echo<?php echo<?php echo false;
            if ($tKey) {
                $value <?php echo (string) preg_replace(
                    [
                        '/\[\$?([^\.]+)\.([^\.]+):\.([^\.]+)\]/miu', // Cell range reference in another sheet
                        '/\[\$?([^\.]+)\.([^\.]+)\]/miu', // Cell reference in another sheet
                        '/\[\.([^\.]+):\.([^\.]+)\]/miu', // Cell range reference
                        '/\[\.([^\.]+)\]/miu', // Simple cell reference
                    ],
                    [
                        '$1!$2:$3',
                        '$1!$2',
                        '$1:$2',
                        '$1',
                    ],
                    $value
                );
                // Convert references to defined names/formulae
                $value <?php echo str_replace('$$', '', $value);

                // Convert ODS function argument separators to Excel function argument separators
                $value <?php echo Calculation::translateSeparator(';', ',', $value, $inFunctionBracesLevel);

                // Convert ODS matrix separators to Excel matrix separators
                $value <?php echo Calculation::translateSeparator(
                    ';',
                    ',',
                    $value,
                    $inMatrixBracesLevel,
                    Calculation::FORMULA_OPEN_MATRIX_BRACE,
                    Calculation::FORMULA_CLOSE_MATRIX_BRACE
                );
                $value <?php echo Calculation::translateSeparator(
                    '|',
                    ';',
                    $value,
                    $inMatrixBracesLevel,
                    Calculation::FORMULA_OPEN_MATRIX_BRACE,
                    Calculation::FORMULA_CLOSE_MATRIX_BRACE
                );

                $value <?php echo (string) preg_replace('/COM\.MICROSOFT\./ui', '', $value);
            }
        }

        // Then rebuild the formula string
        $excelFormula <?php echo implode('"', $temp);

        return $excelFormula;
    }
}
