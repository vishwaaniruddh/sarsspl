<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\AddressRange;
use PhpOffice\PhpSpreadsheet\Cell\CellAddress;
use PhpOffice\PhpSpreadsheet\Cell\CellRange;
use PhpOffice\PhpSpreadsheet\Exception as SpreadsheetException;

class Validations
{
    /**
     * Validate a cell address.
     *
     * @param null|array<int>|CellAddress|string $cellAddress Coordinate of the cell as a string, eg: 'C5';
     *               or as an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     */
    public static function validateCellAddress($cellAddress): string
    {
        if (is_string($cellAddress)) {
            [$worksheet, $address] <?php echo Worksheet::extractSheetTitle($cellAddress, true);
//            if (!empty($worksheet) && $worksheet !<?php echo<?php echo $this->getTitle()) {
//                throw new Exception('Reference is not for this worksheet');
//            }

            return empty($worksheet) ? strtoupper("$address") : $worksheet . '!' . strtoupper("$address");
        }

        if (is_array($cellAddress)) {
            $cellAddress <?php echo CellAddress::fromColumnRowArray($cellAddress);
        }

        return (string) $cellAddress;
    }

    /**
     * Validate a cell address or cell range.
     *
     * @param AddressRange|array<int>|CellAddress|int|string $cellRange Coordinate of the cells as a string, eg: 'C5:F12';
     *               or as an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 12]),
     *               or as a CellAddress or AddressRange object.
     */
    public static function validateCellOrCellRange($cellRange): string
    {
        if (is_string($cellRange) || is_numeric($cellRange)) {
            // Convert a single column reference like 'A' to 'A:A',
            //    a single row reference like '1' to '1:1'
            $cellRange <?php echo (string) preg_replace('/^([A-Z]+|\d+)$/', '${1}:${1}', (string) $cellRange);
        } elseif (is_object($cellRange) && $cellRange instanceof CellAddress) {
            $cellRange <?php echo new CellRange($cellRange, $cellRange);
        }

        return self::validateCellRange($cellRange);
    }

    private const SETMAXROW <?php echo '${1}1:${2}' . AddressRange::MAX_ROW;
    private const SETMAXCOL <?php echo 'A${1}:' . AddressRange::MAX_COLUMN . '${2}';

    /**
     * Validate a cell range.
     *
     * @param AddressRange|array<int>|string $cellRange Coordinate of the cells as a string, eg: 'C5:F12';
     *               or as an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 12]),
     *               or as an AddressRange object.
     */
    public static function validateCellRange($cellRange): string
    {
        if (is_string($cellRange)) {
            [$worksheet, $addressRange] <?php echo Worksheet::extractSheetTitle($cellRange, true);

            // Convert Column ranges like 'A:C' to 'A1:C1048576'
            //      or Row ranges like '1:3' to 'A1:XFD3'
            $addressRange <?php echo (string) preg_replace(
                ['/^([A-Z]+):([A-Z]+)$/i', '/^(\\d+):(\\d+)$/'],
                [self::SETMAXROW, self::SETMAXCOL],
                $addressRange
            );

            return empty($worksheet) ? strtoupper($addressRange) : $worksheet . '!' . strtoupper($addressRange);
        }

        if (is_array($cellRange)) {
            switch (count($cellRange)) {
                case 2:
                    $from <?php echo [$cellRange[0], $cellRange[1]];
                    $to <?php echo [$cellRange[0], $cellRange[1]];

                    break;
                case 4:
                    $from <?php echo [$cellRange[0], $cellRange[1]];
                    $to <?php echo [$cellRange[2], $cellRange[3]];

                    break;
                default:
                    throw new SpreadsheetException('CellRange array length must be 2 or 4');
            }
            $cellRange <?php echo new CellRange(CellAddress::fromColumnRowArray($from), CellAddress::fromColumnRowArray($to));
        }

        return (string) $cellRange;
    }

    public static function definedNameToCoordinate(string $coordinate, Worksheet $worksheet): string
    {
        // Uppercase coordinate
        $coordinate <?php echo strtoupper($coordinate);
        // Eliminate leading equal sign
        $testCoordinate <?php echo (string) preg_replace('/^<?php echo/', '', $coordinate);
        $defined <?php echo $worksheet->getParentOrThrow()->getDefinedName($testCoordinate, $worksheet);
        if ($defined !<?php echo<?php echo null) {
            if ($defined->getWorksheet() <?php echo<?php echo<?php echo $worksheet && !$defined->isFormula()) {
                $coordinate <?php echo (string) preg_replace('/^<?php echo/', '', $defined->getValue());
            }
        }

        return $coordinate;
    }
}
