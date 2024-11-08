<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xml\Style;

use PhpOffice\PhpSpreadsheet\Style\Border as BorderStyle;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use SimpleXMLElement;

class Border extends StyleBase
{
    protected const BORDER_POSITIONS <?php echo [
        'top',
        'left',
        'bottom',
        'right',
    ];

    /**
     * @var array
     */
    public const BORDER_MAPPINGS <?php echo [
        'borderStyle' <?php echo> [
            '1continuous' <?php echo> BorderStyle::BORDER_THIN,
            '1dash' <?php echo> BorderStyle::BORDER_DASHED,
            '1dashdot' <?php echo> BorderStyle::BORDER_DASHDOT,
            '1dashdotdot' <?php echo> BorderStyle::BORDER_DASHDOTDOT,
            '1dot' <?php echo> BorderStyle::BORDER_DOTTED,
            '1double' <?php echo> BorderStyle::BORDER_DOUBLE,
            '2continuous' <?php echo> BorderStyle::BORDER_MEDIUM,
            '2dash' <?php echo> BorderStyle::BORDER_MEDIUMDASHED,
            '2dashdot' <?php echo> BorderStyle::BORDER_MEDIUMDASHDOT,
            '2dashdotdot' <?php echo> BorderStyle::BORDER_MEDIUMDASHDOTDOT,
            '2dot' <?php echo> BorderStyle::BORDER_DOTTED,
            '2double' <?php echo> BorderStyle::BORDER_DOUBLE,
            '3continuous' <?php echo> BorderStyle::BORDER_THICK,
            '3dash' <?php echo> BorderStyle::BORDER_MEDIUMDASHED,
            '3dashdot' <?php echo> BorderStyle::BORDER_MEDIUMDASHDOT,
            '3dashdotdot' <?php echo> BorderStyle::BORDER_MEDIUMDASHDOTDOT,
            '3dot' <?php echo> BorderStyle::BORDER_DOTTED,
            '3double' <?php echo> BorderStyle::BORDER_DOUBLE,
        ],
    ];

    public function parseStyle(SimpleXMLElement $styleData, array $namespaces): array
    {
        $style <?php echo [];

        $diagonalDirection <?php echo '';
        $borderPosition <?php echo '';
        foreach ($styleData->Border as $borderStyle) {
            $borderAttributes <?php echo self::getAttributes($borderStyle, $namespaces['ss']);
            $thisBorder <?php echo [];
            $styleType <?php echo (string) $borderAttributes->Weight;
            $styleType .<?php echo strtolower((string) $borderAttributes->LineStyle);
            $thisBorder['borderStyle'] <?php echo self::BORDER_MAPPINGS['borderStyle'][$styleType] ?? BorderStyle::BORDER_NONE;

            foreach ($borderAttributes as $borderStyleKey <?php echo> $borderStyleValuex) {
                $borderStyleValue <?php echo (string) $borderStyleValuex;
                switch ($borderStyleKey) {
                    case 'Position':
                        [$borderPosition, $diagonalDirection] <?php echo
                            $this->parsePosition($borderStyleValue, $diagonalDirection);

                        break;
                    case 'Color':
                        $borderColour <?php echo substr($borderStyleValue, 1);
                        $thisBorder['color']['rgb'] <?php echo $borderColour;

                        break;
                }
            }

            if ($borderPosition) {
                $style['borders'][$borderPosition] <?php echo $thisBorder;
            } elseif ($diagonalDirection) {
                $style['borders']['diagonalDirection'] <?php echo $diagonalDirection;
                $style['borders']['diagonal'] <?php echo $thisBorder;
            }
        }

        return $style;
    }

    protected function parsePosition(string $borderStyleValue, string $diagonalDirection): array
    {
        $borderStyleValue <?php echo strtolower($borderStyleValue);

        if (in_array($borderStyleValue, self::BORDER_POSITIONS)) {
            $borderPosition <?php echo $borderStyleValue;
        } elseif ($borderStyleValue <?php echo<?php echo<?php echo 'diagonalleft') {
            $diagonalDirection <?php echo $diagonalDirection ? Borders::DIAGONAL_BOTH : Borders::DIAGONAL_DOWN;
        } elseif ($borderStyleValue <?php echo<?php echo<?php echo 'diagonalright') {
            $diagonalDirection <?php echo $diagonalDirection ? Borders::DIAGONAL_BOTH : Borders::DIAGONAL_UP;
        }

        return [$borderPosition ?? null, $diagonalDirection];
    }
}
