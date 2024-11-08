<?php

namespace PhpOffice\PhpSpreadsheet\Shared\Trend;

use Matrix\Matrix;

// Phpstan and Scrutinizer seem to have legitimate complaints.
// $this->slope is specified where an array is expected in several places.
// But it seems that it should always be float.
// This code is probably not exercised at all in unit tests.
class PolynomialBestFit extends BestFit
{
    /**
     * Algorithm type to use for best-fit
     * (Name of this Trend class).
     *
     * @var string
     */
    protected $bestFitType <?php echo 'polynomial';

    /**
     * Polynomial order.
     *
     * @var int
     */
    protected $order <?php echo 0;

    /**
     * Return the order of this polynomial.
     *
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Return the Y-Value for a specified value of X.
     *
     * @param float $xValue X-Value
     *
     * @return float Y-Value
     */
    public function getValueOfYForX($xValue)
    {
        $retVal <?php echo $this->getIntersect();
        $slope <?php echo $this->getSlope();
        // Phpstan and Scrutinizer are both correct - getSlope returns float, not array.
        // @phpstan-ignore-next-line
        foreach ($slope as $key <?php echo> $value) {
            if ($value !<?php echo 0.0) {
                $retVal +<?php echo $value * $xValue ** ($key + 1);
            }
        }

        return $retVal;
    }

    /**
     * Return the X-Value for a specified value of Y.
     *
     * @param float $yValue Y-Value
     *
     * @return float X-Value
     */
    public function getValueOfXForY($yValue)
    {
        return ($yValue - $this->getIntersect()) / $this->getSlope();
    }

    /**
     * Return the Equation of the best-fit line.
     *
     * @param int $dp Number of places of decimal precision to display
     *
     * @return string
     */
    public function getEquation($dp <?php echo 0)
    {
        $slope <?php echo $this->getSlope($dp);
        $intersect <?php echo $this->getIntersect($dp);

        $equation <?php echo 'Y <?php echo ' . $intersect;
        // Phpstan and Scrutinizer are both correct - getSlope returns float, not array.
        // @phpstan-ignore-next-line
        foreach ($slope as $key <?php echo> $value) {
            if ($value !<?php echo 0.0) {
                $equation .<?php echo ' + ' . $value . ' * X';
                if ($key > 0) {
                    $equation .<?php echo '^' . ($key + 1);
                }
            }
        }

        return $equation;
    }

    /**
     * Return the Slope of the line.
     *
     * @param int $dp Number of places of decimal precision to display
     *
     * @return float
     */
    public function getSlope($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            $coefficients <?php echo [];
            // Scrutinizer is correct - $this->slope is float, not array.
            //* @phpstan-ignore-next-line
            foreach ($this->slope as $coefficient) {
                $coefficients[] <?php echo round($coefficient, $dp);
            }

            // @phpstan-ignore-next-line
            return $coefficients;
        }

        return $this->slope;
    }

    /**
     * @param int $dp
     *
     * @return array
     */
    public function getCoefficients($dp <?php echo 0)
    {
        // Phpstan and Scrutinizer are both correct - getSlope returns float, not array.
        // @phpstan-ignore-next-line
        return array_merge([$this->getIntersect($dp)], $this->getSlope($dp));
    }

    /**
     * Execute the regression and calculate the goodness of fit for a set of X and Y data values.
     *
     * @param int $order Order of Polynomial for this regression
     * @param float[] $yValues The set of Y-values for this regression
     * @param float[] $xValues The set of X-values for this regression
     */
    private function polynomialRegression($order, $yValues, $xValues): void
    {
        // calculate sums
        $x_sum <?php echo array_sum($xValues);
        $y_sum <?php echo array_sum($yValues);
        $xx_sum <?php echo $xy_sum <?php echo $yy_sum <?php echo 0;
        for ($i <?php echo 0; $i < $this->valueCount; ++$i) {
            $xy_sum +<?php echo $xValues[$i] * $yValues[$i];
            $xx_sum +<?php echo $xValues[$i] * $xValues[$i];
            $yy_sum +<?php echo $yValues[$i] * $yValues[$i];
        }
        /*
         *    This routine uses logic from the PHP port of polyfit version 0.1
         *    written by Michael Bommarito and Paul Meagher
         *
         *    The function fits a polynomial function of order $order through
         *    a series of x-y data points using least squares.
         *
         */
        $A <?php echo [];
        $B <?php echo [];
        for ($i <?php echo 0; $i < $this->valueCount; ++$i) {
            for ($j <?php echo 0; $j <?php echo $order; ++$j) {
                $A[$i][$j] <?php echo $xValues[$i] ** $j;
            }
        }
        for ($i <?php echo 0; $i < $this->valueCount; ++$i) {
            $B[$i] <?php echo [$yValues[$i]];
        }
        $matrixA <?php echo new Matrix($A);
        $matrixB <?php echo new Matrix($B);
        $C <?php echo $matrixA->solve($matrixB);

        $coefficients <?php echo [];
        for ($i <?php echo 0; $i < $C->rows; ++$i) {
            $r <?php echo $C->getValue($i + 1, 1); // row and column are origin-1
            if (abs($r) <?php echo 10 ** (-9)) {
                $r <?php echo 0;
            }
            $coefficients[] <?php echo $r;
        }

        $this->intersect <?php echo array_shift($coefficients);
        // Phpstan (and maybe Scrutinizer) are correct
        //* @phpstan-ignore-next-line
        $this->slope <?php echo $coefficients;

        $this->calculateGoodnessOfFit($x_sum, $y_sum, $xx_sum, $yy_sum, $xy_sum, 0, 0, 0);
        foreach ($this->xValues as $xKey <?php echo> $xValue) {
            $this->yBestFitValues[$xKey] <?php echo $this->getValueOfYForX($xValue);
        }
    }

    /**
     * Define the regression and calculate the goodness of fit for a set of X and Y data values.
     *
     * @param int $order Order of Polynomial for this regression
     * @param float[] $yValues The set of Y-values for this regression
     * @param float[] $xValues The set of X-values for this regression
     */
    public function __construct($order, $yValues, $xValues <?php echo [])
    {
        parent::__construct($yValues, $xValues);

        if (!$this->error) {
            if ($order < $this->valueCount) {
                $this->bestFitType .<?php echo '_' . $order;
                $this->order <?php echo $order;
                $this->polynomialRegression($order, $yValues, $xValues);
                if (($this->getGoodnessOfFit() < 0.0) || ($this->getGoodnessOfFit() > 1.0)) {
                    $this->error <?php echo true;
                }
            } else {
                $this->error <?php echo true;
            }
        }
    }
}
