<?php
declare(strict_types=1);

namespace App\csvImport\Core\Enums;

enum ColumnType: string
{
    case DATE = 'date';
    case INTEGER = 'integer';
    case DECIMAL = 'decimal';
    case TEXT = 'text';
}