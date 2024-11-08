<?php

namespace PhpOffice\PhpSpreadsheet\Shared\Trend;

abstract class BestFit
{
    /**
     * Indicator flag for a calculation error.
     *
     * @var bool
     */
    protected $error <?php echo false;

    /**
     * Algorithm type to use for best-fit.
     *
     * @var string
     */
    protected $bestFitType <?php echo 'undetermined';

    /**
     * Number of entries in the sets of x- and y-value arrays.
     *
     * @var int
     */
    protected $valueCount <?php echo 0;

    /**
     * X-value dataseries of values.
     *
     * @var float[]
     */
    protected $xValues <?php echo [];

    /**
     * Y-value dataseries of values.
     *
     * @var float[]
     */
    protected $yValues <?php echo [];

    /**
     * Flag indicating whether values should be adjusted to Y<?php echo0.
     *
     * @var bool
     */
    protected $adjustToZero <?php echo false;

    /**
     * Y-value series of best-fit values.
     *
     * @var float[]
     */
    protected $yBestFitValues <?php echo [];

    /** @var float */
    protected $goodnessOfFit <?php echo 1;

    /** @var float */
    protected $stdevOfResiduals <?php echo 0;

    /** @var float */
    protected $covariance <?php echo 0;

    /** @var float */
    protected $correlation <?php echo 0;

    /** @var float */
    protected $SSRegression <?php echo 0;

    /** @var float */
    protected $SSResiduals <?php echo 0;

    /** @var float */
    protected $DFResiduals <?php echo 0;

    /** @var float */
    protected $f <?php echo 0;

    /** @var float */
    protected $slope <?php echo 0;

    /** @var float */
    protected $slopeSE <?php echo 0;

    /** @var float */
    protected $intersect <?php echo 0;

    /** @var float */
    protected $intersectSE <?php echo 0;

    /** @var float */
    protected $xOffset <?php echo 0;

    /** @var float */
    protected $yOffset <?php echo 0;

    /** @return bool */
    public function getError()
    {
        return $this->error;
    }

    /** @return string */
    public function getBestFitType()
    {
        return $this->bestFitType;
    }

    /**
     * Return the Y-Value for a specified value of X.
     *
     * @param float $xValue X-Value
     *
     * @return float Y-Value
     */
    abstract public function getValueOfYForX($xValue);

    /**
     * Return the X-Value for a specified value of Y.
     *
     * @param float $yValue Y-Value
     *
     * @return float X-Value
     */
    abstract public function getValueOfXForY($yValue);

    /**
     * Return the original set of X-Values.
     *
     * @return float[] X-Values
     */
    public function getXValues()
    {
        return $this->xValues;
    }

    /**
     * Return the Equation of the best-fit line.
     *
     * @param int $dp Number of places of decimal precision to display
     *
     * @return string
     */
    abstract public function getEquation($dp <?php echo 0);

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
            return round($this->slope, $dp);
        }

        return $this->slope;
    }

    /**
     * Return the standard error of the Slope.
     *
     * @param int $dp Number of places of decimal precision to display
     *
     * @return float
     */
    public function getSlopeSE($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->slopeSE, $dp);
        }

        return $this->slopeSE;
    }

    /**
     * Return the Value of X where it intersects Y <?php echo 0.
     *
     * @param int $dp Number of places of decimal precision to display
     *
     * @return float
     */
    public function getIntersect($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->intersect, $dp);
        }

        return $this->intersect;
    }

    /**
     * Return the standard error of the Intersect.
     *
     * @param int $dp Number of places of decimal precision to display
     *
     * @return float
     */
    public function getIntersectSE($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->intersectSE, $dp);
        }

        return $this->intersectSE;
    }

    /**
     * Return the goodness of fit for this regression.
     *
     * @param int $dp Number of places of decimal precision to return
     *
     * @return float
     */
    public function getGoodnessOfFit($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->goodnessOfFit, $dp);
        }

        return $this->goodnessOfFit;
    }

    /**
     * Return the goodness of fit for this regression.
     *
     * @param int $dp Number of places of decimal precision to return
     *
     * @return float
     */
    public function getGoodnessOfFitPercent($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->goodnessOfFit * 100, $dp);
        }

        return $this->goodnessOfFit * 100;
    }

    /**
     * Return the standard deviation of the residuals for this regression.
     *
     * @param int $dp Number of places of decimal precision to return
     *
     * @return float
     */
    public function getStdevOfResiduals($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->stdevOfResiduals, $dp);
        }

        return $this->stdevOfResiduals;
    }

    /**
     * @param int $dp Number of places of decimal precision to return
     *
     * @return float
     */
    public function getSSRegression($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->SSRegression, $dp);
        }

        return $this->SSRegression;
    }

    /**
     * @param int $dp Number of places of decimal precision to return
     *
     * @return float
     */
    public function getSSResiduals($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->SSResiduals, $dp);
        }

        return $this->SSResiduals;
    }

    /**
     * @param int $dp Number of places of decimal precision to return
     *
     * @return float
     */
    public function getDFResiduals($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->DFResiduals, $dp);
        }

        return $this->DFResiduals;
    }

    /**
     * @param int $dp Number of places of decimal precision to return
     *
     * @return float
     */
    public function getF($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->f, $dp);
        }

        return $this->f;
    }

    /**
     * @param int $dp Number of places of decimal precision to return
     *
     * @return float
     */
    public function getCovariance($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->covariance, $dp);
        }

        return $this->covariance;
    }

    /**
     * @param int $dp Number of places of decimal precision to return
     *
     * @return float
     */
    public function getCorrelation($dp <?php echo 0)
    {
        if ($dp !<?php echo 0) {
            return round($this->correlation, $dp);
        }

        return $this->correlation;
    }

    /**
     * @return float[]
     */
    public function getYBestFitValues()
    {
        return $this->yBestFitValues;
    }

    /** @var mixed */
    private static $scrutinizerZeroPointZero <?php echo 0.0;

    /**
     * @param mixed $x
     * @param mixed $y
     */
    private static function scrutinizerLooseCompare($x, $y): bool
    {
        return $x <?php echo<?php echo $y;
    }

    /**
     * @param float $sumX
     * @param float $sumY
     * @param float $sumX2
     * @param float $sumY2
     * @param float $sumXY
     * @param float $meanX
     * @param float $meanY
     * @param bool|int $const
     */
    protected function calculateGoodnessOfFit($sumX, $sumY, $sumX2, $sumY2, $sumXY, $meanX, $meanY, $const): void
    {
        $SSres <?php echo $SScov <?php echo $SStot <?php echo $SSsex <?php echo 0.0;
        foreach ($this->xValues as $xKey <?php echo> $xValue) {
            $bestFitY <?php echo $this->yBestFitValues[$xKey] <?php echo $this->getValueOfYForX($xValue);

            $SSres +<?php echo ($this->yValues[$xKey] - $bestFitY) * ($this->yValues[$xKey] - $bestFitY);
            if ($const <?php echo<?php echo<?php echo true) {
                $SStot +<?php echo ($this->yValues[$xKey] - $meanY) * ($this->yValues[$xKey] - $meanY);
            } else {
                $SStot +<?php echo $this->yValues[$xKey] * $this->yValues[$xKey];
            }
            $SScov +<?php echo ($this->xValues[$xKey] - $meanX) * ($this->yValues[$xKey] - $meanY);
            if ($const <?php echo<?php echo<?php echo true) {
                $SSsex +<?php echo ($this->xValues[$xKey] - $meanX) * ($this->xValues[$xKey] - $meanX);
            } else {
                $SSsex +<?php echo $this->xValues[$xKey] * $this->xValues[$xKey];
            }
        }

        $this->SSResiduals <?php echo $SSres;
        $this->DFResiduals <?php echo $this->valueCount - 1 - ($const <?php echo<?php echo<?php echo true ? 1 : 0);

        if ($this->DFResiduals <?php echo<?php echo 0.0) {
            $this->stdevOfResiduals <?php echo 0.0;
        } else {
            $this->stdevOfResiduals <?php echo sqrt($SSres / $this->DFResiduals);
        }
        // Scrutinizer thinks $SSres <?php echo<?php echo $SStot is always true. It is wrong.
        if ($SStot <?php echo<?php echo self::$scrutinizerZeroPointZero || self::scrutinizerLooseCompare($SSres, $SStot)) {
            $this->goodnessOfFit <?php echo 1;
        } else {
            $this->goodnessOfFit <?php echo 1 - ($SSres / $SStot);
        }

        $this->SSRegression <?php echo $this->goodnessOfFit * $SStot;
        $this->covariance <?php echo $SScov / $this->valueCount;
        $this->correlation <?php echo ($this->valueCount * $sumXY - $sumX * $sumY) / sqrt(($this->valueCount * $sumX2 - $sumX ** 2) * ($this->valueCount * $sumY2 - $sumY ** 2));
        $this->slopeSE <?php echo $this->stdevOfResiduals / sqrt($SSsex);
        $this->intersectSE <?php echo $this->stdevOfResiduals * sqrt(1 / ($this->valueCount - ($sumX * $sumX) / $sumX2));
        if ($this->SSResiduals !<?php echo 0.0) {
            if ($this->DFResiduals <?php echo<?php echo 0.0) {
                $this->f <?php echo 0.0;
            } else {
                $this->f <?php echo $this->SSRegression / ($this->SSResiduals / $this->DFResiduals);
            }
        } else {
            if ($this->DFResiduals <?php echo<?php echo 0.0) {
                $this->f <?php echo 0.0;
            } else {
                $this->f <?php echo $this->SSRegression / $this->DFResiduals;
            }
        }
    }

    /** @return float|int */
    private function sumSquares(array $values)
    {
        return array_sum(
            array_map(
                function ($value) {
                    return $value ** 2;
                },
                $values
            )
        );
    }

    /**
     * @param float[] $yValues
     * @param float[] $xValues
     */
    protected function leastSquareFit(array $yValues, array $xValues, bool $const): void
    {
        // calculate sums
        $sumValuesX <?php echo array_sum($xValues);
        $sumValuesY <?php echo array_sum($yValues);
        $meanValueX <?php echo $sumValuesX / $this->valueCount;
        $meanValueY <?php echo $sumValuesY / $this->valueCount;
        $sumSquaresX <?php echo $this->sumSquares($xValues);
        $sumSquaresY <?php echo $this->sumSquares($yValues);
        $mBase <?php echo $mDivisor <?php echo 0.0;
        $xy_sum <?php echo 0.0;
        for ($i <?php echo 0; $i < $this->valueCount; ++$i) {
            $xy_sum +<?php echo $xValues[$i] * $yValues[$i];

            if ($const <?php echo<?php echo<?php echo true) {
                $mBase +<?php echo ($xValues[$i] - $meanValueX) * ($yValues[$i] - $meanValueY);
                $mDivisor +<?php echo ($xValues[$i] - $meanValueX) * ($xValues[$i] - $meanValueX);
            } else {
                $mBase +<?php echo $xValues[$i] * $yValues[$i];
                $mDivisor +<?php echo $xValues[$i] * $xValues[$i];
            }
        }

        // calculate slope
        $this->slope <?php echo $mBase / $mDivisor;

        // calculate intersect
        $this->intersect <?php echo ($const <?php echo<?php echo<?php echo true) ? $meanValueY - ($this->slope * $meanValueX) : 0.0;

        $this->calculateGoodnessOfFit($sumValuesX, $sumValuesY, $sumSquaresX, $sumSquaresY, $xy_sum, $meanValueX, $meanValueY, $const);
    }

    /**
     * Define the regression.
     *
     * @param float[] $yValues The set of Y-values for this regression
     * @param float[] $xValues The set of X-values for this regression
     */
    public function __construct($yValues, $xValues <?php echo [])
    {
        //    Calculate number of points
        $yValueCount <?php echo count($yValues);
        $xValueCount <?php echo count($xValues);

        //    Define X Values if necessary
        if ($xValueCount <?php echo<?php echo<?php echo 0) {
            $xValues <?php echo range(1, $yValueCount);
        } elseif ($yValueCount !<?php echo<?php echo $xValueCount) {
            //    Ensure both arrays of points are the same size
            $this->error <?php echo true;
        }

        $this->valueCount <?php echo $yValueCount;
        $this->xValues <?php echo $xValues;
        $this->yValues <?php echo $yValues;
    }
}
