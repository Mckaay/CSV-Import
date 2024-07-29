<?php

namespace App\csvImport\Core\MySql;

use App\csvImport\Core\QueryBuilder;
use App\csvImport\Core\Sanitizers\DateSanitizer;
use App\csvImport\Core\Sanitizers\DecimalSanitizer;
use App\csvImport\Core\Sanitizers\TextSanitizer;
use App\csvImport\Core\Sanitizers\SanitizationStrategy;

class MySqlQueryBuilder implements QueryBuilder
{
    private array $sanitizers;

    public function __construct()
    {
        $this->sanitizers = [
            'date' => new DateSanitizer(),
            'check #' => new TextSanitizer(),
            'description' => new TextSanitizer(),
            'amount' => new DecimalSanitizer()
        ];
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

    private function sanitizeValue(string $column, $value): string
    {
        if ($this->isNullOrEmpty($value)) {
            return 'NULL';
        }

        $sanitizer = $this->getSanitizer($column);
        $sanitizedValue = $sanitizer->sanitize($value);

        return is_string($sanitizedValue) ? "'" . $sanitizedValue . "'" : $sanitizedValue;
    }

    private function isNullOrEmpty($value): bool
    {
        return is_null($value) || $value === '';
    }

    private function getSanitizer(string $column): SanitizationStrategy
    {
        return $this->sanitizers[$column] ?? new TextSanitizer();
    }
}