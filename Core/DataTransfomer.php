<?php
declare(strict_types=1);

namespace App\csvImport\Core;

use App\csvImport\Core\FieldsMapping\FieldsMappingInterface;
use App\csvImport\SampleFieldMapper;
use http\Exception\InvalidArgumentException;

class DataTransfomer
{
    protected FieldsMappingInterface $fieldsMapping;

    public function __construct(FieldsMappingInterface $fieldsMapping) {
        $this->fieldsMapping = $fieldsMapping;
    }


    public function transformData(array $csvData): array
    {
        if (empty($csvData)) {
            throw new InvalidArgumentException('Csv_Data is empty!');
        }

        $fieldMapping = SampleFieldMapper::getFieldMappings();
        $data = [];
        foreach ($csvData as $row) {
            $extractedRow = $this->formatRow($row, $fieldMapping);
            $data[] = $extractedRow;
        }

        return $data;
    }

    private function formatRow(array $row, array $fieldMapping): array {
        $index = 0;
        $extractedRow = [];

        foreach ($row as $value) {
            $extractedRow[$fieldMapping[$index]] = $value;
            $index++;
        }

        return $extractedRow;
    }

}