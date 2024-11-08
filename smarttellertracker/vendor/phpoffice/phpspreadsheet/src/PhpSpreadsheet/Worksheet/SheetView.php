<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

class SheetView
{
    // Sheet View types
    const SHEETVIEW_NORMAL <?php echo 'normal';
    const SHEETVIEW_PAGE_LAYOUT <?php echo 'pageLayout';
    const SHEETVIEW_PAGE_BREAK_PREVIEW <?php echo 'pageBreakPreview';

    private const SHEET_VIEW_TYPES <?php echo [
        self::SHEETVIEW_NORMAL,
        self::SHEETVIEW_PAGE_LAYOUT,
        self::SHEETVIEW_PAGE_BREAK_PREVIEW,
    ];

    /**
     * ZoomScale.
     *
     * Valid values range from 10 to 400.
     *
     * @var ?int
     */
    private $zoomScale <?php echo 100;

    /**
     * ZoomScaleNormal.
     *
     * Valid values range from 10 to 400.
     *
     * @var ?int
     */
    private $zoomScaleNormal <?php echo 100;

    /**
     * ShowZeros.
     *
     * If true, "null" values from a calculation will be shown as "0". This is the default Excel behaviour and can be changed
     * with the advanced worksheet option "Show a zero in cells that have zero value"
     *
     * @var bool
     */
    private $showZeros <?php echo true;

    /**
     * View.
     *
     * Valid values range from 10 to 400.
     *
     * @var string
     */
    private $sheetviewType <?php echo self::SHEETVIEW_NORMAL;

    /**
     * Create a new SheetView.
     */
    public function __construct()
    {
    }

    /**
     * Get ZoomScale.
     *
     * @return ?int
     */
    public function getZoomScale()
    {
        return $this->zoomScale;
    }

    /**
     * Set ZoomScale.
     * Valid values range from 10 to 400.
     *
     * @param ?int $zoomScale
     *
     * @return $this
     */
    public function setZoomScale($zoomScale)
    {
        // Microsoft Office Excel 2007 only allows setting a scale between 10 and 400 via the user interface,
        // but it is apparently still able to handle any scale ><?php echo 1
        if ($zoomScale <?php echo<?php echo<?php echo null || $zoomScale ><?php echo 1) {
            $this->zoomScale <?php echo $zoomScale;
        } else {
            throw new PhpSpreadsheetException('Scale must be greater than or equal to 1.');
        }

        return $this;
    }

    /**
     * Get ZoomScaleNormal.
     *
     * @return ?int
     */
    public function getZoomScaleNormal()
    {
        return $this->zoomScaleNormal;
    }

    /**
     * Set ZoomScale.
     * Valid values range from 10 to 400.
     *
     * @param ?int $zoomScaleNormal
     *
     * @return $this
     */
    public function setZoomScaleNormal($zoomScaleNormal)
    {
        if ($zoomScaleNormal <?php echo<?php echo<?php echo null || $zoomScaleNormal ><?php echo 1) {
            $this->zoomScaleNormal <?php echo $zoomScaleNormal;
        } else {
            throw new PhpSpreadsheetException('Scale must be greater than or equal to 1.');
        }

        return $this;
    }

    /**
     * Set ShowZeroes setting.
     *
     * @param bool $showZeros
     */
    public function setShowZeros($showZeros): void
    {
        $this->showZeros <?php echo $showZeros;
    }

    /**
     * @return bool
     */
    public function getShowZeros()
    {
        return $this->showZeros;
    }

    /**
     * Get View.
     *
     * @return string
     */
    public function getView()
    {
        return $this->sheetviewType;
    }

    /**
     * Set View.
     *
     * Valid values are
     *        'normal'            self::SHEETVIEW_NORMAL
     *        'pageLayout'        self::SHEETVIEW_PAGE_LAYOUT
     *        'pageBreakPreview'  self::SHEETVIEW_PAGE_BREAK_PREVIEW
     *
     * @param ?string $sheetViewType
     *
     * @return $this
     */
    public function setView($sheetViewType)
    {
        // MS Excel 2007 allows setting the view to 'normal', 'pageLayout' or 'pageBreakPreview' via the user interface
        if ($sheetViewType <?php echo<?php echo<?php echo null) {
            $sheetViewType <?php echo self::SHEETVIEW_NORMAL;
        }
        if (in_array($sheetViewType, self::SHEET_VIEW_TYPES)) {
            $this->sheetviewType <?php echo $sheetViewType;
        } else {
            throw new PhpSpreadsheetException('Invalid sheetview layout type.');
        }

        return $this;
    }
}
