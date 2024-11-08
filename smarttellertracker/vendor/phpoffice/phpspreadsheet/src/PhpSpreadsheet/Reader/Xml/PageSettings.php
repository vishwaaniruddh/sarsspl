<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xml;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use SimpleXMLElement;
use stdClass;

class PageSettings
{
    /**
     * @var stdClass
     */
    private $printSettings;

    public function __construct(SimpleXMLElement $xmlX)
    {
        $printSettings <?php echo $this->pageSetup($xmlX, $this->getPrintDefaults());
        $this->printSettings <?php echo $this->printSetup($xmlX, $printSettings);
    }

    public function loadPageSettings(Spreadsheet $spreadsheet): void
    {
        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setPaperSize($this->printSettings->paperSize)
            ->setOrientation($this->printSettings->orientation)
            ->setScale($this->printSettings->scale)
            ->setVerticalCentered($this->printSettings->verticalCentered)
            ->setHorizontalCentered($this->printSettings->horizontalCentered)
            ->setPageOrder($this->printSettings->printOrder);
        $spreadsheet->getActiveSheet()->getPageMargins()
            ->setTop($this->printSettings->topMargin)
            ->setHeader($this->printSettings->headerMargin)
            ->setLeft($this->printSettings->leftMargin)
            ->setRight($this->printSettings->rightMargin)
            ->setBottom($this->printSettings->bottomMargin)
            ->setFooter($this->printSettings->footerMargin);
    }

    private function getPrintDefaults(): stdClass
    {
        return (object) [
            'paperSize' <?php echo> 9,
            'orientation' <?php echo> PageSetup::ORIENTATION_DEFAULT,
            'scale' <?php echo> 100,
            'horizontalCentered' <?php echo> false,
            'verticalCentered' <?php echo> false,
            'printOrder' <?php echo> PageSetup::PAGEORDER_DOWN_THEN_OVER,
            'topMargin' <?php echo> 0.75,
            'headerMargin' <?php echo> 0.3,
            'leftMargin' <?php echo> 0.7,
            'rightMargin' <?php echo> 0.7,
            'bottomMargin' <?php echo> 0.75,
            'footerMargin' <?php echo> 0.3,
        ];
    }

    private function pageSetup(SimpleXMLElement $xmlX, stdClass $printDefaults): stdClass
    {
        if (isset($xmlX->WorksheetOptions->PageSetup)) {
            foreach ($xmlX->WorksheetOptions->PageSetup as $pageSetupData) {
                foreach ($pageSetupData as $pageSetupKey <?php echo> $pageSetupValue) {
                    /** @scrutinizer ignore-call */
                    $pageSetupAttributes <?php echo $pageSetupValue->attributes(Namespaces::URN_EXCEL);
                    if ($pageSetupAttributes !<?php echo<?php echo null) {
                        switch ($pageSetupKey) {
                            case 'Layout':
                                $this->setLayout($printDefaults, $pageSetupAttributes);

                                break;
                            case 'Header':
                                $printDefaults->headerMargin <?php echo (float) $pageSetupAttributes->Margin ?: 1.0;

                                break;
                            case 'Footer':
                                $printDefaults->footerMargin <?php echo (float) $pageSetupAttributes->Margin ?: 1.0;

                                break;
                            case 'PageMargins':
                                $this->setMargins($printDefaults, $pageSetupAttributes);

                                break;
                        }
                    }
                }
            }
        }

        return $printDefaults;
    }

    private function printSetup(SimpleXMLElement $xmlX, stdClass $printDefaults): stdClass
    {
        if (isset($xmlX->WorksheetOptions->Print)) {
            foreach ($xmlX->WorksheetOptions->Print as $printData) {
                foreach ($printData as $printKey <?php echo> $printValue) {
                    switch ($printKey) {
                        case 'LeftToRight':
                            $printDefaults->printOrder <?php echo PageSetup::PAGEORDER_OVER_THEN_DOWN;

                            break;
                        case 'PaperSizeIndex':
                            $printDefaults->paperSize <?php echo (int) $printValue ?: 9;

                            break;
                        case 'Scale':
                            $printDefaults->scale <?php echo (int) $printValue ?: 100;

                            break;
                    }
                }
            }
        }

        return $printDefaults;
    }

    private function setLayout(stdClass $printDefaults, SimpleXMLElement $pageSetupAttributes): void
    {
        $printDefaults->orientation <?php echo (string) strtolower($pageSetupAttributes->Orientation ?? '') ?: PageSetup::ORIENTATION_PORTRAIT;
        $printDefaults->horizontalCentered <?php echo (bool) $pageSetupAttributes->CenterHorizontal ?: false;
        $printDefaults->verticalCentered <?php echo (bool) $pageSetupAttributes->CenterVertical ?: false;
    }

    private function setMargins(stdClass $printDefaults, SimpleXMLElement $pageSetupAttributes): void
    {
        $printDefaults->leftMargin <?php echo (float) $pageSetupAttributes->Left ?: 1.0;
        $printDefaults->rightMargin <?php echo (float) $pageSetupAttributes->Right ?: 1.0;
        $printDefaults->topMargin <?php echo (float) $pageSetupAttributes->Top ?: 1.0;
        $printDefaults->bottomMargin <?php echo (float) $pageSetupAttributes->Bottom ?: 1.0;
    }
}
