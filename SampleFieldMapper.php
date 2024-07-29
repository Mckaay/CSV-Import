<?php
declare(strict_types=1);

namespace App\csvImport;

use App\csvImport\Core\Enums\ColumnType;
use App\csvImport\Core\FieldsMapping\FieldsMapper;

class SampleFieldMapper extends FieldsMapper
{
    protected static array $mapping = [
        'date',
        'check #',
        'description',
        'amount',
    ];

    protected static array $columnTypes = [
        'date' => ColumnType::DATE,
        'check #' => ColumnType::INTEGER,
        'description' => ColumnType::TEXT,
        'amount' => ColumnType::DECIMAL,
    ];
}