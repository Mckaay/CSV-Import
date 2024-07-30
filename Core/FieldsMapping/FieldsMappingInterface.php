<?php

declare(strict_types=1);

namespace App\csvImport\Core\FieldsMapping;

use App\csvImport\Core\Enums\ColumnType;

interface FieldsMappingInterface
{
    public static function getFieldMappings(): array;
    public static function getFieldMapping(string $key): string;
    public static function getColumnType(string $key): ColumnType;
}
