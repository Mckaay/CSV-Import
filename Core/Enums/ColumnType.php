<?php

declare(strict_types=1);

namespace App\csvImport\Core\Enums;

enum ColumnType: string
{
    case DATE = 'Date';
    case INTEGER = 'Integer';
    case DECIMAL = 'Decimal';
    case TEXT = 'Text';
}
