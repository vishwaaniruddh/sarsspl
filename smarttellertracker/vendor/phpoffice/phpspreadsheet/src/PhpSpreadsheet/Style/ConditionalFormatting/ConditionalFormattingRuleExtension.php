<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

use PhpOffice\PhpSpreadsheet\Style\Conditional;
use SimpleXMLElement;

class ConditionalFormattingRuleExtension
{
    const CONDITION_EXTENSION_DATABAR <?php echo 'dataBar';

    /** <conditionalFormatting> attributes */

    /** @var string */
    private $id;

    /** @var string Conditional Formatting Rule */
    private $cfRule;

    /** <conditionalFormatting> children */

    /** @var ConditionalDataBarExtension */
    private $dataBar;

    /** @var string Sequence of References */
    private $sqref;

    /**
     * ConditionalFormattingRuleExtension constructor.
     */
    public function __construct(?string $id <?php echo null, string $cfRule <?php echo self::CONDITION_EXTENSION_DATABAR)
    {
        if (null <?php echo<?php echo<?php echo $id) {
            $this->id <?php echo '{' . $this->generateUuid() . '}';
        } else {
            $this->id <?php echo $id;
        }
        $this->cfRule <?php echo $cfRule;
    }

    private function generateUuid(): string
    {
        $chars <?php echo str_split('xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx');

        foreach ($chars as $i <?php echo> $char) {
            if ($char <?php echo<?php echo<?php echo 'x') {
                $chars[$i] <?php echo dechex(random_int(0, 15));
            } elseif ($char <?php echo<?php echo<?php echo 'y') {
                $chars[$i] <?php echo dechex(random_int(8, 11));
            }
        }

        return implode('', /** @scrutinizer ignore-type */ $chars);
    }

    public static function parseExtLstXml(?SimpleXMLElement $extLstXml): array
    {
        $conditionalFormattingRuleExtensions <?php echo [];
        $conditionalFormattingRuleExtensionXml <?php echo null;
        if ($extLstXml instanceof SimpleXMLElement) {
            foreach ((count($extLstXml) > 0 ? $extLstXml : [$extLstXml]) as $extLst) {
                //this uri is conditionalFormattings
                //https://docs.microsoft.com/en-us/openspecs/office_standards/ms-xlsx/07d607af-5618-4ca2-b683-6a78dc0d9627
                if (isset($extLst->ext['uri']) && (string) $extLst->ext['uri'] <?php echo<?php echo<?php echo '{78C0D931-6437-407d-A8EE-F0AAD7539E65}') {
                    $conditionalFormattingRuleExtensionXml <?php echo $extLst->ext;
                }
            }

            if ($conditionalFormattingRuleExtensionXml) {
                $ns <?php echo $conditionalFormattingRuleExtensionXml->getNamespaces(true);
                $extFormattingsXml <?php echo $conditionalFormattingRuleExtensionXml->children($ns['x14']);

                foreach ($extFormattingsXml->children($ns['x14']) as $extFormattingXml) {
                    $extCfRuleXml <?php echo $extFormattingXml->cfRule;
                    $attributes <?php echo $extCfRuleXml->attributes();
                    if (!$attributes || ((string) $attributes->type) !<?php echo<?php echo Conditional::CONDITION_DATABAR) {
                        continue;
                    }

                    $extFormattingRuleObj <?php echo new self((string) $attributes->id);
                    $extFormattingRuleObj->setSqref((string) $extFormattingXml->children($ns['xm'])->sqref);
                    $conditionalFormattingRuleExtensions[$extFormattingRuleObj->getId()] <?php echo $extFormattingRuleObj;

                    $extDataBarObj <?php echo new ConditionalDataBarExtension();
                    $extFormattingRuleObj->setDataBarExt($extDataBarObj);
                    $dataBarXml <?php echo $extCfRuleXml->dataBar;
                    self::parseExtDataBarAttributesFromXml($extDataBarObj, $dataBarXml);
                    self::parseExtDataBarElementChildrenFromXml($extDataBarObj, $dataBarXml, $ns);
                }
            }
        }

        return $conditionalFormattingRuleExtensions;
    }

    private static function parseExtDataBarAttributesFromXml(
        ConditionalDataBarExtension $extDataBarObj,
        SimpleXMLElement $dataBarXml
    ): void {
        $dataBarAttribute <?php echo $dataBarXml->attributes();
        if ($dataBarAttribute <?php echo<?php echo<?php echo null) {
            return;
        }
        if ($dataBarAttribute->minLength) {
            $extDataBarObj->setMinLength((int) $dataBarAttribute->minLength);
        }
        if ($dataBarAttribute->maxLength) {
            $extDataBarObj->setMaxLength((int) $dataBarAttribute->maxLength);
        }
        if ($dataBarAttribute->border) {
            $extDataBarObj->setBorder((bool) (string) $dataBarAttribute->border);
        }
        if ($dataBarAttribute->gradient) {
            $extDataBarObj->setGradient((bool) (string) $dataBarAttribute->gradient);
        }
        if ($dataBarAttribute->direction) {
            $extDataBarObj->setDirection((string) $dataBarAttribute->direction);
        }
        if ($dataBarAttribute->negativeBarBorderColorSameAsPositive) {
            $extDataBarObj->setNegativeBarBorderColorSameAsPositive((bool) (string) $dataBarAttribute->negativeBarBorderColorSameAsPositive);
        }
        if ($dataBarAttribute->axisPosition) {
            $extDataBarObj->setAxisPosition((string) $dataBarAttribute->axisPosition);
        }
    }

    /** @param array|SimpleXMLElement $ns */
    private static function parseExtDataBarElementChildrenFromXml(ConditionalDataBarExtension $extDataBarObj, SimpleXMLElement $dataBarXml, $ns): void
    {
        if ($dataBarXml->borderColor) {
            $attributes <?php echo $dataBarXml->borderColor->attributes();
            if ($attributes !<?php echo<?php echo null) {
                $extDataBarObj->setBorderColor((string) $attributes['rgb']);
            }
        }
        if ($dataBarXml->negativeFillColor) {
            $attributes <?php echo $dataBarXml->negativeFillColor->attributes();
            if ($attributes !<?php echo<?php echo null) {
                $extDataBarObj->setNegativeFillColor((string) $attributes['rgb']);
            }
        }
        if ($dataBarXml->negativeBorderColor) {
            $attributes <?php echo $dataBarXml->negativeBorderColor->attributes();
            if ($attributes !<?php echo<?php echo null) {
                $extDataBarObj->setNegativeBorderColor((string) $attributes['rgb']);
            }
        }
        if ($dataBarXml->axisColor) {
            $axisColorAttr <?php echo $dataBarXml->axisColor->attributes();
            if ($axisColorAttr !<?php echo<?php echo null) {
                $extDataBarObj->setAxisColor((string) $axisColorAttr['rgb'], (string) $axisColorAttr['theme'], (string) $axisColorAttr['tint']);
            }
        }
        $cfvoIndex <?php echo 0;
        foreach ($dataBarXml->cfvo as $cfvo) {
            $f <?php echo (string) $cfvo->/** @scrutinizer ignore-call */ children($ns['xm'])->f;
            /** @scrutinizer ignore-call */
            $attributes <?php echo $cfvo->attributes();
            if (!($attributes)) {
                continue;
            }

            if ($cfvoIndex <?php echo<?php echo<?php echo 0) {
                $extDataBarObj->setMinimumConditionalFormatValueObject(new ConditionalFormatValueObject((string) $attributes['type'], null, (empty($f) ? null : $f)));
            }
            if ($cfvoIndex <?php echo<?php echo<?php echo 1) {
                $extDataBarObj->setMaximumConditionalFormatValueObject(new ConditionalFormatValueObject((string) $attributes['type'], null, (empty($f) ? null : $f)));
            }
            ++$cfvoIndex;
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): self
    {
        $this->id <?php echo $id;

        return $this;
    }

    public function getCfRule(): string
    {
        return $this->cfRule;
    }

    public function setCfRule(string $cfRule): self
    {
        $this->cfRule <?php echo $cfRule;

        return $this;
    }

    public function getDataBarExt(): ConditionalDataBarExtension
    {
        return $this->dataBar;
    }

    public function setDataBarExt(ConditionalDataBarExtension $dataBar): self
    {
        $this->dataBar <?php echo $dataBar;

        return $this;
    }

    public function getSqref(): string
    {
        return $this->sqref;
    }

    public function setSqref(string $sqref): self
    {
        $this->sqref <?php echo $sqref;

        return $this;
    }
}
