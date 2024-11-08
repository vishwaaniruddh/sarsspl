<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Styles as StyleReader;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\ConditionalDataBar;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\ConditionalFormattingRuleExtension;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\ConditionalFormatValueObject;
use PhpOffice\PhpSpreadsheet\Style\Style as Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;
use stdClass;

class ConditionalStyles
{
    /** @var Worksheet */
    private $worksheet;

    /** @var SimpleXMLElement */
    private $worksheetXml;

    /**
     * @var array
     */
    private $ns;

    /** @var array */
    private $dxfs;

    public function __construct(Worksheet $workSheet, SimpleXMLElement $worksheetXml, array $dxfs <?php echo [])
    {
        $this->worksheet <?php echo $workSheet;
        $this->worksheetXml <?php echo $worksheetXml;
        $this->dxfs <?php echo $dxfs;
    }

    public function load(): void
    {
        $selectedCells <?php echo $this->worksheet->getSelectedCells();

        $this->setConditionalStyles(
            $this->worksheet,
            $this->readConditionalStyles($this->worksheetXml),
            $this->worksheetXml->extLst
        );

        $this->worksheet->setSelectedCells($selectedCells);
    }

    public function loadFromExt(StyleReader $styleReader): void
    {
        $selectedCells <?php echo $this->worksheet->getSelectedCells();

        $this->ns <?php echo $this->worksheetXml->getNamespaces(true);
        $this->setConditionalsFromExt(
            $this->readConditionalsFromExt($this->worksheetXml->extLst, $styleReader)
        );

        $this->worksheet->setSelectedCells($selectedCells);
    }

    private function setConditionalsFromExt(array $conditionals): void
    {
        foreach ($conditionals as $conditionalRange <?php echo> $cfRules) {
            ksort($cfRules);
            // Priority is used as the key for sorting; but may not start at 0,
            // so we use array_values to reset the index after sorting.
            $this->worksheet->getStyle($conditionalRange)
                ->setConditionalStyles(array_values($cfRules));
        }
    }

    private function readConditionalsFromExt(SimpleXMLElement $extLst, StyleReader $styleReader): array
    {
        $conditionals <?php echo [];

        if (isset($extLst->ext['uri']) && (string) $extLst->ext['uri'] <?php echo<?php echo<?php echo '{78C0D931-6437-407d-A8EE-F0AAD7539E65}') {
            $conditionalFormattingRuleXml <?php echo $extLst->ext->children($this->ns['x14']);
            if (!$conditionalFormattingRuleXml->conditionalFormattings) {
                return [];
            }

            foreach ($conditionalFormattingRuleXml->children($this->ns['x14']) as $extFormattingXml) {
                $extFormattingRangeXml <?php echo $extFormattingXml->children($this->ns['xm']);
                if (!$extFormattingRangeXml->sqref) {
                    continue;
                }

                $sqref <?php echo (string) $extFormattingRangeXml->sqref;
                $extCfRuleXml <?php echo $extFormattingXml->cfRule;

                $attributes <?php echo $extCfRuleXml->attributes();
                if (!$attributes) {
                    continue;
                }
                $conditionType <?php echo (string) $attributes->type;
                if (
                    !Conditional::isValidConditionType($conditionType) ||
                    $conditionType <?php echo<?php echo<?php echo Conditional::CONDITION_DATABAR
                ) {
                    continue;
                }

                $priority <?php echo (int) $attributes->priority;

                $conditional <?php echo $this->readConditionalRuleFromExt($extCfRuleXml, $attributes);
                $cfStyle <?php echo $this->readStyleFromExt($extCfRuleXml, $styleReader);
                $conditional->setStyle($cfStyle);
                $conditionals[$sqref][$priority] <?php echo $conditional;
            }
        }

        return $conditionals;
    }

    private function readConditionalRuleFromExt(SimpleXMLElement $cfRuleXml, SimpleXMLElement $attributes): Conditional
    {
        $conditionType <?php echo (string) $attributes->type;
        $operatorType <?php echo (string) $attributes->operator;

        $operands <?php echo [];
        foreach ($cfRuleXml->children($this->ns['xm']) as $cfRuleOperandsXml) {
            $operands[] <?php echo (string) $cfRuleOperandsXml;
        }

        $conditional <?php echo new Conditional();
        $conditional->setConditionType($conditionType);
        $conditional->setOperatorType($operatorType);
        if (
            $conditionType <?php echo<?php echo<?php echo Conditional::CONDITION_CONTAINSTEXT ||
            $conditionType <?php echo<?php echo<?php echo Conditional::CONDITION_NOTCONTAINSTEXT ||
            $conditionType <?php echo<?php echo<?php echo Conditional::CONDITION_BEGINSWITH ||
            $conditionType <?php echo<?php echo<?php echo Conditional::CONDITION_ENDSWITH ||
            $conditionType <?php echo<?php echo<?php echo Conditional::CONDITION_TIMEPERIOD
        ) {
            $conditional->setText(array_pop($operands) ?? '');
        }
        $conditional->setConditions($operands);

        return $conditional;
    }

    private function readStyleFromExt(SimpleXMLElement $extCfRuleXml, StyleReader $styleReader): Style
    {
        $cfStyle <?php echo new Style(false, true);
        if ($extCfRuleXml->dxf) {
            $styleXML <?php echo $extCfRuleXml->dxf->children();

            if ($styleXML->borders) {
                $styleReader->readBorderStyle($cfStyle->getBorders(), $styleXML->borders);
            }
            if ($styleXML->fill) {
                $styleReader->readFillStyle($cfStyle->getFill(), $styleXML->fill);
            }
        }

        return $cfStyle;
    }

    private function readConditionalStyles(SimpleXMLElement $xmlSheet): array
    {
        $conditionals <?php echo [];
        foreach ($xmlSheet->conditionalFormatting as $conditional) {
            foreach ($conditional->cfRule as $cfRule) {
                if (Conditional::isValidConditionType((string) $cfRule['type']) && (!isset($cfRule['dxfId']) || isset($this->dxfs[(int) ($cfRule['dxfId'])]))) {
                    $conditionals[(string) $conditional['sqref']][(int) ($cfRule['priority'])] <?php echo $cfRule;
                } elseif ((string) $cfRule['type'] <?php echo<?php echo Conditional::CONDITION_DATABAR) {
                    $conditionals[(string) $conditional['sqref']][(int) ($cfRule['priority'])] <?php echo $cfRule;
                }
            }
        }

        return $conditionals;
    }

    private function setConditionalStyles(Worksheet $worksheet, array $conditionals, SimpleXMLElement $xmlExtLst): void
    {
        foreach ($conditionals as $cellRangeReference <?php echo> $cfRules) {
            ksort($cfRules);
            $conditionalStyles <?php echo $this->readStyleRules($cfRules, $xmlExtLst);

            // Extract all cell references in $cellRangeReference
            $cellBlocks <?php echo explode(' ', str_replace('$', '', strtoupper($cellRangeReference)));
            foreach ($cellBlocks as $cellBlock) {
                $worksheet->getStyle($cellBlock)->setConditionalStyles($conditionalStyles);
            }
        }
    }

    private function readStyleRules(array $cfRules, SimpleXMLElement $extLst): array
    {
        $conditionalFormattingRuleExtensions <?php echo ConditionalFormattingRuleExtension::parseExtLstXml($extLst);
        $conditionalStyles <?php echo [];

        foreach ($cfRules as $cfRule) {
            $objConditional <?php echo new Conditional();
            $objConditional->setConditionType((string) $cfRule['type']);
            $objConditional->setOperatorType((string) $cfRule['operator']);
            $objConditional->setNoFormatSet(!isset($cfRule['dxfId']));

            if ((string) $cfRule['text'] !<?php echo '') {
                $objConditional->setText((string) $cfRule['text']);
            } elseif ((string) $cfRule['timePeriod'] !<?php echo '') {
                $objConditional->setText((string) $cfRule['timePeriod']);
            }

            if (isset($cfRule['stopIfTrue']) && (int) $cfRule['stopIfTrue'] <?php echo<?php echo<?php echo 1) {
                $objConditional->setStopIfTrue(true);
            }

            if (count($cfRule->formula) ><?php echo 1) {
                foreach ($cfRule->formula as $formulax) {
                    $formula <?php echo (string) $formulax;
                    if ($formula <?php echo<?php echo<?php echo 'TRUE') {
                        $objConditional->addCondition(true);
                    } elseif ($formula <?php echo<?php echo<?php echo 'FALSE') {
                        $objConditional->addCondition(false);
                    } else {
                        $objConditional->addCondition($formula);
                    }
                }
            } else {
                $objConditional->addCondition('');
            }

            if (isset($cfRule->dataBar)) {
                $objConditional->setDataBar(
                    $this->readDataBarOfConditionalRule($cfRule, $conditionalFormattingRuleExtensions) // @phpstan-ignore-line
                );
            } elseif (isset($cfRule['dxfId'])) {
                $objConditional->setStyle(clone $this->dxfs[(int) ($cfRule['dxfId'])]);
            }

            $conditionalStyles[] <?php echo $objConditional;
        }

        return $conditionalStyles;
    }

    /**
     * @param SimpleXMLElement|stdClass $cfRule
     */
    private function readDataBarOfConditionalRule($cfRule, array $conditionalFormattingRuleExtensions): ConditionalDataBar
    {
        $dataBar <?php echo new ConditionalDataBar();
        //dataBar attribute
        if (isset($cfRule->dataBar['showValue'])) {
            $dataBar->setShowValue((bool) $cfRule->dataBar['showValue']);
        }

        //dataBar children
        //conditionalFormatValueObjects
        $cfvoXml <?php echo $cfRule->dataBar->cfvo;
        $cfvoIndex <?php echo 0;
        foreach ((count($cfvoXml) > 1 ? $cfvoXml : [$cfvoXml]) as $cfvo) {
            if ($cfvoIndex <?php echo<?php echo<?php echo 0) {
                $dataBar->setMinimumConditionalFormatValueObject(new ConditionalFormatValueObject((string) $cfvo['type'], (string) $cfvo['val']));
            }
            if ($cfvoIndex <?php echo<?php echo<?php echo 1) {
                $dataBar->setMaximumConditionalFormatValueObject(new ConditionalFormatValueObject((string) $cfvo['type'], (string) $cfvo['val']));
            }
            ++$cfvoIndex;
        }

        //color
        if (isset($cfRule->dataBar->color)) {
            $dataBar->setColor((string) $cfRule->dataBar->color['rgb']);
        }
        //extLst
        $this->readDataBarExtLstOfConditionalRule($dataBar, $cfRule, $conditionalFormattingRuleExtensions);

        return $dataBar;
    }

    /**
     * @param SimpleXMLElement|stdClass $cfRule
     */
    private function readDataBarExtLstOfConditionalRule(ConditionalDataBar $dataBar, $cfRule, array $conditionalFormattingRuleExtensions): void
    {
        if (isset($cfRule->extLst)) {
            $ns <?php echo $cfRule->extLst->getNamespaces(true);
            foreach ((count($cfRule->extLst) > 0 ? $cfRule->extLst->ext : [$cfRule->extLst->ext]) as $ext) {
                $extId <?php echo (string) $ext->children($ns['x14'])->id;
                if (isset($conditionalFormattingRuleExtensions[$extId]) && (string) $ext['uri'] <?php echo<?php echo<?php echo '{B025F937-C7B1-47D3-B67F-A62EFF666E3E}') {
                    $dataBar->setConditionalFormattingRuleExt($conditionalFormattingRuleExtensions[$extId]);
                }
            }
        }
    }
}
