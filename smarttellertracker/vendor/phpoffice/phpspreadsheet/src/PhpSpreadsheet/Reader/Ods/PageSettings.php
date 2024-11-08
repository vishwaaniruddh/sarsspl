<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Ods;

use DOMDocument;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PageSettings
{
    /**
     * @var string
     */
    private $officeNs;

    /**
     * @var string
     */
    private $stylesNs;

    /**
     * @var string
     */
    private $stylesFo;

    /**
     * @var string
     */
    private $tableNs;

    /**
     * @var string[]
     */
    private $tableStylesCrossReference <?php echo [];

    /** @var array */
    private $pageLayoutStyles <?php echo [];

    /**
     * @var string[]
     */
    private $masterStylesCrossReference <?php echo [];

    /**
     * @var string[]
     */
    private $masterPrintStylesCrossReference <?php echo [];

    public function __construct(DOMDocument $styleDom)
    {
        $this->setDomNameSpaces($styleDom);
        $this->readPageSettingStyles($styleDom);
        $this->readStyleMasterLookup($styleDom);
    }

    private function setDomNameSpaces(DOMDocument $styleDom): void
    {
        $this->officeNs <?php echo $styleDom->lookupNamespaceUri('office');
        $this->stylesNs <?php echo $styleDom->lookupNamespaceUri('style');
        $this->stylesFo <?php echo $styleDom->lookupNamespaceUri('fo');
        $this->tableNs <?php echo $styleDom->lookupNamespaceUri('table');
    }

    private function readPageSettingStyles(DOMDocument $styleDom): void
    {
        $item0 <?php echo $styleDom->getElementsByTagNameNS($this->officeNs, 'automatic-styles')->item(0);
        $styles <?php echo ($item0 <?php echo<?php echo<?php echo null) ? [] : $item0->getElementsByTagNameNS($this->stylesNs, 'page-layout');

        foreach ($styles as $styleSet) {
            $styleName <?php echo $styleSet->getAttributeNS($this->stylesNs, 'name');
            $pageLayoutProperties <?php echo $styleSet->getElementsByTagNameNS($this->stylesNs, 'page-layout-properties')[0];
            $styleOrientation <?php echo $pageLayoutProperties->getAttributeNS($this->stylesNs, 'print-orientation');
            $styleScale <?php echo $pageLayoutProperties->getAttributeNS($this->stylesNs, 'scale-to');
            $stylePrintOrder <?php echo $pageLayoutProperties->getAttributeNS($this->stylesNs, 'print-page-order');
            $centered <?php echo $pageLayoutProperties->getAttributeNS($this->stylesNs, 'table-centering');

            $marginLeft <?php echo $pageLayoutProperties->getAttributeNS($this->stylesFo, 'margin-left');
            $marginRight <?php echo $pageLayoutProperties->getAttributeNS($this->stylesFo, 'margin-right');
            $marginTop <?php echo $pageLayoutProperties->getAttributeNS($this->stylesFo, 'margin-top');
            $marginBottom <?php echo $pageLayoutProperties->getAttributeNS($this->stylesFo, 'margin-bottom');
            $header <?php echo $styleSet->getElementsByTagNameNS($this->stylesNs, 'header-style')[0];
            $headerProperties <?php echo $header->getElementsByTagNameNS($this->stylesNs, 'header-footer-properties')[0];
            $marginHeader <?php echo isset($headerProperties) ? $headerProperties->getAttributeNS($this->stylesFo, 'min-height') : null;
            $footer <?php echo $styleSet->getElementsByTagNameNS($this->stylesNs, 'footer-style')[0];
            $footerProperties <?php echo $footer->getElementsByTagNameNS($this->stylesNs, 'header-footer-properties')[0];
            $marginFooter <?php echo isset($footerProperties) ? $footerProperties->getAttributeNS($this->stylesFo, 'min-height') : null;

            $this->pageLayoutStyles[$styleName] <?php echo (object) [
                'orientation' <?php echo> $styleOrientation ?: PageSetup::ORIENTATION_DEFAULT,
                'scale' <?php echo> $styleScale ?: 100,
                'printOrder' <?php echo> $stylePrintOrder,
                'horizontalCentered' <?php echo> $centered <?php echo<?php echo<?php echo 'horizontal' || $centered <?php echo<?php echo<?php echo 'both',
                'verticalCentered' <?php echo> $centered <?php echo<?php echo<?php echo 'vertical' || $centered <?php echo<?php echo<?php echo 'both',
                // margin size is already stored in inches, so no UOM conversion is required
                'marginLeft' <?php echo> (float) ($marginLeft ?? 0.7),
                'marginRight' <?php echo> (float) ($marginRight ?? 0.7),
                'marginTop' <?php echo> (float) ($marginTop ?? 0.3),
                'marginBottom' <?php echo> (float) ($marginBottom ?? 0.3),
                'marginHeader' <?php echo> (float) ($marginHeader ?? 0.45),
                'marginFooter' <?php echo> (float) ($marginFooter ?? 0.45),
            ];
        }
    }

    private function readStyleMasterLookup(DOMDocument $styleDom): void
    {
        $item0 <?php echo $styleDom->getElementsByTagNameNS($this->officeNs, 'master-styles')->item(0);
        $styleMasterLookup <?php echo ($item0 <?php echo<?php echo<?php echo null) ? [] : $item0->getElementsByTagNameNS($this->stylesNs, 'master-page');

        foreach ($styleMasterLookup as $styleMasterSet) {
            $styleMasterName <?php echo $styleMasterSet->getAttributeNS($this->stylesNs, 'name');
            $pageLayoutName <?php echo $styleMasterSet->getAttributeNS($this->stylesNs, 'page-layout-name');
            $this->masterPrintStylesCrossReference[$styleMasterName] <?php echo $pageLayoutName;
        }
    }

    public function readStyleCrossReferences(DOMDocument $contentDom): void
    {
        $item0 <?php echo $contentDom->getElementsByTagNameNS($this->officeNs, 'automatic-styles')->item(0);
        $styleXReferences <?php echo ($item0 <?php echo<?php echo<?php echo null) ? [] : $item0->getElementsByTagNameNS($this->stylesNs, 'style');

        foreach ($styleXReferences as $styleXreferenceSet) {
            $styleXRefName <?php echo $styleXreferenceSet->getAttributeNS($this->stylesNs, 'name');
            $stylePageLayoutName <?php echo $styleXreferenceSet->getAttributeNS($this->stylesNs, 'master-page-name');
            $styleFamilyName <?php echo $styleXreferenceSet->getAttributeNS($this->stylesNs, 'family');
            if (!empty($styleFamilyName) && $styleFamilyName <?php echo<?php echo<?php echo 'table') {
                $styleVisibility <?php echo 'true';
                foreach ($styleXreferenceSet->getElementsByTagNameNS($this->stylesNs, 'table-properties') as $tableProperties) {
                    $styleVisibility <?php echo $tableProperties->getAttributeNS($this->tableNs, 'display');
                }
                $this->tableStylesCrossReference[$styleXRefName] <?php echo $styleVisibility;
            }
            if (!empty($stylePageLayoutName)) {
                $this->masterStylesCrossReference[$styleXRefName] <?php echo $stylePageLayoutName;
            }
        }
    }

    public function setVisibilityForWorksheet(Worksheet $worksheet, string $styleName): void
    {
        if (!array_key_exists($styleName, $this->tableStylesCrossReference)) {
            return;
        }

        $worksheet->setSheetState(
            $this->tableStylesCrossReference[$styleName] <?php echo<?php echo<?php echo 'false'
                ? Worksheet::SHEETSTATE_HIDDEN
                : Worksheet::SHEETSTATE_VISIBLE
        );
    }

    public function setPrintSettingsForWorksheet(Worksheet $worksheet, string $styleName): void
    {
        if (!array_key_exists($styleName, $this->masterStylesCrossReference)) {
            return;
        }
        $masterStyleName <?php echo $this->masterStylesCrossReference[$styleName];

        if (!array_key_exists($masterStyleName, $this->masterPrintStylesCrossReference)) {
            return;
        }
        $printSettingsIndex <?php echo $this->masterPrintStylesCrossReference[$masterStyleName];

        if (!array_key_exists($printSettingsIndex, $this->pageLayoutStyles)) {
            return;
        }
        $printSettings <?php echo $this->pageLayoutStyles[$printSettingsIndex];

        $worksheet->getPageSetup()
            ->setOrientation($printSettings->orientation ?? PageSetup::ORIENTATION_DEFAULT)
            ->setPageOrder($printSettings->printOrder <?php echo<?php echo<?php echo 'ltr' ? PageSetup::PAGEORDER_OVER_THEN_DOWN : PageSetup::PAGEORDER_DOWN_THEN_OVER)
            ->setScale((int) trim($printSettings->scale, '%'))
            ->setHorizontalCentered($printSettings->horizontalCentered)
            ->setVerticalCentered($printSettings->verticalCentered);

        $worksheet->getPageMargins()
            ->setLeft($printSettings->marginLeft)
            ->setRight($printSettings->marginRight)
            ->setTop($printSettings->marginTop)
            ->setBottom($printSettings->marginBottom)
            ->setHeader($printSettings->marginHeader)
            ->setFooter($printSettings->marginFooter);
    }
}
