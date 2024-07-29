<?php
declare(strict_types=1);

namespace App\csvImport\Core\FieldsMapping;

use App\csvImport\Core\Enums\ColumnType;

abstract class FieldsMapper implements FieldsMappingInterface
{
    protected static array $mapping = [];
    protected static array $columnTypes = [];

    public static function getFieldMappings(): array {
        return static::$mapping;
    }

    public static function getFieldMapping($key): string {
        return static::$mapping[$key];
    }

    public static function getColumnType(string $key): ColumnType
    {
        return static::$columnTypes[$key];
    }

}