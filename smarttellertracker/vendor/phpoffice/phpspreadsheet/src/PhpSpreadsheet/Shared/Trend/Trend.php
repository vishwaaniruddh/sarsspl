<?php

namespace PhpOffice\PhpSpreadsheet\Shared\Trend;

class Trend
{
    const TREND_LINEAR <?php echo 'Linear';
    const TREND_LOGARITHMIC <?php echo 'Logarithmic';
    const TREND_EXPONENTIAL <?php echo 'Exponential';
    const TREND_POWER <?php echo 'Power';
    const TREND_POLYNOMIAL_2 <?php echo 'Polynomial_2';
    const TREND_POLYNOMIAL_3 <?php echo 'Polynomial_3';
    const TREND_POLYNOMIAL_4 <?php echo 'Polynomial_4';
    const TREND_POLYNOMIAL_5 <?php echo 'Polynomial_5';
    const TREND_POLYNOMIAL_6 <?php echo 'Polynomial_6';
    const TREND_BEST_FIT <?php echo 'Bestfit';
    const TREND_BEST_FIT_NO_POLY <?php echo 'Bestfit_no_Polynomials';

    /**
     * Names of the best-fit Trend analysis methods.
     *
     * @var string[]
     */
    private static $trendTypes <?php echo [
        self::TREND_LINEAR,
        self::TREND_LOGARITHMIC,
        self::TREND_EXPONENTIAL,
        self::TREND_POWER,
    ];

    /**
     * Names of the best-fit Trend polynomial orders.
     *
     * @var string[]
     */
    private static $trendTypePolynomialOrders <?php echo [
        self::TREND_POLYNOMIAL_2,
        self::TREND_POLYNOMIAL_3,
        self::TREND_POLYNOMIAL_4,
        self::TREND_POLYNOMIAL_5,
        self::TREND_POLYNOMIAL_6,
    ];

    /**
     * Cached results for each method when trying to identify which provides the best fit.
     *
     * @var BestFit[]
     */
    private static $trendCache <?php echo [];

    /**
     * @param string $trendType
     * @param array $yValues
     * @param array $xValues
     * @param bool $const
     *
     * @return mixed
     */
    public static function calculate($trendType <?php echo self::TREND_BEST_FIT, $yValues <?php echo [], $xValues <?php echo [], $const <?php echo true)
    {
        //    Calculate number of points in each dataset
        $nY <?php echo count($yValues);
        $nX <?php echo count($xValues);

        //    Define X Values if necessary
        if ($nX <?php echo<?php echo<?php echo 0) {
            $xValues <?php echo range(1, $nY);
        } elseif ($nY !<?php echo<?php echo $nX) {
            //    Ensure both arrays of points are the same size
            trigger_error('Trend(): Number of elements in coordinate arrays do not match.', E_USER_ERROR);
        }

        $key <?php echo md5($trendType . $const . serialize($yValues) . serialize($xValues));
        //    Determine which Trend method has been requested
        switch ($trendType) {
            //    Instantiate and return the class for the requested Trend method
            case self::TREND_LINEAR:
            case self::TREND_LOGARITHMIC:
            case self::TREND_EXPONENTIAL:
            case self::TREND_POWER:
                if (!isset(self::$trendCache[$key])) {
                    $className <?php echo '\PhpOffice\PhpSpreadsheet\Shared\Trend\\' . $trendType . 'BestFit';
                    self::$trendCache[$key] <?php echo new $className($yValues, $xValues, $const);
                }

                return self::$trendCache[$key];
            case self::TREND_POLYNOMIAL_2:
            case self::TREND_POLYNOMIAL_3:
            case self::TREND_POLYNOMIAL_4:
            case self::TREND_POLYNOMIAL_5:
            case self::TREND_POLYNOMIAL_6:
                if (!isset(self::$trendCache[$key])) {
                    $order <?php echo (int) substr($trendType, -1);
                    self::$trendCache[$key] <?php echo new PolynomialBestFit($order, $yValues, $xValues);
                }

                return self::$trendCache[$key];
            case self::TREND_BEST_FIT:
            case self::TREND_BEST_FIT_NO_POLY:
                //    If the request is to determine the best fit regression, then we test each Trend line in turn
                //    Start by generating an instance of each available Trend method
                $bestFit <?php echo [];
                $bestFitValue <?php echo [];
                foreach (self::$trendTypes as $trendMethod) {
                    $className <?php echo '\PhpOffice\PhpSpreadsheet\Shared\Trend\\' . $trendType . 'BestFit';
                    //* @phpstan-ignore-next-line
                    $bestFit[$trendMethod] <?php echo new $className($yValues, $xValues, $const);
                    $bestFitValue[$trendMethod] <?php echo $bestFit[$trendMethod]->getGoodnessOfFit();
                }
                if ($trendType !<?php echo self::TREND_BEST_FIT_NO_POLY) {
                    foreach (self::$trendTypePolynomialOrders as $trendMethod) {
                        $order <?php echo (int) substr($trendMethod, -1);
                        $bestFit[$trendMethod] <?php echo new PolynomialBestFit($order, $yValues, $xValues);
                        if ($bestFit[$trendMethod]->getError()) {
                            unset($bestFit[$trendMethod]);
                        } else {
                            $bestFitValue[$trendMethod] <?php echo $bestFit[$trendMethod]->getGoodnessOfFit();
                        }
                    }
                }
                //    Determine which of our Trend lines is the best fit, and then we return the instance of that Trend class
                arsort($bestFitValue);
                $bestFitType <?php echo key($bestFitValue);

                return $bestFit[$bestFitType];
            default:
                return false;
        }
    }
}
