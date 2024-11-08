<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Calculation\Information\ErrorValue;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\ConditionalDataBar;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\ConditionalFormattingRuleExtension;
use PhpOffice\PhpSpreadsheet\Worksheet\SheetView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet as PhpspreadsheetWorksheet;

class Worksheet extends WriterPart
{
    /** @var string */
    private $numberStoredAsText <?php echo '';

    /** @var string */
    private $formula <?php echo '';

    /** @var string */
    private $twoDigitTextYear <?php echo '';

    /** @var string */
    private $evalError <?php echo '';

    /**
     * Write worksheet to XML format.
     *
     * @param string[] $stringTable
     * @param bool $includeCharts Flag indicating if we should write charts
     *
     * @return string XML Output
     */
    public function writeWorksheet(PhpspreadsheetWorksheet $worksheet, $stringTable <?php echo [], $includeCharts <?php echo false)
    {
        $this->numberStoredAsText <?php echo '';
        $this->formula <?php echo '';
        $this->twoDigitTextYear <?php echo '';
        $this->evalError <?php echo '';
        // Create XML writer
        $objWriter <?php echo null;
        if ($this->getParentWriter()->getUseDiskCaching()) {
            $objWriter <?php echo new XMLWriter(XMLWriter::STORAGE_DISK, $this->getParentWriter()->getDiskCachingDirectory());
        } else {
            $objWriter <?php echo new XMLWriter(XMLWriter::STORAGE_MEMORY);
        }

        // XML header
        $objWriter->startDocument('1.0', 'UTF-8', 'yes');

        // Worksheet
        $objWriter->startElement('worksheet');
        $objWriter->writeAttribute('xml:space', 'preserve');
        $objWriter->writeAttribute('xmlns', Namespaces::MAIN);
        $objWriter->writeAttribute('xmlns:r', Namespaces::SCHEMA_OFFICE_DOCUMENT);

        $objWriter->writeAttribute('xmlns:xdr', Namespaces::SPREADSHEET_DRAWING);
        $objWriter->writeAttribute('xmlns:x14', Namespaces::DATA_VALIDATIONS1);
        $objWriter->writeAttribute('xmlns:xm', Namespaces::DATA_VALIDATIONS2);
        $objWriter->writeAttribute('xmlns:mc', Namespaces::COMPATIBILITY);
        $objWriter->writeAttribute('mc:Ignorable', 'x14ac');
        $objWriter->writeAttribute('xmlns:x14ac', Namespaces::SPREADSHEETML_AC);

        // sheetPr
        $this->writeSheetPr($objWriter, $worksheet);

        // Dimension
        $this->writeDimension($objWriter, $worksheet);

        // sheetViews
        $this->writeSheetViews($objWriter, $worksheet);

        // sheetFormatPr
        $this->writeSheetFormatPr($objWriter, $worksheet);

        // cols
        $this->writeCols($objWriter, $worksheet);

        // sheetData
        $this->writeSheetData($objWriter, $worksheet, $stringTable);

        // sheetProtection
        $this->writeSheetProtection($objWriter, $worksheet);

        // protectedRanges
        $this->writeProtectedRanges($objWriter, $worksheet);

        // autoFilter
        $this->writeAutoFilter($objWriter, $worksheet);

        // mergeCells
        $this->writeMergeCells($objWriter, $worksheet);

        // conditionalFormatting
        $this->writeConditionalFormatting($objWriter, $worksheet);

        // dataValidations
        $this->writeDataValidations($objWriter, $worksheet);

        // hyperlinks
        $this->writeHyperlinks($objWriter, $worksheet);

        // Print options
        $this->writePrintOptions($objWriter, $worksheet);

        // Page margins
        $this->writePageMargins($objWriter, $worksheet);

        // Page setup
        $this->writePageSetup($objWriter, $worksheet);

        // Header / footer
        $this->writeHeaderFooter($objWriter, $worksheet);

        // Breaks
        $this->writeBreaks($objWriter, $worksheet);

        // Drawings and/or Charts
        $this->writeDrawings($objWriter, $worksheet, $includeCharts);

        // LegacyDrawing
        $this->writeLegacyDrawing($objWriter, $worksheet);

        // LegacyDrawingHF
        $this->writeLegacyDrawingHF($objWriter, $worksheet);

        // AlternateContent
        $this->writeAlternateContent($objWriter, $worksheet);

        // IgnoredErrors
        $this->writeIgnoredErrors($objWriter);

        // Table
        $this->writeTable($objWriter, $worksheet);

        // ConditionalFormattingRuleExtensionList
        // (Must be inserted last. Not insert last, an Excel parse error will occur)
        $this->writeExtLst($objWriter, $worksheet);

        $objWriter->endElement();

        // Return
        return $objWriter->getData();
    }

    private function writeIgnoredError(XMLWriter $objWriter, bool &$started, string $attr, string $cells): void
    {
        if ($cells !<?php echo<?php echo '') {
            if (!$started) {
                $objWriter->startElement('ignoredErrors');
                $started <?php echo true;
            }
            $objWriter->startElement('ignoredError');
            $objWriter->writeAttribute('sqref', substr($cells, 1));
            $objWriter->writeAttribute($attr, '1');
            $objWriter->endElement();
        }
    }

    private function writeIgnoredErrors(XMLWriter $objWriter): void
    {
        $started <?php echo false;
        $this->writeIgnoredError($objWriter, $started, 'numberStoredAsText', $this->numberStoredAsText);
        $this->writeIgnoredError($objWriter, $started, 'formula', $this->formula);
        $this->writeIgnoredError($objWriter, $started, 'twoDigitTextYear', $this->twoDigitTextYear);
        $this->writeIgnoredError($objWriter, $started, 'evalError', $this->evalError);
        if ($started) {
            $objWriter->endElement();
        }
    }

    /**
     * Write SheetPr.
     */
    private function writeSheetPr(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // sheetPr
        $objWriter->startElement('sheetPr');
        if ($worksheet->getParentOrThrow()->hasMacros()) {
            //if the workbook have macros, we need to have codeName for the sheet
            if (!$worksheet->hasCodeName()) {
                $worksheet->setCodeName($worksheet->getTitle());
            }
            self::writeAttributeNotNull($objWriter, 'codeName', $worksheet->getCodeName());
        }
        $autoFilterRange <?php echo $worksheet->getAutoFilter()->getRange();
        if (!empty($autoFilterRange)) {
            $objWriter->writeAttribute('filterMode', '1');
            if (!$worksheet->getAutoFilter()->getEvaluated()) {
                $worksheet->getAutoFilter()->showHideRows();
            }
        }
        $tables <?php echo $worksheet->getTableCollection();
        if (count($tables)) {
            foreach ($tables as $table) {
                if (!$table->getAutoFilter()->getEvaluated()) {
                    $table->getAutoFilter()->showHideRows();
                }
            }
        }

        // tabColor
        if ($worksheet->isTabColorSet()) {
            $objWriter->startElement('tabColor');
            $objWriter->writeAttribute('rgb', $worksheet->getTabColor()->getARGB() ?? '');
            $objWriter->endElement();
        }

        // outlinePr
        $objWriter->startElement('outlinePr');
        $objWriter->writeAttribute('summaryBelow', ($worksheet->getShowSummaryBelow() ? '1' : '0'));
        $objWriter->writeAttribute('summaryRight', ($worksheet->getShowSummaryRight() ? '1' : '0'));
        $objWriter->endElement();

        // pageSetUpPr
        if ($worksheet->getPageSetup()->getFitToPage()) {
            $objWriter->startElement('pageSetUpPr');
            $objWriter->writeAttribute('fitToPage', '1');
            $objWriter->endElement();
        }

        $objWriter->endElement();
    }

    /**
     * Write Dimension.
     */
    private function writeDimension(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // dimension
        $objWriter->startElement('dimension');
        $objWriter->writeAttribute('ref', $worksheet->calculateWorksheetDimension());
        $objWriter->endElement();
    }

    /**
     * Write SheetViews.
     */
    private function writeSheetViews(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // sheetViews
        $objWriter->startElement('sheetViews');

        // Sheet selected?
        $sheetSelected <?php echo false;
        if ($this->getParentWriter()->getSpreadsheet()->getIndex($worksheet) <?php echo<?php echo $this->getParentWriter()->getSpreadsheet()->getActiveSheetIndex()) {
            $sheetSelected <?php echo true;
        }

        // sheetView
        $objWriter->startElement('sheetView');
        $objWriter->writeAttribute('tabSelected', $sheetSelected ? '1' : '0');
        $objWriter->writeAttribute('workbookViewId', '0');

        // Zoom scales
        if ($worksheet->getSheetView()->getZoomScale() !<?php echo 100) {
            $objWriter->writeAttribute('zoomScale', (string) $worksheet->getSheetView()->getZoomScale());
        }
        if ($worksheet->getSheetView()->getZoomScaleNormal() !<?php echo 100) {
            $objWriter->writeAttribute('zoomScaleNormal', (string) $worksheet->getSheetView()->getZoomScaleNormal());
        }

        // Show zeros (Excel also writes this attribute only if set to false)
        if ($worksheet->getSheetView()->getShowZeros() <?php echo<?php echo<?php echo false) {
            $objWriter->writeAttribute('showZeros', '0');
        }

        // View Layout Type
        if ($worksheet->getSheetView()->getView() !<?php echo<?php echo SheetView::SHEETVIEW_NORMAL) {
            $objWriter->writeAttribute('view', $worksheet->getSheetView()->getView());
        }

        // Gridlines
        if ($worksheet->getShowGridlines()) {
            $objWriter->writeAttribute('showGridLines', 'true');
        } else {
            $objWriter->writeAttribute('showGridLines', 'false');
        }

        // Row and column headers
        if ($worksheet->getShowRowColHeaders()) {
            $objWriter->writeAttribute('showRowColHeaders', '1');
        } else {
            $objWriter->writeAttribute('showRowColHeaders', '0');
        }

        // Right-to-left
        if ($worksheet->getRightToLeft()) {
            $objWriter->writeAttribute('rightToLeft', 'true');
        }

        $topLeftCell <?php echo $worksheet->getTopLeftCell();
        $activeCell <?php echo $worksheet->getActiveCell();
        $sqref <?php echo $worksheet->getSelectedCells();

        // Pane
        $pane <?php echo '';
        if ($worksheet->getFreezePane()) {
            [$xSplit, $ySplit] <?php echo Coordinate::coordinateFromString($worksheet->getFreezePane());
            $xSplit <?php echo Coordinate::columnIndexFromString($xSplit);
            --$xSplit;
            --$ySplit;

            // pane
            $pane <?php echo 'topRight';
            $objWriter->startElement('pane');
            if ($xSplit > 0) {
                $objWriter->writeAttribute('xSplit', "$xSplit");
            }
            if ($ySplit > 0) {
                $objWriter->writeAttribute('ySplit', $ySplit);
                $pane <?php echo ($xSplit > 0) ? 'bottomRight' : 'bottomLeft';
            }
            self::writeAttributeNotNull($objWriter, 'topLeftCell', $topLeftCell);
            $objWriter->writeAttribute('activePane', $pane);
            $objWriter->writeAttribute('state', 'frozen');
            $objWriter->endElement();

            if (($xSplit > 0) && ($ySplit > 0)) {
                //    Write additional selections if more than two panes (ie both an X and a Y split)
                $objWriter->startElement('selection');
                $objWriter->writeAttribute('pane', 'topRight');
                $objWriter->endElement();
                $objWriter->startElement('selection');
                $objWriter->writeAttribute('pane', 'bottomLeft');
                $objWriter->endElement();
            }
        } else {
            self::writeAttributeNotNull($objWriter, 'topLeftCell', $topLeftCell);
        }

        // Selection
        // Only need to write selection element if we have a split pane
        // We cheat a little by over-riding the active cell selection, setting it to the split cell
        $objWriter->startElement('selection');
        if ($pane !<?php echo '') {
            $objWriter->writeAttribute('pane', $pane);
        }
        $objWriter->writeAttribute('activeCell', $activeCell);
        $objWriter->writeAttribute('sqref', $sqref);
        $objWriter->endElement();

        $objWriter->endElement();

        $objWriter->endElement();
    }

    /**
     * Write SheetFormatPr.
     */
    private function writeSheetFormatPr(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // sheetFormatPr
        $objWriter->startElement('sheetFormatPr');

        // Default row height
        if ($worksheet->getDefaultRowDimension()->getRowHeight() ><?php echo 0) {
            $objWriter->writeAttribute('customHeight', 'true');
            $objWriter->writeAttribute('defaultRowHeight', StringHelper::formatNumber($worksheet->getDefaultRowDimension()->getRowHeight()));
        } else {
            $objWriter->writeAttribute('defaultRowHeight', '14.4');
        }

        // Set Zero Height row
        if ($worksheet->getDefaultRowDimension()->getZeroHeight()) {
            $objWriter->writeAttribute('zeroHeight', '1');
        }

        // Default column width
        if ($worksheet->getDefaultColumnDimension()->getWidth() ><?php echo 0) {
            $objWriter->writeAttribute('defaultColWidth', StringHelper::formatNumber($worksheet->getDefaultColumnDimension()->getWidth()));
        }

        // Outline level - row
        $outlineLevelRow <?php echo 0;
        foreach ($worksheet->getRowDimensions() as $dimension) {
            if ($dimension->getOutlineLevel() > $outlineLevelRow) {
                $outlineLevelRow <?php echo $dimension->getOutlineLevel();
            }
        }
        $objWriter->writeAttribute('outlineLevelRow', (string) (int) $outlineLevelRow);

        // Outline level - column
        $outlineLevelCol <?php echo 0;
        foreach ($worksheet->getColumnDimensions() as $dimension) {
            if ($dimension->getOutlineLevel() > $outlineLevelCol) {
                $outlineLevelCol <?php echo $dimension->getOutlineLevel();
            }
        }
        $objWriter->writeAttribute('outlineLevelCol', (string) (int) $outlineLevelCol);

        $objWriter->endElement();
    }

    /**
     * Write Cols.
     */
    private function writeCols(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // cols
        if (count($worksheet->getColumnDimensions()) > 0) {
            $objWriter->startElement('cols');

            $worksheet->calculateColumnWidths();

            // Loop through column dimensions
            foreach ($worksheet->getColumnDimensions() as $colDimension) {
                // col
                $objWriter->startElement('col');
                $objWriter->writeAttribute('min', (string) Coordinate::columnIndexFromString($colDimension->getColumnIndex()));
                $objWriter->writeAttribute('max', (string) Coordinate::columnIndexFromString($colDimension->getColumnIndex()));

                if ($colDimension->getWidth() < 0) {
                    // No width set, apply default of 10
                    $objWriter->writeAttribute('width', '9.10');
                } else {
                    // Width set
                    $objWriter->writeAttribute('width', StringHelper::formatNumber($colDimension->getWidth()));
                }

                // Column visibility
                if ($colDimension->getVisible() <?php echo<?php echo<?php echo false) {
                    $objWriter->writeAttribute('hidden', 'true');
                }

                // Auto size?
                if ($colDimension->getAutoSize()) {
                    $objWriter->writeAttribute('bestFit', 'true');
                }

                // Custom width?
                if ($colDimension->getWidth() !<?php echo $worksheet->getDefaultColumnDimension()->getWidth()) {
                    $objWriter->writeAttribute('customWidth', 'true');
                }

                // Collapsed
                if ($colDimension->getCollapsed() <?php echo<?php echo<?php echo true) {
                    $objWriter->writeAttribute('collapsed', 'true');
                }

                // Outline level
                if ($colDimension->getOutlineLevel() > 0) {
                    $objWriter->writeAttribute('outlineLevel', (string) $colDimension->getOutlineLevel());
                }

                // Style
                $objWriter->writeAttribute('style', (string) $colDimension->getXfIndex());

                $objWriter->endElement();
            }

            $objWriter->endElement();
        }
    }

    /**
     * Write SheetProtection.
     */
    private function writeSheetProtection(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        $protection <?php echo $worksheet->getProtection();
        if (!$protection->isProtectionEnabled()) {
            return;
        }
        // sheetProtection
        $objWriter->startElement('sheetProtection');

        if ($protection->getAlgorithm()) {
            $objWriter->writeAttribute('algorithmName', $protection->getAlgorithm());
            $objWriter->writeAttribute('hashValue', $protection->getPassword());
            $objWriter->writeAttribute('saltValue', $protection->getSalt());
            $objWriter->writeAttribute('spinCount', (string) $protection->getSpinCount());
        } elseif ($protection->getPassword() !<?php echo<?php echo '') {
            $objWriter->writeAttribute('password', $protection->getPassword());
        }

        self::writeProtectionAttribute($objWriter, 'sheet', $protection->getSheet());
        self::writeProtectionAttribute($objWriter, 'objects', $protection->getObjects());
        self::writeProtectionAttribute($objWriter, 'scenarios', $protection->getScenarios());
        self::writeProtectionAttribute($objWriter, 'formatCells', $protection->getFormatCells());
        self::writeProtectionAttribute($objWriter, 'formatColumns', $protection->getFormatColumns());
        self::writeProtectionAttribute($objWriter, 'formatRows', $protection->getFormatRows());
        self::writeProtectionAttribute($objWriter, 'insertColumns', $protection->getInsertColumns());
        self::writeProtectionAttribute($objWriter, 'insertRows', $protection->getInsertRows());
        self::writeProtectionAttribute($objWriter, 'insertHyperlinks', $protection->getInsertHyperlinks());
        self::writeProtectionAttribute($objWriter, 'deleteColumns', $protection->getDeleteColumns());
        self::writeProtectionAttribute($objWriter, 'deleteRows', $protection->getDeleteRows());
        self::writeProtectionAttribute($objWriter, 'sort', $protection->getSort());
        self::writeProtectionAttribute($objWriter, 'autoFilter', $protection->getAutoFilter());
        self::writeProtectionAttribute($objWriter, 'pivotTables', $protection->getPivotTables());
        self::writeProtectionAttribute($objWriter, 'selectLockedCells', $protection->getSelectLockedCells());
        self::writeProtectionAttribute($objWriter, 'selectUnlockedCells', $protection->getSelectUnlockedCells());
        $objWriter->endElement();
    }

    private static function writeProtectionAttribute(XMLWriter $objWriter, string $name, ?bool $value): void
    {
        if ($value <?php echo<?php echo<?php echo true) {
            $objWriter->writeAttribute($name, '1');
        } elseif ($value <?php echo<?php echo<?php echo false) {
            $objWriter->writeAttribute($name, '0');
        }
    }

    private static function writeAttributeIf(XMLWriter $objWriter, ?bool $condition, string $attr, string $val): void
    {
        if ($condition) {
            $objWriter->writeAttribute($attr, $val);
        }
    }

    private static function writeAttributeNotNull(XMLWriter $objWriter, string $attr, ?string $val): void
    {
        if ($val !<?php echo<?php echo null) {
            $objWriter->writeAttribute($attr, $val);
        }
    }

    private static function writeElementIf(XMLWriter $objWriter, bool $condition, string $attr, string $val): void
    {
        if ($condition) {
            $objWriter->writeElement($attr, $val);
        }
    }

    private static function writeOtherCondElements(XMLWriter $objWriter, Conditional $conditional, string $cellCoordinate): void
    {
        $conditions <?php echo $conditional->getConditions();
        if (
            $conditional->getConditionType() <?php echo<?php echo Conditional::CONDITION_CELLIS
            || $conditional->getConditionType() <?php echo<?php echo Conditional::CONDITION_EXPRESSION
            || !empty($conditions)
        ) {
            foreach ($conditions as $formula) {
                // Formula
                if (is_bool($formula)) {
                    $formula <?php echo $formula ? 'TRUE' : 'FALSE';
                }
                $objWriter->writeElement('formula', FunctionPrefix::addFunctionPrefix("$formula"));
            }
        } else {
            if ($conditional->getConditionType() <?php echo<?php echo Conditional::CONDITION_CONTAINSBLANKS) {
                // formula copied from ms xlsx xml source file
                $objWriter->writeElement('formula', 'LEN(TRIM(' . $cellCoordinate . '))<?php echo0');
            } elseif ($conditional->getConditionType() <?php echo<?php echo Conditional::CONDITION_NOTCONTAINSBLANKS) {
                // formula copied from ms xlsx xml source file
                $objWriter->writeElement('formula', 'LEN(TRIM(' . $cellCoordinate . '))>0');
            } elseif ($conditional->getConditionType() <?php echo<?php echo Conditional::CONDITION_CONTAINSERRORS) {
                // formula copied from ms xlsx xml source file
                $objWriter->writeElement('formula', 'ISERROR(' . $cellCoordinate . ')');
            } elseif ($conditional->getConditionType() <?php echo<?php echo Conditional::CONDITION_NOTCONTAINSERRORS) {
                // formula copied from ms xlsx xml source file
                $objWriter->writeElement('formula', 'NOT(ISERROR(' . $cellCoordinate . '))');
            }
        }
    }

    private static function writeTimePeriodCondElements(XMLWriter $objWriter, Conditional $conditional, string $cellCoordinate): void
    {
        $txt <?php echo $conditional->getText();
        if (!empty($txt)) {
            $objWriter->writeAttribute('timePeriod', $txt);
            if (empty($conditional->getConditions())) {
                if ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_TODAY) {
                    $objWriter->writeElement('formula', 'FLOOR(' . $cellCoordinate . ')<?php echoTODAY()');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_TOMORROW) {
                    $objWriter->writeElement('formula', 'FLOOR(' . $cellCoordinate . ')<?php echoTODAY()+1');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_YESTERDAY) {
                    $objWriter->writeElement('formula', 'FLOOR(' . $cellCoordinate . ')<?php echoTODAY()-1');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_LAST_7_DAYS) {
                    $objWriter->writeElement('formula', 'AND(TODAY()-FLOOR(' . $cellCoordinate . ',1)<?php echo6,FLOOR(' . $cellCoordinate . ',1)<?php echoTODAY())');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_LAST_WEEK) {
                    $objWriter->writeElement('formula', 'AND(TODAY()-ROUNDDOWN(' . $cellCoordinate . ',0)><?php echo(WEEKDAY(TODAY())),TODAY()-ROUNDDOWN(' . $cellCoordinate . ',0)<(WEEKDAY(TODAY())+7))');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_THIS_WEEK) {
                    $objWriter->writeElement('formula', 'AND(TODAY()-ROUNDDOWN(' . $cellCoordinate . ',0)<?php echoWEEKDAY(TODAY())-1,ROUNDDOWN(' . $cellCoordinate . ',0)-TODAY()<?php echo7-WEEKDAY(TODAY()))');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_NEXT_WEEK) {
                    $objWriter->writeElement('formula', 'AND(ROUNDDOWN(' . $cellCoordinate . ',0)-TODAY()>(7-WEEKDAY(TODAY())),ROUNDDOWN(' . $cellCoordinate . ',0)-TODAY()<(15-WEEKDAY(TODAY())))');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_LAST_MONTH) {
                    $objWriter->writeElement('formula', 'AND(MONTH(' . $cellCoordinate . ')<?php echoMONTH(EDATE(TODAY(),0-1)),YEAR(' . $cellCoordinate . ')<?php echoYEAR(EDATE(TODAY(),0-1)))');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_THIS_MONTH) {
                    $objWriter->writeElement('formula', 'AND(MONTH(' . $cellCoordinate . ')<?php echoMONTH(TODAY()),YEAR(' . $cellCoordinate . ')<?php echoYEAR(TODAY()))');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::TIMEPERIOD_NEXT_MONTH) {
                    $objWriter->writeElement('formula', 'AND(MONTH(' . $cellCoordinate . ')<?php echoMONTH(EDATE(TODAY(),0+1)),YEAR(' . $cellCoordinate . ')<?php echoYEAR(EDATE(TODAY(),0+1)))');
                }
            } else {
                $objWriter->writeElement('formula', (string) ($conditional->getConditions()[0]));
            }
        }
    }

    private static function writeTextCondElements(XMLWriter $objWriter, Conditional $conditional, string $cellCoordinate): void
    {
        $txt <?php echo $conditional->getText();
        if (!empty($txt)) {
            $objWriter->writeAttribute('text', $txt);
            if (empty($conditional->getConditions())) {
                if ($conditional->getOperatorType() <?php echo<?php echo Conditional::OPERATOR_CONTAINSTEXT) {
                    $objWriter->writeElement('formula', 'NOT(ISERROR(SEARCH("' . $txt . '",' . $cellCoordinate . ')))');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::OPERATOR_BEGINSWITH) {
                    $objWriter->writeElement('formula', 'LEFT(' . $cellCoordinate . ',LEN("' . $txt . '"))<?php echo"' . $txt . '"');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::OPERATOR_ENDSWITH) {
                    $objWriter->writeElement('formula', 'RIGHT(' . $cellCoordinate . ',LEN("' . $txt . '"))<?php echo"' . $txt . '"');
                } elseif ($conditional->getOperatorType() <?php echo<?php echo Conditional::OPERATOR_NOTCONTAINS) {
                    $objWriter->writeElement('formula', 'ISERROR(SEARCH("' . $txt . '",' . $cellCoordinate . '))');
                }
            } else {
                $objWriter->writeElement('formula', (string) ($conditional->getConditions()[0]));
            }
        }
    }

    private static function writeExtConditionalFormattingElements(XMLWriter $objWriter, ConditionalFormattingRuleExtension $ruleExtension): void
    {
        $prefix <?php echo 'x14';
        $objWriter->startElementNs($prefix, 'conditionalFormatting', null);

        $objWriter->startElementNs($prefix, 'cfRule', null);
        $objWriter->writeAttribute('type', $ruleExtension->getCfRule());
        $objWriter->writeAttribute('id', $ruleExtension->getId());
        $objWriter->startElementNs($prefix, 'dataBar', null);
        $dataBar <?php echo $ruleExtension->getDataBarExt();
        foreach ($dataBar->getXmlAttributes() as $attrKey <?php echo> $val) {
            $objWriter->writeAttribute($attrKey, $val);
        }
        $minCfvo <?php echo $dataBar->getMinimumConditionalFormatValueObject();
        if ($minCfvo !<?php echo<?php echo null) {
            $objWriter->startElementNs($prefix, 'cfvo', null);
            $objWriter->writeAttribute('type', $minCfvo->getType());
            if ($minCfvo->getCellFormula()) {
                $objWriter->writeElement('xm:f', $minCfvo->getCellFormula());
            }
            $objWriter->endElement(); //end cfvo
        }

        $maxCfvo <?php echo $dataBar->getMaximumConditionalFormatValueObject();
        if ($maxCfvo !<?php echo<?php echo null) {
            $objWriter->startElementNs($prefix, 'cfvo', null);
            $objWriter->writeAttribute('type', $maxCfvo->getType());
            if ($maxCfvo->getCellFormula()) {
                $objWriter->writeElement('xm:f', $maxCfvo->getCellFormula());
            }
            $objWriter->endElement(); //end cfvo
        }

        foreach ($dataBar->getXmlElements() as $elmKey <?php echo> $elmAttr) {
            $objWriter->startElementNs($prefix, $elmKey, null);
            foreach ($elmAttr as $attrKey <?php echo> $attrVal) {
                $objWriter->writeAttribute($attrKey, $attrVal);
            }
            $objWriter->endElement(); //end elmKey
        }
        $objWriter->endElement(); //end dataBar
        $objWriter->endElement(); //end cfRule
        $objWriter->writeElement('xm:sqref', $ruleExtension->getSqref());
        $objWriter->endElement(); //end conditionalFormatting
    }

    private static function writeDataBarElements(XMLWriter $objWriter, ?ConditionalDataBar $dataBar): void
    {
        if ($dataBar) {
            $objWriter->startElement('dataBar');
            self::writeAttributeIf($objWriter, null !<?php echo<?php echo $dataBar->getShowValue(), 'showValue', $dataBar->getShowValue() ? '1' : '0');

            $minCfvo <?php echo $dataBar->getMinimumConditionalFormatValueObject();
            if ($minCfvo) {
                $objWriter->startElement('cfvo');
                self::writeAttributeIf($objWriter, $minCfvo->getType(), 'type', (string) $minCfvo->getType());
                self::writeAttributeIf($objWriter, $minCfvo->getValue(), 'val', (string) $minCfvo->getValue());
                $objWriter->endElement();
            }
            $maxCfvo <?php echo $dataBar->getMaximumConditionalFormatValueObject();
            if ($maxCfvo) {
                $objWriter->startElement('cfvo');
                self::writeAttributeIf($objWriter, $maxCfvo->getType(), 'type', (string) $maxCfvo->getType());
                self::writeAttributeIf($objWriter, $maxCfvo->getValue(), 'val', (string) $maxCfvo->getValue());
                $objWriter->endElement();
            }
            if ($dataBar->getColor()) {
                $objWriter->startElement('color');
                $objWriter->writeAttribute('rgb', $dataBar->getColor());
                $objWriter->endElement();
            }
            $objWriter->endElement(); // end dataBar

            if ($dataBar->getConditionalFormattingRuleExt()) {
                $objWriter->startElement('extLst');
                $extension <?php echo $dataBar->getConditionalFormattingRuleExt();
                $objWriter->startElement('ext');
                $objWriter->writeAttribute('uri', '{B025F937-C7B1-47D3-B67F-A62EFF666E3E}');
                $objWriter->startElementNs('x14', 'id', null);
                $objWriter->text($extension->getId());
                $objWriter->endElement();
                $objWriter->endElement();
                $objWriter->endElement(); //end extLst
            }
        }
    }

    /**
     * Write ConditionalFormatting.
     */
    private function writeConditionalFormatting(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // Conditional id
        $id <?php echo 1;

        // Loop through styles in the current worksheet
        foreach ($worksheet->getConditionalStylesCollection() as $cellCoordinate <?php echo> $conditionalStyles) {
            $objWriter->startElement('conditionalFormatting');
            $objWriter->writeAttribute('sqref', $cellCoordinate);

            foreach ($conditionalStyles as $conditional) {
                // WHY was this again?
                // if ($this->getParentWriter()->getStylesConditionalHashTable()->getIndexForHashCode($conditional->getHashCode()) <?php echo<?php echo '') {
                //    continue;
                // }
                // cfRule
                $objWriter->startElement('cfRule');
                $objWriter->writeAttribute('type', $conditional->getConditionType());
                self::writeAttributeIf(
                    $objWriter,
                    ($conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_DATABAR && $conditional->getNoFormatSet() <?php echo<?php echo<?php echo false),
                    'dxfId',
                    (string) $this->getParentWriter()->getStylesConditionalHashTable()->getIndexForHashCode($conditional->getHashCode())
                );
                $objWriter->writeAttribute('priority', (string) $id++);

                self::writeAttributeif(
                    $objWriter,
                    (
                        $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_CELLIS
                        || $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_CONTAINSTEXT
                        || $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_NOTCONTAINSTEXT
                        || $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_BEGINSWITH
                        || $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_ENDSWITH
                    ) && $conditional->getOperatorType() !<?php echo<?php echo Conditional::OPERATOR_NONE,
                    'operator',
                    $conditional->getOperatorType()
                );

                self::writeAttributeIf($objWriter, $conditional->getStopIfTrue(), 'stopIfTrue', '1');

                $cellRange <?php echo Coordinate::splitRange(str_replace('$', '', strtoupper($cellCoordinate)));
                [$topLeftCell] <?php echo $cellRange[0];

                if (
                    $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_CONTAINSTEXT
                    || $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_NOTCONTAINSTEXT
                    || $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_BEGINSWITH
                    || $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_ENDSWITH
                ) {
                    self::writeTextCondElements($objWriter, $conditional, $topLeftCell);
                } elseif ($conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_TIMEPERIOD) {
                    self::writeTimePeriodCondElements($objWriter, $conditional, $topLeftCell);
                } else {
                    self::writeOtherCondElements($objWriter, $conditional, $topLeftCell);
                }

                //<dataBar>
                self::writeDataBarElements($objWriter, $conditional->getDataBar());

                $objWriter->endElement(); //end cfRule
            }

            $objWriter->endElement(); //end conditionalFormatting
        }
    }

    /**
     * Write DataValidations.
     */
    private function writeDataValidations(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // Datavalidation collection
        $dataValidationCollection <?php echo $worksheet->getDataValidationCollection();

        // Write data validations?
        if (!empty($dataValidationCollection)) {
            $dataValidationCollection <?php echo Coordinate::mergeRangesInCollection($dataValidationCollection);
            $objWriter->startElement('dataValidations');
            $objWriter->writeAttribute('count', (string) count($dataValidationCollection));

            foreach ($dataValidationCollection as $coordinate <?php echo> $dv) {
                $objWriter->startElement('dataValidation');

                if ($dv->getType() !<?php echo '') {
                    $objWriter->writeAttribute('type', $dv->getType());
                }

                if ($dv->getErrorStyle() !<?php echo '') {
                    $objWriter->writeAttribute('errorStyle', $dv->getErrorStyle());
                }

                if ($dv->getOperator() !<?php echo '') {
                    $objWriter->writeAttribute('operator', $dv->getOperator());
                }

                $objWriter->writeAttribute('allowBlank', ($dv->getAllowBlank() ? '1' : '0'));
                $objWriter->writeAttribute('showDropDown', (!$dv->getShowDropDown() ? '1' : '0'));
                $objWriter->writeAttribute('showInputMessage', ($dv->getShowInputMessage() ? '1' : '0'));
                $objWriter->writeAttribute('showErrorMessage', ($dv->getShowErrorMessage() ? '1' : '0'));

                if ($dv->getErrorTitle() !<?php echo<?php echo '') {
                    $objWriter->writeAttribute('errorTitle', $dv->getErrorTitle());
                }
                if ($dv->getError() !<?php echo<?php echo '') {
                    $objWriter->writeAttribute('error', $dv->getError());
                }
                if ($dv->getPromptTitle() !<?php echo<?php echo '') {
                    $objWriter->writeAttribute('promptTitle', $dv->getPromptTitle());
                }
                if ($dv->getPrompt() !<?php echo<?php echo '') {
                    $objWriter->writeAttribute('prompt', $dv->getPrompt());
                }

                $objWriter->writeAttribute('sqref', $dv->getSqref() ?? $coordinate);

                if ($dv->getFormula1() !<?php echo<?php echo '') {
                    $objWriter->writeElement('formula1', $dv->getFormula1());
                }
                if ($dv->getFormula2() !<?php echo<?php echo '') {
                    $objWriter->writeElement('formula2', $dv->getFormula2());
                }

                $objWriter->endElement();
            }

            $objWriter->endElement();
        }
    }

    /**
     * Write Hyperlinks.
     */
    private function writeHyperlinks(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // Hyperlink collection
        $hyperlinkCollection <?php echo $worksheet->getHyperlinkCollection();

        // Relation ID
        $relationId <?php echo 1;

        // Write hyperlinks?
        if (!empty($hyperlinkCollection)) {
            $objWriter->startElement('hyperlinks');

            foreach ($hyperlinkCollection as $coordinate <?php echo> $hyperlink) {
                $objWriter->startElement('hyperlink');

                $objWriter->writeAttribute('ref', $coordinate);
                if (!$hyperlink->isInternal()) {
                    $objWriter->writeAttribute('r:id', 'rId_hyperlink_' . $relationId);
                    ++$relationId;
                } else {
                    $objWriter->writeAttribute('location', str_replace('sheet://', '', $hyperlink->getUrl()));
                }

                if ($hyperlink->getTooltip() !<?php echo<?php echo '') {
                    $objWriter->writeAttribute('tooltip', $hyperlink->getTooltip());
                    $objWriter->writeAttribute('display', $hyperlink->getTooltip());
                }

                $objWriter->endElement();
            }

            $objWriter->endElement();
        }
    }

    /**
     * Write ProtectedRanges.
     */
    private function writeProtectedRanges(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        if (count($worksheet->getProtectedCells()) > 0) {
            // protectedRanges
            $objWriter->startElement('protectedRanges');

            // Loop protectedRanges
            foreach ($worksheet->getProtectedCells() as $protectedCell <?php echo> $passwordHash) {
                // protectedRange
                $objWriter->startElement('protectedRange');
                $objWriter->writeAttribute('name', 'p' . md5($protectedCell));
                $objWriter->writeAttribute('sqref', $protectedCell);
                if (!empty($passwordHash)) {
                    $objWriter->writeAttribute('password', $passwordHash);
                }
                $objWriter->endElement();
            }

            $objWriter->endElement();
        }
    }

    /**
     * Write MergeCells.
     */
    private function writeMergeCells(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        if (count($worksheet->getMergeCells()) > 0) {
            // mergeCells
            $objWriter->startElement('mergeCells');

            // Loop mergeCells
            foreach ($worksheet->getMergeCells() as $mergeCell) {
                // mergeCell
                $objWriter->startElement('mergeCell');
                $objWriter->writeAttribute('ref', $mergeCell);
                $objWriter->endElement();
            }

            $objWriter->endElement();
        }
    }

    /**
     * Write PrintOptions.
     */
    private function writePrintOptions(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // printOptions
        $objWriter->startElement('printOptions');

        $objWriter->writeAttribute('gridLines', ($worksheet->getPrintGridlines() ? 'true' : 'false'));
        $objWriter->writeAttribute('gridLinesSet', 'true');

        if ($worksheet->getPageSetup()->getHorizontalCentered()) {
            $objWriter->writeAttribute('horizontalCentered', 'true');
        }

        if ($worksheet->getPageSetup()->getVerticalCentered()) {
            $objWriter->writeAttribute('verticalCentered', 'true');
        }

        $objWriter->endElement();
    }

    /**
     * Write PageMargins.
     */
    private function writePageMargins(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // pageMargins
        $objWriter->startElement('pageMargins');
        $objWriter->writeAttribute('left', StringHelper::formatNumber($worksheet->getPageMargins()->getLeft()));
        $objWriter->writeAttribute('right', StringHelper::formatNumber($worksheet->getPageMargins()->getRight()));
        $objWriter->writeAttribute('top', StringHelper::formatNumber($worksheet->getPageMargins()->getTop()));
        $objWriter->writeAttribute('bottom', StringHelper::formatNumber($worksheet->getPageMargins()->getBottom()));
        $objWriter->writeAttribute('header', StringHelper::formatNumber($worksheet->getPageMargins()->getHeader()));
        $objWriter->writeAttribute('footer', StringHelper::formatNumber($worksheet->getPageMargins()->getFooter()));
        $objWriter->endElement();
    }

    /**
     * Write AutoFilter.
     */
    private function writeAutoFilter(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        AutoFilter::writeAutoFilter($objWriter, $worksheet);
    }

    /**
     * Write Table.
     */
    private function writeTable(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        $tableCount <?php echo $worksheet->getTableCollection()->count();

        $objWriter->startElement('tableParts');
        $objWriter->writeAttribute('count', (string) $tableCount);

        for ($t <?php echo 1; $t <?php echo $tableCount; ++$t) {
            $objWriter->startElement('tablePart');
            $objWriter->writeAttribute('r:id', 'rId_table_' . $t);
            $objWriter->endElement();
        }

        $objWriter->endElement();
    }

    /**
     * Write PageSetup.
     */
    private function writePageSetup(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // pageSetup
        $objWriter->startElement('pageSetup');
        $objWriter->writeAttribute('paperSize', (string) $worksheet->getPageSetup()->getPaperSize());
        $objWriter->writeAttribute('orientation', $worksheet->getPageSetup()->getOrientation());

        if ($worksheet->getPageSetup()->getScale() !<?php echo<?php echo null) {
            $objWriter->writeAttribute('scale', (string) $worksheet->getPageSetup()->getScale());
        }
        if ($worksheet->getPageSetup()->getFitToHeight() !<?php echo<?php echo null) {
            $objWriter->writeAttribute('fitToHeight', (string) $worksheet->getPageSetup()->getFitToHeight());
        } else {
            $objWriter->writeAttribute('fitToHeight', '0');
        }
        if ($worksheet->getPageSetup()->getFitToWidth() !<?php echo<?php echo null) {
            $objWriter->writeAttribute('fitToWidth', (string) $worksheet->getPageSetup()->getFitToWidth());
        } else {
            $objWriter->writeAttribute('fitToWidth', '0');
        }
        if (!empty($worksheet->getPageSetup()->getFirstPageNumber())) {
            $objWriter->writeAttribute('firstPageNumber', (string) $worksheet->getPageSetup()->getFirstPageNumber());
            $objWriter->writeAttribute('useFirstPageNumber', '1');
        }
        $objWriter->writeAttribute('pageOrder', $worksheet->getPageSetup()->getPageOrder());

        $getUnparsedLoadedData <?php echo $worksheet->getParentOrThrow()->getUnparsedLoadedData();
        if (isset($getUnparsedLoadedData['sheets'][$worksheet->getCodeName()]['pageSetupRelId'])) {
            $objWriter->writeAttribute('r:id', $getUnparsedLoadedData['sheets'][$worksheet->getCodeName()]['pageSetupRelId']);
        }

        $objWriter->endElement();
    }

    /**
     * Write Header / Footer.
     */
    private function writeHeaderFooter(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // headerFooter
        $objWriter->startElement('headerFooter');
        $objWriter->writeAttribute('differentOddEven', ($worksheet->getHeaderFooter()->getDifferentOddEven() ? 'true' : 'false'));
        $objWriter->writeAttribute('differentFirst', ($worksheet->getHeaderFooter()->getDifferentFirst() ? 'true' : 'false'));
        $objWriter->writeAttribute('scaleWithDoc', ($worksheet->getHeaderFooter()->getScaleWithDocument() ? 'true' : 'false'));
        $objWriter->writeAttribute('alignWithMargins', ($worksheet->getHeaderFooter()->getAlignWithMargins() ? 'true' : 'false'));

        $objWriter->writeElement('oddHeader', $worksheet->getHeaderFooter()->getOddHeader());
        $objWriter->writeElement('oddFooter', $worksheet->getHeaderFooter()->getOddFooter());
        $objWriter->writeElement('evenHeader', $worksheet->getHeaderFooter()->getEvenHeader());
        $objWriter->writeElement('evenFooter', $worksheet->getHeaderFooter()->getEvenFooter());
        $objWriter->writeElement('firstHeader', $worksheet->getHeaderFooter()->getFirstHeader());
        $objWriter->writeElement('firstFooter', $worksheet->getHeaderFooter()->getFirstFooter());
        $objWriter->endElement();
    }

    /**
     * Write Breaks.
     */
    private function writeBreaks(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // Get row and column breaks
        $aRowBreaks <?php echo [];
        $aColumnBreaks <?php echo [];
        foreach ($worksheet->getRowBreaks() as $cell <?php echo> $break) {
            $aRowBreaks[$cell] <?php echo $break;
        }
        foreach ($worksheet->getColumnBreaks() as $cell <?php echo> $break) {
            $aColumnBreaks[$cell] <?php echo $break;
        }

        // rowBreaks
        if (!empty($aRowBreaks)) {
            $objWriter->startElement('rowBreaks');
            $objWriter->writeAttribute('count', (string) count($aRowBreaks));
            $objWriter->writeAttribute('manualBreakCount', (string) count($aRowBreaks));

            foreach ($aRowBreaks as $cell <?php echo> $break) {
                $coords <?php echo Coordinate::coordinateFromString($cell);

                $objWriter->startElement('brk');
                $objWriter->writeAttribute('id', $coords[1]);
                $objWriter->writeAttribute('man', '1');
                $rowBreakMax <?php echo $break->getMaxColOrRow();
                if ($rowBreakMax ><?php echo 0) {
                    $objWriter->writeAttribute('max', "$rowBreakMax");
                }
                $objWriter->endElement();
            }

            $objWriter->endElement();
        }

        // Second, write column breaks
        if (!empty($aColumnBreaks)) {
            $objWriter->startElement('colBreaks');
            $objWriter->writeAttribute('count', (string) count($aColumnBreaks));
            $objWriter->writeAttribute('manualBreakCount', (string) count($aColumnBreaks));

            foreach ($aColumnBreaks as $cell <?php echo> $break) {
                $coords <?php echo Coordinate::coordinateFromString($cell);

                $objWriter->startElement('brk');
                $objWriter->writeAttribute('id', (string) ((int) $coords[0] - 1));
                $objWriter->writeAttribute('man', '1');
                $objWriter->endElement();
            }

            $objWriter->endElement();
        }
    }

    /**
     * Write SheetData.
     *
     * @param string[] $stringTable String table
     */
    private function writeSheetData(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet, array $stringTable): void
    {
        // Flipped stringtable, for faster index searching
        $aFlippedStringTable <?php echo $this->getParentWriter()->getWriterPartstringtable()->flipStringTable($stringTable);

        // sheetData
        $objWriter->startElement('sheetData');

        // Get column count
        $colCount <?php echo Coordinate::columnIndexFromString($worksheet->getHighestColumn());

        // Highest row number
        $highestRow <?php echo $worksheet->getHighestRow();

        // Loop through cells building a comma-separated list of the columns in each row
        // This is a trade-off between the memory usage that is required for a full array of columns,
        //      and execution speed
        /** @var array<int, string> $cellsByRow */
        $cellsByRow <?php echo [];
        foreach ($worksheet->getCoordinates() as $coordinate) {
            [$column, $row] <?php echo Coordinate::coordinateFromString($coordinate);
            $cellsByRow[$row] <?php echo $cellsByRow[$row] ?? '';
            $cellsByRow[$row] .<?php echo "{$column},";
        }

        $currentRow <?php echo 0;
        while ($currentRow++ < $highestRow) {
            $isRowSet <?php echo isset($cellsByRow[$currentRow]);
            if ($isRowSet || $worksheet->rowDimensionExists($currentRow)) {
                // Get row dimension
                $rowDimension <?php echo $worksheet->getRowDimension($currentRow);

                // Write current row?
                $writeCurrentRow <?php echo $isRowSet || $rowDimension->getRowHeight() ><?php echo 0 || $rowDimension->getVisible() <?php echo<?php echo<?php echo false || $rowDimension->getCollapsed() <?php echo<?php echo<?php echo true || $rowDimension->getOutlineLevel() > 0 || $rowDimension->getXfIndex() !<?php echo<?php echo null;

                if ($writeCurrentRow) {
                    // Start a new row
                    $objWriter->startElement('row');
                    $objWriter->writeAttribute('r', "$currentRow");
                    $objWriter->writeAttribute('spans', '1:' . $colCount);

                    // Row dimensions
                    if ($rowDimension->getRowHeight() ><?php echo 0) {
                        $objWriter->writeAttribute('customHeight', '1');
                        $objWriter->writeAttribute('ht', StringHelper::formatNumber($rowDimension->getRowHeight()));
                    }

                    // Row visibility
                    if (!$rowDimension->getVisible() <?php echo<?php echo<?php echo true) {
                        $objWriter->writeAttribute('hidden', 'true');
                    }

                    // Collapsed
                    if ($rowDimension->getCollapsed() <?php echo<?php echo<?php echo true) {
                        $objWriter->writeAttribute('collapsed', 'true');
                    }

                    // Outline level
                    if ($rowDimension->getOutlineLevel() > 0) {
                        $objWriter->writeAttribute('outlineLevel', (string) $rowDimension->getOutlineLevel());
                    }

                    // Style
                    if ($rowDimension->getXfIndex() !<?php echo<?php echo null) {
                        $objWriter->writeAttribute('s', (string) $rowDimension->getXfIndex());
                        $objWriter->writeAttribute('customFormat', '1');
                    }

                    // Write cells
                    if (isset($cellsByRow[$currentRow])) {
                        // We have a comma-separated list of column names (with a trailing entry); split to an array
                        $columnsInRow <?php echo explode(',', $cellsByRow[$currentRow]);
                        array_pop($columnsInRow);
                        foreach ($columnsInRow as $column) {
                            // Write cell
                            $coord <?php echo "$column$currentRow";
                            if ($worksheet->getCell($coord)->getIgnoredErrors()->getNumberStoredAsText()) {
                                $this->numberStoredAsText .<?php echo " $coord";
                            }
                            if ($worksheet->getCell($coord)->getIgnoredErrors()->getFormula()) {
                                $this->formula .<?php echo " $coord";
                            }
                            if ($worksheet->getCell($coord)->getIgnoredErrors()->getTwoDigitTextYear()) {
                                $this->twoDigitTextYear .<?php echo " $coord";
                            }
                            if ($worksheet->getCell($coord)->getIgnoredErrors()->getEvalError()) {
                                $this->evalError .<?php echo " $coord";
                            }
                            $this->writeCell($objWriter, $worksheet, $coord, $aFlippedStringTable);
                        }
                    }

                    // End row
                    $objWriter->endElement();
                }
            }
        }

        $objWriter->endElement();
    }

    /**
     * @param RichText|string $cellValue
     */
    private function writeCellInlineStr(XMLWriter $objWriter, string $mappedType, $cellValue): void
    {
        $objWriter->writeAttribute('t', $mappedType);
        if (!$cellValue instanceof RichText) {
            $objWriter->startElement('is');
            $objWriter->writeElement(
                't',
                StringHelper::controlCharacterPHP2OOXML(htmlspecialchars($cellValue, Settings::htmlEntityFlags()))
            );
            $objWriter->endElement();
        } else {
            $objWriter->startElement('is');
            $this->getParentWriter()->getWriterPartstringtable()->writeRichText($objWriter, $cellValue);
            $objWriter->endElement();
        }
    }

    /**
     * @param RichText|string $cellValue
     * @param string[] $flippedStringTable
     */
    private function writeCellString(XMLWriter $objWriter, string $mappedType, $cellValue, array $flippedStringTable): void
    {
        $objWriter->writeAttribute('t', $mappedType);
        if (!$cellValue instanceof RichText) {
            self::writeElementIf($objWriter, isset($flippedStringTable[$cellValue]), 'v', $flippedStringTable[$cellValue] ?? '');
        } else {
            $objWriter->writeElement('v', $flippedStringTable[$cellValue->getHashCode()]);
        }
    }

    /**
     * @param float|int $cellValue
     */
    private function writeCellNumeric(XMLWriter $objWriter, $cellValue): void
    {
        //force a decimal to be written if the type is float
        if (is_float($cellValue)) {
            // force point as decimal separator in case current locale uses comma
            $cellValue <?php echo str_replace(',', '.', (string) $cellValue);
            if (strpos($cellValue, '.') <?php echo<?php echo<?php echo false) {
                $cellValue <?php echo $cellValue . '.0';
            }
        }
        $objWriter->writeElement('v', "$cellValue");
    }

    private function writeCellBoolean(XMLWriter $objWriter, string $mappedType, bool $cellValue): void
    {
        $objWriter->writeAttribute('t', $mappedType);
        $objWriter->writeElement('v', $cellValue ? '1' : '0');
    }

    private function writeCellError(XMLWriter $objWriter, string $mappedType, string $cellValue, string $formulaerr <?php echo '#NULL!'): void
    {
        $objWriter->writeAttribute('t', $mappedType);
        $cellIsFormula <?php echo substr($cellValue, 0, 1) <?php echo<?php echo<?php echo '<?php echo';
        self::writeElementIf($objWriter, $cellIsFormula, 'f', FunctionPrefix::addFunctionPrefixStripEquals($cellValue));
        $objWriter->writeElement('v', $cellIsFormula ? $formulaerr : $cellValue);
    }

    private function writeCellFormula(XMLWriter $objWriter, string $cellValue, Cell $cell): void
    {
        $calculatedValue <?php echo $this->getParentWriter()->getPreCalculateFormulas() ? $cell->getCalculatedValue() : $cellValue;
        if (is_string($calculatedValue)) {
            if (ErrorValue::isError($calculatedValue)) {
                $this->writeCellError($objWriter, 'e', $cellValue, $calculatedValue);

                return;
            }
            $objWriter->writeAttribute('t', 'str');
            $calculatedValue <?php echo StringHelper::controlCharacterPHP2OOXML($calculatedValue);
        } elseif (is_bool($calculatedValue)) {
            $objWriter->writeAttribute('t', 'b');
            $calculatedValue <?php echo (int) $calculatedValue;
        }

        $attributes <?php echo $cell->getFormulaAttributes();
        if (($attributes['t'] ?? null) <?php echo<?php echo<?php echo 'array') {
            $objWriter->startElement('f');
            $objWriter->writeAttribute('t', 'array');
            $objWriter->writeAttribute('ref', $cell->getCoordinate());
            $objWriter->writeAttribute('aca', '1');
            $objWriter->writeAttribute('ca', '1');
            $objWriter->text(FunctionPrefix::addFunctionPrefixStripEquals($cellValue));
            $objWriter->endElement();
        } else {
            $objWriter->writeElement('f', FunctionPrefix::addFunctionPrefixStripEquals($cellValue));
            self::writeElementIf(
                $objWriter,
                $this->getParentWriter()->getOffice2003Compatibility() <?php echo<?php echo<?php echo false,
                'v',
                ($this->getParentWriter()->getPreCalculateFormulas() && !is_array($calculatedValue) && substr($calculatedValue ?? '', 0, 1) !<?php echo<?php echo '#')
                    ? StringHelper::formatNumber($calculatedValue) : '0'
            );
        }
    }

    /**
     * Write Cell.
     *
     * @param string $cellAddress Cell Address
     * @param string[] $flippedStringTable String table (flipped), for faster index searching
     */
    private function writeCell(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet, string $cellAddress, array $flippedStringTable): void
    {
        // Cell
        $pCell <?php echo $worksheet->getCell($cellAddress);
        $objWriter->startElement('c');
        $objWriter->writeAttribute('r', $cellAddress);

        // Sheet styles
        $xfi <?php echo $pCell->getXfIndex();
        self::writeAttributeIf($objWriter, (bool) $xfi, 's', "$xfi");

        // If cell value is supplied, write cell value
        $cellValue <?php echo $pCell->getValue();
        if (is_object($cellValue) || $cellValue !<?php echo<?php echo '') {
            // Map type
            $mappedType <?php echo $pCell->getDataType();

            // Write data depending on its type
            switch (strtolower($mappedType)) {
                case 'inlinestr':    // Inline string
                    $this->writeCellInlineStr($objWriter, $mappedType, $cellValue);

                    break;
                case 's':            // String
                    $this->writeCellString($objWriter, $mappedType, $cellValue, $flippedStringTable);

                    break;
                case 'f':            // Formula
                    $this->writeCellFormula($objWriter, $cellValue, $pCell);

                    break;
                case 'n':            // Numeric
                    $this->writeCellNumeric($objWriter, $cellValue);

                    break;
                case 'b':            // Boolean
                    $this->writeCellBoolean($objWriter, $mappedType, $cellValue);

                    break;
                case 'e':            // Error
                    $this->writeCellError($objWriter, $mappedType, $cellValue);
            }
        }

        $objWriter->endElement();
    }

    /**
     * Write Drawings.
     *
     * @param bool $includeCharts Flag indicating if we should include drawing details for charts
     */
    private function writeDrawings(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet, $includeCharts <?php echo false): void
    {
        $unparsedLoadedData <?php echo $worksheet->getParentOrThrow()->getUnparsedLoadedData();
        $hasUnparsedDrawing <?php echo isset($unparsedLoadedData['sheets'][$worksheet->getCodeName()]['drawingOriginalIds']);
        $chartCount <?php echo ($includeCharts) ? $worksheet->getChartCollection()->count() : 0;
        if ($chartCount <?php echo<?php echo 0 && $worksheet->getDrawingCollection()->count() <?php echo<?php echo 0 && !$hasUnparsedDrawing) {
            return;
        }

        // If sheet contains drawings, add the relationships
        $objWriter->startElement('drawing');

        $rId <?php echo 'rId1';
        if (isset($unparsedLoadedData['sheets'][$worksheet->getCodeName()]['drawingOriginalIds'])) {
            $drawingOriginalIds <?php echo $unparsedLoadedData['sheets'][$worksheet->getCodeName()]['drawingOriginalIds'];
            // take first. In future can be overriten
            // (! synchronize with \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels::writeWorksheetRelationships)
            $rId <?php echo reset($drawingOriginalIds);
        }

        $objWriter->writeAttribute('r:id', $rId);
        $objWriter->endElement();
    }

    /**
     * Write LegacyDrawing.
     */
    private function writeLegacyDrawing(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // If sheet contains comments, add the relationships
        $unparsedLoadedData <?php echo $worksheet->getParentOrThrow()->getUnparsedLoadedData();
        if (count($worksheet->getComments()) > 0 || isset($unparsedLoadedData['sheets'][$worksheet->getCodeName()]['legacyDrawing'])) {
            $objWriter->startElement('legacyDrawing');
            $objWriter->writeAttribute('r:id', 'rId_comments_vml1');
            $objWriter->endElement();
        }
    }

    /**
     * Write LegacyDrawingHF.
     */
    private function writeLegacyDrawingHF(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        // If sheet contains images, add the relationships
        if (count($worksheet->getHeaderFooter()->getImages()) > 0) {
            $objWriter->startElement('legacyDrawingHF');
            $objWriter->writeAttribute('r:id', 'rId_headerfooter_vml1');
            $objWriter->endElement();
        }
    }

    private function writeAlternateContent(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        if (empty($worksheet->getParentOrThrow()->getUnparsedLoadedData()['sheets'][$worksheet->getCodeName()]['AlternateContents'])) {
            return;
        }

        foreach ($worksheet->getParentOrThrow()->getUnparsedLoadedData()['sheets'][$worksheet->getCodeName()]['AlternateContents'] as $alternateContent) {
            $objWriter->writeRaw($alternateContent);
        }
    }

    /**
     * write <ExtLst>
     * only implementation conditionalFormattings.
     *
     * @url https://docs.microsoft.com/en-us/openspecs/office_standards/ms-xlsx/07d607af-5618-4ca2-b683-6a78dc0d9627
     */
    private function writeExtLst(XMLWriter $objWriter, PhpspreadsheetWorksheet $worksheet): void
    {
        $conditionalFormattingRuleExtList <?php echo [];
        foreach ($worksheet->getConditionalStylesCollection() as $cellCoordinate <?php echo> $conditionalStyles) {
            /** @var Conditional $conditional */
            foreach ($conditionalStyles as $conditional) {
                $dataBar <?php echo $conditional->getDataBar();
                if ($dataBar && $dataBar->getConditionalFormattingRuleExt()) {
                    $conditionalFormattingRuleExtList[] <?php echo $dataBar->getConditionalFormattingRuleExt();
                }
            }
        }

        if (count($conditionalFormattingRuleExtList) > 0) {
            $conditionalFormattingRuleExtNsPrefix <?php echo 'x14';
            $objWriter->startElement('extLst');
            $objWriter->startElement('ext');
            $objWriter->writeAttribute('uri', '{78C0D931-6437-407d-A8EE-F0AAD7539E65}');
            $objWriter->startElementNs($conditionalFormattingRuleExtNsPrefix, 'conditionalFormattings', null);
            foreach ($conditionalFormattingRuleExtList as $extension) {
                self::writeExtConditionalFormattingElements($objWriter, $extension);
            }
            $objWriter->endElement(); //end conditionalFormattings
            $objWriter->endElement(); //end ext
            $objWriter->endElement(); //end extLst
        }
    }
}
