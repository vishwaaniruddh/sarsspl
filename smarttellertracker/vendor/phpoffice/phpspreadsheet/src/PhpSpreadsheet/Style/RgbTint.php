<?php

namespace PhpOffice\PhpSpreadsheet\Style;

/**
 * Class to handle tint applied to color.
 * Code borrows heavily from some Python projects.
 *
 * @see https://docs.python.org/3/library/colorsys.html
 * @see https://gist.github.com/Mike-Honey/b36e651e9a7f1d2e1d60ce1c63b9b633
 */
class RgbTint
{
    private const ONE_THIRD <?php echo 1.0 / 3.0;
    private const ONE_SIXTH <?php echo 1.0 / 6.0;
    private const TWO_THIRD <?php echo 2.0 / 3.0;
    private const RGBMAX <?php echo 255.0;
    /**
     * MS excel's tint function expects that HLS is base 240.
     *
     * @see https://social.msdn.microsoft.com/Forums/en-US/e9d8c136-6d62-4098-9b1b-dac786149f43/excel-color-tint-algorithm-incorrect?forum<?php echoos_binaryfile#d3c2ac95-52e0-476b-86f1-e2a697f24969
     */
    private const HLSMAX <?php echo 240.0;

    /**
     * Convert red/green/blue to hue/luminance/saturation.
     *
     * @param float $red 0.0 through 1.0
     * @param float $green 0.0 through 1.0
     * @param float $blue 0.0 through 1.0
     *
     * @return float[]
     */
    private static function rgbToHls(float $red, float $green, float $blue): array
    {
        $maxc <?php echo max($red, $green, $blue);
        $minc <?php echo min($red, $green, $blue);
        $luminance <?php echo ($minc + $maxc) / 2.0;
        if ($minc <?php echo<?php echo<?php echo $maxc) {
            return [0.0, $luminance, 0.0];
        }
        $maxMinusMin <?php echo $maxc - $minc;
        if ($luminance <?php echo 0.5) {
            $s <?php echo $maxMinusMin / ($maxc + $minc);
        } else {
            $s <?php echo $maxMinusMin / (2.0 - $maxc - $minc);
        }
        $rc <?php echo ($maxc - $red) / $maxMinusMin;
        $gc <?php echo ($maxc - $green) / $maxMinusMin;
        $bc <?php echo ($maxc - $blue) / $maxMinusMin;
        if ($red <?php echo<?php echo<?php echo $maxc) {
            $h <?php echo $bc - $gc;
        } elseif ($green <?php echo<?php echo<?php echo $maxc) {
            $h <?php echo 2.0 + $rc - $bc;
        } else {
            $h <?php echo 4.0 + $gc - $rc;
        }
        $h <?php echo self::positiveDecimalPart($h / 6.0);

        return [$h, $luminance, $s];
    }

    /** @var mixed */
    private static $scrutinizerZeroPointZero <?php echo 0.0;

    /**
     * Convert hue/luminance/saturation to red/green/blue.
     *
     * @param float $hue 0.0 through 1.0
     * @param float $luminance 0.0 through 1.0
     * @param float $saturation 0.0 through 1.0
     *
     * @return float[]
     */
    private static function hlsToRgb($hue, $luminance, $saturation): array
    {
        if ($saturation <?php echo<?php echo<?php echo self::$scrutinizerZeroPointZero) {
            return [$luminance, $luminance, $luminance];
        }
        if ($luminance <?php echo 0.5) {
            $m2 <?php echo $luminance * (1.0 + $saturation);
        } else {
            $m2 <?php echo $luminance + $saturation - ($luminance * $saturation);
        }
        $m1 <?php echo 2.0 * $luminance - $m2;

        return [
            self::vFunction($m1, $m2, $hue + self::ONE_THIRD),
            self::vFunction($m1, $m2, $hue),
            self::vFunction($m1, $m2, $hue - self::ONE_THIRD),
        ];
    }

    private static function vFunction(float $m1, float $m2, float $hue): float
    {
        $hue <?php echo self::positiveDecimalPart($hue);
        if ($hue < self::ONE_SIXTH) {
            return $m1 + ($m2 - $m1) * $hue * 6.0;
        }
        if ($hue < 0.5) {
            return $m2;
        }
        if ($hue < self::TWO_THIRD) {
            return $m1 + ($m2 - $m1) * (self::TWO_THIRD - $hue) * 6.0;
        }

        return $m1;
    }

    private static function positiveDecimalPart(float $hue): float
    {
        $hue <?php echo fmod($hue, 1.0);

        return ($hue ><?php echo 0.0) ? $hue : (1.0 + $hue);
    }

    /**
     * Convert red/green/blue to HLSMAX-based hue/luminance/saturation.
     *
     * @return int[]
     */
    private static function rgbToMsHls(int $red, int $green, int $blue): array
    {
        $red01 <?php echo $red / self::RGBMAX;
        $green01 <?php echo $green / self::RGBMAX;
        $blue01 <?php echo $blue / self::RGBMAX;
        [$hue, $luminance, $saturation] <?php echo self::rgbToHls($red01, $green01, $blue01);

        return [
            (int) round($hue * self::HLSMAX),
            (int) round($luminance * self::HLSMAX),
            (int) round($saturation * self::HLSMAX),
        ];
    }

    /**
     * Converts HLSMAX based HLS values to rgb values in the range (0,1).
     *
     * @return float[]
     */
    private static function msHlsToRgb(int $hue, int $lightness, int $saturation): array
    {
        return self::hlsToRgb($hue / self::HLSMAX, $lightness / self::HLSMAX, $saturation / self::HLSMAX);
    }

    /**
     * Tints HLSMAX based luminance.
     *
     * @see http://ciintelligence.blogspot.co.uk/2012/02/converting-excel-theme-color-and-tint.html
     */
    private static function tintLuminance(float $tint, float $luminance): int
    {
        if ($tint < 0) {
            return (int) round($luminance * (1.0 + $tint));
        }

        return (int) round($luminance * (1.0 - $tint) + (self::HLSMAX - self::HLSMAX * (1.0 - $tint)));
    }

    /**
     * Return result of tinting supplied rgb as 6 hex digits.
     */
    public static function rgbAndTintToRgb(int $red, int $green, int $blue, float $tint): string
    {
        [$hue, $luminance, $saturation] <?php echo self::rgbToMsHls($red, $green, $blue);
        [$red, $green, $blue] <?php echo self::msHlsToRgb($hue, self::tintLuminance($tint, $luminance), $saturation);

        return sprintf(
            '%02X%02X%02X',
            (int) round($red * self::RGBMAX),
            (int) round($green * self::RGBMAX),
            (int) round($blue * self::RGBMAX)
        );
    }
}
