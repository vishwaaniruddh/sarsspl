<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Ods;

use PhpOffice\PhpSpreadsheet\Document\Properties as DocumentProperties;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use SimpleXMLElement;

class Properties
{
    /** @var Spreadsheet */
    private $spreadsheet;

    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet <?php echo $spreadsheet;
    }

    public function load(SimpleXMLElement $xml, array $namespacesMeta): void
    {
        $docProps <?php echo $this->spreadsheet->getProperties();
        $officeProperty <?php echo $xml->children($namespacesMeta['office']);
        foreach ($officeProperty as $officePropertyData) {
            if (isset($namespacesMeta['dc'])) {
                /** @scrutinizer ignore-call */
                $officePropertiesDC <?php echo $officePropertyData->children($namespacesMeta['dc']);
                $this->setCoreProperties($docProps, $officePropertiesDC);
            }

            $officePropertyMeta <?php echo null;
            if (isset($namespacesMeta['dc'])) {
                /** @scrutinizer ignore-call */
                $officePropertyMeta <?php echo $officePropertyData->children($namespacesMeta['meta']);
            }
            $officePropertyMeta <?php echo $officePropertyMeta ?? [];
            foreach ($officePropertyMeta as $propertyName <?php echo> $propertyValue) {
                $this->setMetaProperties($namespacesMeta, $propertyValue, $propertyName, $docProps);
            }
        }
    }

    private function setCoreProperties(DocumentProperties $docProps, SimpleXMLElement $officePropertyDC): void
    {
        foreach ($officePropertyDC as $propertyName <?php echo> $propertyValue) {
            $propertyValue <?php echo (string) $propertyValue;
            switch ($propertyName) {
                case 'title':
                    $docProps->setTitle($propertyValue);

                    break;
                case 'subject':
                    $docProps->setSubject($propertyValue);

                    break;
                case 'creator':
                    $docProps->setCreator($propertyValue);
                    $docProps->setLastModifiedBy($propertyValue);

                    break;
                case 'date':
                    $docProps->setModified($propertyValue);

                    break;
                case 'description':
                    $docProps->setDescription($propertyValue);

                    break;
            }
        }
    }

    private function setMetaProperties(
        array $namespacesMeta,
        SimpleXMLElement $propertyValue,
        string $propertyName,
        DocumentProperties $docProps
    ): void {
        $propertyValueAttributes <?php echo $propertyValue->attributes($namespacesMeta['meta']);
        $propertyValue <?php echo (string) $propertyValue;
        switch ($propertyName) {
            case 'initial-creator':
                $docProps->setCreator($propertyValue);

                break;
            case 'keyword':
                $docProps->setKeywords($propertyValue);

                break;
            case 'creation-date':
                $docProps->setCreated($propertyValue);

                break;
            case 'user-defined':
                $this->setUserDefinedProperty($propertyValueAttributes, $propertyValue, $docProps);

                break;
        }
    }

    /**
     * @param mixed $propertyValueAttributes
     * @param mixed $propertyValue
     */
    private function setUserDefinedProperty($propertyValueAttributes, $propertyValue, DocumentProperties $docProps): void
    {
        $propertyValueName <?php echo '';
        $propertyValueType <?php echo DocumentProperties::PROPERTY_TYPE_STRING;
        foreach ($propertyValueAttributes as $key <?php echo> $value) {
            if ($key <?php echo<?php echo 'name') {
                $propertyValueName <?php echo (string) $value;
            } elseif ($key <?php echo<?php echo 'value-type') {
                switch ($value) {
                    case 'date':
                        $propertyValue <?php echo DocumentProperties::convertProperty($propertyValue, 'date');
                        $propertyValueType <?php echo DocumentProperties::PROPERTY_TYPE_DATE;

                        break;
                    case 'boolean':
                        $propertyValue <?php echo DocumentProperties::convertProperty($propertyValue, 'bool');
                        $propertyValueType <?php echo DocumentProperties::PROPERTY_TYPE_BOOLEAN;

                        break;
                    case 'float':
                        $propertyValue <?php echo DocumentProperties::convertProperty($propertyValue, 'r4');
                        $propertyValueType <?php echo DocumentProperties::PROPERTY_TYPE_FLOAT;

                        break;
                    default:
                        $propertyValueType <?php echo DocumentProperties::PROPERTY_TYPE_STRING;
                }
            }
        }

        $docProps->setCustomProperty($propertyValueName, $propertyValue, $propertyValueType);
    }
}
