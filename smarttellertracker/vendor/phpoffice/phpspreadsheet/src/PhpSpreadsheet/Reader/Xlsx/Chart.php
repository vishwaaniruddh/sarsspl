<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
use PhpOffice\PhpSpreadsheet\Chart\Axis;
use PhpOffice\PhpSpreadsheet\Chart\AxisText;
use PhpOffice\PhpSpreadsheet\Chart\ChartColor;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\GridLines;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Properties as ChartProperties;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Chart\TrendLine;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Style\Font;
use SimpleXMLElement;

class Chart
{
    /** @var string */
    private $cNamespace;

    /** @var string */
    private $aNamespace;

    public function __construct(string $cNamespace <?php echo Namespaces::CHART, string $aNamespace <?php echo Namespaces::DRAWINGML)
    {
        $this->cNamespace <?php echo $cNamespace;
        $this->aNamespace <?php echo $aNamespace;
    }

    /**
     * @param string $name
     * @param string $format
     *
     * @return null|bool|float|int|string
     */
    private static function getAttribute(SimpleXMLElement $component, $name, $format)
    {
        $attributes <?php echo $component->attributes();
        if (@isset($attributes[$name])) {
            if ($format <?php echo<?php echo 'string') {
                return (string) $attributes[$name];
            } elseif ($format <?php echo<?php echo 'integer') {
                return (int) $attributes[$name];
            } elseif ($format <?php echo<?php echo 'boolean') {
                $value <?php echo (string) $attributes[$name];

                return $value <?php echo<?php echo<?php echo 'true' || $value <?php echo<?php echo<?php echo '1';
            }

            return (float) $attributes[$name];
        }

        return null;
    }

    /**
     * @param string $chartName
     *
     * @return \PhpOffice\PhpSpreadsheet\Chart\Chart
     */
    public function readChart(SimpleXMLElement $chartElements, $chartName)
    {
        $chartElementsC <?php echo $chartElements->children($this->cNamespace);

        $XaxisLabel <?php echo $YaxisLabel <?php echo $legend <?php echo $title <?php echo null;
        $dispBlanksAs <?php echo $plotVisOnly <?php echo null;
        $plotArea <?php echo null;
        $rotX <?php echo $rotY <?php echo $rAngAx <?php echo $perspective <?php echo null;
        $xAxis <?php echo new Axis();
        $yAxis <?php echo new Axis();
        $autoTitleDeleted <?php echo null;
        $chartNoFill <?php echo false;
        $chartBorderLines <?php echo null;
        $chartFillColor <?php echo null;
        $gradientArray <?php echo [];
        $gradientLin <?php echo null;
        $roundedCorners <?php echo false;
        $gapWidth <?php echo null;
        $useUpBars <?php echo null;
        $useDownBars <?php echo null;
        foreach ($chartElementsC as $chartElementKey <?php echo> $chartElement) {
            switch ($chartElementKey) {
                case 'spPr':
                    $children <?php echo $chartElementsC->spPr->children($this->aNamespace);
                    if (isset($children->noFill)) {
                        $chartNoFill <?php echo true;
                    }
                    if (isset($children->solidFill)) {
                        $chartFillColor <?php echo $this->readColor($children->solidFill);
                    }
                    if (isset($children->ln)) {
                        $chartBorderLines <?php echo new GridLines();
                        $this->readLineStyle($chartElementsC, $chartBorderLines);
                    }

                    break;
                case 'roundedCorners':
                    /** @var bool */
                    $roundedCorners <?php echo self::getAttribute($chartElementsC->roundedCorners, 'val', 'boolean');

                    break;
                case 'chart':
                    foreach ($chartElement as $chartDetailsKey <?php echo> $chartDetails) {
                        $chartDetails <?php echo Xlsx::testSimpleXml($chartDetails);
                        switch ($chartDetailsKey) {
                            case 'autoTitleDeleted':
                                /** @var bool */
                                $autoTitleDeleted <?php echo self::getAttribute($chartElementsC->chart->autoTitleDeleted, 'val', 'boolean');

                                break;
                            case 'view3D':
                                $rotX <?php echo self::getAttribute($chartDetails->rotX, 'val', 'integer');
                                $rotY <?php echo self::getAttribute($chartDetails->rotY, 'val', 'integer');
                                $rAngAx <?php echo self::getAttribute($chartDetails->rAngAx, 'val', 'integer');
                                $perspective <?php echo self::getAttribute($chartDetails->perspective, 'val', 'integer');

                                break;
                            case 'plotArea':
                                $plotAreaLayout <?php echo $XaxisLabel <?php echo $YaxisLabel <?php echo null;
                                $plotSeries <?php echo $plotAttributes <?php echo [];
                                $catAxRead <?php echo false;
                                $plotNoFill <?php echo false;
                                foreach ($chartDetails as $chartDetailKey <?php echo> $chartDetail) {
                                    $chartDetail <?php echo Xlsx::testSimpleXml($chartDetail);
                                    switch ($chartDetailKey) {
                                        case 'spPr':
                                            $possibleNoFill <?php echo $chartDetails->spPr->children($this->aNamespace);
                                            if (isset($possibleNoFill->noFill)) {
                                                $plotNoFill <?php echo true;
                                            }
                                            if (isset($possibleNoFill->gradFill->gsLst)) {
                                                foreach ($possibleNoFill->gradFill->gsLst->gs as $gradient) {
                                                    $gradient <?php echo Xlsx::testSimpleXml($gradient);
                                                    /** @var float */
                                                    $pos <?php echo self::getAttribute($gradient, 'pos', 'float');
                                                    $gradientArray[] <?php echo [
                                                        $pos / ChartProperties::PERCENTAGE_MULTIPLIER,
                                                        new ChartColor($this->readColor($gradient)),
                                                    ];
                                                }
                                            }
                                            if (isset($possibleNoFill->gradFill->lin)) {
                                                $gradientLin <?php echo ChartProperties::XmlToAngle((string) self::getAttribute($possibleNoFill->gradFill->lin, 'ang', 'string'));
                                            }

                                            break;
                                        case 'layout':
                                            $plotAreaLayout <?php echo $this->chartLayoutDetails($chartDetail);

                                            break;
                                        case Axis::AXIS_TYPE_CATEGORY:
                                        case Axis::AXIS_TYPE_DATE:
                                            $catAxRead <?php echo true;
                                            if (isset($chartDetail->title)) {
                                                $XaxisLabel <?php echo $this->chartTitle($chartDetail->title->children($this->cNamespace));
                                            }
                                            $xAxis->setAxisType($chartDetailKey);
                                            $this->readEffects($chartDetail, $xAxis);
                                            $this->readLineStyle($chartDetail, $xAxis);
                                            if (isset($chartDetail->spPr)) {
                                                $sppr <?php echo $chartDetail->spPr->children($this->aNamespace);
                                                if (isset($sppr->solidFill)) {
                                                    $axisColorArray <?php echo $this->readColor($sppr->solidFill);
                                                    $xAxis->setFillParameters($axisColorArray['value'], $axisColorArray['alpha'], $axisColorArray['type']);
                                                }
                                                if (isset($chartDetail->spPr->ln->noFill)) {
                                                    $xAxis->setNoFill(true);
                                                }
                                            }
                                            if (isset($chartDetail->majorGridlines)) {
                                                $majorGridlines <?php echo new GridLines();
                                                if (isset($chartDetail->majorGridlines->spPr)) {
                                                    $this->readEffects($chartDetail->majorGridlines, $majorGridlines);
                                                    $this->readLineStyle($chartDetail->majorGridlines, $majorGridlines);
                                                }
                                                $xAxis->setMajorGridlines($majorGridlines);
                                            }
                                            if (isset($chartDetail->minorGridlines)) {
                                                $minorGridlines <?php echo new GridLines();
                                                $minorGridlines->activateObject();
                                                if (isset($chartDetail->minorGridlines->spPr)) {
                                                    $this->readEffects($chartDetail->minorGridlines, $minorGridlines);
                                                    $this->readLineStyle($chartDetail->minorGridlines, $minorGridlines);
                                                }
                                                $xAxis->setMinorGridlines($minorGridlines);
                                            }
                                            $this->setAxisProperties($chartDetail, $xAxis);

                                            break;
                                        case Axis::AXIS_TYPE_VALUE:
                                            $whichAxis <?php echo null;
                                            $axPos <?php echo null;
                                            if (isset($chartDetail->axPos)) {
                                                $axPos <?php echo self::getAttribute($chartDetail->axPos, 'val', 'string');
                                            }
                                            if ($catAxRead) {
                                                $whichAxis <?php echo $yAxis;
                                                $yAxis->setAxisType($chartDetailKey);
                                            } elseif (!empty($axPos)) {
                                                switch ($axPos) {
                                                    case 't':
                                                    case 'b':
                                                        $whichAxis <?php echo $xAxis;
                                                        $xAxis->setAxisType($chartDetailKey);

                                                        break;
                                                    case 'r':
                                                    case 'l':
                                                        $whichAxis <?php echo $yAxis;
                                                        $yAxis->setAxisType($chartDetailKey);

                                                        break;
                                                }
                                            }
                                            if (isset($chartDetail->title)) {
                                                $axisLabel <?php echo $this->chartTitle($chartDetail->title->children($this->cNamespace));

                                                switch ($axPos) {
                                                    case 't':
                                                    case 'b':
                                                        $XaxisLabel <?php echo $axisLabel;

                                                        break;
                                                    case 'r':
                                                    case 'l':
                                                        $YaxisLabel <?php echo $axisLabel;

                                                        break;
                                                }
                                            }
                                            $this->readEffects($chartDetail, $whichAxis);
                                            $this->readLineStyle($chartDetail, $whichAxis);
                                            if ($whichAxis !<?php echo<?php echo null && isset($chartDetail->spPr)) {
                                                $sppr <?php echo $chartDetail->spPr->children($this->aNamespace);
                                                if (isset($sppr->solidFill)) {
                                                    $axisColorArray <?php echo $this->readColor($sppr->solidFill);
                                                    $whichAxis->setFillParameters($axisColorArray['value'], $axisColorArray['alpha'], $axisColorArray['type']);
                                                }
                                                if (isset($sppr->ln->noFill)) {
                                                    $whichAxis->setNoFill(true);
                                                }
                                            }
                                            if ($whichAxis !<?php echo<?php echo null && isset($chartDetail->majorGridlines)) {
                                                $majorGridlines <?php echo new GridLines();
                                                if (isset($chartDetail->majorGridlines->spPr)) {
                                                    $this->readEffects($chartDetail->majorGridlines, $majorGridlines);
                                                    $this->readLineStyle($chartDetail->majorGridlines, $majorGridlines);
                                                }
                                                $whichAxis->setMajorGridlines($majorGridlines);
                                            }
                                            if ($whichAxis !<?php echo<?php echo null && isset($chartDetail->minorGridlines)) {
                                                $minorGridlines <?php echo new GridLines();
                                                $minorGridlines->activateObject();
                                                if (isset($chartDetail->minorGridlines->spPr)) {
                                                    $this->readEffects($chartDetail->minorGridlines, $minorGridlines);
                                                    $this->readLineStyle($chartDetail->minorGridlines, $minorGridlines);
                                                }
                                                $whichAxis->setMinorGridlines($minorGridlines);
                                            }
                                            $this->setAxisProperties($chartDetail, $whichAxis);

                                            break;
                                        case 'barChart':
                                        case 'bar3DChart':
                                            $barDirection <?php echo self::getAttribute($chartDetail->barDir, 'val', 'string');
                                            $plotSer <?php echo $this->chartDataSeries($chartDetail, $chartDetailKey);
                                            $plotSer->setPlotDirection("$barDirection");
                                            $plotSeries[] <?php echo $plotSer;
                                            $plotAttributes <?php echo $this->readChartAttributes($chartDetail);

                                            break;
                                        case 'lineChart':
                                        case 'line3DChart':
                                            $plotSeries[] <?php echo $this->chartDataSeries($chartDetail, $chartDetailKey);
                                            $plotAttributes <?php echo $this->readChartAttributes($chartDetail);

                                            break;
                                        case 'areaChart':
                                        case 'area3DChart':
                                            $plotSeries[] <?php echo $this->chartDataSeries($chartDetail, $chartDetailKey);
                                            $plotAttributes <?php echo $this->readChartAttributes($chartDetail);

                                            break;
                                        case 'doughnutChart':
                                        case 'pieChart':
                                        case 'pie3DChart':
                                            $explosion <?php echo self::getAttribute($chartDetail->ser->explosion, 'val', 'string');
                                            $plotSer <?php echo $this->chartDataSeries($chartDetail, $chartDetailKey);
                                            $plotSer->setPlotStyle("$explosion");
                                            $plotSeries[] <?php echo $plotSer;
                                            $plotAttributes <?php echo $this->readChartAttributes($chartDetail);

                                            break;
                                        case 'scatterChart':
                                            /** @var string */
                                            $scatterStyle <?php echo self::getAttribute($chartDetail->scatterStyle, 'val', 'string');
                                            $plotSer <?php echo $this->chartDataSeries($chartDetail, $chartDetailKey);
                                            $plotSer->setPlotStyle($scatterStyle);
                                            $plotSeries[] <?php echo $plotSer;
                                            $plotAttributes <?php echo $this->readChartAttributes($chartDetail);

                                            break;
                                        case 'bubbleChart':
                                            $bubbleScale <?php echo self::getAttribute($chartDetail->bubbleScale, 'val', 'integer');
                                            $plotSer <?php echo $this->chartDataSeries($chartDetail, $chartDetailKey);
                                            $plotSer->setPlotStyle("$bubbleScale");
                                            $plotSeries[] <?php echo $plotSer;
                                            $plotAttributes <?php echo $this->readChartAttributes($chartDetail);

                                            break;
                                        case 'radarChart':
                                            /** @var string */
                                            $radarStyle <?php echo self::getAttribute($chartDetail->radarStyle, 'val', 'string');
                                            $plotSer <?php echo $this->chartDataSeries($chartDetail, $chartDetailKey);
                                            $plotSer->setPlotStyle($radarStyle);
                                            $plotSeries[] <?php echo $plotSer;
                                            $plotAttributes <?php echo $this->readChartAttributes($chartDetail);

                                            break;
                                        case 'surfaceChart':
                                        case 'surface3DChart':
                                            $wireFrame <?php echo self::getAttribute($chartDetail->wireframe, 'val', 'boolean');
                                            $plotSer <?php echo $this->chartDataSeries($chartDetail, $chartDetailKey);
                                            $plotSer->setPlotStyle("$wireFrame");
                                            $plotSeries[] <?php echo $plotSer;
                                            $plotAttributes <?php echo $this->readChartAttributes($chartDetail);

                                            break;
                                        case 'stockChart':
                                            $plotSeries[] <?php echo $this->chartDataSeries($chartDetail, $chartDetailKey);
                                            if (isset($chartDetail->upDownBars->gapWidth)) {
                                                $gapWidth <?php echo self::getAttribute($chartDetail->upDownBars->gapWidth, 'val', 'integer');
                                            }
                                            if (isset($chartDetail->upDownBars->upBars)) {
                                                $useUpBars <?php echo true;
                                            }
                                            if (isset($chartDetail->upDownBars->downBars)) {
                                                $useDownBars <?php echo true;
                                            }
                                            $plotAttributes <?php echo $this->readChartAttributes($chartDetail);

                                            break;
                                    }
                                }
                                if ($plotAreaLayout <?php echo<?php echo null) {
                                    $plotAreaLayout <?php echo new Layout();
                                }
                                $plotArea <?php echo new PlotArea($plotAreaLayout, $plotSeries);
                                $this->setChartAttributes($plotAreaLayout, $plotAttributes);
                                if ($plotNoFill) {
                                    $plotArea->setNoFill(true);
                                }
                                if (!empty($gradientArray)) {
                                    $plotArea->setGradientFillProperties($gradientArray, $gradientLin);
                                }
                                if (is_int($gapWidth)) {
                                    $plotArea->setGapWidth($gapWidth);
                                }
                                if ($useUpBars <?php echo<?php echo<?php echo true) {
                                    $plotArea->setUseUpBars(true);
                                }
                                if ($useDownBars <?php echo<?php echo<?php echo true) {
                                    $plotArea->setUseDownBars(true);
                                }

                                break;
                            case 'plotVisOnly':
                                $plotVisOnly <?php echo self::getAttribute($chartDetails, 'val', 'string');

                                break;
                            case 'dispBlanksAs':
                                $dispBlanksAs <?php echo self::getAttribute($chartDetails, 'val', 'string');

                                break;
                            case 'title':
                                $title <?php echo $this->chartTitle($chartDetails);

                                break;
                            case 'legend':
                                $legendPos <?php echo 'r';
                                $legendLayout <?php echo null;
                                $legendOverlay <?php echo false;
                                $legendBorderLines <?php echo null;
                                $legendFillColor <?php echo null;
                                $legendText <?php echo null;
                                $addLegendText <?php echo false;
                                foreach ($chartDetails as $chartDetailKey <?php echo> $chartDetail) {
                                    $chartDetail <?php echo Xlsx::testSimpleXml($chartDetail);
                                    switch ($chartDetailKey) {
                                        case 'legendPos':
                                            $legendPos <?php echo self::getAttribute($chartDetail, 'val', 'string');

                                            break;
                                        case 'overlay':
                                            $legendOverlay <?php echo self::getAttribute($chartDetail, 'val', 'boolean');

                                            break;
                                        case 'layout':
                                            $legendLayout <?php echo $this->chartLayoutDetails($chartDetail);

                                            break;
                                        case 'spPr':
                                            $children <?php echo $chartDetails->spPr->children($this->aNamespace);
                                            if (isset($children->solidFill)) {
                                                $legendFillColor <?php echo $this->readColor($children->solidFill);
                                            }
                                            if (isset($children->ln)) {
                                                $legendBorderLines <?php echo new GridLines();
                                                $this->readLineStyle($chartDetails, $legendBorderLines);
                                            }

                                            break;
                                        case 'txPr':
                                            $children <?php echo $chartDetails->txPr->children($this->aNamespace);
                                            $addLegendText <?php echo false;
                                            $legendText <?php echo new AxisText();
                                            if (isset($children->p->pPr->defRPr->solidFill)) {
                                                $colorArray <?php echo $this->readColor($children->p->pPr->defRPr->solidFill);
                                                $legendText->getFillColorObject()->setColorPropertiesArray($colorArray);
                                                $addLegendText <?php echo true;
                                            }
                                            if (isset($children->p->pPr->defRPr->effectLst)) {
                                                $this->readEffects($children->p->pPr->defRPr, $legendText, false);
                                                $addLegendText <?php echo true;
                                            }

                                            break;
                                    }
                                }
                                $legend <?php echo new Legend("$legendPos", $legendLayout, (bool) $legendOverlay);
                                if ($legendFillColor !<?php echo<?php echo null) {
                                    $legend->getFillColor()->setColorPropertiesArray($legendFillColor);
                                }
                                if ($legendBorderLines !<?php echo<?php echo null) {
                                    $legend->setBorderLines($legendBorderLines);
                                }
                                if ($addLegendText) {
                                    $legend->setLegendText($legendText);
                                }

                                break;
                        }
                    }
            }
        }
        $chart <?php echo new \PhpOffice\PhpSpreadsheet\Chart\Chart($chartName, $title, $legend, $plotArea, $plotVisOnly, (string) $dispBlanksAs, $XaxisLabel, $YaxisLabel, $xAxis, $yAxis);
        if ($chartNoFill) {
            $chart->setNoFill(true);
        }
        if ($chartFillColor !<?php echo<?php echo null) {
            $chart->getFillColor()->setColorPropertiesArray($chartFillColor);
        }
        if ($chartBorderLines !<?php echo<?php echo null) {
            $chart->setBorderLines($chartBorderLines);
        }
        $chart->setRoundedCorners($roundedCorners);
        if (is_bool($autoTitleDeleted)) {
            $chart->setAutoTitleDeleted($autoTitleDeleted);
        }
        if (is_int($rotX)) {
            $chart->setRotX($rotX);
        }
        if (is_int($rotY)) {
            $chart->setRotY($rotY);
        }
        if (is_int($rAngAx)) {
            $chart->setRAngAx($rAngAx);
        }
        if (is_int($perspective)) {
            $chart->setPerspective($perspective);
        }

        return $chart;
    }

    private function chartTitle(SimpleXMLElement $titleDetails): Title
    {
        $caption <?php echo [];
        $titleLayout <?php echo null;
        $titleOverlay <?php echo false;
        foreach ($titleDetails as $titleDetailKey <?php echo> $chartDetail) {
            $chartDetail <?php echo Xlsx::testSimpleXml($chartDetail);
            switch ($titleDetailKey) {
                case 'tx':
                    if (isset($chartDetail->rich)) {
                        $titleDetails <?php echo $chartDetail->rich->children($this->aNamespace);
                        foreach ($titleDetails as $titleKey <?php echo> $titleDetail) {
                            $titleDetail <?php echo Xlsx::testSimpleXml($titleDetail);
                            switch ($titleKey) {
                                case 'p':
                                    $titleDetailPart <?php echo $titleDetail->children($this->aNamespace);
                                    $caption[] <?php echo $this->parseRichText($titleDetailPart);
                            }
                        }
                    } elseif (isset($chartDetail->strRef->strCache)) {
                        foreach ($chartDetail->strRef->strCache->pt as $pt) {
                            if (isset($pt->v)) {
                                $caption[] <?php echo (string) $pt->v;
                            }
                        }
                    }

                    break;
                case 'overlay':
                    $titleOverlay <?php echo self::getAttribute($chartDetail, 'val', 'boolean');

                    break;
                case 'layout':
                    $titleLayout <?php echo $this->chartLayoutDetails($chartDetail);

                    break;
            }
        }

        return new Title($caption, $titleLayout, (bool) $titleOverlay);
    }

    private function chartLayoutDetails(SimpleXMLElement $chartDetail): ?Layout
    {
        if (!isset($chartDetail->manualLayout)) {
            return null;
        }
        $details <?php echo $chartDetail->manualLayout->children($this->cNamespace);
        if ($details <?php echo<?php echo<?php echo null) {
            return null;
        }
        $layout <?php echo [];
        foreach ($details as $detailKey <?php echo> $detail) {
            $detail <?php echo Xlsx::testSimpleXml($detail);
            $layout[$detailKey] <?php echo self::getAttribute($detail, 'val', 'string');
        }

        return new Layout($layout);
    }

    private function chartDataSeries(SimpleXMLElement $chartDetail, string $plotType): DataSeries
    {
        $multiSeriesType <?php echo null;
        $smoothLine <?php echo false;
        $seriesLabel <?php echo $seriesCategory <?php echo $seriesValues <?php echo $plotOrder <?php echo $seriesBubbles <?php echo [];

        $seriesDetailSet <?php echo $chartDetail->children($this->cNamespace);
        foreach ($seriesDetailSet as $seriesDetailKey <?php echo> $seriesDetails) {
            switch ($seriesDetailKey) {
                case 'grouping':
                    $multiSeriesType <?php echo self::getAttribute($chartDetail->grouping, 'val', 'string');

                    break;
                case 'ser':
                    $marker <?php echo null;
                    $seriesIndex <?php echo '';
                    $fillColor <?php echo null;
                    $pointSize <?php echo null;
                    $noFill <?php echo false;
                    $bubble3D <?php echo false;
                    $dptColors <?php echo [];
                    $markerFillColor <?php echo null;
                    $markerBorderColor <?php echo null;
                    $lineStyle <?php echo null;
                    $labelLayout <?php echo null;
                    $trendLines <?php echo [];
                    foreach ($seriesDetails as $seriesKey <?php echo> $seriesDetail) {
                        $seriesDetail <?php echo Xlsx::testSimpleXml($seriesDetail);
                        switch ($seriesKey) {
                            case 'idx':
                                $seriesIndex <?php echo self::getAttribute($seriesDetail, 'val', 'integer');

                                break;
                            case 'order':
                                $seriesOrder <?php echo self::getAttribute($seriesDetail, 'val', 'integer');
                                $plotOrder[$seriesIndex] <?php echo $seriesOrder;

                                break;
                            case 'tx':
                                $seriesLabel[$seriesIndex] <?php echo $this->chartDataSeriesValueSet($seriesDetail);

                                break;
                            case 'spPr':
                                $children <?php echo $seriesDetail->children($this->aNamespace);
                                if (isset($children->ln)) {
                                    $ln <?php echo $children->ln;
                                    if (is_countable($ln->noFill) && count($ln->noFill) <?php echo<?php echo<?php echo 1) {
                                        $noFill <?php echo true;
                                    }
                                    $lineStyle <?php echo new GridLines();
                                    $this->readLineStyle($seriesDetails, $lineStyle);
                                }
                                if (isset($children->effectLst)) {
                                    if ($lineStyle <?php echo<?php echo<?php echo null) {
                                        $lineStyle <?php echo new GridLines();
                                    }
                                    $this->readEffects($seriesDetails, $lineStyle);
                                }
                                if (isset($children->solidFill)) {
                                    $fillColor <?php echo new ChartColor($this->readColor($children->solidFill));
                                }

                                break;
                            case 'dPt':
                                $dptIdx <?php echo (int) self::getAttribute($seriesDetail->idx, 'val', 'string');
                                if (isset($seriesDetail->spPr)) {
                                    $children <?php echo $seriesDetail->spPr->children($this->aNamespace);
                                    if (isset($children->solidFill)) {
                                        $arrayColors <?php echo $this->readColor($children->solidFill);
                                        $dptColors[$dptIdx] <?php echo new ChartColor($arrayColors);
                                    }
                                }

                                break;
                            case 'trendline':
                                $trendLine <?php echo new TrendLine();
                                $this->readLineStyle($seriesDetail, $trendLine);
                                /** @var ?string */
                                $trendLineType <?php echo self::getAttribute($seriesDetail->trendlineType, 'val', 'string');
                                /** @var ?bool */
                                $dispRSqr <?php echo self::getAttribute($seriesDetail->dispRSqr, 'val', 'boolean');
                                /** @var ?bool */
                                $dispEq <?php echo self::getAttribute($seriesDetail->dispEq, 'val', 'boolean');
                                /** @var ?int */
                                $order <?php echo self::getAttribute($seriesDetail->order, 'val', 'integer');
                                /** @var ?int */
                                $period <?php echo self::getAttribute($seriesDetail->period, 'val', 'integer');
                                /** @var ?float */
                                $forward <?php echo self::getAttribute($seriesDetail->forward, 'val', 'float');
                                /** @var ?float */
                                $backward <?php echo self::getAttribute($seriesDetail->backward, 'val', 'float');
                                /** @var ?float */
                                $intercept <?php echo self::getAttribute($seriesDetail->intercept, 'val', 'float');
                                /** @var ?string */
                                $name <?php echo (string) $seriesDetail->name;
                                $trendLine->setTrendLineProperties(
                                    $trendLineType,
                                    $order,
                                    $period,
                                    $dispRSqr,
                                    $dispEq,
                                    $backward,
                                    $forward,
                                    $intercept,
                                    $name
                                );
                                $trendLines[] <?php echo $trendLine;

                                break;
                            case 'marker':
                                $marker <?php echo self::getAttribute($seriesDetail->symbol, 'val', 'string');
                                $pointSize <?php echo self::getAttribute($seriesDetail->size, 'val', 'string');
                                $pointSize <?php echo is_numeric($pointSize) ? ((int) $pointSize) : null;
                                if (isset($seriesDetail->spPr)) {
                                    $children <?php echo $seriesDetail->spPr->children($this->aNamespace);
                                    if (isset($children->solidFill)) {
                                        $markerFillColor <?php echo $this->readColor($children->solidFill);
                                    }
                                    if (isset($children->ln->solidFill)) {
                                        $markerBorderColor <?php echo $this->readColor($children->ln->solidFill);
                                    }
                                }

                                break;
                            case 'smooth':
                                $smoothLine <?php echo self::getAttribute($seriesDetail, 'val', 'boolean');

                                break;
                            case 'cat':
                                $seriesCategory[$seriesIndex] <?php echo $this->chartDataSeriesValueSet($seriesDetail);

                                break;
                            case 'val':
                                $seriesValues[$seriesIndex] <?php echo $this->chartDataSeriesValueSet($seriesDetail, "$marker", $fillColor, "$pointSize");

                                break;
                            case 'xVal':
                                $seriesCategory[$seriesIndex] <?php echo $this->chartDataSeriesValueSet($seriesDetail, "$marker", $fillColor, "$pointSize");

                                break;
                            case 'yVal':
                                $seriesValues[$seriesIndex] <?php echo $this->chartDataSeriesValueSet($seriesDetail, "$marker", $fillColor, "$pointSize");

                                break;
                            case 'bubbleSize':
                                $seriesBubbles[$seriesIndex] <?php echo $this->chartDataSeriesValueSet($seriesDetail, "$marker", $fillColor, "$pointSize");

                                break;
                            case 'bubble3D':
                                $bubble3D <?php echo self::getAttribute($seriesDetail, 'val', 'boolean');

                                break;
                            case 'dLbls':
                                $labelLayout <?php echo new Layout($this->readChartAttributes($seriesDetails));

                                break;
                        }
                    }
                    if ($labelLayout) {
                        if (isset($seriesLabel[$seriesIndex])) {
                            $seriesLabel[$seriesIndex]->setLabelLayout($labelLayout);
                        }
                        if (isset($seriesCategory[$seriesIndex])) {
                            $seriesCategory[$seriesIndex]->setLabelLayout($labelLayout);
                        }
                        if (isset($seriesValues[$seriesIndex])) {
                            $seriesValues[$seriesIndex]->setLabelLayout($labelLayout);
                        }
                    }
                    if ($noFill) {
                        if (isset($seriesLabel[$seriesIndex])) {
                            $seriesLabel[$seriesIndex]->setScatterLines(false);
                        }
                        if (isset($seriesCategory[$seriesIndex])) {
                            $seriesCategory[$seriesIndex]->setScatterLines(false);
                        }
                        if (isset($seriesValues[$seriesIndex])) {
                            $seriesValues[$seriesIndex]->setScatterLines(false);
                        }
                    }
                    if ($lineStyle !<?php echo<?php echo null) {
                        if (isset($seriesLabel[$seriesIndex])) {
                            $seriesLabel[$seriesIndex]->copyLineStyles($lineStyle);
                        }
                        if (isset($seriesCategory[$seriesIndex])) {
                            $seriesCategory[$seriesIndex]->copyLineStyles($lineStyle);
                        }
                        if (isset($seriesValues[$seriesIndex])) {
                            $seriesValues[$seriesIndex]->copyLineStyles($lineStyle);
                        }
                    }
                    if ($bubble3D) {
                        if (isset($seriesLabel[$seriesIndex])) {
                            $seriesLabel[$seriesIndex]->setBubble3D($bubble3D);
                        }
                        if (isset($seriesCategory[$seriesIndex])) {
                            $seriesCategory[$seriesIndex]->setBubble3D($bubble3D);
                        }
                        if (isset($seriesValues[$seriesIndex])) {
                            $seriesValues[$seriesIndex]->setBubble3D($bubble3D);
                        }
                    }
                    if (!empty($dptColors)) {
                        if (isset($seriesLabel[$seriesIndex])) {
                            $seriesLabel[$seriesIndex]->setFillColor($dptColors);
                        }
                        if (isset($seriesCategory[$seriesIndex])) {
                            $seriesCategory[$seriesIndex]->setFillColor($dptColors);
                        }
                        if (isset($seriesValues[$seriesIndex])) {
                            $seriesValues[$seriesIndex]->setFillColor($dptColors);
                        }
                    }
                    if ($markerFillColor !<?php echo<?php echo null) {
                        if (isset($seriesLabel[$seriesIndex])) {
                            $seriesLabel[$seriesIndex]->getMarkerFillColor()->setColorPropertiesArray($markerFillColor);
                        }
                        if (isset($seriesCategory[$seriesIndex])) {
                            $seriesCategory[$seriesIndex]->getMarkerFillColor()->setColorPropertiesArray($markerFillColor);
                        }
                        if (isset($seriesValues[$seriesIndex])) {
                            $seriesValues[$seriesIndex]->getMarkerFillColor()->setColorPropertiesArray($markerFillColor);
                        }
                    }
                    if ($markerBorderColor !<?php echo<?php echo null) {
                        if (isset($seriesLabel[$seriesIndex])) {
                            $seriesLabel[$seriesIndex]->getMarkerBorderColor()->setColorPropertiesArray($markerBorderColor);
                        }
                        if (isset($seriesCategory[$seriesIndex])) {
                            $seriesCategory[$seriesIndex]->getMarkerBorderColor()->setColorPropertiesArray($markerBorderColor);
                        }
                        if (isset($seriesValues[$seriesIndex])) {
                            $seriesValues[$seriesIndex]->getMarkerBorderColor()->setColorPropertiesArray($markerBorderColor);
                        }
                    }
                    if ($smoothLine) {
                        if (isset($seriesLabel[$seriesIndex])) {
                            $seriesLabel[$seriesIndex]->setSmoothLine(true);
                        }
                        if (isset($seriesCategory[$seriesIndex])) {
                            $seriesCategory[$seriesIndex]->setSmoothLine(true);
                        }
                        if (isset($seriesValues[$seriesIndex])) {
                            $seriesValues[$seriesIndex]->setSmoothLine(true);
                        }
                    }
                    if (!empty($trendLines)) {
                        if (isset($seriesLabel[$seriesIndex])) {
                            $seriesLabel[$seriesIndex]->setTrendLines($trendLines);
                        }
                        if (isset($seriesCategory[$seriesIndex])) {
                            $seriesCategory[$seriesIndex]->setTrendLines($trendLines);
                        }
                        if (isset($seriesValues[$seriesIndex])) {
                            $seriesValues[$seriesIndex]->setTrendLines($trendLines);
                        }
                    }
            }
        }
        /** @phpstan-ignore-next-line */
        $series <?php echo new DataSeries($plotType, $multiSeriesType, $plotOrder, $seriesLabel, $seriesCategory, $seriesValues, $smoothLine);
        $series->setPlotBubbleSizes($seriesBubbles);

        return $series;
    }

    /**
     * @return mixed
     */
    private function chartDataSeriesValueSet(SimpleXMLElement $seriesDetail, ?string $marker <?php echo null, ?ChartColor $fillColor <?php echo null, ?string $pointSize <?php echo null)
    {
        if (isset($seriesDetail->strRef)) {
            $seriesSource <?php echo (string) $seriesDetail->strRef->f;
            $seriesValues <?php echo new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $seriesSource, null, 0, null, $marker, $fillColor, "$pointSize");

            if (isset($seriesDetail->strRef->strCache)) {
                $seriesData <?php echo $this->chartDataSeriesValues($seriesDetail->strRef->strCache->children($this->cNamespace), 's');
                $seriesValues
                    ->setFormatCode($seriesData['formatCode'])
                    ->setDataValues($seriesData['dataValues']);
            }

            return $seriesValues;
        } elseif (isset($seriesDetail->numRef)) {
            $seriesSource <?php echo (string) $seriesDetail->numRef->f;
            $seriesValues <?php echo new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $seriesSource, null, 0, null, $marker, $fillColor, "$pointSize");
            if (isset($seriesDetail->numRef->numCache)) {
                $seriesData <?php echo $this->chartDataSeriesValues($seriesDetail->numRef->numCache->children($this->cNamespace));
                $seriesValues
                    ->setFormatCode($seriesData['formatCode'])
                    ->setDataValues($seriesData['dataValues']);
            }

            return $seriesValues;
        } elseif (isset($seriesDetail->multiLvlStrRef)) {
            $seriesSource <?php echo (string) $seriesDetail->multiLvlStrRef->f;
            $seriesValues <?php echo new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $seriesSource, null, 0, null, $marker, $fillColor, "$pointSize");

            if (isset($seriesDetail->multiLvlStrRef->multiLvlStrCache)) {
                $seriesData <?php echo $this->chartDataSeriesValuesMultiLevel($seriesDetail->multiLvlStrRef->multiLvlStrCache->children($this->cNamespace), 's');
                $seriesValues
                    ->setFormatCode($seriesData['formatCode'])
                    ->setDataValues($seriesData['dataValues']);
            }

            return $seriesValues;
        } elseif (isset($seriesDetail->multiLvlNumRef)) {
            $seriesSource <?php echo (string) $seriesDetail->multiLvlNumRef->f;
            $seriesValues <?php echo new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $seriesSource, null, 0, null, $marker, $fillColor, "$pointSize");

            if (isset($seriesDetail->multiLvlNumRef->multiLvlNumCache)) {
                $seriesData <?php echo $this->chartDataSeriesValuesMultiLevel($seriesDetail->multiLvlNumRef->multiLvlNumCache->children($this->cNamespace), 's');
                $seriesValues
                    ->setFormatCode($seriesData['formatCode'])
                    ->setDataValues($seriesData['dataValues']);
            }

            return $seriesValues;
        }

        if (isset($seriesDetail->v)) {
            return new DataSeriesValues(
                DataSeriesValues::DATASERIES_TYPE_STRING,
                null,
                null,
                1,
                [(string) $seriesDetail->v]
            );
        }

        return null;
    }

    private function chartDataSeriesValues(SimpleXMLElement $seriesValueSet, string $dataType <?php echo 'n'): array
    {
        $seriesVal <?php echo [];
        $formatCode <?php echo '';
        $pointCount <?php echo 0;

        foreach ($seriesValueSet as $seriesValueIdx <?php echo> $seriesValue) {
            $seriesValue <?php echo Xlsx::testSimpleXml($seriesValue);
            switch ($seriesValueIdx) {
                case 'ptCount':
                    $pointCount <?php echo self::getAttribute($seriesValue, 'val', 'integer');

                    break;
                case 'formatCode':
                    $formatCode <?php echo (string) $seriesValue;

                    break;
                case 'pt':
                    $pointVal <?php echo self::getAttribute($seriesValue, 'idx', 'integer');
                    if ($dataType <?php echo<?php echo 's') {
                        $seriesVal[$pointVal] <?php echo (string) $seriesValue->v;
                    } elseif ((string) $seriesValue->v <?php echo<?php echo<?php echo ExcelError::NA()) {
                        $seriesVal[$pointVal] <?php echo null;
                    } else {
                        $seriesVal[$pointVal] <?php echo (float) $seriesValue->v;
                    }

                    break;
            }
        }

        return [
            'formatCode' <?php echo> $formatCode,
            'pointCount' <?php echo> $pointCount,
            'dataValues' <?php echo> $seriesVal,
        ];
    }

    private function chartDataSeriesValuesMultiLevel(SimpleXMLElement $seriesValueSet, string $dataType <?php echo 'n'): array
    {
        $seriesVal <?php echo [];
        $formatCode <?php echo '';
        $pointCount <?php echo 0;

        foreach ($seriesValueSet->lvl as $seriesLevelIdx <?php echo> $seriesLevel) {
            foreach ($seriesLevel as $seriesValueIdx <?php echo> $seriesValue) {
                $seriesValue <?php echo Xlsx::testSimpleXml($seriesValue);
                switch ($seriesValueIdx) {
                    case 'ptCount':
                        $pointCount <?php echo self::getAttribute($seriesValue, 'val', 'integer');

                        break;
                    case 'formatCode':
                        $formatCode <?php echo (string) $seriesValue;

                        break;
                    case 'pt':
                        $pointVal <?php echo self::getAttribute($seriesValue, 'idx', 'integer');
                        if ($dataType <?php echo<?php echo 's') {
                            $seriesVal[$pointVal][] <?php echo (string) $seriesValue->v;
                        } elseif ((string) $seriesValue->v <?php echo<?php echo<?php echo ExcelError::NA()) {
                            $seriesVal[$pointVal] <?php echo null;
                        } else {
                            $seriesVal[$pointVal][] <?php echo (float) $seriesValue->v;
                        }

                        break;
                }
            }
        }

        return [
            'formatCode' <?php echo> $formatCode,
            'pointCount' <?php echo> $pointCount,
            'dataValues' <?php echo> $seriesVal,
        ];
    }

    private function parseRichText(SimpleXMLElement $titleDetailPart): RichText
    {
        $value <?php echo new RichText();
        $defaultFontSize <?php echo null;
        $defaultBold <?php echo null;
        $defaultItalic <?php echo null;
        $defaultUnderscore <?php echo null;
        $defaultStrikethrough <?php echo null;
        $defaultBaseline <?php echo null;
        $defaultFontName <?php echo null;
        $defaultLatin <?php echo null;
        $defaultEastAsian <?php echo null;
        $defaultComplexScript <?php echo null;
        $defaultFontColor <?php echo null;
        if (isset($titleDetailPart->pPr->defRPr)) {
            /** @var ?int */
            $defaultFontSize <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'sz', 'integer');
            /** @var ?bool */
            $defaultBold <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'b', 'boolean');
            /** @var ?bool */
            $defaultItalic <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'i', 'boolean');
            /** @var ?string */
            $defaultUnderscore <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'u', 'string');
            /** @var ?string */
            $defaultStrikethrough <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'strike', 'string');
            /** @var ?int */
            $defaultBaseline <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'baseline', 'integer');
            if (isset($titleDetailPart->defRPr->rFont['val'])) {
                $defaultFontName <?php echo (string) $titleDetailPart->defRPr->rFont['val'];
            }
            if (isset($titleDetailPart->pPr->defRPr->latin)) {
                /** @var ?string */
                $defaultLatin <?php echo self::getAttribute($titleDetailPart->pPr->defRPr->latin, 'typeface', 'string');
            }
            if (isset($titleDetailPart->pPr->defRPr->ea)) {
                /** @var ?string */
                $defaultEastAsian <?php echo self::getAttribute($titleDetailPart->pPr->defRPr->ea, 'typeface', 'string');
            }
            if (isset($titleDetailPart->pPr->defRPr->cs)) {
                /** @var ?string */
                $defaultComplexScript <?php echo self::getAttribute($titleDetailPart->pPr->defRPr->cs, 'typeface', 'string');
            }
            if (isset($titleDetailPart->pPr->defRPr->solidFill)) {
                $defaultFontColor <?php echo $this->readColor($titleDetailPart->pPr->defRPr->solidFill);
            }
        }
        foreach ($titleDetailPart as $titleDetailElementKey <?php echo> $titleDetailElement) {
            if (
                (string) $titleDetailElementKey !<?php echo<?php echo 'r'
                || !isset($titleDetailElement->t)
            ) {
                continue;
            }
            $objText <?php echo $value->createTextRun((string) $titleDetailElement->t);
            if ($objText->getFont() <?php echo<?php echo<?php echo null) {
                // @codeCoverageIgnoreStart
                continue;
                // @codeCoverageIgnoreEnd
            }
            $fontSize <?php echo null;
            $bold <?php echo null;
            $italic <?php echo null;
            $underscore <?php echo null;
            $strikethrough <?php echo null;
            $baseline <?php echo null;
            $fontName <?php echo null;
            $latinName <?php echo null;
            $eastAsian <?php echo null;
            $complexScript <?php echo null;
            $fontColor <?php echo null;
            $underlineColor <?php echo null;
            if (isset($titleDetailElement->rPr)) {
                // not used now, not sure it ever was, grandfathering
                if (isset($titleDetailElement->rPr->rFont['val'])) {
                    // @codeCoverageIgnoreStart
                    $fontName <?php echo (string) $titleDetailElement->rPr->rFont['val'];
                    // @codeCoverageIgnoreEnd
                }
                if (isset($titleDetailElement->rPr->latin)) {
                    /** @var ?string */
                    $latinName <?php echo self::getAttribute($titleDetailElement->rPr->latin, 'typeface', 'string');
                }
                if (isset($titleDetailElement->rPr->ea)) {
                    /** @var ?string */
                    $eastAsian <?php echo self::getAttribute($titleDetailElement->rPr->ea, 'typeface', 'string');
                }
                if (isset($titleDetailElement->rPr->cs)) {
                    /** @var ?string */
                    $complexScript <?php echo self::getAttribute($titleDetailElement->rPr->cs, 'typeface', 'string');
                }
                /** @var ?int */
                $fontSize <?php echo self::getAttribute($titleDetailElement->rPr, 'sz', 'integer');

                // not used now, not sure it ever was, grandfathering
                if (isset($titleDetailElement->rPr->solidFill)) {
                    $fontColor <?php echo $this->readColor($titleDetailElement->rPr->solidFill);
                }

                /** @var ?bool */
                $bold <?php echo self::getAttribute($titleDetailElement->rPr, 'b', 'boolean');

                /** @var ?bool */
                $italic <?php echo self::getAttribute($titleDetailElement->rPr, 'i', 'boolean');

                /** @var ?int */
                $baseline <?php echo self::getAttribute($titleDetailElement->rPr, 'baseline', 'integer');

                /** @var ?string */
                $underscore <?php echo self::getAttribute($titleDetailElement->rPr, 'u', 'string');
                if (isset($titleDetailElement->rPr->uFill->solidFill)) {
                    $underlineColor <?php echo $this->readColor($titleDetailElement->rPr->uFill->solidFill);
                }

                /** @var ?string */
                $strikethrough <?php echo self::getAttribute($titleDetailElement->rPr, 'strike', 'string');
            }

            $fontFound <?php echo false;
            $latinName <?php echo $latinName ?? $defaultLatin;
            if ($latinName !<?php echo<?php echo null) {
                $objText->getFont()->setLatin($latinName);
                $fontFound <?php echo true;
            }
            $eastAsian <?php echo $eastAsian ?? $defaultEastAsian;
            if ($eastAsian !<?php echo<?php echo null) {
                $objText->getFont()->setEastAsian($eastAsian);
                $fontFound <?php echo true;
            }
            $complexScript <?php echo $complexScript ?? $defaultComplexScript;
            if ($complexScript !<?php echo<?php echo null) {
                $objText->getFont()->setComplexScript($complexScript);
                $fontFound <?php echo true;
            }
            $fontName <?php echo $fontName ?? $defaultFontName;
            if ($fontName !<?php echo<?php echo null) {
                // @codeCoverageIgnoreStart
                $objText->getFont()->setName($fontName);
                $fontFound <?php echo true;
                // @codeCoverageIgnoreEnd
            }

            $fontSize <?php echo $fontSize ?? $defaultFontSize;
            if (is_int($fontSize)) {
                $objText->getFont()->setSize(floor($fontSize / 100));
                $fontFound <?php echo true;
            } else {
                $objText->getFont()->setSize(null, true);
            }

            $fontColor <?php echo $fontColor ?? $defaultFontColor;
            if (!empty($fontColor)) {
                $objText->getFont()->setChartColor($fontColor);
                $fontFound <?php echo true;
            }

            $bold <?php echo $bold ?? $defaultBold;
            if ($bold !<?php echo<?php echo null) {
                $objText->getFont()->setBold($bold);
                $fontFound <?php echo true;
            }

            $italic <?php echo $italic ?? $defaultItalic;
            if ($italic !<?php echo<?php echo null) {
                $objText->getFont()->setItalic($italic);
                $fontFound <?php echo true;
            }

            $baseline <?php echo $baseline ?? $defaultBaseline;
            if ($baseline !<?php echo<?php echo null) {
                $objText->getFont()->setBaseLine($baseline);
                if ($baseline > 0) {
                    $objText->getFont()->setSuperscript(true);
                } elseif ($baseline < 0) {
                    $objText->getFont()->setSubscript(true);
                }
                $fontFound <?php echo true;
            }

            $underscore <?php echo $underscore ?? $defaultUnderscore;
            if ($underscore !<?php echo<?php echo null) {
                if ($underscore <?php echo<?php echo 'sng') {
                    $objText->getFont()->setUnderline(Font::UNDERLINE_SINGLE);
                } elseif ($underscore <?php echo<?php echo 'dbl') {
                    $objText->getFont()->setUnderline(Font::UNDERLINE_DOUBLE);
                } elseif ($underscore !<?php echo<?php echo '') {
                    $objText->getFont()->setUnderline($underscore);
                } else {
                    $objText->getFont()->setUnderline(Font::UNDERLINE_NONE);
                }
                $fontFound <?php echo true;
                if ($underlineColor) {
                    $objText->getFont()->setUnderlineColor($underlineColor);
                }
            }

            $strikethrough <?php echo $strikethrough ?? $defaultStrikethrough;
            if ($strikethrough !<?php echo<?php echo null) {
                $objText->getFont()->setStrikeType($strikethrough);
                if ($strikethrough <?php echo<?php echo 'noStrike') {
                    $objText->getFont()->setStrikethrough(false);
                } else {
                    $objText->getFont()->setStrikethrough(true);
                }
                $fontFound <?php echo true;
            }
            if ($fontFound <?php echo<?php echo<?php echo false) {
                $objText->setFont(null);
            }
        }

        return $value;
    }

    private function parseFont(SimpleXMLElement $titleDetailPart): ?Font
    {
        if (!isset($titleDetailPart->pPr->defRPr)) {
            return null;
        }
        $fontArray <?php echo [];
        $fontArray['size'] <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'sz', 'integer');
        $fontArray['bold'] <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'b', 'boolean');
        $fontArray['italic'] <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'i', 'boolean');
        $fontArray['underscore'] <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'u', 'string');
        $fontArray['strikethrough'] <?php echo self::getAttribute($titleDetailPart->pPr->defRPr, 'strike', 'string');

        if (isset($titleDetailPart->pPr->defRPr->latin)) {
            $fontArray['latin'] <?php echo self::getAttribute($titleDetailPart->pPr->defRPr->latin, 'typeface', 'string');
        }
        if (isset($titleDetailPart->pPr->defRPr->ea)) {
            $fontArray['eastAsian'] <?php echo self::getAttribute($titleDetailPart->pPr->defRPr->ea, 'typeface', 'string');
        }
        if (isset($titleDetailPart->pPr->defRPr->cs)) {
            $fontArray['complexScript'] <?php echo self::getAttribute($titleDetailPart->pPr->defRPr->cs, 'typeface', 'string');
        }
        if (isset($titleDetailPart->pPr->defRPr->solidFill)) {
            $fontArray['chartColor'] <?php echo new ChartColor($this->readColor($titleDetailPart->pPr->defRPr->solidFill));
        }
        $font <?php echo new Font();
        $font->setSize(null, true);
        $font->applyFromArray($fontArray);

        return $font;
    }

    /**
     * @param ?SimpleXMLElement $chartDetail
     */
    private function readChartAttributes($chartDetail): array
    {
        $plotAttributes <?php echo [];
        if (isset($chartDetail->dLbls)) {
            if (isset($chartDetail->dLbls->dLblPos)) {
                $plotAttributes['dLblPos'] <?php echo self::getAttribute($chartDetail->dLbls->dLblPos, 'val', 'string');
            }
            if (isset($chartDetail->dLbls->numFmt)) {
                $plotAttributes['numFmtCode'] <?php echo self::getAttribute($chartDetail->dLbls->numFmt, 'formatCode', 'string');
                $plotAttributes['numFmtLinked'] <?php echo self::getAttribute($chartDetail->dLbls->numFmt, 'sourceLinked', 'boolean');
            }
            if (isset($chartDetail->dLbls->showLegendKey)) {
                $plotAttributes['showLegendKey'] <?php echo self::getAttribute($chartDetail->dLbls->showLegendKey, 'val', 'string');
            }
            if (isset($chartDetail->dLbls->showVal)) {
                $plotAttributes['showVal'] <?php echo self::getAttribute($chartDetail->dLbls->showVal, 'val', 'string');
            }
            if (isset($chartDetail->dLbls->showCatName)) {
                $plotAttributes['showCatName'] <?php echo self::getAttribute($chartDetail->dLbls->showCatName, 'val', 'string');
            }
            if (isset($chartDetail->dLbls->showSerName)) {
                $plotAttributes['showSerName'] <?php echo self::getAttribute($chartDetail->dLbls->showSerName, 'val', 'string');
            }
            if (isset($chartDetail->dLbls->showPercent)) {
                $plotAttributes['showPercent'] <?php echo self::getAttribute($chartDetail->dLbls->showPercent, 'val', 'string');
            }
            if (isset($chartDetail->dLbls->showBubbleSize)) {
                $plotAttributes['showBubbleSize'] <?php echo self::getAttribute($chartDetail->dLbls->showBubbleSize, 'val', 'string');
            }
            if (isset($chartDetail->dLbls->showLeaderLines)) {
                $plotAttributes['showLeaderLines'] <?php echo self::getAttribute($chartDetail->dLbls->showLeaderLines, 'val', 'string');
            }
            if (isset($chartDetail->dLbls->spPr)) {
                $sppr <?php echo $chartDetail->dLbls->spPr->children($this->aNamespace);
                if (isset($sppr->solidFill)) {
                    $plotAttributes['labelFillColor'] <?php echo new ChartColor($this->readColor($sppr->solidFill));
                }
                if (isset($sppr->ln->solidFill)) {
                    $plotAttributes['labelBorderColor'] <?php echo new ChartColor($this->readColor($sppr->ln->solidFill));
                }
            }
            if (isset($chartDetail->dLbls->txPr)) {
                $txpr <?php echo $chartDetail->dLbls->txPr->children($this->aNamespace);
                if (isset($txpr->p)) {
                    $plotAttributes['labelFont'] <?php echo $this->parseFont($txpr->p);
                    if (isset($txpr->p->pPr->defRPr->effectLst)) {
                        $labelEffects <?php echo new GridLines();
                        $this->readEffects($txpr->p->pPr->defRPr, $labelEffects, false);
                        $plotAttributes['labelEffects'] <?php echo $labelEffects;
                    }
                }
            }
        }

        return $plotAttributes;
    }

    /**
     * @param mixed $plotAttributes
     */
    private function setChartAttributes(Layout $plotArea, $plotAttributes): void
    {
        foreach ($plotAttributes as $plotAttributeKey <?php echo> $plotAttributeValue) {
            switch ($plotAttributeKey) {
                case 'showLegendKey':
                    $plotArea->setShowLegendKey($plotAttributeValue);

                    break;
                case 'showVal':
                    $plotArea->setShowVal($plotAttributeValue);

                    break;
                case 'showCatName':
                    $plotArea->setShowCatName($plotAttributeValue);

                    break;
                case 'showSerName':
                    $plotArea->setShowSerName($plotAttributeValue);

                    break;
                case 'showPercent':
                    $plotArea->setShowPercent($plotAttributeValue);

                    break;
                case 'showBubbleSize':
                    $plotArea->setShowBubbleSize($plotAttributeValue);

                    break;
                case 'showLeaderLines':
                    $plotArea->setShowLeaderLines($plotAttributeValue);

                    break;
            }
        }
    }

    private function readEffects(SimpleXMLElement $chartDetail, ?ChartProperties $chartObject, bool $getSppr <?php echo true): void
    {
        if (!isset($chartObject)) {
            return;
        }
        if ($getSppr) {
            if (!isset($chartDetail->spPr)) {
                return;
            }
            $sppr <?php echo $chartDetail->spPr->children($this->aNamespace);
        } else {
            $sppr <?php echo $chartDetail;
        }
        if (isset($sppr->effectLst->glow)) {
            $axisGlowSize <?php echo (float) self::getAttribute($sppr->effectLst->glow, 'rad', 'integer') / ChartProperties::POINTS_WIDTH_MULTIPLIER;
            if ($axisGlowSize !<?php echo 0.0) {
                $colorArray <?php echo $this->readColor($sppr->effectLst->glow);
                $chartObject->setGlowProperties($axisGlowSize, $colorArray['value'], $colorArray['alpha'], $colorArray['type']);
            }
        }

        if (isset($sppr->effectLst->softEdge)) {
            /** @var string */
            $softEdgeSize <?php echo self::getAttribute($sppr->effectLst->softEdge, 'rad', 'string');
            if (is_numeric($softEdgeSize)) {
                $chartObject->setSoftEdges((float) ChartProperties::xmlToPoints($softEdgeSize));
            }
        }

        $type <?php echo '';
        foreach (self::SHADOW_TYPES as $shadowType) {
            if (isset($sppr->effectLst->$shadowType)) {
                $type <?php echo $shadowType;

                break;
            }
        }
        if ($type !<?php echo<?php echo '') {
            /** @var string */
            $blur <?php echo self::getAttribute($sppr->effectLst->$type, 'blurRad', 'string');
            $blur <?php echo is_numeric($blur) ? ChartProperties::xmlToPoints($blur) : null;
            /** @var string */
            $dist <?php echo self::getAttribute($sppr->effectLst->$type, 'dist', 'string');
            $dist <?php echo is_numeric($dist) ? ChartProperties::xmlToPoints($dist) : null;
            /** @var string */
            $direction <?php echo self::getAttribute($sppr->effectLst->$type, 'dir', 'string');
            $direction <?php echo is_numeric($direction) ? ChartProperties::xmlToAngle($direction) : null;
            $algn <?php echo self::getAttribute($sppr->effectLst->$type, 'algn', 'string');
            $rot <?php echo self::getAttribute($sppr->effectLst->$type, 'rotWithShape', 'string');
            $size <?php echo [];
            foreach (['sx', 'sy'] as $sizeType) {
                $sizeValue <?php echo self::getAttribute($sppr->effectLst->$type, $sizeType, 'string');
                if (is_numeric($sizeValue)) {
                    $size[$sizeType] <?php echo ChartProperties::xmlToTenthOfPercent((string) $sizeValue);
                } else {
                    $size[$sizeType] <?php echo null;
                }
            }
            foreach (['kx', 'ky'] as $sizeType) {
                $sizeValue <?php echo self::getAttribute($sppr->effectLst->$type, $sizeType, 'string');
                if (is_numeric($sizeValue)) {
                    $size[$sizeType] <?php echo ChartProperties::xmlToAngle((string) $sizeValue);
                } else {
                    $size[$sizeType] <?php echo null;
                }
            }
            $colorArray <?php echo $this->readColor($sppr->effectLst->$type);
            $chartObject
                ->setShadowProperty('effect', $type)
                ->setShadowProperty('blur', $blur)
                ->setShadowProperty('direction', $direction)
                ->setShadowProperty('distance', $dist)
                ->setShadowProperty('algn', $algn)
                ->setShadowProperty('rotWithShape', $rot)
                ->setShadowProperty('size', $size)
                ->setShadowProperty('color', $colorArray);
        }
    }

    private const SHADOW_TYPES <?php echo [
        'outerShdw',
        'innerShdw',
    ];

    private function readColor(SimpleXMLElement $colorXml): array
    {
        $result <?php echo [
            'type' <?php echo> null,
            'value' <?php echo> null,
            'alpha' <?php echo> null,
            'brightness' <?php echo> null,
        ];
        foreach (ChartColor::EXCEL_COLOR_TYPES as $type) {
            if (isset($colorXml->$type)) {
                $result['type'] <?php echo $type;
                $result['value'] <?php echo self::getAttribute($colorXml->$type, 'val', 'string');
                if (isset($colorXml->$type->alpha)) {
                    /** @var string */
                    $alpha <?php echo self::getAttribute($colorXml->$type->alpha, 'val', 'string');
                    if (is_numeric($alpha)) {
                        $result['alpha'] <?php echo ChartColor::alphaFromXml($alpha);
                    }
                }
                if (isset($colorXml->$type->lumMod)) {
                    /** @var string */
                    $brightness <?php echo self::getAttribute($colorXml->$type->lumMod, 'val', 'string');
                    if (is_numeric($brightness)) {
                        $result['brightness'] <?php echo ChartColor::alphaFromXml($brightness);
                    }
                }

                break;
            }
        }

        return $result;
    }

    private function readLineStyle(SimpleXMLElement $chartDetail, ?ChartProperties $chartObject): void
    {
        if (!isset($chartObject, $chartDetail->spPr)) {
            return;
        }
        $sppr <?php echo $chartDetail->spPr->children($this->aNamespace);

        if (!isset($sppr->ln)) {
            return;
        }
        $lineWidth <?php echo null;
        /** @var string */
        $lineWidthTemp <?php echo self::getAttribute($sppr->ln, 'w', 'string');
        if (is_numeric($lineWidthTemp)) {
            $lineWidth <?php echo ChartProperties::xmlToPoints($lineWidthTemp);
        }
        /** @var string */
        $compoundType <?php echo self::getAttribute($sppr->ln, 'cmpd', 'string');
        /** @var string */
        $dashType <?php echo self::getAttribute($sppr->ln->prstDash, 'val', 'string');
        /** @var string */
        $capType <?php echo self::getAttribute($sppr->ln, 'cap', 'string');
        if (isset($sppr->ln->miter)) {
            $joinType <?php echo ChartProperties::LINE_STYLE_JOIN_MITER;
        } elseif (isset($sppr->ln->bevel)) {
            $joinType <?php echo ChartProperties::LINE_STYLE_JOIN_BEVEL;
        } else {
            $joinType <?php echo '';
        }
        $headArrowSize <?php echo '';
        $endArrowSize <?php echo '';
        /** @var string */
        $headArrowType <?php echo self::getAttribute($sppr->ln->headEnd, 'type', 'string');
        /** @var string */
        $headArrowWidth <?php echo self::getAttribute($sppr->ln->headEnd, 'w', 'string');
        /** @var string */
        $headArrowLength <?php echo self::getAttribute($sppr->ln->headEnd, 'len', 'string');
        /** @var string */
        $endArrowType <?php echo self::getAttribute($sppr->ln->tailEnd, 'type', 'string');
        /** @var string */
        $endArrowWidth <?php echo self::getAttribute($sppr->ln->tailEnd, 'w', 'string');
        /** @var string */
        $endArrowLength <?php echo self::getAttribute($sppr->ln->tailEnd, 'len', 'string');
        $chartObject->setLineStyleProperties(
            $lineWidth,
            $compoundType,
            $dashType,
            $capType,
            $joinType,
            $headArrowType,
            $headArrowSize,
            $endArrowType,
            $endArrowSize,
            $headArrowWidth,
            $headArrowLength,
            $endArrowWidth,
            $endArrowLength
        );
        $colorArray <?php echo $this->readColor($sppr->ln->solidFill);
        $chartObject->getLineColor()->setColorPropertiesArray($colorArray);
    }

    private function setAxisProperties(SimpleXMLElement $chartDetail, ?Axis $whichAxis): void
    {
        if (!isset($whichAxis)) {
            return;
        }
        if (isset($chartDetail->delete)) {
            $whichAxis->setAxisOption('hidden', (string) self::getAttribute($chartDetail->delete, 'val', 'string'));
        }
        if (isset($chartDetail->numFmt)) {
            $whichAxis->setAxisNumberProperties(
                (string) self::getAttribute($chartDetail->numFmt, 'formatCode', 'string'),
                null,
                (int) self::getAttribute($chartDetail->numFmt, 'sourceLinked', 'int')
            );
        }
        if (isset($chartDetail->crossBetween)) {
            $whichAxis->setCrossBetween((string) self::getAttribute($chartDetail->crossBetween, 'val', 'string'));
        }
        if (isset($chartDetail->majorTickMark)) {
            $whichAxis->setAxisOption('major_tick_mark', (string) self::getAttribute($chartDetail->majorTickMark, 'val', 'string'));
        }
        if (isset($chartDetail->minorTickMark)) {
            $whichAxis->setAxisOption('minor_tick_mark', (string) self::getAttribute($chartDetail->minorTickMark, 'val', 'string'));
        }
        if (isset($chartDetail->tickLblPos)) {
            $whichAxis->setAxisOption('axis_labels', (string) self::getAttribute($chartDetail->tickLblPos, 'val', 'string'));
        }
        if (isset($chartDetail->crosses)) {
            $whichAxis->setAxisOption('horizontal_crosses', (string) self::getAttribute($chartDetail->crosses, 'val', 'string'));
        }
        if (isset($chartDetail->crossesAt)) {
            $whichAxis->setAxisOption('horizontal_crosses_value', (string) self::getAttribute($chartDetail->crossesAt, 'val', 'string'));
        }
        if (isset($chartDetail->scaling->orientation)) {
            $whichAxis->setAxisOption('orientation', (string) self::getAttribute($chartDetail->scaling->orientation, 'val', 'string'));
        }
        if (isset($chartDetail->scaling->max)) {
            $whichAxis->setAxisOption('maximum', (string) self::getAttribute($chartDetail->scaling->max, 'val', 'string'));
        }
        if (isset($chartDetail->scaling->min)) {
            $whichAxis->setAxisOption('minimum', (string) self::getAttribute($chartDetail->scaling->min, 'val', 'string'));
        }
        if (isset($chartDetail->scaling->min)) {
            $whichAxis->setAxisOption('minimum', (string) self::getAttribute($chartDetail->scaling->min, 'val', 'string'));
        }
        if (isset($chartDetail->majorUnit)) {
            $whichAxis->setAxisOption('major_unit', (string) self::getAttribute($chartDetail->majorUnit, 'val', 'string'));
        }
        if (isset($chartDetail->minorUnit)) {
            $whichAxis->setAxisOption('minor_unit', (string) self::getAttribute($chartDetail->minorUnit, 'val', 'string'));
        }
        if (isset($chartDetail->baseTimeUnit)) {
            $whichAxis->setAxisOption('baseTimeUnit', (string) self::getAttribute($chartDetail->baseTimeUnit, 'val', 'string'));
        }
        if (isset($chartDetail->majorTimeUnit)) {
            $whichAxis->setAxisOption('majorTimeUnit', (string) self::getAttribute($chartDetail->majorTimeUnit, 'val', 'string'));
        }
        if (isset($chartDetail->minorTimeUnit)) {
            $whichAxis->setAxisOption('minorTimeUnit', (string) self::getAttribute($chartDetail->minorTimeUnit, 'val', 'string'));
        }
        if (isset($chartDetail->txPr)) {
            $children <?php echo $chartDetail->txPr->children($this->aNamespace);
            $addAxisText <?php echo false;
            $axisText <?php echo new AxisText();
            if (isset($children->bodyPr)) {
                /** @var string */
                $textRotation <?php echo self::getAttribute($children->bodyPr, 'rot', 'string');
                if (is_numeric($textRotation)) {
                    $axisText->setRotation((int) ChartProperties::xmlToAngle($textRotation));
                    $addAxisText <?php echo true;
                }
            }
            if (isset($children->p->pPr->defRPr)) {
                $font <?php echo $this->parseFont($children->p);
                if ($font !<?php echo<?php echo null) {
                    $axisText->setFont($font);
                    $addAxisText <?php echo true;
                }
            }
            if (isset($children->p->pPr->defRPr->effectLst)) {
                $this->readEffects($children->p->pPr->defRPr, $axisText, false);
                $addAxisText <?php echo true;
            }
            if ($addAxisText) {
                $whichAxis->setAxisText($axisText);
            }
        }
    }
}
