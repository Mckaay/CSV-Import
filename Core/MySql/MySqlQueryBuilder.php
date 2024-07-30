<?php

declare(strict_types=1);

namespace App\csvImport\Core\MySql;

use App\csvImport\Core\Enums\ColumnType;
use App\csvImport\Core\FieldsMapping\FieldsMappingInterface;
use App\csvImport\Core\QueryBuilder;
use App\csvImport\Core\Sanitizers\DateSanitizer;
use App\csvImport\Core\Sanitizers\DecimalSanitizer;
use App\csvImport\Core\Sanitizers\IntegerSanitizer;
use App\csvImport\Core\Sanitizers\TextSanitizer;

class MySqlQueryBuilder implements QueryBuilder
{
    public function __construct(private FieldsMappingInterface $fieldsMapping)
    {
    }

    public function buildInsertQuery(string $tableName, array $data): string
    {
        if (empty($data)) {
            return '';
        }

        $columnString = $this->buildColumnString($data[0]);
        $valueString = $this->buildValueString($data);
        return "INSERT INTO `$tableName` ($columnString) VALUES $valueString";
    }

    private function buildColumnString(array $firstRow): string
    {
        $columns = array_keys($firstRow);
        $escapedColumns = array_map(fn($column) => "`$column`", $columns);
        return implode(', ', $escapedColumns);
    }

    private function buildValueString(array $data): string
    {
        $valueStrings = array_map([$this, 'sanitizeRow'], $data);
        return implode(', ', $valueStrings);
    }

    private function sanitizeRow(array $row): string
    {
        $sanitizedValues = array_map([$this, 'sanitizeValue'], array_keys($row), $row);
        return '(' . implode(', ', $sanitizedValues) . ')';
    }

    private function sanitizeValue(string $column, $value): mixed
    {
        if ($this->isNullOrEmpty($value)) {
            return 'NULL';
        }

        $columnType = $this->fieldsMapping::getColumnType($column);
        $sanitizedValue = match ($columnType) {
            ColumnType::INTEGER => IntegerSanitizer::sanitize($value),
            ColumnType::DECIMAL => DecimalSanitizer::sanitize($value),
            ColumnType::DATE=> DateSanitizer::sanitize($value),
            default => TextSanitizer::sanitize($value),
        };
        return is_string($sanitizedValue) ? "'" . $sanitizedValue . "'" : $sanitizedValue;
    }

    private function isNullOrEmpty($value): bool
    {
        return is_null($value) || $value === '';
    }
}
